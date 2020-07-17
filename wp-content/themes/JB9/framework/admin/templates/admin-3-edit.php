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

global $CORE, $default_email_array; 

if(isset($_GET['edit_email']) && is_numeric($_GET['edit_email']) ){ 
$wlt_emails = get_option("wlt_emails");

?>
  

<form method="post" name="admin_email" id="admin_email" action="admin.php?page=3" >
<input type="hidden" name="action" value="newemail" />
<input type="hidden" name="tab" value="email" />
<input type="hidden" name="page" value="3" />
<?php if(isset($_GET['edit_email']) && $_GET['edit_email'] > 0 ){ ?>
<input type="hidden" name="eid" value="<?php echo $_GET['edit_email']; ?>" />
<input type="hidden" name="wlt_email[ID]" value="<?php echo $_GET['edit_email']; ?>" />
<?php } ?>
<div class="card"><div class="card-header"><span>Email</span></div><div class="card-body"> 



          	 <div class="">
             
                <label class="control-label span3" for="normal-field">Subject</label>
                
                <br />
                <div class="mb-2">
                  <input type="text"  name="wlt_email[subject]" class="form-control" value="<?php if(isset($_GET['edit_email']) && isset($wlt_emails[$_GET['edit_email']]['subject']) ){ echo stripslashes($wlt_emails[$_GET['edit_email']]['subject']); }?>">
                   
                </div>
              </div> 
              
              <div class="clearfix"></div>
              
              <div class=" mt-3">
                <style>
				.wp-switch-editor, .tmce-active .switch-tmce, .html-active .switch-html { height:27px !important; }
				</style>
                 
                 
                 <?php
				 
				 // LOAD UP EDITOR
	if(isset($_GET['edit_email']) && $_GET['edit_email'] != -1 ){ $content = stripslashes($wlt_emails[$_GET['edit_email']]['message']); }else{ $content = ""; }
	
	echo wp_editor( $content, 'wlt_email', array( 'textarea_name' => 'wlt_email[message]') ); 
				 
				 ?>
                             
                
              </div> 


<hr />

<div class="clearfix"></div>
 
<div id="emailDefaultsDisplay" style="display:none;"></div>
<a class="btn btn-secondary float-right" href="javascript:void(0);" onclick="jQuery('#emailDefaultsDisplay').html(jQuery('#emailDefaults').html());jQuery('#emailDefaultsDisplay').toggle();"> 
<i class="fa fa-code" aria-hidden="true"></i> Show Email Tags</a>            
              
              
 <div class="clearfix"></div>
              
              
              
              
              
              
              
              
              <?php /*
<hr />
              
<div id="wlt_email_extras">
 
  <div class="accordion-group">
    <div class="accordion-heading">
      <a class="accordion-toggle collapsed" data-toggle="collapse" data-parent="#wlt_email_extras" href="#col1"> 
 
      Global Email Shortcodes    </a>
    </div>
    <div id="col1" class="accordion-body collapse" style="height: 0px;">
      <div class="accordion-inner">
    
      <p>These are email shortcodes that are available for all emails.</p>
              
              <div class="well" style="background: #fff;">
              <?php
			  
			  $btnArray = array(
			  
			  "link" 		=> "Website Link",
			  "blog_name" 	=> "Blog Name",
			  "date" 		=> "Date & Time",
			  "time" 		=> "Time",
			  "username" 	=> "Username",
			  "user_email" 	=> "User Email",
			  "user_registered" => "User Registered Date"
			  
			  );
			  foreach( $btnArray as $k => $b){
			   echo "<a href='javascript:void(0);' onclick=\"AddthisShortC('".$k."','wlt_email');\" class='btn' style='margin-right:10px; margin-bottom:5px;'>(".$k.")</a>";
			   }
			  
			  ?>
              </div>
              
        
    
     </div>
    </div>
  </div>
  
  
   <div class="accordion-group">
    <div class="accordion-heading">
      <a class="accordion-toggle collapsed" data-toggle="collapse" data-parent="#wlt_email_extras" href="#col3"> 
     
      Special Email Shortcodes  </a>
    </div>
    <div id="col3" class="accordion-body collapse" style="height: 0px;">
      <div class="accordion-inner">
    
      <p>These shortcodes are only available when a set email is sent such as the welcome email or the renewal email.</p>
      
      
<?php if(is_array($default_email_array)){ foreach($default_email_array as $key1=>$val1){ 


if(isset($val1["break"])){ }else{ 
	echo '<div class="well" style="background: #fff;"><span class="label '.$val1['label'].'">'.$val1['name']."</span> - ";
		if(is_array($val1['shortcodes'])){
			foreach( $val1['shortcodes'] as $k => $b){
			echo "<a href='javascript:void(0);' onclick=\"AddthisShortC('".$b."','wlt_email');\" class='btn' style='margin-right:10px; margin-bottom:5px;'>(".$b.")</a>";
			}
		}
	echo "</div>";
}} }
?>

 
    
     </div>
    </div>
  </div>
  
  
  
  <div class="accordion-group">
    <div class="accordion-heading">
      <a class="accordion-toggle collapsed" data-toggle="collapse" data-parent="#wlt_email_extras" href="#col2"> 
       
      Email Headers  </a>
    </div>
    <div id="col2" class="accordion-body collapse" style="height: 0px;">
      <div class="accordion-inner">
    
 <div class="form-row control-group row-fluid">
                <label class="control-label span3" for="normal-field"><b>Email From</b></label>
                <div class="controls span9">
                <div class="row-fluid">
                    <div class="span5">
                    <input type="text"  name="wlt_email[from_name]" class="row-fluid" value="<?php if(isset($_GET['edit_email'])){ echo $wlt_emails[$_GET['edit_email']]['from_name']; }?>" placeholder="Name">
                    </div>                
                    <div class="span5">
                    <input type="text"  name="wlt_email[from_email]" class="row-fluid" value="<?php if(isset($_GET['edit_email'])){ echo $wlt_emails[$_GET['edit_email']]['from_email']; }?>" placeholder="Email">
                    </div>
                </div> 
                   
                </div>
              </div> 
            
              
              
              <div class="form-row control-group row-fluid">
                <label class="control-label span3" for="normal-field"><b>BCC:</b></label>
                <div class="controls span9">
                <div class="row-fluid">
                    <div class="span5">
                    <input type="text"  name="wlt_email[bcc_name]" class="row-fluid" value="<?php if(isset($_GET['edit_email'])){ echo $wlt_emails[$_GET['edit_email']]['bcc_name']; }?>" placeholder="Your Name">
                    </div>                
                    <div class="span5">
                    <input type="text"  name="wlt_email[bcc_email]" class="row-fluid" value="<?php if(isset($_GET['edit_email'])){ echo $wlt_emails[$_GET['edit_email']]['bcc_email']; }?>" placeholder="Your Email">
                    </div>
                </div> 
                   
                </div>
              </div> 
    
     </div>
    </div>
  </div>     

<div class="clearfix"></div>
</div>
              
        
*/ ?>
              
              
           
<script>
function AddthisShortC(code, box){		   
	jQuery('#'+box).val(jQuery('#'+box).val()+'('+ code +')'); 
}
</script>            
              
</div><!-- end card block -->
</div><!-- end card -->    

<div class="text-center savebtn"> <button class="btn btn-lg btn-secondary">Save Changes</button> </div>    

</form>
<?php } ?>