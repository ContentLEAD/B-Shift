<?php

function isthisanewslider(){
		if(isset($_POST['add_new_slider'])) {

			return get_the_id(); 
		} else {
			return isset($_GET['slider_id'])? $_GET['slider_id'] : $_POST['slider_id'];
		}
}

function indiSlide($slide = null, $master = null){ 
								    if($slide === null){
								    	//echo 'slide is null';
								    	//echo '<pre>';
								    	//var_dump($master['Slider_Width_Metric'][0]);
								        $defaults = array(
								            'index' => $master['Slides_Array_Count'][0]==null? 0 : $master['Slides_Array_Count'][0],
								            'slide_content'  => '',
								            'image_upload'  => '',
								            'image_height' => 50,
								            'image_position' => 'none',
								            'text_position' => 'none',
								            'position_bottom' => 0,
								            'color' => '',
								            'width' => $master['Slider_Width'][0] == null? 0 : $master['Slider_Width'][0],
								            'width_metric' => $master['Slider_Width_Metric'][0] == null? '%' : $master['Slider_Width_Metric'][0],
								            'delay' => $master['Slider_Delay'][0]==null? '' : $master['Slider_Delay'][0],
								            'slide_upload' => ''
								            
								        );
								        $slide = $defaults;								       
								    }
								    // $slide['index'] will replace $i;
								    extract($slide);
								    
								    
								    ?>
	    
	    							<li data-id="<?php echo $index; ?>" style="display: inline-block; vertical-align: top;"><h2 class="<?php if($index==0) { echo 'slide_title engaged'; } else { echo 'slide_title';} ?>">Slide <?php echo $index+1; ?></h2>
									<div id = "slide-<?php echo $index; ?>" class="<?php if($index==0) { echo 'ib show_slide'; } else { echo 'ib collapse';} ?>">
										<div class="slide-preview" id="slide-preview-<?=$index ?>">
												<div id="slide-preview-inner-<?=$index ?>" class="slide-preview-inner" style="color: #<?= $color; ?>; background-image: url('<?php echo $slide_upload; ?>'); background-position: 0; background-size:cover; width: <?php echo $width; ?><?php echo $width_metric; ?>; height: <?php echo $master['Slider_Height'][0]; ?><?php echo $master['Slider_Height_Metric'][0]; ?>;padding: 0 5%;">
													<span class="slide-nav-left" data-direction="left"></span>
	                    							<span class="slide-nav-right" data-direction="right"></span>
													<div style="position: relative; top: 50%; transform: translateY(-50%);">
														<div class="option-a" style="float: <?php echo $text_position; ?>">
														<?php 
															echo html_entity_decode($slide_content); 
																 
															?>
														</div>
														<div class="option-b" style="float: <?php echo $image_position; ?>; bottom: <?php $position_bottom; ?> %;">
															
																<img src="<?php	echo $image_upload ?>" class="inner-image-<?php echo $index; ?>" height="<?php echo $image_height; ?>px" width="auto" style="display: <?php echo $image_upload==''? 'inline' : 'none'; ?>" />
															
															
														</div>	
													</div>
												</div>
											</div>
										<h4 data-index = "<?= $index ?>">Content</h4>
											<!--Slide editor is loaded here -->
											<?php
											$editor_id = 'slide_editor'.$index;
											//$settings = array( 'media_buttons' => false, 'textarea_name'=> 'slide_content[]','editor_height'=>'75px','editor_class'=>'bshift-editor','editor_css'=>'<style>.wp-editor-wrap{width: 255px;}</style>');
	
											
											?>
											<textarea class="slide_input bshift-editor" name="slide_content[]"><?php echo $slide_content; ?></textarea>
										<div class="bshift-form-element">
										<h4>Image Height</h4>
										<input type="text" data-index = "<?php echo $index ?>" name="image_height[]" class="slide_input ih" value="<?php echo $image_height; ?>"></input>pixels</br>
										</div>
										<div class="bshift-form-element">
										<h4>Image Position</h4>
										
											<select name="image_position[]" class="ip">
												<option value="left" <?php if($image_position == 'left'){echo("selected");}?>>Left</option>
												<option value="right" <?php if($image_position == 'right'){echo("selected");}?>>Right</option>
												<option value="none" <?php if($image_position == 'none'){echo("selected");}?>>Center</option>
											</select></br>
										</div>
										<div class="bshift-form-element">
										<h4>Text Position</h4>
										
											<select name="text_position[]" class="tp">
												<option value="none" <?php if($text_position == 'none'){echo("selected");}?>>Center</option>
												<option value="left" <?php if($text_position == 'left'){echo("selected");}?>>Left</option>
												<option value="right" <?php if($text_position == 'right'){echo("selected");}?>>Right</option>					
											</select></br>
										</div>
										<div class="bshift-form-element">
										<h4>Image Bottom Adjustment</h4>
										<input type="text" name="position_bottom[]" class="slide_input btm" value="<?php echo $position_bottom;  ?>" />%</br>
										</div>
										<div class="bshift-form-element">
										<input class="slide_input image_url_<?php echo $index; ?>" name="image_upload[]" value="<?php echo $image_upload; ?>" type="text" />
										<input class="upload_image_button" value="Add Image" data-id="<?php echo $i; ?>" data-target="slide-button-preview" type="button"></input>
										</div>
										<div class="bshift-form-element">
										<h4>Content Color</h4><input type="text" class="jscolor jscolor-active slide_input" name="color[]" value=<?php echo $color;?>></br>
										</div>
										<div class="bshift-form-element">
										<h4>Width</h4>
											<input type="text" id="slide_width" class="slide_input" name="width[]" value="<?php echo $width; ?>" />
											
											<select name="width_metric[]" class="<?php echo $width_metric; ?> metric" value="<?php echo $width_metric; ?>" >
												<option value="px" <?php if($width_metric == 'px'){echo("selected");}?>>Pixels</option>
												<option value="%" <?php if($width_metric == '%'){echo("selected");}?>>Percent</option>
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
											<input type="text" class="slide_input" name="delay[]" value="<?php echo $delay; ?>"></input>
										</div>
										<div class="bshift-form-element" style="display: none;">
										<h4>Effect</h4>
											<?php $selected_effect = $master['effect']; ?>
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
											<input type="text" class="slide_input" name="index[]" value="<?php echo $index; ?>"></input>
										</div>
										<div class="bshift-form-element">
											<input class="slide_input image_url" name="slide_upload[]" value="<?php echo $slide_upload; ?>" type="text"></input>
											<input class="upload_image_button background" value="Add Background" data-id = "<?php echo $index; ?>" data-target="slide-button-preview" type="button"></input>
										</div>
											<img src="<?php echo plugin_dir_url(__FILE__); ?>/img/delete-512.png" class="delete_slide" title="Delete this slide."/>
											<!--<img src="<?php echo plugin_dir_url(__FILE__); ?>/img/prev.png" class="b-preview" title="Preview this slide." />-->
											
											<!--<input type="submit" name="delete[]" value="delete slide" data-ref="<?php echo $i; ?>" class="delete_slide"></input>-->
											<input type="hidden" name="counter[]"></input>
											
									</div> <!--end .ib -->
								</li>
						<?php } ?> <!-- End indiSlide function -->