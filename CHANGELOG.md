# Changelog

## [3.0.0] - 2026-08-21

### Changed

- **Breaking:** every page-builder/callout block fieldset and its view partial is renamed to a `content_`/`callout_` prefixed, name-chain convention (e.g. `accordion.yaml` → `content_accordion.yaml`); shared field clusters (theme, content intro, buttons, media, modal, page config, social links, team member) are consolidated into importable `group_*` fieldsets instead of being duplicated inline; Bard sets move to the matching `set_*` fieldsets. `page_blocks.yaml` keeps its existing name (not renamed to `page_builder`) but is now pure composition — one import per set, plus an icon.
- The pre-existing `resources/views/components/` shared-atom layer is consolidated into `resources/views/partials/`, which also gains new atoms (`_carousel`, `_media`, `_section`).
- The 50/50 Split and Large Media blocks' image/video picker is now the shared `group_media` field, which adds a carousel option.
- CTA Bumper, Callout Grid, and Image Callout move into their own "Callouts" page-builder group, previously mixed into the generic "Content" group.
- SEO fields now come from the `aerni/advanced-seo` package instead of an inline `seo_fields` fieldset.

### Added

- **Component-catalog system**: `php artisan components:audit` (checks the name-chain, builder purity, catalog integrity, and theme/CSS consistency), `components:sync` (stubs missing catalog entries, reports orphans), and `components:make` (scaffolds a new component's fieldset, builder registration, partial, and catalog entry in one step). A `content/collections/components` catalog collection (with a `component_tags` taxonomy) documents every component's purpose, when to use it, and what content it needs. Reachable from a new System → Components control panel page and the command palette (⌘K).
- Three new Bard sets: Image, Embed, and Buttons.
- An `accent-dark` theme option.
- An `EnvironmentInfo` dashboard widget that flags non-production environments.
- `chrisvasey/statamic-boost` for AI-assisted development against this kit's conventions.

### Fixed

- The image carousel's active-slide counter could drift out of sync with the visible slide at either boundary.

## [2.0.0] - 2025-02-04

### Changed

- Converted all `{{ partial:... }}` tags to the new `<s:partial:... />` component syntax across templates
- Simplified SEO meta fallbacks in layout using null coalescence (`??`) operator
- Simplified button text fallback in `_button.antlers.html` using null coalescence
- Consolidated link button text logic in `_link.antlers.html` into a single expression with explanatory comment
