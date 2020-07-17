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
    
   global $CORE, $post, $userdata, $settings;
   
   ?>
<?php if(isset($GLOBALS['error_message'])){ ?>
<div class="alert alert-<?php echo $GLOBALS['error_type']; ?> text-center mb-5">
   <h4 class="alert-heading"><?php echo $GLOBALS['error_message']; ?></h4>
</div>
<?php } ?>
<form  role="form" method="post" action="" onsubmit="return CheckFormData();">
   <input type="hidden" name="action" value="singlecontactform" />
   <div id="html_element"></div>
   <?php if(isset($_GET['report']) && is_numeric($_GET['report']) ){ ?><input type="hidden" name="report" value="<?php echo strip_tags($_GET['report']); ?>" /><?php } ?>
   <div class="row">
      <div class="col-12 col-md-6">
         <label><?php echo __("First Name","premiumpress") ?>  <span class="required">*</span></label>
         <div class="controls mb-3"> 
            <input type="text" class="form-control" name="form[name]" id="name">
         </div>
      </div>
      <div class="col-12 col-md-6">
         <label><?php echo __("Last Name","premiumpress") ?></label>
         <div class="controls mb-3"> 
            <input type="text" class="form-control" name="form[name1]" id="name1">
         </div>
      </div>
      <div class="col-12 col-md-6">
         <label><?php echo __("Email","premiumpress") ?> <span class="required">*</span></label>
         <div class="controls mb-3"> 
            <input type="text" class="form-control" id="email1" name="form[email]">
         </div>
      </div>
      <div class="col-12 col-md-6">
         <label><?php echo __("Phone","premiumpress") ?> </label>
         <div class="controls mb-3">
            <input type="text" class="form-control" id="phone" name="form[phone]">
         </div>
      </div>
      <div class="col-12">
         <label><?php echo __("Message","premiumpress") ?> <span class="required">*</span> </label>
         <div class="controls mb-3">
            <textarea name="form[message]" class="form-control" id="message" style="height:150px; width:100%;"></textarea>
         </div>
      </div>
      <?php if(_ppt('comment_captcha') == 1 && _ppt('google_recap_sitekey') != "" ){ ?>
      <div class="col-12">
         <div class="g-recaptcha mt-2" data-sitekey="<?php echo stripslashes(_ppt('google_recap_sitekey')); ?>"></div>
      </div>
      <?php } ?>   
      <div class="col-12 my-3"> 
         <input name="agreetc" type="checkbox" id="agreetc" onchange="UpdateTCA()" /> <?php echo sprintf(__( "Agree to <a href=\"%s\">terms &amp; conditions.</a>", "premiumpress"), ""._ppt(array('links','terms'))."", ""  ); ?>
      </div>
      <div class="col-12">
         <button type="submit" id="btncontactform" class="btn btn-primary rounded-0 py-3" disabled><?php echo __("Send Message","premiumpress") ?></button>	
      </div>
   </div>   
</form>
<script>
   function UpdateTCA(){					 
		if(jQuery('#agreetc').is(':checked') ){                        	
			jQuery('#btncontactform').removeAttr("disabled");
		}else{
			jQuery('#btncontactform').attr("disabled", true);                       
		} 					 
	}
   function CheckFormData()
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