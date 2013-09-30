(function($) {

    /**
     * Get the Cookie value
     *
     * @param nombre string cookie name
     * @return string cookie value
     */
    $._getCookie = function(nombre) {
        var dcookie = document.cookie;
        var cname = nombre + "=";
        var longitud = dcookie.length;
        var inicio = 0;

        while (inicio < longitud)
        {
            var vbegin = inicio + cname.length;
            if (dcookie.substring(inicio, vbegin) == cname)
            {
                var vend = dcookie.indexOf(";", vbegin);
                if (vend == -1)
                    vend = longitud;
                return unescape(dcookie.substring(vbegin, vend));
            }
            inicio = dcookie.indexOf(" ", inicio) + 1;
            if (inicio == 0)
                break;
        }
        return null;
    };
    /**
     * Set the Cookie
     *
     * @param name string cookie name
     * @param value string cookie value
     * @return void
     */
    $._setCookie = function(name, value) {
        document.cookie = name + "=" + value + "; expires=" + (60 * 24) + "; path=/";
    };


    $.abh_showDiv = function(selected_tab) {
        if (typeof selected_tab !== 'undefined') {
            $(selected_tab).fadeIn();
            $(selected_tab).parents('#abh_box').find(selected_tab.replace('#', '.')).addClass("abh_active");
        }
    };

    $.abh_showContent = function(obj) {
        obj.find("#abh_tabs").show();
        obj.find(".abh_job").show();
        obj.find(".abh_allposts").show();
        obj.find(".abh_social").show();

        obj.find("#abh_tab_content").css('border-bottom-width', '1px');
        obj.find("#abh_tab_content h3").css('border-bottom-width', '0px');
        obj.find("#abh_tab_content h4").css('border-bottom-width', '0px');
        obj.find(".abh_description").slideDown('fast');

        obj.find(".abh_arrow").addClass('abh_active');
    };

    $.abh_hideContent = function(obj) {
        obj.find(".abh_description").slideUp('fast', function() {
            obj.find("#abh_tabs").hide();
            obj.find(".abh_job").hide();
            obj.find(".abh_allposts").hide();
            obj.find(".abh_social").hide();
            obj.find("#abh_tab_content").css('border-bottom-width', '0px');
            obj.find("#abh_tab_content h3").css('border-bottom-width', '1px');
            obj.find("#abh_tab_content h4").css('border-bottom-width', '1px');
            obj.find(".abh_arrow").removeClass('abh_active');
        });
    };

})(jQuery);

jQuery(document).ready(function($) {

    $("#abh_tab_content .abh_image img, #abh_tab_content h4, #abh_tab_content h3").bind('click', function(event) {
        event.preventDefault();
        if ($(this).parents('#abh_box').find("#abh_tabs").is(':visible')) {
            $.abh_hideContent($(this).parents('#abh_box'));
        } else {
            $.abh_showContent($(this).parents('#abh_box'));
        }
    });

    // On tab click
    $("#abh_tabs li").click(function() {
        //First remove class "active" from currently active tab
        $("#abh_tabs li").removeClass('abh_active');

        //Now add class "active" to the selected/clicked tab
        $(this).addClass("abh_active");

        //Hide all tab content
        $(".abh_tab").hide();

        //Here we get the href value of the selected tab
        var selected_tab = $(this).find("a").attr("href");

        //Show the selected tab content
        $.abh_showDiv(selected_tab);
        $._setCookie('abh_tab', selected_tab);

        //At the end, we add return false so that the click on the link is not executed
        return false;
    });

    $(".abh_content").find("h3").append('<span class="abh_arrow"></span>');
});

