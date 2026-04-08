<?php
/**
 * FAQ Block Template.
 *
 * @param array  $block The block settings and attributes.
 * @param string $content The block inner HTML (empty).
 * @param bool   $is_preview True during AJAX preview.
 * @param (int|string) $post_id The post ID this block is saved to.
 *
 * @package aceedu
 */

$ub_id         = 'faq-' . $block['id'];
$ub_class_name = 'faq-block alignfull ' . ( isset( $block['className'] ) ? $block['className'] : '' );

// Fields.
$ub_title          = get_field( 'faq_title' );
$ub_description    = get_field( 'faq_description' );
$ub_items          = get_field( 'faq_items' );
$ub_title_mw       = get_field( 'faq_title_max_width' ) ? get_field( 'faq_title_max_width' ) : 960;
$ub_description_mw = get_field( 'faq_description_max_width' ) ? get_field( 'faq_description_max_width' ) : 720;

// Dynamic dummy content from block.json if fields are empty in preview.
if ( $is_preview && empty( $ub_title ) && empty( $ub_items ) ) {
	$ub_example_data = function_exists( 'ub_get_block_example_data' ) ? ub_get_block_example_data( $block ) : array();
	if ( ! empty( $ub_example_data ) ) {
		$ub_title       = isset( $ub_example_data['faq_title'] ) ? $ub_example_data['faq_title'] : '';
		$ub_description = isset( $ub_example_data['faq_description'] ) ? $ub_example_data['faq_description'] : '';
		$ub_items       = isset( $ub_example_data['faq_items'] ) ? $ub_example_data['faq_items'] : array();
	}
}
?>

<section id="<?php echo esc_attr( $ub_id ); ?>" class="<?php echo esc_attr( $ub_class_name ); ?> py-16 lg:py-24 bg-white">
	<div class="container">
		<!-- Header -->
		<div class="flex flex-col items-center text-center mb-16 px-4">
			<?php if ( $ub_title ) : ?>
				<h2 class="text-2xl lg:text-3xl font-black text-slate-900 leading-tight mb-4 mx-auto" 
					style="max-width: <?php echo esc_attr( $ub_title_mw ); ?>px;">
					<?php echo esc_html( $ub_title ); ?>
				</h2>
			<?php endif; ?>

			<?php if ( $ub_description ) : ?>
				<p class="text-base text-slate-500 mx-auto" 
					style="max-width: <?php echo esc_attr( $ub_description_mw ); ?>px;">
					<?php echo esc_html( $ub_description ); ?>
				</p>
			<?php endif; ?>
		</div>

		<!-- Accordion Items -->
		<div class="max-w-4xl mx-auto flex flex-col gap-4">
			<?php if ( $ub_items ) : ?>
				<?php foreach ( $ub_items as $ub_item ) : ?>
					<?php 
					$ub_question = isset( $ub_item['question'] ) ? $ub_item['question'] : '';
					$ub_answer   = isset( $ub_item['answer'] ) ? $ub_item['answer'] : '';
					?>
					<?php if ( $ub_question ) : ?>
						<details class="group bg-slate-50 rounded-xl transition-all duration-300 hover:bg-slate-100/50">
							<summary class="flex items-center justify-between py-4 px-5 cursor-pointer list-none list-item-none [&::-webkit-details-marker]:hidden">
								<h3 class="text-base font-bold text-slate-900 pr-8">
									<?php echo esc_html( $ub_question ); ?>
								</h3>
								<div class="shrink-0 transition-transform duration-300 group-open:rotate-180">
									<svg class="w-5 h-5 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
										<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
									</svg>
								</div>
							</summary>
							<div class="px-5 pb-4 pt-0 animate-fade-in text-slate-600 leading-relaxed text-base prose prose-sm prose-slate max-w-none">
								<?php echo wp_kses_post( $ub_answer ); ?>
							</div>
						</details>
					<?php endif; ?>
				<?php endforeach; ?>
			<?php endif; ?>
		</div>
	</div>
</section>

<style>
/* Hide the default arrow in Safari/Chrome */
details summary::-webkit-details-marker {
  display: none;
}
@keyframes faq_fade_in {
	from { opacity: 0; transform: translateY(-5px); }
	to { opacity: 1; transform: translateY(0); }
}
.animate-fade-in {
	animation: faq_fade_in 0.3s ease-out forwards;
}
</style>
