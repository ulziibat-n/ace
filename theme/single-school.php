<?php
/**
 * The template for displaying single school
 */

get_header();

while ( have_posts() ) :
	the_post();
	$ub_school_id = get_the_ID();

	// ACF Fields
	$ub_en_name     = get_field( 'school_name_en' );
	$ub_ko_name     = get_field( 'school_name_ko' );
	$ub_short_intro = get_field( 'short_intro' );
	$ub_logo        = get_field( 'logo' );
	$ub_hero_image  = get_field( 'hero_image' );

	// Quick Facts
	$ub_visa_rate     = get_field( 'visa_success_rate_text' );
	$ub_accreditation = get_field( 'accreditation_status' );
	$ub_ranking_korea = get_field( 'ranking_korea_text' );

	// Taxonomies
	$ub_locations  = get_the_terms( $ub_school_id, 'school_location' );
	$ub_guarantors = get_the_terms( $ub_school_id, 'guarantor_requirement' );
	$ub_types      = get_the_terms( $ub_school_id, 'school_type' );

	// Prepare content for TOC
	ob_start();
	?>
	<section id="overview">
		<h2><?php esc_html_e( 'Сургуулийн тухай', 'ace' ); ?></h2>
		
		<!-- School Gallery Slider -->
		<?php
		$ub_school_gallery = get_field( 'school_gallery' );
		if ( $ub_school_gallery ) :
			?>
			<div class="not-prose mb-12 swiper" data-school-gallery>
				<div class="swiper-wrapper">
					<?php foreach ( $ub_school_gallery as $ub_image_id ) : ?>
						<div class="swiper-slide rounded-xs overflow-hidden aspect-21/9 relative group cursor-zoom-in shadow-2xl">
							<?php echo wp_get_attachment_image( $ub_image_id, 'full', false, array( 'class' => 'w-full h-full object-cover transition-transform duration-700 group-hover:scale-105' ) ); ?>
							<div class="absolute inset-0 bg-linear-to-t from-slate-950/60 to-transparent opacity-0 group-hover:opacity-100 transition-opacity flex items-end p-12">
								<p class="text-white text-sm font-medium tracking-wide"><?php echo esc_html( wp_get_attachment_caption( $ub_image_id ) ); ?></p>
							</div>
						</div>
					<?php endforeach; ?>
				</div>
				<div class="mt-6 flex justify-between items-center px-4">
					<div class="swiper-pagination static! w-auto!"></div>
					<div class="flex gap-2">
						<button data-gal-prev class="w-10 h-10 rounded-xs bg-white shadow-sm border border-slate-100 flex items-center justify-center text-slate-400 hover:text-primary transition-colors hover:shadow-md cursor-pointer">
							<svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path></svg>
						</button>
						<button data-gal-next class="w-10 h-10 rounded-xs bg-white shadow-sm border border-slate-100 flex items-center justify-center text-slate-400 hover:text-primary transition-colors hover:shadow-md cursor-pointer">
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
	</section>

	<section id="admissions">
		<h2><?php esc_html_e( 'Элсэлтийн мэдээлэл', 'ace' ); ?></h2>
		<div class="not-prose grid grid-cols-1 md:grid-cols-2 gap-4 mb-8">
			<div class="bg-slate-50 p-6 rounded-xs border border-slate-100">
				<span class="block text-slate-400 text-[10px] font-bold uppercase tracking-widest mb-3"><?php esc_html_e( 'Элсэлтийн сарууд', 'ace' ); ?></span>
				<?php
				$ub_months = get_field( 'intake_months' );
				if ( $ub_months ) :
					?>
					<div class="flex flex-wrap gap-2">
						<?php foreach ( $ub_months as $ub_m ) : ?>
							<span class="px-3 py-1 bg-white rounded-xs shadow-sm border border-slate-200 text-xs font-bold text-slate-700"><?php echo esc_html( $ub_m ); ?> сар</span>
						<?php endforeach; ?>
					</div>
				<?php endif; ?>
			</div>
			<div class="bg-slate-50 p-6 rounded-xs border border-slate-100">
				<span class="block text-slate-400 text-[10px] font-bold uppercase tracking-widest mb-3"><?php esc_html_e( 'Шаардлага', 'ace' ); ?></span>
				<div class="space-y-2 text-sm">
					<div class="flex items-center gap-2">
						<span class="w-1.5 h-1.5 rounded-full bg-primary"></span>
						<span class="text-slate-600 font-medium">TOPIK: <strong class="text-slate-900"><?php the_field( 'topik_requirement' ); ?></strong></span>
					</div>
					<div class="flex items-center gap-2">
						<span class="w-1.5 h-1.5 rounded-full bg-primary"></span>
						<span class="text-slate-600 font-medium">English: <strong class="text-slate-900"><?php the_field( 'english_requirement' ); ?></strong></span>
					</div>
				</div>
			</div>
		</div>
		<?php the_field( 'application_notes' ); ?>
	</section>

	<section id="tuition">
		<h2><?php esc_html_e( 'Төлбөр & Тэтгэлэг', 'ace' ); ?></h2>
		
		<!-- General Tuition Overview -->
		<div class="not-prose grid grid-cols-1 md:grid-cols-2 gap-4 mb-12">
			<div class="p-6 bg-slate-900 rounded-xs text-white">
				<span class="block text-blue-300 text-[10px] font-bold uppercase tracking-widest mb-1">Хэлний бэлтгэл</span>
				<span class="text-2xl font-black block"><?php the_field( 'tuition_language_course' ); ?></span>
				<p class="text-blue-100/40 text-[10px] mt-1">Нэг улирал (6 сар)</p>
			</div>
			<div class="p-6 bg-primary rounded-xs text-white shadow-lg shadow-primary/20">
				<span class="block text-blue-100 text-[10px] font-bold uppercase tracking-widest mb-1">Бакалавр (Ерөнхий)</span>
				<span class="text-2xl font-black block"><?php the_field( 'tuition_undergraduate' ); ?></span>
				<p class="text-blue-100/40 text-[10px] mt-1">Нэг улирал</p>
			</div>
		</div>

		<!-- Searchable Tuition by Major (Bachelor) -->
		<?php if ( have_rows( 'tuition_bachelor_list' ) ) : ?>
			<div class="not-prose mb-12">
				<div class="flex flex-col items-center mb-8">
					<h3 class="text-2xl font-black text-primary mb-6"><?php esc_html_e( 'Бакалавр', 'ace' ); ?></h3>
					<div class="w-full max-w-2xl relative">
						<input type="text" data-tuition-search="bachelor" placeholder="<?php esc_attr_e( 'Мэргэжлээр хайх', 'ace' ); ?>" 
							class="w-full py-4 px-6 bg-white border border-slate-200 rounded-xs shadow-sm focus:ring-2 focus:ring-primary/20 focus:border-primary transition-all text-center placeholder:italic">
					</div>
				</div>
				<div class="overflow-hidden border border-slate-100 rounded-xs bg-white shadow-sm">
					<table class="w-full text-left border-collapse">
						<thead>
							<tr class="bg-slate-50 border-b border-slate-100">
								<th class="px-6 py-4 text-xs font-black uppercase tracking-widest text-slate-900 w-2/3"><?php esc_html_e( 'Тэнхим', 'ace' ); ?></th>
								<th class="px-6 py-4 text-xs font-black uppercase tracking-widest text-slate-900"><?php esc_html_e( 'Төлбөр', 'ace' ); ?></th>
							</tr>
						</thead>
						<tbody data-tuition-table="bachelor">
							<?php
							while ( have_rows( 'tuition_bachelor_list' ) ) :
								the_row();
								?>
								<tr class="border-b border-slate-50 hover:bg-slate-50/50 transition-colors">
									<td class="px-6 py-4 text-sm font-medium text-slate-700"><?php the_sub_field( 'department' ); ?></td>
									<td class="px-6 py-4 text-sm font-bold text-slate-900"><?php the_sub_field( 'fee' ); ?></td>
								</tr>
							<?php endwhile; ?>
						</tbody>
					</table>
				</div>
			</div>
		<?php endif; ?>

		<!-- Searchable Tuition by Major (Master) -->
		<?php if ( have_rows( 'tuition_master_list' ) ) : ?>
			<div class="not-prose mb-12">
				<div class="flex flex-col items-center mb-8">
					<h3 class="text-2xl font-black text-primary mb-6"><?php esc_html_e( 'Магистр', 'ace' ); ?></h3>
					<div class="w-full max-w-2xl relative">
						<input type="text" data-tuition-search="master" placeholder="<?php esc_attr_e( 'Мэргэжлээр хайх', 'ace' ); ?>" 
							class="w-full py-4 px-6 bg-white border border-slate-200 rounded-xs shadow-sm focus:ring-2 focus:ring-primary/20 focus:border-primary transition-all text-center placeholder:italic">
					</div>
				</div>
				<div class="overflow-hidden border border-slate-100 rounded-xs bg-white shadow-sm">
					<table class="w-full text-left border-collapse">
						<thead>
							<tr class="bg-slate-50 border-b border-slate-100">
								<th class="px-6 py-4 text-xs font-black uppercase tracking-widest text-slate-900 w-2/3"><?php esc_html_e( 'Тэнхим', 'ace' ); ?></th>
								<th class="px-6 py-4 text-xs font-black uppercase tracking-widest text-slate-900"><?php esc_html_e( 'Төлбөр', 'ace' ); ?></th>
							</tr>
						</thead>
						<tbody data-tuition-table="master">
							<?php
							while ( have_rows( 'tuition_master_list' ) ) :
								the_row();
								?>
								<tr class="border-b border-slate-50 hover:bg-slate-50/50 transition-colors">
									<td class="px-6 py-4 text-sm font-medium text-slate-700"><?php the_sub_field( 'department' ); ?></td>
									<td class="px-6 py-4 text-sm font-bold text-slate-900"><?php the_sub_field( 'fee' ); ?></td>
								</tr>
							<?php endwhile; ?>
						</tbody>
					</table>
				</div>
			</div>
		<?php endif; ?>

		<!-- Scholarship Cards Section -->
		<?php if ( have_rows( 'scholarships_list' ) ) : ?>
			<div class="not-prose mt-16 pt-16 border-t border-slate-100">
				<h3 class="text-2xl font-black text-primary text-center mb-12"><?php esc_html_e( 'Тэтгэлэг', 'ace' ); ?></h3>
				<div class="grid grid-cols-1 md:grid-cols-2 gap-4">
					<?php
					while ( have_rows( 'scholarships_list' ) ) :
						the_row();
						?>
						<div class="bg-slate-50 border border-slate-200 rounded-xs p-6 flex flex-col justify-between transition-all hover:shadow-md">
							<span class="text-xs text-slate-400 font-medium mb-4"><?php the_sub_field( 'condition' ); ?></span>
							<div class="text-xl md:text-2xl font-bold text-slate-900"><?php the_sub_field( 'benefit' ); ?></div>
						</div>
					<?php endwhile; ?>
				</div>
			</div>
		<?php else : ?>
			<?php if ( get_field( 'scholarship_info' ) ) : ?>
				<div class="mt-8">
					<h4 class="text-lg font-bold text-slate-900 mb-4"><?php esc_html_e( 'Тэтгэлэгийн ерөнхий мэдээлэл', 'ace' ); ?></h4>
					<?php the_field( 'scholarship_info' ); ?>
				</div>
			<?php endif; ?>
		<?php endif; ?>

		<!-- Dormitory Fees & Gallery -->
		<div id="dormitory" class="mt-20 pt-16 border-t border-slate-100">
			<h2><?php esc_html_e( 'Дотуур байр', 'ace' ); ?></h2>
			<div class="not-prose grid grid-cols-1 md:grid-cols-2 gap-8 mb-8">
				<div class="p-6 bg-blue-50/50 border border-blue-100 rounded-xs flex flex-col justify-center">
					<span class="text-[10px] font-black uppercase tracking-widest text-primary/60 mb-1">Дотуур байрны төлбөр</span>
					<span class="text-xl font-bold text-slate-900"><?php the_field( 'dormitory_fee' ); ?></span>
				</div>
				<div class="p-6 bg-slate-50 border border-slate-100 rounded-xs flex flex-col justify-center">
					<span class="text-[10px] font-black uppercase tracking-widest text-slate-400 mb-1">Хоолны төлбөр</span>
					<span class="text-xl font-bold text-slate-900"><?php the_field( 'meal_fee' ); ?></span>
				</div>
			</div>
			
			<div class="singular-content mb-8">
				<?php the_field( 'dormitory_info' ); ?>
			</div>

			<!-- Dormitory Gallery Slider -->
			<?php
			$ub_dorm_gallery = get_field( 'dormitory_gallery' );
			if ( $ub_dorm_gallery ) :
				?>
				<div class="not-prose mt-8 swiper" data-school-gallery>
					<div class="swiper-wrapper">
						<?php foreach ( $ub_dorm_gallery as $ub_image_id ) : ?>
							<div class="swiper-slide rounded-xs overflow-hidden aspect-video relative group cursor-zoom-in">
								<?php echo wp_get_attachment_image( $ub_image_id, 'large', false, array( 'class' => 'w-full h-full object-cover transition-transform duration-500 group-hover:scale-110' ) ); ?>
							</div>
						<?php endforeach; ?>
					</div>
					<div class="mt-4 flex justify-center gap-2">
						<div class="swiper-pagination static!"></div>
					</div>
				</div>
			<?php endif; ?>
		</div>
	</section>

	<?php if ( have_rows( 'strengths_repeater' ) ) : ?>
		<section id="strengths">
			<h2><?php esc_html_e( 'Давуу талууд', 'ace' ); ?></h2>
			<div class="not-prose grid grid-cols-1 md:grid-cols-2 gap-4">
				<?php
				while ( have_rows( 'strengths_repeater' ) ) :
					the_row();
					?>
					<div class="bg-white p-6 rounded-xs border border-slate-100 shadow-xs flex gap-4">
						<div class="w-10 h-10 rounded-xs bg-primary/5 text-primary shrink-0 flex items-center justify-center">
							<svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
						</div>
						<div>
							<h4 class="text-base font-bold text-slate-900 mb-1"><?php the_sub_field( 'title' ); ?></h4>
							<p class="text-slate-500 text-xs leading-relaxed"><?php the_sub_field( 'description' ); ?></p>
						</div>
					</div>
				<?php endwhile; ?>
			</div>
		</section>
	<?php endif; ?>

	<?php if ( have_rows( 'faq_repeater' ) ) : ?>
		<section id="faq">
			<h2><?php esc_html_e( 'Түгээмэл асуултууд', 'ace' ); ?></h2>
			<div class="not-prose space-y-3">
				<?php
				while ( have_rows( 'faq_repeater' ) ) :
					the_row();
					?>
					<div class="faq-item border border-slate-100 rounded-xs overflow-hidden shadow-xs">
						<button class="faq-trigger w-full px-5 py-4 text-left flex items-center justify-between group">
							<span class="font-bold text-slate-900 text-sm group-hover:text-primary transition-colors"><?php the_sub_field( 'question' ); ?></span>
							<svg class="w-4 h-4 text-slate-400 group-hover:text-primary transition-all transform shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
						</button>
						<div class="faq-content hidden px-5 pb-5 text-slate-600 singular-content">
							<?php the_sub_field( 'answer' ); ?>
						</div>
					</div>
				<?php endwhile; ?>
			</div>
		</section>
	<?php endif; ?>
	<?php
	$ub_combined_content = ob_get_clean();
	$ub_toc_data         = ub_get_toc_and_content( $ub_combined_content );
	?>

	<article id="post-<?php the_ID(); ?>" <?php post_class( 'school-single' ); ?>>
		
		<!-- Hero Section (Matches content-single.php) -->
		<header class="relative entry-header group">
			<div class="relative w-full text-white bg-slate-900">
				<?php
				if ( has_post_thumbnail() ) :
					the_post_thumbnail( 'full', array( 'class' => 'w-full h-full absolute inset-0 z-10 object-cover' ) );
				elseif ( $ub_hero_image ) :
					echo wp_get_attachment_image( $ub_hero_image, 'full', false, array( 'class' => 'w-full h-full absolute inset-0 z-10 object-cover' ) );
				endif;
				?>
				<div class="relative z-20 pt-96 pb-20 w-full lg:pb-32 to-slate-950/30 bg-linear-to-t from-slate-950/95">
					<div class="container">
						<div class="w-full lg:w-3/4">
							<div class="flex flex-col items-start lg:mx-auto lg:max-w-content">
								<div class="flex items-center gap-3 mb-6">
									<?php if ( $ub_logo ) : ?>
										<div class="w-12 h-12 p-1.5 bg-white rounded-xs shadow-xl">
											<?php echo wp_get_attachment_image( $ub_logo, 'thumbnail', false, array( 'class' => 'w-full h-full object-contain' ) ); ?>
										</div>
									<?php endif; ?>
									<div class="flex flex-wrap gap-2">
										<?php if ( $ub_locations ) : ?>
											<span class="text-[0.625rem] font-bold uppercase leading-none px-2 py-1.5 bg-white text-primary rounded-xs"><?php echo esc_html( $ub_locations[0]->name ); ?></span>
										<?php endif; ?>
										<?php if ( $ub_types ) : ?>
											<span class="text-[0.625rem] font-bold uppercase leading-none px-2 py-1.5 bg-primary text-white rounded-xs"><?php echo esc_html( $ub_types[0]->name ); ?></span>
										<?php endif; ?>
									</div>
								</div>

								<h1 class="text-4xl lg:text-5xl font-bold leading-tight"><?php the_title(); ?></h1>
								<?php if ( $ub_en_name ) : ?>
									<p class="mt-8 text-lg"><?php echo esc_html( $ub_en_name ); ?></p>
								<?php endif; ?>
								
								<div class="mt-8 text-[0.625rem] font-bold uppercase tracking-widest flex flex-wrap items-center gap-y-4 gap-x-6">
									<div class="flex items-center gap-2">
										<span class="w-2 h-2 rounded-full bg-emerald-400"></span>
										<?php esc_html_e( 'Элсэлт нээлттэй', 'ace' ); ?>
									</div>
									<?php if ( $ub_guarantors ) : ?>
										<span class="opacity-30">|</span>
										<div class="flex items-center gap-2">
											<svg class="w-3.5 h-3.5 text-blue-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"></path></svg>
											<?php echo esc_html( $ub_guarantors[0]->name ); ?>
										</div>
									<?php endif; ?>

									<?php if ( $ub_ranking_korea ) : ?>
										<span class="opacity-30">|</span>
										<div class="flex items-center gap-2">
											<svg class="w-3.5 h-3.5 text-amber-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 3v4M3 5h4M6 17v4m-2-2h4m5-16l2.286 6.857L21 12l-5.714 2.143L13 21l-2.286-6.857L5 12l5.714-2.143L13 3z"></path></svg>
											<span class="text-white/60 lowercase mr-1 font-medium"><?php esc_html_e( 'Эрэмбэ:', 'ace' ); ?></span>
											<span class="text-white"><?php echo esc_html( $ub_ranking_korea ); ?></span>
										</div>
									<?php endif; ?>

									<?php if ( $ub_visa_rate ) : ?>
										<span class="opacity-30">|</span>
										<div class="flex items-center gap-2">
											<svg class="w-3.5 h-3.5 text-emerald-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
											<span class="text-white/60 lowercase mr-1 font-medium"><?php esc_html_e( 'Виза:', 'ace' ); ?></span>
											<span class="text-white"><?php echo esc_html( $ub_visa_rate ); ?></span>
										</div>
									<?php endif; ?>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</header>

		<!-- Content Area (Matches content-single.php layout) -->
		<div class="py-16 lg:py-32 bg-slate-50/30">
			<div class="container">
				<div class="flex flex-col lg:flex-row-reverse gap-12">
					
					<!-- Sidebar -->
					<div class="w-full lg:w-1/4">
						<div class="relative lg:sticky lg:top-8 space-y-12">
							
							<!-- TOC -->
							<div class="pb-12 mb-12 border-b lg:leading-none singular-content lg:text-xs lg:pl-8 lg:mb-0 lg:pb-0 lg:border-0">
								<h3 class="font-black text-xl lg:uppercase lg:text-xs tracking-widest mb-4"><?php esc_html_e( 'Агуулга', 'ace' ); ?></h3>
								<ul data-content-toc class="mt-4 list-none pl-0 space-y-2">
									<?php echo $ub_toc_data['toc']; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
								</ul>
							</div>

							<!-- Quick Facts Card -->
							<div class="bg-white rounded-xs p-6 border border-slate-100 shadow-sm">
								<h3 class="text-sm font-bold text-slate-900 mb-4 uppercase tracking-wider"><?php esc_html_e( 'Хурдан мэдээлэл', 'ace' ); ?></h3>
								<div class="space-y-4 text-xs">
									<?php if ( $ub_accreditation ) : ?>
										<div class="flex items-center justify-between py-2 border-b border-slate-50">
											<span class="text-slate-500"><?php esc_html_e( 'Магадлан итгэмжлэл', 'ace' ); ?></span>
											<span class="text-slate-900 font-bold">
											<?php
												$ub_accred_choices = array(
													'certified' => esc_html__( 'Тийм', 'ace' ),
													'excellent' => esc_html__( 'Шилдэг', 'ace' ),
													'none' => esc_html__( 'Үгүй', 'ace' ),
												);
												echo esc_html( $ub_accred_choices[ $ub_accreditation ] );
												?>
											</span>
										</div>
									<?php endif; ?>
								</div>

								<div class="mt-6 space-y-2">
									<?php if ( get_field( 'official_website' ) ) : ?>
										<a href="<?php the_field( 'official_website' ); ?>" target="_blank" class="flex items-center justify-center gap-2 w-full py-3 bg-slate-50 text-slate-700 text-[10px] uppercase tracking-widest font-black rounded-xs hover:bg-slate-100 transition-all border border-slate-100 no-underline">
											<svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 12a9 9 0 01-9 9m9-9a9 9 0 00-9-9m9 9H3m9 9a9 9 0 01-9-9m9 9c1.657 0 3-4.03 3-9s-1.343-9-3-9m0 18c-1.657 0-3-4.03-3-9s1.343-9 3-9m-9 9h18"></path></svg>
											Вэбсайт
										</a>
									<?php endif; ?>
									<?php if ( get_field( 'brochure_url' ) ) : ?>
										<a href="<?php the_field( 'brochure_url' ); ?>" target="_blank" class="flex items-center justify-center gap-2 w-full py-3 bg-blue-50 text-primary text-[10px] uppercase tracking-widest font-black rounded-xs hover:bg-blue-100 transition-all border border-blue-100 no-underline italic">
											<svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 21h10a2 2 0 002-2V9.414a1 1 0 00-.293-.707l-5.414-5.414A1 1 0 0012.586 3H7a2 2 0 00-2 2v14a2 2 0 002 2z"></path></svg>
											Танилцуулга
										</a>
									<?php endif; ?>
								</div>
							</div>

						</div>
					</div>

					<!-- Main Content -->
					<div class="relative w-full lg:w-3/4">
					<div class="singular-content lg:mx-auto lg:max-content-width">
						<?php
						echo $ub_toc_data['content']; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
						?>
					</div>

						<!-- Inquiry Section (Refined CTA Banner) -->
						<div class="mt-20">
							<section id="inquiry" class="relative overflow-hidden bg-primary text-white py-16 lg:py-24 rounded-xs shadow-2xl shadow-primary/30 scroll-mt-32 border-[12px] border-white shadow-black/10">
								<div class="absolute right-[-10%] top-[-10%] w-[400px] h-[400px] lg:w-[600px] lg:h-[600px] opacity-10 pointer-events-none">
									<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" class="w-full h-full text-white">
										<circle cx="12" cy="12" r="10"></circle>
										<line x1="2" y1="12" x2="22" y2="12"></line>
										<path d="M12 2a15.3 15.3 0 0 1 4 10 15.3 15.3 0 0 1-4 10 15.3 15.3 0 0 1-4-10 15.3 15.3 0 0 1 4-10z"></path>
									</svg>
								</div>
								<div class="container relative z-10">
									<div class="max-w-4xl mx-auto text-center flex flex-col items-center">
										<h2 class="text-3xl md:text-5xl font-black mb-6 text-white no-anchor italic uppercase tracking-tight"><?php the_field( 'inquiry_cta_title' ); ?></h2>
										<p class="text-blue-100/80 text-lg mb-12 max-w-2xl mx-auto font-medium"><?php the_field( 'inquiry_cta_text' ); ?></p>
										<div class="flex flex-wrap justify-center gap-4">
											<?php if ( get_field( 'messenger_link' ) ) : ?>
												<a href="<?php the_field( 'messenger_link' ); ?>" class="inline-flex items-center justify-center bg-white text-primary px-8 py-4 rounded-xs font-bold transition-all duration-300 hover:scale-105 shadow-xl no-underline border border-white min-w-[160px] uppercase tracking-widest text-xs">
													<svg class="w-5 h-5 mr-3 text-primary" fill="currentColor" viewBox="0 0 24 24"><path d="M12 2C6.477 2 2 6.145 2 11.258c0 2.903 1.46 5.498 3.746 7.226.188.14.306.357.306.598l.004 2.147c.002.396.43.645.767.44l2.42-1.467a.998.998 0 01.554-.165c.422.022.853.033 1.288.033 5.523 0 10-4.145 10-9.258C22 6.145 17.523 2 12 2zm1.083 12.317l-2.517-2.686L5.65 14.4l5.417-5.753 2.516 2.686L18.498 8.8l-5.415 5.517z"/></svg>
													Messenger
												</a>
											<?php endif; ?>
											<?php if ( get_field( 'kakao_link' ) ) : ?>
												<a href="<?php the_field( 'kakao_link' ); ?>" class="inline-flex items-center justify-center bg-[#FEE500] text-[#3c1e1e] px-8 py-4 rounded-xs font-bold transition-all duration-300 hover:scale-105 shadow-xl no-underline border border-[#FEE500] min-w-[160px] uppercase tracking-widest text-xs">
													<svg class="w-5 h-5 mr-3" fill="currentColor" viewBox="0 0 24 24"><path d="M12 3c-4.97 0-9 3.185-9 7.115 0 2.558 1.707 4.805 4.283 6.11l-.813 2.977c-.114.417.385.76.713.543l3.51-2.31c.42.062.855.095 1.307.095 4.97 0 9-3.185 9-7.115S16.97 3 12 3z"/></svg>
													KakaoTalk
												</a>
											<?php endif; ?>
										</div>
									</div>
								</div>
							</section>
						</div>

					</div>
				</div>
			</div>
		</div>

		<!-- Related Schools -->
		<section class="overflow-hidden relative py-16 w-full lg:py-32 bg-slate-100">
			<div class="container">
				<div class="flex gap-8 justify-between items-end mb-12">
					<div class="max-w-xl grow">
						<h2 class="mb-2 text-2xl font-bold tracking-tight lg:text-3xl"><?php esc_html_e( 'Төстэй сургуулиуд', 'ace' ); ?></h2>
						<p class="font-medium leading-tight text-foreground/60"><?php esc_html_e( 'Таны сонирхсон байршил дахь бусад сургуулиудыг эндээс хараарай.', 'ace' ); ?></p>
					</div>
					<div class="flex gap-2 items-center pb-2 shrink">
						<button data-related-posts-carousel-prev class="flex justify-center items-center w-12 h-12 bg-white rounded-full border border-white shadow-sm transition-all cursor-pointer shadow-primary/5 group hover:bg-primary hover:border-primary">
							<svg class="w-5 h-5 transition-colors text-primary group-hover:text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path></svg>
						</button>
						<button data-related-posts-carousel-next class="flex justify-center items-center w-12 h-12 bg-white rounded-full border border-white shadow-sm transition-all cursor-pointer shadow-primary/5 group hover:bg-primary hover:border-primary">
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
					<div data-related-posts-carousel class="overflow-visible! swiper group">
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

		<!-- Mobile Bottom Sticky CTA -->
		<div class="fixed bottom-6 left-6 right-6 z-50 md:hidden animate-bounce-subtle">
			<a href="#inquiry" class="flex items-center justify-center w-full py-4 bg-primary text-white font-black rounded-xs shadow-2xl shadow-primary/40 border border-white/20 uppercase tracking-widest text-xs">
				<?php esc_html_e( 'ЗӨВЛӨГӨӨ АВАХ', 'ace' ); ?>
			</a>
		</div>

	</article>

	<!-- Search & Gallery Logic -->
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

		// Swiper Initialization for galleries
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
