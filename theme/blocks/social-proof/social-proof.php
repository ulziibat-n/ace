<?php
/**
 * Social Proof Block Template (Stats + Testimonials).
 */

$id = 'social-proof-' . $block['id'];
$stats        = get_field( 'stats' );
$testimonials = get_field( 'testimonials' );

?>

<section id="<?php echo esc_attr( $id ); ?>" class="py-20 bg-neutral-900 text-white">
    <div class="container mx-auto px-4">
        
        <?php if ( $stats ) : ?>
            <div class="grid grid-cols-2 md:grid-cols-4 gap-8 mb-20">
                <?php foreach ( $stats as $stat ) : ?>
                    <div class="text-center">
                        <div class="text-4xl md:text-5xl font-bold text-secondary mb-2"><?php echo esc_html( $stat['number'] ); ?></div>
                        <div class="text-neutral-400 font-medium"><?php echo esc_html( $stat['label'] ); ?></div>
                    </div>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>

        <?php if ( $testimonials ) : ?>
            <div class="max-w-4xl mx-auto">
                <div class="relative bg-white/5 border border-white/10 p-10 md:p-16 rounded-3xl backdrop-blur-sm">
                    <svg class="absolute top-10 left-10 w-12 h-12 text-secondary/20" fill="currentColor" viewBox="0 0 32 32">
                        <path d="M10 8c-3.3 0-6 2.7-6 6v10h10V14H8c0-2.2 1.8-4 4-4V8zm14 0c-3.3 0-6 2.7-6 6v10h10V14h-6c0-2.2 1.8-4 4-4V8z"></path>
                    </svg>
                    
                    <div class="relative z-10 text-center">
                        <?php foreach ( $testimonials as $index => $item ) : ?>
                            <div class="testimonial-item <?php echo $index === 0 ? '' : 'hidden'; ?>">
                                <p class="text-xl md:text-2xl italic leading-relaxed mb-8">
                                    "<?php echo esc_html( $item['quote'] ); ?>"
                                </p>
                                <div class="flex items-center justify-center gap-4">
                                    <?php if ( $item['image'] ) : ?>
                                        <?php echo wp_get_attachment_image( $item['image'], 'thumbnail', false, array( 'class' => 'w-16 h-16 rounded-full object-cover border-2 border-secondary' ) ); ?>
                                    <?php endif; ?>
                                    <div class="text-left">
                                        <div class="font-bold text-lg"><?php echo esc_html( $item['name'] ); ?></div>
                                        <div class="text-secondary text-sm"><?php echo esc_html( $item['details'] ); ?></div>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>
        <?php endif; ?>

    </div>
</section>
