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
   
   if(!_ppt_checkfile("widget-listings.php")){
   
   
   // DISPLAY AMOUNT
   $num = 5;
   if(isset($settings['num']) && is_numeric($settings['num']) && $settings['num'] > 0){
   $num = $settings['num'];
   }
   
   ?>
<div class="widget listings-featured shadow-sm">
   <div class="widget-wrap">
      <div class="widget-block">
         
  <?php if(!isset($settings['show_title']) || ( isset($settings['show_title']) && $settings['show_title'] != 0) ){ ?>         
<div class="widget-title"><span><?php if(isset($settings['title']) && strlen($settings['title']) > 1 ){ echo $settings['title']; }else{ 

 		if(THEME_KEY == "da"){ 
		 echo __("Featured Members","premiumpress");
		 }else{
		 echo __("Featured Listings","premiumpress");
		 }

} ?></span></div>
<?php } ?>
       
         <div class="widget-content"><div class="container"><div class="row">
         
         
               <?php	
                  
                $args = array('posts_per_page' => $num, 
				'post_type' => 'listing_type', 'orderby' => 'name', 'order' => 'desc', 'paged'  => 1, 'offset'  => 0,
				'meta_query' => array (
						 	array(
							
							'relation'    => 'OR',	
										 
							'f1'    => array(
								'key' => 'featured',
								'value' => 1							 			
							),			 
							'f2'   => array(
								'key'     => 'featured',							
								'value' => 'yes',
												
							),						
						), 	
					  ) 
				 );
                  $wp_query1 = new WP_Query($args);                   
                  if ( $wp_query1->have_posts() ) {                                                       
                  while ( $wp_query1->have_posts() ) {  $wp_query1->the_post();                  
                  ?>
                  
                  <div class="col-12 col-md-6 col-lg-12">
                  <div class="row mb-3">
               <div class="col-2 px-0">
                  
                     <div class="image mt-2">
                     <a href="<?php the_permalink(); ?>">
                        <?php if ( has_post_thumbnail() ) { ?>
                        <?php the_post_thumbnail(array(80,80, 'class'=> " img-fluid")); ?>
                        <?php }else{ ?>
                        
                        <?php if(THEME_KEY == "cp"){ ?>
                         <?php echo do_shortcode('[COUPONIMAGE  link=0 single=1]'); ?>  
                         <?php }else{ ?>
                        <?php echo do_shortcode('[IMAGE link=0]'); ?> 
                        <?php } ?>
                        <?php } ?>
                        </a>
                     </div>
                </div>
                <div class="col-10 pr-0">
                      
                        <div class="mb-2 txt-500"><a href="<?php the_permalink(); ?>" class="text-dark"><?php the_title(); ?></a></div>
                     	
                        
                        <div class="small text-muted">
						
						<?php if(THEME_KEY == "da"){ ?>
						 <?php echo do_shortcode('[GENDER-ICON]'); ?> <?php echo do_shortcode('[GENDER]'); ?> / <?php echo do_shortcode('[AGE]'); ?>
						<?php }else{ ?>
						<?php echo do_shortcode('[CATEGORY limit=1]'); ?>
                        <?php } ?>
                        
                         </div>
                         
                                       
               </div>
               </div></div> 
              
               <?php } } ?> 
               <?php wp_reset_query(); ?>
            
            
         </div></div></div>
      </div>
   </div>
</div>
<?php } ?>