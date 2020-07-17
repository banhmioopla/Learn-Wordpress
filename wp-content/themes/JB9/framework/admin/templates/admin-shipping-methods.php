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

global $region_list;


// LOAD IN MAIN DEFAULTS 
$core_admin_values = get_option("core_admin_values"); 

// GET SHIPPING METHODS
$custommethods 	= _ppt('custommethods');
 
  
?> 
<div class="card p-0">
<div class="card-header">

<a href="javascript:void(0);" onClick="jQuery('#ppt_custom_methods_box').clone().prependTo('#ppt_shipping_methods');" class="btn btn-primary btn-sm float-right" style="float:right;">Add New</a>	   

<span>
Custom Shipping Methods
</span>
</div>
<div class="card-body"> 

 

<ul id="ppt_shipping_methods">

 
<?php 
 
 
if(is_array($custommethods) && !empty($custommethods['region'])){ $i=0;  

foreach($custommethods['name'] as $cship){ 

if($custommethods['name'][$i] == ""){ $i++; continue; }

  
?>


<li class="cfielditem" id="ccs-<?php echo $i; ?>"> 

	<div class="heading">
      
     	<div class="showhide">
            <a href="#" onclick="jQuery('#ccs-inner<?php echo $i; ?>').fadeToggle();" rel="tooltip" data-original-title="Show/Hide Options" data-placement="top" class="btn btn-primary btn-sm">
            <i class="fa fa-search" aria-hidden="true"></i>
            </a>                                  
        </div>            

        <div class="name">
        
        
        <a href="#" onClick="jQuery('#csm-<?php echo $i; ?>').val('');jQuery('#ccs-<?php echo $i; ?>').hide();" rel="tooltip" data-original-title="Delete" data-placement="top" class="btn btn-primary btn-sm">
        <i class="fas fa-times" aria-hidden="true"></i>
        </a> 
 		
        <strong class="ml-2"><?php echo $custommethods['name'][$i]; ?></strong>
        
        
        </div>
        
	</div> 
     
     
    <div id="ccs-inner<?php echo $i; ?>"  style="display:none;padding:20px;">            
            
 		
        <div class="row mt-4">
        <div class="col-md-6">
            <label>Display Caption</label>
        </div>
        <div class="col-md-6">
             <input type="text" name="admin_values[custommethods][name][]" value="<?php echo $custommethods['name'][$i]; ?>" class="form-control" id="csm-<?php echo $i; ?>"/>
        </div>
        </div>
        
        <div class="row mt-4">
        <div class="col-md-6">
            <label>Select Region</label>
        </div>
        <div class="col-md-6">
            <select name="admin_values[custommethods][region][]" id="cmship1" class="form-control">
          <?php 
		  
$regions = _ppt('regions'); 
$c = 0;
if(is_array( $regions )){ 
	while($c < count($regions['name']) ){
		if($regions['name'][$c] !="" ){	
		
			if($custommethods['region'][$i] == $regions['key'][$c] ){
			echo "<option value='".$regions['key'][$c]."' selected=selected>".$regions['name'][$c]."</option>";	
			}else{
			echo "<option value='".$regions['key'][$c]."'>".$regions['name'][$c]."</option>";	
			}
								
		} // end if
	$c++;
	} // end foreach
}// end if
		 
		  ?>
        </select>
        </div>
        </div>
        
        <div class="row mt-4">
        <div class="col-md-6">
            <label>Price</label>
        </div>
        <div class="col-md-6">
        
         	<div class="input-group">
              <span class="add-on input-group-prepend"><span class="input-group-text"><?php echo hook_currency_symbol(''); ?></span></span>
                 <input type="text" name="admin_values[custommethods][price][]" value="<?php echo $core_admin_values['custommethods']['price'][$i]; ?>" class="form-control" />
            </div> 
      
        </div>
        </div>
 
          
 
 	<hr />
    
    <input type="text" style="max-width:150px;" class="form-control bg-light float-right" name="admin_values[custommethods][key][]" value="<?php echo $custommethods['key'][$i]; ?>" />
    <button type="submit" class="btn btn-primary" onclick="document.getElementById('ShowTab').value='basic_shipping';document.getElementById('ShowSubTab').value='shiptab4'">Save</button>
    </div>
    
</li> 
<?php $i++; } } ?>

</ul>






</div></div><!-- end card -->