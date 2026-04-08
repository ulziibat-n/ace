<?php
/**
 * The template for displaying school archives
 */

get_header();

$ub_current_location = isset( $_GET['location'] ) ? sanitize_text_field( wp_unslash( $_GET['location'] ) ) : '';
$ub_current_guarantor = isset( $_GET['guarantor'] ) ? sanitize_text_field( wp_unslash( $_GET['guarantor'] ) ) : '';
$ub_search_query     = isset( $_GET['s_school'] ) ? sanitize_text_field( wp_unslash( $_GET['s_school'] ) ) : '';

// Taxonomies for filters
$ub_locations  = get_terms( array( 'taxonomy' => 'school_location', 'hide_empty' => true ) );
$ub_guarantors = get_terms( array( 'taxonomy' => 'guarantor_requirement', 'hide_empty' => true ) );

// Options Page Fields
$ub_archive_title = get_field( 'school_archive_title', 'option' ) ?: esc_html__( 'Сургуулиуд', 'ace' );
$ub_archive_desc  = get_field( 'school_archive_description', 'option' ) ?: esc_html__( 'БНСУ-ын шилдэг Их Дээд Сургуулиудын нэгдсэн мэдээлэл.', 'ace' );
$ub_archive_bg    = get_field( 'school_archive_bg', 'option' );

?>

<main id="primary" class="site-main">

	<!-- Hero Section (Matches archive.php) -->
	<header class="relative entry-header group">
		<div class="relative w-full text-white bg-slate-900">
			<?php if ( $ub_archive_bg ) : ?>
				<?php echo wp_get_attachment_image( $ub_archive_bg, 'full', false, array( 'class' => 'w-full h-full absolute inset-0 z-10 object-cover' ) ); ?>
			<?php endif; ?>
			<div class="relative z-30 pt-48 pb-16 w-full lg:pt-72 lg:pb-32 to-slate-950/30 bg-linear-to-t from-slate-950/95">
				<div class="max-w-page">
					<div class="flex flex-col">
						<h1 class="text-4xl font-bold leading-tight lg:text-6xl"><?php echo esc_html( $ub_archive_title ); ?></h1>
						<?php if ( $ub_archive_desc ) : ?>
							<div class="mt-8 text-lg max-w-content ml-0!">
								<p><?php echo esc_html( $ub_archive_desc ); ?></p>
							</div>
						<?php endif; ?>
					</div>
				</div>
			</div>
		</div>
	</header>

	<!-- Main Content Area -->
	<section class="bg-slate-100 min-h-screen py-16 lg:py-24">
		<div class="container">
			<div class="flex flex-col lg:flex-row gap-12">
				
				<!-- Sidebar Filters (1/4) -->
				<aside class="w-full lg:w-1/4">
					<div class="lg:sticky lg:top-8">
						<div class="bg-white rounded-xs border border-slate-200/60 p-6 md:p-8">
							<h3 class="text-sm font-black text-slate-900 mb-6 flex items-center gap-2 uppercase tracking-widest italic">
								<svg class="w-4 h-4 text-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2.586a1 1 0 01-.293.707l-6.414 6.414a1 1 0 00-.293.707V17l-4 4v-6.586a1 1 0 00-.293-.707L3.293 7.293A1 1 0 013 6.586V4z"></path></svg>
								<?php esc_html_e( 'Шүүлтүүр', 'ace' ); ?>
							</h3>
							
							<form action="<?php echo esc_url( get_post_type_archive_link( 'school' ) ); ?>" method="GET" class="space-y-6">
								<!-- Search -->
								<div>
									<label for="s_school" class="block text-[10px] font-black uppercase tracking-widest text-slate-400 mb-2"><?php esc_html_e( 'Хайлт', 'ace' ); ?></label>
									<div class="relative">
										<input type="text" name="s_school" id="s_school" value="<?php echo esc_attr( $ub_search_query ); ?>" 
											class="w-full pl-4 pr-4 py-3 bg-slate-50 border-slate-200 focus:border-primary focus:ring-0 rounded-xs text-sm text-slate-900 transition-all placeholder:text-slate-300" 
											placeholder="Сургуулийн нэр...">
									</div>
								</div>

								<!-- Location Filter -->
								<div>
									<label for="location" class="block text-[10px] font-black uppercase tracking-widest text-slate-400 mb-2"><?php esc_html_e( 'Байршил', 'ace' ); ?></label>
									<select name="location" id="location" class="w-full py-3 px-4 bg-slate-50 border-slate-200 focus:border-primary focus:ring-0 rounded-xs text-sm text-slate-900 appearance-none cursor-pointer">
										<option value=""><?php esc_html_e( 'Бүх байршил', 'ace' ); ?></option>
										<?php foreach ( $ub_locations as $ub_loc ) : ?>
											<option value="<?php echo esc_attr( $ub_loc->slug ); ?>" <?php selected( $ub_current_location, $ub_loc->slug ); ?>><?php echo esc_html( $ub_loc->name ); ?></option>
										<?php endforeach; ?>
									</select>
								</div>

								<!-- Guarantor Filter -->
								<div>
									<label for="guarantor" class="block text-[10px] font-black uppercase tracking-widest text-slate-400 mb-2"><?php esc_html_e( 'Батлан даагч', 'ace' ); ?></label>
									<select name="guarantor" id="guarantor" class="w-full py-3 px-4 bg-slate-50 border-slate-200 focus:border-primary focus:ring-0 rounded-xs text-sm text-slate-900 appearance-none cursor-pointer">
										<option value=""><?php esc_html_e( 'Бүх төрөл', 'ace' ); ?></option>
										<?php foreach ( $ub_guarantors as $ub_guar ) : ?>
											<option value="<?php echo esc_attr( $ub_guar->slug ); ?>" <?php selected( $ub_current_guarantor, $ub_guar->slug ); ?>><?php echo esc_html( $ub_guar->name ); ?></option>
										<?php endforeach; ?>
									</select>
								</div>

								<!-- Buttons -->
								<div class="pt-4 space-y-3">
									<button type="submit" class="w-full inline-flex items-center justify-center bg-primary text-white px-6 py-4 rounded-xs font-bold transition-all duration-300 hover:bg-slate-900 shadow-lg shadow-primary/20 no-underline uppercase text-xs tracking-widest">
										<?php esc_html_e( 'Шүүлтүүр хэрэглэх', 'ace' ); ?>
									</button>
									
									<?php if ( $ub_current_location || $ub_current_guarantor || $ub_search_query ) : ?>
										<a href="<?php echo esc_url( get_post_type_archive_link( 'school' ) ); ?>" class="w-full inline-flex items-center justify-center bg-slate-100 text-slate-600 px-6 py-3 rounded-xs font-bold transition-all duration-300 hover:bg-slate-200 no-underline uppercase text-[10px] tracking-widest">
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
					<div class="flex items-center justify-between mb-8 px-2">
						<div>
							<?php
							global $wp_query;
							$ub_count = $wp_query->found_posts;
							?>
							<p class="text-sm font-medium text-slate-500">
								<?php printf( esc_html__( 'Нийт %s сургууль олдлоо', 'ace' ), '<span class="text-slate-900 font-bold">' . esc_html( $ub_count ) . '</span>' ); ?>
							</p>
						</div>
					</div>

					<!-- Grid -->
					<?php if ( have_posts() ) : ?>
						<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-[10px]">
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
						<div class="bg-white rounded-xs p-16 text-center border border-slate-200/60">
							<div class="w-16 h-16 bg-slate-50 rounded-full flex items-center justify-center mx-auto mb-6 text-slate-300">
								<svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
							</div>
							<h3 class="text-xl font-bold text-slate-900 mb-2 italic uppercase"><?php esc_html_e( 'Илэрц олдсонгүй', 'ace' ); ?></h3>
							<p class="text-slate-500 text-sm"><?php esc_html_e( 'Та хайлтын үг эсвэл шүүлтүүрээ өөрчилж үзнэ үү.', 'ace' ); ?></p>
						</div>
					<?php endif; ?>
				</div>

			</div>
		</div>
	</section>

	<!-- Lead Capture Section (Refined CTA Banner) -->
	<section id="help-cta" class="relative overflow-hidden bg-primary text-white py-16 lg:py-24">
		<div class="absolute right-[-10%] top-[-10%] w-[400px] h-[400px] lg:w-[600px] lg:h-[600px] opacity-10 pointer-events-none">
			<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" class="w-full h-full text-white">
				<circle cx="12" cy="12" r="10"></circle>
				<line x1="2" y1="12" x2="22" y2="12"></line>
				<path d="M12 2a15.3 15.3 0 0 1 4 10 15.3 15.3 0 0 1-4 10 15.3 15.3 0 0 1-4-10 15.3 15.3 0 0 1 4-10z"></path>
			</svg>
		</div>

		<div class="container relative z-10">
			<div class="max-w-4xl mx-auto text-center flex flex-col items-center">
				<h2 class="text-2xl lg:text-4xl font-black mb-6 text-white no-anchor italic uppercase tracking-tight">
					<?php esc_html_e( 'Сургуулиа сонгоход тань тусламж хэрэгтэй байна уу?', 'ace' ); ?>
				</h2>
				<p class="text-blue-100/80 text-lg mb-12 max-w-2xl mx-auto font-medium leading-relaxed">
					<?php esc_html_e( 'Манай туршлагатай зөвлөхүүд танд хамгийн тохиромжтой хувилбарыг сонгоход туслах болно.', 'ace' ); ?>
				</p>

				<!-- Buttons Container (Matches cta-banner block exactly) -->
				<div class="flex flex-col sm:flex-row gap-4 mt-4 items-center justify-center">
					<a href="/contact" class="inline-flex items-center justify-center bg-white text-primary px-8 py-4 rounded-xs font-bold transition-all duration-300 hover:scale-105 shadow-2xl shadow-black/10 no-underline border border-white min-w-[200px]">
						<svg class="w-5 h-5 mr-3 text-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"></path></svg>
						<span class="uppercase font-bold tracking-widest text-xs"><?php esc_html_e( 'Зөвлөгөө авах', 'ace' ); ?></span>
					</a>
					<a href="#" class="inline-flex items-center justify-center bg-transparent border-2 border-white/30 text-white px-8 py-4 rounded-xs font-bold transition-all duration-300 hover:bg-white/10 no-underline min-w-[200px]">
						<svg class="w-5 h-5 mr-3 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path></svg>
						<span class="uppercase font-bold tracking-widest text-xs"><?php esc_html_e( 'Холбогдох', 'ace' ); ?></span>
					</a>
				</div>
			</div>
		</div>
	</section>

</main>

<?php
get_footer();
