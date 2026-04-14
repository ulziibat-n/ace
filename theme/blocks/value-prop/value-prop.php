<?php
/**
 * Value Proposition Block Template (Carousel Layout).
 *
 * @package aceedu
 * @since 1.0.0
 */

// Гар аргаар хандахаас сэргийлэх.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$ub_id = 'value-prop-' . $block['id'];
if ( ! empty( $block['anchor'] ) ) {
	$ub_id = $block['anchor'];
}

$ub_align      = ! empty( $block['align'] ) ? 'align' . $block['align'] : 'alignfull';
$ub_class_name = 'block-value-prop ' . $ub_align . ' bg-white py-16 lg:py-24 w-full overflow-hidden ' . ( isset( $block['className'] ) ? $block['className'] : '' );

// ACF талбаруудыг унших.
$ub_headline    = get_field( 'vp_headline' );
$ub_description = get_field( 'vp_description' );
$ub_btn_label   = get_field( 'vp_btn_label' );
$ub_btn_url     = get_field( 'vp_btn_url' );
$ub_items       = get_field( 'vp_items' );

// Max Width Logic.
$ub_title_mw = get_field( 'vp_title_max_width' ) ?: 768;
$ub_desc_mw  = get_field( 'vp_description_max_width' ) ?: 720;

$ub_title_rem = ( $ub_title_mw / 16 ) . 'rem';
$ub_desc_rem  = ( $ub_desc_mw / 16 ) . 'rem';

// Блокны өгөгдөл хоосон байвал жишээ өгөгдөл эсвэл Default утгуудыг унших.
if ( empty( $ub_items ) ) {
	$ub_example_data = function_exists( 'ub_get_block_example_data' ) ? ub_get_block_example_data( $block ) : array();
	if ( ! empty( $ub_example_data ) ) {
		$ub_headline    = ! empty( $ub_headline ) ? $ub_headline : ( isset( $ub_example_data['vp_headline'] ) ? $ub_example_data['vp_headline'] : '' );
		$ub_description = ! empty( $ub_description ) ? $ub_description : ( isset( $ub_example_data['vp_description'] ) ? $ub_example_data['vp_description'] : '' );
		$ub_items       = isset( $ub_example_data['vp_items'] ) ? $ub_example_data['vp_items'] : array();
	}
}

/**
 * Иконуудыг дүрслэх туслах функц (SVG).
 */
if ( ! function_exists( 'site_render_vp_icon' ) ) {
	/**
	 * SVG icons-ийг хэвлдэг функц
	 *
	 * @param string $icon_name - Иконы нэр.
	 * @return string
	 */
	function site_render_vp_icon( $icon_name ) {
		switch ( $icon_name ) {
			case 'map-pin':
				return '<svg class="w-6 h-6 text-secondary" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M20 10c0 6-8 12-8 12s-8-6-8-12a8 8 0 0 1 16 0Z"/><circle cx="12" cy="10" r="3"/></svg>';
			case 'graduation-cap':
			case 'graduation-cap-alt':
				return '<svg class="w-6 h-6 text-secondary" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M22 10v6M2 10l10-5 10 5-10 5z"/><path d="M6 12v5c3 3 9 3 12 0v-5"/></svg>';
			case 'users':
				return '<svg class="w-6 h-6 text-secondary" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M22 21v-2a4 4 0 0 0-3-3.87"/><path d="M16 3.13a4 4 0 0 1 0 7.75"/></svg>';
			case 'clipboard-check':
				return '<svg class="w-6 h-6 text-secondary" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect width="8" height="4" x="8" y="2" rx="1" ry="1"/><path d="M16 4h2a2 2 0 0 1 2 2v14a2 2 0 0 1-2 2H6a2 2 0 0 1-2-2V6a2 2 0 0 1 2-2h2"/><path d="m9 14 2 2 4-4"/></svg>';
			default:
				return '<svg class="w-6 h-6 text-secondary" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"/><path d="m9 12 2 2 4-4"/></svg>';
		}
	}
}
?>

<section id="<?php echo esc_attr( $ub_id ); ?>" class="<?php echo esc_attr( $ub_class_name ); ?>">
	<div class="container">
		
		<!-- Section Header & Navigation (Synced with Trust Signals). -->
		<div class="flex flex-row gap-8 justify-between items-end mb-12">
			<div class="grow">
				<?php if ( $ub_headline ) : ?>
					<h2 class="mb-2 text-2xl font-bold tracking-tight leading-none lg:text-3xl text-primary" style="max-width: <?php echo esc_attr( $ub_title_rem ); ?>;">
						<?php echo esc_html( $ub_headline ); ?>
					</h2>
				<?php endif; ?>

				<?php if ( $ub_description ) : ?>
					<p class="mb-8 text-base opacity-80 text-slate-500 leading-tight leading-tight" style="max-width: <?php echo esc_attr( $ub_desc_rem ); ?>;">
						<?php echo wp_kses_post( $ub_description ); ?>
					</p>
				<?php endif; ?>

				<?php if ( $ub_btn_label && $ub_btn_url ) : ?>
					<div class="mt-8">
						<a href="<?php echo esc_url( $ub_btn_url ); ?>" class="inline-flex justify-center items-center px-8 h-12 text-sm font-bold text-white rounded-sm transition-all bg-primary hover:bg-primary-dark">
							<?php echo esc_html( $ub_btn_label ); ?>
						</a>
					</div>
				<?php endif; ?>
			</div>

			<!-- Carousel Navigation. -->
			<div data-value-prop-nav class="flex gap-2 items-center pb-2 transition-all duration-300 shrink">
				<button data-value-prop-prev class="flex justify-center items-center w-12 h-12 bg-white rounded-full border shadow-sm transition-all cursor-pointer border-slate-100 shadow-primary/5 group hover:bg-primary hover:border-primary">
					<svg class="w-5 h-5 transition-colors text-primary group-hover:text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path></svg>
				</button>
				<button data-value-prop-next class="flex justify-center items-center w-12 h-12 bg-white rounded-full border shadow-sm transition-all cursor-pointer border-slate-100 shadow-primary/5 group hover:bg-primary hover:border-primary">
					<svg class="w-5 h-5 transition-colors text-primary group-hover:text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
				</button>
			</div>
		</div>

		<!-- Swiper Component. -->
		<div class="swiper overflow-visible! group" data-value-prop-slider>
			<div class="swiper-wrapper flex! gap-[10px] group-[.swiper-initialized]:gap-0">
				<?php if ( ! empty( $ub_items ) ) : ?>
					<?php foreach ( $ub_items as $ub_item ) : ?>
						<?php
						$ub_custom_icon = isset( $ub_item['custom_icon'] ) ? $ub_item['custom_icon'] : '';
						$ub_icon_slug   = isset( $ub_item['icon'] ) ? $ub_item['icon'] : '';
						$ub_card_title  = isset( $ub_item['title'] ) ? $ub_item['title'] : '';
						$ub_card_desc   = isset( $ub_item['description'] ) ? $ub_item['description'] : '';
						$ub_card_link   = isset( $ub_item['link'] ) ? $ub_item['link'] : '';
						?>
						<div class="swiper-slide h-auto! flex! w-full max-w-[calc((88rem-30px)/4)]">
							<div class="flex relative flex-col justify-between pr-20 w-full h-full transition-all duration-500 block-value-prop__card group italic:not-italic">
								
								<!-- Icon. -->
								<div class="flex justify-center items-center w-12 h-12 transition-all duration-500 group-hover:scale-110">
									<?php
									if ( $ub_custom_icon ) {
										$ub_icon_url = wp_get_attachment_image_url( $ub_custom_icon, 'full' );
										?>
										<div class="w-12 h-12 bg-secondary" style="-webkit-mask-image: url('<?php echo esc_url( $ub_icon_url ); ?>'); mask-image: url('<?php echo esc_url( $ub_icon_url ); ?>'); -webkit-mask-size: contain; mask-size: contain; -webkit-mask-repeat: no-repeat; mask-repeat: no-repeat;"></div>
										<?php
									} else {
										echo wp_kses(
											site_render_vp_icon( $ub_icon_slug ),
											array(
												'svg'    => array(
													'class' => array(),
													'xmlns' => array(),
													'viewbox' => array(),
													'fill' => array(),
													'stroke' => array(),
													'stroke-width' => array(),
													'stroke-linecap' => array(),
													'stroke-linejoin' => array(),
												),
												'path'   => array(
													'd' => array(),
												),
												'circle' => array(
													'cx' => array(),
													'cy' => array(),
													'r'  => array(),
												),
												'rect'   => array(
													'width' => array(),
													'height' => array(),
													'x'  => array(),
													'y'  => array(),
													'rx' => array(),
													'ry' => array(),
												),
											)
										);
									}
									?>
								</div>

								<!-- Content. -->
								<div class="relative z-10 mt-10">
									<h3 class="mb-4 max-w-[200px] text-sm font-bold text-primary leading-none uppercase">
										<?php if ( $ub_card_link ) : ?>
											<a href="<?php echo esc_url( $ub_card_link ); ?>" class="transition-colors after:absolute after:inset-0 hover:text-secondary">
												<?php echo esc_html( $ub_card_title ); ?>
											</a>
										<?php else : ?>
											<?php echo esc_html( $ub_card_title ); ?>
										<?php endif; ?>
									</h3>
									<?php if ( $ub_card_desc ) : ?>
										<p class="max-w-[250px] text-xs font-medium leading-snug text-foreground/80">
											<?php echo wp_kses_post( $ub_card_desc ); ?>
										</p>
									<?php endif; ?>
								</div>

							</div>
						</div>
					<?php endforeach; ?>
				<?php endif; ?>
			</div>

			<!-- Pagination / ProgressBar. -->
			<div class="swiper-pagination static! ml-0 mt-16 max-w-xs overflow-hidden rounded-sm!" style="--swiper-pagination-progressbar-bg-color:#F1F5F9;--swiper-theme-color:#085399;"></div>
		</div>

	</div>
</section>
