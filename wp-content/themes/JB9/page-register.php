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

global $CORE, $errortext, $errorStyle, $userdata; 


function _hook_head(){
?>
 <script src='https://www.google.com/recaptcha/api.js'></script>
<?php }
if(_ppt('comment_captcha') == 1 && _ppt('google_recap_sitekey') != "" && _ppt('google_recap_secretkey') != ""){
add_action('wp_head','_hook_head');
}

?>


<?php if(defined('IS_MOBILEVIEW') && _ppt('mobileweb') == 1 ){ //   &&  !_ppt_checkfile("page-login-mobile.php") ?>

<?php get_template_part( '_mobile/page-register', 'mobile' );	?> 

<?php }elseif(!_ppt_checkfile("page-register.php")){ ?>


<?php get_header($CORE->pageswitch()); ?>
 
<main id="main"> 

	<?php //get_template_part( 'page', 'top' ); ?>   
    
    <?php hook_register_before(); ?>
    
        <?php if(strlen($errortext) > 1){ ?>
            <div class="alert <?php echo $errorStyle; ?> text-center"><?php echo $errortext; ?></div>
            <?php if(_ppt('register_mobilenum') == '1'){  ?>
            <script>			
			jQuery(document).ready(function() {
			jQuery('#sms-form-1').hide();
			jQuery('#sms-form-2').hide();
			jQuery('#registerform').show();
			});
			</script>
            <?php } ?>
        <?php } ?>        
  

	<?php if(_ppt('register_mobilenum') == '1'){  ?>
    <?php get_template_part('templates/register', 'mobile' ); ?>
    <?php } ?>
 
    <section>
    
    <?php get_template_part( 'ajax-modal', 'register' ); ?>

	</section>  

    <?php hook_register_after(); ?>

	<?php //get_template_part( 'page', 'bottom' ); ?>  
 
</main><!-- end main -->

<?php get_footer($CORE->pageswitch()); ?>

<?php } ?>