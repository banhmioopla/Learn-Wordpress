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
   if (!defined('THEME_VERSION')) {	header('HTTP/1.0 403 Forbidden'); exit; } global $CORE;
   
  
   
    wp_register_style( 'framework-cart', FRAMREWORK_URI.'css/backup_css/css.cart.css', array(), THEME_VERSION, false);	 
	wp_enqueue_style( 'framework-cart' );	
   
    
   	$currency_symbol = get_option("currency_symbol");
   	$order   = array("\r\n", "\n", "\r");
   	$replace = '<br />'; 
   	$SQL = "SELECT DISTINCT * FROM ".$wpdb->prefix."core_orders 
   	WHERE ".$wpdb->prefix."core_orders.autoid = ('".$_GET['oid']."') GROUP BY order_id LIMIT 1"; 
   	
   	$orderdata = $wpdb->get_results($SQL, OBJECT);
   	$order = $orderdata[0];
    	
   	
   // BUILD SHIPPING DETAILS FROM ORDER DATA
   $SHIPPING_LABEL = "";
   
   $SHIPPING_LABEL .= str_replace(' ','',strip_tags(str_replace("<br/>","\r\n\r\n",trim($order->shipping_label))));
   if(strlen($SHIPPING_LABEL) < 5){
    	$SHIPPING_LABEL = "";
   	if(defined('WLT_CART') && is_numeric($order->user_id) ){
   		$shop_user_fields = array(
   			"billing_fname" => array( "type" => "text", "caption" => "First Name" ),
   			"billing_lname" => array( "type" => "text", "caption" => "Last Name" ),
   			"billing_phone" => array( "type" => "text", "caption" => "Telephone" ),
   			"billing_email" => array( "type" => "text", "caption" => "Email" ),
   			"billing_company" => array( "type" => "text", "caption" => "Company Name", "nr" => true ), // NOT REQUIRED
   			"billing_address" => array( "type" => "text", "caption" => "Address" ),
   			"billing_country" => array( "type" => "country", "caption" => "Country" ),
   			"billing_city" => array( "type" => "text", "caption" => "City" ),
   			"billing_state" => array( "type" => "state", "caption" => "State" ),
   			"billing_zip" => array( "type" => "text", "caption" => "Zip/Postal Code" ),
   		);
   		
   		foreach($shop_user_fields as $fkey => $field){
   			
   			$fb = get_user_meta($order->user_id, $fkey, true);
   			if(strlen($fb) > 1){
   			$SHIPPING_LABEL .= $fb." \n";
   			}
   		}// end foreach
   	
   	}// end if
    
   }
    
    	 
   ?>
<script>
   jQuery(document).ready(function(){
   
   jQuery('#pagetitle').html('<h1>#<?php echo hook_orderid($order->autoid); ?></h1>');
   
   });
   
</script>
<div class="row">
<div class="col-lg-8">
   <div class="bg-white p-5 shadow" style="border-radius: 7px;">
      <div class="tabheader mb-4">
      
      
        <a href="<?php echo THEME_URI; ?>/_invoice.php?invoiceid=<?php echo $order->autoid; ?>" class="btn btn-primary btn-sm float-right" target="_blank">View Invoice</a>
      
         <h4><span>Order Items</span></h4>
      </div>
 
         
         
         <p>
         
         <span class="float-right text-muted font-weight-bold"><?php echo $order->order_id ?></span>
         
         <?php echo date('l jS \of F Y h:i:s A', strtotime($order->order_date." ".$order->order_time)); ?>
          
         
         </p>
        
         
         
        
         <div class="row">
            <div class="col-md-12">
               <?php
			   
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
                  
               ?>
                  
                  
               <div class="readonly">
                  <?php get_template_part( hook_theme_folder( array('checkout', 'table', true) ) , 'table' ); ?>
               </div>
                
               <?php if(substr($order->order_data,0,5) == "addon" ){ ?>
               <div class="mt-4">
               <label class="txt500">Addon Purchased</label>
                 
               <?php
			   $thisVal = substr($order->order_data,5,100);			   
				$current_data = get_post_meta($order->order_items,'customextras', true); 
				if(is_array($current_data) && !empty($current_data) && $current_data['name'][0] != "" ){ $i=0; 				 
					foreach($current_data['name'] as $key => $data){ 
					if($current_data['name'][$i] !="" && is_numeric($current_data['price'][$i]) ){						
							if($i == $thisVal){
							?>
                            <div class="bg-light p-3 border">
                            <span class="float-right badge badge-primary"><?php echo hook_price($current_data['price'][$i]); ?></span>
                            <h6><?php echo $current_data['name'][$i]; ?></h6>
                            <p><?php echo trim($current_data['value'][$i]); ?></p>
                            </div>
                            <?php						
							} 
						}						
						$i++; 
					}
				} 
			   
			   ?>
               </div>
               <?php } ?>
            </div>
         </div>
         
         <p class="text-muted mt-2"> User IP: <a href="http://whatismyipaddress.com/ip/<?php echo $order->order_ip ?>" target="_blank" class="tag tag-danger"><?php echo $order->order_ip ?></a>
         
         
          <?php if($order->order_gatewayname != ""){ ?> / <?php echo $order->order_gatewayname; ?> <?php } ?>
         
          </p>
         
         
          <?php 
               if(strlen(get_user_meta($order->user_id,'billing_comments',true)) > 1){ ?>
            <h6 class=""> User Comments </h6>
            <div><?php echo get_user_meta($order->user_id,'billing_comments',true); ?></div>
            <?php } ?>
            
 
       
         <div class="mt-4">
            <a href="admin.php?page=6"><i class="fa fa-arrow-left mr-3" aria-hidden="true"></i> Go Back</a>
         </div>
    
      <style>
         #premiumpress .card-footer { display:none; }
         .editme.hide { display:none; }
         .photo, .avatar {
         max-width: 80px;
         max-height: 80px;
         margin-left:-5px;
         }
         #premiumpress .checkout-table .form-control { border:0px !important; padding:0px; text-align:center; }
         #premiumpress .checkout-table .btn-remove-item { display:none; }
      </style>
      <script>
         function show_raw(){
         
         	jQuery('.editme').each(function(i, obj) {
         		
         		if(jQuery(obj).hasClass('hide') ){
         			jQuery(obj).removeClass('hide');
         		}else{
         			jQuery(obj).addClass('hide');
         		}
         	});
         }
         
         
         
      </script>
   </div>
</div>
<div class="col-lg-4">



 

     <form method="post" target="_self">
         <input name="saveorder" type="hidden" value="yes" />
         <input type="hidden" name="order[autoid]" value="<?php echo $order->autoid ?>">
         <input type="hidden" name="order[order_id]" value="<?php echo $order->order_id ?>">
         <input type="hidden" name="order[user_id]" value="<?php echo $order->user_id ?>">  
         
          <input type="hidden" name="order[order_data]" value="<?php echo $order->order_data ?>">  
           <input type="hidden" name="order[shipping_label]" value="<?php echo $order->shipping_label ?>">  
           <input type="hidden" name="order[payment_data]" value="<?php echo $order->payment_data ?>">  
           
           
           
         <?php $uf = get_userdata($order->user_id);  ?>

   <div class="bg-white p-4 shadow" style="border-radius: 7px;">
      <div class="tabheader mb-4">
      
       <?php

// ORDER TYPE
$ordertype = $CORE->orders_get_type($order->order_id);

?>

<div style="padding:8px; float:right; max-width:150px; background:<?php echo $ordertype['color']; ?>; color:#fff; text-align:center; font-size:11px; text-transform:uppercase"><?php echo $ordertype['name']; ?></div>

      
      
         <h4>Order Details</h4>
          
      </div>
      <div class="row">
      
      
               <div class="col-md-12">
               
               
               <?php

 
// ORDER STATUS
$orderstatus = $CORE->order_get_status($order->order_status);

 
?>

<div style=" background:<?php echo $orderstatus['color']; ?>; color:#222; margin-top:5px; text-align:center; font-size:11px; width:100px; float:right; text-transform:uppercase"><?php echo $orderstatus['name']; ?></div>

               
               <label class="txt500">Order Status</label>
               <div class="input-group">
                   
<select name="order[order_status]" class="form-control">
<?php
// ORDER STATUS
$orderstatus = $CORE->order_get_status();
foreach($orderstatus as $k => $n){
?>
<option value="<?php echo $k; ?>" <?php selected( $order->order_status, $k ); ?>><?php echo $n['name']; ?></option>
<?php } ?>
</select>

                
               </div>
            </div>
            
            
         
             <div class="col-md-12 mt-3">
               <label class="txt500">Order Email</label>
               <div class="input-group">
                   
               <input type="text" class="form-control" name="order[order_email]" value="<?php echo $order->order_email ?>">
                
               </div>
            </div>
         
      
            <div class="col-md-12 mt-4 row pr-0">
               <label class="txt500 col-6 mt-1">User</label>
               <div class="input-group col-6 pr-0">
                  <a href="user-edit.php?user_id=<?php echo $order->user_id; ?>" class="float-right btn-sm btn-primary btn-block text-center" style="line-height: 30px;"><?php echo $uf->user_login; ?></a>
               </div>
            </div>
            
            <div class="col-md-12 mt-3 row pr-0">
               <label class="txt500 col-6 mt-1">Tax</label>
               <div class="input-group col-6 pr-0">
                  <span class="input-group-prepend input-group-text "><?php echo hook_currency_symbol(''); ?></span>
                  <input type="text" class="form-control" name="order[order_tax]" value="<?php echo $order->order_tax ?>">
               </div>
            </div>
            <div class="col-md-12 mt-3 row pr-0">
               <label class="txt500 col-6 mt-1">Shipping</label>
               <div class="input-group col-6 pr-0">
                  <span class="input-group-prepend input-group-text"><?php echo hook_currency_symbol(''); ?></span>
                  <input type="text" class="form-control" name="order[order_shipping]" value="<?php echo $order->order_shipping ?>">
               </div>
            </div>
            <div class="col-md-12 mt-3 row pr-0">
               <label class="txt500 col-6 mt-1">Order Total</label>
               <div class="input-group col-6 pr-0">
                  <span class="input-group-prepend input-group-text"><?php echo hook_currency_symbol(''); ?></span>
                  <input type="text" class="form-control" name="order[order_total]" value="<?php echo $order->order_total ?>" />
               </div>
            </div>
         </div>
         
           
                  <?php if(strlen($SHIPPING_LABEL) > 5){ ?>
            <div class="col-md-12">
               <label class="txt500">Delivery Details</label>
               <div class="input-group">
                   
               <textarea style="height:100px; width:100%" class="form-control " name="order[shipping_label]"><?php echo $SHIPPING_LABEL; ?></textarea>
                
               </div>
            </div>
             <?php } ?>
 
             
             
             
             
             
             
             
        <!-- end row -->
         <div class="bg-primary p-1 text-center mt-4 shadow" style="border-radius: 7px;">
            <button type="submit" class="btn btn-lg btn-primary btn-block"><?php echo __("Update Order Details","premiumpress-admin"); ?></button> 
         </div>
  
      </div>
      
      
  </form>  
      
      
      
      
      
   </div>
</div>