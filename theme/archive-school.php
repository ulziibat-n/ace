<?php
/**
 * The template for displaying school archives
 */

get_header();
?>

<div class="bg-neutral-50 min-h-screen">
    <header class="bg-primary text-white py-20">
        <div class="container mx-auto px-4 text-center">
            <h1 class="text-4xl md:text-5xl font-bold mb-4"><?php _e( 'Сургуулиуд', 'ace' ); ?></h1>
            <p class="text-lg text-primary-dark/20 max-w-2xl mx-auto opacity-80">
                <?php _e( 'Солонгос улсын нэр хүндтэй их дээд сургуулиудыг хот, чиглэл, тэтгэлгийн боломжоор нь шүүж хараарай.', 'ace' ); ?>
            </p>
        </div>
    </header>

    <div class="container mx-auto px-4 py-16">
        <?php if ( have_posts() ) : ?>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                <?php
                while ( have_posts() ) :
                    the_post();
                    get_template_part( 'template-parts/content/content', 'school' );
                endwhile;
                ?>
            </div>

            <div class="mt-12">
                <?php ace_the_posts_navigation(); ?>
            </div>

        <?php else : ?>
            <div class="text-center py-20">
                <p class="text-neutral-500"><?php _e( 'Сургууль олдсонгүй.', 'ace' ); ?></p>
            </div>
        <?php endif; ?>
    </div>
</div>

<?php
get_footer();
