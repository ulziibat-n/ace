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

	<section id="primary" class="flex min-h-[80vh] items-center justify-center bg-slate-50 px-4 py-20">
		<main id="main" class="max-w-content mx-auto w-full text-center">

			<div class="max-w-content mx-auto w-full max-w-2xl">
				<div class="flex flex-col items-center">
					<header>
						<div class="mb-4 text-8xl leading-none font-black tracking-tighter text-primary opacity-5 select-none lg:text-[12rem]">404</div>
						<h1 class="mb-6 text-3xl leading-[1.1] font-bold tracking-tight text-slate-900 lg:text-5xl">
							<?php esc_html_e( 'Уучлаарай, таны хайсан хуудас олдсонгүй', 'ace' ); ?>
						</h1>
					</header>

					<div class="mx-auto mb-10 flex max-w-lg flex-col items-center text-center text-slate-500">
						<p class="text-lg leading-relaxed">
							<?php esc_html_e( 'Магадгүй энэ хуудас устгагдсан эсвэл нэр нь өөрчлөгдсөн байж болзошгүй. Доорх товчийг ашиглан нүүр хуудас руу буцна уу.', 'ace' ); ?>
						</p>
						
						<div class="mt-10 flex w-full justify-center">
							<a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="inline-flex items-center rounded-sm bg-slate-900 px-12 py-4 font-medium text-white transition-all hover:-translate-y-1 hover:bg-slate-800 hover:shadow-2xl">
								<svg class="mr-2 h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path></svg>
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
