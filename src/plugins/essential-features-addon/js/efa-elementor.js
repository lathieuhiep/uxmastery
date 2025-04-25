(function ($) {
    // setting owlCarousel
    const owlCarouselOptions = (options) => {
        let defaults = {
            loop: true,
            smartSpeed: 800,
            autoplaySpeed: 800,
            navSpeed: 800,
            dotsSpeed: 800,
            dragEndSpeed: 800,
            navText: ['<i class="efa-icon-mask efa-icon-mask-arrow-left"></i>','<i class="efa-icon-mask efa-icon-mask-arrow-right"></i>'],
        }

        // extend options
        return $.extend(defaults, options)
    }

    /* Fly-up title animation */
    const ElementFlyUpTitle = function ($scope, $) {
        const titles = $scope.find('.fly-up-title');
console.log(titles)
        if ( titles.length ) {
            titles.each(function () {
                const el = $(this);
                const text = el.data('text');
                if (!text) return;

                el.html(''); // Clear nội dung cũ

                // Tạo từng span, giữ cả khoảng trắng
                for (let i = 0; i < text.length; i++) {
                    const char = text[i];
                    const letter = $('<span>').text(char === ' ' ? '\u00A0' : char); // \u00A0 = non-breaking space
                    el.append(letter);
                }

                // Tạo hiệu ứng sóng nhẹ và fade-in mượt
                el.find('span').each(function (index) {
                    const that = $(this);

                    const baseDelay = 100;
                    const waveOffset = Math.sin(index / 2);
                    const delay = index * baseDelay + waveOffset;

                    setTimeout(function () {
                        that.addClass('visible');
                    }, delay);
                });
            });
        }
    };

    /* Start Carousel slider */
    const ElementCarouselSlider = function ($scope, $) {
        const slider = $scope.find('.custom-owl-carousel');

        if ( slider.length ) {
            const options = slider.data('settings-owl');
            slider.owlCarousel(owlCarouselOptions(options))
        }
    };

    /* counter up */
    const ElementCounterUp = function ($scope, $) {
        const counting = $scope.find('.counting');

        if ( counting.length ) {
            counting.counterUp({
                delay: 10,
                time: 1000
            });
        }
    }

    $(window).on('elementor/frontend/init', function () {
        /* Element fly-up title */
        elementorFrontend.hooks.addAction('frontend/element_ready/efa-hero.default', ElementFlyUpTitle);

        /* Element slider */
        elementorFrontend.hooks.addAction('frontend/element_ready/efa-slides.default', ElementCarouselSlider);

        /* Element post carousel */
        elementorFrontend.hooks.addAction('frontend/element_ready/efa-post-carousel.default', ElementCarouselSlider);

        /* Element testimonial slider */
        elementorFrontend.hooks.addAction('frontend/element_ready/efa-testimonial-slider.default', ElementCarouselSlider);

        /* Element carousel images */
        elementorFrontend.hooks.addAction('frontend/element_ready/efa-carousel-images.default', ElementCarouselSlider);

        /* Element counter up */
        elementorFrontend.hooks.addAction('frontend/element_ready/efa-service-card.default', ElementCounterUp);
    });

})(jQuery);