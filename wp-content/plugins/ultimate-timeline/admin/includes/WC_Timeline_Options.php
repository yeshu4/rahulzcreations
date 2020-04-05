<?php
defined('ABSPATH') || die;
class WC_Timeline_Options{

    public static function update_options(){
        if ( ! wp_verify_nonce( $_POST['update-timeline-options'], 'update-timeline-options' ) ) {
            die();
        }
        global $wpdb;

        $timeline_title     = isset( $_POST['timeline_title'] ) ? sanitize_text_field( $_POST['timeline_title'] )  : '';
        $timeline_bg_color  = isset( $_POST['timeline_bg_color'] ) ? sanitize_text_field( $_POST['timeline_bg_color'] )  : '#0000';

        $errors = [];
        if ( empty( $timeline_bg_color ) ) {
            $timeline_bg_color  ="";
			//$errors['timeline_bg_color'] = esc_html__( 'Please Select a Timeline Background Color.', 'ultimate-timeline' );
        }

        if ( count( $errors ) < 1 ) {
            try {
                $data = array(
                    'timeline_title'    => $timeline_title,
                    'timeline_bg_color' => $timeline_bg_color
                );
                update_option('weblizar_timeline_options',$data );
                $timeline_options = get_option('weblizar_timeline_options');
                if ( $timeline_options == false ) {
                    throw new Exception( esc_html__( 'An unexpected error occurred.', 'ultimate-timeline' ) );
                }
                wp_send_json_success( array( 'message' => esc_html__( 'Timeline Options Updated Successfully !', 'ultimate-timeline' ) ) );
            } catch ( Exception $exception ) {
                wp_send_json_error( $exception->getMessage() );
            }
        }
        wp_send_json_error( $errors );
        wp_die();
    }


}
