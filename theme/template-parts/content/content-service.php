<?php
/**
 * Template part for displaying service posts as cards
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class('bg-white group rounded-2xl p-8 border border-neutral-100 hover:border-primary/20 hover:shadow-xl hover:shadow-primary/5 transition-all duration-300 flex flex-col'); ?>>
    <div class="w-16 h-16 bg-neutral-100 rounded-xl flex items-center justify-center text-primary group-hover:bg-primary group-hover:text-white transition-colors duration-300 mb-6">
        <?php if ( has_post_thumbnail() ) : ?>
            <?php the_post_thumbnail( 'thumbnail', array( 'class' => 'w-8 h-8 object-contain' ) ); ?>
        <?php else : ?>
            <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z" />
            </svg>
        <?php endif; ?>
    </div>

    <h3 class="text-2xl font-bold text-neutral-900 mb-4 group-hover:text-primary transition-colors">
        <a href="<?php the_permalink(); ?>">
            <?php the_title(); ?>
        </a>
    </h3>

    <div class="text-neutral-600 mb-8 line-clamp-3">
        <?php echo wp_trim_words( get_the_excerpt(), 25 ); ?>
    </div>

    <div class="mt-auto">
        <a href="<?php the_permalink(); ?>" class="inline-flex items-center font-bold text-primary gap-2 group/link">
            <?php _e( 'Дэлгэрэнгүй үзэх', 'aceedu' ); ?>
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 transition-transform group-hover/link:translate-x-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3" />
            </svg>
        </a>
    </div>
</article>
