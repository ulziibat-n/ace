<?php
/**
 * The template for displaying school archives
 *
 * @package aceedu
 * @since   1.0.0
 */

get_header();

$ub_current_location  = '';
$ub_current_guarantor = '';
$ub_search_query      = '';

// phpcs:disable WordPress.Security.NonceVerification.Recommended -- Public GET filter for archive page does not require nonce to maintain shareable URLs.
if ( isset( $_GET['location'] ) ) {
	$ub_current_location = sanitize_text_field( wp_unslash( $_GET['location'] ) );
}
if ( isset( $_GET['guarantor'] ) ) {
	$ub_current_guarantor = sanitize_text_field( wp_unslash( $_GET['guarantor'] ) );
}
if ( isset( $_GET['s_school'] ) ) {
	$ub_search_query = sanitize_text_field( wp_unslash( $_GET['s_school'] ) );
}
// phpcs:enable WordPress.Security.NonceVerification.Recommended

// Taxonomies for filters.
$ub_locations  = get_terms(
	array(
		'taxonomy'   => 'school_location',
		'hide_empty' => true,
	)
);
$ub_guarantors = get_terms(
	array(
		'taxonomy'   => 'guarantor_requirement',
		'hide_empty' => true,
	)
);

// Options Page Fields.
$ub_archive_title = get_field( 'school_archive_title', 'option' ) ?? esc_html__( 'Сургуулиуд', 'ace' );
$ub_archive_desc  = get_field( 'school_archive_description', 'option' ) ?? esc_html__( 'БНСУ-ын шилдэг Их Дээд Сургуулиудын нэгдсэн мэдээлэл.', 'ace' );
$ub_archive_bg    = get_field( 'school_archive_bg', 'option' );

?>

<main id="primary" class="site-main">

	<!-- Hero Section (Matches archive.php) -->
	<header class="relative entry-header group">
		<div class="relative w-full text-white bg-slate-900">
			<?php if ( $ub_archive_bg ) : ?>
				<?php echo wp_get_attachment_image( $ub_archive_bg, 'full', false, array( 'class' => 'w-full h-full absolute inset-0 z-10 object-cover' ) ); ?>
			<?php endif; ?>
			<div class="pt-76">
				<div class="overflow-hidden relative z-30 py-16 w-full lg:pb-32">
					<!-- Gradient Backdrop Blur Overlay -->
					<div class="pointer-events-none absolute inset-0 z-0 mask-[linear-gradient(to_top,black_40%,transparent_100%)] backdrop-blur-xs"></div>
					
					<div class="absolute inset-0 z-0 to-slate-950/0 bg-linear-to-t from-slate-950/95"></div>
					
					<div class="container relative z-10">
						<div class="flex flex-col items-start">
							<h1 class="text-4xl font-bold leading-tight text-white translate-y-4 lg:text-6xl"><?php echo esc_html( $ub_archive_title ); ?></h1>
							<?php if ( $ub_archive_desc ) : ?>
								<div class="max-w-4xl mt-8 ml-0! text-lg text-white/90">
									<p><?php echo esc_html( $ub_archive_desc ); ?></p>
								</div>
							<?php endif; ?>
						</div>
					</div>
				</div>
			</div>
		</div>
	</header>

	<!-- Main Content Area -->
	<section class="py-16 min-h-screen bg-slate-100 lg:py-24">
		<div class="container">
			<div class="flex flex-col gap-12 lg:flex-row">
				
				<!-- Sidebar Filters (1/4) -->
				<aside class="w-full lg:w-1/4">
					<div class="lg:sticky lg:top-8">
						<div class="p-6 bg-white border rounded-xs border-slate-200/60 md:p-8">
							<h3 class="flex gap-2 items-center mb-6 text-sm italic font-black tracking-widest uppercase text-slate-900">
								<svg class="w-4 h-4 text-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2.586a1 1 0 01-.293.707l-6.414 6.414a1 1 0 00-.293.707V17l-4 4v-6.586a1 1 0 00-.293-.707L3.293 7.293A1 1 0 013 6.586V4z"></path></svg>
								<?php esc_html_e( 'Шүүлтүүр', 'ace' ); ?>
							</h3>
							
							<form action="<?php echo esc_url( get_post_type_archive_link( 'school' ) ); ?>" method="GET" class="space-y-6">
								<!-- Search -->
								<div>
									<label for="s_school" class="mb-2 block text-[10px] font-black tracking-widest text-slate-400 uppercase"><?php esc_html_e( 'Хайлт', 'ace' ); ?></label>
									<div class="relative">
										<input type="text" name="s_school" id="s_school" value="<?php echo esc_attr( $ub_search_query ); ?>" 
											class="py-3 pr-4 pl-4 w-full text-sm transition-all rounded-xs border-slate-200 bg-slate-50 text-slate-900 placeholder:text-slate-300 focus:border-primary focus:ring-0" 
											placeholder="Сургуулийн нэр...">
									</div>
								</div>

								<!-- Location Filter -->
								<div>
									<label for="location" class="mb-2 block text-[10px] font-black tracking-widest text-slate-400 uppercase"><?php esc_html_e( 'Байршил', 'ace' ); ?></label>
									<select name="location" id="location" class="px-4 py-3 w-full text-sm appearance-none cursor-pointer rounded-xs border-slate-200 bg-slate-50 text-slate-900 focus:border-primary focus:ring-0">
										<option value=""><?php esc_html_e( 'Бүх байршил', 'ace' ); ?></option>
										<?php foreach ( $ub_locations as $ub_loc ) : ?>
											<option value="<?php echo esc_attr( $ub_loc->slug ); ?>" <?php selected( $ub_current_location, $ub_loc->slug ); ?>><?php echo esc_html( $ub_loc->name ); ?></option>
										<?php endforeach; ?>
									</select>
								</div>

								<!-- Guarantor Filter -->
								<div>
									<label for="guarantor" class="mb-2 block text-[10px] font-black tracking-widest text-slate-400 uppercase"><?php esc_html_e( 'Батлан даагч', 'ace' ); ?></label>
									<select name="guarantor" id="guarantor" class="px-4 py-3 w-full text-sm appearance-none cursor-pointer rounded-xs border-slate-200 bg-slate-50 text-slate-900 focus:border-primary focus:ring-0">
										<option value=""><?php esc_html_e( 'Бүх төрөл', 'ace' ); ?></option>
										<?php foreach ( $ub_guarantors as $ub_guar ) : ?>
											<option value="<?php echo esc_attr( $ub_guar->slug ); ?>" <?php selected( $ub_current_guarantor, $ub_guar->slug ); ?>><?php echo esc_html( $ub_guar->name ); ?></option>
										<?php endforeach; ?>
									</select>
								</div>

								<!-- Buttons -->
								<div class="pt-4 space-y-3">
									<button type="submit" class="inline-flex justify-center items-center px-6 py-4 w-full text-xs font-bold tracking-widest text-white no-underline uppercase shadow-lg transition-all duration-300 rounded-xs bg-primary shadow-primary/20 hover:bg-slate-900">
										<?php esc_html_e( 'Шүүлтүүр хэрэглэх', 'ace' ); ?>
									</button>
									
									<?php if ( $ub_current_location || $ub_current_guarantor || $ub_search_query ) : ?>
										<a href="<?php echo esc_url( get_post_type_archive_link( 'school' ) ); ?>" class="inline-flex w-full items-center justify-center rounded-xs bg-slate-100 px-6 py-3 text-[10px] font-bold tracking-widest text-slate-600 uppercase no-underline transition-all duration-300 hover:bg-slate-200">
											<?php esc_html_e( 'Цэвэрлэх', 'ace' ); ?>
										</a>
									<?php endif; ?>
								</div>
							</form>
						</div>
					</div>
				</aside>

				<!-- Content Area (3/4) -->
				<div class="w-full lg:w-3/4">
					
					<!-- Results Info -->
					<div class="flex justify-between items-center px-2 mb-8">
						<div>
							<?php
							global $wp_query;
							$ub_count = $wp_query->found_posts;
							?>
							<p class="text-sm font-medium text-slate-500">
								<?php
								/* translators: %s: number of schools found */
								printf( esc_html__( 'Нийт %s сургууль олдлоо', 'ace' ), '<span class="font-bold text-slate-900">' . esc_html( $ub_count ) . '</span>' );
								?>
							</p>
						</div>
					</div>

					<!-- Grid -->
					<?php if ( have_posts() ) : ?>
						<div class="grid grid-cols-1 gap-[10px] md:grid-cols-2 lg:grid-cols-3">
							<?php
							while ( have_posts() ) :
								the_post();
								?>
								<?php get_template_part( 'template-parts/content-school-card' ); ?>
							<?php endwhile; ?>
						</div>

						<!-- Pagination (Matches archive.php logic) -->
						<div class="mt-16 empty:hidden">
							<?php ub_the_posts_navigation(); ?>
						</div>

					<?php else : ?>
						<!-- No Content -->
						<div class="p-16 text-center bg-white border rounded-xs border-slate-200/60">
							<div class="flex justify-center items-center mx-auto mb-6 w-16 h-16 rounded-full bg-slate-50 text-slate-300">
								<svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
							</div>
							<h3 class="mb-2 text-xl italic font-bold uppercase text-slate-900"><?php esc_html_e( 'Илэрц олдсонгүй', 'ace' ); ?></h3>
							<p class="text-sm text-slate-500"><?php esc_html_e( 'Та хайлтын үг эсвэл шүүлтүүрээ өөрчилж үзнэ үү.', 'ace' ); ?></p>
						</div>
					<?php endif; ?>
				</div>

			</div>
		</div>
	</section>

	<!-- Lead Capture Section (Refined CTA Banner) -->
	<section id="help-cta" class="overflow-hidden relative py-16 text-white bg-primary lg:py-24">
		<div class="pointer-events-none absolute top-[-10%] right-[-10%] h-[400px] w-[400px] opacity-10 lg:h-[600px] lg:w-[600px]">
			<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" class="w-full h-full text-white">
				<circle cx="12" cy="12" r="10"></circle>
				<line x1="2" y1="12" x2="22" y2="12"></line>
				<path d="M12 2a15.3 15.3 0 0 1 4 10 15.3 15.3 0 0 1-4 10 15.3 15.3 0 0 1-4-10 15.3 15.3 0 0 1 4-10z"></path>
			</svg>
		</div>

		<div class="container relative z-10">
			<div class="flex flex-col items-center mx-auto max-w-4xl text-center">
				<h2 class="mb-6 text-2xl italic font-black tracking-tight text-white uppercase no-anchor lg:text-4xl">
					<?php esc_html_e( 'Сургуулиа сонгоход тань тусламж хэрэгтэй байна уу?', 'ace' ); ?>
				</h2>
				<p class="mx-auto mb-12 max-w-2xl text-lg font-medium leading-relaxed text-blue-100/80">
					<?php esc_html_e( 'Манай туршлагатай зөвлөхүүд танд хамгийн тохиромжтой хувилбарыг сонгоход туслах болно.', 'ace' ); ?>
				</p>

				<!-- Buttons Container (Matches cta-banner block exactly) -->
				<div class="flex flex-col gap-4 justify-center items-center mt-4 sm:flex-row">
					<a href="/contact" class="inline-flex min-w-[200px] items-center justify-center rounded-xs border border-white bg-white px-8 py-4 font-bold text-primary no-underline shadow-2xl shadow-black/10 transition-all duration-300 hover:scale-105">
						<svg class="mr-3 w-5 h-5 text-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"></path></svg>
						<span class="text-xs font-bold tracking-widest uppercase"><?php esc_html_e( 'Зөвлөгөө авах', 'ace' ); ?></span>
					</a>
					<a href="#" class="inline-flex min-w-[200px] items-center justify-center rounded-xs border-2 border-white/30 bg-transparent px-8 py-4 font-bold text-white no-underline transition-all duration-300 hover:bg-white/10">
						<svg class="mr-3 w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path></svg>
						<span class="text-xs font-bold tracking-widest uppercase"><?php esc_html_e( 'Холбогдох', 'ace' ); ?></span>
					</a>
				</div>
			</div>
		</div>
	</section>

</main>

<?php
get_footer();
