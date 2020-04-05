<?php
defined('ABSPATH') || die();
get_header();
do_action( 'weblizar_timeline_before_main_content' );
?>
<div class="wrap">
    <div class="container mt-4 mb-3">
        <section>
            <?php
            while ( have_posts() ) : the_post();
                $post    = get_post();
                $post_id = $post->ID;

                $story_settings_data = get_post_meta( $post_id, 'wct_story_setting', true );
                if ( isset( $story_settings_data['story_image_id'] ) ) {
                    $story_image_id = esc_attr( $story_settings_data['story_image_id'] );
                }
                ?>
                <article <?php post_class(); ?>>
                    <header>
                        <div class="row">
                            <div class="col-sm-9">
                                <h1 class="page-header"><?php the_title(); ?></h1>
                            </div>
                        </div>
                        <?php $image_url = ! empty( wp_get_attachment_url( $story_image_id ) ) ? wp_get_attachment_url( $story_image_id ) : '';
                        if ( ! empty( $image_url ) ) : ?>
                        <div class="image-area mt-4">
                            <img id="imageResult" src="<?php echo esc_url( $image_url ) ?>" alt="" class="img-fluid rounded shadow-sm d-block custom_single_img_view">
                        </div>
                        <?php endif; ?>
                    </header>
                    <div id="weblizar-timeline-content-<?php the_ID(); ?>" class="mb-4">
                        <?php the_content(); ?>
                    </div>
                </article>
            <?php endwhile;
            wp_reset_postdata();
            ?>
        </section>
    </div>
</div>
<?php get_footer(); ?>
