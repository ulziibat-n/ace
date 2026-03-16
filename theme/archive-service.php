<?php
/**
 * The template for displaying service archives
 */

get_header();
?>

<div class="bg-white min-h-screen">
    <header class="py-20 bg-neutral-900 text-white">
        <div class="container mx-auto px-4 text-center">
            <h1 class="text-4xl md:text-5xl font-bold mb-6"><?php _e( 'Манай үйлчилгээнүүд', 'ace' ); ?></h1>
            <p class="text-xl text-neutral-400 max-w-3xl mx-auto leading-relaxed">
                <?php _e( 'Солонгост сурах замналыг тань хялбарчлах зорилготой, системчилсэн бэлтгэл хөтөлбөрүүд.', 'ace' ); ?>
            </p>
        </div>
    </header>

    <div class="container mx-auto px-4 py-24">
        <?php if ( have_posts() ) : ?>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                <?php
                while ( have_posts() ) :
                    the_post();
                    get_template_part( 'template-parts/content/content', 'service' );
                endwhile;
                ?>
            </div>
        <?php else : ?>
            <div class="text-center py-20">
                <p class="text-neutral-500"><?php _e( 'Үйлчилгээ олдсонгүй.', 'ace' ); ?></p>
            </div>
        <?php endif; ?>
    </div>
</div>

<?php
get_footer();
