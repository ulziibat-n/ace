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
		<header class="entry-header group relative">
			<div class="relative w-full bg-slate-900 text-white">
				<?php if ( has_post_thumbnail( $ub_posts_page_id ) ) : ?>
					<?php echo get_the_post_thumbnail( $ub_posts_page_id, 'full', array( 'class' => 'w-full h-full absolute inset-0 z-10 object-cover' ) ); ?>
				<?php endif; ?>
				<div class="relative z-20 w-full bg-linear-to-t from-slate-950/95 to-slate-950/30 pt-48 pb-16 lg:pt-72 lg:pb-32">
					<div class="max-w-page">
						<div class="flex flex-col">
							<h1 class="text-4xl leading-tight font-bold lg:text-6xl"><?php single_post_title(); ?></h1>
							<?php if ( get_the_archive_description() ) : ?>
								<p class="max-w-content mt-8 ml-0! text-lg opacity-80"><?php echo get_the_archive_description(); ?></p>
							<?php endif; ?>
						</div>
					</div>
				</div>
			</div>
		</header>
		<?php
	endif;
	?>

	<section id="primary" class="min-h-screen bg-slate-100">
		<main id="main" class="container py-24">

		<?php
		if ( have_posts() ) {
			?>

			<div class="grid grid-cols-1 gap-[10px] md:grid-cols-2 lg:grid-cols-4">
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
