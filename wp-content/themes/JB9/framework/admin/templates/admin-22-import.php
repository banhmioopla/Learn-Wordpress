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


<div class="tabheader mb-4">

 
         <h4><span>Import Subscribers</span></h4>
      </div>




 <?php if(isset($GLOBALS['error_message'] )){ ?>
<div class="alert font-weight-bold alert-success"> <button type="button" class="close" data-dismiss="alert">x</button> <?php echo $GLOBALS['error_message'] ; ?> </div>
<?php } ?>

<form method="post"  action="admin.php?page=22" >
 
<input type="hidden" name="tab" value="tab-newslettertab3" />
<input type="hidden" name="action" value="importemails" />  
 
<div class="mt-3 mb-3 text-muted">Enter email addresses below, each on a new line with optional name values. <br /> Import format is: <b> example@hotmail.com [John Doe]</b></div>

<textarea class="form-control" id="import_emails_data" style="height:400px !important;" name="import_emails"></textarea>  
                
 
  
     
<div class="savebtnbox p3"><button type="submit" class="btn btn-lg btn-dark mt-3"><?php echo __("Import Subscribers","premiumpress-admin"); ?></button> </div> 
 
</form>

</div></div>

<div class="col-lg-4">

 <a href="javascript:void(0);" onclick="jQuery('#MainTabs a[href=#ns1]').tab('show');"  class="btn btn-primary mb-4 btn-lg btn-block text-left"><i class="fa fa-arrow-left mr-3"></i> Go Back</a>
    

</div>

</div>