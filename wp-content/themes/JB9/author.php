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

if(!_ppt_checkfile("author.php")){

$GLOBALS['flag-author'] = 1;

$GLOBALS['flag-nobreadcrumbs'] = 1;

 
function _hook_head(){
?>
 <script src='https://www.google.com/recaptcha/api.js'></script>
<?php }
if(_ppt('comment_captcha') == 1){
add_action('wp_head','_hook_head');
}

global $CORE, $authorID;
 
// TURN ON/OFF DISPLAY 
if(_ppt('allow_profile') == 0){ 
	header("location: ".home_url());
	exit();
}

// RANDOM NUMBERS
$email_nr1 = rand("0", "9");$email_nr2 = rand("0", "9");

// GET USER INFO
$user_info = get_userdata($authorID); 
 		
// USER COUNTRY
$selected_country = get_user_meta($authorID,'country',true); 

// GET WEBSITE
$web = get_the_author_meta( 'url', $authorID); 

//SOCIAL MEDIA LINKS
$d0 =  _ppt(array('links','myaccount'))."/?u=".$authorID."&tab=msg&show=1";

$d1 = (get_user_meta( $authorID, 'url', true) == '') ? "javascript:void(0)" : get_user_meta( $authorID, 'url', true);
$d1_class = ($d1 == 'javascript:void(0)') ? "web disabled" : "web";
 
$d2 = (get_user_meta( $authorID, 'facebook', true) == '') ? "javascript:void(0)" : get_user_meta( $authorID, 'facebook', true);
$d2_class = ($d2 == 'javascript:void(0)') ? "facebook disabled" : "facebook";

$d3 = (get_user_meta( $authorID, 'twitter', true) == '') ? "javascript:void(0)" : get_user_meta( $authorID, 'twitter', true);
$d3_class = ($d3 == 'javascript:void(0)') ? "twitter disabled" : "twitter";

$d4 = (get_user_meta( $authorID, 'linkedin', true) == '') ? "javascript:void(0)" : get_user_meta( $authorID, 'linkedin', true);
$d4_class = ($d4 == 'javascript:void(0)') ? "linkedin disabled" : "linkedin";

$d5 = (get_user_meta( $authorID, 'skype', true) == '') ? "javascript:void(0)" : get_user_meta( $authorID, 'skype', true);
$d5_class = ($d5 == 'javascript:void(0)') ? "skype disabled" : "skype";


if(!isset($GLOBALS['flag-account']) && !$authorID){
	$login_link = wp_login_url( get_permalink($post->ID) );
	$d0 = $login_link;
	$d1 = $login_link;
	$d2 = $login_link;
	$d3 = $login_link;
	$d4 = $login_link;
	$d5 = $login_link;
}
 
// GET DESC
$desc = get_the_author_meta( 'description', $authorID); 

// BUILD DISPLAY NAME
$name = $CORE->user_display_name($authorID);


get_header($CORE->pageswitch()); ?>
 

<div class="user-header page-content-block bg-primary text-white">
   <div class="content-top page-content-title border-bottom">
      <div class="container">
         <div class="image">
            <?php echo get_avatar( $authorID, 180 ); ?>
         </div>
         <div class="user-details">
            <div class="row">
               <div class="col-sm-7">
                  <span class="username"><?php echo $CORE->user_display_name($authorID); ?></span> 
                  
                  <?php echo $CORE->user_verified($authorID, 1); ?>                  
                  <span class="mx-lg-1" style="opacity:0.5">&bull;</span>
      
      			  <?php if(_ppt('enable_memberships') == 1){ ?>
                  <span class="badge badge-success"><i class="fa fa-user mr-1"></i> <?php echo $CORE->user_membership_name($authorID); ?></span>                   
                  <span class="mx-lg-1" style="opacity:0.5">&bull;</span>
                   <?php } ?>
                   
                  <?php echo $CORE->user_online($authorID, 1); ?>
                  
                  <div class="mt-3 small">
                     <i class="fa fa-user-circle" aria-hidden="true"></i> <?php echo __("Joined","premiumpress") ?> <?php  echo hook_date($user_info->user_registered); ?>
                  </div>
                  
                  
                  <div class="ppt_socialicon mt-3">    
                     <a href="<?php echo $d0; ?>" class='msga' rel="nofollow"><i class='fa fa-envelope'></i></a>
                     <a href="<?php echo $d1; ?>" rel="nofollow" target="_blank" class="<?php echo $d1_class; ?>"><i class='fa fa-globe'></i></a>      
                     <a href="<?php echo $d2; ?>" rel="nofollow" target="_blank" class="<?php echo $d2_class; ?>"><i class='fab fa-facebook'></i></a>                      	
                     <a href="<?php echo $d3; ?>" rel="nofollow" target="_blank" class="<?php echo $d3_class; ?>"><i class='fab fa-twitter'></i></a>
                     <a href="<?php echo $d4; ?>" rel="nofollow" target="_blank" class="<?php echo $d4_class; ?>"><i class='fab fa-linkedin'></i></a>
                     <a href="<?php echo $d5; ?>" rel="nofollow" target="_blank" class="<?php echo $d5_class; ?>"><i class='fab fa-skype'></i></a> 
                  </div>
               </div>
               <div class="col-2"> </div>
               <div class="col-sm-3">        
               </div>
            </div>
         </div>
      </div>
   </div>					 
</div>
<div class="clearfix"></div>
<main id="main">
   <div class="container">
      <div class="row">
         <div class="col-lg-8 py-4">
         
         
         <div id="main-inner"> 
            
 <?php if(isset($_GET['ftyou'])){ ?>
<div class="alert alert-success">
		  <button type="button" class="close" data-dismiss="alert">x</button>
		  <?php echo __("Feedback Left, Thank You.","premiumpress") ?>
		</div>
<?php } ?>
            
            
         <div class="p-3">
            <h5 class=" mb-4 text-uppercase"><?php echo __("About Me","premiumpress") ?></h5>
            <div class="typography">
               <?php if(strlen($desc) > 1){ ?>
               <?php echo wpautop($desc); ?>
               <?php }else{ ?>         
               <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Praesent tempus eleifend risus ut congue. Pellentesque nec lacus elit. Pellentesque convallis nisi ac augue pharetra eu tristique neque consequat. Mauris ornare tempor nulla, vel sagittis diam convallis eget.</p>
               <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Praesent tempus eleifend risus ut congue. Pellentesque nec lacus elit. Pellentesque convallis nisi ac augue pharetra eu tristique neque consequat. Mauris ornare tempor nulla, vel sagittis diam convallis eget.</p>
               <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Praesent tempus eleifend risus ut congue. Pellentesque nec lacus elit. Pellentesque convallis nisi ac augue pharetra eu tristique neque consequat. Mauris ornare tempor nulla, vel sagittis diam convallis eget.</p>
               <?php }?>
               
               
          </div>
          
            
<?php if(in_array(THEME_KEY,array('at','ct','mj'))){ ?>
<div class="clearfix my-5">
    <ul class="nav nav-tabs clearfix" role="tablist">
       <li class="nav-item h5">
          <a class="nav-link active py-3" data-toggle="tab" href="#t1" role="tab"><?php echo __("Feedback Received","premiumpress") ?></a>
       </li>
       <li class="nav-item h5">
          <a class="nav-link py-3" data-toggle="tab" href="#t2" role="tab"><?php echo __("Feedback Left","premiumpress") ?></a>
       </li>
    </ul>
    <div class="tab-content p-3 pb-4 bg-white border single" style="margin-top: -1px;">
       <?php get_template_part( 'author', 'feedback' ); ?> 
    </div>
</div> 
<?php } ?>      
            </div>
            </div>
            
         </div>
         <!-- end col -->
         <div class="col-lg-4">
            <div class="contactbox with-box-shadow">
               <div class="contactbox-wrap">
                  <div class="contactbox-header clearfix text-uppercase bg-dark text-light font-weight-bold"> 
                     <?php echo __("Contact","premiumpress"); ?>
                  </div>
                  <div class="contactbox-booking-inner">
                  
                  <?php if(isset($GLOBALS['contactformsent'])){ ?>
                    <div class="alert alert-success">
                           <h4 class="alert-heading"><?php echo __("Message Sent","premiumpress") ?></h4>
                           <p><?php echo __("Your message has been sent to the listing owner. You should hear back from the listing onwer ASAP.","premiumpress") ?></p>
                        </div>
                  <?php }else{ ?>
                     <form role="form" method="post" action="" onsubmit="return CheckFormData();" class="fast-contact-wrapper" >
                        
                        <input type="hidden" name="code_value" value="<?php echo ($email_nr1+$email_nr2); ?>" />
                        <input type="hidden" name="action" value="contactform" />
                        <input type="hidden" name="pid" value="<?php echo $post->ID; ?>" />
                        
                        <?php if(isset($GLOBALS['error_message']) && $GLOBALS['error_type'] == "error"){ ?>
                        <div class="alert alert-info text-center mb-5">
                           <h4 class="alert-heading"><?php echo $GLOBALS['error_message']; ?></h4>
                        </div>
                        <?php } ?>
                        <div class="row">
                           <div class="col-xss-12 col-xs-6 col-sm-12 col-md-12">
                              <div class="form-group">
                                 <label><?php echo __("Your Name","premiumpress") ?> (<?php echo __("required","premiumpress") ?>)</label>
                                 <input type="text" class="form-control"  name="contact_n1" id="name" value="<?php if(isset($GLOBALS['error_message']) && $GLOBALS['error_type'] == "error"){ echo esc_html($_POST['contact_n1']); } ?>">
                              </div>
                           </div>
                           <div class="col-xss-12 col-xs-6 col-sm-12 col-md-12">
                              <div class="form-group">
                                 <label><?php echo __("Your Email","premiumpress") ?> (<?php echo __("required","premiumpress") ?>)</label>
                                 <input type="text" class="form-control" id="email1" name="contact_e1" value="<?php if(isset($GLOBALS['error_message']) && $GLOBALS['error_type'] == "error"){ echo esc_html($_POST['contact_e1']); } ?>">
                              </div>
                           </div>
                           <div class="col-xss-12 col-xs-6 col-sm-12 col-md-12">
                              <div class="form-group">
                                 <label><?php echo __("Your Phone","premiumpress") ?></label>
                                 <input type="text" class="form-control" id="phone" name="contact_p1" value="<?php if(isset($GLOBALS['error_message']) && $GLOBALS['error_type'] == "error"){ echo esc_html($_POST['contact_p1']); } ?>">
                              </div>
                           </div>
                           <div class="col-xss-12 col-xs-12 col-sm-12 col-md-12">
                              <div class="form-group">
                                 <label><?php echo __("Message","premiumpress") ?></label>
                                 <textarea name="contact_m1" class="form-control" id="message" rows="6"></textarea>
                              </div>
                           </div>
                           <div class="col-xss-12 col-xs-6 col-sm-12 col-md-12">
                           <?php if(_ppt('comment_captcha') == 1){ ?>
                              <div class="g-recaptcha my-3" data-sitekey="<?php echo stripslashes(_ppt('google_recap_sitekey')); ?>"></div>
                              <?php } ?>
                     
                    <div class="clearfix">
                     <input name="agreetc" type="checkbox" id="agreetc" class="float-left mr-2 mt-1" onchange="UpdateTCA()" />
                     <span class="small float-left" > <?php echo sprintf(__( "Agree to <a href=\"%s\">terms &amp; conditions.</a>", "premiumpress"), ""._ppt(array('links','terms'))."", ""  ); ?></span>
                    </div>
                     
                              <button type="submit" class="btn btn-primary btn-block mt-3" disabled id="btn-agreetc"> <i class="fa fa-envelope"></i> <?php echo __("Send Message","premiumpress") ?> </button>
                        </div>
                        
                     </form>
                     <?php } ?>
                     
                     <script>					 
					 function UpdateTCA(){					 
					 if(jQuery('#agreetc').is(':checked') ){                        	
                        jQuery('#btn-agreetc').removeAttr("disabled");
                        }else{
							jQuery('#btn-agreetc').attr("disabled", true);
                        	alert("<?php echo __("Please agree to the website terms and conditions.","premiumpress"); ?>");
                        	return false;
                        } 					 
					 }
					 </script>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>
</main>
 

<script language="javascript">
   function CheckFormData()
   {
   
   	
   	var name 	= document.getElementById("name"); 
   	var email1 	= document.getElementById("email1");
   	var code = document.getElementById("code");
   	var message = document.getElementById("message");	 
   				
   	if(name.value == '')
   	{
   		alert('<?php echo __("Please complete all required fields.","premiumpress") ?>');
   		name.focus();
   		name.style.border = 'thin solid red';
   		return false;
   	}
   	if(email1.value == '')
   	{
   		alert('<?php echo __("Please complete all required fields.","premiumpress") ?>');
   		email1.focus();
   		email1.style.border = 'thin solid red';
   		return false;
   	}
   
   	
   	if(message.value == '')
   	{
   		alert('<?php echo __("Please complete all required fields.","premiumpress") ?>');
   		message.focus();
   		message.style.border = 'thin solid red';
   		return false;
   	} 
   	
   
   	if(code.value == '')
   	{
   		alert('<?php echo __("Please complete all required fields.","premiumpress") ?>');
   		code.focus();
   		code.style.border = 'thin solid red';
   		return false;
   	} 			
   	
   	return true;
   }
   
   
</script>

<?php get_footer($CORE->pageswitch()); ?>

<?php } ?>