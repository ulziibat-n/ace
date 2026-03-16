<?php
/**
 * Roadmap Block Template.
 */

$id = 'roadmap-' . $block['id'];
$title    = get_field( 'title' ) ?: 'Солонгост сурах 3 үндсэн замнал';
$subtitle = get_field( 'subtitle' ) ?: 'Таны одоогийн түвшинд таарах замыг ACE-ийн зөвлөх танд хамт сонгоно.';
$steps    = get_field( 'steps' );

?>

<section id="<?php echo esc_attr( $id ); ?>" class="py-20 bg-neutral-50">
    <div class="container mx-auto px-4">
        <div class="text-center max-w-3xl mx-auto mb-16">
            <h2 class="text-3xl md:text-4xl font-bold text-neutral-900 mb-4"><?php echo esc_html( $title ); ?></h2>
            <p class="text-lg text-neutral-600"><?php echo esc_html( $subtitle ); ?></p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-8 relative">
            <?php if ( $steps ) : ?>
                <?php foreach ( $steps as $index => $step ) : ?>
                    <div class="bg-white p-8 rounded-2xl shadow-sm border border-neutral-100 relative z-10 hover:shadow-md transition-shadow duration-300">
                        <div class="w-12 h-12 bg-primary text-white rounded-full flex items-center justify-center font-bold text-xl mb-6">
                            <?php echo $index + 1; ?>
                        </div>
                        <h3 class="text-xl font-bold text-neutral-900 mb-3"><?php echo esc_html( $step['title'] ); ?></h3>
                        <p class="text-neutral-600"><?php echo esc_html( $step['description'] ); ?></p>
                    </div>
                <?php endforeach; ?>
            <?php else : ?>
                <!-- Placeholder steps -->
                <?php for($i=1; $i<=3; $i++) : ?>
                    <div class="bg-white p-8 rounded-2xl shadow-sm border border-neutral-100 relative z-10">
                        <div class="w-12 h-12 bg-primary text-white rounded-full flex items-center justify-center font-bold text-xl mb-6">
                            <?php echo $i; ?>
                        </div>
                        <h3 class="text-xl font-bold text-neutral-900 mb-3">Алхам <?php echo $i; ?></h3>
                        <p class="text-neutral-600">Энд алхмын тайлбарыг оруулна уу.</p>
                    </div>
                <?php endfor; ?>
            <?php endif; ?>
            
            <!-- Connector line (desktop only) -->
            <div class="hidden md:block absolute top-1/2 left-0 w-full h-0.5 bg-neutral-200 -translate-y-12 -z-0"></div>
        </div>
    </div>
</section>
