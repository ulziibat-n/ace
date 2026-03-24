<?php
/**
 * Template part for displaying single posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package aceedu
 */

?>
<?php
$ub_header_class = 'default';
if ( function_exists( 'get_field' ) && null !== get_field( 'featured_image_type' ) && get_field( 'featured_image_type' ) ) {
	$ub_header_class = 'bg-' . get_field( 'featured_image_type' );
}
?>
<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

	<header class="entry-header relative <?php echo esc_attr( $ub_header_class ); ?>">
		<?php
		if ( function_exists( 'get_field' ) && get_field( 'featured_image_type' ) === 'full' ) :
			?>
			<div class="relative w-full text-white bg-slate-900">
				<?php
				if ( has_post_thumbnail() ) :
					the_post_thumbnail( 'full', array( 'class' => 'w-full h-full absolute inset-0 z-10 object-cover' ) );
				endif;
				?>
				<div class="relative z-20 pt-64 pb-32 w-full to-slate-950/30 bg-linear-to-t from-slate-950">
					<div class="container px-4 mx-auto">
						<div class="w-full lg:w-3/4">
							<div class="flex flex-col items-start lg:mx-auto lg:max-w-content">
								<?php ub_display_primary_category( 'mb-4 text-[0.625rem] font-bold uppercase leading-none px-2 rounded-xs ml-1 py-1.5 bg-white text-primary' ); ?>
								<h1 class="text-4xl font-bold leading-tight"><?php echo esc_html( get_the_title() ); ?></h1>
								<?php
								if ( has_excerpt() ) :
									?>
									<p class="mt-8 text-lg"><?php echo esc_html( get_the_excerpt() ); ?></p>
									<?php
								endif;
								?>
								<div class="mt-8 text-[0.625rem] font-bold uppercase">
									<?php echo esc_html__( 'Нийтлээч:', 'ace' ); ?> <?php the_author(); ?> <span class="mx-2 font-light opacity-50">|</span> <?php echo esc_html( get_the_date() ); ?>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
			<?php
		else :
			?>
			<div class="container">
				<div class="flex gap-2 items-center">
					<?php
					if ( has_post_thumbnail() ) :
						?>
						<div>
							<?php echo wp_get_attachment_image( get_post_thumbnail_id(), 'full', false, array( 'class' => 'w-full h-full absolute inset-0 z-0 object-cover' ) ); ?>
						</div>
						<?php
					endif;
					?>
					<div>
						<h1><?php echo esc_html( get_the_title() ); ?></h1>
					<?php
					if ( has_excerpt() ) :
						?>
						<p><?php echo esc_html( get_the_excerpt() ); ?></p>
						<?php
					endif;
					?>
					</div>
				</div>
				
			</div>
			<?php
		endif;
		?>
	</header><!-- .entry-header -->
	<div class="py-16 lg:py-32">
		<div class="container px-4 mx-auto">
			<div class="flex flex-col lg:flex-row-reverse">
				<div class="w-full lg:w-1/4">
					<div class="relative lg:sticky lg:top-8">
						<?php
						$ub_post_content = apply_filters( 'the_content', get_the_content() );
						$ub_toc_data     = ub_get_toc_and_content( $ub_post_content );
						?>
						<div class="pb-12 mb-12 border-b lg:leading-none prose prose-a:no-underline lg:text-xs lg:prose-li:pl-0 lg:prose-ul:ml-0 lg:prose-ul:pl-3.5 lg:prose-li:my-2 prose-a:text-foreground border-foreground/5 lg:pl-8 lg:mb-0 lg:pb-0 lg:border-0">
							<h3 class="font-bold text-[1.5em] lg:uppercase lg:text-xs"><?php esc_html_e( 'Агуулга', 'ace' ); ?></h3>
							<ul data-content-toc class="mt-2">
								<?php echo $ub_toc_data['toc']; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
							</ul>
						</div>
					</div>
				</div>
				<div class="relative w-full lg:w-3/4">
					<div class="leading-relaxed lg:mx-auto lg:max-w-content prose">
						<?php
						echo $ub_toc_data['content']; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
						?>
					</div>
				</div>
			</div>
		</div>
	</div><!-- .entry-content -->

</article><!-- #post-${ID} -->
