# Changelog

All notable changes to the Cascadia Starter Kit will be documented in this file.

The format is based on [Keep a Changelog](https://keepachangelog.com/en/1.1.0/),
and this project adheres to [Semantic Versioning](https://semver.org/spec/v2.0.0.html).

## [2.0.0] - 2025-02-04

### Added

- **Statamic V6 compatibility** – Kit updated for Statamic 6.x (Laravel 12+, PHP 8.3+)
- **Tailwind CSS 4** – Migrated from Tailwind 3 to Tailwind 4 with CSS-first configuration
  - `@theme` blocks for design tokens and colors in `site.css`
  - `@plugin "@tailwindcss/typography"` for typography utilities
  - `@utility` and `@layer` directives for custom utilities and base styles
  - `@tailwindcss/vite` plugin for Vite integration
  - `@tailwindcss/postcss` for PostCSS support
- **@alpinejs/intersect** – Added for intersection-observer-based behaviors (e.g., scroll-triggered animations, lazy loading)
- **View Transitions** – `@view-transition` support in theme styles for smoother navigation transitions
- **`"type": "module"`** – ES modules enabled in `package.json` for modern JavaScript imports

### Changed

- **Vite 6** – Upgraded from Vite 4 to Vite 6
- **laravel-vite-plugin** – Upgraded from ^0.7.2 to ^1.2.0
- **Alpine.js 3.14** – Updated from 3.13.x to 3.14.9 (collapse, focus, ui plugins)
- **Tailwind configuration** – Switched from `tailwind.config.js` to CSS-first configuration
  - Content paths, theme extensions, and plugins now defined via `@import`, `@theme`, and `@plugin` in CSS
- **Vite config** – Tailwind now integrated via `@tailwindcss/vite` plugin instead of PostCSS
- **Theme system** – Theme variables now leverage Tailwind 4's `@theme` blocks for consistent design tokens

### Removed

- **tailwind.config.js** – Replaced by Tailwind 4 CSS-first configuration
- **PostCSS Tailwind plugin** – Tailwind now integrated via `@tailwindcss/vite` and `@tailwindcss/postcss`

### Dependencies

| Package | Before | After |
|---------|--------|-------|
| tailwindcss | ^3.3.2 | ^4.1.7 |
| vite | ^4.0.0 | ^6.3.5 |
| laravel-vite-plugin | ^0.7.2 | ^1.2.0 |
| @tailwindcss/typography | ^0.5.9 | ^0.5.16 |
| alpinejs | ^3.13.0 | ^3.14.9 |
| @alpinejs/* | ^3.13.x | ^3.14.9 |
| @tailwindcss/vite | — | ^4.1.7 |
| @tailwindcss/postcss | — | ^4.1.7 |
| @alpinejs/intersect | — | ^3.14.9 |

### Migration Notes

- Run `npm install` after upgrading to ensure all new dependencies are installed.
- If you've customized `tailwind.config.js`, migrate your config to the new CSS-first format in `resources/css/site.css`.
- Tailwind 4 has a different configuration model—refer to the [Tailwind v4 documentation](https://tailwindcss.com/docs/v4) for details.
