<?php
$core_gateways = array();
$core_gateways[1]['name'] 		= "Paypal Standard";
$core_gateways[1]['function'] 	= "gateway_paypal";
$core_gateways[1]['website'] 	= "http://www.paypal.com";
$core_gateways[1]['logo'] 		= "paypal.png";
$core_gateways[1]['callback'] 	= "yes";
 

$core_gateways[1]['fields'] 	= array(
'1' => array('name' => 'Gateway', 'type' => 'listbox', 'fieldname' => 'gateway_paypal','list' => array('yes'=>'Enable','no'=>'Disable')),
'2' => array('name' => 'Use Sandbox', 'type' => 'listbox', 'fieldname' => 'paypal_sandbox','list' => array('yes'=>'Yes (i am testing)','no'=>'No (my website is live)')),					 

'3' => array('name' => 'Paypal Email', 'type' => 'text', 'fieldname' => 'paypal_email'),
'4' => array('name' => 'Currency Code', 'type' => 'text', 'fieldname' => 'paypal_currency'),
'5' => array('name' => 'Display Name -or- Image URL', 'type' => 'text', 'fieldname' => 'gateway_paypal_name', 'default' => 'https://www.paypalobjects.com/webstatic/mktg/logo/AM_SbyPP_mc_vs_dc_ae.jpg') ,
'6' => array('name' => 'Recurring Payments', 'type' => 'listbox', 'fieldname' => 'paypal_recurring','list' => array('yes'=>'Yes (where possible)','no'=>'Disable')),					 
'7' => array('name' => 'Language', 'type' => 'text', 'fieldname' => 'paypal_language', 'default' => 'US'),

 

);
$core_gateways[1]['notes'] 	= "A list of country codes for paypal languages can be <a href='https://developer.paypal.com/webapps/developer/docs/classic/api/country_codes/' style='text-decoration:underline;'>found here.</a>";
$GLOBALS['core_gateways'] = $core_gateways;
// ---------------------------- GATEWAY FIELD CODE ------------------------







function MakePayButton($link){
	global $CORE;
	$STRING = '<button class="btn btn-primary btn-block font-weight-bold text-uppercase mt-3" style="cursor:pointer">'.__("Pay Now","premiumpress") .'</button>';
	return $STRING;
}

// ---------------------------- GATEWAY CODE ------------------------
function gateway_paypal($data=""){

	global $CORE, $wpdb;
 
 	$gatewaycode = "";	
	 
	// DECODE DATA
	$data = $CORE->order_decode($data['details']);	
 	
	// COUPON CODE
	/*
	if(isset($data->couponcode) && strlen($data->couponcode) > 1){	
		$discount = $CORE->coupon_amount($data->couponcode, $data->amount);
		if(is_numeric($discount)){		
			$data->amount = ( $data->amount - $discount );
		}	
	}*/
   	 
	if(!isset($GLOBALS['pformid'])){	$GLOBALS['pformid'] = 1; }else{ $GLOBALS['pformid']++; }
	
	if(get_option('paypal_sandbox') == "yes"){
	$gatewaycode .= '<form method="post" style="margin:0px !important;" action="https://www.sandbox.paypal.com/cgi-bin/webscr" name="checkout_paypal'.$GLOBALS['pformid'].'">';
	}else{
	$gatewaycode .= '<form method="post" style="margin:0px !important;" action="https://www.paypal.com/cgi-bin/webscr" name="checkout_paypal'.$GLOBALS['pformid'].'">';
	}	
 	// CALLBACK LINKS
	$gatewaycode .= '
	<input type="hidden" name="rm" value="2">
	<input type="hidden" name="lc" value="'.get_option('paypal_language').'">
	<input type="hidden" name="return" value="'._ppt(array('links','callback')).'?auth=1">
	<input type="hidden" name="cancel_return" value="'._ppt(array('links','callback')).'/?cancel=1">
	<input type="hidden" name="notify_url" value="'._ppt(array('links','callback')).'">';	
	
	if(isset($GLOBALS['shipping']) && is_numeric($GLOBALS['shipping']) && $GLOBALS['shipping'] > 0){		
		$gatewaycode .= '<input type="hidden" name="shipping_1" value="'.trim($GLOBALS['shipping']).'">';
	}
	if(isset($GLOBALS['tax']) && is_numeric($GLOBALS['tax']) && $GLOBALS['tax'] > 0){
		$gatewaycode .= '<input type="hidden" name="tax_cart" value="'.round(trim($GLOBALS['tax']),2).'">';
	}
	if(isset($GLOBALS['weight']) && ( $GLOBALS['weight'] != "" && $GLOBALS['weight'] != 0 ) ){
		$gatewaycode .= '<input type="hidden" name="weight_cart" value="'.trim($GLOBALS['weight']).'">';
	}
	if(isset($GLOBALS['discount']) && strlen($GLOBALS['discount']) > 0){
		$gatewaycode .= '<input type="hidden" name="discount_amount_cart" value="'.trim($GLOBALS['discount']).'">';
	}
	// CHECK IF WE ARE GOING TO BE USING THE PAYPAL CART OR SINGLE 
	// PAYMENT OPTIONS
	if(isset($GLOBALS['items']) && is_array($GLOBALS['items'])){
		// BUILD PAYPAL CART DATA
		$i=1; 
		foreach($GLOBALS['items'] as $key=>$inneritem){
			foreach($inneritem as $item){		
			
			$name = $item['name'];
			
			if(strlen($item['custom']) > 1){ $name .= "-".preg_replace("/\r\n|\r|\n/", "",$item['custom']); }	 
			$gatewaycode .='<input type="hidden" name="item_name_'.$i.'" value="'.trim(strip_tags($name)).'">
			<input type="hidden" name="amount_'.$i.'" value="'.trim($item['amount']).'">
			<input type="hidden" name="quantity_'.$i.'" value="'.$item['qty'].'">';
			$i++;
			}			
		}	
	
	$gatewaycode .= '<input type="hidden" name="upload" value="1">';
	$gatewaycode .= '<input type="hidden" name="cmd" value="_cart">';
	}else{
	 
if(isset($data->recurring) && $data->recurring == 1 && isset($data->recurring_days) && is_numeric($data->recurring_days) ){
 
 
		$gatewaycode .= '<input type="hidden" name="cmd" value="_xclick-subscriptions">
		<input type="hidden" name="a3" value="'.$data->amount.'">';

		if($data->recurring_days < 14){

			$gatewaycode .= '<input type="hidden" name="a3" value="'.$data->amount.'">		
			<input type="hidden" name="p3" value="'.$data->recurring_days.'">
			<input type="hidden" name="t3" value="D">
			<input type="hidden" name="src" value="1">
			<input type="hidden" name="sra" value="1">';

			}elseif($data->recurring_days < 30){

			$numweeks = $data->recurring_days/7;
			$gatewaycode .= '<input type="hidden" name="a3" value="'.$data->amount.'">
			<input type="hidden" name="p3" value="'.$numweeks.'">
			<input type="hidden" name="t3" value="W">
			<input type="hidden" name="src" value="1">
			<input type="hidden" name="sra" value="1">';

			}elseif($data->recurring_days < 370){

			$nummonths = $data->recurring_days/30;							 							  	
			$gatewaycode .= '<input type="hidden" name="a3" value="'.$data->amount.'">	
			<input type="hidden" name="p3" value="'.$nummonths.'">	
			<input type="hidden" name="t3" value="M">
			<input type="hidden" name="src" value="1">
			<input type="hidden" name="sra" value="1">';		
			}
		
	}else{
		$gatewaycode .= '<input type="hidden" name="cmd" value="_xclick">';
	}	 
	
	$gatewaycode .= '<input type="hidden" name="amount" value="'.$data->amount.'" id="paypalAmount">';
	$gatewaycode .= '<input type="hidden" name="item_name" value="'.strip_tags($data->description).'">';
	 
	}
	
 
	if(defined('WLT_CART') && isset($GLOBALS['flag-checkout']) ){
	 // SELLER PROTECTION
	/*$gatewaycode .= '
	<input type="hidden" name="first_name" value="">
	<input type="hidden" name="last_name" value="">
	<input type="hidden" name="email" value="">
	<input type="hidden" name="address1" value="">
	<input type="hidden" name="address2" value="">
	<input type="hidden" name="city" value="">
	<input type="hidden" name="country" value="">
	<input type="hidden" name="zip" value="">
	<input type="hidden" name="state" value="">
	<input type="hidden" name="address_override" value="1">';
	*/
	}
 	
	$gatewaycode .= '
	<input type="hidden" name="item_number" value="'.$GLOBALS['orderid'].'">
	<input type="hidden" name="business" value="'.get_option('paypal_email').'">
	<input type="hidden" name="currency_code" value="'.hook_price_currencycode(get_option('paypal_currency')).'">
	<input type="hidden" name="charset" value="utf-8">
	<input type="hidden" name="custom" value="'.$GLOBALS['orderid'].'" class="paymentcustomfield">
	<input type="hidden" name="bn" value="PREMIUMPRESSLIMITED_SP">
	'.MakePayButton('javascript:document.checkout_paypal'.$GLOBALS['pformid'].'.submit();').'</form>';

	return $gatewaycode;

}

/*
	this function processes a new order
	for all payment gateways
	
	returns ORDERID
	
*/
function core_generic_gateway_callback($orderid, $data){ global $wpdb, $CORE, $userdata; $order_data_description = "";
 
	// MUST HAVE AN ORDER ID
	if($orderid == ""){ return; }	
	  
	// BUILD DATA TO SAVE INTO THE DATABASE
	$savadata = array(	
	
	'user_id'		=> '',
	'order_id'		=> $orderid,
	'order_ip' 		=> $_SERVER['REMOTE_ADDR'],
	'order_date' 	=> date("Y-m-d"),
	'order_time' 	=> date("H:i:s"),
	'order_data' 	=> '',
	'order_items' 	=> '', // USED TO HOLD THE LISTING IDS OR CART SESSION ID
	'order_email' 	=> '',
	'order_shipping' => 0,
	'order_tax' 	=> 0,
	'order_total' 	=> 0,
	'order_status' 	=> 1, // PAID	
	'user_login_name' => '',
	'shipping_label' 	=> '', 	
	'order_description' => '', // SHORT ORDER DESCRIPTION
	'order_gatewayname' => '', // USED FOR THE GATEWAY NAME (PAYPAL ETC)	
	'payment_data' 	=> '',		
 	//'order_tokens' 	=> 0,
 	//'order_credit' 	=> 0,	
	);
	
	
	// CHECK FOR SUBSCRIPTIONS
	if(isset($data['recurring']) && $data['recurring'] == 1){
	$savadata['order_status'] = 8; // recurring status
	}
	
	  
	// SAVE ALL ORDER DATA FOR DEBUGGING
	$pstring = "";
	foreach($_POST as $k=>$v){ if(!is_array($k) && !is_array($v)){ $pstring .= $k.":".$v."\n"; } }		
	$data['paydata']		= $pstring;
	
	// FILL IN THE BLANKS FROM DATA PASSED VIA $orderdata	
	if(isset($data['amount']) && is_numeric($data['amount']) ){ $savadata['order_total'] =  $data['amount']; }
	if(isset($data['tax']) && is_numeric($data['tax']) ){ $savadata['order_tax'] =  $data['tax']; }
	if(isset($data['shipping']) && is_numeric($data['shipping']) ){ $savadata['order_shipping'] =  $data['shipping']; }
 
	if(isset($data['description']) && strlen($data['description']) > 1 ){ $savadata['order_description'] = $data['description']; }	
	if(isset($data['gateway_name']) ){  $savadata['order_gatewayname'] =  $data['gateway_name']; }
	
	if(isset($data['payment_data']) && strlen($data['payment_data']) > 1 ){  $savadata['payment_data'] = $data['payment_data']; }
	
	  
	// CHECK FOR USER SESSION
	if($userdata->ID){
	
		$savadata['user_id'] 			=  $userdata->ID;
		$savadata['user_login_name'] 	= $userdata->user_login; 
		
		if(isset($data['email'])){
		$savadata['order_email'] 		=  $data['email'];
		}
		
	}elseif ( substr($orderid ,0,4) == "SUBS" ){
	
		// GETKEY
		$ff = explode("-",$orderid);
		
		$user_info = get_userdata($ff[2]);
		
		$savadata['user_id']			= $ff[2];		
		$savadata['order_email'] 		= $user_info->user_email;		
		$savadata['user_login_name']	= get_the_author_meta('user_login', $ff[2]);	 	
	
	}elseif ( isset($data['email']) && strlen($data['email']) > 1 && email_exists($data['email']) ){
	 				
		$author_id = email_exists($data['email']);		
		$savadata['user_id']	= $author_id;		
		$savadata['order_email'] = $data['email'];		
		$savadata['user_login_name']	= get_the_author_meta('user_login', $author_id);	
	
	} elseif(isset($data['email']) && strlen($data['email']) > 1) {	
			
		$user_email = $data['email'];
		$user_name = explode("@",$user_email);
		$new_user_name = $user_name[0].date('d');
		$random_password = wp_generate_password( 12, false );
		$user_ID = wp_create_user( $new_user_name, $random_password, $user_email );			 
		// SEND USER PASSWORD
		wp_new_user_notification( $user_ID, $random_password );	
					
		$savadata['user_id'] 	= $user_ID;
		$savadata['order_email'] = $data['email'];
		$savadata['user_login_name'] 	= $new_user_name;	
				
	}else{
	
		$savadata['user_id'] 			= 1;
		$savadata['user_login_name'] 	= "Guest";
		
		if(isset($data['email']) && $data['email'] != ""  ){ $savadata['order_email'] =  $data['email']; }else{ $savadata['order_email'] = "no-email-recorded@noone.com"; }
		
	}
 	  
	// ADD NEW ORDER
	$orderadd = $CORE->ORDER('add',$savadata);
 
	// ADD TO ARRAY
	$savadata['ID'] =  $orderadd['orderid'];
 	$savadata['IDFORMATTED'] =  $CORE->order_get_orderid($orderadd['orderid']);	 
	 
	// HOOK FOR ALL MAIN THEME ACTIONS
	if($orderadd['type'] == "new"){
	 		$savadata = hook_v9_order_process( $savadata );	// KEEP THIS FOR CHILD THEME HOOKS	
	} 
	 
	// RETURN SAVE DATA
	return $savadata;
	

}

function core_paypal_callback($c){
	 
	global $wpdb, $CORE, $userdata;
 	 
	// CHECK WE HAVE RECIEVED DATA FROM PAYPAL
	
	if(isset($_GET['cancel'])){
	
	return "error";	
	
	}elseif(isset($_POST['custom'])  && ( isset($_POST['payment_status']) || isset( $_POST['txn_type'] ) ) ){
		
		// NOW WE CHECK THE STATUS
		$order_id = trim($_POST['custom']);
		
		if( isset($_POST['txn_type']) && ( $_POST['txn_type'] == "subscr_cancel" || $_POST['txn_type'] == "subscr_eot" ) ) { 
			
			$obits = explode("-",$order_id);
			update_post_meta($obits[1],'subscription','cancelled');
			
			// UPDATE ORDER STATUS
			$SQL = "UPDATE ".$wpdb->prefix."core_orders SET order_status='4' WHERE order_id='".$order_id."' LIMIT 1";		 
			$wpdb->query($SQL);
			
			
		}elseif ($_POST['payment_status'] == "Completed" || $_POST['payment_status'] =="Pending"){
					
			// BUILD ORDER DATA FROM PAYPAL CALLBACK DATA
			$order_desc = "";
			if(isset($_POST['item_name'])){		$order_desc .= $_POST['item_name'];	}
			if(isset($_POST['item_name1'])){	$order_desc .= $_POST['item_name1']; }
			if(isset($_POST['item_name_1'])){	$order_desc .= $_POST['item_name_1']; }	
				
			// INFORMATION ABOUT THE BUYER
			$first_name = isset($_POST['first_name']) ? $_POST['first_name'] : "";
			$last_name = isset($_POST['last_name']) ? $_POST['last_name'] : "";
	 
			$address_city 				= isset($_POST['address_city']) ? $_POST['address_city']: "";
			$address_country 			= isset($_POST['address_country']) ? $_POST['address_country']: "";
			$address_country_code 		= isset($_POST['address_country_code']) ? $_POST['address_country_code']: "";
			$address_name 				= isset($_POST['address_name']) ? $_POST['address_name'] : "";
			$address_state 				= isset($_POST['address_state']) ? $_POST['address_state'] : "";
			$address_status 			= isset($_POST['address_status']) ? $_POST['address_status'] : "";
			$address_street 			= isset($_POST['address_street']) ? $_POST['address_street'] : "";
			$address_zip 				= isset($_POST['address_zip']) ? $_POST['address_zip'] : "";	
			
			$tax 				= isset($_POST['tax']) ? $_POST['tax'] : "";
			$mc_shipping 		= isset($_POST['mc_shipping']) ? $_POST['mc_shipping'] : "";
			$mc_gross 			= isset($_POST['mc_gross']) ? $_POST['mc_gross'] : "";	 
			
		
			$data = core_generic_gateway_callback($order_id, 		
					array(
					
						"gateway_name" => "PayPal Payment",
						"amount" => $mc_gross,
						"tax" => $tax,
						"shipping" => $mc_shipping,					
						
						"email" =>  $_POST['payer_email'],
						'description' => $order_desc,
					) 
			);
			
			return $data;
	
		} elseif ( isset($_POST['txn_type']) &&  $_POST['txn_type'] == "subscr_payment"  ){
		 
			return "success"; 
						
		} elseif ( isset($_POST['payment_status']) && ($_POST['payment_status'] == 'Reversed') || ($_POST['payment_status'] == 'Refunded') ) {
							
			return "error";				
		}	
	
	}
  
	
	// ELSE RETURN EXISTING VALUE FROM OTHER GATEWAYS
	return $c;
	 
}


function core_token_callback($c){

	global $wpdb, $CORE, $userdata;
 
	 
	// CHECK WE HAVE RECIEVED DATA FROM PAYPAL
	if(isset($_POST['tokenpurchase'])  && is_numeric($_POST['tokenpurchase']) && $_POST['tokenpurchase'] > 0  ){
	  	
		$usercredit = get_user_meta($userdata->ID,'wlt_usertokens',true);
		if(isset($usercredit) && is_numeric($usercredit) && $usercredit >= $_POST['total']){ 
		
			update_user_meta($userdata->ID,'wlt_usertokens', get_user_meta($userdata->ID,'wlt_usertokens', true) - $_POST['total'] ); 
			
			$data = core_generic_gateway_callback($_POST['custom'], 		
				array(
				
					"gateway_name" => "Token Payment",
					"amount" => $_POST['total'],
					"email" =>  $userdata->user_email,
					'description' =>  $_POST['item_name'],
				) 
			);
				
			return $data;
		
		}else{ 	
			return "error";			
		}	
	}
		
	// ELSE RETURN EXISTING VALUE FROM OTHER GATEWAYS
	return $c;

}



function core_free_order_callback($c){ global $userdata;

 		 
		if(isset($c['free_payment_order']) && $c['amount'] == 0){		
		 
			 return core_generic_gateway_callback($c['custom'], 		
				array(
				
					"gateway_name" => "Free Order",
					"amount" => $c['amount'],
					"email" => $userdata->user_email,
					"description" => $c['description'],
				) 
			);	
					
		}elseif(isset($_POST['free_payment_order']) && $_POST['amount'] == 0){		
		 
			 return core_generic_gateway_callback($_POST['custom'], 		
				array(
				
					"gateway_name" => "Free Order",
					"amount" => $_POST['amount'],
					"email" => $userdata->user_email,
					"description" => $_POST['description'],
				) 
			);			
		}
		
	// ELSE RETURN EXISTING VALUE FROM OTHER GATEWAYS
	return $c;
}


function core_admin_test_callback($c){


 		if(isset($_POST['admin_test_callback'])){	
		 
		 	$data = core_generic_gateway_callback(
			
				$_POST['custom'], // <-- ORDER ID 		
				
				array(
				
					"gateway_name" => "Admin Test",
					"amount" => $_POST['amount'],
					"email" => get_option('admin_email'),
					"description" => $_POST['description'],
					"recurring" => $_POST['subscription'],
				)
				
			);
		 
			return $data;	
			
		}
		
	// ELSE RETURN EXISTING VALUE FROM OTHER GATEWAYS
	return $c;
}

function core_usercredit_callback($c){

	global $wpdb, $CORE, $userdata;
	
 	 
	// CHECK WE HAVE RECIEVED DATA FROM PAYPAL
	if(isset($_POST['credit_total'])  && is_numeric($_POST['credit_total']) && $_POST['credit_total'] > 0  ){ //&& $CORE->ORDEREXISTS($_POST['custom']) == false
		 
		$usercredit = get_user_meta($userdata->ID,'wlt_usercredit',true);
		if(isset($usercredit) && is_numeric($usercredit) && $usercredit >= $_POST['credit_total']){ 
			
			update_user_meta($userdata->ID,'wlt_usercredit', get_user_meta($userdata->ID,'wlt_usercredit',true) - $_POST['credit_total'] );
			
			// SUCCESS AND PASS IN DATA
			$data = core_generic_gateway_callback($_POST['custom'], array('description' =>  $_POST['item_name'], 'email' => $userdata->user_email, 'shipping' => '', 'shipping_label' => '', 'tax' => 0, 'amount' => $_POST['credit_total'] ) );
			 
			return $data;	
			
		}else{
		
		return "error";	
		
		}	
	}
	
	// ELSE RETURN EXISTING VALUE FROM OTHER GATEWAYS
	return $c;

}


?>