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
		'prose prose-neutral max-w-none prose-a:text-primary'
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
		$title = __( 'Category Archives: ', 'aceedu' ) . '<span>' . single_term_title( '', false ) . '</span>';
	} elseif ( is_tag() ) {
		$title = __( 'Tag Archives: ', 'aceedu' ) . '<span>' . single_term_title( '', false ) . '</span>';
	} elseif ( is_author() ) {
		$title = __( 'Author Archives: ', 'aceedu' ) . '<span>' . get_the_author_meta( 'display_name' ) . '</span>';
	} elseif ( is_year() ) {
		$title = __( 'Yearly Archives: ', 'aceedu' ) . '<span>' . get_the_date( _x( 'Y', 'yearly archives date format', 'aceedu' ) ) . '</span>';
	} elseif ( is_month() ) {
		$title = __( 'Monthly Archives: ', 'aceedu' ) . '<span>' . get_the_date( _x( 'F Y', 'monthly archives date format', 'aceedu' ) ) . '</span>';
	} elseif ( is_day() ) {
		$title = __( 'Daily Archives: ', 'aceedu' ) . '<span>' . get_the_date() . '</span>';
	} elseif ( is_post_type_archive() ) {
		$cpt   = get_post_type_object( get_queried_object()->name );
		$title = sprintf(
			/* translators: %s: Post type singular name */
			esc_html__( '%s Archives', 'aceedu' ),
			$cpt->labels->singular_name
		);
	} elseif ( is_tax() ) {
		$tax   = get_taxonomy( get_queried_object()->taxonomy );
		$title = sprintf(
			/* translators: %s: Taxonomy singular name */
			esc_html__( '%s Archives', 'aceedu' ),
			$tax->labels->singular_name
		);
	} else {
		$title = __( 'Archives:', 'aceedu' );
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
	$html = str_replace( 'custom-logo-link', 'block [&_img]:w-full [&_img]:max-w-[4rem] [&_img]:h-auto', $html );
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
	$classes[] = 'font-sans bg-white';
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
 * @param array   $classes Одоо байгаа цэсний элементийн классууд.
 * @param WP_Post $item    Цэсний элементийн объект.
 * @param array   $args    wp_nav_menu() функцын аргументууд.
 * @return array Шинэчилсэн классуудын жагсаалт.
 */
function ub_nav_menu_classes( $classes, $item, $args ) {
	// Хэрэв тодорхой нэг цэсэнд (theme_location) класс нэмэх бол энд шалгаж болно.
	if ( 'menu-1' === $args->theme_location ) {
		$classes[] = 'group [&_a]:text-slate-700 [&_a]:font-bold [&_a]:transition-colors [&_a]:duration-300 [&_a]:ease-in-out [&_a]:hover:text-primary [&_a]:group-[.current-menu-item]:text-primary [&_a]:text-xs [&_a]:uppercase';
	}

	return $classes;
}
add_filter( 'nav_menu_css_class', 'ub_nav_menu_classes', 10, 3 );


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
}
ub_disable_unused_features();

/**
 * Вэб сайтын гадна талд (Front-end) ашиглагдах CSS болон JS файлуудыг дуудах.
 *
 * Энэ функцээр дамжуулан Google Fonts, үндсэн style.css болон
 * бусад JavaScript файлуудыг зөв дарааллаар нь вэб сайт руу оруулдаг.
 */
function ub_scripts() {
	wp_enqueue_style( 'ace-style', get_stylesheet_uri(), array(), UB_VERSION );
	wp_enqueue_script( 'ace-script', get_template_directory_uri() . '/js/script.min.js', array(), UB_VERSION, true );
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
		wp_enqueue_script(
			'ace-editor',
			get_template_directory_uri() . '/js/block-editor.min.js',
			array(
				'wp-blocks',
				'wp-edit-post',
			),
			UB_VERSION,
			true
		);
		wp_add_inline_script( 'ace-editor', "tailwindTypographyClasses = '" . esc_attr( UB_TYPOGRAPHY_CLASSES ) . "'.split(' ');", 'before' );
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
