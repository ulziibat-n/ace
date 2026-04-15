<?php
/**
 * Template part for displaying the header content with modern Tailwind styling.
 *
 * @package aceedu
 */
?>

<header id="masthead" class="relative z-50">
	<div id="mobile-header-blur" class="h-(--header-height) z-40 fixed top-0 left-0 right-0 xl:hidden hidden backdrop-blur-md bg-white/80 mask-[linear-gradient(to_bottom,black_80%,transparent)]"></div>
	<div class="container relative z-50">
		<div class="flex gap-8 items-center">
			<!-- Logo -->
			<div class="shrink-0">
				<?php if ( has_custom_logo() ) : ?>
					<?php the_custom_logo(); ?>
				<?php else : ?>
					<a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home" class="flex gap-2 items-center">
						<span class="flex gap-1 items-center text-2xl font-black tracking-tighter text-neutral-900">
							<span class="text-primary">ACE</span>EDU
						</span>
					</a>
				<?php endif; ?>
			</div>

			<!-- Desktop Navigation -->
			<nav id="site-navigation" class="hidden gap-8 items-center xl:flex" aria-label="<?php esc_attr_e( 'Үндсэн цэс', 'aceedu' ); ?>">
				<?php
				wp_nav_menu(
					array(
						'theme_location'  => 'menu-1',
						'menu_id'         => 'primary-menu',
						'container'       => false,
						'depth'           => 2,
						'menu_class'      => 'flex items-center',
						'list_item_class' => 'inline-block', // Custom filter needed or handle in CSS.
						'walker'          => new UB_Mega_Menu_Walker(),
					)
				);
				?>
			</nav>

			<div class="flex gap-2 items-center mr-0 ml-auto py-5.5">
				<div class="hidden gap-1 items-center xl:flex">
					<?php ub_language_switcher(); ?>

					<?php
					$ub_header_button = function_exists( 'get_field' ) ? get_field( 'header_button', 'option' ) : null;
					?>
					<?php if ( $ub_header_button ) : ?>
						<a href="<?php echo esc_url( $ub_header_button['url'] ); ?>" 
							target="<?php echo esc_attr( $ub_header_button['target'] ? $ub_header_button['target'] : '_self' ); ?>"
							class="px-4 py-2 text-xs font-bold text-white shadow-lg transition-all duration-300 rounded-xs bg-primary shadow-primary/20 hover:bg-primary-dark">
							<?php echo esc_html( $ub_header_button['title'] ); ?>
						</a>
					<?php endif; ?>
				</div>

				<!-- Mobile Menu Toggle -->
				<button id="mobile-menu-toggle" class="flex justify-center items-center p-2 transition-colors rounded-xs text-primary hover:bg-neutral-50 xl:hidden" aria-label="<?php esc_attr_e( 'Цэс нээх/хаах', 'aceedu' ); ?>">
					<svg class="w-6 h-6 menu-icon-open" fill="none" stroke="currentColor" viewBox="0 0 24 24">
						<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16m-7 6h7"></path>
					</svg>
					<svg class="hidden w-6 h-6 menu-icon-close" fill="none" stroke="currentColor" viewBox="0 0 24 24">
						<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
					</svg>
				</button>
			</div>
		</div>
	</div>

	<!-- Mobile Menu Overlay -->
	<div id="mobile-menu" class="fixed inset-0 z-30 hidden h-screen overflow-y-auto bg-white pt-(--header-height) xl:hidden">
		<div class="container py-8">
			<?php
			wp_nav_menu(
				array(
					'theme_location' => 'menu-1',
					'container'      => false,
					'depth'          => 2,
					'menu_class'     => 'flex flex-col gap-6 text-xl font-bold text-neutral-900',
					'walker'         => new UB_Mega_Menu_Walker(),
					'is_mobile'      => true,
				)
			);
			?>
			<div class="flex flex-col gap-8 pt-8 mt-12 border-t border-neutral-100">
				<div class="flex gap-4 justify-between items-center">
					<span class="text-[0.625rem] font-black text-neutral-400 uppercase tracking-[0.2em]"><?php esc_html_e( 'Хэл солих', 'aceedu' ); ?>:</span>
					<?php ub_language_switcher(); ?>
				</div>
				
				<?php if ( $ub_header_button ) : ?>
					<a href="<?php echo esc_url( $ub_header_button['url'] ); ?>" 
						target="<?php echo esc_attr( $ub_header_button['target'] ? $ub_header_button['target'] : '_self' ); ?>"
						class="block px-6 py-3 w-full text-sm font-bold text-center text-white shadow-lg rounded-xs bg-primary shadow-primary/20">
						<?php echo esc_html( $ub_header_button['title'] ); ?>
					</a>
				<?php endif; ?>
			</div>
		</div>
	</div>
</header>
