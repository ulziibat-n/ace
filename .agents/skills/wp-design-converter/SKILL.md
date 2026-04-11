---
name: wp-design-converter
description: Converts static HTML/Tailwind to WordPress templates
---

# WordPress Design Converter Skill

This skill enables the agent to convert static HTML/Tailwind CSS mockups into production-ready WordPress templates while maintaining 100% design fidelity.

## Instructions

1. **Analyze Static HTML**: Carefully review the provided static HTML structure, classes, and assets.
2. **Component Decomposition**: Break down repeated UI components into WordPress template-parts located in `template-parts/` or designated directories.
3. **Dynamic Integration**: Replace hardcoded text, images, and links with WordPress functions:
    - Use `the_title()` or `get_the_title()` for headings.
    - Use `get_field()` for ACF fields.
    - Use `the_post_thumbnail()` or `wp_get_attachment_image()` for images.
    - Use `esc_html()`, `esc_attr()`, and `esc_url()` for security.
4. **Visual Exactness**: Ensure the final PHP output generates the exact same HTML and CSS structure as the provided mockup. DO NOT modify Tailwind classes or layout logic.
