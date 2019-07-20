/* Homepage Scripts
================================================================ */

$(document).ready(function() {

    if (window.matchMedia('(min-width: 940px)').matches) { // is the window width larger than 940px?
    /* Hero Parallax Background
    ******************************************************************/

        var heroBg = $('.parallax-bg .hero');

        $(window).on('scroll', function() { 

            var st = $(this).scrollTop();

            heroBg.css({ 
                'background-position' : "0 "+(st/1.5)+"px, 0 0",
            }); 

        });

    /* Hero Fixed
    ******************************************************************/

    	$(".hero-fixed").css({
    		'padding-top':($(".hero").height()+'px')
    	});

        var hero = $('.hero-fixed .hero');

        $(window).on('scroll', function() {

            var st = $(this).scrollTop();

            hero.css({ 
                'opacity' : 1 - st/1000
            }); 

        });

    /* Hero HTML5 Video
    ******************************************************************/

        $('.video-bg .hero-vid, .video-bg .hero-overlay').show();

    } // end window.matchMedia

}); // End document.ready
