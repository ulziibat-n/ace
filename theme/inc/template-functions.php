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
	$html = str_replace( 'custom-logo-link', 'block [&_img]:w-full [&_img]:max-w-[3.5rem] [&_img]:h-auto py-6', $html );
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
 * @param int       $depth   Цэсний түвшин (0 нь top-level).
 * @return array Шинэчилсэн классуудын жагсаалт.
 */
function ub_nav_menu_classes( $classes, $item, $args, $depth ) {
	$args           = (object) $args;
	$theme_location = $args->theme_location ?? '';

	// Хэрэв тодорхой нэг цэсэнд (theme_location) класс нэмэх бол энд шалгаж болно.
	if ( 'menu-1' === $theme_location ) {
		// Тухайн түвшнээр (depth) нэрлэсэн групп нэмэх.
		$classes[] = "group/level-{$depth}";

		// Зөвхөн top-level (Level 1) цэсний элементүүдэд классуудыг нэмэх.
		if ( 0 === (int) $depth ) {
			$classes[] = 'group/level-0 [&>a]:text-primary [&>a]:block [&>a]:font-bold [&>a]:transition-colors [&>a]:duration-300 xl:[&>a]:leading-[80px] [&>a]:px-2 [&>a]:ease-in-out [&>a]:hover:text-secondary [&>a]:group-hover/level-0:text-secondary [&>a]:group-[.current-menu-item]/level-0:text-secondary [&>a]:group-[.current-menu-parent]/level-0:text-secondary [&>a]:group-[.current-menu-ancestor]/level-0:text-secondary [&>a]:text-xs [&>a]:uppercase [&>a]:transition-colors';
		} elseif ( (int) $depth > 0 ) {
			// Дэд цэсний бүх li элементүүд (Level 2, 3 гэх мэт).
			$classes[] = '[&>a]:text-sm [&>a]:font-medium [&>a]:text-primary [&>a]:hover:text-secondary [&>a]:group-[.current-menu-item]/level-1:text-secondary [&>a]:group-[.current-menu-parent]/level-1:text-secondary [&>a]:group-[.current-menu-ancestor]/level-1:text-secondary [&>a]:transition-colors [&>a]:duration-300';
		}
	}

	return $classes;
}
add_filter( 'nav_menu_css_class', 'ub_nav_menu_classes', 10, 4 );

/**
 * Цэсний элемент бүрийн хүүхдийн тоог тоолж, child_count атрибут нэмэх.
 */
function ub_nav_menu_item_child_count( $items ) {
	$parents = array();
	foreach ( $items as $item ) {
		if ( $item->menu_item_parent && (int) $item->menu_item_parent > 0 ) {
			$parents[] = $item->menu_item_parent;
		}
	}

	$counts = array_count_values( $parents );

	foreach ( $items as $item ) {
		$item->child_count = isset( $counts[ $item->ID ] ) ? $counts[ $item->ID ] : 0;
	}

	return $items;
}
add_filter( 'wp_nav_menu_objects', 'ub_nav_menu_item_child_count' );

/**
 * Дэд цэсний (sub-menu) <ul> элемент дээр нэмэлт CSS классуудыг нэмэх функц.
 *
 * @param array    $classes Одоо байгаа дэд цэсний классууд.
 * @param stdClass $args    wp_nav_menu() функцын аргументууд.
 * @param int      $depth   Цэсний түвшин.
 * @return array Шинэчилсэн классуудын жагсаалт.
 */
function ub_nav_menu_submenu_classes( $classes, $args, $depth ) {
	$args           = (object) $args;
	$theme_location = $args->theme_location ?? '';

	if ( 'menu-1' === $theme_location ) {
		// Mobile specific submenu classes.
		if ( ! empty( $args->is_mobile ) ) {
			$classes[] = 'flex flex-col gap-0 pl-4 mt-4 border-l border-neutral-100';
			return $classes;
		}

		// Desktop styles (Level 2 items wrap).
		if ( 0 === $depth ) {
			$classes[] = 'w-full px-8 pb-8';

			// Дэд цэсний тооноос хамаарч загварыг тохируулах.
			if ( class_exists( 'UB_Mega_Menu_Walker' ) && UB_Mega_Menu_Walker::$last_child_count > 3 ) {
				$classes[] = 'lg:grid lg:grid-cols-2 lg:gap-x-12 max-w-3xl';
			} else {
				$classes[] = 'max-w-xs';
			}
		} elseif ( $depth > 0 ) {
			// Level 3+ дэд цэсүүдэд зориулсан сав (Level 3+ ul).
			$classes[] = 'sub-menu-level-3';
		}
	}
	return $classes;
}
add_filter( 'nav_menu_submenu_css_class', 'ub_nav_menu_submenu_classes', 10, 3 );

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
	$args           = (object) $args;
	$theme_location = $args->theme_location ?? '';

	if ( 'menu-1' === $theme_location && $depth > 0 && ! empty( $item->description ) ) {
		$item_output = str_replace(
			'</a>',
			'<span class="block mb-4 max-w-xs text-xs font-normal leading-tight normal-case text-slate-500 line-clamp-2">' . esc_html( $item->description ) . '</span></a>',
			$item_output
		);
	}
	return $item_output;
}
add_filter( 'walker_nav_menu_start_el', 'ub_nav_menu_description', 10, 4 );

/**
 * ACE Mega Menu Walker.
 * Сүб-меню болон түүний гарчгийг нэг контейнерт (div) багцалж харуулна.
 */
class UB_Mega_Menu_Walker extends Walker_Nav_Menu {
	private $current_parent_title = '';
	private $current_parent_url   = '';
	private $has_banner           = false;
	private $banner_data          = array();

	/**
	 * Сүүлийн боловсруулсан эцэг элементийн хүүхдийн тоо.
	 *
	 * @var int
	 */
	public static $last_child_count = 0;

	/**
	 * Цэсний элемент эхлэх үед.
	 */
	function start_el( &$output, $item, $depth = 0, $args = null, $id = 0 ) {
		$args = (object) $args;
		// Level 1 элемент бүр дээр баннерын өгөгдлийг reset хийх.
		if ( 0 === $depth ) {
			$this->has_banner       = false;
			$this->banner_data      = array();
			self::$last_child_count = isset( $item->child_count ) ? (int) $item->child_count : 0;
		}

		$item_id      = isset( $item->ID ) ? (int) $item->ID : 0;
		$item_classes = isset( $item->classes ) ? (array) $item->classes : array();

		// Хэрэв Level 1 эцэг элемент бөгөөд дэд цэстэй бол нэрийг нь түр хадгалж, ACF шалгана.
		if ( 0 === $depth && in_array( 'menu-item-has-children', $item_classes, true ) ) {
			$this->current_parent_title = $item->title ?? '';
			$this->current_parent_url   = $item->url ?? '';

			// ACF талбаруудыг унших: Зөвхөн 'sub_menu' true байвал баннерыг идэвхжүүлнэ.
			if ( $item_id > 0 && function_exists( 'get_field' ) ) {
				$acf_banner_enabled = (bool) get_field( 'sub_menu', $item_id );

				if ( $acf_banner_enabled ) {
					$this->has_banner  = true;
					$this->banner_data = array(
						'image'       => get_field( 'banner_image', $item_id ),
						'title'       => get_field( 'banner_title', $item_id ),
						'description' => get_field( 'banner_description', $item_id ),
					);
				}
			}
		}
		parent::start_el( $output, $item, $depth, $args, $id );
	}

	/**
	 * Дэд цэс (ul) эхлэх үед.
	 */
	function start_lvl( &$output, $depth = 0, $args = null ) {
		$args   = (object) $args;
		$indent = str_repeat( "\t", $depth );

		if ( 0 === $depth && 'menu-1' === ( $args->theme_location ?? '' ) && empty( $args->is_mobile ) ) {
			$wrapper_classes = 'absolute left-0 top-full hidden group-hover/level-0:flex flex-col w-full bg-white min-w-[200px] rounded-xs rounded-t-none shadow-xl animate-in fade-in slide-in-from-top-1 duration-200 z-50';

			if ( $this->has_banner ) {
				$wrapper_classes  = str_replace( 'group-hover/level-0:flex', 'group-hover/level-0:grid', $wrapper_classes );
				$wrapper_classes .= ' lg:grid-cols-12 overflow-hidden';
			}

			// Ерөнхий контейнер болон гарчгийг нэмж байна.
			$output .= "\n$indent<div class=\"$wrapper_classes\">\n";

			// Хэрэв баннертай бол зүүн талын агуулгын контейнер нээх.
			if ( $this->has_banner ) {
				$output .= "$indent\t<div class=\"lg:col-span-9 flex flex-col\">\n";
			}

			$output .= "$indent\t<div class=\"px-8 pt-8 pointer-events-none\">\n";
			$output .= "$indent\t\t<span class=\"text-[0.625rem] font-black tracking-[0.2em] uppercase text-primary/40 block mb-2\">" . esc_html( $this->current_parent_title ) . "</span>\n";
			$output .= "$indent\t</div>\n";
		}

		parent::start_lvl( $output, $depth, $args );
	}

	/**
	 * Дэд цэс (ul) дуусах үед.
	 */
	function end_lvl( &$output, $depth = 0, $args = null ) {
		$args   = (object) $args;
		$indent = str_repeat( "\t", $depth );
		parent::end_lvl( $output, $depth, $args );

		if ( 0 === $depth && 'menu-1' === ( $args->theme_location ?? '' ) && empty( $args->is_mobile ) ) {
			if ( $this->has_banner ) {
				$output .= "$indent\t</div><!-- .col-span-8 -->\n";

				// Баннер хэсэг.
				$output .= "$indent\t<div class=\"lg:col-span-3 p-8 flex flex-col\">\n";

				if ( ! empty( $this->banner_data['image'] ) ) {
					$img_id  = is_array( $this->banner_data['image'] ) ? $this->banner_data['image']['ID'] : $this->banner_data['image'];
					$output .= "$indent\t\t<div class=\"aspect-video rounded-xs overflow-hidden mb-4\">\n";
					$output .= "$indent\t\t\t" . wp_get_attachment_image( (int) $img_id, 'large', false, array( 'class' => 'w-full h-full object-cover' ) ) . "\n";
					$output .= "$indent\t\t</div>\n";
				}

				if ( ! empty( $this->banner_data['title'] ) ) {
					$output .= "$indent\t\t<p class=\"text-sm font-bold leading-tight text-primary mb-1\">" . esc_html( $this->banner_data['title'] ) . "</p>\n";
				}

				if ( ! empty( $this->banner_data['description'] ) ) {
					$output .= "$indent\t\t<p class=\"text-xs text-slate-500 leading-tight\">" . esc_html( $this->banner_data['description'] ) . "</p>\n";
				}

				$output .= "$indent\t\t<a href=\"" . esc_url( $this->current_parent_url ) . "\" class=\"mt-4 inline-flex items-center gap-1 text-[0.625rem] font-bold leading-none uppercase tracking-wider text-primary hover:text-primary-dark transition-colors\">\n";
				$output .= "$indent\t\t\t" . esc_html__( 'Дэлгэрэнгүй', 'aceedu' ) . "\n";
				$output .= "$indent\t\t\t<svg class=\"w-3 h-3\" viewBox=\"0 0 24 24\" fill=\"none\" stroke=\"currentColor\" stroke-width=\"2.5\" stroke-linecap=\"round\" stroke-linejoin=\"round\"><path d=\"M5 12h14m-7-7 7 7-7 7\"/></svg>\n";
				$output .= "$indent\t\t</a>\n";

				$output .= "$indent\t</div><!-- .col-span-4 -->\n";
			}

			$output .= "$indent</div><!-- .absolute-wrapper -->\n";
		}
	}
}



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
	// Swiper Assets.
	wp_register_style( 'swiper', get_template_directory_uri() . '/assets/css/swiper-bundle.min.css', array(), '11.0.0' );
	wp_register_script( 'swiper', get_template_directory_uri() . '/assets/js/swiper-bundle.min.js', array(), '11.0.0', true );

	// Block Scripts with Swiper dependency.
	wp_register_script( 'hero-js', get_template_directory_uri() . '/blocks/hero/hero.js', array( 'swiper' ), UB_VERSION, true );
	wp_register_script( 'testimonials-js', get_template_directory_uri() . '/blocks/testimonials/testimonials.js', array( 'swiper' ), UB_VERSION, true );
	wp_register_script( 'trust-signals-js', get_template_directory_uri() . '/blocks/trust-signals/trust-signals.js', array( 'swiper' ), UB_VERSION, true );
	wp_register_script( 'core-pathways-js', get_template_directory_uri() . '/blocks/core-pathways/core-pathways.js', array( 'swiper' ), UB_VERSION, true );
	wp_register_script( 'value-prop-js', get_template_directory_uri() . '/blocks/value-prop/value-prop.js', array( 'swiper' ), UB_VERSION, true );
	wp_register_script( 'mvv-js', get_template_directory_uri() . '/blocks/mission-vision-values/mission-vision-values.js', array( 'swiper' ), UB_VERSION, true );
	wp_register_script( 'team-js', get_template_directory_uri() . '/blocks/team/team.js', array( 'swiper' ), UB_VERSION, true );
	wp_register_script( 'milestones-js', get_template_directory_uri() . '/blocks/milestones/milestones.js', array( 'swiper' ), UB_VERSION, true );
	wp_register_script( 'process-roadmap-js', get_template_directory_uri() . '/blocks/process-roadmap/process-roadmap.js', array( 'swiper' ), UB_VERSION, true );
	wp_register_script( 'bento-trust-signals-js', get_template_directory_uri() . '/blocks/trust-signals-bento/trust-signals-bento.js', array(), UB_VERSION, true );
	wp_register_script( 'carousel-blocks-js', get_template_directory_uri() . '/blocks/schools-carousel/carousel-blocks.js', array( 'swiper' ), UB_VERSION, true );
	wp_register_script( 'featured-posts-slider-js', get_template_directory_uri() . '/blocks/featured-posts-slider/featured-posts-slider.js', array( 'swiper' ), UB_VERSION, true );

	// Block Styles with Swiper dependency.
	wp_register_style( 'hero-css', get_template_directory_uri() . '/blocks/hero/hero.css', array( 'swiper' ), UB_VERSION );
}
add_action( 'init', 'ub_register_assets', 5 );
/**
 * Скриптүүд
 *
 * @return void
 */
function ub_scripts() {
	wp_enqueue_style( 'ace-style', get_stylesheet_uri(), array(), UB_VERSION );
	wp_enqueue_script( 'ace-script', get_template_directory_uri() . '/js/script.min.js', array(), UB_VERSION, true );

	// Register Modular Component Scripts.
	wp_register_script(
		'related-posts-script',
		get_template_directory_uri() . '/assets/js/related-posts.js',
		array( 'swiper' ),
		UB_VERSION,
		true
	);

	// Conditionally Enqueue Related Posts Carousel assets.
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
			@font-face {
				font-family: 'GmarketSans';
				src: url('https://cdn.jsdelivr.net/gh/projectnoonnu/noonfonts_2001@1.1/GmarketSansLight.woff') format('woff');
				font-weight: 300;
				font-style: normal;
				font-display: swap;
			}
			@font-face {
				font-family: 'GmarketSans';
				src: url('https://cdn.jsdelivr.net/gh/projectnoonnu/noonfonts_2001@1.1/GmarketSansMedium.woff') format('woff');
				font-weight: 500;
				font-style: normal;
				font-display: swap;
			}
			@font-face {
				font-family: 'GmarketSans';
				src: url('https://cdn.jsdelivr.net/gh/projectnoonnu/noonfonts_2001@1.1/GmarketSansBold.woff') format('woff');
				font-weight: 700;
				font-style: normal;
				font-display: swap;
			}
			body, .editor-styles-wrapper {
				font-family: 'Google Sans', 'GmarketSans', ui-sans-serif, system-ui, sans-serif;
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

/**
 * Кирилл үсгийг латин галиг руу хөрвүүлж, SEO-д ээлтэй slug үүсгэх функц.
 *
 * Энэ функц нь WordPress-ийн sanitize_title шүүлтүүртэй холбогдож,
 * шинэ хуудас эсвэл пост үүсгэх үед кирилл гарчгийг латин галиг руу хөрвүүлнэ.
 *
 * @param string $title Анхны гарчиг эсвэл slug.
 * @return string Галигласан slug.
 */
function ub_cyrillic_slug_transliteration( $title ) {
	$cyrillic_map = array(
		'А' => 'A',
		'Б' => 'B',
		'В' => 'V',
		'Г' => 'G',
		'Д' => 'D',
		'Е' => 'E',
		'Ё' => 'Yo',
		'Ж' => 'J',
		'З' => 'Z',
		'И' => 'I',
		'Й' => 'I',
		'К' => 'K',
		'Л' => 'L',
		'М' => 'M',
		'Н' => 'N',
		'О' => 'O',
		'Ө' => 'U',
		'П' => 'P',
		'Р' => 'R',
		'С' => 'S',
		'Т' => 'T',
		'У' => 'U',
		'Ү' => 'U',
		'Ф' => 'F',
		'Х' => 'Kh',
		'Ц' => 'Ts',
		'Ч' => 'Ch',
		'Ш' => 'Sh',
		'Щ' => 'Shch',
		'Ъ' => '',
		'Ы' => 'Y',
		'Ь' => '',
		'Э' => 'E',
		'Ю' => 'Yu',
		'Я' => 'Ya',
		'а' => 'a',
		'б' => 'b',
		'в' => 'v',
		'г' => 'g',
		'д' => 'd',
		'е' => 'e',
		'ё' => 'yo',
		'ж' => 'j',
		'з' => 'z',
		'и' => 'i',
		'й' => 'i',
		'к' => 'k',
		'л' => 'l',
		'м' => 'm',
		'н' => 'n',
		'о' => 'o',
		'ө' => 'u',
		'п' => 'p',
		'р' => 'r',
		'с' => 's',
		'т' => 't',
		'у' => 'u',
		'ү' => 'u',
		'ф' => 'f',
		'х' => 'kh',
		'ц' => 'ts',
		'ч' => 'ch',
		'ш' => 'sh',
		'щ' => 'shch',
		'ъ' => '',
		'ы' => 'y',
		'ь' => '',
		'э' => 'e',
		'ю' => 'yu',
		'я' => 'ya',
	);

	return strtr( $title, $cyrillic_map );
}
add_filter( 'sanitize_title', 'ub_cyrillic_slug_transliteration', 0 );

/**
 * Өмнөх кирилл slug-уудыг латин галиг руу бөөнөөр нь шилжүүлэх түр зуурын функц.
 * Сэрэмжлүүлэг: Ажиллуулахын өмнө баазаа нөөцлөхийг зөвлөж байна.
 * Ашиглах хаяг: /wp-admin/?ub_migrate_slugs=1&_wpnonce={nonce}
 * Nonce үүсгэх: wp_create_nonce( 'ub_migrate_slugs' )
 */
function ub_migrate_existing_cyrillic_slugs() {
	if ( ! is_admin() || ! current_user_can( 'manage_options' ) ) {
		return;
	}

	// phpcs:ignore WordPress.Security.NonceVerification.Recommended -- Nonce-г доор шалгаж байна.
	if ( ! isset( $_GET['ub_migrate_slugs'] ) ) {
		return;
	}

	// Nonce шалгалт — CSRF халдлагаас хамгаалах.
	if ( ! isset( $_GET['_wpnonce'] ) || ! wp_verify_nonce( sanitize_text_field( wp_unslash( $_GET['_wpnonce'] ) ), 'ub_migrate_slugs' ) ) {
		wp_die( esc_html__( 'Security check failed.', 'aceedu' ), 403 );
	}

	$post_types = array( 'post', 'page', 'school' );
	$post_count = 0;
	$term_count = 0;

	// 1. Постуудыг шинэчлэх.
	$posts = get_posts(
		array(
			'post_type'      => $post_types,
			'posts_per_page' => -1,
			'post_status'    => 'any',
		)
	);

	foreach ( $posts as $post ) {
		$new_slug = ub_cyrillic_slug_transliteration( $post->post_title );
		$new_slug = sanitize_title( $new_slug );

		if ( $new_slug !== $post->post_name ) {
			wp_update_post(
				array(
					'ID'        => $post->ID,
					'post_name' => $new_slug,
				)
			);
			++$post_count;
		}
	}

	// 2. Таксономийн элементүүдийг (Terms) шинэчлэх.
	$taxonomies = get_taxonomies( array( 'public' => true ) );
	$terms      = get_terms(
		array(
			'taxonomy'   => $taxonomies,
			'hide_empty' => false,
		)
	);

	if ( ! is_wp_error( $terms ) ) {
		foreach ( $terms as $term ) {
			$new_term_slug = ub_cyrillic_slug_transliteration( $term->name );
			$new_term_slug = sanitize_title( $new_term_slug );

			if ( $new_term_slug !== $term->slug ) {
				wp_update_term(
					$term->term_id,
					$term->taxonomy,
					array(
						'slug' => $new_term_slug,
					)
				);
				++$term_count;
			}
		}
	}

	// Үр дүнг харуулах.
	add_action(
		'admin_notices',
		function () use ( $post_count, $term_count ) {
			echo '<div class="notice notice-success is-dismissible"><p>';
			printf( 'Slug migration completed. %d posts and %d terms updated.', absint( $post_count ), absint( $term_count ) );
			echo '</p></div>';
		}
	);
}
// add_action( 'admin_init', 'ub_migrate_existing_cyrillic_slugs' );.



/**
 * Placement Test - Default Questions (acf/load_value)
 */
function ub_default_pt_questions( $value, $post_id, $field ) {
	if ( ! is_admin() || ! empty( $value ) ) {
		return $value;
	}

	// Default 5 standard Topik-style questions
	return array(
		array(
			'field_pt_q_title'   => 'Эхний асуулт: 저는 학생____. (이다)',
			'field_pt_q_options' => array(
				array(
					'field_pt_q_opt_label' => '입니다',
					'field_pt_q_opt_score' => 1,
				),
				array(
					'field_pt_q_opt_label' => '입니까',
					'field_pt_q_opt_score' => 0,
				),
				array(
					'field_pt_q_opt_label' => '이에요',
					'field_pt_q_opt_score' => 0,
				),
			),
		),
		array(
			'field_pt_q_title'   => 'Хоёр дахь: 이것은 사과____. (이다)',
			'field_pt_q_options' => array(
				array(
					'field_pt_q_opt_label' => '가 아닙니다',
					'field_pt_q_opt_score' => 0,
				),
				array(
					'field_pt_q_opt_label' => '입니다',
					'field_pt_q_opt_score' => 1,
				),
				array(
					'field_pt_q_opt_label' => '인가요',
					'field_pt_q_opt_score' => 0,
				),
			),
		),
		array(
			'field_pt_q_title'   => 'Гурав дахь: 어제 친구를 ____. (만나다)',
			'field_pt_q_options' => array(
				array(
					'field_pt_q_opt_label' => '만날 것입니다',
					'field_pt_q_opt_score' => 0,
				),
				array(
					'field_pt_q_opt_label' => '만났습니다',
					'field_pt_q_opt_score' => 1,
				),
				array(
					'field_pt_q_opt_label' => '만나고 있습니다',
					'field_pt_q_opt_score' => 0,
				),
			),
		),
		array(
			'field_pt_q_title'   => 'Дөрөв дэх: 주말에 영화를 ____ 고 해요. (보다)',
			'field_pt_q_options' => array(
				array(
					'field_pt_q_opt_label' => '보',
					'field_pt_q_opt_score' => 0,
				),
				array(
					'field_pt_q_opt_label' => '볼',
					'field_pt_q_opt_score' => 1,
				),
				array(
					'field_pt_q_opt_label' => '본',
					'field_pt_q_opt_score' => 0,
				),
			),
		),
		array(
			'field_pt_q_title'   => 'Тав дахь: 날씨가 정말 ____. (춥다)',
			'field_pt_q_options' => array(
				array(
					'field_pt_q_opt_label' => '춥습니다',
					'field_pt_q_opt_score' => 1,
				),
				array(
					'field_pt_q_opt_label' => '추울 것입니다',
					'field_pt_q_opt_score' => 0,
				),
				array(
					'field_pt_q_opt_label' => '추웠습니다',
					'field_pt_q_opt_score' => 0,
				),
			),
		),
	);
}
add_filter( 'acf/load_value/name=pt_questions', 'ub_default_pt_questions', 10, 3 );

/**
 * Placement Test - Default Levels (acf/load_value)
 */
function ub_default_pt_levels( $value, $post_id, $field ) {
	if ( ! is_admin() || ! empty( $value ) ) {
		return $value;
	}

	return array(
		array(
			'field_pt_lvl_min'    => 0,
			'field_pt_lvl_max'    => 2,
			'field_pt_lvl_title'  => 'Төвшин 1: Анхан шат (Beginner 1)',
			'field_pt_lvl_desc'   => 'Та гүйцэтгэлээ сайжруулахын тулд анхан шатны сургалтад хамрагдана уу.',
			'field_pt_lvl_course' => '',
		),
		array(
			'field_pt_lvl_min'    => 3,
			'field_pt_lvl_max'    => 4,
			'field_pt_lvl_title'  => 'Төвшин 2: Анхан шат цааш (Beginner 2)',
			'field_pt_lvl_desc'   => 'Та анхан шатны мэдлэгтэй байна.',
			'field_pt_lvl_course' => '',
		),
		array(
			'field_pt_lvl_min'    => 5,
			'field_pt_lvl_max'    => 5,
			'field_pt_lvl_title'  => 'Төвшин 3: Дунд шат (Intermediate)',
			'field_pt_lvl_desc'   => 'Та дүрэм болон үгийн сайн мэдлэгтэй байна.',
			'field_pt_lvl_course' => '',
		),
	);
}
add_filter( 'acf/load_value/name=pt_levels', 'ub_default_pt_levels', 10, 3 );
