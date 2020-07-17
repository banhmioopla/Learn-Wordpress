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
   
 
   
   if(!_ppt_checkfile("widget-blog-categories.php")){
   ?>
<div class="widget blog-categories shadow-sm">
   <div class="widget-wrap">
      <div class="widget-block">
         
  <?php if(!isset($settings['show_title']) || ( isset($settings['show_title']) && $settings['show_title'] != 0) ){ ?>         
<div class="widget-title"><span><?php if(isset($settings['title']) && strlen($settings['title']) > 1 ){ echo $settings['title']; }else{

		 echo __("Blog Categories","premiumpress");		 

} ?></span></div>
<?php } ?>
         
         <div class="widget-content">
            <ul class="list-unstyled">
               <?php wp_list_categories( array(
                  'orderby'    => 'name',
                  'show_count' => true,
                  //'hide_empty' => false,
                  'title_li' => '',
                  'class' => '',
                  ) ); ?> 
            </ul>
         </div>
      </div>
   </div>
</div>
<?php } ?>