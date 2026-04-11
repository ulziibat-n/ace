<?php
/**
 * CTA Banner Block Template.
 *
 * @param array  $block The block settings and attributes.
 * @param string $content The block inner HTML (empty).
 * @param bool   $is_preview True during AJAX preview.
 * @param (int|string) $post_id The post ID this block is saved to.
 *
 * @package aceedu
 */

$ub_id         = 'cta-banner-' . $block['id'];
$ub_class_name = 'cta-banner-block alignfull ' . ( isset( $block['className'] ) ? $block['className'] : '' );

// Fields.
$ub_title          = get_field( 'cta_title' );
$ub_description    = get_field( 'cta_description' );
$ub_link_1         = get_field( 'cta_link_1' );
$ub_link_2         = get_field( 'cta_link_2' );
$ub_show_globe     = get_field( 'cta_show_globe' );
$ub_title_mw       = get_field( 'cta_title_max_width' ) ? get_field( 'cta_title_max_width' ) : 960;
$ub_description_mw = get_field( 'cta_description_max_width' ) ? get_field( 'cta_description_max_width' ) : 720;

if ( null === $ub_show_globe ) {
	$ub_show_globe = true;
}

// Dynamic dummy content from block.json if fields are empty in preview.
if ( $is_preview && empty( $ub_title ) ) {
	$ub_example_data = function_exists( 'ub_get_block_example_data' ) ? ub_get_block_example_data( $block ) : array();
	if ( ! empty( $ub_example_data ) ) {
		$ub_title       = isset( $ub_example_data['cta_title'] ) ? $ub_example_data['cta_title'] : '';
		$ub_description = isset( $ub_example_data['cta_description'] ) ? $ub_example_data['cta_description'] : '';
		$ub_link_1      = isset( $ub_example_data['cta_link_1'] ) ? $ub_example_data['cta_link_1'] : null;
		$ub_link_2      = isset( $ub_example_data['cta_link_2'] ) ? $ub_example_data['cta_link_2'] : null;
	}
}
?>

<section id="<?php echo esc_attr( $ub_id ); ?>" class="<?php echo esc_attr( $ub_class_name ); ?> relative overflow-hidden bg-primary py-16 text-white lg:py-24">
	<!-- Subtle Globe Icon. -->
	<?php if ( $ub_show_globe ) : ?>
		<div class="pointer-events-none absolute top-[-10%] right-[-10%] h-[400px] w-[400px] opacity-10 lg:h-[600px] lg:w-[600px]">
			<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" class="h-full w-full text-white">
				<circle cx="12" cy="12" r="10"></circle>
				<line x1="2" y1="12" x2="22" y2="12"></line>
				<path d="M12 2a15.3 15.3 0 0 1 4 10 15.3 15.3 0 0 1-4 10 15.3 15.3 0 0 1-4-10 15.3 15.3 0 0 1 4-10z"></path>
			</svg>
		</div>
	<?php endif; ?>

	<div class="relative z-10 container">
		<div class="mx-auto flex max-w-4xl flex-col items-center text-center">
			<?php if ( $ub_title ) : ?>
				<h2 class="mx-auto mb-3 text-2xl leading-tight font-bold text-white lg:text-3xl" 
					style="max-width: <?php echo esc_attr( $ub_title_mw ); ?>px;">
					<?php echo esc_html( $ub_title ); ?>
				</h2>
			<?php endif; ?>

			<?php if ( $ub_description ) : ?>
				<p class="mx-auto mb-6 text-base text-white opacity-90" 
					style="max-width: <?php echo esc_attr( $ub_description_mw ); ?>px;">
					<?php echo esc_html( $ub_description ); ?>
				</p>
			<?php endif; ?>

			<!-- Buttons Container. -->
			<div class="mt-4 flex flex-col items-center justify-center gap-3 sm:flex-row">
				<?php if ( $ub_link_1 ) : ?>
					<a href="<?php echo esc_url( $ub_link_1['url'] ); ?>" 
						target="<?php echo esc_attr( isset( $ub_link_1['target'] ) ? $ub_link_1['target'] : '_self' ); ?>"
						class="inline-flex min-w-[140px] items-center justify-center rounded-xs border border-white bg-white px-6 py-2 font-bold text-primary no-underline shadow-xl shadow-black/5 transition-all duration-300 hover:bg-slate-100">
						<!-- Speech Bubble Icon. -->
						<svg class="mr-3 h-4 w-4 text-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
							<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"></path>
						</svg>
						<span class="text-xs leading-none text-primary uppercase"><?php echo esc_html( ( isset( $ub_link_1['title'] ) && $ub_link_1['title'] ) ? $ub_link_1['title'] : 'Чат бичих' ); ?></span>
					</a>
				<?php endif; ?>

				<?php if ( $ub_link_2 ) : ?>
					<a href="<?php echo esc_url( $ub_link_2['url'] ); ?>" 
						target="<?php echo esc_attr( isset( $ub_link_2['target'] ) ? $ub_link_2['target'] : '_self' ); ?>"
						class="inline-flex min-w-[140px] items-center justify-center rounded-xs border-2 border-white/30 bg-transparent px-6 py-2 font-bold text-white no-underline transition-all duration-300 hover:bg-white/10">
						<!-- Phone Icon. -->
						<svg class="mr-3 h-5 w-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
							<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path>
						</svg>
						<span class="text-xs leading-none text-white uppercase"><?php echo esc_html( ( isset( $ub_link_2['title'] ) && $ub_link_2['title'] ) ? $ub_link_2['title'] : '8800-****' ); ?></span>
					</a>
				<?php endif; ?>
			</div>
		</div>
	</div>
</section>
