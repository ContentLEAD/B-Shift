<?php
//var_dump($_POST);
echo "Slider instantiated.";


?>
<!--<form action=" " method="post">
<p>Title</p>
<input type="hidden" name="update"></input>
<input type="text" name="title" value="<?php echo get_post_meta($post_id,'Slider_Name',true); ?>"></input>
<p>DELAY</p>
<input type="text" name="delay" value="<?php echo get_post_meta($post_id,'Slider_Delay',true); ?>"></input>
<p>STATE</p>
<?php $selected_state = get_post_meta($post_id,'Slider_State',true); ?>
<select name="state">
<option value="draft" <?php if($selected_state == 'draft'){echo("selected");}?>>Draft</option>
<option value="published" <?php if($selected_state == 'published'){echo("selected");}?>>Published</option>
<option value="pending" <?php if($selected_state == 'pending'){echo("selected");}?>>Pending</option>
</select>
<p>HEIGHT</p>
<input type="text" name="height" value="<?php echo get_post_meta($post_id,'Slider_Height',true); ?>"></input>
<p>WIDTH</p>
<input type="text" name="width" value="<?php echo get_post_meta($post_id,'Slider_Width',true); ?>"></input>
<p>EFFECT</p>
<?php
    $selected_effect = get_post_meta($post_id,'Slider_Effect',true);
?>
<select name="effect" class="<?php echo $selected; ?>">
<option value="fade" <?php if($selected_effect == 'fade'){echo("selected");}?>>Fade</option>
<option value="slide_vertical" <?php if($selected_effect == 'slide-vertical'){echo("selected");}?>>Slide Vertical</option>
<option value="slide_left" <?php if($selected_effect == 'slide-left'){echo("selected");}?>>Slide Left</option>
<option value="slide_right" <?php if($selected_effect == 'slide-right'){echo("selected");}?>>Slide Right</option>
<option value="toggle" <?php if($selected_effect == 'toggle'){echo("selected");}?>>Standard Toggle</option>
</select>
<input type="submit" value="update slider"></input>
</form>-->