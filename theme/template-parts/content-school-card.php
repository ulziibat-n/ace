<?php
/**
 * Template part for displaying school cards in archive
 */

$ub_school_id   = get_the_ID();
$ub_logo        = get_field( 'logo', $ub_school_id );
$ub_short_intro = get_field( 'short_intro', $ub_school_id );
$ub_location    = get_the_terms( $ub_school_id, 'school_location' );
$ub_guarantor   = get_the_terms( $ub_school_id, 'guarantor_requirement' );
$ub_visa_rate   = get_field( 'visa_success_rate_text', $ub_school_id );
$ub_is_featured = get_field( 'is_featured', $ub_school_id );
?>

<article id="post-<?php the_ID(); ?>" <?php post_class( 'school-card relative flex flex-col h-full group/entry bg-white rounded-xs overflow-hidden transition-all duration-300 hover:shadow-xl hover:-translate-y-1' ); ?>>
	
	<!-- Image / Logo Area -->
	<header class="relative aspect-video overflow-hidden bg-slate-50">
		<?php if ( $ub_is_featured ) : ?>
			<div class="absolute top-4 left-4 z-20">
				<span class="rounded-xs bg-amber-400 px-2 py-1.5 text-[0.625rem] leading-none font-bold text-amber-950 uppercase shadow-sm">
					<?php esc_html_e( 'Онцлох', 'ace' ); ?>
				</span>
			</div>
		<?php endif; ?>

		<?php if ( has_post_thumbnail() ) : ?>
			<?php the_post_thumbnail( 'medium_large', array( 'class' => 'w-full h-full object-cover transition-transform duration-500 group-hover/entry:scale-105' ) ); ?>
		<?php else : ?>
			<div class="flex h-full w-full items-center justify-center text-slate-200">
				<svg class="h-12 w-12" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path></svg>
			</div>
		<?php endif; ?>
		
		<!-- Logo Overlay -->
		<?php if ( $ub_logo ) : ?>
			<div class="absolute bottom-4 left-4 z-20 flex h-12 w-12 items-center justify-center overflow-hidden rounded-xs border border-slate-100 bg-white p-1 shadow-lg">
				<?php echo wp_get_attachment_image( $ub_logo, 'thumbnail', false, array( 'class' => 'max-w-full max-h-full object-contain' ) ); ?>
			</div>
		<?php endif; ?>


		<div class="pointer-events-none absolute inset-0 bg-linear-to-t from-slate-900/40 to-transparent"></div>
	</header>

	<!-- Content Container -->
	<div class="flex grow flex-col p-6">
		
		<!-- Meta Chips -->
		<div class="mb-4 flex flex-wrap gap-2">
			<?php if ( $ub_location ) : ?>
				<div class="flex items-center text-[0.625rem] font-bold tracking-wider text-slate-400 uppercase">
					<svg class="mr-1 h-3 w-3 text-primary/50" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
					<?php echo esc_html( $ub_location[0]->name ); ?>
				</div>
			<?php endif; ?>

			<?php if ( $ub_guarantor ) : ?>
				<div class="flex items-center text-[0.625rem] font-bold tracking-wider text-emerald-600/80 uppercase">
					<svg class="mr-1 h-3 w-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"></path></svg>
					<?php echo esc_html( $ub_guarantor[0]->name ); ?>
				</div>
			<?php endif; ?>
		</div>

		<h3 class="mb-3 text-base leading-tight font-bold transition-colors group-hover/entry:text-primary">
			<a href="<?php the_permalink(); ?>" class="before:absolute before:inset-0 before:z-10">
				<?php the_title(); ?>
			</a>
		</h3>

		<?php if ( $ub_short_intro ) : ?>
			<p class="mb-6 line-clamp-2 text-[13px] leading-relaxed text-slate-500">
				<?php echo esc_html( $ub_short_intro ); ?>
			</p>
		<?php endif; ?>

		<!-- Footer / Read More -->
		<div class="mt-auto flex items-center justify-between border-t border-foreground/5 pt-4 text-[0.65rem] font-bold text-primary transition-all group-hover/entry:gap-2">
			<span class="tracking-widest uppercase"><?php esc_html_e( 'Дэлгэрэнгүй', 'ace' ); ?></span>
			<svg class="h-4 w-4 transition-transform group-hover/entry:translate-x-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"></path></svg>
		</div>
	</div>
</article>
