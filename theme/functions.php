<?php
/**
 * UB (ACE) theme-ийн үндсэн функцүүд болон тодорхойлолтууд
 *
 * Энэхүү файл нь вэб сайтын суурь тохиргоо, файл дуудах, болон бусад нэмэлт
 * функцүүдийг агуулдаг. Энэ файлд зөвхөн бусад файлуудыг import хийх хэрэгтэй.
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package aceedu
 */

if ( ! function_exists( 'ub_setup' ) ) :
	/**
	 * Theme-ийн анхны тохиргоо болон WordPress-ийн функцүүдийг идэвхжүүлэх.
	 *
	 * Энэ функц нь 'after_setup_theme' hook-той холбогдож ажиллах бөгөөд
	 * вэб сайт ачаалж эхлэх үед зурагны хэмжээ, цэсний байршил,
	 * theme-ийн дэмжлэгүүдийг (thumbnails гэх мэт) бүртгэдэг.
	 */
	function ub_setup() {
		/**
		 * Make theme available for translation.
		 * Translations can be filed in the /languages/ directory.
		 */
		load_theme_textdomain( 'aceedu', get_template_directory() . '/languages' );

		// Add default posts and comments RSS feed links to head.
		add_theme_support( 'automatic-feed-links' );

		/*
		 * Let WordPress manage the document title.
		 * By adding theme support, we declare that this theme does not use a
		 * hard-coded <title> tag in the document head, and expect WordPress to
		 * provide it for us.
		 */
		add_theme_support( 'title-tag' );

		/*
		 * Enable support for Post Thumbnails on posts and pages.
		 *
		 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
		 */
		add_theme_support( 'post-thumbnails' );

		// Enable excerpts for pages.
		add_post_type_support( 'page', 'excerpt' );

		// This theme uses wp_nav_menu() in two locations.
		register_nav_menus(
			array(
				'menu-1' => __( 'Үндсэн цэс', 'aceedu' ),
				'menu-2' => __( 'Компани', 'aceedu' ),
				'menu-3' => __( 'Үйлчилгээ', 'aceedu' ),
			)
		);

		/*
		 * Switch default core markup for search form, comment form, and comments
		 * to output valid HTML5.
		 */
		add_theme_support(
			'html5',
			array(
				'search-form',
				'comment-form',
				'comment-list',
				'gallery',
				'caption',
				'style',
				'script',
			)
		);

		/**
		 * Add support for core custom logo.
		 *
		 * @link https://codex.wordpress.org/Theme_Logo
		 */
		add_theme_support(
			'custom-logo',
			array(
				'height'      => 100,
				'width'       => 400,
				'flex-width'  => true,
				'flex-height' => true,
			)
		);

		// Add support for editor styles.
		add_theme_support( 'editor-styles' );

		// Enqueue editor styles.
		add_editor_style( 'style-editor.css' );

		// Add support for responsive embedded content.
		add_theme_support( 'responsive-embeds' );

		// Remove support for block templates.
		remove_theme_support( 'block-templates' );
	}
endif;
add_action( 'after_setup_theme', 'ub_setup' );

/**
 * Functions which enhance the theme by hooking into WordPress.
 * Constants and core theme setup functions are defined here.
 */
require get_template_directory() . '/inc/template-functions.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Custom post types and taxonomies.
 */
require get_template_directory() . '/inc/post-types.php';

/**
 * Custom blocks registration.
 */
require get_template_directory() . '/inc/acf-blocks.php';

/**
 * ACF JSON synchronization.
 */
require get_template_directory() . '/inc/acf-json.php';

/**
 * Editor settings and block filtering.
 */
require get_template_directory() . '/inc/editor-settings.php';

/**
 * TutorLMS Integration.
 */
require get_template_directory() . '/inc/tutorlms.php';
