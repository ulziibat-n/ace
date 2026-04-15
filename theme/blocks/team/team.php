<?php
/**
 * Team Block Template.
 *
 * @param array $block The block settings and attributes.
 *
 * @package aceedu
 */

$ub_id = 'team-' . $block['id'];
if ( ! empty( $block['anchor'] ) ) {
	$ub_id = $block['anchor'];
}

$ub_class_name = 'block-team alignfull py-16 bg-slate-50 lg:py-24 w-full overflow-hidden';
if ( ! empty( $block['className'] ) ) {
	$ub_class_name .= ' ' . $block['className'];
}

// Талбаруудын утгыг авах.
$ub_headline    = get_field( 'ub_team_headline' );
$ub_description = get_field( 'ub_team_description' );
$ub_members     = get_field( 'ub_team_members' );
$ub_title_mw    = get_field( 'ub_team_title_max_width' ) ?? 768;
$ub_desc_mw     = get_field( 'ub_team_description_max_width' ) ?? 720;

$ub_title_rem = ( $ub_title_mw / 16 ) . 'rem';
$ub_desc_rem  = ( $ub_desc_mw / 16 ) . 'rem';

// Редактор дээр жишээ өгөгдөл харуулах.
if ( empty( $ub_members ) ) {
	$ub_example_data = function_exists( 'ub_get_block_example_data' ) ? ub_get_block_example_data( $block ) : array();
	$ub_headline     = ! empty( $ub_headline ) ? $ub_headline : ( $ub_example_data['ub_team_headline'] ?? '' );
	$ub_description  = ! empty( $ub_description ) ? $ub_description : ( $ub_example_data['ub_team_description'] ?? '' );
	$ub_members      = $ub_example_data['ub_team_members'] ?? array();
}
?>

<section id="<?php echo esc_attr( $ub_id ); ?>" class="<?php echo esc_attr( $ub_class_name ); ?>">
	<div class="container">
		
		<!-- Header & Nav -->
		<div class="mb-12 flex flex-row items-end justify-between gap-8">
			<div class="grow text-left">
				<?php if ( $ub_headline ) : ?>
					<h2 class="mb-3 text-2xl leading-none font-bold text-primary lg:text-3xl" style="max-width: <?php echo esc_attr( $ub_title_rem ); ?>;">
						<?php echo esc_html( $ub_headline ); ?>
					</h2>
				<?php endif; ?>

				<?php if ( $ub_description ) : ?>
					<p class="mt-4 text-base leading-tight text-slate-500 opacity-80" style="max-width: <?php echo esc_attr( $ub_desc_rem ); ?>;">
						<?php echo wp_kses_post( $ub_description ); ?>
					</p>
				<?php endif; ?>
			</div>

			<!-- Carousel Navigation. -->
			<div data-team-nav class="flex shrink items-center gap-2 pb-2 transition-all duration-300">
				<button data-team-prev class="group/btn flex h-12 w-12 cursor-pointer items-center justify-center rounded-full border border-slate-100 bg-white shadow-sm shadow-primary/5 transition-all hover:border-primary hover:bg-primary">
					<svg class="h-5 w-5 text-primary transition-colors group-hover/btn:text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path></svg>
				</button>
				<button data-team-next class="group/btn flex h-12 w-12 cursor-pointer items-center justify-center rounded-full border border-slate-100 bg-white shadow-sm shadow-primary/5 transition-all hover:border-primary hover:bg-primary">
					<svg class="h-5 w-5 text-primary transition-colors group-hover/btn:text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
				</button>
			</div>
		</div>

		<!-- Swiper Container. -->
		<div class="swiper group overflow-visible!" data-team-slider>
			<div class="swiper-wrapper flex! items-stretch! gap-[10px] group-[.swiper-initialized]:gap-0">
				<?php if ( ! empty( $ub_members ) ) : ?>
					<?php foreach ( $ub_members as $ub_member ) : ?>
						<?php
						$ub_m_name    = isset( $ub_member['name'] ) ? $ub_member['name'] : '';
						$ub_m_pos     = isset( $ub_member['position'] ) ? $ub_member['position'] : '';
						$ub_m_bio     = isset( $ub_member['bio'] ) ? $ub_member['bio'] : '';
						$ub_m_photo   = isset( $ub_member['photo'] ) ? $ub_member['photo'] : 0;
						$ub_photo_url = $ub_m_photo ? wp_get_attachment_image_url( $ub_m_photo, 'large' ) : 'https://images.unsplash.com/photo-1560250097-0b93528c311a?auto=format&fit=crop&w=400&q=80';
						?>
						<div class="swiper-slide flex! h-auto! w-full max-w-[calc((88rem-30px)/4)]">
							<div data-card class="group/card flex h-full w-full flex-col overflow-hidden rounded-sm bg-white transition-all duration-300">
								<!-- Photo -->
								<div class="relative aspect-square overflow-hidden bg-slate-200">
									<?php if ( $ub_m_photo ) : ?>
										<?php echo wp_get_attachment_image( $ub_m_photo, 'large', false, array( 'class' => 'object-cover absolute inset-0 w-full! h-full! transition-transform duration-500' ) ); ?>
									<?php else : ?>
										<img src="https://images.unsplash.com/photo-1560250097-0b93528c311a?auto=format&fit=crop&w=400&q=80" alt="<?php echo esc_attr( $ub_m_name ); ?>" class="absolute inset-0 h-full! w-full! object-cover transition-transform duration-500" />
									<?php endif; ?>
								</div>
								
								<!-- Content -->
								<div class="grow p-6">
									<h3 class="mb-1 text-base leading-none font-bold text-slate-900"><?php echo esc_html( $ub_m_name ); ?></h3>
									<p class="mb-3 text-[0.7rem] font-bold text-primary uppercase"><?php echo esc_html( $ub_m_pos ); ?></p>
									<?php if ( $ub_m_bio ) : ?>
										<p class="line-clamp-3 text-xs leading-tight font-medium text-slate-500 opacity-70"><?php echo esc_html( $ub_m_bio ); ?></p>
									<?php endif; ?>
								</div>
							</div>
						</div>
					<?php endforeach; ?>
				<?php endif; ?>
			</div>
			
			<!-- Pagination (Progressbar). -->
			<div class="swiper-pagination static! mt-10 ml-0 max-w-xs overflow-hidden rounded-sm!" style="--swiper-pagination-progressbar-bg-color:#F1F5F9;--swiper-theme-color:#085399;"></div>
		</div>

	</div>
</section>
