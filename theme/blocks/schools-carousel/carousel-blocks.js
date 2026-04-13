/**
 * Shared Dynamic Carousel Blocks Script
 *
 * Handles Swiper initialization for Schools Carousel and Posts Carousel
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
			// Reset heights
			swiper.slides.forEach((slide) => {
				slide.style.height = 'auto';
				const article = slide.querySelector('article');
				if (article) article.style.height = 'auto';
			});

			// Measure
			swiper.slides.forEach((slide) => {
				const article = slide.querySelector('article');
				if (article && article.offsetHeight > maxHeight)
					maxHeight = article.offsetHeight;
			});

			// Apply
			swiper.slides.forEach((slide) => {
				const article = slide.querySelector('article');
				if (article) article.style.height = `${maxHeight}px`;
			});
		}
	};

	/**
	 * Initialize Carousel
	 *
	 * @param {HTMLElement} block The block element.
	 */
	const initCarousel = (block) => {
		const sliderEl = block.querySelector('[data-carousel-slider]');
		if (!sliderEl || typeof Swiper === 'undefined') return;

		new Swiper(sliderEl, {
			loop: false,
			speed: 600,
			spaceBetween: 10,
			slidesPerView: 'auto',
			watchOverflow: true,
			pagination: {
				el: block.querySelector('.swiper-pagination'),
				type: 'progressbar',
			},
			navigation: {
				nextEl: block.querySelector('[data-carousel-next]'),
				prevEl: block.querySelector('[data-carousel-prev]'),
			},
			on: {
				init: function () {
					setSameHeight(this);
				},
				resize: function () {
					setSameHeight(this);
				},
				update: function () {
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
			.querySelectorAll('.block-schools-carousel, .block-posts-carousel')
			.forEach(initCarousel);
	};

	// Frontend
	if (document.readyState === 'loading') {
		document.addEventListener('DOMContentLoaded', onReady);
	} else {
		onReady();
	}

	// Editor
	if (window.acf) {
		const blockTypes = ['schools-carousel', 'posts-carousel'];
		blockTypes.forEach((type) => {
			window.acf.addAction(`render_block_preview/type=${type}`, (block) => {
				const nativeBlock = block instanceof jQuery ? block[0] : block;
				initCarousel(nativeBlock);
			});
		});
	}
})();
