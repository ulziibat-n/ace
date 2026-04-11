/**
 * Related Posts Carousel Script
 * 
 * Handles Swiper initialization for the related posts carousel
 * using pure Vanilla JS.
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
                swiper.slides.forEach(slide => {
                    slide.style.height = 'auto';
                });
                swiper.slides.forEach(slide => {
                    if (slide.offsetHeight > maxHeight) maxHeight = slide.offsetHeight;
                });
                if (maxHeight > 0) {
                    swiper.slides.forEach(slide => {
                        slide.style.height = `${maxHeight}px`;
                    });
                    swiper.update();
                }
            }
        });
    };

    /**
     * Initialize Related Posts Carousel
     */
    const initRelatedPosts = () => {
        const carouselEl = document.querySelector('[data-related-posts-carousel]');
        if (!carouselEl || typeof Swiper === 'undefined') return;

        new Swiper(carouselEl, {
            slidesPerView: 'auto',
            spaceBetween: 10,
            navigation: {
                nextEl: '[data-related-posts-carousel-next]',
                prevEl: '[data-related-posts-carousel-prev]'
            },
            mousewheel: {
                forceToAxis: true
            },
            grabCursor: true,
            on: {
                init: function() {
                    setSameHeight(this);
                },
                resize: function() {
                    setSameHeight(this);
                }
            }
        });
    };

    // Initialize
    if (document.readyState === 'loading') {
        document.addEventListener('DOMContentLoaded', initRelatedPosts);
    } else {
        initRelatedPosts();
    }
})();
