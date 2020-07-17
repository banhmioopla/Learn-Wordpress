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
<div class="elementor_footer footerpart <?php if(isset($settings['class'])){ echo $settings['class']." "; }else{ echo "bg-dark"; } ?>">
<div class="container py-3">
    
    <div class="row">    
    <div class="col-md-12 text-center">
   		<div class="copy mt-2 text-uppercase"><?php echo "&copy; ".date("Y")." - ".stripslashes(_ppt(array('company','name'))); ?></div>   
    </div>
     </div> 
</div>
</div>