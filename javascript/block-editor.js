/**
 * Block editor modifications
 *
 * This file is loaded only by the block editor. Use it to modify the block
 * editor via its APIs.
 *
 * The JavaScript code you place here will be processed by esbuild, and the
 * output file will be created at `../theme/js/block-editor.min.js` and
 * enqueued in `../theme/functions.php`.
 *
 * For esbuild documentation, please see:
 * https://esbuild.github.io/
 */

/**
 * This import adds your front-end post title and Tailwind Typography classes
 * to the block editor. It also adds some helper classes so you can access the
 * post type when modifying the block editor’s appearance.
 */
import '@_tw/typography/block-editor-classes';

wp.domReady(() => {
	/**
	 * Add support for Tailwind Typography’s `lead` class via a block style.
	 */
	wp.blocks.registerBlockStyle('core/paragraph', {
		name: 'lead',
		label: 'Lead',
	});

	// Unregister stretchy variations.
	wp.blocks.unregisterBlockVariation( 'core/paragraph', 'stretchy-paragraph' );
	wp.blocks.unregisterBlockVariation( 'core/heading', 'stretchy-heading' );

});

/**
 * Initialize ACF block previews in the editor
 */
const initializeBlock = ($block) => {
	const heroSlider = $block.find('[data-hero-slider]');
	if (heroSlider.length && typeof Swiper !== 'undefined') {
		new Swiper(heroSlider[0], {
			loop: true,
			effect: 'fade',
			speed: 800,
			autoplay: {
				delay: 5000,
				disableOnInteraction: false,
			},
			pagination: {
				el: '.swiper-pagination',
				clickable: true,
			},
			navigation: {
				nextEl: '.swiper-button-next',
				prevEl: '.swiper-button-prev',
			},
		});
	}

	const testimonialsSlider = $block.find('[data-testimonials-slider]');
	if (testimonialsSlider.length && typeof Swiper !== 'undefined') {
		new Swiper(testimonialsSlider[0], {
			loop: false,
			speed: 600,
			spaceBetween: 10,
			slidesPerView: 1,
			autoplay: {
				delay: 7000,
				disableOnInteraction: false,
			},
			pagination: {
				el: '.swiper-pagination',
				type: 'progressbar',
			},
			navigation: {
				nextEl: '[data-testimonials-carousel-next]',
				prevEl: '[data-testimonials-carousel-prev]',
			},
			breakpoints: {
				640: { slidesPerView: 2 },
				1024: { slidesPerView: 3 },
				1280: { slidesPerView: 4 },
			},
		});
	}
};

// Initialize blocks on editor load or preview update.
if (window.acf) {
	window.acf.addAction('render_block_preview/type=hero', initializeBlock);
	window.acf.addAction('render_block_preview/type=testimonials', initializeBlock);
}
