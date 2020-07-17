<?php global $CORE, $userdata, $wpdb, $settings; ?>
<div class="blog4 <?php if(isset($settings['class']) && $settings['class'] != ""){ echo $settings['class']." "; } ?>">	   
<div class="container">			
<div class="row">                      
<?php

$args = array('posts_per_page' => 3,  'order' => 'des',  'post_type' => 'post' );
			  
// PERFORM LOOP	
$query2 = new WP_Query( $args );
if ( $query2->have_posts() ) {
	// The 2nd Loop
	while ( $query2->have_posts() ) {
		$query2->the_post();
		
		$post =  $query2->post;
ob_start();	
get_template_part( 'content', 'post' );
$newcss = ob_get_clean();

echo str_replace("col-lg-6","col-lg-4 col-6",$newcss); 

}

	// Restore original Post Data
	wp_reset_postdata();
}
 
?>
</div>
</div>
</div>