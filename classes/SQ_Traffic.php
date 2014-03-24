<?php

/**
 * Class for Traffic Record
 */
class SQ_Traffic extends SQ_FrontController {

    public function getTrafficScript($code) {
        return '    <script type="text/javascript">
    var _paq = _paq || [];
    _paq.push(["trackPageView"]);
    _paq.push(["enableLinkTracking"]);

    (function() {
      var u= (("https:" == document.location.protocol) ? "https" : "http") + "://analytics.squirrly.co/";
      _paq.push(["setTrackerUrl", u+"track.php"]);
      _paq.push(["setSiteId", "' . $code . '"]);
      var d=document, g=d.createElement("script"), s=d.getElementsByTagName("script")[0]; g.type="text/javascript";
      g.defer=true; g.async=true; g.src=u+"track.js"; s.parentNode.insertBefore(g,s);
    })();
  </script>
  <noscript><img src="http://analytics.squirrly.co/track.php?idsite=' . $code . '&amp;rec=1" style="border:0" alt="" /></noscript>
';
    }

}

?>
