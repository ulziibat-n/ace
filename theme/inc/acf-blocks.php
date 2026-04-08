<?php
/**
 * Register ACF Blocks
 */

function ub_register_acf_blocks() {
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
add_action( 'init', 'ub_register_acf_blocks' );

/**
 * Add Block Categories
 *
 * @param array $categories Existing block categories.
 * @return array Modified block categories.
 */
function ub_block_categories( $categories ) {
	return array_merge(
		$categories,
		array(
			array(
				'slug'  => 'ace-blocks',
				'title' => __( 'ACE Блокууд', 'aceedu' ),
			),
		)
	);
}
add_filter( 'block_categories_all', 'ub_block_categories', 10, 1 );

/**
 * Бүх ACF блокуудыг автоматаар бүтэн өргөнөөр харуулах болон сонголт хийх хэсгийг нуух.
 * Энэ нь ирээдүйд шинэ блокууд нэмэгдэхэд автоматаар ажиллана.
 *
 * @param array  $args Блокны аргументууд.
 * @param string $block_type Блокны нэр (acf/faq г.м).
 * @return array Шинэчилсэн аргументууд.
 */
function ub_force_acf_blocks_alignment( $args, $block_type ) {
	if ( strpos( $block_type, 'acf/' ) === 0 ) {
		// Зөвхөн 'full' өргөнийг зөвшөөрөх.
		$args['supports']['align'] = array( 'full' );

		// Анхдагч өргөнийг 'full' болгож тохируулах.
		$args['attributes']['align'] = array(
			'type'    => 'string',
			'default' => 'full',
		);
	}
	return $args;
}
add_filter( 'register_block_type_args', 'ub_force_acf_blocks_alignment', 20, 2 );
