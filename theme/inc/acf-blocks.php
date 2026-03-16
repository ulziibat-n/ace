<?php
/**
 * Register ACF Blocks
 */

function ace_register_acf_blocks() {
	/**
	 * We register our blocks by looking for block.json files in the blocks directory.
	 */
	$blocks_dir = get_template_directory() . '/blocks';
	
	if ( is_dir( $blocks_dir ) ) {
		$block_folders = scandir( $blocks_dir );
		foreach ( $block_folders as $folder ) {
			if ( '.' !== $folder && '..' !== $folder ) {
				$block_json = $blocks_dir . '/' . $folder . '/block.json';
				if ( file_exists( $block_json ) ) {
					register_block_type( $blocks_dir . '/' . $folder );
				}
			}
		}
	}
}
add_action( 'init', 'ace_register_acf_blocks' );

/**
 * Add Block Categories
 */
function ace_block_categories( $categories, $post ) {
	return array_merge(
		$categories,
		array(
			array(
				'slug'  => 'ace-blocks',
				'title' => __( 'ACE Блокууд', 'ace' ),
			),
		)
	);
}
add_filter( 'block_categories_all', 'ace_block_categories', 10, 2 );
