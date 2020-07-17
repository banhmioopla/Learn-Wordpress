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

// COUNTRY LIST
$country_string1 = "";
foreach($GLOBALS['core_country_list'] as $key=>$value){
	$country_string1 .= "<option value='".$key."'>".$value."</option>";
} // end if 
  
?> 


   
<div class="row">

<div class="col-lg-6">

<div class="bg-white p-5 shadow" style="border-radius: 7px;">


<div class="tabheader mb-4">
         <h4><span>Display Countries </span></h4>
         <p class="text-muted ">Here you can limit which countries are displayed at checkout.</p>
 
      </div>



 

 
     
 
<select data-placeholder="Select Countries..."  name="admin_values[checkout_countries][]" class="chzn-select " multiple="multiple" style="width:450px;">
<option value="">All Countires</option>
<?php
$country_string = $country_string1;

// ADD ON SELECTED ITEMS
if( is_array( _ppt('checkout_countries') ) ){
 
	foreach(_ppt('checkout_countries') as $selected_countries){
	 
		if( strlen($selected_countries) > 1){	
		
			$country_string = str_replace($selected_countries."'",$selected_countries."' selected=selected",$country_string);	
		}
	}
}

echo $country_string;
?>
</select>  

 
 
 
    
    	<label class="txt500 mt-3">Default State </label>
        
<input type="text" class="form-control" name="admin_values[checkout_default_state]" value="<?php echo stripslashes(_ppt('checkout_default_state')); ?>" placeholder="e.g. North Yorkshire">	 
 
 
 
 
 
    
    	<label class="txt500 mt-3">Default City </label>
        
<input type="text" class="form-control" name="admin_values[checkout_default_city]" value="<?php echo stripslashes(_ppt('checkout_default_city')); ?>" placeholder="e.g. Scarborough">	 

 

</div>
  </div>
    
    <div class="col-6"> 

</div>


</div>

<div class="bg-primary p-1 text-center mt-5 shadow" style="border-radius: 7px;">

<button type="submit" class="btn btn-lg btn-primary btn-block"><?php echo __("Save Settings","premiumpress-admin"); ?></button> 

</div> 

