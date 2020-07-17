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

// LOAD IN MAIN DEFAULTS 
$core_admin_values = get_option("core_admin_values");  

// EMAILS
$wlt_emails = get_option("wlt_emails");


// EMAIL DEFAULTS
$emailto = "";
if(isset($_GET['emailto'])){ $emailto = $_GET['emailto']; }
$subject = "";
$content = "";

  
?>

<div class="row">

<div class="col-lg-8">

<div class="bg-white p-5 shadow" style="border-radius: 7px;">


<div class="tabheader mb-4">
 <h4><span>Quick Send</span></h4>
</div>
        

<form method="post" name="admin_email" id="admin_email" action="admin.php?page=3">
<input type="hidden" name="action" value="send-new-email" />
<input type="hidden" name="tab" value="send" />
 
       



<div class="row my-3">

<div class="col-md-4">
<input type="radio"  value="1" name="senttogo" onclick="jQuery('#eeu').hide();" <?php if(strlen($emailto) == 0){ ?>checked="checked"<?php } ?> /> All Users
</div>
<div class="col-md-4">
<input type="radio"  value="2" name="senttogo" onclick="jQuery('#eeu').show(); jQuery('#ueem').show();" <?php if(strlen($emailto) > 1){ ?>checked="checked"<?php } ?>/> Selected Users
</div>
<div class="col-md-4">
<input type="radio"  value="2" name="senttogo" onclick="jQuery('#eeu').show(); jQuery('#ueem').hide();" <?php if(strlen($emailto) > 1){ ?>checked="checked"<?php } ?>/> Email Address
</div>
</div>
 
 
<div class="row mb-2" id="eeu" style="display:none;">
    <div class="col-12" style="">
    <label class="txt500">Email To:</label>
    <div><input type="text"  name="to_emails" id="new_subject" class="form-control-sm btn-block" value="<?php echo $emailto; ?>"> </div>   
    </div>  
    <div class="col-12 mt-2" id="ueem">
    <label class="txt500">Users</label>
    <div class="clearfix"></div>
    
     <?php echo str_replace("name=","id='useremailselect' style='width:260px;' name=", wp_dropdown_users(array('name' => 'useremailselect', 'multi' => true, 'echo' => false, 'class' => 'chzn-select')) ); ?>
    
    </div>           
</div>
  

<script>

jQuery( "#useremailselect" ).change(function() {
 
 
    jQuery.ajax({
        type: "POST",
        url: '<?php echo home_url(); ?>/',		
		data: {
            action: "get_user_email",
			uid: jQuery(this).val(),
        },
        success: function(response) {			
			jQuery('#new_subject').val( jQuery('#new_subject').val() + ',' +response);		 
			
        },
        error: function(e) {
            alert("error "+e)
        }
    });	
 
});
</script>

<div class="clearfix"></div>

<div class="mb-3 mt-4">
<label class="txt500">Email Subject</label>
<input type="text"  name="subject" class="form-control-sm btn-block" value="<?php echo $subject; ?>"> 
</div>      
 

<div id="showemails" style="display:none">
<div class="my-2">

<script>
 
jQuery(document).ready(function(){

	//jQuery('#sendNewEmail #wp-message-media-buttons').after('<a href="javascript:void(0);" onclick="jQuery(\'#showemails\').toggle();" class="button"><i class="fa fa fa-envelope"></i> Get System Email Content</a> ');
<?php if(strlen($emailto) > 1){ ?>
	jQuery('#eeu').show();
	<?php } ?>

});


function SetEmailContent(eid){
 
    jQuery.ajax({
        type: "POST",
        url: '<?php echo home_url(); ?>/',		
		data: {
            action: "get_email_content",
			emailid: eid,
        },
        success: function(response) {	
		
			console.log(response);
 
			// ADD TEXT TO EDITOR
			text1 = response.replace("\n", "<br />")
			parent.tinyMCE.activeEditor.setContent(text1);
			 
			
        },
        error: function(e) {
         
        }
    });

}

</script>
<label>Select System Email</label>
<select data-placeholder="Choose a an email..." name="" onchange="SetEmailContent(this.value)" class="form-control">
<option></option>
	<?php 
	if(is_array($wlt_emails)){ 
		foreach($wlt_emails as $key=>$field){ 
			if(isset($core_admin_values['emails']) && isset($core_admin_values['emails'][$key1]) && $core_admin_values['emails'][$key1] == $key){	$sel = " selected=selected ";	}else{ $sel = ""; }
			echo "<option value='".$key."' ".$sel.">".stripslashes($field['subject'])."</option>"; 
		} 
	} 
	?> 
 
</select>  


</div>

</div>         
              
<div id="sendNewEmail" style=" margin-top:30px;">
<?php echo wp_editor( $content, 'message', array( 'textarea_name' => 'message', 'editor_height' => '300px') );  ?>                        
</div>
 

 

 
              
 
<button class="btn btn-lg mt-3 btn-block btn-primary" class="btn btn-dark">Send Email</button>
               
</form>

   




</div></div>

<div class="col-lg-4">


<a href="javascript:void(0);" onclick="jQuery('#MainTabs a[href=#settings]').tab('show');"  class="btn btn-primary mb-4 btn-lg btn-block text-left"><i class="fa fa-arrow-left mr-3"></i> Go Back</a>
    

</div></div>
