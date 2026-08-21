import ComponentCatalogPage from './components/ComponentCatalogPage.vue';

/**
 * The kit's component-catalog system: a CP page (System > Components,
 * registered by ComponentCatalogServiceProvider) plus command-palette
 * shortcuts that run the same actions and toast the result. Entirely
 * the kit's own — no dependency on Scout or any other addon.
 */
function postCp(path) {
    return fetch(path, {
        method: 'POST',
        credentials: 'same-origin',
        headers: {
            'X-CSRF-TOKEN': Statamic.$config.get('csrfToken'),
            'X-Requested-With': 'XMLHttpRequest',
        },
    }).then((response) => response.json());
}

function runAndToast(path, successMessage) {
    postCp(path).then((data) => {
        Statamic.$toast[data.passed ? 'success' : 'error'](data.passed ? successMessage : 'See System > Components for details');
    });
}

Statamic.booting(() => {
    Statamic.$inertia.register('ComponentCatalogPage', ComponentCatalogPage);

    // persist: true — the palette clears all non-persisted commands on
    // every CP navigation (Statamic's own router 'start' handler), so
    // without it these vanish after the first page.
    Statamic.$commandPalette.add({
        category: Statamic.$commandPalette.category.Actions,
        text: ['Cascadia', 'Run component audit'],
        icon: 'checkmark',
        persist: true,
        action: () => runAndToast('/cp/cascadia/components/audit', 'Component audit passed'),
    });

    Statamic.$commandPalette.add({
        category: Statamic.$commandPalette.category.Actions,
        text: ['Cascadia', 'Sync component catalog'],
        icon: 'sync',
        persist: true,
        action: () => runAndToast('/cp/cascadia/components/sync', 'Catalog sync complete'),
    });
});
