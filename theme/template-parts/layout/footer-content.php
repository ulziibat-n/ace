<?php
/**
 * Template part for displaying the footer content with structured columns
 */
?>

<footer id="colophon" class="bg-neutral-900 text-white pt-20 pb-10">
    <div class="container mx-auto px-4">
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-12 mb-16">
            
            <!-- Column 1: Brand -->
            <div>
                <a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home" class="inline-block mb-6">
                    <span class="text-3xl font-black tracking-tighter text-white flex items-center gap-1">
                        <span class="text-primary">ACE</span>EDU
                    </span>
                </a>
                <p class="text-neutral-400 text-sm leading-relaxed mb-6">
                    <?php _e( 'Солонгост хэлний бэлтгэлээс тэтгэлэг хүртэл, нэг газраас. Бид таны сурах замналыг мэргэжлийн түвшинд төлөвлөж өгөх болно.', 'aceedu' ); ?>
                </p>
                <div class="flex items-center gap-4">
                    <!-- Social icons (Placeholder names, SVGs could be added) -->
                    <a href="#" class="w-10 h-10 rounded-full bg-white/5 flex items-center justify-center hover:bg-primary transition-colors">FB</a>
                    <a href="#" class="w-10 h-10 rounded-full bg-white/5 flex items-center justify-center hover:bg-primary transition-colors">IG</a>
                    <a href="#" class="w-10 h-10 rounded-full bg-white/5 flex items-center justify-center hover:bg-primary transition-colors">YT</a>
                </div>
            </div>

            <!-- Column 2: Program & Services -->
            <div>
                <h4 class="text-lg font-bold mb-6"><?php _e( 'Үйлчилгээ', 'aceedu' ); ?></h4>
                <ul class="space-y-4 text-neutral-400 text-sm">
                    <li><a href="<?php echo esc_url( home_url( '/schools' ) ); ?>" class="hover:text-white transition-colors"><?php _e( 'Сургуулиуд', 'aceedu' ); ?></a></li>
                    <li><a href="<?php echo esc_url( home_url( '/services' ) ); ?>" class="hover:text-white transition-colors"><?php _e( 'Хөтөлбөрүүд', 'aceedu' ); ?></a></li>
                    <li><a href="<?php echo esc_url( home_url( '/scholarships' ) ); ?>" class="hover:text-white transition-colors"><?php _e( 'Тэтгэлэг', 'aceedu' ); ?></a></li>
                    <li><a href="<?php echo esc_url( home_url( '/courses' ) ); ?>" class="hover:text-white transition-colors"><?php _e( 'Онлайн хичээл', 'aceedu' ); ?></a></li>
                </ul>
            </div>

            <!-- Column 3: Resources -->
            <div>
                <h4 class="text-lg font-bold mb-6"><?php _e( 'Нөөцүүд', 'aceedu' ); ?></h4>
                <ul class="space-y-4 text-neutral-400 text-sm">
                    <li><a href="<?php echo esc_url( home_url( '/stories' ) ); ?>" class="hover:text-white transition-colors"><?php _e( 'Амжилтын түүх', 'aceedu' ); ?></a></li>
                    <li><a href="<?php echo esc_url( home_url( '/blog' ) ); ?>" class="hover:text-white transition-colors"><?php _e( 'Блог / Guide', 'aceedu' ); ?></a></li>
                    <li><a href="<?php echo esc_url( home_url( '/faq' ) ); ?>" class="hover:text-white transition-colors"><?php _e( 'FAQ', 'aceedu' ); ?></a></li>
                    <li><a href="<?php echo esc_url( home_url( '/events' ) ); ?>" class="hover:text-white transition-colors"><?php _e( 'Event & Webinar', 'aceedu' ); ?></a></li>
                </ul>
            </div>

            <!-- Column 4: Contact -->
            <div>
                <h4 class="text-lg font-bold mb-6"><?php _e( 'Холбоо барих', 'aceedu' ); ?></h4>
                <ul class="space-y-4 text-neutral-400 text-sm">
                    <li class="flex items-start gap-3">
                        <span class="text-primary font-bold">A:</span>
                        <span>Улаанбаатар хот, Сүхбаатар дүүрэг...</span>
                    </li>
                    <li class="flex items-center gap-3">
                        <span class="text-primary font-bold">P:</span>
                        <span>+976 8888 8888</span>
                    </li>
                    <li class="flex items-center gap-3">
                        <span class="text-primary font-bold">E:</span>
                        <span>info@aceedu.mn</span>
                    </li>
                </ul>
                <div class="mt-8">
                    <a href="<?php echo esc_url( home_url( '/registration' ) ); ?>" class="inline-block bg-white text-neutral-900 px-6 py-3 rounded-xl font-bold text-sm hover:bg-secondary hover:text-white transition-all duration-300">
                        <?php _e( 'Зөвлөгөө авах', 'aceedu' ); ?>
                    </a>
                </div>
            </div>
        </div>

        <div class="pt-10 border-t border-white/10 flex flex-col md:flex-row justify-between items-center gap-4 text-xs text-neutral-500 uppercase tracking-widest">
            <p>&copy; <?php echo date('Y'); ?> ACE EDU WORLD. All rights reserved.</p>
            <div class="flex gap-6">
                <a href="<?php echo esc_url( home_url( '/privacy-policy' ) ); ?>" class="hover:text-white transition-colors"><?php _e( 'Privacy Policy', 'aceedu' ); ?></a>
                <a href="<?php echo esc_url( home_url( '/terms-conditions' ) ); ?>" class="hover:text-white transition-colors"><?php _e( 'Terms & Conditions', 'aceedu' ); ?></a>
            </div>
        </div>
    </div>
</footer>
