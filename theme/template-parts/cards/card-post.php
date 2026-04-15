<?php
/**
 * Template part for displaying a post card.
 *
 * @package ace
 */

$ub_card_class = isset( $args['class'] ) ? $args['class'] : '';
?>

<article id="post-<?php the_ID(); ?>" <?php post_class( 'flex flex-col h-full relative group/entry bg-white rounded-sm overflow-hidden transition-all duration-300 ' . $ub_card_class ); ?>>
	<!-- Image Container -->
	<header class="overflow-hidden relative aspect-video">
		<?php if ( has_post_thumbnail() ) : ?>
			<?php the_post_thumbnail( 'large', array( 'class' => 'w-full h-full object-cover transition-transform duration-500 group-hover/entry:scale-105' ) ); ?>
		<?php else : ?>
			<div class="flex justify-center items-center w-full h-full bg-slate-100 text-slate-300">
				<svg class="w-12 h-12" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
			</div>
		<?php endif; ?>
		
		<!-- Category Badge -->
		<div class="absolute top-4 left-4">
			<?php ub_display_primary_category( 'text-[0.625rem] font-bold uppercase leading-none px-2 py-1.5 rounded-xs bg-white text-primary shadow-sm' ); ?>
		</div>
	</header>

	<!-- Content Container -->
	<div class="flex flex-col p-6 grow">

		<h3 class="mb-4 text-sm font-bold leading-tight transition-colors group-hover/entry:text-primary">
			<a href="<?php the_permalink(); ?>" class="block no-underline before:absolute before:inset-0 before:z-10">
				<?php the_title(); ?>
			</a>
		</h3>
		<div class="mt-auto flex items-center text-[0.65rem] font-bold text-slate-500 group-hover/entry:text-primary uppercase transition-all">
			<span class="font-medium text-slate-500"><?php echo esc_html( get_the_date() ); ?></span>
			<span class="mx-2 font-light opacity-50 text-slate-500">|</span>
			<div class="flex gap-2 items-center transition-all">
				<span><?php esc_html_e( 'Нийтлэл унших', 'aceedu' ); ?></span>
				<svg class="w-3 h-3 transition-transform group-hover/entry:translate-x-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"></path></svg>
			</div>
		</div>
	</div>
</article>
