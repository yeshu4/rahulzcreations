<?php
defined('ABSPATH') || die();

require_once 'WCT_ShortCode.php';

add_action( 'init', array('WCT_ShortCode','weblizar_timeline_custom_post_type' ));

add_action('wp_enqueue_scripts',array('WCT_ShortCode','timeline_assets'));

add_shortcode('weblizar_timeline',array('WCT_ShortCode','timeline_view'));

add_filter( 'the_content',  array('WCT_ShortCode','disable_wp_auto_p'), 0 );

add_filter('single_template', array('WCT_ShortCode','my_custom_template'));

