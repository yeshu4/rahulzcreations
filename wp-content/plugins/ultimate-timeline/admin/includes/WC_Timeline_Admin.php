<?php
defined('ABSPATH') || die;
class WC_Timeline_Admin{
    public static function create_menu() {
        $wct_admin_submenu = add_submenu_page( 'edit.php?post_type=weblizar_timeline', esc_html__( 'Timeline Options', 'ultimate-timeline' ), esc_html__( 'Timeline Options', 'ultimate-timeline' ), 'manage_options', 'wct_timeline_options', array( 'WC_Timeline_Admin', 'admin_menu' ),  27 );
        add_action('wp-print-styles-'.$wct_admin_submenu, array('WC_Timeline_Admin','admin_menu_assets'));
    }
    public static function admin_menu() {
        include_once WEBLIZAR_TIMELINE_DIR.'admin/weblizar-timeline-options.php';
    }

    public static function admin_menu_assets( $hook_suffix ) {
        $screen = get_current_screen();
        if ( is_object( $screen ) && 'weblizar_timeline_page_wct_timeline_options' == $screen->base ) {
            wp_enqueue_style( 'wp-color-picker' );
            wp_enqueue_style( 'bootstrap', WEBLIZAR_TIMELINE_URL . 'assets/css/bootstrap.min.css' );
            wp_enqueue_style( 'font-awesome', WEBLIZAR_TIMELINE_URL . 'includes/fa-icons/css/font-awesome/css/all.min.css' );
            wp_enqueue_style( 'timeline-options', WEBLIZAR_TIMELINE_URL . 'assets/css/timeline_option.css' );

            wp_enqueue_script( 'wp-color-picker' );
            wp_enqueue_script( 'popper', WEBLIZAR_TIMELINE_URL . 'assets/js/popper.min.js', array( 'jquery' ), true, true );
            wp_enqueue_script( 'bootstrap', WEBLIZAR_TIMELINE_URL . 'assets/js/bootstrap.min.js', array( 'popper' ), true, true );
            wp_enqueue_script( 'font-awesome', WEBLIZAR_TIMELINE_URL . 'includes/fa-icons/js/min/awesome.js');
            wp_enqueue_script( 'timeline-option', WEBLIZAR_TIMELINE_URL . 'assets/js/timeline_option.js', array( 'jquery' ), true, true );
            wp_enqueue_script( 'wct-ajax', WEBLIZAR_TIMELINE_URL . 'assets/js/wct-ajax.js', array( 'jquery' ), true, true );
        }
    }

    public static function enqueue_scripts_styles( $hook_suffix ) {
        if ( in_array( $hook_suffix, array( 'post.php', 'post-new.php' ) ) ) {
            $screen = get_current_screen();
            if ( is_object( $screen ) && 'weblizar_timeline' == $screen->post_type ) {
                /* Enqueue styles */
                wp_enqueue_style( 'wp-color-picker' );
                wp_enqueue_style( 'bootstrap', WEBLIZAR_TIMELINE_URL . 'assets/css/bootstrap.min.css' );

                wp_enqueue_style( 'fontselect', WEBLIZAR_TIMELINE_URL . 'assets/css/fontselect.css' );
                wp_enqueue_style( 'image-upload', WEBLIZAR_TIMELINE_URL . 'assets/css/image-upload.css' );
                wp_enqueue_style( 'font-awesome', WEBLIZAR_TIMELINE_URL . 'includes/fa-icons/css/font-awesome/css/all.min.css' );
                wp_enqueue_style( 'fa-shims', WEBLIZAR_TIMELINE_URL . 'includes/fa-icons/css/fa-shims.css' );
                wp_enqueue_style( 'fa-field-css', WEBLIZAR_TIMELINE_URL . 'includes/fa-icons/css/fa-field.css' );
                wp_enqueue_style( 'zebra-datepicker', WEBLIZAR_TIMELINE_URL . 'assets/css/zebra_datepicker.min.css' );
                wp_enqueue_style( 'ultimate-timeline', WEBLIZAR_TIMELINE_URL . 'assets/css/ultimate-timeline.css' );

                /* Enqueue scripts */
                wp_enqueue_media();
                wp_enqueue_script( 'wp-color-picker' );
                wp_enqueue_script( 'popper', WEBLIZAR_TIMELINE_URL . 'assets/js/popper.min.js', array( 'jquery' ), true, true );
                wp_enqueue_script( 'bootstrap', WEBLIZAR_TIMELINE_URL . 'assets/js/bootstrap.min.js', array( 'popper' ), true, true );
                wp_enqueue_script( 'jquery-fontselect', WEBLIZAR_TIMELINE_URL . 'assets/js/jquery.fontselect.min.js', array( 'jquery' ), true, true );
                wp_enqueue_script( 'font-awesome', WEBLIZAR_TIMELINE_URL . 'includes/fa-icons/js/min/awesome.js');
                wp_enqueue_script( 'image-upload', WEBLIZAR_TIMELINE_URL . 'assets/js/image-upload.js', array( 'jquery' ) );
                wp_enqueue_script( 'fa-field-js', WEBLIZAR_TIMELINE_URL . 'includes/fa-icons/js/fa-field.js', array( 'jquery' ) );
                wp_enqueue_script( 'zebra-datepicker', WEBLIZAR_TIMELINE_URL . 'assets/js/zebra_datepicker.min.js', array( 'jquery' ), true, true );
                wp_enqueue_script( 'wct-admin', WEBLIZAR_TIMELINE_URL . 'assets/js/wct-admin.js', array( 'jquery' ), true, true );
            }
        }else{
            wp_enqueue_style( 'ultimate-timeline', WEBLIZAR_TIMELINE_URL . 'assets/css/ultimate-timeline.css' );

            wp_enqueue_script( 'font-awesome', WEBLIZAR_TIMELINE_URL . 'includes/fa-icons/js/min/awesome.js');
        }
    }

}