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

global $CORE;

if(isset($_GET['massimport'])){ 
// ADD ON STYLES
wp_enqueue_style('addform', FRAMREWORK_URI.'css/backup_css/css.framework-addform.css');
wp_enqueue_style('addform');

wp_enqueue_script('addform', FRAMREWORK_URI.'js/backup_js/js.submission.js');
wp_enqueue_script('addform');

wp_enqueue_script('addform1', FRAMREWORK_URI.'js/backup_js/js.submissionupload.js');
wp_enqueue_script('addform1');

}

?>
 
 
<h4>Mass Import</h4>
<p class="lead">Here you can mass import multiple image/video files at once.</p>
<div class="linebar"></div>
  
<textarea class="form-control" name="fcustom" id="newCustomdata" style="display:none !important;"><?php 


if(isset($_GET['keys']) && is_array($_GET['keys'])){ foreach($_GET['keys'] as $i=> $k){ if($k == ""){$i++; continue; } echo $k."=".$_GET['values'][$i].","; } } ?></textarea>
    
<form action="<?php echo get_home_url(); ?>/wp-admin/admin.php?page=4" method="get" <?php if(isset($_GET['startmassimport'])){ ?>style="display:none;"<?php } ?>>

<input type="hidden" value="massimport" name="page" />
<input type="hidden" value="" name="tab" />
<input type="hidden" value="1" name="startmassimport" /> 
<input type="hidden" value="1" name="massimport" />



<div class="row formrow">

    <div class="col-md-4">
    
    <label>Listing Title</label>
    
    </div>
    <div class="col-md-8">
    
    <input type="text" name="ftitle" id="newTitle" value="<?php if(isset($_GET['ftitle'])){ echo trim($_GET['ftitle']); }else{ ?>Mass Imported File<?php } ?>" class="form-control" />
    
    </div> 
</div>

<div class="row formrow">

    <div class="col-md-4">
    
    <label>Custom Field Data</label>
    
     <p class="desc">This is the same as normal WordPress custom field data and will be saved with every file.</p>
    
    </div>
    <div class="col-md-8">
    
    <?php if(THEME_KEY == "ph"){ ?>
    
    <div class="bg-light p-2 mb-3">
        <div class="row">
        <div class="col-6">
        <input type="text" name="keys[]" class="form-control" value="media_type" />
        </div>
        <div class="col-6">
         <select name="values[]" class="form-control" style="width:99%;">
        <?php
        
            $values = array(1 => __( 'Photo', 'premiumpress' ), 2 => __( 'Video', 'premiumpress' )  );
            
            ?>
             
            <?php foreach($values as $k => $v){ ?>
            <option value="<?php echo $k; ?>" <?php if(isset($post->ID) && $CORE->get_edit_data('media_type', $post->ID) == $k){ echo "selected=selected"; } ?>><?php echo $v; ?></option>
            <?php } ?>
        
        </select>
        </div> 
        </div>
    </div>   
    
    <div class="bg-light p-2 mb-3">
        <div class="row">
        <div class="col-6">
        <input type="text" name="keys[]" class="form-control" value="orientation" />
        </div>
        <div class="col-6">
        <select name="values[]" class="form-control" style="width:99%;">
        <?php
        
            $values = array(1 => __( 'Horizontal', 'premiumpress' ), 2 => __( 'Vertical', 'premiumpress' )  );
            
            ?>
             
            <?php foreach($values as $k => $v){ ?>
            <option value="<?php echo $k; ?>" <?php if(isset($post->ID) && $CORE->get_edit_data('orientation', $post->ID) == $k){ echo "selected=selected"; } ?>><?php echo $v; ?></option>
            <?php } ?>
        
        </select>
        </div> 
        </div>
    </div>  
    
    
    <div class="bg-light p-2 mb-3">
        <div class="row">
        <div class="col-6">
        <input type="text" name="keys[]" class="form-control" value="setup" />
        </div>
        <div class="col-6">
        <select name="values[]" class="form-control" style="width:99%;">
        <?php
        
            $values = array(1 => __( 'Free Download', 'premiumpress' ), 2 => __( 'Paid Download', 'premiumpress' )  );
            
            ?>
             
            <?php foreach($values as $k => $v){ ?>
            <option value="<?php echo $k; ?>" <?php if(isset($post->ID) && $CORE->get_edit_data('setup', $post->ID) == $k){ echo "selected=selected"; } ?>><?php echo $v; ?></option>
            <?php } ?>
        
        </select>
        </div> 
        </div>
    </div>  
    <?php } ?>
    
    <div id="extracustomfields">
    <div class="bg-light p-2 mb-3">
        <div class="row">
        <div class="col-6">
        <input type="text" name="keys[]" class="form-control" placeholder="custom key" />
        </div>
        <div class="col-6">
        <input type="text" name="values[]" class="form-control" placeholder="custom value" />
        </div> 
        </div>
    </div>
    </div>
  
    
    <a href="javascript:void(0);" onClick="jQuery('#extracustomfields').clone().appendTo('#extracustomfields');" class="small"><u>Add New Field</u></a>
    
   
    
    </div> 
    
</div>
 
<div class="row formrow">
    
    
    <div class="col-md-4">
    
    <label>Category</label>
    
     <p class="desc">Select the category to assign all imported media too.</p>
     
     <p class="desc mt-3">Add new <a href="edit-tags.php?taxonomy=listing&post_type=listing_type">categories here.</a></p>
    
    
    </div>
    <div class="col-md-8">
  
<select data-placeholder="Choose a category..." class="form-control" style="height:400px !important;" multiple="multiple" id="ncatlist" onclick="addNewCat()";>
 
 <?php echo str_replace("<select","<option", wp_dropdown_categories( array(
                'walker'=> new Walker_Admin_Taxonomy, 
                'taxonomy' => THEME_TAXONOMY, 
                'show_count' => 1, 
                'hide_empty' => 0, 
                'echo' => 0,  
				'selected' => array(),
				)
             ) ); ?>
            
</select> 
<script>
function addNewCat(){
	jQuery('#newCat').val('');
	jQuery('#ncatlist > option:selected').each(function() {	 
		jQuery('#newCat').val( jQuery('#newCat').val() + ',' + jQuery(this).val() );
	});
}

</script>
<input type="hidden" id="newCat" value="<?php if(isset($_GET['fcats'])){ echo substr($_GET['fcats'],1); } ?>" name="fcats" />
    
    </div>
    
    </div>

</div>

<div class="text-center">
 
<div class="savebtnbox p3"><button type="submit" class="btn btn-lg btn-dark mt-3">Continue</button> </div> 
       
</form>       
       

       
<form id="fileupload" action="<?php echo get_home_url(); ?>/index.php" method="POST" enctype="multipart/form-data" <?php if(!isset($_GET['startmassimport'])){ ?>style="display:none;"<?php } ?>>
       
   
	   
       <!-- MASS UPLOAD FILE PROGRESS BAR --->
       <div class="fileupload-progress " id="fileuploaddisplayall" style="display:none;">
                <progress class="progress progress-success progress-striped active" role="progressbar" aria-valuemin="0" aria-valuemax="100" value="0" max="100"></progress>
                <div class="progress-extended">&nbsp;</div>
        <hr />
       </div>
        
       <!--- UPLOAD BUTTONS -->
       <div class="fileupload-loading"></div>
       <div class="fileupload-buttonbar">
       
      
           
                <button type="button" class="btn btn-info start pull-right"  onclick="jQuery('#fileuploaddisplayall').show();">
                    <i class="fa fa-upload"></i>
                    <span><?php echo __("Upload All","premiumpress"); ?></span>
                </button>
            
                <!-- The fileinput-button span is used to style the file input field as button -->
                <span class="btn btn-success fileinput-button">                  
                    <span><?php echo __("Select Files","premiumpress"); ?></span>
                    <input type="file" name="files[]" multiple>
                </span>
     <div class="clearfix"></div> 
     
     <p class="bg-light p-2 border text-left my-4">Images should be min 800px. Max filesize <?php echo ini_get('upload_max_filesize'); ?> and <?php echo ini_get('post_max_size'); ?> POST max size. (set by your hosting account)</p>
     
                 
     <div class="clearfix"></div>        
     </div>
     
     
     
     
     
     
     <!-- EDIT MEDIA BOX --->
     <div class="editbox" id="editmediabox" style="display:none;">
        <div class="media_edit_box">
            <div class="pull-right">
                <div class="btn btn-default" onclick="jQuery('#editmediabox').hide();">hide</div>
            </div>
         
            <div id="editmediaboxcontent"></div>
          	            
        </div>
     </div>
     <!-- END EDIT MEDIA BOX --->
 
 
	<div id="ajax_media_msg"></div>
        
	<div id="mediatablelist" class="files px-3"></div>
    
 
    
</form>
 
<script>
 
jQuery(document).ready(function() {

 
 
});
function setorder(saveorder){
	
	jQuery('#ajax_media_msg').html();
	var order = 1;
	jQuery('.dorder').each(function(i, obj) {
			jQuery(obj).val(order);
			order = order +1;
	});
	
	if(saveorder == 1){
		jQuery('.dorder').each(function(i, obj) {
			 
				ajax_media_order(jQuery(obj).data('pid'), jQuery(obj).data('aid'), jQuery(obj).val());
				 
		});
	}	
}
function ajax_media_order(id, attachmentid, orderid){

    jQuery.ajax({
        type: "POST",
        url: '<?php echo home_url(); ?>/',		
		data: {
            action: "set_media_order",		  
			pid: id,
			aid: attachmentid,
			order: orderid,
			 
        },
        success: function(response) {
			
			jQuery('#ajax_media_msg').html("Order Updated");
		 	console.log("order updated");
			
        },
        error: function(e) {
		console.log("error settings order "+e);
            //alert("error settings order "+e)
        }
    });

}	
function ajax_media_edit(id, attachmentid){

    jQuery.ajax({
        type: "POST",
        url: '<?php echo home_url(); ?>/',		
		data: {
            action: "set_media_title",		  
			pid: id,
			aid: attachmentid,
			title: jQuery('#media-title-'+attachmentid).val(),
			order: jQuery('#media-order-'+attachmentid).val(),
			 
        },
        success: function(response) {
			
			jQuery('#editmediaboxcontent').html(response);
			jQuery('#editmediabox').show();
			
        },
        error: function(e) {
            //alert("error "+e)
        }
    });

}
</script>
 
   
<?php if(isset($_GET['massimport'])){  ?>
 

<form method="post" action="<?php echo get_home_url(); ?>/index.php" target="core_delete_attachment_iframe" name="core_delete_attachment" id="core_delete_attachment">
<input type="hidden"  name="core_delete_attachment" value="gogo" />
<input type="hidden" id="attachement_id" name="attachement_id" value="" />
</form>
<iframe frameborder="0" style="display:none;" scrolling="auto" name="core_delete_attachment_iframe" id="core_delete_attachment_iframe"></iframe>
<!-- The template to display files available for upload -->
<script id="template-upload" type="text/x-tmpl">
{% for (var i=0, file; file=o.files[i]; i++) { %}
{% if (file.error) { %}
<div class="alert alert-danger"><b><?php echo $CORE->_e(array('add','22')); ?>:</b> {%=file.error%}
<button type="button" class="close" data-dismiss="alert" aria-label="Close">
  <span aria-hidden="true">&times;</span>
</button></div> 
{% } else { %}
<div class="uploaditem template-upload text-left"><div class="row">
    <div class="col-md-3 preview">
        <span class=""></span>
    </div>
    <div class="col-md-6">  
	<span class="fname">{%=file.name%}</span>  
<progress class="progress progress-success progress-striped active" role="progressbar" aria-valuemin="0" aria-valuemax="100" aria-valuenow="0" value="0" max="100"></progress>
</div> 
<div class="col-md-3">    
{% if (!i) { %}
<span class="cancel">
            <button class="btn btn-danger mt-2">
                <i class="fa fa-trash"></i>              
            </button>
</span>
{% } %}        
{% if (!o.options.autoUpload) { %}
<span class="start">
                <button class="btn btn-success mt-2">
                    <i class="fa fa-check"></i>
                    
                </button>
</span>
{% } %}    
    </div>
<div class="clearfix"></div>	
</div></div>
{% } %}
{% } %}
</script>
<!-- The template to display files available for download -->
<script id="template-download" type="text/x-tmpl">
{% for (var i=0, file; file=o.files[i]; i++) { %}
{% if (file.error) { %}
<div class="alert alert-danger"><b><?php echo __("Error","premiumpress"); ?>:</b> {%=file.error%}
<button type="button" class="close" data-dismiss="alert" aria-label="Close">
  <span aria-hidden="true">&times;</span>
</button></div> 
{% } else { %}
<div class="row uploaditem template-download text-left  {%=file.aid%}bb">
<div class="col-md-3 preview">
<a href="{%=file.url%}" title="{%=file.name%}" rel="gallery" download="{%=file.name%}"><img src="{%=file.thumbnail_url%}"></a>
</div>
<div class="col-md-6">	  
 
<a href="{%=file.link%}" target="_blank" class="btn btn-success mt-3">Visit Page</a>
</div>
<div class="col-md-3">
	<div class="delete mt-3">
	<button class="btn btn-danger" data-type="{%=file.delete_type%}" data-url="{%=file.delete_url%}"{% if (file.delete_with_credentials) { %} data-xhr-fields='{"withCredentials":true}'{% } %}>
	<i class="fa fa-trash"></i>            
	</button>
	</div>
</div>
<div class="clearfix"></div>	
</div>
{% } %}
{% } %}
</script>
<script>
jQuery(function () {

 

    // Initialize the jQuery File Upload widget:
    jQuery('#fileupload').fileupload({
        url: '<?php echo get_home_url(); ?>/wp-admin/admin.php?page=4',
		type: 'POST',
		paramName: 'core_attachments',
		fileTypes: '/^image\/(gif|jpeg|png)$/',
		formData: {  name: 'core_post_id', value: "newlisting", title: jQuery('#newTitle').val(), cat: jQuery('#newCat').val(), custom: jQuery('#newCustomdata').val()   }, 
	
		maxNumberOfFiles: 100,
		 
	 
    });	
	jQuery('#fileupload').bind('fileuploaddestroy', function (e, data) {
	 
		document.getElementById('attachement_id').value= data.url;
		document.core_delete_attachment.submit();	
	});
 
});	
</script> 
<?php } ?>