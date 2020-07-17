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
 

global $CORE, $settings; ?><div class="elementor_footer footer_bot footerpart <?php if(isset($settings['class'])){ echo $settings['class']." "; } ?>">
<div class="container py-3">
    
    <div class="row">    
    <div class="col-md-6 text-center text-md-left">
   		<div class="copy mt-1 h6"><?php echo "&copy; ".date("Y")." - ".stripslashes(_ppt(array('company','name'))); ?></div>   
    </div>
    <div class="col-md-6 text-right hide-mobile"> 
             
         <a id="#top" class="mr-2" href="#"><i class="fa fa-angle-up fa-2x"></i></a>       
    </div>
    </div> 
</div>
</div>