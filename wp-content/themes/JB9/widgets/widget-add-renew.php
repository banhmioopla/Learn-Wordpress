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

global $CORE, $userdata, $post; 

 
if(!_ppt_checkfile("widget-add-renew.php")){?>


<div class="widget mb-4 shadow-sm contactusbtn">
   
      <h4><?php echo __("Have a question?","premiumpress"); ?></h4>
      <p><?php echo __("Contact our support team anytime with your questions.","premiumpress"); ?></p>
      <a href="<?php echo _ppt(array('links','contact')); ?>" class="btn btn-warning btn-lg btn-block mt-3 rounded-0 text-light font-weight-bold"><?php echo __("Contact Us","premiumpress"); ?></a>
   </div>


   <div class="widget packagedetailsbox mb-4 shadow-sm" style="display:none;">
      <ul class="payment-right small list-unstyled" >
         <li style="border-top:0px;">
            <div id="package-type" class="left">
               <?php echo __("Package","premiumpress"); ?>
            </div>
            <div class="right">
               <span class="ppname">xxx</span>
            </div>
            <div class="clearfix"></div>
         </li>
         <?php if(!isset($_GET['eid'])){ ?>
         <li class="pptime-wrap">
            <div class="left"><?php echo __("Period","premiumpress"); ?></div>
            <div class="right">
               <span class="pptime">xx</span>
            </div>
            <div class="clearfix"></div>
         </li>
         <?php } ?>
         <?php if(isset($_GET['eid'])){ 
            $expires = $CORE->get_listing_expirydate($_GET['eid']);
            
            //
            $paiddate = get_post_meta($_GET['eid'], 'paid_date', true);
            $paid_invoiceid = get_post_meta($_GET['eid'], 'paid_invoiceid', true);
            
            
            ?>
         <li>
            <div class="left"><?php echo __("Published","premiumpress"); ?>:</div>
            <div class="right">
               <span class="pptimepublished"><?php echo hook_date(get_the_date($_GET['eid']));   ?></span>
            </div>
            <div class="clearfix"></div>
         </li>
         <li>
            <div class="left"><?php echo __("Expires","premiumpress"); ?>:</div>
            <div class="right">
               <span class="pptimeleft"><?php if($expires == 0){ echo __("Never Expires","premiumpress"); }else{ echo hook_date($expires); } ?></span>
            </div>
            <div class="clearfix"></div>
         </li>
         <li>
            <div class="left"><?php echo __("Views","premiumpress"); ?>:</div>
            <div class="right">
               <span class="pptimeleft"><?php echo do_shortcode('[HITS pid="'.$_GET['eid'].'"]'); ?></span>
            </div>
            <div class="clearfix"></div>
         </li>
         <?php } ?>
         <li>
            <div class="left"><strong><?php if(isset($_GET['eid']) && $paiddate != "" && get_post_meta($_GET['eid'],'freelisting', true) != 1 ){ echo __("Total Paid","premiumpress"); }else{ echo __("Total","premiumpress"); } ?>:</strong></div>
            <div class="right">	
            <?php if( isset($_GET['eid']) && get_post_meta($_GET['eid'],'freelisting', true) == 1 ){ ?>
            <span><?php echo __("FREE","premiumpress"); ?></span>	
            <?php }else{ ?>
               <span class="ppprice"></span>			
               <?php } ?>			 
            </div>
            <div class="clearfix"></div>
         </li>
      </ul>
      <?php if(isset($_GET['eid'])  && $paiddate != "" && get_post_meta($_GET['eid'],'freelisting', true) != 1 ){  ?>
      <ul class="list-unstyled small">
         <li>
            <?php echo __("Payment Recieved","premiumpress"); ?>: 
            <div><?php echo hook_date($paiddate); ?></div>
         </li>
         <?php if($paid_invoiceid != ""){ ?>
         <li class="mt-2">
            <?php echo __("Payment Invoice","premiumpress"); ?>: 
            <div> 
               <a href="<?php echo get_template_directory_uri(); ?>/_invoice.php?invoiceid=<?php echo $paid_invoiceid; ?>" target='_blank' style='text-decoration:underline;'>
               #<?php echo $CORE->order_get_orderid($paid_invoiceid); ?>
               </a>
            </div>
         </li>
         <?php } ?>
      </ul>
      
      
      <?php if(_ppt('pak'.get_post_meta($_GET['eid'],'packageID',true).'_duration') > 0){ ?>
      <div style="margin:-20px;" class="bg-light p-3 mt-4 border-top">
     
      
      <h6><?php echo __("Renew this listings!","premiumpress"); ?></h6>
      
      <div class="text-muted small"><?php echo str_replace("%a",_ppt('pak'.get_post_meta($_GET['eid'],'packageID',true).'_duration'), str_replace("%b", hook_price(_ppt('pak'.get_post_meta($_GET['eid'],'packageID',true).'_price')), __("Extend the listing for an additonal %a days for only %b","premiumpress") )); ?></div>
      
       
       
     <script>
function ajax_renewlisting_payment(){

		ChangeSteps(3); 
		jQuery('#vlistingbutton').hide();
   
       jQuery.ajax({
           type: "POST",
           url: '<?php echo home_url(); ?>/',		
   		data: {
            action: "load_new_payment_form",
			details: jQuery('#ajax_renewlisting_payment_data').val(),
           },
           success: function(response) {
   			
   			jQuery('#ajax_payment_form').html(response);
   			jQuery('#credit-payment-form').show();
   			
           },
           error: function(e) {
               alert("error "+e)
           }
       });
   
   }
 
</script>
       
      <button class="btn btn-success btn-block mt-3" onclick="ajax_renewlisting_payment();" type="button"><?php echo __("Renew Now","premiumpress"); ?></button>
       
      </div>
      <textarea id="ajax_renewlisting_payment_data" style="display:none;">
      <?php    
			   
$cartdata = array(
	"uid" => $userdata->ID, 
	"amount" => _ppt('pak'.get_post_meta($_GET['eid'],'packageID',true).'_price'), 	
	"local_currency_amount" => $CORE->price_format_display(array(_ppt('pak'.get_post_meta($_GET['eid'],'packageID',true).'_price'), false ) ),
	"local_currency_code" => $CORE->_currency_get_code(),	
	"order_id" => "RENEW-".$_GET['eid']."-".date("Ymds"),
	"description" => "Listing Renewal #".$_GET['eid'],	
	"recurring" => 0,								
);
echo $CORE->order_encode($cartdata); ?>
      </textarea>
      <?php } ?>
      
      
      
      <?php } ?> 

<?php } ?>