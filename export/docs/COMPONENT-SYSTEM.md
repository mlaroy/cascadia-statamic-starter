# The Component System

This document explains the kit's component system in plain terms — the conventions every component follows, and the tooling that keeps them honest.

---

## Why this exists

Most Statamic sites accumulate structure by accident. One developer defines a heading field inline, another copies it with slightly different settings, a third invents a new rich-text configuration because they didn't know one already existed. Six months later there are nine ways to add a button and nobody remembers which components are safe to use where.

This kit takes the opposite approach: **every component follows the same rules, and the rules are checkable by a machine.**

That matters for two audiences:

1. **People.** Editors get a consistent control panel where every block works the same way. Developers get a codebase where knowing one component's name tells you where everything about it lives.
2. **AI assistants.** The rules are precise enough that an AI can assemble new pages — or build entirely new components — without guessing.

## What it does

The system has four parts that always stay in sync. For any component (say, `content_basic_hero`), the same name appears in four places — we call this the **name chain**:

| Artifact | Where | What it is |
|---|---|---|
| Fieldset | `resources/fieldsets/content_basic_hero.yaml` | The fields an editor fills in |
| Builder set | inside `resources/fieldsets/page_blocks.yaml` | Makes the block available in the page builder |
| Partial | `resources/views/page_blocks/_content_basic_hero.antlers.html` | The template that renders it |
| Catalog entry | `content/collections/components/content_basic_hero.md` | Metadata: what it's for, when to use it |

The **component catalog** deserves special mention: it's a Statamic collection (visible in the control panel under "System") where each component describes itself — what it looks like, when to use it, when a sibling component is the better choice, and what content it needs to look good. Humans can edit these descriptions in the control panel.

Shared building blocks (`group_content` for the eyebrow/heading/description intro, `group_media` for image/video/carousel choices, `group_button` for links, `group_bard` for rich text, `group_theme` for color schemes) are defined once and imported everywhere — so consistency isn't a discipline problem, it's the path of least resistance.

Two commands keep the whole thing honest:

### `php artisan components:audit`

The rule-checker. It verifies:

- every component has all four name-chain artifacts, and nothing is orphaned
- the page builder stays "pure" (each block is one import, with an icon)
- fieldsets are named and titled according to the taxonomy
- every theme option in the CMS has a matching CSS class, and vice versa
- no leftover auto-generated replicator wrappers

It exits with a failure code when something's wrong, so it can run in CI and block a merge that breaks the conventions.

### `php artisan components:sync [--prune]`

The catalog housekeeper. If someone adds a component fieldset but forgets its catalog entry, `sync` creates a stub (with TODOs where the descriptions go). If a catalog entry points at a component that no longer exists, `sync` reports it — and `--prune` deletes it.

Both are also reachable from the control panel: a "System → Components" page with buttons for each, and matching command-palette entries (⌘K → "Cascadia").

## How to use it

**Day to day, you mostly don't have to.** Build components following the conventions below, and run `components:audit` before committing — or let CI run it for you.

**When adding a new component**, start with the scaffolder:

```
php artisan components:make content_pricing_table --group=content --icon=layout-grid-dots
```

That creates all four artifacts at once — a fieldset stub (theme + content groups imported), the builder registration, a partial stub with the section wrapper, and a catalog entry with TODOs — passing the audit from the first second. Then:

1. Add block-specific fields to the fieldset, composing the shared groups rather than redefining fields.
2. Build the markup in the partial, using the shared atoms (`partials.link`, `partials.media`, `partials.carousel`).
3. Fill in the catalog entry's descriptions (in the file or in the control panel).
4. Run `php artisan components:audit` — green means you didn't miss anything.
