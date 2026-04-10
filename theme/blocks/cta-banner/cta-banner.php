<?php
/**
 * CTA Banner Block Template.
 *
 * @package aceedu
 */

$ub_id         = 'cta-banner-' . $block['id'];
$ub_class_name = 'block-cta-banner alignfull ' . ( isset( $block['className'] ) ? $block['className'] : '' );

// Fields.
$ub_cta_message = get_field( 'cta_message' );
$ub_cta_link    = get_field( 'cta_link' );
$ub_style_type  = get_field( 'style_type' ) ? get_field( 'style_type' ) : 'navy';

// Style classes.
$ub_bg_class   = ( 'amber' === $ub_style_type ) ? 'bg-amber-400' : 'bg-primary';
$ub_text_class = ( 'amber' === $ub_style_type ) ? 'text-slate-900' : 'text-white';
$ub_btn_class  = ( 'amber' === $ub_style_type ) ? 'bg-slate-900 text-white' : 'bg-white text-primary';

if ( ! $ub_cta_message && $is_preview ) {
	echo '<div class="p-12 text-center bg-slate-100 border-2 border-dashed border-slate-300 rounded-sm">Мессежээ оруулна уу.</div>';
	return;
}
?>

<section id="<?php echo esc_attr( $ub_id ); ?>" class="<?php echo esc_attr( $ub_class_name ); ?> py-12 lg:py-16 <?php echo esc_attr( $ub_bg_class ); ?>">
	<div class="container px-6 lg:px-12">
		<div class="flex flex-col lg:flex-row items-center justify-between gap-8">
			<h2 class="text-2xl lg:text-4xl font-black <?php echo esc_attr( $ub_text_class ); ?> tracking-tight text-center lg:text-left">
				<?php echo esc_html( $ub_cta_message ); ?>
			</h2>

			<?php if ( $ub_cta_link ) : ?>
				<a href="<?php echo esc_url( $ub_cta_link['url'] ); ?>" target="<?php echo esc_attr( $ub_cta_link['target'] ); ?>" class="<?php echo esc_attr( $ub_btn_class ); ?> px-8 py-4 rounded-xs font-bold shadow-xl shadow-black/5 transition-all duration-300 hover:scale-105 uppercase text-xs tracking-widest whitespace-nowrap">
					<?php echo esc_html( $ub_cta_link['title'] ); ?>
				</a>
			<?php endif; ?>
		</div>
	</div>
</section>
