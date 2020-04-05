<?php
defined('ABSPATH') || die;
class WeblizarTimelinePostType{

    public function __construct(){
        include_once('includes/WC_Timeline_Admin.php');
        include('includes/WC_Timeline_Options.php');
        include_once(WEBLIZAR_TIMELINE_DIR.'includes/helpers/wct-helper.php');

        add_filter('manage_edit-weblizar_timeline_columns',array($this,'add_new_weblizar_timeline_columns'));
        add_action( 'manage_weblizar_timeline_posts_custom_column' , array($this,'wct_custom_columns'), 10, 2 );
        add_action('post_submitbox_misc_actions', array($this, 'wct_submitbox_metabox'));
        add_action( 'admin_menu', array( 'WC_Timeline_Admin', 'create_menu' ) );
        add_action('post_submitbox_misc_actions', array($this, 'wct_submit_code_metabox'));
        add_action( 'admin_enqueue_scripts', array( 'WC_Timeline_Admin', 'enqueue_scripts_styles' ) );
        add_action( 'admin_enqueue_scripts', array( 'WC_Timeline_Admin', 'admin_menu_assets' ) );
        // ajax requests
        add_action( 'wp_ajax_wct-update-timeline-options', array( 'WC_Timeline_Options', 'update_options' ) );
    }

    // custom columns for all stories
    public static function add_new_weblizar_timeline_columns( $gallery_columns ) {
        $new_columns['cb']          = '<input type="checkbox" />';
        $new_columns['title']       = esc_attr_x('Story Title', 'column name');
        $new_columns['story_year']  = esc_attr_x('Story Year','ultimate-timeline');
        $new_columns['story_date']  = esc_attr_x('Story Date','ultimate-timeline');
        $new_columns['icon']        = esc_attr_x('Story Icon','ultimate-timeline');
        $new_columns['date']        = esc_attr_x('Published Date', 'column name');
        return $new_columns;
    }

    // WCT column handlers
    public static function wct_custom_columns( $column, $post_id ) {
        $wct_story_settings  = get_post_meta( $post_id, 'wct_story_setting', true );
        switch ( $column ) {
            case "story_year":
                $wct_story_date     = $wct_story_settings['wct_story_date'];
                $story_timestamp    = strtotime( $wct_story_date );
                if( $story_timestamp !== false ){
                    $story_year = date("Y", $story_timestamp );
                    echo"<p><strong>" . esc_html( $story_year ) . "</strong></p>";
                }
                break;

            case "story_date":
                $wct_story_date =  $wct_story_settings['wct_story_date'];
                echo"<p><strong>" . esc_html( $wct_story_date ) . "</strong></p>";
                break;

            case "icon":
                $icon = $wct_story_settings['fa_field_icon'];
                if($icon){
                    echo '<i class="'.esc_attr( $icon ).' custom_timeline_icon" aria-hidden="true"></i>';
                }else{
                    echo '<i class="fa fa-clock-o custom_timeline_icon" aria-hidden="true"></i>';
                }
                break;
            default:
                echo "<p>".esc_html_e( 'Not Matched', 'ultimate-timeline' )."</p>";
        }
    }

    public static function wct_submitbox_metabox(){
        if( ( isset( $_REQUEST['post'] ) && get_post_type( $_REQUEST['post'] ) == 'weblizar_timeline' ) ||
            ( isset( $_REQUEST['post_type'] ) && $_REQUEST['post_type'] == 'weblizar_timeline' ) ){
            $html  = '<div class="misc-pub-section ctl-notice">';
            $html .= '<span class="custom_date_side_meta_box">'. esc_attr__('*Please select story Date / Year from settings below the story content.','ultimate-timeline');
            $html .= ' <a href="#normal-sortables"><br/> - '. esc_attr__('Timeline Story Settings (Date/Year)','ultimate-timeline') .'</a>';
            $html .= '</span>';
            $html .= '</div>';
            echo $html;

        }
    }

    public static function wct_submit_code_metabox(){
        if( ( isset( $_REQUEST['post'] ) && get_post_type( $_REQUEST['post'] ) == 'weblizar_timeline' ) ||
            ( isset( $_REQUEST['post_type'] ) && $_REQUEST['post_type'] == 'weblizar_timeline' ) ){
            $html  = '<div class="misc-pub-section ctl-notice">';
            $html .= '<span class="custom_date_side_meta_box">'.esc_attr__('Copy below shortcode in any Page to publish your Timeline','ultimate-timeline');
            $html .= ' <a href="#"><br/>'.esc_attr__('[weblizar_timeline]','ultimate-timeline').'</a>';
            $html .= '</span>';
            $html .= '</div>';
            echo $html;

        }
    }
}