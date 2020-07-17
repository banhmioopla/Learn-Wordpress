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

global $CORE, $userdata, $wpdb, $settings; ?>
<div class="ppt-header header-1 header-logo5 <?php if(!isset($settings['sticky'])){ ?>no-sticky<?php } ?>">
   <div class="container py-4">
      <div class="row">
         <div class="col-md-6">
            <div class="logo text-left pl-0" data-mobile-logo="<?php echo hook_logo(array(1,0)); ?>" data-sticky-logo="<?php echo hook_logo(array(1,0)); ?>">
               <a href="<?php echo get_home_url(); ?>/" title="<?php echo get_bloginfo('name'); ?>">
               <?php echo hook_logo(0); ?>
               </a>
            </div>
         </div>
         <div class="col-md-6 d-none d-lg-block text-right">
            <?php echo $CORE->BANNER('header'); ?>                
         </div>
      </div>
   </div>
   <div class="burger-menu mt-5">
      <div class="line-menu line-half first-line"></div>
      <div class="line-menu"></div>
      <div class="line-menu line-half last-line"></div>
   </div>
</div>