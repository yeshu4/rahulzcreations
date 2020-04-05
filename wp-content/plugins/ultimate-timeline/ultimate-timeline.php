<?php
/*
* Plugin Name: Ultimate Timeline - Responsive History Timeline block
* Plugin URI: https://weblizar.com/ultimate-timeline/
* Description: Ultimate Timeline plugin creates beautiful history time-lines on your website. It is responsive time-line showcase in DESC order based on posted date of stories with colors, fontawsome icons.
* Version: 1.2
* Author: Weblizar
* Author URI: weblizar.com
* License:GPLv2 or later
* License URI: https://www.gnu.org/licenses/gpl-2.0.html
* Text Domain: ultimate-timeline
 */

defined('ABSPATH') || die;

if (!defined('WEBLIZAR_TIMELINE_CURRENT_VERSION')){
    define('WEBLIZAR_TIMELINE_CURRENT_VERSION', '1.2');
}
define('WEBLIZAR_TIMELINE_DIR',plugin_dir_path(__FILE__));
define('WEBLIZAR_TIMELINE_URL',plugin_dir_url(__FILE__));

class WeblizarTimeline{
    private static $instance = null;
    public $error_message = null;
    function __construct(){
        require_once ('includes/functions/weblizar-timeline-activation.php');
        WeblizarTimelineActivation::wct_include_files();
    }

    public static function get_instance() {
        if ( is_null( self::$instance ) ) {
            self::$instance = new self();
        }
        return self::$instance;
    }

    public static function activation(){
        include_once ('includes/functions/weblizar-timeline-activation.php');
        WeblizarTimelineActivation::activation();
    }

    public static function deactivation(){
        //Do Nothing
        flush_rewrite_rules();
    }

}
WeblizarTimeline::get_instance();
register_activation_hook(__FILE__,array('WeblizarTimeline','activation'));
register_deactivation_hook(__FILE__,array('WeblizarTimeline','deactivation'));