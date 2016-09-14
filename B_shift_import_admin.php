<?php



?>

<div class="wrap">
 <img src="<?php echo plugin_dir_url(__FILE__); ?>/img/banner_brafton.jpg" class="bshift-admn-banner">
 <h2>Create New B-Shift Slider</h2>
 <a href="<?php echo get_site_url(); ?>/wp-admin/admin.php?page=slider_settings_page" class="engage container create-slider-button">Create New Slider</a> 
<div class="container" style="background-color: #FFC">

    
    <?php 
        global $post;
        $slider_query = new WP_Query(array('post_type' => 'b-shift-slider','post_status'=>'any','posts_per_page'=>'100'));

        if($slider_query->have_posts()) : while ($slider_query->have_posts()) : $slider_query->the_post(); ?>

                    
                    <div class="row" id = "post-<?php the_ID(); ?>">
                        <div class="col-md-3"><a href="<?php echo get_home_url(); ?>/wp-admin/admin.php?page=edit_slider&slider_id=<?php the_ID(); ?>"> <?php the_title(); ?></a></div>
                        <div class="col-md-3"> <?php the_time('F jS, Y'); ?></div>
                        <div class="col-md-3"> [bshift id="<?php the_ID() ?>"]</div>
                        <div class="col-md-3"><?php if( current_user_can( 'delete_post' ) ) : ?><a href="#" data-id="<?php the_ID() ?>" data-nonce="<?php echo wp_create_nonce('my_delete_post_nonce') ?>" class="delete-post">Delete</a><?php endif ?></div>
                    </div>
                
            <?php endwhile; ?>
        <?php endif; ?>
</div> <!--end container. --> 
<p>
