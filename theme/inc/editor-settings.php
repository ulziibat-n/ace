<?php
/**
 * Gutenberg Editor Settings
 * Distract-free and clean editing experience.
 *
 * @package aceedu
 */

/**
 * Limit allowed block types to keep the editor clean.
 * We remove Design (except Separator), Widgets, Theme, and Embeds categories.
 *
 * @param array                   $allowed_block_types List of allowed block types.
 * @param WP_Block_Editor_Context $editor_context      The current block editor context.
 *
 * @return array List of allowed block types.
 */
function ub_allowed_block_types( $allowed_block_types, $editor_context ) {

	// List of allowed core blocks.
	$allowed_blocks = array(
		'core/paragraph',
		'core/heading',
		'core/list',
		'core/list-item',
		'core/quote',
		'core/image',
		'core/table',
		'core/separator',
	);

	// Custom ACF Blocks.
	$acf_blocks = array(
		'acf/hero',
		'acf/roadmap',
		'acf/faq',
		'acf/social-proof',
		'acf/feature-grid',
		'acf/contact-form',
		'acf/cta-banner',
	);

	foreach ( $acf_blocks as $block ) {
		$allowed_blocks[] = $block;
	}

	return $allowed_blocks;
}
add_filter( 'allowed_block_types_all', 'ub_allowed_block_types', 10, 2 );

/**
 * Блокуудын alignment тохиргоог өөрчлөх.
 * Full width сонголтыг хасаж, зөвхөн Wide үлдээх. (Editor UI-аас хасах)
 */
add_action(
	'admin_head',
	function () {
		echo '<style>
		button[aria-label="Full width"],
		.components-popover__content button[aria-label="Full width"],
		.block-editor-block-card__alignment-option[data-alignment="full"] {
			display: none !important;
		}
	</style>';
	}
);

/**
 * Блокуудын өгөгдмөл загваруудыг хасах.
 */
function ub_unregister_block_styles() {
	unregister_block_style( 'core/image', 'rounded' );
}
add_action( 'init', 'ub_unregister_block_styles' );

/**
 * Remove Core Block Patterns to prevent clutter.
 */
function ub_remove_core_block_patterns() {
	remove_theme_support( 'core-block-patterns' );
}
add_action( 'after_setup_theme', 'ub_remove_core_block_patterns' );
