<?php
/**
 * Featured Posts Slider Block Template.
 *
 * @param array $block The block settings and attributes.
 * @param string $content The block inner HTML (empty).
 * @param bool $is_preview True during AJAX preview.
 * @param  (int|string) $post_id The post ID this block is saved to.
 *
 * @package aceedu
 */

$ub_id = 'featured-slider-' . $block['id'];
if ( ! empty( $block['anchor'] ) ) {
	$ub_id = $block['anchor'];
}

$ub_class_name = 'featured-posts-slider-block alignfull';
if ( ! empty( $block['className'] ) ) {
	$ub_class_name .= ' ' . $block['className'];
}

// Fields.
$ub_filter_type     = get_field( 'pc_filter_type' ) ? get_field( 'pc_filter_type' ) : 'latest';
$ub_posts_count     = get_field( 'pc_posts_count' ) ? get_field( 'pc_posts_count' ) : 3;
$ub_category_filter = get_field( 'pc_category_filter' );
$ub_selected_posts  = get_field( 'pc_selected_posts' );

// Dynamic dummy content from block.json if fields are empty in preview.
if ( $is_preview && empty( $ub_selected_posts ) && 'manual' === $ub_filter_type ) {
	$ub_example_data = function_exists( 'ub_get_block_example_data' ) ? ub_get_block_example_data( $block ) : array();
	if ( ! empty( $ub_example_data['selection_type'] ) ) {
		$ub_filter_type = $ub_example_data['selection_type'];
	}
}

// Build WP_Query.
$ub_filter_type     = get_field( 'pc_filter_type' ) ? get_field( 'pc_filter_type' ) : 'latest';
$ub_category_filter = get_field( 'pc_category_filter' );

$ub_args = array(
	'post_type'           => 'post',
	'posts_per_page'      => $ub_posts_count,
	'post_status'         => 'publish',
	'ignore_sticky_posts' => 1,
);

if ( 'category' === $ub_filter_type && ! empty( $ub_category_filter ) ) {
	$ub_args['tax_query'] = array(
		array(
			'taxonomy' => 'category',
			'field'    => 'term_id',
			'terms'    => $ub_category_filter,
		),
	);
} else {
	// Sticky Posts (default/latest).
	$ub_sticky_posts     = get_option( 'sticky_posts' );
	$ub_args['post__in'] = ! empty( $ub_sticky_posts ) ? $ub_sticky_posts : array( 0 );
	$ub_args['orderby']  = 'post__in';
}

$ub_query = new WP_Query( $ub_args );

if ( ! $ub_query->have_posts() && ! $is_preview ) {
	return;
}
?>

<section id="<?php echo esc_attr( $ub_id ); ?>" class="<?php echo esc_attr( $ub_class_name ); ?> relative overflow-hidden bg-neutral-900 text-white">
	<div class="swiper featured-swiper" data-featured-slider>
		<div class="swiper-wrapper">
			<?php
			if ( $ub_query->have_posts() ) :
				while ( $ub_query->have_posts() ) :
					$ub_query->the_post();
					$ub_featured_img_id = get_post_thumbnail_id();
					$ub_categories      = get_the_category();
					?>
					<div class="swiper-slide group/slide relative flex! flex-col justify-end overflow-hidden pt-60 lg:pt-48">
						<!-- Background Image -->
						<div class="absolute inset-0 z-0 scale-110 transition-transform duration-8000 ease-out group-[.swiper-slide-active]/slide:scale-100">
							<?php if ( $ub_featured_img_id ) : ?>
								<?php echo wp_get_attachment_image( $ub_featured_img_id, 'full', false, array( 'class' => 'w-full h-full absolute inset-0 z-10 object-cover' ) ); ?>
							<?php else : ?>
								<div class="object-cover absolute inset-0 z-10 w-full h-full bg-slate-800"></div>
							<?php endif; ?>
						</div>

						<div class="relative z-10 mt-auto mb-0 overflow-hidden">
							<!-- Gradient Backdrop Blur Overlay -->
							<div class="pointer-events-none absolute inset-0 z-0 mask-[linear-gradient(to_top,black_40%,transparent_100%)] backdrop-blur-xs"></div>
							<div class="absolute inset-0 z-0 bg-linear-to-t from-slate-950/70 to-slate-950/0"></div>
							
							<div class="relative z-10 container w-full py-20 lg:py-32">
								<div class="flex flex-col justify-center items-start h-full">
									<div class="mb-4 translate-y-4 opacity-0 transition-all delay-50 duration-500 group-[.swiper-slide-active]/slide:translate-y-0 group-[.swiper-slide-active]/slide:opacity-100">
										<?php ub_display_primary_category( 'mb-4 text-[0.625rem] font-bold uppercase leading-none px-2 rounded-xs ml-1 py-1.5 bg-white text-primary' ); ?>
									</div>
									
									<h2 class="max-w-3xl translate-y-4 text-4xl leading-none font-bold text-white opacity-0 transition-all delay-100 duration-500 group-[.swiper-slide-active]/slide:translate-y-0 group-[.swiper-slide-active]/slide:opacity-100 ">
										<a href="<?php the_permalink(); ?>" class="text-white no-underline hover:text-white"><?php the_title(); ?></a>
									</h2>
									
									<?php if ( has_excerpt() ) : ?>
										<p class="mt-6 max-w-2xl translate-y-4 text-md leading-tight text-white/90 opacity-0 transition-all delay-250 duration-500 group-[.swiper-slide-active]/slide:translate-y-0 group-[.swiper-slide-active]/slide:opacity-100">
											<?php echo esc_html( get_the_excerpt() ); ?>
										</p>
									<?php endif; ?>

									<div class="mt-6 translate-y-4 text-[0.625rem] font-bold text-white/60 uppercase opacity-0 transition-all delay-350 duration-500 group-[.swiper-slide-active]/slide:translate-y-0 group-[.swiper-slide-active]/slide:opacity-100">
										<?php echo esc_html__( 'Нийтлээч:', 'aceedu' ); ?> <?php the_author(); ?> <span class="mx-2 font-light opacity-50">|</span> <?php echo esc_html( get_the_date() ); ?>
									</div>
								</div>
							</div>
						</div>
					</div>
					<?php
				endwhile;
				wp_reset_postdata();
			elseif ( $is_preview ) :
				?>
				<div class="p-20 w-full text-center border-2 border-dashed border-slate-200 bg-slate-100 text-slate-400">
					<?php esc_html_e( 'Онцлох постууд олдсонгүй. Пост сонгох эсвэл тоог нь шалгана уу.', 'aceedu' ); ?>
				</div>
				<?php
			endif;
			?>
		</div>
		
		<div class="container flex absolute bottom-0 left-1/2 z-40 flex-row gap-8 justify-between items-end -translate-x-1/2 pointer-events-none">
			<div class="swiper-pagination pointer-events-auto static! ml-0 max-w-xs grow overflow-hidden rounded-none [&_.swiper-pagination-progressbar-fill]:origin-left! [&_.swiper-pagination-progressbar-fill]:scale-x-(--hero-autoplay-progress,0)! [&_.swiper-pagination-progressbar-fill]:transition-none! [&_span]:rounded-none!" style="--swiper-pagination-progressbar-bg-color:rgba(255,255,255,0.9);--swiper-theme-color:var(--color-primary);"></div>
			
			<div class="flex gap-2 items-center pb-8 pointer-events-auto">
				<button data-featured-carousel-prev class="flex justify-center items-center w-12 h-12 text-white rounded-full border shadow-sm backdrop-blur-md transition-all cursor-pointer group border-white/20 bg-white/10 hover:border-white hover:bg-white">
					<svg class="w-5 h-5 transition-colors group-hover:text-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path></svg>
				</button>
				<button data-featured-carousel-next class="flex justify-center items-center w-12 h-12 text-white rounded-full border shadow-sm backdrop-blur-md transition-all cursor-pointer group border-white/20 bg-white/10 hover:border-white hover:bg-white">
					<svg class="w-5 h-5 transition-colors group-hover:text-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
				</button>
			</div>
		</div>
	</div>
</section>
