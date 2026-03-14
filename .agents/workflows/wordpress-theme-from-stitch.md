---
description: How to build a WordPress/WooCommerce custom theme from a Stitch MCP design project
---

# WordPress Theme from Stitch Design

## Environment Rules (Laragon + WSL)
- The shell is **WSL** — never use Windows commands (`copy`, `cmd.exe /c`, `move`). Use Unix equivalents (`cp`, `mv`) with `/mnt/c/` paths.
- WordPress root is at `c:\laragon\www\custom-theme` (Windows) / `/mnt/c/laragon/www/custom-theme` (WSL).
- Theme directory: `wp-content/themes/<theme-name>/`.
- **WooCommerce is pre-installed** — always declare `add_theme_support('woocommerce')`.

## Stitch MCP Extraction Workflow
1. `mcp_StitchMCP_get_project` → get project metadata (colors, font, device type).
2. `mcp_StitchMCP_list_screens` → list all screens and their IDs.
3. `mcp_StitchMCP_get_screen` → for each screen, get the `htmlCode.downloadUrl`.
4. Use `browser_subagent` to open the download URL and **extract the full raw HTML source** including all Tailwind classes, inline styles, and structure. The `read_url_content` tool only gives markdown summaries — it strips classes.
5. Save the raw HTML to a reference file before starting conversion.

## Critical Design Fidelity Rules
- **Never hallucinate UI elements.** Build exactly what's in the Stitch HTML.
- **Check for interactive controls:** Carousels always need left/right navigation arrows. Check the Stitch source for `justify-between` in section headers — that indicates navigation buttons exist.
- **Product cards in carousels:** Always use a FIXED width (e.g., `width: 280px; min-width: 280px; max-width: 280px;`), never just `min-width` alone — cards will expand to fill available space.
- **Scroll containers for carousels:** Wrap in a positioning wrapper, use `scroll-behavior: smooth`, hide scrollbar with `scrollbar-width: none` + `::-webkit-scrollbar { display: none }`.

## WordPress Theme File Checklist
// turbo-all

1. `style.css` — Must start with theme header comment block. Convert Tailwind to vanilla CSS custom properties.
2. `functions.php` — Must include:
   - `add_theme_support('title-tag', 'post-thumbnails', 'custom-logo', 'html5', 'woocommerce')`
   - `wp_enqueue_style` / `wp_enqueue_script` (never hardcode `<link>` or `<script>`)
   - `register_nav_menus` for all menu locations
   - WooCommerce cart fragment filter for AJAX cart count
   - Remove default WC wrappers and sidebar
3. `header.php` — Must include: `<!DOCTYPE html>`, `language_attributes()`, `wp_head()`, `body_class()`, `wp_body_open()`
4. `footer.php` — Must include `wp_footer()` before `</body></html>`
5. `front-page.php` — Homepage template with `get_header()` / `get_footer()`
6. `index.php` — Fallback with basic WordPress loop

## WooCommerce Override Rules
- Place overrides in `theme/woocommerce/` directory.
- `archive-product.php` — shop page (use `wc_get_template_part('content', 'product')` inside loop).
- `content-product.php` — individual product card in loops.
- `single-product.php` — product detail page.
- `cart/cart.php` — cart page (preserve `wp_nonce_field` and all WC hooks).
- Always calculate sale percentage dynamically: `round(((regular - sale) / regular) * 100)`.
- Always provide **static fallback data** for when WooCommerce isn't active.

## CSS Conversion: Tailwind → Vanilla
- Extract Tailwind config from `<script id="tailwind-config">` in Stitch HTML.
- Map `colors`, `fontFamily`, `borderRadius` to CSS custom properties in `:root`.
- Translate utility classes to semantic class names (e.g., `.glass`, `.bento-gradient`, `.product-card`).
- Always include responsive breakpoints: `768px` (tablet), `1024px` (desktop), `1280px` (large).

## Common Pitfalls to Avoid
1. **Don't use `min-width` alone on flex children** — they'll expand. Always pair with `width` and `max-width`.
2. **Don't forget the `</div>` for wrapper elements** — when adding a scroll wrapper, count open/close tags.
3. **Don't hardcode image URLs in final templates** — use `get_the_post_thumbnail_url()`, `wc_placeholder_img_src()`.
4. **Don't skip `esc_url()`, `esc_html()`, `esc_attr()`** — WordPress coding standards require escaping.
5. **Don't forget `wp_reset_postdata()`** after custom WP_Query loops.
