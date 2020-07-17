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
global $CORE, $userdata, $wpdb, $settings;

// MY FAVOURITES
$c2 = 0;
if($userdata->ID){

	// MY FAVOURITES
	$c2 = $CORE->user_favs_count();
}

?>
<div class="header-2 ppt-header header-1 header-logo2 <?php if(isset($settings['class'])){ echo $settings['class']; } ?> <?php if(!isset($settings['sticky'])){ echo "no-sticky"; } ?>">
   <div class="center-menu-2"  id="header-logo">
      <div class="container py-4">
         <div class="row">
            <div class="col-md-3">
               <div class="logo text-left pl-0" data-mobile-logo="<?php echo hook_logo(array(1,0)); ?>" data-sticky-logo="<?php echo hook_logo(array(1,0)); ?>">
                  <a href="<?php echo get_home_url(); ?>/" title="<?php echo get_bloginfo('name'); ?>">
                  <?php echo hook_logo(0); ?>
                  </a>
               </div>
            </div>
            <div class="col-md-5 d-none d-lg-block">
            
            </div>
            <div class="col-md-4 d-none d-lg-block">
               <div class="hicons row float-right mt-1">
        <?php if(THEME_KEY == "sp" || ( isset($settings['basket']) && $settings['basket'] == 1 ) ){ ?>
         
                
         <a href="<?php echo _ppt(array('links','cart')); ?>">
                      <div class="icon icon-basket"> 
                   <span class="cart-basket-count count bg-secondary">0</span>
                     </div>
                     
          
         </a>
          
         
         <?php }else{ ?>
                  <a href="<?php if($userdata->ID){ ?><?php echo home_url(); ?>/?s=&favs=1<?php }else{ ?><?php echo site_url('wp-login.php?action=login', 'login_post'); ?><?php } ?>" class="mx-4 text-dark">
                     <div class="icon icon1"> 
                        <span class="count bg-secondary"><?php echo $c2; ?></span> 
                     </div>
                     <div class="small text-uppercase"><?php echo __("favorites","premiumpress"); ?></div>
                  </a>
        <?php } ?>
               </div>
            </div>
         </div>
      </div>
   </div>
      <div class="burger-menu mt-5">
      <div class="line-menu line-half first-line"></div>
      <div class="line-menu"></div>
      <div class="line-menu line-half last-line"></div>
   </div>
</div>