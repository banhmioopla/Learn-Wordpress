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
 
global $CORE, $post, $userdata, $settings;

?>
<header class="header-2">
<div class="ppt-header header-innner  <?php if(isset($settings['transparent'])){ ?>header-transparent-on<?php } ?> <?php if(isset($settings['shadow'])){ ?>header-shadow<?php } ?> header-light viewport-lg <?php if(isset($settings['nosticky'])){ ?>no-sticky<?php } ?>">
<div  id="header-menu">
   <div class="container">
   
    
   
      <div class="ppt-header-container row">
      
     
      
         
         
         <div class="col-md-4">
         
         <div class="logo" data-mobile-logo="<?php echo hook_logo(array(1,0)); ?>" data-sticky-logo="<?php echo hook_logo(array(1,0)); ?>">
            <a href="<?php echo get_home_url(); ?>/" title="<?php echo get_bloginfo('name'); ?>">
            <?php echo hook_logo(0); ?>
            </a>
         </div>
         
         
         
         </div>
         
         <div class="col-md-4">
         
         
         
         </div>
         
         <div class="col-md-4 text-right d-none d-lg-block">
         
              <a href="" class="btn btn-primary btn-large rounded mt-4">Main Button</a>         
             
            
         
         </div>
         
         
         
         
       
          
          
          
          
      </div>
   </div>
</div>
</div>
</header>