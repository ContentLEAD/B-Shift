<?php



?>

<div class="wrap">
 <img src="<?php echo plugin_dir_url(__FILE__); ?>/img/banner_brafton.jpg" class="bshift-admn-banner">
 <h2>Create New B-Shift Slider</h2> 
<div class="container" style="background-color: #FFC">
    
    <?php 
        global $post;
        $slider_query = new WP_Query(array('post_type' => 'b-shift-slider','post_status'=>'any','posts_per_page'=>'100'));

        if($slider_query->have_posts()) : while ($slider_query->have_posts()) : $slider_query->the_post(); ?>

                    <?php $id = get_the_ID(); ?>
                    <div class="row">
                        <div class="col-md-3"><a href="<?php echo get_home_url(); ?>/wp-admin/admin.php?page=edit_slider&slider_id=<?php the_ID(); ?>"> <?php the_title(); ?></a></div>
                        <div class="col-md-3"> <?php the_time('F jS, Y'); ?></div>
                        <div class="col-md-3"> [bshift id="<?php the_ID() ?>"]</div>
                        <div class="col-md-3"><a href="<?php echo get_delete_post_link(); ?>">Delete</a></div>
                    </div>
                
            <?php endwhile; ?>
        <?php endif; ?>
</div> <!--end container. --> 
<p>
<a href="<?php echo get_site_url(); ?>/wp-admin/admin.php?page=slider_settings_page" class="engage container create-slider-button">Create New Slider</a>