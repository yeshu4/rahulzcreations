<?php
defined('ABSPATH') || die;
require_once WEBLIZAR_TIMELINE_DIR.'admin/includes/meta_boxes/timeline_default_options.php';
$weblizar_options = get_option('weblizar_timeline_options');
if( is_array( $weblizar_options ) && ! empty( $weblizar_options ) ) {
    $timeline_title     = ! empty( $weblizar_options['timeline_title'] ) ? esc_attr( $weblizar_options['timeline_title'] ) : '';
    $timeline_bg_color  = ! empty( $weblizar_options['timeline_bg_color'] ) ? esc_attr( $weblizar_options['timeline_bg_color'] ) : '#0000';
}
?>
<div class="container">
    <div class="row">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 bhoechie-tab-container">
            <div class="col-lg-3 col-md-3 col-sm-3 col-xs-3 bhoechie-tab-menu pull-left">
                <div class="list-group">
                    <a href="#" class="list-group-item active text-left">
                        <h4 ><i class="fa fa-list"></i> <span> <?php esc_attr_e('Timeline Settings','ultimate-timeline') ?></span></h4>
                    </a>
                </div>
            </div>
            <div class="col-lg-9 col-md-9 col-sm-9 col-xs-9 bhoechie-tab pull-right">
                <!-- flight section -->
                <div class="bhoechie-tab-content active">
                    <div class="wct-setting-container">
                        <div class="wct-timeline-shortcode">
                            <div class="row">
                                <div class="col-md-6">
                                    <h4> <span class="text-success"> <?php esc_attr_e('Copy the Shortcode in any page to publish your Timeline','ultimate-timeline') ?></span></h4>
                                </div>
                                <div class="col-md-6">
                                    <h4><?php echo  esc_attr__('[weblizar_timeline]','ultimate-timeline' ) ?></h4>
                                </div>
                            </div>
                        </div>
                        <hr>
                        <div class="row"> <h4> <?php esc_html_e( 'Default Settings', 'ultimate-timeline' ); ?> </h4></div>
                        <form id="wct-update-timeline-options-form">
                            <?php $nonce = wp_create_nonce( 'update-timeline-options' ); ?>
                            <input type="hidden" name="update-timeline-options" value="<?php echo esc_attr( $nonce ); ?>">
                            <div class="wct-setting-general">
                                <div class="row mt-4">
                                    <div class="col-xs-12 col-md-4 wct-setting-col">
                                        <span class="wct_setting_key">
                                            <?php esc_html_e( 'Timeline Title', 'ultimate-timeline' ); ?>
                                        </span>
                                    </div>
                                    <div class="col-xs-12 col-md-8 wct-setting-col">
                                        <div class="form-group">
                                            <div class="form-row">
                                                <input name="timeline_title" type="text" id="timeline_title" value="<?php echo esc_attr( $timeline_title );?>"
                                                       placeholder="<?php esc_html_e( 'Timeline Title', 'ultimate-timeline' ); ?>" >
                                            </div>
                                            <small>( <?php esc_html_e( 'Enter Timeline Title to set as your Timeline Header Title', 'ultimate-timeline' ); ?> )</small>
                                        </div>
                                    </div>
                                </div>

                                <div class="row mt-4">
                                    <div class="col-xs-12 col-md-4 wct-setting-col">
                                        <span class="wct_setting_key">
                                            <?php esc_html_e( 'Timeline Background Color', 'ultimate-timeline' ); ?>
                                        </span>
                                    </div>
                                    <div class="col-xs-12 col-md-8 wct-setting-col">
                                        <div class="form-group">
                                            <div class="form-row">
                                                <input name="timeline_bg_color" type="text" class="color-picker" id="timeline_bg_color" value="<?php echo esc_attr( $timeline_bg_color ); ?>">
                                            </div>
                                            <small class="d-block">( <?php esc_html_e( 'Choose Default color for your Timeline Background.', 'ultimate-timeline' ); ?> )</small>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="custom_option_submit">
                                <input type="submit" class="button button-primary update-timeline-options-btn" value="<?php esc_attr_e( 'Save Changes', 'ultimate-timeline' ); ?>">
                            </div>
                        </form>
                        <a href="#" class="wtc-smooth-up" title="<?php esc_html_e( 'Back to top', 'ultimate-timeline' ); ?>"></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
