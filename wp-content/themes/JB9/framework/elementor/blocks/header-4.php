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
 
global $CORE, $post, $userdata; 
?>
<header class="header-4">

<div class="ppt-header header-shadow center-menu-2 viewport-lg no-sticky">
   <div class="bg-primary"> 
      <div class="container">
         <div class="row">
            <div class="col-md-4">
               <div class="logo text-left pl-0" data-mobile-logo="<?php echo $GLOBALS['CORE_THEME']['logo_url']; ?>" data-sticky-logo="<?php echo $GLOBALS['CORE_THEME']['logo_url']; ?>">
                  <a href="<?php echo get_home_url(); ?>/" title="<?php echo get_bloginfo('name'); ?>">
                  <?php echo hook_logo(0); ?>
                  </a>
               </div>
            </div>
            <div class="col-md-7 pt-4 d-none d-lg-block">   
               <?php echo _ppt('advertising1'); ?>     
            </div>
            <div class="col-md-1 pt-4 d-none d-lg-block text-right">
               <div class="hicons row">
                  <a href="<?php if($userdata->ID){ ?><?php echo home_url(); ?>/?s=&favs=1<?php }else{ ?><?php echo site_url('wp-login.php?action=login', 'login_post'); ?><?php } ?>" class="text-light">
                     <div class="icon icon1"> 
                        <span class="notify notify-right"><strong class="cart-basket-count"></strong></span> 
                     </div>
                     <small><?php echo __("Basket","premiumpress"); ?> </small>
                  </a>
                   
               </div>
               <!-- end header icons -->
            </div>
         </div>
         <div class="clearfix"></div>
         <div class="burger-menu mt-md-4 mr-md-5">
            <div class="line-menu line-half first-line"></div>
            <div class="line-menu"></div>
            <div class="line-menu line-half last-line"></div>
         </div>
      </div>
   </div>
   <div class="bg-light">
      <div class="container">
         <nav class="ppt-menu separate-line submenu-scale text-left" style="border-top:0px;">
         <?php ob_start(); ?>
         <li class="d-block d-sm-none">
            <a href="<?php echo _ppt(array('links','cart')); ?>" class="btn btn-secondary rounded-0 mr-2 font-weight-bold text-uppercase">
            <i class="fa fa-shopping-basket font-weight-bold"></i>
            <?php echo __("Basket","premiumpress"); ?> (<span class="cart-basket-count"></span>)            
            </a> 
         </li>
         <?php
            $addon = ob_get_clean();
                     ?>
         <nav class="ppt-menu  text-left">
            <?php 
               ob_start();	
               echo do_shortcode('[MAINMENU class="" style="1"]');
               $menu = ob_get_clean();                  
               echo str_replace("</ul>",  $addon."</ul>", $menu);
                
                ?>
         </nav>
      </div>
   </div>
 
</div>

</header>