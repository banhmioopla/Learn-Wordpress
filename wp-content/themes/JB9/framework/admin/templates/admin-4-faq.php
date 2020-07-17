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
if(isset($_POST['cfaq']) && current_user_can('administrator') ){

update_option("cfaq", $_POST['cfaq']);

}
  
$cfaq = get_option("cfaq"); 


  
?> 
 

<script>
jQuery(document).ready(function() {	
    jQuery( "#customfieldlist" ).sortable(); 

});
</script>
 
 
<?php get_template_part('framework/admin/templates/admin', 'form-top' ); ?>
<div class="row">   
<div class="col-md-8">

<div class="bg-white p-5 shadow" style="border-radius: 7px;">


<div class="tabheader mb-4">

<a href="javascript:void(0);" onClick="jQuery('#customfieldlist_new').clone().prependTo('#customfieldlist');" class="btn-sm btn-primary btn float-right">Add New Field</a>	

       <h4><span>F.A.Q</span></h4>
      </div>
      
 

<ul id="customfieldlist">
<?php if(is_array($cfaq)){ $i=0; $setKeys = array(); $selectedcatlist = array();

foreach($cfaq['name'] as $data){ 

	if($cfaq['name'][$i] != "" ){  ?>
    
    
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
        
        &nbsp; <strong><?php echo $cfaq['name'][$i]; ?></strong>  
        
        </div>
    
    </div>
    
    <div class="inside cf-<?php echo $i; ?>">  
         
        <label class="txt500">Title <span class="required">*</span></label>      
        
        <input type="text" name="cfaq[name][]" id="title-<?php echo $i; ?>" value="<?php echo $cfaq['name'][$i]; ?>" class="form-control"  />       
        
      	<label class="mt-2 txt500">Description <span class="required">*</span></label>  
  		
        <textarea name="cfaq[desc][]" style="width:100%; height:200px !important;" class="form-control"><?php echo $cfaq['desc'][$i]; ?></textarea>

	</div>
    
</li>
 <?php $i++; } ?>    
    
<?php } ?>    

<?php } ?>  
</ul>
<div class="bg-primary p-1 text-center mt-5 shadow" style="border-radius: 7px;">

<button type="submit" class="btn btn-lg btn-primary btn-block">Save Settings</button> 

</div>
 <?php get_template_part('framework/admin/templates/admin', 'form-bottom' ); ?>

<div style="display:none"><div id="customfieldlist_new">

    <li class="cfielditem"> 
    
    <div class="heading">
    <div class="name">New FAQ</div>
    </div>
    <div class="inside">    
       
        <label>Title</label>
        <input type="text" name="cfaq[name][]" value="" id="nfaqt" class="form-control" />  
         
        
        <label class="mt-1">Description</label>
        <textarea name="cfaq[desc][]" style="width:100%; height:200px;" class="form-control"></textarea>
    
    <hr />
    <button class="btn btn-primary" type="submit" onclick="checknotblank()">Save</button>
    
    </div>
    
    </li>  
      
</div></div>

</div></div></div>

<script>
function checknotblank(){
if(jQuery('#nfaqt').val() == ""){  jQuery('#nfaqt').val(' '); }
}
</script>
 