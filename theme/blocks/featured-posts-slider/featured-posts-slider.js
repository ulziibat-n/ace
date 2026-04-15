/**
 * Featured Posts Slider Script
 */
(() => {
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

	const initFeaturedSlider = (block) => {
		const sliderEl = block.querySelector('[data-featured-slider]');
		if (!sliderEl || typeof Swiper === 'undefined') return;

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
				nextEl: block.querySelector('[data-featured-carousel-next]'),
				prevEl: block.querySelector('[data-featured-carousel-prev]'),
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
			},
		});
	};

	const onReady = () => {
		document.querySelectorAll('.featured-posts-slider-block').forEach(initFeaturedSlider);
	};

	if (document.readyState === 'loading') {
		document.addEventListener('DOMContentLoaded', onReady);
	} else {
		onReady();
	}

	if (window.acf) {
		window.acf.addAction('render_block_preview/type=featured-posts-slider', (block) => {
			const nativeBlock = block instanceof jQuery ? block[0] : block;
			initFeaturedSlider(nativeBlock);
		});
	}
})();
