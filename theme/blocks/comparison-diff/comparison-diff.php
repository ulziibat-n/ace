<?php
/**
 * Comparison Diff (Table) Block Template.
 *
 * @param array $block The block settings and attributes.
 *
 * @package aceedu
 */

$ub_id = 'comparison-diff-' . $block['id'];
if ( ! empty( $block['anchor'] ) ) {
	$ub_id = $block['anchor'];
}

$ub_class_name = 'block-comparison-diff alignfull py-16 lg:py-24 bg-white w-full overflow-hidden relative';
if ( ! empty( $block['className'] ) ) {
	$ub_class_name .= ' ' . $block['className'];
}

// Талбаруудын утгыг авах.
$ub_headline    = get_field( 'cd_headline' );
$ub_description = get_field( 'cd_description' );

$ub_left_title  = get_field( 'cd_left_title' ) ?? 'Бие даан бэлтгэх';
$ub_right_title = get_field( 'cd_right_title' ) ?? 'ACE EDU WORLD-тэй хамт';

$ub_rows = get_field( 'cd_rows' );

$ub_title_mw = get_field( 'cd_title_max_width' ) ?? 768;
$ub_desc_mw  = get_field( 'cd_description_max_width' ) ?? 720;

$ub_title_rem = ( $ub_title_mw / 16 ) . 'rem';
$ub_desc_rem  = ( $ub_desc_mw / 16 ) . 'rem';

// Редактор дээр жишээ өгөгдөл харуулах.
if ( empty( $ub_rows ) ) {
	$ub_example_data = function_exists( 'ub_get_block_example_data' ) ? ub_get_block_example_data( $block ) : array();
	$ub_headline     = ! empty( $ub_headline ) ? $ub_headline : ( $ub_example_data['cd_headline'] ?? '' );
	$ub_description  = ! empty( $ub_description ) ? $ub_description : ( $ub_example_data['cd_description'] ?? '' );
	$ub_left_title   = ! empty( $ub_left_title ) ? $ub_left_title : ( $ub_example_data['cd_left_title'] ?? '' );
	$ub_right_title  = ! empty( $ub_right_title ) ? $ub_right_title : ( $ub_example_data['cd_right_title'] ?? '' );
	$ub_rows         = $ub_example_data['cd_rows'] ?? array();
}
?>

<section id="<?php echo esc_attr( $ub_id ); ?>" class="<?php echo esc_attr( $ub_class_name ); ?>">
	<div class="container">
		
		<!-- Header (Synced with Premium Layout). -->
		<div class="mb-12 flex flex-row items-end justify-between gap-8">
			<div class="grow">
				<?php if ( $ub_headline ) : ?>
					<h2 class="mb-2 text-2xl leading-none font-bold tracking-tight text-primary lg:text-3xl" style="max-width: <?php echo esc_attr( $ub_title_rem ); ?>;">
						<?php echo esc_html( $ub_headline ); ?>
					</h2>
				<?php endif; ?>

				<?php if ( $ub_description ) : ?>
					<p class="mt-4 text-base leading-tight text-slate-500 opacity-80" style="max-width: <?php echo esc_attr( $ub_desc_rem ); ?>;">
						<?php echo wp_kses_post( $ub_description ); ?>
					</p>
				<?php endif; ?>
			</div>
		</div>

		<!-- Comparison Table/Grid. -->
		<div class="w-full">
			
			<!-- Table Header (Desktop Only). -->
			<div class="mb-0 hidden grid-cols-1 border-b border-slate-100 pb-4 min-[500px]:grid min-[500px]:grid-cols-2 lg:grid-cols-[18.75rem_1fr_1fr]">
				<div class="pr-8 text-sm font-bold text-slate-400 uppercase min-[500px]:col-span-2 lg:col-span-1"></div>
				<div class="flex items-center pr-8 text-sm font-bold text-slate-500 uppercase">
					<?php echo esc_html( $ub_left_title ); ?>
				</div>
				<div class="flex items-center pr-8 text-sm font-bold text-primary uppercase">
					<?php echo esc_html( $ub_right_title ); ?>
				</div>
			</div>

			<!-- Rows. -->
			<?php if ( ! empty( $ub_rows ) ) : ?>
				<div class="">
					<?php foreach ( $ub_rows as $row ) : ?>
						<?php
						$row_criteria = $row['criteria'] ?? '';
						$row_left     = $row['left_point'] ?? '';
						$row_right    = $row['right_point'] ?? '';
						?>
						<div class="group grid grid-cols-1 gap-4 border-b border-slate-50 py-8 min-[500px]:grid-cols-2 min-[500px]:gap-0 lg:grid-cols-[18.75rem_1fr_1fr]">
							
							<!-- Criteria Column. -->
							<div class="pr-8 text-xs font-bold text-slate-500 uppercase min-[500px]:col-span-2 min-[500px]:mb-4 lg:col-span-1 lg:mb-0">
								<?php echo esc_html( $row_criteria ); ?>
							</div>

							<!-- Bad/Self Column. -->
							<div class="relative px-0 min-[500px]:pr-4 lg:pr-8">
								<div class="mb-2 flex items-start min-[500px]:hidden">
									<span class="text-xs font-bold text-slate-400 uppercase"><?php echo esc_html( $ub_left_title ); ?></span>
								</div>
								<div class="italic:not-italic max-w-xs text-sm leading-snug text-slate-500">
									<?php echo wp_kses_post( $row_left ); ?>
								</div>
							</div>

							<!-- Good/ACE Column. -->
							<div class="relative mt-4 px-0 min-[500px]:mt-0">
								<div class="mb-2 flex items-start min-[500px]:hidden">
									<span class="text-xs font-bold text-primary uppercase"><?php echo esc_html( $ub_right_title ); ?></span>
								</div>
								<div class="max-w-xs text-sm leading-snug font-medium text-primary">
									<?php echo wp_kses_post( $row_right ); ?>
								</div>
							</div>

						</div>
					<?php endforeach; ?>
				</div>
			<?php endif; ?>

		</div>

	</div>
</section>
