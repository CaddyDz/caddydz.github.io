/* Earth Slider
================================================================ */

$(document).ready(function () {

    if ($('#s-welcome').length > 0) {

        //-----------------------------------------------------------------
        // Config
        //-----------------------------------------------------------------

        var $pin = $('.earth .pin-wrapper');
        var $pinCount = $pin.length;
        var $pinRange = 165;
        var $pinFirstChild = $('.earth .pin-wrapper:first-child');
        var $pinLastChild = $('.earth .pin-wrapper:last-child');
        var $pinActive = $('.earth .pin-wrapper.active');
        var $pinIndex = $pinActive.index() + 1;

        //-----------------------------------------------------------------
        // Position the pins
        //-----------------------------------------------------------------

        function pinRotate(pinAngle, pinNo) {

            var pinAngle = pinAngle / (pinNo + 1) + ((180 - $pinRange) / 2);
            pinAngle.toString();
            var interval = pinAngle - ((180 - $pinRange) / 2);

            for (i = 1; i < $pinCount + 1; i++) {
                if (i > 1) {
                    pinAngle += interval;
                }
                i.toString();
                $('.pin-wrapper:nth-child(' + i + ')').css({
                    transform: 'rotate(' + pinAngle + 'deg)'
                });
            }

        }

        pinRotate($pinRange, $pinCount);

        //-----------------------------------------------------------------
        // Change content on pin click
        //-----------------------------------------------------------------

        $pin.click(function () {

            $pin.removeClass('active');
            $(this).addClass('active');
            $('.welcome-content').removeClass('active');

            var $pinActive = $(this);
            var $pinIndex = $(this).index() + 1;

            setTimeout(function () {
                $('.welcome-content').removeClass('active');
                $('.welcome-content:nth-child(' + $pinIndex + ')').addClass('active');
            }, 200);

        });

        //-----------------------------------------------------------------
        // Change content on next/prev click
        //-----------------------------------------------------------------

        $('.section.welcome .nav-prev').click(function () {

            var $pinActive = $('.earth .pin-wrapper.active');

            $pinActive.removeClass('active');

            if ($pinActive.is(':first-child')) {
                $pinActive = $pinLastChild;
                $pinActive.addClass('active');
            } else {
                $pinActive.prev().addClass('active');
            }

            $('.welcome-content').removeClass('active');

            setTimeout(function () {
                $('.welcome-content').removeClass('active');
                $('.welcome-content:nth-child(' + $pinIndex + ')').addClass('active');
            }, 200);

            var $pinActive = $('.earth .pin-wrapper.active');
            var $pinIndex = $pinActive.index() + 1;

        });

        $('.section.welcome .nav-next').click(function () {

            var $pinActive = $('.earth .pin-wrapper.active');

            $pinActive.removeClass('active');

            if ($pinActive.is(':last-child')) {
                $pinActive = $pinFirstChild;
                $pinActive.addClass('active');
            } else {
                $pinActive.next().addClass('active');
            }

            $('.welcome-content').removeClass('active');

            setTimeout(function () {
                $('.welcome-content').removeClass('active');
                $('.welcome-content:nth-child(' + $pinIndex + ')').addClass('active');
            }, 200);

            var $pinActive = $('.earth .pin-wrapper.active');
            var $pinIndex = $pinActive.index() + 1;

        });

        //-----------------------------------------------------------------
        // Load Animations
        //-----------------------------------------------------------------

        if (window.matchMedia('(min-width: 940px)').matches) {
            $(window).bind("load scroll", function () {
                welcome = $('.welcome-titles');
                welcomeA = welcome.offset().top + welcome.height();
                welcomeB = $(window).scrollTop() + $(window).height();
                if (welcomeA < welcomeB) {
                    $('.welcome header:first-of-type').addClass('active');
                }
            });
        } else {
            $('.welcome .pin').css({
                opacity: 1
            });
            $('.welcome header:first-of-type').addClass('active');
        }

    }

}); // end document.ready

//-----------------------------------------------------------------
// Equal height content
//-----------------------------------------------------------------

$(window).load(function () {

    var highest = null;
    var hi = 0;

    $(".welcome-content").each(function () {
        var h = $(this).outerHeight();
        if (h > hi) {
            hi = h;
            highest = $(this);
        }
        $(".welcome-content").css("height", hi)
    });

}); // end window.load
