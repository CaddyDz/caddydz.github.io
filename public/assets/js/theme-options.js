$(document).ready(function() {
    /* Single Article - Load more comments */
    $('.load-more').click(function() {
        $(this).hide();
        $('.hidden-comment').fadeIn(400);
    });
    
}); // End document.ready
