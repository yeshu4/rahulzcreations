<?php
defined('ABSPATH') || die;
require_once WEBLIZAR_TIMELINE_DIR.'includes/helpers/wct-helper.php';
$icon = '';
$post_id = $post->ID;
$timeline_settings  = get_post_meta($post_id,'wct_story_setting',true);
if ( is_array( $timeline_settings ) ) {
    if ( isset( $timeline_settings['fa_field_icon'] ) ) {
        $icon = esc_attr( $timeline_settings['fa_field_icon'] );
    }
}
$all_icons = WeblizarTimelineHelper::wct_generate_icon_array();
?>

<div class="fa-field-metabox">
    <div class="fa-field-current-icon">
        <div class="icon">
            <?php
            if ( $icon ) :
                if( strpos( $icon, '-o' ) !== false ) {
                    $icon = "fa ".$icon;
                } else if( strpos( $icon, 'fas' ) !== false || strpos( $icon, 'fab' ) !== false ) {
                    $icon = $icon;
                } else {
                    $icon = "fa ".$icon;
                }
                ?>
                <i class="<?php echo esc_attr( $icon ); ?>"></i>
            <?php
            else :
                $icon = 'fas fa-clock';
                echo '<i class="fas fa-clock" aria-hidden="true"></i>';
            endif; ?>
        </div>
        <div class="delete <?php echo esc_attr( $icon ) ? 'active' : ''; ?>">&times;</div>
    </div>
    <input type="hidden" name="fa_field_icon" id="fa_field_icon" value="<?php echo esc_attr( $icon ); ?>">
    <?php wp_nonce_field( 'fa_field_icon', 'fa_field_icon_nonce' ); ?>

    <button class="button-primary add-fa-icon"><?php esc_attr_e( 'Add Icon', 'ultimate-timeline' ); ?></button>
</div>
<div class="fa-field-modal" id="fa-field-modal" style="display:none">
    <div class="fa-field-modal-close">&times;</div>
    <h1 class="fa-field-modal-title"><?php esc_attr_e( 'Select Font Awesome Icon', 'ultimate-timeline' ); ?></h1>
    <div class="icon_search_container">
        <input type="text" id="searchicon" onkeyup="wctSearchIcon()" placeholder="<?php esc_attr_e( 'Search Icon..', 'ultimate-timeline' ); ?>">
    </div>
    <div id="wct_icon_wrapper" class="fa-field-modal-icons">
        <?php if ( $all_icons ) : ?>
            <?php foreach ( $all_icons as $icon ) : ?>
                <div class="fa-field-modal-icon-holder" data-icon="<?php echo esc_attr( $icon['class'] ); ?>">
                    <div class="icon">
                        <i data-icon-name="<?php echo esc_attr( $icon['class'] ); ?>" class="<?php echo esc_attr( $icon['class'] ); ?>"></i>
                    </div>
                </div>
            <?php endforeach; ?>
        <?php endif; ?>
    </div>
</div>