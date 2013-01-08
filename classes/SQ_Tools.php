<?php

/**
 * Handles the parameters and url
 *
 * @author Squirrly
 */
class SQ_Tools extends SQ_FrontController {
    /** @var options Array of options from database */
    public static $options = array();
    public $flash_data = null;
    public $showNote = array();
    static $errors_count = 0;
    
    function __construct() {
        parent::__construct();
        
        self::$options = $this->getOptions();
    }
    
    /**
    * This hook will save the current version in database and load the messages from usermeta
    *
    * @return void
    */
    function hookInit(){
        global $sq_showNote;
        
        //TinyMCE editor required
        set_user_setting('editor', 'tinymce');
        
        $this->showNote = $sq_showNote;
        $this->loadMultilanguage();
        $this->checkPluginUpdated();
        $this->load_flashdata();
    }
    
    /**
    * This hook will output the message to WP header
    *
    * @return void
    */
    function hookNotices(){
        global $pagenow;
        
        $message = $this->flashdata('plugin_update_notice');

        if($message) 
        {
            // keep update message on update and plugins page because they do many redirects, 
            // so we never know whether user seen the message or not
            if($pagenow == 'update.php' || ($pagenow == 'plugins.php' && isset($_GET['action'])))
                    $this->keep_flashdata('plugin_update_notice');

            echo $this->showNotices($message);
        }
    }
    
    /**
    * This hook will save the new# sign notices in the usermeta table in database
    *
    * @return void
    */
    function hookShutdown(){
         global $user_ID;
        $new_data = array();
        
        if(is_array($this->flash_data)) {
            foreach($this->flash_data as $k => $v) {
                    if(substr($k, 0, 4) == 'new#')
                           $new_data['old#' . substr($k, 4)] = $v;
            }

            update_user_option($user_ID, SQ_META, $new_data, false);
        }

        return;
    }
    
    /**
    * Load the Options from user option table in DB
    *
    * @return void
    */
    public static function getOptions(){
        $options = json_decode(get_option(SQ_OPTION),true);
        
        if (is_array($options))
            return $options;
       
        return false;
    }
    
    /**
    * Save the Options in user option table in DB
    *
    * @return void
    */
    public static function saveOptions($key, $value){
        self::$options[$key] = $value;
        update_option(SQ_OPTION, json_encode(self::$options));
    }
    
    /**
    * Get a value from $_POST / $_GET
    * if unavailable, take a default value
    *
    * @param string $key Value key
    * @param mixed $defaultValue (optional)
    * @return mixed Value
    */
    public static function getValue($key, $defaultValue = false){
        if (!isset($key) OR empty($key) OR !is_string($key))
                return false;
        $ret = (isset($_POST[$key]) ? $_POST[$key] : (isset($_GET[$key]) ? $_GET[$key] : $defaultValue));

        if (is_string($ret) === true)
                $ret = urldecode(preg_replace('/((\%5C0+)|(\%00+))/i', '', urlencode($ret)));
        return !is_string($ret)? $ret : stripslashes($ret);
    }

    public static function getIsset($key){
        if (!isset($key) OR empty($key) OR !is_string($key))
                return false;
        return isset($_POST[$key]) ? true : (isset($_GET[$key]) ? true : false);
    }

    /**
    * Show the notices to WP 
    *
    * @return void
    */
    public static function showNotices($message, $type = 'sq_notices'){
        if (file_exists(_SQ_THEME_DIR_.'SQ_notices.php')){
            ob_start();
                include (_SQ_THEME_DIR_.'SQ_notices.php');
            $message = ob_get_contents();
            ob_end_clean();
        }
        
        return $message;
    }
    
    private function loadMultilanguage(){
        if ( !defined('WP_PLUGIN_DIR') ) {
                load_plugin_textdomain( _PLUGIN_NAME_, _PLUGIN_NAME_ . '/languages/' ); 
	} else {
		load_plugin_textdomain( _PLUGIN_NAME_, null, _PLUGIN_NAME_ . '/languages/' ); 
               
	}
        
    }
    
    /**
    * checkPluginUpdated
    *
    * Checks whether plugin update happened and triggers update notice
    *	
    */
    private function checkPluginUpdated(){
        $saved_version = self::$options['version'];

        // setup current version for new plugin installations
        if(!$saved_version && !self::$options['apiID']) {
            $this->saveOptions('version', SQ_VERSION);
        }

        // it'll trigger only if different version of plugin was installed before
        if(!$saved_version || version_compare($saved_version, SQ_VERSION, '!='))
        {
            // save new version string to database to avoid event doubling
            $this->saveOptions('version', SQ_VERSION);

            // setup flashdata so admin_notices hook could pick it up next time it will be displayed
            if(isset($this->showNote[SQ_VERSION])){
                $this->set_flashdata('plugin_update_notice', $this->showNote[SQ_VERSION]);

            }
        }
    }
    
    /**
    * Check for SEO blog bad settings
    */
    public static function checkErrorSettings($count_only = false) {
        
        
        if ( function_exists( 'is_network_admin' ) && is_network_admin() )
                return;

        if ( isset( self::$options['ignore_warn'] ) && self::$options[ 'ignore_warn' ] == 1 )
                return;
        
        $fixit = "<a href=\"javascript:void(0);\"  onclick=\"%s jQuery(this).closest('div').fadeOut('slow'); if(parseInt(jQuery('.sq_count').html())>0) { var notif = (parseInt(jQuery('.sq_count').html()) - 1); if (notif > 0) {jQuery('.sq_count').html(notif); }else{ jQuery('.sq_count').hide(); } } jQuery.post(ajaxurl, { action: '%s', nonce: '".wp_create_nonce( 'sq_none' )."'});\" >" . __( "Fix it for me!", _PLUGIN_NAME_ ) . "</a>";
        
        /* IF SEO INDEX IS OFF*/
        if ( self::getAutoSeoSquirrly() ){
            if ($count_only)
                self::$errors_count ++;
            else SQ_Error::setError(__('Let Squirrly optimize your SEO automatically (recommended)', _PLUGIN_NAME_) . " <br />" . sprintf( $fixit, "jQuery('#sq_use_on').attr('checked', true);", "sq_fixautoseo") . " | ", 'settings');
        }
        
        /* IF SEO INDEX IS OFF*/
        if ( self::getPrivateBlog() ){
            if ($count_only)
                self::$errors_count ++;
            else SQ_Error::setError(__('You\'re blocking google from indexing your site!', _PLUGIN_NAME_) . " <br />" . sprintf( $fixit, "", "sq_fixprivate") . " | ", 'settings');
        }
        
        if ( self::getBadLinkStructure() ){
            if ($count_only)
                self::$errors_count ++;
            else SQ_Error::setError(__('It is highly recommended that you include the %postname% variable in the permalink structure.', _PLUGIN_NAME_)  . " <br />" . sprintf( $fixit, "","sq_fixpermalink"). " | ", 'settings');
        }
        
       /* if ( !self::getCommentsNotification() ){
            if ($count_only)
                self::$errors_count ++;
            else SQ_Error::setError(__('It is highly recommended that you set to receive notifications for new comments.', _PLUGIN_NAME_)  . " <br />" . sprintf( $fixit, "","sq_fixcomments"). " | ", 'settings');
        }*/
    }
    
    /**
     * Check if the blog is in private mode
     * @return bool
     */
    private static function getAutoSeoSquirrly() {
        if(isset(self::$options['sq_use']))
            return ((int)self::$options['sq_use'] == 0 );
        
        return true;
    }
    
    /**
     * Check if the blog is in private mode
     * @return bool
     */
    private static function getPrivateBlog() {
        return ((int)get_option( 'blog_public' ) == 0 );
    }
    
    /**
     * Check if the blog comments is in private mode
     * @return bool
     */
    private static function getCommentsNotification() {
        return ((int)get_option( 'comments_notify' ) == 1 );
    }
    
    /**
     * Check if the blog has a bad link structure
     * @return bool
     */
    private static function getBadLinkStructure() {
        $link = get_option('permalink_structure');
        if ($link == '' || strpos($link, '%postname%') === false)
            return true;
    }
    
    /**
    * Get flashdata by key and wipes it immidiately
    *	
    * @return void
    */
    protected function flashdata($key) {
        if(isset($this->flash_data['new#' . $key]))
            return $this->flash_data['new#' . $key];
        else if(isset($this->flash_data['old#' . $key]))
            return $this->flash_data['old#' . $key];

        return null;
    }

    /**
    * Load flashdata that used to be available once and then wiped
    *	
    * @return void
     */
    private function load_flashdata() {
        global $user_ID;

        if (is_array($this->flash_data))
            $this->flash_data = array_merge ($this->flash_data,get_user_option('sq_plugin_flash', $user_ID));
        else
            $this->flash_data = get_user_option(SQ_META, $user_ID);
       
        if(!is_array($this->flash_data))
                $this->flash_data = array();

        return;
    }
   
    
    /**
    * Keep flashdata key till next time
    *	
    * @return void
     */
    private function keep_flashdata($key) {
        $val = $this->flashdata($key);

        if(!is_null($val))
                $this->flash_data['new#' . $key] = $val;
        
        return;
    }

    /**
    * Set flashdata value by key, pass null value to unset flashdata
    *	
    * @return void
     */
    private function set_flashdata($key, $value) {
        if(is_null($value)) {
            if(isset($this->flash_data['new#' . $key]))
                    unset($this->flash_data['new#' . $key]);
            if(isset($this->flash_data['old#' . $key]))
                    unset($this->flash_data['old#' . $key]);

            return;
        }

        $this->flash_data['new#' . $key] = $value;
        
        return;
    }
    
    
    /**
    * Support for i18n with wpml, polyglot or qtrans
    * 
    * @param string $in
    * @return string $in localized
    */
    public static function i18n($in) {
        if (function_exists('langswitch_filter_langs_with_message')) {
            $in = langswitch_filter_langs_with_message($in);
        }
        if (function_exists('polyglot_filter')) {
            $in = polyglot_filter($in);
        }
        if (function_exists('qtrans_useCurrentLanguageIfNotFoundUseDefaultLanguage')) {
            $in = qtrans_useCurrentLanguageIfNotFoundUseDefaultLanguage($in);
        }
        $in = apply_filters('localization', $in);
        return $in;
    }
    
    /**
     * Convert integer on the locale format.
     *
     * @param int $number The number to convert based on locale.
     * @param int $decimals Precision of the number of decimal places.
     * @return string Converted number in string format.
     */
    public static function i18n_number_format( $number, $decimals = 0 ) {
            global $wp_locale;
            $formatted = number_format( $number, absint( $decimals ), $wp_locale->number_format['decimal_point'], $wp_locale->number_format['thousands_sep'] );
            return apply_filters( 'number_format_i18n', $formatted );
    }    
    
    
    public static function getBrowserInfo(){
        $u_agent = $_SERVER['HTTP_USER_AGENT'];
        $bname = 'Unknown';
        $platform = 'Unknown';
        $version= "";
        if (!function_exists('preg_match'))
            return false;
        
        //First get the platform?
        if (preg_match('/linux/i', $u_agent)) {
            $platform = 'linux';
        }
        elseif (preg_match('/macintosh|mac os x/i', $u_agent)) {
            $platform = 'mac';
        }
        elseif (preg_match('/windows|win32/i', $u_agent)) {
            $platform = 'windows';
        }

        // Next get the name of the useragent yes seperately and for good reason
        if(preg_match('/MSIE/i',$u_agent) && !preg_match('/Opera/i',$u_agent))
        {
            $bname = 'IE';
            $ub = "MSIE";
        }
        elseif(preg_match('/Firefox/i',$u_agent))
        {
            $bname = 'Mozilla Firefox';
            $ub = "Firefox";
        }
        elseif(preg_match('/Chrome/i',$u_agent))
        {
            $bname = 'Google Chrome';
            $ub = "Chrome";
        }
        elseif(preg_match('/Safari/i',$u_agent))
        {
            $bname = 'Apple Safari';
            $ub = "Safari";
        }
        elseif(preg_match('/Opera/i',$u_agent))
        {
            $bname = 'Opera';
            $ub = "Opera";
        }
        elseif(preg_match('/Netscape/i',$u_agent))
        {
            $bname = 'Netscape';
            $ub = "Netscape";
        }

        // finally get the correct version number
        $known = array('Version', $ub, 'other');
        $pattern = '#(?' . join('|', $known) .')[/ ]+(?[0-9.|a-zA-Z.]*)#';
       
        if (strpos($u_agent, 'MSIE 7.0;') !== false){
                $version = 7.0;
        }
        
        if ($version==null || $version=="") {
            $version="0";
        }     
        
        return array(         
            'userAgent' => $u_agent,
            'name'      => $bname,
            'version'   => $version,
            'platform'  => $platform,
            'pattern'    => $pattern
        );
    }
}

?>
