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

<div class="col-12">
<div class="card p-0">
<div class="card-header">
<!--
<a href="#quickAdd" role="button" data-toggle="modal" class="btn btn-primary btn-sm" style="float:right;margin-left:10px;">Quick Add</a>
-->	   
<a href="javascript:void(0);" onClick="jQuery('#wlt__regions').clone().insertAfter('#wlt__regionss');" class="btn btn-primary btn-sm" style="float:right;">Add New</a>	 

<span>
Regions
</span>
</div>
<div class="card-body">
 
 
 
<!-- Modal -->
<div id="quickAdd" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="quickAddLabel" aria-hidden="true">

<div class="modal-dialog" role="document">
    <div class="modal-content">
 
  <div class="modal-body">

 
        <h4 class="media-heading">USA Tax States</h4>
        <p>Select this option if you wish you add the predefined tax regions to your website.</p>
        <a href="admin.php?page=cart&add_pre_usa=1&tab=regions" onclick="jQuery('#ShowTab').val('regions');" class="btn btn-info">Select Option</a> - remember to save changes.
     
        
        <h4 class="media-heading ">Canadian Tax States</h4>
        <p>Select this option if you wish you add the Canadian tax regions.</p>
        <a href="admin.php?page=cart&add_pre_usa=3&tab=regions" onclick="jQuery('#ShowTab').val('regions');"  class="btn btn-info">Select Option</a> - remember to save changes.
        
        
        <h4 class="media-heading ">European Union Countries</h4>
        <p>Select this option if you wish you add the European Union countries.</p>
        <a href="admin.php?page=cart&add_pre_usa=2&tab=regions" onclick="jQuery('#ShowTab').val('regions');" class="btn btn-info">Select Option</a> - remember to save changes.
              
               
  </div>
  <div class="modal-footer">
    <button class="btn" data-dismiss="modal" aria-hidden="true">Close</button>

  </div>
</div>
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->



<?php

if( isset($_GET['add_pre_usa']) && !isset($_POST['tab'])   ){

 
	$df = 0; $i = 0;	
	while($i < count($core_admin_values['regions']['name']) ){ if($core_admin_values['regions']['name'][$i] !=""){ 
	$df++;
	} $i++; }
 
	$GLOBALS['savemeform'] = 1;
	
	if($_GET['add_pre_usa'] == 1){
 
		$core_admin_values['regions']['name'][$df] = 'USA (0% Tax States Only)';
		$core_admin_values['regions']['country'][$df] = array('');
		$core_admin_values['regions']['state'][$df] = array('Alaska','Delaware','Montana','New Hampshire','Oregon');		
		$df++;
		$core_admin_values['regions']['name'][$df] = 'USA (2.9% Tax States Only)';  
		$core_admin_values['regions']['country'][$df] = array('');
		$core_admin_values['regions']['state'][$df] = array('Colorado');
		$df++;
		$core_admin_values['regions']['name'][$df] = 'USA (4% Tax States Only)'; 
		$core_admin_values['regions']['country'][$df] = array('');
		$core_admin_values['regions']['state'][$df] = array('Alabama','Georgia','Guam','Hawaii','Louisiana','Missouri','New York','Oklahoma','South Dakota','Wyoming');
		$df++;
		$core_admin_values['regions']['name'][$df] = 'USA (5% Tax States Only)';  
		$core_admin_values['regions']['country'][$df] = array('');
		$core_admin_values['regions']['state'][$df] = array('Maine','Nebraska','New Mexico','North Carolina','North Dakota','Puerto Rico','Utah','Wisconsin');
		$df++;
		$core_admin_values['regions']['name'][$df] = 'USA (6% Tax States Only)'; 
		$core_admin_values['regions']['country'][$df] = array('');
		$core_admin_values['regions']['state'][$df] = array('Arkansas','District of Columbia','Florida','Idaho','Iowa','Kansas','Kentucky','Maryland','Massachusetts','Michigan','Ohio','Pennsylvania','South Carolina','Vermont','Virginia','West Virginia');
		$df++;
		$core_admin_values['regions']['name'][$df] = 'USA (6.6% Tax States Only)'; 
		$core_admin_values['regions']['country'][$df] = array('');
		$core_admin_values['regions']['state'][$df] = array('Arizona','Connecticut','Illinois','Minnesota','Nevada','Texas','Washington');
		$df++;
		$core_admin_values['regions']['name'][$df] = 'USA (7.5% Tax States Only)';
		$core_admin_values['regions']['country'][$df] = array('');
		$core_admin_values['regions']['state'][$df] = array('California','Indiana','Mississippi','New Jersey','Rhode Island','Tennessee');
	 
	}elseif($_GET['add_pre_usa'] == 2){
	
		$core_admin_values['regions']['name'][$df] = 'EU - European Union Countries';
		$core_admin_values['regions']['country'][$df] = array('AT','BE','BG','HR','CY','CZ','DE','EE','FI','FR','DE','GR','HU','IS','IT','LV','LT','LU','MT','NL','PL','PT','RO','SK','SI','SP','SE','UK');
		$core_admin_values['regions']['state'][$df] = array('');
		
	}elseif($_GET['add_pre_usa'] == 3){
	
		$core_admin_values['regions']['name'][$df] = 'CA (5% Tax States Only)';
		$core_admin_values['regions']['country'][$df] = array('');
		$core_admin_values['regions']['state'][$df] = array('Alberta');
		$df++;
		$core_admin_values['regions']['name'][$df] = 'CA (10% Tax States Only)';
		$core_admin_values['regions']['country'][$df] = array('');
		$core_admin_values['regions']['state'][$df] = array('Saskatchewan');
		$df++;	
		$core_admin_values['regions']['name'][$df] = 'CA (12% Tax States Only)';
		$core_admin_values['regions']['country'][$df] = array('');
		$core_admin_values['regions']['state'][$df] = array('British Columbia');
		$df++;		
		$core_admin_values['regions']['name'][$df] = 'CA (13% Tax States Only)';
		$core_admin_values['regions']['country'][$df] = array('');
		$core_admin_values['regions']['state'][$df] = array('Manitoba','Ontario','New Brunswick','Newfoundland');
		$df++;	
		$core_admin_values['regions']['name'][$df] = 'CA (14% Tax States Only)';
		$core_admin_values['regions']['country'][$df] = array('');
		$core_admin_values['regions']['state'][$df] = array('Quebec','Prince Edward Island');
		$df++;			
		$core_admin_values['regions']['name'][$df] = 'CA (15% Tax States Only)';
		$core_admin_values['regions']['country'][$df] = array('');
		$core_admin_values['regions']['state'][$df] = array('Nova Scotia');			
	} 
}

?>
 
<ul id="wlt__regionss">
<?php 
  
// COUNTRY LIST
$country_string1 = "";
foreach($GLOBALS['core_country_list'] as $key=>$value){
	$country_string1 .= "<option value='".$key."'>".$value."</option>";
} // end if 

// STATE LIST
$state_string1 = "";
foreach($GLOBALS['core_country_list'] as $key=>$value){
	$state_string1 .= "<optgroup label='".$value."' class='".$key."_state'>";	
						
	// NOW LETS CHECK FOR STATES
	if(isset($GLOBALS['core_state_list'][$key])){
		$bits = explode("|",$GLOBALS['core_state_list'][$key]);
		foreach($bits as $st){
			if(isset($selected_state) && $selected_state == $value){ $sel ="selected=selected"; }else{ $sel =""; }
			$state_string1 .= '<option value="'.$st.'">'.$st.'</option>';
		} // end if
							
	}// end if
						
	$state_string1 .= "</optgroup>";										
} // end if
  
if( is_array(_ppt('regions')) ){ $i=0; 

while($i < count($core_admin_values['regions']['name']) ){ if($core_admin_values['regions']['name'][$i] !=""){  ?>
    <li class="cfielditem" id="method_<?php echo $i; ?>">
    
     <div class="heading">
     
     
      	<div class="showhide">
            <a href="#" onclick="jQuery('#region_inside_<?php echo $i; ?>').fadeToggle();" rel="tooltip" data-original-title="Show/Hide Options" data-placement="top" class="btn btn-primary btn-sm">
            <i class="fa fa-search" aria-hidden="true"></i>
            </a>                                  
        </div>    
    
  
     
    <div class="name">
    
    
    
    <a href="#" onClick="jQuery('#method_<?php echo $i; ?>_d1').val('');jQuery('#method_<?php echo $i; ?>').hide();" rel="tooltip" data-original-title="Delete" data-placement="top" class="btn btn-primary btn-sm">
        <i class="fas fa-times" aria-hidden="true"></i>
        </a> 
    
    
    
 &nbsp;Region: <?php echo $core_admin_values['regions']['name'][$i]; ?>
 
 </div>
 
 </div><!-- end heading -->
 
 
    <div class="inside" style="display:none;" id="region_inside_<?php echo $i; ?>"> 
    
    
          
    <label>Display Text <small>(e.g European Region)</small></label>
    <input type="text" name="admin_values[regions][name][]" value="<?php echo $core_admin_values['regions']['name'][$i]; ?>"  class="form-control" id="method_<?php echo $i; ?>_d1"  /> 
     

<div class="row mt-4">
<div class="col-md-6">
 <label class="">Select region countries</label>
 
<select data-placeholder="Select Countries..." class="chzn-select" name="admin_values[regions][country][<?php echo $i; ?>][]" id="region_country_<?php echo $i; ?>" multiple="multiple" style="width:250px;">
<option value="">&nbsp;</option>
<?php
$country_string = $country_string1;

// ADD ON SELECTED ITEMS
if(isset($core_admin_values['regions']['country'][$i]) && is_array($core_admin_values['regions']['country'][$i]) ){
	foreach($core_admin_values['regions']['country'][$i] as $selected_countries){
		if(isset($selected_countries) && strlen($selected_countries) > 1){	 
			$country_string = str_replace($selected_countries."'",$selected_countries."' selected=selected",$country_string);	
		}
	}
}

echo $country_string;
?>
</select>  



<script>
jQuery(document).ready(function(){
      jQuery("#region_country_<?php echo $i; ?>").change(function(){ 
        
		if(confirm("Would you like to add the states/provinces for this country?\n\n\n If you are applying the same tax/ship price for the entire country, you do not need to add states/provinces.")){
		
			alert('Please wait a moment while we update the state list for you. (the window may freeze for a moments)');
		    var cla = jQuery("#region_country_<?php echo $i; ?>").val();	
   			jQuery.each( cla, function( key, value ) {
				jQuery("."+value+"_state").children().attr('selected','selected').trigger('liszt:updated');
			});	
		}else{
			//Cancel button pressed...
		} 
		
		 		
      });	  
});
</script>    

</div>
<div class="col-md-6">              

<label class="">Select region states</label>

<select data-placeholder="Select States..." class="chzn-select" name="admin_values[regions][state][<?php echo $i; ?>][]" id="region_state_<?php echo $i; ?>" multiple="multiple" style="width:250px;">
<option value=""></option>
<?php
$state_string = $state_string1;
// ADD ON SELECTED ITEMS
if(isset($core_admin_values['regions']['state'][$i]) && is_array($core_admin_values['regions']['state'][$i]) ){
	foreach($core_admin_values['regions']['state'][$i] as $selected_states){
		if(isset($selected_states) && strlen($selected_states) > 1){	 
			$state_string = str_replace($selected_states.'"',$selected_states.'" selected=selected',$state_string);	
		}
	}
}
echo $state_string;
?>
</select>  

</div>
</div>
                      
       <hr />                 
  
   <input type="text" name="admin_values[regions][key][]" value="<?php echo $core_admin_values['regions']['key'][$i]; ?>"  class="form-control float-right bg-light" style="width: 150px;"  />      
   
    <button type="submit" class="btn btn-primary rounded-0" onclick="document.getElementById('ShowTab').value='regions'">Save Changes</button>   
    <div class="clear"></div>
    </div>
    </li> 
<?php } $i++;  } } ?>
</ul>
 









</div></div><!-- end card -->













<!-- DEFAULT BOX CODE --->
<div style="display:none"><div id="wlt__regions">
    <div class="postbox">
    <div title="Click to toggle" class="handlediv"></div>
 
    <div class="inside">       
    <p>Display Text <small>(e.g European Region)</small></p>
    <input type="text" name="admin_values[regions][name][]" value="" class="form-control m-b-1"  /> 
    
     <input type="hidden" name="admin_values[regions][key][]" value="regkey-<?php echo rand(23412,32424); ?>"   />  
    
    <button type="submit" class="btn btn-primary mt-4 rounded-0" onclick="document.getElementById('ShowTab').value='regions'">Save</button>
    </div>
    </div> 
</div>
</div>
<!-- DEFAULT BOX CODE --->

 
<hr />



<div class="description">

<p>Regions let you setup country/state combinations which can be used for custom tax and shipping prices.</p>

<p><b class="label label-info">Note:</b> If you are applying the same tax/ship price for the entire country, you <u>do not</u> need to add all of the states/provinces as well.</p>

</div>


</div>


<div class="bg-primary p-1 text-center mt-5 shadow" style="border-radius: 7px;">

<button type="submit" class="btn btn-lg btn-primary btn-block"><?php echo __("Save Settings","premiumpress-admin"); ?></button> 

</div> 