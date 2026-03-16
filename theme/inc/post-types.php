<?php
/**
 * ACE EDU WORLD төсөлд зориулсан тусгай контентын төрлүүд (CPT) болон 
 * ангилал (Taxonomies)-ийг бүртгэх файл.
 */

/**
 * Сургууль, Үйлчилгээ, Амжилтын түүх зэрэг тусгай пост төрлүүдийг бүртгэх функц.
 * 
 * Энэ функц нь WordPress-ийн стандарт 'post' болон 'page'-ээс гадна 
 * вэб сайтад шаардлагатай байгаа бүх төрлийн контентуудыг админ хэсэгт 
 * тусад нь цэс болгон оруулж ирдэг.
 */
function aceedu_register_post_types() {

	// Schools (Сургуулиуд)
	register_post_type( 'school', array(
		'labels' => array(
			'name' => __( 'Сургуулиуд', 'aceedu' ),
			'singular_name' => __( 'Сургууль', 'aceedu' ),
		),
		'public' => true,
		'has_archive' => true,
		'rewrite' => array( 'slug' => 'schools' ),
		'menu_icon' => 'dashicons-university',
		'supports' => array( 'title', 'editor', 'thumbnail', 'excerpt' ),
		'show_in_rest' => true,
	) );

	// Services (Үйлчилгээ)
	register_post_type( 'service', array(
		'labels' => array(
			'name' => __( 'Үйлчилгээ', 'aceedu' ),
			'singular_name' => __( 'Үйлчилгээ', 'aceedu' ),
		),
		'public' => true,
		'has_archive' => true,
		'rewrite' => array( 'slug' => 'services' ),
		'menu_icon' => 'dashicons-rest-api',
		'supports' => array( 'title', 'editor', 'thumbnail', 'excerpt' ),
		'show_in_rest' => true,
	) );

	// Success Stories (Амжилтын түүх)
	register_post_type( 'success_story', array(
		'labels' => array(
			'name' => __( 'Амжилтын түүх', 'aceedu' ),
			'singular_name' => __( 'Амжилтын түүх', 'aceedu' ),
		),
		'public' => true,
		'has_archive' => true,
		'rewrite' => array( 'slug' => 'stories' ),
		'menu_icon' => 'dashicons-awards',
		'supports' => array( 'title', 'editor', 'thumbnail', 'excerpt' ),
		'show_in_rest' => true,
	) );

	// Events (Event / Webinar)
	register_post_type( 'event', array(
		'labels' => array(
			'name' => __( 'Хэмжээ/Вебинар', 'aceedu' ),
			'singular_name' => __( 'Хэмжээ', 'aceedu' ),
		),
		'public' => true,
		'has_archive' => true,
		'rewrite' => array( 'slug' => 'events' ),
		'menu_icon' => 'dashicons-calendar-alt',
		'supports' => array( 'title', 'editor', 'thumbnail', 'excerpt' ),
		'show_in_rest' => true,
	) );

	// FAQ (Асуулт хариулт)
	register_post_type( 'faq', array(
		'labels' => array(
			'name' => __( 'FAQ', 'aceedu' ),
			'singular_name' => __( 'FAQ', 'aceedu' ),
		),
		'public' => true,
		'has_archive' => false,
		'menu_icon' => 'dashicons-editor-help',
		'supports' => array( 'title', 'editor' ),
		'show_in_rest' => true,
	) );
}
add_action( 'init', 'aceedu_register_post_types' );

/**
 * Пост төрлүүдэд зориулсан ангилал, шүүлтүүрүүдийг (Taxonomies) бүртгэх функц.
 * 
 * Жишээ нь: Сургуулиудыг хотоор нь эсвэл сургалтын түвшингөөр нь 
 * ангилах боломжийг энд тодорхойлдог.
 */
function aceedu_register_taxonomies() {

	// City (Хот)
	register_taxonomy( 'city', array( 'school' ), array(
		'labels' => array(
			'name' => __( 'Хотууд', 'aceedu' ),
			'singular_name' => __( 'Хот', 'aceedu' ),
		),
		'hierarchical' => true,
		'show_in_rest' => true,
	) );

	// Study Level (Түвшин)
	register_taxonomy( 'study_level', array( 'school', 'service', 'success_story' ), array(
		'labels' => array(
			'name' => __( 'Түвшинүүд', 'aceedu' ),
			'singular_name' => __( 'Түвшин', 'aceedu' ),
		),
		'hierarchical' => true,
		'show_in_rest' => true,
	) );

	// FAQ Category
	register_taxonomy( 'faq_category', array( 'faq' ), array(
		'labels' => array(
			'name' => __( 'FAQ Ангилал', 'aceedu' ),
			'singular_name' => __( 'FAQ Ангилал', 'aceedu' ),
		),
		'hierarchical' => true,
		'show_in_rest' => true,
	) );
}
add_action( 'init', 'aceedu_register_taxonomies' );
