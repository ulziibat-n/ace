<?php
/**
 * Template part for displaying school posts as cards
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class('bg-white rounded-2xl shadow-sm border border-neutral-100 overflow-hidden hover:shadow-lg transition-all duration-300 flex flex-col'); ?>>
    <div class="aspect-video relative overflow-hidden bg-neutral-100">
        <?php if ( has_post_thumbnail() ) : ?>
            <?php the_post_thumbnail( 'medium_large', array( 'class' => 'w-full h-full object-cover transition-transform duration-500 hover:scale-105' ) ); ?>
        <?php else : ?>
            <div class="w-full h-full flex items-center justify-center text-neutral-400">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
                </svg>
            </div>
        <?php endif; ?>
        
        <?php 
        $cities = get_the_terms( get_the_ID(), 'city' );
        if ( ! empty( $cities ) ) : ?>
            <div class="absolute top-4 left-4">
                <span class="bg-primary/90 text-white text-xs font-bold px-3 py-1 rounded-full backdrop-blur-sm">
                    <?php echo esc_html( $cities[0]->name ); ?>
                </span>
            </div>
        <?php endif; ?>
    </div>

    <div class="p-6 flex-grow flex flex-col">
        <h3 class="text-xl font-bold text-neutral-900 mb-2 line-clamp-2">
            <a href="<?php the_permalink(); ?>" class="hover:text-primary transition-colors">
                <?php the_title(); ?>
            </a>
        </h3>
        
        <div class="text-neutral-600 text-sm line-clamp-3 mb-6">
            <?php echo wp_trim_words( get_the_excerpt(), 20 ); ?>
        </div>

        <div class="mt-auto flex items-center justify-between pt-4 border-t border-neutral-100">
            <div class="flex flex-wrap gap-2">
                <?php 
                $levels = get_the_terms( get_the_ID(), 'study_level' );
                if ( ! empty( $levels ) ) :
                    foreach ( array_slice($levels, 0, 2) as $level ) : ?>
                        <span class="text-[10px] uppercase tracking-wider font-bold text-neutral-400 bg-neutral-100 px-2 py-0.5 rounded">
                            <?php echo esc_html( $level->name ); ?>
                        </span>
                    <?php endforeach;
                endif; ?>
            </div>
            <a href="<?php the_permalink(); ?>" class="text-primary font-bold text-sm flex items-center gap-1 group">
                Үзэх
                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 transition-transform group-hover:translate-x-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                </svg>
            </a>
        </div>
    </div>
</article>
