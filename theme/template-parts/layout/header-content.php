<?php
/**
 * Template part for displaying the header content with modern Tailwind styling.
 *
 * @package aceedu
 */
?>

<header id="masthead" class="relative z-50">
	<div class="container px-4 mx-auto">
		<div class="flex relative gap-8 items-center py-6">
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
			<nav id="site-navigation" class="hidden gap-8 items-center lg:flex" aria-label="<?php esc_attr_e( 'Үндсэн цэс', 'aceedu' ); ?>">
				<?php
				wp_nav_menu(
					array(
						'theme_location'  => 'menu-1',
						'menu_id'         => 'primary-menu',
						'container'       => false,
						'depth'           => 2,
						'menu_class'      => 'flex items-center gap-4',
						'list_item_class' => 'inline-block', // Custom filter needed or handle in CSS.
					)
				);
				?>
			</nav>

			<div class="flex gap-1 items-stretch mr-0 ml-auto">
				<?php ub_language_switcher(); ?>

				<?php
				$ub_header_button = function_exists( 'get_field' ) ? get_field( 'header_button', 'option' ) : null;
				?>
				<?php if ( $ub_header_button ) : ?>
					<a href="<?php echo esc_url( $ub_header_button['url'] ); ?>" 
						target="<?php echo esc_attr( $ub_header_button['target'] ? $ub_header_button['target'] : '_self' ); ?>"
						class="px-4 py-2 text-xs font-bold text-white shadow-lg transition-all duration-300 bg-primary hover:bg-primary-dark rounded-xs shadow-primary/20">
						<?php echo esc_html( $ub_header_button['title'] ); ?>
					</a>
				<?php endif; ?>
			</div>
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
					'depth'          => 2,
					'menu_class'     => 'flex flex-col gap-6 text-2xl font-black text-neutral-900',
				)
			);
			?>
			<div class="flex flex-col gap-8 pt-8 mt-12 border-t border-neutral-100">
				<?php ub_language_switcher(); ?>
				
				<?php if ( $header_button ) : ?>
					<a href="<?php echo esc_url( $header_button['url'] ); ?>" 
						target="<?php echo esc_attr( $header_button['target'] ? $header_button['target'] : '_self' ); ?>"
						class="block py-5 w-full text-xl font-black text-center text-white rounded-2xl bg-primary">
						<?php echo esc_html( $header_button['title'] ); ?>
					</a>
				<?php endif; ?>
			</div>
		</div>
	</div>
</header>
