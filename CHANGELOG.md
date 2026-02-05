# Changelog

## [2.0.0] - 2025-02-04

### Changed

- Converted all `{{ partial:... }}` tags to the new `<s:partial:... />` component syntax across templates
- Simplified SEO meta fallbacks in layout using null coalescence (`??`) operator
- Simplified button text fallback in `_button.antlers.html` using null coalescence
- Consolidated link button text logic in `_link.antlers.html` into a single expression with explanatory comment
