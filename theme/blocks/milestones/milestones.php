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

$ub_class_name = 'block-milestones alignfull py-16 bg-white lg:py-24 w-full overflow-hidden relative';
if ( ! empty( $block['className'] ) ) {
	$ub_class_name .= ' ' . $block['className'];
}

// Талбаруудын утгыг авах.
$ub_headline    = get_field( 'ub_milestones_headline' );
$ub_description = get_field( 'ub_milestones_description' );
$ub_items       = get_field( 'ub_milestones_items' );
$ub_title_mw    = get_field( 'ub_milestones_title_max_width' ) ?? 768;
$ub_desc_mw     = get_field( 'ub_milestones_description_max_width' ) ?? 720;

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
		
		<!-- Header & Navigation (Synced with Value Prop). -->
		<div class="flex flex-row gap-8 justify-between items-end mb-16">
			<div class="text-left grow">
				<?php if ( $ub_headline ) : ?>
					<h2 class="mb-2 text-2xl font-bold tracking-tight leading-none lg:text-3xl text-primary" style="max-width: <?php echo esc_attr( $ub_title_rem ); ?>;">
						<?php echo esc_html( $ub_headline ); ?>
					</h2>
				<?php endif; ?>

				<?php if ( $ub_description ) : ?>
					<p class="text-base opacity-80 text-slate-500 leading-tight leading-tight" style="max-width: <?php echo esc_attr( $ub_desc_rem ); ?>;">
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

		<!-- Swiper Component. -->
		<div class="swiper overflow-visible! group/milestone-slider" data-milestones-slider>
			<div class="swiper-wrapper flex! gap-0">
				<?php if ( ! empty( $ub_items ) ) : ?>
					<?php foreach ( $ub_items as $ub_item ) : ?>
						<?php
						$ub_year    = isset( $ub_item['year'] ) ? $ub_item['year'] : '';
						$ub_m_title = isset( $ub_item['title'] ) ? $ub_item['title'] : '';
						$ub_m_desc  = isset( $ub_item['description'] ) ? $ub_item['description'] : '';
						?>
						<div class="swiper-slide h-auto! flex! w-full max-w-[calc((88rem-30px)/4)] pr-8 pb-8 border-b border-primary/10 relative group/milestone">
							<!-- Marker Dot Wrapper (Center the dot vertically for line alignment) -->		
							<div class="absolute bottom-0 left-0 z-10 -mb-1.5 w-3 h-3 rounded-full border transition-all duration-300 border-primary bg-primary group-[.swiper-slide-active]/milestone:scale-125 group-[.swiper-slide-active]/milestone:bg-secondary group-[.swiper-slide-active]/milestone:border-secondary"></div>
									
							<div class="flex flex-col pr-12 w-full h-full transition-all duration-500 italic:not-italic">
								
								<!-- Content (Following Value Prop Typography) -->
								<div class="relative z-10 mb-12 grow">
									<h3 class="mb-2 text-sm font-bold leading-none uppercase transition-colors duration-500 text-primary">
										<?php echo esc_html( $ub_m_title ); ?>
									</h3>
									<?php if ( $ub_m_desc ) : ?>
										<p class="max-w-[250px] text-sm font-medium leading-snug text-slate-500">
											<?php echo wp_kses_post( $ub_m_desc ); ?>
										</p>
									<?php endif; ?>
								</div>

								<!-- Year (Positioned at the very bottom) -->
								<div class="mt-auto text-3xl font-light tracking-tighter leading-none transition-all duration-500 text-primary group-[.swiper-slide-active]/milestone:text-secondary">
									<?php echo esc_html( $ub_year ); ?>
								</div>

							</div>
						</div>
					<?php endforeach; ?>
				<?php endif; ?>
			</div>
			
		</div>

	</div>
</section>
