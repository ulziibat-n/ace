<?php
/**
 * Service Value Prop Block Template.
 *
 * @param array $block The block settings and attributes.
 * @param string $content The block inner HTML (empty).
 * @param bool $is_preview True during AJAX preview.
 * @param (int|string) $post_id The post ID this block is saved to.
 *
 * @package aceedu
 */

$ub_id = 'service-value-prop-' . $block['id'];
if ( ! empty( $block['anchor'] ) ) {
	$ub_id = $block['anchor'];
}

// Create class attribute allowing for custom "className" and "align" values.
$ub_class_name = 'block-service-value-prop alignfull py-16 lg:py-24 bg-white';
if ( ! empty( $block['className'] ) ) {
	$ub_class_name .= ' ' . $block['className'];
}

// ACF Fields.
$ub_badge       = get_field( 'svp_badge' );
$ub_headline    = get_field( 'svp_headline' );
$ub_description = get_field( 'svp_description' );
$ub_items       = get_field( 'svp_items' );
$ub_image       = get_field( 'svp_image' );
$ub_image_pos   = get_field( 'svp_image_position' ) ?? 'right';
$ub_headline_mw = get_field( 'svp_headline_mw' ) ?? 500;

$ub_headline_rem = ( $ub_headline_mw / 16 ) . 'rem';

// Preview fallback.
if ( empty( $ub_items ) && $is_preview ) {
	$ub_example_data = function_exists( 'ub_get_block_example_data' ) ? ub_get_block_example_data( $block ) : array();
	$ub_badge        = $ub_example_data['svp_badge'] ?? 'OUR VALUE';
	$ub_headline     = $ub_example_data['svp_headline'] ?? 'Бид хэрхэн туслах вэ?';
	$ub_description  = $ub_example_data['svp_description'] ?? 'Таны мөрөөдөлд хүрэх замыг бид дата аналитик болон стратегийн төлөвлөлтөөр хамгийн оновчтой болгоно.';
	$ub_items        = $ub_example_data['svp_items'] ?? array();
	$ub_image_pos    = $ub_example_data['svp_image_position'] ?? 'right';
}

$ub_flex_dir = 'lg:flex-row';
if ( 'left' === $ub_image_pos ) {
	$ub_flex_dir = 'lg:flex-row-reverse';
}
?>

<section id="<?php echo esc_attr( $ub_id ); ?>" class="<?php echo esc_attr( $ub_class_name ); ?>">
	<div class="container">
		<div class="<?php echo esc_attr( $ub_flex_dir ); ?> flex flex-col items-center gap-12 lg:gap-24">
			
			<!-- Content Side -->
			<div class="w-full lg:w-1/2">
				<?php if ( $ub_badge ) : ?>
					<span class="mb-4 inline-block text-xs font-bold tracking-widest text-primary uppercase">
						<?php echo esc_html( $ub_badge ); ?>
					</span>
				<?php endif; ?>

				<?php if ( $ub_headline ) : ?>
					<h2 class="mb-6 text-3xl leading-tight font-bold text-slate-900 lg:text-4xl" style="max-width: <?php echo esc_attr( $ub_headline_rem ); ?>;">
						<?php echo esc_html( $ub_headline ); ?>
					</h2>
				<?php endif; ?>

				<?php if ( $ub_description ) : ?>
					<p class="mb-10 text-base leading-relaxed text-slate-500 lg:text-lg">
						<?php echo wp_kses_post( $ub_description ); ?>
					</p>
				<?php endif; ?>

				<?php if ( ! empty( $ub_items ) ) : ?>
					<div class="space-y-8">
						<?php foreach ( $ub_items as $ub_item ) : ?>
							<div class="flex items-start gap-4">
								<div class="mt-1 flex h-6 w-6 shrink-0 items-center justify-center rounded-full bg-primary/10 text-primary">
									<svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"><polyline points="20 6 9 17 4 12"></polyline></svg>
								</div>
								<div>
									<h4 class="mb-1 text-base font-bold text-slate-900">
										<?php echo esc_html( $ub_item['title'] ); ?>
									</h4>
									<?php if ( ! empty( $ub_item['description'] ) ) : ?>
										<p class="text-sm leading-relaxed text-slate-500">
											<?php echo wp_kses_post( $ub_item['description'] ); ?>
										</p>
									<?php endif; ?>
								</div>
							</div>
						<?php endforeach; ?>
					</div>
				<?php endif; ?>
			</div>

			<!-- Image Side -->
			<div class="w-full lg:w-1/2">
				<div class="relative">
					<div class="relative z-10 aspect-4/3 w-full overflow-hidden rounded-sm shadow-2xl">
						<?php if ( $ub_image ) : ?>
							<?php echo wp_get_attachment_image( $ub_image, 'large', false, array( 'class' => 'w-full h-full object-cover' ) ); ?>
						<?php else : ?>
							<div class="flex h-full w-full items-center justify-center bg-slate-100">
								<svg class="h-20 w-20 text-slate-300" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
									<path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 002-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
								</svg>
							</div>
						<?php endif; ?>
					</div>
					<!-- Decorative Element -->
					<div class="absolute -top-6 -right-6 z-0 h-24 w-24 rounded-xs bg-secondary/20"></div>
					<div class="absolute -bottom-6 -left-6 z-0 h-32 w-32 rounded-xs bg-primary/5"></div>
				</div>
			</div>

		</div>
	</div>
</section>
