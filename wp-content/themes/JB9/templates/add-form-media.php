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

global $CORE, $userdata;
 
if(isset($_GET['post'])){ $_GET['eid'] = $_GET['post']; }

 
// GET EXISTING UPLOAD COUNT
$EXISTING_UPLOAD_COUNT = 0;
if(isset($_GET['eid'])){
$EXISTING_UPLOAD_COUNT = $CORE->UPLOADSPACE($_GET['eid']);
}


if(1==1){  

 
?>
<div class="<?php if(defined('IS_MOBILEVIEW') ){ }else{?>card rounded-0<?php } ?>" id="headingFiles">
<div class="card-header" id="headingFour">
   <h5 class="mb-0">
      <button class="btn btn-link btn-block text-left text-uppercase font-weight-bold text-dark" data-toggle="collapse" data-target="#collapseFour" aria-expanded="false" aria-controls="collapseFour">
      <?php echo __("Media Space","premiumpress"); ?> (<span id="mediaspaceused"><?php echo $EXISTING_UPLOAD_COUNT; ?></span> / <span class="uploadspace">0</span>) 
      </button>
   </h5>
</div>
<div id="collapseFour" class="collapse show" aria-labelledby="headingFour" data-parent="#accordion">
<div class="<?php if(defined('IS_MOBILEVIEW') ){ ?>mt-3<?php }else{?>card-body<?php } ?>">
<div id="mediauploadblock">
<?php } ?>
<form id="fileupload" action="<?php echo get_home_url(); ?>/index.php" method="POST" enctype="multipart/form-data">
 
   <div class="row mb-5 pb-4">
      <div class="col-md-6">
         <p class="lead"><?php echo str_replace("%s", ini_get('upload_max_filesize'), __("We support image files of type JPG, JPEG and PNG files up to %s with at least 800 pixels along one side.","premiumpress") ); ?></p>
         <p><?php echo str_replace("%s", ini_get('upload_max_filesize'), __("FLV, MP4, MPEG, MOV and AVI videos up to %s and a minimum resolution of 800x640 pixels.","premiumpress") ); ?> </p>
      </div>
      <div class="col-md-1">
      </div>
      <div class="col-md-4">
         <!--- UPLOAD BUTTONS -->
         <div class="fileupload-loading"></div>
         <div class="fileupload-buttonbar">
            <!-- The fileinput-button span is used to style the file input field as button -->
            <span class="btn btn-primary fileinput-button px-5 btn-block my-4"  onclick="jQuery('.start').show();" style="margin:auto auto;" id="mainuploadbutton"> 
            <span><?php echo __("Select File","premiumpress"); ?></span>
            <input type="file" name="files[]" multiple  >
            </span>
            <button type="button" id="uploadlalbtn" class="btn btn-secondary start btn-block"  style="display:none;" onclick="jQuery('#fileuploaddisplayall').show();">
            <i class="fa fa-upload"></i>
            <span><?php echo __("Upload All","premiumpress"); ?></span>
            </button>
            <div class="clearfix"></div>
         </div>
      </div>
   </div>
   <!-- MASS UPLOAD FILE PROGRESS BAR --->
   <div class="fileupload-progress" id="fileuploaddisplayall" style="display:none;">
      <progress class="progress progress-success progress-striped active" role="progressbar" aria-valuemin="0" aria-valuemax="100" value="0" max="100"></progress>
      <div class="progress-extended">&nbsp;</div>
   </div>
   <div id="ajax_media_msg"></div>
   <ul id="mediatablelist" class="files pl-0">
      <?php
         $counter = 1; $media = "";
         if(isset($_GET['eid'])){
         $media = $CORE->media_get($_GET['eid'],"all");
         }
         
         if(isset($_GET['eid']) && is_array($media) && !empty($media)){ 
         foreach($media as $img){
         	 
         ?>
      <li>
         <input type="hidden" value="<?php echo $img['order']; ?>" data-pid="<?php if( !isset($img['postID']) || ( isset($img['postID']) && $img['postID'] == "") ){ echo $_GET['eid']; }else{ echo $img['postID']; } ?>" data-aid="<?php if( !isset($img['postID']) || ( isset($img['postID']) && $img['postID'] == "") ){ echo "9999"; }else{ echo $img['id']; } ?>" class="dorder" id="media-order-<?php echo $img['id']; ?>"  />
         <div class="uploaditem template-upload clearfix ftype_<?php echo substr($img['type'],0,5); ?> imgshow<?php echo $counter; ?>">
            <div class="row">
               <div class="col-3 preview">
                  <?php  echo $CORE->media_display($img);  ?> 
               </div>
               <div class="col-7">
                  <div class="mb-1 text-uppercase small"><?php echo __("Media Caption","premiumpress"); ?></div>
                  <input type="text" value="<?php echo get_the_title($img['id']); ?>" 
                  id="media-title-<?php echo $img['id']; ?>" class="form-control rounded-0" onchange="ajax_media_edit(<?php if(isset($img['postID'])){ echo $img['postID']; } ?> ,<?php echo $img['id']; ?>)" />   
                  <div class="mt-1 small text-uppercase">
                     <?php if(isset($img['size'])){ echo $CORE->_format_bytes($img['size']); } ?> /  <?php echo $CORE->_format_type($img['type']); ?> <?php if(isset($img['dimentions']) && strlen($img['dimentions']) > 1){ echo "/ ".$img['dimentions']; } ?>
                  </div>
               </div>
               <div class="col-2 text-center">
                  <div class=" bits delete1 mt-4">
                     <button class="btn btn-secondary btn-sm wlt_tooltip" type="button" 		
                        data-placement="top"
                        data-original-title="<?php echo __("Delete","premiumpress"); ?>" 
                        data-trigger="hover"                       
                        onclick="ajax_media_delete('<?php if( !isset($img['postID']) || ( isset($img['postID']) && $img['postID'] == "") ){ echo $_GET['eid']; }else{ echo $img['postID']; } ?>','<?php if( !isset($img['postID']) || ( isset($img['postID']) && $img['postID'] == "") ){ echo "9999"; }else{ echo $img['id']; } ?>','<?php echo $counter; ?>');PreCheckuploadSpace();">
                     <i class="fa fa-trash nomargin" id="<?php echo $counter; ?>delbtn"></i>
                     </button>  
                  </div>
               </div>
            </div>
            <!-- end row -->
         </div>
         <div class="clearfix"></div>
      </li>
      <?php $counter++; } } ?>
   </ul>
</form>

 
 
 
<script>
 
jQuery(document).ready(function() {

	jQuery(".wlt_tooltip").tooltip({ html : true});

	// MAKE SORTABLE
	<?php  if(isset($_GET['eid'])){ ?>
	setTimeout(function(){
	jQuery( "#mediatablelist" ).sortable({
	
		stop: function( ) {
            //var order = $("#sortable").sortable("serialize", {key:'order[]'});
            //$( "p" ).html( order );
			setorder(1);
			//setorder();
        } 
	});
	}, 1500);  
	<?php } ?>
	
	// SET DEFAULT ORDER
 	setorder(0);
	
	
	
	<?php if(isset($_GET['eid']) && is_array($media) && !empty($media)){  ?>
	// IF USER HAS AN IMAGE ALREADY, SKIP TO NEXT SECTION
		jQuery('#collapseFour').collapse('toggle');
		setTimeout(function(){
		jQuery('#collapseOne').collapse('show');
		 }, 1000); 
	<?php } ?>
	
	
	
	
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
			
			jQuery('#ajax_media_msg').html("<?php echo __("Order Updated","premiumpress"); ?>");
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
			
			jQuery('#ajax_media_msg').html(response);
			jQuery('#editmediabox').show();
			
        },
        error: function(e) {
            //alert("error "+e)
        }
    });

}


function ajax_media_delete(id, attachmentid, counter){
	
	
	jQuery('#'+counter+'delbtn').removeClass('fa-trash').addClass('fa-spin fa-spinner');
	
    jQuery.ajax({
        type: "POST",
        url: '<?php echo home_url(); ?>/',		
		data: {
            action: "delete_file",		  
			pid: id,
			aid: attachmentid,	
			stopc:1,		 
        },
        success: function(response) {
			
			jQuery('.imgshow' + counter).hide();
			jQuery('.imgshow' + counter).html('');
			
			// UPDATE COUNTER			
			totalM = parseFloat(jQuery('#mediaspaceused').html());
			if(totalM == 0){ totalM = 1; }
			totalM = totalM - 1;
			jQuery('#mediaspaceused').html(totalM)
			
        },
        error: function(e) {
            alert("error "+e)
        }
    });

}

</script>
 
   
 </div><!-- end panel-body -->
 




</div>
  </div>
  </div> 
  

 

<form method="post" action="<?php echo get_home_url(); ?>/index.php" target="core_delete_attachment_iframe" name="core_delete_attachment" id="core_delete_attachment">
<input type="hidden"  name="core_delete_attachment" value="gogo" />
<input type="hidden" id="attachement_id" name="attachement_id" value="" />
</form>
<iframe frameborder="0" style="display:none;" scrolling="auto" name="core_delete_attachment_iframe" id="core_delete_attachment_iframe"></iframe>
<!-- The template to display files available for upload -->
<script id="template-upload" type="text/x-tmpl">
{% for (var i=0, file; file=o.files[i]; i++) { %}
{% if (file.error) { %}
<div class="alert alert-danger">{%=file.error%}
<button type="button" class="close" data-dismiss="alert" aria-label="Close">
  <span aria-hidden="true">&times;</span>
</button></div> 
{% } else { %}
<div class="uploaditem template-upload ">
<div class="row">
    <div class="col-3 preview">
        <span class=""></span>
    </div>
    <div class="col-6">  
	<span class="fname">{%=file.name%}</span>  
<progress class="progress progress-success progress-striped active" role="progressbar" aria-valuemin="0" aria-valuemax="100" aria-valuenow="0" value="0" max="100"></progress>
</div> 
<div class="col-3">  
{% if (!o.options.autoUpload) { %}
<span class="start"><button class="btn btn-primary btn-sm"><i class="fa fa-check nomargin"></i></button></span>
{% } %}   
{% if (!i) { %}
<span class="cancel"><button class="btn btn-secondary btn-sm btndeleteme" onclick="PreCheckuploadSpace();"><i class="fa fa-trash nomargin"></i></button></span>
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
<div class="alert alert-danger"  style="display:none;"><b><?php echo __("Error","premiumpress"); ?>:</b> {%=file.error%}
<button type="button" class="close" data-dismiss="alert" aria-label="Close">
  <span aria-hidden="true">&times;</span>
</button></div> 
{% } else { %}
<div class="uploaditem template-download  {%=file.aid%}bb">
<div class="row">
<div class="col-md-3 preview">
<a href="{%=file.url%}" title="{%=file.name%}" rel="gallery" download="{%=file.name%}"><img src="{%=file.thumbnail_url%}"></a>
</div>
<div class="col-md-7">
<div class="mb-1 text-uppercase small"><?php echo __("Media Caption","premiumpress"); ?></div>
<input type="text" value="{%=file.name%}" id="media-title-{%=file.aid%}" onchange="ajax_media_edit('<?php if(isset($_GET['eid'])){ echo $_GET['eid']; } ?>', '{%=file.aid%}');" class="form-input col-md-12" />
</div>
    <div class="col-md-2 text-center">     
    <div class=" bits delete mt-4">	 
	<button class="btn btn-sm btn-secondary btndeleteme" onclick="PreCheckuploadSpace();" data-type="{%=file.delete_type%}" data-url="{%=file.delete_url%}"{% if (file.delete_with_credentials) { %} data-xhr-fields='{"withCredentials":true}'{% } %}>
	<i class="fa fa-trash"></i>            
	</button>
	</div>	
</div>
</div></div>
{% } %}
{% } %}
</script>
<script>

jQuery(document).ready(function () {

 
    jQuery('#fileupload').fileupload({
        url: '<?php echo get_home_url(); ?>/index.php',
		type: 'POST',
		paramName: 'core_attachments',
		//fileTypes: '/^image\/(gif|jpeg|png)$/',
		formData: {  name: 'core_post_id', value: <?php if(isset($_GET['eid'])){ echo $_GET['eid']; }else{ echo 0; } ?>   },
	    success: function(response) {
	  
		  if(typeof response['error'] == "undefined" ){
			   
								  
					 jQuery('#SUBMISSION_FORM').append('<input type="hidden" value="'+response[0]['pid']+'" name="eid" />');
					 
					// SHOW HIDE BOXES
					<?php if(!isset($_GET['eid'])){ ?>
					jQuery('#collapseFour').collapse();
					setTimeout(function(){
								jQuery('#collapseOne').collapse('show');
								 }, 1000);
					jQuery('.card-header button').prop("disabled",false);	
					<?php } ?>
					
					// UPDATE COUNTER			
					totalM = parseFloat(jQuery('#mediaspaceused').html());
					if(totalM < 0){ totalM = 0; }
					totalM = totalM + 1;
					jQuery('#mediaspaceused').html(totalM);
			
			} else {
			
			alert(response['error']);
			
			}
			
        },
        error: function(e) {
            alert("error "+e)
        }
	 
});	

 
	jQuery('#fileupload').bind('fileuploadadd', function (e, data) {	
	
	 // CHECK WE HAVE ENOUGH SPACE LEFT
	 setTimeout(function(){ CheckuploadSpace(); }, 1000 );
	
	});

	
	jQuery('#fileupload').bind('fileuploaddestroy', function (e, data) {
	
		// UPDATE COUNTER			
		totalM = parseFloat(jQuery('#mediaspaceused').html());
		if(totalM == 0){ totalM = 1; }
		totalM = totalM - 1;
		jQuery('#mediaspaceused').html(totalM);
	 
		document.getElementById('attachement_id').value= data.url;
		document.core_delete_attachment.submit();	
	});
	
	


 
});	
 



	function PreCheckuploadSpace(){
	
	 	// CHECK WE HAVE ENOUGH SPACE LEFT
		 setTimeout(function(){ CheckuploadSpace(); }, 1000 );
	} 
	function CheckuploadSpace(){
	
	
		c = jQuery('#mediatablelist .uploaditem .preview').length; 
		
	 	
		if(c >=  jQuery('.uploadspace').html()){
		
			jQuery("#mainuploadbutton input").prop( "disabled", true );		
			jQuery(".fileinput-button").removeClass('btn-primary').addClass('btn-outline-primary');
			jQuery(".fileinput-button span").html("<?php echo trim(__("Upload Space Exceeded","premiumpress")); ?>");
			
			// REMOVE EXTRA UPLOADS
			removeNum = c - parseFloat(jQuery('.uploadspace').html());
			if(removeNum > 0){
				jQuery.each( jQuery('#mediatablelist .uploaditem') , function( key, v ) {				 
				  if(removeNum > 0){
				  jQuery(v).html('').hide();
				  removeNum--;
				  }				  
				});							
			}			
			
			jQuery("#mediatablelist .btn-secondary").on("click", CheckuploadSpace1);
			
		}else{
			jQuery("#mainuploadbutton input").prop( "disabled", false );
			jQuery(".fileinput-button span").html('<?php echo __("Select File","premiumpress"); ?>');		
		}
	
	}
	function CheckuploadSpace1(){
	
		c = jQuery('#mediatablelist .uploaditem').length;
		 	
		if(c >  jQuery('.uploadspace').html()){
		
		}else{
		
		jQuery("#mainuploadbutton input").prop( "disabled", false );
		jQuery(".fileinput-button span").html('<?php echo __("Select File","premiumpress"); ?>');
		
		}
		
	}



</script>