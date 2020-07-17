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

global $CORE, $userdata, $wpdb, $settings;


// MY FAVOURITES
$c2 = 0;
if($userdata->ID){

	// MY FAVOURITES
	$c2 = $CORE->user_favs_count();
}

 ?>
<div class="elementor_header elementor_logo header-6 header-logo10 center-menu-2 <?php if(!isset($settings['sticky'])){ ?>no-sticky<?php } ?> <?php if(isset($settings['class'])){ echo $settings['class']; } ?>" <?php if(isset($settings['id'])){ echo "id='".$settings['id']."'"; } ?>>

   
      <div class="container py-4">
         <div class="row">
            <div class="<?php if(THEME_KEY != "sp"){ echo "col-md-4"; }else{ echo "col-md-3"; } ?>">
               <div class="logo text-left pl-0" data-mobile-logo="<?php echo hook_logo(array(1,0)); ?>" data-sticky-logo="<?php echo hook_logo(array(1,0)); ?>">
                  <a href="<?php echo get_home_url(); ?>/" title="<?php echo get_bloginfo('name'); ?>">
                  <?php echo hook_logo(0); ?>
                  </a>
               </div>
            </div>
            <div class="<?php if(THEME_KEY != "sp"){ echo "col-md-4"; }else{ echo "col-md-4"; } ?> d-none d-lg-block">
            
              
               <form action="<?php echo get_home_url(); ?>/" method="get" name="searchform1" id="searchform1">
                  <input type="hidden" name="catid" value="" id="searchform1_catid" />
                  <div class="form-group mb-1">
                     <div class="input-group">
                      
                        <input type="text" class="form-control" name="s"  value="<?php if(isset($_GET['s'])){ echo strip_tags($_GET['s']); } ?>" placeholder="<?php if(isset($settings['search_txt'])){ echo $settings['search_txt']; }else{  echo __("Search keyword...","premiumpress"); } ?>" >
                        <button><i class="fa fa-search"></i></button> 
                     </div>
                  </div>
               </form>
             
            </div>
            <div class="<?php if(THEME_KEY != "sp"){ echo "col-md-4"; }else{ echo "col-md-5"; } ?> d-none d-lg-block">
           
            
            <ul class="links float-right">
            <?php if(defined('WLT_DEMOMODE') ||  get_option('users_can_register') == 1){ ?>
            <?php if(!$userdata->ID){ ?>
            <li class="icon1"> 
                     <a href="<?php echo wp_registration_url(); ?>">
                     <?php echo __("Sign up/in","premiumpress"); ?>
                     </a>
             </li>
             <?php }else{ ?>
             <li class="icon0"> 
                     <a href="<?php echo _ppt(array('links','myaccount')); ?>">
                     <?php echo __("My Account","premiumpress"); ?>
                     </a>
           </li>
           <?php } ?>
            
            </li>
            <li class="icon2"> <a href="<?php echo home_url(); ?>/?s=&favs=1"><?php echo __("Favorites","premiumpress"); ?><?php if($c2 > 0){ ?><span><?php echo $c2; ?></span><?php } ?></a></li>
            <?php } ?>
            
            <?php if(THEME_KEY == "sp" || _ppt('display_basket') == 1 ){ ?>
            <li class="icon3"> 
            
            <a href="<?php echo _ppt(array('links','cart')); ?>">
           
            <?php echo __("Basket","premiumpress"); ?><span class="cart-basket-count"></span>           
            </a>             
            
            </li>
            <?php } ?>
            
            </ul>
             
             
            </div>
         </div>
      </div>
   </div>