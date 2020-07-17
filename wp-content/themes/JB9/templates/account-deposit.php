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

global $CORE, $userdata; $membershipfields = get_option("membershipfields");

// 1. GET THE USERS CREDIT
$user_credit = get_user_meta($userdata->ID,'wlt_usercredit',true);
if($user_credit == "" || !is_numeric($user_credit) ){ $user_credit = 0; }
	
	
// 2. GET THE USERS TOKENS
$user_tokens = get_user_meta($userdata->ID,'wlt_usertokens',true);
if($user_tokens == "" || !is_numeric($user_tokens)){ $user_tokens = 0; }
 
?>
<div  style="display:none" id="credit-payment-form">
<div class="card card-payment-box mb-5">
   <div class="card-header"><?php echo __("Make Payment","premiumpress"); ?></div>
   <div class="card-body">
   <div id="ajax_payment_form"></div>
   </div>
</div>
</div>




<?php /* if(_ppt('credit_system') != 1){ ?>


<div class="row clearfix">
   <div class="col-md-8">
      <h5><?php echo __("Deposit Funds","premiumpress"); ?></h5>
      <hr />
      <div class="row">
         <div class="col-md-6">
            <select class="form-control" id="deposit_credit">
               <?php 
                  $deposits = array("5","10","20","30","40","50","60","70","80","90","100","150","200");
                  foreach( $deposits as $v){ ?>
               <option value="<?php
			   
			   
$cartdata = array(
	"uid" => $userdata->ID, 
	"amount" => $v, 	
	"local_currency_amount" => $CORE->price_format_display(array($v, false ) ),
	"local_currency_code" => $CORE->_currency_get_code(),	
	"order_id" => "CREDIT-".$userdata->ID."-".date("Ymds"),
	"description" => "Deposit Funds for Credit",	
	"recurring" => 0,								
);
echo $CORE->order_encode($cartdata); ?>"><?php echo hook_price($v); ?></option>
               <?php } ?>
            </select>
         </div>
         <div class="col-md-6">
            <button class="btn btn-primary px-4" onclick="ajax_deposit_payment('deposit_credit');"><?php echo __("Make Payment","premiumpress"); ?></button>
         </div>
      </div>
      
      <div class="mt-4">
         <p><?php echo __("Credit is non-refundable and expires after one year.","premiumpress"); ?></p>
        
      </div>
   </div>
   <div class="col-md-4">
      <div class="card  text-center">
         <div class="card-header"> <i class="fal fa-award"></i> <?php echo __("Current Balance","premiumpress"); ?></div>
         <div class="card-body ">
            <h4 class="ebold"><?php echo hook_price($user_credit); ?></h4>
         </div>
      </div>
   </div>
</div>
<?php } */ ?>


 

<?php if(_ppt('token_system') != 1){ ?>


<section class="p3 p-lg-5">
<div class="row mb-2 clearfix">

<div class="col-md-8">

<h5><?php echo __("Deposit Funds for Tokens","premiumpress"); ?></h5>

<hr />

<div class="row">
<div class="col-md-6">
    <select class="form-control" id="deposit_tokens">
    <?php 
	
	$deposits = array("5","10","20","30","40","50","60","70","80","90","100","150","200");
	foreach( $deposits as $v){ ?>
    <option value="<?php
			   
			   
$cartdata = array(
	"uid" => $userdata->ID, 
	"amount" => $v, 	
	"local_currency_amount" => $CORE->price_format_display(array($v, false ) ),
	"local_currency_code" => $CORE->_currency_get_code(),	
	"order_id" => "TOKEN-".$userdata->ID."-".date("Ymds"),
	"description" => "Deposit Funds for Tokens",	
	"recurring" => 0,								
);
echo $CORE->order_encode($cartdata); ?>"><?php echo hook_price($v)." = ".$CORE->credit_exchangerate($v, "tokens"); ?> <?php echo __("tokens","premiumpress"); ?></option>
    <?php } ?>
    </select>
</div>
<div class="col-md-6">

<button class="btn btn-primary px-4" onclick="ajax_deposit_payment('deposit_tokens');"><?php echo __("Make Payment","premiumpress"); ?></button>

</div>

</div>


 

<div class="mt-4">

<p><?php echo __("Tokens are non-refundable and expire after one year.","premiumpress"); ?></p>

 <p><?php echo __("For larger amounts","premiumpress"); ?> <a href="<?php echo _ppt(array('links', 'contact')); ?>" class="underline"><u><?php echo __("contact us","premiumpress"); ?></u>.</a> </p>

 
</div>

</div>
<div class="col-md-4">

    <div class="card  text-center">
    
        <div class="card-header"> <i class="fa fa-money"></i> <?php echo __("Current Balance","premiumpress"); ?></div>
    	
        <div class="card-body text-center">
        
        	<h4 class="ebold"><?php echo $user_tokens; ?></h4> <span class="small text-uppercase"><?php echo __("tokens","premiumpress"); ?></span> 
    	
        </div>
        
    </div>

</div>

</div><!-- end mb-2 --> 

</section>

<?php } ?>

 
<script>
function ajax_deposit_payment(hh){
   
       jQuery.ajax({
           type: "POST",
           url: '<?php echo home_url(); ?>/',		
   		data: {
            action: "load_new_payment_form",
			details: jQuery('#'+hh).val(),
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