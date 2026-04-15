/**
 * Front-end JavaScript
 */

document.addEventListener('DOMContentLoaded', () => {
	// FAQ Accordion Logic
	const faqItems = document.querySelectorAll('.faq-item');

	faqItems.forEach((item) => {
		const trigger = item.querySelector('.faq-trigger');

		if (trigger) {
			trigger.addEventListener('click', () => {
				const isOpen = item.classList.contains('active');
				const content = item.querySelector('.faq-content');

				// Close all other items
				faqItems.forEach((i) => {
					i.classList.remove('active');
					const c = i.querySelector('.faq-content');
					if (c) c.classList.add('hidden');
				});

				if (!isOpen && content) {
					item.classList.add('active');
					content.classList.remove('hidden');
				}
			});
		}
	});

	// Smooth Scroll for Sub-Nav and Anchors
	document.querySelectorAll('a[href^="#"]').forEach((anchor) => {
		anchor.addEventListener('click', function (e) {
			const targetId = this.getAttribute('href');
			if (targetId === '#' || !targetId.startsWith('#')) return;

			const targetElement = document.querySelector(targetId);
			if (targetElement) {
				e.preventDefault();
				const offset = 100; // Account for sticky nav
				const elementPosition =
					targetElement.getBoundingClientRect().top;
				const offsetPosition =
					elementPosition + window.pageYOffset - offset;

				window.scrollTo({
					top: offsetPosition,
					behavior: 'smooth',
				});
			}
		});
	});

	// Sticky Nav Highlight on Scroll
	const sections = document.querySelectorAll('section[id]');
	const navLinks = document.querySelectorAll('.school-single nav a');

	if (sections.length > 0 && navLinks.length > 0) {
		window.addEventListener('scroll', () => {
			let current = '';
			sections.forEach((section) => {
				const sectionTop = section.offsetTop;
				if (window.pageYOffset >= sectionTop - 150) {
					current = section.getAttribute('id');
				}
			});

			navLinks.forEach((link) => {
				link.classList.remove('text-primary', 'border-primary');
				link.classList.add('text-slate-500', 'border-transparent');
				if (link.getAttribute('href') === `#${current}`) {
					link.classList.remove(
						'text-slate-500',
						'border-transparent'
					);
					link.classList.add('text-primary', 'border-primary');
				}
			});
		});
	}

	// Mobile Menu Toggle Logic
	const mobileMenuToggle = document.getElementById('mobile-menu-toggle');
	const mobileMenu = document.getElementById('mobile-menu');
	const iconOpen = mobileMenuToggle?.querySelector('.menu-icon-open');
	const iconClose = mobileMenuToggle?.querySelector('.menu-icon-close');

	if (mobileMenuToggle && mobileMenu) {
		mobileMenuToggle.addEventListener('click', () => {
			const isOpen = !mobileMenu.classList.contains('hidden');

			if (isOpen) {
				// Close Menu
				mobileMenu.classList.add('hidden');
				iconOpen?.classList.remove('hidden');
				iconClose?.classList.add('hidden');
				document.body.classList.remove('overflow-hidden');
			} else {
				// Open Menu
				mobileMenu.classList.remove('hidden');
				iconOpen?.classList.add('hidden');
				iconClose?.classList.remove('hidden');
				document.body.classList.add('overflow-hidden');
			}
		});

		// Close menu when clicking on a link
		const mobileLinks = mobileMenu.querySelectorAll('a');
		mobileLinks.forEach((link) => {
			link.addEventListener('click', () => {
				mobileMenu.classList.add('hidden');
				iconOpen?.classList.remove('hidden');
				iconClose?.classList.add('hidden');
				document.body.classList.remove('overflow-hidden');
			});
		});
	}

	/**
	 * Real-time Header Height Calculation
	 */
	const headerHeightUpdate = () => {
		const masthead = document.getElementById('masthead');
		if (masthead) {
			const height = masthead.offsetHeight;
			document.documentElement.style.setProperty(
				'--header-height',
				`${height}px`
			);
		}
	};

	// Initial calculation
	headerHeightUpdate();

	// Update on resize
	window.addEventListener('resize', headerHeightUpdate);
});
