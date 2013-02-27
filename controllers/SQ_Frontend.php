<?php
class SQ_Frontend extends SQ_FrontController {
        public static $options;
 
        function __construct() {
            parent::__construct();
            
            /* Load Tools */
            SQ_ObjController::getController('SQ_Tools', false);
            self::$options = SQ_Tools::getOptions();
            
            /* if autosettings is activated get the header */
            if ( isset(self::$options['sq_use']) && (int)self::$options['sq_use'] == 1 ){
                if(function_exists('ob_start')){
                    ob_start(array($this->model,'setHeader'));
                }
                
            }
        }
        
        function action(){}
        
        /** 
         * Hook the Header load
         */
        public function hookFronthead(){
            parent::hookHead();
            
            if ( isset(self::$options['sq_use']) && (int)self::$options['sq_use'] == 1 ){
                $this->model->flushHeader();
            }
           
            
	}
        
   
}

?>