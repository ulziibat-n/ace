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

// Max Width Logic.
$ub_title_mw = get_field( 'tm_title_max_width' ) ?: 768;
$ub_desc_mw  = get_field( 'tm_description_max_width' ) ?: 720;

$ub_title_rem = ( $ub_title_mw / 16 ) . 'rem';
$ub_desc_rem  = ( $ub_desc_mw / 16 ) . 'rem';

// Dynamic dummy content from block.json if fields are empty in preview.
if ( $is_preview && empty( $ub_testimonials ) ) {
	$ub_example_data = function_exists( 'ub_get_block_example_data' ) ? ub_get_block_example_data( $block ) : array();
	if ( ! empty( $ub_example_data ) ) {
		$ub_title        = ! empty( $ub_title ) ? $ub_title : ( isset( $ub_example_data['title'] ) ? $ub_example_data['title'] : '' );
		$ub_description  = ! empty( $ub_description ) ? $ub_description : ( isset( $ub_example_data['description'] ) ? $ub_example_data['description'] : '' );
		$ub_testimonials = isset( $ub_example_data['testimonials'] ) ? $ub_example_data['testimonials'] : array();
	}
}

// Final Fallback for labels if still empty.
$ub_title       = ! empty( $ub_title ) ? $ub_title : 'Бидний бахархал';
$ub_description = ! empty( $ub_description ) ? $ub_description : 'ACE EDU төвөөр дамжуулан Солонгос улсад амжилттай суралцаж буй оюутнуудын сэтгэгдэл.';

if ( empty( $ub_testimonials ) && $is_preview ) {
	echo '<div class="p-12 text-center border-2 border-dashed rounded-sm bg-slate-100 border-slate-300">Testimonials: Мэдээллээ оруулна уу.</div>';
	return;
}

$ub_id         = 'testimonials-' . $block['id'];
$ub_class_name = 'testimonials-block alignfull bg-slate-100 ' . ( isset( $block['className'] ) ? $block['className'] : '' );
?>
<section id="<?php echo esc_attr( $ub_id ); ?>" class="<?php echo esc_attr( $ub_class_name ); ?> relative w-full overflow-hidden py-16 lg:py-24">
	<div class="container">
		<div class="mb-12 flex flex-row items-end justify-between gap-8">
			<div class="grow">
				<?php if ( $ub_title ) : ?>
					<h2 class="mb-2 text-2xl font-bold tracking-tight lg:text-3xl leading-none" style="max-width: <?php echo esc_attr( $ub_title_rem ); ?>;"><?php echo esc_html( $ub_title ); ?></h2>
				<?php endif; ?>
				
				<?php if ( $ub_description ) : ?>
					<p class="mb-6 leading-tight font-medium text-foreground/60" style="max-width: <?php echo esc_attr( $ub_desc_rem ); ?>;"><?php echo esc_html( $ub_description ); ?></p>
				<?php endif; ?>

				<?php if ( $ub_link ) : ?>
					<div class="inline-block">
						<a href="<?php echo esc_url( $ub_link['url'] ); ?>" 
							target="<?php echo esc_attr( $ub_link['target'] ? $ub_link['target'] : '_self' ); ?>"
							class="inline-flex items-center gap-4 rounded-xs bg-primary px-4 py-2 text-xs font-bold text-white shadow-lg shadow-primary/20 transition-all duration-300 hover:bg-primary-dark">
							<?php echo esc_html( $ub_link['title'] ); ?>
							<svg class="h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"><path d="M1.99974 13.0001L1.9996 11.0002L18.1715 11.0002L14.2218 7.05044L15.636 5.63623L22 12.0002L15.636 18.3642L14.2218 16.9499L18.1716 13.0002L1.99974 13.0001Z"></path></svg>
						</a>
					</div>
				<?php endif; ?>
			</div>

			<!-- Carousel Navigation. -->
			<div class="flex shrink items-center gap-2 pb-2">
				<button data-testimonials-carousel-prev class="group flex h-12 w-12 cursor-pointer items-center justify-center rounded-full border border-white bg-white shadow-sm shadow-primary/5 transition-all hover:border-primary hover:bg-primary">
					<svg class="h-5 w-5 text-primary transition-colors group-hover:text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path></svg>
				</button>
				<button data-testimonials-carousel-next class="group flex h-12 w-12 cursor-pointer items-center justify-center rounded-full border border-white bg-white shadow-sm shadow-primary/5 transition-all hover:border-primary hover:bg-primary">
					<svg class="h-5 w-5 text-primary transition-colors group-hover:text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
				</button>
			</div>
		</div>

		<div class="swiper group overflow-visible!" data-testimonials-slider>
			<div class="swiper-wrapper flex! gap-[10px] group-[.swiper-initialized]:gap-0">
				<?php foreach ( $ub_testimonials as $item ) : ?>
					<div class="swiper-slide flex h-auto! w-full max-w-[300px] flex-col">
						<div class="group/item flex h-full grow flex-col justify-between gap-4 overflow-hidden rounded-sm border border-slate-50 bg-white p-6 transition-all duration-300 hover:shadow-md">
							<!-- Quote. -->
							<div class="relative grow text-sm leading-tight font-bold">
								<?php echo wp_kses( $item['quote'], array( 'p' => array() ) ); ?>
							</div>

							<!-- Card Header: Name/School and Image. -->
							<div class="mt-auto flex items-start justify-between border-t border-slate-50 pt-4">
								<div class="grow pr-4">
									<?php if ( ! empty( $item['family_member'] ) ) : ?>
										<p class="mb-1 text-sm leading-none font-bold"><?php echo esc_html( $item['family_member'] ); ?></p>
										<p class="mb-1 text-[0.65rem] leading-none font-medium text-foreground/60"><?php echo esc_html( $item['name'] ); ?></p>
									<?php else : ?>
										<p class="mb-1 text-sm leading-none font-bold"><?php echo esc_html( $item['name'] ); ?></p>
									<?php endif; ?>
									<p class="text-[0.65rem] leading-none font-bold text-primary uppercase"><?php echo esc_html( $item['school'] ); ?></p>
								</div>
								<?php if ( ! empty( $item['image'] ) ) : ?>
									<div class="shrink-0">
										<img class="h-10 w-10 rounded-full border-2 border-slate-50 object-cover shadow-sm" src="<?php echo esc_url( $item['image']['url'] ); ?>" alt="<?php echo esc_attr( $item['name'] ); ?>" />
									</div>
								<?php endif; ?>
							</div>
						</div>
					</div>
				<?php endforeach; ?>
			</div>
			
			<!-- Pagination. -->
			<div class="swiper-pagination static! mt-8 ml-0 max-w-xs overflow-hidden rounded-sm!" style="--swiper-pagination-progressbar-bg-color:#FFF;--swiper-theme-color:var(--color-primary);"></div>
		</div>
	</div>
</section>
