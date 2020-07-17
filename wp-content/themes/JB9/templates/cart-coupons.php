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

global $table_data, $CORE, $CORE_CART, $userdata, $wpdb;
 
if(isset($GLOBALS['CORE_THEME']['couponcodes']) && $GLOBALS['CORE_THEME']['couponcodes'] != '1'){ return; }  


$wlt_coupons = get_option("wlt_coupons");
 


// ERROR MESSAGE
if(isset($GLOBALS['flag-single']) && isset($GLOBALS['error_message']) && strlen($GLOBALS['error_message']) > 2){
$STRING .= $CORE->ERRORCLASS($GLOBALS['error_message'],'info');
}
// end
?>



<?php
// ADD IN EXTRA BIT FOR MEMBERSHIP AREA
if(isset($_POST['membershipID']) && is_numeric($_POST['membershipID']) ){
	echo '<input type="hidden" name="membershipID" value="'.$_POST['membershipID'].'" />';
}
?>

 
<a class="btn btn-secondary btn-coupon text-uppercase px-3"  id="appcouponcode" href="javascript:void(0);">

<?php echo __("Apply Coupon","premiumpress"); ?>


</a> 

<script>				
jQuery(document).ready(function(){ 								
	jQuery('#appcouponcode').click(function() {					
                             
		jQuery('#CouponCodeModal').modal('show'); 
                                
	});									
});				 
</script>

 
<!-- Modal -->
<div id="CouponCodeModal" class="modal fade addcart" tabindex="-1" role="dialog">

  <div class="modal-dialog"><div class="modal-wrap"><div class="modal-content">
 
 
  <div class="modal-body py-5"> 
  
	<form  name="couponcodes" id="couponcodesform" method="post">
      
      <h5><?php echo __("Coupon Code","premiumpress"); ?> </h5>
                
		<input type="text" id="wlt_couponcode" name="wlt_couponcode" class="form-control input-lg rounded-0">
                
		<p class="help-block mt-1"><?php echo __("You can only use one discount code at a time.","premiumpress"); ?></p>
				 
		<button class="btn btn-2" type="submit"><?php echo __("Apply Coupon","premiumpress"); ?></button>
                
  </form>
  </div>

</div></div></div>

</div><!-- end modal -->    
