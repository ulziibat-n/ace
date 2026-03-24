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
	if ( $ub_page_title ) :
		?>
		<header class="relative entry-header group">
			<div class="relative w-full text-white bg-slate-900">
				<?php
				if ( has_post_thumbnail() ) :
					the_post_thumbnail( 'full', array( 'class' => 'w-full h-full absolute inset-0 z-10 object-cover' ) );
				endif;
				?>
				<div class="relative z-20 pt-48 pb-16 w-full lg:pt-72 lg:pb-32 to-slate-950/30 bg-linear-to-t from-slate-950/95">
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
	endif;
	$ub_page_content_class .= ' py-16 lg:py-32 prose';
	?>
	<div class="<?php echo esc_attr( $ub_page_content_class ); ?>">
		<?php
		the_content();
		?>
	</div><!-- .entry-content -->
</article><!-- #post-<?php the_ID(); ?> -->
