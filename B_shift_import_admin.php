<?php



?>

<div class="wrap">
 <img src="<?php echo plugin_dir_url(__FILE__); ?>/img/banner_brafton.jpg" class="bshift-admn-banner">
 <h2>Create New B-Shift Slider</h2>
    
        <p><a href="<?php echo get_site_url(); ?>/wp-admin/admin.php?page=slider_settings_page" style="border: 1px solid;
padding: 4px; background-color: #FFF; font-weight: 600; text-decoration: none;" class="engage">Create New Slider</a></p>
 
<div class="container" style="background-color: #FFC">
    <div class="row">
    <?php 
        global $post;
        $slider_query = new WP_Query(array('post_type' => 'b-shift-slider','post_status'=>'any'));

        if($slider_query->have_posts()) : while ($slider_query->have_posts()) : $slider_query->the_post(); ?>

                    <?php $id = get_the_ID(); ?>
                    <div class="col-md-3"><a href="<?php echo get_home_url(); ?>/wp-admin/admin.php?page=edit_slider&slider_id=<?php the_ID(); ?>"> <?php the_title(); ?></a></div>
                    <div class="col-md-3"> <?php the_time('F jS, Y'); ?></div>
                    <div class="col-md-3"> [bshift id="<?php the_ID() ?>"]</div>
                    <div class="col-md-3"><a href="<?php echo get_delete_post_link(); ?>">Delete</a></div>
                    
                
            <?php endwhile; ?>
        <?php endif; ?>
    </div>
</div> <!--end container. -->      
   
</div>
