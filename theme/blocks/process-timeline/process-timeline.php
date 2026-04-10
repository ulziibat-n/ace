<?php
/**
 * Process Timeline Block Template.
 *
 * @package aceedu
 */

$ub_id         = 'process-timeline-' . $block['id'];
$ub_class_name = 'block-process-timeline alignfull ' . ( isset( $block['className'] ) ? $block['className'] : '' );

// Fields.
$ub_steps = get_field( 'steps' );

if ( ! $ub_steps && $is_preview ) {
	echo '<div class="p-12 text-center bg-slate-100 border-2 border-dashed border-slate-300 rounded-sm">Алхмуудаа нэмнэ үү.</div>';
	return;
}
?>

<section id="<?php echo esc_attr( $ub_id ); ?>" class="<?php echo esc_attr( $ub_class_name ); ?> py-16 lg:py-24 bg-white">
	<div class="container px-6 lg:px-12">
		<?php if ( $ub_steps ) : ?>
			<div class="relative flex flex-col lg:flex-row gap-8 lg:gap-4 items-start">
				<?php foreach ( $ub_steps as $index => $step ) : ?>
					<div class="block-process-timeline__step flex-1 relative group w-full">
						<!-- Content. -->
						<div class="bg-slate-50 p-8 rounded-sm border border-slate-100 h-full transition-all duration-300 hover:shadow-md hover:bg-white">
							<?php if ( ! empty( $step['step_label'] ) ) : ?>
								<span class="block mb-4 text-xs font-black text-primary uppercase tracking-widest opacity-60">
									<?php echo esc_html( $step['step_label'] ); ?>
								</span>
							<?php endif; ?>

							<h3 class="text-xl font-bold mb-4 text-slate-900">
								<?php echo esc_html( $step['title'] ); ?>
							</h3>

							<p class="text-slate-600 leading-relaxed font-medium">
								<?php echo esc_html( $step['description'] ); ?>
							</p>
						</div>

						<!-- Connector for Desktop. -->
						<?php if ( $index < count( $ub_steps ) - 1 ) : ?>
							<div class="hidden lg:block absolute top-1/2 -right-4 translate-y-[-50%] z-20">
								<svg class="w-8 h-8 text-slate-200" fill="none" stroke="currentColor" viewBox="0 0 24 24">
									<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="9 5l7 7-7 7"></path>
								</svg>
							</div>
						<?php endif; ?>
					</div>
				<?php endforeach; ?>
			</div>
		<?php endif; ?>
	</div>
</section>
