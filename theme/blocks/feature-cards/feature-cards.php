<?php
/**
 * Feature Cards Block Template.
 *
 * @package aceedu
 */

$ub_id         = 'feature-cards-' . $block['id'];
$ub_class_name = 'block-feature-cards alignfull ' . ( isset( $block['className'] ) ? $block['className'] : '' );

// Fields.
$ub_section_title = get_field( 'section_title' );
$ub_cards         = get_field( 'cards' );

if ( ! $ub_cards && $is_preview ) {
	echo '<div class="p-12 text-center bg-slate-100 border-2 border-dashed border-slate-300 rounded-sm">Картуудаа нэмнэ үү.</div>';
	return;
}
?>

<section id="<?php echo esc_attr( $ub_id ); ?>" class="<?php echo esc_attr( $ub_class_name ); ?> py-16 lg:py-24 bg-slate-50">
	<div class="container px-6 lg:px-12">
		<?php if ( $ub_section_title ) : ?>
			<h2 class="text-center text-3xl lg:text-4xl font-black mb-12 lg:mb-20 text-slate-900 tracking-tight">
				<?php echo esc_html( $ub_section_title ); ?>
			</h2>
		<?php endif; ?>

		<?php if ( $ub_cards ) : ?>
			<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
				<?php foreach ( $ub_cards as $card ) : ?>
					<div class="block-feature-cards__card h-full bg-white p-8 lg:p-10 rounded-sm border border-slate-100 shadow-sm hover:shadow-xl hover:-translate-y-2 transition-all duration-300 flex flex-col">
						<?php if ( ! empty( $card['icon'] ) ) : ?>
							<div class="w-16 h-16 mb-8 bg-primary/5 rounded-full flex items-center justify-center text-primary group-hover:bg-primary group-hover:text-white transition-colors duration-300">
								<?php echo wp_get_attachment_image( $card['icon']['ID'], 'thumbnail', true, array( 'class' => 'w-8 h-8 object-contain' ) ); ?>
							</div>
						<?php endif; ?>

						<h3 class="text-xl font-bold mb-4 text-slate-900">
							<?php echo esc_html( $card['title'] ); ?>
						</h3>

						<div class="text-slate-600 leading-relaxed font-medium">
							<?php echo wp_kses_post( $card['description'] ); ?>
						</div>
					</div>
				<?php endforeach; ?>
			</div>
		<?php endif; ?>
	</div>
</section>
