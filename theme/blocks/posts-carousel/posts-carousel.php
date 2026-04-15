<?php
/**
 * Posts Carousel Block Template.
 *
 * @package ace
 * @since 1.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$ub_id = 'posts-carousel-' . $block['id'];
if ( ! empty( $block['anchor'] ) ) {
	$ub_id = $block['anchor'];
}

$ub_align      = ! empty( $block['align'] ) ? 'align' . $block['align'] : 'alignfull';
$ub_class_name = 'block-posts-carousel relative w-full overflow-hidden bg-slate-100 py-16 lg:py-24 ' . $ub_align . ( isset( $block['className'] ) ? ' ' . $block['className'] : '' );

// ACF Fields.
$ub_example_data = ub_get_block_example_data( $block );
$ub_headline     = get_field( 'pc_title' ) ?: ( $ub_example_data['pc_title'] ?? '' );
$ub_description  = get_field( 'pc_description' ) ?: ( $ub_example_data['pc_description'] ?? '' );
$ub_posts_count  = get_field( 'pc_posts_count' ) ?: 10;
$ub_filter_type  = get_field( 'pc_filter_type' ) ?: 'all';
$ub_link         = get_field( 'pc_link' );

// Max Width Logic.
$ub_title_mw = get_field( 'pc_title_max_width' ) ?: 768;
$ub_desc_mw  = get_field( 'pc_description_max_width' ) ?: 720;

$ub_title_rem = ( $ub_title_mw / 16 ) . 'rem';
$ub_desc_rem  = ( $ub_desc_mw / 16 ) . 'rem';

// Query Args.
$ub_args = array(
	'post_type'           => 'post',
	'posts_per_page'      => $ub_posts_count,
	'ignore_sticky_posts' => 1,
	'post_status'         => 'publish',
);

// Filtering Logic.
if ( 'manual' === $ub_filter_type ) {
	$ub_selected = get_field( 'pc_selected_posts' );
	if ( ! empty( $ub_selected ) ) {
		$ub_args['post__in'] = $ub_selected;
		$ub_args['orderby']  = 'post__in';
	}
} elseif ( 'category' === $ub_filter_type ) {
	$ub_categories = get_field( 'pc_category_filter' );
	if ( ! empty( $ub_categories ) ) {
		$ub_args['category__in'] = $ub_categories;
	}
}

$ub_query = new WP_Query( $ub_args );
?>

<section id="<?php echo esc_attr( $ub_id ); ?>" class="<?php echo esc_attr( $ub_class_name ); ?>">
	<div class="container">
		<div class="mb-12 flex flex-row items-end justify-between gap-8">
			<div class="grow">
				<?php if ( $ub_headline ) : ?>
					<h2 class="mb-2 text-2xl leading-none font-bold tracking-tight text-primary lg:text-3xl" style="max-width: <?php echo esc_attr( $ub_title_rem ); ?>;">
						<?php echo esc_html( $ub_headline ); ?>
					</h2>
				<?php endif; ?>
				<?php if ( $ub_description ) : ?>
					<p class="text-base leading-tight text-slate-500 opacity-80" style="max-width: <?php echo esc_attr( $ub_desc_rem ); ?>;">
						<?php echo wp_kses_post( $ub_description ); ?>
					</p>
				<?php endif; ?>

				<?php if ( ! empty( $ub_link['url'] ) && ! empty( $ub_link['title'] ) ) : ?>
					<div class="mt-6">
						<a href="<?php echo esc_url( $ub_link['url'] ); ?>" 
							target="<?php echo esc_attr( $ub_link['target'] ? $ub_link['target'] : '_self' ); ?>"
							class="inline-flex items-center gap-4 rounded-xs bg-primary px-4 py-2 text-xs font-bold text-white no-underline shadow-lg shadow-primary/20 transition-all duration-300 hover:bg-primary-dark">
							<?php echo esc_html( $ub_link['title'] ); ?>
							<svg class="h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"><path d="M1.99974 13.0001L1.9996 11.0002L18.1715 11.0002L14.2218 7.05044L15.636 5.63623L22 12.0002L15.636 18.3642L14.2218 16.9499L18.1716 13.0002L1.99974 13.0001Z"></path></svg>
						</a>
					</div>
				<?php endif; ?>
			</div>

			<!-- Carousel Navigation -->
			<div data-carousel-nav class="flex shrink items-center gap-2 pb-2">
				<button data-carousel-prev class="group flex h-12 w-12 cursor-pointer items-center justify-center rounded-full border border-white bg-white shadow-sm shadow-primary/5 transition-all hover:border-primary hover:bg-primary">
					<svg class="h-5 w-5 text-primary transition-colors group-hover:text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path></svg>
				</button>
				<button data-carousel-next class="group flex h-12 w-12 cursor-pointer items-center justify-center rounded-full border border-white bg-white shadow-sm shadow-primary/5 transition-all hover:border-primary hover:bg-primary">
					<svg class="h-5 w-5 text-primary transition-colors group-hover:text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
				</button>
			</div>
		</div>

		<?php if ( $ub_query->have_posts() ) : ?>
			<div data-carousel-slider class="swiper group overflow-visible!">
				<div class="swiper-wrapper flex flex-nowrap gap-[10px] group-[.swiper-initialized]:gap-0">
					<?php
					while ( $ub_query->have_posts() ) :
						$ub_query->the_post();
						?>
						<div class="swiper-slide flex! h-auto! w-full max-w-[calc((96rem-30px)/4)]">
							<?php get_template_part( 'template-parts/cards/card', 'post' ); ?>
						</div>
						<?php
					endwhile;
					wp_reset_postdata();
					?>
				</div>
				
				<!-- ProgressBar -->
				<div class="swiper-pagination static! mt-8 ml-0 max-w-xs overflow-hidden rounded-sm!" style="--swiper-pagination-progressbar-bg-color:#F1F5F9;--swiper-theme-color:#085399;"></div>
			</div>
		<?php else : ?>
			<?php if ( $is_preview ) : ?>
				<div class="rounded-sm border-2 border-dashed border-slate-200 p-12 text-center text-slate-400">
					Нийтлэлүүд олдсонгүй. Шүүлтүүрээ шалгана уу.
				</div>
			<?php endif; ?>
		<?php endif; ?>

	</div>
</section>
