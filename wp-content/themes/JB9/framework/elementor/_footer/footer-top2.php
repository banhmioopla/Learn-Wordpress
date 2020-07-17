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
 

global $CORE, $settings; 

?>
<div class="elementor_footer footerpart footer-top2 footer_bot py-3 <?php if(isset($settings['class'])){ echo $settings['class']." "; } ?>">
<div class="container">
      <div class="row my-4">
         <div class="col-md-6 col-lg-4 d-none d-md-block d-lg-block">
         
         
<?php		 
// SET DEFAULTS
ob_start();
dynamic_sidebar('footer1'); 
$footer1 = ob_get_clean();
if(strlen($footer1) > 10){ echo $footer1; }else{	 
?>
         
            <h6 class="text-uppercase font-weight-bold mb-3"><?php echo __("Company Information","premiumpress"); ?></h6>
            <div class="text-uppercase mt-5"><?php echo _ppt(array('company','name')); ?></div>
            <div><?php echo _ppt(array('company','address')); ?></div>
            <div class="mb-3"><?php echo _ppt(array('company','phone')); ?></div>
            <div class="socials">
               <a class="social" target="_blank" href="<?php echo _ppt(array('social','twitter')); ?>" title="Twitter"><i class="text-light fa <?php echo _ppt(array('social','twitter_icon')); ?>"></i></a>
               <a class="social" target="_blank" href="<?php echo _ppt(array('social','facebook')); ?>" title="Facebook"><i class="text-light fa <?php echo _ppt(array('social','facebook_icon')); ?>"></i></a>
               <a class="social" target="_blank" href="<?php echo _ppt(array('social','dribbble')); ?>" title="Google plus"><i class="text-light fa <?php echo _ppt(array('social','dribbble_icon')); ?>"></i></a> 
               <a class="social" target="_blank" href="<?php echo _ppt(array('social','linkedin')); ?>" title="Dribbble"><i class="text-light fa <?php echo _ppt(array('social','linkedin_icon')); ?>"></i></a>
            </div>
            
<?php } ?>
            
            
         </div>
         <div class="col-md-4 d-none d-lg-block">
<?php		 
// SET DEFAULTS
ob_start();
dynamic_sidebar('footer2'); 
$footer1 = ob_get_clean();
if(strlen($footer1) > 10){ echo $footer1; }else{	 
?>         
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
<?php } ?>
         </div>
         <div class="col-lg-4 col-md-6">
<?php		 
// SET DEFAULTS
ob_start();
dynamic_sidebar('footer3'); 
$footer1 = ob_get_clean();
if(strlen($footer1) > 10){ echo $footer1; }else{	 
?>
            <h6 class="text-uppercase font-weight-bold mb-3"><?php echo __("Sign up for Newsletter","premiumpress") ?></h6>
            <p><?php echo __("Sign up to get our latest exclusive updates, deals, offers and promotions.","premiumpress") ?></p>
            <?php get_template_part( 'templates/widget', 'newsletter' ); ?> 
<?php } ?>
         </div>
      </div>
</div>
</div>