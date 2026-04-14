<?php
/**
 * The template for displaying single school
 *
 * @package aceedu
 * @since   1.0.0
 */

get_header();

while ( have_posts() ) :
	the_post();
	$ub_school_id = get_the_ID();

	// ACF Fields.
	$ub_en_name     = get_field( 'school_name_en' );
	$ub_ko_name     = get_field( 'school_name_ko' );
	$ub_short_intro = get_field( 'short_intro' );
	$ub_hero_image  = get_field( 'hero_image' );

	// Quick Facts.
	$ub_visa_rate     = get_field( 'visa_success_rate_text' );
	$ub_accreditation = get_field( 'accreditation_status' );
	$ub_ranking_korea = get_field( 'ranking_korea_text' );

	// Taxonomies.
	$ub_locations  = get_the_terms( $ub_school_id, 'school_location' );
	$ub_guarantors = get_the_terms( $ub_school_id, 'guarantor_requirement' );
	$ub_types      = get_the_terms( $ub_school_id, 'school_type' );

	?>

	<article id="post-<?php the_ID(); ?>" <?php post_class( 'school-single' ); ?>>
		
		<!-- Hero Section (Premium Layout) -->
		<header class="relative group entry-header">
			<div class="relative w-full text-white bg-slate-900">
				<?php
				if ( has_post_thumbnail() ) :
					the_post_thumbnail( 'full', array( 'class' => 'absolute inset-0 z-10 h-full w-full object-cover' ) );
				elseif ( $ub_hero_image ) :
					echo wp_get_attachment_image( $ub_hero_image, 'full', false, array( 'class' => 'absolute inset-0 z-10 h-full w-full object-cover' ) );
				endif;
				?>
				<div class="pt-76">
					<div class="overflow-hidden relative z-20 py-20 w-full lg:pb-32">
						<!-- Gradient Backdrop Blur Overlay -->
						<div class="pointer-events-none absolute inset-0 z-0 backdrop-blur-xs mask-[linear-gradient(to_top,black_40%,transparent_100%)]"></div>
					
						<div class="absolute inset-0 z-0 bg-linear-to-t from-slate-950/95 to-slate-950/0"></div>
					
						<div class="container relative z-10">
							<div class="flex flex-col items-start">
								<!-- Badges -->
								<div class="flex gap-3 items-center mb-4">
									<div class="flex flex-wrap gap-2">
										<?php if ( $ub_locations ) : ?>
											<span class="rounded-xs bg-white px-2 py-1.5 text-[0.625rem] font-bold uppercase leading-none text-primary"><?php echo esc_html( $ub_locations[0]->name ); ?></span>
										<?php endif; ?>
										<?php if ( $ub_types ) : ?>
											<span class="rounded-xs bg-primary px-2 py-1.5 text-[0.625rem] font-bold uppercase leading-none text-white"><?php echo esc_html( $ub_types[0]->name ); ?></span>
										<?php endif; ?>
										<?php if ( $ub_accreditation ) : ?>
											<span class="rounded-xs border border-white/20 bg-white/10 px-2 py-1.5 text-[0.625rem] font-bold uppercase leading-none text-white backdrop-blur-sm">
												<?php
												$ub_accred_choices = array(
													'certified' => esc_html__( 'Магадлан итгэмжлэгдсэн', 'aceedu' ),
													'excellent' => esc_html__( 'Шилдэг магадлан', 'aceedu' ),
													'none' => esc_html__( 'Магадлан байхгүй', 'aceedu' ),
												);
												echo esc_html( $ub_accred_choices[ $ub_accreditation ] ?? '' );
												?>
											</span>
										<?php endif; ?>
									</div>
								</div>

								<h1 class="text-4xl font-bold leading-none text-white translate-y-4 lg:text-6xl"><?php the_title(); ?></h1>
								<?php if ( $ub_en_name ) : ?>
									<p class="mt-8 max-w-4xl text-lg text-white/90"><?php echo esc_html( $ub_en_name ); ?></p>
								<?php endif; ?>
								
								<!-- Meta Info Row -->
								<div class="mt-8 flex flex-wrap items-center gap-x-6 gap-y-4 text-[0.625rem] font-bold uppercase tracking-widest text-white/60">
									<div class="flex gap-2 items-center">
										<span class="w-2 h-2 bg-emerald-400 rounded-full"></span>
										<?php esc_html_e( 'Элсэлт нээлттэй', 'aceedu' ); ?>
									</div>
									<?php if ( $ub_guarantors ) : ?>
										<span class="opacity-30">|</span>
										<div class="flex gap-2 items-center">
											<svg class="w-3.5 h-3.5 text-blue-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"></path></svg>
											<?php echo esc_html( $ub_guarantors[0]->name ); ?>
										</div>
									<?php endif; ?>

									<?php if ( $ub_ranking_korea ) : ?>
										<span class="opacity-30">|</span>
										<div class="flex gap-2 items-center">
											<svg class="w-3.5 h-3.5 text-amber-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 3v4M3 5h4M6 17v4m-2-2h4m5-16l2.286 6.857L21 12l-5.714 2.143L13 21l-2.286-6.857L5 12l5.714-2.143L13 3z"></path></svg>
											<span class="mr-1 font-medium lowercase text-white/40"><?php esc_html_e( 'Эрэмбэ:', 'aceedu' ); ?></span>
											<span class="text-white/80"><?php echo esc_html( $ub_ranking_korea ); ?></span>
										</div>
									<?php endif; ?>

									<?php if ( $ub_visa_rate ) : ?>
										<span class="opacity-30">|</span>
										<div class="flex gap-2 items-center">
											<svg class="w-3.5 h-3.5 text-emerald-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
											<span class="mr-1 font-medium lowercase text-white/40"><?php esc_html_e( 'Виза:', 'aceedu' ); ?></span>
											<span class="text-white/80"><?php echo esc_html( $ub_visa_rate ); ?></span>
										</div>
									<?php endif; ?>
								</div>

								<!-- Hero Action Buttons -->
								<div class="flex flex-wrap gap-3 mt-10">
									<?php if ( get_field( 'official_website' ) ) : ?>
										<a href="<?php the_field( 'official_website' ); ?>" target="_blank" class="inline-flex items-center gap-2 rounded-xs border border-white/20 bg-white/10 px-6 py-2.5 text-[10px] font-black uppercase tracking-widest text-white no-underline backdrop-blur-sm transition-all hover:bg-white/20">
											<svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 12a9 9 0 01-9 9m9-9a9 9 0 00-9-9m9 9H3m9 9a9 9 0 01-9-9m9 9c1.657 0 3-4.03 3-9s-1.343-9-3-9m0 18c-1.657 0-3-4.03-3-9s1.343-9 3-9m-9 9h18"></path></svg>
											<?php esc_html_e( 'Вэбсайт', 'aceedu' ); ?>
										</a>
									<?php endif; ?>
									<?php if ( get_field( 'brochure_url' ) ) : ?>
										<a href="<?php the_field( 'brochure_url' ); ?>" target="_blank" class="inline-flex items-center gap-2 rounded-xs bg-white px-6 py-2.5 text-[10px] font-black uppercase tracking-widest text-primary no-underline transition-all hover:bg-slate-100">
											<svg class="w-4 h-4 italic text-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 21h10a2 2 0 002-2V9.414a1 1 0 00-.293-.707l-5.414-5.414A1 1 0 0012.586 3H7a2 2 0 00-2 2v14a2 2 0 002 2z"></path></svg>
											<?php esc_html_e( 'Танилцуулга', 'aceedu' ); ?>
										</a>
									<?php endif; ?>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</header>

		<!-- Main Content Area (Single Column Centered) -->
		<div class="py-16 bg-slate-50/30 lg:py-32">
			<div class="container">
				<div class="max-w-4xl">
					
					<!-- Overview Section -->
					<section id="overview" class="mb-20">
						<div class="">
							<h2><?php esc_html_e( 'Сургуулийн тухай', 'aceedu' ); ?></h2>
							
							<!-- Gallery Slider -->
							<?php
							$ub_school_gallery = get_field( 'school_gallery' );
							if ( $ub_school_gallery ) :
								?>
								<div class="mb-12 not-prose swiper" data-school-gallery>
									<div class="swiper-wrapper">
										<?php foreach ( $ub_school_gallery as $ub_image_id ) : ?>
											<div class="overflow-hidden relative shadow-2xl swiper-slide group aspect-21/9 cursor-zoom-in rounded-xs">
												<?php echo wp_get_attachment_image( $ub_image_id, 'full', false, array( 'class' => 'w-full h-full object-cover transition-transform duration-700 group-hover:scale-105' ) ); ?>
												<div class="flex absolute inset-0 items-end p-12 to-transparent opacity-0 transition-opacity bg-linear-to-t from-slate-950/60 group-hover:opacity-100">
													<p class="text-sm font-medium tracking-wide text-white"><?php echo esc_html( wp_get_attachment_caption( $ub_image_id ) ); ?></p>
												</div>
											</div>
										<?php endforeach; ?>
									</div>
									<div class="flex justify-between items-center px-4 mt-6">
										<div class="swiper-pagination static! w-auto!"></div>
										<div class="flex gap-2">
											<button data-gal-prev class="flex justify-center items-center w-10 h-10 bg-white border shadow-sm transition-colors cursor-pointer rounded-xs border-slate-100 text-slate-400 hover:text-primary hover:shadow-md">
												<svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path></svg>
											</button>
											<button data-gal-next class="flex justify-center items-center w-10 h-10 bg-white border shadow-sm transition-colors cursor-pointer rounded-xs border-slate-100 text-slate-400 hover:text-primary hover:shadow-md">
												<svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
											</button>
										</div>
									</div>
								</div>
							<?php endif; ?>

							<?php the_content(); ?>
							<?php if ( $ub_short_intro ) : ?>
								<blockquote>
									<p><?php echo esc_html( $ub_short_intro ); ?></p>
								</blockquote>
							<?php endif; ?>
						</div>
					</section>

					<!-- Admissions Section -->
					<section id="admissions" class="mb-20">
						<div class="">
							<h2><?php esc_html_e( 'Элсэлтийн мэдээлэл', 'aceedu' ); ?></h2>
						</div>
						<div class="grid grid-cols-1 gap-4 mb-8 not-prose md:grid-cols-2">
							<div class="p-6 border rounded-xs border-slate-100 bg-slate-50">
								<span class="mb-3 block text-[10px] font-bold tracking-widest text-slate-400 uppercase"><?php esc_html_e( 'Элсэлтийн сарууд', 'aceedu' ); ?></span>
								<?php
								$ub_months = get_field( 'intake_months' );
								if ( $ub_months ) :
									?>
									<div class="flex flex-wrap gap-2">
										<?php foreach ( $ub_months as $ub_m ) : ?>
											<span class="px-3 py-1 text-xs font-bold bg-white border shadow-sm rounded-xs border-slate-200 text-slate-700"><?php echo esc_html( $ub_m ); ?> сар</span>
										<?php endforeach; ?>
									</div>
								<?php endif; ?>
							</div>
							<div class="p-6 border rounded-xs border-slate-100 bg-slate-50">
								<span class="mb-3 block text-[10px] font-bold tracking-widest text-slate-400 uppercase"><?php esc_html_e( 'Шаардлага', 'aceedu' ); ?></span>
								<div class="space-y-2 text-sm">
									<div class="flex gap-2 items-center">
										<span class="w-1.5 h-1.5 rounded-full bg-primary"></span>
										<span class="font-medium text-slate-600">TOPIK: <strong class="text-slate-900"><?php the_field( 'topik_requirement' ); ?></strong></span>
									</div>
									<div class="flex gap-2 items-center">
										<span class="w-1.5 h-1.5 rounded-full bg-primary"></span>
										<span class="font-medium text-slate-600">English: <strong class="text-slate-900"><?php the_field( 'english_requirement' ); ?></strong></span>
									</div>
								</div>
							</div>
						</div>
						<div class="">
							<?php the_field( 'application_notes' ); ?>
						</div>
					</section>

					<!-- Tuition Section -->
					<section id="tuition" class="mb-20">
						<div class="">
							<h2><?php esc_html_e( 'Төлбөр & Тэтгэлэг', 'aceedu' ); ?></h2>
						</div>
						
						<!-- Fees Summary -->
						<div class="grid grid-cols-1 gap-4 mb-12 not-prose md:grid-cols-2">
							<div class="p-6 text-white rounded-xs bg-slate-900">
								<span class="mb-1 block text-[10px] font-bold tracking-widest text-blue-300 uppercase"><?php esc_html_e( 'Хэлний бэлтгэл', 'aceedu' ); ?></span>
								<span class="block text-2xl font-black"><?php the_field( 'tuition_language_course' ); ?></span>
								<p class="mt-1 text-[10px] text-blue-100/40">Нэг улирал (6 сар)</p>
							</div>
							<div class="p-6 text-white shadow-lg rounded-xs bg-primary shadow-primary/20">
								<span class="mb-1 block text-[10px] font-bold tracking-widest text-blue-100 uppercase"><?php esc_html_e( 'Бакалавр (Ерөнхий)', 'aceedu' ); ?></span>
								<span class="block text-2xl font-black"><?php the_field( 'tuition_undergraduate' ); ?></span>
								<p class="mt-1 text-[10px] text-blue-100/40">Нэг улирал</p>
							</div>
						</div>

						<!-- Tuition Tables and Scholarships (Same logic as before) -->
						<?php get_template_part( 'template-parts/content/school-tuition-tables' ); // Extracted logic for clarity if needed, but I'll keep it inline for now or restore it properly. ?>
						
						<?php /* RESTORING TABLES INLINE */ ?>
						<?php if ( have_rows( 'tuition_bachelor_list' ) ) : ?>
							<div class="mb-12 not-prose">
								<div class="flex flex-col items-center mb-8">
									<h3 class="mb-6 text-2xl font-black text-primary"><?php esc_html_e( 'Бакалаврын төлбөр (Мэргэжлээр)', 'aceedu' ); ?></h3>
									<div class="relative w-full max-w-2xl">
										<input type="text" data-tuition-search="bachelor" placeholder="<?php esc_attr_e( 'Мэргэжлээр хайх', 'aceedu' ); ?>" 
											class="px-6 py-4 w-full text-center bg-white border shadow-sm transition-all rounded-xs border-slate-200 placeholder:italic focus:border-primary focus:ring-2 focus:ring-primary/20">
									</div>
								</div>
								<div class="overflow-hidden bg-white border shadow-sm rounded-xs border-slate-100">
									<table class="w-full text-left border-collapse">
										<thead>
											<tr class="border-b border-slate-100 bg-slate-50">
												<th class="px-6 py-4 w-2/3 text-xs font-black tracking-widest uppercase text-slate-900"><?php esc_html_e( 'Тэнхим', 'aceedu' ); ?></th>
												<th class="px-6 py-4 text-xs font-black tracking-widest uppercase text-slate-900"><?php esc_html_e( 'Төлбөр', 'aceedu' ); ?></th>
											</tr>
										</thead>
										<tbody data-tuition-table="bachelor">
											<?php
											while ( have_rows( 'tuition_bachelor_list' ) ) :
												the_row();
												?>
												<tr class="border-b transition-colors border-slate-50 hover:bg-slate-50/50">
													<td class="px-6 py-4 text-sm font-medium text-slate-700"><?php the_sub_field( 'department' ); ?></td>
													<td class="px-6 py-4 text-sm font-bold text-slate-900"><?php the_sub_field( 'fee' ); ?></td>
												</tr>
											<?php endwhile; ?>
										</tbody>
									</table>
								</div>
							</div>
						<?php endif; ?>

						<?php if ( have_rows( 'tuition_master_list' ) ) : ?>
							<div class="mb-12 not-prose">
								<div class="flex flex-col items-center mb-8">
									<h3 class="mb-6 text-2xl font-black text-primary"><?php esc_html_e( 'Магистр / Докторын төлбөр', 'aceedu' ); ?></h3>
									<div class="relative w-full max-w-2xl">
										<input type="text" data-tuition-search="master" placeholder="<?php esc_attr_e( 'Мэргэжлээр хайх', 'aceedu' ); ?>" 
											class="px-6 py-4 w-full text-center bg-white border shadow-sm transition-all rounded-xs border-slate-200 placeholder:italic focus:border-primary focus:ring-2 focus:ring-primary/20">
									</div>
								</div>
								<div class="overflow-hidden bg-white border shadow-sm rounded-xs border-slate-100">
									<table class="w-full text-left border-collapse">
										<thead>
											<tr class="border-b border-slate-100 bg-slate-50">
												<th class="px-6 py-4 w-2/3 text-xs font-black tracking-widest uppercase text-slate-900"><?php esc_html_e( 'Тэнхим', 'aceedu' ); ?></th>
												<th class="px-6 py-4 text-xs font-black tracking-widest uppercase text-slate-900"><?php esc_html_e( 'Төлбөр', 'aceedu' ); ?></th>
											</tr>
										</thead>
										<tbody data-tuition-table="master">
											<?php
											while ( have_rows( 'tuition_master_list' ) ) :
												the_row();
												?>
												<tr class="border-b transition-colors border-slate-50 hover:bg-slate-50/50">
													<td class="px-6 py-4 text-sm font-medium text-slate-700"><?php the_sub_field( 'department' ); ?></td>
													<td class="px-6 py-4 text-sm font-bold text-slate-900"><?php the_sub_field( 'fee' ); ?></td>
												</tr>
											<?php endwhile; ?>
										</tbody>
									</table>
								</div>
							</div>
						<?php endif; ?>

						<!-- Scholarships -->
						<?php if ( have_rows( 'scholarships_list' ) ) : ?>
							<div class="pt-16 mt-16 border-t not-prose border-slate-100">
								<h3 class="mb-12 text-2xl font-black text-center text-primary"><?php esc_html_e( 'Тэтгэлэгийн нөхцөлүүд', 'aceedu' ); ?></h3>
								<div class="grid grid-cols-1 gap-4 md:grid-cols-2">
									<?php
									while ( have_rows( 'scholarships_list' ) ) :
										the_row();
										?>
										<div class="flex flex-col justify-between p-6 border transition-all rounded-xs border-slate-200 bg-slate-50 hover:shadow-md">
											<span class="mb-4 text-xs font-medium text-slate-400"><?php the_sub_field( 'condition' ); ?></span>
											<div class="text-xl font-bold text-slate-900 md:text-2xl"><?php the_sub_field( 'benefit' ); ?></div>
										</div>
									<?php endwhile; ?>
								</div>
							</div>
						<?php endif; ?>
					</section>

					<!-- Dormitory Section -->
					<section id="dormitory" class="mb-20">
						<div class="">
							<h2><?php esc_html_e( 'Дотуур байр', 'aceedu' ); ?></h2>
						</div>
						<div class="grid grid-cols-1 gap-4 mb-8 not-prose md:grid-cols-2">
							<div class="flex flex-col justify-center p-6 border border-blue-100 rounded-xs bg-blue-50/50">
								<span class="mb-1 text-[10px] font-black tracking-widest text-primary/60 uppercase"><?php esc_html_e( 'Дотуур байрны төлбөр', 'aceedu' ); ?></span>
								<span class="text-xl font-bold text-slate-900"><?php the_field( 'dormitory_fee' ); ?></span>
							</div>
							<div class="flex flex-col justify-center p-6 border rounded-xs border-slate-100 bg-slate-50">
								<span class="mb-1 text-[10px] font-black tracking-widest text-slate-400 uppercase"><?php esc_html_e( 'Хоолны төлбөр', 'aceedu' ); ?></span>
								<span class="text-xl font-bold text-slate-900"><?php the_field( 'meal_fee' ); ?></span>
							</div>
						</div>
						<div class="">
							<?php the_field( 'dormitory_info' ); ?>
						</div>
						<?php
						$ub_dorm_gallery = get_field( 'dormitory_gallery' );
						if ( $ub_dorm_gallery ) :
							?>
							<div class="mt-8 not-prose swiper" data-school-gallery>
								<div class="swiper-wrapper">
									<?php foreach ( $ub_dorm_gallery as $ub_image_id ) : ?>
										<div class="overflow-hidden relative swiper-slide group aspect-video cursor-zoom-in rounded-xs">
											<?php echo wp_get_attachment_image( $ub_image_id, 'large', false, array( 'class' => 'w-full h-full object-cover transition-transform duration-500 group-hover:scale-110' ) ); ?>
										</div>
									<?php endforeach; ?>
								</div>
								<div class="flex gap-2 justify-center mt-4">
									<div class="swiper-pagination static!"></div>
								</div>
							</div>
						<?php endif; ?>
					</section>

					<!-- Strengths Section -->
					<?php if ( have_rows( 'strengths_repeater' ) ) : ?>
						<section id="strengths" class="mb-20">
							<div class="">
								<h2><?php esc_html_e( 'Давуу талууд', 'aceedu' ); ?></h2>
							</div>
							<div class="grid grid-cols-1 gap-4 not-prose md:grid-cols-2">
								<?php
								while ( have_rows( 'strengths_repeater' ) ) :
									the_row();
									?>
									<div class="flex gap-4 p-6 bg-white border rounded-xs border-slate-100 shadow-xs">
										<div class="flex justify-center items-center w-10 h-10 shrink-0 rounded-xs bg-primary/5 text-primary">
											<svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
										</div>
										<div>
											<h4 class="mb-1 text-base font-bold text-slate-900"><?php the_sub_field( 'title' ); ?></h4>
											<p class="text-xs leading-relaxed text-slate-500"><?php the_sub_field( 'description' ); ?></p>
										</div>
									</div>
								<?php endwhile; ?>
							</div>
						</section>
					<?php endif; ?>

					<!-- FAQ Section -->
					<?php if ( have_rows( 'faq_repeater' ) ) : ?>
						<section id="faq" class="mb-20">
							<div class="">
								<h2><?php esc_html_e( 'Түгээмэл асуултууд', 'aceedu' ); ?></h2>
							</div>
							<div class="space-y-3 not-prose">
								<?php
								while ( have_rows( 'faq_repeater' ) ) :
									the_row();
									?>
									<div class="overflow-hidden border faq-item rounded-xs border-slate-100 shadow-xs">
										<button class="flex justify-between items-center px-5 py-4 w-full text-left faq-trigger group">
											<span class="text-sm font-bold transition-colors text-slate-900 group-hover:text-primary"><?php the_sub_field( 'question' ); ?></span>
											<svg class="w-4 h-4 transition-all transform shrink-0 text-slate-400 group-hover:text-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
										</button>
										<div class="hidden px-5 pb-5 faq-content text-slate-600">
											<?php the_sub_field( 'answer' ); ?>
										</div>
									</div>
								<?php endwhile; ?>
							</div>
						</section>
					<?php endif; ?>

				</div>
			</div>
		</div>

		<!-- Related Schools -->
		<section class="overflow-hidden relative py-16 w-full bg-slate-100 lg:py-32">
			<div class="container">
				<div class="flex gap-8 justify-between items-end mb-12">
					<div class="max-w-xl grow">
						<h2 class="mb-2 text-2xl font-bold tracking-tight leading-none lg:text-3xl"><?php esc_html_e( 'Төстэй сургуулиуд', 'aceedu' ); ?></h2>
						<p class="text-base leading-tight opacity-80 text-slate-500"><?php esc_html_e( 'Таны сонирхсон байршил дахь бусад сургуулиудыг эндээс хараарай.', 'aceedu' ); ?></p>
					</div>
					<div class="flex gap-2 items-center pb-2 shrink">
						<button data-related-posts-carousel-prev class="flex justify-center items-center w-12 h-12 bg-white rounded-full border border-white shadow-sm transition-all cursor-pointer group shadow-primary/5 hover:border-primary hover:bg-primary">
							<svg class="w-5 h-5 transition-colors text-primary group-hover:text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path></svg>
						</button>
						<button data-related-posts-carousel-next class="flex justify-center items-center w-12 h-12 bg-white rounded-full border border-white shadow-sm transition-all cursor-pointer group shadow-primary/5 hover:border-primary hover:bg-primary">
							<svg class="w-5 h-5 transition-colors text-primary group-hover:text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
						</button>
					</div>
				</div>
				<?php
				$ub_related_query = new WP_Query(
					array(
						'post_type'      => 'school',
						'posts_per_page' => 10,
						'post__not_in'   => array( $ub_school_id ),
						'tax_query'      => $ub_locations ? array(
							array(
								'taxonomy' => 'school_location',
								'field'    => 'term_id',
								'terms'    => $ub_locations[0]->term_id,
							),
						) : array(),
					)
				);

				if ( $ub_related_query->have_posts() ) :
					?>
					<div data-related-posts-carousel class="swiper group overflow-visible!">
						<div class="swiper-wrapper flex flex-nowrap gap-[10px] group-[.swiper-initialized]:gap-0">
							<?php
							while ( $ub_related_query->have_posts() ) :
								$ub_related_query->the_post();
								?>
								<div class="swiper-slide w-full max-w-[calc((96rem-30px)/4)]">
									<?php get_template_part( 'template-parts/content-school-card' ); ?>
								</div>
								<?php
							endwhile;
							wp_reset_postdata();
							?>
						</div>
					</div>
				<?php endif; ?>
			</div>
		</section>

		<!-- Lead Capture Section (Matches cta-banner block exactly) -->
		<?php
		$ub_cta_title_mw = get_field( 'inquiry_cta_title_max_width' ) ?? 768;
		$ub_cta_text_mw  = get_field( 'inquiry_cta_text_max_width' ) ?? 720;

		$ub_cta_title_rem = ( $ub_cta_title_mw / 16 ) . 'rem';
		$ub_cta_text_rem  = ( $ub_cta_text_mw / 16 ) . 'rem';
		?>
		<section id="inquiry" class="overflow-hidden relative py-16 text-white bg-primary lg:py-24">
			<div class="pointer-events-none absolute top-[-10%] right-[-10%] h-[400px] w-[400px] opacity-10 lg:h-[600px] lg:w-[600px]">
				<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" class="w-full h-full text-white">
					<circle cx="12" cy="12" r="10"></circle>
					<line x1="2" y1="12" x2="22" y2="12"></line>
					<path d="M12 2a15.3 15.3 0 0 1 4 10 15.3 15.3 0 0 1-4 10 15.3 15.3 0 0 1-4-10 15.3 15.3 0 0 1 4-10z"></path>
				</svg>
			</div>

			<div class="container relative z-10">
				<div class="flex flex-col items-center mx-auto text-center">
					<h2 class="mx-auto mb-3 text-2xl font-bold leading-tight text-white lg:text-3xl" style="max-width: <?php echo esc_attr( $ub_cta_title_rem ); ?>;">
						<?php the_field( 'inquiry_cta_title' ); ?>
					</h2>

					<p class="mx-auto mb-6 text-base text-white opacity-90" style="max-width: <?php echo esc_attr( $ub_cta_text_rem ); ?>;">
						<?php the_field( 'inquiry_cta_text' ); ?>
					</p>

					<div class="flex flex-col gap-3 justify-center items-center mt-4 sm:flex-row">
						<?php
						$ub_messenger_link = get_field( 'messenger_link' );
						if ( $ub_messenger_link ) :
							?>
							<a href="<?php echo esc_url( $ub_messenger_link['url'] ); ?>" target="<?php echo esc_attr( $ub_messenger_link['target'] ?? '_self' ); ?>" class="inline-flex min-w-[140px] items-center justify-center rounded-xs border border-white bg-white px-6 py-2 font-bold text-primary no-underline shadow-xl shadow-black/5 transition-all duration-300 hover:bg-slate-100">
								<span class="text-xs leading-none uppercase"><?php echo esc_html( ! empty( $ub_messenger_link['title'] ) ? $ub_messenger_link['title'] : __( 'Товчлуур 1', 'ace' ) ); ?></span>
							</a>
						<?php endif; ?>

						<?php
						$ub_kakao_link = get_field( 'kakao_link' );
						if ( $ub_kakao_link ) :
							?>
							<a href="<?php echo esc_url( $ub_kakao_link['url'] ); ?>" target="<?php echo esc_attr( $ub_kakao_link['target'] ?? '_self' ); ?>" class="inline-flex min-w-[140px] items-center justify-center rounded-xs border-2 border-white/30 bg-transparent px-6 py-2 font-bold text-white no-underline transition-all duration-300 hover:bg-white/10">
								<span class="text-xs leading-none uppercase"><?php echo esc_html( ! empty( $ub_kakao_link['title'] ) ? $ub_kakao_link['title'] : __( 'Товчлуур 2', 'ace' ) ); ?></span>
							</a>
						<?php endif; ?>
					</div>
				</div>
			</div>
		</section>

		<!-- Mobile Bottom Sticky CTA -->
		<div class="fixed right-6 bottom-6 left-6 z-50 animate-bounce-subtle md:hidden">
			<a href="#inquiry" class="flex justify-center items-center py-4 w-full text-xs font-black tracking-widest text-white uppercase border shadow-2xl rounded-xs border-white/20 bg-primary shadow-primary/40">
				<?php esc_html_e( 'ЗӨВЛӨГӨӨ АВАХ', 'aceedu' ); ?>
			</a>
		</div>

	</article>

	<!-- Gallery Logic (Same as before) -->
	<script>
	document.addEventListener('DOMContentLoaded', function() {
		// Tuition Search
		const setupSearch = (inputId, tableId) => {
			const input = document.querySelector(`[data-tuition-search="${inputId}"]`);
			const rows = document.querySelectorAll(`[data-tuition-table="${tableId}"] tr`);
			
			if (!input || !rows.length) return;
			
			input.addEventListener('input', function() {
				const query = this.value.toLowerCase().trim();
				rows.forEach(row => {
					const text = row.querySelector('td').textContent.toLowerCase();
					row.style.display = text.includes(query) ? '' : 'none';
				});
			});
		};

		setupSearch('bachelor', 'bachelor');
		setupSearch('master', 'master');

		// Swiper Initialization
		if (typeof Swiper !== 'undefined') {
			document.querySelectorAll('[data-school-gallery]').forEach(function(el) {
				const prevBtn = el.querySelector('[data-gal-prev]');
				const nextBtn = el.querySelector('[data-gal-next]');
				
				new Swiper(el, {
					slidesPerView: 1,
					spaceBetween: 20,
					loop: true,
					pagination: {
						el: el.querySelector('.swiper-pagination'),
						clickable: true,
					},
					navigation: {
						nextEl: nextBtn,
						prevEl: prevBtn,
					},
				});
			});
		}
	});
	</script>

	<?php
endwhile;

get_footer();
