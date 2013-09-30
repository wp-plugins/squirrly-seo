jQuery(document).ready(function($) {

    $(".abh_content").mouseenter(function() {
        $(this).find(".abh_social").stop().fadeIn('slow');
    }).mouseleave(function() {
        $(this).find(".abh_social").stop().fadeOut('fast');
    });

});

