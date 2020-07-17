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

// ADDITONAL TEXT FOR THE LANGUAGE FILES
__("Popular","premiumpress");
__("Memberships","premiumpress");
__("Privacy","premiumpress");
__("Pages","premiumpress");
__("Terms &amp; Conditions","premiumpress");
__("Pricing","premiumpress"); 
__("How it works","premiumpress"); 

if(!_ppt_checkfile("404.php")){

?>
  
<?php global $CORE; ?>

<?php get_header($CORE->pageswitch()); ?>
 
<main id="main">
   <div class="container">
      <div class="row my-5">
         <div class="col-md-12 text-center">
            <i class="fa fa-close" style="font-size:2000%;"></i>    
            <h3 class="mb-3"><?php echo __("Looks like something's broken here.","premiumpress") ?></h3>
            <p class="mb-3"><?php echo __("The page you were looking for could not be found. Head back home, or ","premiumpress") ?></p>
            <a href="<?php echo home_url(); ?>/?s=" class="btn btn-lg btn-primary mt-4"><?php echo __("Search Website","premiumpress") ?></a>
         </div>
      </div>
   </div>
   <!-- end container -->
</main>
<!-- end main -->

<?php get_footer($CORE->pageswitch()); ?>

<?php } ?>