<?php


class framework_ajax extends framework_email {

	
 
function _ajax_actions(){ global $CORE, $wpdb, $userdata;


	/// SET USER LOCATION
	if(isset($_POST['updatemylocation'])){				
		$_SESSION['mylocation']['log'] = strip_tags($_POST['log']);
		$_SESSION['mylocation']['lat'] = strip_tags($_POST['lat']);
		$_SESSION['mylocation']['zip'] = strip_tags($_POST['zip']);
		$_SESSION['mylocation']['country'] = strip_tags($_POST['country']);
		$_SESSION['mylocation']['address'] = strip_tags($_POST['myaddress']);
	}

 	/*
		this function redirects the user to the category page if
		they are only viewing one category

	*/
	if(isset($_GET['advanced_search']) && $_GET['s'] == ""){	 
	
		foreach($_GET as $a => $k){
		 
			if(substr($a,0,2) == "ct" && isset($k[0]) && is_numeric($k[0]) && !isset($k[1]) ){
				
				$canContinue = true;
				
				if(isset($_GET['price1']) || isset($_GET['price2']) ){
					if($_GET['price1'] == 0 && $_GET['price2'] == 0){
					
					}else{
					$canContinue = false;
					}
				}
				
				if($canContinue){
					$category = get_term_by('term_taxonomy_id', $k[0]);
					 
					$category_link = get_term_link($category);
					
					if ( !is_wp_error( $category_link ) ) {						
						// send user
						wp_redirect($category_link);
						exit();
					
					}// end if error
				
				} // end if contineue
				
			} // end if CT
			
		}	// end foreach
	}// end search
	

		// CUSTOM COMMENTS SHORTCODE
		if(isset($_POST['commentsform']) && isset($_POST['pid']) && is_numeric($_POST['pid']) && $userdata ){
		
			if(strlen($_POST['comment']) > 0 ){
			 
			$time = current_time('mysql');	
			$data = array(
				'comment_post_ID' => $_POST['pid'],
				'comment_author' => $userdata->display_name,
				'comment_author_email' => 'admin@admin.com',
				'comment_author_url' => 'http://',
				'comment_content' => strip_tags($_POST['comment']),
				'comment_type' => '',
				'comment_parent' => 0,
				'user_id' => $userdata->ID,
				'comment_author_IP' => $this->get_client_ip(),
				'comment_agent' => 'Mozilla/5.0 (Windows; U; Windows NT 5.1; en-US; rv:1.9.0.10) Gecko/2009042316 Firefox/3.0.10 (.NET CLR 3.5.30729)',
				'comment_date' => $time,
				'comment_approved' => 0,
			);
			
			wp_insert_comment($data);			 
			
			}
		
		}


	//CHECK FOR OUTBOUT LINKS		
	if(strpos($_SERVER['REQUEST_URI'], "/outtax/") !== false) {	
		 
			$bb = explode("outtax/",$_SERVER['REQUEST_URI']);
			$bb1 = explode("/",$bb[1]);
			
			 			
			if(is_numeric($bb1[0])){
			 
				// GET LIST
				$link = _ppt('category_website_afflink_'.$bb1[0]);
				if($link == ""){
				$link = _ppt('category_website_'.$bb1[0]);
				}
			 
				if($link == ""){
				$link = home_url(); 
				}				
				 
				$link = hook_outbound_link($link);	
		 
		 		if(strpos($link, "http") === false){
				$link = "http://".$link;
				}			
				 
			
			
				// REDIRECT				 
				header("location:".$link, true ,301);
				exit;
				
			}	
	}elseif(strpos($_SERVER['REQUEST_URI'], "/out/") !== false) {	
		 
			$bb = explode("out/",$_SERVER['REQUEST_URI']);
			$bb1 = explode("/",$bb[1]);
							
			if(strlen($bb1[1]) > 1){
				$GLOBALS['out_post_id'] = $bb1[0];
				 
				// UPDATE CLICK COUNTER
				update_post_meta($bb1[0], 'clicks', get_post_meta($bb1[0], 'clicks', true) + 1 );
				
				// GET LIST
				$link = get_post_meta($bb1[0], $bb1[1], true);		
				$link = hook_outbound_link($link);	
				
				// USED COUNT
				if(THEME_KEY == "cp"){
				$used = get_post_meta($bb1[0],'used',true);
				if($used == ""){ $used = 0; }
				update_post_meta($bb1[0],'used', $used + 1);
				}
				
				
				if(strpos($link, "http") === false){
				$link = "http://".$link;
				}			
				 
				// REDIRECT				 
				header("location:".$link, true ,301);
				exit;
				
			}		 
	}elseif (strpos($_SERVER['REQUEST_URI'], "/confirm/") !== false) {
			$bb = explode("confirm/",$_SERVER['REQUEST_URI']);			
			if (strpos($bb[1], "unsubscribe/") !== false) {
			
				$be = explode("unsubscribe/",$bb[1]);
				$wpdb->query("DELETE FROM ".$wpdb->prefix."core_mailinglist WHERE email = ('".esc_sql(strip_tags($be[1]))."') LIMIT 1");
				// REDIRECT USER		
				$url = get_option('mailinglist_unsubscribe_thankyou');
				if($url == ""){ $url = home_url(); }
				header("location: ".$url);
				exit();
			}elseif (strpos($bb[1], "mailinglist/") !== false) {
				$be = explode("mailinglist/",$bb[1]);
				$wpdb->query("UPDATE ".$wpdb->prefix."core_mailinglist SET email_confirmed=1 WHERE email_hash = ('".esc_sql(strip_tags($be[1]))."') LIMIT 1");
				// REDIRECT USER		
				$url = get_option('mailinglist_confirmation_thankyou');
				if($url == ""){ $url = home_url(); }
				header("location: ".$url);
				exit();
			}		 
	}



	if(isset($_POST['cart_action'])){		
			
		switch($_POST['cart_action']){
			 	
				case "update": {
				
				 
				//$ProductArray = array( "1" => array( "qty" => 50 ) );
				//$_SESSION['wlt_cart'][612] = $ProductArray;
				//die();
				
				// GET CART DATA
				global $CORE_CART;
				$cartdata 	= $CORE_CART->cart_getitems();
				
				$cart_items = $cartdata['items'];
				
				//PRODUCT DATA					
				$product_id 		= $_POST['pid'];
				$product_qty 		= $_POST['qty'];
				$product_ship 		= 0; // NEEDS DOING
				$product_innerid 	= $_POST['innerid']; // USED AT CHECKOUT FOR INCREASING QTY	
			 	$product_customdata = "";
				if(strlen($_POST['custom']) > 1){ 
					$product_customdata = $_POST['custom'];
				}
				
				// CREDIT SYSTEM
				$product_paument_via_tokens 		= 0; 
				if(isset($_POST['tokens']) && is_numeric($_POST['tokens']) && $_POST['tokens'] == 1){
				$product_paument_via_tokens 		= 1; 
				}
				
			 
				// CHECK IF THE PRODUCT ALREADY EXISTS
				if(isset($cart_items[$product_id])){	
							
					$ProductArray = $cart_items[$product_id]; 	
					
					if( is_numeric($product_innerid) && isset($cart_items[$product_id][$product_innerid]) ){
						$innerID 		= $product_innerid;
					
					}else{		
						$innerID = count($cart_items[$product_id]);
					}
													
				}else{ 
			 
					$ProductArray = array( "1" => array( "qty" => 0 ) ); // NEW PRODUCT
					$innerID = 1;
					
				}// endif
				
				
				// IF WERE ADDING CHECK IF WE NEED TO ADD A NEW PRODUCT
				// OR UPDATE AN EXISTING ONE
				if($_POST['type'] == "add" && $product_customdata != "" && isset($cart_items[$product_id]) ){
					$innerID = count($cart_items[$product_id])+1;	// GENERATE A NEW ID
				}
				
				// THIS IS THE PRODUCT WE ARE EDITING!!!
				$CURRENTPRODUCT = $ProductArray[$innerID]; 			 
			
				// NOW PERFORM TASK
				switch($_POST['type']){
				
					case "add": {
						 
						$CURRENTPRODUCT['qty'] = $CURRENTPRODUCT['qty'] + $product_qty;					 
					
					} break;
					
					case "remove": {
						
						$CURRENTPRODUCT['qty'] = $CURRENTPRODUCT['qty'] - $product_qty;	
						
					} break;
					
					case "update": {
						 
						$CURRENTPRODUCT['qty'] = $product_qty;					 
					
					} break;
				
				}// end switch
				
				
					 
				// IF LESS THAN 1 REMOVE
				if($CURRENTPRODUCT['qty'] < 1){
					unset($_SESSION['wlt_cart'][$product_id][$innerID]);						
					die("here");						
				}
						
			 	
				 
				// CHECK FOR EXTRAS
				$extras_array = array();
				if(strlen($product_customdata) > 0){ 
						$e1 = explode(",",$product_customdata);	 $o=1;										
						foreach($e1 as $ed){
							$bits = explode("|",$ed);
							if(isset($bits[1])){
							$extras_array[$o]['key'] 	= $bits[0];
							$extras_array[$o]['field'] 	= $bits[1];
							$extras_array[$o]['text'] 	= $bits[2];
							$extras_array[$o]['amount'] = $bits[3];
							 
							$o++;
							} // end if
						} // end foreach
				}// end if
					
				// PRODUCT SAVE
				$CURRENTPRODUCT['extra'] 	= array("ship" => $product_ship, "tokens" => $product_paument_via_tokens, "custom" => $extras_array);				
			 	
 				// SAVE SESSION
				$_SESSION['wlt_cart'][$product_id][$innerID] = $CURRENTPRODUCT;
					 
				// LEAVE MSG
				die(print_r($_SESSION['wlt_cart']).print_r($ProductArray)); 
			
				
				} break; // end update
			
		} // end switch				
		 
	}// end actions
 

 
 
// AJAX FROM WITHIN THE SITE
if(isset($_POST['admin_action']) && $_POST['admin_action'] !=""){

	switch($_POST['admin_action']){
	
 
		case "user_delete": {
		
			if(isset($_POST['uid']) && is_numeric($_POST['uid']) && $_POST['uid'] != 1 ){
			
				require_once(ABSPATH.'wp-admin/includes/user.php' );
				
				wp_delete_user($_POST['uid']);
			
				die(json_encode(array("status" => "ok")));
			
			}else{
				die(json_encode(array("status" => "error")));
			}
		
		} break;
	
		case "update_title": {
		
				$the_post 				= array();
				$the_post['ID'] 		= $_POST['id'];
				$the_post['post_title'] = strip_tags(strip_tags($_POST['title']));
				wp_update_post( $the_post );
				
				die("ok");
		
		} break;
		
		case "update_custom_field": {
			
			if(is_numeric($_POST['pid'])){
				update_post_meta($_POST['pid'], $_POST['key'], $_POST['value']);
			}
				die("ok");
		
		} break;

		case "listing_catprice": {
				
			if(!is_numeric($_POST['cid'])){ die(0); }
				
			if(is_numeric($_POST['amount'])){
					$current_catprices = get_option('wlt_catprices');
					if(!is_array($current_catprices)){ $current_catprices = array(); }
					$current_catprices[$_POST['cid']] = $_POST['amount'];
					update_option('wlt_catprices',$current_catprices);
					die(1);				 
				}
			
			die(0);	 
				
		} break;
	
	} // end switch

}


// AJAX FROM WITHIN THE SITE
if(isset($_POST['action']) && $_POST['action'] !=""){

	switch($_POST['action']){
	
	case "update_user_payment": {
	
		if(is_numeric($_POST['id'])){
			
			$status = $_POST['val'];
			
			update_post_meta($_POST['id'],'status',$status);
			
			// IF PAYMENT HAS AN OFFER, UPDATE THIS TOO			
			$offer_id = get_post_meta($_POST['id'],'offer_id',$status);
			if($offer_id != ""){
				update_post_meta($offer_id,'payment_complete', date('Y-m-d H:i:s') );
			}
 			
			// RESPONDE
			if($status == 1){ $h = __("Paid","premiumpress"); ?>           
			   <span class="badge badge-success"><?php echo __("Paid","premiumpress"); ?></span>           
			   <?php }elseif($status == 2){ $h = __("Refunded","premiumpress"); ?>
			   <span class="badge badge-danger"><?php echo __("Refunded","premiumpress"); ?></span>          
			   <?php }elseif($status == 3){ $h = __("Cancelled","premiumpress"); ?>           
			   <span class="badge badge-info"><?php echo __("Cancelled","premiumpress"); ?></span>  
			   <?php
			   }
			   
			// ADD LOG ENTRY			 	
			$CORE->ADDLOG("Invoice Updated to ".$h."", 0, 0, "", "invoice", $_POST['id'] );	 		 	
		 	
		}
		die();
	
	} break;
	
	case "get_user_payment": {
	
	  	
		// GET SELLER DETAILS
		$seller_id = get_post_meta($_POST['id'],'seller_id',true);
		 
		// GET AMOUNT
		$amount = get_post_meta($_POST['id'],'amount',true);		
		
		// FIND OUT WHAT THE SELLER PAYMENT DETAILS ARE
		$payment_type = get_user_meta($seller_id,'payment_type',true);
		
		// GET PAYPAL EMAIL
		$paypalemail = get_user_meta($seller_id,'paypal',true);	
		
		?>
        <div class="border p-4 bg-light mb-4 clearfix">
        
        <?php
		 	
		// IF IS THE ADMIN - SHOW ADMIN PAYMENT OPTIONS 
		if(user_can( $seller_id, 'administrator' )){
		 
		
		?>
       
        
        <div id="ajax_payment_form_account_overdue" class="mb-4"></div>              
                               
<script> 
ajax_load_payment();

function ajax_load_payment(){
   
       jQuery.ajax({
           type: "POST",
           url: '<?php echo home_url(); ?>/',		
   		data: {
               action: "load_new_payment_form",
   			details:jQuery('#ppt_orderdata').val(),
           },
           success: function(response) {			
   			jQuery('#ajax_payment_form_account_overdue').html(response);
   			
           },
           error: function(e) {
               alert("error "+e)
           }
       });
   
   }
</script>

<input type="hidden" id="ppt_orderdata" value="<?php 
    
   echo $CORE->order_encode(array(   
   	"uid" => $seller_id, 
   	"amount" => $amount,    	
   	"local_currency_amount" => $CORE->price_format_display( $amount ),
   	"local_currency_code" => $CORE->_currency_get_code(),   	
   	"order_id" => "INVOICE-".$_POST['id']."-".rand(),   	 
   	"description" => "Payment Invoice #".$_POST['id'],   	
   	"recurring" => 0,   	
   	"couponcode" => 0, 		
   ) ); 
    		
   ?>" />
        
        <?php }elseif($payment_type == "bank"){ ?>        
          
		<p><?php echo __("The seller has indicated they would like payment via bank transfer.","premiumpress"); ?></p>
        
        <p><?php echo __("Bank details below","premiumpress"); ?>;</p> 
        
        <p><pre><?php echo stripslashes(get_user_meta($seller_id,'bank',true)); ?></pre></p>       
       
       <?php }elseif($payment_type == "person"){ ?>        
          
		<p><?php echo __("The seller has indicated they would like on collection.","premiumpress"); ?></p>
        
        <p><?php echo __("The sellers address is;","premiumpress"); ?></p> 
        
        <p><pre><?php echo stripslashes(get_user_meta($seller_id,'payaddresss',true)); ?></pre></p>
      
        <?php }elseif($payment_type == "paypal"){ ?>
       
        <p><?php echo __("The seller has indicated they would like payment for this item sent via PayPal.","premiumpress"); ?></p>
    
		<?php
           
            echo '<form method="post"  action="https://www.paypal.com/cgi-bin/webscr" name="checkout_paypal" class="pull-left">	 
            <input type="hidden" name="lc" value="US">
            <input type="hidden" name="return" value="'._ppt(array('links','account')).'">
            <input type="hidden" name="cancel_return" value="'._ppt(array('links','account')).'">
            <input type="hidden" name="notify_url" value="'._ppt(array('links','account')).'">
            <input type="hidden" name="discount_amount_cart" value="0">
            <input type="hidden" name="cmd" value="_xclick">
            <input type="hidden" name="amount" value="'.$amount.'">
            <input type="hidden" name="item_name" value="Payment for invoice '.$CORE->order_get_orderid($_POST['id']).'">
            <input type="hidden" name="item_number" value="USERPAYMENT-'.$seller_id.'-'.date('Ydm').'">
            <input type="hidden" name="business" value="'.$paypalemail.'">
            <input type="hidden" name="currency_code" value="'._ppt(array('currency','code')).'">
            <input type="hidden" name="charset" value="utf-8">
            <input type="hidden" name="custom" value="'.$_POST['id'].'">
            <button  class="btn btn-lg btn-info">'.__("Pay Now Via PayPal","premiumpress").'</button>					
            </form>';	
        ?>
        
         <?php }elseif($payment_type == "stripe"){ 
		 
	  
		  $_POST['details'] = $CORE->order_encode(array(   
			"uid" => $seller_id, 
			"amount" => $amount,    	
			"local_currency_amount" => $CORE->price_format_display( $amount ),
			"local_currency_code" => $CORE->_currency_get_code(),   	
			"order_id" => "INVOICE-".$_POST['id']."-USER-".$seller_id,   	 
			"description" => "Payment Invoice #".$_POST['id'],   	
			"recurring" => 0,   	
			"couponcode" => 0, 		
		   ) ); 
   
		  $GLOBALS['orderid'] 		= "INVOICE-".$_POST['id']."-".rand();
		  $GLOBALS['description'] 	= "Payment Invoice #".$_POST['id'];
		  $GLOBALS['tax'] 			= 0;
		  $GLOBALS['shipping'] 		= 0;
		  
		  echo v9_gateway_stripe_form(array(
			"uid" 			=> $seller_id, 
			"amount" 		=> $amount,    		
			"order_id" 		=> $GLOBALS['orderid'],   	 
			"description" 	=> $GLOBALS['description'],   	 
		  ));
	  
	  
	  
	  }else{ ?>
        
        <p><strong><?php echo __("The seller has not set any payment preference.","premiumpress"); ?></strong></p>
        
        <p><?php echo __("Please contact them directly to discuss a payment method.","premiumpress"); ?></p>
        
        <p><a href="<?php echo _ppt(array('links','account'))."?msg=1&u=".$seller_id; ?>" class="btn btn-primary rounded-0"><?php echo __("Contact User","premiumpress"); ?></a></p>
        
        <?php } ?>
        </div>
        <?php		
		 die();
	
	} break;
 	
	case "cancel_membership": {
	 	
		update_user_meta($_POST['uid'], 'wlt_subscription', "" );
		
		return 1; 
	
	
	} break;	
	
	case "events_set_attending": {
	
	
	$attending = get_post_meta($_POST['pid'],'attending',true);
	if(!is_array($attending)){ $attending = array(); }	
	
	if(isset($attending[$_POST['uid']] )){
	unset($attending[$_POST['uid']]);
	}else{
	$attending[$_POST['uid']] = $_POST['uid'];	
	}
		
	update_post_meta($_POST['pid'],'attending',$attending);
	
	die("ok");
	
	
	} break;
	
	case "rating_likes_check": {


		if(is_numeric($_POST['pid']) ){ 
			 
				// GET RATING IPS AND STOP THE USER FROM VOTING MULTIPLE TIMES
				$rated_user_ips = get_option('rated_user_ips');
				$user_ip = $CORE->get_client_ip();
				if(!is_array($rated_user_ips)){ $rated_user_ips = array(); }
				 
				if(isset($rated_user_ips[$_POST['pid']]) && in_array($user_ip, $rated_user_ips[$_POST['pid']]['ip-'.$user_ip])  ){ 
					
					echo "none";
					die();
				
				}else{
				
					echo "1";
					die();
				
				}
			
		}// end if if valid pid
				 
		echo "none";			
		die();
	
	} break;
	
		case "rating_likes": {	
		
		 		 
			if(is_numeric($_POST['pid']) ){ 
			 
				// GET RATING IPS AND STOP THE USER FROM VOTING MULTIPLE TIMES
				$rated_user_ips = get_option('rated_user_ips');
				$user_ip = $CORE->get_client_ip();
				if(!is_array($rated_user_ips)){ $rated_user_ips = array(); }
				 
				if(isset($rated_user_ips[$_POST['pid']]) && in_array($user_ip, $rated_user_ips[$_POST['pid']]['ip-'.$user_ip])  ){ 
					
					echo "none";
					die();
				
				}else{
				
					// GET EXISTING DATA
					if($_POST['value'] == "up"){
						$result = get_post_meta($_POST['pid'], 'ratingup', true);
						if(!is_numeric($result)){ $result = 1; }else{ $result = $result + 1; }
						update_post_meta($_POST['pid'], 'ratingup', $result);
						$value = 1;
					}else{
						$result = get_post_meta($_POST['pid'], 'ratingdown', true);
						if(!is_numeric($result)){ $result = 1; }else{ $result = $result + 1; }
						update_post_meta($_POST['pid'], 'ratingdown', $result);	
						$value = 0;				
					}
					
					// SAVE RESULTS			
					$total = get_post_meta($_POST['pid'], 'rating_total', true);	
					if(!is_numeric($total)){ $total = 1; }else{ $total = $total + 1; }	
					update_post_meta($_POST['pid'], 'rating_total', $total);
					
					// SAVE USER IP
					if(!isset($rated_user_ips[$_POST['pid']]['ip-'.$user_ip])){ $rated_user_ips[$_POST['pid']]['ip-'.$user_ip] = array(); }
					$rated_user_ips[$_POST['pid']]['ip-'.$user_ip] = array_merge($rated_user_ips[$_POST['pid']]['ip-'.$user_ip],array("ip" => $user_ip, "rating" => $value));
					update_option('rated_user_ips', $rated_user_ips); 
					
					echo $result;
					die();
				
				}
			
			}// end if if valid pid
				 
			echo "none";			
			die();
			
		} break;
	
	
		// CHANGE MESSAGE STATUS ONCLICK	
		case "msg_changestatus": {	
				if(is_numeric($_POST['id'])){			
						update_post_meta($_POST['id'],"status","read");	
						}					 	
		} break;
	
 
		case "validateUsername": {				
		
			if(strlen($_POST['name']) > 2){
				$dd = get_user_by( 'login',  str_replace("-"," ",strip_tags($_POST['name'])) );	
				 
				if(isset($dd->ID)){
					die("yes");
				}
			}	
			die("0");
									
		} break;
	
		case "translate": {
  
		$apiKey = _ppt('google_api_key');
		if($apiKey == ""){ 
		die($_POST['text']);
		}
		$text = $_POST['text'];
		$l1 = $_POST['l1'];
		$l2 = $_POST['l2'];
		$url = 'https://www.googleapis.com/language/translate/v2?key=' . $apiKey . '&q=' . rawurlencode($text) . '&source='.$l1.'&target='.$l2;
	
		$data = wp_remote_get($url);	
		$responseDecoded = json_decode($data['body'], true);
		
		die($responseDecoded['data']['translations'][0]['translatedText']);
		
		
		} break;
	
		case "sms_test": {	
			die($CORE->SENDSMS_ADMIN($_POST['num'], $_POST['msg']));
		} break;
		
		case "sms_sendcode": {
			
			$response = "invalid number";
			if(isset($_POST['num']) && $_POST['num'] > 6){
			
			$response = $CORE->SENDSMS_ACTIVATION($_POST['pf'].$_POST['num']);
			
			}
			die($response);
		
		} break;
		
		case "sms_validatecode": {
		
			if($_POST['code'] == date('ymd')){
			die("ok");
			}else{
			die("error");
			}	
		
		} break;
	
		case "get_email_content": {
			
			$emailid = $_POST['emailid'];
			
			// EMAILS
			$wlt_emails = get_option("wlt_emails");

			if(is_array($wlt_emails)){ 
				foreach($wlt_emails as $key => $field){ 
				
					if($emailid == $key){
						die($field['message']);
					}
				 
				} 
			} 
		
			die();
		
		} break;
	
		case "admin_delete_log":{
			
			$wpdb->query("DELETE FROM ".$wpdb->prefix."core_log WHERE autoid = ('".strip_tags($_POST['logid'])."') LIMIT 1"); 							
			die();
			
		} break;
		
		case "admin_delete_alllogs":{
			
			$wpdb->query("DELETE FROM ".$wpdb->prefix."core_log WHERE type='email'"); 							
			die();
			
		} break;
		
		/*
			this function gets a users email
			address from their user id
		*/
		case "get_user_email": {
		
			$userid = $_POST['uid'];
			if(is_numeric($userid)){
				die(get_the_author_meta( 'email', $userid));
			}
			
			die();		
		} break;
	
		case "load_media_delete": {
		
			update_post_meta($_POST['pid'], 'image','');
			die();
		
		} break;
		
		/*
		case "delete_media": {
		
			if(isset($_POST['aid']) && is_numeric($_POST['aid'])){
		  	
			wp_delete_attachment( $_POST['aid'] );
			die('media deleted');			
			}
			die();
			
		} break;
		*/
		
		case "delete_file": {
		 
			if(isset($_POST['aid']) && is_numeric($_POST['aid']) && $_POST['aid'] == "9999"){
			
			delete_post_meta($_POST['pid'],'image','');	
			die();
			
			}elseif(isset($_POST['aid']) && is_numeric($_POST['aid'])){
			  
				// GET EXISTS MEDIA ARRAYS
				$get_type = array("image_array", "video_array", "doc_array", "music_array");			
				// LOOP ARRAYS TO GET ALL MEDIA DATA
				foreach($get_type as $type){		
					// GET THE MEDIA DATA FOR THIS ARRAY
					$data = get_post_meta($_POST['pid'],$type,true);	 
					if(is_array($data)){
					// LOOP THROUGH, CHECK AND DELETE
						$new_array = array();			
						foreach($data as $media){
							if($media['id'] != $_POST['aid']){
								$new_array[] = $media;
							}else{
								$delsrc 	= $media['filepath'];
								$delthumbsrc = $media['thumbnail'];				
								
							}// end if
						}// end foreach	
						// UPDATE MEDIA FILE ARRAY
						update_post_meta($_POST['pid'],$type,$new_array);	
					}// end if
				} // end foreach
				// LOOP THROUGH AND REMOVE THE ONE WE DONT WANT
				
				// DELETE FILE FROM WORDPRESS MEDIA LIBUARY
				if ( false === wp_delete_attachment($_POST['aid'], true) ){	
					//die("could not delete file");
				} 
				
				// FALLBACK IF SYSTEM IS NOT DELETING IMAGES
				if(strlen($delsrc) > 1 && file_exists($delsrc)){ @unlink($delsrc); } 
				if(strlen($delthumbsrc) > 1){ 	
					$ff = explode("/",$delsrc);
					$fg = explode($ff[count($ff)-1],$delsrc);
					$fd = explode("/",$delthumbsrc);
					$thumbspath = $fg[0].$fd[count($fd)-1]; 
					if(file_exists($thumbspath)){					
					@unlink($thumbspath);
					}
				} 
			
			}
			
			if(isset($_POST['stopc'])){
			die();
			}
		
		} break;
		
		case "get_media_dimentions": {
		
		$image_attributes = wp_get_attachment_image_src( $_POST['aid'] , 'full' );
		die(json_encode(array("w" => $image_attributes[1], "h" => $image_attributes[2] )));
		die();
		
		} break;
		
		case "get_media_size": {
		
		$image_attributes = wp_get_attachment_image_src( $_POST['aid'] , 'full' );
		
		die(print_r($image_attributes));
		die(json_encode(array("size" => 1000 )));
		die();
		
		} break;
		
		case "set_media_order": {
		
		global $userdata;
	 
			// CHECK THE POST AUTHOR AGAINST THE USER LOGGED IN
					$post_data = get_post($_POST['aid']); 
					if($post_data->post_author == $userdata->ID || user_can($userdata->ID, 'administrator') ){
					
					$haschanged = false;
					
					// SET FEATURED IMAGE
					if($_POST['order'] == 1){
				 	set_post_thumbnail($_POST['pid'], $_POST['aid']);
					}
					
					// LOOP ALL ITEMS
					foreach(array("image_array", "video_array", "doc_array", "music_array") as $switch){
						
						 	if($haschanged){ continue; }
							$t = array();
							$g = get_post_meta($_POST['pid'], $switch, true);							
							
							if(is_array($g) && !empty($g) ){	
								 					
								foreach($g as $img){
									if($img['id'] == $_POST['aid']){
										$haschanged = true;
										$img['order'] = $_POST['order'];
									}
									$t[] = $img; 
								}
								
								if($haschanged){
								update_post_meta($_POST['pid'], $switch, $t);
								}
													
							} // end if
							
						}// end foreach	
						 
					}
					die();
		
		} break;
		case "set_media_title": {
		
			
			// MAKE SURE THE USER IS THE AUTHOR
			$post_data = get_post($_POST['aid']); 
			if($post_data->post_author == $userdata->ID || is_admin() ){
					
				$the_post 				= array();
				$the_post['ID'] 		= $_POST['aid'];
				$the_post['post_title'] = strip_tags(strip_tags($_POST['title']));
				wp_update_post( $the_post );
				 
				die("updated");	 
			}	
		
		
		die("123");
		} break;
	
	
		case "quickview": {
		global $post;
		$post = new stdClass();
		$post->ID 				= $_POST['pid'];
		$post->post_type 		= "listing_type";
		$post->post_title		= get_the_title($post->ID);
		
		?>
        <?php get_template_part('single','quickview'); ?>
        <?php
		
		die();
		
		} break;
	
		case "load_categories": {
		
		 echo wp_list_categories(array(
                'walker'=> new Walker_CategorySelection, 
                'taxonomy' => THEME_TAXONOMY, 
                'show_count' => 1, 
                'hide_empty' => 0, 
                'echo' => 0, 
                'parent' => $_POST['parent'],
                'title_li' =>   "",
				'level' => $_POST['level']
				) 
            ); 
		
		die();
		
		} break;
		 
	
		case "savelisting": {	global $userdata;
		  
		  // PREPARE DATA
		  $data = array();
		  parse_str($_POST['data'], $data); 
		  
		     
			// VALIDATION
			if(strlen($data['form']['post_title']) < 2){ 		
			die(__("Please provide more details, your listing is too short.","premiumpress"));			 
			}			
			
			// SETUP WORDPRESS ALUES FOR NEW POST
			
			if($data['htmleditor'] == 1){
			 		$tags_to_strip = array("form","code"  );
				$CONTENT = $data['form']['post_content'];
				foreach ($tags_to_strip as $tag)
				{
					$CONTENT = preg_replace("/<\\/?" . $tag . "(.|\\s)*?>/","", $CONTENT);
				
				}
				
 			}else{
			$CONTENT = stripslashes(strip_tags(str_replace("http://","",str_replace("https://","",$data['form']['post_content']))));	
			}
			// ADD TAGS TO CONTENT FOR BETTER SEARCHING
			// SAVE POST TAGS
			if(isset($data['form']['post_tags'])){
				
				// DELETE OLD TAGS
				$CONTENT = preg_replace('#<div id="ppt_keywords">(.*?)</div>#', ' ', stripslashes($CONTENT));
				$CONTENT .= '<div id="ppt_keywords">'.str_replace(","," ",strip_tags($data['form']['post_tags']))."</div>";					
			}
			
			$my_post = array(
				'post_type'		=> 'listing_type',
				'post_title' 	=> esc_html($data['form']['post_title']),
				'post_modified' => current_time( 'mysql' ),
				'post_excerpt' => ' ',
				'post_content' 	=> $CONTENT,
			);			
			
			if(isset($data['form']['post_excerpt']) ){ 
				$my_post['post_excerpt'] = $data['form']['post_excerpt']; 						 
			}	
			
			 
			// LISTING STATUS
			$admin_default_status = _ppt('default_listing_status');
			if($admin_default_status == "pending" && !isset($_GET['eid'])  ){ //
				$my_post['post_status'] 	= "pending";
			}else{
				$my_post['post_status'] 	= "publish";
			}			
			 
			// GET POSTID
			if( isset($data['eid']) ){
				$my_post['ID'] = $data['eid']; 
				wp_update_post( $my_post );
				$POSTID = $data['eid'];
				
				
				// SEND EDIT LISTING EMAIL
				$data1 = array(		
					"username" => $userdata->display_name,	
					"item_title" => get_the_title($POSTID),
					"item_link" => get_permalink($POSTID),	
					"title" => get_the_title($POSTID),
					"link" => get_permalink($POSTID),
					"ID" => $POSTID,
				); 
										
				$CORE->email_system('admin', 'admin_editlisting', $data1);
				
				// ADD LOG
				$CORE->ADDLOG("Listing Updated", $userdata->ID, $data['eid'], get_the_title($data['eid']), "listing", $data['eid'] );
				
			}else{
			
				$POSTID = wp_insert_post( $my_post );	
				
				// SEND EMAIL
				$data1 = array(		
					"username" => $userdata->display_name,	
					"item_title" => get_the_title($POSTID),
					"item_link" => get_permalink($POSTID),	
					"title" => get_the_title($POSTID),
					"link" => get_permalink($POSTID),
					"ID" => $POSTID,
				); 
										
				$CORE->email_system('admin', 'admin_newlisting', $data1);
				
				// SEND TO USER
				$CORE->email_system($userdata->ID, 'newlisting', $data1);	
				
				// ADD LOG
				$CORE->ADDLOG("Listing Created", $userdata->ID, $POSTID, get_the_title($POSTID), "listing", $POSTID );						 
			}	
			
		 	
			// CHECK FOR AMOUNT DUE
			if(isset($data['freelisting'])){
			
				unset($data['form']['totalprice']);	
				update_post_meta($POSTID, 'freelisting', 1 );
				update_post_meta($POSTID, 'paid_date', date("Y-m-d H:i:s") );
						
			
			}elseif(isset($data['form']['totalprice']) && is_numeric($data['form']['totalprice']) && $data['form']['totalprice'] > 0 ){				
			
				// IF LISTING HAS EXPIRED THEN FORCE PAYMENT
				// OTHERWISE REMOVE PAYMENT REQUIRED
				
				if(!isset($_GET['eid'])){ // MUST BE $_GET
				
					update_post_meta($POSTID, 'total_price_due', esc_html($data['form']['totalprice']));
				
				}elseif($CORE->has_expired($POSTID)){
				
					update_post_meta($POSTID, 'total_price_due', esc_html($data['form']['totalprice']));
					
				}else{
				
					unset($data['form']['totalprice']);
				}		 			
								
			}
		 
			// SET PACKAGE DATA FOR THIS LISTING
			if(isset($data['packageID']) && is_numeric($data['packageID'])  ){					 			
				
				// SET ID
				update_post_meta($POSTID, 'packageID', strip_tags($data['packageID']) );
				
				// SET FEATURED
				if(_ppt('pak'.$data['packageID'].'_featured') == 1){
				update_post_meta($POSTID, 'featured', "1" );
				}
								
			}	
			
			// SET POWERSELL STATUS ADD-ON
			if(get_user_meta($userdata->ID,'wlt_powerseller', true) == 1){			 
				update_post_meta($POSTID, 'powerseller', "1" );
			}
			
			// VERIFIED USER ADDON
			if(get_user_meta($userdata->ID,'wlt_verified',true) == "yes"){
				update_post_meta($POSTID, 'verified', "1" );			
			}
			 
			// SETUP CATEGORIES
			$categories = array();
			if(isset($data['form']['category'])){
				
				if(is_array($data['form']['category'])){
					foreach($data['form']['category'] as $cat){
						if(!is_numeric($cat) ){ continue; }
						$categories[] = $cat;
					}
				}				
				// UPDATE CAT LIST
				wp_set_post_terms( $POSTID, $categories, THEME_TAXONOMY );
			}
			 
			// SAVE THE CUSTOM DATA
			if(isset($data['custom']) && is_array($data['custom'])){ 	
			
			
				foreach($data['custom'] as $key => $val){ 
				 	
					// PASS ON SOME KEYS
					if($key == "listing_expiry_date" || $key == "listing_expiry_days" ){ continue; }
				
					// CLEAN SOME ATTRIBUTES
					if(substr($key,0,5) == "price"){
						$val = preg_replace('/[^\da-z.]/i', '', $val);
					}
				 	
					// SAVE DATA
					if($val == ""){
						delete_post_meta($POSTID, strip_tags($key));
					}elseif(is_array($val)){					 
						update_post_meta($POSTID, strip_tags($key), $val);
					}else{
						update_post_meta($POSTID, strip_tags($key), esc_html(strip_tags($val)));
					}
				}
				
				// EXPIRY DATE
				if(isset($data['custom']['listing_expiry_days']) && is_numeric($data['custom']['listing_expiry_days']) ){ 	
					// UPDATE EXPIRY DATE
					
					if($data['custom']['listing_expiry_days'] > 0 && $data['custom']['listing_expiry_days'] < 1){
					update_post_meta($POSTID, "listing_expiry_date", date("Y-m-d H:i:s", strtotime( date("Y-m-d H:i:s") . " +".$data['custom']['listing_expiry_days']." hours") ) );
					}else{
					update_post_meta($POSTID, "listing_expiry_date", date("Y-m-d H:i:s", strtotime( date("Y-m-d H:i:s") . " +".$data['custom']['listing_expiry_days']." days") ) );
					}
					
	
				}
				
				
			}
			
			// SAVE POST TAGS
			if(isset($data['form']['post_tags'])){
			 
			wp_set_post_tags( $POSTID, explode(",",strip_tags($data['form']['post_tags'])), false);		
			}
			 
			 
			// SAVE THE TAXONOMY DATA
			if(isset($data['tax']) && is_array($data['tax'])){ 		 
				foreach($data['tax'] as $key => $val){ 
				
					// REGISTER IF DOESNT EXIST
					if(!taxonomy_exists($key)){
					register_taxonomy( $key, 'listing_type', array( 'hierarchical' => true, 'labels' =>'', 'query_var' => true, 'rewrite' => true ) ); 
					}
										  
					// SAVE DATA
					$g = wp_set_post_terms( $POSTID, $val, $key );
			
				}
			}
			
		 
			// CHECK FOR FILE UPLOAD
			if(isset($_FILES['image']) && is_array($_FILES['image']) ){	 // && 
			 
				$u=0;
				foreach($CORE->reArrayFiles($_FILES['image']) as $file_upload){			
					if(strlen($file_upload['name']) > 1){
						if(isset($data['eid']) || $u == 0){
						$responce = hook_upload($POSTID, $file_upload,true);
						}else{
						$responce = hook_upload($POSTID, $file_upload);
						}
						if(isset($responce['error'])){
							$canContinue = false;			
							$errorMsg = $responce['error'];
						}// end if
						$u++;
					} // end if			
				} // end foeach
			} // end if
			
		
			// ADD-ON ATTRIBUTES FOR SOME THEMES 
			if(isset($data['attributes']) && is_array($data['attributes']) && !empty($data['attributes'])){
			update_post_meta($POSTID,"attributes",$data['attributes']);
			}else{
			update_post_meta($POSTID,"attributes","");
			}
 
			// YOUTUBE
			if(isset($data['youtube_id']) && strlen($data['youtube_id']) == 11  ){
				update_post_meta($POSTID, 'youtube_id', esc_attr( $data['youtube_id'] ) );
			}	
			
			// BUSINESS HOURS
			if(isset($data['startTime'])){	 
				$businesshours = array( 'start' => $data['startTime'], 'end' => $data['endTime'], 'active' => $data['isActive']  );
				update_post_meta($POSTID,"businesshours", $businesshours);				 
			}
			
			// ADD ON FOR MJ THEME
			if(THEME_KEY == "mj"){
			update_post_meta($POSTID, 'customextras', $data['customextras']);
			}
			 
			// IF IS NEW RETURN PAYMENT DATA
			if(isset($data['form']['totalprice']) && is_numeric($data['form']['totalprice']) && $data['form']['totalprice'] > 0 ){	
		
			
                $npaymentdat = array(  
				             
                "uid" => $userdata->ID,
                "order_id" => "LST-".$POSTID."-".rand(),                 
                "description" => __("Listing Payment","premiumpress"),
				
				"amount" => $data['form']['totalprice'],  
				
				"local_currency_amount" => $CORE->price_format_display( $payment_due ),
   				"local_currency_code" => $CORE->_currency_get_code(),
												
                ); 
				
				// ADD ON RECURRING
				if(_ppt('pak'.get_post_meta($POSTID, 'packageID',true)."_r") == 1){				
					$npaymentdat["recurring"] = "1";  
					$npaymentdat["recurring_days"] = _ppt('pak'.get_post_meta($POSTID, 'packageID',true)."_rdays"); 			
				}				
			
                $g = $CORE->order_encode($npaymentdat);
				die($g);
				
			}else{
			
				// REDIRECT LINK 	
				$redirect = get_permalink($POSTID);				
				
				die($redirect);
			}
			 
			 
			
		} break;
		
		
case "SaveRating": {
				
					// LOAD IN LANGUAGE
					 
					if(is_numeric($_POST['pid']) && is_numeric($_POST['value'])){
					// GET RATING IPS AND STOP THE USER FROM VOTING MULTIPLE TIMES
					$rated_user_ips = get_option('rated_user_ips');  $user_ip = $CORE->get_client_ip();
					if(!is_array($rated_user_ips)){ $rated_user_ips = array(); }
					
						if(isset($rated_user_ips[$_POST['pid']]) && isset($rated_user_ips[$_POST['pid']]['ips']) && in_array($user_ip, $rated_user_ips[$_POST['pid']]['ips']) ){							
							echo ''.__("You've Already Rated!","premiumpress");
							die();
							
						}elseif(isset($rated_user_ips[$_POST['pid']]) && isset($rated_user_ips[$_POST['pid']]['ips']) && !in_array($user_ip, $rated_user_ips[$_POST['pid']]['ips']) ){
						 
							$rated_user_ips[$_POST['pid']]['ips'] = array_merge($rated_user_ips[$_POST['pid']]['ips'],array("ip" => $user_ip, "rating" => $_POST['value']));
							update_option('rated_user_ips', $rated_user_ips); 
						}
						
					// GET RATING IPS
					$rated_user_ips = get_option('rated_user_ips');  $user_ip = $CORE->get_client_ip();
					if(!is_array($rated_user_ips)){ $rated_user_ips = array(); }
					if(isset($rated_user_ips[$user_ip])){ return; }else{ update_option('rated_user_ips', array_merge($rated_user_ips,array($user_ip))); }					 
					// GET EXISTING DATA
					$totalvotes = get_post_meta($_POST['pid'], 'starrating_votes', true);
					$totalamount = get_post_meta($_POST['pid'], 'starrating_total', true);
					if(!is_numeric($totalamount)){ $totalamount = $_POST['value']; }else{ $totalamount += $_POST['value']; }
					if(!is_numeric($totalvotes)){ $totalvotes = 1; }else{ $totalvotes++; }
					// WORK OUT RATING
					$save_rating = round(($totalamount/$totalvotes),2);
					// SAVE RESULTS
					update_post_meta($_POST['pid'], 'starrating', $save_rating);
					update_post_meta($_POST['pid'], 'starrating_total', $totalamount);
					update_post_meta($_POST['pid'], 'starrating_votes', $totalvotes);
					
					echo ''.__("Thank You!","premiumpress");
					die();
				 
					//echo $save_rating." <-- total votes:".$totalvotes." / total amount: ".$totalamount;
					}
				} break;
		
	
		case "load_mapdata": {		 
		 	//stripslashes($_POST['data']))
			
			 
			die($CORE->wlt_googlemap_data(1));
			
		} break;
	
		case "update_mylocaton": {
		
			/// SET USER LOCATION
			if(isset($_POST['address'])){
			 		
					$_SESSION['mylocation']['log'] = strip_tags($_POST['long']);
					$_SESSION['mylocation']['lat'] = strip_tags($_POST['lat']);
					$_SESSION['mylocation']['zip'] = strip_tags($_POST['zip']);
					$_SESSION['mylocation']['country'] = strip_tags($_POST['country']);
					$_SESSION['mylocation']['address'] = strip_tags($_POST['address']);
					$_SESSION['mylocation']['city'] = strip_tags($_POST['city']);
					 die("ok");
			}
			die("error");
		
		} break;
		
		case "get_location_states": {
		
		if(isset($GLOBALS['core_state_list'][$_POST['country_id']])){
			$states = explode("|",$GLOBALS['core_state_list'][$_POST['country_id']]);
			foreach($states as $state){
			?>
            <option value="<?php echo $state; ?>" <?php if($state == $_POST['state_id']){ echo "selected=selected"; } ?>><?php echo $state; ?></option>
            <?php
			}
		}
		
		die();
		
		} break;	
	
		case "SaveSession": { 
		global $CORE_CART;
				$table_data = $CORE_CART->cart_getitems();
				$wpdb->query("DELETE FROM ".$wpdb->prefix."core_sessions WHERE session_key = ('".session_id()."') LIMIT 1");	
				$wpdb->query("INSERT INTO ".$wpdb->prefix."core_sessions (`session_key` ,`session_date` ,`session_userid`, session_data) VALUES ('".session_id()."', '".date('Y-m-d H:i:s')."', '".$userdata->ID."', '".serialize($table_data)."')");
			 die();
		} break;			
		case "UpdateUserField":
		case "update_userfield": {
				
				if(isset($_POST['id']) && $_POST['id'] == "cartcomment"){
				   
					if($userdata->ID){
					
						$SQL = "SELECT * FROM ".$wpdb->prefix."core_sessions WHERE session_key = ('".strip_tags($_POST['key'])."') LIMIT 1";						 
						$hassession = $wpdb->get_results($SQL, OBJECT);					 
						if(!empty($hassession)){
						
							$cart_data 				= unserialize($hassession[0]->session_data);
							$cart_data['comments'] 	= stripslashes(strip_tags($_POST['value']));
							
							$wpdb->query("UPDATE ".$wpdb->prefix."core_sessions SET session_data = '".serialize($cart_data)."' WHERE session_key = ('".strip_tags($_POST['key'])."') LIMIT 1"); 
							
							die("UPDATE ".$wpdb->prefix."core_sessions SET session_data = '".serialize($cart_data)."' WHERE session_key = ('".strip_tags($_POST['key'])."') LIMIT 1");
							 
						} 
					
					}else{
					
						update_option('cartc_' . stripslashes(strip_tags($_POST['value'])) , stripslashes(strip_tags($_POST['key'])) );
					 
					} 
					
				}else{
					
					update_user_meta($_POST['id'], strip_tags($_POST['key']), strip_tags($_POST['value']));
			 
				}
				
				die();
							
		} break;
		
		case "server_time": {
		
			header("Cache-Control: no-cache, must-revalidate"); // HTTP/1.1 
			header("Expires: Fri, 1 Jan 2010 00:00:00 GMT"); // Date in the past 
			header("Content-Type: text/plain; charset=utf-8"); // MIME type 
			$now = new DateTime(); 
		 	die(json_encode(array("time" => $now->format("M j, Y H:i:s O")  )) );
		
		} break;
	
		case "contactform": {
		
		$canContinue = true;
		
		// SECURITY CODE
	 	if(_ppt('comment_captcha') == 1 && _ppt('google_recap_sitekey') != "" && isset($_POST['g-recaptcha-response']) ){		
			// CHECK GOOGLE CAP
			$canContinue = google_validate_recaptcha();
		}elseif(isset($_POST['code_value'])){
			// CHECK USER INPUT		
			if(strip_tags($_POST['code_value']) != strip_tags($_POST['contact_code']) ){
				$canContinue = false;
			}		
		}else{
			// STOP
			$canContinue = false;
		}
	 	
		// EMAIL CHECK
		if(!$canContinue){
						
			$GLOBALS['error_type'] = "error";
			$GLOBALS['error_title'] = __("Security Code Incorrect","premiumpress");
			$GLOBALS['error_message'] = __("The security code you entered was invalid or incorrect.","premiumpress");
						
		}elseif( !preg_match("/^[_a-z0-9-]+(.[_a-z0-9-]+)*@[a-z0-9-]+(.[a-z0-9-]+)*(.[a-z]{2,3})$/i", $_POST['contact_e1']) && $CORE->get_client_ip() != "error" ) {
				
			$GLOBALS['error_type'] = "error";
			$GLOBALS['error_title'] = __("Invalid Email Address","premiumpress");
			$GLOBALS['error_message'] = __("The email address you provided seems to be invalid.","premiumpress");
				 
		
		}elseif($canContinue){
		 
	 	 
							// SAVE MESSAGE
							$Message = "
							".__("Name","premiumpress").": ".strip_tags($_POST['contact_n1'])."\r\n
							".__("Email","premiumpress").": ".strip_tags($_POST['contact_e1'])."\r\n
							".__("Phone","premiumpress").": ".strip_tags($_POST['contact_p1'])." \r\n
							".__("Message","premiumpress").": ".strip_tags($_POST['contact_m1'])."\r\n
							".__("Link","premiumpress").": <a href='".get_permalink($_POST['pid'])."'>".get_permalink($_POST['pid'])."</a>\r\n"; 
						 
						 
							// GET POST DATA
							$post = get_post($_POST['pid']);				 
							if(!$userdata->ID){	$userid = 1;}else{	$userid = $userdata->ID; }
							$user_info = get_userdata($post->post_author);
							
							$my_post = array();
							$my_post['post_title'] 		= "RE:".$post->post_title;
							$my_post['post_content'] 	= $Message;
							$my_post['post_excerpt'] 	= "";
							$my_post['post_status'] 	= "publish";
							$my_post['post_type'] 		= "wlt_message";
							$my_post['post_author'] 	= $userid;
							$POSTID 					= wp_insert_post( $my_post );
							
							// ADD SOME EXTRA CUSTOM FIELDS
							add_post_meta($POSTID, "username", $user_info->user_login );	
							add_post_meta($POSTID, "userID", $user_info->ID);	
							add_post_meta($POSTID, "status", "unread" );
							add_post_meta($POSTID, "ref", get_permalink($_POST['pid']) );
			 
							// SEND EMAIL	
												 
							$_POST['message'] 		= $_POST['contact_m1'];
							$_POST['fullmessage'] 	= $Message;
							$_POST['phone'] 		= $_POST['contact_p1'];
							$_POST['email'] 		= $_POST['contact_e1'];
							//$_POST['name'] 		= $_POST['contact_n1']; <-- creates error, not sure why
							$_POST['link'] 		= get_permalink($_POST['pid']);							 
							
							$CORE->SENDEMAIL($post->post_author,'listingcontactform');
							 
							// ADD LOG ENTRY
							$CORE->ADDLOG("<a href='(ulink)'>".$userdata->user_nicename.'</a> used the listing contact form: <a href="(plink)"><b>['.$post->post_title.']</b></a>.', $userdata->ID, $_POST['pid'] ,'label-info');
							
							// SET FLAG
							$GLOBALS['contactformsent'] = true;
							 
							// LEAVE MSG
							$GLOBALS['error_type'] = "success";
							$GLOBALS['error_title'] = __("Message Sent","premiumpress");	
							$GLOBALS['error_message'] = __("Your message was sent, please allow 24/48 hours for a response.","premiumpress");	
								
			}
						 
					
		} break;
	
		case "newsletter_join" : {	
				
				  
				if( !preg_match("/^[_a-z0-9-]+(.[_a-z0-9-]+)*@[a-z0-9-]+(.[a-z0-9-]+)*(.[a-z]{2,3})$/i", $_POST['email']) && $CORE->get_client_ip() != "error" ) {
				
					$status =  "error";
				 
				}else{
				// ADD DATABASE ENTRY
				// CHECK IT DOESNT ALREADY EXIST
				$result = $wpdb->get_results("SELECT email_hash FROM ".$wpdb->prefix."core_mailinglist WHERE email = '".strip_tags($_POST['email'])."' ", ARRAY_A);
			 
				if(empty($result)){				
					$hash = md5($_POST['email'].rand());
					$SQL = "INSERT INTO ".$wpdb->prefix."core_mailinglist (`email`, `email_hash`, `email_ip`, `email_date`, `email_firstname`, `email_lastname`) 
					VALUES ('".strip_tags($_POST['email'])."', '".$hash."', '".$CORE->get_client_ip()."', now(), '', '');";			
					$wpdb->query($SQL);
				}else{
					$hash = $result[0]['email_hash'];
				}
				
				// BUILD LINK FOR EMAIL
				$_POST['link'] = get_home_url()."/confirm/mailinglist/".$hash;	
						 
				// SEND OUT CONFIRMATION EMAIL
				
				$ed = _ppt('mailinglist');				
				
				$subject = stripslashes($ed['confirmation_title']);
				$message = stripslashes($ed['confirmation_message']);
				$message = str_replace("(link)", $_POST['link'] , $message);				
				
				// SEND EMAIL
				$CORE->email_send($_POST['email'], $subject, $message);
				
				// PROVIDE USER MESSAGE
				$status = "ok";			
				}
				
				die(json_encode( array("status" => $status) ) );
				
		} break;
	
		case "listing_enhancements": {
		
			die($CORE->listing_enhancements($_POST['pid']));
		
		} break;
	
		case "listing_relist": {
			
			if(isset($_POST['pid']) && is_numeric($_POST['pid']) ){
			
				// GET REILIST PRICE
				$relist = $this->relist_price($_POST['pid']);
				
				// START DATE FOR RENEWAL encase
				// user is upgrading early
				$listing_expiry_date = get_post_meta($_POST['pid'],'listing_expiry_date',true); 
				if( strtotime($listing_expiry_date) < strtotime(current_time( 'mysql' ))  ){	
				$datenow = current_time( 'mysql' );
				}else{
				$datenow = $listing_expiry_date;
				}
		 		
				// WORK OUT HOW LONG TO UPGRADE FOR
				if(isset($relist['days']) && $relist['days'] > 0){ $extdasy = $relist['days']; }else{ $extdasy = 30; }
				
				if($relist['price'] > 0){
				
					// ADD NEW PAYMENT REQUEST TO LISTING
				
				
				}else{ 
				
					// UPGRADE LISTING FOR FREE
					if($relist['days'] == 0){
					
					} 
					
					hook_relist_listing_action($postid);
					
					// SAVE THE NEW DATE
					update_post_meta($_POST['pid'], 'listing_expiry_date', date("Y-m-d H:i:s", strtotime($datenow . " +".$extdasy." days"))); 
				
				}
				
				// RETURN MSG
				die(json_encode(array("status" => "ok")));
			
			}
		
		} break;
		
		case "listing_featured": {
		
			if(isset($_POST['pid']) && is_numeric($_POST['pid']) ){
			
				$featured = get_post_meta($_POST['pid'],'featured', true);
				
				if($featured == "yes"){
					update_post_meta($_POST['pid'],'featured',"no");
					die(json_encode(array("current" => "no")));
				}else{
					update_post_meta($_POST['pid'],'featured', "yes");
					die(json_encode(array("current" => "yes")));
				}
			
			}
		
		}
		case "listing_delete": {
		
			if(isset($_POST['pid']) && is_numeric($_POST['pid']) ){
				
				// CHECK THE POST AUTHOR AGAINST THE USER LOGGED IN
				$post_data = get_post($_POST['pid']); 
				if($post_data->post_author == $userdata->ID){
			 	
				
				$my_post = array();
				$my_post['ID'] 					= $_POST['pid'];
				$my_post['post_status']			= "trash";
				wp_update_post( $my_post  );
				// DELETE ALL ATTACHMENTS
				$CORE->UPLOAD_DELETEALL($_POST['pid']);
				
				// ADD LOG ENTRY
				$CORE->ADDLOG("Listing Deleted", $userdata->ID, $_POST['pid'], get_the_title($_POST['pid']), "listing", $_POST['id'] );
				
				// ERROR MESSAGE
				die(json_encode(array("status" => "ok")));
				
				}else{
				
				die(json_encode(array("status" => "error")));
					
				}
				
			} // end if
			
			return false;	
		
		} break;
		case "check_couponcode": {
			
			// CHECK
			if(!isset($_POST['code']) || ( isset($_POST['code']) && $_POST['code'] == "") ){ return 0; }
		 	
			$wlt_coupons = get_option("wlt_coupons");
			 
			// CHECK WE HAVE SUCH A CODE
			if(is_array($wlt_coupons) && count($wlt_coupons) > 0 ){
				foreach($wlt_coupons as $key => $field){
					if($_POST['code'] == $field['code']){	
						
						
						// UPDATE USED COUNTER
						if(!isset($wlt_coupons[$key]['used'])){ 
							$wlt_coupons[$key]['used'] = 1; 
						}else{ 
							$wlt_coupons[$key]['used'] = $wlt_coupons[$key]['used']+1; 
						}
					 
				 		
						// WORK OUT DISCOUNT AMOUNT
						$discount = $field['discount_percentage'];
						if($discount != ""){													   						
							$dc = str_replace(",","",$_POST['amount'])/100*$discount;							
						}else{
							$dc = $field['discount_fixed']; 
						}
						
						 
						$amount = intval(strval($_POST['amount'])) - intval(strval($dc));
						
						
						$rr = 0;
						$rd = 0;
						
						if(isset($_POST['recurring']) && is_numeric($_POST['recurring'])){
						$rr = $_POST['recurring'];
						}
						if(isset($_POST['recurring_days']) && is_numeric($_POST['recurring_days'])){
						$rd = $_POST['recurring_days'];
						}
						 
						$cartdata = array(
							"uid" 			=> $userdata->ID, 
							"amount" 		=> $amount,
							"order_id" 		=> $_POST['orderid'],
							"description" 	=> $_POST['desc'],	
							"couponcode" 	=> $_POST['code'],
							"old_amount"	=> strval($_POST['amount']),
							"recurring" 	=> $rr,
							"recurring_days" => $rd,												
						);
						
						// UPDATE COUNTER
						 update_option("wlt_coupons", $wlt_coupons);	
						
						
						// REPORT AJAX
						header('Content-type: application/json');
						$n = array("total" => hook_price($amount), "total_value" => $amount, "code" => $CORE->order_encode($cartdata), "old_amount"	=> strval($_POST['amount']), );
						echo json_encode($n);
						die();
						 				 				 
					}			
				} // end foreach
							 
			} // end if				
				

		  
			
			die(0);
		
		} break;
		case "load_new_payment_form_recalculate": {
			
			if(isset($_POST['details'])){
			 	 
				// DECODE DATA
				$data = array();
				$data = $CORE->order_decode($_POST['details']);
				$data->amount = $_POST['amount'];
				if(isset($_POST['orderid'])){
				$data->order_id = $_POST['orderid'];
				}
				echo $CORE->order_encode($data);
		 			
			}
			
			die();
		
		} break;
		
		case "load_new_payment_form": {
			
			if(isset($_POST['details'])){		
				
				if(isset($_POST['smallform'])){ $sm = 1; }else{ $sm = 0; }
		 	
				echo $CORE->payment_setup($_POST['details'], $sm );			
			}
			
			die();
		
		} break;
		
		case "load_payment_form": {
		
		die('user load_new_payment_form');
		 
		
		} break;
		
		case "validateexpiry":  
		case "expire_check_listing": {
		
			die($CORE->expire_listing($_POST['pid']));			
			
		} break; 
	
		case "addfeedback": {
		
	 	 
	 		// MAKE SURE THE AUTHOR ID IS SET
			if(!is_numeric($_POST['uid'])  ){ return; }
			 		
					// ADD THE FEEDBACK
					$my_post = array();
					$my_post['post_title'] 		= strip_tags(strip_tags($_POST['subject']));
					$my_post['post_content'] 	= strip_tags(strip_tags($_POST['message']));
					$my_post['post_excerpt'] 	= "";
					$my_post['post_status'] 	= "publish";
					$my_post['post_type'] 		= "wlt_feedback";
					$my_post['post_author'] 	= $userdata->ID;
					$POSTID 					= wp_insert_post( $my_post );
					
					// ADD UP ALL THE STARS
					// DEVIDE THEM BY 5
					// MULTIPLY BY 100
					
					$score = round( ( $_POST['rating1']+$_POST['rating2']+$_POST['rating3']+$_POST['rating4'] ) / 4 ,2);
					
					// SAVE COMMEN META INCASE WE DELETE IT
					add_post_meta($POSTID, 'ratingtotal', $score );
					add_post_meta($POSTID, 'rating1', $_POST['rating1'] );
					add_post_meta($POSTID, 'rating2', $_POST['rating2'] );
					add_post_meta($POSTID, 'rating3', $_POST['rating3'] );
					add_post_meta($POSTID, 'rating4', $_POST['rating4'] );					
					
					if(isset($_POST['pid']) && is_numeric($_POST['pid'])){
					
					add_post_meta($POSTID, "uid", $_POST['uid']);
					add_post_meta($POSTID, "pid", $_POST['pid']);
					add_post_meta($POSTID, 'ratingpid', $_POST['pid'] );	
					
						// UPDATE THE LIST ITSELF WITH A TOTAL ASLO
						$totalvotes = get_post_meta($_POST['pid'], 'starrating_votes', true);
						$totalamount = get_post_meta($_POST['pid'], 'starrating_total', true);
						
						if(!is_numeric($totalamount)){ $totalamount = $score; }else{ $totalamount += $score; }
						if(!is_numeric($totalvotes)){ $totalvotes = 1; }else{ $totalvotes++; }	
						 
						$save_rating = round(($totalamount/$totalvotes),2);
					
						update_post_meta($_POST['pid'], 'starrating', $save_rating);
						update_post_meta($_POST['pid'], 'starrating_total', $totalamount);
						update_post_meta($_POST['pid'], 'starrating_votes', $totalvotes); 						
						
					}					
					
					 
					// CUSTOM FIELDS
					if(isset($_POST['orderid'])){
					add_post_meta($POSTID, "orderid", $_POST['orderid']);					
					} 
				 
					// EXTRAS FOR THEME CHANGES
					if(isset($_POST['extraid']) && $_POST['extraid'] != "" ){					
					add_post_meta($_POST['extraid'], "feedback_date", date("Y-m-d H:i:s")); // ADS THE FEEDBAK  ADDED DATE TO THE LISTING
					}
				  
					// SEND EMAIL
					$_POST['title'] 	= $my_post['post_title'];
					$_POST['link'] 		= get_author_posts_url( $_POST['uid'] );
					$CORE->SENDEMAIL($_POST['uid'],'newfeedback');	
				 	
					// ADD LOG ENTRY					 
					$CORE->ADDLOG("Feedback Added", $userdata->ID, $POSTID, "", "feedback", $_POST['uid'] );		 		 	
		 	 
		
		} break;
		
	
	case "delfeedback": {	
		
		// CHECK FEEDBACK BELONGS TO THIS USER?
		
		wp_delete_post( $_POST['fid'], true);
		
		// DELETE ALL FEEDBACK WITH THIS REPLY ID
		
		$args = array(
			'post_type' => 'wlt_feedback',
			'posts_per_page'	=> '150',
			'meta_query' => array(
					 
					array(
						'key'		=> 'replyid',
						'value' 	=> $_POST['fid'],
						'compare' 		=> '=',
					),
					 
				),
		);
		$query1 = new WP_Query($args); 
		$data = $query1->posts;
		// GET USER FEEDBACK
		if(!empty($data)){  foreach($data as $post){
			wp_delete_post( $post->ID, true);		
		}}
		
		// LEAVE MESSAGE FOR THE USER
		$GLOBALS['error_message'] 	= __("Feedback Deleted","premiumpress");
			
	
	} break;
	
	case "sellspace_set": {
		
		if(!is_numeric($_POST['cid'])){ return; }
	
		// SET NEW BANNER ID
		update_post_meta($_POST['cid'], 'bannerid', esc_attr($_POST['bannerid']));
		
		// UPDATE LINK
		update_post_meta($_POST['cid'], 'url', esc_attr($_POST['camurl']) ); 
		
		// IF THE EXISTING VALUE IS BLANK THEN LETS ASUME THIS IS THE FIRST TIME WE'VE UPLOAD
		// SO WE SHOULD START THE ADVERTISING PERIOD FROM NOW ON
		
		$timeleft = get_post_meta($_POST['cid'], 'listing_expiry_date', true);
		if($timeleft == ""){
			$campaign = get_post_meta($_POST['cid'], 'campaign', true);
			$DAYS = $sellspacedata[$campaign."_days"];
			if($DAYS == ""){ $DAYS = 30; }
			$sellspacedata = $GLOBALS['CORE_THEME']['sellspace']; 
			update_post_meta( $_POST['cid'], 'listing_expiry_date', date("Y-m-d H:i:s", strtotime( date("Y-m-d H:i:s") . " +".$DAYS." days")) );
		}
		
		// MSG
		$GLOBALS['error_message'] = __("Banner Set Successfully","premiumpress")."<script>jQuery(document).ready(function() { jQuery('#MyAccountBlock').hide();jQuery('#MyAdvertising').show(); jQuery('#SellSpaceTabs a[href=\"#a3\"]').tab('show'); });</script>";
	
	} break;
	
	case "sellspace_delete": { 
		
		// DELETE FILES
		@unlink(get_post_meta($_POST['delid'],'path', true));
			 
		// NOW LETS SAVE THE NEW ONE	
		wp_delete_post( $_POST['delid'], true );
		
		// MSG
		$GLOBALS['error_message'] = __("Banner Deleted Successfully","premiumpress")."<script>jQuery(document).ready(function() { jQuery('#MyAccountBlock').hide();jQuery('#MyAdvertising').show(); jQuery('#SellSpaceTabs a[href=\"#a2\"]').tab('show');  });</script>";
	
	
	} break;
	
	case "sellspace": {
	
	$GLOBALS['error_message']= "";
		 
		if(is_array($_FILES['wlt_banner'])){
			$i = 0;
			foreach($_FILES['wlt_banner'] as $banner){
			 
			if(!isset($_FILES['wlt_banner']['name'][$i]) || ( isset($_FILES['wlt_banner']['name'][$i]) && $_FILES['wlt_banner']['name'][$i] == "") ){ $i++; continue; }
			 
				if(in_array($_FILES['wlt_banner']['type'][$i], array('image/jpg','image/jpeg','image/png', 'image/gif') ) ){
					
					// INCLUDE UPLOAD SCRIPTS
					$dir_path = str_replace("wp-content","",WP_CONTENT_DIR);
					if(!function_exists('wp_handle_upload')){
					require $dir_path . "/wp-admin/includes/file.php";
					}
					
					// GET WORDPRESS UPLOAD DATA
					$uploads = wp_upload_dir();
					
					// UPLOAD FILE 
					$file_array = array(
						'name' 		=> $_FILES['wlt_banner']['name'][$i], //$userdata->ID."_userphoto",//
						'type'		=> $_FILES['wlt_banner']['type'][$i],
						'tmp_name'	=> $_FILES['wlt_banner']['tmp_name'][$i],
						'error'		=> $_FILES['wlt_banner']['error'][$i],
						'size'		=> $_FILES['wlt_banner']['size'][$i],
					);
					//die(print_r($file_array));
					$uploaded_file = wp_handle_upload( $file_array, array( 'test_form' => FALSE ));
				 
					// CHECK FOR ERRORS
					if(isset($uploaded_file['error']) ){		
						$GLOBALS['error_message'] .= $uploaded_file['error'];
					}else{
					
					// GET SIZES
					list($width, $height) = getimagesize($uploaded_file['file']);
					 
					$my_post = array();
					$my_post['post_title'] 		= strip_tags($_FILES['wlt_banner']['name'][$i]);
					$my_post['post_content'] 	= $width."X".$height."=".$_FILES['wlt_banner']['size'][$i];
					$my_post['post_excerpt'] 	= $uploaded_file['url'];
					$my_post['post_status'] 	= "publish";
					$my_post['post_type'] 		= "wlt_banner";
					$my_post['post_author'] 	= $userdata->ID;
					$POSTID 					= wp_insert_post( $my_post );
					
					// ADD CUSTOM FIELDS
					add_post_meta($POSTID,'img', $uploaded_file['url']);	
					add_post_meta($POSTID,'path', $uploaded_file['file']);
					add_post_meta($POSTID,'size', $_FILES['wlt_banner']['size'][$i]);
					add_post_meta($POSTID,'width', $width);
					add_post_meta($POSTID,'height', $height);
					
					}
					
					$i++;
					
				}else{
				$GLOBALS['error_message'] .= __("File Type Invalid","premiumpress")." (".$_FILES['wlt_banner']['name'][$i].")<br>";
				}
			}
		}
		
		// MSG
		if($GLOBALS['error_message'] == ""){
		$GLOBALS['error_message'] = __("Banners Saved Successfully","premiumpress");
		}
		
		$GLOBALS['error_message'] .= "<script>jQuery(document).ready(function() { jQuery('#MyAccountBlock').hide();jQuery('#MyAdvertising').show(); jQuery('#SellSpaceTabs a[href=\"#a2\"]').tab('show');   });</script>";
	
	
	} break;
	
	case "withdraw": {
	
		if(is_numeric($_POST['amount']) && $_POST['amount'] > 0){
		 
			$subject  = __("[IMPORTANT] Payment Withdrawal Request","premiumpress");
			$msg 	 .= "Username: ".$userdata->display_name."\r\n";
			$msg 	 .= "User ID: ".$userdata->ID."\r\n";
			$msg 	 .= "Email: ".$userdata->user_email."\r\n";
			$msg 	 .= "Amount: ".hook_price($_POST['amount'])."\r\n";
			$msg 	 .= "Preferences: ".$_POST['message']."\r\n";
	 
			// SAVE A COPY TO THE DATABASE
			
			$SQL = "INSERT INTO `".$wpdb->prefix."core_withdrawal` (
			`user_id` ,
			`user_ip` ,
			`user_name` ,
			`datetime` ,
			`withdrawal_comments` ,
			`withdrawal_status` ,
			`withdrawal_total`
			)
			VALUES ('".$userdata->ID."',  '".$CORE->get_client_ip()."',  '".$userdata->user_login."',  '".date('Y-m-d H:i:s') ."',  '".strip_tags($_POST['message'])."',  '0',  '".strip_tags($_POST['amount'])."')";
			
			$wpdb->query($SQL);
			 
			// SEND EMAIL TO ADMIN
			$CORE->SENDEMAIL('admin','custom',$subject,$msg);
			
			$GLOBALS['error_message'] 	= __("Thank You. Your request has been sent.","premiumpress");	
		}	
	
	} break;
 
	
	case "deletemsgs": {
 		
		if(isset($_POST['check']) && is_array($_POST['check']) ){
		
			foreach($_POST['check'] as $msgid){
			
			update_post_meta($msgid,'status','delete');
		
			}
			
			$GLOBALS['error_message'] 	= __("Message Deleted","premiumpress")."<script>jQuery(document).ready(function() { jQuery('#MyAccountBlock').hide();jQuery('#MyMsgBlock').show(); });</script>";
	 
		}
	 	
		
	} break;
	case "deletemsg": {
 
	 	update_post_meta($_POST['messageID'],'status','delete');
		
		$GLOBALS['error_message'] 	= __("Message Deleted","premiumpress")."<script>jQuery(document).ready(function() { jQuery('#MyAccountBlock').hide();jQuery('#MyMsgBlock').show(); });</script>";	
	 
	} break;
	
	case "sendmsg": {
		
		$dd = get_user_by( 'login',  $_POST['username'] );
		 
		// ADDED TO FIX HYPEN USERNAMES
		if($dd == ""){
		$dd = get_user_by( 'login',  str_replace("-"," ",$_POST['username']) );	
		}
 
		if(!isset($dd->ID)){
		
			$GLOBALS['error_type'] 		= "error"; //ok,warn,error,info
			$GLOBALS['error_message'] 	= __("Username not found","premiumpress"); 
			
		}elseif(isset($dd->ID)){	

			// CHECK HOW MANY MESSAGES HAVE BEEN SENT ALREADY FROM THIS USER
			$SQL = "SELECT count(*) AS total FROM $wpdb->posts WHERE post_type = 'wlt_message' AND post_author = '".$userdata->ID."' AND post_date LIKE ('".date("Y-m-d")."%')";	
			$found = (array)$wpdb->get_results($SQL);
 
			if($found[0]->total < 20 ){ // LIMIT 10 PER DAY
		 
				$my_post = array();
				$my_post['post_title'] 		= strip_tags(strip_tags($_POST['subject']));
				$my_post['post_content'] 	= strip_tags(strip_tags($_POST['message']));
				$my_post['post_excerpt'] 	= "";
				$my_post['post_status'] 	= "publish";
				$my_post['post_type'] 		= "wlt_message";
				$my_post['post_author'] 	= $userdata->ID;
				$POSTID 					= wp_insert_post( $my_post );
				
				add_post_meta($POSTID, "username", $dd->user_login);	
				add_post_meta($POSTID, "userID", $dd->ID);
				add_post_meta($POSTID, "status", "unread");
				 
			  
				$GLOBALS['error_type'] 		= "success"; //ok,warn,error,info
				$GLOBALS['error_title'] 	= __("Message Sent!","premiumpress");
				$GLOBALS['error_message'] 	= __("Your message has been sent successfully.","premiumpress");
				
				// SEND EMAIL
				$_POST['username'] = $dd->display_name;
				$_POST['from_username'] = $userdata->display_name; 
				 
				$CORE->email_system($dd->ID, 'msg_new', $args = array() );
				
				// CLEAR MESSSAGE VALUES
				$_POST['subject'] = "";
				$_POST['message'] = "";
				
				$GLOBALS['showmesgbox']= 1;
				
			}else{
			
				$GLOBALS['error_type'] 		= "error"; //ok,warn,error,info
				$GLOBALS['error_title'] 	= __("Too Many Messages Sent","premiumpress");
				$GLOBALS['error_message'] 	= __("We have detected your've sent too many messages within a short period of time. Please wait 24 hours to send more messages..","premiumpress");
				
				$GLOBALS['showmesgbox']=1;
			}
		} 	
		
	} break;
	
	case "userupdatephoto": {
			
			// UPLOAD USER PHOTO			 
			if(isset($_FILES['wlt_userphoto']) && strlen($_FILES['wlt_userphoto']['name']) > 2 && in_array($_FILES['wlt_userphoto']['type'],$CORE->allowed_image_types) ){
				
				
				// LOAD IN WORDPRESS FILE UPLOAOD CLASSES
				$dir_path = str_replace("wp-content","",WP_CONTENT_DIR);
				if(!function_exists('get_file_description')){
				if(!defined('ABSPATH')){
				require $dir_path . "/wp-load.php";
				}
				require $dir_path . "/wp-admin/includes/file.php";
				require $dir_path . "/wp-admin/includes/media.php";	
				}
				if(!function_exists('wp_generate_attachment_metadata') ){
				require $dir_path . "/wp-admin/includes/image.php";
				}				 
				
				// GET WORDPRESS UPLOAD DATA
				$uploads = wp_upload_dir();
				
				// UPLOAD FILE 
				$file_array = array(
					'name' 		=> $_FILES['wlt_userphoto']['name'], //$userdata->ID."_userphoto",//
					'type'		=> $_FILES['wlt_userphoto']['type'],
					'tmp_name'	=> $_FILES['wlt_userphoto']['tmp_name'],
					'error'		=> $_FILES['wlt_userphoto']['error'],
					'size'		=> $_FILES['wlt_userphoto']['size'],
				);
				
				$uploaded_file = wp_handle_upload( $file_array, array( 'test_form' => FALSE ));	  
				// CHECK FOR ERRORS
				if(isset($uploaded_file['error']) ){		
					$GLOBALS['error_message'] = $uploaded_file['error'];
				}else{
				
				// set up the array of arguments for "wp_insert_post();"
				$attachment = array(			 
					'post_mime_type' => $_FILES['wlt_userphoto']['type'],
					'post_title' => preg_replace('/\.[^.]+$/', '', basename( $file['name'] ) ),
					'post_content' => '',
					'post_author' => $userdata->ID,
					'post_status' => 'inherit',
					'post_type' => 'attachment',
					'post_parent' => 0,
					'guid' => $uploaded_file['url']
				);									
				
				// insert the attachment post type and get the ID
				$attachment_id = wp_insert_post( $attachment );
		
				// generate the attachment metadata
				$attach_data = wp_generate_attachment_metadata( $attachment_id, $uploaded_file['file'] );
				 
				// update the attachment metadata
				$rr = wp_update_attachment_metadata( $attachment_id,  $attach_data );
				
				if(isset($attach_data['sizes']['thumbnail']['file'])){
					$thumbnail = $uploads['url']."/".$attach_data['sizes']['thumbnail']['file'];
				}else{
					$thumbnail = $uploaded_file['url'];
				}	
					
			 	 
				// NOW LETS SAVE THE NEW ONE	
				update_user_meta($userdata->ID, "userphoto", array('img' =>$thumbnail, 'path' => $uploaded_file['file'] ) );
				
				}
			}
			
			$GLOBALS['error_message'] = __("Profile Data Updated","premiumpress");
	
	} break;
	
	case "userupdatepass": { 
	
	
			// CHECK IF WE ARE CHANGING PASSWORDS	
			if(!defined('WLT_DEMOMODE')){	 
				if( ( $_POST['password'] == $_POST['password_r'] ) && $_POST['password'] !=""){
					
					$data = array();
					$data['user_pass'] 		= $_POST['password'];					
					$data['ID'] 			= $userdata->ID;
					wp_update_user( $data );	
						
					// ERROR MESSAGE
					$GLOBALS['error_message'] = __("Account Updated","premiumpress");
					
				} elseif(isset($_POST['password']) && strlen($_POST['password']) > 1){	
						
					// PASSWORD CHECK ERROR
					$GLOBALS['error_message'] = __("New Password Invalid","premiumpress");
					
				}else{
					// ERROR MESSAGE
					$GLOBALS['error_message'] = __("Profile Data Updated","premiumpress");
				}
				

				
			}// end if
		
	
	} break;
	
	case "userupdate": { 
	 
			// SAVE THE CUSTOM PROFILE DATA
			if(isset($_POST['custom']) && is_array($_POST['custom'])){ 	
	
				foreach($_POST['custom'] as $key => $val){
				
					if($val == ""){					
						delete_user_meta($userdata->ID, strip_tags($key));
					}elseif(is_array($val)){
						update_user_meta($userdata->ID, strip_tags($key), $val);
					}else{					
						update_user_meta($userdata->ID, strip_tags($key), esc_html(strip_tags($val)));					
					}
				} // end foreach
			}// end if
			
			$data = array();
			$data['ID'] 			= $userdata->ID;

			
			// CHECK EMAIL IS VALID			
			update_user_meta($userdata->ID, 'url', strip_tags($_POST['url']));
			update_user_meta($userdata->ID, 'phone', strip_tags($_POST['phone']));
			
			// SOCIAL
			update_user_meta($userdata->ID, 'facebook', strip_tags($_POST['facebook']));
			update_user_meta($userdata->ID, 'twitter', strip_tags($_POST['twitter']));
			update_user_meta($userdata->ID, 'linkedin', strip_tags($_POST['linkedin']));
			update_user_meta($userdata->ID, 'skype', strip_tags($_POST['skype']));
			
			// PROFILE BG
			if(isset($_POST['pbg'])){
			update_user_meta($userdata->ID, 'pbg', strip_tags($_POST['pbg']));			
			}
			
			// ADDRESS
			
			update_user_meta($userdata->ID, 'address1', strip_tags($_POST['address1']));
			update_user_meta($userdata->ID, 'address2', strip_tags($_POST['address2']));
			update_user_meta($userdata->ID, 'zip', strip_tags($_POST['zip']));
			
			update_user_meta($userdata->ID, 'country', strip_tags($_POST['country']));
			update_user_meta($userdata->ID, 'city', strip_tags($_POST['city']));

			// MOBILE
			if(isset($_POST['mobile']) && is_numeric($_POST['mobile'])){
			update_user_meta($userdata->ID, 'mobile', strip_tags($_POST['mobile']) );
			}
			
			// PAYPAL DETAILS
			update_user_meta($userdata->ID, 'payment_type', strip_tags($_POST['payment_type']) );
			update_user_meta($userdata->ID, 'paypal', strip_tags($_POST['paypal']) );			
			update_user_meta($userdata->ID, 'bank', strip_tags($_POST['bank']) );
			update_user_meta($userdata->ID, 'payaddresss', strip_tags($_POST['payaddresss']) );
			if(isset($_POST['stripeid'])){
			update_user_meta($userdata->ID, 'stripeid', strip_tags($_POST['stripeid']) );
			}
			
			// EXTRA
			$data['first_name'] 		= strip_tags($_POST['fname']);
			$data['last_name'] 			= strip_tags($_POST['lname']);
		 	$data['description'] 		= strip_tags($_POST['description']);		
			
			wp_update_user( $data );			
			
			// FUNCTION FOR PLUGINS
			//do_action('profile_update');
			hook_account_update();
			
			$GLOBALS['error_message'] = __("Details Saved Successfully","premiumpress");
		
		} break;
		
		default: {
		
		hook_account_save();
		
		} break;
	
} // end switch	
	
	


if(isset($_GET['claime']) && is_numeric($_GET['claime']) ){

	// CHECK IF THE USER HAS CLAIMED ANY LISTINGS BEFORE
	if(get_user_meta($userdata->ID, "claimed_listing",true) == ""){
		// ALLOW CLAIM
		$my_post = array();
		$my_post['ID'] 					= $_GET['claime'];
		$my_post['post_status']			= "publish";
		$my_post['post_author']			= $userdata->ID;	
		wp_update_post( $my_post  );
		// ADD CUSTOM FIELD SO WE KNOW IT WAS CLAIMED
		$_POST['title'] = get_the_title($_GET['claime']);
		// SET USER FLAG
		update_user_meta($userdata->ID, "claimed_listing", $_GET['claime']);
		// REMOVE CLAIM
		$CORE->email_system('admin','admin_newclaim');
		// ADD LOG ENTRY
		$CORE->ADDLOG("<a href='(ulink)'>".$userdata->user_nicename.'</a> claimed listing <b>['.get_the_title($_GET['claime']).']</b>', $userdate->ID,$_GET['claime'],'label-important');
		
		
		
	// ERROR MESSAGE
	$GLOBALS['error_message'] = __("<h4>Thank You</h4> This listing has now been assigned to your account.","premiumpress");
	}else{
	
	// ADD LOG ENTRY
	$CORE->ADDLOG("<a href='(ulink)'>".$userdata->user_nicename.'</a> tried to claim listing <b>['.get_the_title($_GET['claime']).']</b> but was denied! (too many claims)', $userdate->ID,$_GET['claime'],'label-info');
		
	$GLOBALS['error_message'] = __("<h4>Too Many Claims!</h4> Our system shows you have already claimed a listing before. <br/>Please contact our management team if you wish to claim any further listings.","premiumpress");
	$GLOBALS['error_type'] = "error";
	}	
	
}
	
	

} // end ajax

}














function _ajax_calls(){ global $wpdb, $post, $userdata, $CORE;


if(isset($_POST['wlt_ajax'])){

	switch($_POST['wlt_ajax']){
	
		case "mapdata": {

			$data =	$CORE->wlt_googlemap_data();
			header('Content-type: application/json');
			$n = array("mapdata" => $data );
			echo json_encode($n);
			die();
		
		} break; 
				
		/***
		
		desc: Category selection tool for listing page
		updated: 23rd July 2014
		
		***/
		case "cats": {
		
		$json = array();		
		if(!is_array($_POST['category']) || ( is_array($_POST['category']) && empty($_POST['category']) )){	
		$json[] = '{"id" : "hide"}'; 
		}else{
		
		// CATEGORY PRICE
		$current_catprices = get_option('wlt_catprices'); $price = "";
		
		foreach($_POST['category'] as $cat){
			// ARGS
			$args = array(
			'taxonomy'                 => THEME_TAXONOMY,
			'child_of'                 => $cat,
			'hide_empty'               => 0,
			'hierarchical'             => false,
			'exclude'                  => 0);
			// QUERY CATS
			$cats  = get_categories( $args ); 
			 
			// CHECK FOR VALID DATA
			if(is_array($cats) && !empty($cats)){		
				// SELECTED VALUES
				$selcats = explode(",",$_POST['selected']);
				// LOOP
				foreach($cats as $data){				
					//SKIP IF NOT SAME PARENT
					if($cat != $data->parent){ continue; }
					// SELECED
					if(in_array($data->term_id,$selcats)){ $sel = "selected=selected"; }else{ $sel = ""; }
					// SHOW PRICE
					if(isset($current_catprices[$data->term_id]) 
					&& ( isset($current_catprices[$data->term_id]) && is_numeric($current_catprices[$data->term_id]) && $current_catprices[$data->term_id] > 0 ) ){ 
						$price = " (".hook_price($current_catprices[$data->term_id]).')'; 
					}
					// BUILD JASON STRING
					$json[] = '{"id" : "'.$data->term_id.'", "text" : "'.$data->name.$price.'", "sel" : "'.$sel.'"}'; 
				}// end foreach	
			}else{		
				$json[] = '{"id" : "hide"}'; 		
			}
		}// end foreach	
		}	
		// OUTPUT	
		echo '[' . implode(',', $json) . ']'; 
		die();				  
      
		} break;
	
	
	
	
	} // end switch

}// end if


if(isset($_GET['core_aj']) && $_GET['core_aj'] == 1){

	
	switch($_GET['action']){
	
		case "locationform": {
		
			get_template_part( 'ajax-modal', 'location' );
			
			die();		
		
		} break;
			
		case "loginform": {
		
			get_template_part( 'ajax-modal', 'login' );
			
			die();		
		
		} break;
		
		
		case "searchform": {
		
			get_template_part( 'ajax-modal', 'search' );
			
			die();		
		
		} break;
		
		case "ratingform": {
			
			get_template_part( 'ajax-modal', 'rating' );
			
			die();		
		
		} break;
		
		case "registerform": {
		
			get_template_part( 'ajax-modal', 'register' );
			
			die();		
		
		} break;
	
		case "extraform": {
		
			get_template_part( 'ajax-modal', 'extra' );
			
			die();		
		
		} break;		
				case "showadvancedsearch": {
				
					// LOAD IN LANGUAGE
						
				global $ADSEARCH;
				 
				  echo $ADSEARCH->build_form( null, true ); 
				
				} break;
			
				case "ajaxvideobox": {
				
				if(isset($_GET['pid']) && is_numeric($_GET['pid']) ){
				
					
					if($_GET['f'] == "Youtube_link"){
					// CHECK IF YOUTUBE LINK IS PRESENT
					$youtubelink = get_post_meta($_GET['pid'],$_GET['f'],true);
					
					$youid = explode("v=",$youtubelink);
					$thisid = explode("&",$youid[1]);
					echo '<div id="wlt_videobox_ajax_'.$_GET['pid'].'_active">
					
					<div class="hidden-sm hidden-xs videobox'.$_GET['pid'].'">
						<video width="640" height="360" preload="none" style="width: 100%; height: 100%;" autoplay="true">
						<source type="video/youtube" src="'.$youtubelink.'" />				 				 
						</video>
					</div>
					
					<div class="visible-sm visible-xs">
						<iframe style="width:100%; height:100%;" src="//www.youtube.com/embed/'.$thisid[0].'" frameborder="0" allowfullscreen></iframe>
					</div>
					
					</div>';
					
					}else{
					
					echo '<div id="wlt_videobox_ajax_'.$_GET['pid'].'_active" class="videobox'.$_GET['pid'].'">
					
					<video width="100%" height="500" style="width: 100%; max-height: 500px;" controls="controls" preload="none" autoplay="true">
					<source type="'.$_GET['t'].'" src="http://'.$_GET['f'].'" />
					 
						<object width="100%" height="300" style="width: 100%; height: 100%;" type="application/x-shockwave-flash" data="'.get_template_directory_uri().'/framework/slider/flashmediaelement.swf">
							<param name="movie" value="'.get_template_directory_uri().'/framework/slider/flashmediaelement.swf" />
							<param name="flashvars" value="controls=true&file=http://'.$_GET['f'].'" />	
						</object>
						
					</video>
					
					</div>';
			
					}
				
				}
				
				} break;
				
				 
				
				case "suggest": { 
				if(!isset($_GET['qq'])){ return; }
				if(!current_user_can('administrator')){ return; }
				$querystr = "SELECT $wpdb->posts.* FROM $wpdb->posts, $wpdb->postmeta 
				WHERE $wpdb->posts.ID = $wpdb->postmeta.post_id 
				AND ( $wpdb->posts.ID LIKE '%".strip_tags(trim(htmlentities($_GET['qq'])))."%'  OR
				 $wpdb->posts.post_title LIKE '%".strip_tags(trim(htmlentities($_GET['qq'])))."%' )
				AND $wpdb->posts.post_status = 'publish' 
				AND $wpdb->posts.post_type = '".THEME_TAXONOMY."_type'
				GROUP BY $wpdb->posts.ID LIMIT 5";
				$results = $wpdb->get_results($querystr, OBJECT);
				
				/* Get the data into a format that Smart Suggest will read (see documentation). */
				$data = array('header' => array(), 'data' => array());
				$data['header'] = array('title' => 'Matching Products',	'num' => 10,	'limit' => 5	);
				 
				foreach ($results as $result)
				{
					if(isset($_GET['option']) && $_GET['option'] == 1){
					$data['data'][] = array(
					'primary' => $result->post_title,																						
					'secondary' => substr($result->post_excerpt,0,80)."..",														
					'image' => $CORE->GETIMAGE($result->ID,false,array("pathonly" => true)),																			
					'onclick' => "var select = document.getElementById('".$_GET['boxid']."');select.options[select.options.length] = new Option('".htmlentities(strip_tags(str_replace("'","",$result->post_title)))."', '".$result->ID."',true,true);",	
					'fill_text' => ""	
					);
					}
					
				}
				$final = array($data);header('Content-type: application/json');echo json_encode($final);die();
				} break;
				
				
			

				
				
				case "CatPrice": {
				if(!is_numeric($_GET['cid'])){ die(); }
				$current_catprices = get_option('wlt_catprices'); $cprice = "";
				if(!is_array($current_catprices)){ $current_catprices = array(); }
				if(isset($current_catprices[$_GET['cid']])){  $cprice = $current_catprices[$_GET['cid']]; }
				echo '<input type="text" name="catprice" class="form-control" style="margin-right:15px;text-align:right;width:100%;" id="catprice" value="'.$cprice.'">';
				 
				} break;
				// MAILING LIST 			
		
				// GOOGLE MAP
				case "MapData": {	
				
				// LOAD IN LANGUAGE
					
				if(!is_numeric($_GET['postid'])){ die(); }				
				$pd = get_post($_GET['postid']);				
				echo "<h4>".$pd->post_title."</h4>";
				echo "<p style='max-height:240px;overflow:hidden;'>".preg_replace('/\[caption[^>]+\]/i', "", preg_replace('/\[gallery[^>]+\]/i', "", strip_tags($pd->post_content)) )."</p>";	
				
				echo "<p><a href='".get_permalink($pd->ID)."' style='color:#fff;'>".__("Read More","premiumpress")."</a></p>";	
							
				} break;
				// FAVS OPTIONS
				case "ListObject": {
				// LOAD IN LANGUAGE
									
					/** first make sure we are logged in **/
					if($userdata->ID && ( $_GET['type'] == "favorite" || $_GET['type'] == "wishlist" || $_GET['type'] == "blocked"  || $_GET['type'] == "friends"  ) && is_numeric($_GET['postid'])){					
						/** get existing user list ***/				
						$extn = "_list";
						if(defined('WP_ALLOW_MULTISITE')){
						$extn .= get_current_blog_id();
						}						 
						$my_list = get_user_meta($userdata->ID, $_GET['type'].$extn,true);						
						
						/** now lets check if we have an item already, if so delete it otherwise add one ***/	
						if(is_array($my_list) && in_array($_GET['postid'], $my_list) ){
							$result = $my_list;							
							unset($result[array_search($_GET['postid'], $result)]);						 						
							$error_message = __("Item Added","premiumpress");
							$ac = "warning";
						}else{			 
							$result = array_merge((array)$my_list, array($_GET['postid']));
							$error_message = __("Item Removed","premiumpress");  
							$ac = "success";
						}
						/*** now cleanup array(); ***/
						if(is_array($result)){
						$newResult = array();
							foreach($result as $g){
								if(is_numeric($g)){
									$newResult[] = $g;
								}
							}
						}
						/** now lets update ***/				 
						update_user_meta($userdata->ID, $_GET['type'].$extn, $newResult);
						/** now lets display the message to the user ***/
						die($error_message."**".$ac);					 
					}else{  		 
					 die(__("<b>Members Only</b> Please login to use this feature.","premiumpress")."**warning");
					}					
				} break;
				
									
									
				// CHANGE THE STATE VALUE FOR OUNTRY/STATE/CITY	
				case "ChangeState": {				
				
				$selected = $_GET['sel']; $in_array = array();				
							
				if(strpos($_GET['div'],"core_state") !== false){
						$s1 = 'map-state'; $s2 = 'map-country';										
				}else{
						$s1 = 'map-city'; $s2 = 'map-state';	
				}				
				
				$SQL = "SELECT DISTINCT a.meta_value FROM ".$wpdb->postmeta." AS a				
				INNER JOIN ".$wpdb->postmeta." AS t ON ( t.meta_key = '".$s2."' AND t.meta_value= ('".strip_tags($_GET['val'])."') AND t.post_id = a.post_id )				
				WHERE a.meta_key = '".$s1."'";				
			 
				$results = $wpdb->get_results($SQL); 
				 				 
				if(count($results) > 0 && !empty($results) ){
				
					echo "<option value=''></option>";
					
					foreach ($results as $val){			
						
						$state = $val->meta_value;						
						if(!in_array($state,$in_array)){						
							
							// ADD TO ARRAY
							$in_array[] = $state;
							$statesArray[] .= $state;
						}// if in array					
					} // end while	
					
					// NOW RE-ORDER AND DISPLAY
					asort($statesArray);
					foreach($statesArray as $state){ 
							if(strlen($state) < 2){ continue; }
							if($selected != "" &&  $state == $selected){
							echo "<option selected=selected>". $state."</option>";
							}else{
							echo "<option>". $state."</option>";
							} // end if	
					} 
					
					
				}else{ // end if
				
				// LOAD IN LANGUAGE
					
				
				echo "<option value=''>".$CORE->_e(array('validate','26'))."</option>";
				}							
				} break;
				
				case "ChangeSearchValues": { 
					
					$THIS_SLUG = "";
				 	
					// GET ALL PARENT TERMS AND FIND ONE THAT MATCHES THE SLUG
					 $bits = explode("__", $_GET['key']);
					  
					 if(!isset($bits[0])){ return; }
					 
					 // REGISTER TO PREVENT ERROR
					 register_taxonomy( $bits[0], 'listing_type', array() );
					 if(isset($bits[1])){
					 register_taxonomy( $bits[1], 'listing_type', array() );
					 }
					 
					 // GET LIST OF ALL PARENTS FROM SUB MENU
					 $parent_terms = get_terms($bits[0] ,array(  'orderby'    => 'count', 	'hide_empty' => 0, 'parent' => 0 ));								 				 			
					 if ( !empty( $parent_terms ) && !is_wp_error( $parent_terms ) ){
					 
					  
					 	// VALIDATION FOR VALUE
					 	if($_GET['val'] == ""){ die("<select id='novalueset'><option value=''></option></select>"); }	 
						 
						 // PASSED IN NUMERICAL VALUE INSTEAD OF SLUG
						if(is_numeric($_GET['val']) && isset($bits[1])){
						
							$found_term = get_term_by('id', $_GET['val'], $bits[1]);	
							   				 
							if(isset($found_term->slug)){
								$_GET['val'] = $found_term->slug;						 
							}					 
						}
						 	 
						// LOOP PARENT TERMS
						foreach ( $parent_terms as $term ) {
						  
						 	// CHECK FOR MATCH
							if (strpos($term->slug, $_GET['val']) !== false && $THIS_SLUG == "") {
								 
								 
								$THIS_SLUG = $term->slug;
								 
								if (strpos($_GET['val'], "-") === false && strpos($term->slug, "-") !== false){
								
								}else{
								
								}
							} 							
						}
					 	 	
						if($THIS_SLUG != ""){
						
							// GET THE PARENT ID
							$df_term = get_term_by('slug', $THIS_SLUG, $bits[0]);
							  
							// CHECK IF TERM EXISTS
							if(isset($df_term->term_id)){
						
								$terms = get_terms($bits[0], array('hide_empty' => false ) ); //, 'child_of' => $df_term->term_id
								
								$selec = (isset( $_GET['pr'] )) ? $_GET['pr'] : '';
								 
								 
								$count = count($terms);
						 
							if ( $count > 0 ){
							 echo "<select name='".$_GET['cl']."' class='form-control'>";
							 
							 if($_GET['add'] == 0){ echo "<option value=''></option>"; }
							 
							 foreach ( $terms as $term ) {
							 
							 	if($term->parent != $df_term->term_id){ continue; }
							 
								if($_GET['pr'] == "-1"){ $sv = $term->term_id; }else{ $sv = $term->slug;  }
								if($selec == $sv){ $a = "selected=selected"; }else{ $a = ""; }				   
								echo "<option value='".$sv."' ".$a.">" . $term->name . " (".$term->count.") </option>";							   				
							 }						  
							
							 echo "</select>";
							 }
							 }else{
							  echo "<select><option value=''></option></select>";
							 }
						 
						 } // end if
						
						 
					 }else{
					 	echo "<select><option value=''></option></select>";
					 }				  
				
				
				} break;
			}
		
			die();	
		}
		//////////////////////////////////////////////////////////////////////////////////////	

}














	
} // end class

?>