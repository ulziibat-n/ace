<?php
/**
 * Template part for displaying the header content with modern Tailwind styling.
 *
 * @package aceedu
 */
?>

<header id="masthead" class="relative z-50 ">
	<div class="container mx-auto px-4">
		<div class="flex items-center gap-8 py-6 relative">
			<!-- Logo -->
			<div class="shrink-0">
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
			<nav id="site-navigation" class="hidden lg:flex items-center gap-8" aria-label="<?php esc_attr_e( 'Үндсэн цэс', 'aceedu' ); ?>">
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

			<div class="flex items-stretch gap-1 ml-auto mr-0">
				<?php ub_language_switcher(); ?>

				<?php
				$ub_header_button = function_exists( 'get_field' ) ? get_field( 'header_button', 'option' ) : null;
				?>
				<?php if ( $ub_header_button ) : ?>
					<a href="<?php echo esc_url( $ub_header_button['url'] ); ?>" 
						target="<?php echo esc_attr( $ub_header_button['target'] ? $ub_header_button['target'] : '_self' ); ?>"
						class="bg-primary hover:bg-primary-dark text-white px-4 py-2 rounded-xs text-xs font-bold transition-all duration-300 shadow-lg shadow-primary/20">
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
			<div class="mt-12 pt-8 border-t border-neutral-100 flex flex-col gap-8">
				<?php ub_language_switcher(); ?>
				
				<?php if ( $header_button ) : ?>
					<a href="<?php echo esc_url( $header_button['url'] ); ?>" 
						target="<?php echo esc_attr( $header_button['target'] ? $header_button['target'] : '_self' ); ?>"
						class="block w-full text-center bg-primary text-white py-5 rounded-2xl font-black text-xl">
						<?php echo esc_html( $header_button['title'] ); ?>
					</a>
				<?php endif; ?>
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
