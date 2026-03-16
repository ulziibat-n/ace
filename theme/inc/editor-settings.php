<?php
/**
 * Gutenberg Editor Settings
 * Distract-free and clean editing experience.
 */

/**
 * Limit allowed block types to keep the editor clean.
 * We remove Design (except Separator), Widgets, Theme, and Embeds categories.
 */
function ub_allowed_block_types( $allowed_block_types, $editor_context ) {
	
	// List of allowed core blocks
	$allowed_blocks = array(
		// Essential Text Blocks
		'core/paragraph',
		'core/heading',
		'core/list',
		'core/list-item',
		'core/quote',
		
		// Essential Media
		'core/image',
		'core/gallery',
		
		// Specifically requested from Design category
		'core/separator',
		
		// Custom ACF Blocks
		'acf/hero',
		'acf/roadmap',
		'acf/faq',
		'acf/social-proof',
		'acf/feature-grid',
		'acf/contact-form',
	);

	// In the future, if you add more ACF blocks, they must be added to this list
	// or we can dynamically pull all acf/ blocks.
	
	return $allowed_blocks;
}
add_filter( 'allowed_block_types_all', 'ub_allowed_block_types', 10, 2 );

/**
 * Remove Core Block Patterns to prevent clutter
 */
function ub_remove_core_block_patterns() {
	remove_theme_support( 'core-block-patterns' );
}
add_action( 'after_setup_theme', 'ub_remove_core_block_patterns' );
