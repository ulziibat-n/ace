<?php
/**
 * Mission, Vision & Values Block Template.
 *
 * @param array $block The block settings and attributes.
 * @param string $content The block inner HTML (empty).
 * @param bool $is_preview True during AJAX preview.
 * @param (int|string) $post_id The post ID this block is saved to.
 *
 * @package aceedu
 */

// Блокийн ID болон ангиллыг тодорхойлох.
$ub_id = 'mvv-' . $block['id'];
if ( ! empty( $block['anchor'] ) ) {
	$ub_id = $block['anchor'];
}

$ub_class_name = 'block-mvv alignfull py-16 bg-slate-50 lg:py-24 w-full overflow-hidden';
if ( ! empty( $block['className'] ) ) {
	$ub_class_name .= ' ' . $block['className'];
}

// Талбаруудын утгыг авах.
$ub_headline    = get_field( 'ub_mvv_headline' );
$ub_description = get_field( 'ub_mvv_description' );
$ub_items       = get_field( 'ub_mvv_items' );
$ub_title_mw    = get_field( 'ub_mvv_title_max_width' ) ?: 768;
$ub_desc_mw     = get_field( 'ub_mvv_description_max_width' ) ?: 720;

$ub_title_rem = ( $ub_title_mw / 16 ) . 'rem';
$ub_desc_rem  = ( $ub_desc_mw / 16 ) . 'rem';

// Редактор дээр жишээ өгөгдөл харуулах.
if ( empty( $ub_items ) ) {
	$ub_example_data = function_exists( 'ub_get_block_example_data' ) ? ub_get_block_example_data( $block ) : array();
	$ub_headline     = ! empty( $ub_headline ) ? $ub_headline : ( $ub_example_data['ub_mvv_headline'] ?? '' );
	$ub_description  = ! empty( $ub_description ) ? $ub_description : ( $ub_example_data['ub_mvv_description'] ?? '' );
	$ub_items        = $ub_example_data['ub_mvv_items'] ?? array();
}
?>

<section id="<?php echo esc_attr( $ub_id ); ?>" class="<?php echo esc_attr( $ub_class_name ); ?>">
	<div class="container">
		
		<?php if ( $ub_headline || $ub_description ) : ?>
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
				<div data-mvv-nav class="flex gap-2 items-center pb-2 transition-all duration-300 shrink">
					<button data-mvv-prev class="flex justify-center items-center w-12 h-12 bg-white rounded-full border shadow-sm transition-all cursor-pointer border-slate-100 shadow-primary/5 group/btn hover:bg-primary hover:border-primary">
						<svg class="w-5 h-5 transition-colors text-primary group-hover/btn:text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path></svg>
					</button>
					<button data-mvv-next class="flex justify-center items-center w-12 h-12 bg-white rounded-full border shadow-sm transition-all cursor-pointer border-slate-100 shadow-primary/5 group/btn hover:bg-primary hover:border-primary">
						<svg class="w-5 h-5 transition-colors text-primary group-hover/btn:text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
					</button>
				</div>
			</div>
		<?php endif; ?>

		<div class="swiper overflow-visible! group" data-mvv-slider>
			<div class="swiper-wrapper gap-[10px] group-[.swiper-initialized]:gap-0">
				<?php if ( ! empty( $ub_items ) ) : ?>
					<?php foreach ( $ub_items as $ub_item ) : ?>
						<?php
						$ub_card_icon  = isset( $ub_item['icon'] ) ? $ub_item['icon'] : null;
						$ub_card_title = isset( $ub_item['title'] ) ? $ub_item['title'] : '';
						$ub_card_desc  = isset( $ub_item['description'] ) ? $ub_item['description'] : '';
						?>
						<div class="swiper-slide h-auto! flex! w-full max-w-[calc((90rem-20px)/3)]">
							<div data-card class="flex relative flex-col p-8 w-full bg-white rounded-sm transition-all duration-300 group/mvv-card">
								<!-- Icon Wrapper -->
								<?php if ( $ub_card_icon ) : ?>
									<div class="flex justify-center items-center mb-6 w-14 h-14 transition-colors rounded-xs bg-slate-50 text-primary group-hover/mvv-card:bg-primary group-hover/mvv-card:text-white">
										<?php echo wp_get_attachment_image( $ub_card_icon, 'thumbnail', false, array( 'class' => 'h-8 w-8 object-contain' ) ); ?>
									</div>
								<?php else : ?>
									<!-- Default Icon if none uploaded -->
									<div class="flex justify-center items-center mb-6 w-14 h-14 transition-colors rounded-xs bg-slate-50 text-primary group-hover/mvv-card:bg-primary group-hover/mvv-card:text-white">
										<svg class="w-8 h-8" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="m9 12 2 2 4-4"/><circle cx="12" cy="12" r="10"/></svg>
									</div>
								<?php endif; ?>

								<!-- Content -->
								<h3 class="mb-4 text-sm font-bold leading-none uppercase transition-colors group-hover/mvv-card:text-primary">
									<?php echo esc_html( $ub_card_title ); ?>
								</h3>
								
								<p class="leading-tight opacity-90 text-md text-foreground/70">
									<?php echo wp_kses_post( $ub_card_desc ); ?>
								</p>

								<!-- Decoration bit -->
								<div class="absolute bottom-0 left-0 w-0 h-1 transition-all duration-300 bg-primary group-hover/mvv-card:w-full"></div>
							</div>
						</div>
					<?php endforeach; ?>
				<?php endif; ?>
			</div>
		</div>

	</div>
</section>
