<?php
/**
 * Core Pathways & Services Block Template (Carousel Redesign).
 *
 * @param array $block The block settings and attributes.
 * @param string $content The block inner HTML (empty).
 * @param bool $is_preview True during AJAX preview.
 * @param (int|string) $post_id The post ID this block is saved to.
 *
 * @package aceedu
 * @since 1.0.0
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$ub_id = 'block-core-pathways-' . $block['id'];
if ( ! empty( $block['anchor'] ) ) {
	$ub_id = $block['anchor'];
}

$ub_align      = ! empty( $block['align'] ) ? 'align' . $block['align'] : 'alignfull';
$ub_class_name = 'block-core-pathways ' . $ub_align . ' bg-slate-50 relative w-full overflow-hidden py-16 lg:py-24 ' . ( isset( $block['className'] ) ? $block['className'] : '' );

// ACF Fields.
$ub_title       = get_field( 'cp_title' );
$ub_description = get_field( 'cp_description' );
$ub_link        = get_field( 'cp_link' );
$ub_services    = get_field( 'cp_services' );

// Max Width Logic.
$ub_title_mw = get_field( 'cp_title_max_width' ) ?: 768;
$ub_desc_mw  = get_field( 'cp_description_max_width' ) ?: 720;

$ub_title_rem = ( $ub_title_mw / 16 ) . 'rem';
$ub_desc_rem  = ( $ub_desc_mw / 16 ) . 'rem';

// Dynamic dummy content from block.json if fields are empty in preview.
if ( $is_preview && empty( $ub_services ) ) {
	$ub_example_data = function_exists( 'ub_get_block_example_data' ) ? ub_get_block_example_data( $block ) : array();
	if ( ! empty( $ub_example_data ) ) {
		$ub_title       = ! empty( $ub_title ) ? $ub_title : ( isset( $ub_example_data['cp_title'] ) ? $ub_example_data['cp_title'] : '' );
		$ub_description = ! empty( $ub_description ) ? $ub_description : ( isset( $ub_example_data['cp_description'] ) ? $ub_example_data['cp_description'] : '' );
		$ub_services    = isset( $ub_example_data['cp_services'] ) ? $ub_example_data['cp_services'] : array();
	}
}

// Final Fallback for labels if still empty.
$ub_title       = ! empty( $ub_title ) ? $ub_title : 'Таны зорилгод нийцсэн цогц үйлчилгээнүүд';
$ub_description = ! empty( $ub_description ) ? $ub_description : 'Солонгос улсад суралцах таны мөрөөдлийг бодит болгохын тулд бид анхан шатны зөвлөгөөнөөс эхлээд онгоцноос буух хүртэлх бүх шатанд мэргэжлийн чиглүүлэг үзүүлдэг.';
?>

<section id="<?php echo esc_attr( $ub_id ); ?>" class="<?php echo esc_attr( $ub_class_name ); ?>">
	<div class="container">
		
		<!-- Header (Matching Testimonials Style) -->
		<div class="flex flex-row gap-8 justify-between items-end mb-12">
			<div class="grow">
				<?php if ( $ub_title ) : ?>
					<h2 class="mb-2 text-2xl font-bold tracking-tight leading-none lg:text-3xl text-slate-900" style="max-width: <?php echo esc_attr( $ub_title_rem ); ?>;"><?php echo esc_html( $ub_title ); ?></h2>
				<?php endif; ?>
				
				<?php if ( $ub_description ) : ?>
					<p class="mb-6 font-medium leading-tight text-slate-500/80" style="max-width: <?php echo esc_attr( $ub_desc_rem ); ?>;"><?php echo esc_html( $ub_description ); ?></p>
				<?php endif; ?>

				<?php if ( $ub_link ) : ?>
					<div class="inline-block">
						<a href="<?php echo esc_url( $ub_link['url'] ); ?>" 
							target="<?php echo esc_attr( $ub_link['target'] ? $ub_link['target'] : '_self' ); ?>"
							class="inline-flex gap-4 items-center px-4 py-2 text-xs font-bold text-white no-underline border shadow-lg transition-all duration-300 rounded-xs bg-primary border-primary shadow-primary/20 hover:bg-primary-dark">
							<?php echo esc_html( $ub_link['title'] ); ?>
							<svg class="w-4 h-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"><path d="M1.99974 13.0001L1.9996 11.0002L18.1715 11.0002L14.2218 7.05044L15.636 5.63623L22 12.0002L15.636 18.3642L14.2218 16.9499L18.1716 13.0002L1.99974 13.0001Z"></path></svg>
						</a>
					</div>
				<?php endif; ?>
			</div>

			<!-- Carousel Navigation. -->
			<div class="flex gap-2 items-center pb-2 shrink">
				<button data-core-pathways-carousel-prev class="flex justify-center items-center w-12 h-12 bg-white rounded-full border border-white shadow-sm transition-all cursor-pointer group shadow-primary/5 hover:border-primary hover:bg-primary">
					<svg class="w-5 h-5 transition-colors text-primary group-hover:text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path></svg>
				</button>
				<button data-core-pathways-carousel-next class="flex justify-center items-center w-12 h-12 bg-white rounded-full border border-white shadow-sm transition-all cursor-pointer group shadow-primary/5 hover:border-primary hover:bg-primary">
					<svg class="w-5 h-5 transition-colors text-primary group-hover:text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
				</button>
			</div>
		</div>

		<!-- Swiper Container. -->
		<div class="swiper group overflow-visible!" data-core-pathways-slider>
			<div class="swiper-wrapper flex! gap-[10px] group-[.swiper-initialized]:gap-0">
				<?php if ( ! empty( $ub_services ) ) : ?>
					<?php
					foreach ( $ub_services as $ub_service ) :
						$ub_s_title = isset( $ub_service['title'] ) ? $ub_service['title'] : '';
						$ub_s_desc  = isset( $ub_service['description'] ) ? $ub_service['description'] : '';
						$ub_s_icon  = isset( $ub_service['icon'] ) ? $ub_service['icon'] : 0; // Using this as Background Image.
						$ub_s_link  = isset( $ub_service['cta_link'] ) ? $ub_service['cta_link'] : null;

						$ub_bg_url = $ub_s_icon ? wp_get_attachment_image_url( $ub_s_icon, 'large' ) : 'https://placehold.co/600x800/085399/FFFFFF?text=ACE+EDU';
						?>
						<div class="swiper-slide flex h-auto! w-full max-w-[360px] flex-col">
							<div class="box-border flex overflow-hidden relative flex-col justify-end p-8 pt-72 w-full h-full rounded-sm transition-all duration-500 group/item grow bg-primary/10 hover:shadow-xl">
									<!-- Background Image. -->
									<div class="absolute inset-0 z-0">
										<img src="<?php echo esc_url( $ub_bg_url ); ?>" alt="<?php echo esc_attr( $ub_s_title ); ?>" class="absolute inset-0 object-cover w-full h-full! transition-transform duration-[2s] ease-[cubic-bezier(0.25,0.46,0.45,0.94)] group-hover/item:scale-105" />
										<!-- Overlay Gradient with Backdrop Blur (Bottom 50%). -->
										<div class="absolute inset-x-0 bottom-0 top-1/2 to-transparent bg-linear-to-t from-slate-900/95 via-slate-900/20 backdrop-blur-sm mask-[linear-gradient(to_top,black_40%,transparent_100%)]"></div>
									</div>
									<!-- Content (White Text on Overlay). -->
									<div class="flex relative z-10 flex-col w-full h-full">
										<div class="mt-auto w-full">
											<h3 class="mb-3 text-base font-bold leading-none text-white"><?php echo esc_html( $ub_s_title ); ?></h3>
								
											<?php if ( $ub_s_desc ) : ?>
												<p class="mb-4 text-sm font-medium leading-tight text-white/80 line-clamp-3"><?php echo esc_html( $ub_s_desc ); ?></p>
											<?php endif; ?>
											<!-- CTA. -->
											<?php if ( ! empty( $ub_s_link ) ) : ?>
												<a href="<?php echo esc_url( $ub_s_link['url'] ); ?>"
													target="<?php echo esc_attr( $ub_s_link['target'] ? $ub_s_link['target'] : '_self' ); ?>"
													class="inline-flex gap-3 items-center text-xs font-bold text-white no-underline transition-all hover:gap-4">
													<?php echo esc_html( $ub_s_link['title'] ? $ub_s_link['title'] : 'Дэлгэрэнгүй' ); ?>
													<svg class="w-4 h-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"><path d="M1.99974 13.0001L1.9996 11.0002L18.1715 11.0002L14.2218 7.05044L15.636 5.63623L22 12.0002L15.636 18.3642L14.2218 16.9499L18.1716 13.0002L1.99974 13.0001Z"></path></svg>
												</a>
											<?php else : ?>
												<span class="inline-flex gap-3 items-center text-xs font-bold text-white no-underline transition-all cursor-pointer hover:gap-4">
													Дэлгэрэнгүй
													<svg class="w-4 h-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"><path d="M1.99974 13.0001L1.9996 11.0002L18.1715 11.0002L14.2218 7.05044L15.636 5.63623L22 12.0002L15.636 18.3642L14.2218 16.9499L18.1716 13.0002L1.99974 13.0001Z"></path></svg>
												</span>
											<?php endif; ?>
										</div>
									</div>
								</div>
						</div>
					<?php endforeach; ?>
				<?php endif; ?>
			</div>
			
			<!-- Pagination (Progressbar). -->
			<div class="swiper-pagination static! mt-10 ml-0 max-w-xs overflow-hidden rounded-sm!" style="--swiper-pagination-progressbar-bg-color:#FFF;--swiper-theme-color:var(--color-primary);"></div>
		</div>

	</div>
</section>
