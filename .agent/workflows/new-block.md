## New ACF Gutenberg Block Workflow

1. Create directory: blocks/{block-name}/
2. Generate block.json (use acf-gutenberg-block skill)
3. Generate render.php (use acf-gutenberg-block skill)
4. Generate block.css with BEM naming: .site-{name}-block__element
5. Generate block.js (minimal — only if JS interaction needed)
6. Create registration file: inc/blocks/block-{name}.php
7. Register ACF field group for block
8. Add require_once in functions.php
9. Build assets: npm run build
10. Test: add block in editor → preview → inspect DOM
