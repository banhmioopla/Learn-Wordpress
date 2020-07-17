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
if (!defined('THEME_VERSION')) {	header('HTTP/1.0 403 Forbidden'); exit; } $core_admin_values = get_option("core_admin_values"); ?> 
 
 
 

<div class="row">

<div class="col-lg-7">

<div class="bg-white p-5 shadow" style="border-radius: 7px;">


 


         

 
         
  
<div class="tabheader mt-5 mb-4">

 
<h4><span>Bulk Import Coupons</span></h4>

</div>


<p class=" text-muted">Enter a list of coupons items below, separate each coupon with a new line.</p>

<textarea class="form-control" id="default-textarea" style="height:200px;width:100%" name="coupon_import"></textarea>  

<p class="mt-3">Fixed Format: Code[discount]</p>  

       
       
       
       
       
       
       
</div></div>

<div class="col-lg-5">


<a href="javascript:void(0);" onclick="jQuery('#MainTabs a[href=#gateways]').tab('show');" class="btn btn-primary mb-4 btn-lg btn-block text-left"><i class="fa fa-arrow-left mr-3" aria-hidden="true"></i> Go Back</a>

</div>
</div>    