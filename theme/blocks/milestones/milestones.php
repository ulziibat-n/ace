<?php
/**
 * Milestones Block Template.
 *
 * @param array $block The block settings and attributes.
 *
 * @package aceedu
 */

$ub_id = 'milestones-' . $block['id'];
if ( ! empty( $block['anchor'] ) ) {
	$ub_id = $block['anchor'];
}

$ub_class_name = 'block-milestones alignfull py-16 bg-white lg:py-24 w-full overflow-hidden';
if ( ! empty( $block['className'] ) ) {
	$ub_class_name .= ' ' . $block['className'];
}

// Талбаруудын утгыг авах.
$ub_headline    = get_field( 'ub_milestones_headline' );
$ub_description = get_field( 'ub_milestones_description' );
$ub_items       = get_field( 'ub_milestones_items' );
$ub_title_mw    = get_field( 'ub_milestones_title_max_width' ) ?: 768;
$ub_desc_mw     = get_field( 'ub_milestones_description_max_width' ) ?: 720;

$ub_title_rem = ( $ub_title_mw / 16 ) . 'rem';
$ub_desc_rem  = ( $ub_desc_mw / 16 ) . 'rem';

// Редактор дээр жишээ өгөгдөл харуулах.
if ( empty( $ub_items ) ) {
	$ub_example_data = function_exists( 'ub_get_block_example_data' ) ? ub_get_block_example_data( $block ) : array();
	$ub_headline     = ! empty( $ub_headline ) ? $ub_headline : ( $ub_example_data['ub_milestones_headline'] ?? '' );
	$ub_description  = ! empty( $ub_description ) ? $ub_description : ( $ub_example_data['ub_milestones_description'] ?? '' );
	$ub_items        = $ub_example_data['ub_milestones_items'] ?? array();
}
?>

<section id="<?php echo esc_attr( $ub_id ); ?>" class="<?php echo esc_attr( $ub_class_name ); ?>">
	<div class="container">
		
		<!-- Header & Nav -->
		<div class="flex flex-row gap-8 justify-between items-end mb-12">
			<div class="text-left grow">
				<?php if ( $ub_headline ) : ?>
					<h2 class="mb-3 text-2xl font-bold leading-tight text-primary lg:text-3xl" style="max-width: <?php echo esc_attr( $ub_title_rem ); ?>;">
						<?php echo esc_html( $ub_headline ); ?>
					</h2>
				<?php endif; ?>

				<?php if ( $ub_description ) : ?>
					<p class="text-base opacity-80 text-slate-500" style="max-width: <?php echo esc_attr( $ub_desc_rem ); ?>;">
						<?php echo wp_kses_post( $ub_description ); ?>
					</p>
				<?php endif; ?>
			</div>

			<!-- Carousel Navigation. -->
			<div data-milestones-nav class="flex gap-2 items-center pb-2 transition-all duration-300 shrink">
				<button data-milestones-prev class="flex justify-center items-center w-12 h-12 bg-white rounded-full border shadow-sm transition-all cursor-pointer border-slate-100 shadow-primary/5 group/btn hover:bg-primary hover:border-primary">
					<svg class="w-5 h-5 transition-colors text-primary group-hover/btn:text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path></svg>
				</button>
				<button data-milestones-next class="flex justify-center items-center w-12 h-12 bg-white rounded-full border shadow-sm transition-all cursor-pointer border-slate-100 shadow-primary/5 group/btn hover:bg-primary hover:border-primary">
					<svg class="w-5 h-5 transition-colors text-primary group-hover/btn:text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
				</button>
			</div>
		</div>

		<!-- Swiper Container. -->
		<div class="swiper overflow-visible! group" data-milestones-slider>
			<div class="swiper-wrapper flex! gap-[10px] group-[.swiper-initialized]:gap-0">
				<?php if ( ! empty( $ub_items ) ) : ?>
					<?php foreach ( $ub_items as $ub_item ) : ?>
						<?php
						$ub_year = isset( $ub_item['year'] ) ? $ub_item['year'] : '';
						$ub_m_title = isset( $ub_item['title'] ) ? $ub_item['title'] : '';
						$ub_m_desc  = isset( $ub_item['description'] ) ? $ub_item['description'] : '';
						?>
						<div class="swiper-slide h-auto! flex! w-full max-w-[calc((90rem-30px)/4)]">
							<div data-card class="relative flex flex-col justify-between p-8 w-full h-full bg-white border shadow-sm transition-all duration-500 rounded-sm italic:not-italic border-primary/10 shadow-primary/0 in-[.swiper-slide-active]:bg-primary in-[.swiper-slide-active]:text-white in-[.swiper-slide-active]:border-transparent in-[.swiper-slide-active]:shadow-primary/10 in-[.swiper-slide-active]:shadow-md group">
								
								<!-- Year Header -->
								<div class="mb-6 text-3xl font-light leading-none tracking-tighter transition-colors duration-500 text-primary in-[.swiper-slide-active]:text-white">
									<?php echo esc_html( $ub_year ); ?>
								</div>

								<!-- Content. -->
								<div class="relative z-10">
									<h3 class="mb-3 text-base font-bold leading-tight transition-colors duration-500 text-slate-900 in-[.swiper-slide-active]:text-white">
										<?php echo esc_html( $ub_m_title ); ?>
									</h3>
									<?php if ( $ub_m_desc ) : ?>
										<p class="text-xs font-medium leading-relaxed transition-colors duration-500 text-slate-500 in-[.swiper-slide-active]:text-white/80">
											<?php echo wp_kses_post( $ub_m_desc ); ?>
										</p>
									<?php endif; ?>
								</div>

							</div>
						</div>
					<?php endforeach; ?>
				<?php endif; ?>
			</div>
			
			<!-- Pagination (Progressbar). -->
			<div class="swiper-pagination static! mt-10 ml-0 max-w-xs overflow-hidden rounded-sm!" style="--swiper-pagination-progressbar-bg-color:#F1F5F9;--swiper-theme-color:#085399;"></div>
		</div>

	</div>
</section>
