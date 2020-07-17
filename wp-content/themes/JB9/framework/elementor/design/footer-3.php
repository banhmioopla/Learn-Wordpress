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
 
if( ( _ppt('newsletter') == 1 || _ppt('newsletter') == 2 ) && !isset($_GET['mapsearch']) ){ ?>
<div class="newsletter-wrapper bg-primary my-1">
   <div class="container">
      <div class="row">
         <div class="col-md-6 pt-0 pb-0">
            <div class="text-holder">
               <h3><?php echo __("Sign up for Newsletter","premiumpress") ?></h3>
               <p><?php echo __("Sign up to get our latest exclusive updates, deals, offers and promotions.","premiumpress") ?></p>
            </div>
         </div>
         <div class="col-md-6 pt-0 pb-0">
            <?php get_template_part( 'templates/widget', 'newsletter' ); ?> 
         </div>
      </div>
   </div>
</div>
<?php } ?>