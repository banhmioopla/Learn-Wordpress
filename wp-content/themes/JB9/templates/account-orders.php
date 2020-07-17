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
   
   global $CORE, $userdata, $STRING;
   
   ?>
<section class="p3 p-lg-5 bg-white ">
   <?php
      if(THEME_KEY != "sp"){
      
      $paged = ( get_query_var( 'paged' ) ) ? absint( get_query_var( 'paged' ) ) : 1;
      $args = array(
      	'post_type' 		=> 'wlt_payments',
      	'posts_per_page' 	=> 12,
          'paged' 			=> $paged,
      	'meta_query' => array(
      		'relation'    => 'OR',												 
      									'seller_id'    => array(
      										'key' => 'seller_id',	
      										'type' 			=> 'NUMERIC',
      										'value' 		=> $userdata->ID,
      										'compare' 		=> '=',								 					 			
      									),			 
      									'buyer_id'   => array(
      										'key'     => 'buyer_id',							
      										'type' 			=> 'NUMERIC',
      										'value' 		=> $userdata->ID,
      										'compare' 		=> '=',															
      									),		
      	),
      );
      $wp_query1 = new WP_Query($args); 
      $orders = $wpdb->get_results($wp_query1->request, OBJECT);
      if(!empty($orders)){ ?>
   <h5><?php echo __("My Payments","premiumpress"); ?></h5>
   <p><?php echo __("These are payments made to/from other members.","premiumpress"); ?></p>
   <hr class="dashed margin-bottom3" />
   <div id="ajax_makepayment_form"></div>
   <!-- leave this -->
   <table class="table table-bordered table-payments table-striped mb-4 small">
      <thead>
         <tr>
            <th>#</th>
            <th><?php echo __("Order ID","premiumpress"); ?></th>
            <th><?php echo __("Date","premiumpress"); ?></th>
            <th><?php echo __("Amount","premiumpress"); ?></th>
            <th><?php echo __("Status","premiumpress"); ?></th>
         </tr>
      </thead>
      <tbody>
         <?php $i = 1; foreach($orders as $order){ 
            // GET ORDER STATUS
            $status = get_post_meta($order->ID,'status',true);		
            
            // GET TOTAL
            $amount = get_post_meta($order->ID,'amount',true);	  
            
            // SELLER ID
            $seller_id = get_post_meta($order->ID,'seller_id',true);	  
            $buyer_id = get_post_meta($order->ID,'buyer_id',true);	  
            
            
            ?>
         <tr class="row-<?php echo $order->ID; ?>">
            <td><?php echo $i; ?></td>
            <td>
               #<?php echo $CORE->order_get_orderid($order->ID); ?>
            </td>
            <td>
               <?php echo hook_date(get_the_date($order->ID)); ?>
            </td>
            <td>
               <?php echo hook_price($amount); ?>
            </td>
            <td>
               <?php if($status == 1){ ?>           
               <span class="badge badge-success"><?php echo __("Paid","premiumpress"); ?><span>           
               <?php }elseif($status == 2){ ?>
               <span class="badge badge-danger"><?php echo __("Refunded","premiumpress"); ?><span>          
               <?php }elseif($status == 3){ ?>           
               <span class="badge badge-info"><?php echo __("Cancelled","premiumpress"); ?><span>           
               <?php }else{ ?>
               <?php if($seller_id == $userdata->ID){ ?>  
               <div id="update_status_<?php echo $order->ID; ?>">
                  <select class="form-control-sm" style="width:100%;" onChange="ajax_btn_updatepayment('<?php echo $order->ID; ?>',this.value, 'update_status_<?php echo $order->ID; ?>');">
                     <option value="0"><?php echo __("Waiting Payment","premiumpress"); ?></option>
                     <option value="1"><?php echo __("Paid","premiumpress"); ?></option>
                     <option value="2"><?php echo __("Refunded","premiumpress"); ?></option>
                     <option value="3"><?php echo __("Cancelled","premiumpress"); ?></option>
                  </select>
                  </select>
               </div>
               <?php } ?>
               <?php if($buyer_id == $userdata->ID){ ?>
               <a href="javascript:void(0);" onclick="ajax_btn_makepayment(<?php echo $order->ID; ?>);" class="btn btn-success btn-sm btn-block"><?php echo __("Make Payment","premiumpress"); ?></a>
               <?php } ?>
               <?php } ?>
            </td>
         </tr>
         <?php $i++; } ?>
      </tbody>
   </table>
   <?php if(isset($_GET['paymentid']) ){ ?>
   <script> jQuery(document).ready(function(){  setTimeout(function(){  SwitchPage('orders'); }, 2500); jQuery('.row-<?php echo $_GET['paymentid']; ?>').addClass('bg-success text-light'); }); </script>
   <?php } ?> 
   <script>
      function ajax_btn_updatepayment(id,val, div){
         
             jQuery.ajax({
                 type: "POST",
                 url: '<?php echo home_url(); ?>/',		
         		data: {
                  action: "update_user_payment",
      			id: id,
      			val: val,
                 },
                 success: function(response) {
         			
         			jQuery('#'+div).html(response);
         		 	
                 },
                 error: function(e) {
                     alert("error "+e)
                 }
             });
         
         }
      function ajax_btn_makepayment(id){
         
             jQuery.ajax({
                 type: "POST",
                 url: '<?php echo home_url(); ?>/',		
         		data: {
                  action: "get_user_payment",
      			id: id,
                 },
                 success: function(response) {
         			
         			jQuery('#ajax_makepayment_form').html(response);
         			//jQuery('.table-payments').hide();
         			
                 },
                 error: function(e) {
                     alert("error "+e)
                 }
             });
         
         }
       
   </script>
   <?php } ?>
   <?php } ?>
   <h5><?php echo __("My Orders","premiumpress"); ?></h5>
   <p><?php echo __("These are payments made to this website.","premiumpress"); ?></p>
   <hr class="dashed margin-bottom3" />
   <?php 
      $SQL = "SELECT * FROM `".$wpdb->prefix."core_orders` WHERE user_id = ('".$userdata->ID."') ORDER BY autoid DESC"; 
      $orders = (array)$wpdb->get_results($SQL);
      
      if(!empty($orders)){  ?>
   <table class="table table-bordered table-striped small">
      <thead>
         <tr>
            <th>#</th>
            <th><?php echo __("Order ID","premiumpress"); ?></th>
            <th><?php echo __("Date","premiumpress"); ?></th>
            <th><?php echo __("Amount","premiumpress"); ?></th>
            <th><?php echo __("Status","premiumpress"); ?></th>
         </tr>
      </thead>
      <tbody>
         <?php $i = 1; foreach($orders as $order){ ?>
         <tr>
            <td><?php echo $i; ?></td>
            <td>
               <a href="<?php echo get_template_directory_uri(); ?>/_invoice.php?invoiceid=<?php echo $order->autoid; ?>" target='_blank' style='text-decoration:underline;'>
               #<?php echo $CORE->order_get_orderid($order->autoid); ?>
               </a>
            </td>
            <td>
               <?php echo hook_date($order->order_date." ".$order->order_time); ?>
            </td>
            <td>
               <?php echo hook_price($order->order_total); ?>
            </td>
            <td>
               <span><?php 
			   
			   // ORDER STATUS
				$orderstatus = $CORE->order_get_status($order->order_status);
				echo $orderstatus['name']; ?></span>
            </td>
         </tr>
         <?php $i++; } ?>
      </tbody>
   </table>
   <?php do_action('hook_account_orders_after'); ?>
   <?php }else{ ?>
   <div class="text-center margin-top3 margin-bottom3">
      <div class="font-size20"><?php echo __("No orders found","premiumpress"); ?></div>
   </div>
   <?php } ?>
   
   
   
   <!-- SAVE BUTTON -->
            <div class="row mt-4">
            <div class="col-md-5">
             
            </div>
            <div class="col-md-3 "></div>
            <div class="col-md-4  text-sm-right">
             <a onclick="SwitchPage('dashboard');" href="javascript:void(0);" class="btn btn-outline-secondary rounded-0 btn-block mb-5">
			 <?php echo __("Dashboard","premiumpress"); ?> <i class="fa fa-angle-right" aria-hidden="true"></i>
             </a>
            </div>            
            </div>
            <!-- END SAVE BUTTON -->   
</section>