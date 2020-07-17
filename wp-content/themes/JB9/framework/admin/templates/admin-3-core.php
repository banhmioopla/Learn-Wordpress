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

// GET CORE EMAILS
$wlt_emails = get_option("wlt_emails");  
 
		 
		 // update_option("wlt_emails","");
?>
<div class="card">
<div class="card-header">

<a href="#" rel="tooltip" data-original-title="Here you can create new emails for your website." data-placement="top" class="btn btn-help btn-sm float-right"><i class="fa fa fa-info" aria-hidden="true"></i></a>

   <a href="admin.php?page=3&edit_email=-1" class="btn btn-sm btn-primary float-right">Create New Email</a>
    

<span>
Emails
</span>
</div>
<div class="card-body1"> 


<?php if(is_array($wlt_emails) && count($wlt_emails) > 0 ){  ?>
            <table id="datatable_example" class="responsive table table-striped table-bordered" style="width:100%;margin-bottom:0; ">
            <thead>
            <tr>
              <th class="no_sort">Email Subject </th>
                            
              <th class="no_sort" style="width:110px;text-align:center;">Actions</th>
              
            </thead>
            <tbody>
            
            <script>
			
			function setemailcontent1(div){
			
				jQuery('.testmessage').val(jQuery('#'+div).val());
				tinyMCE.activeEditor.setContent(jQuery('#'+div).val());
			
			}
			function setemailsubject(div){
			
				jQuery('#esubject').val(jQuery('#'+div).val());
				
			
			}
			</script>
			
            
        <?php
 	  
		foreach($wlt_emails as $key=>$field){ ?>
		<tr>
         <td><?php echo stripslashes($field['subject']); ?></td>         
        
         <td class="ms" style="width:150px;">
         <center>
                 
                  
                  
                    <a class="btn btn-primary btn-sm" rel="tooltip" data-placement="top" 
                  data-original-title="Send Test Email"  data-toggle="modal" href="#TestEmailModal" onclick="setemailsubject('<?php echo "tsmail_".$key; ?>');setemailcontent1('<?php echo "temail_".$key; ?>')"
                  ><i class="fa fa-envelope"></i></a> 
                  
                  <span class="sep">|</span>
                  
                  <a class="btn btn-primary btn-sm" rel="tooltip" href="admin.php?page=3&edit_email=<?php echo $key; ?>" data-placement="top" data-original-title=" edit "><i class="fa fa-pencil"></i></a>
                                     
<span class="sep">|</span>



 

<form method="post" name="admin_email" id="admin_email" action="admin.php?page=3" class="pull-right" >
<input type="hidden" name="action" value="deleteemail" />
<input type="hidden" name="tab" value="email" />
<input type="hidden" name="page" value="3" />
<input type="hidden" name="emailid" value="<?php echo $key; ?>" />

<button class="btn btn-danger btn-sm confirm"><i class="fa fa-trash"></i></button>

</form>
                  
                  <textarea style="display:none;" id="temail_<?php echo $key; ?>"><?php echo stripslashes($field['message']); ?></textarea>
                  <textarea style="display:none;" id="tsmail_<?php echo $key; ?>"><?php echo stripslashes($field['subject']); ?></textarea>
                  
               
            </center>
            </td>
            </tr>
            <?php  }   ?> 
 
            </tbody>
            </table>

         <?php } ?>   
</div><!-- end card block -->
</div><!-- end card --> 
 