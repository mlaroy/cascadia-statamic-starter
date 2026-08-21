<template>
    <div class="max-w-4xl mx-auto" data-max-width-wrapper>
        <Header title="Components" />

        <div class="flex flex-col gap-6">
            <div class="grid gap-6" :class="canSync ? 'md:grid-cols-2' : ''">
                <CardPanel heading="Conventions audit">
                    <Description class="mb-3">
                        Checks the component system against the kit conventions — name chain, builder purity, catalog integrity, theme keys vs CSS classes.
                    </Description>
                    <Button size="sm" :disabled="auditing" @click="runAudit">{{ auditing ? 'Running…' : 'Run audit' }}</Button>
                    <ResultPanel :result="lastAuditResult" class="mt-4" />
                </CardPanel>

                <CardPanel v-if="canSync" heading="Catalog sync">
                    <Description class="mb-3">
                        Stubs catalog entries for block fieldsets that lack one, and reports orphans.
                    </Description>
                    <Button size="sm" :disabled="syncing" @click="runSync">{{ syncing ? 'Running…' : 'Sync catalog' }}</Button>
                    <ResultPanel :result="lastSyncResult" class="mt-4" />
                </CardPanel>
            </div>

            <CardPanel heading="Catalog">
                <Description v-if="entries.length" class="mb-3">
                    {{ entries.length }} component{{ entries.length === 1 ? '' : 's' }} in the catalog.
                </Description>
                <Description v-else class="mb-3">No catalog entries yet.</Description>

                <Table v-if="entries.length">
                    <TableRow v-for="entry in entries" :key="entry.slug">
                        <TableCell width="60%">
                            <a :href="entry.edit_url" class="hover:underline">{{ entry.title }}</a>
                        </TableCell>
                        <TableCell>{{ entry.builder_group ?? '—' }}</TableCell>
                    </TableRow>
                </Table>
            </CardPanel>
        </div>
    </div>
</template>

<script>
import { Header, CardPanel, Button, Description, Badge, Table, TableRow, TableCell } from '@statamic/cms/ui';

const ResultPanel = {
    props: { result: { type: Object, default: null } },
    components: { Badge },
    template: `
        <div v-if="result">
            <div class="flex items-center gap-2 mb-2">
                <Badge :color="result.passed ? 'green' : 'red'">{{ result.passed ? 'Passed' : 'Failed' }}</Badge>
                <span class="text-2xs text-gray-500">{{ new Date(result.ran_at).toLocaleString() }}</span>
            </div>
            <pre class="text-2xs text-gray-800 dark:text-gray-200 bg-gray-100 dark:bg-gray-900 rounded p-3 overflow-x-auto whitespace-pre-wrap">{{ result.output }}</pre>
        </div>
        <p v-else class="text-2xs text-gray-500">Not run yet.</p>
    `,
};

export default {
    components: { Header, CardPanel, Button, Description, Table, TableRow, TableCell, ResultPanel },

    props: {
        canSync: { type: Boolean, default: false },
        lastAudit: { type: Object, default: null },
        lastSync: { type: Object, default: null },
        entries: { type: Array, default: () => [] },
    },

    data() {
        return {
            auditing: false,
            syncing: false,
            lastAuditResult: this.lastAudit,
            lastSyncResult: this.lastSync,
        };
    },

    methods: {
        runAudit() {
            this.auditing = true;

            this.$axios
                .post('/cp/cascadia/components/audit')
                .then((response) => {
                    this.lastAuditResult = response.data;
                    this.$toast[response.data.passed ? 'success' : 'error'](response.data.passed ? 'Component audit passed' : 'Component audit found issues');
                })
                .finally(() => (this.auditing = false));
        },

        runSync() {
            this.syncing = true;

            this.$axios
                .post('/cp/cascadia/components/sync')
                .then((response) => {
                    this.lastSyncResult = response.data;
                    this.$toast.success('Catalog sync complete');
                })
                .finally(() => (this.syncing = false));
        },
    },
};
</script>
