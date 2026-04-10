<?php
/**
 * Page Header Block Template.
 *
 * @package aceedu
 */

$ub_id         = 'page-header-' . $block['id'];
$ub_class_name = 'block-page-header alignfull ' . ( isset( $block['className'] ) ? $block['className'] : '' );

// Fields.
$ub_custom_title = get_field( 'custom_title' );
$ub_bg_image     = get_field( 'bg_image' );

// Logic.
$ub_title = ! empty( $ub_custom_title ) ? $ub_custom_title : get_the_title();

if ( ! $ub_title && $is_preview ) {
	echo '<div class="p-12 text-center bg-slate-100 border-2 border-dashed border-slate-300 rounded-sm">Мэдээллээ оруулна уу.</div>';
	return;
}
?>

<section id="<?php echo esc_attr( $ub_id ); ?>" class="<?php echo esc_attr( $ub_class_name ); ?> relative py-12 lg:py-20 bg-slate-900 overflow-hidden">
	<?php if ( $ub_bg_image ) : ?>
		<div class="absolute inset-0 z-0">
			<?php echo wp_get_attachment_image( $ub_bg_image['ID'], 'full', false, array( 'class' => 'w-full h-full object-cover opacity-30' ) ); ?>
		</div>
	<?php endif; ?>

	<div class="container relative z-10 px-6 lg:px-12">
		<?php if ( function_exists( 'yoast_breadcrumb' ) ) : ?>
			<div class="block-page-header__breadcrumbs text-xs uppercase font-bold text-white/50 mb-4 tracking-widest">
				<?php yoast_breadcrumb(); ?>
			</div>
		<?php endif; ?>

		<h1 class="block-page-header__title text-3xl lg:text-5xl font-black text-white leading-tight tracking-tighter">
			<?php echo esc_html( $ub_title ); ?>
		</h1>
	</div>
</section>
