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
if(isset($_POST['ctestimonial']) && current_user_can('administrator') ){

update_option("ctestimonial", $_POST['ctestimonial']);

}
  
$ctestimonial = get_option("ctestimonial"); 

 
?> 
 

<script>
jQuery(document).ready(function() {	
    jQuery( "#customfieldlisttest" ).sortable(); 

});
</script>


<div class="row">   
<div class="col-md-8">

<div class="bg-white p-5 shadow" style="border-radius: 7px;">


<div class="tabheader mb-4">

<a href="javascript:void(0);" onClick="jQuery('#customfieldlisttest_new').clone().prependTo('#customfieldlisttest');" class="btn-sm btn-primary btn float-right">Add Testimonial</a>	
 
       <h4><span>Testimonial</span></h4>
      </div>
      
  <?php get_template_part('framework/admin/templates/admin', 'form-top' ); ?>


<ul id="customfieldlisttest">
<?php if(is_array($ctestimonial)){ $i=0; $setKeys = array(); $selectedcatlist = array();

foreach($ctestimonial['name'] as $data){ 

	if($ctestimonial['name'][$i] != "" ){  ?>
    
    
<li class="cfielditem closed " id="testrowid-<?php echo $i; ?>">
	
    <div class="heading">
      
     	<div class="showhide">
            <a href="#" onclick="jQuery('.cf-<?php echo $i; ?>').fadeToggle();" rel="tooltip" data-original-title="Show/Hide Options" data-placement="top" class="btn btn-primary btn-sm">
            <i class="fa fa-search" aria-hidden="true"></i>
            </a>                                  
        </div>            

        <div class="name">
        
        <a href="#" onClick="jQuery('#testrowid-<?php echo $i; ?>').html('').hide();" rel="tooltip" data-original-title="Delete" data-placement="top" class="btn btn-primary btn-sm">
        <i class="fas fa-times" aria-hidden="true"></i>
        </a> 
        
        &nbsp; <strong><?php echo $ctestimonial['name'][$i]; ?></strong>  
        
        </div>
    
    </div>
    
    <div class="inside cf-<?php echo $i; ?>">  
         
         
        <div class="row">
        
        <div class="col-md-6">
        
        <label>User - Full Name <span class="required">*</span></label>      
        
        <input type="text" name="ctestimonial[name][]" value="<?php echo $ctestimonial['name'][$i]; ?>" class="form-control"  />  
        
        </div>
        
        <div class="col-md-6">
        
        <label>User - Job Title <span class="required">*</span></label>      
        
        <input type="text" name="ctestimonial[name_title][]" value="<?php if(isset($ctestimonial['name_title'][$i])){ echo $ctestimonial['name_title'][$i]; } ?>" class="form-control"  />  
        
        </div>
        

        </div>
        
             
        <label class="mt-1">User - Photo</label>      
        
        <input type="text" name="ctestimonial[userphoto][]" value="<?php if(isset($ctestimonial['userphoto'][$i])){ echo $ctestimonial['userphoto'][$i]; } ?>" class="form-control"  />  
         
         
         
<input type="hidden" 
id="up_logo_url_aid<?php echo $i; ?>" 
name="ctestimonial[logo_url_aid][]" 
value="<?php if(isset($ctestimonial["logo_url_aid"][$i])){  echo stripslashes($ctestimonial["logo_url_aid"][$i]); } ?>"  />                
   
                
<input 
name="ctestimonial[logo_url][]" 
type="hidden" 
id="up_logo_url<?php echo $i; ?>" 
value="<?php if($ctestimonial['logo_url'][$i] != ""){  echo stripslashes($ctestimonial['logo_url'][$i]); } ?>" />



<?php if(isset($ctestimonial['logo_url'][$i]) && substr($ctestimonial['logo_url'][$i],0,4) == "http"){ ?>

<div class="pptselectbox bg-dark p-5 text-center  mb-2">
  <img src="<?php echo $ctestimonial['logo_url'][$i]; ?>" style="max-width:300px; max-height:300px;" id="logo_url_preview<?php echo $i; ?>" />   
</div>

<div class="pptselectbtns">

<a href="<?php if(isset($ctestimonial['logo_url'][$i])){ echo $ctestimonial['logo_url'][$i]; } ?>" target="_blank" class="btn btn-primary">View </a>
 
<a href="javascript:void(0);"id="editImg_logo_url<?php echo $i; ?>" class="btn btn-primary">Edit </a>

<a href="javascript:void(0);" id="upload_logo_url<?php echo $i; ?>" class="btn btn-primary">Change </a>

<a href="javascript:void(0);" onclick="jQuery('#up_logo_url<?php echo $i; ?>').val('');document.admin_save_form.submit();" class="btn btn-primary">Delete</a>

</div>

<?php }else{ ?>

<div class="pptselectbox bg-dark p-5 text-center  mb-2">
<a href="javascript:void(0);" id="upload_logo_url<?php echo $i; ?>">
    <img src="<?php echo FRAMREWORK_URI; ?>/admin/images/select.png" class="simg" id="logo_url_preview<?php echo $i; ?>" />
    <div>select image</div>
</a> 
</div>

<?php } ?>
                

                

   
<script >
jQuery(document).ready(function () {

	jQuery('#editImg_logo_url<?php echo $i; ?>').click(function() {           
			   	 
		tb_show('', 'media.php?attachment_id=<?php if(isset($ctestimonial["logo_url_aid"][$i])){ echo $ctestimonial["logo_url_aid"][$i]; } ?>&action=edit&amp;TB_iframe=true');
					 
		return false;
	});
	
	jQuery('#upload_logo_url<?php echo $i; ?>').click(function() {           
	
		ChangeAIDBlock('up_logo_url_aid<?php echo $i; ?>');
		ChangeImgBlock('up_logo_url<?php echo $i; ?>');		
		ChangeImgPreviewBlock('logo_url_preview<?php echo $i; ?>')
		
		formfield = jQuery('#up_logo_url<?php echo $i; ?>').attr('name');
	 
		tb_show('', 'media-upload.php?type=image&amp;TB_iframe=true');
			return false;
	});
					
});	
</script>
         
         
         
         
         
         
         
         
         
         
         
        
        <div class="row">
        <div class="col-md-6">
        
        <label class="mt-1">Date <span class="required">*</span></label>      
        
        <input type="text" name="ctestimonial[date][]" value="<?php if(isset($ctestimonial['date'][$i])){ echo $ctestimonial['date'][$i]; } ?>" class="form-control"  /> 
        
        </div>
        <div class="col-md-6"> 
             
        <label class="mt-1">Rating <span class="required">*</span></label>      
        
        <select name="ctestimonial[rating][]" class="form-control">
        
        <option value="1" <?php if(isset($ctestimonial['rating'][$i]) && $ctestimonial['rating'][$i] == 1){ echo 'selected=selected'; } ?>>1 Star</option>
        <option value="2" <?php if(isset($ctestimonial['rating'][$i]) && $ctestimonial['rating'][$i] == 2){ echo 'selected=selected'; } ?>>2 Stars</option>
        <option value="3" <?php if(isset($ctestimonial['rating'][$i]) && $ctestimonial['rating'][$i] == 3){ echo 'selected=selected'; } ?>>3 Stars</option>
        <option value="4" <?php if(isset($ctestimonial['rating'][$i]) && $ctestimonial['rating'][$i] == 4){ echo 'selected=selected'; } ?>>4 Stars</option>
        <option value="5" <?php if(isset($ctestimonial['rating'][$i]) && $ctestimonial['rating'][$i] == 5){ echo 'selected=selected'; } ?>>5 Stars</option>
        
        
        </select>
         
        </div>
        </div>
        
        
      	<label class="mt-1">Description <span class="required">*</span></label>  
  		
        <textarea name="ctestimonial[desc][]" style="width:100%; height:200px !important;" class="form-control"><?php if(isset($ctestimonial['desc'][$i])){ echo stripslashes($ctestimonial['desc'][$i]); } ?></textarea>

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


</div></div> </div>


<div style="display:none"><div id="customfieldlisttest_new">

    <li class="cfielditem"> 
    
    <div class="heading">
    <div class="name">New testimonial</div>
    </div>
    <div class="inside">    
       
        <label>Name</label>
        <input type="text" name="ctestimonial[name][]" value="" id="ntestimonialt" class="form-control" />  
         
        
        <label class="mt-1">Description</label>
        <textarea name="ctestimonial[desc][]" style="width:100%; height:200px;" class="form-control"></textarea>
    
    <hr />
    <button class="btn btn-primary" type="submit" onclick="checknotblank()">Save</button>
    
    </div>
    
    </li>  
      
</div></div>

<script>
function checknotblank(){
if(jQuery('#ntestimonialt').val() == ""){  jQuery('#ntestimonialt').val(' '); }
}
</script>

 