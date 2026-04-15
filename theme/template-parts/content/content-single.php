<?php
/**
 * Template part for displaying single posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package aceedu
 */

?>
<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<header class="entry-header group relative">
		<div class="relative w-full bg-slate-900 text-white">
			<?php
			if ( has_post_thumbnail() ) :
				the_post_thumbnail( 'full', array( 'class' => 'w-full h-full absolute inset-0 z-10 object-cover' ) );
			endif;
			?>
			<div class="pt-76">
				<div class="relative z-20 w-full overflow-hidden py-20 lg:pb-32">
					<!-- Gradient Backdrop Blur Overlay -->
					<div class="pointer-events-none absolute inset-0 z-0 mask-[linear-gradient(to_top,black_40%,transparent_100%)] backdrop-blur-xs"></div>
				
					<div class="absolute inset-0 z-0 bg-linear-to-t from-slate-950/95 to-slate-950/0"></div>
				
					<div class="relative z-10 container">
						<div class="flex flex-col items-start">
							<?php ub_display_primary_category( 'mb-4 text-[0.625rem] font-bold uppercase leading-none px-2 rounded-xs ml-1 py-1.5 bg-white text-primary' ); ?>
							<h1 class="max-w-6xl translate-y-4 text-4xl leading-none font-bold text-white lg:text-6xl"><?php echo esc_html( get_the_title() ); ?></h1>
							<?php
							if ( has_excerpt() ) :
								?>
								<p class="mt-8 max-w-4xl text-lg text-white/90"><?php echo esc_html( get_the_excerpt() ); ?></p>
								<?php
							endif;
							?>
							<div class="mt-8 text-[0.625rem] font-bold text-white/60 uppercase">
								<?php echo esc_html__( 'Нийтлээч:', 'ace' ); ?> <?php the_author(); ?> <span class="mx-2 font-light opacity-50">|</span> <?php echo esc_html( get_the_date() ); ?>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</header><!-- .entry-header -->
	<div class="py-16 lg:py-32">
		<div class="container">
			<div class="flex flex-col lg:flex-row-reverse">
				<div class="w-full lg:w-1/4">
					<div class="relative lg:sticky lg:top-8">
						<?php
						$ub_post_content = apply_filters( 'the_content', get_the_content() );
						$ub_toc_data     = ub_get_toc_and_content( $ub_post_content );
						?>
						<div class="singular-content mb-12 border-b border-b-slate-100 pb-12 lg:mb-0 lg:border-0 lg:pb-0 lg:pl-8 lg:text-xs lg:leading-none">
							<h3 class="text-xs! font-bold tracking-widest uppercase"><?php esc_html_e( 'Агуулга', 'ace' ); ?></h3>
							<ul data-content-toc class="mt-4 list-none space-y-2 pl-0">
								<?php echo $ub_toc_data['toc']; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
							</ul>
						</div>
					</div>
				</div>
				<div class="relative w-full lg:w-3/4">
					<div class="singular-content">
						<?php
						echo $ub_toc_data['content']; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
						?>
					</div>
				</div>
			</div>
		</div>
	</div><!-- .entry-content -->

</article><!-- #post-${ID} -->
