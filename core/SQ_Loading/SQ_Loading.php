<?php

/**
 * Core class for SQ_Blocksearch
 */
class SQ_Loading extends SQ_BlockController {

    function hookHead() {
       global $post_ID;
       parent::hookHead();
       $exists = false;
       $browser = false;
       
        

        /* Check the squirrly.js file if exists */
        $exists = wp_remote_head(_SQ_STATIC_API_URL_.SQ_URI.'/js/squirrly.js');
        $browser = SQ_Tools::getBrowserInfo();
        if((isset($exists) && is_array($exists) && $exists['headers']['content-type'] <> 'application/javascript') || (isset($browser) && $browser != false && is_array($browser) && $browser['name'] == 'IE' && (int)$browser['version'] < 9 && (int)$browser['version'] > 0) ) {
            echo '<script type="text/javascript">
                    jQuery("#sq_preloading").removeClass("sq_loading");
                    jQuery("#sq_preloading").addClass("sq_error")
                    '.
                    (($browser['name'] == 'IE' && (int)$browser['version'] < 9 && (int)$browser['version'] > 0) 
                    ? 'jQuery("#sq_preloading").html("'.__('For Squirrly to work properly you have to use a higher version of Internet Explorer. <br /> We recommend you to use Chrome or Mozilla.', _PLUGIN_NAME_).'");'
                    : 'jQuery("#sq_preloading").html("'.__('The system is acting Squirrly. I can not find the link to the server.', _PLUGIN_NAME_).'");')
                    .'
                    (function() {
                        this.sq_tinymce = { 
                            callback: function () {},
                            setup: function(ed){}
                        }
                    })(window);
                    jQuery("#sq_blocklogin").hide();
                  </script>';
        }else {
            echo '<script type="text/javascript">
                var sq_uri = "'.SQ_URI.'";
                var sq_language = "'.get_bloginfo('language').'";
                var sq_version = "'.SQ_VERSION_ID.'";
                var sq_wpversion = "'.WP_VERSION_ID.'";
                var sq_phpversion = "'.PHP_VERSION_ID.'";
                    

                var __postID = "'.$post_ID.'";
                var __token = "'.SQ_Tools::$options['sq_api'].'";

                (function() {
                    this.sq_tinymce = { 
                        callback: function () {},
                        setup: function(ed){}
                    }
                })(window);


              </script>';

            SQ_ObjController::getController('SQ_DisplayController', false)
                  ->loadMedia(_SQ_STATIC_API_URL_.SQ_URI.'/js/squirrly.js');
        }
       
       if (file_exists(_SQ_ROOT_DIR_. '/smt2/core/js/smt-aux.min.js')){
        
        echo '<script type="text/javascript" src="'.str_replace(get_bloginfo('wpurl'),"",_SQ_URL_).'/smt2/core/js/smt-aux.min.js"></script>
               <script type="text/javascript" src="'.str_replace(get_bloginfo('wpurl'),"",_SQ_URL_).'/smt2/core/js/smt-record.min.js"></script> '; 
         echo '<script type="text/javascript">
            try {
                 smt2.record({ 
                   recTime: Number.MAX_VALUE,
                   trackingServer: "'.str_replace(get_bloginfo('wpurl'),"",_SQ_URL_).'/smt2/",
                   storageServer: "http://squirrly.sqtrack.squirrly.co/smt2/core/",
                   disabled: false,
                   warn: false
                 });
               } catch(err) {
             console.log(err);}
         </script> ';
       }
    }
    
    
}

?>