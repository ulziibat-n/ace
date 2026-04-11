<?php declare(strict_types=1);
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
$ub_title        = get_field( 'ts_title' ) ? get_field( 'ts_title' ) : __( 'Бидний амжилт тоогоор', 'aceedu' );
$ub_description  = get_field( 'ts_description' ) ? get_field( 'ts_description' ) : __( 'Бидний амжилтын гол үзүүлэлт бол оюутнуудын маань бодит үр дүн юм.', 'aceedu' );
$ub_header_width = get_field( 'ts_header_width' ) ? get_field( 'ts_header_width' ) : 600;
$ub_stats        = get_field( 'ts_stats' );

// Default stats for preview or if empty.
if ( empty( $ub_stats ) ) {
	$ub_stats = array(
		array(
			'stat_number' => '800+',
			'stat_label'  => __( 'Амжилттай суралцсан оюутан', 'aceedu' ),
			'stat_icon'   => 0,
		),
		array(
			'stat_number' => '45+',
			'stat_label'  => __( 'БНСУ-ын Их, дээд сургууль', 'aceedu' ),
			'stat_icon'   => 0,
		),
		array(
			'stat_number' => '98%',
			'stat_label'  => __( 'Виз гаралтын баталгаа', 'aceedu' ),
			'stat_icon'   => 0,
		),
		array(
			'stat_number' => '8+',
			'stat_label'  => __( 'Жилийн бодит туршлага', 'aceedu' ),
			'stat_icon'   => 0,
		),
	);
}
?>

<section id="<?php echo esc_attr( $ub_id ); ?>" class="<?php echo esc_attr( $ub_class_name ); ?>">
	<div class="container px-6 mx-auto lg:px-12">
		
		<!-- Section Header & Navigation. -->
		<div class="flex flex-row gap-8 justify-between items-end mb-12">
			<div class="grow" style="max-width: <?php echo esc_attr( (string) $ub_header_width ); ?>px;">
				<h2 class="mb-2 text-2xl font-bold tracking-tight lg:text-3xl text-slate-900">
					<?php echo esc_html( $ub_title ); ?>
				</h2>
				<p class="text-base font-medium leading-tight text-slate-500/80">
					<?php echo esc_html( $ub_description ); ?>
				</p>
			</div>

			<!-- Carousel Navigation. -->
			<div data-trust-signals-nav class="flex gap-2 items-center pb-2 transition-all duration-300 shrink">
				<button data-trust-signals-prev class="flex justify-center items-center w-12 h-12 bg-white rounded-full border border-slate-100 shadow-sm transition-all cursor-pointer shadow-primary/5 group hover:bg-[#085399] hover:border-[#085399]">
					<svg class="w-5 h-5 transition-colors text-[#085399] group-hover:text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path></svg>
				</button>
				<button data-trust-signals-next class="flex justify-center items-center w-12 h-12 bg-white rounded-full border border-slate-100 shadow-sm transition-all cursor-pointer shadow-primary/5 group hover:bg-[#085399] hover:border-[#085399]">
					<svg class="w-5 h-5 transition-colors text-[#085399] group-hover:text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
				</button>
			</div>
		</div>

		<!-- Swiper Component. -->
		<div class="swiper <?php echo ! $is_preview ? 'overflow-visible!' : 'overflow-hidden'; ?> group" data-trust-signals-slider>
			<div class="swiper-wrapper flex! gap-[10px] group-[.swiper-initialized]:gap-0">
				<?php
				foreach ( $ub_stats as $ub_index => $ub_stat ) :
					$ub_icon_id = isset( $ub_stat['stat_icon'] ) ? $ub_stat['stat_icon'] : 0;
					?>
					<div class="swiper-slide h-auto! w-full max-w-[300px]">
						<div class="block-trust-signals__card w-full relative group p-8 rounded-sm overflow-hidden flex flex-col justify-between h-full">
							
							<!-- Grid Background Pattern. -->
							<div class="block-trust-signals__grid-pattern absolute inset-0 pointer-events-none transition-opacity duration-500">
								<svg width="100%" height="100%" xmlns="http://www.w3.org/2000/svg">
									<defs>
										<pattern id="grid-ts-<?php echo esc_attr( $ub_id . '-' . $ub_index ); ?>" width="30" height="30" patternUnits="userSpaceOnUse">
											<path d="M 30 0 L 0 0 0 30" fill="none" stroke="currentColor" stroke-width="1"/>
										</pattern>
									</defs>
									<rect width="100%" height="100%" fill="url(#grid-ts-<?php echo esc_attr( $ub_id . '-' . $ub_index ); ?>)" />
								</svg>
							</div>

							<!-- Top Icon. -->
							<div class="relative z-10 w-10 h-10 transition-transform duration-500 group-hover:scale-110">
								<?php
								if ( $ub_icon_id ) :
									echo wp_get_attachment_image( $ub_icon_id, 'thumbnail', false, array( 'class' => 'w-full h-full object-contain' ) );
								else :
									?>
									<svg class="w-full h-full opacity-20" fill="currentColor" viewBox="0 0 24 24">
										<path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14l-5-4.87 6.91-1.01L12 2z"/>
									</svg>
									<?php
								endif;
								?>
							</div>

							<!-- Bottom Content. -->
							<div class="relative z-10 mt-10">
								<div class="block-trust-signals__number text-3xl lg:text-4xl font-bold tracking-tighter leading-none mb-2 transition-colors duration-500">
									<?php echo esc_html( $ub_stat['stat_number'] ); ?>
								</div>
								<div class="block-trust-signals__label font-bold leading-none text-xs lg:text-sm max-w-[180px] transition-colors duration-500">
									<?php echo esc_html( $ub_stat['stat_label'] ); ?>
								</div>
							</div>
						</div>
					</div>
				<?php endforeach; ?>
			</div>

			<!-- Pagination. -->
			<div class="swiper-pagination static! ml-0 mt-8 max-w-xs overflow-hidden rounded-sm!" style="--swiper-pagination-progressbar-bg-color:#F1F5F9;--swiper-theme-color:#085399;"></div>
		</div>

	</div>
</section>
