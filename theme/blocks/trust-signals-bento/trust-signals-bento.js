/**
 * Trust Signals Bento Script
 * 
 * Handles count-up animation for numbers using Intersection Observer.
 */
(() => {
    /**
     * Animate Number
     * 
     * @param {HTMLElement} el The element to animate
     * @param {number} target The target number
     */
    const animateCount = (el, target) => {
        let start = 0;
        const duration = 2000; // 2 seconds
        const startTime = performance.now();
        const suffix = el.innerText.replace(/[0-9]/g, ''); // Extract +, % etc

        const update = (currentTime) => {
            const elapsed = currentTime - startTime;
            const progress = Math.min(elapsed / duration, 1);
            
            // Ease out quad
            const easeProgress = progress * (2 - progress);
            
            const currentCount = Math.floor(easeProgress * target);
            el.innerText = currentCount + suffix;

            if (progress < 1) {
                requestAnimationFrame(update);
            } else {
                el.innerText = target + suffix;
            }
        };

        requestAnimationFrame(update);
    };

    /**
     * Initialize Observer
     */
    const initObserver = () => {
        const observerOptions = {
            threshold: 0.1
        };

        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    const el = entry.target;
                    const target = parseInt(el.getAttribute('data-countup'));
                    if (!isNaN(target)) {
                        animateCount(el, target);
                    }
                    observer.unobserve(el);
                }
            });
        }, observerOptions);

        document.querySelectorAll('[data-countup]').forEach(el => {
            observer.observe(el);
        });
    };

    // Frontend initialization
    if (document.readyState === 'loading') {
        document.addEventListener('DOMContentLoaded', initObserver);
    } else {
        initObserver();
    }

    // Editor support
    if (window.acf) {
        window.acf.addAction('render_block_preview/type=trust-signals-bento', (block) => {
            // In editor, we just show the numbers without animation for better usability
            // or we can trigger it once. 
        });
    }
})();
