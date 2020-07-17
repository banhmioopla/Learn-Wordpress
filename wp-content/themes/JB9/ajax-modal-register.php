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

if(!_ppt_checkfile("ajax-modal-register.php")){
?>
<div class="modal-dialog " role="document">
   <div class="modal-content">
      <form class="registerform ajax_modal" name="registerform" id="registerform" action="<?php echo site_url('wp-login.php?action=register', 'login_post'); ?>" method="post" 
         onsubmit="return js_validate_fields('<?php echo __("Please completed required fields.","premiumpress") ?>')">
         
          <?php if(isset($_GET['redirect'])){ ?>
               <input type="hidden" name="redirect_to" value="<?php echo esc_attr($_GET['redirect']); ?>" /> 
               <?php }elseif(isset($_GET['redirect_to']) && $_GET['redirect_to'] != ""){ ?>
               <input type="hidden" name="redirect_to" value="<?php echo esc_attr($_GET['redirect_to']); ?>" /> 
               <?php } ?>
         
         <div class="text-center titleblock">
            <h4 class="title"><?php echo __("New Member","premiumpress") ?></h4>
            <p class="subtitle"><?php echo __("Create your free account now and enjoy all of the member benefits.","premiumpress"); ?></p>
         </div>
         <div class="line bg-primary">&nbsp;</div>
         <div class="modal-body">
            <div class="row">
               <?php if(_ppt('allow_socialbuttons') == 1){  $providers = array( "Twitter", "Facebook", "Google", "Linkedin" ); foreach($providers as $key ){ if(_ppt('social_'.strtolower($key).'') == '1'){   ?>                  
               <div class="col-xs-12 col-md-12 mb-3">
                  <a class="btn btn-<?php echo strtolower($key); ?> btn-block" href="<?php echo home_url(); ?>/?sociallogin=<?php echo $key; ?>" rel="nofollow">
                  <?php echo __("Register With","premiumpress"); ?> <?php echo $key; ?>
                  </a>
               </div>
               <?php } } ?>
               <div class="col-xs-12 col-md-12">
                  <div class="login-modal-or">
                     <div><span><?php echo __("or","premiumpress"); ?></span></div>
                  </div>
               </div>
               <?php } ?>
              
               <div class="col-xs-12 col-md-12">
                  <div class="form-group">
                     <div class="row">
                        <div class="col-md-12">
                           <input type="text" name="first_name"  tabindex="1" value="<?php if(isset($_POST['first_name'])){ echo esc_html(strip_tags($_POST['first_name'])); } ?>" class="form-control required" placeholder="<?php echo __("First Name","premiumpress") ?>">                 
                        </div>
                     </div>
                  </div>
               </div>
               <div class="col-xs-12 col-md-12">
                  <div class="form-group">
                     <div class="row">
                        <div class="col-md-12">
                           <input type="text" name="last_name" tabindex="2" value="<?php if(isset($_POST['last_name'])){ echo esc_html(strip_tags($_POST['last_name'])); } ?>" class="form-control required" placeholder="<?php echo __("Last Name","premiumpress") ?>">                 
                        </div>
                     </div>
                  </div>
               </div>
               <hr class="dashed" />
               <div class="col-xs-12 col-md-12">
                  <div class="form-group">
                     <div class="row">
                        <div class="col-md-12">
                           <input type="text" name="user_login" tabindex="3" value="<?php if(isset($_POST['user_login'])){ echo esc_html(strip_tags($_POST['user_login'])); } ?>" class="form-control required" placeholder="<?php echo __("Username","premiumpress"); ?>">                 
                        </div>
                     </div>
                  </div>
               </div>
               <?php if(_ppt('register_mobilenum') == '1' || _ppt('register_mobilenum_basic') == '1' ){  ?>
               <div class="col-xs-12 col-md-12">
                  <div class="form-group">
                     <div class="row">
                        <div class="col-md-12">
                           <label class="col-form-label"><?php echo __("Mobile Number","premiumpress"); ?></label>
                        </div>
                        <div class="col-md-12">
                           <div class="row">
                              <div class="col-4">
                                 <input name="custom[mobile-prefix]" type="text" class="form-control required" id="mobileprefix-input" placeholder="+" 
                                    value="<?php if(isset($_POST['custom']['mobile-prefix'])){ echo esc_html(strip_tags($_POST['custom']['mobile-prefix'])); } ?>" />            
                              </div>
                              <div class="col-8">
                                 <input name="custom[mobile]" type="text" class="form-control required" id="mobilenum-input"
                                    value="<?php if(isset($_POST['custom']['mobile-num'])){ echo esc_html(strip_tags($_POST['custom']['mobile-num'])); } ?>" />        
                              </div>
                           </div>
                           <!-- end row -->      
                        </div>
                     </div>
                  </div>
               </div>
               <?php } ?>   
               <div class="col-xs-12 col-md-12">
                  <div class="form-group">
                     <div class="row">
                        <div class="col-md-12">
                           <input type="text" name="user_email" id="user_email" tabindex="4" value="<?php if(isset($_POST['user_email'])){ echo esc_html(strip_tags($_POST['user_email'])); } ?>" class="form-control required" placeholder="<?php echo __("Email","premiumpress"); ?>">                 
                        </div>
                     </div>
                  </div>
               </div>
               <?php echo $CORE->user_fields(); ?>
               <?php if(_ppt('visitor_password') == '1'){  ?>
               <div class="col-xs-12 col-md-12">
                  <div class="form-group">
                     <div class="row">
                        <div class="col-md-8">                 
                           <input type="password" name="pass1" id="pass1" value="<?php if(isset($_POST['pass1'])){ echo esc_html(strip_tags($_POST['pass1'])); } ?>" tabindex="200" class="form-control required" placeholder="<?php echo __("Password","premiumpress"); ?>"> 
                        </div>
                     </div>
                  </div>
                  <div class="form-group">
                     <div class="row">
                        <div class="col-md-8">                  
                           <input type="password" name="pass2" id="pass2" value="<?php if(isset($_POST['pass2'])){ echo esc_html(strip_tags($_POST['pass2'])); } ?>" tabindex="201" class="form-control required" placeholder="<?php echo __("Confirm Password","premiumpress"); ?>">                      
                        </div>
                     </div>
                  </div>
               </div>
               <?php } ?>                
                
               <?php if(_ppt('comment_captcha') == 1 && ( _ppt('google_recap_sitekey') != "" && _ppt('google_recap_secretkey') != "" ) ){ ?>
               
               <div class="g-recaptcha mt-2 ml-3" data-sitekey="<?php echo stripslashes(_ppt('google_recap_sitekey')); ?>"></div>
               
               <?php }elseif(_ppt('comment_captcha') == 1){  $reg_nr1 = rand("0", "9"); $reg_nr2 = rand("0", "9");?>
               
               <div class="col-xs-12 col-md-12">
                  <div class="form-group">
                     <div class="row">
                        <div class="col-md-12">
                           <label class="col-form-label"> <?php echo __("Security Question","premiumpress") ?> </label>
                        </div>
                        <div class="col-md-12">
                           <div class="input-group">
                               
                              <input type="text" name="reg_val" tabindex="500" class="form-control required"  placeholder="<?php echo $reg_nr1; ?> + <?php echo $reg_nr2; ?> ="> 
                              <input type="hidden" name="reg1" value="<?php echo $reg_nr1; ?>" />
                              <input type="hidden" name="reg2" value="<?php echo $reg_nr2; ?>" />
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
               
               <?php } ?>
               
               
               <?php $cmemberships = get_option("cmemberships"); if(is_array($cmemberships) && !empty($cmemberships) && isset($cmemberships[0]['key'] ) && $cmemberships[0]['key'] != "" ){ ?>
               <hr class="dashed" />
               <p><?php echo __("Please select a membership type from the list below;","premiumpress") ?></p>
               <?php get_template_part('templates/extra', 'memberships' ); ?>
               <?php } ?> 
               <?php do_action('register_form'); ?>
            </div>
         </div>
         
         	<div class="clearfix ml-3 mb-4">
            <input type="checkbox" id="agreepp1" value="1" />
			<?php echo __("You read and agree to our","premiumpress"); ?> <a href="<?php echo _ppt(array('links','privacy')); ?>" target="_blank"><u><?php echo __("privacy policy.","premiumpress"); ?></u></a></small>
         	</div>
            
            <div class="clearfix"></div>
           
         <div class="modal-footer text-center">
            <button type="submit" name="wp-submit" id="wp-submit-register" class="btn btn-primary btn-block rounded-0 py-3"  disabled><?php echo __("Register","premiumpress"); ?></button>
         </div>
      </form>
      <script>
jQuery(document).ready(function(){

	jQuery('#agreepp1').click(function(){
		if (this.checked) {
			 jQuery('#wp-submit-register').prop("disabled", false);
		}
	});

});
	  </script>
   </div>
</div>
<?php } ?>