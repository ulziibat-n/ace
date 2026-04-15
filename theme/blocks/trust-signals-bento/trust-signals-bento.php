<?php
/**
 * Trust Signals Bento Block Template.
 *
 * @param array $block The block settings and attributes.
 *
 * @package aceedu
 */

$ub_id = 'trust-signals-bento-' . $block['id'];
if ( ! empty( $block['anchor'] ) ) {
	$ub_id = $block['anchor'];
}

$ub_class_name = 'block-ts-bento alignfull py-16 bg-white lg:py-24 w-full';
if ( ! empty( $block['className'] ) ) {
	$ub_class_name .= ' ' . $block['className'];
}

// ACF Fields.
$ub_headline    = get_field( 'headline' );
$ub_description = get_field( 'description' );

$ub_sig1 = get_field( 'sig1' );
$ub_sig2 = get_field( 'sig2' );
$ub_sig3 = get_field( 'sig3' );
$ub_sig4 = get_field( 'sig4' );

// Preview fallback.
if ( empty( $ub_sig1['number'] ) ) {
	$ub_example_data = function_exists( 'ub_get_block_example_data' ) ? ub_get_block_example_data( $block ) : array();
	$ub_headline     = ! empty( $ub_headline ) ? $ub_headline : ( $ub_example_data['headline'] ?? '' );
	$ub_sig1         = $ub_example_data['sig1'] ?? array();
	$ub_sig2         = $ub_example_data['sig2'] ?? array();
	$ub_sig3         = $ub_example_data['sig3'] ?? array();
	$ub_sig4         = $ub_example_data['sig4'] ?? array();
}
?>

<section id="<?php echo esc_attr( $ub_id ); ?>" class="<?php echo esc_attr( $ub_class_name ); ?>">
	<div class="container">
		
		<?php if ( $ub_headline || $ub_description ) : ?>
			<div class="mb-12 text-left">
				<?php if ( $ub_headline ) : ?>
					<h2 class="mb-3 text-2xl leading-tight font-bold text-primary lg:text-3xl"><?php echo esc_html( $ub_headline ); ?></h2>
				<?php endif; ?>
				<?php if ( $ub_description ) : ?>
					<p class="text-base leading-tight text-slate-500 opacity-80"><?php echo wp_kses_post( $ub_description ); ?></p>
				<?php endif; ?>
			</div>
		<?php endif; ?>

		<div class="grid grid-cols-1 gap-[10px] md:grid-cols-3">
			
			<!-- Signal 1: Large Primary (Top-Left) -->
			<div class="col-span-1 flex min-h-[240px] flex-col rounded-sm bg-primary p-8 text-white">
				<div class="mb-4 text-4xl leading-none font-light tracking-tighter lg:text-6xl" data-countup="<?php echo esc_attr( preg_replace( '/[^0-9]/', '', $ub_sig1['number'] ) ); ?>">
					<?php echo esc_html( $ub_sig1['number'] ); ?>
				</div>
					<p class="text-base mt-auto max-w-64 leading-tight font-medium opacity-90"><?php echo esc_html( $ub_sig1['text'] ); ?></p>
			</div>

			<!-- Signal 2: Small Gray (Top-Middle) -->
			<div class="col-span-1 flex min-h-[240px] flex-col rounded-sm bg-slate-50 p-8">
				<div class="mb-4 text-4xl leading-none font-light tracking-tighter text-primary lg:text-6xl" data-countup="<?php echo esc_attr( preg_replace( '/[^0-9]/', '', $ub_sig2['number'] ) ); ?>">
					<?php echo esc_html( $ub_sig2['number'] ); ?>
				</div>
				<p class="text-base mt-auto max-w-64 leading-tight font-medium text-slate-500/80"><?php echo esc_html( $ub_sig2['text'] ); ?></p>
			</div>

			<!-- Signal 4: Tall with Image (Right) -->
			<div class="relative col-span-1 flex min-h-[400px] flex-col overflow-hidden rounded-sm bg-slate-100 p-8 md:row-span-2">
				<?php if ( ! empty( $ub_sig4['image'] ) ) : ?>
					<div class="absolute inset-0 z-0">
						<?php echo wp_get_attachment_image( $ub_sig4['image'], 'large', false, array( 'class' => 'w-full h-full object-cover' ) ); ?>
						<div class="absolute inset-0 bg-linear-to-t from-slate-900/80 to-transparent"></div>
					</div>
				<?php endif; ?>
				
				<div class="<?php echo ! empty( $ub_sig4['image'] ) ? 'text-white' : 'text-slate-900'; ?> relative z-10 flex h-full flex-col">
					<div class="<?php echo ! empty( $ub_sig4['image'] ) ? '' : 'text-primary'; ?> mb-4 text-6xl leading-none font-light tracking-tighter lg:text-8xl" data-countup="<?php echo esc_attr( preg_replace( '/[^0-9]/', '', $ub_sig4['number'] ) ); ?>">
						<?php echo esc_html( $ub_sig4['number'] ); ?>
					</div>
					<p class="text-base mt-auto max-w-64 leading-tight font-medium opacity-90"><?php echo esc_html( $ub_sig4['text'] ); ?></p>
				</div>
			</div>

			<!-- Signal 3: Wide Gray (Bottom-Left) -->
			<div class="col-span-1 flex min-h-[160px] items-center rounded-sm bg-slate-50 p-8 md:col-span-2">
				<div class="flex flex-col gap-8">
					<div class="text-4xl leading-none font-light tracking-tighter whitespace-nowrap text-primary lg:text-5xl" data-countup="<?php echo esc_attr( preg_replace( '/[^0-9]/', '', $ub_sig3['number'] ) ); ?>">
						<?php echo esc_html( $ub_sig3['number'] ); ?>
					</div>
					<p class="text-base max-w-64 leading-tight font-medium text-slate-500/80"><?php echo esc_html( $ub_sig3['text'] ); ?></p>
				</div>
			</div>

		</div>

	</div>
</section>
