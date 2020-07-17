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
<div class="elementor_footer footerpart footer-top4 py-3 <?php if(isset($settings['class'])){ echo $settings['class']." "; } ?>">
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
            <h3><?php echo __("Have a question?","premiumpress"); ?> <br> <?php echo __("contact us!","premiumpress"); ?></h3>
            <a href="<?php echo _ppt(array('links','contact')); ?>" class="btn btn-outline-secondary btn-lg mt-3"><?php echo __("Contact Us","premiumpress"); ?></a>
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
            <ul class="links clearfix mb-0 pr-lg-5">
               <li><a href="<?php echo _ppt(array('links','myaccount')); ?>"><?php echo __("My Account","premiumpress"); ?></a></li>
               <li><a href="<?php echo _ppt(array('links','blog')); ?>"><?php echo __("Blog","premiumpress"); ?></a></li>
               <li><a href="<?php echo _ppt(array('links','aboutus')); ?>"><?php echo __("About Us","premiumpress"); ?></a></li>
               <li><a href="<?php echo _ppt(array('links','contact')); ?>"><?php echo __("Contact","premiumpress"); ?></a></li>
            </ul>
<?php } ?>
         </div>
         <div class="col-md-4 d-none d-lg-block">
<?php		 
// SET DEFAULTS
ob_start();
dynamic_sidebar('footer3'); 
$footer1 = ob_get_clean();
if(strlen($footer1) > 10){ echo $footer1; }else{	 
?>
            <h6 class="text-uppercase font-weight-bold mb-3"><?php echo __("Our Mission","premiumpress"); ?></h6>
            <p><?php echo _ppt(array('company','mission')); ?></p>
            <a href="<?php echo _ppt(array('links','aboutus')); ?>"><b><?php echo __("read more","premiumpress"); ?></b></a>
<?php } ?>
         </div>
      </div>
   </div>
</div>