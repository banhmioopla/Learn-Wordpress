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
   
   
   if(!_ppt_checkfile("widget-listings-recent.php")){
   ?>
<div class="widget listings-featured shadow-sm">
   <div class="widget-wrap">
      <div class="widget-block">
   
         
  <?php if(!isset($settings['show_title']) || ( isset($settings['show_title']) && $settings['show_title'] != 0) ){ ?>         
<div class="widget-title"><span><?php if(isset($settings['title']) && strlen($settings['title']) > 1 ){ echo $settings['title']; }else{ 

 		 
		 echo __("Recently Viewed","premiumpress");
		 

} ?></span></div>
<?php } ?>
         
         
      
         <div class="widget-content"><div class="container"><div class="row">
         
         
               <?php	
                  
				  
			$SQL = "SELECT post_id, meta_value AS date FROM `".$wpdb->prefix."postmeta` WHERE meta_key='pageviewed' AND meta_value !='' GROUP BY post_id ORDER BY UNIX_TIMESTAMP(date) desc LIMIT ".$num;
			$h = $wpdb->get_results($SQL, OBJECT);
			if(!empty($h)){
				
				$gg = array();
				foreach($h as $p){
				 	
				$post = get_post($p->post_id);
				  
				   
			   $vv = $CORE->date_timediff(get_post_meta($p->post_id,'pageviewed',true));		 
	  	                  
                  ?>
                  
                  <div class="col-12 col-md-6 col-lg-12">
                  <div class="row mb-3">
               <div class="col-2 px-0">
                  
                     <div class="image mt-2">
                     <a href="<?php the_permalink(); ?>">
                        <?php if ( has_post_thumbnail() ) { ?>
                        <?php the_post_thumbnail(array(80,80, 'class'=> " img-fluid")); ?>                        
						<?php }elseif(THEME_KEY == 'cp'){ ?>
						<?php echo do_shortcode('[COUPONIMAGE]'); ?>
						<?php }else{ ?>
                        <?php echo do_shortcode('[IMAGE link=0]'); ?> 
                        <?php } ?>
                        </a>
                     </div>
                </div>
                <div class="col-10 pr-0">
                      
                        <div class="mb-2 txt-500"><a href="<?php the_permalink(); ?>" class="text-dark"><?php the_title(); ?></a></div>
                     	
                        <div class="small text-muted">
                       
						<?php if(THEME_KEY == "da"){ ?>
						 <?php echo do_shortcode('[GENDER-ICON]'); ?> <?php echo do_shortcode('[GENDER]'); ?> 
						<?php }else{ ?>
						<?php echo do_shortcode('[CATEGORY limit=1]'); ?>
                        <?php } ?>
                        
                         - <?php echo $vv['string-small']; ?> <?php echo __("ago","premiumpress") ?>
                        
                         </div>
               </div>
               </div></div> 
              
               <?php } }   ?> 
               <?php wp_reset_query(); ?>
            
            
         </div></div></div>
      </div>
   </div>
</div>
<?php } ?>