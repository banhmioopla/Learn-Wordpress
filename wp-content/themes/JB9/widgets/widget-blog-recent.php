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
   
   global $CORE, $userdata, $settings, $post; 
   
   // DISPLAY AMOUNT
   $num = 5;
   if(isset($settings['num']) && is_numeric($settings['num']) && $settings['num'] > 0){
   $num = $settings['num'];
   }
   
   if(!_ppt_checkfile("widget-blog-recent.php")){
   ?>
<div class="widget blog-recent shadow-sm">
   <div class="widget-wrap">
      <div class="widget-block">
 
      
  <?php if(!isset($settings['show_title']) || ( isset($settings['show_title']) && $settings['show_title'] != 0) ){ ?>         
<div class="widget-title"><span><?php if(isset($settings['title']) && strlen($settings['title']) > 1 ){ echo $settings['title']; }else{ 

 		 
		 echo __("Popular Blog Posts","premiumpress");
		 

} ?></span></div>
<?php } ?>

         
         <div class="widget-content <?php if(!isset($settings['show_title']) || ( isset($settings['show_title']) && $settings['show_title'] != 0) ){ }else{?>pt-3<?php } ?>"><div class="container"><div class="row">
             
               <?php	
                  $paged = ( get_query_var( 'paged' ) ) ? absint( get_query_var( 'paged' ) ) : 1;
                  
                  $args = array(
                      'post_type' 		=> 'post',
                      'posts_per_page' 	=> $num,
                  
                  );
                  $wp_query = new WP_Query($args);                   
                  if ( $wp_query->have_posts() ) {                                                       
                  while ( $wp_query->have_posts() ) {  $wp_query->the_post();    
				   
                  ?>
                  
                  <div class="col-12 col-md-6 col-lg-12">
                  <div class="row mb-3">
               <div class="col-2 col-md-2 px-0">
                  
                     <div class="image mt-1">
                     <a href="<?php the_permalink(); ?>">
                        <?php if ( has_post_thumbnail() ) { ?>
                        <?php the_post_thumbnail(array(80,80, 'class'=> " img-fluid")); ?>
                        <?php }else{ ?>
                        <?php echo do_shortcode('[IMAGE link=0]'); ?> 
                        <?php } ?>
                        </a>
                     </div>
                </div>
                <div class="col-10 pr-0">
                      
                        <div class="mb-2 txt-500"><a href="<?php the_permalink(); ?>" class="text-dark"><?php the_title(); ?></a></div>
                     	
                        <div class="small text-muted"><?php echo date('jS M', strtotime($post->post_date)); ?> </div>
                                      
               </div>
               </div></div> 
              
               <?php } } ?>  
               <?php wp_reset_query(); ?>
               </div>
            </div>
         </div>
      </div>
   </div>
</div>
<?php } ?>