<?php
defined('ABSPATH') || die;
require_once WEBLIZAR_TIMELINE_DIR.'includes/helpers/wct-helper.php';
require_once WEBLIZAR_TIMELINE_DIR.'admin/includes/meta_boxes/timeline_default_options.php';
$attribute = shortcode_atts( array(
        'post_per_page' => 10,
        'order'=>'',
        'story-content'=>'',
        'date-format'=>'',
        'icons'=>'',
        'show-posts'=>'',
        'skin'=>'default'
    ), $attr );

    $skin               = esc_attr( $attribute['skin'] );

    $wct_post_per_page  = $attribute['post_per_page'];
    $wct_post_order     = $attribute['order'];
    $wct_post_per_page  = $wct_post_per_page ? $wct_post_per_page : 10;
    $wct_post_order     = $wct_post_order ? $wct_post_order : "DESC";
    $wct_posts_orders   = '';
    $story_desc_type    = '';
    $story_date_format        = 'Y M d';

    $weblizar_options = get_option('weblizar_timeline_options');
    if( is_array( $weblizar_options ) && ! empty( $weblizar_options ) ) {
        $timeline_title     = ! empty( $weblizar_options['timeline_title'] ) ? esc_attr( $weblizar_options['timeline_title'] ) : '';
        $timeline_bg_color  = ! empty( $weblizar_options['timeline_bg_color'] ) ? esc_attr( $weblizar_options['timeline_bg_color'] ) : '#0000';
    }

    // create dynamic classes
    $timeline_icon_bg = 'bg-secondary';

    $i = 0;
    // timeline stories custom loop
    $args = array(
        'post_type'         => 'weblizar_timeline',
        'posts_per_page'    => $wct_post_per_page,
        'post_status'       => array( 'publish', 'future', 'Scheduled' ),
        'orderby'           => 'wct_story_timestamp',
        'order'             =>  $wct_post_order
    );
    $args['meta_query'] = array(
        array(
            'key'       => 'wct_story_timestamp',
            'compare'   => 'EXISTS',
            'type'      => 'NUMERIC'
        ));

    $args['paged'] = ( get_query_var('paged') ) ? get_query_var('paged') : 1;
    $paged = $args['paged'];
    $args['posts_per_page'] = $wct_post_per_page;


    $weblizar_options = get_option('weblizar_timeline_options');
    if( is_array( $weblizar_options ) && ! empty( $weblizar_options ) ) {
        $layout             = ! empty( $weblizar_options['layout'] ) ? esc_attr( $weblizar_options['layout'] ) : 'vertical';
        $story_date_format  = ! empty( $weblizar_options['story_date_format'] ) ? esc_attr( $weblizar_options['story_date_format'] ) : 'Y M d';
    }


    // start Main query
    $wtl_loop = new WP_Query( apply_filters( 'wct_stories_query', $args ) );
    $total_stories = $wtl_loop->found_posts;
    $html = '';
    if ( $wtl_loop->have_posts() ){
        while ( $wtl_loop->have_posts()) : $wtl_loop->the_post();
            $p_id = sanitize_key( get_the_ID() );
            global $post;
            $posted_date = WeblizarTimelineHelper::get_story_date( $p_id, $story_date_format );
            $story_data  = WeblizarTimelineHelper::get_story_data( $p_id );
            if ( $i % 2 == 0) {
                $even_odd = ""; //even
            } else {
                $even_odd = "left-aligned"; //odd
            }
            $story_icon         = WeblizarTimelineHelper::get_story_icon( $p_id );
            $story_content      = apply_filters( 'the_content', get_the_content() );
            $story_content      = apply_filters('weblizar_timeline_story_content', $story_content );
            $story_style        = 'div.custom_story_icon_'.esc_attr( $p_id ).'{ background-color : '.WeblizarTimelineHelper::get_story_color( $p_id ).'; color : white; }';

            $author_id      = $post->post_author;
            $author_name    = WeblizarTimelineHelper::getAuthorNameById('user_nicename',$author_id );
            $author_image   = WeblizarTimelineHelper::getAuthorNameById('user_avatar',$author_id );
            $author_name    = ! empty( $author_name ) ? esc_attr( $author_name ) : esc_attr__('Not Available','ultimate-timeline');
            $author_image   = ! empty( $author_image ) ? esc_url( $author_image ) : esc_url(WEBLIZAR_TIMELINE_URL.'/assets/images/no-image.png' );


            $story_image_full_size = $show_story_image = $add_story_animation = $show_story_date = false;
            $story_image_id = $author = $story_title_color = $story_paragraph_color = $story_paragraph_bg_color = $custom_css = '';
            if ( !empty( $story_data)){
                $story_image_id         = ( ! empty( $story_data['story_image_id'] ) ) ? esc_attr( $story_data['story_image_id'] ) : '';
                $show_story_image       = ( isset( $story_data['display_story_image'] ) ) ? (bool)$story_data['display_story_image'] : true;
                $story_image_full_size  = ( isset( $story_data['story_full_screen'] ) ) ? (bool)$story_data['story_full_screen'] : true;

                $story_title_color          =  ( ! empty( $story_data['story_title_color'] ) ) ? esc_attr( $story_data['story_title_color'] ) : '#000';
                $story_title_bg_color       =  ( ! empty( $story_data['story_title_bg_color'] ) ) ? esc_attr( $story_data['story_title_bg_color'] ) : '#fff';
                $story_paragraph_color      =  ( ! empty( $story_data['story_paragraph_color'] ) ) ? esc_attr( $story_data['story_paragraph_color'] ) : '#494242';
                $story_paragraph_bg_color   =  ( ! empty( $story_data['story_paragraph_bg_color'] ) ) ? esc_attr( $story_data['story_paragraph_bg_color'] ) : '#fff';

                $story_date_color       =  ( ! empty( $story_data['story_date_color'] ) ) ? esc_attr( $story_data['story_date_color'] ) : '#000';
                $show_story_date        = ( isset( $story_data['display_story_date'] ) ) ? (bool)$story_data['display_story_date'] : true;

                $display_author_name    = ( isset( $story_data['display_author_name'] ) ) ? (bool)$story_data['display_author_name'] : true;

                $add_story_animation    = ( isset( $story_data['add_story_animation'] ) ) ? ( bool )$story_data['add_story_animation'] : false;
                $story_animation        = ( ! empty( $story_data['story_animation'] ) ) ? esc_attr( $story_data['story_animation'] ) : 'fade-up';
            }

            $full_size_image_css = $full_size_p_css = $full_size_card_css = '';

            if ( ! $story_image_full_size ){
                $full_size_card_css = 'div.custom_image_card_box_'.esc_attr( $p_id ).'{ float: left!important;width: 50%!important;margin-right: 15px!important; }';
                $full_size_p_css = 'p.custom_story_p_'.esc_attr( $p_id ).'{ padding-top:0!important; }';
            }else{
                $full_size_image_css = 'div.custom_image_card_box_'.esc_attr( $p_id ).' .timeline_image_'.esc_attr( $p_id ).'{ height: 200px!important;width: 435px!important; }';
            }
            $story_title_css = 'h2.custom_story_title_'.esc_attr( $p_id ).'{ color:'.$story_title_color.'!important;background-color:'.$story_title_bg_color.'!important; }';
            $story_paragraph_css = 'p.custom_story_p_'.esc_attr( $p_id ).'{ color:'.$story_paragraph_color.'!important;background-color:'.$story_paragraph_bg_color.'!important; }';
            $story_date_css = 'span.custom_story_date_'.esc_attr( $p_id ).'{ color:'.$story_date_color.'!important; }';

            $timeline_css = 'div.weblizar_timeline_container { background-color : '.$timeline_bg_color.'; }';

            $custom_css .= $full_size_card_css . $full_size_image_css . $full_size_p_css . $story_title_css . $story_paragraph_css . $story_date_css . $story_style. $timeline_css;
            if ( ! empty( $custom_css ) ) {
                wp_register_style( 'ultimate-timeline-css', '' );
                wp_enqueue_style( 'ultimate-timeline-css' );
                wp_add_inline_style( 'ultimate-timeline-css', $custom_css );
            }

            $story_animation_css = '';
            if ( $add_story_animation ){
                $story_animation_css = "data-aos='".$story_animation."'";
            }

            $html .= '<article class="timeline-entry '.$even_odd.'" '.$story_animation_css.'>
                        <div class="timeline-entry-inner">';
                            if ( $display_author_name ){
                                $author = ' - <small>'. esc_attr__( $author_name ) .'</small></small>';
                            }
                            if ( $show_story_date == true) {
                                $html .= '<time class="timeline-time" datetime="' . esc_attr__( $posted_date )  . '"><span class="custom_story_date_'.esc_attr( $p_id ).'">' . esc_attr__( $posted_date, 'ultimate-timeline' ) . '</span></time>';
                            }

                            $html .= '<div class="timeline-icon custom_story_icon_'.esc_attr( $p_id ).'">
                                '. $story_icon .'
                            </div>
        
                            <div class="timeline-label">
                            <h2 class="custom_story_title_'.esc_attr( $p_id ).'">' . esc_html( get_the_title( $p_id ) ) . '' . $author . '</h2>';
                            if ( $show_story_image ){
                                $image_url = ! empty( wp_get_attachment_url( esc_attr__( $story_image_id )) ) ? wp_get_attachment_url( esc_attr__( $story_image_id ) ) : WEBLIZAR_TIMELINE_URL.'assets/images/no-image.png';
                                $html .='<div class="card custom_image_card_box_'.esc_attr( $p_id ).'">
                                    <div class="card-body">
                                        <img src="'.esc_url( $image_url ) .'" class="img-responsive img-rounded full-width timeline_image_'.esc_attr( $p_id ).'">                         
                                    </div>
                                </div>';
                            }

                            $html .= '
                                <p class="custom_story_p_'.esc_attr( $p_id ).'">'. wp_kses_post( $story_content ) .'</p>
                            </div>
                           ';
           $html .=  '</div>
        </article>';

            if ( $i == $total_stories - 1){
                $html .= '<article class="timeline-entry begin">
                    <div class="timeline-entry-inner">
                        <div class="timeline-icon">
                            <i class="fa fa-info-circle timeline_end_icon"></i>
                        </div>
                         <span class="timeline_end_span">'. esc_attr__('END', 'ultimate-timeline' ).'</span>
                    </div>
                </article>';
            }
            $story_content = '';
            $i++;
        endwhile;
        wp_reset_postdata();
    } else {
        $html .= '<div class="no-content"><h4>';
        $html .= esc_attr__('Sorry,You have not added any story yet', 'weblizar-timeline');
        $html .= '</h4></div>';
    }
    ?>
<div class="container weblizar_timeline_container">
    <?php if( $timeline_title !== '' ): ?>
        <h4 class="text-center mt-0 mb-5 text-light text-uppercase">
            <?php echo esc_attr__( $timeline_title ) ?>
        </h4>
    <?php endif; ?>
    <div class="row">
        <div class="timeline-centered">
            <?php echo $html ?>
        </div>
    </div>
</div>
