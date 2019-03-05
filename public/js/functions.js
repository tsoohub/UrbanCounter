jQuery(document).ready(function($) {
    $(".faqlist li a").click(function(event) {
        event.preventDefault();

        var defaultAnchorOffset = 0;

        var anchor = $(this).attr('data-scrollto');

        var anchorOffset = $('#'+anchor).attr('data-scroll-offset');
        if (!anchorOffset)
            anchorOffset = defaultAnchorOffset;

        $('html,body').animate({
            scrollTop: $('#'+anchor).offset().top - anchorOffset
        }, 1000);
    });

});