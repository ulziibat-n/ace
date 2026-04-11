<?php
/**
 * Hero Block Template.
 *
 * @param array $block The block settings and attributes.
 * @param string $content The block inner HTML (empty).
 * @param bool $is_preview True during AJAX preview.
 * @param  (int|string) $post_id The post ID this block is saved to.
 *
 * @package aceedu
 */

$ub_id = 'hero-' . $block['id'];
if ( ! empty( $block['anchor'] ) ) {
	$ub_id = $block['anchor'];
}

$ub_class_name = 'hero-block alignfull';
if ( ! empty( $block['className'] ) ) {
	$ub_class_name .= ' ' . $block['className'];
}

$ub_slides = get_field( 'slides' );

// Dynamic dummy content from block.json if fields are empty in preview.
if ( $is_preview && empty( $ub_slides ) ) {
	$ub_example_data = function_exists( 'ub_get_block_example_data' ) ? ub_get_block_example_data( $block ) : array();
	if ( ! empty( $ub_example_data['slides'] ) ) {
		$ub_slides = $ub_example_data['slides'];
	}
}

if ( ! $ub_slides ) {
	if ( $is_preview ) {
		echo '<div class="p-12 text-center rounded-sm border-2 border-dashed bg-slate-100 border-slate-300">Херо: Слайдуудаа оруулна уу. "Example" дата block.json-оос уншигдаж байна уу?</div>';
	}
	return;
}
?>

<section id="<?php echo esc_attr( $ub_id ); ?>" class="<?php echo esc_attr( $ub_class_name ); ?> relative overflow-hidden bg-neutral-900 text-white">
	<div class="swiper hero-swiper" data-hero-slider>
		<div class="swiper-wrapper">
			<?php foreach ( $ub_slides as $ub_slide ) : ?>
				<?php
				$ub_image       = isset( $ub_slide['image'] ) ? $ub_slide['image'] : null;
				$ub_title       = isset( $ub_slide['title'] ) ? $ub_slide['title'] : '';
				$ub_description = isset( $ub_slide['description'] ) ? $ub_slide['description'] : '';
				$ub_button      = isset( $ub_slide['button'] ) ? $ub_slide['button'] : null;

				// Handle case where image might be an ID or array.
				$ub_image_id  = 0;
				$ub_image_url = '';
				if ( is_array( $ub_image ) && isset( $ub_image['ID'] ) ) {
					$ub_image_id = $ub_image['ID'];
				} elseif ( is_numeric( $ub_image ) ) {
					$ub_image_id = $ub_image;
				} elseif ( is_array( $ub_image ) && isset( $ub_image['url'] ) ) {
					$ub_image_url = $ub_image['url'];
				}
				?>
				<div class="swiper-slide group/slide relative min-h-[600px] md:min-h-[700px] lg:min-h-[850px] flex flex-col justify-end overflow-hidden">
					<div class="absolute inset-0 z-0 transition-transform duration-8000 ease-out scale-110 group-[.swiper-slide-active]/slide:scale-100">
						<?php if ( $ub_image_id ) : ?>
							<?php echo wp_get_attachment_image( $ub_image_id, 'full', false, array( 'class' => 'w-full h-full absolute inset-0 z-10 object-cover' ) ); ?>
						<?php elseif ( $ub_image_url ) : ?>
							<img src="<?php echo esc_url( $ub_image_url ); ?>" class="object-cover absolute inset-0 z-10 w-full h-full" alt="">
						<?php endif; ?>
						<div class="absolute inset-0 z-20 to-slate-950/30 bg-linear-to-t from-slate-950/95"></div>
					</div>

					<div class="container relative z-30 pt-96 pb-20 w-full lg:pb-32">
						<div class="flex flex-col max-w-4xl">
							<?php if ( $ub_title ) : ?>
								<h2 class="opacity-0 translate-y-4 transition-all duration-500 delay-50 group-[.swiper-slide-active]/slide:opacity-100 group-[.swiper-slide-active]/slide:translate-y-0 text-4xl font-bold leading-none lg:text-6xl">
									<?php echo esc_html( $ub_title ); ?>
								</h2>
							<?php endif; ?>

							<?php if ( $ub_description ) : ?>
								<p class="opacity-0 translate-y-4 transition-all duration-500 delay-200 group-[.swiper-slide-active]/slide:opacity-100 group-[.swiper-slide-active]/slide:translate-y-0 mt-8 max-w-2xl text-base text-white lg:text-lg">
									<?php echo esc_html( $ub_description ); ?>
								</p>
							<?php endif; ?>
							
							<?php if ( $ub_button && isset( $ub_button['url'] ) ) : ?>
								<div class="opacity-0 translate-y-4 transition-all duration-500 delay-350 group-[.swiper-slide-active]/slide:opacity-100 group-[.swiper-slide-active]/slide:translate-y-0 flex flex-col items-start mt-10">
									<a href="<?php echo esc_url( $ub_button['url'] ); ?>" 
										target="<?php echo esc_attr( isset( $ub_button['target'] ) ? $ub_button['target'] : '_self' ); ?>"
										class="flex gap-4 items-center px-4 py-2 text-xs font-bold text-white shadow-lg transition-all duration-300 bg-primary hover:bg-primary-dark rounded-xs shadow-primary/20">
										<span class="text-xs leading-none"><?php echo esc_html( isset( $ub_button['title'] ) ? $ub_button['title'] : 'Дэлгэрэнгүй' ); ?></span>
										<svg class="w-4 h-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"><path d="M1.99974 13.0001L1.9996 11.0002L18.1715 11.0002L14.2218 7.05044L15.636 5.63623L22 12.0002L15.636 18.3642L14.2218 16.9499L18.1716 13.0002L1.99974 13.0001Z"></path></svg>
									</a>
								</div>
							<?php endif; ?>
						</div>
					</div>
				</div>
			<?php endforeach; ?>
		</div>
		
		<!-- Swiper Navigation/Pagination - Aligned with Testimonials Style -->
		<div class="container flex absolute bottom-12 left-1/2 z-40 flex-row gap-8 justify-between items-center -translate-x-1/2 pointer-events-none">
			<div class="swiper-pagination static! ml-0 grow max-w-xs overflow-hidden rounded-sm! pointer-events-auto" style="--swiper-pagination-progressbar-bg-color:rgba(255,255,255,0.2);--swiper-theme-color:#FFF;"></div>
			
			<div class="flex gap-2 items-center pointer-events-auto">
				<button data-hero-carousel-prev class="flex justify-center items-center w-12 h-12 rounded-full border shadow-sm backdrop-blur-md transition-all cursor-pointer bg-white/10 border-white/20 group hover:bg-white hover:border-white">
					<svg class="w-5 h-5 text-white transition-colors group-hover:text-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path></svg>
				</button>
				<button data-hero-carousel-next class="flex justify-center items-center w-12 h-12 rounded-full border shadow-sm backdrop-blur-md transition-all cursor-pointer bg-white/10 border-white/20 group hover:bg-white hover:border-white">
					<svg class="w-5 h-5 text-white transition-colors group-hover:text-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
				</button>
			</div>
		</div>
	</div>
</section>

<style>
/* Swiper Autoplay Progress Override */
.hero-block .swiper-pagination-progressbar-fill {
	transform: scaleX(var(--hero-autoplay-progress, 0)) !important;
	transform-origin: left !important;
	transition: none !important;
}
</style>
