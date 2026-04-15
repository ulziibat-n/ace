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
	<header class="entry-header group relative">
		<div class="relative w-full bg-slate-900 text-white">
			<?php if ( $ub_category_image ) : ?>
				<?php echo wp_get_attachment_image( $ub_category_image, 'full', false, array( 'class' => 'w-full h-full absolute inset-0 z-10 object-cover' ) ); ?>
			<?php endif; ?>
			<div class="pt-76">
				<div class="relative z-30 w-full overflow-hidden py-16 lg:pb-32">
					<!-- Gradient Backdrop Blur Overlay -->
					<div class="pointer-events-none absolute inset-0 z-0 mask-[linear-gradient(to_top,black_40%,transparent_100%)] backdrop-blur-xs"></div>
					
					<div class="absolute inset-0 z-0 bg-linear-to-t from-slate-950/95 to-slate-950/0"></div>
					
					<div class="relative z-10 container">
						<div class="flex flex-col items-start">
							<?php the_archive_title( '<h1 class="text-4xl font-bold leading-tight text-white translate-y-4 lg:text-6xl">', '</h1>' ); ?>
							<?php if ( get_the_archive_description() ) : ?>
								<div class="mt-8 ml-0! max-w-4xl text-lg text-white/90">
									<?php the_archive_description(); ?>
								</div>
							<?php endif; ?>
						</div>
					</div>
				</div>
			</div>
		</div>
	</header>

	<section id="primary" class="min-h-screen bg-slate-100">
		<main id="main" class="container py-24">

		<?php if ( have_posts() ) : ?>

			<div class="grid grid-cols-1 gap-[10px] md:grid-cols-2 lg:grid-cols-4">
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
