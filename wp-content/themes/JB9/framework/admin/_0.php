<?php
// CHECK THE PAGE IS NOT BEING LOADED DIRECTLY
if (!defined('THEME_VERSION')) {	header('HTTP/1.0 403 Forbidden'); exit; }
// SETUP GLOBALS
global $wpdb, $CORE, $CORE_ADMIN, $userdata;
// LOAD IN MAIN DEFAULTS
$core_admin_values = get_option("core_admin_values"); $license = get_option('wlt_license_key');
// UPGRADE SYSTEM
if(isset($_POST['adminArray']['wlt_license_email'])){
	update_option("wlt_license_upgrade",""); // CLEAR
}

// END 9.1.6 UPDATE

if($license == ""){
 
 ?> 
 
 <style>
 .card-header { display:none;}
 </style>
  
<link href="<?php echo get_bloginfo('template_url')."/framework/"; ?>css/backup_css/css.bootstrap.css" rel="stylesheet">  
<link href="<?php echo get_bloginfo('template_url')."/framework/admin/"; ?>css/premiumpress.css" rel="stylesheet">

<?php get_template_part('framework/admin/templates/admin', 'form-top' ); ?> 

<div class="padding1">
  
 
<?php if(get_option('wlt_license_upgrade') == 1){ ?>
<div class="clearfix"></div>
<div class="alert alert-block alert-danger m-b-0 ">
<h4 class="alert-heading" style="color:#b94a48; font-size:18px; font-weight:bold;">License Key Error</h4>
<p>The license key you entered during installation was either invalid or has expired. Please re-enter your license key below.</p>         
</div>
 <input type="hidden"  name="adminArray[wlt_license_key_error]"  value="1">
<?php } ?>
 
 

<div class="card-header" style="margin-left:-20px;">

<img src="<?php echo get_template_directory_uri(); ?>/framework/admin/images/logo.png" alt="admin area" />

</div>
 

<div style="max-width:500px; margin:50px auto;">



<div class="card  bg-white shadow rounded-0">



<div class="card-body">

 

<label class="mt-3 text-uppercase small font-weight-bold">Licence Key <u>or</u> Avangate Order ID</label>
 
 <input type="text"  name="adminArray[wlt_license_key]" id="license_key" class="form-control"  value="">


<p class="mt-2">Your software license can be <a href="https://www.premiumpress.com/account/" style="text-decoration:underline;" target="_blank">found here.</a> </p>
 
<label class="mt-3 text-uppercase small font-weight-bold">Email Address</label>

<input type="text"  name="adminArray[wlt_license_email]" class="form-control" id="license_email" value="">
 
 
		<?php
		
		$nameArray = array(
		
		"realestate" => array("n" => "Real Estate Theme"),
		"directory" => array("n" => "Directory Theme"),
		"coupon" => array("n" => "Coupon Theme"),
		"auction" => array("n" => "Auction Theme"),
		"shop" => array("n" => "Shop Theme"),
		"classifieds" => array("n" => "Classifieds Theme"),
		"photography" => array("n" => "Stock Photo Theme"),
		"compare" => array("n" => "Comparison Theme"),
		"dating" => array("n" => "Dating Theme"),
		"video" => array("n" => "Video Theme"),
		"software" => array("n" => "Software Download Theme"),
		"micro" => array("n" => "Micro Jobs Theme"),
		"jobs" => array("n" => "Jobs Board Theme"),
		
		"_dev" => array("n" => "xxx"),
		
		);

 
		$HandlePath = TEMPLATEPATH; $TemplateString = "";
	    $count=1;
		if($handle1 = opendir($HandlePath)) {      
			while(false !== ($file = readdir($handle1))){	
			
				// GET LIST
				if(substr($file,0,1) == "_" && is_dir(TEMPLATEPATH."/".$file)){
				
					if(str_replace("_","",$file) == "mobile"){ continue; }
				
					$TemplateString .= '<option value="'.str_replace("_","",$file).'">'; 
						$TemplateString .= $nameArray[str_replace("_","",$file)]["n"]." - Version ".THEME_VERSION;									
						$TemplateString.= "</option>";	
				}
			
			 
			}
		}
		
?> 
<?php if(strlen($TemplateString) > 1){ 




?>
 
 
<label class="mt-2 text-uppercase small font-weight-bold">Template</label>
 
<?php $selected_template = ""; ?>
<select name="admin_values[template]" class="form-control" style="width:100%; height:35px;">
<?php echo $TemplateString; ?>
 
</select>
 
 
<?php } ?>
 

 
<label class="mt-3 text-uppercase small font-weight-bold">Terms &amp; Conditions</label>
     
<textarea style="height:150px;width:100%; margin-bottom:20px; font-size:12px;"><?php include("terms.txt"); ?></textarea>

 <label class="checkbox small alert alert-white btn-block text-uppercase">
 <input type="checkbox" value="" onchange="UnDMe()" /> I agree to the terms of usage/disclaimer.
 </label>
 
 
 
</div><!-- end block -->

<?php //wlt_system_check(true); ?>    


        
<div class="card-footer1 text-center">
   
    <button type="submit" class="btn btn-lg btn-primary mb-3 rounded-0 px-5" id="mainsavebtn">Install Theme</button>
 
</div>  






</div><!-- end card --> 
 
</div><!-- end max 960 -->


 
 


     
<script> 
 
function isValidEmailAddress(emailAddress) {
    var pattern = new RegExp(/^(("[\w-+\s]+")|([\w-+]+(?:\.[\w-+]+)*)|("[\w-+\s]+")([\w-+]+(?:\.[\w-+]+)*))(@((?:[\w-+]+\.)*\w[\w-+]{0,66})\.([a-z]{2,6}(?:\.[a-z]{2})?)$)|(@\[?((25[0-5]\.|2[0-4][\d]\.|1[\d]{2}\.|[\d]{1,2}\.))((25[0-5]|2[0-4][\d]|1[\d]{2}|[\d]{1,2})\.){2}(25[0-5]|2[0-4][\d]|1[\d]{2}|[\d]{1,2})\]?$)/i);
    return pattern.test(emailAddress);
};
function VALIDATE_INSTALL_DATA(){
 
var de4 	= document.getElementById("license_key");
if(de4.value == ''){
	alert('License Key Missing');
	de4.style.border = 'thin solid red';
	de4.focus();
	return false;
}
 
if(de4.value.length  < 5){
	alert('Invalid License Key');
	de4.style.border = 'thin solid red';
	de4.focus();
	return false;
}
var de5 	= document.getElementById("license_email");
if( !isValidEmailAddress( de5.value ) ) {	
alert('Invalid Email Address');
de5.style.border = 'thin solid red';
de5.focus();
return false;
}

}
jQuery(document).ready(function() { 
jQuery('#mainsavebtn').attr('disabled', true);  }); 
function UnDMe(){
 
if ( jQuery('#mainsavebtn').is(':disabled') === false) { jQuery('#mainsavebtn').attr('disabled', true);  
} else {jQuery('#mainsavebtn').attr('disabled', false);  }}
</script>



</div><!-- end padding -->
<?php get_template_part('framework/admin/templates/admin', 'form-bottom' ); ?>

<?php } ?>