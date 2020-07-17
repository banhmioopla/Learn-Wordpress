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
 
global $CORE, $post, $userdata;

// ONLY AUTHOR OF LISTING CAN SEE THIS
if($post->post_author != $userdata->ID){ return; }

// GET THE PRICE DUE
$payment_due = get_post_meta($post->ID,'total_price_due',true);

$packageID  = "";

?>
<?php if($payment_due > 0){ ?>
<section class="bg-light">
   <div class="container py-5">
      <div class="row">
         <div class="col-md-8">
            <div class="bg-white"><div id="ajax_payment_form"></div></div>
         </div>
         <div class="col-md-4">
            <ul class="payment-right">
               <li>
                  <div id="package-type" class="left">
                     <?php echo __("Name","premiumpress"); ?>
                  </div>
                  <div class="right">
                     <span id="ppname"><?php echo __("Listing Payment","premiumpress"); ?></span>
                  </div>
                  <div class="clearfix"></div>
               </li>
               <li>
                  <div class="left"><?php echo __("Sub Total","premiumpress"); ?>:</div>
                  <div class="right">
                     <span id="ppsubtotal"><?php echo hook_price($payment_due); ?></span>
                  </div>
                  <div class="clearfix"></div>
               </li>
               <li id="ppdiscountlist" style="display:none;">
                  <div class="left"><?php echo __("Discount","premiumpress"); ?>:</div>
                  <div class="right">
                     <span id="ppdiscount">xxx</span>
                  </div>
                  <div class="clearfix"></div>
               </li>
               <li>
                  <div class="left"><strong><?php echo __("Total","premiumpress"); ?>:</strong></div>
                  <div class="right">	
                     <span id="ppprice"><?php echo hook_price($payment_due); ?></span>
                  </div>
                  <div class="clearfix"></div>
               </li>
            </ul>
         </div>
      </div>
   </div>
</section>
<script>
   jQuery(document).ready(function(){
   ajax_load_payment();
   });
   
   
   function ajax_load_payment(){
   
       jQuery.ajax({
           type: "POST",
           url: '<?php echo home_url(); ?>/',		
   		data: {
               action: "load_new_payment_form",
   				details:jQuery('#ppt_orderdata1').val(),
           },
           success: function(response) {	
		   	
   			jQuery('#ajax_payment_form').html(response);
   			
           },
           error: function(e) {
               alert("error "+e)
           }
       });
   
   }
</script>
<input type="hidden" id="ppt_orderdata1" value="<?php 
   $couponcode = "";
   if(isset($_POST['couponcode'])){
   $couponcode = esc_attr($_POST['couponcode']);
   }
   
   

$npaymentdat = array(               
	"uid" 			=> $userdata->ID,                
	            
	"order_id" 		=> "LST-".$POSTID."-".rand(),                 
	"description" 	=> __("Listing Payment","premiumpress"),
	"couponcode" 	=> $couponcode,	
	
	"amount" => $payment_due, 	
	
	"local_currency_amount" => $CORE->price_format_display( $payment_due ),
   	"local_currency_code" => $CORE->_currency_get_code(),
											
); 
 
 				
// ADD ON RECURRING
if(_ppt('pak'.get_post_meta($post->ID, 'packageID',true)."_r") == 1){
	$npaymentdat["recurring"] = "1";  
	$npaymentdat["recurring_days"] = _ppt('pak'.get_post_meta($post->ID, 'packageID',true)."_rdays"); 			
}				
echo $CORE->order_encode($npaymentdat);

 ?>" />
<?php } ?>
<div id="option_btn">
   <div class="heading"><i class="fa fa-cog" aria-hidden="true"></i></div>
   <div id="ajax_response_msg"></div>
   <?php if($payment_due > 0){ ?>
   <div class="info blue"><?php echo __("awaiting payment","premiumpress"); ?></div>
   <?php }elseif($post->post_status == "draft"){ ?>
   <div class="info red"><?php echo __("Draft","premiumpress"); ?></div>
   <?php }elseif($post->post_status == "pending"){ ?>
   <div class="info blue"><?php echo __("pending approval","premiumpress"); ?></div>
   <?php }else{ ?>
   <div class="info green"><?php echo __("Live","premiumpress"); ?></div>
   <?php }  ?>
   <div class="box-alert bell box-shadow">
      <div class="box-alert-wrap">
         <?php if($payment_due > 0){ ?>
         <?php /*
            <a href="#myPaymentOptions" role="button" data-toggle="modal" onclick="ajax_load_payment()" ><i class="fa fa-credit-card" aria-hidden="true"></i> 
               
               <?php echo __("Pay Now","premiumpress"); ?>
         </a>*/ ?>
         <a href="<?php echo _ppt(array('links','add')); ?>?eid=<?php echo $post->ID; ?>"  rel="tooltip" data-original-title="<?php echo __("Edit","premiumpress"); ?>" data-placement="left" >
         <i class="fa fa-pencil"></i> 
         <?php echo __("Edit","premiumpress"); ?>
         </a>
         <?php if(THEME_KEY != "da" && hook_can_delete_listing($post->ID) != "stop"){ ?>
         <a href="javascript:void(0);" onclick="ajax_delete_listing();"  rel="tooltip" data-original-title="<?php echo __("Delete","premiumpress"); ?>" data-placement="left">
         <i class="fa fa-trash" aria-hidden="true"></i>
         <?php echo __("Delete","premiumpress"); ?>
         </a> 
         <?php } ?>
         <?php }elseif($post->post_status == "pending") { ?>
         <?php }else{ ?>
         <?php /*
            <a href="#myPaymentOptions" role="button" data-toggle="modal" onclick="ajax_show_enhancements();">
            <i class="fal fa-award" aria-hidden="true"></i> 
            <?php echo __("Upgrade","premiumpress"); ?>
         </a>  
         */ ?>
         <?php if(_ppt(array('links','add')) != ""){ ?>
         <a href="<?php echo _ppt(array('links','add')); ?>?eid=<?php echo $post->ID; ?>" >
         <i class="fa fa-pencil"></i> 
         <?php echo __("Edit","premiumpress"); ?>
         </a>
         <?php } ?>
         <?php if(_ppt('renewlisting') == 1 && $payment_due < 1 && $packageID != "" ){ ?>
         <i class="fa fa-refresh" aria-hidden="true"></i>        
         <?php if($relist['price'] == 0){ ?>
         <a href="javascript:void(0);" onclick="ajax_relist_listing();"><?php echo __("Relist Now","premiumpress"); ?></a> 
         <?php }else{ ?>
         <a href="#myPaymentOptions" role="button" data-toggle="modal" onclick="ajax_relist_payment();" ><?php echo __("Relist for","premiumpress"); ?> <?php echo hook_price($relist['price']); ?></a> 
         <?php } ?>       
         <?php } ?>
         <?php if(THEME_KEY != "da" && hook_can_delete_listing($post->ID) != "stop"){ ?>
         <a href="javascript:void(0);" onclick="ajax_delete_listing();" ><i class="fa fa-trash" aria-hidden="true"></i> <?php echo __("Delete","premiumpress"); ?></a> 
         <?php } ?> 
         <?php } // end if published ?>
      </div>
   </div>
</div>
<!-- show payment form -->
<div id="myPaymentOptions" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
   <div class="modal-dialog">
      <div class="modal-content">
         <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">x</button>
            <h4 class="modal-title" id="modal-title"> <?php echo __("Choose payment method","premiumpress"); ?></h4>
         </div>
         <div class="modal-body">
            <?php if(is_numeric($payment_due) && $payment_due > 0){ ?>
            <div><?php echo __("Total due:","premiumpress"); ?><?php echo hook_price($payment_due); ?></div>
            <?php } ?>
            <div id="author-toolbox-payment-options"></div>
         </div>
      </div>
   </div>
</div>
<!-- end payment form -->
<script>
   function ajax_show_enhancements(){
   
       jQuery.ajax({
           type: "POST",
           url: '<?php echo home_url(); ?>/',		
   		data: {
               action: "listing_enhancements",			 
   			pid: <?php echo $post->ID; ?>,			 
           },
           success: function(response) {
   		
   			jQuery('#modal-title').html("Choose an upgrade option");
   			
   			if(response == ""){
   			jQuery('#author-toolbox-payment-options').html('<?php echo __("No upgrades available.","premiumpress"); ?>');
   			}else{
   			jQuery('#author-toolbox-payment-options').html(response);
   			}
   						
   			
   			
           },
           error: function(e) {
               //alert("error "+e)
           }
       });
   
   }
   
   <?php if(_ppt('renewlisting') == 1){ ?>
   function ajax_relist_payment(){
   
       jQuery.ajax({
           type: "POST",
           url: '<?php echo home_url(); ?>/',		
   		data: {
               action: "load_payment_form",
   			amount: <?php if(isset($relist['price'])){ echo $relist['price']; }else{ echo 0; } ?>,
   			orderid: 'REW-<?php echo $post->ID; ?>-<?php echo $userdata->ID."-".date("Ymds"); ?>',
   			desc: 'Relist Payment',
   			pid: '',
   			subscription: false,
   			credit: false,
           },
           success: function(response) {			
   			jQuery('#author-toolbox-payment-options').html(response);
   			
           },
           error: function(e) {
               alert("error "+e)
           }
       });
   
   }
   function ajax_relist_listing(){
   
       jQuery.ajax({
           type: "POST",
           url: '<?php echo home_url(); ?>/',	
   		dataType: 'json',	
   		data: {
               action: "listing_relist",
   			pid: <?php echo $post->ID; ?>,
           },
           success: function(response) {			
   			if(response.status == "ok"){
   			
   				// RELOAD PAGE
   				window.open('<?php echo get_permalink($post->ID); ?>', "_self");
   			 
   			} 			
           },
           error: function(e) {
               alert("error "+e)
           }
       });
   
   }
   <?php } ?>
    
    
    
      
   function ajax_delete_listing(){
   
   if(confirm("Are you sure?")){
   
       jQuery.ajax({
           type: "POST",
           url: '<?php echo home_url(); ?>/',	
   		dataType: 'json',	
   		data: {
               action: "listing_delete",
   			pid: <?php echo $post->ID; ?>,
           },
           success: function(response) {			
   			if(response.status == "ok"){	
   							
   				window.open('<?php echo _ppt(array('links','myaccount')); ?>', "_self");			 
     		 	
   			}else{			
   				jQuery('#ajax_response_msg').html("error trying to delete");			
   			}			
           },
           error: function(e) {
               alert("error "+e)
           }
       });
   }// end are you sure
   
   }
</script>
