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
	<section class="overflow-hidden relative py-16 w-full lg:py-32 bg-slate-100">
		<div class="container">
			<div class="flex gap-8 justify-between items-end mb-12">
				<div class="max-w-xl grow">
					<h2 class="mb-2 text-2xl font-bold tracking-tight lg:text-3xl"><?php esc_html_e( 'Холбоотой нийтлэлүүд', 'ace' ); ?></h2>
					<p class="font-medium leading-tight text-foreground/60"><?php esc_html_e( 'Таны сонирхсон сэдвээрх бусад хэрэгтэй мэдээллүүдийг эндээс уншаарай.', 'ace' ); ?></p>
				</div>
				<!-- Carousel Navigation -->
				<div class="flex gap-2 items-center pb-2 shrink">
					<button data-related-posts-carousel-prev class="flex justify-center items-center w-12 h-12 bg-white rounded-full border border-white shadow-sm transition-all cursor-pointer shadow-primary/5 group hover:bg-primary hover:border-primary">
						<svg class="w-5 h-5 transition-colors text-primary group-hover:text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path></svg>
					</button>
					<button data-related-posts-carousel-next class="flex justify-center items-center w-12 h-12 bg-white rounded-full border border-white shadow-sm transition-all cursor-pointer shadow-primary/5 group hover:bg-primary hover:border-primary">
						<svg class="w-5 h-5 transition-colors text-primary group-hover:text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
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
				<div data-related-posts-carousel class="overflow-visible! swiper group">
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
