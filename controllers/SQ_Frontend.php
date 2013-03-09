<?php
class SQ_Frontend extends SQ_FrontController {
        public static $options;
 
        function __construct() {
            parent::__construct();
            
            SQ_ObjController::getController('SQ_Tools', false);
            self::$options = SQ_Tools::getOptions();
            
        }

        function hookLoaded(){
            if ( isset(self::$options['sq_use']) && (int)self::$options['sq_use'] == 1 ){
               $this->model->startBuffer(); 
            }
        }
        function action(){}
        
        /** 
         * Hook the Header load
         */
        public function hookFronthead(){
            parent::hookHead();
            
            if ( isset(self::$options['sq_use']) && (int)self::$options['sq_use'] == 1 ){
                echo $this->model->setHeader();
                $this->model->flushHeader();
            }
            
	}
        
        function hookFrontfooter(){
            if ( isset(self::$options['sq_use']) && (int)self::$options['sq_use'] == 1 ){
                $this->model->flushHeader();
            }
        }
}

?>