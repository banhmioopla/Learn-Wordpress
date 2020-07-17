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

// LOAD IN MAIN DEFAULTS 
$core_admin_values = get_option("core_admin_values");  
 
  
?>


 

 

<div class="row">

<div class="col-lg-8">

<div class="bg-white p-5 shadow" style="border-radius: 7px;">


 
 
 
</div></div>

<div class="col-lg-4">

<a href="javascript:void(0);" onclick="jQuery('#MainTabs a[href=#settings]').tab('show');" class="btn btn-primary mb-4 btn-lg btn-block text-left"><i class="fa fa-arrow-left mr-3" aria-hidden="true"></i> Go Back</a>

        <div class="bg-white shadow mt-5" style="border-radius: 7px;">
        	
            <div class="p-5 text-center">
            
            <img src="<?php echo get_bloginfo('template_url')."/framework/admin/"; ?>images/icon3.png" class="img-fluid mb-4" />
            
        	<h5 class="mb-3">Language Setup</h5>
            
            <p style="font-size:16px;" class="text-muted">Learn how to setup pages in this quick video tutorial.</p>
            </div>
        
            <div class="btnbox bg-light text-center p-3 py-4" style="border-radius: 7px;">
            
            <a href="https://www.youtube.com/watch?v=G68QcvQ1U40" class="btn btn-dark">Watch Tutorial</a>
            
            </div>
        
        </div>


</div>


</div> 