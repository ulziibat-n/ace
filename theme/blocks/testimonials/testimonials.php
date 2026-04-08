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
	echo '<div class="p-12 text-center bg-slate-100 border-2 border-dashed border-slate-300 rounded-sm">Мэдээллээ оруулна уу.</div>';
	return;
}

$ub_id         = 'testimonials-' . $block['id'];
$ub_class_name = 'testimonials-block alignfull bg-slate-100 ' . ( isset( $block['className'] ) ? $block['className'] : '' );
?>
<section id="<?php echo esc_attr( $ub_id ); ?>" class="<?php echo esc_attr( $ub_class_name ); ?> py-16 lg:py-24 relative w-full overflow-hidden">
	<div class="container">
		<div class="flex flex-col lg:flex-row gap-8 justify-between items-end mb-12">
			<div class="max-w-xl grow">
				<?php if ( $ub_title ) : ?>
					<h2 class="mb-2 text-2xl font-bold tracking-tight lg:text-3xl"><?php echo esc_html( $ub_title ); ?></h2>
				<?php endif; ?>
				
				<?php if ( $ub_description ) : ?>
					<p class="font-medium leading-tight text-foreground/60 mb-6"><?php echo esc_html( $ub_description ); ?></p>
				<?php endif; ?>

				<?php if ( $ub_link ) : ?>
					<div class="inline-block">
						<a href="<?php echo esc_url( $ub_link['url'] ); ?>" 
							target="<?php echo esc_attr( $ub_link['target'] ? $ub_link['target'] : '_self' ); ?>"
							class="inline-flex items-center px-4 py-2 text-xs font-bold text-white shadow-lg transition-all duration-300 bg-primary hover:bg-primary-dark rounded-xs shadow-primary/20">
							<?php echo esc_html( $ub_link['title'] ); ?>
							<svg class="w-3 h-3 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"></path></svg>
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

		<div class="swiper overflow-visible!" data-testimonials-slider>
			<div class="swiper-wrapper flex!">
				<?php foreach ( $ub_testimonials as $item ) : ?>
					<div class="swiper-slide flex flex-col h-auto!">
						<div class="bg-white rounded-sm overflow-hidden grow flex flex-col gap-4 justify-between p-6 h-full transition-all duration-300 group/item hover:shadow-md border border-slate-50">
							<!-- Quote. -->
							<blockquote class="font-bold text-sm leading-tight relative grow">
								<?php echo wp_kses( $item['quote'], array( 'p' => array() ) ); ?>
							</blockquote>

							<!-- Card Header: Name/School and Image. -->
							<div class="flex justify-between items-start mt-auto pt-4 border-t border-slate-50">
								<div class="grow pr-4">
									<?php if ( ! empty( $item['family_member'] ) ) : ?>
										<p class="font-bold leading-none text-sm mb-1"><?php echo esc_html( $item['family_member'] ); ?></p>
										<p class="text-[0.65rem] leading-none font-medium text-foreground/60 mb-1"><?php echo esc_html( $item['name'] ); ?></p>
									<?php else : ?>
										<p class="font-bold leading-none text-sm mb-1"><?php echo esc_html( $item['name'] ); ?></p>
									<?php endif; ?>
									<p class="text-[0.65rem] leading-none font-bold text-primary uppercase"><?php echo esc_html( $item['school'] ); ?></p>
								</div>
								<?php if ( ! empty( $item['image'] ) ) : ?>
									<div class="shrink-0">
										<img class="w-10 h-10 rounded-full object-cover border-2 border-slate-50 shadow-sm" src="<?php echo esc_url( $item['image']['url'] ); ?>" alt="<?php echo esc_attr( $item['name'] ); ?>" />
									</div>
								<?php endif; ?>
							</div>
						</div>
					</div>
				<?php endforeach; ?>
			</div>
			
			<!-- Pagination. -->
			<div class="swiper-pagination !static mt-8 max-w-xs overflow-hidden !rounded-sm" style="--swiper-pagination-progressbar-bg-color:#FFF;"></div>
		</div>
	</div>
</section>
