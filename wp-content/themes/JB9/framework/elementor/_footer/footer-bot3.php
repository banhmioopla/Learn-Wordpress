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
            <div class="copy mt-2"><?php echo "&copy; ".date("Y")." - ".stripslashes(_ppt(array('company','name'))); ?></div>
   </div>
   
   <div class="col-sm-12 col-md-8 text-right d-none d-md-block hide-mobile">
            <ul class="cards list-inline float-right">
               <li class="list-inline-item"><img src="<?php echo get_template_directory_uri()."/framework/img/icons/card1.jpg"; ?>" alt="payment" /></li>
               <li class="list-inline-item"><img src="<?php echo get_template_directory_uri()."/framework/img/icons/card2.jpg"; ?>" alt="payment" /></li>
               <li class="list-inline-item"><img src="<?php echo get_template_directory_uri()."/framework/img/icons/card3.jpg"; ?>" alt="payment" /></li>
               <li class="list-inline-item"><img src="<?php echo get_template_directory_uri()."/framework/img/icons/card4.jpg"; ?>" alt="payment" /></li>
            </ul>
    </div>
</div> 
</div>
</div>