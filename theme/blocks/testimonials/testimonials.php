<?php
/**
 * Testimonials Carousel block template.
 *
 * @package aceedu
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

// Get ACF fields.
$ub_testimonials = get_field( 'testimonials' );
$ub_title        = get_field( 'title' );
$ub_description  = get_field( 'description' );
$ub_link         = get_field( 'link' );

if ( empty( $ub_testimonials ) && $is_preview ) {
	echo '<div class="p-12 text-center rounded-sm border-2 border-dashed bg-slate-100 border-slate-300">Мэдээллээ оруулна уу.</div>';
	return;
}

$ub_id         = 'testimonials-' . $block['id'];
$ub_class_name = 'testimonials-block alignfull bg-slate-100 ' . ( isset( $block['className'] ) ? $block['className'] : '' );
?>
<section id="<?php echo esc_attr( $ub_id ); ?>" class="<?php echo esc_attr( $ub_class_name ); ?> py-16 lg:py-24 relative w-full overflow-hidden">
	<div class="container">
		<div class="flex flex-row gap-8 justify-between items-end mb-12">
			<div class="max-w-xl grow">
				<?php if ( $ub_title ) : ?>
					<h2 class="mb-2 text-2xl font-bold tracking-tight lg:text-3xl"><?php echo esc_html( $ub_title ); ?></h2>
				<?php endif; ?>
				
				<?php if ( $ub_description ) : ?>
					<p class="mb-6 font-medium leading-tight text-foreground/60"><?php echo esc_html( $ub_description ); ?></p>
				<?php endif; ?>

				<?php if ( $ub_link ) : ?>
					<div class="inline-block">
						<a href="<?php echo esc_url( $ub_link['url'] ); ?>" 
							target="<?php echo esc_attr( $ub_link['target'] ? $ub_link['target'] : '_self' ); ?>"
							class="inline-flex gap-4 items-center px-4 py-2 text-xs font-bold text-white shadow-lg transition-all duration-300 bg-primary hover:bg-primary-dark rounded-xs shadow-primary/20">
							<?php echo esc_html( $ub_link['title'] ); ?>
							<svg class="w-4 h-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"><path d="M1.99974 13.0001L1.9996 11.0002L18.1715 11.0002L14.2218 7.05044L15.636 5.63623L22 12.0002L15.636 18.3642L14.2218 16.9499L18.1716 13.0002L1.99974 13.0001Z"></path></svg>
						</a>
					</div>
				<?php endif; ?>
			</div>

			<!-- Carousel Navigation. -->
			<div class="flex gap-2 items-center pb-2 shrink">
				<button data-testimonials-carousel-prev class="flex justify-center items-center w-12 h-12 bg-white rounded-full border border-white shadow-sm transition-all cursor-pointer shadow-primary/5 group hover:bg-primary hover:border-primary">
					<svg class="w-5 h-5 transition-colors text-primary group-hover:text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path></svg>
				</button>
				<button data-testimonials-carousel-next class="flex justify-center items-center w-12 h-12 bg-white rounded-full border border-white shadow-sm transition-all cursor-pointer shadow-primary/5 group hover:bg-primary hover:border-primary">
					<svg class="w-5 h-5 transition-colors text-primary group-hover:text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
				</button>
			</div>
		</div>

		<div class="swiper overflow-visible! group" data-testimonials-slider>
			<div class="swiper-wrapper flex! gap-[10px] group-[.swiper-initialized]:gap-0">
				<?php foreach ( $ub_testimonials as $item ) : ?>
					<div class="swiper-slide flex flex-col h-auto! w-full max-w-[300px]">
						<div class="flex overflow-hidden flex-col gap-4 justify-between p-6 h-full bg-white rounded-sm border transition-all duration-300 grow group/item hover:shadow-md border-slate-50">
							<!-- Quote. -->
							<div class="relative text-sm font-bold leading-tight grow">
								<?php echo wp_kses( $item['quote'], array( 'p' => array() ) ); ?>
							</div>

							<!-- Card Header: Name/School and Image. -->
							<div class="flex justify-between items-start pt-4 mt-auto border-t border-slate-50">
								<div class="pr-4 grow">
									<?php if ( ! empty( $item['family_member'] ) ) : ?>
										<p class="mb-1 text-sm font-bold leading-none"><?php echo esc_html( $item['family_member'] ); ?></p>
										<p class="text-[0.65rem] leading-none font-medium text-foreground/60 mb-1"><?php echo esc_html( $item['name'] ); ?></p>
									<?php else : ?>
										<p class="mb-1 text-sm font-bold leading-none"><?php echo esc_html( $item['name'] ); ?></p>
									<?php endif; ?>
									<p class="text-[0.65rem] leading-none font-bold text-primary uppercase"><?php echo esc_html( $item['school'] ); ?></p>
								</div>
								<?php if ( ! empty( $item['image'] ) ) : ?>
									<div class="shrink-0">
										<img class="object-cover w-10 h-10 rounded-full border-2 shadow-sm border-slate-50" src="<?php echo esc_url( $item['image']['url'] ); ?>" alt="<?php echo esc_attr( $item['name'] ); ?>" />
									</div>
								<?php endif; ?>
							</div>
						</div>
					</div>
				<?php endforeach; ?>
			</div>
			
			<!-- Pagination. -->
			<div class="swiper-pagination static! ml-0 mt-8 max-w-xs overflow-hidden rounded-sm!" style="--swiper-pagination-progressbar-bg-color:#FFF;--swiper-theme-color:var(--color-primary);"></div>
		</div>
	</div>
</section>
