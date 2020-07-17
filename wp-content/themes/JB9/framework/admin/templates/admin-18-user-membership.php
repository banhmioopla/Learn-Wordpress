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

// SAVE CUSTOM FIELD DATE
if(isset($_POST['cmemberships'])){

update_option("cmemberships", $_POST['cmemberships']);

}
  
$cmemberships = get_option("cmemberships"); 
if(!is_array($cmemberships)){ $cmemberships = array(); }  
  
?> 
 

<script>
jQuery(document).ready(function() {	
    jQuery( "#membership-list" ).sortable(); 

});
</script> 



<div class="card">
<div class="card-header">
<a href="#" rel="tooltip" data-original-title="Make different membership packages for your users." data-placement="top" class="btn btn-help btn-sm float-right"><i class="fa fa fa-info" aria-hidden="true"></i></a>
<?php if(is_array($cmemberships) && !empty($cmemberships) ){ ?>
<a href="javascript:void(0);" onclick="jQuery('#transfer-memberships').toggle();" rel="tooltip" data-original-title="Transfer Memberships" data-placement="top" class="btn btn-help btn-sm float-right"><i class="fa fa-refresh" aria-hidden="true"></i></a>
<?php } ?>

<a href="javascript:void(0);" onClick="jQuery('#membership-list_new').clone().prependTo('#membership-list');" class="btn btn-sm btn-primary float-right">Add Membership</a>	

<span>
Membership Packages
</span>
</div>
<div class="card-body">
 
 
 
<ul id="membership-list">
<?php if(is_array($cmemberships) && !empty($cmemberships) ){ $i=0; 

foreach($cmemberships['name'] as $data){ 

	if($cmemberships['name'][$i] != "" ){  ?>
    
    
<li class="cfielditem closed " id="rowid-<?php echo $i; ?>">
	
    <div class="heading">
      
     	<div class="showhide">
            <a href="#" onclick="jQuery('.cf-<?php echo $i; ?>').fadeToggle();" rel="tooltip" data-original-title="Show/Hide Options" data-placement="top" class="btn btn-primary btn-sm">
            <i class="fa fa-search" aria-hidden="true"></i>
            </a>                                  
        </div>            

        <div class="name">
        
        <a href="#" onClick="jQuery('#rowid-<?php echo $i; ?>').html('').hide();" rel="tooltip" data-original-title="Delete" data-placement="top" class="btn btn-primary btn-sm">
        <i class="fas fa-times" aria-hidden="true"></i>
        </a> 
        
        &nbsp; <strong><?php echo $cmemberships['name'][$i]; ?></strong>  (<?php echo str_replace("-","",$cmemberships['key'][$i]); ?>)
        
        </div>
    
    </div>
    
    <div class="inside cf-<?php echo $i; ?>">  
         
        <label>Title <span class="required">*</span></label>      
        
        <input type="text" name="cmemberships[name][]" id="title-<?php echo $i; ?>" value="<?php echo $cmemberships['name'][$i]; ?>" class="form-control"  />
        
        
        <label class="margin-top1">Description <span class="required">*</span></label>  
  		
        <textarea name="cmemberships[desc][]" style="width:100%; height:100px;" class="form-control"><?php echo $cmemberships['desc'][$i]; ?></textarea>

        
        
        
        
        <div class="row mt-1">
        
        	<div class="col-md-6">
            
            <label>Price</label>
            
            <div class="input-group">
              <span class="input-group-prepend"><span class="input-group-text"><?php echo hook_currency_symbol(''); ?></span></span>
              <input type="text" name="cmemberships[price][]" id="price-<?php echo $i; ?>" value="<?php echo $cmemberships['price'][$i]; ?>" class="form-control"  />  
            </div>                   
            
            </div>
        
        	<div class="col-md-6">
            
             <label>Unique Key <span class="required">*</span> </label>
             
              <input type="text" name="cmemberships[key][]" id="key-<?php echo $i; ?>" value="<?php echo str_replace("-","",$cmemberships['key'][$i]); ?>" class="form-control"  />        
             
            </div>   
                 
        </div>
        
        
        
        
        
        
        <hr class="mt-3 mb-3" /> 
        
        <h6 class="">Subscription Includes (optional)</h6>
        
        <div class="row mt-1"> 
        
        	<div class="col-md-4">
            
            <label>Credit Included;</label>
            
            <div class="input-group">
              <span class="input-group-prepend"><span class="input-group-text">#</span></span>
              <input type="text" name="cmemberships[credit][]" value="<?php if(!isset($cmemberships['credit'][$i])){ echo 0; }else{ echo $cmemberships['credit'][$i]; } ?>" class="form-control"  />  
            </div> 
            
              
            </div>
            
        	<div class="col-md-4">

            <label>Tokens Included;</label>
            
            <div class="input-group">
              <span class="input-group-prepend"><span class="input-group-text">#</span></span>
              <input type="text" name="cmemberships[tokens][]" value="<?php if(!isset($cmemberships['tokens'][$i])){ echo 0; }else{ echo $cmemberships['tokens'][$i]; } ?>" class="form-control"  />  
            </div>  

           </div> 
           
           <div class="col-md-4">
			 
            
            
            </div>
            
        </div><!-- end row -->
        
        
        
        
        
        <hr class="mt-3 mb-3" /> 
        
        <h6 class="">Expiry Details</h6>
        
        <div class="row mt-1"> 
        
        	<div class="col-md-4">
            
            <label>Days to expire</label>
            
            <div class="input-group">
              <span class="input-group-prepend">#</span>
              <input type="text" name="cmemberships[days][]" value="<?php if(!isset($cmemberships['days'][$i])){ echo 30; }else{ echo $cmemberships['days'][$i]; } ?>" class="form-control"  />  
            </div> 
            
              
            </div>
            
        	<div class="col-md-4">

            

           </div> 
           
           <div class="col-md-4">
			 
            
            
            </div>
            
        </div><!-- end row -->
        
        
          
        
   
	</div>
    
</li>

 <?php $i++; } ?>    
    
<?php } ?>    

<?php } ?>  
</ul>

</div><!-- end card block -->
</div><!-- end card -->





<?php if(is_array($cmemberships) && count($cmemberships) > 0 ){  ?>  
    
 

<div class="card" id="transfer-memberships" style="display:none;">
<div class="card-header">
<span>
Transfer User Memberships
</span>
</div>
<div class="card-body">

<div class="row mt-3 mb-3">


<div class="col-md-6">

      
        <select onchange="jQuery('#fromM').val(this.value);" class="chzn-select" style="width:300px">
        <option></option>
          <?php $i = 0; if(is_array($cmemberships) && !empty($cmemberships) ){   foreach($cmemberships['name'] as $data){ if($cmemberships['name'][$i] != "" ){ ?> 
          
                <option value="<?php echo $cmemberships['key'][$i]; ?>"><?php echo stripslashes($cmemberships['name'][$i]); ?></option>
                
          <?php } $i++;  } } ?> 
          
        </select>

</div>

<div class="col-md-6">

        <select onchange="jQuery('#toM').val(this.value);" class="chzn-select" style="width:300px">
        <option></option>
          <?php $i = 0; if(is_array($cmemberships) && !empty($cmemberships) ){   foreach($cmemberships['name'] as $data){ if($cmemberships['name'][$i] != "" ){ ?> 
          
                <option value="<?php echo $cmemberships['key'][$i]; ?>"><?php echo stripslashes($cmemberships['name'][$i]); ?></option>
                
          <?php } $i++;  } } ?> 
          
        </select>

</div>


</div>

<div class="text-center">
<button class="btn btn-primary " type="button" onclick="document.TransferFormMembership.submit();">Start Transfer</button>
</div>

</div><!-- end card block -->
</div><!-- end card -->      
 <?php } ?>       















<script>
function checknotblank(){
if(jQuery('#nfaqt').val() == ""){  jQuery('#nfaqt').val(' '); }
}
</script>
