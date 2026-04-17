<?php
/**
 * Latest Posts Grid Block Template.
 *
 * @param array $block The block settings and attributes.
 * @param string $content The block inner HTML (empty).
 * @param bool $is_preview True during AJAX preview.
 * @param  (int|string) $post_id The post ID this block is saved to.
 *
 * @package aceedu
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$ub_id = 'latest-posts-' . $block['id'];
if ( ! empty( $block['anchor'] ) ) {
	$ub_id = $block['anchor'];
}

$ub_align      = ! empty( $block['align'] ) ? 'align' . $block['align'] : 'alignfull';
$ub_class_name = 'block-latest-posts relative w-full overflow-hidden bg-slate-100 py-16 lg:py-24 ' . $ub_align . ( isset( $block['className'] ) ? ' ' . $block['className'] : '' );

// ACF Fields.
$ub_example_data = function_exists( 'ub_get_block_example_data' ) ? ub_get_block_example_data( $block ) : array();
$ub_headline     = get_field( 'lp_title' );
$ub_description  = get_field( 'lp_description' );

// Show example data only in editor if fields are empty.
if ( $is_preview ) {
	$ub_headline    = $ub_headline ? $ub_headline : ( $ub_example_data['lp_title'] ?? 'Гарчиг (Жишээ)' );
	$ub_description = $ub_description ? $ub_description : ( $ub_example_data['lp_description'] ?? 'Тайлбар (Жишээ)' );
}
$ub_posts_count  = get_option( 'posts_per_page' );

// Max Width Logic.
$ub_title_mw = get_field( 'lp_title_max_width' ) ? get_field( 'lp_title_max_width' ) : 768;
$ub_desc_mw  = get_field( 'lp_description_max_width' ) ? get_field( 'lp_description_max_width' ) : 720;

$ub_title_rem = ( $ub_title_mw / 16 ) . 'rem';
$ub_desc_rem  = ( $ub_desc_mw / 16 ) . 'rem';

// Pagination Logic.
$ub_paged = ( get_query_var( 'paged' ) ) ? get_query_var( 'paged' ) : ( ( get_query_var( 'page' ) ) ? get_query_var( 'page' ) : 1 );

// Query Args - Default args for fallback.
$ub_args = array(
	'post_type'           => 'post',
	'posts_per_page'      => $ub_posts_count,
	'paged'               => $ub_paged,
	'ignore_sticky_posts' => 1,
	'post_status'         => 'publish',
	'orderby'             => 'date',
	'order'               => 'DESC',
);

/**
 * Main Query Integration.
 * If we are contextually in the main loop (archive, blog page, etc.), use the global query.
 */
global $wp_query;
$ub_is_main_loop = ( is_home() || is_archive() || is_search() ) && $wp_query->is_main_query() && ! is_admin();

if ( $ub_is_main_loop ) {
	$ub_query = $wp_query;
} else {
	$ub_query = new WP_Query( $ub_args );
}
?>

<section id="<?php echo esc_attr( $ub_id ); ?>" class="<?php echo esc_attr( $ub_class_name ); ?>">
	<div class="relative z-10 container">
		
		<?php if ( $ub_headline || $ub_description ) : ?>
			<div class="mb-12 flex flex-row items-end justify-between gap-8">
				<div class="grow">
					<?php if ( $ub_headline ) : ?>
						<h2 class="mb-2 text-2xl leading-none font-bold tracking-tight lg:text-3xl" style="max-width: <?php echo esc_attr( $ub_title_rem ); ?>;">
							<?php echo esc_html( $ub_headline ); ?>
						</h2>
					<?php endif; ?>

					<?php if ( $ub_description ) : ?>
						<p class="mt-4 text-base leading-tight text-slate-500 opacity-80" style="max-width: <?php echo esc_attr( $ub_desc_rem ); ?>;">
							<?php echo wp_kses_post( $ub_description ); ?>
						</p>
					<?php endif; ?>
				</div>
			</div>
		<?php endif; ?>

		<?php if ( $ub_query->have_posts() ) : ?>
			<div class="grid grid-cols-1 gap-[10px] sm:grid-cols-2 lg:grid-cols-4">
				<?php
				while ( $ub_query->have_posts() ) :
					$ub_query->the_post();
					?>
					<?php get_template_part( 'template-parts/cards/card', 'post' ); ?>
					<?php
				endwhile;
				?>
			</div>

			<?php
			/**
			 * Pagination logic.
			 * We swap the global $wp_query with our custom query to use standard navigation tags.
			 */
			global $wp_query;
			$ub_original_query = $wp_query;
			// phpcs:ignore WordPress.WP.GlobalVariablesOverride.Prohibited
			$wp_query = $ub_query;
			?>
			<div class="mt-12 empty:hidden">
				<?php ub_the_posts_navigation(); ?>
			</div>
			<?php
			// Restore the original query.
			// phpcs:ignore WordPress.WP.GlobalVariablesOverride.Prohibited
			$wp_query = $ub_original_query;
			wp_reset_postdata();
			?>

		<?php else : ?>
			<?php if ( $is_preview ) : ?>
				<div class="rounded-sm border-2 border-dashed border-slate-200 p-12 text-center text-slate-400">
					Нийтлэлүүд олдсонгүй.
				</div>
			<?php endif; ?>
		<?php endif; ?>

	</div>
</section>
