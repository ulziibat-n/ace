<?php
/**
 * Process Roadmap Block Template.
 *
 * @param array $block The block settings and attributes.
 *
 * @package aceedu
 */

$ub_id = 'process-roadmap-' . $block['id'];
if ( ! empty( $block['anchor'] ) ) {
	$ub_id = $block['anchor'];
}

$ub_class_name = 'block-process-roadmap alignfull py-16 bg-white lg:py-24 w-full overflow-hidden relative';
if ( ! empty( $block['className'] ) ) {
	$ub_class_name .= ' ' . $block['className'];
}

// Талбаруудын утгыг авах.
$ub_headline    = get_field( 'pr_headline' );
$ub_description = get_field( 'pr_description' );
$ub_items       = get_field( 'pr_items' );
$ub_title_mw    = get_field( 'pr_title_max_width' ) ?? 768;
$ub_desc_mw     = get_field( 'pr_description_max_width' ) ?? 720;

$ub_title_rem = ( $ub_title_mw / 16 ) . 'rem';
$ub_desc_rem  = ( $ub_desc_mw / 16 ) . 'rem';

// Редактор дээр жишээ өгөгдөл харуулах.
if ( empty( $ub_items ) ) {
	$ub_example_data = function_exists( 'ub_get_block_example_data' ) ? ub_get_block_example_data( $block ) : array();
	$ub_headline     = ! empty( $ub_headline ) ? $ub_headline : ( $ub_example_data['pr_headline'] ?? 'Алхам алхмаар үйл явц' );
	$ub_description  = ! empty( $ub_description ) ? $ub_description : ( $ub_example_data['pr_description'] ?? 'Бид таныг бүх шатанд бүрэн чиглүүлнэ.' );
	$ub_items        = $ub_example_data['pr_items'] ?? array();
}
?>

<section id="<?php echo esc_attr( $ub_id ); ?>" class="<?php echo esc_attr( $ub_class_name ); ?>">
	<div class="container">
		
		<!-- Header & Navigation (Synced with Testimonials layout). -->
		<div class="flex flex-row gap-8 justify-between items-end mb-16">
			<div class="text-left grow">
				<?php if ( $ub_headline ) : ?>
					<h2 class="mb-2 text-2xl font-bold tracking-tight leading-none lg:text-3xl text-primary" style="max-width: <?php echo esc_attr( $ub_title_rem ); ?>;">
						<?php echo esc_html( $ub_headline ); ?>
					</h2>
				<?php endif; ?>

				<?php if ( $ub_description ) : ?>
					<p class="text-base leading-tight opacity-80 text-slate-500 mt-4" style="max-width: <?php echo esc_attr( $ub_desc_rem ); ?>;">
						<?php echo wp_kses_post( $ub_description ); ?>
					</p>
				<?php endif; ?>
			</div>

			<!-- Carousel Navigation. -->
			<div data-process-nav class="flex gap-2 items-center pb-2 transition-all duration-300 shrink">
				<button data-process-prev class="flex justify-center items-center w-12 h-12 bg-white rounded-full border border-white shadow-sm transition-all cursor-pointer shadow-primary/5 group/btn hover:border-primary hover:bg-primary">
					<svg class="w-5 h-5 transition-colors text-primary group-hover/btn:text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path></svg>
				</button>
				<button data-process-next class="flex justify-center items-center w-12 h-12 bg-white rounded-full border border-white shadow-sm transition-all cursor-pointer shadow-primary/5 group/btn hover:border-primary hover:bg-primary">
					<svg class="w-5 h-5 transition-colors text-primary group-hover/btn:text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
				</button>
			</div>
		</div>

		<!-- Swiper Component. -->
		<div class="swiper overflow-visible! group" data-process-slider>
			<div class="swiper-wrapper flex! gap-0">
				<?php if ( ! empty( $ub_items ) ) : ?>
					<?php foreach ( $ub_items as $ub_index => $ub_item ) : ?>
						<?php
						$ub_title = isset( $ub_item['title'] ) ? $ub_item['title'] : '';
						$ub_desc  = isset( $ub_item['description'] ) ? $ub_item['description'] : '';
						$ub_step  = sprintf( '%02d', $ub_index + 1 );
						?>
						<div class="swiper-slide h-auto! flex! w-full max-w-[calc((88rem-20px)/3)] pr-8 pb-8 border-b border-primary/10 relative group/process-step">
							<!-- Marker Dot Wrapper -->		
							<div class="absolute bottom-0 left-0 z-10 -mb-1.5 w-3 h-3 rounded-full border transition-all duration-300 border-primary bg-primary group-[.swiper-slide-active]/process-step:scale-125 group-[.swiper-slide-active]/process-step:bg-secondary group-[.swiper-slide-active]/process-step:border-secondary"></div>
									
							<div class="flex flex-col pr-12 w-full h-full transition-all duration-500 italic:not-italic group-hover/process-step:translate-y-[-4px]">
								
								<!-- Content -->
								<div class="relative z-10 mb-12 grow">
									<h3 class="mb-4 text-sm font-bold leading-none uppercase transition-colors duration-500 text-primary">
										<?php echo esc_html( $ub_title ); ?>
									</h3>
									<?php if ( $ub_desc ) : ?>
										<p class="text-base leading-snug text-slate-500">
											<?php echo wp_kses_post( $ub_desc ); ?>
										</p>
									<?php endif; ?>
								</div>

								<!-- Step Number (Positioned at the bottom like milestones year) -->
								<div class="mt-auto text-3xl font-light tracking-tighter leading-none transition-all duration-500 text-primary group-[.swiper-slide-active]/process-step:text-secondary group-hover/process-step:text-secondary">
									<?php echo esc_html( $ub_step ); ?>
								</div>

							</div>
						</div>
					<?php endforeach; ?>
				<?php endif; ?>
			</div>
			
		</div>

	</div>
</section>
