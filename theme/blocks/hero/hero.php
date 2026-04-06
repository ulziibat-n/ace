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

if ( ! $ub_slides ) {
	if ( $is_preview ) {
		echo '<div class="p-12 text-center bg-slate-100 border-2 border-dashed border-slate-300 rounded-sm">Херо: Слайдуудаа оруулна уу.</div>';
	}
	return;
}
?>

<section id="<?php echo esc_attr( $ub_id ); ?>" class="<?php echo esc_attr( $ub_class_name ); ?> relative overflow-hidden bg-neutral-900 text-white">
	<div class="swiper hero-swiper" data-hero-slider>
		<div class="swiper-wrapper">
			<?php foreach ( $ub_slides as $ub_slide ) : ?>
				<?php
				$ub_image       = $ub_slide['image'];
				$ub_title       = $ub_slide['title'];
				$ub_description = $ub_slide['description'];
				$ub_button      = $ub_slide['button'];
				?>
				<div class="swiper-slide relative min-h-[600px] md:min-h-[700px] lg:min-h-[850px] flex flex-col justify-end">
					<?php if ( $ub_image ) : ?>
						<div class="absolute inset-0 z-0">
							<?php echo wp_get_attachment_image( $ub_image['ID'], 'full', false, array( 'class' => 'w-full h-full absolute inset-0 z-10 object-cover' ) ); ?>
							<div class="absolute inset-0 z-20 to-slate-950/30 bg-linear-to-t from-slate-950/95"></div>
						</div>
					<?php endif; ?>

					<div class="container relative z-30 pt-48 pb-16 lg:pt-72 lg:pb-32">
						<div class="max-w-4xl flex flex-col">
							<?php if ( $ub_title ) : ?>
								<h1 class="text-4xl font-bold leading-tight lg:text-6xl mb-0 animate-fade-in-up text-white">
									<?php echo esc_html( $ub_title ); ?>
								</h1>
							<?php endif; ?>

							<?php if ( $ub_description ) : ?>
								<p class="mt-8 text-lg max-w-2xl animate-fade-in-up delay-100 text-white">
									<?php echo esc_html( $ub_description ); ?>
								</p>
							<?php endif; ?>
							
							<?php if ( $ub_button ) : ?>
								<div class="mt-10 animate-fade-in-up delay-200">
									<a href="<?php echo esc_url( $ub_button['url'] ); ?>" 
										target="<?php echo esc_attr( $ub_button['target'] ? $ub_button['target'] : '_self' ); ?>"
										class="inline-flex items-center justify-center bg-primary hover:bg-primary-dark text-white px-6 py-2 rounded-xs font-bold transition-all duration-300 shadow-lg shadow-primary/20 transform hover:-translate-y-1 no-underline">
										<span class="uppercase leading-none text-xs"><?php echo esc_html( $ub_button['title'] ); ?></span>
									</a>
								</div>
							<?php endif; ?>
						</div>
					</div>
				</div>
			<?php endforeach; ?>
		</div>
		
		<!-- Swiper Navigation/Pagination -->
		<div class="swiper-pagination bottom-12! left-10! w-auto!"></div>
		<div class="swiper-button-next right-10! text-white! after:text-2xl!"></div>
		<div class="swiper-button-prev left-10! text-white! after:text-2xl!"></div>
	</div>
</section>

<style>
	.hero-block .swiper-pagination-bullet {
		background-color: white;
		opacity: 0.5;
		transition: all 0.3s ease;
	}
	.hero-block .swiper-pagination-bullet-active {
		background-color: var(--color-primary);
		width: 80px;
		opacity: 1;
	}
</style>

<script>
	document.addEventListener('DOMContentLoaded', function() {
		const heroSwiper = new Swiper('.hero-swiper', {
			loop: true,
			effect: 'slide',
			speed: 800,
			autoplay: {
				delay: 5000,
				disableOnInteraction: false,
			},
			pagination: {
				el: '.swiper-pagination',
				clickable: true,
			},
			navigation: {
				nextEl: '.swiper-button-next',
				prevEl: '.swiper-button-prev',
			},
		});
	});
</script>
