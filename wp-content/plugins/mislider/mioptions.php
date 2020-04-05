<?php
	if( isset($_REQUEST['submit']) && $_REQUEST['submit'] == "Save Changes" ){
		
		$stageHeight 	=	intval((!empty($_REQUEST['options']['stageHeight'])) ? $_REQUEST['options']['stageHeight'] : 380 );
		$slidesOnStage	=	sanitize_text_field((!empty($_REQUEST['options']['slidesOnStage'])) ? $_REQUEST['options']['slidesOnStage'] : false );
		$slidePosition	=	sanitize_text_field((!empty($_REQUEST['options']['slidePosition'])) ? $_REQUEST['options']['slidePosition'] : center );
		$slideStart		=	sanitize_text_field((!empty($_REQUEST['options']['slideStart'])) ? $_REQUEST['options']['slideStart'] : mid );
		$slideScaling	=	intval((!empty($_REQUEST['options']['slideScaling'])) ? $_REQUEST['options']['slideScaling'] : 150 );
		$offsetV		=	intval((!empty($_REQUEST['options']['offsetV'])) ? $_REQUEST['options']['offsetV'] : -5 );
		$centerV		=	sanitize_text_field((!empty($_REQUEST['options']['centerV'])) ? $_REQUEST['options']['centerV'] : true );
		$navButtons		=	absint((!empty($_REQUEST['options']['navButtonsOpacity'])) ? $_REQUEST['options']['navButtonsOpacity'] : 1 );
		
		update_option( 'stageHeight', $stageHeight, 'yes' );
		update_option( 'slidesOnStage', $slidesOnStage, 'yes' );
		update_option( 'slidePosition', $slidePosition, 'yes' );
		update_option( 'slideStart', $slideStart, 'yes' );
		update_option( 'slideScaling', $slideScaling, 'yes' );
		update_option( 'offsetV', $offsetV, 'yes' );
		update_option( 'centerV', $centerV, 'yes' );
		update_option( 'navButtonsOpacity', $navButtons, 'yes' );
		
	}	
?>
<style>
form#mislidersetting .textbold { font-weight:bold; font-size: 14px; padding:10px; letter-spacing:0.7px;}
form#mislidersetting .textlight { opacity:0.5; font-size:12px;}
form#mislidersetting select.mislider-options { width:192px;}
</style>
<form method="post" action="<?php echo $_SERVER['REQUEST_URI'];?>" name="mislidersetting" id="mislidersetting">
	<input type="hidden" name="page" value="mioptions.php" />
	<?php settings_fields( 'mislider_opt' ); ?>
	<?php do_settings_sections( 'mislider_options' ); ?>
	<table width="100%" cellspacing="5" cellpadding="5">	
		<tr>
			<td colspan="3"><h3>MiSlider Settings</h3></td>
		</tr>
		<tr>
			<td width="12%" class="textbold">Height of the stage</td>
			<td width="2%" class="textlight"> : </td>
			<td width="10%"><input type="text" class="mislider-options" name="options[stageHeight]" value="<?php echo get_option('stageHeight', $stageHeight);  ?>" maxlength="3" required /></td>
			<td class="textlight"> * The height of the stage in px. Options: false or positive integer. false = height is calculated using maximum slide heights. Default: false</td>
		</tr>
		<tr>
			<td class="textbold">Number of slides</td>
			<td class="textlight"> : </td>
			<td><input type="text" class="mislider-options" name="options[slidesOnStage]" value="<?php echo get_option('slidesOnStage', $slidesOnStage); ?>" required /></td>
			<td class="textlight"> * Number of slides visible at one time. Options: false or positive integer. false = Fit as many as possible.  Default: 1</td>
		</tr>
		<tr>
			<td class="textbold">Current slide position</td>
			<td class="textlight"> : </td>
			<td>
				<select class="mislider-options" name="options[slidePosition]">
					<option value="left" <?php if( get_option('slidePosition', $slidePosition ) == 'left' ) { echo "selected"; }  ?>>left</option>
					<option value="center" <?php if( get_option('slidePosition', $slidePosition) == 'center' ) { echo "selected"; }  ?> >center</option>
					<option value="right" <?php if( get_option('slidePosition', $slidePosition) == 'right' ) { echo "selected"; }  ?>>right</option>
				</select>
			</td>
			<td class="textlight"> * The location of the current slide on the stage. Options: 'left', 'right', 'center'. Defualt: 'left'</td>
		</tr>
		<tr>
			<td class="textbold">Slide to start on</td>
			<td class="textlight"> : </td>
			<td>
				<select class="mislider-options" name="options[slideStart]">
					<option value="beg" <?php if( get_option('slideStart', $slideStart) == 'beg' ) { echo "selected"; }  ?>>beg</option>
					<option value="mid" <?php if( get_option('slideStart', $slideStart) == 'mid' ) { echo "selected"; }  ?>>mid</option>
					<option value="end" <?php if( get_option('slideStart', $slideStart) == 'end' ) { echo "selected"; }  ?>>end</option>
				</select>
			<td class="textlight"> * The slide to start on. Options: 'beg', 'mid', 'end'. Defualt: 'beg'</td></tr>
		<tr>
			<td class="textbold">Scaling factor</td>
			<td class="textlight"> : </td>
			<td><input type="text" class="mislider-options" name="options[slideScaling]" value="<?php echo get_option('slideScaling', $slideScaling); ?>" required /></td>
			<td class="textlight"> * The relative percentage scaling factor of the current slide - other slides are scaled down. Options: positive number 100 or higher. 100 = No scaling. Defualt: 100</td>
		</tr>
		<tr>
			<td class="textbold">Vertical offset</td>
			<td class="textlight"> : </td>
			<td><input type="text" class="mislider-options" name="options[offsetV]" value="<?php echo get_option('offsetV', $offsetV); ?>" required /></td> 
			<td class="textlight"> * The vertical offset of the slide center as a percentage of slide height. Options:  positive or negative number. Neg value = up. Pos value = down. 0 = No offset. Default: 0</td>
		</tr>
		<tr>
			<td class="textbold">Center slide</td>
			<td class="textlight"> : </td>
			<td><input type="text" class="mislider-options" name="options[centerV]" value="<?php echo get_option('centerV', $centerV); ?>" required /> </td> 
			<td class="textlight"> * Center slide contents vertically - Boolean. Default: false </td>
		</tr>
		<tr>
			<td class="textbold">Nav Buttons</td>
			<td class="textlight"> : </td>
			<td><input type="text" class="mislider-options" name="options[navButtonsOpacity]" value="<?php echo get_option('navButtonsOpacity', $navButtons); ?>" maxlength="2" required /></td>
			<td class="textlight"> * Opacity of the prev and next button navigation when not transitioning. Options: Number between 0 and 1. 0 (transparent) - 1 (opaque). Default: .5</td>
		</tr>
		<tr>
			<td colspan="4"><?php submit_button(); ?></td>
		</tr>
	</table>
</form>