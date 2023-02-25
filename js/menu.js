'use strict';

// Anchor tags
$(function () {
    $('a[href^="#"]').click(function () {
        var target = $(this).attr('href');
        $('html, body').animate({ scrollTop: $(target).offset().top - 50 }, 800);
        return false;
    });
});

// Fixed-top menu
function fixedHeader() {
    var ww = $(window).scrollTop();
    if (ww > 0) {
        $('.menu').addClass('menu--active');
        $('.mobile-menu').addClass('mobile-menu--active');
    } else {
        $('.menu').removeClass('menu--active');
        $('.mobile-menu').removeClass('mobile-menu--active');
    }
}
// Immediately call
fixedHeader();

$(window).on('scroll', function () {
    // Call on window scroll
    fixedHeader();
});
