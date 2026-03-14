---
description: How to build a WordPress/WooCommerce custom theme from a Stitch MCP design project
---

# WordPress Theme from Stitch Design

## Environment & Architecture
- **Shell**: Use **WSL** (/mnt/c/...) for terminal commands.
- **Modular Theme**: 
  - Root files (`header.php`, `footer.php`, `front-page.php`) are **stubs**.
  - Reusable layout parts in `layout/`.
  - Main page templates in `pages/`.
  - Assets in `assets/css/` and `assets/js/`, organized by functionality.
- **WooCommerce**: Pre-installed. Use `theme/woocommerce/` for overrides.

## Language Toggle & RTL (Arabic/English)
- **Attribute Switching**: Use `dir="rtl"` and `lang="ar"` on the `<html>` tag via JS.
- **Translation Hooks**: Use semantic CSS classes (e.g., `.hero-title`, `.b2b-cta`) as hooks for `lang-toggle.js`.
- **Persistence**: Store `'lang'` in `localStorage`. Apply immediately in `header.php` to avoid flip.
- **RTL Overrides**: Always enqueue `assets/css/rtl-overrides.css`. Scope with `[dir="rtl"]`.
- **Carousel RTL**: Handle negative `scrollLeft` values in JS. Flip arrows with `transform: scaleX(-1)`.

## Dark Mode Implementation
- **Class Toggle**: Use `dark` class on `<html>`. 
- **Persistence**: Store `'theme'` in `localStorage`.

## Animation & GSAP
- **GSAP Logic**: Keep in `assets/js/gsap-animations.js`. Use `ScrollTrigger` for scroll effects.
- **Impact Counters**: Use `IntersectionObserver` in `assets/js/impact-counter.js`.

## Stitch MCP Extraction Workflow
1. `mcp_StitchMCP_get_project` → get project metadata (colors, font, device type).
2. `mcp_StitchMCP_list_screens` → list all screens and their IDs.
3. `mcp_StitchMCP_get_screen` → for each screen, get the `htmlCode.downloadUrl`.
4. Use `browser_subagent` to open the download URL and **extract the full raw HTML source** including all Tailwind classes.
5. Save raw HTML to a reference file before conversion.

## Critical Design Fidelity Rules
- **Pixel-Perfect**: Build exactly what's in the Stitch HTML. No hallucinations.
- **Product Cards**: Fixed widths for carousels (e.g., `width: 320px; min-width: 320px;`).
- **Scroll Containers**: Use `scroll-behavior: smooth` and hide scrollbars.

## WooCommerce Override Rules
- Place overrides in `theme/woocommerce/`.
- Always provide **static fallback data** in PHP for when WC is inactive.
- Calculate sale percentages dynamically: `round(((reg - sale) / reg) * 100)`.

## Common Pitfalls to Avoid
1. **Don't use `min-width` alone on flex children** — they'll expand.
2. **Don't forget placeholders** for missing images.
3. **Escaping**: Always use `esc_html()`, `esc_url()`, and `esc_attr()`.
4. **RTL Logic**: Don't load RTL CSS conditionally; always load it for the JS toggle.
5. **Clean Code**: Remove unused scripts and old static HTML once converted.
