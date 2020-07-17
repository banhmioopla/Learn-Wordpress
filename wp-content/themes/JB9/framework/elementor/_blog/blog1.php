<?php global $CORE, $userdata, $wpdb, $settings;
 
?>
<div class="blog1">
         <?php
            $args = array('posts_per_page' => 3,  'order' => 'des',  'post_type' => 'post' );
             // PERFORM LOOP	
            $query2 = new WP_Query( $args );
            if ( $query2->have_posts() ) {
            while ( $query2->have_posts() ) {
            $query2->the_post();
            $post =  $query2->post;
            ?>
         
 <div class="card mb-3">
            <div class="card-body">
            <div class="row">
            <div class="col-3 px-0 px-md-2">
            <?php echo do_shortcode('[IMAGE]'); ?>
            </div>
            <div class="col-9">
            <div class="blogcontent">
            <h6 class="text-uppercase font-weight-bold"><a href="<?php echo get_permalink($post->ID); ?>" class="text-dark"><?php echo $post->post_title; ?></a></h6>
            <div class="text-muted small mt-4"><?php echo hook_date($post->post_date); ?></div>
            </div>
            </div>
            </div>               
            </div>
         </div>
         
         <?php   }
            wp_reset_postdata();
            }
            ?>
</div>