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
 

global $CORE, $settings; ?>
<div class="elementor_footer footerpart <?php if(isset($settings['class'])){ echo $settings['class']." "; } ?>">
<div class="container py-3">
      <div class="row">
         <div class="col-sm-12 col-md-4 text-center text-md-left">
            <div class="copyright"><?php echo "&copy; ".date("Y")." - ".stripslashes(_ppt(array('company','name'))); ?></div>
         </div>
         <div class="col-sm-12 col-md-8 text-right d-none d-md-block hide-mobile">
            <?php echo do_shortcode('[MAINMENU footer=1 class="footer-menu list-inline float-right"][/MAINMENU]'); ?>
         </div>
      </div> 
</div>
</div>