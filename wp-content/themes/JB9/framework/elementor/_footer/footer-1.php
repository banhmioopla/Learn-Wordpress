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
 
global $CORE, $userdata; 
?>
<footer class="elementor_footer bg-dark p-4 text-light footer-1">
   <div class="container">
      <?php if(strlen($CORE->BANNER('footer')) > 0){ ?>
      <div class="row">
         <div class="col-12 text-center mt-4">
            <?php echo $CORE->BANNER('footer'); ?>
         </div>
      </div>
      <?php } ?>
      <div class="row my-4">
         <div class="col-md-6 col-lg-4 d-none d-md-block d-lg-block">
            <h6 class="text-uppercase font-weight-bold mb-3"><?php echo __("Company Information","premiumpress"); ?></h6>
            <div class="text-uppercase mt-5"><?php echo _ppt(array('company','name')); ?></div>
            <div><?php echo _ppt(array('company','address')); ?></div>
            <div class="mb-3"><?php echo _ppt(array('company','phone')); ?></div>
            <div class="socials">
               <a class="social" target="_blank" href="<?php echo _ppt(array('social','twitter')); ?>" title="Twitter"><i class="fa <?php echo _ppt(array('social','twitter_icon')); ?>"></i></a>
               <a class="social" target="_blank" href="<?php echo _ppt(array('social','facebook')); ?>" title="Facebook"><i class="fa <?php echo _ppt(array('social','facebook_icon')); ?>"></i></a>
               <a class="social" target="_blank" href="<?php echo _ppt(array('social','dribbble')); ?>" title="Google plus"><i class="fa <?php echo _ppt(array('social','dribbble_icon')); ?>"></i></a> 
               <a class="social" target="_blank" href="<?php echo _ppt(array('social','linkedin')); ?>" title="Dribbble"><i class="fa <?php echo _ppt(array('social','linkedin_icon')); ?>"></i></a>
            </div>
         </div>
         <div class="col-md-4 d-none d-lg-block">
            <h6 class="text-uppercase font-weight-bold mb-3"><?php echo __("Useful Links","premiumpress"); ?></h6>
            <div class="row">
               <div class="col-md-6">
                  <ul class="links clearfix mb-0">
                     <li><a href="<?php echo _ppt(array('links','myaccount')); ?>"><?php echo __("My Account","premiumpress"); ?></a></li>
                     <li><a href="<?php echo _ppt(array('links','blog')); ?>"><?php echo __("Blog","premiumpress"); ?></a></li>
                     <li><a href="<?php echo _ppt(array('links','aboutus')); ?>"><?php echo __("About Us","premiumpress"); ?></a></li>
                     <li><a href="<?php echo _ppt(array('links','contact')); ?>"><?php echo __("Contact","premiumpress"); ?></a></li>
                  </ul>
               </div>
               <div class="col-md-6">        
                  <?php echo do_shortcode('[MAINMENU footer=1 class="links"][/MAINMENU]'); ?>     
               </div>
            </div>
         </div>
         <div class="col-lg-4 col-md-6">
            <h6 class="text-uppercase font-weight-bold mb-3"><?php echo __("Sign up for Newsletter","premiumpress") ?></h6>
            <p><?php echo __("Sign up to get our latest exclusive updates, deals, offers and promotions.","premiumpress") ?></p>
            <?php get_template_part( 'templates/widget', 'newsletter' ); ?> 
         </div>
      </div>
      <hr />
      <div class="row">
         <div class="col-sm-12 col-md-4">
            <div class="copyright">&copy; <?php echo date("Y"); ?> - <?php echo stripslashes(_ppt(array('company','name'))); ?></div>
         </div>
         <div class="col-sm-12 col-md-8 text-right d-none d-md-block">
            <ul class="cards list-inline float-right">
               <li class="list-inline-item"><img src="<?php echo get_template_directory_uri()."/framework/img/icons/card1.jpg"; ?>" alt="payment" /></li>
               <li class="list-inline-item"><img src="<?php echo get_template_directory_uri()."/framework/img/icons/card2.jpg"; ?>" alt="payment" /></li>
               <li class="list-inline-item"><img src="<?php echo get_template_directory_uri()."/framework/img/icons/card3.jpg"; ?>" alt="payment" /></li>
               <li class="list-inline-item"><img src="<?php echo get_template_directory_uri()."/framework/img/icons/card4.jpg"; ?>" alt="payment" /></li>
            </ul>
         </div>
      </div>
   </div>
</footer>