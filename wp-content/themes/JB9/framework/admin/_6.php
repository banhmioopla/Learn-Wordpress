<?php
/* =============================================================================
   USER ACTIONS
   ========================================================================== */
// CHECK THE PAGE IS NOT BEING LOADED DIRECTLY
if (!defined('THEME_VERSION')) {	header('HTTP/1.0 403 Forbidden'); exit; }
// SETUP GLOBALS
global $wpdb, $CORE, $CORE_ADMIN;
if(!is_object($CORE_ADMIN)){
$CORE_ADMIN	 			= new wlt_admin;
}
// LOAD IN OPTIONS FOR ADVANCED SEARCH
wp_enqueue_script( 'jquery-ui-sortable' );
wp_enqueue_script( 'jquery-ui-draggable' );
wp_enqueue_script( 'jquery-ui-droppable' );
 

// LOAD IN MAIN DEFAULTS
if(function_exists('current_user_can') && current_user_can('administrator')){



 
 	// SAVE ORDER SETTINGS
	if(isset($_GET['dwid']) && is_numeric($_GET['dwid'] )){
	
		$wpdb->query("DELETE FROM ".$wpdb->prefix."core_withdrawal WHERE autoid='".$_GET['dwid']."' LIMIT 1");
		 
		$GLOBALS['error'] 		= 1;
		$GLOBALS['error_type'] 	= "ok"; //ok,warn,error,info
		$GLOBALS['error_message'] 	= "Widthdrawal Deleted Successfully";
		
	}
	
	if(isset($_POST['savewidthdrawal']) && strlen($_POST['savewidthdrawal']) > 1){
	 
	
		$SQL = "UPDATE `".$wpdb->prefix."core_withdrawal` SET 
			user_id='".$_POST['user_id']."',
			  	
		  	withdrawal_comments = '".esc_sql($_POST['comments'])."',
			withdrawal_status = '".$_POST['status']."',
			withdrawal_total = '".$_POST['amount']."'
			
			WHERE autoid='".$_POST['autoid']."' LIMIT 1";
		 
			$wpdb->query($SQL);
			
			// REMOVE CREDIT FROM USERS ACCOUNT
			if($_POST['oldstatus'] == 0 && $_POST['status'] == 1){			
			update_user_meta($_POST['user_id'],'wlt_usercredit', get_user_meta($_POST['user_id'],'wlt_usercredit',true)-$_POST['amount']);
			}
		 
			
		$GLOBALS['error'] 		= 1;
		$GLOBALS['error_type'] 	= "ok"; //ok,warn,error,info
		$GLOBALS['error_message'] 	= "Widthdrawal Data Updated";
		
	// SAVE ORDER SETTINGS
	}elseif(isset($_POST['saveorder']) && strlen($_POST['saveorder']) > 1){
	
	 
		$SQL = "UPDATE ".$wpdb->prefix."core_orders SET 
			user_id='".$_POST['order']['user_id']."',
			order_id='".$_POST['order']['order_id']."',
			order_data='".esc_sql($_POST['order']['order_data'])."',	
		  	order_status='".esc_sql($_POST['order']['order_status'])."',
		
			order_email = '".esc_sql($_POST['order']['order_email'])."',			
			shipping_label='".esc_sql($_POST['order']['shipping_label'])."',
			
			order_tax='".esc_sql($_POST['order']['order_tax'])."',
			order_shipping='".esc_sql($_POST['order']['order_shipping'])."',
			order_total='".esc_sql($_POST['order']['order_total'])."',
			
			payment_data='".esc_sql($_POST['order']['payment_data'])."'
			WHERE autoid='".$_POST['order']['autoid']."' LIMIT 1";
		 
			$wpdb->query($SQL);
			
		$GLOBALS['error'] 		= 1;
		$GLOBALS['error_type'] 	= "ok"; //ok,warn,error,info
		$GLOBALS['error_message'] 	= "Order Updated";
 	 
	}elseif(isset($_GET['doid']) && strlen($_GET['doid']) > 0){
  	 
		$wpdb->query("DELETE FROM ".$wpdb->prefix."core_orders WHERE autoid='".$_GET['doid']."' LIMIT 1");
		 
		$GLOBALS['error'] 		= 1;
		$GLOBALS['error_type'] 	= "ok"; //ok,warn,error,info
		$GLOBALS['error_message'] 	= "Order Deleted Successfully";
		 
	}
}

 
$core_admin_values = get_option("core_admin_values");
 
 
define('HIDE-SAVEFORM', true); 

// LOAD IN HEADER
if(is_object($CORE_ADMIN)){
echo $CORE_ADMIN->HEAD(1);
}

?>
 

        
 
<?php

if(isset($_GET['oid'])  ){ 
?> 
<div class="row"> 
   <div class="col-md-12">
      <div class="tab-content"><?php get_template_part('framework/admin/templates/admin', '6-orders-data' );  ?></div>
   </div>
</div><?php

}elseif(isset($_GET['wid'])  ){ 
?> 
<div class="row"> 
   <div class="col-md-12">
      <div class="tab-content"><?php get_template_part('framework/admin/templates/admin', '6-withdrawal-data' );  ?></div>
   </div>
</div><?php

}else{ 
?>
<style>
.inline { flex-direction: row !important; width:400px; }
.inline a { float:left; margin-right:10px; border-radius:0px !important; }
</style>

 
       
<?php get_template_part('framework/admin/templates/admin', '6-overview' ); ?> 
       
      
 
<?php

}

?>  
   
<?php // LOAD IN FOOTER

echo $CORE_ADMIN->FOOTER(1); ?>