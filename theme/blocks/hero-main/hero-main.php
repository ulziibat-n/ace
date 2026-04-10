<?php
/**
 * Hero Main Block Template.
 *
 * @package aceedu
 */

$ub_id         = 'hero-main-' . $block['id'];
$ub_class_name = 'block-hero-main alignfull ' . ( isset( $block['className'] ) ? $block['className'] : '' );

// Fields.
$ub_super_title     = get_field( 'super_title' );
$ub_headline        = get_field( 'headline' );
$ub_description     = get_field( 'description' );
$ub_left_cta        = get_field( 'left_cta' );
$ub_right_cta       = get_field( 'right_cta' );
$ub_bg_image        = get_field( 'bg_image' );
$ub_overlay_opacity = get_field( 'overlay_opacity' ) ? get_field( 'overlay_opacity' ) : 60;

if ( ! $ub_headline && $is_preview ) {
	echo '<div class="p-12 text-center bg-slate-100 border-2 border-dashed border-slate-300 rounded-sm">Мэдээллээ оруулна уу.</div>';
	return;
}
?>

<section id="<?php echo esc_attr( $ub_id ); ?>" class="<?php echo esc_attr( $ub_class_name ); ?> relative min-h-[80vh] flex items-center overflow-hidden">
	<!-- Background Image with Overlay. -->
	<div class="absolute inset-0 z-0">
		<?php if ( $ub_bg_image ) : ?>
			<?php echo wp_get_attachment_image( $ub_bg_image['ID'], 'full', false, array( 'class' => 'w-full h-full object-cover' ) ); ?>
		<?php else : ?>
			<div class="w-full h-full bg-slate-900"></div>
		<?php endif; ?>
		<div class="absolute inset-0 bg-slate-900/<?php echo esc_attr( $ub_overlay_opacity ); ?>"></div>
	</div>

	<div class="container relative z-10 px-6 lg:px-12 py-24">
		<div class="max-w-4xl">
			<?php if ( $ub_super_title ) : ?>
				<span class="block-hero-main__super block text-amber-400 font-bold uppercase tracking-widest text-xs mb-4">
					<?php echo esc_html( $ub_super_title ); ?>
				</span>
			<?php endif; ?>

			<?php if ( $ub_headline ) : ?>
				<h1 class="block-hero-main__title text-white text-4xl lg:text-7xl font-black leading-tight tracking-tighter mb-6">
					<?php echo esc_html( $ub_headline ); ?>
				</h1>
			<?php endif; ?>

			<?php if ( $ub_description ) : ?>
				<p class="block-hero-main__desc text-white/80 text-lg lg:text-xl font-medium mb-10 max-w-2xl leading-relaxed">
					<?php echo esc_html( $ub_description ); ?>
				</p>
			<?php endif; ?>

			<div class="flex flex-wrap gap-4">
				<?php if ( $ub_left_cta ) : ?>
					<a href="<?php echo esc_url( $ub_left_cta['url'] ); ?>" target="<?php echo esc_attr( $ub_left_cta['target'] ); ?>" class="bg-primary text-white rounded-xs px-6 py-3 text-sm font-bold shadow-lg shadow-primary/20 transition-all duration-300 hover:bg-primary-dark hover:scale-105 uppercase tracking-wide">
						<?php echo esc_html( $ub_left_cta['title'] ); ?>
					</a>
				<?php endif; ?>

				<?php if ( $ub_right_cta ) : ?>
					<a href="<?php echo esc_url( $ub_right_cta['url'] ); ?>" target="<?php echo esc_attr( $ub_right_cta['target'] ); ?>" class="bg-transparent border-2 border-white/30 text-white rounded-xs px-6 py-3 text-sm font-bold transition-all duration-300 hover:bg-white/10 hover:scale-105 uppercase tracking-wide">
						<?php echo esc_html( $ub_right_cta['title'] ); ?>
					</a>
				<?php endif; ?>
			</div>
		</div>
	</div>
</section>
