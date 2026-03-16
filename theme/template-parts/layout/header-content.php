<?php
/**
 * Template part for displaying the header content with modern Tailwind styling
 */
?>

<header id="masthead" class="sticky top-0 z-50 bg-white/80 backdrop-blur-md border-b border-neutral-100">
    <div class="container mx-auto px-4">
        <div class="flex items-center justify-between h-20 md:h-24">
            
            <!-- Logo -->
            <div class="flex-shrink-0">
                <?php if ( has_custom_logo() ) : ?>
                    <?php the_custom_logo(); ?>
                <?php else : ?>
                    <a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home" class="flex items-center gap-2">
                        <span class="text-2xl font-black tracking-tighter text-neutral-900 flex items-center gap-1">
                            <span class="text-primary">ACE</span>EDU
                        </span>
                    </a>
                <?php endif; ?>
            </div>

            <!-- Desktop Navigation -->
            <nav id="site-navigation" class="hidden lg:flex items-center gap-8" aria-label="<?php esc_attr_e( 'Main Navigation', 'ace' ); ?>">
                <?php
                wp_nav_menu(
                    array(
                        'theme_location' => 'menu-1',
                        'menu_id'        => 'primary-menu',
                        'container'      => false,
                        'menu_class'     => 'flex items-center gap-8 text-sm font-bold text-neutral-600 hover:text-neutral-900 transition-colors',
                        'list_item_class' => 'inline-block', // Custom filter needed or handle in CSS
                    )
                );
                ?>
                
                <a href="<?php echo esc_url( home_url( '/registration' ) ); ?>" class="bg-primary hover:bg-primary-dark text-white px-6 py-3 rounded-full text-sm font-bold transition-all duration-300 shadow-lg shadow-primary/20">
                    <?php _e( 'Бүртгүүлэх', 'ace' ); ?>
                </a>
            </nav>

            <!-- Mobile Menu Toggle -->
            <button id="mobile-menu-toggle" class="lg:hidden p-2 text-neutral-600 hover:text-primary transition-colors focus:outline-none" aria-controls="mobile-menu" aria-expanded="false">
                <span class="sr-only"><?php esc_html_e( 'Toggle menu', 'ace' ); ?></span>
                <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path class="menu-open" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16m-7 6h7" />
                    <path class="menu-close hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>
        </div>
    </div>

    <!-- Mobile Menu Overlay -->
    <div id="mobile-menu" class="hidden lg:hidden fixed inset-0 top-[80px] md:top-[96px] bg-white z-40 overflow-y-auto">
        <div class="p-8">
            <?php
            wp_nav_menu(
                array(
                    'theme_location' => 'menu-1',
                    'container'      => false,
                    'menu_class'     => 'flex flex-col gap-6 text-2xl font-black text-neutral-900',
                )
            );
            ?>
            <div class="mt-12 pt-8 border-t border-neutral-100">
                <a href="<?php echo esc_url( home_url( '/registration' ) ); ?>" class="block w-full text-center bg-primary text-white py-5 rounded-2xl font-black text-xl">
                    <?php _e( 'Бүртгүүлэх', 'ace' ); ?>
                </a>
            </div>
        </div>
    </div>
</header>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const toggle = document.getElementById('mobile-menu-toggle');
        const menu = document.getElementById('mobile-menu');
        const openIcon = toggle.querySelector('.menu-open');
        const closeIcon = toggle.querySelector('.menu-close');

        toggle.addEventListener('click', function() {
            const expanded = toggle.getAttribute('aria-expanded') === 'true';
            toggle.setAttribute('aria-expanded', !expanded);
            menu.classList.toggle('hidden');
            openIcon.classList.toggle('hidden');
            closeIcon.classList.toggle('hidden');
            document.body.classList.toggle('overflow-hidden');
        });
    });
</script>
