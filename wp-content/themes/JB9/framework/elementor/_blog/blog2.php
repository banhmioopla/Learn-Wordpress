<?php global $CORE, $userdata, $wpdb, $settings;
 
?>
<div class="blog2">
<div class="container-fluid">
<div class="row">
            <div class="col-md-6 "> 
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

                  
            </div>
            <div class="col-md-6">         
 
<div class="datelist">
<?php	
              
               $args = array(
                   'post_type' 			=> 'post',
                   'posts_per_page' 	=> 3,
				   'offset' 			=> -1, 
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

<div class="blog-box bg-primary">
                <a href="<?php the_permalink(); ?>" class="flex-container">
                	<div class="blox-calendar bg-primary ">
                        <div class="blox-calendar-box">
                            <div class="blox-calendar-date"><?php echo $day; ?></div>
                            <div class="blox-calendar-month"><?php echo $month; ?></div>
                        </div>
                    </div>
                    
                    <div class="blox-scroller-content bg-dark">
                        <div class="blox-heading"><?php the_title(); ?></div>
                        <div class="blox-paragraph"><?php echo do_shortcode('[EXCERPT limit=90]'); ?>...</div>
                    </div>
                </a>
            </div>
   <?php }}?>

<?php wp_reset_query(); ?>  

</div>  
</div>
</div>
</div>
</div>