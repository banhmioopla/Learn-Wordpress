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

global $wpdb, $CORE;


// LOAD IN MAIN DEFAULTS 
$core_admin_values = get_option("core_admin_values");  

// EMAILS
$wlt_emails = get_option("wlt_emails");

// DEFAULT CORE EMAILS
$default_email_array = $CORE->email_list();
 
  
?>


 
<div class="row">

<div class="col-lg-8">

<div class="bg-white p-5 mt-5 shadow" style="border-radius: 7px;">


<div class="tabheader mb-4">
 
         <h4><span>Emails</span></h4>
      </div>



 


        <table class="table  table-striped1 table-bordered">
     
            <tbody>
            
        
<!------------ FIELD -------------->      
<?php if(is_array($default_email_array)){ $i=0; foreach($default_email_array as $key1=>$val1){ 


if(isset($val1["break"])){ ?>
 
              <tr style="    background:#efefef;">
                <th><?php echo $val1["break"]; ?></th>
                <th>&nbsp;</th>
              </tr>
           
<?php }else{ ?>
<tr><td>
<?php echo $val1['name']; ?>  

<?php if(isset($val1['desc'])){ ?><a href="javascript:void(0);" rel="tooltip" data-original-title="<?php echo $val1['desc']; ?>" data-placement="top" style="color:#888">
  <i class="fa fa-info-circle" aria-hidden="true"></i>
</a>
<?php } ?>

<br />  
<?php if(isset($core_admin_values['emails'][$key1]) && is_numeric($core_admin_values['emails'][$key1])){ ?>
<a style="font-size:11px;" href="admin.php?page=3&test_email=<?php echo $key1; ?>&emailid=<?php echo $core_admin_values['emails'][$key1]; ?>"><i class="gicon-plus-sign"></i> send test email</a>

/

<a href="admin.php?page=3&edit_email=<?php echo $core_admin_values['emails'][$key1]; ?>" style="font-size:11px;">edit this email</a>

<?php } ?>
</td>
<td>
<select data-placeholder="Choose a an email..." name="admin_values[emails][<?php echo $key1; ?>]" style="width:300px;" class="chzn-select">

	<?php 
	if(is_array($wlt_emails)){ 
		foreach($wlt_emails as $key=>$field){ 
			if(isset($core_admin_values['emails']) && isset($core_admin_values['emails'][$key1]) && $core_admin_values['emails'][$key1] == $key){	$sel = " selected=selected ";	}else{ $sel = ""; }
			echo "<option value='".$key."' ".$sel.">".stripslashes($field['subject'])."</option>"; 
		} 
	} 
	?> 
    
     <option value="" <?php if(!isset($core_admin_values['emails'][$key1]) || isset($core_admin_values['emails'][$key1]) &&  $core_admin_values['emails'][$key1] == ""){ echo " selected=selected "; } ?>>--- do not send --- </option>
</select>  
</td></tr>   


 
 
<?php } ?>

<?php $i++; } } ?>
</div>
 
<!------------ END FIELD -------------->  
 </tr> </tbody> </table>       
 
 </div></div>

<div class="col-lg-4">



        <div class="bg-white shadow mt-5" style="border-radius: 7px;">
        	
            <div class="p-5 text-center">
            
            <img src="<?php echo get_bloginfo('template_url')."/framework/admin/"; ?>images/icon3.png" class="img-fluid mb-4" />
            
        	<h5 class="mb-3">Language Setup</h5>
            
            <p style="font-size:16px;" class="text-muted">Learn how to setup pages in this quick video tutorial.</p>
            </div>
        
            <div class="btnbox bg-light text-center p-3 py-4" style="border-radius: 7px;">
            
            <a href="https://www.youtube.com/watch?v=G68QcvQ1U40" class="btn btn-dark">Watch Tutorial</a>
            
            </div>
        
        </div>


</div>


</div>