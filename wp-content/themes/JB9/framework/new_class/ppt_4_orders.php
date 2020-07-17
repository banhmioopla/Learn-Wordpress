<?php


class framework_orders extends framework_media {


function orders_get_type($orderid = ""){

$ordertypes = array(

	"LST" 			=> array("id" =>"LST",  "name" => "Listing",  "color" => "#0092ca"),
	"SUBS" 			=> array("id" =>"SUBS",  "name" => "Membership",  "color" => "#dc35c0"),
	"BAN" 			=> array("id" =>"BAN",  "name" => "Advertising",  "color" => "green"),
	"CREDIT" 		=> array("id" =>"CREDIT",  "name" => "User Credit",  "color" => "green"),
	"TOKEN" 		=> array("id" =>"TOKEN",  "name" => "Token",  "color" => "" ),
	"RENEW" 		=> array("id" =>"RENEW",  "name" => "Renewal",  "color" => "orange"),
	"INVOICE" 		=> array("id" =>"INVOICE",  "name" => "Invoice",  "color" => "green"),
	"POWERSELLER" 	=> array("id" =>"POWERSELLER",  "name" => "Powerseller",  "color" => "green"),
	"UPGRADE" 		=> array("id" =>"UPGRADE",  "name" => "Listing Upgrade",  "color" => "green"),	
	"CART" 			=> array("id" =>"CART",  "name" => "Cart",  "color" => "orange"),	
	"MJ" 			=> array("id" =>"MJ",  "name" => "Micro Jobs",  "color" => "orange"),
	"NA" 			=> array("id" =>"NA",  "name" => "Unknown",  "color" => "orange"),
	
);

	if($orderid == ""){
	
	return $ordertypes;
	
	}elseif(substr($orderid,0,2) == "MJ"){	
	
	$key = "MJ";	
	
	}elseif(substr($orderid,0,5) == "TOKEN"){	
	
	$key = "TOKEN";
	
	}elseif(substr($orderid,0,5) == "RENEW"){	
 
	$key = "RENEW";
	
	}elseif(substr($orderid,0,7) == "INVOICE"){
	
	$key = "INVOICE";
	
	}elseif(substr($orderid,0,11) == "POWERSELLER"){	
	
	$key = "POWERSELLER";
	
	}elseif(substr($orderid,0,3) == "BAN"){
	
	$key = "BAN";
	
	}elseif(substr($orderid,0,6) == "CREDIT"){
	
	$key = "CREDIT";
	
	}elseif(substr($orderid,0,7) == "UPGRADE"){
	
	$key = "UPGRADE";
	
	}elseif( substr($orderid ,0,4) == "SUBS"){
	
	$key = "SUBS";
	
	}elseif( substr($orderid ,0 ,3) == "LST"){
	
	$key = "LST";
	
	}elseif( substr($orderid ,0,4) == "CART"){	
	
	$key = "CART";
	
	}else{
	
	$key = "NA";
	
	} 
	
	return $ordertypes[$key]; 	

}

function order_get_status($id = ""){ global $CORE;

 
$order_status = array(
 
	0 => array(	
		"name" =>  __("Pending","premiumpress"), 
		"color" => "#e5e5e5",
	),
	
	1 => array(	// FOR OLDER SYSTEM
		"name" =>  __("Paid","premiumpress"), 
		"color" => "#87c8f7",
	),
	
	2 => array(	
		"name" =>  __("Failed","premiumpress"), 
		"color" => "#eca3a3",
	),
	
	3 => array(	
		"name" =>  __("Processing","premiumpress"), 
		"color" => "#c6e2c6",
	),
	
	4 => array(	
		"name" =>  __("Cancelled","premiumpress"), 
		"color" => "#e5e5e5",
	),
	
	5 => array(	
		"name" =>  __("Complete","premiumpress"), 
		"color" => "#87c8f7",
	),
	
	6 => array(	
		"name" =>  __("Refunded","premiumpress"), 
		"color" => "#e5e5e5",
	),
	
	7 => array(	
		"name" =>  __("On Hold","premiumpress"), 
		"color" => "#f8dea7",
	),

	8 => array(	
		"name" =>  __("Recurring","premiumpress"), 
		"color" => "#a688cf",
	),

);

if(is_numeric($id)){

return $order_status[$id];
}

return $order_status; 

}
 

function orders_cron_subscriptions(){ global $wpdb, $CORE;

// LOOP ALL MEMBERS WITH ACTIVE SUBSCRIPTIONS
$SQL = "SELECT * FROM ".$wpdb->usermeta." WHERE meta_key = 'wlt_subscription' ";
 
 
$result = $wpdb->get_results($SQL, ARRAY_A);
if(!empty($result)){

	foreach($result as $uu){
	
		if(is_array(unserialize($uu['meta_value']))){
		
			$data = unserialize($uu['meta_value']);			
			$ff = $this->date_timediff($data['date_expires'],'');
			
			if($ff['expired'] == 0){
			
				// GET THE SUBSCRIPTION AND ADD TO USERS ACCOUNT
				
				$sdata = $CORE->user_susbcription_get($data['key']);
			 
				if( isset($sdata['day_credit']) &&  is_numeric($sdata['day_credit']) && $sdata['day_credit'] > 0){					
						$c = get_user_meta($uu['user_id'],'wlt_usercredit', true);
						$c1  = $c + $sdata['day_credit'];
						update_user_meta($uu['user_id'],'wlt_usercredit', $c1);						
				}
						
				if( isset($sdata['day_tokens']) && is_numeric($sdata['day_tokens']) && $sdata['day_tokens'] > 0){
						$c = get_user_meta($uu['user_id'],'wlt_usertokens', true);
						$c1  = $c + $sdata['day_tokens'];
						update_user_meta($uu['user_id'],'wlt_usertokens', $c1);
				} 
			
			}else{
				
				// WHAT TODO IF EXPIRED
				// ??
				// ??
				// SEND EMAIL
			
			}
		
			}	
		}// end foreach
	
	} // end if

 
}
  
 
/*

This function creates the order ID for a new purchase

*/

function order_get_orderid($autoid = "", $oid = ""){ 
	
	return str_pad($autoid, 6, "0", STR_PAD_LEFT);
	
}
 

/*
	this is the main function for hook_price
	it will return a price formatted
	or use array to remove curreny code
*/
function price_format_display($data){  $curreny = true; $val = $data; $digs = "";
 
	// CHECK FOR ARRAY WITH CURRENY OFF
	if(is_array($data)){	 
		$val = $data[0];		
		if(isset($data[1])){
		$curreny = false;
		}else{
		$curreny = true;
		}
		
	}elseif(_ppt('currency_jquery') == '1'){
	return  "<label class='js_price m-0'>".$data."</label>";
	} 
	 
 	if( is_array(_ppt('currency')) ){	
		$seperator = "."; $sep = ","; $digs = 2; 
		
		// DECIMAL PLACES
		
		if(is_numeric(_ppt( array('currency','dec') ) ) ){
		$digs = _ppt(array('currency','dec'));
		}
		 
		
		// FORMAT NUMBER
		if(is_numeric($val)){		
		$val = number_format($val,$digs, $seperator, $sep); 
		}
		
		$val = hook_price_filter($val);
		
		// RETURN IF EMPTY
		if($val == ""){ return $val; }
		
		// LEFT/RIGHT POSITION
		if($curreny){
			if(_ppt( array('currency','position') ) == "right"){ 
				if(substr($val,-3) == ".00"){ $val = substr($val,0,-3); }
				$val = $val.hook_currency_symbol('');
			}else{				
				$val = hook_currency_symbol('').$val;
			}
		}	
	}

	// CHOP OF THE END TO MAKE IT LOOK NICER
	if($digs == 2 && substr($val,-3) == ".00"){ 
	
	$val = str_replace(",000","xxx",$val);
	
		if($digs == 2 && substr($val,-3) == ".00"){
		$val = substr($val,0,-3); 
		}
	 $val = str_replace("xxx",",000",$val);
	
	}

// RETURN
return $val;
}	

/*
	this function will get the exchange rate for
	tokens and credit
*/
function credit_exchangerate($amount, $type){

	if($type == "credit"){
	
		$rate = _ppt('credit_exchange');
		if($rate == "" || !is_numeric($rate) ){ $rate = 1; }
		
		return $amount * $rate;
	
	}else{
	
		$rate = _ppt('token_exchange');
		if($rate == "" || !is_numeric($rate) ){ $rate = 1; }
		
		return round($amount * $rate);	
	
	}

}


function order_encode($order_id){
 
return base64_encode(json_encode($order_id));

}

function order_decode($order_id){
 
return json_decode(base64_decode($order_id));

}


/*
	this function checks to see
	if an order is already within the daatabase
*/
function order_exists($orderID){ global $wpdb;

	$ores = $wpdb->get_results("SELECT count(*) as total FROM ".$wpdb->prefix."core_orders WHERE order_id LIKE ('%".strip_tags($orderID)."%')");
	if($ores[0]->total == 0){	
		return false;
	}else{
		return true;
	}	
}

/*
	this function checks to see
	if an order is already within the daatabase
*/
function order_total($orderID){ global $wpdb;

	$ores = $wpdb->get_results("SELECT order_total AS total FROM ".$wpdb->prefix."core_orders WHERE order_id LIKE ('%".strip_tags($orderID)."%')");
	
	if(!isset($ores[0])){
		return false;
	}elseif($ores[0]->total == 0){	
		return false;
	}else{
		return $ores[0]->total;
	}	
} 

function ORDER_STATUS($id){ global $CORE;
 
if(is_numeric($id)){
	switch($id){
	case "1": { $id = __("Paid","premiumpress"); } break;
	case "2": { $id = __("Refunded","premiumpress"); } break;
	case "3": { $id = __("Incomplete","premiumpress"); } break;
	case "4": { $id = __("Failed","premiumpress"); } break;
	case "5": { $id = __("Paid &amp; Complete","premiumpress"); } break;
	}
}
return hook_order_status($id);

}

function ORDER($action='add', $order_data){

global $userdata, $wpdb, $CORE;
 
	switch($action){
	
		case "add": {
		 
		// CLEAN THE ORDER DATA
		foreach($order_data as $key=>$val){			 
		$oData[$key] =  esc_sql($val);				 
		}// end foreach
	 	 
		// CHECK IF THIS ORDER ID ALREADY EXISTS
		 
		$ores = $wpdb->get_results("SELECT count(*) as total, autoid FROM ".$wpdb->prefix."core_orders WHERE order_id = ('".$oData["order_id"]."')");
 
		if($ores[0]->total == 0){	 
		
			// END SQL	
			$SQL ="INSERT INTO `".$wpdb->prefix."core_orders` (`user_id`, `order_id`, `order_ip`, `order_date`, `order_time`, `order_data`, `order_items`, `order_email`, order_shipping, order_tax, `order_total`, `order_status`, `user_login_name`, shipping_label, payment_data, order_description, order_gatewayname) VALUES ('".$oData["user_id"]."', '".$oData["order_id"]."', '".$oData["order_ip"]."', '".$oData["order_date"]."', '".$oData["order_time"]."', '".$oData["order_data"]."', '".$oData["order_items"]."', '".$oData["order_email"]."', '".$oData["order_shipping"]."', '".$oData["order_tax"]."', '".$oData["order_total"]."', '".$oData["order_status"]."', '".$oData["user_login_name"]."', '".$oData["shipping_label"]."', '".$oData["payment_data"]."', '".$oData["order_description"]."', '".$oData["order_gatewayname"]."')";			 
		 
			// SAVE DATA
			$wpdb->query($SQL); 
			
			// GET ID 
			$NEWDBID = $wpdb->insert_id; //<-- MUST BE AFTER INSERT otherwise the ID will change
			
			 
			// ADD LOG			 
			$CORE->ADDLOG("New Order Added", $oData["user_id"] , $oData["order_data"], $NEWDBID, "order", $oData["order_total"] );	
		 	
			// GET THE AUTOID FOR ORDER ID
			return array("orderid" => $NEWDBID, "type" => "new");
		
		}else{
		
			return array("orderid" => $ores[0]->autoid, "type" => "old");
		}
	 
		} break ; // end add
		
	} // end switch

}



function ORDERTOTAL($userid){ global $wpdb;

	$ores = $wpdb->get_results("SELECT count(*) as total FROM ".$wpdb->prefix."core_orders WHERE user_id = ('".strip_tags($userid)."')");
 
	if($ores[0]->total == 0){	
		return 0;
	}else{
		return $ores[0]->total;
	}	
}

 
	/* 
	
		This function displays the payment options
		available to the user
	*/
	
	function payment_via_tokens($orderID, $amount, $description){ global $userdata, $post, $CORE;
 		
		
		
		// GET MY TOKENS
		$myTokens = 0;
		if($userdata->ID){		
		
			$myTokens = get_user_meta($userdata->ID, 'wlt_usertokens', true);
					
		}else{
		
			$text = '<i class="fa fa-user icon-big-left" aria-hidden="true"></i>'.__("Please login to make payment using Tokens.","premiumpress");
		}
		
		if($myTokens < $amount){
		
			$text = '<li class="list-group-item"><i class="fa fa-5x mr-3 mb-4 fa-close icon-big-left float-left"></i>'.__("You do not have enough tokens to complete this purchase. Please purchase more tokens from within your account area.","premiumpress")."</li>";
		
		}else{
	 
	
			$text = ' <li class="list-group-item"><div class="container">
				
							<div class="row"> <div class="col-md-7 title">
								
								<b>'.__("User Token Payment","premiumpress").'</b><br> <small>'.__("Your current balance is","premiumpress").' '.$myTokens.' '.__("tokens","premiumpress").'</small>
								
							
							</div>
							
							<div class="col-md-4 paybutton">
							
							<form method="post"  action="'._ppt(array('links','callback')).'" name="checkout_usertokens" class="mt-3">
							<input type="hidden" name="total" value="'.$amount.'" />
							<input type="hidden" name="custom" value="'.$orderID.'" class="paymentcustomfield">		
							 <input type="hidden" name="tokenpurchase" value="1" /> 
							 <input type="hidden" name="item_name" value="'.strip_tags($description).'">	
							<button class="btn btn-primary btn-block text-uppercase font-weight-bold" type="submit">'.__("Pay Now","premiumpress") .'</button>
							</form>
							
							</div>
							
							</div>
							</li>';
		}	
		
		ob_start();
		?>
        <div class="mb-4"><div class="box-grey-wrap">
        <?php echo $text; ?>
        </div></div>
        <?php
		$STRING = ob_get_clean(); 
			   
		return $STRING;
	
	}
	
/* =============================================================================
PAYMENT SETUP FOR PROCESSING ORDERS
========================================================================== */


function coupon_amount($code, $total){

if(_ppt('couponcodes') == 1 && strlen($code) > 1 ){
		 
			// COUPON CODES 
			$wlt_coupons = get_option("wlt_coupons");
			// CHECK WE HAVE SUCH A CODE
			if(is_array($wlt_coupons) && count($wlt_coupons) > 0 ){
				foreach($wlt_coupons as $key=>$field){
					if($code == $field['code']){	
					
							// WORK OUT DISCOUNT AMOUNT
							$discount = $field['discount_percentage'];
							if($discount != ""){
								return $total/100*$discount;
							}else{
								return $field['discount_fixed']; 
							}
					
					}
				}
			}			
			  
		}
		
		return 0;

}

	function payment_setup($data, $smallform = 0){ global $CORE, $userdata; $STRING = "";
	  
	  	// SMALL FORM COL WIDTHS
		if($smallform == 1){ $col1 = 'col-12'; $col2 = "col-12"; }else{ $col1 = 'col-md-7';  $col2 = "col-md-4";  }		
	 	 
		// DECODE DATA
		$data = $CORE->order_decode($data);
	 	   
		// MAKE SURE HERE IS AN ORDER ID
		if(!isset($data->order_id)){
		die("no payment data");
		}	 	
		
		 
		// CHECK FOR TOKEN PAYMENT
		if(isset($data->tokens) && is_numeric($data->tokens) && $data->tokens > 0){				
			$STRING .= $this->payment_via_tokens($data->order_id, $data->tokens , $data->description);	
		} 
		 
		// HOOK INTO THE PAYMENT GATEWAY ARRAY 
		$gatway = hook_payments_gateways($GLOBALS['core_gateways']);
		
		
		$data->amount = str_replace(",",".",$data->amount);
		
		$GLOBALS['orderid'] 	= $data->order_id;	
		$GLOBALS['total'] 		= $data->amount;
		$GLOBALS['description'] = $data->description;
		$GLOBALS['subtotal'] 	= 0;
		$GLOBALS['shipping'] 	= 0;
		$GLOBALS['tax'] 		= 0;
		$GLOBALS['weight'] 		= 0; 
		$GLOBALS['discount'] 	= 0;
		$GLOBALS['items'] 		= "";		
		 
		 
		//if(!is_numeric($data->amount)){ $data->amount = 0; }
		if($data->amount < 0){ $data->amount = 0; } 
		
		
		if(_ppt('couponcodes') == 1 && isset($data->couponcode) && strlen($data->couponcode) > 1 ){
		 
			// COUPON CODES 
			$wlt_coupons = get_option("wlt_coupons");
			// CHECK WE HAVE SUCH A CODE
			if(is_array($wlt_coupons) && count($wlt_coupons) > 0 ){
				foreach($wlt_coupons as $key=>$field){
					if($data->couponcode == $field['code']){	
					
							// WORK OUT DISCOUNT AMOUNT
							$discount = $field['discount_percentage'];
							if($discount != ""){
								$GLOBALS['CODECODES_DISCOUNT'] = $GLOBALS['total']/100*$discount;
							}else{
								$GLOBALS['CODECODES_DISCOUNT'] = $field['discount_fixed']; 
							}
					
					}
				}
			}
			
			if(isset($GLOBALS['CODECODES_DISCOUNT']) && $GLOBALS['CODECODES_DISCOUNT'] > 0){
				$GLOBALS['total'] =  $GLOBALS['total'] - $GLOBALS['CODECODES_DISCOUNT'];
			}
			
			$STRING .= ' <script>jQuery("#ppdiscountlist").show();jQuery("#ppdiscount").html("'.hook_price($GLOBALS['CODECODES_DISCOUNT']).'");jQuery("#ppprice").html("'.hook_price($GLOBALS['total']).'");</script>';
			 
		}		
		
		
		
		
		$STRING .= '<ul class="list-group">';	
		
		 
		
		// MAKE SURE PACKAGES ARE ENABLED, OTHERWISE WE CANNOT GET THE PAYMENT DATA	
		if(is_array($gatway) && isset($data->amount) && is_numeric($data->amount) && $data->amount > 0 ){
		 
		 // LOOP AND DISPLAY GATEWAYS
			foreach($gatway as $Value){
			 
				// GATEWAY IS ENABLED 		 
				if(get_option($Value['function']) == "yes" ){
				
					// TEXT ONLY
					 if( !isset($Value['ownform']) ){
					
					   $rannum = rand();
					   
					   $STRING .= '<li class="list-group-item py-lg-4"><div class="container">
				
							<div class="row">
							
							 
								<div class="'.$col1.' name">';
								
								if(strpos(get_option($Value['function'].'_name'), "http") === false){
								
									$STRING .= '<strong>'.get_option($Value['function'].'_name').'</strong>';
									
									if(strlen(get_option($Value['function']."_desc")) > 2){									
									$STRING .= '<div class="small">'.get_option($Value['function']."_desc").'</div>';									
									} 
									
								}else{
								
									$STRING .= '<img src="'.get_option($Value['function']."_name").'" alt="payment" class="img-fluid">';
									
								}
								
								
								 
								
								$STRING .= '</div>
							
							<div class="'.$col2.' paybutton">
							
							'.str_replace("gateway_","gateway_".$rannum."_",$Value['function']($_POST)).'
							
							</div> 
							
							
						</div> 
							 
							
							</div></li>';	   
					   
					// NORMAL FORMS	
					}else{	
									
						$STRING .= '<li class="list-group-item">'.$Value['function']($_POST).'<div class="clearfix"></div></li>';	
											
					}// END IF
					
				}// end if			
			
			
			} // end foreach		
		
		} // end gateway loop
		 
		
		
		
	// ADD ON PAYMENT BY USER CREDIT
	if($userdata->ID){
	$usercredit = get_user_meta($userdata->ID,'wlt_usercredit',true);
	}
	
	if(isset($usercredit) && isset($data->amount) && is_numeric($data->amount) && $data->amount > 0 && $usercredit >= $data->amount ){
			
		 	
				if(!isset($GLOBALS['uccount'])){ $GLOBALS['uccount'] = 1; }else{ $GLOBALS['uccount']++; }
				
				
				$STRING .= '<li class="list-group-item py-lg-4"><div class="container">
							<div class="row">
						   <div class="'.$col1.' name"><strong>'.__("User Credit Payment","premiumpress").'</strong><br> <div class="small">'.__("Your current balance is","premiumpress").' '.hook_price($usercredit).'</div></div>
						   <div class="'.$col2.' paybutton">
						   
						   <form method="post"  action="'._ppt(array('links','callback')).'" name="checkout_usercredit'.$GLOBALS['uccount'].'">
							<input type="hidden" name="credit_total" id="credit_total" value="'.$GLOBALS['total'].'" />
							<input type="hidden" name="custom" value="'.$GLOBALS['orderid'].'" class="paymentcustomfield">		
							<input type="hidden" name="item_name" value="'.strip_tags($GLOBALS['description']).'">			 
							 
							<button class="btn btn-primary btn-block font-weight-bold text-uppercase" type="submit">'.__("Pay Now","premiumpress") .'</button>
							
							</form>
			
						   </div>
						   </div>
						  
						   <div class="clearfix"></div>  </div></li>'; 
		}
			 
			
			
		// ADD ON FOR ADMIN TESTING
		if( defined('WLT_DEMOMODE') || ( isset($data->test) || user_can($userdata->ID, 'administrator') ) ){ // && isset($data->amount) && is_numeric($data->amount) && $data->amount > 0
		
		
		 $STRING .= '<li class="list-group-item py-lg-4"><div class="container">
				
							<div class="row">
							 	
								<div class="'.$col1.' name">
								
								<strong>Payment System Test</strong>
								
								<div class="small">Use this to test the callback function on this website.</div>
								
								</div>
							
							<div class="'.$col2.' paybutton">
							
							<form method="post" action="'._ppt(array('links','callback')).'" style="display:inline">
							<input type="hidden" name="admin_test_callback" value="1" />';
							
if(isset($data->recurring) && $data->recurring == 1 && isset($data->recurring_days) && is_numeric($data->recurring_days) ){
$STRING .= '<input type="hidden" name="subscription" value="1" />';
}else{
 $STRING .= '<input type="hidden" name="subscription" value="0" />';
}
							
						$STRING .= '<input type="hidden" name="amount" value="'.$GLOBALS['total'].'" id="admin_test_total" />
							<input type="hidden" name="custom" value="'.$GLOBALS['orderid'].'" class="paymentcustomfield" />							
							<input type="hidden" name="description" value="'.strip_tags($GLOBALS['description']).'"  />
							
							<button class="btn btn-primary btn-block font-weight-bold text-uppercase" style="cursor:pointer">'.__("Pay Now","premiumpress") .'</button>
							 
						 
							</form>
							
							</div> 
							
							
						</div> 
							 
							
							</div></li>';  
		
		
			 				
			}
			
			// HANDLE FREE PAYMENTS
	 
			
		// ADD ON FOR ADMIN TESTING
	 	 
		if( ( isset($data->amount) && is_numeric($data->amount) && $data->amount == 0 )  ){ // || ( isset($data->tokens) && $data->tokens == 0 ) 
		
		 	
				$STRING .= '<li class="list-group-item">
				<div class="container">
				<div class="row">
				<div class="'.$col1.' title font-weight-bold">
								'.__("No Payment Required","premiumpress") .'
				</div>
				<div class="'.$col2.' paybutton">
				
					<form method="post" action="'._ppt(array('links','callback')).'">
							
							<input type="hidden" name="free_payment_order" value="1" />
							
							<input type="hidden" name="amount" value="0"  />
							<input type="hidden" name="custom" value="'.$GLOBALS['orderid'].'" class="paymentcustomfield" />							
							 <input type="hidden" name="description" value="'.strip_tags($GLOBALS['description']).'" class="paymentcustomfield" />
							 
							<button class="btn btn-primary btn-block font-weight-bold text-uppercase" type="submit">'.__("Complete Order","premiumpress") .'</button>
					</form>
				</div>								
				</div>
				</div>	   
				</li>'; 				
			}
		 
		// COUPON ADD-ONS FOR DISCOUNTS
		if(_ppt('couponcodes') == 1 && isset($data->amount) && is_numeric($data->amount) && $data->amount > 0 && !isset($data->nocoupons)  ){
		
	  
		ob_start();
		?>
        <li class="list-group-item">
				<div class="container">
				<div class="row">
				<div class="col-md-7 title">
				<a href="javascript:void(0);" onclick="jQuery('#couponcodeform').toggle();" class="small"><?php echo __("Have a coupon code? ","premiumpress"); ?></a>
				</div>
				<div class="col-md-4">
				
					<form method="post" action="#" id="couponcodeform" style="display:none;" onsubmit="ajax_apply_coupon(this); return false;"><input type="hidden" name="coupon_orderid" value="<?php echo $data->order_id; ?>" /><input type="text" name="couponcode" id="couponcode" class="form-control form-control-sm" placeholder="<?php echo __("Enter coupon here.. ","premiumpress"); ?>"><button class="btn btn-primary btn-sm" type="submit"><?php echo __("Apply Coupon","premiumpress"); ?></button></form>            
                    
<script>
function ajax_apply_coupon(acode){
  
       jQuery.ajax({
           type: "POST",
           url: '<?php echo home_url(); ?>/',
		   dataType: 'json',		
   		data: {
            action: 	"check_couponcode",
			code: 		acode.couponcode.value,		
			<?php if(isset($data->old_amount) && is_numeric($data->old_amount)){ ?>
			amount: 	"<?php echo $data->old_amount; ?>",
			<?php }else{ ?>
			amount: 	"<?php echo $data->amount; ?>",
			<?php } ?>
			orderid: 	"<?php echo $GLOBALS['orderid']; ?>",
			desc: 		"<?php echo strip_tags($GLOBALS['description']); ?>",
			<?php if(isset($data->recurring) && is_numeric($data->recurring) && isset($data->recurring_days) && is_numeric($data->recurring_days) ){ ?>
			recurring:  <?php echo $data->recurring; ?>,
			recurring_days: <?php echo $data->recurring_days; ?>,
			<?php } ?>
        },
        success: function(response) {
		  
				if(response == 0){
				
					alert("<?php echo __("Invalid Coupon Code","premiumpress"); ?>");
					return false;
				
				}else{
				
				console.log(response);
				
					jQuery.ajax({
					   type: "POST",
					   url: '<?php echo home_url(); ?>/',					   	
					data: {
						action: "load_new_payment_form",
						details: response.code,
					   },
					   success: function(r) { 
			 			
						alert("<?php echo __("Coupon Applied","premiumpress"); ?>");
					  
						jQuery('#ajax_payment_form').html(r); 
							
						jQuery('#ppprice').html(response.total);
						jQuery('#pprice').html(response.total);
						jQuery('.ppprice').html(response.total);
						
												
						return false;
						
					   },
					   error: function(e) {
						   alert("error "+e);
						   return false;
					   }
				   }); 
				   
				   return false;
				
				}
			   			
           },
           error: function(e) {
               alert("error "+e);
			   return false;
           }
       });

}
</script></div></div></div></li><?php 
		$STRING .= ob_get_clean();
		
		}
		
		
		$STRING .= '</ul>';
		
		// RETURN GATEWAY INFORMATION
		return $STRING;
	}
	

	/*
	THIS IS THE OLD PAYMENT SETUP
	*/
	function PAYMENTS($amount, $orderID, $description, $postid, $subscription = true, $showccredit = true  ){ global $userdata, $post, $CORE; $STRING ="";  $packagefields = get_option("packagefields");
	
		
	} 
 


/* =============================================================================
CURRENY OPTIONS
========================================================================== */

	/*
		this function will return the 
		active currency code
	*/
	function _currency_get_code($c = array()){	
	
		// CHECK IF NOT TURNED OFF 	
		if(_ppt('currency_menu') != '1'){ return _ppt(array('currency','code')); }

	
		if(isset($_SESSION['currency']) && isset($_SESSION['currency']['code']) && $_SESSION['currency']['code'] != ""){
			return $_SESSION['currency']['code'];
		}else{
			
			$default = _ppt(array('curreny','symbol') );					 
			if($default == ""){ 
			
			$core_data = get_option("core_admin_values");
			$default = $core_data['currency']['symbol']; 
			
			}
		
			return $default;
		}
	}
	
	/*
		this function will get the active
		currency symbol
	*/
	function _currency_get_symbol($c){
	
		// CHECK IF NOT TURNED OFF 	
		if(_ppt('currency_menu') != '1'){ return _ppt(array('currency','symbol'));; }

	
		if(!is_admin() && isset($_SESSION['currency']) && isset($_SESSION['currency']['symbol'])){
		
			return $_SESSION['currency']['symbol'];
			
		}else{
			
			$default = _ppt( array('currency','symbol') );
 	 
			if($default == ""){ $default = "$"; }
		
			return $default;
		}
	}		
	/*
		this function sets up the currency with rates etc
	*/
	function _currency_setup($p = 0){	
	
	
		
		 $GLOBALS['shop_currency']	= array();
		 if(!isset($GLOBALS['CORE_THEME']['currency'])){ return; }
		 if(!isset($GLOBALS['CORE_THEME']['cc'])){ return; }
		 
		 if(!isset($GLOBALS['CORE_THEME']['currency']['code'])){ $GLOBALS['CORE_THEME']['currency']['code'] = "USD"; }
	 
		 // CREATE DEFAULT VALUE	
		 $GLOBALS['shop_currency'][$GLOBALS['CORE_THEME']['currency']['code']] 	= array(
			"code" => $GLOBALS['CORE_THEME']['currency']['code'], 
			"rate" => 1, 
			"symbol"=> hook_currency_symbol(''), 
			"link"	=> "c=".$GLOBALS['CORE_THEME']['currency']['code']
			);
		
		 $i=1; 
		 while($i < 6){ 
		
			if($GLOBALS['CORE_THEME']['cc']['symbol'.$i] == ""){ $i++; continue; }
			
			$GLOBALS['shop_currency'][$GLOBALS['CORE_THEME']['cc']['code'.$i]] 	= array(
			"code" => $GLOBALS['CORE_THEME']['cc']['code'.$i], 
			"rate" => $GLOBALS['CORE_THEME']['cc']['rate'.$i], 
			"symbol"=> $GLOBALS['CORE_THEME']['cc']['symbol'.$i] , 
			"link"=> "c=".$GLOBALS['CORE_THEME']['cc']['code'.$i]
			);
		
		 $i++; 
		 }
	
		if(isset($_REQUEST['c']) && isset($GLOBALS['shop_currency'][$_REQUEST['c']])){ 
			
			$_SESSION['currency'] 	= $GLOBALS['shop_currency'][$_REQUEST['c']];
		
		}
 
	
	}


	// THIS FUNCTION WILL HANDLE ALL OF THE CURRENCY CONVERSIONS ETC
	function _currency($p = 0){	
 
	// CHECK IF NOT TURNED OFF 	
	if(_ppt('currency_menu') != '1'){ return $p; }
  
	if(isset($_REQUEST['c']) && isset($GLOBALS['shop_currency'][$_REQUEST['c']])){ 
			
		$_SESSION['currency'] 	= $GLOBALS['shop_currency'][$_REQUEST['c']];
	 
	}elseif(isset($_SESSION['currency']['rate']) && $_SESSION['currency']['rate'] > 0  ){ 
	
	 	// DO NOTHING	
								 
	}elseif(isset($GLOBALS['shop_currency']) && isset($GLOBALS['currency']['code']) ){
	
		$_SESSION['currency'] 	= $GLOBALS['shop_currency'][$GLOBALS['currency']['code']];
	}
 

	// CALCULATE NEW PRICE	
	if(isset($_SESSION['currency']) && isset($_SESSION['currency']['rate']) && $_SESSION['currency']['rate'] > 0 ){	
		
		// STRIP TAGS FROM PRICE JUST ENCASE
		$p = strip_tags($p); 
		
			// 
			if($_SESSION['currency']['code'] == $GLOBALS['CORE_THEME']['currency']['code']){
			
			$thisrate = 1;		
			
			}else{
			
			$thisrate = $_SESSION['currency']['rate'];
			
			}
		 
		if($p > 0){ 
			$p = str_replace(",","",$p);
			$p = ($p/$thisrate); // get the rate against the default curreny	
			$p = round($p,2); 
			
			$seperator = "."; $sep = ","; $digs = 2; 
			if(is_numeric($p)){		
			$p = number_format($p,$digs, $seperator, $sep); 
			}
		} // end if
		
	} // end if
	
	// RESET DISPLAY CURRENCY
	if(isset($_SESSION['currency']['symbol'])){
	$_SESSION['currency']['symbol'] = 	hook_currency_symbol('');
	}
 
	return $p;
	}

 	
 
 
	function _curreny_dropdown_menu($crumb = false){ global $post, $CORE, $wpdb; $STRING = "";
 	
	//if(isset($GLOBALS['CURRENYISSET'])){ return; }
	//$GLOBALS['CURRENYISSET'] = 1;
	
	// DISABLE IF REQUESTED
	//if(_ppt('currency_menu') != '1'){ return; }
	
	// MAKE SURE ITS SET
	if(!isset($GLOBALS['shop_currency']) || (isset($GLOBALS['shop_currency']) && empty($GLOBALS['shop_currency']) ) ){ return; }
 	
		// SETUP DEFAULTS
		if(!isset($_SESSION['currency']['code']) || (isset($_SESSION['currency']['code']) && $_SESSION['currency']['code'] == "" ) ){ 
		
			$_SESSION['currency']['code'] 	= $GLOBALS['CORE_THEME']['currency']['code']; 
			$_SESSION['currency']['symbol'] = hook_currency_symbol('');  
			$_SESSION['currency']['rate'] = 0; 		
	 
		} 
		
		
		$cimg = "";
		if(isset($_REQUEST['c'])){
		
			$cimg = '('.$GLOBALS['shop_currency'][$_REQUEST['c']]['symbol'].')';
			
			 
			$STRING .= '[xx] '.$GLOBALS['shop_currency'][$_REQUEST['c']]['code'].'';	
			
		}elseif(isset($_SESSION['currency'])){
		
			$cimg = '('.$_SESSION['currency']['symbol'].')';
		 
			$STRING .= '[xx] '.$_SESSION['currency']['code'].'  ';
		
		} 
		 
		
		$STRING = str_replace("[xx]",$cimg, $STRING);
		
		ob_start();	
		
		 
		?>
        
<div class="btn-group currencylist">  
 
  <a href="#" data-toggle="dropdown" role="button" aria-expanded="false"> 
  
  <?php echo $STRING; ?> </a> 
 
  <div class="dropdown-menu">
  
 <?php if(is_array($GLOBALS['shop_currency'])){  foreach($GLOBALS['shop_currency'] as $v){
		
			if($GLOBALS['shop_currency'][$v['code']]['rate'] == ""){ continue; }
			
			// DETERMINE IF WE NEED TO ADD A SLASH OR A QUESTION
			$pageLink = $CORE->curPageURL();
			if(substr($pageLink,-1) == "/"){
			$pageLink .= "?";
			}else{
			$pageLink .= "&";
			}
			
			
			?> 
            
            <a href="<?php echo $pageLink.$v['link']; ?>" class="dropdown-item">
             
                
                 (<?php echo $v['symbol']; ?>)  <?php echo $v['code']; ?>
             
             </a>
         
            
            <?php
		}  
		?>



  </div>
</div>
        
        
        
 
		<?php
		
		}
			
		return ob_get_clean();
	}
	

  
  
  
/* =============================================================================
ORDER PROCESSING
========================================================================== */

  
/*
	this function handles differeny changes
	based on the order ID prefix
*/

function _hook_v9_order_process($data){ global $wpdb, $CORE, $userdata;


	if(isset($data['order_id'])){
 	 
		// TOKEN PAYMENT
		if(substr($data['order_id'],0,5) == "TOKEN"){
		 
			// BREAK DOWN ID
			$ob = explode("-",$data['order_id']);	
		 	 
			// ADD ON TOKENS
			if( is_numeric($ob[1]) && $ob[1] > 0){	
			 
						$c = get_user_meta($data['user_id'],'wlt_usertokens', true);
						$c1  = $c + $CORE->credit_exchangerate($data['order_total'], "token");
						update_user_meta($data['user_id'],'wlt_usertokens', $c1);
			}
			
		
		
		}elseif(substr($data['order_id'],0,5) == "RENEW"){	
		
		 	// BREAK DOWN ID
			$ob = explode("-",$data['order_id']);
			
			if( is_numeric($ob[1]) && $ob[1] > 0){
			
				$POSTID = $ob[1];
				
				$pak = get_post_meta($POSTID,'packageID',true);
				
				// GET LISTING TIME AND ADD TIME
				$tnow = get_post_meta($POSTID, 'listing_expiry_date', true);	
				if($tnow == ""){ $tnow = date("Y-m-d H:i:s"); }
				
				$newdate = date("Y-m-d H:i:s", strtotime( $tnow . " +"._ppt('pak'.$pak.'_duration')." days"));
				 
				update_post_meta($POSTID, 'listing_expiry_date', $newdate );
				 
			
			}
		
		}elseif(substr($data['order_id'],0,7) == "INVOICE"){	
			
			// BREAK DOWN ID
			$ob = explode("-",$data['order_id']); 
		 	 
			if( is_numeric($ob[2]) && $ob[2] > 0){
			
			update_post_meta($ob[2],'payment_complete', date('Y-m-d H:i:s') );
			update_post_meta($ob[2],'invoice_status', 5);
			
			
			}
		
		// POWERSELLER ADDON
		}elseif(substr($data['order_id'],0,11) == "POWERSELLER"){	
		
			// BREAK DOWN ID
			//$ob = explode("-",$data['order_id']);	
		 	update_user_meta($data['user_id'],'wlt_powerseller', 1);
			
			// VERIFIED USER
			$SQL = "SELECT DISTINCT ID
			   FROM ".$wpdb->prefix."posts
			   WHERE ".$wpdb->prefix."posts.post_status = 'publish' 
			   AND ".$wpdb->prefix."posts.post_type = 'listing_type'
			   AND ".$wpdb->prefix."posts.post_author = '".$data['user_id']."' ORDER BY ".$wpdb->prefix."posts.post_date DESC LIMIT 30"; 		
			$results = $wpdb->get_results($SQL); 				 				 
			if(!empty($results) ){		 
				foreach ($results as $val){	
				update_post_meta($val->ID,'powerseller',1);					 
				}
			 }
 	 
		// CHECK IF THIS IS A SELLSPACE PAYMENT
		}elseif(substr($data['order_id'],0,3) == "BAN"){
		
			// BREAK DOWN ID
			$ob = explode("-",$data['order_id']);
			
			// CREATE A NEW CAMPAIGN
			$my_post = array();
			$my_post['post_title'] 		= $data['order_id'];
			$my_post['post_content'] 	= "";
			$my_post['post_excerpt'] 	= "";
			$my_post['post_status'] 	= "publish";
			$my_post['post_type'] 		= "wlt_campaign";
			$my_post['post_author'] 	= $userdata->ID;
			$POSTID 					= wp_insert_post( $my_post );
			
			// GET BANNER DETAILS
			$sellspacedata = _ppt('sellspace'); 
			
			add_post_meta($POSTID, 'impressions', '0');	
			add_post_meta($POSTID, 'clicks', '0'); 
			add_post_meta($POSTID, 'bannerid', '0'); 
			add_post_meta($POSTID, 'campaign', $ob[1]);
			add_post_meta($POSTID, 'listing_expiry_date', date("Y-m-d H:i:s", strtotime( date("Y-m-d H:i:s") . " +".$sellspacedata[$ob[1]."_days"]." days")) );
	 
 
		}elseif(substr($data['order_id'],0,6) == "CREDIT"){
		
			// BREAK DOWN ID
			$ob = explode("-",$data['order_id']);
			
			// ADD ON CREDIT
			if( is_numeric($ob[1]) && $ob[1] > 0){					
						$c = get_user_meta($data['user_id'],'wlt_usercredit', true);
						$c1  = $c + $CORE->credit_exchangerate($data['order_total'], "credit");
						update_user_meta($data['user_id'],'wlt_usercredit', $c1);						
			}
		
		
		// LISTING UPGRADES
		}elseif(substr($data['order_id'],0,7) == "UPGRADE"){
			
			// BREAK DOWN ID
			$ob = explode("-",$data['order_id']);
 				
			// GET THE ENHANCEMENT DATA
			$cenhancement = get_option("cenhancement"); 
	 
			if(is_array($cenhancement) && isset( $cenhancement['name'][$ob[2]] ) ){ 			
				update_post_meta($ob[1], $cenhancement['key'][$ob[2]], "yes" );
			}
		
		// SUBSCRIPTION PAYMENT
		}elseif( substr($data['order_id'] ,0,4) == "SUBS"){
	 
			// GETKEY
			$ff = explode("-",$data['order_id']);
			 
			// GET THE CREDITS AND TOKENS FOR THIS
			// SUBSCRIPTION AND UPDATE THE USERS ACCOUNT
			   
			$csubscriptions = get_option("csubscriptions"); 
			 
			$days = 30;
			$listings = 0;
			$flistings = 0;
			if(is_array($csubscriptions) && !empty($csubscriptions) ){ $i=0; 
	 
				foreach($csubscriptions['name'] as $xxx){ 
				
					if(isset($SET)){ continue; }
				
					if($csubscriptions['key'][$i] == $ff[1]){
					
						$SET = 1;
					
						$tokens = 0;
						$credit = 0;
						$days 	= $csubscriptions['days'][$i];
						 
					 
						if(isset($csubscriptions['credit'][$i]) && is_numeric($csubscriptions['credit'][$i]) && $csubscriptions['credit'][$i] > 0){					
							$c = get_user_meta($data['user_id'],'wlt_usercredit', true);
							if(!is_numeric($c)){ $c = 0; }	
							$c1  = $c + $csubscriptions['credit'][$i];
							update_user_meta($data['user_id'],'wlt_usercredit', $c1);						
						}
						
						if(isset($csubscriptions['tokens'][$i]) && is_numeric($csubscriptions['tokens'][$i]) && $csubscriptions['tokens'][$i] > 0){
							$c = get_user_meta($data['user_id'],'wlt_usertokens', true);
							if(!is_numeric($c)){ $c = 0; }							
							$c1  = $c + $csubscriptions['tokens'][$i];
							update_user_meta($data['user_id'],'wlt_usertokens', $c1);
						}
					
					}
					$i++;				
				}
			}// end if has subscription	 
			 	
			 
			// CHECK FOR EXISTING SUBSCRIPTION
			$f = get_user_meta($data['user_id'], 'wlt_subscription',true);	
					
			if(is_array($f) && !empty($f) ){
			
				// ADD ON EXTRA TIME			
				$da = $this->date_timediff($f['date_expires'],'');				 
				if($da['expired'] == 0){
					$days += $da['date_array']['days']+($da['date_array']['months']*30);
				}
				
			}
			
		 	
			// 0 = UNLIMITED BUT WE SET A LONG EXPIRY DATE
			if($days == 0){
			$dd = date("Y-m-d H:i:s", strtotime( date("Y-m-d H:i:s") . " +10 years"));			
			}else{
			$dd =  date("Y-m-d H:i:s", strtotime( date("Y-m-d H:i:s") . " + ".$days." days"));
			}
			
			
			// SAVE THE SUBSCRIPTION TO THE USERS ACCOUNT
			update_user_meta($data['user_id'],'wlt_subscription', 
				array(
					"key" => $ff[1] , 
					"date_start" => date("Y-m-d-H:i:s"), 
					"date_expires" => $dd,					
				)
			);
		 		 
		
		}elseif( substr($data['order_id'] ,0 ,3) == "LST"){
		
		
		
			// BREAK DOWN ID
			$ob = explode("-",$data['order_id']);
		 	 
			// DELETE FIELD
			delete_post_meta($ob[1],'total_price_due');
			
			// SET DATE FLAG
			update_post_meta($ob[1],'paid_date',date("Y-m-d-H:i:s"));
			update_post_meta($ob[1],'paid_invoiceid', $data['ID'] );
			
			
			
			 
		}elseif( substr($data['order_id'] ,0,4) == "CART"){		
		
			// BREAK DOWN ID
			$ob = explode("-",$data['order_id']);		
   
			// UPDATE ORDERS TABLE AND SET THE ORDER_ITEMS TO THE CART ID
			$wpdb->get_results("UPDATE ".$wpdb->prefix."core_orders SET order_items = '".$ob['1']."' WHERE order_id = ('".$data["order_id"]."')");	
 			
			// NOW GET CART DATA
			$SQL = "SELECT * FROM ".$wpdb->prefix."core_sessions WHERE session_key = ('".strip_tags($ob[1])."') LIMIT 1";
			$hassession = $wpdb->get_results($SQL, OBJECT);
		
			if(!empty($hassession)){
			 	
				// RESTORE THE CART DATA
				$cart_data = unserialize($hassession[0]->session_data); 
				 		 
				// NOW WE LOOP ALL ITEMS AND REMOVE THE QTY IF REQUIRED
				if(isset($cart_data['items']) && is_array($cart_data['items'])){				
				
					// CHECK FOR COMMENTS
					if($cart_data['userid'] == 0){ // GUEST CHECKOUT		
						$order_username = "Guest";	
						$order_useremail = $cart_data['guest_data']["billing_email"];							
					}else {
						$order_username = get_user_meta($cart_data['userid'], "billing_fname",true)." ".get_user_meta($cart_data['userid'], "billing_lname",true);	
						 
						$user_info = get_userdata($cart_data['userid']);
						//$userloginname = $user_info->user_login;
						$order_username = $user_info->user_nicename;
						$order_useremail = $user_info->user_email;										
					}	
					
					$order_data_description = "\n\n\n********** Order Information **********\n\n";
					$order_data_description .= "Date : ".hook_date(date('Y-m-d H:i:s'))."\n";
					$order_data_description .= "Order ID : ".$data['order_id']."\n";				 
					$order_data_description .= "Items : ".count($cart_data['items'])."\n";												
					$order_data_description .= "Order Total : ".hook_price($cart_data['total'])."\n";
					
					// SEND EMAIL	
					$all_emails = _ppt('emails');					
					if(isset($all_emails['admin_order_new']['enable']) && $all_emails['admin_order_new']['enable'] == 1){
									
						$data1 = array(		
								"username" 		=> $order_username,	
								"description" 	=> $order_data_description,
								"order_id" 		=> $data['order_id'],								
								"order_email" 	=> $order_useremail,								 
						);															
												
						$CORE->email_system('admin', 'admin_order_new', $data1);
											
					}
					if(isset($all_emails['order_new_sccuess']['enable'] ) && $all_emails['order_new_sccuess']['enable'] == 1){
										
						$data1 = array(		
								"username" 		=> $order_username,	
								"description" 	=> $order_data_description,
								"order_id" 		=> $data['order_id'],								
								"order_email" 	=> $order_useremail,								 
						); 
										
						$CORE->email_system($order_useremail, 'order_new_sccuess', $data1);
					}
							
				
					// UPDATE ORDER QTY AND DATA ITEMS
					foreach($cart_data['items'] as $key => $item){
								foreach($item as $mainitem){								
								
									// UPDATE PURCHASE COUNTER
									$purchased = get_post_meta($key,'purchased',true);
									if($purchased == ""){ $purchased = 0; }									
									update_post_meta($key,'purchased', ( $purchased + 1 ));
									
								 
									// SETUP PRICE
									/*if(get_post_meta($key,'price-on',true) == 1){
										$product_amount = 0;
									}else{
										$product_amount = get_post_meta($key,'price',true);
									}*/									
								 
									// UPDATE STOCK COUNT
									if(get_post_meta($key,'stock_remove',true) == "1"){									
									
										// CHECK IF WE ARE USING THE PRICE-ON SYSTEM
										if(get_post_meta($key,'price-on',true) == 1 && isset($mainitem['custom_data']) ){										
											 	// LET CUSTOM DATA HANDLE IT
										}else{											
											// UPDATE
											update_post_meta($key,'qty',get_post_meta($key,'qty',true)-$mainitem['qty']);
										}
									}
									
								 
									// LOOP ALL THE CUSTOM DATA
									if(isset($mainitem['custom_data']) && is_array($mainitem['custom_data']) && !empty($mainitem['custom_data']) ){
										foreach($mainitem['custom_data'] as $f){
										
										 
											/*if($f['field'] == "priceon"){
												update_post_meta($key,'price-'.$f['key'].'-stock',get_post_meta($key,'price-'.$f['key'].'-stock',true)-$mainitem['qty']);
											}else{
											
											}*/
											
											// UPDATE AMOUNT
											//$product_amount += $f['amount'];
												
												
										} // end foreach
									}
				
						} }
						
				
				}// END ITEMS
						
			} // END HAS SESSOPM
		
		
		
		
		//die('cart process here'); 
		
		} // END ID TYPE
	
	}


return $data;


}
  
  
  
	
}

?>