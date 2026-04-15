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
 * @param array $allowed_block_types List of allowed block types.
 *
 * @return array List of allowed block types.
 */
function ub_allowed_block_types( $allowed_block_types ) {
	// We are replacing the list, so unset the original parameter to satisfy PHPCS.
	unset( $allowed_block_types );

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
		'acf/hero-main',
		'acf/roadmap',
		'acf/faq',
		'acf/social-proof',
		'acf/feature-grid',
		'acf/feature-cards',
		'acf/contact-form',
		'acf/cta-banner',
		'acf/process-timeline',
		'acf/testimonials',
		'acf/trust-signals',
		'acf/page-header',
		'acf/core-pathways',
		'acf/design-system',
		'acf/value-prop',
		'acf/schools-carousel',
		'acf/posts-carousel',
		'acf/hero-about',
		'acf/mission-vision-values',
		'acf/team',
		'acf/milestones',
		'acf/trust-signals-bento',
		'acf/about-info',
		'acf/service-features',
		'acf/service-value-prop',
		'acf/process-roadmap',
		'acf/comparison-diff',
		'acf/featured-posts-slider',
		'acf/latest-posts',
	);

	foreach ( $acf_blocks as $block ) {
		$allowed_blocks[] = $block;
	}

	return $allowed_blocks;
}
add_filter( 'allowed_block_types_all', 'ub_allowed_block_types', 10, 1 );

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
