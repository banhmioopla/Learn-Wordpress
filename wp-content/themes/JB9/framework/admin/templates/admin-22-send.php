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


<div class="row">

<div class="col-lg-8">

<div class="bg-white p-5 shadow" style="border-radius: 7px;">



<?php if(isset($GLOBALS['error_message'] )){ ?>
<div class="alert font-weight-bold alert-success"> <button type="button" class="close" data-dismiss="alert">x</button> <?php echo $GLOBALS['error_message'] ; ?> </div>
<?php } ?>



<div class="tabheader mb-4"><h4>Send Newsletter</h4></div>
  







 
<form method="post" name="admin_email" id="admin_email" action="admin.php?page=22" >
 
<input type="hidden" name="tab" value="tab-newslettertab4" />
<input type="hidden" name="action" value="sendemail" />  

 
      
      <label class="txt500">Subject</label>
      
      <input type="text" name="subject" class="form-control my-3"/>
            
      
      <label class="txt500">Content</label>
      
      <textarea class="form-control mt-3" style="height:350px !important;" name="message"></textarea> 
    
            
 

<div class="savebtnbox p3"><button type="submit" class="btn btn-lg btn-dark mt-3"><?php echo __("Send Newsletter","premiumpress-admin"); ?></button> </div> 
  
</form>


<div class="alert alert-info mt-3 rounded-0 small">The message you send below will be emailed to ALL of your active subscribers. Use the tag <code>(unsubscribe)</code> to include an unsubscribe link in your email.</div>


</div></div>

<div class="col-lg-4">

 <a href="javascript:void(0);" onclick="jQuery('#MainTabs a[href=#ns1]').tab('show');"  class="btn btn-primary mb-4 btn-lg btn-block text-left"><i class="fa fa-arrow-left mr-3"></i> Go Back</a>
    

</div>

</div>     