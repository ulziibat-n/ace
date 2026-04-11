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
				<div class="swiper-slide group/slide relative flex! flex-col justify-end overflow-hidden pt-76 lg:pt-60">
					<div class="absolute inset-0 z-0 scale-110 transition-transform duration-8000 ease-out group-[.swiper-slide-active]/slide:scale-100">
						<?php if ( $ub_image_id ) : ?>
							<?php echo wp_get_attachment_image( $ub_image_id, 'full', false, array( 'class' => 'w-full h-full absolute inset-0 z-10 object-cover' ) ); ?>
						<?php elseif ( $ub_image_url ) : ?>
							<img src="<?php echo esc_url( $ub_image_url ); ?>" class="absolute inset-0 z-10 h-full w-full object-cover" alt="">
						<?php endif; ?>
					</div>

						<div class="relative z-10 mt-auto mb-0 overflow-hidden">
							<!-- Gradient Backdrop Blur Overlay -->
							<div class="pointer-events-none absolute inset-0 z-0 mask-[linear-gradient(to_top,black_40%,transparent_100%)] backdrop-blur-xs"></div>
							
							<div class="absolute inset-0 z-0 bg-linear-to-t from-slate-950/70 to-slate-950/0"></div>
							
							<div class="relative z-10 container w-full py-20 lg:py-32">
								<div class="flex max-w-4xl flex-col">
									<?php if ( $ub_title ) : ?>
										<h2 class="translate-y-4 text-4xl leading-none font-bold text-white opacity-0 transition-all delay-50 duration-500 group-[.swiper-slide-active]/slide:translate-y-0 group-[.swiper-slide-active]/slide:opacity-100 lg:text-6xl">
											<?php echo esc_html( $ub_title ); ?>
										</h2>
									<?php endif; ?>
									<?php if ( $ub_description ) : ?>
										<p class="mt-8 max-w-2xl translate-y-4 text-base text-white opacity-0 transition-all delay-200 duration-500 group-[.swiper-slide-active]/slide:translate-y-0 group-[.swiper-slide-active]/slide:opacity-100 lg:text-lg">
											<?php echo esc_html( $ub_description ); ?>
										</p>
									<?php endif; ?>
							
									<?php if ( $ub_button && isset( $ub_button['url'] ) ) : ?>
										<div class="mt-10 flex translate-y-4 flex-col items-start opacity-0 transition-all delay-350 duration-500 group-[.swiper-slide-active]/slide:translate-y-0 group-[.swiper-slide-active]/slide:opacity-100">
											<a href="<?php echo esc_url( $ub_button['url'] ); ?>"
												target="<?php echo esc_attr( isset( $ub_button['target'] ) ? $ub_button['target'] : '_self' ); ?>"
												class="flex items-center gap-4 rounded-xs bg-primary px-4 py-2 text-xs font-bold text-white no-underline shadow-lg shadow-primary/20 transition-all duration-300 hover:bg-primary-dark">
												<span class="text-xs leading-none"><?php echo esc_html( isset( $ub_button['title'] ) ? $ub_button['title'] : 'Дэлгэрэнгүй' ); ?></span>
												<svg class="h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"><path d="M1.99974 13.0001L1.9996 11.0002L18.1715 11.0002L14.2218 7.05044L15.636 5.63623L22 12.0002L15.636 18.3642L14.2218 16.9499L18.1716 13.0002L1.99974 13.0001Z"></path></svg>
											</a>
										</div>
									<?php endif; ?>
								</div>
							</div>
						</div>
				</div>
			<?php endforeach; ?>
		</div>
		
		<!-- Swiper Navigation/Pagination - Aligned with Testimonials Style -->
		<div class="pointer-events-none absolute bottom-0 left-1/2 z-40 container flex -translate-x-1/2 flex-row items-end justify-between gap-8">
			<div class="swiper-pagination pointer-events-auto static! ml-0 max-w-xs grow overflow-hidden rounded-none [&_span]:rounded-none!" style="--swiper-pagination-progressbar-bg-color:rgba(255,255,255,0.9);--swiper-theme-color:var(--color-primary);"></div>
			
			<div class="pointer-events-auto flex items-center gap-2 pb-8">
				<button data-hero-carousel-prev class="group flex h-12 w-12 cursor-pointer items-center justify-center rounded-full border border-white/20 bg-white/10 shadow-sm backdrop-blur-md transition-all hover:border-white hover:bg-white">
					<svg class="h-5 w-5 text-white transition-colors group-hover:text-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path></svg>
				</button>
				<button data-hero-carousel-next class="group flex h-12 w-12 cursor-pointer items-center justify-center rounded-full border border-white/20 bg-white/10 shadow-sm backdrop-blur-md transition-all hover:border-white hover:bg-white">
					<svg class="h-5 w-5 text-white transition-colors group-hover:text-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
				</button>
			</div>
		</div>
	</div>
</section>

