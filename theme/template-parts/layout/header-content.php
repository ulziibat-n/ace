<?php
/**
 * Template part for displaying the header content with modern Tailwind styling.
 *
 * @package aceedu
 */
?>

<header id="masthead" class="relative z-50">
	<div class="container">
		<div class="relative flex items-center gap-8">
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
			<nav id="site-navigation" class="hidden items-center gap-8 lg:flex" aria-label="<?php esc_attr_e( 'Үндсэн цэс', 'aceedu' ); ?>">
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

			<div class="mr-0 ml-auto flex items-stretch gap-1 py-5.5">
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
		</div>
	</div>

	<!-- Mobile Menu Overlay -->
	<div id="mobile-menu" class="fixed inset-0 top-[80px] z-40 hidden overflow-y-auto bg-white md:top-[96px] lg:hidden">
		<div class="p-8">
			<?php
			wp_nav_menu(
				array(
					'theme_location' => 'menu-1',
					'container'      => false,
					'depth'          => 2,
					'menu_class'     => 'flex flex-col gap-6 text-2xl font-black text-neutral-900',
					'walker'         => new UB_Mega_Menu_Walker(),
				)
			);
			?>
			<div class="mt-12 flex flex-col gap-8 border-t border-neutral-100 pt-8">
				<?php ub_language_switcher(); ?>
				
				<?php if ( $ub_header_button ) : ?>
					<a href="<?php echo esc_url( $ub_header_button['url'] ); ?>" 
						target="<?php echo esc_attr( $ub_header_button['target'] ? $ub_header_button['target'] : '_self' ); ?>"
						class="block w-full rounded-2xl bg-primary py-5 text-center text-xl font-black text-white">
						<?php echo esc_html( $ub_header_button['title'] ); ?>
					</a>
				<?php endif; ?>
			</div>
		</div>
	</div>
</header>
