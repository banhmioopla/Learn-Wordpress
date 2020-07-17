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
  
// SAVE CUSTOM FIELD DATE
if(isset($_POST['cenhancement'])){
update_option("cenhancement", $_POST['cenhancement']);
}  
$cenhancement = get_option("cenhancement"); 
 
// ADD ON DEFAULTS

if(!isset($cenhancement['name'][1])){
	
	$cenhancement['name'][0] 	= "Featured Listing";
	$cenhancement['price'][0] 	= "10";
	$cenhancement['key'][0] 	= "featured";
	$cenhancement['desc'][0] 	= "";
	
	$cenhancement['name'][1] 	= "Top of Category Results";
	$cenhancement['price'][1] 	= "10";
	$cenhancement['key'][1] 	= "topcategory";
	$cenhancement['desc'][1] 	= "";
 
}
 
?> 
 

<script>
jQuery(document).ready(function() {	
    jQuery( "#customfieldlist1" ).sortable(); 

});

</script>


 
<div style="float:right"><span id="catlistboxright">&nbsp;</span></div>



 

<div class="card">
<div class="card-header">
 

<a href="javascript:void(0);" onClick="jQuery('#customfieldlist1_new').clone().prependTo('#customfieldlist1');" class="btn btn-sm btn-primary float-right">Add Enhancement</a>	

<span>
Packages
</span>
</div>
<div class="card-body">






 

<ul id="customfieldlist1">
<?php  
$i=-1;
while($i < count($cenhancement['name']) ){ $i++; $savedKeys = array();

	if(isset($cenhancement['name'][$i]) && $cenhancement['name'][$i] != "" ){  ?>
    
    
<li class="cfielditem closed " id="field<?php echo $i; ?>">
	
    <div class="heading">
      
 
        
        <div class="showhide">
            <a href="#" onclick="jQuery('.cf-<?php echo $i; ?>').fadeToggle();" rel="tooltip" data-original-title="Show/Hide Options" data-placement="top" class="btn btn-primary btn-sm">
            <i class="fa fa-search" aria-hidden="true"></i>
            </a>                                  
        </div>            

        <div class="name">
        
        <?php if($cenhancement['key'][$i] != "featured" && $cenhancement['key'][$i] != "topcategory"){ ?>
        
        <a href="#" onClick="jQuery('#dbkey-<?php echo $i; ?>').val('');jQuery('#field<?php echo $i; ?>').html('');" rel="tooltip" data-original-title="Delete" data-placement="top" class="btn btn-primary btn-sm">
        <i class="fas fa-times" aria-hidden="true"></i>
        </a>
        
        <?php } ?>
        
        &nbsp; <strong><?php echo $cenhancement['name'][$i]; ?></strong>  </div>
    
    </div>
    
    <div class="inside cf-<?php echo $i; ?>">  
         
        <label>Title <span class="required">*</span></label>      
        <input type="text" name="cenhancement[name][]" id="ftitle-<?php echo $i; ?>" value="<?php echo $cenhancement['name'][$i]; ?>" class="form-control"  />  
     
     
     <div class="row margin-top1">
     
         <div class="col-md-4">
             <label>Price</label>
              <div class="input-prepend">
              <input type="text" name="cenhancement[price][]" value="<?php echo $cenhancement['price'][$i]; ?>" id="fprice-<?php echo $i; ?>" class="form-control"  />  
              <span class="add-on ">$</span>
            </div>
         </div>
         
         <div class="col-md-4">
             <label>Database Key</label>
              <div class="input-prepend">
              <input type="text" name="cenhancement[key][]" value="<?php echo $cenhancement['key'][$i]; ?>" id="fkey-<?php echo $i; ?>"  class="form-control" />  
              <span class="add-on "><i class="gicon-lock"></i></span>
            </div>
            
         </div>
     
    </div>    
      
      <div class="">
        
      	<label>Description <span class="required">*</span>  </label>  
  		   <textarea name="cenhancement[desc][]" style="width:100%; height:200px;"><?php echo $cenhancement['desc'][$i]; ?></textarea>
           
      </div>


</div>
 <?php  } ?>    
    
<?php } ?>    
 
</ul>









</div></div>
 