<?php
/**
 * Trust Signals & Numbers Block Template.
 *
 * @param array $block The block settings and attributes.
 * @param string $content The block inner HTML (empty).
 * @param bool $is_preview True during AJAX preview.
 * @param (int|string) $post_id The post ID this block is saved to.
 *
 * @package aceedu
 * @since 1.0.0
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$ub_id = 'trust-signals-' . $block['id'];
if ( ! empty( $block['anchor'] ) ) {
	$ub_id = $block['anchor'];
}

$ub_class_name = 'block-trust-signals alignfull bg-white py-16 lg:py-24 w-full overflow-hidden';
if ( ! empty( $block['className'] ) ) {
	$ub_class_name .= ' ' . $block['className'];
}

// ACF Fields.
$ub_title       = get_field( 'ts_title' );
$ub_description = get_field( 'ts_description' );
$ub_stats       = get_field( 'ts_stats' );

// Max Width Logic.
$ub_title_mw = get_field( 'ts_title_max_width' ) ?: 768;
$ub_desc_mw  = get_field( 'ts_description_max_width' ) ?: 720;

$ub_title_rem = ( $ub_title_mw / 16 ) . 'rem';
$ub_desc_rem  = ( $ub_desc_mw / 16 ) . 'rem';

// Dynamic dummy content from block.json if fields are empty in preview.
if ( $is_preview && empty( $ub_stats ) ) {
	$ub_example_data = function_exists( 'ub_get_block_example_data' ) ? ub_get_block_example_data( $block ) : array();
	if ( ! empty( $ub_example_data ) ) {
		$ub_title       = ! empty( $ub_title ) ? $ub_title : ( isset( $ub_example_data['ts_title'] ) ? $ub_example_data['ts_title'] : '' );
		$ub_description = ! empty( $ub_description ) ? $ub_description : ( isset( $ub_example_data['ts_description'] ) ? $ub_example_data['ts_description'] : '' );
		$ub_stats       = isset( $ub_example_data['ts_stats'] ) ? $ub_example_data['ts_stats'] : array();
	}
}

// Final Fallback for labels if still empty.
$ub_title       = ! empty( $ub_title ) ? $ub_title : 'Бидний амжилт тоогоор';
$ub_description = ! empty( $ub_description ) ? $ub_description : 'Бидний амжилтын гол үзүүлэлт бол оюутнуудын маань бодит үр дүн юм.';
?>

<section id="<?php echo esc_attr( $ub_id ); ?>" class="<?php echo esc_attr( $ub_class_name ); ?>">
	<div class="container mx-auto px-6 lg:px-12">
		
		<!-- Section Header & Navigation. -->
		<div class="mb-12 flex flex-row items-end justify-between gap-8">
			<div class="grow">
				<h2 class="mb-2 text-2xl leading-none font-bold tracking-tight text-slate-900 lg:text-3xl" style="max-width: <?php echo esc_attr( $ub_title_rem ); ?>;">
					<?php echo esc_html( $ub_title ); ?>
				</h2>
				<p class="text-base leading-tight text-slate-500 opacity-80" style="max-width: <?php echo esc_attr( $ub_desc_rem ); ?>;">
					<?php echo esc_html( $ub_description ); ?>
				</p>
			</div>

			<!-- Carousel Navigation. -->
			<div data-trust-signals-nav class="flex shrink items-center gap-2 pb-2 transition-all duration-300">
				<button data-trust-signals-prev class="group flex h-12 w-12 cursor-pointer items-center justify-center rounded-full border border-slate-100 bg-white shadow-sm shadow-primary/5 transition-all hover:border-primary hover:bg-primary">
					<svg class="h-5 w-5 text-primary transition-colors group-hover:text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path></svg>
				</button>
				<button data-trust-signals-next class="group flex h-12 w-12 cursor-pointer items-center justify-center rounded-full border border-slate-100 bg-white shadow-sm shadow-primary/5 transition-all hover:border-primary hover:bg-primary">
					<svg class="h-5 w-5 text-primary transition-colors group-hover:text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
				</button>
			</div>
		</div>

		<!-- Swiper Component. -->
		<div class="swiper group overflow-visible!" data-trust-signals-slider>
			<div class="swiper-wrapper flex! gap-[10px] group-[.swiper-initialized]:gap-0">
				<?php
				foreach ( $ub_stats as $ub_index => $ub_stat ) :
					$ub_icon_id = isset( $ub_stat['stat_icon'] ) ? $ub_stat['stat_icon'] : 0;
					?>
					<div class="swiper-slide flex! h-auto! w-full max-w-[300px]">
						<div class="block-trust-signals__card group italic:not-italic relative flex h-full w-full flex-col justify-between overflow-hidden rounded-sm border border-primary/10 bg-white p-8 shadow-sm shadow-primary/0 transition-all duration-500 in-[.swiper-slide-active]:border-transparent in-[.swiper-slide-active]:bg-primary in-[.swiper-slide-active]:text-white in-[.swiper-slide-active]:shadow-md in-[.swiper-slide-active]:shadow-primary/10">

							<!-- Top Icon (Upload). -->
							<div class="block-trust-signals__icon-wrapper relative z-10 h-10 w-10 transition-all duration-500 group-hover:scale-110 in-[.swiper-slide-active]:brightness-0 in-[.swiper-slide-active]:invert">
								<?php
								if ( $ub_icon_id ) {
									echo wp_get_attachment_image( $ub_icon_id, 'thumbnail', false, array( 'class' => 'w-full h-full object-contain' ) );
								} else {
									// Fallback icon if none uploaded.
									?>
									<svg class="h-full w-full text-primary transition-colors duration-500 in-[.swiper-slide-active]:text-white" viewBox="0 0 24 24" fill="currentColor">
										<path d="M12 2L1 7l11 5 11-5-11-5zM2 8.26l10 4.54 10-4.54V15h2v-6.74L12 3.73 2 8.26zM20 18.5V10.15l-1 0.45v7.9c0 1-1.5 2-4 2s-4-1-4-2v-7.9l-1-0.45v8.35L12 21l8-2.5z"/>
									</svg>
									<?php
								}
								?>
							</div>

							<!-- Bottom Content. -->
							<div class="relative z-10 mt-10">
								<div class="block-trust-signals__number mb-2 text-3xl leading-none font-light tracking-tighter text-primary transition-colors duration-500 in-[.swiper-slide-active]:text-white lg:text-4xl">
									<?php echo esc_html( $ub_stat['stat_number'] ); ?>
								</div>
								<div class="block-trust-signals__label max-w-[180px] text-xs leading-none font-medium transition-colors duration-500 in-[.swiper-slide-active]:text-white/90 lg:text-sm">
									<?php echo esc_html( $ub_stat['stat_label'] ); ?>
								</div>
							</div>
						</div>
					</div>
				<?php endforeach; ?>
			</div>

			<!-- Pagination. -->
			<div class="swiper-pagination static! mt-8 ml-0 max-w-xs overflow-hidden rounded-sm!" style="--swiper-pagination-progressbar-bg-color:#F1F5F9;--swiper-theme-color:#085399;"></div>
		</div>

	</div>
</section>
