<?php

  if ( ! class_exists( 'WCT_Fa_Icons' ) ) {

    class WCT_Fa_Icons {

      var $icons;

      var $screens;

      public function __construct()
      {
        // generate the icon array
        $this->wct_generate_icon_array();

        // Set screens
        $this->screens = array('weblizar_timeline');
        add_action('init', array($this, 'wct_fa_init'));

        // Load scripts and/or styles in the front-end
        add_action('wp_enqueue_scripts', array($this, 'wct_front_scripts'));
        // These should only be loaded in the admin, and for users that can edit posts
        if ( is_admin() ) {
          // Load up the metabox
          add_action('add_meta_boxes', array($this, 'wct_metabox'));
          // Saves the data
          add_action('save_post', array($this, 'wct_save'));
          // Load up plugin styles and scripts
          add_action('admin_enqueue_scripts', array($this, 'wct_ss'));
          // Add a pretty font awesome modal
       //   add_action('admin_footer', array($this, 'wctl_modal'));
        }
      }

      public function wct_front_scripts() {
        if ( apply_filters( 'fa_field_load_styles', true ) ) {
          wp_enqueue_style( 'font-awesome', WEBLIZAR_TIMELINE_URL . 'css/font-awesome/css/font-awesome.min.css' );
        }
      }

      public function wct_ss() {
        // only load the styles for eligable post types
        if ( in_array( get_current_screen()->post_type, $this->screens ) ) {
            require_once WEBLIZAR_TIMELINE_DIR.'includes/helpers/wct-helper.php';
          $postType = WeblizarTimelineHelper::wtlfree_get_ctp();
         
          if( $postType=="weblizar_timeline" ){
          // load up font awesome
          wp_enqueue_style( 'fa-field-fontawesome-css', WEBLIZAR_TIMELINE_URL . 'includes/fa-icons/css/font-awesome/css/all.min.css' );
          wp_enqueue_style('wct-font-shims','https://use.fontawesome.com/releases/v5.7.2/css/v4-shims.css');
          // load up plugin css
          wp_enqueue_style( 'fa-field-css', WEBLIZAR_TIMELINE_URL . 'includes/fa-icons/css/fa-field.css' );
          // load up plugin js
          wp_enqueue_script( 'fa-field-js', WEBLIZAR_TIMELINE_URL . 'includes/fa-icons/js/fa-field.js', array( 'jquery' ) );
          }
        }
      }

      public function wct_metabox() {
        $screens=array('weblizar_timeline');
        foreach ( $screens as $screen ) {
          add_meta_box( 'fa_field', esc_attr__( 'Select Story Icon', 'ultimate-timeline' ), array(
            $this,
            'wct_populate_metabox'
          ), $screen, 'side','high' );
        }
      }

      public function wct_populate_metabox( $post ) {
        $icon = get_post_meta( $post->ID, 'fa_field_icon', true );
        ?>
        <div class="fa-field-metabox">
          <div class="fa-field-current-icon">
            <div class="icon">
              <?php 
              if ( $icon ) : 
                if( strpos( $icon, '-o' ) !== false){
                  $icon = "fa ".$icon;
                }else if( strpos( $icon, 'fas' ) !== false || strpos( $icon, 'fab' ) !==false ) {
                  $icon = $icon;
                }else{
                  $icon = "fa ".$icon;
                } 
                ?>
                <i class="<?php echo esc_attr( $icon ); ?>"></i>
              <?php endif; ?>
            </div>
            <div class="delete <?php echo esc_attr( $icon ) ? 'active' : ''; ?>">&times;</div>
          </div>
          <input type="hidden" name="fa_field_icon" id="fa_field_icon" value="<?php echo esc_attr( $icon ); ?>">
          <?php wp_nonce_field( 'fa_field_icon', 'fa_field_icon_nonce' ); ?>

          <button class="button-primary add-fa-icon"><?php esc_attr__( 'Add Icon', 'ultimate-timeline' ); ?></button>
        </div>
        <div class="fa-field-modal" id="fa-field-modal">
          <div class="fa-field-modal-close">&times;</div>
          <h1 class="fa-field-modal-title"><?php _e( 'Select Font Awesome Icon', 'ultimate-timeline' ); ?></h1>
         <div class="icon_search_container">
          <input type="text" id="searchicon" onkeyup="wctSearchIcon()" placeholder="<?php esc_attr__('Search Icon..') ?>">
           </div>
          <div id="wct_icon_wrapper" class="fa-field-modal-icons">
            <?php if ( $this->icons ) : ?>
              <?php foreach ( $this->icons as $icon ) : ?>
                <div class="fa-field-modal-icon-holder" data-icon="<?php echo esc_attr( $icon['class'] ); ?>">
                  <div class="icon">
                    <i  data-icon-name="<?php echo esc_attr( $icon['class'] ); ?>" class="<?php echo esc_attr( $icon['class'] ); ?>"></i>
                  </div>
                </div>
              <?php endforeach; ?>

            <?php endif; ?>
          </div>
        </div>       
      <?php
      }

      public function wct_save( $post_id ) {
       if ( get_post_type( $post_id ) != "weblizar_timeline" ) {
          return;
        }
        if ( isset( $_POST['fa_field_icon_nonce'] ) && ! wp_verify_nonce( $_POST['fa_field_icon_nonce'], 'fa_field_icon' ) ) {
          return;
        }
        if ( isset( $_POST['fa_field_icon'] ) ) {
          update_post_meta( $post_id, 'fa_field_icon',sanitize_text_field( $_POST['fa_field_icon'] ) );
        }
      }

      public function instance() {
        return new self();
      }

      private function wct_generate_icon_array() {
          $icons = get_option( 'fa_icons' );
          if ( ! empty( $icons ) ) {
              require_once WEBLIZAR_TIMELINE_DIR.'includes/fa-icons/includes/fa-icons-array.php';
              foreach ( $all_icons as $icon ) {
                  $icons[] = array( 'class' => $icon );
              }
              update_option( 'fa_icons', $icons );
          }
          return $icons;
      }
    
  }
}