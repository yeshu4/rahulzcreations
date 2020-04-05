<?php
/*
Plugin Name:Multi Item Responsive Slider 
Description:Its jQuery slider specifically designed for displaying multiple images
Version:1.0
Author:Naveenkumar C
License:GPL2
 
Copyright 2014-2016 Naveenkumar C (email: cnaveen777 at gmail.com)

This program is free software; you can redistribute it and/or modify
it under the terms of the GNU General Public License as published by
the Free Software Foundation; either version 2 of the License, or
(at your option) any later version.

This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
GNU General Public License for more details.

You should have received a copy of the GNU General Public License
along with this program; if not, write to the Free Software
Foundation, Inc., 59 Temple Place, Suite 330, Boston, MA  02111-1307  USA
*/
// Exit you access directly
defined( 'ABSPATH' ) or die( 'No script kiddies please!' );

add_theme_support('post-thumbnails');
add_image_size( 'mislider_image', 360, 360, true );

function mislider_register_post_type(){
	
	$singular = "Slide";
	$Plural = "Slider";
	$menuname = "Mislider";
	
	$labels = array(
		'name'               =>	$Plural,
		'singular_name'      => $singular,
		'menu_name'          => $menuname,
		'name_admin_bar'     => $singular,
		'add_new'            => 'Add New',
		'add_new_item'       => 'Add New ' .$singular,
		'new_item'           => 'New '. $singular,
		'edit_item'          => 'Edit '. $singular,
		'view_item'          => 'View '. $singular,
		'all_items'          => 'All '. $Plural,
		'search_items'       => 'Search'. $Plural,
		'parent_item_colon'  => 'Parent'. $Plural.':',
		'not_found'          => 'No '. $Plural.'found.',
		'not_found_in_trash' => 'No '. $Plural.' found in Trash.'
	);

	$args = array(
		'labels'             => $labels,
        'description'        => __( 'Description.', 'your-plugin-textdomain' ),
		'public'             => true,
		'publicly_queryable' => true,
		'show_ui'            => true,
		'show_in_menu'       => true,
		'menu_icons'		 => 'dashicons-awards',
		'query_var'          => true,
		'rewrite'            => array( 'slug' => 'mislider' ),
		'capability_type'    => 'post',
		'has_archive'        => true,
		'hierarchical'       => false,
		'menu_position'      => null,
		'supports'           => array( 'title', 'editor', 'author', 'thumbnail', 'excerpt', 'comments' )
	);	
	register_post_type('mislider',$args);
}
add_action('init', 'mislider_register_post_type');


// Adding slider setting page
add_action( 'admin_menu', 'mislider_setting' ); 


// Slider setting page function 
function mislider_setting() {
	add_options_page( 'Mislider Options', 'Mislider Settings', 'manage_options', 'mioptions.php', 'mislider_option_setting');
}


add_action( 'admin_init', 'mislider_options_init' );
function mislider_options_init(){
	register_setting( 'mislider_opt', 'mislider_options', 'intval' );
}


function mislider_option_setting(){	
	require_once('mioptions.php');
}

function mislider_css_and_js() {	

	wp_enqueue_script('jquery');

	wp_register_script( 'mislider_modernizr-custom_js', plugin_dir_url( __FILE__ ) . 'js/modernizr-custom.js' );
	wp_enqueue_script('mislider_modernizr-custom_js');
	
	wp_register_script( 'mislider_misliderjs', plugin_dir_url( __FILE__ ) . 'js/mislider.js' );
	wp_enqueue_script('mislider_misliderjs');

	wp_register_style( 'mislider_css',  plugin_dir_url( __FILE__ ) . 'css/misliderstyles.css' );
	wp_enqueue_style('mislider_css');
}
add_action( 'wp_enqueue_scripts', 'mislider_css_and_js' );

function mislider(){
?>
<div class="mis-stage">
	<ol class="mis-slider">
		<?php			
		global $post; 
		$args = array( 'numberposts' => -1, 'post_type' => 'mislider');
		$myposts = get_posts( $args );
		foreach( $myposts as $post ) { setup_postdata($post);                        
		?>
		<li class="mis-slide">
			<a href="#" class="mis-container">
				<figure>
					<?php the_post_thumbnail('mislider_image',array('class'=>'img-responsive')); ?>
					<figcaption><?php the_title(); ?></figcaption>
				</figure>
			</a>
		</li>
		<?php } ?>
	</ol>
</div>
<script type="text/javascript">
<?php
	$set_stageHeight	=	get_option('stageHeight', $stageHeight);
	$set_slidesOnStage	=	get_option('slidesOnStage', $slidesOnStage);
	$set_slidePosition	=	get_option('slidePosition', $slidePosition);
	$set_slideStart		=	get_option('slideStart', $slideStart);
	$set_slideScaling	=	get_option('slideScaling', $slideScaling);
	$set_offsetV		=	get_option('offsetV', $offsetV);
	$set_centerV		=	get_option('centerV', $centerV);
	$set_navButtons		=	get_option('navButtonsOpacity', $navButtons);
?>
jQuery(function (jQuery) {
	var slider = jQuery('.mis-stage').miSlider({
		stageHeight:<?php if ( isset( $set_stageHeight ) ) { echo $set_stageHeight; } else { echo "380"; } ?>,
		slidesOnStage:<?php if ( isset( $set_slidesOnStage ) ) { echo $set_slidesOnStage; } else { echo "false"; } ?>,
		slidePosition:'<?php if ( isset( $set_slidePosition ) ) { echo $set_slidePosition; } else { echo "center"; } ?>',
		slideStart:'<?php if ( isset( $set_slideStart ) ) { echo $set_slideStart; } else { echo "mid"; } ?>',
		slideScaling:<?php if ( isset( $set_slideScaling ) ) { echo $set_slideScaling; } else { echo "150"; } ?>,
		offsetV:<?php if ( isset( $set_offsetV ) ) { echo $set_offsetV; } else { echo "-5"; } ?>,
		centerV:<?php if ( isset( $set_centerV ) ) { echo $set_centerV; } else { echo "true"; } ?>,
		navButtonsOpacity:<?php if ( isset( $set_navButtons ) ) { echo $set_navButtons; } else { echo "1"; } ?>
	});
});
</script>
<?php } ?>
<?php add_shortcode( 'mislider_display', 'mislider' ); ?>