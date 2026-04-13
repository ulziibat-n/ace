/**
 * Core Pathways Block Script
 *
 * Handles Swiper initialization for the core pathways slider in both
 * frontend and block editor contexts using pure Vanilla JS.
 */
(() => {
	/**
	 * Set Same Height for all slides in swiper
	 *
	 * @param {Object} swiper The Swiper instance
	 */
	const setSameHeight = (swiper) => {
		let maxHeight = 0;
		if (swiper.slides && swiper.slides.length > 0) {
			swiper.slides.forEach((slide) => {
				slide.style.height = 'auto';
			});
			swiper.slides.forEach((slide) => {
				if (slide.offsetHeight > maxHeight)
					maxHeight = slide.offsetHeight;
			});
			swiper.slides.forEach((slide) => {
				slide.style.height = `${maxHeight}px`;
			});
		}
	};

	/**
	 * Initialize Core Pathways Slider
	 *
	 * @param {HTMLElement} block The block element.
	 */
	const initCorePathwaysSlider = (block) => {
		const sliderEl = block.querySelector('[data-core-pathways-slider]');
		if (!sliderEl || typeof Swiper === 'undefined') return;

		// Initialize Swiper
		new Swiper(sliderEl, {
			loop: false,
			speed: 600,
			spaceBetween: 10,
			slidesPerView: 'auto',
			centeredSlides: false,
			pagination: {
				el: block.querySelector('.swiper-pagination'),
				type: 'progressbar',
			},
			navigation: {
				nextEl: block.querySelector(
					'[data-core-pathways-carousel-next]'
				),
				prevEl: block.querySelector(
					'[data-core-pathways-carousel-prev]'
				),
			},
			on: {
				init: function () {
					setSameHeight(this);
				},
				resize: function () {
					setSameHeight(this);
				},
			},
		});
	};

	/**
	 * Block Initialization
	 */
	const onReady = () => {
		document
			.querySelectorAll('.block-core-pathways')
			.forEach(initCorePathwaysSlider);
	};

	// Frontend
	if (document.readyState === 'loading') {
		document.addEventListener('DOMContentLoaded', onReady);
	} else {
		onReady();
	}

	// Editor (ACF Block Preview)
	if (window.acf) {
		window.acf.addAction(
			'render_block_preview/type=core-pathways',
			(block) => {
				const nativeBlock = block instanceof jQuery ? block[0] : block;
				initCorePathwaysSlider(nativeBlock);
			}
		);
	}
})();
