<?php
/**
 * Template part for displaying the header content with modern Tailwind styling.
 *
 * @package aceedu
 */
?>

<header id="masthead" class="relative z-50">
	<div id="mobile-header-blur" class="fixed top-0 right-0 left-0 z-40 hidden h-(--header-height) bg-white/80 mask-[linear-gradient(to_bottom,black_80%,transparent)] backdrop-blur-md xl:hidden"></div>
	<div class="relative z-50 container">
		<div class="flex items-center gap-8">
			<!-- Logo -->
			<div class="shrink-0">
				<?php if ( has_custom_logo() ) : ?>
					<?php the_custom_logo(); ?>
				<?php else : ?>
					<a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home" class="flex items-center gap-2">
						<span class="flex items-center gap-1 text-2xl font-black tracking-tighter text-neutral-900">
							<span class="text-primary">ACE</span>EDU
						</span>
					</a>
				<?php endif; ?>
			</div>

			<!-- Desktop Navigation -->
			<nav id="site-navigation" class="hidden items-center gap-8 xl:flex" aria-label="<?php esc_attr_e( 'Үндсэн цэс', 'aceedu' ); ?>">
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

			<div class="mr-0 ml-auto flex items-center gap-2 py-5.5">
				<div class="hidden items-center gap-1 xl:flex">
					<?php ub_language_switcher(); ?>

					<?php
					$ub_header_button = function_exists( 'get_field' ) ? get_field( 'header_button', 'option' ) : null;
					?>
					<?php if ( $ub_header_button ) : ?>
						<a href="<?php echo esc_url( $ub_header_button['url'] ); ?>" 
							target="<?php echo esc_attr( $ub_header_button['target'] ? $ub_header_button['target'] : '_self' ); ?>"
							class="rounded-xs bg-primary px-4 py-2 text-xs font-bold text-white shadow-lg shadow-primary/20 transition-all duration-300 hover:bg-primary-dark">
							<?php echo esc_html( $ub_header_button['title'] ); ?>
						</a>
					<?php endif; ?>
				</div>

				<!-- Mobile Menu Toggle -->
				<button id="mobile-menu-toggle" class="flex items-center justify-center rounded-xs p-2 text-primary transition-colors hover:bg-neutral-50 xl:hidden" aria-label="<?php esc_attr_e( 'Цэс нээх/хаах', 'aceedu' ); ?>">
					<svg class="menu-icon-open h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
						<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16m-7 6h7"></path>
					</svg>
					<svg class="menu-icon-close hidden h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
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
			<div class="mt-12 flex flex-col gap-8 border-t border-neutral-100 pt-8">
				<div class="flex items-center justify-between gap-4">
					<span class="text-[0.625rem] font-black tracking-[0.2em] text-neutral-400 uppercase"><?php esc_html_e( 'Хэл солих', 'aceedu' ); ?>:</span>
					<?php ub_language_switcher(); ?>
				</div>
				
				<?php if ( $ub_header_button ) : ?>
					<a href="<?php echo esc_url( $ub_header_button['url'] ); ?>" 
						target="<?php echo esc_attr( $ub_header_button['target'] ? $ub_header_button['target'] : '_self' ); ?>"
						class="block w-full rounded-xs bg-primary px-6 py-3 text-center text-sm font-bold text-white shadow-lg shadow-primary/20">
						<?php echo esc_html( $ub_header_button['title'] ); ?>
					</a>
				<?php endif; ?>
			</div>
		</div>
	</div>
</header>
