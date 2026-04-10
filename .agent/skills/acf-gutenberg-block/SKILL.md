---
name: acf-gutenberg-block
description: >
  Trigger when: creating new Gutenberg block, adding ACF fields to block,
  building block templates, registering block styles/scripts
triggers:
  - "new block"
  - "create block"  
  - "ACF block"
  - "Gutenberg block"
---

## Step-by-Step Block Creation Protocol

### Step 1: block.json (REQUIRED FIRST)
{
  "$schema": "https://schemas.wp.org/trunk/block.json",
  "apiVersion": 3,
  "name": "site/{block-name}",
  "title": "Block Display Name",
  "category": "site-blocks",
  "icon": "admin-generic",
  "description": "Block purpose",
  "supports": {
    "html": false,
    "align": ["wide", "full"],
    "color": { "background": true, "text": true },
    "spacing": { "padding": true, "margin": true }
  },
  "attributes": {
    "align": { "type": "string", "default": "wide" }
  },
  "acf": {
    "mode": "preview",
    "renderTemplate": "render.php"
  },
  "editorScript": "file:./block.js",
  "style": "file:./block.css"
}

### Step 2: render.php Pattern
<?php
declare(strict_types=1);
/**
 * Block: {Name}
 * @package SiteTheme
 * @since 1.0.0
 */

// Bail if no block context
if (!isset($block)) { return; }

$block_id    = $block['id'] ?? uniqid('block-');
$block_class = 'site-{name}-block';
$align_class = !empty($block['align']) ? 'align' . esc_attr($block['align']) : '';

// Get ACF fields with fallbacks
$title       = get_field('site_{name}_title') ?: '';
$description = get_field('site_{name}_description') ?: '';

// Early return if no content (edit mode exception)
if (empty($title) && !defined('REST_REQUEST')) { return; }
?>

<div id="<?php echo esc_attr($block_id); ?>" 
     class="<?php echo esc_attr("{$block_class} {$align_class}"); ?>">
  <?php if ($title) : ?>
    <h2 class="site-{name}-block__title">
      <?php echo esc_html($title); ?>
    </h2>
  <?php endif; ?>
</div>

### Step 3: Registration (inc/blocks/block-{name}.php)
<?php
declare(strict_types=1);

add_action('init', function(): void {
    if (!function_exists('acf_register_block_type')) { return; }
    
    register_block_type(
        get_template_directory() . '/blocks/{block-name}/block.json'
    );
    
    // Register block category if needed
    add_filter('block_categories_all', function(array $categories): array {
        return array_merge([
            [
                'slug'  => 'site-blocks',
                'title' => __('Site Blocks', 'site-theme'),
                'icon'  => 'admin-home',
            ]
        ], $categories);
    });
}, 5);
