<?php
/**
 * The main template file
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no `home.php` file exists.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package aceedu
 */

get_header();
?>

	<?php
	if ( is_home() && ! is_front_page() ) :
		$ub_posts_page_id = get_option( 'page_for_posts' );
		?>
		<header class="relative entry-header group">
			<div class="relative w-full text-white bg-slate-900">
				<?php if ( has_post_thumbnail( $ub_posts_page_id ) ) : ?>
					<?php echo get_the_post_thumbnail( $ub_posts_page_id, 'full', array( 'class' => 'w-full h-full absolute inset-0 z-10 object-cover' ) ); ?>
				<?php endif; ?>
				<div class="relative z-20 pt-48 pb-16 w-full lg:pt-72 lg:pb-32 to-slate-950/30 bg-linear-to-t from-slate-950/95">
					<div class="max-w-page">
						<div class="flex flex-col">
							<h1 class="text-4xl font-bold leading-tight lg:text-6xl"><?php single_post_title(); ?></h1>
							<?php if ( get_the_archive_description() ) : ?>
								<p class="mt-8 text-lg opacity-80 max-w-content ml-0!"><?php echo get_the_archive_description(); ?></p>
							<?php endif; ?>
						</div>
					</div>
				</div>
			</div>
		</header>
		<?php
	endif;
	?>

	<section id="primary" class="bg-slate-100 min-h-screen">
		<main id="main" class="container py-24">

		<?php
		if ( have_posts() ) {
			?>

			<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-[10px]">
				<?php
				// Load posts loop.
				while ( have_posts() ) {
					the_post();
					get_template_part( 'template-parts/cards/card', 'post' );
				}
				?>
			</div>

			<div class="mt-12 empty:hidden"><?php ub_the_posts_navigation(); ?></div>

			<?php

		} else {

			// If no content, include the "No posts found" template.
			get_template_part( 'template-parts/content/content', 'none' );

		}
		?>

		</main><!-- #main -->
	</section><!-- #primary -->

<?php
get_footer();
