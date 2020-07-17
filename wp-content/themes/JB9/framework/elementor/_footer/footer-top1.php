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
<?php if(strlen(stripslashes(_ppt('advertising2'))) > 2){ ?>
<div class="text-center py-5 border-top bg-white">
<?php echo stripslashes(str_replace("form","",_ppt('advertising2'))); ?>
</div>
<?php } ?>
<div class="elementor_footer footerpart newsletter-wrapper <?php if(isset($settings['class'])){ echo $settings['class']." "; } ?>">
   <div class="container py-5">
      <div class="row">
         <div class="col-md-8 pt-0 pb-0">
         <?php		 
// SET DEFAULTS
ob_start();
dynamic_sidebar('footer1'); 
$footer1 = ob_get_clean();
if(strlen($footer1) > 10){ echo $footer1; }else{	 
?>
            <div class="text-holder">
               <h3 class="h3-lg"><?php echo __("Sign up for Newsletter","premiumpress") ?></h3>
               <p><?php echo __("Sign up to get our latest exclusive updates, deals, offers and promotions.","premiumpress") ?></p>
            </div>
            <?php } ?>
         </div>
         <div class="col-md-4 pt-0 pb-0">
                  <?php		 
// SET DEFAULTS
ob_start();
dynamic_sidebar('footer2'); 
$footer1 = ob_get_clean();
if(strlen($footer1) > 10){ echo $footer1; }else{	 
?>
            <?php get_template_part( 'templates/widget', 'newsletter' ); ?> 
            <?php } ?>
         </div>
      </div>
   </div>
</div>