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

// GET WEIGHT SHIP
$weightship = _ppt('weightship'); 

// MAKE REGIONS LIST
$regions 		= _ppt('regions');
$region_list = "";  $c=0;
if(is_array( $regions )){ 
	while($c < count($regions['name']) ){
		if($regions['name'][$c] !="" ){							 
		$region_list .= "<option value='".$regions['key'][$c]."' id='".$c."'>".$regions['name'][$c]."</option>";									
		} // end if
	$c++;
	} // end foreach
}// end if
 

  
?> 
<div class="card p-0">
<div class="card-header">

<a href="javascript:void(0);" onClick="jQuery('#wlt_weightbox').clone().prependTo('#wlt_weightbased_shpping');" class="btn btn-primary btn-sm float-right">Add New</a>	   

<span>
Weight Based Shipping
</span>
</div>
<div class="card-body"> 

 

<ul id="wlt_weightbased_shpping">

 
<?php 


if(is_array($weightship) && !empty($weightship['region'])){ $wi=0;  

foreach($weightship['region'] as $weightopK){ 

if($core_admin_values['weightship']['pricec'][$wi] == ""){ $wi++; continue; }
 			 
 
?>

<li class="cfielditem" id="ewbs<?php echo $wi; ?>"> 
    
    <div class="heading">
      
     	<div class="showhide">
            <a href="#" onclick="jQuery('#ewbsinner<?php echo $wi; ?>').fadeToggle();" rel="tooltip" data-original-title="Show/Hide Options" data-placement="top" class="btn btn-primary btn-sm">
            <i class="fa fa-search" aria-hidden="true"></i>
            </a>                                  
        </div>            

        <div class="name">
        
        <a href="#" onClick="jQuery('#ewbs<?php echo $wi; ?>').remove();" rel="tooltip" data-original-title="Delete" data-placement="top" class="btn btn-primary btn-sm">
        <i class="fas fa-times" aria-hidden="true"></i>
        </a> 
        
        <strong class="ml-2">
        >  <?php echo $weightship['pricea'][$wi]; ?>  < <?php echo $weightship['priceb'][$wi]; ?> = <?php echo hook_price($weightship['pricec'][$wi]); ?>  
        </strong>
        
        
        </div>
    
    </div> 
     
     
    <div id="ewbsinner<?php echo $wi; ?>" class="bg-white"  style="display:none;padding:20px;">
            
 
 

        <div class="row">
        <div class="col-md-6">
           <label>Region</label>
        </div>
        <div class="col-md-6">
  
        <select name="admin_values[weightship][region][]" class="form-control">
          <?php 
		  
$regions = _ppt('regions'); 
$c = 0;
if(is_array( $regions )){ 
	while($c < count($regions['name']) ){
		if($regions['name'][$c] !="" ){	
		
			if($core_admin_values['weightship']['region'][$wi] == $regions['key'][$c] ){
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

        <div class="row">
        <div class="col-md-6">
            <label>Weight (greater than)</label>
        </div>
        <div class="col-md-6">
             <div class="input-group">
              <span class="add-on input-group-prepend"><span class="input-group-text">#</span></span>
                <input type="text" name="admin_values[weightship][pricea][]" value="<?php echo $core_admin_values['weightship']['pricea'][$wi]; ?>" class="form-control"/> 
            </div>  
        </div>
        </div>        
        
         <div class="row">
        <div class="col-md-6">
            <label>Weight (less than)</label>
        </div>
        <div class="col-md-6">
             <div class="input-group">
             <span class="add-on input-group-prepend"><span class="input-group-text">#</span></span>
                <input type="text" name="admin_values[weightship][priceb][]" value="<?php echo $core_admin_values['weightship']['priceb'][$wi]; ?>" class="form-control"/>
            </div>  
        </div>
        </div>

         <div class="row">
        <div class="col-md-6">
            <label> Price Per Item</label>
        </div>
        <div class="col-md-6">
             <div class="input-group">
             <span class="add-on input-group-prepend"><span class="input-group-text"><?php echo hook_currency_symbol(''); ?></span></span>
                 <input type="text" name="admin_values[weightship][pricec][]" value="<?php echo $core_admin_values['weightship']['pricec'][$wi]; ?>" class="form-control" />
            </div>  
        </div>
        </div>
 
 
 <hr />
    <button type="submit" class="btn btn-primary" onclick="document.getElementById('ShowTab').value='basic_shipping';document.getElementById('ShowSubTab').value='shiptab4'">Save</button>
    </div>
    </li> 

<?php $wi++; } } ?>

</ul>







</div></div><!-- end card -->