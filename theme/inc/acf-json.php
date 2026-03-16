<?php
/**
 * ACF JSON Sync settings
 */

/**
 * Set the save path for ACF JSON files.
 */
add_filter( 'acf/settings/save_json', 'aceedu_acf_json_save_point' );
function aceedu_acf_json_save_point( $path ) {
	return get_template_directory() . '/acf-json';
}

/**
 * Set the load path for ACF JSON files.
 */
add_filter( 'acf/settings/load_json', 'aceedu_acf_json_load_point' );
function aceedu_acf_json_load_point( $paths ) {
	// Remove original path (optional)
	unset( $paths[0] );

	// Append our new path
	$paths[] = get_template_directory() . '/acf-json';

	return $paths;
}
