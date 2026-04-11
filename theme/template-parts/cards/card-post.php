<?php
/**
 * Template part for displaying a post card.
 *
 * @package ace
 */

$ub_card_class = isset( $args['class'] ) ? $args['class'] : '';
?>

<article id="post-<?php the_ID(); ?>" <?php post_class( 'flex flex-col h-full group/entry bg-white rounded-sm overflow-hidden transition-all duration-300 ' . $ub_card_class ); ?>>
	<!-- Image Container -->
	<header class="relative aspect-video overflow-hidden">
		<?php if ( has_post_thumbnail() ) : ?>
			<?php the_post_thumbnail( 'large', array( 'class' => 'w-full h-full object-cover transition-transform duration-500 group-hover/entry:scale-105' ) ); ?>
		<?php else : ?>
			<div class="flex h-full w-full items-center justify-center bg-slate-100 text-slate-300">
				<svg class="h-12 w-12" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
			</div>
		<?php endif; ?>
		
		<!-- Category Badge -->
		<div class="absolute top-4 left-4">
			<?php ub_display_primary_category( 'text-[0.625rem] font-bold uppercase leading-none px-2 py-1.5 rounded-xs bg-white text-primary shadow-sm' ); ?>
		</div>
	</header>

	<!-- Content Container -->
	<div class="flex grow flex-col p-6">
		
		<div class="mb-2 flex items-center gap-2 text-[0.65rem] font-medium text-foreground/50 uppercase">
			<svg class="h-3 w-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
			<?php echo get_the_date(); ?>
		</div>

		<h3 class="mb-4 text-base leading-tight font-bold transition-colors group-hover/entry:text-primary">
			<a href="<?php the_permalink(); ?>" class="before:absolute before:inset-0 before:z-10">
				<?php the_title(); ?>
			</a>
		</h3>

		<div class="mt-auto flex items-center justify-between border-t border-foreground/5 pt-4 text-xs font-bold text-primary transition-all group-hover/entry:gap-2">
			<span><?php esc_html_e( 'Цааш унших', 'ace' ); ?></span>
			<svg class="h-4 w-4 transition-transform group-hover/entry:translate-x-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"></path></svg>
		</div>
	</div>
</article>
