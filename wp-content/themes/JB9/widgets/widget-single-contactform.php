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
   
      // RANDOM NUMBERS
   $email_nr1 = rand("0", "9"); $email_nr2 = rand("0", "9"); 
   
   global $post, $settings;
   ?>
   
   <div class="widget" id="widget-contactme" data-title="<?php echo __("Contact Me","premiumpress") ?>">
    
   
<?php if(!isset($settings['show_title']) || ( isset($settings['show_title']) && $settings['show_title'] != 0) ){ ?>         
<div class="widget-title">

<i class="fa fa-envelope float-right mt-1" aria-hidden="true"></i>

<span><?php if(isset($settings['title']) && strlen($settings['title']) > 1 ){ echo $settings['title']; }else{ echo __("Contact Me","premiumpress"); } ?></span></div>
<?php } ?>
 
 
   <?php 
   
   // CHECK IF LISTING CONTACT EMAIL IS SET BY ADMIN
   $g = _ppt(array('emails','listingcontactform')); 
   
   if( current_user_can('administrator') && ( !isset($g['enable']) || (isset($g['enable']) && $g['enable'] == 0) ) ){ ?>
   <div class="alert alert-danger">
   <strong>Admin Notice:</strong>
   The listing contact form email has been disabled or has not been setup. Please check your PremiumPress email setup tab in the admin.
   </div>
   <?php } ?>   
    
   <?php 	  
      if(isset($GLOBALS['error_message']) && isset($GLOBALS['error_type']) && $GLOBALS['error_type'] == "error"){ ?>
   <div class="alert alert-info text-center">
    <strong>Admin Notice:</strong>
      <?php echo $GLOBALS['error_message']; ?>
   </div>
   <?php }elseif(isset($GLOBALS['error_message']) && isset($GLOBALS['error_type']) && $GLOBALS['error_type'] == "success"){  ?>
   <div class="alert alert-success">
    
      <strong><?php echo __("Good News!","premiumpress"); ?></strong>
      <?php echo __("Your message has been sent - thank you.","premiumpress"); ?>
   </div>
   <script>
      jQuery(document).ready(function() {               	 
      		jQuery('.contactform').html('');               	 
      
      });
      
   </script> 
   <?php } ?>

   <form role="form" method="post" action="<?php echo get_permalink($post->ID); ?>" onsubmit="return CheckContactFormData();" class="contactform">
      <input type="hidden" name="code_value" value="<?php echo ($email_nr1+$email_nr2); ?>" />
      <input type="hidden" name="action" value="contactform" />
      <input type="hidden" name="pid" value="<?php echo $post->ID; ?>" /> 
     
      <div class="row">
         <div class="col-12 col-md-6">
            <label><?php echo __("Full Name","premiumpress") ?>  <span class="required">*</span></label>
            <div class="controls mb-3"> 
               <input type="text" class="form-control form-control-sm" name="contact_n1" id="name" tabindex="1" value="<?php if(isset($GLOBALS['error_message']) && isset($GLOBALS['error_type']) && $GLOBALS['error_type'] == "error"){ echo esc_html($_POST['contact_n1']); } ?>">
            </div>
         </div>
         <div class="col-md-6">
            <label><?php echo __("Telephone","premiumpress") ?> </label>
            <div class="controls mb-3">
               <input type="text" class="form-control form-control-sm" id="phone" name="contact_p1" tabindex="3" value="<?php if(isset($GLOBALS['error_message']) && isset($GLOBALS['error_type']) && $GLOBALS['error_type'] == "error"){ echo esc_html($_POST['contact_p1']); } ?>" >
            </div>
         </div>
         <div class="col-12">
            <label><?php echo __("Email","premiumpress") ?> <span class="required">*</span></label>
            <div class="controls mb-3"> 
               <input type="text" class="form-control form-control-sm" id="email1" name="contact_e1" tabindex="2" value="<?php if(isset($GLOBALS['error_message']) && isset($GLOBALS['error_type']) && $GLOBALS['error_type'] == "error"){ echo esc_html($_POST['contact_e1']); } ?>">
            </div>
         </div>

      </div>
      <div class="form-group ">
         <label><?php echo __("Message","premiumpress") ?> <span class="required">*</span> </label>
         <div class="controls mb-3">
            <textarea name="contact_m1" class="form-control form-control-sm" id="message" tabindex="5" style="height:110px; width:100%;"><?php if(isset($GLOBALS['error_message']) && isset($GLOBALS['error_type'])  && $GLOBALS['error_type'] == "error"){ echo esc_html($_POST['contact_m1']); } ?></textarea>
         </div>
      </div>
      
      

      
      
      <?php if(_ppt('comment_captcha') == 1 && _ppt('google_recap_sitekey') != "" ){ ?>
      <div class="col-12 mb-3">
         <div class="g-recaptcha mt-2" data-sitekey="<?php echo stripslashes(_ppt('google_recap_sitekey')); ?>"></div>
      </div>
      <script src='https://www.google.com/recaptcha/api.js'></script>
      <?php }else{ ?>   
      <input type="hidden" name="code_value" value="<?php echo ($email_nr1+$email_nr2); ?>" />
        <div class="row">
                 <div class="col-md-12">
                    <label>  <?php echo str_replace("%a",$email_nr1,str_replace("%b",$email_nr2,__("Security: %a + %b ?","premiumpress"))); ?> <span class="required">*</span></label> 
                    <input type="text" name="contact_code" value="" class="form-control form-control-sm"  id="code" tabindex="4" /> 
                 </div>
        </div>
        <?php } ?>
      
      
      
      <div class="clearfix"></div>
      <hr />
      <div class="clearfix">
         <input name="agree-widget-contactform" type="checkbox" id="agree-widget-contactform" class="float-left mr-2 mt-1" onchange="UpdateContactFormCheck()" />
         <span class="small float-left" > <?php echo sprintf(__( "Agree to <a href=\"%s\">terms &amp; conditions.</a>", "premiumpress"), ""._ppt(array('links','terms'))."", ""  ); ?></span>
      </div>
      <button type="submit" class="btn btn-primary btn-block mt-3 rounded-0" disabled id="btn-agree-widget-contactform"><?php echo __("Send Message","premiumpress") ?> </button>

</form>


</div>

<script>					 
function UpdateContactFormCheck(){
	if(jQuery("#agree-widget-contactform").is(':checked') ){
		jQuery('#btn-agree-widget-contactform').removeAttr("disabled");	
	}else{	
		jQuery('#btn-agree-widget-contactform').attr("disabled", true);
		alert("<?php echo __("Please agree to the website terms and conditions.","premiumpress"); ?>");
		return false;	
	}
}
   
 
      function CheckContactFormData()
      {
      
      	
      	var name 	= document.getElementById("name"); 
      	var email1 	= document.getElementById("email1");
      	var code = document.getElementById("code");
      	var message = document.getElementById("message");	 
      				
      	if(name.value == '')
      	{
      		alert('<?php echo __("Please complete all required fields.","premiumpress") ?>');
      		name.focus();
      		name.style.border = 'thin solid red';
      		return false;
      	}
      	if(email1.value == '')
      	{
      		alert('<?php echo __("Please complete all required fields.","premiumpress") ?>');
      		email1.focus();
      		email1.style.border = 'thin solid red';
      		return false;
      	}
      	
      
      	if(code.value == '')
      	{ 
      		alert('<?php echo __("Please complete all required fields.","premiumpress") ?>');
      		code.focus();
      		code.style.border = 'thin solid red';
      		return false;
      	} 
      	
      	if(code.value != '<?php echo $email_nr1+$email_nr2; ?>')
      	{
      		alert('<?php echo __("The verification code is incorrect.","premiumpress") ?>');
      		message.focus();
      		message.style.border = 'thin solid red';
      		return false;
      	}
      	
      	if(message.value == '')
      	{
      		alert('<?php echo __("Please complete all required fields.","premiumpress") ?>');
      		message.focus();
      		message.style.border = 'thin solid red';
      		return false;
      	}  
      	
      	return true;
      }
   </script>