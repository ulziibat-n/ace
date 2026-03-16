<?php
/**
 * UB (ACE) theme-ийн үндсэн функцүүд болон тодорхойлолтууд
 *
 * Энэхүү файл нь вэб сайтын суурь тохиргоо, файл дуудах, болон бусад нэмэлт
 * функцүүдийг агуулдаг.
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package aceedu
 */

if ( ! defined( 'UB_VERSION' ) ) {
	$theme_info = wp_get_theme();
	define( 'UB_VERSION', $theme_info->get( 'Version' ) );
}

if ( ! defined( 'UB_TYPOGRAPHY_CLASSES' ) ) {
	/*
	 * Set Tailwind Typography classes for the front end, block editor and
	 * classic editor using the constant below.
	 *
	 * For the front end, these classes are added by the `ub_content_class`
	 * function. You will see that function used everywhere an `entry-content`
	 * or `page-content` class has been added to a wrapper element.
	 *
	 * For the block editor, these classes are converted to a JavaScript array
	 * and then used by the `./javascript/block-editor.js` file, which adds
	 * them to the appropriate elements in the block editor (and adds them
	 * again when they’re removed.)
	 *
	 * For the classic editor (and anything using TinyMCE, like Advanced Custom
	 * Fields), these classes are added to TinyMCE’s body class when it
	 * initializes.
	 */
	define(
		'UB_TYPOGRAPHY_CLASSES',
		'prose prose-neutral max-w-none prose-a:text-primary'
	);
}

if ( ! function_exists( 'ub_setup' ) ) :
	/**
	 * Theme-ийн анхны тохиргоо болон WordPress-ийн функцүүдийг идэвхжүүлэх.
	 *
	 * Энэ функц нь 'after_setup_theme' hook-той холбогдож ажиллах бөгөөд
	 * вэб сайт ачаалж эхлэх үед зурагны хэмжээ, цэсний байршил,
	 * theme-ийн дэмжлэгүүдийг (thumbnails гэх мэт) бүртгэдэг.
	 */
	function ub_setup() {
		/*
		 * Make theme available for translation.
		 * Translations can be filed in the /languages/ directory.
		 * If you're building a theme based on ub, use a find and replace
		 * to change 'aceedu' to the name of your theme in all the template files.
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

		// This theme uses wp_nav_menu() in two locations.
		register_nav_menus(
			array(
				'menu-1' => __( 'Үндсэн цэс', 'aceedu' ),
				'menu-2' => __( 'Доод талын цэс', 'aceedu' ),
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

		// Add theme support for selective refresh for widgets.
		// Add theme support for automatic RSS feed links. (Optional, keeping it for now).
		// add_theme_support( 'automatic-feed-links' );.

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

		// Custom color palette for the editor.
		add_theme_support(
			'editor-color-palette',
			array(
				array(
					'name'  => __( 'Primary', 'aceedu' ),
					'slug'  => 'primary',
					'color' => '#1e3a8a',
				),
				array(
					'name'  => __( 'Secondary', 'aceedu' ),
					'slug'  => 'secondary',
					'color' => '#f59e0b',
				),
				array(
					'name'  => __( 'Slate', 'aceedu' ),
					'slug'  => 'slate',
					'color' => '#1e293b',
				),
				array(
					'name'  => __( 'White', 'aceedu' ),
					'slug'  => 'white',
					'color' => '#ffffff',
				),
			)
		);

		// Disable custom colors and gradients to keep design consistent.
		add_theme_support( 'disable-custom-colors' );
		add_theme_support( 'editor-gradient-presets', array() );
		add_theme_support( 'disable-custom-gradients' );
	}
endif;
add_action( 'after_setup_theme', 'ub_setup' );

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

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Functions which enhance the theme by hooking into WordPress.
 */
require get_template_directory() . '/inc/template-functions.php';
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

/**
 * Display Falang Language Switcher with Tailwind Styling.
 */
function ub_language_switcher() {
	if ( ! function_exists( 'falang_languages_list' ) || ! function_exists( 'FALANG' ) ) {
		return;
	}

	$languages = falang_languages_list();
	if ( empty( $languages ) || count( $languages ) < 2 ) {
		return;
	}

	$current_language_slug = falang_current_language();
	?>
	<div class="flex items-center gap-3 text-xs font-bold tracking-widest uppercase">
		<?php
		$count = count( $languages );
		$i     = 0;
		foreach ( $languages as $language ) :
			$i++;
			$is_active = ( $current_language_slug === $language->slug );
			$url       = FALANG()->get_translated_url( $language );

			// Map for cleaner display
			$display_name = $language->slug;
			if ( strpos( $language->slug, 'mn' ) === 0 ) {
				$display_name = 'MN';
			} elseif ( strpos( $language->slug, 'en' ) === 0 ) {
				$display_name = 'EN';
			} elseif ( strpos( $language->slug, 'ko' ) === 0 ) {
				$display_name = 'KO';
			} else {
				$display_name = strtoupper( substr( $language->slug, 0, 2 ) );
			}
			?>
			<a href="<?php echo esc_url( $url ); ?>"
			   class="transition-all duration-300 <?php echo $is_active ? 'text-primary' : 'text-neutral-400 hover:text-neutral-900'; ?>">
				<?php echo esc_html( $display_name ); ?>
			</a>
			<?php if ( $i < $count ) : ?>
				<span class="w-1 h-1 rounded-full bg-neutral-200"></span>
			<?php endif; ?>
		<?php endforeach; ?>
	</div>
	<?php
}
