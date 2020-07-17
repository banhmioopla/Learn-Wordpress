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

global $CORE, $errortext, $userdata, $errorStyle; 



function _hook_head(){
?>
 <script src='https://www.google.com/recaptcha/api.js'></script>
<?php }
if(_ppt('comment_captcha') == 1 && ( _ppt('google_recap_sitekey') != "" && _ppt('google_recap_secretkey') != "" ) ){
add_action('wp_head','_hook_head');
}

?>

<?php if(defined('IS_MOBILEVIEW') && _ppt('mobileweb') == 1 ){   ?>

<?php get_template_part( '_mobile/page-login', 'mobile' );	?> 

<?php }elseif(!_ppt_checkfile("page-login.php")){ ?>

<?php get_header($CORE->pageswitch()); ?>
<main id="main">
   <?php //get_template_part( 'page', 'top' ); ?>
   <div class="container">
      <?php hook_login_before(); ?>  
      <section>
         <?php if(strlen($errortext) > 1){ ?>
         <div class="alert my-5 rounded-0 <?php echo $errorStyle; ?> text-center"><?php echo $errortext; ?></div>
         <?php } ?> 
         
         
         <?php if($userdata->ID){ ?>
         
         <div class="row"> 
         <div class="col-lg-12 py-5 text-center">
         
         <h1 class="h2"><?php echo __("You are already logged in!","premiumpress") ?></h1>          
          
         <a href="<?php echo _ppt(array('links','myaccount')); ?>" class="btn btn-primary btn-lg mt-5"><?php echo __("My Account","premiumpress") ?></a>
           
         </div>
         </div>
         
         <?php }elseif(get_option('users_can_register') == 1){ ?>
         
         <div class="row"> 
         <div class="col-lg-6">
         <?php get_template_part( 'ajax-modal', 'login' ); ?>
         </div>
         <div class="col-lg-6">
         <?php get_template_part( 'ajax-modal', 'register' ); ?>
         </div>
         </div>
         
         <?php }else{ ?>
         
         <?php get_template_part( 'ajax-modal', 'login' ); ?>
         
         <?php } ?>       
          
      </section>
      <?php hook_login_after(); ?>
   </div>
   <?php //get_template_part( 'page', 'bottom' ); ?>  
</main>
<script>
jQuery(document).ready(function(){
jQuery('button.close').hide();
});
</script>
<?php get_footer($CORE->pageswitch()); ?>

<?php } ?>