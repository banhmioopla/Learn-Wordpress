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

<div class="footer-1">
<div class="container">
    
    <div class="row">    
    <div class="col-md-6">
   		<div class="copy mt-2 text-uppercase">&copy; <?php echo date("Y"); ?> - <?php echo stripslashes(_ppt(array('company','name'))); ?></div>   
    </div>
    <div class="col-md-6">    
             
      <ul class="cards list-inline float-right mt-2">
               <li class="list-inline-item"><img src="<?php echo get_template_directory_uri()."/framework/img/icons/card1.jpg"; ?>" alt="payment" /></li>
               <li class="list-inline-item"><img src="<?php echo get_template_directory_uri()."/framework/img/icons/card2.jpg"; ?>" alt="payment" /></li>
               <li class="list-inline-item"><img src="<?php echo get_template_directory_uri()."/framework/img/icons/card3.jpg"; ?>" alt="payment" /></li>
               <li class="list-inline-item"><img src="<?php echo get_template_directory_uri()."/framework/img/icons/card4.jpg"; ?>" alt="payment" /></li>
            </ul>      
    </div>
    </div> 
</div>
</div>