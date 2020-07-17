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

global $CORE, $wpdb;

// LOAD IN MAIN DEFAULTS 
$core_admin_values = get_option("core_admin_values");  
 
  
?>
 <?php get_template_part('framework/admin/templates/admin', 'form-top' ); ?>
<div class="row">

<div class="col-lg-8">

<div class="bg-white p-5 shadow" style="border-radius: 7px;">


<div class="tabheader mb-4">

 
         <h4><span>Confirmation Email</span></h4>
      </div>


<p class="text-muted">This email is sent to the user once they subscribe to your mailing list and requires them to confirm their email address.</p>
  
            
            <label class="txt500">Email Subject</label>
            
             <input type="text" class="form-control"  name="admin_values[mailinglist][confirmation_title]" value="<?php echo stripslashes(_ppt(array('mailinglist','confirmation_title'))); ?>" 
			 <?php if(_ppt(array('mailinglist','confirmation_title')) == ""){ echo 'placeholder="Newsletter Confirmation"'; } ?>>  
             
             <div class="mt-3 mb-3">
             <style>
				.wp-switch-editor, .tmce-active .switch-tmce, .html-active .switch-html { height:27px !important; }
				</style>
             <?php echo wp_editor( _ppt(array('mailinglist','confirmation_message')), 'wlt_email', array( 'textarea_name' => 'admin_values[mailinglist][confirmation_message]') );  ?>
 			
            </div>
            
            <p class="my-2"><b>Remember</b> use the shortcode (link) for the confirmation link within your email.</p>
            
    
            <label class="txt500">Thank You Page</label>
             
             <input type="text"  class="form-control" name="adminArray[mailinglist_confirmation_thankyou]" placeholder="http://mywebiste.com/thankyou" value="<?php echo get_option('mailinglist_confirmation_thankyou'); ?>">
             
             <p class="py-2 text-muted">Users are sent to after they confirm email.</p>
           
            <label class="txt500">Unsubscribe Page</label>
              <input type="text"  class="form-control" name="adminArray[mailinglist_unsubscribe_thankyou]" placeholder="http://mywebiste.com/unsubscribe" value="<?php echo get_option('mailinglist_unsubscribe_thankyou'); ?>">
              
              <p class="py-2 text-muted">Users are sent to after they unsubscribe from your mailing list.</p>
             


 <button type="submit" class="btn btn-lg btn-primary btn-block rounded-0"><?php echo __("Save Settings","premiumpress-admin"); ?></button> 
    
</div></div>

<div class="col-lg-4">

 <a href="javascript:void(0);" onclick="jQuery('#MainTabs a[href=#ns1]').tab('show');"  class="btn btn-primary mb-4 btn-lg btn-block text-left"><i class="fa fa-arrow-left mr-3"></i> Go Back</a>
    

</div>

</div>
 <?php get_template_part('framework/admin/templates/admin', 'form-bottom' ); ?>