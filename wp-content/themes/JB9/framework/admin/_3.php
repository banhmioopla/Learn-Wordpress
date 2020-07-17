<?php
// CHECK THE PAGE IS NOT BEING LOADED DIRECTLY
if (!defined('THEME_VERSION')) {	header('HTTP/1.0 403 Forbidden'); exit; }
// SETUP GLOBALS
global $wpdb, $CORE, $userdata, $CORE_ADMIN;
// LOAD IN MAIN DEFAULTS 
$core_admin_values = get_option("core_admin_values");  

// DEFAULT CORE EMAILS
$default_email_array = $CORE->email_list();
 

// REMOVE REGISTRATION FIELD
if(!defined('WLT_DEMOMODE') && current_user_can('administrator')){

 
if(isset($_POST['action'])){
 
	switch($_POST['action']){
	
	
	case "clearemaillog": {
	
		$SQL = "DELETE * FROM ".$wpdb->prefix."core_log WHERE type='email'";
		$result = $wpdb->get_results($SQL); 
	
		$_POST['tab'] = "email";
		$GLOBALS['error_message'] = "Email Log Updated Successfully";
		
	} break;
 	
	
	
	case "newemail": {
			 
		// GET EXISTING FIELDS THEN ADD-ON THE NEW ONE
		$wlt_emails = get_option("wlt_emails");
		if(!is_array($wlt_emails)){ $wlt_emails = array(); }
		
		// ADD ONE NEW FIELD 
		if(!isset($_POST['eid'])){
				array_push($wlt_emails, $_POST['wlt_email']);		
				$GLOBALS['error_message'] = "Email Created Successfully";
		}else{
				$wlt_emails[$_POST['eid']] = $_POST['wlt_email'];		
				$GLOBALS['error_message'] = "Email Updated Successfully";
		}
		
		// SAVE ARRAY DATA		 
		update_option( "wlt_emails", $wlt_emails);
		 
	
	} break;	
	
	case "send-new-email": {
	 
		// CLEAN UP
		$subject = $_POST['subject'];
		$message = $_POST['message']; 	
		 
		if($_POST['senttogo'] == 1){
		
			// EMAILS
			$mailinglist = $wpdb->get_results("SELECT user_email AS email, display_name AS name FROM ".$wpdb->users.""); 
 
			if ( $mailinglist ) {
				foreach ( $mailinglist as $data ) {				 
					// VALIDATE
					if(strlen($data->email) > 5){					
						// SEND EMAIL
						$CORE->email_send($data->email, $subject, $message);				
					}// end if	
				}
			}
			
		}elseif($_POST['senttogo'] == 2){
			
			// TO EMAILS
			$to_emails = trim($_POST['to_emails']);
			$emails = explode(",",$to_emails);
						
			// EMAILS
			foreach($emails as $email){				
				// VALIDATE
				if(strlen($email) > 5){					
					// SEND EMAIL
					$CORE->email_send($email, $subject, $message);				
				}// end if						
			}// foreach	
		
		}	
		
		$GLOBALS['error_message'] = "Emails sent.";
	
	} break;
	
	case "testemail": {
 
		$CORE->email_send($_POST['test_email_data']['toemail'],$_POST['test_email_data']['subject'], $_POST['test_email_data']['message']);
		
		$GLOBALS['error_message'] = "Email sent.";
		
	} break;
	
	case "sendemail": {
	if(strlen($_POST['subject']) > 2){
		$mailinglist = $wpdb->get_results("SELECT * FROM ".$wpdb->prefix."core_mailinglist WHERE email_confirmed=1"); 
		if ( $mailinglist ) {
			foreach ( $mailinglist as $maild ) {
				if(strlen($maild->email) > 1){
				$CORE->email_send($maild->email,$_POST['subject'],$_POST['message']);
				}
			}
		}
		$GLOBALS['error_message'] = "Email sent.";
	}
	} break;
	

} 
 


}
}

$wlt_emails = get_option("wlt_emails");

// LOAD IN HEADER
echo $CORE_ADMIN->HEAD(1);   

?>






   	
        <?php get_template_part('framework/admin/templates/admin', '3-overview' ); ?>
       
     
        <?php if(isset($_GET['edit_email']) && is_numeric($_GET['edit_email']) ){  ?>
        <div class="padding">
           <h4>Add/Edit Email</h4>
           <?php get_template_part('framework/admin/templates/admin', '3-edit' );  ?>
        </div>
        <?php } ?>
         
 
  

<!-- THIS IS FOR THE ADD/EDIT EMAIL SECTION -->

<div id="emailDefaults" style="display:none">

<div class="well">
<p>Please switch to "text editing" for click-to-add on all shortcodes.</p>

<?php if(is_array($default_email_array)){ foreach($default_email_array as $key1=>$val1){ 


if(isset($val1["break"])){ }else{ 

if(isset($val1['label'])){
	echo '<div style="border-bottom:2px dashed #ddd; line-height:50px;"><span class="label '.$val1['label'].'">'.$val1['name']."</span> - ";
		if(is_array($val1['shortcodes'])){
			foreach( $val1['shortcodes'] as $k => $b){
			echo "<a href='#' onclick=\"AddthisShortC('".$b."','wlt_email');\" class='btn' style='margin-right:10px; margin-bottom:5px;'>(".$b.")</a>";
			}
		}
	echo "</div>";
	}
}} }
?>
    </div>
</div> 


<?php // LOAD IN FOOTER
echo $CORE_ADMIN->FOOTER(2); ?>