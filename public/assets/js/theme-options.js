
/* Theme Options
================================================================ */

$(document).ready(function() {

    /* Show/hide theme options */

    $('.options-trigger').click(function() {
        $('.theme-options').toggleClass('active');
        $(this).toggleClass('active');
    });

    /* Remember options */

    $(function() {
        $('input[type=checkbox]').each(function() {
            var state = JSON.parse( localStorage.getItem('radio_'  + this.id) );        
            if (state) this.checked = state.checked;
        });
    });

    if(!$('html').hasClass('ie9')) {
        $(window).bind('unload', function() {
            $('input[type=checkbox]').each(function() {
                localStorage.setItem(
                    'radio_' + this.id, JSON.stringify({checked: this.checked})
                );
            });
        });
    }
    
    $('#fixed-header-toggle').click(function(){
        if (this.checked) {
            $('body').addClass('fixed-header');
        } else {
            $('body').removeClass('fixed-header'); 
        }
    }) 

    /* HTML logo */
    $('#html-logo').click(function(){
        if (this.checked) {
            $('.image-logo').hide();
            $('.html-logo').show();
        } else {
            $('.image-logo').show();
            $('.html-logo').hide();
        }
    }) 

    /* Single Post - Load more comments */
    $('.load-more').click(function() {
        $(this).hide();
        $('.hidden-comment').fadeIn(400);
    });
    
}); // End document.ready

$(window).load(function(){

    /* Fixed header */
    if ($('#fixed-header-toggle:checked').length > 0) {
        $('body').addClass('fixed-header');
    } else {
        $('body').removeClass('fixed-header');     
    }

    /* HTML logo */
    if ($('#html-logo:checked').length > 0) {
        $('.image-logo').hide();
        $('.html-logo').show();
    } else {
        $('.image-logo').show();
        $('.html-logo').hide();    
    }

}); // End window.load