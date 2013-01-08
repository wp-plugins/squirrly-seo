<?php

/**
 * Core class for SQ_Blocksearch
 */
class SQ_Blockresearch extends SQ_BlockController {
    function hookHead() {
       parent::hookHead();
       
       
       echo '<script type="text/javascript">
                var __infotext = ["'.__('Talk about it:',_PLUGIN_NAME_).'", "'.__('Search it:',_PLUGIN_NAME_).'", "'.__('Competition:',_PLUGIN_NAME_).'", "'.__('Trend:',_PLUGIN_NAME_).'"];
              </script>';
    }
}

?>