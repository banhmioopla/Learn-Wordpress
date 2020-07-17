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
 

global $CORE;

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
<footer class="bg-dark py-3 text-light text-uppercase">
   <div class="container">
      <?php if(strlen($CORE->BANNER('footer')) > 0){ ?>
      <div class="text-center">
         <div class="mt-4">
            <?php echo $CORE->BANNER('footer'); ?>
         </div>
      </div>
      <?php } ?>
      <div class="row">
         <div class="col-sm-12 col-md-4">
            <div class="copyright">&copy; <?php echo date("Y"); ?> - <?php echo stripslashes(_ppt(array('company','name'))); ?></div>
         </div>
         <div class="col-sm-12 col-md-8 text-right d-none d-md-block">
            <?php echo do_shortcode('[MAINMENU footer=1 class="footer-menu list-inline float-right"][/MAINMENU]'); ?>
         </div>
      </div>
   </div>
</footer>