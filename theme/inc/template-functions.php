<?php
/**
 * WordPress-ийн стандарт функцүүдийг сайжруулах болон theme-д зориулсан
 * нэмэлт функцүүдийг агуулсан файл.
 *
 * @package aceedu
 */

/**
 * UB (ACE) theme-ийн үндсэн тодорхойлолтууд
 */
if ( ! defined( 'UB_VERSION' ) ) {
	$theme_info = wp_get_theme();
	define( 'UB_VERSION', $theme_info->get( 'Version' ) );
}

if ( ! defined( 'UB_TYPOGRAPHY_CLASSES' ) ) {
	define(
		'UB_TYPOGRAPHY_CLASSES',
		'singular-content'
	);
}

/**
 * Ганц пост, хуудас эсвэл хавсралт (attachment) ачаалах үед
 * Pingback URL-ийг автоматаар илрүүлэх header нэмэх.
 */
function ub_pingback_header() {
	if ( is_singular() && pings_open() ) {
		printf( '<link rel="pingback" href="%s">', esc_url( get_bloginfo( 'pingback_url' ) ) );
	}
}
add_action( 'wp_head', 'ub_pingback_header' );

/**
 * Сэтгэгдэл бичих формын үндсэн талбаруудын тохиргоог өөрчлөх.
 *
 * @param array $defaults Сэтгэгдлийн формын анхны аргументууд.
 * @return array Шинэчилсэн талбаруудын жагсаалт.
 */
function ub_comment_form_defaults( $defaults ) {
	$comment_field = $defaults['comment_field'];

	// Adjust height of comment form.
	$defaults['comment_field'] = preg_replace( '/rows="\d+"/', 'rows="5"', $comment_field );

	return $defaults;
}
add_filter( 'comment_form_defaults', 'ub_comment_form_defaults' );

/**
 * Архивын хуудасны гарчгийг (Category, Tag, Author гэх мэт) засаж харуулах.
 */
function ub_get_the_archive_title() {
	if ( is_category() ) {
		$title = '<span>' . single_term_title( '', false ) . '</span>';
	} elseif ( is_tag() ) {
		$title = '<span>' . single_term_title( '', false ) . '</span>';
	} elseif ( is_author() ) {
		$title = '<span>' . get_the_author_meta( 'display_name' ) . '</span>';
	} elseif ( is_year() ) {
		$title = '<span>' . get_the_date( _x( 'Y', 'yearly archives date format', 'aceedu' ) ) . '</span>';
	} elseif ( is_month() ) {
		$title = '<span>' . get_the_date( _x( 'F Y', 'monthly archives date format', 'aceedu' ) ) . '</span>';
	} elseif ( is_day() ) {
		$title = '<span>' . get_the_date() . '</span>';
	} elseif ( is_post_type_archive() ) {
		$cpt   = get_post_type_object( get_queried_object()->name );
		$title = '<span>' . $cpt->labels->singular_name . '</span>';
	} elseif ( is_tax() ) {
		$tax   = get_taxonomy( get_queried_object()->taxonomy );
		$title = '<span>' . single_term_title( '', false ) . '</span>';
	} else {
		$title = '<span>' . __( 'Archives', 'aceedu' ) . '</span>';
	}
	return $title;
}
add_filter( 'get_the_archive_title', 'ub_get_the_archive_title' );

/**
 * "Үргэлжлүүлэн унших" (Continue Reading) холбоосыг үүсгэх.
 *
 * @param string $more_string Холбоос дотор харагдах текст.
 */
function ub_continue_reading_link( $more_string ) {

	if ( ! is_admin() ) {
		$continue_reading = sprintf(
			/* translators: %s: Name of current post. */
			wp_kses( __( 'Continue reading %s', 'aceedu' ), array( 'span' => array( 'class' => array() ) ) ),
			the_title( '<span class="sr-only">"', '"</span>', false )
		);

		$more_string = '<a href="' . esc_url( get_permalink() ) . '">' . $continue_reading . '</a>';
	}

	return $more_string;
}

// Filter the excerpt more link.
add_filter( 'excerpt_more', 'ub_continue_reading_link' );

// Filter the content more link.
add_filter( 'the_content_more_link', 'ub_continue_reading_link' );

/**
 *  Typography-ийн классуудыг нэмэх.
 *
 * @param mixed $html Логоны HTML код.
 * @return array|string Шинэчилсэн HTML код.
 */
function ub_custom_logo_class( $html ) {
	// 'custom-logo-link' гэсэн текстийг олоод хажууд нь 'your-custom-class' нэмнэ
	$html = str_replace( 'custom-logo-link', 'block [&_img]:w-full [&_img]:max-w-[3.5rem] [&_img]:h-auto', $html );
	return $html;
}
add_filter( 'get_custom_logo', 'ub_custom_logo_class' );

/**
 * <body> элементэд нэмэлт CSS классуудыг нэмэх функц.
 *
 * Энэ функц нь WordPress-ийн 'body_class' шүүлтүүрийг (filter) ашиглан
 * вэб сайтын хуудас бүрийн онцлогоос хамаарч (жишээ нь: нүүр хуудас,
 * ганц болон олон пост харагдах үед) <body> таг дээр тусгай классуудыг
 * автоматаар нэмж өгдөг. Энэ нь CSS загварчлалыг илүү уян хатан болгоно.
 *
 * @param array $classes Одоо байгаа body классуудын жагсаалт.
 * @return array Шинэчилсэн классуудын жагсаалт.
 */
function ub_body_classes( $classes ) {
	// Энд нэмэлт нөхцөлт классуудыг нэмж болно.
	$classes[] = '';
	return $classes;
}
add_filter( 'body_class', 'ub_body_classes' );

/**
 * Цэсний элементүүдэд (<li>) нэмэлт CSS классуудыг нэмэх функц.
 *
 * Энэ функц нь WordPress-ийн 'nav_menu_css_class' шүүлтүүрийг ашиглан
 * вэб сайтын цэсний элемент бүр дээр Tailwind CSS эсвэл өөр бусад
 * тусгай классуудыг нэмж өгөх боломжийг олгоно.
 *
 * @param array     $classes Одоо байгаа цэсний элементийн классууд.
 * @param \WP_Post  $item    Цэсний элементийн объект.
 * @param \stdClass $args    wp_nav_menu() функцын аргументууд.
 * @return array Шинэчилсэн классуудын жагсаалт.
 */
function ub_nav_menu_classes( $classes, $item, $args ) {
	// Хэрэв тодорхой нэг цэсэнд (theme_location) класс нэмэх бол энд шалгаж болно.
	if ( 'menu-1' === $args->theme_location ) {
		$classes[] = 'group [&_a]:text-primary [&_a]:block [&_a]:font-bold [&_a]:transition-colors [&_a]:duration-300 [&_a]:ease-in-out [&_a]:hover:text-secondary [&_a]:group-[.current-menu-item]:text-secondary [&_a]:text-xs [&_a]:uppercase';

		// If it's a sub-menu item.
		if ( in_array( 'sub-menu-item', $classes, true ) || $item->menu_item_parent > 0 ) {
			$classes[] = '[&_a]:px-6 [&_a]:py-2 [&_a]:normal-case [&_a]:font-medium [&_a]:text-slate-600 [&_a]:hover:bg-slate-50';
		}
	}

	if ( 'menu-2' === $args->theme_location || 'menu-3' === $args->theme_location ) {
		$classes[] = 'block [&_a]:hover:text-white [&_a]:transition-colors [&_a]:font-semibold [&_a]:text-[0.6875rem]';
	}

	return $classes;
}
add_filter( 'nav_menu_css_class', 'ub_nav_menu_classes', 10, 3 );
/**
 * Дэд цэсний (sub-menu) <ul> элемент дээр нэмэлт CSS классуудыг нэмэх функц.
 *
 * @param array    $classes Одоо байгаа дэд цэсний классууд.
 * @param stdClass $args    wp_nav_menu() функцын аргументууд.
 * @return array Шинэчилсэн классуудын жагсаалт.
 */
function ub_nav_menu_submenu_classes( $classes, $args ) {
	if ( 'menu-1' === $args->theme_location ) {
		$classes[] = 'absolute left-0 top-full hidden w-full group-hover:block bg-slate-50 min-w-[200px] rounded-xs py-4 animate-in fade-in slide-in-from-top-1 duration-200 z-50';
	}
	return $classes;
}
add_filter( 'nav_menu_submenu_css_class', 'ub_nav_menu_submenu_classes', 10, 2 );

/**
 * Цэсний тайлбарыг (description) дэд цэсний элементүүд дээр харуулах функц.
 *
 * @param string    $item_output Цэсний элементийн HTML код.
 * @param WP_Post   $item        Цэсний элементийн объект.
 * @param int       $depth       Цэсний түвшин.
 * @param \stdClass $args        wp_nav_menu() функцын аргументууд.
 * @return string Шинэчилсэн HTML код.
 */
function ub_nav_menu_description( $item_output, $item, $depth, $args ) {
	if ( 'menu-1' === $args->theme_location && $depth > 0 && ! empty( $item->description ) ) {
		$item_output = str_replace(
			'</a>',
			'<span class="block text-[0.625rem] text-slate-400 font-normal normal-case mt-0.5 leading-tight">' . esc_html( $item->description ) . '</span></a>',
			$item_output
		);
	}
	return $item_output;
}
add_filter( 'walker_nav_menu_start_el', 'ub_nav_menu_description', 10, 4 );


/**
 * Сэтгэгдэл, Визжет, болон Site Editor-ийг зөвхөн Production (Debug хаалттай) үед хаах.
 *
 * Хэрэв WP_DEBUG идэвхтэй байвал хөгжүүлэгчид бүх функцүүд нээлттэй харагдах бөгөөд
 * харин Live сайт дээр (WP_DEBUG = false) хэрэгцээгүй цэсүүдийг нууж сайтыг цэгцэлнэ.
 */
function ub_disable_unused_features() {
	// Хэрэв Debug mode идэвхтэй байвал эдгээр хязгаарлалтуудыг хийхгүй.
	if ( defined( 'WP_DEBUG' ) && WP_DEBUG ) {
		return;
	}

	// Сэтгэгдэл хаах.
	add_filter( 'comments_open', '__return_false', 20, 2 );
	add_filter( 'pings_open', '__return_false', 20, 2 );

	add_action(
		'admin_menu',
		function () {
			// Comments цэс хасах.
			remove_menu_page( 'edit-comments.php' );

			// Site Editor (Gutenberg FSE) цэсийг хасах.
			remove_submenu_page( 'themes.php', 'site-editor.php?path=/edit' );
		},
		999
	);

	// Пост төрлүүдээс сэтгэгдлийн дэмжлэгийг хасах.
	add_action(
		'init',
		function () {
			remove_post_type_support( 'post', 'comments' );
			remove_post_type_support( 'page', 'comments' );
		},
		100
	);

	// Author archive (зохиогчийн хуудас) хаах.
	add_action(
		'template_redirect',
		function () {
			if ( is_author() ) {
				wp_safe_redirect( home_url(), 301 );
				exit;
			}
		}
	);
}
ub_disable_unused_features();

/**
 * Author archive (зохиогчийн хуудас)-ыг хайлтын системээс нуух.
 */
add_filter(
	'wp_robots',
	function ( $robots ) {
		if ( is_author() ) {
			return wp_robots_no_robots( $robots );
		}
		return $robots;
	}
);

/**
 * Вэб сайтын гадна талд (Front-end) ашиглагдах CSS болон JS файлуудыг дуудах.
 *
 * Энэ функцээр дамжуулан Google Fonts, үндсэн style.css болон
 * бусад JavaScript файлуудыг зөв дарааллаар нь вэб сайт руу оруулдаг.
 */
/**
 * Register global assets that may be or used as dependencies by blocks.
 * Registered here on 'init' so handles are available to block.json and backend.
 */
function ub_register_assets() {
	// Swiper Assets
	wp_register_style( 'swiper', get_template_directory_uri() . '/assets/css/swiper-bundle.min.css', array(), '11.0.0' );
	wp_register_script( 'swiper', get_template_directory_uri() . '/assets/js/swiper-bundle.min.js', array(), '11.0.0', true );

	// Block Scripts with Swiper dependency
	wp_register_script( 'hero-js', get_template_directory_uri() . '/blocks/hero/hero.js', array( 'swiper' ), UB_VERSION, true );
	wp_register_script( 'testimonials-js', get_template_directory_uri() . '/blocks/testimonials/testimonials.js', array( 'swiper' ), UB_VERSION, true );
	wp_register_script( 'trust-signals-js', get_template_directory_uri() . '/blocks/trust-signals/trust-signals.js', array( 'swiper' ), UB_VERSION, true );
	wp_register_script( 'core-pathways-js', get_template_directory_uri() . '/blocks/core-pathways/core-pathways.js', array( 'swiper' ), UB_VERSION, true );
	wp_register_script( 'value-prop-js', get_template_directory_uri() . '/blocks/value-prop/value-prop.js', array( 'swiper' ), UB_VERSION, true );
	wp_register_script( 'mvv-js', get_template_directory_uri() . '/blocks/mission-vision-values/mission-vision-values.js', array( 'swiper' ), UB_VERSION, true );
	wp_register_script( 'carousel-blocks-js', get_template_directory_uri() . '/blocks/schools-carousel/carousel-blocks.js', array( 'swiper' ), UB_VERSION, true );

	// Block Styles with Swiper dependency
	wp_register_style( 'hero-css', get_template_directory_uri() . '/blocks/hero/hero.css', array( 'swiper' ), UB_VERSION );
}
add_action( 'init', 'ub_register_assets', 5 );

function ub_scripts() {
	wp_enqueue_style( 'ace-style', get_stylesheet_uri(), array(), UB_VERSION );
	wp_enqueue_script( 'ace-script', get_template_directory_uri() . '/js/script.min.js', array(), UB_VERSION, true );

	// Register Modular Component Scripts
	wp_register_script( 
		'related-posts-script', 
		get_template_directory_uri() . '/assets/js/related-posts.js', 
		array( 'swiper' ), 
		UB_VERSION, 
		true 
	);

	// Conditionally Enqueue Related Posts Carousel assets
	if ( is_singular( array( 'post', 'school' ) ) ) {
		wp_enqueue_style( 'swiper' );
		wp_enqueue_script( 'related-posts-script' );
	}
}
add_action( 'wp_enqueue_scripts', 'ub_scripts' );

/**
 * Gutenberg (Block Editor) редактор дээр ашиглагдах файл болон стилийг дуудах.
 *
 * Редактор дээр вэб сайтын гадна талтай ижилхэн харагдуулахын тулд
 * фонт болон Tailwind-ийн тусгай тохиргоог энд оруулж өгдөг.
 */
function ub_enqueue_block_editor_script() {
	$current_screen = function_exists( 'get_current_screen' ) ? get_current_screen() : null;

	if (
		$current_screen &&
		$current_screen->is_block_editor() &&
		'widgets' !== $current_screen->id
	) {
		// Enqueue block editor script.
		wp_enqueue_script(
			'ace-editor',
			get_template_directory_uri() . '/js/block-editor.min.js',
			array( 'wp-blocks', 'wp-edit-post' ),
			UB_VERSION,
			true
		);
		// Enqueue Swiper assets for block editor preview.
		wp_enqueue_style( 'swiper', get_template_directory_uri() . '/assets/css/swiper-bundle.min.css', array(), '11.0.0' );
		wp_enqueue_script( 'swiper', get_template_directory_uri() . '/assets/js/swiper-bundle.min.js', array(), '11.0.0', true );

		// Swiper assets are enqueued; block-level assets will handle necessary initializations.
	}

	// Block editor font-face injection (admin context).
	if ( is_admin() ) {
		$ub_font_uri = get_template_directory_uri() . '/fonts';
		$ub_font_css = "
			@font-face {
				font-family: 'Google Sans';
				src: url('{$ub_font_uri}/GoogleSans-Regular.woff2') format('woff2'),
					 url('{$ub_font_uri}/GoogleSans-Regular.woff') format('woff');
				font-weight: 400;
				font-style: normal;
				font-display: swap;
			}
			@font-face {
				font-family: 'Google Sans';
				src: url('{$ub_font_uri}/GoogleSans-Medium.woff2') format('woff2'),
					 url('{$ub_font_uri}/GoogleSans-Medium.woff') format('woff');
				font-weight: 500;
				font-style: normal;
				font-display: swap;
			}
			@font-face {
				font-family: 'Google Sans';
				src: url('{$ub_font_uri}/GoogleSans-SemiBold.woff2') format('woff2'),
					 url('{$ub_font_uri}/GoogleSans-SemiBold.woff') format('woff');
				font-weight: 600;
				font-style: normal;
				font-display: swap;
			}
			@font-face {
				font-family: 'Google Sans';
				src: url('{$ub_font_uri}/GoogleSans-Bold.woff2') format('woff2'),
					 url('{$ub_font_uri}/GoogleSans-Bold.woff') format('woff');
				font-weight: 700;
				font-style: normal;
				font-display: swap;
			}
			body, .editor-styles-wrapper {
				font-family: 'Google Sans', ui-sans-serif, system-ui, sans-serif;
			}
		";
		wp_register_style( 'ace-editor-fonts', false, array(), UB_VERSION );
		wp_enqueue_style( 'ace-editor-fonts' );
		wp_add_inline_style( 'ace-editor-fonts', $ub_font_css );
	}
}
add_action( 'enqueue_block_assets', 'ub_enqueue_block_editor_script' );


/**
 * TinyMCE (Classic Editor) редактор дээр Tailwind Typography-ийн классуудыг нэмэх.
 *
 * @param array $settings TinyMCE-ийн тохиргоонууд.
 * @return array Шинэчилсэн тохиргоо.
 */
function ub_tinymce_add_class( $settings ) {
	$settings['body_class'] = UB_TYPOGRAPHY_CLASSES;
	return $settings;
}
add_filter( 'tiny_mce_before_init', 'ub_tinymce_add_class' );

/**
 * Гарчгийн (Heading) түвшингүүдийг Tailwind Typography-д нийцүүлэн хязгаарлах.
 *
 * Редактор дээр H1-ийг зөвхөн нэг байлгах, H5/H6-г дизайнд тохируулан
 * хасах зорилгоор Default сонголтыг H2, H3, H4 болгож өөрчилнө.
 *
 * @param array  $args Блок бүртгэх үеийн аргументууд.
 * @param string $block_type Блокны нэр (core/heading гэх мэт).
 * @return array Шинэчилсэн аргументууд.
 */
function ub_modify_heading_levels( $args, $block_type ) {
	if ( 'core/heading' !== $block_type ) {
		return $args;
	}

	// Remove <h1>, <h5> and <h6>.
	$args['attributes']['levelOptions']['default'] = array( 2, 3, 4 );

	return $args;
}
add_filter( 'register_block_type_args', 'ub_modify_heading_levels', 10, 2 );

/**
 * ACF блокын жишээ өгөгдлийг block.json-оос унших функц.
 *
 * @param array $block Блокны объект.
 * @return array Жишээ өгөгдөл.
 */
function ub_get_block_example_data( $block ) {
	$example_data = array();
	$block_slug   = str_replace( 'acf/', '', $block['name'] );
	$json_path    = get_template_directory() . '/blocks/' . $block_slug . '/block.json';

	if ( file_exists( $json_path ) ) {
		$json_content = file_get_contents( $json_path );
		$json_data    = json_decode( $json_content, true );

		if ( ! empty( $json_data['example']['attributes']['data'] ) ) {
			$example_data = $json_data['example']['attributes']['data'];
		}
	}

	return $example_data;
}
