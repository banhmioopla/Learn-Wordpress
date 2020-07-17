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
if(isset($_POST['cpackages'])){
update_option("cpackages", $_POST['cpackages']);
}
  
$cpackages = get_option("cpackages"); 
if(!is_array($cpackages)){ $cpackages = array(); }  

// SETUP ARRAY FOR EXISTING KEYS
// ENCASE THE USER HASNT REALISED THEY ARE THE SAME
$ekeys = array();
  
?> 
 

<script>
jQuery(document).ready(function() {	
    jQuery( "#package-list" ).sortable(); 

});
</script> 



<div class="card">
<div class="card-header">
<a href="#" rel="tooltip" data-original-title="Allows you to charge different payment plans to charge users for posting different content." data-placement="top" class="btn btn-help btn-sm float-right"><i class="fa fa fa-info" aria-hidden="true"></i></a>

<?php if(is_array($cpackages) && count($cpackages) > 0 ){  ?>  
<a href="javascript:void(0);" onclick="jQuery('#transfer-packages').toggle();" rel="tooltip" data-original-title="Transfer Packages" data-placement="top" class="btn btn-help btn-sm float-right"><i class="fa fa-refresh" aria-hidden="true"></i></a>
<?php } ?>

<a href="javascript:void(0);" onClick="jQuery('#package-list_new').clone().prependTo('#package-list');" class="btn btn-sm btn-primary float-right">Add Package</a>	

<span>
Packages
</span>
</div>
<div class="card-body">
 
 
 
<ul id="package-list">
<?php if(is_array($cpackages) && !empty($cpackages) ){ $i=0; 

foreach($cpackages['name'] as $data){ 

	if($cpackages['name'][$i] != "" ){  ?>
    
    
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
        
        <small><?php echo $cpackages['key'][$i]; ?></small>
        
        &nbsp; <strong><?php echo $cpackages['name'][$i]; ?></strong>  
        
        </div>
    
    </div>
    
    <div class="inside cf-<?php echo $i; ?>">  
         
        <div class="row"> 
         
            <div class="col-md-6"> 
            
            <label>Display Name <span class="required">*</span></label>      
            
            <input type="text" name="cpackages[name][]" id="title-<?php echo $i; ?>" value="<?php echo $cpackages['name'][$i]; ?>" class="form-control"  />
            
            </div>
            
             
            <div class="col-md-6"> 
            
            <label>Sales Caption <span class="required">*</span></label>      
            
            <input type="text" name="cpackages[subtitle][]" id="title-<?php echo $i; ?>" value="<?php echo $cpackages['subtitle'][$i]; ?>" class="form-control"  />
            
            </div>
        
        </div><!-- end row -->        
        
         <h6 class="mt-3">Pricing Table Display</h6>
        
        <div class="row mt-1">
        
            <div class="col-md-4"> 
            
            <label>Stars (0 = hide)</label>      
            
            <input type="text" name="cpackages[stars][]" id="title-<?php echo $i; ?>" value="<?php echo $cpackages['stars'][$i]; ?>" class="form-control"  />
            
            </div>
            
             
            <div class="col-md-4"> 
            
            <label>Icon Name (<a href="http://fontawesome.io/icons/" target="_blank" style="text-decoration:underline;">see list</a>)</label>      
            
            <input type="text" name="cpackages[icon][]" id="title-<?php echo $i; ?>" value="<?php echo $cpackages['icon'][$i]; ?>" class="form-control"  />
            
            </div>
            
            <div class="col-md-4"> 
            
            <label>Selected</label>      
            
              <div style="margin-top: 5px;">
                                      <label class="radio off">
                                      <input type="radio" name="toggle" 
                                      value="off" onchange="document.getElementById('pak-active-<?php echo $i; ?>').value='0'">
                                      </label>
                                      <label class="radio on">
                                      <input type="radio" name="toggle"
                                      value="on" onchange="document.getElementById('pak-active-<?php echo $i; ?>').value='1'">
                                      </label>
                                      <div class="toggle <?php if(isset($cpackages['active'][$i]) && $cpackages['active'][$i] == '1'){  ?>on<?php } ?>">
                                        <div class="yes">ON</div>
                                        <div class="switch"></div>
                                        <div class="no">OFF</div>
                                      </div>
               </div> 
                                
                                 
                                 <input type="hidden" id="pak-active-<?php echo $i; ?>" name="cpackages[active][]"
                                 value="<?php if(isset($cpackages['active'][$i])){ echo $cpackages['active'][$i]; } ?>">
             </div>
             
        </div><!-- end row -->   
        
        
        
         
         
        <h6 class="mt-3">Payment Terms</h6>
        
        <div class="row mt-1">
        
        	<div class="col-md-4">

             <label>Price</label>
            
            <div class="input-group">
              <span class="input-group-prepend"><?php echo hook_currency_symbol(''); ?></span>
              <input type="text" name="cpackages[price][]" id="price-<?php echo $i; ?>" value="<?php echo $cpackages['price'][$i]; ?>" class="form-control"  />  
            </div>                   
            

            </div> 
        
        
        	<div class="col-md-4">

                <label>Duration</label>
                
                <div class="input-group">
                  <span class="input-group-prepend">days</span>
                  <input type="text" name="cpackages[days][]" value="<?php if(!isset($cpackages['days'][$i])){ echo 10; }else{ echo $cpackages['days'][$i]; } ?>" class="form-control" style="padding-left:40px;"  />  
                </div> 

            </div> 
        
        	<div class="col-md-4">
            
            <label>Recurring Payment</label>
            
               <div style="margin-top: 5px;">
                                      <label class="radio off">
                                      <input type="radio" name="toggle" 
                                      value="off" onchange="document.getElementById('pak-recurring-<?php echo $i; ?>').value='0'">
                                      </label>
                                      <label class="radio on">
                                      <input type="radio" name="toggle"
                                      value="on" onchange="document.getElementById('pak-recurring-<?php echo $i; ?>').value='1'">
                                      </label>
                                      <div class="toggle <?php if(isset($cpackages['recurring'][$i]) && $cpackages['recurring'][$i] == '1'){  ?>on<?php } ?>">
                                        <div class="yes">ON</div>
                                        <div class="switch"></div>
                                        <div class="no">OFF</div>
                                      </div>
               </div> 
                                
                                 
                                 <input type="hidden" id="pak-recurring-<?php echo $i; ?>" name="cpackages[recurring][]"
                                 value="<?php if(isset($cpackages['recurring'][$i])){ echo $cpackages['recurring'][$i]; } ?>">
            
              
            </div>
            
        

            
        </div>
        
        <h6 class="mt-3">Basic Package Features</h6>
        
        <div class="row mt-1"> 
        
        	<div class="col-md-4">
            
            <label>Categories</label>
            
            <div class="input-group">
              <span class="input-group-prepend">#</span>
              <input type="text" name="cpackages[cats][]" value="<?php if(!isset($cpackages['cats'][$i])){ echo 10; }else{ echo $cpackages['cats'][$i]; } ?>" class="form-control"  />  
            </div> 
            
              
            </div>
            
        	<div class="col-md-4">
			
            <div class="from-group">
            <label>Media Uploads</label>
            
            <div class="input-group">
              <span class="input-group-prepend">#</span>
              <input type="text" name="cpackages[files][]" value="<?php if(!isset($cpackages['files'][$i])){ echo 10; }else{ echo $cpackages['files'][$i]; } ?>" class="form-control"  />  
            </div> 
            
            </div> 

           </div> 
           
           <div class="col-md-4">
			
                <label>HTML Description</label>
            
               <div style="margin-top: 5px;">
                                      <label class="radio off">
                                      <input type="radio" name="toggle" 
                                      value="off" onchange="document.getElementById('pak-html-<?php echo $i; ?>').value='0'">
                                      </label>
                                      <label class="radio on">
                                      <input type="radio" name="toggle"
                                      value="on" onchange="document.getElementById('pak-html-<?php echo $i; ?>').value='1'">
                                      </label>
                                      <div class="toggle <?php if(isset($cpackages['html'][$i]) && $cpackages['html'][$i] == '1'){  ?>on<?php } ?>">
                                        <div class="yes">ON</div>
                                        <div class="switch"></div>
                                        <div class="no">OFF</div>
                                      </div>
               </div> 
                                
                                 
                                 <input type="hidden" id="pak-html-<?php echo $i; ?>" name="cpackages[html][]"
                                 value="<?php if(isset($cpackages['html'][$i])){ echo $cpackages['html'][$i]; } ?>">
            
            
            </div>
            
        </div><!-- end row -->
        
         <h6 class="">Admin</h6>
       
        
        <div class="row mt-1">
 
        
        	<div class="col-md-6">
            
             <label>Unique Package Key <span class="required">*</span> </label>
             
             <?php
			 if(in_array($cpackages['key'][$i],$ekeys)){
			 	$key = $cpackages['key'][$i]."-".rand(0,10000);
			 }else{
				$key = $cpackages['key'][$i];			 	
			 }
			 $ekeys[] = $key;
			 ?>
             
              <input type="text" name="cpackages[key][]" id="key-<?php echo $i; ?>" value="<?php echo $key; ?>" class="form-control"  />        
             
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





<?php if(is_array($cpackages) && count($cpackages) > 0 ){  ?>  
    
 

<div class="card" id="transfer-packages" style="display:none;">
<div class="card-header">
<span>
Transfer Listing Packages
</span>
</div>
<div class="card-body">

<div class="row">


<div class="col-md-6">

      
        <select onchange="jQuery('#fromM').val(this.value);" class="chzn-select" style="width:300px">
        <option></option>
          <?php $i = 0; if(is_array($cpackages) && !empty($cpackages) ){   foreach($cpackages['name'] as $data){ if($cpackages['name'][$i] != "" ){ ?> 
          
                <option value="<?php echo $cpackages['key'][$i]; ?>"><?php echo stripslashes($cpackages['name'][$i]); ?></option>
                
          <?php } $i++;  } } ?> 
          
        </select>

</div>

<div class="col-md-6">

        <select onchange="jQuery('#toM').val(this.value);" class="chzn-select" style="width:300px">
        <option></option>
          <?php $i = 0; if(is_array($cpackages) && !empty($cpackages) ){   foreach($cpackages['name'] as $data){ if($cpackages['name'][$i] != "" ){ ?> 
          
                <option value="<?php echo $cpackages['key'][$i]; ?>"><?php echo stripslashes($cpackages['name'][$i]); ?></option>
                
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
