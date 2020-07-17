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

global $CORE, $userdata; 

	// 1. GET THE USERS CREDIT
	$user_credit = get_user_meta($userdata->ID,'wlt_usercredit',true);
	if($user_credit == "" || !is_numeric($user_credit) ){ $user_credit = 0; }
	
// GET DATA
$wdata1 = $wpdb->get_results("SELECT count(*) as total FROM ".$wpdb->prefix."core_withdrawal WHERE user_id='".$userdata->ID."' AND withdrawal_status = 0 LIMIT 1", OBJECT);

 if($wdata1[0]->total == 1){ 
?>
 
<section class="p3 p-lg-5 bg-white ">

<div class="p-5 text-center">
<h2><?php echo __("You have a pending request","premiumpress"); ?></h2>
<p class="mt-4"><?php echo __("Please wait for our admin to accept/decline your current request.","premiumpress"); ?></p>
</div>

</section>

<?php }else{ ?>

<section class="p3 p-lg-5 bg-white ">

<h5><?php echo __("Cashout Funds","premiumpress"); ?></h5>
      <p><?php echo __("Please complete the form below and one of our team will contact you back ASAP to arrange payment.","premiumpress"); ?></p>
      <hr />
      
<div class="row clearfix">
   <div class="col-md-8">
      
      <form  role="form" method="post" action="" onsubmit="return CheckFormData();" class="mb-4 mt-3">
         <input type="hidden" name="action" value="cashoutform" />
         <div class="row">
            <div class="col-md-12">
               <label><?php echo __("Message","premiumpress"); ?></label>
               <textarea class="form-control rounded-0" style="height:200px;" name="cashout-message" id="cashout-message"></textarea>
               <label class="mt-3"><?php echo __("Amount","premiumpress"); ?></label>
               
               <div class="input-group" style="width:200px;">
                  <span class="input-group-prepend input-group-text rounded-0"><?php echo _ppt(array('currency','symbol')); ?></span>
                 <input type="text" class="form-control rounded-0" name="cashout-amount" id="cashout-amount"/>
               </div>
               
            </div>
            <div class="col-md-12">
               <button class="btn btn-primary my-4" type="submit"><?php echo __("Request Cashout","premiumpress"); ?></button>
            </div>
         </div>
      </form>
   </div>
   <div class="col-md-4">
      <div class="card  text-center mt-5">
         <div class="card-header"><?php echo __("Current Balance","premiumpress"); ?></div>
         <div class="card-body">
            <h4><?php echo hook_price($user_credit); ?></h4>
         </div>
      </div>
   </div>
</div>
</section>
<?php } ?>
<script>
   function CheckFormData()
   { 
   	 
   	var amount = document.getElementById("cashout-amount");
   	var message = document.getElementById("cashout-message");	
    
   
   	if(message.value == '')
   	{
   		alert('<?php echo __("Please add some details about why you are cashing out.","premiumpress") ?>');
   		message.focus();
   		message.style.border = 'thin solid red';
   		return false;
   	} 		
   	
   
   	if(amount.value == '')
   	{
   		alert('<?php echo __("Please enter a valid amount.","premiumpress") ?>');
   		amount.focus();
   		amount.style.border = 'thin solid red';
   		return false;
   	} 
	
	  if(amount.value > <?php echo $user_credit; ?>)
   	{
   		alert('<?php echo __("Please enter a valid amount.","premiumpress") ?>');
   		amount.focus();
   		amount.style.border = 'thin solid red';
   		return false;
   	} 
   	
   	return true;
   }
   
   
</script>