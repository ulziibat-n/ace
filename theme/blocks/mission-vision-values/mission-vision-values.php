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
$ub_title_mw    = get_field( 'ub_mvv_title_max_width' ) ?? 768;
$ub_desc_mw     = get_field( 'ub_mvv_description_max_width' ) ?? 720;

$ub_title_rem = ( $ub_title_mw / 16 ) . 'rem';
$ub_desc_rem  = ( $ub_desc_mw / 16 ) . 'rem';

// Check if items are actually filled (not just empty rows from sync).
$ub_has_real_items = false;
if ( ! empty( $ub_items ) ) {
	foreach ( $ub_items as $item ) {
		if ( ! empty( $item['title'] ) || ! empty( $item['description'] ) || ! empty( $item['icon'] ) ) {
			$ub_has_real_items = true;
			break;
		}
	}
}

// Редактор дээр жишээ өгөгдөл харуулах.
if ( ! $ub_has_real_items ) {
	$ub_example_data = function_exists( 'ub_get_block_example_data' ) ? ub_get_block_example_data( $block ) : array();
	$ub_headline     = ! empty( $ub_headline ) ? $ub_headline : ( $ub_example_data['ub_mvv_headline'] ?? '' );
	$ub_description  = ! empty( $ub_description ) ? $ub_description : ( $ub_example_data['ub_mvv_description'] ?? '' );
	$ub_items        = $ub_example_data['ub_mvv_items'] ?? array();
}
?>

<section id="<?php echo esc_attr( $ub_id ); ?>" class="<?php echo esc_attr( $ub_class_name ); ?>">
	<div class="container">
		
		<?php if ( $ub_headline || $ub_description ) : ?>
			<div class="mb-12 flex flex-row items-end justify-between gap-8">
				<div class="grow text-left">
					<?php if ( $ub_headline ) : ?>
						<h2 class="mb-3 text-2xl leading-none font-bold text-primary lg:text-3xl" style="max-width: <?php echo esc_attr( $ub_title_rem ); ?>;">
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
				<div data-mvv-nav class="flex shrink items-center gap-2 pb-2 transition-all duration-300">
					<button data-mvv-prev class="group/btn flex h-12 w-12 cursor-pointer items-center justify-center rounded-full border border-slate-100 bg-white shadow-sm shadow-primary/5 transition-all hover:border-primary hover:bg-primary">
						<svg class="h-5 w-5 text-primary transition-colors group-hover/btn:text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path></svg>
					</button>
					<button data-mvv-next class="group/btn flex h-12 w-12 cursor-pointer items-center justify-center rounded-full border border-slate-100 bg-white shadow-sm shadow-primary/5 transition-all hover:border-primary hover:bg-primary">
						<svg class="h-5 w-5 text-primary transition-colors group-hover/btn:text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
					</button>
				</div>
			</div>
		<?php endif; ?>

		<div class="swiper group overflow-visible!" data-mvv-slider>
			<div class="swiper-wrapper flex! gap-[10px] group-[.swiper-initialized]:gap-0">
				<?php if ( ! empty( $ub_items ) ) : ?>
					<?php foreach ( $ub_items as $ub_item ) : ?>
						<?php
						$ub_card_icon  = isset( $ub_item['icon'] ) ? $ub_item['icon'] : null;
						$ub_card_title = isset( $ub_item['title'] ) ? $ub_item['title'] : '';
						$ub_card_desc  = isset( $ub_item['description'] ) ? $ub_item['description'] : '';
						?>
						<div class="swiper-slide flex! h-auto! w-full max-w-[calc((88rem-20px)/3)]">
							<div data-card class="group/mvv-card relative flex w-full flex-col rounded-sm bg-white px-8 py-12 transition-all duration-300">
								<!-- Icon Wrapper -->
								<div class="mb-12">
									<?php if ( ! empty( $ub_card_icon ) ) : ?>
										<?php
										echo wp_get_attachment_image(
											$ub_card_icon,
											'full',
											false,
											array(
												'class' => 'h-12 w-12 object-contain filter-secondary transition-all duration-300',
												'style' => 'filter: invert(18%) sepia(88%) saturate(3619%) hue-rotate(345deg) brightness(85%) contrast(106%);',
											)
										);
										?>
									<?php else : ?>
										<!-- Default Icon if none uploaded -->
										<div class="text-secondary">
											<svg class="h-12 w-12" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
												<path d="m9 12 2 2 4-4"/><circle cx="12" cy="12" r="10"/>
											</svg>
										</div>
									<?php endif; ?>
								</div>

								<!-- Content -->
								<h3 class="mb-4 text-sm leading-none font-bold text-primary uppercase transition-colors group-hover/mvv-card:text-primary">
									<?php echo esc_html( $ub_card_title ); ?>
								</h3>
								
								<p class="text-sm leading-snug text-slate-500">
									<?php echo wp_kses_post( $ub_card_desc ); ?>
								</p>

								<!-- Decoration bit -->
								<div class="absolute bottom-0 left-0 h-1 w-0 bg-primary transition-all duration-300 group-hover/mvv-card:w-full"></div>
							</div>
						</div>
					<?php endforeach; ?>
				<?php endif; ?>
			</div>
		</div>

	</div>
</section>
