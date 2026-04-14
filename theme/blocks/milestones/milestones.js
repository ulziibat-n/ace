/**
 * Milestones Block Script
 *
 * Handles Swiper initialization for the timeline carousel.
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
				const content = slide.querySelector('.flex-col');
				if (content) content.style.height = 'auto';
			});

			// Measure max height
			swiper.slides.forEach((slide) => {
				const content = slide.querySelector('.flex-col');
				if (content && content.offsetHeight > maxHeight)
					maxHeight = content.offsetHeight;
			});

			// Apply max height to all cards
			swiper.slides.forEach((slide) => {
				const content = slide.querySelector('.flex-col');
				if (content) content.style.height = `${maxHeight}px`;
			});
		}
	};

	/**
	 * Initialize Milestones Slider
	 *
	 * @param {HTMLElement} block The block element.
	 */
	const initMilestonesSlider = (block) => {
		const sliderEl = block.querySelector('[data-milestones-slider]');
		const nav = block.querySelector('[data-milestones-nav]');
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
			spaceBetween: 0,
			slidesPerView: 'auto',
			centeredSlides: false,
			watchOverflow: true,
			slideToClickedSlide: true,
			navigation: {
				nextEl: block.querySelector('[data-milestones-next]'),
				prevEl: block.querySelector('[data-milestones-prev]'),
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
			.querySelectorAll('.block-milestones')
			.forEach(initMilestonesSlider);
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
			'render_block_preview/type=milestones',
			(block) => {
				const nativeBlock = block instanceof jQuery ? block[0] : block;
				initMilestonesSlider(nativeBlock);
			}
		);
	}
})();
