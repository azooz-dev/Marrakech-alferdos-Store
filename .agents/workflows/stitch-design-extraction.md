---
description: How to extract complete designs from Stitch MCP projects with full fidelity
---

# Stitch Design Extraction

## Step-by-Step Process

1. **Get project metadata:**
   ```
   mcp_StitchMCP_get_project(name="projects/<ID>")
   ```
   Extract: `designTheme.colorMode`, `designTheme.font`, `designTheme.customColor`, `designTheme.roundness`, `deviceType`.

2. **List all screens:**
   ```
   mcp_StitchMCP_list_screens(projectId="<ID>")
   ```
   Note each screen's `name`, `title`, `htmlCode.downloadUrl`, `width`, `height`.

3. **Get screen details:**
   ```
   mcp_StitchMCP_get_screen(name="projects/<PID>/screens/<SID>", projectId="<PID>", screenId="<SID>")
   ```

4. **Download full HTML source** (CRITICAL):
   - **Do NOT rely on `read_url_content`** — it converts HTML to markdown and strips all CSS classes, inline styles, and structure.
   - **Use `browser_subagent`** to open the `htmlCode.downloadUrl` and extract the full raw DOM.
   - Alternatively, use `view_content_chunk` for text content reference only.

5. **Extract design system from HTML `<head>`:**
   - Look for `<script id="tailwind-config">` — contains the complete Tailwind config with colors, fonts, border radius.
   - Look for `<style>` blocks — contains custom CSS like glassmorphism, gradients.
   - Note Google Fonts and icon font links.

## Key Assets to Extract
| Asset | Where to Find It |
|-------|-----------------|
| Color palette | `tailwind.config.theme.extend.colors` |
| Font family | `tailwind.config.theme.extend.fontFamily` + Google Fonts `<link>` |
| Border radius | `tailwind.config.theme.extend.borderRadius` |
| Custom effects | `<style>` blocks (glassmorphism, gradients, animations) |
| Image URLs | `<img src="...">` tags throughout the HTML |
| Icon set | Material Symbols / Icons `<link>` in `<head>` |

## Fidelity Checklist
- [ ] Carousel/slider sections have navigation arrows
- [ ] Product cards have hover effects (scale, opacity reveal)
- [ ] Glassmorphism has both `backdrop-filter` AND `-webkit-backdrop-filter`
- [ ] All images preserved with original URLs as fallbacks
- [ ] Typography sizes match exactly (check h1–h6, body, labels)
- [ ] Spacing matches (padding, margins, gaps)
- [ ] Border radius values match per component
