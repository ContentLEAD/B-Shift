<?php

function slider($arg){
    
    ?>
    <div class="b-current">
   <div class="slide-preview">
      <div class="inner_prev">
         <div style="position: relative; top: 50%; transform: translateY(-50%);">
            <div class="option-a" id="text-frame">
            </div>
            <div class="option-b" id="image_frame"><img src="" id="inner-image" />
            </div>
         </div>
      </div>
   </div>
   <h4 class="slide_label">Content</h4>
   <textarea hidden="false" class="bshift-editor wp-editor-area" style="height: 182px;" autocomplete="off" cols="40" name="slide_content[]"></textarea>
   <div class="bshift-form-element"><input id="image_url" class="slide_input image_url" name="slide_upload[]" value="" type="text" /><input class="upload_image_button" value="Add Background" data-target="brafton-end-button-preview" type="button" /><br/></div>
   <div class="bshift-form-element">
      <h4 style="display:inline">Image Height</h4>
      <input type="text" id="image-height" name="image_height[]" class="slide_input ih" onchange="imageHeight(this.value)"/>
   </div>
   <div class="bshift-form-element">
      <h4 style="display:inline">Image Position</h4>
      <select name="image_position[]" class="ip" id="image_position" onchange="shiftImage(this.value);">
         <option value="center" >Center</option>
         <option value="left" >Left</option>
         <option value="right" >Right</option>
      </select>
   </div>
   <div class="bshift-form-element">
      <h4>Text Position</h4>
      <select name="text_position[]" class="tp" onchange="shiftText(this.value)">
         <option value="left">Left</option>
         <option value="right">Right</option>
         <option value="none">Center</option>
      </select>
      <br/>
   </div>
   <div class="bshift-form-element">
      <h4>Image Bottom Adjustment</h4>
      <input type="text" name="position_bottom[]" class="slide_input btm" value=""/>%<br/>
   </div>
   <div class="bshift-form-element"><input id="inner-image-url" class="slide_input image_url" name="image_upload[]" type="text" onchange="showImage(this.value)" ><input class="upload_image_button" data-role="dynamic_image" value="Add Image" data-target="slide-button-preview" type="button"></div>
   <div class="bshift-form-element">
      <h4 id="color_label">Content Color</h4>
   </div>
   <div class="bshift-form-element">
      <h4>Width</h4>
      <input type="text" name="width[]" class="slide_width" value="" /><br/>
      <select name="width_metric[]" class="slide_width_metric">
         <option value="px" class="slide_width_metric_px" selected="">Pixels</option>
         <option value="%" class="slide_width_metric_pc" selected="">Percent</option>
      </select>
      <br/>
   </div>
   <div class="bshift-form-element">
      <h4>Delay</h4>
      <input type="text" name="delay[]" value="" class="slide_delay" >
   </div>
   <!--<div class="bshift-form-element"><h4>Effect</h4><select name="effect[]" class="slide_effect"><option value="fader">Fade</option><option value="slide_vertical">Slide Vertical</option><option value="slide_left">Slide Left</option><option value="slide_right">Slide Right</option><option value="toggle">Standard Toggle</option></select>
      </div>-->
   <div class="bshift-form-element">
      <h4>Index</h4>
      <input type="text" name="index[]" class="slide_index" style="display: block;">
   </div>
   <img src="../wp-content/plugins/B-Shift/img/delete-512.png" data-ref="0" class="delete_slide" title="Delete this slide."/><input type="hidden" name="counter[]">
</div>
    <?php
}
function dynamicNewSlide(){
    $master = get_post_meta($post_id);
    $master['totalSlides'] = 3;
    indiSlide(null, $master);
}
function indiSlide($slide = null, $master = null){ 
    if($slide === null){
        $defaults = (
            "index" => $master['totalSlides'];
            "background"    => '',
        )
            $slide = $defaults;
    }
    // $slide['index'] will replace $i;
    extract($slide);
    
    ?>
    
    								<li style="display: inline-block; vertical-align: top;"><h2 class="<?php if($index==0) { echo 'slide_title engaged'; } else { echo 'slide_title';} ?>">Slide <?php echo $index+1; ?></h2>
								<div class="<?php if($i==0) { echo 'ib show_slide'; } else { echo 'ib collapse';} ?>">
									<div class="slide-preview" id="slide-preview-<?=$index ?>">
											<div style="color: #<?= $color; ?>; background-image: url('<?php echo $new_array['slide_upload'][$i]; ?>'); background-position: 0; background-size:cover; width: <?php echo $new_array['width'][$i]; ?><?php echo $new_array['width_metric'][$i]; ?>; height: <?php echo get_post_meta($post_id,'Slider_Height',true); ?><?php echo get_post_meta($post_id,'Slider_Height_Metric',true); ?>;padding: 0 5%;">
												<span class="slide-nav-left" data-direction="left"></span>
                    							<span class="slide-nav-right" data-direction="right"></span>
												<div style="position: relative; top: 50%; transform: translateY(-50%);">
													<div class="option-a" style="float: <?php echo $new_array['text_position'][$i]; ?>">
													<?php 
														echo html_entity_decode($new_array['slide_content'][$i]); 
															 
														?>
													</div>
													<div class="option-b" style="float: <?php echo $slide['image_position']; ?>; bottom: <?php $new_array['position_bottom'][$i]; ?> %;">
														
															<img src="<?php	echo $new_array['image_upload'][$i]? $new_array['image_upload'][$i] : '' ?>" class="inner-image-<?php echo $i; ?>" height="<?php echo $new_array['image_height'][$i]? $new_array['image_height'][$i] : 20; ?>px" width="auto" style="display: <?php echo $new_array['image_upload'][$i]? 'inline' : 'none'; ?>" />
														
														
													</div>	
												</div>
											</div>
										</div>
									<h4>Content</h4>
										<!--Slide editor is loaded here -->
										<?php
										$editor_id = 'slide_editor'.$i;
										$settings = array( 'media_buttons' => false, 'textarea_name'=> 'slide_content[]','editor_height'=>'75px','editor_class'=>'bshift-editor','editor_css'=>'<style>.wp-editor-wrap{width: 255px;}</style>');
										$content = ($new_array['slide_content'][$i])? $new_array['slide_content'][$i] : ' ';
										//$box = wp_editor( $content, $editor_id, $settings);
										
										?>
										<textarea class="slide_input bshift-editor" name="slide_content[]"><?php echo $content; ?></textarea>
									<div class="bshift-form-element">
									<h4>Image Height</h4>
									<input type="text" data-index = "<?php echo $i ?>" name="image_height[]" class="slide_input ih" value="<?php echo $new_array['image_height'][$i]; ?>"></input>pixels</br>
									</div>
									<div class="bshift-form-element">
									<h4>Image Position</h4>
									<?php $selected_position = ($new_array['image_position'][$i])? $new_array['image_position'][$i] : 'none'; ?>
										<select name="image_position[]" class="ip">
											<option value="left" <?php if($selected_position == 'left'){echo("selected");}?>>Left</option>
											<option value="right" <?php if($selected_position == 'right'){echo("selected");}?>>Right</option>
											<option value="none" <?php if($selected_position == 'none'){echo("selected");}?>>Center</option>
										</select></br>
									</div>
									<div class="bshift-form-element">
									<h4>Text Position</h4>
									<?php $selected_position = ($new_array['text_position'][$i])? $new_array['text_position'][$i] : 'none'; ?>
										<select name="text_position[]" class="tp">
											<option value="left" <?php if($selected_position == 'left'){echo("selected");}?>>Left</option>
											<option value="right" <?php if($selected_position == 'right'){echo("selected");}?>>Right</option>
											<option value="none" <?php if($selected_position == 'none'){echo("selected");}?>>Center</option>
										</select></br>
									</div>
									<div class="bshift-form-element">
									<h4>Image Bottom Adjustment</h4>
									<input type="text" name="position_bottom[]" class="slide_input btm" value="<?php echo ($new_array['position_bottom'][$i])? $new_array['position_bottom'][$i] : 0;  ?>"></input>%</br>
									</div>
									<div class="bshift-form-element">
									<input class="slide_input image_url_<?php echo $i; ?>" name="image_upload[]" value="<?php echo $new_array['image_upload'][$i]; ?>" type="text"></input>
									<input class="upload_image_button" value="Add Image" data-id="<?php echo $i; ?>" data-target="slide-button-preview" type="button"></input>
									</div>
									<div class="bshift-form-element">
									<h4>Content Color</h4><input type="text" class="jscolor slide_input" name="color[]" value=<?php echo $new_array['color'][$i];?>></br>
									</div>
									<div class="bshift-form-element">
									<h4>Width</h4>
										<input type="text" id="slide_width" class="slide_input" name="width[]" value="<?php echo $new_array['width'][$i];?>"></input>
										<?php $selected_metric = ($new_array['width_metric'][$i])? $new_array['width_metric'][$i] : get_post_meta($post_id,'Slider_Width_Metric',true); ?>
										<select name="width_metric[]" class="<?php echo $selected_metric; ?> metric">
											<option value="px" <?php if($selected_metric == 'px'){echo("selected");}?>>Pixels</option>
											<option value="%" <?php if($selected_metric == '%'){echo("selected");}?>>Percent</option>
										</select></br>
									</div>
									<!--<h4>Height</h4>
										<input type="text" class="slide_input" name="height[]" value="<?php echo $new_array['height'][$i]; ?>"></input>
										<?php $selected_metric = ($new_array['height_metric'][$i])? $new_array['height_metric'][$i] : get_post_meta($post_id,'Slider_Height_Metric',true); ?>
										<select name="height_metric[]" class="<?php echo $selected_metric; ?> metric">
											<option value="px" <?php if($selected_metric == 'px'){echo("selected");}?>>Pixels</option>
											<option value="%" <?php if($selected_metric == '%'){echo("selected");}?>>Percent</option>
										</select></br>-->
									<div class="bshift-form-element">
									<h4>Delay</h4>
										<input type="text" class="slide_input" name="delay[]" value="<?php echo $new_array['delay'][$i]; ?>"></input>
									</div>
									<div class="bshift-form-element" style="display: none;">
									<h4>Effect</h4>
										<?php $selected_effect = $new_array['effect'][$i]; ?>
									<select name="effect[]" class="slide_input">
										<option value="fader" <?php if($selected_effect == 'fader'){echo("selected");}?>>Fade</option>
										<option value="slide_vertical" <?php if($selected_effect == 'slide_vertical'){echo("selected");}?>>Slide Vertical</option>
										<option value="slide_left" <?php if($selected_effect == 'slide_left'){echo("selected");}?>>Slide Left</option>
										<option value="slide_right" <?php if($selected_effect == 'slide_right'){echo("selected");}?>>Slide Right</option>
										<option value="toggle" <?php if($selected_effect == 'toggle'){echo("selected");}?>>Standard Toggle</option>
										<option value="rotate" <?php if($selected_effect == 'rotate'){echo("selected");}?>>Invert</option>
									</select>
									</div>
									<div class="bshift-form-element">
									<h4>Index</h4>
										<input type="text" class="slide_input" name="index[]" value="<?php echo $i; ?>"></input>
									</div>
									<div class="bshift-form-element">
										<input class="slide_input image_url" name="slide_upload[]" value="<?php echo $new_array['slide_upload'][$i]; ?>" type="text"></input>
										<input class="upload_image_button" value="Add Background" data-target="slide-button-preview" type="button"></input>
									</div>
										<img src="<?php echo plugin_dir_url(__FILE__); ?>/img/delete-512.png" class="delete_slide" title="Delete this slide."/>
										<!--<img src="<?php echo plugin_dir_url(__FILE__); ?>/img/prev.png" class="b-preview" title="Preview this slide." />-->
										
										<!--<input type="submit" name="delete[]" value="delete slide" data-ref="<?php echo $i; ?>" class="delete_slide"></input>-->
										<input type="hidden" name="counter[]"></input>
										
								</div> <!--end .ib -->
							</li>
<?php
    
}