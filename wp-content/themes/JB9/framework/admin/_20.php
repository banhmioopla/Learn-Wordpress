<?php
// CHECK THE PAGE IS NOT BEING LOADED DIRECTLY
if (!defined('THEME_VERSION')) {	header('HTTP/1.0 403 Forbidden'); exit; }
// SETUP GLOBALS
global $wpdb, $CORE, $userdata, $CORE_ADMIN;

// LOAD IN OPTIONS FOR SORTING DATA
wp_enqueue_script( 'jquery-ui-sortable' );
wp_enqueue_script( 'jquery-ui-draggable' );
wp_enqueue_script( 'jquery-ui-droppable' );

if(!defined('WLT_DEMOMODE') && current_user_can('administrator')){

// COUPON CODE SETTINGS
if(isset($_POST['newcoupon']) && strlen($_POST['newcoupon']) > 0){
			
	// GET EXISTING FIELDS THEN ADD-ON THE NEW ONE
	$wlt_coupons = get_option("wlt_coupons");
	if(!is_array($wlt_coupons)){ $wlt_coupons = array(); }
	// ADD ONE NEW FIELD 
	if(!isset($_POST['eid'])){
		array_push($wlt_coupons, $_POST['wlt_coupon']);		
		$GLOBALS['error_message'] = "Coupon Created Successfully";
	}else{
		$wlt_coupons[$_POST['eid']] = $_POST['wlt_coupon'];		
		$GLOBALS['error_message'] = "Coupon Updated Successfully";
	}
	// SAVE ARRAY DATA		 
	update_option( "wlt_coupons", $wlt_coupons);
 
				
}elseif(isset($_GET['delete_coupon']) && is_numeric($_GET['delete_coupon'] )){

	// GET EXISTING FIELDS THEN ADD-ON THE NEW ONE
	$wlt_coupons = get_option("wlt_coupons");
	if(!is_array($wlt_coupons)){ $wlt_coupons = array(); }
	
	// LOOK AND SEARCH FOR DELETION
	foreach($wlt_coupons as $key=>$pak){
		if($key == $_GET['delete_coupon']){
			unset($wlt_coupons[$key]);	 
		}
	}
	
	// SAVE ARRAY DATA
	update_option( "wlt_coupons", $wlt_coupons);
 
	$GLOBALS['error_message'] = "Coupon Deleted Successfully";
	
}

if(isset($_POST['coupon_import']) && strlen($_POST['coupon_import']) > 2 ){
	
	$wlt_coupons = get_option("wlt_coupons"); $new_coupons = array();
	if(!is_array($wlt_coupons)){ $wlt_coupons = array(); }
	$coupons = explode(PHP_EOL,$_POST['coupon_import']);
	if(is_array($coupons)){ $i=0; $g = count($wlt_coupons); $g++;
		foreach($coupons as $c){
		
			$ns = explode("[",$c);
			 
			if(strpos($ns[1],"%") === false){
				$pd = ""; $fd = $ns[1];
			}else{
				$pd = $ns[1]; $fd = "";
			}
			
			$new_coupons[$g] = array("code" => $ns[0], "discount_fixed" => str_replace("]","",$fd), "discount_percentage" => str_replace("%","",str_replace("]","",$pd)));
			$i++; $g++;
		}	
	 
		update_option( "wlt_coupons", array_merge($wlt_coupons,$new_coupons));	
	}	
 
	$GLOBALS['error_message'] =  $i." Coupons Imported Successfully";
	
}

}
 
// LOAD IN HEADER
echo $CORE_ADMIN->HEAD(1); ?>

           
<?php get_template_part('framework/admin/templates/admin', 'form-top' ); ?>
       

<?php get_template_part('framework/admin/templates/admin', '20-overview' ); ?> 


       
     <div class="bg-primary p-1 text-center mt-5 shadow" style="border-radius: 7px;">

<button type="submit" class="btn btn-lg btn-primary btn-block"><?php echo __("Save Settings","premiumpress-admin"); ?></button> 

</div>

   <?php get_template_part('framework/admin/templates/admin', 'form-bottom' ); ?>
 
<?php // LOAD IN FOOTER
echo $CORE_ADMIN->FOOTER(1); ?>







<?php if(isset($_GET['edit_coupon']) && is_numeric($_GET['edit_coupon']) ){ 
$wlt_coupons = get_option("wlt_coupons");
?>
<script>
jQuery(document).ready(function () { jQuery('#CouponModal').modal('show'); })
</script>

<?php } ?>   
<form method="post" name="admin_coupon" id="admin_coupon" action="admin.php?page=20">
<input type="hidden" name="newcoupon" value="yes" />
<input type="hidden" name="tab" value="tab-coupons" />
<?php if(isset($_GET['edit_coupon'])){ ?>
<input type="hidden" name="eid" value="<?php echo $_GET['edit_coupon']; ?>" />
<input type="hidden" name="wlt_coupon[ID]" value="<?php echo $_GET['edit_coupon']; ?>" />
<?php } ?>

<div id="CouponModal" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="CouponModalLabel" aria-hidden="true" style="margin-top:10%;">
<div class="modal-dialog" role="document"><div class="modal-content"> 
            <div class="modal-body">
              
         
            
              	 <div class="row control-group mt-4">
                <label class="control-label col-md-3" for="normal-field"><b>Code</b></label>
                <div class="controls col-md-9">
                  <input type="text"  name="wlt_coupon[code]" class="form-control" value="<?php if(isset($_GET['edit_coupon']) && isset($wlt_coupons[$_GET['edit_coupon']]['code']) ){ echo stripslashes($wlt_coupons[$_GET['edit_coupon']]['code']); }?>">
                   
                </div>
              </div> 
              
              <div class="form-row control-group row-fluid">
                <label class="control-label span3" for="normal-field"><b>Discount:</b></label>
                <div class="controls span9">
                
                <div class="row">
                
                    <div class="col-6">
                    
                    
                    
                     <div class="input-group" id="orders_date1" data-date-format="yyyy-MM-dd" style="cursor:pointer">
                    <span class="add-on input-group-prepend"><span class="input-group-text">%</span></span>
                    <input type="text"  name="wlt_coupon[discount_percentage]" class="form-control" value="<?php if(isset($_GET['edit_coupon']) && isset($wlt_coupons[$_GET['edit_coupon']]['discount_percentage']) ){ echo $wlt_coupons[$_GET['edit_coupon']]['discount_percentage']; }?>" placeholder="Percentage Value"> 
     				</div>
                     
                   
                    </div>                
                    <div class="col-6">
                    
                    
                    <div class="input-group" id="orders_date1" data-date-format="yyyy-MM-dd" style="cursor:pointer">
                    <span class="add-on input-group-prepend"><span class="input-group-text"><?php echo _ppt(array('currency','symbol')); ?></span></span>
                    <input type="text"  name="wlt_coupon[discount_fixed]" class="form-control" value="<?php if(isset($_GET['edit_coupon']) && isset($wlt_coupons[$_GET['edit_coupon']]['discount_fixed']) ){ echo $wlt_coupons[$_GET['edit_coupon']]['discount_fixed']; }?>" placeholder="Fixed Amount">
     				</div>
                    
                    
                    
        
                    </div>
                </div> 
                   
                </div>
              </div> 
           
              
            </div>
            
            <div class="modal-footer">
            
              <button class="btn btn-primary">Save changes</button>
            </div>
</div></div></div>
</form>