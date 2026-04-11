/**
 * Trust Signals Block Script
 *
 * Handles Swiper initialization for the statistics slider in both
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
			// Reset heights first to get natural measurement
			swiper.slides.forEach((slide) => {
				slide.style.height = 'auto';
				const card = slide.querySelector('.block-trust-signals__card');
				if (card) card.style.height = 'auto';
			});

			// Measure max height
			swiper.slides.forEach((slide) => {
				const card = slide.querySelector('.block-trust-signals__card');
				if (card && card.offsetHeight > maxHeight)
					maxHeight = card.offsetHeight;
			});

			// Apply max height to all cards
			swiper.slides.forEach((slide) => {
				const card = slide.querySelector('.block-trust-signals__card');
				if (card) card.style.height = `${maxHeight}px`;
			});
		}
	};

	/**
	 * Initialize Trust Signals Slider
	 *
	 * @param {HTMLElement} block The block element.
	 */
	const initTrustSignalsSlider = (block) => {
		const sliderEl = block.querySelector('[data-trust-signals-slider]');
		const nav = block.querySelector('[data-trust-signals-nav]');
		if (!sliderEl || typeof Swiper === 'undefined') return;

		/**
		 * Toggle Navigation visibility based on slider state
		 *
		 * @param {Object} swiper Swiper instance
		 */
		const toggleNav = (swiper) => {
			if (!nav) return;
			if (swiper.isLocked) {
				nav.classList.add('opacity-0', 'pointer-events-none');
			} else {
				nav.classList.remove('opacity-0', 'pointer-events-none');
			}
		};

		// Initialize Swiper
		new Swiper(sliderEl, {
			loop: false,
			speed: 600,
			spaceBetween: 10,
			slidesPerView: 'auto',
			centeredSlides: false,
			watchOverflow: true,
			slideToClickedSlide: true,
			pagination: {
				el: block.querySelector('.swiper-pagination'),
				type: 'progressbar',
			},
			navigation: {
				nextEl: block.querySelector('[data-trust-signals-next]'),
				prevEl: block.querySelector('[data-trust-signals-prev]'),
			},
			on: {
				init: function () {
					setSameHeight(this);
					toggleNav(this);
				},
				resize: function () {
					setSameHeight(this);
					toggleNav(this);
				},
				update: function () {
					setSameHeight(this);
					toggleNav(this);
				},
			},
		});
	};

	/**
	 * Block Initialization
	 */
	const onReady = () => {
		document
			.querySelectorAll('.block-trust-signals')
			.forEach(initTrustSignalsSlider);
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
			'render_block_preview/type=trust-signals',
			(block) => {
				const nativeBlock = block instanceof jQuery ? block[0] : block;
				initTrustSignalsSlider(nativeBlock);
			}
		);
	}
})();
