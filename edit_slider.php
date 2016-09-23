<?php

	include_once 'slider_functions.php';

	$post_id = isthisanewslider();

	
	if(isset($_POST['update'])) {
		
		//var_dump($_POST);
	  	if($_POST) { 
	  			$post_id = $_POST['slider_id']; 
	  	}

	  	update_post_meta($post_id,'Slider_Name',$_POST['title']);
	  	update_post_meta($post_id,'Slider_Delay',$_POST['delay']);
	  	update_post_meta($post_id,'Slider_State',$_POST['state']);
	  	update_post_meta($post_id,'Slider_Height',$_POST['height']);
	  	update_post_meta($post_id,'Slider_Width',$_POST['width']);
	  	update_post_meta($post_id,'Slider_Effect',$_POST['effect']);
	  	update_post_meta($post_id,'Slider_Bgcolor',$_POST['bgcolor']);
	  	update_post_meta($post_id,'Slider_Width_Metric',$_POST['width_metric']);
	  	if (isset($_POST['autoplay'])) {'';
	  		update_post_meta($post_id,'Slider_Play',$_POST['autoplay']);
	  	} else {
	  		update_post_meta($post_id,'Slider_Play','false');
	  	}
	  	update_post_meta($post_id,'Slider_Height_Metric',$_POST['height_metric']);
	
	}


	if(isset($_POST['save_slides'])) {
		/*echo '</br>';
		echo '<pre>';
		var_dump($_POST);*/
		
		$len = (sizeof($_POST['counter']))? sizeof($_POST['counter']) : sizeof($_POST['content']);
		$temp_array = array(array());
		for($i=0;$i<$len;$i++) {
			$index = ($_POST['index'][$i]=="")? $i : trim($_POST['index'][$i]);
			if($index!=$i) {
					$temp_array['slide_content'][$index] = $_POST['slide_content'][$i];
					$temp_array['image_upload'][$index] = ($_POST['image_upload'][$i])? $_POST['image_upload'][$i] : '';
					$temp_array['image_height'][$index] = ($_POST['image_height'][$i])? $_POST['image_height'][$i] : '';
					$temp_array['image_position'][$index] = ($_POST['image_position'][$i])? $_POST['image_position'][$i] : '';
					$temp_array['text_position'][$index] = ($_POST['text_position'][$i])? $_POST['text_position'][$i] : '';
					$temp_array['position_bottom'][$index] = ($_POST['position_bottom'][$i])? $_POST['position_bottom'][$i] : 0;
					$temp_array['color'][$index] = $_POST['color'][$i];
					$temp_array['bgcolor'][$index] = $_POST['bgcolor'][$i];
					//$temp_array['effect'][$index] = $_POST['effect'][$i];
					//$temp_array['height'][$index] = $_POST['height'][$i];
					$temp_array['width'][$index] = $_POST['width'][$i];
					$temp_array['width_metric'][$index] = $_POST['width_metric'][$i];
					$temp_array['delay'][$index] = $_POST['delay'][$i];
					$temp_array['slide_upload'][$index] = ($_POST['slide_upload'][$i])? $_POST['slide_upload'][$i] : '';
					$temp_array['index'][$index] = $index;
			} else{
					$temp_array['slide_content'][$i] = $_POST['slide_content'][$i];
					$temp_array['image_upload'][$i] = ($_POST['image_upload'][$i])? $_POST['image_upload'][$i] : '';
					$temp_array['image_height'][$i] = ($_POST['image_height'][$i])? $_POST['image_height'][$i] : '';
					$temp_array['image_position'][$i] = ($_POST['image_position'][$i])? $_POST['image_position'][$i] : '';
					$temp_array['text_position'][$i] = ($_POST['text_position'][$i])? $_POST['text_position'][$i] : '';
					$temp_array['position_bottom'][$i] = ($_POST['position_bottom'][$i])? $_POST['position_bottom'][$i] : 0;
					$temp_array['bgcolor'][$i] = $_POST['bgcolor'][$i];
					$temp_array['color'][$i] = $_POST['color'][$i];
					//$temp_array['effect'][$i] = $_POST['effect'][$i];
					//$temp_array['height'][$i] = $_POST['height'][$i];
					$temp_array['width'][$i] = $_POST['width'][$i];
					$temp_array['width_metric'][$i] = $_POST['width_metric'][$i];
					$temp_array['delay'][$i] = $_POST['delay'][$i];
					$temp_array['slide_upload'][$i] = ($_POST['slide_upload'][$i])? $_POST['slide_upload'][$i] : '';
					$temp_array['index'][$i] = $index;
				}
		}
		if(is_array($temp_array)) {
			$temp_array_len = count($temp_array['slide_content']);
		
			if(get_post_meta($post_id,'Slides_Array')) {
				
				$prev_count = get_post_meta($post_id,'Slides_Array_Count',true);
				$new_index = ($prev_count + $temp_array_len)-1;
				$prev_array = get_post_meta($post_id,'Slides_Array',true);
				update_post_meta($post_id,'Slides_Array',$temp_array,$prev_array);
				update_post_meta($post_id,'Slides_Array_Count',$temp_array_len);
				
				}else {
					add_post_meta($post_id,'Slides_Array',$temp_array);
					add_post_meta($post_id,'Slides_Array_Count',$temp_array_len);
				}
		}
	}
 ?>

	<div class="bshift">
		<img src="<?php echo plugin_dir_url(__FILE__); ?>/img/banner_brafton.jpg" class="bshift-admn-banner">
		<form action=" " class="row gen-settings-form" method="post">
			<div class="col-md-3">
				<h4>TITLE</h4>
				<input type="text" name="title" value="<?php echo get_post_meta($post_id,'Slider_Name',true); ?>"></input></br>
				<h4>HEIGHT</h4>
				<input type="text" name="height" value="<?php echo get_post_meta($post_id,'Slider_Height',true); ?>"></input>
				<select name="height_metric" class="metric">
					<?php
				    $selected_metric = get_post_meta($post_id,'Slider_Height_Metric',true);
					?>
					<option value="px" <?php if($selected_metric == 'px'){echo("selected");}?>>Pixels</option>
					<option value="%" <?php if($selected_metric == '%'){echo("selected");}?>>Percent</option>
				</select></br>
			</div>
			<div class="col-md-3">
				<h4>DELAY</h4>
				<input type="text" name="delay" value="<?php echo get_post_meta($post_id,'Slider_Delay',true); ?>"></input></br>
				<h4>WIDTH</h4>
				<input type="text" name="width" value="<?php echo get_post_meta($post_id,'Slider_Width',true); ?>"></input>
				<?php
				    $selected_metric = get_post_meta($post_id,'Slider_Width_Metric',true);
				?>
				<select name="width_metric" class="<?php echo $selected_metric; ?> metric">
					<option value="px" <?php if($selected_metric == 'px'){echo("selected");}?>>Pixels</option>
					<option value="%" <?php if($selected_metric == '%'){echo("selected");}?>>Percent</option>
				</select></br>
			</div>
			<div class="col-md-3">
				<h4>STATE</h4>
				<?php $selected_state = get_post_meta($post_id,'Slider_State',true); ?>
				<select name="state">
					<option value="draft" <?php if($selected_state == 'draft'){echo("selected");}?>>Draft</option>
					<option value="published" <?php if($selected_state == 'published'){echo("selected");}?>>Published</option>
					<option value="pending" <?php if($selected_state == 'pending'){echo("selected");}?>>Pending</option>
				</select></br>
				<h4>EFFECT</h4>
				<?php $selected_effect = get_post_meta($post_id,'Slider_Effect',true); ?>
				<select name="effect" >
					<option value="fader" <?php if($selected_effect == 'fade'){echo("selected");}?>>Fade</option>
					<option value="slide_vertical" <?php if($selected_effect == 'slide_vertical'){echo("selected");}?>>Slide Vertical</option>
					<option value="slide_left" <?php if($selected_effect == 'slide_left'){echo("selected");}?>>Slide Left</option>
					<option value="slide_right" <?php if($selected_effect == 'slide_right'){echo("selected");}?>>Slide Right</option>
					<option value="toggle" <?php if($selected_effect == 'toggle'){echo("selected");}?>>Standard Toggle</option>
					<option value="rotate" <?php if($selected_effect == 'rotate'){echo("selected");}?>>Invert</option>
				</select>
			</div>
			<div class="col-md-3">
				<h4>Background Color</h4><input type="text" class="jscolor" name="bgcolor" value="<?php echo get_post_meta($post_id,'Slider_Bgcolor',true); ?>"></br>
				<input type="hidden" name="update"></input>
				<h4 style="display: inline;">Autoplay</h4>
				<?php $autoplay = get_post_meta($post_id,'Slider_Play',true); ?>
				<input type="checkbox" name="autoplay" value="true" <?php if($autoplay=='true') { echo "checked"; } ?>></input></br>
				<h4>Shortcode: [bshift id="<?php echo $post_id; ?>"]</h4>
				<input type="submit" value="update slider" class="update_slider"></input>
				<input type="hidden" name="slider_id" value="<?php echo $post_id; ?>">
			</div>
			
		</form>

	</div>
		<?php if(sizeof(get_post_meta($post_id,'Slides_Array',true))=="1") : ?>
			<!--<h3 class="add_slide_btn add_new_slide" id="new_slide" data-pid="<?php echo $post_id; ?>">Add Slide</h3>-->
		<?php endif; ?>
		<form action="admin.php?page=edit_slider&slider_id=<?php echo $post_id; ?>" method="post" id="slides" class="<?php echo $post_id; ?>" data-slide-count="<?php echo get_post_meta($post_id,'Slides_Array_Count',true); ?>">
			<input type="hidden" name="pid" value="<?php echo $post_id; ?>" />
			<?php if(get_post_meta($post_id,'Slides_Array',true)) : ?>
				<input type="hidden" name="visible" value="0" />
			<?php endif; ?>
			
			<ul>

			<?php 	$overAllData = get_post_meta($post_id);
					if(get_post_meta($post_id,'Slides_Array',true)) : ?>
				
				<?php 	
                        
                        $new_array = array(array());
						
						$count = get_post_meta($post_id,'Slides_Array_Count',true);
						$new_array = get_post_meta($post_id,'Slides_Array',true);
                        $slides = array();
                        
                        foreach($new_array as $item => $subArray){
                            for($i=0;$i<$count;++$i){
                                if(!count($subArray)){
                                    continue;
                                }
                                
                                $slides[$i][$item] = $subArray[$i];
                            }
                        }
                        
                        
                        
						 for($i=0;$i<$count;$i++) { 
                                indiSlide($slides[$i], $overAllData);
    
                         } 
                ?>

			<?php endif; ?>
			<li style="display: inline-block; vertical-align: bottom;"><h2 class="add_new_slide" data-pid="<?php echo $post_id; ?>"> + </h2> </li>
			<li style="display: inline-block; vertical-align: bottom;"><input style="" value="save/edit" class="btn_save" type="submit"></li>
			</ul>
			<input type="hidden" name="save_slides" data-slide-status="" />
			
		</form>