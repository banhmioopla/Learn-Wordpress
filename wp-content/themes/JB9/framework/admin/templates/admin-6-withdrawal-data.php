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
if (!defined('THEME_VERSION')) {	header('HTTP/1.0 403 Forbidden'); exit; } ?>
<?php

// GET DATA
$wdata1 = $wpdb->get_results("SELECT * FROM ".$wpdb->prefix."core_withdrawal WHERE autoid='".$_GET['wid']."' ORDER BY autoid DESC LIMIT 1", OBJECT);
$wdata = $wdata1[0];

?>
<form action="" method="post" style="margin-bottom:0px; margin-top:10px;">
<input type="hidden" name="submitted" value="no">
<input type="hidden" name="page" value="6">
<input type="hidden" name="tab" id="ShowTab" value="tab-cashout">

<input name="savewidthdrawal" type="hidden" value="yes">
<input type="hidden" name="autoid" value="<?php echo $wdata->autoid; ?>">	 
<input type="hidden" name="user_id" value="<?php echo $wdata->user_id; ?>"> 



<div class="row">
<div class="col-lg-8">
   <div class="bg-white p-5 shadow" style="border-radius: 7px;">
      <div class="tabheader mb-4">
         <h4><span>Withdrawal Information</span></h4>
      </div>



 
 

<h6>User Comments / Payment Preferences</h6>

<textarea style="height:150px; width:100%; height:200px !important;" name="comments" class="form-control my-4"><?php echo $wdata->withdrawal_comments; ?></textarea>



<div class="bg-light p-4 mt-4">

<div class="row">
	<div class="col-2">
	<?php echo get_avatar($wdata->user_id); ?>
    <style>.span4 .avatar { min-width:200px; min-height:200px; border:1px solid #ddd; padding:2px; background:#fff; }</style>
    </div>
	<div class="col-8">
    <?php $uf = get_userdata($wdata->user_id);  ?>
    <h3><?php echo $uf->user_login; ?></h3>
	<p>Name: <?php echo $uf->first_name." ".$uf->last_name; ?></p>
 	<p>Email: <?php echo $uf->user_email; ?></p>
    <p>Phone: <?php echo get_user_meta($wdata->user_id,'phone',true); ?></p>
    <p>Registered: <?php echo $uf->user_registered; ?></p>
    <p>Profile Link: <a href="<?php echo get_author_posts_url( $wdata->user_id ); ?>" target="_blank"><?php echo get_author_posts_url( $wdata->user_id ); ?></a> </p>
    
    </div>
</div>
</div>

</div>

 
</div>
<div class="col-lg-4">


<div class="p-5 bg-light">

<h4 class="mt-4">Amount Requested</h4>

<p>(user total amount <?php echo hook_price(get_user_meta($wdata->user_id,'wlt_usercredit',true)); ?>)</p>
<input type="text" name="amount" class="form-control" value="<?php echo $wdata->withdrawal_total; ?>">
 

<h4 class="mt-4">Status</h4>

<p class="text-muted">Changing to paid will deduct the amount from this users credit total.</p>

<input type="hidden" name="oldstatus" value="<?php echo $wdata->withdrawal_status; ?>" class="form-control" />
<select name="status" style="font-size:14px; width:100%;">
<option value="0" <?php if($wdata->withdrawal_status == 0){ echo "selected=selected"; } ?>>Pending</option>
<option value="1" <?php if($wdata->withdrawal_status == 1){ echo "selected=selected"; } ?>>Paid</option>            
</select>
 
               
<button class="btn btn-primary btn-block rounded-0 mt-5" type="submit">Update Order</button>



</div>
</div>
</div>


</form>
