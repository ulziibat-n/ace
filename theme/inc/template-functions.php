<?php
/**
 * WordPress-ийн стандарт функцүүдийг сайжруулах болон theme-д зориулсан
 * нэмэлт функцүүдийг агуулсан файл.
 *
 * @package aceedu
 */

/**
 * Ганц пост, хуудас эсвэл хавсралт (attachment) ачаалах үед
 * Pingback URL-ийг автоматаар илрүүлэх header нэмэх.
 */
function aceedu_pingback_header() {
	if ( is_singular() && pings_open() ) {
		printf( '<link rel="pingback" href="%s">', esc_url( get_bloginfo( 'pingback_url' ) ) );
	}
}
add_action( 'wp_head', 'aceedu_pingback_header' );

/**
 * Сэтгэгдэл бичих формын үндсэн талбаруудын тохиргоог өөрчлөх.
 *
 * @param array $defaults Сэтгэгдлийн формын анхны аргументууд.
 * @return array Шинэчилсэн талбаруудын жагсаалт.
 */
function aceedu_comment_form_defaults( $defaults ) {
	$comment_field = $defaults['comment_field'];

	// Adjust height of comment form.
	$defaults['comment_field'] = preg_replace( '/rows="\d+"/', 'rows="5"', $comment_field );

	return $defaults;
}
add_filter( 'comment_form_defaults', 'aceedu_comment_form_defaults' );

/**
 * Архивын хуудасны гарчгийг (Category, Tag, Author гэх мэт) засаж харуулах.
 */
function aceedu_get_the_archive_title() {
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
add_filter( 'get_the_archive_title', 'aceedu_get_the_archive_title' );

/**
 * Тухайн постны Featured Image (Thumbnail) харагдах боломжтой эсэхийг шалгах.
 */
function aceedu_can_show_post_thumbnail() {
	return apply_filters( 'aceedu_can_show_post_thumbnail', ! post_password_required() && ! is_attachment() && has_post_thumbnail() );
}

/**
 * Theme-д ашиглагдах Аватар зургийн хэмжээг тодорхойлох.
 */
function aceedu_get_avatar_size() {
	return 60;
}

/**
 * "Үргэлжлүүлэн унших" (Continue Reading) холбоосыг үүсгэх.
 *
 * @param string $more_string Холбоос дотор харагдах текст.
 */
function aceedu_continue_reading_link( $more_string ) {

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
add_filter( 'excerpt_more', 'aceedu_continue_reading_link' );

// Filter the content more link.
add_filter( 'the_content_more_link', 'aceedu_continue_reading_link' );

/**
 * Сэтгэгдлийг HTML5 стандартаар харуулах функц.
 *
 * WordPress-ийн стандарт сэтгэгдлийн гаралтыг өөрчилж, Tailwind Typography
 * болон дизайны онцлогт нийцүүлэн засаж харуулдаг.
 *
 * @param WP_Comment $comment Харуулах сэтгэгдэл.
 * @param array      $args    Нэмэлт аргументууд.
 * @param int        $depth   Сэтгэгдлийн түвшин (хариу бичих үед).
 */
function aceedu_html5_comment( $comment, $args, $depth ) {
	$tag = ( 'div' === $args['style'] ) ? 'div' : 'li';

	$commenter          = wp_get_current_commenter();
	$show_pending_links = ! empty( $commenter['comment_author'] );

	if ( $commenter['comment_author_email'] ) {
		$moderation_note = __( 'Your comment is awaiting moderation.', 'aceedu' );
	} else {
		$moderation_note = __( 'Your comment is awaiting moderation. This is a preview; your comment will be visible after it has been approved.', 'aceedu' );
	}
	?>
	<<?php echo esc_attr( $tag ); ?> id="comment-<?php comment_ID(); ?>" <?php comment_class( $comment->has_children ? 'parent' : '', $comment ); ?>>
		<article id="div-comment-<?php comment_ID(); ?>" class="comment-body">
			<footer class="comment-meta">
				<div class="comment-author vcard">
					<?php
					if ( 0 !== $args['avatar_size'] ) {
						echo get_avatar( $comment, $args['avatar_size'] );
					}
					?>
					<?php
					$comment_author = get_comment_author_link( $comment );

					if ( '0' === $comment->comment_approved && ! $show_pending_links ) {
						$comment_author = get_comment_author( $comment );
					}

					printf(
						/* translators: %s: Comment author link. */
						wp_kses_post( __( '%s <span class="says">says:</span>', 'aceedu' ) ),
						sprintf( '<b class="fn">%s</b>', wp_kses_post( $comment_author ) )
					);
					?>
				</div><!-- .comment-author -->

				<div class="comment-metadata">
					<?php
					printf(
						'<a href="%s"><time datetime="%s">%s</time></a>',
						esc_url( get_comment_link( $comment, $args ) ),
						esc_attr( get_comment_time( 'c' ) ),
						esc_html(
							sprintf(
							/* translators: 1: Comment date, 2: Comment time. */
								__( '%1$s at %2$s', 'aceedu' ),
								get_comment_date( '', $comment ),
								get_comment_time()
							)
						)
					);

					edit_comment_link( __( 'Edit', 'aceedu' ), ' <span class="edit-link">', '</span>' );
					?>
				</div><!-- .comment-metadata -->

				<?php if ( '0' === $comment->comment_approved ) : ?>
				<em class="comment-awaiting-moderation"><?php echo esc_html( $moderation_note ); ?></em>
				<?php endif; ?>
			</footer><!-- .comment-meta -->

			<div <?php aceedu_content_class( 'comment-content' ); ?>>
				<?php comment_text(); ?>
			</div><!-- .comment-content -->

			<?php
			if ( '1' === $comment->comment_approved || $show_pending_links ) {
				comment_reply_link(
					array_merge(
						$args,
						array(
							'add_below' => 'div-comment',
							'depth'     => $depth,
							'max_depth' => $args['max_depth'],
							'before'    => '<div class="reply">',
							'after'     => '</div>',
						)
					)
				);
			}
			?>
		</article><!-- .comment-body -->
	<?php
}

/**
 *  Typography-ийн классуудыг нэмэх.
 *
 * @param mixed $html Логоны HTML код.
 * @return array|string Шинэчилсэн HTML код.
 */
function aceedu_custom_logo_class( $html ) {
	// 'custom-logo-link' гэсэн текстийг олоод хажууд нь 'your-custom-class' нэмнэ
	$html = str_replace( 'custom-logo-link', 'block [&_img]:w-full [&_img]:max-w-[4rem] [&_img]:h-auto', $html );
	return $html;
}
add_filter( 'get_custom_logo', 'aceedu_custom_logo_class' );

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
function aceedu_body_classes( $classes ) {
	// Энд нэмэлт нөхцөлт классуудыг нэмж болно.
	$classes[] = 'font-sans bg-white';
	return $classes;
}
add_filter( 'body_class', 'aceedu_body_classes' );

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
function aceedu_nav_menu_classes( $classes, $item, $args ) {
	// Хэрэв тодорхой нэг цэсэнд (theme_location) класс нэмэх бол энд шалгаж болно.
	if ( 'menu-1' === $args->theme_location ) {
		$classes[] = 'group [&_a]:text-slate-700 [&_a]:font-bold [&_a]:transition-colors [&_a]:duration-300 [&_a]:ease-in-out [&_a]:hover:text-primary [&_a]:group-[.current-menu-item]:text-primary [&_a]:text-xs [&_a]:uppercase';
	}

	return $classes;
}
add_filter( 'nav_menu_css_class', 'aceedu_nav_menu_classes', 10, 3 );
