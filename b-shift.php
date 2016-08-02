<?php 
    /*
    Plugin Name: B-Shift
    Plugin URI: http://www.brafton.com
    Description: Plugin for displaying sliding or rotating images
    Author: 
    Version: 1.0
    Author URI: http://www.brafton.com
    */



function b_shift_scripts() {
    wp_enqueue_script('jquery');
    wp_enqueue_script('jquery-ui','https://ajax.googleapis.com/ajax/libs/jqueryui/1.11.4/jquery-ui.min.js',array());
    wp_enqueue_script('bshift-js',plugin_dir_url(__FILE__).'js/bshift.js', array(), NULL);
    wp_enqueue_script('slick',plugin_dir_url(__FILE__).'slick/slick.js', array(), NULL);
    wp_enqueue_style('jquery-ui','//code.jquery.com/ui/1.10.1/themes/base/jquery-ui.css');
    wp_enqueue_script('bshift-slick',plugin_dir_url(__FILE__).'js/bshift-slick.js', array(), NULL);
    wp_enqueue_style('sass',plugin_dir_url(__FILE__).'css/new_sass.css', array());
    wp_enqueue_style('slick-theme',plugin_dir_url(__FILE__).'slick/slick-theme.css', array());
    wp_enqueue_style('slick',plugin_dir_url(__FILE__).'slick/slick.css', array());
    
    
}

add_action('wp_head', 'b_shift_scripts');

add_action('wp_head', 'b_plugin_ajaxurl');

function b_plugin_ajaxurl() {

   echo '<script type="text/javascript">
           var ajaxurl = "' . admin_url('admin-ajax.php') . '";
         </script>';
}

function load_wp_media_files($hook) {
    
    wp_register_script('brafton-mce','//cdn.tinymce.com/4/tinymce.min.js');
    wp_enqueue_media();
    wp_enqueue_script('jquery');
    wp_enqueue_script('thickbox');
    wp_enqueue_script('media-models');
    wp_enqueue_script('media-upload');
    //wp_enqueue_script('jquery-ui');
    wp_enqueue_style('jquery-ui','//code.jquery.com/ui/1.10.1/themes/base/jquery-ui.css');
    if($hook !== 'post.php') {
                        wp_enqueue_style('bootstrap','https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css');
                    }
    wp_enqueue_style('bshift',plugin_dir_url(__FILE__).'css/bshift.css', array());
    wp_enqueue_style('bshift',plugin_dir_url(__FILE__).'css/bshift.css', array());
    wp_enqueue_script('add-slider',plugin_dir_url(__FILE__).'js/add_slider.js', array());
    wp_enqueue_script('upload_media_widget', plugin_dir_url(__FILE__).'js/upload-media.js', array());
    wp_enqueue_script('color-picker',plugin_dir_url(__FILE__).'js/jscolor.js', array());
    wp_enqueue_script('brafton-mce');

}
add_action('admin_enqueue_scripts','load_wp_media_files' );

?>

<?php
function b_shift_admin() {
    include('b_shift_import_admin.php');

   
}

function b_shift_admin_actions() {
   
    add_menu_page("B-Shift", "B-Shift", "manage_options", "B-Shift", "b_shift_admin","dashicons-camera");
    add_submenu_page(
        'b-shift', //B-Shift slug
        'Create Slider Page',
        'Create Slider Page',
        'manage_options',
        'slider_settings_page',
        'b_shift_submenu_page_callback'
 );
    add_submenu_page(
        'b-shift', //B-Shift slug
        'Edit Slider Page',
	    'Edit Slider Page',
        'manage_options',
        'edit_slider',
        'b_shift_submenu_page_callback'
 );


}

function b_shift_submenu_page_callback() {
    if(isset($_POST['add_new_slider'])){
    
        //call another function to insert post on form submission and return slider id
    $b_slider_id = create_slider();
	include('edit_slider.php');
    }
    elseif(isset($_GET['slider_id'])||isset($b_slider_id)||isset($_POST['update'])){
        include('edit_slider.php');
    } else {
            include('slider_settings_page.php');
        }
} 
add_action('admin_menu', 'b_shift_admin_actions');

add_action( 'init', 'B_Shift_post_register' );

function B_Shift_post_register() {

register_post_type( 'b-shift-slider',
    array(
      'labels' => array(
        'name' => __( 'Slider' ),
        'singular_name' => __( 'Slider' )
      ),
      'public' => false,
      'map_meta_cap'=> true,
      'capabilities'=>array('delete_post'=>'true'),
      'menu_icon'   => 'dashicons-products'

    )
  );
}

function create_slider() {

		global $post;
            $slides = array(array());
        	$title=$_POST['slider_title'];
        	$state=$_POST['state'];
            $delay=$_POST['delay'];
            $height=$_POST['height'];
            $width=$_POST['width'];
            $effect=$_POST['effect'];
            $bgcolor=$_POST['bgcolor'];
            $height_metric=$_POST['height_metric'];
            $width_metric=$_POST['width_metric'];
            if(isset($_POST)) { $autoplay =$_POST['autoplay']; }
		    $vars = array(
    			'post_type'=>'b-shift-slider',
    			'post_title'=> $title,
    			'post_status'=> $state,
    			'meta_input'=>array("slider_title"=>$title)
                
    		);

		$post = wp_insert_post( $vars );
		add_post_meta($post,'Slider_Name',$title);
		add_post_meta($post,'Slider_Delay',$delay);
        add_post_meta($post,'Slider_State',$state);
        add_post_meta($post,'Slider_Height',$height);
        add_post_meta($post,'Slider_Height_Metric',$height_metric);
        add_post_meta($post,'Slider_Width',$width);
        add_post_meta($post,'Slider_Effect',$effect);
        add_post_meta($post,'Slider_Bgcolor',$bgcolor);
        add_post_meta($post,'Slider_Play',$autoplay);
        add_post_meta($post,'Slider_Width_Metric',$width_metric);


}
add_action('wp_ajax_bshift_action_two', 'bshift_second_callback');
add_action( 'wp_ajax_bshift_action', 'bshift_callback' );
function bshift_second_callback() {
    global $wpdb;
    $post = $_POST['id'];
    $bshift_slides = get_post_meta($post,'Slides_Array',true);
    $color_array = $bshift_slides["color"];
    $new_color = array();
    $counter = get_post_meta($post,'Slides_Array_Count',true);
    for($p=0;$p<$counter;$p++) {
        $new_color[$p]=$color_array[$p];
    }
    $new_color = array(
        'colors'    =>$new_color
        );
    //echo $bshift_slides['color'];
    //echo count($bshift_slides['color']);
    //var_dump(json_encode($new_color));
    echo json_encode($new_color);
    die();
}
function bshift_callback() {

    
    global $wpdb; 

    $pid = intval( $_POST['id'] );
    ob_start();
    /*$current = get_post_meta($pid,'Slides_Array_Count',true);
    $editor_id = 'slide_editor';
    $settings = array( 'media_buttons' => false, 'textarea_name'=> 'slide_content[]','editor_height'=>'75px','editor_css'=>'<style>.wp-editor-wrap{width: 175px;}a#content-tmce, a#content-tmce:hover, #qt_content_fullscreen textarea{ display:none;}</style>');
    $content = "";

    wp_editor($content,$editor_id, $settings); */
    $link = ob_get_contents();
    ob_end_clean();

    $cid = $link;
    $wid = get_post_meta($pid,'Slider_Width',true);
    $hid = get_post_meta($pid,'Slider_Height',true);
    $eid = get_post_meta($pid,'Slider_Effect',true);
    $did = get_post_meta($pid,'Slider_Delay',true);
    $lid = get_post_meta($pid,'Slides_Array_Count',true);
    $widm = get_post_meta($pid,'Slider_Width_Metric',true);
    $ajax_array = array();
    $ajax_array['wid'] = $wid;
    $ajax_array['hid'] = $hid;
    $ajax_array['eid'] = $eid;
    $ajax_array['did'] = $did;
    $ajax_array['lid'] = $lid;
    $ajax_array['cid'] = $cid;
    $ajax_array['widm'] = $widm;

    echo json_encode($ajax_array);

    die(); 
}

function bshift_shortcode($atts) {

    $a = shortcode_atts( array(
        'id' => 'something'
    ), $atts );
    $post_id =  $a['id'];
    $slides = array(array());
    $slider_delay = get_post_meta($post_id,'Slider_Delay',true);
    $slider_title = get_post_meta($post_id,'Slider_Name',true);
    $slider_state = get_post_meta($post_id,'Slider_State',true);
    $slides = get_post_meta($post_id,'Slides_Array',true);
    $slide_count = get_post_meta($post_id,'Slides_Array_Count',true);
    $total_width = get_post_meta($post_id,'Slider_Width',true) . get_post_meta($post_id,'Slider_Width_Metric',true);
    $autoplay = get_post_meta($post_id,'Slider_Play',true);
  

    
    ob_start(); /*
    var_dump($slides['content']);
    echo '</br>'. $slider_title;
    echo '<p>';
    for($i=0;$i<$slide_count;$i++) {
        echo $slides['content'][$i];
        echo'</br>';
    }
    echo '</p>'; */?>

    
        <?php 
        $eff = get_post_meta($post_id,'Slider_Effect',true); 
        $direction;
        switch ($eff) {
                    case 'slide_left':
                        $rtl = 'false';
                        break;
                    case 'slide_right':
                        $rtl = 'true';
                        break;
        }
        if($eff == 'slide_left' || $eff == 'slide_right') { ?>
        <?php wp_deregister_script('bshift-js'); ?>

        <div class="left-bframe" <?php if($eff=='slide_right') : ?> dir="rtl" <?php endif; ?> data-speed="<?php echo $slider_delay; ?>" data-rtl="<?php echo $rtl; ?>" data-autoplay="<?php echo $autoplay; ?>" data-pid="<?php echo $post_id; ?>" style="height: <?php echo get_post_meta($post_id,'Slider_Height',true); echo get_post_meta($post_id,'Slider_Height_Metric',true); ?>">
            <?php for($i=0;$i<$slide_count;$i++) {  if($slider_state == 'published'){ ?>
            <div id="<?php echo $post_id; ?>" class="bslide <?php echo $post_id .' '.$slides['effect'][$i] ?>" data-index = "<?php echo $slides['index'][$i]; ?>" data-speed="<?php echo $slides['delay'][$i]; ?>" data-effect="<?php echo $slides['effect'][$i]; ?>" style="background-image: url('<?php echo $slides['slide_upload'][$i]; ?>'); 
                background-size:cover; width: <?php echo $slides['width'][$i]; echo $slides['width_metric'][$i]; ?>; height: 100%; background-position: 0, <?php echo $total_width; ?>;  ">
                <div class="b-shift-content" style="color: #<?php echo $slides['color'][$i]; ?>">
                    <!--<button style="display: block; color: inherit;" type="button" data-role="none" class="slick-prev slick-arrow" aria-label="Previous" role="button">Previous</button>
                    <button style="display: block; color: inherit;" type="button" data-role="none" class="slick-next slick-arrow" aria-label="Next" role="button">Next</button>-->
                    <div class="option-a" style="float: <?php echo $slides['text_position'][$i]; ?>">
                    <?php echo html_entity_decode($slides['slide_content'][$i]); ?>
                    </div>
                    <?php if($slides['image_height'][$i]>0) { ?>
                    <div class="option-b" style="float: <?php echo $slides['image_position'][$i]; ?>; bottom: <?php $slides['position_bottom'][$i]; ?> %;">
                        <img src="<?php echo $slides['image_upload'][$i]; ?>" id="inner-image" style="height: <?php echo $slides['image_height'][$i]; ?>px; display: <?php if($slides['image_upload'][$i]) { echo 'inline'; }  else { echo 'none'; } ?>;"/>
                    </div>
                    <?php } ?>
                </div>
            </div>
            <?php } } ?>
        </div>
        <?php } else { ?>
        <div class="b-outer-frame">
        <ul class="b-frame normal-slider fullwidth-slider" data-autoplay="<?php echo $autoplay; ?>" style="background-color: #000; height: <?php echo get_post_meta($post_id,'Slider_Height',true); echo get_post_meta($post_id,'Slider_Height_Metric',true); ?>; width: <?php echo get_post_meta($post_id,'Slider_Width',true); echo get_post_meta($post_id,'Slider_Width_Metric',true); ?>;">

            <!-- Each li should have the animation specified not the ul -->
            <?php /*foreach($slides as $slide){ if($slide['state']=='published'){ */?>
            <?php for($i=0;$i<$slide_count;$i++) {  if($slider_state == 'published'){ ?>
            <li id="<?php echo $post_id; ?>" class="<?php echo $post_id .' '.$slides['effect'][$i] ?>" 
                data-speed="<?php echo $slides['delay'][$i]; ?>" data-effect="<?php echo $slides['effect'][$i]; ?>" style="background-image: url('<?php echo $slides['slide_upload'][$i]; ?>'); 
                background-size:cover; width: <?php echo $slides['width'][$i]; echo $slides['width_metric'][$i]; ?>; height: 100%; background-position: 0, <?php echo $total_width; ?>;  ">
                    <!-- this div needs to be placed perfect center not center text.  contrain it so it is not 100% of the parent container add slight padding and center div horiz and vertic.  DO NOT center content -->     
                <div class="b-shift-content" style="color: #<?php echo $slides['color'][$i]; ?>">
                    <!-- need to start setting some basic constraitns on the elements to ensure they always render as good as possible under minimal settings. -->
                    <span class="slide-nav-left" data-direction="left"></span>
                    <span class="slide-nav-right" data-direction="right"></span>                    
                    <div class="option-a" style="float: <?php echo $slides['text_position'][$i]; ?>">
                        <?php echo html_entity_decode($slides['slide_content'][$i]); ?>
                    </div>
                    <?php if($slides['image_height'][$i]>0) { ?>
                    <div class="option-b" style="float: <?php echo $slides['image_position'][$i]; ?>; bottom: <?php $slides['position_bottom'][$i]; ?> %;">
                        <img src="<?php echo $slides['image_upload'][$i]; ?>" id="inner-image" style="height: <?php echo $slides['image_height'][$i]; ?>px; display: <?php if($slides['image_upload'][$i]) { echo 'inline'; }  else { echo 'none'; } ?>;"/>
                    </div>
                    <?php } ?>



                </div>
            </li>

            <?php } } ?>
        </ul>
        <?php } ?>
    </div>
    
    <?php
    return ob_get_clean();
}
add_shortcode('bshift', 'bshift_shortcode');


?>