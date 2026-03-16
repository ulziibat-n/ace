<?php
/**
 * ACF JSON Sync settings
 */

/**
 * Set the save path for ACF JSON files.
 */
add_filter( 'acf/settings/save_json', 'ub_acf_json_save_point' );
function ub_acf_json_save_point( $path ) {
	return get_template_directory() . '/acf-json';
}

/**
 * Set the load path for ACF JSON files.
 */
add_filter( 'acf/settings/load_json', 'ub_acf_json_load_point' );
function ub_acf_json_load_point( $paths ) {
	// Remove original path (optional)
	unset( $paths[0] );

	// Append our new path
	$paths[] = get_template_directory() . '/acf-json';

	return $paths;
}
