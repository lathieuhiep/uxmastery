/**
 * Custom js v1.0.0
 * Copyright 2017-2020
 * Licensed under  ()
 */

(function ($) {
    "use strict";

    /* ------------------ NAVBAR FIXED ------------------ */

    $(window).scroll(function () {
        /* affix after scrolling 100px */
        if (
            $(document).scrollTop() > $(window).height() ||
            $(document).scrollTop() > 105
        ) {
            $(".navbar-sticky").addClass("navbar-fixed");
        } else {
            $(".navbar-sticky").removeClass("navbar-fixed");
        }
    });

    /* ------------------  NAVBAR TOGGLE ------------------ */

    $('.navbar-toggler').on('click', function () {
        $('.navbar-toggler-icon').toggleClass('active');
    });

    /* ------------------  NAVBAR SCROLL TO ------------------ */

    var aScroll = $('.nav-item .nav-link'),
        $navbarCollapse = $('.navbar-collapse');
    aScroll.on('click', function (event) {
        var target = $($(this).attr('href'));
        $(this).parent(".nav-item").siblings().removeClass('active');
        $(this).parent('.nav-item').addClass('active');

        if (target.length > 0) {
            event.preventDefault();
            $('html, body').animate({
                scrollTop: target.offset().top - 100
            }, 1000);
        }

        // If click link and navabr is show
        if ($('.navbar-collapse').hasClass('show')) {
            $('.navbar-collapse').toggleClass('show');
            $('.navbar-toggler-icon').toggleClass('active');
            $('.navbar-toggler').toggleClass('collapsed');
        }
    });

    /* ------------------ NAVBAR SCROLLING SECTION ------------------ */

    var $section = $('.elementor-element'),
        $bodyScroll = $('.body-scroll');
    if ($bodyScroll.length > 0) {
        $(window).on("scroll", function () {
            $section.each(function () {
                var sectionID = $(this).attr("id"),
                    sectionTop = $(this).offset().top - 100,
                    sectionHight = $(this).outerHeight(),
                    wScroll = $(window).scrollTop(),
                    $navHref = $("a[href='#" + sectionID + "']"),
                    $nav = $('.navbar-nav').find($navHref).parent();
                if (wScroll > sectionTop - 1 && wScroll < sectionTop + sectionHight - 1) {
                    $nav.addClass('active');
                    $nav.siblings().removeClass('active');
                }
            });
        });
    }

    /* ------------------  sticky sidebar ------------------ */
    const siteSidebar = $('.site-sidebar');
    if (siteSidebar.length > 0) {
        siteSidebar.theiaStickySidebar({
            additionalMarginTop: 60
        });
    }

}(jQuery));