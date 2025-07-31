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

                    const baseDelay = 30;
                    const waveOffset = Math.sin(index / 2) * 10;
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

    // load more
    const ElementBtnLoadMore = ($scope, $) => {
        const btnLoadMore = $scope.find('.btn-load-more');

        if ( btnLoadMore.length ) {
            let paged = 2;

            btnLoadMore.on('click', function () {
                const btn = $(this);
                const checkActive = btn.hasClass('active-loading');

                if ( checkActive ) return;

                const postBlock = btn.closest('.efa-addon-post-grid');
                const postWarp = postBlock.find('.efa-addon-dual-post');
                const settings = postBlock.data('settings');
                const posts_per_page = parseInt( settings.posts_per_page );
                const order_by = settings.order_by;
                const order = settings.order;
                const cat = settings.cat;
                const image_size = settings.image_size;
                const show_excerpt = settings.show_excerpt;
                const excerpt_length = settings.excerpt_length;

                $.ajax({
                    url: btnEfaLoadMore.ajaxurl,
                    type: 'POST',
                    data: {
                        action: 'efa_load_more_dual_posts',
                        paged: paged,
                        posts_per_page: posts_per_page,
                        order_by: order_by,
                        order: order,
                        cat: cat,
                        image_size: image_size,
                        show_excerpt: show_excerpt,
                        excerpt_length: excerpt_length,
                        nonce: btnEfaLoadMore.nonce
                    },
                    beforeSend: function () {
                        btn.addClass('active-loading');
                    },
                    success: function (response) {
                        if ( response.success ) {
                            const $html = $(response.data.html);
                            const $newItems = $html.filter('.item').add($html.find('.item'));

                            $newItems.addClass('efa-zoom-in');
                            postWarp.append($html)

                            if ( response.data.posts_loaded < posts_per_page ) {
                                btn.remove();
                            } else {
                                paged++;
                                btn.removeClass('active-loading');
                            }
                        } else {
                            btn.remove();
                        }
                    }
                })
            })
        }
    }

    // tab posts
    const ElementTabPosts = ($scope, $) => {
        const tabPosts = $scope.find('.efa-addon-tab-posts');

        if (tabPosts.length) {
            const catLinkOpen = tabPosts.find('.cat-link-open');
            const tabNav = tabPosts.find('.tab-nav');
            const tabItems = tabPosts.find('.tab-item');

            const limit = tabNav.data('limit') || 6;
            const order_by = tabNav.data('order-by') || 'date';
            const order = tabNav.data('order') || 'DESC';
            const image_size = tabNav.data('image-size') || 'medium';

            const contentWrapper = tabPosts.find('.tab-content');

            tabItems.on('click', 'a', function (e) {
                e.preventDefault();

                const item = $(this).closest('.tab-item');
                const catId = parseInt(item.data('cat'));
                const contentPane = contentWrapper.find(`.pane-warp[data-cat="${catId}"]`);
                const urlCat = item.data('url-cat');

                // Nếu tab chưa từng load
                if (contentPane.length && contentPane.data('loaded') !== true) {
                    contentPane.html('<p class="loading">Đang tải...</p>');

                    $.ajax({
                        url: btnEfaLoadMore.ajaxurl,
                        method: 'POST',
                        data: {
                            action: 'efa_load_tab_posts',
                            cat_id: catId,
                            limit: limit,
                            order_by: order_by,
                            order: order,
                            image_size: image_size,
                            nonce: btnEfaLoadMore.nonce
                        },
                        success: function (res) {
                            if (res.success) {
                                const $html = $(res.data.html);
                                const $newItems = $html.filter('.post-item').add($html.find('.post-item'));

                                $newItems.addClass('efa-zoom-in');
                                contentPane.append($html);
                                contentPane.data('loaded', true);
                            } else {
                                contentPane.html('<p class="error">Không thể tải nội dung.</p>');
                            }
                        },
                        error: function () {
                            contentPane.html('<p class="error">Lỗi kết nối server.</p>');
                        },
                        complete: function () {
                            contentPane.find('.loading').remove();
                        }
                    });
                }

                // Đổi tab
                tabItems.removeClass('active');
                item.addClass('active');

                contentWrapper.find('.pane-warp').removeClass('active');
                contentPane.addClass('active').find('.post-item').removeClass('efa-zoom-in');

                // update url category
                if (urlCat) {
                    catLinkOpen.attr('href', urlCat);
                }
            });
        }
    };

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

        /* Element load more */
        elementorFrontend.hooks.addAction('frontend/element_ready/efa-dual-post-block.default', ElementBtnLoadMore);

        /* Element tab posts */
        elementorFrontend.hooks.addAction('frontend/element_ready/efa-tab-posts.default', ElementTabPosts);
    });

})(jQuery);