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

wp_enqueue_style( 'wp-color-picker' );
wp_enqueue_script(
            'iris',
            admin_url( 'js/iris.min.js' ),
            array( 'jquery-ui-draggable', 'jquery-ui-slider', 'jquery-touch-punch' ),
            false,
            1
        );
  
?> 
 
 
<div class="card">
<div class="card-header">

<a href="#" rel="tooltip" data-original-title="– A stripped down version of your website – Ideal for seeing your website on a mobile device." data-placement="top" class="btn btn-help btn-sm float-right"><i class="fa fa fa-info" aria-hidden="true"></i></a>
<span>
Mobile Website 
</span>
</div>
<div class="card-body">




<div class="row">
<div class="col-md-6">


  <label> Enable Mobile Web <span rel="tooltip" data-original-title="If turned ON, users will be able to see the BETA version of your website on their mobile phones. If turned OFF, users will see the standard responsive version of your website." data-placement="top">
      <i class="fa fa-info-circle" aria-hidden="true"></i>
        </span>

</label>
  
  
   <div>
                                      <label class="radio off">
                                      <input type="radio" name="toggle" 
                                      value="off" onchange="document.getElementById('mobileweb').value='0'">
                                      </label>
                                      <label class="radio on">
                                      <input type="radio" name="toggle"
                                      value="on" onchange="document.getElementById('mobileweb').value='1'">
                                      </label>
                                      <div class="toggle <?php if(_ppt('mobileweb') == '1'){  ?>on<?php } ?>">
                                        <div class="yes">ON</div>
                                        <div class="switch"></div>
                                        <div class="no">OFF</div>
                                      </div>
                                    </div> 
  
  
   <input type="hidden" id="mobileweb" name="admin_values[mobileweb]" 
                                 value="<?php echo _ppt('mobileweb'); ?>">
                                 
                                 


<hr />



<label>Mobile Text Logo </label>
<input type="text" class="form-control" name="admin_values[mobileweb_logo_text]"  value="<?php echo _ppt('mobileweb_logo_text'); ?>" />


<?php /*
<label>Mobile Color</label>

<input type="text" class="form-control color-field" name="admin_values[mobileweb_color]"  value="<?php echo _ppt('mobileweb_color'); ?>" />

 
<script>
jQuery(document).ready(function(){

        jQuery('.color-field').iris();
}); 
</script>                         
                                 
*/ ?>
                        
                    
                                 
</div>                           
<div class="col-md-6">


<label>Mobile Image Logo </label>
             
                     
<input type="hidden" 
id="up_logo_mobile_url_aid" 
name="admin_values[logo_mobile_url_aid]" 
value="<?php if( _ppt('logo_mobile_url_aid') != ""){  echo stripslashes(_ppt('logo_mobile_url_aid')); } ?>"  />                
   
                
<input 
name="admin_values[logo_mobile_url]" 
type="hidden" 
id="up_logo_mobile_url" 
value="<?php if(_ppt('logo_mobile_url') != ""){  echo stripslashes(_ppt('logo_mobile_url')); } ?>" />



<?php if( substr(_ppt('logo_mobile_url'),0,4) == "http"){ ?>

<div class="pptselectbox bg-dark p-5 text-center">
  <img src="<?php echo _ppt('logo_mobile_url'); ?>" style="max-width:300px; max-height:300px;" id="logo_mobile_url_preview" />   
</div>

<div class="pptselectbtns">

<a href="<?php echo _ppt('logo_mobile_url'); ?>" target="_blank" class="btn btn-primary">View </a>
 
<a href="javascript:void(0);"id="editImg_logo_mobile_url" class="btn btn-primary">Edit </a>

<a href="javascript:void(0);" id="upload_logo_mobile_url" class="btn btn-primary">Change </a>

<a href="javascript:void(0);" onclick="jQuery('#up_logo_mobile_url').val('');document.admin_save_form.submit();" class="btn btn-primary">Delete</a>

</div>

<?php }else{ ?>

<div class="pptselectbox bg-dark p-5 text-center" style="padding:0px;">
<a href="javascript:void(0);" id="upload_logo_mobile_url">
    <img src="<?php echo FRAMREWORK_URI; ?>/admin/images/select.png" class="simg" id="logo_mobile_url_preview" />
    <div>select image</div>
</a> 
</div>

<?php } ?>
                
 
 
<script > 
jQuery(document).ready(function () {

	jQuery('#editImg_logo_mobile_url').click(function() {           
			   	 
		tb_show('', 'media.php?attachment_id=<?php echo _ppt('logo_mobile_url_aid'); ?>&action=edit&amp;TB_iframe=true');
					 
		return false;
	});
	
	jQuery('#upload_logo_mobile_url').click(function() {           
	
		ChangeAIDBlock('up_logo_mobile_url_aid');
		ChangeImgBlock('up_logo_mobile_url');		
		ChangeImgPreviewBlock('logo_mobile_url_preview')
		
		formfield = jQuery('#up_logo_mobile_url').attr('name');
	 
		tb_show('', 'media-upload.php?type=image&amp;TB_iframe=true');
			return false;
	});
					
});	
</script> 

</div>                 
                                 
</div>                            
                                 
                                 
                                 
                                 
                                 
                                 

</div><!-- end block -->
</div><!-- end card --> 

 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 <div class="card">
<div class="card-header">

<span>Home Page Banner </span>

</div>
<div class="card-body">   
 



<div class="row">
<div class="col-md-6">


<label>Display Text</label>
     


<textarea name="admin_values[mobile_home_text_en_us]" id="mobile_home_text_en_us" style="height:100px;" class="form-control m-b-1"><?php echo stripslashes(_ppt('mobile_home_text_en_us')); ?></textarea>

<?php if(is_array(_ppt('languages') )){ echo "<br>"; foreach(_ppt('languages') as $lang){ $icon = explode("_",$lang); if(strtolower($icon[1]) == "us"){ continue; } ?>
<div class="input-group"> 
<span class="add-on input-group-prepend"> 

<a href="javascript:void(0);" onclick="ajax_translate(jQuery('#mobile_home_text_en_us').val(),'en','<?php echo strtolower($lang); ?>','#mobile_home_text_<?php echo strtolower($lang); ?>');">
<div class="flag flag-<?php if(isset($icon[1])){ echo strtolower($icon[1]); }else{ echo $icon[0]; } ?>">&nbsp;</div>
</a>
</span>     
<textarea name="admin_values[mobile_home_text_<?php echo strtolower($lang); ?>]" id="mobile_home_text_<?php echo strtolower($lang); ?>" style="height:100px;" class="form-control m-b-1"><?php echo stripslashes(_ppt('mobile_home_text_'.strtolower($lang))); ?></textarea>
</div>    
<?php } } ?> 




</div>
<div class="col-md-6">






<label>Home Page Image  (375x250 pixels)</label>
             
                     
<input type="hidden" 
id="up_mobile_banner_url_aid" 
name="admin_values[mobile_banner_url_aid]" 
value="<?php if( _ppt('mobile_banner_url_aid') != ""){  echo stripslashes(_ppt('mobile_banner_url_aid')); } ?>"  />                
   
                
<input 
name="admin_values[mobile_banner_url]" 
type="hidden" 
id="up_mobile_banner_url" 
value="<?php if(_ppt('mobile_banner_url') != ""){  echo stripslashes(_ppt('mobile_banner_url')); } ?>" />



<?php if( substr(_ppt('mobile_banner_url'),0,4) == "http"){ ?>

<div class="pptselectbox bg-dark p-5 text-center  mb-2">
  <img src="<?php echo _ppt('mobile_banner_url'); ?>" style="max-width:300px; max-height:300px;" id="mobile_banner_url_preview" />   
</div>

<div class="pptselectbtns">

<a href="<?php echo _ppt('mobile_banner_url'); ?>" target="_blank" class="btn btn-primary">View </a>
 
<a href="javascript:void(0);"id="editImg_mobile_banner_url" class="btn btn-primary">Edit </a>

<a href="javascript:void(0);" id="upload_mobile_banner_url" class="btn btn-primary">Change </a>

<a href="javascript:void(0);" onclick="jQuery('#up_mobile_banner_url').val('');document.admin_save_form.submit();" class="btn btn-primary">Delete</a>

</div>

<?php }else{ ?>

<div class="pptselectbox bg-dark p-5 text-center  mb-2">
<a href="javascript:void(0);" id="upload_mobile_banner_url">
    <img src="<?php echo FRAMREWORK_URI; ?>/admin/images/select.png" class="simg" id="mobile_banner_url_preview" />
    <div>select image</div>
</a> 
</div>

<?php } ?>
                




</div></div>


<script > 
jQuery(document).ready(function () {

	jQuery('#editImg_mobile_banner_url').click(function() {           
			   	 
		tb_show('', 'media.php?attachment_id=<?php echo _ppt('mobile_banner_url_aid'); ?>&action=edit&amp;TB_iframe=true');
					 
		return false;
	});
	
	jQuery('#upload_mobile_banner_url').click(function() {           
	
		ChangeAIDBlock('up_mobile_banner_url_aid');
		ChangeImgBlock('up_mobile_banner_url');		
		ChangeImgPreviewBlock('mobile_banner_url_preview')
		
		formfield = jQuery('#up_mobile_banner_url').attr('name');
	 
		tb_show('', 'media-upload.php?type=image&amp;TB_iframe=true');
			return false;
	});
					
});	
</script> 




</div><!-- end block -->
</div><!-- end card --> 








 <div class="card">
<div class="card-header">

<span>Mobile APP Push Notification </span>

</div>
<div class="card-body">   
 

<textarea class="form-control" style="width:100%; height:400px;"></textarea>

<button type="button">Send Notification</button>




</div><!-- end block -->
</div><!-- end card --> 
