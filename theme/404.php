<?php
/**
 * The template for displaying 404 pages (not found)
 *
 * @link https://codex.wordpress.org/Creating_an_Error_404_Page
 *
 * @package aceedu
 */

get_header();
?>

	<section id="primary" class="bg-slate-50 min-h-[80vh] flex items-center justify-center py-20 px-4">
		<main id="main" class="w-full max-w-content mx-auto text-center">

			<div class="w-full max-w-2xl mx-auto max-w-content">
				<div class="flex flex-col items-center">
					<header>
						<div class="text-primary font-black text-8xl lg:text-[12rem] leading-none mb-4 opacity-5 select-none tracking-tighter">404</div>
						<h1 class="text-3xl font-bold leading-[1.1] lg:text-5xl text-slate-900 mb-6 tracking-tight">
							<?php esc_html_e( 'Уучлаарай, таны хайсан хуудас олдсонгүй', 'ace' ); ?>
						</h1>
					</header>

					<div class="flex flex-col items-center text-slate-500 mb-10 max-w-lg mx-auto text-center">
						<p class="text-lg leading-relaxed">
							<?php esc_html_e( 'Магадгүй энэ хуудас устгагдсан эсвэл нэр нь өөрчлөгдсөн байж болзошгүй. Доорх товчийг ашиглан нүүр хуудас руу буцна уу.', 'ace' ); ?>
						</p>
						
						<div class="flex justify-center w-full mt-10">
							<a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="inline-flex items-center px-12 py-4 bg-slate-900 text-white font-medium rounded-sm transition-all hover:bg-slate-800 hover:shadow-2xl hover:-translate-y-1">
								<svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path></svg>
								<?php esc_html_e( 'Нүүр хуудас руу буцах', 'ace' ); ?>
							</a>
						</div>
					</div>
				</div>
			</div>

		</main><!-- #main -->
	</section><!-- #primary -->

<?php
get_footer();
