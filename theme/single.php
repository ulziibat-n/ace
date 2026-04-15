<?php
/**
 * The template for displaying all single posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package aceedu
 */

get_header();
?>

	<section id="primary">
		<main id="main">

			<?php
			/* Start the Loop */
			while ( have_posts() ) :
				the_post();
				get_template_part( 'template-parts/content/content', 'single' );
			endwhile;
			?>

		</main><!-- #main -->
	</section><!-- #primary -->
	<section class="relative w-full overflow-hidden bg-slate-100 py-16 lg:py-32">
		<div class="container">
			<div class="mb-12 flex items-end justify-between gap-8">
				<div class="max-w-xl grow">
					<h2 class="mb-2 text-2xl leading-none font-bold tracking-tight lg:text-3xl"><?php esc_html_e( 'Холбоотой нийтлэлүүд', 'ace' ); ?></h2>
					<p class="text-base leading-tight text-slate-500 opacity-80"><?php esc_html_e( 'Таны сонирхсон сэдвээрх бусад хэрэгтэй мэдээллүүдийг эндээс уншаарай.', 'ace' ); ?></p>
				</div>
				<!-- Carousel Navigation -->
				<div class="flex shrink items-center gap-2 pb-2">
					<button data-related-posts-carousel-prev class="group flex h-12 w-12 cursor-pointer items-center justify-center rounded-full border border-white bg-white shadow-sm shadow-primary/5 transition-all hover:border-primary hover:bg-primary">
						<svg class="h-5 w-5 text-primary transition-colors group-hover:text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path></svg>
					</button>
					<button data-related-posts-carousel-next class="group flex h-12 w-12 cursor-pointer items-center justify-center rounded-full border border-white bg-white shadow-sm shadow-primary/5 transition-all hover:border-primary hover:bg-primary">
						<svg class="h-5 w-5 text-primary transition-colors group-hover:text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
					</button>
				</div>
			</div>
			<?php
			$ub_categories   = get_the_category( get_the_ID() );
			$ub_category_ids = array();
			foreach ( $ub_categories as $ub_cat ) {
				$ub_category_ids[] = $ub_cat->term_id;
			}

			$ub_related_query = new WP_Query(
				array(
					'category__in'        => $ub_category_ids,
					'post__not_in'        => array( get_the_ID() ),
					'posts_per_page'      => 10,
					'ignore_sticky_posts' => 1,
				)
			);

			if ( $ub_related_query->have_posts() ) :
				?>
				<div data-related-posts-carousel class="swiper group overflow-visible!">
					<div class="swiper-wrapper flex flex-nowrap gap-[10px] group-[.swiper-initialized]:gap-0">
						<?php
						while ( $ub_related_query->have_posts() ) :
							$ub_related_query->the_post();
							?>
							<div class="swiper-slide w-full max-w-[calc((96rem-30px)/4)]">
								<?php get_template_part( 'template-parts/cards/card', 'post', array( 'class' => '' ) ); ?>
							</div>
							<?php
						endwhile;
						wp_reset_postdata();
						?>
					</div>
				</div>
				<?php
			endif;
			?>
		</div>
	</section>
<?php
get_footer();
