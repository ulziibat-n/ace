<?php
/**
 * Contact Form Block Template.
 *
 * @param array $block The block settings and attributes.
 * @param string $content The block inner HTML (empty).
 * @param bool $is_preview True during backend preview render.
 * @param int $post_id The post ID the block is rendering on.
 * @param array $context The context provided to the block by the post or it's parent block.
 * @package aceedu
 */

$ub_id = 'contact-form-' . $block['id'];
if ( ! empty( $block['anchor'] ) ) {
	$ub_id = $block['anchor'];
}

$ub_class_name = 'block-contact-form alignfull py-16 bg-white lg:py-24 w-full';
if ( ! empty( $block['className'] ) ) {
	$ub_class_name .= ' ' . $block['className'];
}

// ACF талбарууд.
$ub_title       = get_field( 'site_contact_title' );
$ub_description = get_field( 'site_contact_description' );
$ub_branches    = get_field( 'site_contact_branches' );
$ub_form_code   = get_field( 'site_contact_form_shortcode' );
$ub_headline_mw = get_field( 'site_contact_headline_mw' );
$ub_headline_mw = ! empty( $ub_headline_mw ) ? $ub_headline_mw : 400;

// rem нэгж рүү хөрвүүлэх.
$ub_headline_rem = ( $ub_headline_mw / 16 ) . 'rem';

// Редактор дээр жишээ өгөгдөл харуулах хэсэг.
if ( $is_preview ) {
	$ub_example_data = function_exists( 'ub_get_block_example_data' ) ? ub_get_block_example_data( $block ) : array();

	if ( empty( $ub_title ) ) {
		$ub_title = $ub_example_data['site_contact_title'] ?? '';
	}

	if ( empty( $ub_description ) ) {
		$ub_description = $ub_example_data['site_contact_description'] ?? '';
	}

	if ( empty( $ub_branches ) ) {
		$ub_branches = ! empty( $ub_example_data['site_contact_branches'] ) ? $ub_example_data['site_contact_branches'] : array();
	}
}

/**
 * SVG Icons.
 */
$ub_icons = array(
	'location' => '<svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/></svg>',
	'phone'    => '<svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/></svg>',
	'email'    => '<svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>',
);
?>

<section id="<?php echo esc_attr( $ub_id ); ?>" class="<?php echo esc_attr( $ub_class_name ); ?>">
	<div class="container">
		<div class="flex flex-col items-start gap-12 lg:flex-row lg:gap-24">
			
			<!-- Left side: Headline, Description & Branches -->
			<div class="w-full lg:w-1/2">
				<div class="mb-12">
					<?php if ( $ub_title ) : ?>
						<h2 class="mb-4 text-2xl leading-none font-bold text-primary lg:text-3xl" style="max-width: <?php echo esc_attr( $ub_title_rem ?? $ub_headline_rem ); ?>;">
							<?php echo esc_html( $ub_title ); ?>
						</h2>
					<?php endif; ?>

					<?php if ( $ub_description ) : ?>
						<p class="text-base leading-tight text-slate-500 opacity-80" style="max-width: <?php echo esc_attr( $ub_desc_rem ?? $ub_headline_rem ); ?>;">
							<?php echo esc_html( $ub_description ); ?>
						</p>
					<?php endif; ?>
				</div>

				<?php if ( $ub_branches ) : ?>
					<div class="flex flex-col">
						<?php foreach ( $ub_branches as $ub_branch ) : ?>
							<div class="branch-card border-b border-slate-100 last:border-0 pb-8 mb-8 last:mb-0 last:pb-0" style="max-width: <?php echo esc_attr( $ub_headline_rem ); ?>;">
								<h3 class="text-sm uppercase leading-none font-bold text-slate-900 mb-4 font-primary">
									<?php echo esc_html( $ub_branch['branch_name'] ?? '' ); ?>
								</h3>
								
								<div class="grid gap-3">
									<?php if ( ! empty( $ub_branch['address'] ) ) : ?>
										<div class="flex items-start gap-3">
											<span class="text-primary mt-1 shrink-0"><?php echo $ub_icons['location']; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?></span>
											<div class="flex flex-col">
												<p class="text-slate-500 text-sm leading-tight max-w-xs">
													<?php echo esc_html( $ub_branch['address'] ); ?>
												</p>
												<?php if ( ! empty( $ub_branch['map_link'] ) ) : ?>
													<div class="mt-0">
														<a href="<?php echo esc_url( $ub_branch['map_link'] ); ?>" target="_blank" rel="noopener noreferrer" class="inline-flex items-center gap-2 text-primary font-semibold text-xs ">
															Газрын зураг дээр харах
															<svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"/></svg>
														</a>
													</div>
												<?php endif; ?>
											</div>
										</div>
									<?php endif; ?>

									<div class="flex flex-wrap gap-x-6 gap-y-2">
										<?php if ( ! empty( $ub_branch ) && ! empty( $ub_branch['phone'] ) ) : ?>
											<div class="flex items-center gap-2">
												<span class="text-primary shrink-0"><?php echo $ub_icons['phone']; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?></span>
												<span class="text-slate-500 text-sm">
													<?php echo esc_html( $ub_branch['phone'] ); ?>
												</span>
											</div>
										<?php endif; ?>

										<?php if ( ! empty( $ub_branch ) && ! empty( $ub_branch['email'] ) ) : ?>
											<div class="flex items-center gap-2">
												<span class="text-primary shrink-0"><?php echo $ub_icons['email']; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?></span>
												<a href="mailto:<?php echo esc_attr( $ub_branch['email'] ?? '' ); ?>" class="text-slate-500 text-sm hover:text-primary transition-colors">
													<?php echo esc_html( $ub_branch['email'] ?? '' ); ?>
												</a>
											</div>
										<?php endif; ?>
									</div>
								</div>
							</div>
						<?php endforeach; ?>
					</div>
				<?php endif; ?>
			</div>

			<!-- Right side: Only Form -->
			<div class="w-full lg:w-1/2">
				<div class="contact-form-container">
					<?php if ( $ub_form_code ) : ?>
						<div class="contact-form-wrapper">
							<?php echo do_shortcode( $ub_form_code ); ?>
						</div>
					<?php else : ?>
						<div class="bg-slate-50 rounded-2xl p-8 text-center border border-dashed border-slate-200">
							<p class="text-slate-400 text-sm italic">Contact Form 7 shortcode оруулаагүй байна.</p>
						</div>
					<?php endif; ?>
				</div>
			</div>

		</div>
	</div>
</section>
