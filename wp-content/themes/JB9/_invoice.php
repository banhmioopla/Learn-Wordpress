<?php 
if(!isset($_GET['invoiceid']) || !is_numeric($_GET['invoiceid']) ){ header('HTTP/1.0 403 Forbidden'); exit;  }

	// TRY TO GENERATE THE CORRECT SERVER PATH FROM THE FILE LOCATION
	// IF YOUR HERE TO EDIT THE SERVER PATH, EDIT THE VALUE BELOW
	
 	$te = explode("wp-content",$_SERVER['SCRIPT_FILENAME']);
	$SERVER_PATH_HERE = $te[0];
	
	if(file_exists($SERVER_PATH_HERE.'/wp-config.php')){
				 
		require( $SERVER_PATH_HERE.'/wp-config.php' );
	
	}else{
	
		die('<h1>Invoice Path Incorrect</h1>
		<p>The script could not generate the correct server path to your invoice file.</p>
		<p>Please edit the file below and manually set the correct server path.</p>
		<p>'.$_SERVER['SCRIPT_FILENAME'].'</p>');
	
	}
	
	// START MAIN INVOICE CONTENT	
	global $wpdb, $userdata; wp_get_current_user();
	
	 
 	// GET THE ORDER DATA FROM THE DATABSE
	$SQL = "SELECT DISTINCT * FROM ".$wpdb->prefix."core_orders WHERE ".$wpdb->prefix."core_orders.autoid = ('".strip_tags($_GET['invoiceid'])."') GROUP BY order_id LIMIT 1";
	$posts = $wpdb->get_results($SQL, OBJECT);
	
	if(empty($posts)){
	die("This invoice no longer exists.");
	}

	foreach($posts as $order){
	
	$GLOBALS['orderdata'] = $order;
 

	// GET THE CLIENT DATA
	$user = get_userdata($order->user_id);
	
	// VALIDATE THIS USER CAN VIEW THE ORDER
	if($userdata->ID != $order->user_id){ 
		if(!current_user_can( 'administrator' )){
		header("location: ".site_url('wp-login.php', 'login_post'));
		exit();	
		}
	}
 
	// GET ORDER STATUS
	$paid = false; $refunded = false;
	switch($order->order_status){
	case "5":
	case "1": { 	$O1 = "Paid";		$O2 = "green"; $paid = true; 	} break;							
	case "2": { 	$O1 = "Refunded";	$O2 = "purple"; $refunded = true;	} break;	
	case "3": { 	$O1 = "Incomplete";	$O2 = "red"; 	} break;
	case "4": { 	$O1 = "Failed";		$O2 = "black";  } break;
	}
	 
 	
		
			   // ORDER TYPE
			$ordertype = $CORE->orders_get_type($order->order_id);
			
			   switch($ordertype['id']){
			   
			   	case "CART":{				
				
					$obits = explode("-",$order->order_id); 
					$SQL = "SELECT session_data FROM ".$wpdb->prefix."core_sessions WHERE session_key LIKE ('%".strip_tags($obits[1])."%') LIMIT 1";
					$hassession = $wpdb->get_results($SQL, OBJECT);
					if(!empty($hassession)){
						// RESTORE THE CART DATA
						$cart_data = unserialize($hassession[0]->session_data);		 
						// NOW WE LOOP ALL ITEMS AND REMOVE THE QTY IF REQUIRED
						if(isset($cart_data['items']) && is_array($cart_data['items'])){
							$GLOBALS['global_cart_data'] = $cart_data;
						 }// end if
					}
				
				} break;
				
				default: {
				
				if(!is_numeric($order->order_shipping)){ $order->order_shipping = 0; }
				if(!is_numeric($order->order_tax)){ $order->order_tax = 0; }				
				$subt = $order->order_total - ($order->order_tax + $order->order_shipping);
				
				
				// BUILD DATA
				$name = $order->order_description;
				$link = "";
				$id = $order->order_items;
				if($id == ""){
				$id =  $order->user_id;
				}
				$extra = "";
				if($ordertype['id'] == "LST"){
				
					// BREAK DOWN ID
					$ob = explode("-",$order->order_id);
				 	
					$name = get_the_title($ob[1]);
					$link = get_permalink($ob[1]);
				}
				
				if($ordertype['id'] == "MJ"){
					
					// TYPE
					$extra = __("Type","premiumpress").": ";				
					if(get_post_meta($p->ID,'gig_type',true) != ""){ 
						$extra .= __("Premium","premiumpress");  
					}else{ 
						$extra .= __("Standard","premiumpress");
					}
					
					// ADDON
					$G = explode(",", $order->order_items);
					 
					if(isset($G[1]) && is_numeric($G[1])){					
						if(get_post_meta($G[1],'gig_addon',true) != "" && is_numeric(get_post_meta($G[1],'gig_addon',true)) ){
							$addonid 		= get_post_meta($G[1],'gig_addon',true);			    
							$current_data 	= get_post_meta($G[0], 'customextras', true); 
							if(is_array($current_data) && !empty($current_data) && $current_data['name'][0] != "" ){ 
								$i=0; 				 
								foreach($current_data['name'] as $key => $data){ 
									if($current_data['name'][$i] !="" && is_numeric($current_data['price'][$i]) ){
									if($i == $addonid){							
									$extra .= " <br> ".__("Add-on","premiumpress").": ".$current_data['name'][$i] ." - ".hook_price($current_data['price'][$i]); 													
									} 							 
								}						
								$i++; 
								}
							}
						}					
					}
					

				
				} 
				
			 
			  $GLOBALS['global_cart_data'] = array(
				  
				"userid" => $order->user_id,
				"total_items" => 1,
				"total" => $order->order_total,
				"subtotal" => $subt,
				"qty" => "1",
				"tax" => $order->order_tax,
				"weight_class" => 0,
				"weight" => 0,
				"tokens" => 0,
				"shipping" => $order->order_shipping,
				"comments" => "",
				"discount" => 0,
				"discount_code" => 0,
				 "items" => array(
						
						$id => array(
							
							1 => array(
							"innerID" => $id,
                            "name" => $name,
                            "link" => $link, 
                            "amount" => $order->order_total,
                            "image" => "", 
							"qty" => "1",
							"comments" => $extra,
							),
						),
					
					),
					
				  );
				
				
				} break;
			   
			   
			   }// end switch		
		
		
		
		
		
	} 

$order = $GLOBALS['orderdata'];
?>
<head>
   <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
   <title>Invoice <?php echo hook_orderid($order->autoid); ?></title>
   <link rel="stylesheet" href="<?php echo FRAMREWORK_URI; ?>css/backup_css/css.bootstrap.css" media="screen" />
   <link rel="stylesheet" href="<?php echo FRAMREWORK_URI; ?>css/backup_css/css.framework.css" media="screen" />
   <link rel="stylesheet" href="<?php echo FRAMREWORK_URI; ?>css/backup_css/css.cart.css" media="screen" />
   <style>
      @import url(http://fonts.googleapis.com/css?family=Bree+Serif);
      h1, h2, h3, h4, h5, h6, .table-header, #logo, .printbutton a {
      font-family: 'Bree Serif', serif;
      }
      .printbutton { text-align:center; font-size:16px; background:#fafafa; border:1px solid #ddd; color:#2b2b2b; width:200px; padding:10px; margin:auto auto;  }
      .show-print { display:none; }
      h1 { font-size:40px; }
      h2 { font-size:25px; }
      @media print {
      h1, h2, h3, h4, h5, h6, .table-header, #logo, .printbutton a {
      font-family:Arial, Helvetica, sans-serif;
      }
	  ul { padding:0px; margin:0px; margin-top:10px; }
	  ul li { list-style:none; padding:none; margin:none; }
	  
      .text-right, .text-print-right { text-align:right; }
      .table-header, .col-qty, .col-price, .col-item  img { display:none; }
      .table-row, .table-footer {   }
      .col-item  { width:80%; float:left; }
      .col-item h6{ margin:0px; padding:0px; }
      .col-total { width:20%; float:left; text-align:right; }
      .readonly {  }
      .readonly img { display:none; }
      .readonly .visible-xs-down, .btn-remove-item { display:none; }
      .readonly h6{ color:#000; text-decoration:none; font-size:14px; }
      .clearfix { clear:both; display:block; }
      .show-print { display:block !important; clear:both; }
      .hide-print { display:none; }
      .no-print, .no-print *{   display: none !important;} 
	  a[href]:after {   content: none !important;}
      .table-header, .t-total .ebold { font-size:150%; padding-bottom:50px; }
	  .table-row {  padding-bottom:50px;  }
	  .checkout-table { border-top:2px solid black; margin-top:20px; padding-top:20px; }
	  
	  .t-subtotal { border-top:2px solid black; margin-top:10px; padidng-top:30px; }
	  .t-subtotal .pricetag {   }
	  .t-subtotal .text-sm-right { padding-top:30px; }
	  
      }
	  
      .mt-2 { margin-top:20px; }
      .mt-3 { margin-top:30px; }
      .mb-2 { margin-bottom:20px; }
   </style>
</head>
<body>
<div class=" border-bottom">
   <div class="container py-4">
      <div class="row">
         <div class="col-6">
            <div id="logo" class="mt-4"><?php echo hook_logo(true); ?></div>
         </div>
         <div class="col-6  text-right">
            <h1><?php echo __("INVOICE","premiumpress") ?></h1>
            <h2>#<?php echo hook_orderid($order->autoid); ?></h2>
         </div>
         
      </div>
   </div>
</div>

   <?php if($paid){ ?>
   <div style="text-align:center" class="show-print">
      <img src="<?php echo FRAMREWORK_URI; ?>/img/invoice-paid.png" style="float:right;"> 
   </div>
   <?php } ?> 
   <div class="container py-5">
   <div class="row">
      <div class="col-6">
         <h4 class="mb-2"><?php echo _ppt(array('company','name')); ?> </h4>
         <?php echo wpautop(_ppt(array('company','address'))); ?> 						
         <?php echo _ppt(array('company','phone')); ?><br>                        
         <?php echo _ppt(array('company','email')); ?>
         <h5 class="mt-3"><?php echo __("Invoice Date","premiumpress") ?></h5>
         <?php echo hook_date($order->order_date);  ?>
      </div>
      <div class="col-6">
       
            <h4 class="mb-2"><?php echo  $CORE->user_display_name($order->user_id); ?></h4>
            <p><?php echo __("Account","premiumpress") ?>: #<?php echo $order->user_id; ?> </p>
            <?php if($paid){ ?> 
            <img src="<?php echo FRAMREWORK_URI; ?>/img/invoice-paid.png" class="float-right no-print hidden-down"> 
            <?php } ?>
            <?php if($refunded){ ?> 
            <img src="<?php echo FRAMREWORK_URI; ?>/img/invoice-refund.png" class="float-right no-print hidden-down"> 
            <?php } ?>
            
            <?php  if(defined('WLT_CART')){ 
               $order_data_description = "";
               if(isset($cart_data['guest_data']) && !empty($cart_data['guest_data']) && strtolower($order->user_login_name) == "guest" ){
               $order_data_description .= "".$cart_data['guest_data']["billing_fname"]." ".$cart_data['guest_data']["billing_lname"]."<BR />";
               $order_data_description .= "".$cart_data['guest_data']["billing_email"]."<BR />";
               $order_data_description .= "".$cart_data['guest_data']["billing_phone"]."<BR />";
               $order_data_description .= "".$cart_data['guest_data']["billing_address"]."<BR />";
               $order_data_description .= "".$cart_data['guest_data']["billing_address2"]."<BR />";
               $order_data_description .= "".$cart_data['guest_data']["billing_city"]."<BR />";
               $order_data_description .= "".$cart_data['guest_data']["billing_state"]."<BR />";
               $order_data_description .= "".$cart_data['guest_data']["billing_country"]."<BR />";
               $order_data_description .= "".$cart_data['guest_data']["billing_zip"]."<BR />"; 
               }else{							
               $order_data_description .= "".get_user_meta($order->user_id, "billing_fname",true)." ".get_user_meta($order->user_id, "billing_lname",true)."<BR />";
               $order_data_description .= "".get_user_meta($order->user_id, "billing_email",true)."<BR />";
               $order_data_description .= "".get_user_meta($order->user_id, "billing_phone",true)."<BR />";
               $order_data_description .= "".get_user_meta($order->user_id, "billing_address",true)."<BR />";
               $order_data_description .= "".get_user_meta($order->user_id, "billing_address2",true)."<BR />";
               $order_data_description .= "".get_user_meta($order->user_id, "billing_city",true)."<BR />";
               $order_data_description .= "".get_user_meta($order->user_id, "billing_state",true)."<BR />";
               $order_data_description .= "".get_user_meta($order->user_id, "billing_country",true)."<BR />";
               $order_data_description .= "".get_user_meta($order->user_id, "billing_zip",true)."<BR />";
               }
               if(strlen($order_data_description) < 80 &&  strlen(trim($order->shipping_label)) > 27 ){
               
               echo $order->shipping_label;
               
               }else{
               
               echo $order_data_description;
               
               		}
               
               }elseif(strlen(trim($order->shipping_label)) > 27){ ?>
            <p><?php echo $order->shipping_label; ?></p>
            <?php } ?>
            
            
            
       
      </div>
   </div>
   <div class="clearfix"></div>
   <div class="readonly clearfix mt-5">  
      <?php get_template_part( hook_theme_folder( array('checkout', 'table', true) ) , 'table' ); ?>    
   </div>                
   <div class="printbutton no-print mt-2" ><a href="javascript:void(0);" onClick="window.print()"><?php echo __("Print Invoice","premiumpress") ?></a></div>
   
<?php if(_ppt('currency_jquery') == '1'){  ?>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script>

const formatter = new Intl.NumberFormat('en-US', {
  style: 'currency',
  currencyDisplay: 'symbol',
  currency: '<?php echo _ppt(array('currency','code')); ?>',
  minimumFractionDigits: <?php if(is_numeric(_ppt(array('currency','dec')))){ echo _ppt(array('currency','dec')); }else{ echo 2; } ?>
});

jQuery(document).ready(function(){
	
	// LOOP AND REPLACE
	jQuery('.js_price').each(function(i, obj) {									  
		totalprice = parseFloat(jQuery(obj).html());									  
		jQuery(obj).html(formatter.format(totalprice));											 
	});

});
</script>
<?php } ?>
</body>
</html>