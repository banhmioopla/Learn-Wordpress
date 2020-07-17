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

global $wpdb, $CORE, $userdata, $CORE_ADMIN;

// LOAD IN MAIN DEFAULTS 
$core_admin_values = get_option("core_admin_values");  
  
?> 

 
            
<h4 class="ntitle">Google Maps</h4>     

<div class="row-fluid ">

    <div class="col-md-3">
                   
    	<label>Enable Maps  </label>
        
   <div>
                                  <label class="radio off">
                                  <input type="radio" name="toggle" 
                                  value="off" onchange="document.getElementById('google').value='0'">
                                  </label>
                                  <label class="radio on">
                                  <input type="radio" name="toggle"
                                  value="on" onchange="document.getElementById('google').value='1'">
                                  </label>
                                  <div class="toggle <?php if($core_admin_values['google'] == '1'){  ?>on<?php } ?>">
                                    <div class="yes">ON</div>
                                    <div class="switch"></div>
                                    <div class="no">OFF</div>
                                  </div>
                                </div> 
        <input type="hidden" id="google" name="admin_values[google]" 
                             value="<?php echo $core_admin_values['google']; ?>">
        
    </div>
    
    
    <div class="col-md-3">
                   
    	<label>Map Required  </label>
        
        
    <div>
                                  <label class="radio off">
                                  <input type="radio" name="toggle" 
                                  value="off" onchange="document.getElementById('google_required').value='0'">
                                  </label>
                                  <label class="radio on">
                                  <input type="radio" name="toggle"
                                  value="on" onchange="document.getElementById('google_required').value='1'">
                                  </label>
                                  <div class="toggle <?php if($core_admin_values['google_required'] == '1'){  ?>on<?php } ?>">
                                    <div class="yes">ON</div>
                                    <div class="switch"></div>
                                    <div class="no">OFF</div>
                                  </div>
                                </div>    
                                
                                <input type="hidden" id="google_required" name="admin_values[google_required]" 
                             value="<?php echo $core_admin_values['google_required']; ?>">    
    </div>
    
</div>         
            

<div class="clearfix"></div>

 
            
            
 
         
             
            
            <?php 
			
			if($core_admin_values['google_coords'] == ""){ $core_admin_values['google_coords'] = "0,0"; } 
			if($core_admin_values['google_zoom'] == ""){ $core_admin_values['google_zoom'] = 8; }
			?>
            
            <!------------ FIELD -------------->          
            <div class="row-fluid" >
                <label class="control-label span4 offset2">Map Zoom <br /><small style="color: #ccc;">value between 0 - 20</small> </label>
                <div class="controls span4">         
                 <div class="input-prepend">
                  <span class="add-on">#</span>
                  <input type="text"  name="admin_values[google_zoom]" value="<?php echo $core_admin_values['google_zoom']; ?>" style="width:60px;">
                </div>        
                </div>
            </div>
            <!------------ END FIELD -------------->
            
        
            
            <!------------ FIELD -------------->          
            <div class="row-fluid" >
                <label class="control-label span4 offset2">Map Cords <br /><small style="color: #ccc;">numeric values only</small></label>
                <div class="controls col-md-3">         
                 <div class="input-prepend">
                  <span class="add-on">lat,long</span>
                  <input type="text"  name="admin_values[google_coords]" value="<?php echo $core_admin_values['google_coords']; ?>" style="width:200px; text-align:right">
                </div>        
                </div>
            </div>
            <!------------ END FIELD -------------->
            





 