---
name: acf-gutenberg-block
description: >
    Trigger when: creating new Gutenberg block, adding ACF fields to block,
    building block templates, registering block styles/scripts
triggers:
    - 'new block'
    - 'create block'
    - 'ACF block'
    - 'Gutenberg block'
---

## Step-by-Step Block Creation Protocol

### Step 1: block.json (REQUIRED FIRST)

{
"name": "acf/{block-name}",
"title": "Block Display Name",
"category": "ace-blocks",
"icon": "admin-generic",
"description": "Block purpose",
"script": "{block-handle}-js",
"acf": {
"mode": "preview",
"renderTemplate": "{block-name}.php"
},
"supports": {
"anchor": true,
"jsx": true,
"mode": false
},
"example": {
"attributes": {
"mode": "preview",
"data": {
"title": "Жишээ гарчиг",
"description": "Энэ бол редакторын өмнөх харагдацад зориулсан жишээ текст юм.",
"items": [
{ "title": "Жишээ 1" },
{ "title": "Жишээ 2" }
]
}
}
}
}

### Step 2: render.php Pattern

<?php
/**
 * Block: {Name}
 * @package aceedu
 */

// Bail if no block context
if (!isset($block)) { return; }

$ub_id    = $block['id'] ?? uniqid('block-');
$ub_class = 'block-{name} alignfull';

// Get ACF fields
$ub_title       = get_field('site_{name}_title');
$ub_description = get_field('site_{name}_description');

// Dynamic dummy content from block.json if fields are empty in preview.
if ( $is_preview && empty( $ub_title ) ) {
	$ub_example_data = function_exists( 'ub_get_block_example_data' ) ? ub_get_block_example_data( $block ) : array();
	if ( ! empty( $ub_example_data ) ) {
		$ub_title       = ! empty( $ub_title ) ? $ub_title : ( isset( $ub_example_data['title'] ) ? $ub_example_data['title'] : '' );
		$ub_description = ! empty( $ub_description ) ? $ub_description : ( isset( $ub_example_data['description'] ) ? $ub_example_data['description'] : '' );
	}
}

// Final Fallback for labels if still empty (Plain strings only - NO translation functions)
$ub_title = $ub_title ?: 'Мэдээллээ оруулна уу';
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
                'slug'  => 'ace-blocks',
                'title' => __('ACE Блокууд', 'aceedu'),
                'icon'  => 'admin-home',
            ]
        ], $categories);
    });
}, 5);

### Step 4: Whitelist in Editor Settings (CRITICAL)

**MANDATORY**: Every new block MUST be added to the `$acf_blocks` array in `theme/inc/editor-settings.php` to be visible in the Gutenberg editor.

```php
// theme/inc/editor-settings.php

$acf_blocks = array(
    // ... existing blocks
    'acf/{block-name}',
);
```
