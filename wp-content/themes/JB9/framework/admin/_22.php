<?php
// CHECK THE PAGE IS NOT BEING LOADED DIRECTLY
if (!defined('THEME_VERSION')) {	header('HTTP/1.0 403 Forbidden'); exit; }
// SETUP GLOBALS
global $wpdb, $CORE, $userdata, $CORE_ADMIN;
// LOAD IN MAIN DEFAULTS 
$core_admin_values = get_option("core_admin_values");  

if(!defined('WLT_DEMOMODE') && current_user_can('administrator')){
	
	if(isset($_GET['delm']) && is_numeric($_GET['delm']) ){
	$wpdb->query("DELETE FROM ".$wpdb->prefix."core_mailinglist WHERE autoid = ('".$_GET['delm']."') LIMIT 1");
	$GLOBALS['error_message'] = "Mailing List Updated";
	
	}elseif(isset($_GET['delall']) && is_numeric($_GET['delall']) ){
	$wpdb->query("DELETE FROM ".$wpdb->prefix."core_mailinglist");
	$GLOBALS['error_message'] = "Mailing List Users Deleted";
	}

 
if(isset($_POST['action'])){
 
	switch($_POST['action']){
	
		case "sendemail": {
		 
		 
		 
		
		if(strlen($_POST['subject']) > 2){
			$mailinglist = $wpdb->get_results("SELECT * FROM ".$wpdb->prefix."core_mailinglist WHERE email_confirmed=1"); 
			if ( $mailinglist ) { 
			
				foreach ( $mailinglist as $maild ) {
					if(strlen($maild->email) > 1){
					
					
					// UNSUBSCRIBE
					$unsubscriptlink = get_home_url()."/confirm/unsubscribe/".$maild->email;
					$message = str_replace("(unsubscribe)",$unsubscriptlink,$_POST['message']);
	
					$CORE->email_send($maild->email,$_POST['subject'], $message);
					}
				}
			}			 
		}
		
		$GLOBALS['error_message'] = "Newsletter Sent";
		
		} break;
		
		
	 	case "importemails": {
 		 
			$emails = explode(PHP_EOL,$_POST['import_emails']);
		  
			if(is_array($emails)){
				foreach($emails as $email){			 
				 $bits = explode("[",$email);
				  
				 $fname = ""; 
				 $lname = "";
				 
				 if(isset($bits[1]) && strpos($bits[1], "]") !== false){
					$ib = explode(" ",$bits[1]);
					$fname = str_replace("]","",$ib[0]); 
					$lname = str_replace("]","",$ib[1]);
				 }		
				 	 
				// ADD DATABASE ENTRY
				if(strlen($bits[0]) > 2){
				
					$hash = md5(rand());
					$SQL = "INSERT INTO ".$wpdb->prefix."core_mailinglist (`email`, `email_hash`, `email_ip`, `email_date`, `email_firstname`, `email_lastname`, email_confirmed) 
					VALUES ('".strip_tags(trim($bits[0]))."', '".$hash."', '".$CORE->get_client_ip()."', now(), '".trim($fname)."', '".trim($lname)."','1');";			
					$wpdb->query($SQL);
					
					 $GLOBALS['error_message'] = "Mailing List Updated";
				
				}
					
				} // end foreach
			}// end if
			
			$GLOBALS['error_message'] = "Mailing List Updated";
		
		} break;
	 
	
	} // end switch
} 

}

// LOAD IN HEADER
echo $CORE_ADMIN->HEAD(1); ?>


<?php get_template_part('framework/admin/templates/admin', '22-overview' ); ?> 


<?php // LOAD IN FOOTER
echo $CORE_ADMIN->FOOTER(1); ?>