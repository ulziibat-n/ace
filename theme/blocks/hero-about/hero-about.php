<?php
/**
 * Hero About Block Template.
 *
 * @param array $block The block settings and attributes.
 * @param string $content The block inner HTML (empty).
 * @param bool $is_preview True during AJAX preview.
 * @param (int|string) $post_id The post ID this block is saved to.
 *
 * @package aceedu
 */

// Блокийн ID болон ангиллыг тодорхойлох.
$ub_id = 'hero-about-' . $block['id'];
if ( ! empty( $block['anchor'] ) ) {
	$ub_id = $block['anchor'];
}

$ub_class_name = 'hero-about-block alignfull';
if ( ! empty( $block['className'] ) ) {
	$ub_class_name .= ' ' . $block['className'];
}

// Талбаруудын утгыг авах.
$ub_title       = get_field( 'ub_hero_about_title' );
$ub_description = get_field( 'ub_hero_about_description' );
$ub_visual_type = get_field( 'ub_hero_about_visual_type' ) ?: 'image';
$ub_image       = get_field( 'ub_hero_about_image' );
$ub_video_file  = get_field( 'ub_hero_about_video_file' );
$ub_video_url   = get_field( 'ub_hero_about_video_url' );
$ub_button      = get_field( 'ub_hero_about_primary_cta' );
$ub_title_mw    = get_field( 'ub_hero_about_title_max_width' ) ?: 896;
$ub_desc_mw     = get_field( 'ub_hero_about_description_max_width' ) ?: 672;

// Convert px to rem for better accessibility/responsiveness.
$ub_title_mw_rem = ( $ub_title_mw / 16 ) . 'rem';
$ub_desc_mw_rem  = ( $ub_desc_mw / 16 ) . 'rem';

// Редактор дээр жишээ өгөгдөл харуулах.
if ( $is_preview && empty( $ub_title ) ) {
	$ub_example_data = function_exists( 'ub_get_block_example_data' ) ? ub_get_block_example_data( $block ) : array();
	$ub_title        = $ub_example_data['ub_hero_about_title'] ?? '';
	$ub_description  = $ub_example_data['ub_hero_about_description'] ?? '';
	$ub_image        = $ub_example_data['ub_hero_about_image'] ?? null;
	$ub_visual_type  = $ub_example_data['ub_hero_about_visual_type'] ?? 'image';
}

// Визуал контентыг бэлдэх.
$ub_image_id  = 0;
$ub_image_url = '';
if ( is_array( $ub_image ) && isset( $ub_image['ID'] ) ) {
	$ub_image_id = $ub_image['ID'];
} elseif ( is_numeric( $ub_image ) ) {
	$ub_image_id = (int) $ub_image;
} elseif ( is_array( $ub_image ) && isset( $ub_image['url'] ) ) {
	$ub_image_url = $ub_image['url'];
}
?>

<section id="<?php echo esc_attr( $ub_id ); ?>" class="<?php echo esc_attr( $ub_class_name ); ?> relative overflow-hidden bg-slate-950 pt-72 text-white flex flex-col justify-end">
	
	<!-- Background Visual -->
	<div class="overflow-hidden absolute inset-0 z-0">
		<!-- Animation wrapper: Subtle zoom out effect on load -->
		<div class="w-full h-full">
			<?php if ( 'image' === $ub_visual_type ) : ?>
				<?php if ( $ub_image_id ) : ?>
					<?php echo wp_get_attachment_image( $ub_image_id, 'full', false, array( 'class' => 'w-full h-full object-cover' ) ); ?>
				<?php elseif ( $ub_image_url ) : ?>
					<img src="<?php echo esc_url( $ub_image_url ); ?>" class="object-cover w-full h-full" alt="">
				<?php endif; ?>
			<?php else : ?>
				<?php if ( $ub_video_file ) : ?>
					<video autoplay muted loop playsinline class="object-cover w-full h-full">
						<source src="<?php echo esc_url( $ub_video_file['url'] ); ?>" type="video/mp4">
					</video>
				<?php elseif ( $ub_video_url ) : ?>
					<?php
					// YouTube URL-ийг embed формат руу хөрвүүлэх (Simple version).
					$ub_embed_url = str_replace( 'watch?v=', 'embed/', $ub_video_url );
					$ub_embed_url = add_query_arg(
						array(
							'autoplay' => 1,
							'mute'     => 1,
							'controls' => 0,
							'loop'     => 1,
							'playlist' => str_replace( 'https://www.youtube.com/embed/', '', $ub_embed_url ),
						),
						$ub_embed_url
					);
					?>
					<iframe src="<?php echo esc_url( $ub_embed_url ); ?>" class="absolute inset-0 w-full h-full scale-150 pointer-events-none" frameborder="0" allow="autoplay; fullscreen" allowfullscreen></iframe>
				<?php endif; ?>
			<?php endif; ?>
		</div>
	</div>

	<div class="relative py-20 w-full lg:py-32">
		<!-- Overlays matching content-single.php -->
		<div class="pointer-events-none absolute inset-0 z-10 mask-[linear-gradient(to_top,black_40%,transparent_100%)] backdrop-blur-xs"></div>
		<div class="absolute inset-0 z-10 bg-linear-to-t from-slate-950/95 to-slate-950/0"></div>

		<!-- Content -->
		<div class="container relative z-20">
			<div class="space-y-6 lg:space-y-8">
				<?php if ( $ub_title ) : ?>
					<h2 class="text-4xl font-bold leading-none text-white animate-fade-up lg:text-6xl" style="max-width: <?php echo esc_attr( $ub_title_mw_rem ); ?>;">
						<?php echo esc_html( $ub_title ); ?>
					</h2>
				<?php endif; ?>

				<?php if ( $ub_description ) : ?>
					<p class="text-lg opacity-90 delay-200 animate-fade-up text-slate-200 lg:text-xl" style="max-width: <?php echo esc_attr( $ub_desc_mw_rem ); ?>;">
						<?php echo esc_html( $ub_description ); ?>
					</p>
				<?php endif; ?>

				<?php if ( $ub_button && isset( $ub_button['url'] ) ) : ?>
					<div class="animate-fade-up delay-400">
						<a href="<?php echo esc_url( $ub_button['url'] ); ?>"
							target="<?php echo esc_attr( $ub_button['target'] ?: '_self' ); ?>"
							class="inline-flex gap-4 items-center px-8 py-4 text-sm font-bold text-white no-underline shadow-lg transition-all duration-300 rounded-xs bg-primary shadow-primary/20 hover:bg-primary-dark hover:scale-105">
							<span><?php echo esc_html( $ub_button['title'] ?: 'Дэлгэрэнгүй' ); ?></span>
							<svg class="w-5 h-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor">
								<path d="M1.99974 13.0001L1.9996 11.0002L18.1715 11.0002L14.2218 7.05044L15.636 5.63623L22 12.0002L15.636 18.3642L14.2218 16.9499L18.1716 13.0002L1.99974 13.0001Z"></path>
							</svg>
						</a>
					</div>
				<?php endif; ?>
			</div>
		</div>
	</div>

</section>
