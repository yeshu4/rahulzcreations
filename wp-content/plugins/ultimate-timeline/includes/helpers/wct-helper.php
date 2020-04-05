<?php
defined('ABSPATH') || die;

class WeblizarTimelineHelper{

    public static function wct_generate_custom_timestamp( $story_date ) {
        if( ! empty( $story_date )) {
            $ctl_story_date = strtotime( $story_date );
            if( $ctl_story_date !== false ) {
                $story_timestamp = date('YmdHi',$ctl_story_date);
            }
            return $story_timestamp;
        }
    }
    // get post type from url
    public static function wtlfree_get_ctp() {
        global $post, $typenow, $current_screen;
        if ( $post && $post->post_type )
            return $post->post_type;
        elseif( $typenow )
            return $typenow;
        elseif( $current_screen && $current_screen->post_type )
            return $current_screen->post_type;
        elseif( isset( $_REQUEST['post_type'] ) )
            return sanitize_key( $_REQUEST['post_type'] );
        return null;
    }

    public static function wct_generate_icon_array() {
        $icons = get_option( 'fa_icons' );
        if ( empty( $icons ) ) {
            require_once WEBLIZAR_TIMELINE_DIR.'includes/fa-icons/includes/fa-icons-array.php';
            foreach ( $all_icons as $icon ) {
                $icons[] = array( 'class' => $icon );
            }
            update_option( 'fa_icons', $icons );
        }
        return $icons;
    }

    public static function wct_run_migration() {
        $args = array(
            'post_type'   => 'weblizar_timeline',
            'post_status' => array('publish','future','scheduled'),
            'numberposts' => -1 );
        $posts = get_posts( $args );

        if( isset( $posts ) && is_array( $posts ) && ! empty( $posts ))
        {
            foreach ( $posts as $post )
            {
                $published_date = get_the_date('m/d/Y H:i', $post->ID );
                if( $published_date ){
                    update_post_meta( $post->ID, 'wct_story_date', $published_date );
                    $story_timestamp = self::generate_timestamp( $published_date );
                    update_post_meta( $post->ID,'wct_story_timestamp',$story_timestamp );
                }
            }
        }
    }

    public static function generate_timestamp( $story_date ) {
        if( ! empty( $story_date ) ){
            $wct_story_date = strtotime( $story_date );
            if( $wct_story_date !== false){
                $story_timestamp = date('YmdHi',$wct_story_date);
            }else{
                $story_timestamp = date('YmdHi',strtotime('today'));
            }
            return $story_timestamp;
        }
    }

    public static function get_story_date( $post_id, $date_formats ) {
        $wct_story_settings  = get_post_meta( $post_id, 'wct_story_setting', true );
        if ( ! empty( $wct_story_settings['wct_story_date'] ) ) {
            $posted_date = date_i18n(__("$date_formats", 'ultimate-timeline'), strtotime( $wct_story_settings['wct_story_date'] ) );
        }else{
            $posted_date = date_i18n(__("$date_formats", 'ultimate-timeline'), strtotime("today"));
        }
        return $posted_date;
    }

    public static function get_story_icon( $post_id ) {
        $wct_story_settings  = get_post_meta( $post_id, 'wct_story_setting', true );
        if ( ! empty( $wct_story_settings['fa_field_icon'] ) ) {
            $icon = '<i class="'. esc_attr( $wct_story_settings['fa_field_icon'] ) .' custom_timeline_icon" aria-hidden="true"></i>';
        }else{
            $icon = '<i class="fa fa-clock-o custom_timeline_icon" aria-hidden="true"></i>';
        }
        return $icon;
    }

    public static function get_story_color( $post_id ) {
        $wct_story_settings  = get_post_meta( $post_id, 'wct_story_setting', true );
        if ( ! empty( $wct_story_settings['story_color'] ) ) {
            $story_color = esc_attr( $wct_story_settings['story_color'] );
        }else{
            $story_color = '#21e1acc2';
        }
        return $story_color;
    }

    public static function get_story_data( $post_id ) {
        $wct_story_settings  = get_post_meta( $post_id, 'wct_story_setting', true );
        if ( ! empty( $wct_story_settings ) ) {
            return $wct_story_settings;
        }else{
            return false;
        }
    }

    public static function getAuthorNameById( $field ='', $user_id = false ) {
        $original_user_id = $user_id;
        if ( ! $user_id ) {
            global $authordata;
            $user_id = isset( $authordata->ID ) ? $authordata->ID : 0;
        } else {
            $authordata = get_userdata( $user_id );
        }

        if ( in_array( $field, array( 'login', 'pass', 'nicename', 'email', 'url', 'registered', 'activation_key', 'status' ) ) ) {
            $field = 'user_' . $field;
        }
        $value = isset( $authordata->$field ) ? $authordata->$field : '';
        $author_meta =  apply_filters( "get_the_author_{$field}", $value, $user_id, $original_user_id );
        return apply_filters( "the_author_{$field}", $author_meta, $user_id );
    }
}
