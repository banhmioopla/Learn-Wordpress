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
   
   if(!_ppt_checkfile("widget-categorylist.php")){
   ?>
<div class="widget categorylist shadow-sm">
   <div class="widget-wrap">
      <div class="widget-block">
 
         <div class="widget-title">
            <span><?php 
			
			if(isset($settings['title']) && strlen($settings['title']) > 1 ){ echo $settings['title']; }else{ echo __("Categories","premiumpress") ; }
			  ?></span>
         </div>
       
         <div class="widget-content"> 
            <?php
               $categories = wp_list_categories( array(
                       'taxonomy'  	=> 'listing',
                       'depth'         => 5,	
                       'hierarchical'  => true,		
                       'hide_empty'    => 0,
                       'echo'			=> false,
                       'title_li' 		=> '',
                        'orderby' 		=> 'term_order',
                        'walker'		=> new walker_shortcode_dcats,
                       'limit' 			=> 10,
					   'show_count' => 1,
                       ) ); 
               
               ?>
            <div class=" wlt_shortcode_dcats clearfix d-none d-md-block d-lg-block">
               <ul class="mb-0 sf-menu sf-vertical">
                  <?php echo $categories; ?>
               </ul>
            </div>
       
        
         </div>
      </div>
   </div>
</div>
<?php } ?>