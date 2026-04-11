/**
 * Hero Block Script
 *
 * Handles Swiper initialization for the hero slider in both
 * frontend and block editor contexts using pure Vanilla JS.
 */
(() => {
	/**
	 * Set Same Height for all slides in swiper
	 *
	 * @param {Object} swiper The Swiper instance
	 */
	const setSameHeight = (swiper) => {
		requestAnimationFrame(() => {
			let maxHeight = 0;
			if (swiper.slides && swiper.slides.length > 0) {
				swiper.slides.forEach((slide) => {
					slide.style.height = 'auto';
				});
				swiper.slides.forEach((slide) => {
					if (slide.offsetHeight > maxHeight)
						maxHeight = slide.offsetHeight;
				});
				if (maxHeight > 0) {
					swiper.slides.forEach((slide) => {
						slide.style.height = `${maxHeight}px`;
					});
					swiper.update();
				}
			}
		});
	};

	/**
	 * Initialize Hero Slider
	 *
	 * @param {HTMLElement} block The block element.
	 */
	const initHeroSlider = (block) => {
		const sliderEl = block.querySelector('[data-hero-slider]');
		if (!sliderEl || typeof Swiper === 'undefined') return;

		// Initialize Swiper
		new Swiper(sliderEl, {
			loop: true,
			speed: 1200,
			autoplay: {
				delay: 6000,
				disableOnInteraction: false,
			},
			pagination: {
				el: block.querySelector('.swiper-pagination'),
				type: 'progressbar',
			},
			navigation: {
				nextEl: block.querySelector('[data-hero-carousel-next]'),
				prevEl: block.querySelector('[data-hero-carousel-prev]'),
			},
			effect: 'fade',
			fadeEffect: {
				crossFade: true,
			},
			on: {
				init: function () {
					setSameHeight(this);
				},
				resize: function () {
					setSameHeight(this);
				},
				autoplayTimeLeft(s, time, progress) {
					sliderEl.style.setProperty(
						'--hero-autoplay-progress',
						(1 - progress).toFixed(3)
					);
				},
			},
		});
	};

	/**
	 * Block Initialization
	 */
	const onReady = () => {
		document.querySelectorAll('.hero-block').forEach(initHeroSlider);
	};

	// Frontend
	if (document.readyState === 'loading') {
		document.addEventListener('DOMContentLoaded', onReady);
	} else {
		onReady();
	}

	// Editor (ACF Block Preview)
	if (window.acf) {
		window.acf.addAction('render_block_preview/type=hero', (block) => {
			const nativeBlock = block instanceof jQuery ? block[0] : block;
			initHeroSlider(nativeBlock);
		});
	}
})();
