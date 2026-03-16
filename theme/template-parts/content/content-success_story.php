<?php
/**
 * Template part for displaying success story posts as cards
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class('bg-white rounded-3xl p-6 border border-neutral-100 hover:shadow-xl transition-all duration-300'); ?>>
    <div class="relative mb-6">
        <div class="aspect-[4/5] rounded-2xl overflow-hidden bg-neutral-100">
            <?php if ( has_post_thumbnail() ) : ?>
                <?php the_post_thumbnail( 'medium_large', array( 'class' => 'w-full h-full object-cover' ) ); ?>
            <?php else : ?>
                 <div class="w-full h-full flex items-center justify-center text-neutral-300">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-20 w-20" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                    </svg>
                </div>
            <?php endif; ?>
        </div>
        
        <?php 
        $levels = get_the_terms( get_the_ID(), 'study_level' );
        if ( ! empty( $levels ) ) : ?>
            <div class="absolute -bottom-3 left-4 right-4">
                <span class="block text-center bg-secondary text-white text-[10px] uppercase tracking-tighter font-black py-2 rounded-lg shadow-lg">
                    <?php echo esc_html( $levels[0]->name ); ?>
                </span>
            </div>
        <?php endif; ?>
    </div>

    <div class="text-center pt-2">
        <h3 class="text-lg font-bold text-neutral-900 mb-1">
            <a href="<?php the_permalink(); ?>" class="hover:text-primary transition-colors">
                <?php the_title(); ?>
            </a>
        </h3>
        <p class="text-neutral-500 text-sm mb-4"><?php echo get_post_meta( get_the_ID(), 'university', true ) ?: 'University Name'; ?></p>
        
        <blockquote class="text-neutral-600 text-sm italic line-clamp-2 mb-6 px-4">
            "<?php echo get_the_excerpt(); ?>"
        </blockquote>

        <a href="<?php the_permalink(); ?>" class="inline-flex items-center justify-center w-10 h-10 rounded-full border border-neutral-200 text-neutral-400 hover:bg-primary hover:text-white hover:border-primary transition-all duration-300">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3" />
            </svg>
        </a>
    </div>
</article>
