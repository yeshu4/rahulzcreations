<?php
defined('ABSPATH') || die;
require_once WEBLIZAR_TIMELINE_DIR.'includes/helpers/wct-helper.php';
class WCT_ShortCode{
    public static function timeline_view( $attr ){
        ob_start();
        include_once 'views/timeline_view.php';
        return ob_get_clean();
    }

    public static function timeline_assets(){
        wp_enqueue_style( 'bootstrap', WEBLIZAR_TIMELINE_URL . 'assets/css/bootstrap.min.css' );
        wp_enqueue_style( 'ultimate-timeline', WEBLIZAR_TIMELINE_URL . 'assets/css/ultimate-timeline.css' );
        wp_enqueue_style( 'timeline', WEBLIZAR_TIMELINE_URL . 'public/inc/css/timeline_view.css' );

        wp_enqueue_script( 'bootstrap', WEBLIZAR_TIMELINE_URL . 'assets/js/bootstrap.min.js', array( 'popper' ), true, true );
        wp_enqueue_script( 'font-awesome', WEBLIZAR_TIMELINE_URL . 'includes/fa-icons/js/min/awesome.js');
    }

    public static function my_custom_template( $single ) {
        global $post;
        if ( $post->post_type == 'weblizar_timeline' ) {
            if ( file_exists( WEBLIZAR_TIMELINE_DIR . 'public/views/shortcode_view.php' ) ) {
                return WEBLIZAR_TIMELINE_DIR . 'public/views/shortcode_view.php';
            }
        }
        return $single;
    }

    public static function disable_wp_auto_p( $content ) {
        remove_filter( 'the_content', 'wpautop' );
        remove_filter( 'the_excerpt', 'wpautop' );
        return $content;
    }

    public static function weblizar_timeline_custom_post_type() {
        $labels = array(
            'name'                => esc_html_x( 'Ultimate Timeline', 'Post Type General Name', 'ultimate-timeline' ),
            'singular_name'       => esc_html_x( 'Ultimate Timeline', 'Post Type Singular Name', 'ultimate-timeline' ),
            'menu_name'           => esc_html__( 'Ultimate Timeline', 'ultimate-timeline' ),
            'name_admin_bar'      => esc_html__( 'Ultimate Timeline', 'ultimate-timeline' ),
            'parent_item_colon'   => esc_html__( 'Parent Item:', 'ultimate-timeline' ),
            'all_items'           => esc_html__( 'All Stories', 'ultimate-timeline' ),
            'add_new_item'        => esc_html__( 'Add New Story', 'ultimate-timeline' ),
            'add_new'             => esc_html__( 'Add New Story', 'ultimate-timeline' ),
            'new_item'            => esc_html__( 'New Story', 'ultimate-timeline' ),
            'edit_item'           => esc_html__( 'Edit Story', 'ultimate-timeline' ),
            'update_item'         => esc_html__( 'Update Story', 'ultimate-timeline' ),
            'view_item'           => esc_html__( 'View Story', 'ultimate-timeline' ),
            'search_items'        => esc_html__( 'Search Story', 'ultimate-timeline' ),
            'not_found'           => esc_html__( 'Not found', 'ultimate-timeline' ),
            'not_found_in_trash'  => esc_html__( 'Not found in Trash', 'ultimate-timeline' ),
        );

        $ultimate_timeline_rewrite = array(
            'slug'       => 'weblizar_timeline',
            'with_front' => false,
            'pages'      => true,
            'feeds'      => true,
        );

        $args = array(
            'label'                 => esc_html__( 'Ultimate Timeline', 'ultimate-timeline' ),
            'labels'                => $labels,
            'description'           => esc_html__( 'Timeline Post Type Description', 'ultimate-timeline' ),
            'supports'              => array('title','editor','thumbnail'),
            'taxonomies'            => array(),
            'hierarchical'          => false,
            'public'                => true,
            'show_ui'               => true,
            'show_in_menu'          => true,
            'menu_icon'             => esc_url(WEBLIZAR_TIMELINE_URL.'assets/images/timeline-icon-small.png' ),
            'menu_position'         => 5,
            'show_in_admin_bar'     => true,
            'show_in_nav_menus'     => true,
            'can_export'            => true,
            'has_archive'           => true,
            'exclude_from_search'   => false,
            'publicly_queryable'    => true,
            'capability_type'       => esc_attr('post'),
            'rewrite'               => $ultimate_timeline_rewrite,
            'rest_base'             => esc_attr('wct_story_setting'),
        );
        register_post_type( 'weblizar_timeline', $args );
    }


}