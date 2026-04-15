<?php
/**
 * Custom template tags for this theme
 *
 * Eventually, some functionality here could be replaced by core features.
 *
 * @package aceedu
 */

if ( ! function_exists( 'ub_posted_on' ) ) :
	/**
	 * Prints HTML with meta information for the current post-date/time.
	 */
	function ub_posted_on() {
		$time_string = '<time class="published updated" datetime="%1$s">%2$s</time>';
		if ( get_the_time( 'U' ) !== get_the_modified_time( 'U' ) ) {
			$time_string = '<time class="published" datetime="%1$s">%2$s</time><time class="updated" datetime="%3$s">%4$s</time>';
		}

		$time_string = sprintf(
			$time_string,
			esc_attr( get_the_date( DATE_W3C ) ),
			esc_html( get_the_date() ),
			esc_attr( get_the_modified_date( DATE_W3C ) ),
			esc_html( get_the_modified_date() )
		);

		printf(
			'<a href="%1$s" rel="bookmark">%2$s</a>',
			esc_url( get_permalink() ),
			$time_string // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
		);
	}
endif;

if ( ! function_exists( 'ub_posted_by' ) ) :
	/**
	 * Prints HTML with meta information about theme author.
	 */
	function ub_posted_by() {
		printf(
		/* translators: 1: posted by label, only visible to screen readers. 2: author link. 3: post author. */
			'<span class="sr-only">%1$s</span><span class="author vcard"><a class="url fn n" href="%2$s">%3$s</a></span>',
			esc_html__( 'Posted by', 'aceedu' ),
			esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ),
			esc_html( get_the_author() )
		);
	}
endif;

if ( ! function_exists( 'ub_comment_count' ) ) :
	/**
	 * Prints HTML with the comment count for the current post.
	 */
	function ub_comment_count() {
		if ( ! post_password_required() && ( comments_open() || get_comments_number() ) ) {
			/* translators: %s: Name of current post. Only visible to screen readers. */
			comments_popup_link( sprintf( __( 'Leave a comment<span class="sr-only"> on %s</span>', 'aceedu' ), get_the_title() ) );
		}
	}
endif;

if ( ! function_exists( 'ub_entry_meta' ) ) :
	/**
	 * Prints HTML with meta information for the categories, tags and comments.
	 * This template tag is used in the entry header.
	 */
	function ub_entry_meta() {

		// Hide author, post date, category and tag text for pages.
		if ( 'post' === get_post_type() ) {

			// Posted by.
			ub_posted_by();

			// Posted on.
			ub_posted_on();

			/* translators: used between list items, there is a space after the comma. */
			$categories_list = get_the_category_list( __( ', ', 'aceedu' ) );
			if ( $categories_list ) {
				printf(
				/* translators: 1: posted in label, only visible to screen readers. 2: list of categories. */
					'<span><span class="sr-only">%1$s</span>%2$s</span>',
					esc_html__( 'Posted in', 'aceedu' ),
					$categories_list // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
				);
			}

			/* translators: used between list items, there is a space after the comma. */
			$tags_list = get_the_tag_list( '', __( ', ', 'aceedu' ) );
			if ( $tags_list ) {
				printf(
				/* translators: 1: tags label, only visible to screen readers. 2: list of tags. */
					'<span><span class="sr-only">%1$s</span>%2$s</span>',
					esc_html__( 'Tags:', 'aceedu' ),
					$tags_list // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
				);
			}
		}

		// Comment count.
		if ( ! is_singular() ) {
			ub_comment_count();
		}

		// Edit post link.
		edit_post_link(
			sprintf(
				wp_kses(
				/* translators: %s: Name of current post. Only visible to screen readers. */
					__( 'Edit <span class="sr-only">%s</span>', 'aceedu' ),
					array(
						'span' => array(
							'class' => array(),
						),
					)
				),
				get_the_title()
			)
		);
	}
endif;

if ( ! function_exists( 'ub_entry_footer' ) ) :
	/**
	 * Prints HTML with meta information for the categories, tags and comments.
	 */
	function ub_entry_footer() {

		// Hide author, post date, category and tag text for pages.
		if ( 'post' === get_post_type() ) {

			// Posted by.
			ub_posted_by();

			// Posted on.
			ub_posted_on();

			/* translators: used between list items, there is a space after the comma. */
			$categories_list = get_the_category_list( __( ', ', 'aceedu' ) );
			if ( $categories_list ) {
				printf(
				/* translators: 1: posted in label, only visible to screen readers. 2: list of categories. */
					'<span><span class="sr-only">%1$s</span>%2$s</span>',
					esc_html__( 'Posted in', 'aceedu' ),
					$categories_list // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
				);
			}

			/* translators: used between list items, there is a space after the comma. */
			$tags_list = get_the_tag_list( '', __( ', ', 'aceedu' ) );
			if ( $tags_list ) {
				printf(
				/* translators: 1: tags label, only visible to screen readers. 2: list of tags. */
					'<span><span class="sr-only">%1$s</span>%2$s</span>',
					esc_html__( 'Tags:', 'aceedu' ),
					$tags_list // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
				);
			}
		}
	}
endif;

if ( ! function_exists( 'ub_post_thumbnail' ) ) :
	/**
	 * Displays an optional post thumbnail, wrapping the post thumbnail in an
	 * anchor element except when viewing a single post.
	 */
	function ub_post_thumbnail() {
		if ( ! ub_can_show_post_thumbnail() ) {
			return;
		}

		if ( is_singular() ) :
			?>

			<figure>
				<?php the_post_thumbnail(); ?>
			</figure><!-- .post-thumbnail -->

			<?php
		else :
			?>

			<figure>
				<a href="<?php the_permalink(); ?>" aria-hidden="true" tabindex="-1">
					<?php the_post_thumbnail(); ?>
				</a>
			</figure>

			<?php
		endif; // End is_singular().
	}
endif;

if ( ! function_exists( 'ub_comment_avatar' ) ) :
	/**
	 * Returns the HTML markup to generate a user avatar.
	 *
	 * @param mixed $id_or_email The Gravatar to retrieve. Accepts a user_id, gravatar md5 hash,
	 *                           user email, WP_User object, WP_Post object, or WP_Comment object.
	 */
	function ub_get_user_avatar_markup( $id_or_email = null ) {

		if ( ! isset( $id_or_email ) ) {
			$id_or_email = get_current_user_id();
		}

		return sprintf( '<div class="vcard">%s</div>', get_avatar( $id_or_email, ub_get_avatar_size() ) );
	}
endif;

if ( ! function_exists( 'ub_discussion_avatars_list' ) ) :
	/**
	 * Displays a list of avatars involved in a discussion for a given post.
	 *
	 * @param array $comment_authors Comment authors to list as avatars.
	 */
	function ub_discussion_avatars_list( $comment_authors ) {
		if ( empty( $comment_authors ) ) {
			return;
		}
		echo '<ol>', "\n";
		foreach ( $comment_authors as $id_or_email ) {
			printf(
				"<li>%s</li>\n",
				ub_get_user_avatar_markup( $id_or_email ) // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
			);
		}
		echo '</ol>', "\n";
	}
endif;

if ( ! function_exists( 'ub_the_posts_navigation' ) ) :
	/**
	 * Wraps `the_posts_pagination` for use throughout the theme.
	 */
	function ub_the_posts_navigation() {
		the_posts_pagination(
			array(
				'mid_size'  => 2,
				'prev_text' => '<svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path></svg><span class="sr-only">' . esc_html__( 'Өмнөх', 'aceedu' ) . '</span>',
				'next_text' => '<span class="sr-only">' . esc_html__( 'Дараах', 'aceedu' ) . '</span><svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>',
			)
		);
	}
endif;

if ( ! function_exists( 'ub_content_class' ) ) :
	/**
	 * Displays the class names for the post content wrapper.
	 *
	 * This allows us to add Tailwind Typography’s modifier classes throughout
	 * the theme without repeating them in multiple files. (They can be edited
	 * at the top of the `../functions.php` file via the
	 * UB_TYPOGRAPHY_CLASSES constant.)
	 *
	 * Based on WordPress core’s `body_class` and `get_body_class` functions.
	 *
	 * @param string|string[] $classes Space-separated string or array of class
	 *                                 names to add to the class list.
	 */
	function ub_content_class( $classes = '' ) {
		$all_classes = array( $classes, UB_TYPOGRAPHY_CLASSES );

		foreach ( $all_classes as &$class_groups ) {
			if ( ! empty( $class_groups ) ) {
				if ( ! is_array( $class_groups ) ) {
					$class_groups = preg_split( '#\s+#', $class_groups );
				}
			} else {
				// Ensure that we always coerce class to being an array.
				$class_groups = array();
			}
		}

		$combined_classes = array_merge( $all_classes[0], $all_classes[1] );
		$combined_classes = array_map( 'esc_attr', $combined_classes );

		// Separates class names with a single space, preparing them for the
		// post content wrapper.
		echo 'class="' . esc_attr( implode( ' ', $combined_classes ) ) . '"';
	}
endif;

if ( ! function_exists( 'ub_can_show_post_thumbnail' ) ) :
	/**
	 * Тухайн постны Featured Image (Thumbnail) харагдах боломжтой эсэхийг шалгах.
	 */
	function ub_can_show_post_thumbnail() {
		return apply_filters( 'ub_can_show_post_thumbnail', ! post_password_required() && ! is_attachment() && has_post_thumbnail() );
	}
endif;

if ( ! function_exists( 'ub_get_avatar_size' ) ) :
	/**
	 * Theme-д ашиглагдах Аватар зургийн хэмжээг тодорхойлох.
	 */
	function ub_get_avatar_size() {
		return 60;
	}
endif;

if ( ! function_exists( 'ub_html5_comment' ) ) :
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
	function ub_html5_comment( $comment, $args, $depth ) {
		$tag = ( 'div' === $args['style'] ) ? 'div' : 'li';

		$commenter          = wp_get_current_commenter();
		$show_pending_links = ! empty( $commenter['comment_author'] );

		if ( $commenter['comment_author_email'] ) {
			$moderation_note = __( 'Your comment is awaiting moderation.', 'aceedu' );
		} else {
			$moderation_note = __( 'Your comment is awaiting moderation. This is a preview; your comment will be visible after it has been approved.', 'aceedu' );
		}
		?>
		<?php // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
		printf( '<%s id="comment-%d" class="%s">', esc_attr( $tag ), get_comment_ID(), esc_attr( implode( ' ', get_comment_class( $comment->has_children ? 'parent' : '', $comment ) ) ) ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
		?>
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

				<div <?php ub_content_class( 'comment-content' ); ?>>
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
endif;

if ( ! function_exists( 'ub_language_switcher' ) ) :
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
		<div class="flex items-center gap-2 text-[0.625rem] font-bold tracking-widest uppercase px-4 py-2 bg-slate-50/70 hover:bg-slate-50 transition-colors duration-300 rounded-xs">
			<?php
			$count = count( $languages );
			$i     = 0;
			foreach ( $languages as $language ) :
				++$i;
				$is_active = ( $current_language_slug === $language->slug );
				$url       = FALANG()->get_translated_url( $language );

				// Map for cleaner display.
				$display_name = $language->slug;
				if ( strpos( $language->slug, 'mn' ) === 0 ) {
					$display_name = 'MN';
				} elseif ( strpos( $language->slug, 'en' ) === 0 ) {
					$display_name = 'EN';
				} elseif ( strpos( $language->slug, 'ko' ) === 0 ) {
					$display_name = 'KR';
				} else {
					$display_name = strtoupper( substr( $language->slug, 0, 2 ) );
				}
				?>
				<a href="<?php echo esc_url( $url ); ?>"
					class="transition-all duration-300 <?php echo $is_active ? 'text-primary' : 'text-slate-400 hover:text-slate-600'; ?>">
					<?php echo esc_html( $display_name ); ?>
				</a>
			<?php endforeach; ?>
		</div>
		<?php
	}
endif;

if ( ! function_exists( 'ub_display_primary_category' ) ) :
	/**
	 * Yoast SEO-ийн үндсэн ангиллыг (Primary Category) хэвлэх функц.
	 *
	 * Хэрэв Yoast SEO дээр үндсэн ангилал сонгогдоогүй бол тухайн постны
	 * сонгогдсон ангилалуудаас хамгийн эхнийхийг харуулна.
	 *
	 * @param string $ub_class Нэмэлт CSS класс.
	 */
	function ub_display_primary_category( $ub_class = '' ) {
		// Yoast SEO-ийн үндсэн ангиллын ID-г мета өгөгдлөөс авах.
		$ub_primary_cat_id  = get_post_meta( get_the_ID(), '_yoast_wpseo_primary_category', true );
		$ub_target_category = null;

		if ( $ub_primary_cat_id ) {
			$ub_target_category = get_term( $ub_primary_cat_id, 'category' );
		}

		// Хэрэв Yoast-ийн ангилал байхгүй бол нийт ангиллуудаас эхнийхийг авах.
		if ( ! $ub_target_category || is_wp_error( $ub_target_category ) ) {
			$ub_categories = get_the_category();
			if ( ! empty( $ub_categories ) ) {
				$ub_target_category = $ub_categories[0];
			}
		}

		// Ангилал олдсон бол линк болон нэрийг хэвлэх.
		if ( $ub_target_category ) {
			printf(
				'<a href="%1$s" class="%2$s">%3$s</a>',
				esc_url( get_category_link( $ub_target_category->term_id ) ),
				esc_attr( $ub_class ),
				esc_html( $ub_target_category->name )
			);
		}
	}
endif;

if ( ! function_exists( 'ub_get_toc_and_content' ) ) :
	/**
	 * Контент доторх h2, h3 тагуудад random ID оноож, Table of Contents (TOC) үүсгэх функц.
	 *
	 * @param string $ub_content Постны контент.
	 * @param int    $ub_post_id Постны ID.
	 * @return array TOC-ийн HTML болон зассан контентыг агуулсан массив.
	 */
	function ub_get_toc_and_content( $ub_content, $ub_post_id = 0 ) {
		if ( ! $ub_post_id ) {
			$ub_post_id = get_the_ID();
		}

		$ub_cache_key = 'ub_toc_' . $ub_post_id;
		$ub_cached    = get_transient( $ub_cache_key );

		if ( false !== $ub_cached ) {
			return $ub_cached;
		}

		// Зөвхөн h2 гарчгуудыг хайж олох regex.
		$ub_regex = '/<(h2)(.*?)>(.*?)<\/h2>/i';
		$ub_toc   = '';

		// Гарчгуудыг боловсруулах.
		$ub_content = preg_replace_callback(
			$ub_regex,
			function ( $ub_matches ) use ( &$ub_toc ) {
				$ub_tag   = $ub_matches[1]; // h2.
				$ub_attrs = $ub_matches[2]; // Бусад атрибутууд.
				$ub_title = wp_strip_all_tags( $ub_matches[3] ); // Гарчгийн текст.

				// Санамсаргүй ID үүсгэх.
				$ub_random_id = 'toc-' . wp_generate_password( 7, false );

				// TOC жагсаалтад нэмэх.
				$ub_li_class = '';
				$ub_toc     .= sprintf(
					'<li class="%1$s"><a href="#%2$s" class="">%3$s</a></li>',
					esc_attr( $ub_li_class ),
					esc_attr( $ub_random_id ),
					esc_html( $ub_title )
				);

				// Контент дахь гарчигт ID-г нэмж буцаах.
				return sprintf( '<%1$s id="%2$s"%3$s>%4$s</%1$s>', $ub_tag, $ub_random_id, $ub_attrs, $ub_matches[3] );
			},
			$ub_content
		);

		$ub_result = array(
			'toc'     => $ub_toc,
			'content' => $ub_content,
		);

		// Кэшийг 12 цагаар хадгалах.
		set_transient( $ub_cache_key, $ub_result, 12 * HOUR_IN_SECONDS );

		return $ub_result;
	}
endif;

/**
 * Пост хадгалах үед TOC кэшийг цэвэрлэх.
 */
add_action(
	'save_post',
	function ( $ub_post_id ) {
		delete_transient( 'ub_toc_' . $ub_post_id );
	}
);
