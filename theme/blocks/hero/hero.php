<?php
/**
 * Hero Block Template.
 *
 * @param array $block The block settings and attributes.
 * @param string $content The block inner HTML (empty).
 * @param bool $is_preview True during AJAX preview.
 * @param  (int|string) $post_id The post ID this block is saved to.
 */

$id = 'hero-' . $block['id'];
if ( ! empty( $block['anchor'] ) ) {
	$id = $block['anchor'];
}

$align_class = $block['align'] ? 'align' . $block['align'] : '';

// ACF Fields
$title        = get_field( 'title' ) ?: 'Солонгост хэлний бэлтгэлээс тэтгэлэг хүртэл, нэг газраас.';
$subtitle     = get_field( 'subtitle' ) ?: 'ACE EDU WORLD нь Солонгост сурах хүсэлтэй залууст нэг цогц зөвлөгөө өгдөг Korean study hub юм.';
$image        = get_field( 'image' );
$variant      = get_field( 'variant' ) ?: 'home';
$ctas         = get_field( 'ctas' );

?>

<section id="<?php echo esc_attr( $id ); ?>" class="relative overflow-hidden bg-neutral-900 text-white <?php echo esc_attr( $align_class ); ?>">
    <?php if ( $image ) : ?>
        <div class="absolute inset-0 opacity-40">
            <?php echo wp_get_attachment_image( $image, 'full', false, array( 'class' => 'w-full h-full object-cover' ) ); ?>
        </div>
    <?php endif; ?>

    <div class="relative z-10 container mx-auto px-4 py-24 md:py-32 lg:py-48">
        <div class="max-w-3xl">
            <h1 class="text-4xl md:text-5xl lg:text-6xl font-bold leading-tight mb-6">
                <?php echo esc_html( $title ); ?>
            </h1>
            <p class="text-lg md:text-xl text-neutral-300 mb-10 max-w-2xl">
                <?php echo esc_html( $subtitle ); ?>
            </p>
            
            <?php if ( $ctas ) : ?>
                <div class="flex flex-wrap gap-4">
                    <?php foreach ( $ctas as $cta ) : ?>
                        <?php 
                        $link = $cta['link'];
                        $is_primary = $cta['primary'];
                        if ( $link ) : 
                        ?>
                            <a href="<?php echo esc_url( $link['url'] ); ?>" 
                               target="<?php echo esc_attr( $link['target'] ?: '_self' ); ?>"
                               class="<?php echo $is_primary ? 'bg-primary hover:bg-primary-dark text-white' : 'bg-white/10 hover:bg-white/20 text-white border border-white/20'; ?> px-8 py-4 rounded-full font-bold transition-all duration-300">
                                <?php echo esc_html( $link['title'] ); ?>
                            </a>
                        <?php endif; ?>
                    <?php endforeach; ?>
                </div>
            <?php else: ?>
                 <div class="flex flex-wrap gap-4">
                    <a href="#register" class="bg-primary hover:bg-primary-dark text-white px-8 py-4 rounded-full font-bold transition-all duration-300">
                        Үнэгүй зөвлөгөө авах
                    </a>
                 </div>
            <?php endif; ?>
        </div>
    </div>
</section>
