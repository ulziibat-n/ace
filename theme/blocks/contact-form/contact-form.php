<?php
/**
 * Contact Section Block Template.
 *
 * @param array $block The block settings and attributes.
 * @param string $content The block inner HTML (empty).
 * @param bool $is_preview True during backend preview render.
 * @param int $post_id The post ID the block is rendering on.
 * @param array $context The context provided to the block by the post or it's parent block.
 * @package aceedu
 */

// Блокын ID болон ангиудыг тодорхойлох.
$block_id = 'contact-section-' . $block['id'];
$classes  = 'contact-section relative py-12 md:py-20 overflow-hidden bg-white';

if ( ! empty( $block['className'] ) ) {
	$classes .= ' ' . $block['className'];
}

// Өгөгдөл унших.
$title       = get_field( 'site_contact_title' );
$description = get_field( 'site_contact_description' );
$branches    = get_field( 'site_contact_branches' );
$form_code   = get_field( 'site_contact_form_shortcode' );

// Preview үед жишээ өгөгдөл ашиглах.
if ( $is_preview && empty( $title ) ) {
	$example_data = ub_get_block_example_data( $block );
	$title        = $example_data['site_contact_title'] ?? '';
	$description  = $example_data['site_contact_description'] ?? '';
	$branches     = $example_data['site_contact_branches'] ?? array();
}

/**
 * SVG Icons.
 */
$icons = array(
	'location' => '<svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/></svg>',
	'phone'    => '<svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/></svg>',
	'email'    => '<svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>',
);
?>

<section id="<?php echo esc_attr( $block_id ); ?>" class="<?php echo esc_attr( $classes ); ?>">
	<div class="container mx-auto px-4">
		<div class="-mx-4 flex flex-wrap">
			
			<!-- Мэдээллийн хэсэг -->
			<div class="mb-12 w-full px-4 lg:mb-0 lg:w-5/12">
				<div class="max-w-lg">
					<?php if ( $title ) : ?>
						<h2 class="font-primary mb-6 text-3xl font-bold tracking-tight text-slate-900 uppercase md:text-4xl">
							<?php echo esc_html( $title ); ?>
						</h2>
					<?php endif; ?>

					<?php if ( $description ) : ?>
						<p class="mb-10 text-lg leading-relaxed text-slate-600">
							<?php echo esc_html( $description ); ?>
						</p>
					<?php endif; ?>

					<?php if ( $branches ) : ?>
						<div class="grid gap-8">
							<?php foreach ( $branches as $branch ) : ?>
								<div class="group rounded-2xl border border-slate-100 bg-slate-50 p-6 transition-all hover:shadow-xl hover:shadow-slate-200/50">
									<h3 class="font-primary mb-4 text-xl font-bold text-slate-900">
										<?php echo esc_html( $branch['branch_name'] ); ?>
									</h3>
									
									<div class="space-y-4">
										<?php if ( ! empty( $branch['address'] ) ) : ?>
											<div class="flex items-start gap-3">
												<span class="mt-1 shrink-0 text-primary"><?php echo $icons['location']; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?></span>
												<p class="text-sm leading-relaxed text-slate-600">
													<?php echo esc_html( $branch['address'] ); ?>
												</p>
											</div>
										<?php endif; ?>

										<?php if ( ! empty( $branch['phone'] ) ) : ?>
											<div class="flex items-center gap-3">
												<span class="shrink-0 text-primary"><?php echo $icons['phone']; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?></span>
												<a href="tel:<?php echo esc_attr( str_replace( ' ', '', $branch['phone'] ) ); ?>" class="text-sm text-slate-600 transition-colors hover:text-primary">
													<?php echo esc_html( $branch['phone'] ); ?>
												</a>
											</div>
										<?php endif; ?>

										<?php if ( ! empty( $branch['email'] ) ) : ?>
											<div class="flex items-center gap-3">
												<span class="shrink-0 text-primary"><?php echo $icons['email']; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?></span>
												<a href="mailto:<?php echo esc_attr( $branch['email'] ); ?>" class="text-sm text-slate-600 transition-colors hover:text-primary">
													<?php echo esc_html( $branch['email'] ); ?>
												</a>
											</div>
										<?php endif; ?>
									</div>

									<?php if ( ! empty( $branch['map_link'] ) ) : ?>
										<div class="mt-6">
											<a href="<?php echo esc_url( $branch['map_link'] ); ?>" target="_blank" rel="noopener noreferrer" class="inline-flex items-center gap-2 text-sm font-semibold text-primary hover:underline">
												Газрын зураг дээр харах
												<svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"/></svg>
											</a>
										</div>
									<?php endif; ?>
								</div>
							<?php endforeach; ?>
						</div>
					<?php endif; ?>
				</div>
			</div>

			<!-- Форм хэсэг -->
			<div class="w-full px-4 lg:w-7/12">
				<div class="rounded-3xl border border-slate-100 bg-white p-8 shadow-2xl shadow-slate-200/60 md:p-12">
					<?php if ( $form_code ) : ?>
						<div class="contact-form-wrapper">
							<?php echo do_shortcode( $form_code ); ?>
						</div>
					<?php else : ?>
						<div class="rounded-2xl border-2 border-dashed border-slate-200 bg-slate-50 p-10 text-center">
							<p class="text-slate-500">Contact Form 7 shortcode оруулаагүй байна.</p>
						</div>
					<?php endif; ?>
				</div>
			</div>

		</div>
	</div>
</section>

<style>
/* CF7 Формын стилийг Tailwind-тэй нийцүүлэх */
.contact-form-wrapper .wpcf7-form p {
	@apply mb-4;
}
.contact-form-wrapper .wpcf7-form-control:not(.wpcf7-submit) {
	@apply w-full bg-slate-50 border border-slate-200 rounded-xl px-4 py-3 text-slate-900 focus:bg-white focus:border-primary focus:ring-4 focus:ring-primary/5 transition-all outline-none;
}
.contact-form-wrapper .wpcf7-submit {
	@apply w-full md:w-auto bg-primary text-white font-bold px-10 py-4 rounded-xl hover:bg-slate-900 transition-colors cursor-pointer uppercase tracking-wider text-sm shadow-lg shadow-primary/20;
}
.contact-form-wrapper .wpcf7-response-output {
	@apply !border-2 !rounded-xl !p-4 !my-4 !mx-0 !text-sm;
}
</style>
