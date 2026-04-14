/**
 * Process Roadmap Block Script
 *
 * Handles Swiper initialization for the process roadmap carousel.
 */
(() => {
	/**
	 * Initialize Process Roadmap Slider
	 *
	 * @param {HTMLElement} block The block element.
	 */
	const initProcessSlider = (block) => {
		const sliderEl = block.querySelector('[data-process-slider]');
		const nav = block.querySelector('[data-process-nav]');
		if (!sliderEl || typeof Swiper === 'undefined') return;

		const toggleNav = (swiper) => {
			if (!nav) return;
			if (swiper.isLocked) {
				nav.classList.add('opacity-0', 'pointer-events-none');
			} else {
				nav.classList.remove('opacity-0', 'pointer-events-none');
			}
		};

		new Swiper(sliderEl, {
			loop: false,
			speed: 600,
			spaceBetween: 0,
			slidesPerView: 'auto',
			centeredSlides: false,
			watchOverflow: true,
			grabCursor: true,
			navigation: {
				nextEl: block.querySelector('[data-process-next]'),
				prevEl: block.querySelector('[data-process-prev]'),
			},
			on: {
				init: function () {
					toggleNav(this);
				},
				resize: function () {
					toggleNav(this);
				},
				update: function () {
					toggleNav(this);
				},
			},
		});
	};

	const onReady = () => {
		document
			.querySelectorAll('.block-process-roadmap')
			.forEach(initProcessSlider);
	};

	if (document.readyState === 'loading') {
		document.addEventListener('DOMContentLoaded', onReady);
	} else {
		onReady();
	}

	if (window.acf) {
		window.acf.addAction(
			'render_block_preview/type=process-roadmap',
			(block) => {
				const nativeBlock = block instanceof jQuery ? block[0] : block;
				initProcessSlider(nativeBlock);
			}
		);
	}
})();
