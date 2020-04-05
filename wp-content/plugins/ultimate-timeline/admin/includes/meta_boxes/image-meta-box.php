<?php
defined('ABSPATH') || die;
$post_id = $post->ID;
$timeline_settings = get_post_meta( $post_id ,'wct_story_setting',true);
$story_image = $story_image_id = '';
if ( is_array( $timeline_settings ) ) {
    if ( isset( $timeline_settings['story_image'] ) ) {
        $story_image    = esc_url( $timeline_settings['story_image'] );
    }
    if ( isset( $timeline_settings['story_image_id'] ) ) {
        $story_image_id = esc_attr_x( $timeline_settings['story_image_id'], 'ultimate-timeline' );
    }
}
?>

<div class="row py-4 custom_image_upload">
    <div class="col-lg-6 mx-auto">

        <!-- Upload image input-->
        <div class="input-group mb-3 px-2 py-2 rounded-pill bg-white shadow-sm image_upload_div">
            <input id="upload" type="file" onchange="readURL( this );" value="<?php echo esc_url( wp_get_attachment_url( $story_image_id ) ); ?>" name="story_image" class="form-control border-0">
            <input id="custom_image_upload_id" type="hidden" value="<?php echo $story_image_id ?>" name="story_image_id" class="form-control border-0">
            <label id="upload-label" for="upload" class="font-weight-light text-muted"><?php esc_attr_e('Choose file','ultimate-timeline')?></label>
            <div class="input-group-append">
                <label for="upload" class="btn btn-light m-0 rounded-pill px-4"> <i class="fa fa-cloud-upload mr-2 text-muted"></i><small class="text-uppercase font-weight-bold text-muted"><?php esc_html_e('Choose file','ultimate-timeline') ?></small></label>
            </div>
        </div>

        <!-- Uploaded image area-->
        <p class="font-italic text-white text-center"><?php esc_html_e('The image uploaded will be rendered inside the box below.','ultimate-timeline') ?></p>
        <div class="image-area mt-4"><img id="imageResult" src="<?php echo esc_url( wp_get_attachment_url( $story_image_id ) ); ?>" alt="" class="img-fluid rounded shadow-sm mx-auto d-block"></div>

    </div>
</div>
