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
		<div class="mb-16 flex flex-row items-end justify-between gap-8">
			<div class="grow text-left">
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
			</div>

			<!-- Carousel Navigation. -->
			<div data-milestones-nav class="flex shrink items-center gap-2 pb-2 transition-all duration-300">
				<button data-milestones-prev class="group/btn flex h-12 w-12 cursor-pointer items-center justify-center rounded-full border border-slate-100 bg-white shadow-sm shadow-primary/5 transition-all hover:border-primary hover:bg-primary">
					<svg class="h-5 w-5 text-primary transition-colors group-hover/btn:text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path></svg>
				</button>
				<button data-milestones-next class="group/btn flex h-12 w-12 cursor-pointer items-center justify-center rounded-full border border-slate-100 bg-white shadow-sm shadow-primary/5 transition-all hover:border-primary hover:bg-primary">
					<svg class="h-5 w-5 text-primary transition-colors group-hover/btn:text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
				</button>
			</div>
		</div>

		<!-- Swiper Component. -->
		<div class="swiper group/milestone-slider overflow-visible!" data-milestones-slider>
			<div class="swiper-wrapper flex! gap-0">
				<?php if ( ! empty( $ub_items ) ) : ?>
					<?php foreach ( $ub_items as $ub_item ) : ?>
						<?php
						$ub_year    = isset( $ub_item['year'] ) ? $ub_item['year'] : '';
						$ub_m_title = isset( $ub_item['title'] ) ? $ub_item['title'] : '';
						$ub_m_desc  = isset( $ub_item['description'] ) ? $ub_item['description'] : '';
						?>
						<div class="swiper-slide group/milestone relative flex! h-auto! w-full max-w-[calc((88rem-30px)/4)] border-b border-primary/10 pr-8 pb-8">
							<!-- Marker Dot Wrapper (Center the dot vertically for line alignment) -->		
							<div class="absolute bottom-0 left-0 z-10 -mb-1.5 h-3 w-3 rounded-full border border-primary bg-primary transition-all duration-300 group-[.swiper-slide-active]/milestone:scale-125 group-[.swiper-slide-active]/milestone:border-secondary group-[.swiper-slide-active]/milestone:bg-secondary"></div>
									
							<div class="italic:not-italic flex h-full w-full flex-col pr-12 transition-all duration-500">
								
								<!-- Content (Following Value Prop Typography) -->
								<div class="relative z-10 mb-12 grow">
									<h3 class="mb-2 text-sm leading-none font-bold text-primary uppercase transition-colors duration-500">
										<?php echo esc_html( $ub_m_title ); ?>
									</h3>
									<?php if ( $ub_m_desc ) : ?>
										<p class="max-w-[250px] text-sm leading-snug font-medium text-slate-500">
											<?php echo wp_kses_post( $ub_m_desc ); ?>
										</p>
									<?php endif; ?>
								</div>

								<!-- Year (Positioned at the very bottom) -->
								<div class="mt-auto text-3xl leading-none font-light tracking-tighter text-primary transition-all duration-500 group-[.swiper-slide-active]/milestone:text-secondary">
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
