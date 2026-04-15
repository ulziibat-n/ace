<?php
/**
 * Template part for displaying pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package aceedu
 */

?>

<?php
$ub_page_title         = true;
$ub_page_content_class = 'page-content';
if ( function_exists( 'get_field' ) && get_field( 'hide_page_title' ) ) {
	$ub_page_title         = false;
	$ub_page_content_class = 'page-wide';
}
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<?php
	$ub_header_class = '';
	if ( ! $ub_page_title ) {
		$ub_header_class = 'hidden';
	}
	?>
	<header class="entry-header group <?php echo esc_attr( $ub_header_class ); ?> relative">
		<div class="relative w-full bg-slate-900 text-white">
			<?php
			if ( has_post_thumbnail() ) :
				the_post_thumbnail( 'full', array( 'class' => 'w-full h-full absolute inset-0 z-10 object-cover' ) );
			endif;
			?>
			<div class="relative z-20 w-full bg-linear-to-t from-slate-950/95 to-slate-950/30 pt-48 pb-16 lg:pt-72 lg:pb-32">
				<div class="<?php echo esc_attr( $ub_page_content_class ); ?>">
					<div class="flex flex-col">
						<?php
						if ( ! is_front_page() ) {
							the_title( '<h1 class="text-4xl font-bold leading-tight lg:text-6xl">', '</h1>' );
						} else {
							the_title( '<h2 class="text-4xl font-bold leading-tight lg:text-6xl">', '</h2>' );
						}
						if ( has_excerpt() ) :
							?>
							<p class="mt-8 text-lg"><?php echo esc_html( get_the_excerpt() ); ?></p>
							<?php
						endif;
						?>
					</div>
				</div>
			</div>
		</div>
	</header><!-- .entry-header -->
	<?php

	if ( $ub_page_title ) {
		$ub_page_content_class .= ' py-16 lg:py-32 singular-content';
	} else {
		$ub_page_content_class .= ' max-w-full';
	}
	?>
	<div class="<?php echo esc_attr( $ub_page_content_class ); ?>">
		<?php
		the_content();
		?>
	</div><!-- .entry-content -->
</article><!-- #post-<?php the_ID(); ?> -->
