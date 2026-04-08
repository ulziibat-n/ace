<?php
/**
 * ACE EDU WORLD төсөлд зориулсан тусгай контентын төрлүүд (CPT) болон 
 * ангилал (Taxonomies)-ийг бүртгэх файл.
 */

function ub_register_school_post_type() {
    $labels = array(
        'name'                  => _x( 'Сургуулиуд', 'Post Type General Name', 'aceedu' ),
        'singular_name'         => _x( 'Сургууль', 'Post Type Singular Name', 'aceedu' ),
        'menu_name'             => __( 'Сургуулиуд', 'aceedu' ),
        'name_admin_bar'        => __( 'Сургууль', 'aceedu' ),
        'archives'              => __( 'Сургуулийн архив', 'aceedu' ),
        'attributes'            => __( 'Сургуулийн шинж чанар', 'aceedu' ),
        'parent_item_colon'     => __( 'Эцэг сургууль:', 'aceedu' ),
        'all_items'             => __( 'Бүх сургуулиуд', 'aceedu' ),
        'add_new_item'          => __( 'Шинэ сургууль нэмэх', 'aceedu' ),
        'add_new'               => __( 'Шинээр нэмэх', 'aceedu' ),
        'new_item'              => __( 'Шинэ сургууль', 'aceedu' ),
        'edit_item'             => __( 'Засах', 'aceedu' ),
        'update_item'           => __( 'Шинэчлэх', 'aceedu' ),
        'view_item'             => __( 'Харах', 'aceedu' ),
        'view_items'            => __( 'Сургуулиудыг харах', 'aceedu' ),
        'search_items'          => __( 'Сургууль хайх', 'aceedu' ),
        'not_found'             => __( 'Олдсонгүй', 'aceedu' ),
        'not_found_in_trash'    => __( 'Хогийн саванд олдсонгүй', 'aceedu' ),
        'featured_image'        => __( 'Онцлох зураг', 'aceedu' ),
        'set_featured_image'    => __( 'Онцлох зураг тохируулах', 'aceedu' ),
        'remove_featured_image' => __( 'Онцлох зургийг устгах', 'aceedu' ),
        'use_featured_image'    => __( 'Онцлох зургаар ашиглах', 'aceedu' ),
        'insert_into_item'      => __( 'Сургуульд оруулах', 'aceedu' ),
        'uploaded_to_this_item' => __( 'Энэ сургуульд хуулагдсан', 'aceedu' ),
        'items_list'            => __( 'Сургуулиудын жагсаалт', 'aceedu' ),
        'items_list_navigation' => __( 'Сургуулиудын жагсаалтын навигаци', 'aceedu' ),
        'filter_items_list'     => __( 'Жагсаалтыг шүүх', 'aceedu' ),
    );
    $args = array(
        'label'                 => __( 'Сургууль', 'aceedu' ),
        'description'           => __( 'Солонгосын их дээд сургуулиудын мэдээлэл', 'aceedu' ),
        'labels'                => $labels,
        'supports'              => array( 'title', 'editor', 'thumbnail', 'excerpt', 'revisions' ),
        'taxonomies'            => array( 'school_location', 'guarantor_requirement', 'school_type' ),
        'hierarchical'          => false,
        'public'                => true,
        'show_ui'               => true,
        'show_in_menu'          => true,
        'menu_position'         => 5,
        'menu_icon'             => 'dashicons-university',
        'show_in_admin_bar'     => true,
        'show_in_nav_menus'     => true,
        'can_export'            => true,
        'has_archive'           => 'schools',
        'exclude_from_search'   => false,
        'publicly_queryable'    => true,
        'capability_type'       => 'post',
        'show_in_rest'          => false,
        'rewrite'               => array( 'slug' => 'schools' ),
    );
    register_post_type( 'school', $args );
}
add_action( 'init', 'ub_register_school_post_type', 0 );

// Taxonomies
function ub_register_school_taxonomies() {
    // Location
    register_taxonomy( 'school_location', array( 'school' ), array(
        'labels'                => array(
            'name'              => __( 'Байршил', 'aceedu' ),
            'singular_name'     => __( 'Байршил', 'aceedu' ),
            'search_items'      => __( 'Байршил хайх', 'aceedu' ),
            'all_items'         => __( 'Бүх байршил', 'aceedu' ),
            'edit_item'         => __( 'Байршил засах', 'aceedu' ),
            'update_item'       => __( 'Байршил шинэчлэх', 'aceedu' ),
            'add_new_item'      => __( 'Шинэ байршил нэмэх', 'aceedu' ),
            'new_item_name'     => __( 'Шинэ байршлын нэр', 'aceedu' ),
            'menu_name'         => __( 'Байршил', 'aceedu' ),
        ),
        'hierarchical'          => true,
        'show_ui'               => true,
        'show_admin_column'     => true,
        'query_var'             => true,
        'show_in_rest'          => true,
        'rewrite'               => array( 'slug' => 'school-location' ),
    ) );

    // Guarantor Requirement
    register_taxonomy( 'guarantor_requirement', array( 'school' ), array(
        'labels'                => array(
            'name'              => __( 'Батлан даагч', 'aceedu' ),
            'singular_name'     => __( 'Батлан даагч', 'aceedu' ),
            'search_items'      => __( 'Хайх', 'aceedu' ),
            'all_items'         => __( 'Бүх төрөл', 'aceedu' ),
            'add_new_item'      => __( 'Шинэ төрөл нэмэх', 'aceedu' ),
            'menu_name'         => __( 'Батлан даагч', 'aceedu' ),
        ),
        'hierarchical'          => true,
        'show_ui'               => true,
        'show_admin_column'     => true,
        'show_in_rest'          => true,
        'rewrite'               => array( 'slug' => 'guarantor' ),
    ) );

    // School Type
    register_taxonomy( 'school_type', array( 'school' ), array(
        'labels'                => array(
            'name'              => __( 'Сургуулийн төрөл', 'aceedu' ),
            'singular_name'     => __( 'Сургуулийн төрөл', 'aceedu' ),
            'menu_name'         => __( 'Сургуулийн төрөл', 'aceedu' ),
        ),
        'hierarchical'          => true,
        'show_ui'               => true,
        'show_admin_column'     => true,
        'show_in_rest'          => true,
        'rewrite'               => array( 'slug' => 'school-type' ),
    ) );
}
add_action( 'init', 'ub_register_school_taxonomies', 0 );

/**
 * Handle filtering for the School archive.
 *
 * @param WP_Query $query The current WordPress query.
 */
function ub_filter_schools_archive( $query ) {
	if ( ! is_admin() && $query->is_main_query() && ( is_post_type_archive( 'school' ) || is_tax( array( 'school_location', 'guarantor_requirement' ) ) ) ) {

		$tax_query = array( 'relation' => 'AND' );

		// Location Filter
		if ( ! empty( $_GET['location'] ) ) { // phpcs:ignore WordPress.Security.NonceVerification.Recommended
			$tax_query[] = array(
				'taxonomy' => 'school_location',
				'field'    => 'slug',
				'terms'    => sanitize_text_field( wp_unslash( $_GET['location'] ) ), // phpcs:ignore WordPress.Security.NonceVerification.Recommended
			);
		}

		// Guarantor Filter
		if ( ! empty( $_GET['guarantor'] ) ) { // phpcs:ignore WordPress.Security.NonceVerification.Recommended
			$tax_query[] = array(
				'taxonomy' => 'guarantor_requirement',
				'field'    => 'slug',
				'terms'    => sanitize_text_field( wp_unslash( $_GET['guarantor'] ) ), // phpcs:ignore WordPress.Security.NonceVerification.Recommended
			);
		}

		if ( count( $tax_query ) > 1 ) {
			$query->set( 'tax_query', $tax_query );
		}

		// Search Filter
		if ( ! empty( $_GET['s_school'] ) ) { // phpcs:ignore WordPress.Security.NonceVerification.Recommended
			$query->set( 's', sanitize_text_field( wp_unslash( $_GET['s_school'] ) ) ); // phpcs:ignore WordPress.Security.NonceVerification.Recommended
		}
	}
}
add_action( 'pre_get_posts', 'ub_filter_schools_archive' );
