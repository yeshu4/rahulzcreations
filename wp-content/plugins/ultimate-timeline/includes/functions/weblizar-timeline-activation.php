<?php
defined('ABSPATH') || die;
require_once WEBLIZAR_TIMELINE_DIR.'includes/helpers/wct-helper.php';
class WeblizarTimelineActivation{
    public static function activation() {
        flush_rewrite_rules();
    }
    public static function wct_include_files(){
        if ( is_admin() ) {
            require_once WEBLIZAR_TIMELINE_DIR . 'admin/weblizar-timeline-post-type.php';
            new WeblizarTimelinePostType();

            require_once WEBLIZAR_TIMELINE_DIR.'admin/weblizar-timeline-meta-box.php';
            new WeblizarTimelineMetaBox();

            WeblizarTimelineHelper::wct_run_migration();
        }
        require_once WEBLIZAR_TIMELINE_DIR.'public/public.php';
    }
}