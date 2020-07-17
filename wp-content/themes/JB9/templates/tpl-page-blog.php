<?php
/*
   Template Name: [PAGE - BLOG]
*/
   
   global $wpdb, $post, $wp_query;
   
   if (!defined('THEME_VERSION')) {	header('HTTP/1.0 403 Forbidden'); exit; }
    
   $GLOBALS['flag-blog'] = true;
    
   if(!_ppt_checkfile("tpl-page-blog.php")){
   
   // + DEFAULT SIDEBAR
   if(get_post_meta($post->ID,'pagecolumns',true) == ""){ define('PPTCOL', 1);  }
   
   // + GLOBAL HEADER
   get_header($CORE->pageswitch()); 
   
   // + PAGE TOP
   get_template_part( 'page', 'top' ); ?>

 
 <div class="content-wrapper">
 

<?php get_template_part('templates/page-top', 'text' ); ?>

<div class="row pr-lg-3">  
   <?php	
      $paged = ( get_query_var( 'paged' ) ) ? absint( get_query_var( 'paged' ) ) : 1;
      
      $args = array(
          'post_type' 			=> 'post',
          'posts_per_page' 	=> 8,
          'paged' 				=> $paged,
      );
      $wp_query = new WP_Query($args); 
      
      // COUNT EXISTING ADVERTISERS	 
      $tt = $wpdb->get_results($wp_query->request, OBJECT);
      
      if(!empty($tt)){
      foreach($tt as $p){
      
      $post = get_post($p->ID);
      
      ?>
   <?php get_template_part( 'content', 'post' ); ?>
   <?php }}?>
</div>
<div class="clearfix mt-4"></div>
<?php echo $CORE->PAGENAV(); ?>
<?php wp_reset_query(); ?>  

</div>
     
<?php 

// + PAGE BOTTOM
get_template_part( 'page', 'bottom' ); 

// + GLOBAL FOOTER
get_footer($CORE->pageswitch()); } ?>