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


// MY FAVOURITES
$c2 = 0;
if($userdata->ID){

	// MY FAVOURITES
	$c2 = $CORE->user_favs_count();
}
?>

 
<header class="header-5">
<div class="ppt-header viewport-lg no-sticky">
 
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
   
 <!-- HEADER LOGO --> 
   <div class="container py-3" id="header-logo">
         <div class="row">
            <div class="col-md-3">
               <div class="logo text-left pl-0" data-mobile-logo="<?php echo $GLOBALS['CORE_THEME']['logo_url']; ?>" data-sticky-logo="<?php echo $GLOBALS['CORE_THEME']['logo_url']; ?>">
                  <a href="<?php echo get_home_url(); ?>/" title="<?php echo get_bloginfo('name'); ?>">
                  <?php echo hook_logo(0); ?>
                  </a>
               </div>
            </div>
            <div class="col-md-5 d-none d-lg-block">   
               <?php echo _ppt('advertising1'); ?>     
            </div>
         <div class="col-md-4 d-none d-lg-block">
            <div class="hicons row float-right mt-3">
               <div class="phonebox">
				<?php if(!$userdata->ID){ ?>                 
                  <a href="<?php echo wp_login_url(); ?>" class="text-dark">
                  <span class="iconsmall"><i class="fa fa-lock text-primary"></i></span>
                  <span class="content mr-3">
                  <span class="text1 mb-1"><?php echo __("members area","premiumpress-childtheme"); ?></span>
                  <span class="text2"><?php echo __("Sign up/in here","premiumpress-childtheme"); ?></span>  
                  </span>              
                  </a>
                  <?php }else{ ?>
                  <a href="<?php echo _ppt(array('links','myaccount')); ?>" class="text-dark">
                  <span class="iconsmall"><span class="icon-user"></span></span>
                  <span class="content mr-3">
                  <span class="text1 mb-1"><?php echo __("My Account","premiumpress-childtheme"); ?></span>
                  <span class="text2"><?php echo __("view dashboard","premiumpress-childtheme"); ?></span> 
                  </span>               
                  </a>
                  <?php } ?>  
               </div>
               <a href="<?php if($userdata->ID){ ?><?php echo home_url(); ?>/?s=&favs=1<?php }else{ ?><?php echo site_url('wp-login.php?action=login', 'login_post'); ?><?php } ?>" class="mx-4 text-dark">
                  <div class="icon icon1"> 
                     <span class="count bg-secondary"><?php echo $c2; ?></span> 
                  </div>
                  <div class="small text-uppercase"><?php echo __("favorites","premiumpress-childtheme"); ?></div>
               </a>
            </div>
         </div>
         </div>
         <div class="clearfix"></div>
         <div class="burger-menu mt-md-4 mr-md-5">
            <div class="line-menu line-half first-line"></div>
            <div class="line-menu"></div>
            <div class="line-menu line-half last-line"></div>
         </div>
    
   </div>
   <!-- HEADER MENU --> 
   <div class="bg-primary clearfix" id="header-menu">
      <div class="container">
         <nav class="ppt-menu float-none separate-line submenu-scale text-left">
         <?php ob_start(); ?>
         
         <?php if(THEME_KEY == "sp"){ ?>
         <li class="cartbtn">
            <a href="<?php echo _ppt(array('links','cart')); ?>" class="btn btn-secondary rounded-0 mr-2 text-uppercase ">
            <i class="fa fa-shopping-basket mr-2"></i>
            <?php echo __("Basket","premiumpress"); ?> (<span class="cart-basket-count"></span>)            
            </a> 
         </li>
         <?php } ?>
         
         
         <?php
            $addon = ob_get_clean();
                     ?>
         <nav class="ppt-menu float-none  text-left">
            <?php 
               ob_start();	
               echo do_shortcode('[MAINMENU class="" style="1"]');
               $menu = ob_get_clean();                  
               echo str_replace("</ul>",  $addon."</ul>", $menu);
                
                ?>
         </nav>
      </div> 
	</div>
    
</header>