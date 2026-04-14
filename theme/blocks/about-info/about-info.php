<?php
/**
 * About Info Block Template.
 *
 * @param array $block The block settings and attributes.
 *
 * @package aceedu
 */

$ub_id = 'about-info-' . $block['id'];
if ( ! empty( $block['anchor'] ) ) {
	$ub_id = $block['anchor'];
}

$ub_class_name = 'block-about-info alignfull py-16 bg-white lg:py-24 w-full';
if ( ! empty( $block['className'] ) ) {
	$ub_class_name .= ' ' . $block['className'];
}

// ACF Fields
$ub_title_left    = get_field( 'ub_about_info_title_left' );
$ub_description_l = get_field( 'ub_about_info_description_left' );
$ub_lead          = get_field( 'ub_about_info_lead' );
$ub_description_r = get_field( 'ub_about_info_description_right' );

$ub_headline_mw = get_field( 'ub_about_info_headline_mw' ) ?: 400;

// Convert to rem
$ub_headline_rem = ( $ub_headline_mw / 16 ) . 'rem';

// Preview fallback logic - More granular to ensure individual fields show dummy data if empty
if ( $is_preview ) {
	$ub_example_data  = function_exists( 'ub_get_block_example_data' ) ? ub_get_block_example_data( $block ) : array();
	$ub_title_left    = ! empty( $ub_title_left ) ? $ub_title_left : ( $ub_example_data['ub_about_info_title_left'] ?? 'ABOUT' );
	$ub_description_l = ! empty( $ub_description_l ) ? $ub_description_l : ( $ub_example_data['ub_about_info_description_left'] ?? '' );
	$ub_lead          = ! empty( $ub_lead ) ? $ub_lead : ( $ub_example_data['ub_about_info_lead'] ?? '' );
	$ub_description_r = ! empty( $ub_description_r ) ? $ub_description_r : ( $ub_example_data['ub_about_info_description_right'] ?? '' );
}
?>

<section id="<?php echo esc_attr( $ub_id ); ?>" class="<?php echo esc_attr( $ub_class_name ); ?>">
	<div class="container">
		<div class="flex flex-col gap-12 items-start lg:flex-row lg:gap-24">
			
			<!-- Left side: Headline & Description (Matching Testimonials Header Style) -->
			<div class="w-full lg:w-1/2">
				<?php if ( $ub_title_left ) : ?>
					<h2 class="mb-4 text-2xl font-bold leading-none text-primary lg:text-3xl" style="max-width: <?php echo esc_attr( $ub_headline_rem ); ?>;">
						<?php echo esc_html( $ub_title_left ); ?>
					</h2>
				<?php endif; ?>

				<?php if ( $ub_description_l ) : ?>
					<p class="text-sm font-medium leading-tight text-slate-500/80 lg:text-base" style="max-width: <?php echo esc_attr( $ub_headline_rem ); ?>;">
						<?php echo esc_html( $ub_description_l ); ?>
					</p>
				<?php endif; ?>
			</div>

			<!-- Right side: Content -->
			<div class="w-full lg:w-1/2">
				<?php if ( $ub_lead ) : ?>
					<div class="mb-6 text-xl font-light leading-tight text-secondary lg:text-2xl">
						<?php echo wp_kses_post( $ub_lead ); ?>
					</div>
				<?php endif; ?>

				<?php if ( ! empty( $ub_description_r ) ) : ?>
					<div class="leading-relaxed text-slate-500 prose">
						<?php echo wp_kses_post( $ub_description_r ); ?>
					</div>
				<?php endif; ?>
			</div>

		</div>
	</div>
</section>
