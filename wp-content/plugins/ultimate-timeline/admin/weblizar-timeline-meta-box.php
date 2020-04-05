<?php
defined('ABSPATH') || die;
require_once WEBLIZAR_TIMELINE_DIR.'includes/helpers/wct-helper.php';
class WeblizarTimelineMetaBox{
    public function __construct(){
        add_action('add_meta_boxes', array('WeblizarTimelineMetaBox','weblizar_add_meta_boxes'));

        add_action( 'save_post', array( 'WeblizarTimelineMetaBox', 'save_meta_boxes_data' ), 10, 2 );
    }

    public static function weblizar_add_meta_boxes() {
        add_meta_box('wct-image',esc_html__('Weblizar Timeline Story Image','ultimate-timeline'),array('WeblizarTimelineMetaBox','image_meta_box'),'weblizar_timeline','normal','high');
        add_meta_box('wct-settings',esc_html__('Weblizar Timeline Story Settings','ultimate-timeline'),array('WeblizarTimelineMetaBox','settings_meta_box'),'weblizar_timeline','normal','low');
        add_meta_box('wct-fa-icons',esc_html__('Weblizar Timeline Story Icon','ultimate-timeline'),array('WeblizarTimelineMetaBox','fa_icon_meta_box'),'weblizar_timeline','side','high');
    }

    public static function settings_meta_box( $post ) {
        require_once WEBLIZAR_TIMELINE_DIR.'admin/includes/meta_boxes/settings-meta-box.php';
    }

    public static function fa_icon_meta_box( $post ) {
        require_once WEBLIZAR_TIMELINE_DIR.'admin/includes/meta_boxes/fa-icon-meta-box.php';
    }

    public static function image_meta_box( $post ) {
        require_once WEBLIZAR_TIMELINE_DIR.'admin/includes/meta_boxes/image-meta-box.php';
    }

    public static function save_meta_boxes_data( $post_id, $post ) {
        if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
            return;
        }
        if ( defined( 'DOING_AJAX' ) && DOING_AJAX ) {
            return;
        }
        if ( ! current_user_can( 'edit_post', $post_id ) ) {
            return;
        }
        if ( wp_is_post_revision( $post ) ) {
            return;
        }
        if ( 'weblizar_timeline' !== $post->post_type ) {
            return;
        }

        $display_story_image        = isset( $_POST['display_story_image'] ) ? (bool) $_POST['display_story_image'] : true;
        $story_image_full_screen    = isset( $_POST['story_image_full_screen'] ) ? (bool)( $_POST['story_image_full_screen'] ) : false;

        $data_timeline = array(
            'display_story_image'       => $display_story_image,
            'story_image_full_screen'   => $story_image_full_screen,
        );
        update_post_meta( $post_id, 'wct_timeline_setting', $data_timeline );
        $story_image_id         = isset( $_POST['story_image_id'] ) ? sanitize_text_field( $_POST['story_image_id'] ) : '';
        $story_image            = isset( $_POST['story_image'] ) ? sanitize_text_field( $_POST['story_image'] ) : '';
        $display_story_image    = isset( $_POST['display_story_image'] ) ? (bool)( $_POST['display_story_image'] ) : true;
        $story_full_screen      = isset( $_POST['story_image_full_screen'] ) ? (bool)( $_POST['story_image_full_screen'] ) : true;

        $display_author_name    = isset( $_POST['display_author_name'] ) ? (bool)( $_POST['display_author_name'] ) : true;

        $story_color            = isset( $_POST['story_color'] ) ? sanitize_hex_color( $_POST['story_color'] ) : '#eeee22';
        if ( isset( $_POST['version'] ) && $_POST['version'] == 'lite') {
            $story_title_bg_color =  $story_color;
            $story_title_color = $story_paragraph_bg_color = '#fff';
            $story_paragraph_color = '#494242';
        }else{
            $story_title_color          = isset( $_POST['story_title_color'] ) ? sanitize_hex_color( $_POST['story_title_color'] ) : '#000';
            $story_title_bg_color       = isset( $_POST['story_title_bg_color'] ) ? sanitize_hex_color( $_POST['story_title_bg_color'] ) : '#fff';
            $story_paragraph_color      = isset( $_POST['story_paragraph_color'] ) ? sanitize_hex_color( $_POST['story_paragraph_color'] ) : '#494242';
            $story_paragraph_bg_color   = isset( $_POST['story_paragraph_bg_color'] ) ? sanitize_hex_color( $_POST['story_paragraph_bg_color'] ) : '#fff';
        }

        $story_date             = isset( $_POST['wct_story_date'] ) ?  sanitize_text_field( $_POST['wct_story_date'] ) : date('m/d/Y h:i',strtotime('today'));
        $display_story_date     = isset( $_POST['display_story_date'] ) ? (bool)( $_POST['display_story_date'] ) : true;
        $story_date_color       = isset( $_POST['story_date_color'] ) ? sanitize_hex_color( $_POST['story_date_color'] ) : '#000';

        $story_icon             = isset( $_POST['fa_field_icon'] ) ?  sanitize_text_field( $_POST['fa_field_icon'] ) : 'fa fa-clock';

        $add_story_animation    = isset( $_POST['add_story_animation'] ) ? (bool)$_POST['add_story_animation'] : false;
        $story_animation        = isset( $_POST['story_animation'] ) ?  sanitize_text_field( $_POST['story_animation'] ) : 'fade-up';

        $data_story = array(
            'story_image_id'            => $story_image_id,
            'story_image'               => $story_image,

            'display_author_name'       => $display_author_name,

            'add_story_animation'       => $add_story_animation,
            'story_animation'           => $story_animation,

            'display_story_image'       => $display_story_image,
            'story_full_screen'         => $story_full_screen,

            'story_color'               => $story_color,
            'story_title_color'         => $story_title_color,
            'story_title_bg_color'      => $story_title_bg_color,
            'story_paragraph_color'     => $story_paragraph_color,
            'story_paragraph_bg_color'  => $story_paragraph_bg_color,

            'wct_story_date'            => $story_date,
            'display_story_date'        => $display_story_date,
            'story_date_color'          => $story_date_color,

            'fa_field_icon'             => $story_icon
        );
        update_post_meta( $post_id, 'wct_story_setting', $data_story );

    }

}