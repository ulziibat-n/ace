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

/**
 * Returns the SVG code for a Remix Icon (Line style).
 *
 * @param string $slug The icon slug.
 * @return string The SVG code.
 */
function site_get_remix_icon_line( string $slug ): string {
	$icons = array(
		'graduation-cap-line' => '<path d="M12 2L1 7l11 5 11-5-11-5zM2 8.26l10 4.54 10-4.54V15h2v-6.74L12 3.73 2 8.26zM20 18.5V10.15l-1 0.45v7.9c0 1-1.5 2-4 2s-4-1-4-2v-7.9l-1-0.45v8.35L12 21l8-2.5z"/>',
		'user-line'           => '<path d="M12 12c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm0 2c-2.67 0-8 1.34-8 4v2h16v-2c0-2.66-5.33-4-8-4z"/>',
		'bank-line'           => '<path d="M2 20h20v2H2v-2zm2-8h2v7H4v-7zm5 0h2v7H9v-7zm5 0h2v7h-2v-7zm5 0h2v7h-2v-7zM2 10l10-8 10 8H2z"/>',
		'building-4-line'     => '<path d="M21 21H3v-2h2V4.5a1.5 1.5 0 0 1 1.5-1.5h11a1.5 1.5 0 0 1 1.5 1.5V19h2v2zM7 5v2h2V5H7zm4 0v2h2V5h-2zm4 0v2h2V5h-2zM7 9v2h2V9H7zm4 0v2h2V9h-2zm4 0v2h2V9h-2zM7 13v2h2v-2H7zm4 0v2h2v-2h-2zm4 0v2h2v-2h-2zm-8 4v2h10v-2H7z"/>',
		'passport-line'       => '<path d="M20 22H4V2h16v20zM6 4v16h12V4H6zm7 3h3v2h-3V7zm0 4h3v2h-3v-2zM8 15h8v2H8v-2z"/>',
		'globe-line'          => '<path d="M12 22C6.477 22 2 17.523 2 12S6.477 2 12 2s10 4.477 10 10-4.477 10-10 10zm-2.29-2.333A8.067 8.067 0 0 1 4.103 14H8.1a25.15 25.15 0 0 1 1.61 5.667zm4.58 0c.664-1.724 1.258-3.64 1.61-5.667h3.997a8.067 8.067 0 0 1-5.607 5.667z"/>',
		'medal-line'          => '<path d="M12 7a5 5 0 1 0 0 10 5 5 0 0 0 0-10zm-7 5a7 7 0 1 1 14 0 7 7 0 0 1-14 0zm7-10l2.5 5h5l-4 3.5 1.5 5-5-3-5 3 1.5-5-4-3.5h5L12 2z"/>',
		'award-line'          => '<path d="M17 15.245v6.872l-5-2.509-5 2.51v-6.873A9 9 0 1 1 17 15.245zM12 18a7 7 0 1 0 0-14 7 7 0 0 0 0 14z"/>',
		'calendar-line'       => '<path d="M9 1v2h6V1h2v2h4a1 1 0 0 1 1 1v16a1 1 0 0 1-1 1H3a1 1 0 0 1-1-1V4a1 1 0 0 1 1-1h4V1h2zm11 7H4v11h16V8zm-3-3H7v1h10V5z"/>',
		'community-line'      => '<path d="M9 13a5 5 0 1 0 0-10 5 5 0 0 0 0 10zm0-2a3 3 0 1 1 0-6 3 3 0 0 1 0 6zm7.503 10.007a9 9 0 0 0-15.006 0l1.666 1.11a7 7 0 0 1 11.674 0l1.666-1.11zM18 10a5 5 0 1 0 0-10 5 5 0 0 0 0 10zm0-2a3 3 0 1 1 0-6 3 3 0 0 1 0 6z"/>',
		'hotel-line'          => '<path d="M22 21H2v-2h1V4.5a1.5 1.5 0 0 1 1.5-1.5h15a1.5 1.5 0 0 1 1.5 1.5V19h1v2zm-4-2V5H5v14h13zM7 7h4v4H7V7zm6 0h3v2h-3V7zm0 4h3v2h-3v-2z"/>',
	);

	return isset( $icons[ $slug ] ) ? $icons[ $slug ] : $icons['graduation-cap-line'];
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
			'stat_icon'   => 'graduation-cap-line',
		),
		array(
			'stat_number' => '45+',
			'stat_label'  => __( 'БНСУ-ын Их, дээд сургууль', 'aceedu' ),
			'stat_icon'   => 'bank-line',
		),
		array(
			'stat_number' => '98%',
			'stat_label'  => __( 'Виз гаралтын баталгаа', 'aceedu' ),
			'stat_icon'   => 'passport-line',
		),
		array(
			'stat_number' => '8+',
			'stat_label'  => __( 'Жилийн бодит туршлага', 'aceedu' ),
			'stat_icon'   => 'calendar-line',
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
				<button data-trust-signals-prev class="flex justify-center items-center w-12 h-12 bg-white rounded-full border shadow-sm transition-all cursor-pointer border-slate-100 shadow-primary/5 group hover:bg-primary hover:border-primary">
					<svg class="w-5 h-5 transition-colors text-primary group-hover:text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path></svg>
				</button>
				<button data-trust-signals-next class="flex justify-center items-center w-12 h-12 bg-white rounded-full border shadow-sm transition-all cursor-pointer border-slate-100 shadow-primary/5 group hover:bg-primary hover:border-primary">
					<svg class="w-5 h-5 transition-colors text-primary group-hover:text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
				</button>
			</div>
		</div>

		<!-- Swiper Component. -->
		<div class="swiper <?php echo ! $is_preview ? 'overflow-visible!' : 'overflow-hidden'; ?> group" data-trust-signals-slider>
			<div class="swiper-wrapper flex! gap-[10px] group-[.swiper-initialized]:gap-0">
				<?php
				foreach ( $ub_stats as $ub_index => $ub_stat ) :
					$ub_icon_slug = isset( $ub_stat['stat_icon'] ) ? $ub_stat['stat_icon'] : 'graduation-cap-line';
					?>
					<div class="swiper-slide h-auto! w-full max-w-[300px]">
						<div class="block-trust-signals__card w-full relative group p-8 rounded-sm overflow-hidden bg-slate-50 flex flex-col justify-between h-full border border-slate-50 shadow-sm transition-all duration-500 in-[.swiper-slide-active]:bg-primary in-[.swiper-slide-active]:text-white in-[.swiper-slide-active]:border-transparent in-[.swiper-slide-active]:shadow-[0_25px_50px_-12px_rgba(8,83,153,0.25)] italic:not-italic">
							
							<!-- Grid Background Pattern. -->
							<div class="block-trust-signals__grid-pattern absolute inset-0 pointer-events-none transition-opacity duration-500 opacity-20 in-[.swiper-slide-active]:opacity-10">
								<svg class="opacity-15" width="100%" height="100%" xmlns="http://www.w3.org/2000/svg">
									<defs>
										<pattern id="grid-ts-<?php echo esc_attr( $ub_id . '-' . $ub_index ); ?>" width="15" height="15" patternUnits="userSpaceOnUse">
											<path d="M 15 0 L 0 0 0 15" fill="none" stroke="currentColor" stroke-width="1"/>
										</pattern>
									</defs>
									<rect width="100%" height="100%" fill="url(#grid-ts-<?php echo esc_attr( $ub_id . '-' . $ub_index ); ?>)" />
								</svg>
							</div>

							<!-- Top Icon (Remix Line). -->
							<div class="block-trust-signals__icon-wrapper relative z-10 w-10 h-10 transition-all duration-500 group-hover:scale-110 text-primary in-[.swiper-slide-active]:text-white">
								<svg class="w-full h-full transition-colors duration-500" viewBox="0 0 24 24" fill="currentColor">
									<?php echo wp_kses( site_get_remix_icon_line( $ub_icon_slug ), array( 'path' => array( 'd' => array() ) ) ); ?>
								</svg>
							</div>

							<!-- Bottom Content. -->
							<div class="relative z-10 mt-10">
								<div class="block-trust-signals__number text-3xl lg:text-4xl font-bold tracking-tighter leading-none mb-2 transition-colors duration-500 text-slate-900 in-[.swiper-slide-active]:text-white">
									<?php echo esc_html( $ub_stat['stat_number'] ); ?>
								</div>
								<div class="block-trust-signals__label font-bold leading-none text-xs lg:text-sm max-w-[180px] transition-colors duration-500 text-slate-500/80 in-[.swiper-slide-active]:text-white/90">
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
