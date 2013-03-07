<?php
class SQ_Frontend extends SQ_FrontController {
        public static $options;
 
        function __construct() {
            parent::__construct();
            
            
            SQ_ObjController::getController('SQ_Tools', false);
            self::$options = SQ_Tools::getOptions();
            
           // add_filter( 'wp_title', array( $this->model, 'getCustomTitle' ), 5 );
           // add_filter( 'thematic_doctitle', array( $this->model, 'getCustomTitle' ) );
        }
        
        function action(){}
        
        /** 
         * Hook the Header load
         */
        public function hookFronthead(){
            parent::hookHead();
            if ( isset(self::$options['sq_use']) && (int)self::$options['sq_use'] == 1 ){
                echo $this->model->setHeader();
            }
           
            
	}
        
   
}

?>