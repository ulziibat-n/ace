<?php
/**
 * Comparison Diff Block Template.
 *
 * @param array $block The block settings and attributes.
 * @param string $content The block inner HTML (empty).
 * @param bool $is_preview True during AJAX preview.
 * @param (int|string) $post_id The post ID this block is saved to.
 *
 * @package aceedu
 */

$ub_id = 'comparison-diff-' . $block['id'];
if ( ! empty( $block['anchor'] ) ) {
	$ub_id = $block['anchor'];
}

// Create class attribute allowing for custom "className" and "align" values.
$ub_class_name = 'block-comparison-diff alignfull py-16 lg:py-24 bg-white';
if ( ! empty( $block['className'] ) ) {
	$ub_class_name .= ' ' . $block['className'];
}

// ACF Fields
$ub_headline    = get_field( 'cd_headline' );
$ub_description = get_field( 'cd_description' );

$ub_left_title   = get_field( 'cd_left_title' );
$ub_left_content = get_field( 'cd_left_content' );

$ub_right_title   = get_field( 'cd_right_title' );
$ub_right_content = get_field( 'cd_right_content' );

$ub_title_mw = get_field( 'cd_title_max_width' ) ?: 768;
$ub_desc_mw  = get_field( 'cd_description_max_width' ) ?: 720;

$ub_title_rem = ( $ub_title_mw / 16 ) . 'rem';
$ub_desc_rem  = ( $ub_desc_mw / 16 ) . 'rem';

// Preview fallback
if ( empty( $ub_left_title ) && $is_preview ) {
	$ub_example_data  = function_exists( 'ub_get_block_example_data' ) ? ub_get_block_example_data( $block ) : array();
	$ub_headline      = $ub_example_data['cd_headline'] ?? 'Before & After (Үр дүнгийн харьцуулалт)';
	$ub_description   = $ub_example_data['cd_description'] ?? 'Энгийн орчуулсан эссе болон ACE-ийн менторын зассан эссений ялгааг харна уу.';
	$ub_left_title    = $ub_example_data['cd_left_title'] ?? 'Энгийн орчуулсан эссе';
	$ub_left_content  = $ub_example_data['cd_left_content'] ?? '';
	$ub_right_title   = $ub_example_data['cd_right_title'] ?? 'ACE Менторшип';
	$ub_right_content = $ub_example_data['cd_right_content'] ?? '';
}
?>

<section id="<?php echo esc_attr( $ub_id ); ?>" class="<?php echo esc_attr( $ub_class_name ); ?>">
	<div class="container">
		
		<?php if ( $ub_headline || $ub_description ) : ?>
			<div class="mb-12 text-center lg:mb-20">
				<?php if ( $ub_headline ) : ?>
					<h2 class="mx-auto mb-4 text-2xl font-bold tracking-tight text-primary lg:text-3xl" style="max-width: <?php echo esc_attr( $ub_title_rem ); ?>;">
						<?php echo esc_html( $ub_headline ); ?>
					</h2>
				<?php endif; ?>
				
				<?php if ( $ub_description ) : ?>
					<p class="mx-auto text-base opacity-80 text-slate-500 leading-tight leading-tight" style="max-width: <?php echo esc_attr( $ub_desc_rem ); ?>;">
						<?php echo wp_kses_post( $ub_description ); ?>
					</p>
				<?php endif; ?>
			</div>
		<?php endif; ?>

		<div class="grid grid-cols-1 gap-8 items-stretch lg:grid-cols-2 lg:gap-0 lg:rounded-sm lg:overflow-hidden lg:shadow-xl lg:border lg:border-slate-100">
			
			<!-- Left Side: Ordinary / Before -->
			<div class="flex flex-col p-8 bg-slate-50 rounded-sm lg:rounded-none lg:p-12">
				<div class="flex items-center mb-6">
					<div class="flex justify-center items-center mr-3 w-8 h-8 rounded-full bg-slate-200 text-slate-500">
						<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M18 6L6 18M6 6l12 12"></path></svg>
					</div>
					<h3 class="text-lg font-bold text-slate-800">
						<?php echo esc_html( $ub_left_title ); ?>
					</h3>
				</div>
				
				<div class="text-sm font-medium leading-relaxed italic text-slate-500/80 prose decoration-red-200 decoration-wavy underline-offset-4">
					<?php echo wp_kses_post( $ub_left_content ); ?>
				</div>
			</div>

			<!-- Right Side: ACE / After -->
			<div class="flex flex-col p-8 bg-primary rounded-sm lg:rounded-none lg:p-12">
				<div class="flex items-center mb-6">
					<div class="flex justify-center items-center mr-3 w-8 h-8 bg-white rounded-full text-primary shadow-lg">
						<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"><polyline points="20 6 9 17 4 12"></polyline></svg>
					</div>
					<h3 class="text-lg font-bold text-white">
						<?php echo esc_html( $ub_right_title ); ?>
					</h3>
				</div>
				
				<div class="text-sm font-medium leading-relaxed text-white prose prose-invert selection:bg-white/20 selection:text-white">
					<?php echo wp_kses_post( $ub_right_content ); ?>
				</div>

				<!-- Premium Badge -->
				<div class="self-start px-3 py-1 mt-auto text-[10px] font-bold tracking-wider uppercase bg-white/10 rounded-xs text-white/90 border border-white/20">
					ACE PREMIUM STANDARD
				</div>
			</div>

		</div>
	</div>
</section>
