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


if(!_ppt_checkfile("ajax-modal-login.php")){
?>
<div class="modal-dialog" role="document">
   <div class="modal-content">
      <form id="loginform" class="loginform ajax_modal" action="<?php echo esc_url( site_url( 'wp-login.php', 'login_post' ) ); ?>" method="post" >
         <input type="hidden" name="testcookie" value="1" /> 
         <input type="hidden"  name="rememberme" id="rememberme"  value="1" /> 
         <button type="button" class="close modalclose" data-dismiss="modal" aria-label="Close" onclick="jQuery('.modal-backdrop').hide();" style="cursor:pointer;">
         <span aria-hidden="true">&times;</span>
         </button>
         <div class="text-center titleblock">
            <h4 class="title"><?php echo __("Members Area","premiumpress") ?></h4>
            <p class="subtitle"><?php echo __("Please sign-in to access this page and enjoy the other member benefits.","premiumpress"); ?></p>
         </div>
         <div class="line bg-primary">&nbsp;</div>
         <div class="modal-body mt-2">
            <div class="row gap-20">
               <?php if(_ppt('allow_socialbuttons') == 1){  $providers = array( "Twitter", "Facebook", "Google", "Linkedin" ); foreach($providers as $key ){ if(_ppt('social_'.strtolower($key).'') == '1'){   ?>                  
               <div class="col-xs-12 col-md-12 mb-3">
                  <a class="btn btn-<?php echo strtolower($key); ?> btn-block" href="<?php echo home_url(); ?>/?sociallogin=<?php echo $key; ?>" rel="nofollow">
                  <?php echo __("Login With","premiumpress"); ?> <?php echo $key; ?>
                  </a>
               </div>
               <?php } } ?>
               <div class="col-xs-12 col-md-12">
                  <div class="login-modal-or">
                     <div><span><?php echo __("or","premiumpress"); ?></span></div>
                  </div>
               </div>
               <?php } ?>
               <div class="col-xs-12 col-sm-12 col-md-12">
                  <div class="form-group">
                     <input type="text" class="form-control" name="log" id="user_login" value="<?php if(isset($_GET['admindemo'])){ echo "admindemo"; }?>" title="Please enter you username"  placeholder=" <?php echo __("Username","premiumpress"); ?> 
                        <?php if(_ppt('register_mobilenum') == '1'){  ?> / <?php echo __("Mobile Number","premiumpress"); ?><?php } ?>">
                     <span class="help-block"></span>
                  </div>
               </div>
               <div class="col-xs-12 col-sm-12 col-md-12">
                  <div class="form-group">
                     <input type="password" class="form-control" name="pwd" id="user_pass" value="<?php if(isset($_GET['admindemo'])){ echo "admindemo"; }?>" title="Please enter your password" placeholder="<?php echo __("Password","premiumpress"); ?>">
                     <span class="help-block"></span>
                  </div>
               </div>
               <?php do_action('login_form'); ?>
               <div class="col-xs-12 col-sm-12 col-md-12">
                  <div class="form-group">		
                     <button type="submit" name="wp-submit" id="wp-submit" class="btn btn-primary btn-block rounded-0 py-3" style="cursor:pointer;">
                     <i class="fa fa-lock mr-2" aria-hidden="true"></i>
                     <?php echo __("Member Login","premiumpress"); ?>
                     </button>
                  </div>
               </div>
               <?php if(get_option('users_can_register') == 1){ ?>
               <div class="col-xs-12 col-sm-12 col-md-12">
                  <div class="register-box-box-action text-center mt-3">
                     <?php echo __("No account?","premiumpress"); ?> <a href="<?php if(_ppt(array('links','register')) != ""){ echo _ppt(array('links','register')); }else{ echo wp_registration_url(); } ?>" class="btn-ajax-register"><?php echo __("Register","premiumpress"); ?></a> / 
					 
					 
					 <a href="<?php if(_ppt(array('links','password')) == ""){ echo wp_lostpassword_url(''); }else{ echo _ppt(array('links','password')); } ?>" class="btn-ajax-register"><?php echo __("forgotten password?","premiumpress"); ?></a>
					 
                  </div>
               </div>
               <?php } ?>
            </div>
         </div>
      </form>
   </div>
</div>
<?php if(defined('WLT_DEMOMODE') && isset($_GET['admindemo'])){  ?>
<script>
jQuery(document).ready(function () {
    jQuery("form#loginform").submit();
});
</script>
<?php } ?>
<?php } ?>