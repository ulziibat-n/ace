<?php
/**
 * The template for displaying archive pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package aceedu
 */

get_header();
?>
	<?php
	$ub_queried_object = get_queried_object();
	$ub_category_image = function_exists( 'get_field' ) ? get_field( 'category_image', $ub_queried_object ) : null;
	?>
	<header class="relative entry-header group">
		<div class="relative w-full text-white bg-slate-900">
			<?php if ( $ub_category_image ) : ?>
				<?php echo wp_get_attachment_image( $ub_category_image, 'full', false, array( 'class' => 'w-full h-full absolute inset-0 z-10 object-cover' ) ); ?>
			<?php endif; ?>
			<div class="relative z-30 pt-48 pb-16 w-full lg:pt-72 lg:pb-32 to-slate-950/30 bg-linear-to-t from-slate-950/95">
				<div class="max-w-page">
					<div class="flex flex-col">
						<?php the_archive_title( '<h1 class="text-4xl font-bold leading-tight lg:text-6xl">', '</h1>' ); ?>
						<?php if ( get_the_archive_description() ) : ?>
							<div class="mt-8 text-lg max-w-content ml-0!">
								<?php the_archive_description(); ?>
							</div>
						<?php endif; ?>
					</div>
				</div>
			</div>
		</div>
	</header>

	<section id="primary" class="bg-slate-100 min-h-screen">
		<main id="main" class="container py-24">

		<?php if ( have_posts() ) : ?>

			<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-[10px]">
				<?php
				// Start the Loop.
				while ( have_posts() ) :
					the_post();
					get_template_part( 'template-parts/cards/card', 'post' );

					// End the loop.
				endwhile;
				?>
			</div>

			<div class="mt-12 empty:hidden"><?php ub_the_posts_navigation(); ?></div>

		<?php else : ?>

			<?php get_template_part( 'template-parts/content/content', 'none' ); ?>

		<?php endif; ?>

		</main><!-- #main -->
	</section><!-- #primary -->

<?php
get_footer();
