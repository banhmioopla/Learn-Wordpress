<?php global $CORE, $userdata, $wpdb, $settings;
 
?>
<div class="blog3">
<div class="container-fluid">
<div class="row">
            <div class="col-lg-6 px-0"> 
<?php

$args = array(
                   'post_type' 			=> 'post',
                   'posts_per_page' 	=> 1, 
                   'paged' 				=> 1,
               );
               $wp_query = new WP_Query($args); 
			
			   // COUNT EXISTING ADVERTISERS	 
	  		   $tt = $wpdb->get_results($wp_query->request, OBJECT);
			   
			  if(!empty($tt)){
              foreach($tt as $p){
			  
			  $post = get_post($p->ID);
              
   $day 	= date("d", strtotime(get_the_date('Y-m-d',$post->ID)));
   $month 	= date("M", strtotime(get_the_date('Y-m-d',$post->ID)));
   $year 	= date("Y", strtotime(get_the_date('Y-m-d',$post->ID)));

?>            
 
<div class="innerc hide-mobile">
  <div class="innerc_wrap">

    <div class="innerc_img">
      <a href="<?php the_permalink(); ?>"><img src="<?php echo do_shortcode('[IMAGE pathonly=1]'); ?>" alt="<?php echo $post->post_title; ?>" class="img-fluid"></a>
    </div>
    <div class="innerc_content_box">
      <a href="<?php the_permalink(); ?>"><h2 class="text-dark"><?php the_title(); ?></h2></a>
      <p><?php echo substr(strip_tags($post->post_content), 0, 100); ?>...</p>
   
    </div>
  </div>
</div>

   <?php }}?>
<?php wp_reset_query(); ?>

                  
            </div><div class="col-lg-6">  
            
         <?php
            $args = array('posts_per_page' => 4,  'order' => 'des',  'post_type' => 'post', 'offset' => 1 );
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
</div></div></div></div>