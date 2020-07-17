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
 
 <div class="container">
<div class="row formrow">

    <div class="col-6">
    
       <label>Business Hours</label>
        
         <p>Here you can turn on/off the business hours setup within the theme.</p>   
        
    </div>
    
    <div class="col-6">
    
		         <div class="mt-4">
                                  <label class="radio off">
                                  <input type="radio" name="toggle" 
                                  value="off" onchange="document.getElementById('businesshours').value='0'">
                                  </label>
                                  <label class="radio on">
                                  <input type="radio" name="toggle"
                                  value="on" onchange="document.getElementById('businesshours').value='1'">
                                  </label>
                                  <div class="toggle <?php if(_ppt('businesshours') == '1'){  ?>on<?php } ?>">
                                    <div class="yes">ON</div>
                                    <div class="switch"></div>
                                    <div class="no">OFF</div>
                                  </div>
                                </div> 
                             
                             
                             <input type="hidden" class="row-fluid" id="businesshours" name="admin_values[businesshours]" 
                             value="<?php echo _ppt('businesshours'); ?>">
	</div>
    
</div>
</div>
