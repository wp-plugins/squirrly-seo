<?php

/**
 * Core class for SQ_Blocksearch
 */
class SQ_Blocksearch extends SQ_BlockController {
  
   function action(){
      $start = 0;
      $nbr = 8;
      $exclude = array();
      
      parent::action();
      switch (SQ_Tools::getValue('action')){
            case 'sq_type_click':
                SQ_Tools::saveOptions('sq_img_licence', SQ_Tools::getValue('licence'));
                exit();
                break;
            case 'sq_search_img':
                
                $get = array('q' => SQ_Tools::getValue('q'),
                              'lang' => SQ_Tools::getValue('lang'),
                              'start' => SQ_Tools::getValue('start'),
                              'page' => SQ_Tools::getValue('page'),
                              'nrb' => SQ_Tools::getValue('nrb')
                    );
                echo $this->model->searchImage($get);
                break;
            case 'sq_search_blog':
                if (SQ_Tools::getValue('exclude') && SQ_Tools::getValue('exclude') <> 'undefined') 
                    $exclude = array((int)SQ_Tools::getValue('exclude'));

                if (SQ_Tools::getValue('start')) 
                   $start = array((int)SQ_Tools::getValue('start'));

                if (SQ_Tools::getValue('nrb')) 
                   $nrb = array((int)SQ_Tools::getValue('nrb'));

                if (SQ_Tools::getValue('q') <> '')
                  echo SQ_ObjController::getController('SQ_Post')->model->searchPost(SQ_Tools::getValue('q'), $exclude, (int)$start, (int)$nrb);
            break;
      }
      
      exit();
   }
   
   function hookHead() {
       parent::hookHead();
        echo '<script type="text/javascript">
             __date = "'.__('date', _PLUGIN_NAME_).'"; __readit = "'.__('Read it!', _PLUGIN_NAME_).'"; __insertit = "'.__('Insert it!', _PLUGIN_NAME_).'"; __reference = "'.__('Reference', _PLUGIN_NAME_).'"; __insertasbox = "'.__('Insert as box', _PLUGIN_NAME_).'"; __notrelevant = "'.__('Not relevant?', _PLUGIN_NAME_).'"; __insertparagraph = "'.__('Insert in your article', _PLUGIN_NAME_).'"; __tinymceerror = "'.__('For Squirrly to work, you have to have tinymce editor installed!', _PLUGIN_NAME_).'"; __ajaxerror = "'.__(':( I lost my squirrel. Please reload the page.', _PLUGIN_NAME_).'"; __nofound = "'.__('No results found!', _PLUGIN_NAME_).'"; __tinymceinactive = "'.__('Switch to Visual editor!', _PLUGIN_NAME_).'"; __morewords = "'.__('Use more words in one keyword',_PLUGIN_NAME_).'"; __toolong = "'.__('Takes too long to check this keyword ...',_PLUGIN_NAME_).'"; __doresearch = "'.__('Do a research!',_PLUGIN_NAME_).'"; __morekeywords = "'.__('Do more research!',_PLUGIN_NAME_).'";
           </script>';
   }
}

?>