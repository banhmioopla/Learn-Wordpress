<?php
/* 
* Theme: PREMIUMPRESS CORE FRAMEWORK FILE
* Url: www.premiumpress.com
* Author: Mark Fail
*
* THIS FILE WILL BE UPDATED WITH EVERY UPDATE
* IF YOU WANT TO MODIFY THIS FILE, CREATE A CHILD THEME
*
* http://codex.wordpress.org/Child_Themes
*/
if (!defined('THEME_VERSION')) {	header('HTTP/1.0 403 Forbidden'); exit; }
 
global $CORE, $post, $wpdb, $userdata, $settings;

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
              
$day 	= date("d", strtotime(get_the_date()));
$month 	= date("M", strtotime(get_the_date()));
$year 	= date("Y", strtotime(get_the_date()));

?>            
 
<div class="blogsingle_6_content">
  <div class="blogsingle_6_content_container_holder" style="background-color:#ffffff;">

    <div class="blogsingle_6_content_placeholder">
      <a href="<?php the_permalink(); ?>"><img src="<?php echo do_shortcode('[IMAGE pathonly=1]'); ?>" alt="<?php echo $post->post_title; ?>" class="img-fluid"></a>
    </div>
    <div class="blogsingle_6_content_content_box">
      <h2 style="color:#181818;"><?php the_title(); ?></h2>
      <p style="color:#8a8a8a; border-left:#181818 4px solid; margin:0 0px 5px -21px; padding-left:19px;"><?php echo do_shortcode('[EXCERPT limit=100]'); ?>...</p>
      <a class="uc_more_btn" style="color:#181818;  background-color:#ffffff;" href="<?php the_permalink(); ?>"><?php echo __("Show More","premiumpress-childtheme") ?></a>
    </div>
  </div>
</div>

   <?php }}?>
<?php wp_reset_query(); ?>