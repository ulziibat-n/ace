<?php
/**
 * The template for displaying success story archives
 */

get_header();
?>

<div class="bg-neutral-50 min-h-screen">
    <header class="py-24 bg-white border-b border-neutral-100">
        <div class="container mx-auto px-4 text-center">
            <span class="text-secondary font-black uppercase tracking-[0.2em] text-xs mb-4 block"><?php _e( 'Social Proof', 'ace' ); ?></span>
            <h1 class="text-4xl md:text-6xl font-black text-neutral-900 mb-6"><?php _e( 'Амжилтын түүхүүд', 'ace' ); ?></h1>
            <p class="text-xl text-neutral-500 max-w-2xl mx-auto leading-relaxed">
                <?php _e( 'ACE EDU WORLD-ээр дамжуулан зорилгодоо хүрсэн оюутнуудын маань бодит түүх, сэтгэгдлүүд.', 'ace' ); ?>
            </p>
        </div>
    </header>

    <div class="container mx-auto px-4 py-20">
        <?php if ( have_posts() ) : ?>
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-8">
                <?php
                while ( have_posts() ) :
                    the_post();
                    get_template_part( 'template-parts/content/content', 'success_story' );
                endwhile;
                ?>
            </div>
            
            <div class="mt-16">
                <?php ace_the_posts_navigation(); ?>
            </div>
        <?php else : ?>
            <div class="text-center py-20">
                <p class="text-neutral-500"><?php _e( 'Түүх олдсонгүй.', 'ace' ); ?></p>
            </div>
        <?php endif; ?>
    </div>

    <!-- Banner CTA -->
    <div class="container mx-auto px-4 pb-20">
        <div class="bg-primary rounded-[3rem] p-12 md:p-20 text-center text-white relative overflow-hidden">
            <div class="relative z-10">
                <h2 class="text-3xl md:text-5xl font-black mb-6"><?php _e( 'Таны түүх эндээс эхлэх боломжтой', 'ace' ); ?></h2>
                <p class="text-white/70 text-lg mb-10 max-w-xl mx-auto"><?php _e( 'Солонгост сурах хүсэл мөрөөдлөө бидэнтэй хамт бодит болгоорой.', 'ace' ); ?></p>
                <a href="<?php echo esc_url( home_url( '/registration' ) ); ?>" class="inline-block bg-secondary hover:bg-white hover:text-primary text-white font-black px-10 py-5 rounded-full transition-all duration-300 shadow-xl shadow-black/10">
                    <?php _e( 'Одоо бүртгүүлэх', 'ace' ); ?>
                </a>
            </div>
            
            <!-- Abstract background shape -->
            <div class="absolute -top-24 -right-24 w-96 h-96 bg-white/5 rounded-full blur-3xl"></div>
            <div class="absolute -bottom-24 -left-24 w-64 h-64 bg-secondary/20 rounded-full blur-3xl"></div>
        </div>
    </div>
</div>

<?php
get_footer();
