<?php
/**
 * Service Features Block Template.
 *
 * @param array $block The block settings and attributes.
 * @param string $content The block inner HTML (empty).
 * @param bool $is_preview True during AJAX preview.
 * @param (int|string) $post_id The post ID this block is saved to.
 *
 * @package aceedu
 */

$ub_id = 'service-features-' . $block['id'];
if ( ! empty( $block['anchor'] ) ) {
	$ub_id = $block['anchor'];
}

// Create class attribute allowing for custom "className" and "align" values.
$ub_class_name = 'block-service-features alignfull py-16 lg:py-24 bg-white';
if ( ! empty( $block['className'] ) ) {
	$ub_class_name .= ' ' . $block['className'];
}

// ACF Fields
$ub_headline    = get_field( 'sf_headline' );
$ub_description = get_field( 'sf_description' );
$ub_items       = get_field( 'sf_items' );
$ub_cols        = get_field( 'sf_columns' ) ?: '3';

$ub_title_mw = get_field( 'sf_title_max_width' ) ?: 768;
$ub_desc_mw  = get_field( 'sf_description_max_width' ) ?: 720;

$ub_title_rem = ( $ub_title_mw / 16 ) . 'rem';
$ub_desc_rem  = ( $ub_desc_mw / 16 ) . 'rem';

// Preview fallback
if ( empty( $ub_items ) && $is_preview ) {
	$ub_example_data = function_exists( 'ub_get_block_example_data' ) ? ub_get_block_example_data( $block ) : array();
	$ub_headline     = $ub_example_data['sf_headline'] ?? 'Яагаад GKS гэж?';
	$ub_description  = $ub_example_data['sf_description'] ?? 'БНСУ-ын засгийн газрын тэтгэлэгт хөтөлбөрийн давуу талууд';
	$ub_items        = $ub_example_data['sf_items'] ?? array();
}

// Column classes.
$ub_grid_cols = 'md:grid-cols-3';
if ( '2' === $ub_cols ) {
	$ub_grid_cols = 'md:grid-cols-2';
} elseif ( '4' === $ub_cols ) {
	$ub_grid_cols = 'md:grid-cols-2 lg:grid-cols-4';
}
?>

<section id="<?php echo esc_attr( $ub_id ); ?>" class="<?php echo esc_attr( $ub_class_name ); ?>">
	<div class="container overflow-hidden">
		
		<?php if ( $ub_headline || $ub_description ) : ?>
			<div class="mb-12 text-center lg:mb-20">
				<?php if ( $ub_headline ) : ?>
					<h2 class="mx-auto mb-4 text-3xl font-bold tracking-tight text-primary lg:text-4xl" style="max-width: <?php echo esc_attr( $ub_title_rem ); ?>;">
						<?php echo esc_html( $ub_headline ); ?>
					</h2>
				<?php endif; ?>
				
				<?php if ( $ub_description ) : ?>
					<p class="mx-auto text-base opacity-80 text-slate-500 leading-tight leading-tight lg:text-lg" style="max-width: <?php echo esc_attr( $ub_desc_rem ); ?>;">
						<?php echo wp_kses_post( $ub_description ); ?>
					</p>
				<?php endif; ?>
			</div>
		<?php endif; ?>

		<?php if ( ! empty( $ub_items ) ) : ?>
			<div class="grid grid-cols-1 gap-[10px] <?php echo esc_attr( $ub_grid_cols ); ?>">
				<?php foreach ( $ub_items as $ub_item ) : ?>
					<?php
					$ub_card_icon  = isset( $ub_item['icon'] ) ? $ub_item['icon'] : '';
					$ub_card_title = isset( $ub_item['title'] ) ? $ub_item['title'] : '';
					$ub_card_desc  = isset( $ub_item['description'] ) ? $ub_item['description'] : '';
					?>
					<div class="flex flex-col p-8 w-full bg-slate-50 rounded-sm transition-all duration-300 group hover:bg-primary hover:-translate-y-1">
						<!-- Icon Wrapper -->
						<?php if ( $ub_card_icon ) : ?>
							<div class="flex justify-center items-center mb-6 w-14 h-14 bg-white rounded-xs border shadow-sm transition-colors border-slate-100 text-primary group-hover:border-white/20 group-hover:bg-white/10 group-hover:text-white">
								<?php
								// Supported icons as helper icons or simple text/SVG
								if ( strpos( $ub_card_icon, '<svg' ) !== false ) {
									echo $ub_card_icon;
								} else {
									// Default to graduation cap if it matches keywords
									$ub_icon_char = '🎓';
									if ( stripos( $ub_card_icon, 'plane' ) !== false ) {
										$ub_icon_char = '✈️';
									}
									if ( stripos( $ub_card_icon, 'bank' ) !== false ) {
										$ub_icon_char = '💰';
									}
									if ( stripos( $ub_card_icon, 'check' ) !== false ) {
										$ub_icon_char = '✅';
									}
									if ( stripos( $ub_card_icon, 'user' ) !== false ) {
										$ub_icon_char = '👤';
									}
									if ( stripos( $ub_card_icon, 'brain' ) !== false ) {
										$ub_icon_char = '🧠';
									}

									echo '<span class="text-2xl">' . $ub_icon_char . '</span>';
								}
								?>
							</div>
						<?php endif; ?>

						<!-- Content -->
						<h3 class="mb-4 text-xl font-bold leading-tight transition-colors text-slate-900 group-hover:text-white">
							<?php echo esc_html( $ub_card_title ); ?>
						</h3>
						
						<p class="text-sm font-medium leading-relaxed transition-colors text-slate-500 group-hover:text-white/80">
							<?php echo wp_kses_post( $ub_card_desc ); ?>
						</p>
					</div>
				<?php endforeach; ?>
			</div>
		<?php endif; ?>

	</div>
</section>
