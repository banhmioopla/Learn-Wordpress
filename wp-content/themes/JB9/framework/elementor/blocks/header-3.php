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

<header class="header-3">
   <!-- HEADER TOP --> 
   <div class="header-top-1 d-none d-md-block" id="header-top">
      <div class="container">
         <div class="row">
            <div class="col-lg-6">
               <ul class="top-bar-menu clearfix mb-0">
                  <li>
                     <?php if(!$userdata->ID){ ?>
                     <a href="<?php echo wp_registration_url(); ?>">
                     <?php echo __("Sign up/in","premiumpress"); ?>
                     </a>
                     <?php }else{ ?>
                     <a href="<?php echo _ppt(array('links','myaccount')); ?>">
                     <?php echo __("My Account","premiumpress"); ?>
                     </a>
                     <?php } ?>
                  </li>
                  <li><a href="<?php echo _ppt(array('links','blog')); ?>"><?php echo __("Blog","premiumpress"); ?></a></li>
                  <li><a href="<?php echo _ppt(array('links','aboutus')); ?>"><?php echo __("About Us","premiumpress"); ?></a></li>
                  <li><a href="<?php echo _ppt(array('links','contact')); ?>"><?php echo __("Contact","premiumpress"); ?></a></li>
               </ul>
            </div>
            <div class="col-lg-6 d-none d-lg-block">
               <div class="socials">
                  <a class="social" target="_blank" href="<?php echo _ppt(array('social','twitter')); ?>" title="Twitter"><i class="fa <?php echo _ppt(array('social','twitter_icon')); ?>"></i></a>
                  <a class="social" target="_blank" href="<?php echo _ppt(array('social','facebook')); ?>" title="Facebook"><i class="fa <?php echo _ppt(array('social','facebook_icon')); ?>"></i></a>
                  <a class="social" target="_blank" href="<?php echo _ppt(array('social','dribbble')); ?>" title="Google plus"><i class="fa <?php echo _ppt(array('social','dribbble_icon')); ?>"></i></a> 
                  <a class="social" target="_blank" href="<?php echo _ppt(array('social','linkedin')); ?>" title="Dribbble"><i class="fa <?php echo _ppt(array('social','linkedin_icon')); ?>"></i></a>
                  <a class="social" target="_blank" href="<?php echo _ppt(array('social','skype')); ?>" title="Skype"><i class="fa <?php echo _ppt(array('social','skype_icon')); ?>"></i></a>
                  <a class="social" target="_blank" href="<?php echo _ppt(array('social','youtube')); ?>" title="Skype"><i class="fa <?php echo _ppt(array('social','youtube_icon')); ?>"></i></a>               
               </div>
               <ul class="top-bar-menu float-right clearfix mb-0">
                  <li><?php echo $CORE->_curreny_dropdown_menu(0); ?></li>
                  <?php if(_ppt('language_dropdown') == 1){ ?> 
                  <li><?php echo $CORE->_language_dropdown_menu(0); ?> </li>
                  <?php } ?>
               </ul>
            </div>
         </div>
      </div>
   </div>
   
   
   
<div class="ppt-header header-innner viewport-lg">
<div  id="header-menu">
   <div class="container">
      <div class="ppt-header-container">
         <div class="logo" data-mobile-logo="<?php echo hook_logo(array(1,0)); ?>" data-sticky-logo="<?php echo hook_logo(array(1,0)); ?>">
            <a href="<?php echo get_home_url(); ?>/" title="<?php echo get_bloginfo('name'); ?>" class=" mr-4">
            <?php echo hook_logo(0); ?>
            </a>
         </div>
         <div class="burger-menu">
            <div class="line-menu line-half first-line"></div>
            <div class="line-menu"></div>
            <div class="line-menu line-half last-line"></div>
         </div>
       
          <?php
		  ob_start(); ?>      
           
             
      
		 <?php if(THEME_KEY == "sp"){ ?>
         <li class="menu-item float-lg-right">          
         <a href="<?php echo _ppt(array('links','cart')); ?>">
         <div class="icon-basket"> <span class=" pr-2 d-block d-sm-none"><?php echo __("My Basket","premiumpress"); ?></span> (<span class="cart-basket-count"></span>)</div>
         </a>
         </li> 
         <?php } ?> 
            <li class="menu-item myaccount float-lg-right addon-text pr-4">
             
            <a href="<?php echo _ppt(array('links','contact')); ?>" class="callus text-right">
            <div class="text-uppercase"><?php echo __("Call Us Now","premiumpress"); ?></div>
            <div class="num"><?php echo _ppt(array('company','phone')); ?></div>
             
            </a>
            </li>   
          
         
         <?php
		 $addon = ob_get_clean();		 
		 ?>
          
         <nav class="ppt-menu separate-line submenu-top-border submenu-scale float-none">
            <?php 
			ob_start();	
			echo do_shortcode('[MAINMENU class="" style="1"]');
			$image = ob_get_clean();
		 	
			echo str_replace("</ul>",  $addon."</ul>", $image);
			 
			 ?> 
         </nav>
      </div>
   </div>
</div>
</div>
</header>