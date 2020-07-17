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

?>
<section class="p3 p-lg-5 bg-white ">


<div id="msgAjax"></div>
<form id="sendmsgform" name="sendmsgform" method="post" action="" class="well" style="display:none;" onsubmit="return CheckMsgFormData();">
   <input type="hidden" name="action" value="sendmsg" />
   <div class="form-group">
      <label class="font-weight-bold text-uppercase"><?php echo __("Username","premiumpress"); ?> <span id="ajaxMsgUser"></span> </label>
      <div class="input-group">
         <input class="form-control rounded-0" name="username" id="usernamefield" type="text"  value="<?php 
            if(isset($_GET['u'])){				  
             if(is_numeric($_GET['u'])){
            $muser = get_userdata($_GET['u'] );						 
            echo $muser->user_login;
             }else{
             echo strip_tags($_GET['u']);
             }
             } ?>">
      </div>
      <script>
         jQuery('#usernamefield').change(function() { 
         
             jQuery.ajax({
                 type: "POST",
                 url: '<?php echo home_url(); ?>/',		
         		data: {
                     action: "validateUsername",
         			name: jQuery('#usernamefield').val(), 
                 },
                 success: function(response) {
         		 
         			if(response == "yes"){
         			jQuery('#ajaxMsgUser').html('<span class="btn-success"><i class="fa fa-check-circle" aria-hidden="true"></i> <?php echo __("Valid","premiumpress"); ?></span>');
         			} else {
         			jQuery('#ajaxMsgUser').html('<span class="btn-danger"><i class="fa fa-close" aria-hidden="true"></i> <?php echo __("Invalid","premiumpress"); ?></span>');
         			}			
                 },
                 error: function(e) {
                     alert("error "+e)
                 }
             });
         
         });
      </script>
   </div>
   <div class="form-group">
      <label class="font-weight-bold text-uppercase"><?php echo __("Subject","premiumpress"); ?></label>
      <input type="text" name="subject" id="subjectfield" value="<?php if(isset($_POST['subject'])){ echo strip_tags(strip_tags($_POST['subject'])); } ?>" class="form-control rounded-0" >
   </div>
   <div class="form-group">
      <label class="font-weight-bold text-uppercase"><?php echo __("Message","premiumpress"); ?></label>
      <textarea id="sendMsgContent" rows="3" class="form-control rounded-0"  style="height:280px;" name="message"><?php if(isset($_POST['message'])){ echo strip_tags(strip_tags($_POST['message'])); } ?></textarea>               
   </div>
    <div class="clearfix">
                     <input name="agreetc" type="checkbox" id="agreetc" class="float-left mr-2 mt-1" onchange="UpdateTCA()" />
                     <span class="small float-left" > <?php echo sprintf(__( "Agree to <a href='%s'><u>terms &amp; conditions.</u></a>", "premiumpress"), ""._ppt(array('links','terms'))."", ""  ); ?></span>
                    </div>
     
   <div class="my-4">
      <button class="btn btn-primary" disabled id="btn-agreetc"><?php echo __("Send Message","premiumpress"); ?></button>
   </div>
<script>
   function CheckMsgFormData()
   { 
   	 
   	var user = document.getElementById("usernamefield");
   	var message = document.getElementById("sendMsgContent");	
    var subject = document.getElementById("subjectfield");	
   
   
   	if(user.value == '')
   	{
   		alert('<?php echo __("Please enter a valid username.","premiumpress") ?>');
   		user.focus();
   		user.style.border = 'thin solid red';
   		return false;
   	} 		
   
	
	  if(subject.value == '')
   	{
   		alert('<?php echo __("Please enter a subject.","premiumpress") ?>');
   		subject.focus();
   		subject.style.border = 'thin solid red';
   		return false;
   	} 
   		
   
   	if(message.value == '')
   	{
   		alert('<?php echo __("Please enter a valid message.","premiumpress") ?>');
   		message.focus();
   		message.style.border = 'thin solid red';
   		return false;
   	} 
   	return true;
   }
   
	 function UpdateTCA(){					 
					 if(jQuery('#agreetc').is(':checked') ){                        	
                        jQuery('#btn-agreetc').removeAttr("disabled");
                        }else{
							jQuery('#btn-agreetc').attr("disabled", true);
                        	alert('<?php echo __("Please agree to the website terms and conditions.","premiumpress"); ?>');
                        	return false;
                        } 					 
					 }
</script>
   
</form>
<form method="post" action="" id="messageDel" name="messageDel">
   <input type="hidden" name="action" value="deletemsg" />
   <input type="hidden" name="messageID" id="messageID" value="" />
</form>
<div  id="userinbox">
   <h5><?php echo __("My Messages","premiumpress"); ?></h5>
   <hr class="dashed mb-3" />
   <form method="post" action="">
      <input type="hidden" name="action" value="deletemsgs" />
      <table class="table table-bordered table-striped">
         <thead>
            <tr>
               <th></th>
               <th <?php if(!defined('IS_MOBILEVIEW')){ ?>style="width:80px;"<?php } ?>><?php echo __("Status","premiumpress"); ?></th>
                <th <?php if(!defined('IS_MOBILEVIEW')){ ?>style="min-width:100px;"<?php } ?>><?php echo __("From","premiumpress"); ?></th>
              
               <th <?php if(!defined('IS_MOBILEVIEW')){ ?>style="min-width:380px;"<?php } ?>><?php echo __("Subject","premiumpress"); ?></th>
               
            </tr>
         </thead>
         <tbody>
            <?php		
               $SQL = "SELECT * FROM ".$wpdb->prefix."posts 
               INNER JOIN ".$wpdb->prefix."postmeta AS mt1 ON (".$wpdb->prefix."posts.ID = mt1.post_id) 
               
               WHERE mt1.meta_key = 'username' AND mt1.meta_value = ('".$userdata->user_login."')
               
               AND ".$wpdb->prefix."posts.post_status = 'publish'	ORDER BY ".$wpdb->prefix."posts.post_date DESC"; 
               //INNER JOIN ".$wpdb->prefix."postmeta AS mt2 ON (".$wpdb->prefix."posts.ID = mt2.post_id) 	
               //AND mt2.meta_key = 'status' AND mt2.meta_value = 'unread'
               
               $posts = $wpdb->get_results($SQL);
               
               $tcount = 0; $STRING = "";
               foreach($posts as $post){ 
               
               // STATUS
               $status = get_post_meta($post->ID, "status", true);	
               if($status == "delete"){ continue; }
               
               //SETUP BOX COLOR
               if($status == "unread"){ $bc = "badge-success"; $txt = __("New","premiumpress"); }else{ $bc = "badge-default"; $txt =__("Read","premiumpress"); }
               
               // GET AUTHOR
               if($post->post_author == 0){
               $author = '';
               $user_info = "";
               }else{
               $user_info = get_userdata($post->post_author);
               $author = '<a href="'.get_author_posts_url($post->post_author, $user_info->display_nicename).'">'.$user_info->display_name.'</a>';		 
               }
               
               
               // NEW MEMBERSHIP FEATURE
               $msgLink = 'onclick="jQuery(\'#my'.$post->ID.'\').toggle();SetAsRead(\''.$post->ID.'\');" href="javascript:void(0);" style="text-decoration:underline;"';	
                                	 
               	// DOES THIS MEMBERSHIP ALLOW READ ACCESS?
				$canAccess = 1;
               	if(THEME_KEY == "da"){
				 
					global $CORE_DATING;
					if(!$CORE_DATING->checkMembershipAccess('access_messages')){				
					$msgLink = 'href="'._ppt(array('links','memberships')).'?noaccess=1"  style="text-decoration:underline;"';	
					$canAccess = 0;
					}
				}
               
               ?>
            <tr>
               <td><input class="checkbox1" type="checkbox" name="check[]" value="<?php echo $post->ID; ?>"></td>
               <td style="text-align:center"><span class="badge <?php echo  $bc; ?>"><?php echo $txt; ?></span></td>
               <td><?php echo $author; ?></td>
               
               <td>
                  <div class="row">
                     <div class="col-md-10 text-left">
                        <a <?php echo $msgLink; ?>><?php echo stripslashes($post->post_title); ?></a> 
                     </div>
                     <div class="col-md-2 text-right">
                        <a href="javascript:void(0);" onClick="document.getElementById('messageID').value='<?php echo $post->ID; ?>';messageDel.submit();" class="btn btn-sm btn-secondary">
                        <i class="fa fa-trash"></i>
                        </a>
                     </div>
                  </div>
                  
               </td>
              
            </tr>
            
            
             <?php if($canAccess){ ?>
             
            <tr id="my<?php echo $post->ID; ?>" style="display:none;">
               <td colspan=3  class="text-left shadow">
                  <div class="font-weight-bold"><?php echo stripslashes($post->post_title); ?></div>
                  
                  <em><i class="fa fa-clock-o"></i> <small><?php echo hook_date($post->post_date); ?></small></em>
				  <hr />
                  <div class="my-2">
                  
                  <?php echo wpautop(stripslashes($post->post_content)); ?>
                  
                  </div>
                  
                  <hr />
                  
                  <a class="btn btn-sm float-left btn-primary text-light" data-dismiss="modal" aria-hidden="true" onclick="jQuery('#userinbox').hide();jQuery('#sendmsgform').show();jQuery('#usernamefield').val('<?php echo $user_info->user_login; ?>');jQuery('#sendMsgContent').val(jQuery('#msg_content_<?php echo $post->ID; ?>').text());jQuery('#subjectfield').val('RE: <?php echo trim(strip_tags(addslashes($post->post_title))); ?>');"><?php echo __("Reply","premiumpress"); ?></a>
                  
                  <a href="javascript:void(0);" onClick="jQuery('#my<?php echo $post->ID; ?>').toggle();" class="btn btn-sm btn-secondary float-right">
                        <i class="fa fa-cross"></i> <?php echo __("Close","premiumpress"); ?>
                        </a> 
               </td>
            </tr>
            <?php } ?>
            
            <?php 
               $tcount++;	
               } // end foreach  
               
                 wp_reset_postdata();
                
               // EMPTY INBOX
               if($tcount == 0){ ?>
            <tr>
               <td colspan=4 style="text-align:center">
                  <div class="mt-3"><?php echo __("Inbox Empty","premiumpress"); ?></div>
                  <script> jQuery(document).ready(function() { jQuery('.selectionbox').hide(); }); </script>
               </td>
            </tr>
            <?php	
               }
                    
                  echo  $STRING;
               
               ?>
         </tbody>
      </table>
      <div class="selectionbox mt-3">
         <input type="checkbox" id="selecctall"/> <?php echo __("Select All","premiumpress"); ?>  <button type="submit" class="float-right btn btn-sm btn-secondary mr-2" ><?php echo __("Delete Selected","premiumpress"); ?></button>
      </div>
   </form>
   <script>
      jQuery(document).ready(function() {
	  
		  jQuery('#selecctall').click(function(event) {  //on click 
			if(this.checked) { // check select status
				jQuery('.checkbox1').each(function() { //loop through each checkbox
					this.checked = true;  //select all checkboxes with class "checkbox1"               
				});
			}else{
				jQuery('.checkbox1').each(function() { //loop through each checkbox
					this.checked = false; //deselect all checkboxes with class "checkbox1"                       
				});         
			}
		  });
      
      });
      
      function SetAsRead(t) {
      
      
      jQuery.ajax({
         type: "POST",
         url: '<?php echo home_url(); ?>/',		
      data: {
             action: "msg_changestatus",
      id: t,
      
         },
         success: function(response) {
      
      
      
         },
         error: function(e) {
             //alert("error "+e)
         }
      });
      
      }
      
      
   </script>
   <?php if(isset($_GET['u']) ){ ?>
            <script>
               jQuery(document).ready(function(){ 
               
			   setTimeout(function(){
				   SwitchPage('messages');
				   
				   jQuery('.nav-tabs a[href="#t3"]').tab('show');
				   jQuery('#sendmsgform').show(); 
				   jQuery('#userinbox').hide();
               }, 2000);
               
               });
            </script>
 <?php } ?> 
   <?php if(isset($_GET['msg']) ){ ?>
            <script>
               jQuery(document).ready(function(){ 
               
			   setTimeout(function(){
               SwitchPage('messages');
               
               jQuery('.nav-tabs a[href="#t3"]').tab('show');
               
			   },2000); 
				
               });
            </script>
 <?php } ?> 
   <hr class="dashed mt-3" />
   
   
   
            <!-- SAVE BUTTON -->
            <div class="row mt-4">
            <div class="col-md-5">
             <a <?php if(THEME_KEY == "da"){ global $CORE_DATING; } if(THEME_KEY == "da" && !$CORE_DATING->checkMembershipAccess('access_messages')){	 ?>
	  href="<?php echo _ppt(array('links','memberships')).'?noaccess=1'; ?>" 
      <?php  }else{ ?>
      href="#top" onclick="jQuery('#sendmsgform').show();jQuery('#userinbox').hide();"
      <?php } ?>  class="btn btn-primary rounded-0" ><?php echo __("New Message","premiumpress"); ?></a> 
            </div>
            <div class="col-md-3 "></div>
            <div class="col-md-4  text-sm-right">
             <a onclick="SwitchPage('dashboard');" href="javascript:void(0);" class="btn btn-outline-secondary rounded-0 btn-block mb-5">
			 <?php echo __("Dashboard","premiumpress"); ?> <i class="fa fa-angle-right" aria-hidden="true"></i>
             </a>
            </div>            
            </div>
            <!-- END SAVE BUTTON -->   
   
   
   
   
 
</div>
<!-- end user inbox -->

</section>