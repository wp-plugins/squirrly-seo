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

})(jQuery);

jQuery(document).ready(function($) {
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
        $(selected_tab).fadeIn();
        $._setCookie('abh_tab', selected_tab);

        //At the end, we add return false so that the click on the link is not executed
        return false;
    });

    //Show the saved cookie tab content
    if ($._getCookie('abh_tab') != null) {
        $(".abh_tab").hide();
        $("#abh_tabs li").removeClass('abh_active');

        //Get the tab from cookie
        var selected_tab = $._getCookie('abh_tab');
        $(selected_tab).fadeIn();
        $(selected_tab).parents('#abh_box').find(selected_tab.replace('#', '.')).addClass("abh_active");
    }

});
