<?php
/**
 * Teacher Info Block Template.
 *
 * @param array $block The block settings and attributes.
 *
 * @package aceedu
 */

$ub_id = 'teacher-info-' . $block['id'];
if ( ! empty( $block['anchor'] ) ) {
	$ub_id = $block['anchor'];
}

$ub_class_name = 'block-teacher-info alignfull py-16 bg-white lg:py-24 w-full';
if ( ! empty( $block['className'] ) ) {
	$ub_class_name .= ' ' . $block['className'];
}

// ACF талбарууд.
$ub_image         = get_field( 'ub_teacher_info_image' );
$ub_title_left    = get_field( 'ub_teacher_info_title_left' );
$ub_description_l = get_field( 'ub_teacher_info_description_left' );
$ub_lead          = get_field( 'ub_teacher_info_lead' );
$ub_description_r = get_field( 'ub_teacher_info_description_right' );

$ub_headline_mw = get_field( 'ub_teacher_info_headline_mw' ) ?? 400;

// rem нэгж рүү хөрвүүлэх.
$ub_headline_rem = ( $ub_headline_mw / 16 ) . 'rem';

// Редактор дээр жишээ өгөгдөл харуулах хэсэг.
if ( $is_preview ) {
	$ub_example_data  = function_exists( 'ub_get_block_example_data' ) ? ub_get_block_example_data( $block ) : array();
	$ub_image         = ! empty( $ub_image ) ? $ub_image : ( $ub_example_data['ub_teacher_info_image'] ?? 0 );
	$ub_title_left    = ! empty( $ub_title_left ) ? $ub_title_left : ( $ub_example_data['ub_teacher_info_title_left'] ?? 'Багшийн нэр' );
	$ub_description_l = ! empty( $ub_description_l ) ? $ub_description_l : ( $ub_example_data['ub_teacher_info_description_left'] ?? '' );
	$ub_lead          = ! empty( $ub_lead ) ? $ub_lead : ( $ub_example_data['ub_teacher_info_lead'] ?? '' );
	$ub_description_r = ! empty( $ub_description_r ) ? $ub_description_r : ( $ub_example_data['ub_teacher_info_description_right'] ?? '' );
}
?>

<section id="<?php echo esc_attr( $ub_id ); ?>" class="<?php echo esc_attr( $ub_class_name ); ?>">
	<div class="container">
		<div class="flex flex-col items-start gap-12 lg:flex-row lg:gap-24">
			
			<!-- Left side: Image, Headline & Description -->
			<div class="w-full lg:w-1/2">

				<?php if ( $ub_title_left ) : ?>
					<h2 class="mb-2 text-sm font-bold leading-none text-primary uppercase" style="max-width: <?php echo esc_attr( $ub_headline_rem ); ?>;">
						<?php echo esc_html( $ub_title_left ); ?>
					</h2>
				<?php endif; ?>

				<?php if ( $ub_description_l ) : ?>
					<div class="text-sm leading-tight text-slate-500 opacity-80" style="max-width: <?php echo esc_attr( $ub_headline_rem ); ?>;">
						<?php echo wp_kses_post( $ub_description_l ); ?>
					</div>
				<?php endif; ?>
				<?php
				$ub_photo_url = $ub_image ? wp_get_attachment_image_url( $ub_image, 'large' ) : 'https://images.unsplash.com/photo-1560250097-0b93528c311a?auto=format&fit=crop&w=400&q=80';
				?>
				<div class="mt-8 w-full max-w-sm">
					<div class="relative aspect-square max-w-36 w-full overflow-hidden rounded-sm bg-slate-200">
						<?php if ( $ub_image ) : ?>
							<?php echo wp_get_attachment_image( $ub_image, 'large', false, array( 'class' => 'absolute inset-0 h-full w-full object-cover' ) ); ?>
						<?php else : ?>
							<img src="<?php echo esc_url( $ub_photo_url ); ?>" alt="<?php echo esc_attr( $ub_title_left ); ?>" class="absolute inset-0 h-full w-full object-cover" />
						<?php endif; ?>
					</div>
				</div>
			</div>

			<!-- Right side: Content -->
			<div class="w-full lg:w-1/2">
				<?php if ( $ub_lead ) : ?>
					<div class="mb-6 text-xl font-light leading-tight text-foreground lg:text-2xl">
						<?php echo wp_kses_post( $ub_lead ); ?>
					</div>
				<?php endif; ?>

				<?php if ( ! empty( $ub_description_r ) ) : ?>
					<div class="prose leading-relaxed text-slate-500">
						<?php echo wp_kses_post( $ub_description_r ); ?>
					</div>
				<?php endif; ?>
			</div>

		</div>
	</div>
</section>
