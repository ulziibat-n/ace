/**
 * Team Block Script
 *
 * Handles Swiper initialization for the team carousel.
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
				const card = slide.querySelector('[data-card]');
				if (card) card.style.height = 'auto';
			});

			swiper.slides.forEach((slide) => {
				const card = slide.querySelector('[data-card]');
				if (card && card.offsetHeight > maxHeight)
					maxHeight = card.offsetHeight;
			});

			swiper.slides.forEach((slide) => {
				const card = slide.querySelector('[data-card]');
				if (card) card.style.height = `${maxHeight}px`;
			});
		}
	};

	/**
	 * Initialize Team Slider
	 *
	 * @param {HTMLElement} block The block element.
	 */
	const initTeamSlider = (block) => {
		const sliderEl = block.querySelector('[data-team-slider]');
		const nav = block.querySelector('[data-team-nav]');
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
				nextEl: block.querySelector('[data-team-next]'),
				prevEl: block.querySelector('[data-team-prev]'),
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

	const onReady = () => {
		document
			.querySelectorAll('.block-team')
			.forEach(initTeamSlider);
	};

	if (document.readyState === 'loading') {
		document.addEventListener('DOMContentLoaded', onReady);
	} else {
		onReady();
	}

	if (window.acf) {
		window.acf.addAction(
			'render_block_preview/type=team',
			(block) => {
				const nativeBlock = block instanceof jQuery ? block[0] : block;
				initTeamSlider(nativeBlock);
			}
		);
	}
})();
