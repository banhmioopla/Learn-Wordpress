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


  
?> 
 

<div class="card">
<div class="card-header">


<a href="#" rel="tooltip" data-original-title="The fallback image is the image displayed when no other image exists. <br /> Recommended dimensions are: 350 x 350 pixels.
" data-placement="top" class="btn btn-help btn-sm float-right"><i class="fa fa fa-info" aria-hidden="true"></i></a>

<span>
Fallback Image Settings
</span>
</div>
<div class="card-body">


<div class="row"> 
          
    <div class="col-md-12">
                   
    
<input type="hidden" 
id="up_fallback_image_aid" 
name="admin_values[fallback_image_aid]" 
value="<?php  echo stripslashes(_ppt('fallback_image_aid'));  ?>"  />                
   
                
<input 
name="admin_values[fallback_image]" 
type="hidden" 
id="up_fallback_image" 
value="<?php echo stripslashes(_ppt('fallback_image'));  ?>" />



<?php if(substr(_ppt('fallback_image'),0,4) == "http"){ ?>

<div class="pptselectbox bg-dark p-5 text-center bg-dark p-5 text-center  mb-2">
  <img src="<?php echo _ppt('fallback_image'); ?>" style="max-width:300px; max-height:300px;" id="fallback_image_preview" />   
</div>

<div class="pptselectbtns">

<a href="<?php echo _ppt('fallback_image'); ?>" target="_blank" class="btn btn-primary">View </a>
 
<a href="javascript:void(0);"id="editImg_fallback_image" class="btn btn-primary">Edit </a>

<a href="javascript:void(0);" id="upload_fallback_image" class="btn btn-primary">Change </a>

<a href="javascript:void(0);" onclick="jQuery('#up_fallback_image').val('');document.admin_save_form.submit();" class="btn btn-primary">Delete</a>

</div>

<?php }else{ ?>

<div class="pptselectbox bg-dark p-5 text-center bg-dark p-5 text-center  mb-2">
<a href="javascript:void(0);" id="upload_fallback_image">
    <img src="<?php echo FRAMREWORK_URI; ?>/admin/images/select.png" class="simg" id="fallback_image_preview" />
    <div>select image</div>
</a> 
</div>

<?php } ?>
                

                

   
<script >
jQuery(document).ready(function () {

	jQuery('#editImg_fallback_image').click(function() {           
			   	 
		tb_show('', 'media.php?attachment_id=<?php echo _ppt('fallback_image_aid'); ?>&action=edit&amp;TB_iframe=true');
					 
		return false;
	});
	
	jQuery('#upload_fallback_image').click(function() {           
	
		ChangeAIDBlock('up_fallback_image_aid');
		ChangeImgBlock('up_fallback_image');		
		ChangeImgPreviewBlock('fallback_image_preview')
		
		formfield = jQuery('#up_fallback_image').attr('name');
	 
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

<a href="#" rel="tooltip" data-original-title="Here you can turn on/off different upload formats." data-placement="top" class="btn btn-help btn-sm float-right"><i class="fa fa fa-info" aria-hidden="true"></i></a>

<span>

Media Upload Types

</span>
</div>
<div class="card-body">

<div class="row">

<div class="col-md-3">

	<label>Image Uploads</label>
	
    <div>
    <label class="radio off">
                                  <input type="radio" name="toggle" 
                                  value="off" onchange="document.getElementById('allow_images').value='0'">
                                  </label>
                                  <label class="radio on">
                                  <input type="radio" name="toggle"
                                  value="on" onchange="document.getElementById('allow_images').value='1'">
                                  </label>
                                  <div class="toggle <?php if(_ppt('allow_images') == '1'){  ?>on<?php } ?>">
                                    <div class="yes">ON</div>
                                    <div class="switch"></div>
                                    <div class="no">OFF</div>
                                  </div>
                                </div> 
                                
                                <input type="hidden" id="allow_images" name="admin_values[allow_images]" value="<?php echo _ppt('allow_images'); ?>">

</div>

<div class="col-md-3">

	<label>Video Uploads</label>
	
    <div>
    <label class="radio off">
                                  <input type="radio" name="toggle" 
                                  value="off" onchange="document.getElementById('allow_video').value='0'">
                                  </label>
                                  <label class="radio on">
                                  <input type="radio" name="toggle"
                                  value="on" onchange="document.getElementById('allow_video').value='1'">
                                  </label>
                                  <div class="toggle <?php if(_ppt('allow_video') == '1'){  ?>on<?php } ?>">
                                    <div class="yes">ON</div>
                                    <div class="switch"></div>
                                    <div class="no">OFF</div>
                                  </div>
                                </div> 
                                
                                <input type="hidden" id="allow_video" name="admin_values[allow_video]" value="<?php echo _ppt('allow_video'); ?>">

</div>


<div class="col-md-3">

	<label>Document Uploads</label>
	
    <div>
    <label class="radio off">
                                  <input type="radio" name="toggle" 
                                  value="off" onchange="document.getElementById('allow_docs').value='0'">
                                  </label>
                                  <label class="radio on">
                                  <input type="radio" name="toggle"
                                  value="on" onchange="document.getElementById('allow_docs').value='1'">
                                  </label>
                                  <div class="toggle <?php if(_ppt('allow_docs') == '1'){  ?>on<?php } ?>">
                                    <div class="yes">ON</div>
                                    <div class="switch"></div>
                                    <div class="no">OFF</div>
                                  </div>
                                </div> 
                                
                                <input type="hidden" id="allow_docs" name="admin_values[allow_docs]" value="<?php echo _ppt('allow_docs'); ?>">

</div>


<div class="col-md-3">

	<label>Audio Uploads</label>
	
    <div>
    <label class="radio off">
                                  <input type="radio" name="toggle" 
                                  value="off" onchange="document.getElementById('allow_audio').value='0'">
                                  </label>
                                  <label class="radio on">
                                  <input type="radio" name="toggle"
                                  value="on" onchange="document.getElementById('allow_audio').value='1'">
                                  </label>
                                  <div class="toggle <?php if(_ppt('allow_audio') == '1'){  ?>on<?php } ?>">
                                    <div class="yes">ON</div>
                                    <div class="switch"></div>
                                    <div class="no">OFF</div>
                                  </div>
                                </div> 
                                
                                <input type="hidden" id="allow_audio" name="admin_values[allow_audio]" value="<?php echo _ppt('allow_audio'); ?>">

</div>

</div><!-- end row -->


</div><!-- end block -->
</div><!-- end card -->  



















<div class="card">
<div class="card-header">


<a href="#" rel="tooltip" data-original-title="The fallback image is the image displayed when no other image exists. <br /> Recommended dimensions are: 350 x 350 pixels.
" data-placement="top" class="btn btn-help btn-sm float-right"><i class="fa fa fa-info" aria-hidden="true"></i></a>

<span>
Watermark Image Settings
</span>
</div>
<div class="card-body">


<div class="row">

    <div class="col-md-3">
    
    	<label>Enable Watermark<span rel="tooltip" data-original-title="If turned ON, images will be displayed with a watermark." data-placement="top">
      <i class="fa fa-info-circle" aria-hidden="true"></i>
        </span></label>
        
 		<div>
                                  <label class="radio off">
                                  <input type="radio" name="toggle" 
                                  value="off" onchange="document.getElementById('watermark').value='0'">
                                  </label>
                                  <label class="radio on">
                                  <input type="radio" name="toggle"
                                  value="on" onchange="document.getElementById('watermark').value='1'">
                                  </label>
                                  <div class="toggle <?php if(_ppt('watermark') == '1'){  ?>on<?php } ?>">
                                    <div class="yes">ON</div>
                                    <div class="switch"></div>
                                    <div class="no">OFF</div>
                                  </div>
                                </div> 
                                
                                <input type="hidden" id="watermark" name="admin_values[watermark]" 
                             value="<?php echo _ppt('watermark'); ?>">
 

</div>


<div class="col-md-9">

<label>Watermark Text</label>

   <input type="text" class="form-control" name="admin_values[watermark_text]" value="<?php echo _ppt('watermark_text'); ?>">

</div>

</div>


</div><!-- end block -->
</div><!-- end card -->  

 
