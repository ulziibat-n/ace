<?php
/**
 * Template part for displaying a school card.
 *
 * @package ace
 * @since 1.0.0
 */

$ub_card_class = isset( $args['class'] ) ? $args['class'] : '';
$ub_post_id    = get_the_ID();

// ACF Fields.
$ub_name_ko = get_field( 'school_name_ko', $ub_post_id );
$ub_tuition = get_field( 'tuition_language_course', $ub_post_id );

// Taxonomies.
$ub_locations = get_the_terms( $ub_post_id, 'school_location' );
$ub_location  = ( ! empty( $ub_locations ) && ! is_wp_error( $ub_locations ) ) ? $ub_locations[0]->name : '';
?>

<article id="school-<?php echo esc_attr( $ub_post_id ); ?>" <?php post_class( 'flex flex-col h-full group/entry bg-white rounded-sm overflow-hidden transition-all duration-300 border border-primary/5 hover:shadow-xl ' . $ub_card_class ); ?>>
	<!-- Image Container -->
	<header class="overflow-hidden relative aspect-4/3 bg-slate-100">
		<?php if ( has_post_thumbnail() ) : ?>
			<?php the_post_thumbnail( 'large', array( 'class' => 'w-full h-full object-cover transition-transform duration-500 group-hover/entry:scale-105' ) ); ?>
		<?php else : ?>
			<div class="flex justify-center items-center w-full h-full text-slate-300">
				<svg class="w-12 h-12" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path></svg>
			</div>
		<?php endif; ?>
		
		<!-- Location Badge -->
		<?php if ( $ub_location ) : ?>
			<div class="absolute top-4 left-4">
				<span class="text-[0.625rem] font-bold uppercase leading-none px-2 py-1.5 rounded-xs bg-white text-primary shadow-sm">
					<?php echo esc_html( $ub_location ); ?>
				</span>
			</div>
		<?php endif; ?>
	</header>

	<!-- Content Container -->
	<div class="flex flex-col p-6 grow">
		
		<!-- Korean Name -->
		<div class="flex flex-wrap gap-2 mb-4">
			<?php if ( $ub_name_ko ) : ?>
				<span class="text-[0.7rem] font-medium text-foreground/40 bg-slate-50 px-2 py-0.5 rounded-xs">
					<?php echo esc_html( $ub_name_ko ); ?>
				</span>
			<?php endif; ?>
		</div>

		<h3 class="mb-2 text-base font-bold leading-tight transition-colors group-hover/entry:text-primary line-clamp-2">
			<a href="<?php the_permalink(); ?>" class="before:absolute before:inset-0 before:z-10">
				<?php the_title(); ?>
			</a>
		</h3>

		<?php if ( $ub_tuition ) : ?>
			<div class="mb-4 text-xs font-medium text-foreground/60">
				<span class="font-bold text-primary"><?php echo esc_html( $ub_tuition ); ?></span> / улирал
			</div>
		<?php endif; ?>

		<div class="flex justify-between items-center pt-4 mt-auto text-xs font-bold border-t transition-all border-foreground/5 text-primary group-hover/entry:gap-2">
			<span><?php esc_html_e( 'Дэлгэрэнгүй', 'aceedu' ); ?></span>
			<svg class="w-4 h-4 transition-transform group-hover/entry:translate-x-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"></path></svg>
		</div>
	</div>
</article>
