<?php
class SQ_Blockseo extends SQ_BlockController {
    function action(){}
    
    function hookHead() {
       parent::hookHead();
        echo '<script type="text/javascript">
             var __snippetname = "'.__('Squirrly Snippet', _PLUGIN_NAME_).'"; 
             var __snippetrefresh = "'.__('Refresh', _PLUGIN_NAME_).'"; 
           </script>';
   }
}

?>