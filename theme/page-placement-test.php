<?php
/**
 * Template Name: Placement Test
 *
 * @package aceedu
 */

/**
 * JS enqueuing for Placement Test.
 */
function ub_enqueue_placement_test_assets() {
	if ( is_page_template( 'page-placement-test.php' ) ) {
		wp_enqueue_script(
			'ub-placement-test',
			get_template_directory_uri() . '/assets/js/placement-test.js',
			array(),
			wp_get_theme()->get( 'Version' ),
			true
		);
	}
}
add_action( 'wp_enqueue_scripts', 'ub_enqueue_placement_test_assets' );

get_header();

// Get ACF Fields.
$time_limit = get_field( 'pt_time_limit' );
$time_limit = $time_limit ? (int) $time_limit : 30;

$questions = get_field( 'pt_questions' );
if ( ! is_array( $questions ) ) {
	$questions = array();
}

$levels = get_field( 'pt_levels' );
if ( ! is_array( $levels ) ) {
	$levels = array();
}

// Prepare JSON for frontend JS.
$test_data = array(
	'timeLimit' => $time_limit,
	'questions' => $questions,
	'levels'    => $levels,
	'i18n'      => array(
		'finish'   => esc_html__( 'Дуусгах', 'aceedu' ),
		'next'     => esc_html__( 'Дараах', 'aceedu' ),
		'unknown'  => esc_html__( 'Тодорхойгүй', 'aceedu' ),
		'no_match' => esc_html__( 'Таны оноонд таарах төвшин олдсонгүй.', 'aceedu' ),
	),
);
?>

	<section id="primary" class="relative w-full overflow-hidden py-16 lg:py-24 bg-slate-50 min-h-175 flex flex-col justify-center">
		<main id="main">
			<div class="container mx-auto max-w-3xl">
				<h1 class="hidden"><?php echo esc_html( get_the_title() ); ?></h1>
				<?php
				// Main Loop to output page content if any.
				while ( have_posts() ) :
					the_post();
					if ( get_the_content() ) :
						?>
						<div class="mb-8 prose max-w-none text-center">
							<?php the_content(); ?>
						</div>
						<?php
					endif;
				endwhile;
				?>

				<!-- The Vue/Vanilla JS App Container -->
				<div class="overflow-hidden mx-auto max-w-3xl" id="placement-test-app">
					
					<!-- Screen 1: Start -->
					<div id="test-start-screen" class="p-8 text-center lg:p-12">
						<h1 class="mb-4 text-3xl font-bold text-primary"><?php echo esc_html( get_the_title() ); ?></h1>
						<p class="mb-8 text-slate-600">
							<?php echo has_excerpt() ? esc_html( get_the_excerpt() ) : esc_html__( 'Солонгос хэлний төвшин тогтоох тестэнд тавтай морил. Та доорх товчийг дарж шалгалтаа эхлүүлнэ үү.', 'aceedu' ); ?>
						</p>
						
						<div class="mb-8 flex flex-col items-center justify-center gap-4 sm:flex-row">
							<div class="flex items-center gap-2 rounded-lg bg-white border border-slate-200 px-4 py-3 text-primary">
								<svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
								<span class="font-bold"><?php echo esc_html( $time_limit ); ?> <?php esc_html_e( 'минут', 'aceedu' ); ?></span>
							</div>
							<div class="flex items-center gap-2 rounded-lg bg-white border border-slate-200 px-4 py-3 text-primary">
								<svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8.228 9c.549-1.165 2.03-2 3.772-2 2.21 0 4 1.343 4 3 0 1.4-1.278 2.575-3.006 2.907-.542.104-.994.54-.994 1.093m0 3h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
								<span class="font-bold"><?php echo count( $questions ); ?> <?php esc_html_e( 'асуулт', 'aceedu' ); ?></span>
							</div>
						</div>

						<button id="btn-start-test" class="inline-flex items-center justify-center rounded-lg bg-primary px-12 py-4 font-bold text-white transition-colors duration-200 hover:bg-primary-dark">
							<?php esc_html_e( 'Тест эхлэх', 'aceedu' ); ?>
						</button>
					</div>

					<!-- Screen 2: Active Test -->
					<div id="test-active-screen" class="hidden flex-col h-full rounded-xl border border-slate-200 overflow-hidden bg-white">
						<div class="sticky top-0 z-10 flex items-center justify-between bg-white px-10 py-6 transition-colors" id="timer-header">
							<div class="text-sm font-bold text-slate-500">
								<?php esc_html_e( 'Асуулт', 'aceedu' ); ?> <span id="current-q-num" class="text-slate-900">1</span> / <?php echo count( $questions ); ?>
							</div>
							<div class="flex items-center gap-1 text-sm uppercase font-black text-primary " id="timer-display">
								<svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
								<span id="time-remaining">00:00</span>
							</div>
						</div>
						
						<!-- Progress bar -->
						<div class="w-full bg-slate-100 h-1">
							<div id="test-progress-bar" class="h-1 w-0 bg-primary transition-all duration-300"></div>
						</div>

						<div class="grow p-6 lg:p-10 bg-white" id="question-container">
							<!-- JS injects question here -->
						</div>

						<div class="flex justify-end border-t border-slate-100 bg-slate-50/50 px-10 py-6">
							<button id="btn-next-q" class="inline-flex cursor-not-allowed items-center justify-center rounded-lg bg-slate-200 px-6 py-3 font-bold text-slate-400 opacity-50 transition-colors duration-200" disabled>
								<?php esc_html_e( 'Дараах', 'aceedu' ); ?>
								<svg class="ml-2 h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
							</button>
						</div>
					</div>

					<!-- Screen 3: Result -->
					<div id="test-result-screen" class="hidden p-8 text-center lg:p-12">
						<div class="mx-auto mb-6 flex h-20 w-20 items-center justify-center rounded-full border border-slate-200 bg-white text-green-600">
							<svg class="h-10 w-10" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
						</div>
						<h2 class="mb-2 text-2xl font-bold text-slate-900"><?php esc_html_e( 'Тест амжилттай дууслаа!', 'aceedu' ); ?></h2>
						<p class="mb-8 text-slate-500"><?php esc_html_e( 'Таны авсан оноо болон төвшин:', 'aceedu' ); ?></p>
						
						<div class="mx-auto mb-8 max-w-md rounded-xl border border-slate-200 bg-white p-6 text-center">
							<div class="mb-4 flex items-center justify-between">
								<span class="text-slate-500"><?php esc_html_e( 'Нийт оноо:', 'aceedu' ); ?></span>
								<span class="text-xl font-black text-primary"><span id="result-score">0</span> / <span id="result-max-score">0</span></span>
							</div>
							<div class="flex flex-col gap-4 items-center justify-between border-t border-primary/10 pt-4">
								<span class="text-slate-500"><?php esc_html_e( 'Тодорхойлогдсон төвшин:', 'aceedu' ); ?></span>
								<span class="text-xl font-black text-secondary" id="result-level-title">...</span>
							</div>
							<div class="mt-4 text-sm text-slate-600" id="result-level-desc"></div>
						</div>

						<div id="result-course-action" class="hidden">
							<h3 class="mb-4 text-lg font-bold text-slate-900"><?php esc_html_e( 'Танд санал болгох сургалт:', 'aceedu' ); ?></h3>
							<a href="#" id="result-course-link" class="inline-flex items-center justify-center rounded-lg bg-primary px-8 py-4 font-bold text-white transition-colors duration-200 hover:bg-primary-dark">
								<?php esc_html_e( 'Сургалтын мэдээлэл харах', 'aceedu' ); ?>
							</a>
						</div>
					</div>

				</div>

			</div>
		</main><!-- #main -->
	</section><!-- #primary -->

	<script id="placement-test-data" type="application/json">
		<?php echo wp_json_encode( $test_data ); ?>
	</script>

<?php
get_footer();
