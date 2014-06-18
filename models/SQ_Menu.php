<?php

class Model_SQ_Menu {

    /** @var array with the menu content
     *
     * $page_title (string) (required) The text to be displayed in the title tags of the page when the menu is selected
     * $menu_title (string) (required) The on-screen name text for the menu
     * $capability (string) (required) The capability required for this menu to be displayed to the user. User levels are deprecated and should not be used here!
     * $menu_slug (string) (required) The slug name to refer to this menu by (should be unique for this menu). Prior to Version 3.0 this was called the file (or handle) parameter. If the function parameter is omitted, the menu_slug should be the PHP file that handles the display of the menu page content.
     * $function The function that displays the page content for the menu page. Technically, the function parameter is optional, but if it is not supplied, then WordPress will basically assume that including the PHP file will generate the administration screen, without calling a function. Most plugin authors choose to put the page-generating code in a function within their main plugin file.:In the event that the function parameter is specified, it is possible to use any string for the file parameter. This allows usage of pages such as ?page=my_super_plugin_page instead of ?page=my-super-plugin/admin-options.php.
     * $icon_url (string) (optional) The url to the icon to be used for this menu. This parameter is optional. Icons should be fairly small, around 16 x 16 pixels for best results. You can use the plugin_dir_url( __FILE__ ) function to get the URL of your plugin directory and then add the image filename to it. You can set $icon_url to "div" to have wordpress generate <br> tag instead of <img>. This can be used for more advanced formating via CSS, such as changing icon on hover.
     * $position (integer) (optional) The position in the menu order this menu should appear. By default, if this parameter is omitted, the menu will appear at the bottom of the menu structure. The higher the number, the lower its position in the menu. WARNING: if 2 menu items use the same position attribute, one of the items may be overwritten so that only one item displays!
     *
     * */
    public $menu = array();

    /** @var array with the menu content
     * $id (string) (required) HTML 'id' attribute of the edit screen section
     * $title (string) (required) Title of the edit screen section, visible to user
     * $callback (callback) (required) Function that prints out the HTML for the edit screen section. Pass function name as a string. Within a class, you can instead pass an array to call one of the class's methods. See the second example under Example below.
     * $post_type (string) (required) The type of Write screen on which to show the edit screen section ('post', 'page', 'link', or 'custom_post_type' where custom_post_type is the custom post type slug)
     * $context (string) (optional) The part of the page where the edit screen section should be shown ('normal', 'advanced', or 'side'). (Note that 'side' doesn't exist before 2.7)
     * $priority (string) (optional) The priority within the context where the boxes should show ('high', 'core', 'default' or 'low')
     * $callback_args (array) (optional) Arguments to pass into your callback function. The callback will receive the $post object and whatever parameters are passed through this variable.
     *
     * */
    public $meta = array();

    public function __construct() {

    }

    /**
     * Add a menu in WP admin page
     *
     * @param array $param
     *
     * @return void
     */
    public function addMenu($param = null) {
        if ($param)
            $this->menu = $param;

        if (is_array($this->menu)) {

            if ($this->menu[0] <> '' && $this->menu[1] <> '') {
                /* add the translation */
                $this->menu[0] = __($this->menu[0], _SQ_PLUGIN_NAME_);
                $this->menu[1] = __($this->menu[1], _SQ_PLUGIN_NAME_);

                if (!isset($this->menu[5]))
                    $this->menu[5] = null;
                if (!isset($this->menu[6]))
                    $this->menu[6] = null;
                if (!isset($this->menu[7]))
                    $this->menu[7] = null;

                /* add the menu with WP */
                add_menu_page($this->menu[0], $this->menu[1], $this->menu[2], $this->menu[3], $this->menu[4], $this->menu[5], $this->menu[6], $this->menu[7]);
            }
        }
    }

    /**
     * Add a submenumenu in WP admin page
     *
     * @param array $param
     *
     * @return void
     */
    public function addSubmenu($param = null) {
        if ($param)
            $this->menu = $param;

        if (is_array($this->menu)) {

            if ($this->menu[0] <> '' && $this->menu[1] <> '') {
                /* add the translation */
                $this->menu[0] = __($this->menu[0], _SQ_PLUGIN_NAME_);
                $this->menu[1] = __($this->menu[1], _SQ_PLUGIN_NAME_);

                if (!isset($this->menu[5]))
                    $this->menu[5] = null;
                if (!isset($this->menu[6]))
                    $this->menu[6] = null;
                if (!isset($this->menu[7]))
                    $this->menu[7] = null;

                /* add the menu with WP */
                add_submenu_page($this->menu[0], $this->menu[1], $this->menu[2], $this->menu[3], $this->menu[4], $this->menu[5], $this->menu[6], $this->menu[7]);
            }
        }
    }

    /**
     * Add a box Meta in WP
     *
     * @param array $param
     *
     * @return void
     */
    public function addMeta($param = null) {
        if ($param)
            $this->meta = $param;


        if (is_array($this->meta)) {

            if ($this->meta[0] <> '' && $this->meta[1] <> '') {
                /* add the translation */
                $this->meta[1] = __($this->meta[1], _SQ_PLUGIN_NAME_);

                if (!isset($this->meta[5]))
                    $this->meta[5] = null;
                if (!isset($this->meta[6]))
                    $this->meta[6] = null;
                /* add the box content with WP */
                add_meta_box($this->meta[0], $this->meta[1], $this->meta[2], $this->meta[3], $this->meta[4], $this->meta[5]);
                //add_meta_box('post'._SQ_PLUGIN_NAME_, __(ucfirst(_SQ_PLUGIN_NAME_),_SQ_PLUGIN_NAME_), array($this, 'showMenu'), 'post', 'side', 'high');
            }
        }
    }

    /**
     * Check the google code saved at settings
     *
     * @return string
     */
    public function checkGoogleWTCode($code) {
        if ($code <> '') {
            if (strpos($code, 'content') !== false) {
                preg_match('/content\\s*=\\s*[\'\"]([^\'\"]+)[\'\"]/i', $code, $result);
                if (isset($result[1]) && !empty($result[1]))
                    $code = $result[1];
            }

            if (strpos($code, '"') !== false) {
                preg_match('/[\'\"]([^\'\"]+)[\'\"]/i', $code, $result);
                if (isset($result[1]) && !empty($result[1]))
                    $code = $result[1];
            }

            if ($code == '')
                SQ_Error::setError(__("The code for Google Webmaster Tool is incorrect.", _SQ_PLUGIN_NAME_));
        }
        return $code;
    }

    /**
     * Check the google code saved at settings
     *
     * @return string
     */
    public function checkGoogleAnalyticsCode($code) {
        //echo $code;
        if ($code <> '') {
            if (strpos($code, '_gaq.push') !== false) {
                preg_match('/_gaq.push\(\[[\'\"]_setAccount[\'\"],\\s?[\'\"]([^\'\"]+)[\'\"]\]\)/i', $code, $result);
                if (isset($result[1]) && !empty($result[1]))
                    $code = $result[1];
            }

            if (strpos($code, '"') !== false) {
                preg_match('/[\'\"]([^\'\"]+)[\'\"]/i', $code, $result);
                if (isset($result[1]) && !empty($result[1]))
                    $code = $result[1];
            }

            if (strpos($code, 'UA-') === false) {
                $code = '';
                SQ_Error::setError(__("The code for Google Analytics is incorrect.", _SQ_PLUGIN_NAME_));
            }
        }
        return $code;
    }

    /**
     * Check the Facebook code saved at settings
     *
     * @return string
     */
    public function checkFavebookInsightsCode($code) {
        if ($code <> '') {
            if (strpos($code, 'content') !== false) {
                preg_match('/content\\s*=\\s*[\'\"]([^\'\"]+)[\'\"]/i', $code, $result);
                if (isset($result[1]) && !empty($result[1]))
                    $code = $result[1];
            }

            if (strpos($code, '"') !== false) {
                preg_match('/[\'\"]([^\'\"]+)[\'\"]/i', $code, $result);
                if (isset($result[1]) && !empty($result[1]))
                    $code = $result[1];
            }

            if ($code == '')
                SQ_Error::setError(__("The code for Facebook is incorrect.", _SQ_PLUGIN_NAME_));
        }
        return $code;
    }

    /**
     * Check the Bing code saved at settings
     *
     * @return string
     */
    public function checkBingWTCode($code) {
        if ($code <> '') {
            if (strpos($code, 'content') !== false) {
                preg_match('/content\\s*=\\s*[\'\"]([^\'\"]+)[\'\"]/i', $code, $result);
                if (isset($result[1]) && !empty($result[1]))
                    $code = $result[1];
            }

            if (strpos($code, '"') !== false) {
                preg_match('/[\'\"]([^\'\"]+)[\'\"]/i', $code, $result);
                if (isset($result[1]) && !empty($result[1]))
                    $code = $result[1];
            }

            if ($code == '')
                SQ_Error::setError(__("The code for Bing is incorrect.", _SQ_PLUGIN_NAME_));
        }
        return $code;
    }

    /**
     * Add the image to the root path
     *
     * @param string $file
     * @param string $path
     * @return array [name (the name of the file), favicon (the path of the ico), message (the returned message)]
     *
     */
    public function addFavicon($file, $path = ABSPATH) {

        $out = array();
        $out['name'] = strtolower(basename($file['name']));
        $out['tmp'] = _SQ_CACHE_DIR_ . strtolower(basename($file['name']));
        $out['favicon'] = $path . "/" . 'favicon.ico';
        $file_err = $file['error'];

        /* get the file extension */
        $file_name = explode('.', $file['name']);
        $file_type = strtolower($file_name[count($file_name) - 1]);

        /* if the file has a name */
        if (!empty($file['name'])) {
            /* Check the extension */
            $file_type = strtolower($file_type);
            $files = array('ico', 'jpeg', 'jpg', 'gif', 'png');
            $key = in_array($file_type, $files);

            if (!$key) {
                SQ_Error::setError(__("File type error: Only ICO, JPEG, JPG, GIF or PNG files are allowed.", _SQ_PLUGIN_NAME_));
                return;
            }

            /* Check for error messages */
            if (!$this->checkFunctions()) {
                SQ_Error::setError(__("GD error: The GD library must be installed on your server.", _SQ_PLUGIN_NAME_));
                return;
            } else {
                /* Delete the previous file if exists */
                if (is_file($out['tmp'])) {
                    if (!unlink($out['tmp'])) {
                        SQ_Error::setError(__("Delete error: Could not delete the old favicon.", _SQ_PLUGIN_NAME_));
                        return;
                    }
                }

                /* Upload the file */
                if (!move_uploaded_file($file['tmp_name'], $out['tmp'])) {
                    SQ_Error::setError(__("Upload error: Could not upload the favicon.", _SQ_PLUGIN_NAME_));
                    return;
                }

                /* Change the permision */
                if (!chmod($out['tmp'], 0755)) {
                    SQ_Error::setError(__("Permission error: Could not change the favicon permissions.", _SQ_PLUGIN_NAME_));
                    return;
                }

                if ($file_type <> 'ico') {
                    /* Transform the image into icon */

                    switch ($file_type) {
                        case "jpeg":
                        case "jpg":
                            $im = @imagecreatefromjpeg($out['tmp']);
                            break;
                        case "gif":
                            $im = @imagecreatefromgif($out['tmp']);
                            break;
                        case "png":
                            $im = @imagecreatefrompng($out['tmp']);
                            break;
                    }

                    /* Save the file */
                    if ($im) {
                        $ico = SQ_ObjController::getModel('SQ_Ico');
                        $ico->set_image($out['tmp'], array(32, 32));
                        $ico->save_ico($out['favicon']);
                    } else {
                        SQ_Error::setError(__("ICO Error: Could not create the ICO from file. Try with another file type.", _SQ_PLUGIN_NAME_));
                    }
                } else {
                    copy($out['tmp'], $out['favicon']);
                }

                $out['message'] = __("The favicon has been updated.", _SQ_PLUGIN_NAME_);

                return $out;
            }
        }
    }

    private function checkFunctions() {
        $required_functions = array(
            'getimagesize',
            'imagecreatefromstring',
            'imagecreatetruecolor',
            'imagecolortransparent',
            'imagecolorallocatealpha',
            'imagealphablending',
            'imagesavealpha',
            'imagesx',
            'imagesy',
            'imagecopyresampled',
        );

        foreach ($required_functions as $function) {
            if (!function_exists($function)) {
                SQ_Error::setError("The PHP_ICO class was unable to find the $function function, which is part of the GD library. Ensure that the system has the GD library installed and that PHP has access to it through a PHP interface, such as PHP's GD module. Since this function was not found, the library will be unable to create ICO files.");
                return false;
            }
        }

        return true;
    }

}
