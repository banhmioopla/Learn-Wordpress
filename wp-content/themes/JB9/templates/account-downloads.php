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

$SQL = "SELECT * FROM `".$wpdb->prefix."core_orders` INNER JOIN ".$wpdb->prefix."core_sessions ON ( ".$wpdb->prefix."core_sessions.session_key = ".$wpdb->prefix."core_orders.order_items ) WHERE ".$wpdb->prefix."core_orders.user_id = ('".$userdata->ID."') "; 
 
$orders = (array)$wpdb->get_results($SQL);

?>

<h5><?php echo __("My Downloads","premiumpress"); ?></h5>

<hr class="dashed mb-3" />  


<?php if(!empty($orders)){ $i = 1; ?>

                
<div class="row">

<?php

	foreach($orders as $order){
 	
	// RESTORE THE CART DATA
	$cart_data = unserialize($order->session_data);	
				 			
	// NOW WE LOOP ALL ITEMS AND REMOVE THE QTY IF REQUIRED
	if(isset($cart_data['items']) && is_array($cart_data['items'])){
	
		foreach($cart_data['items'] as $key=>$item){ 
		
			foreach($item as $mainitem){
			 
			 // GET THE FIRST IMAGE
			 $files = $CORE->media_get($key,'all');
			 $file_to_download = $files[0];	
			 
			 // LETS GET THE DIMENTION SIZES
			 $DIMENTIONS =  $file_to_download['dimentions'];
			 
			 if(isset($mainitem['custom_data']) && is_array($mainitem['custom_data']) && !empty($mainitem['custom_data']) ){
			 	foreach($mainitem['custom_data'] as $f){
				
					if($f['field'] == "priceon" && get_post_meta($key,'price-'.$f['key'].'-size',true) != "" ){
						
						$DIMENTIONS = get_post_meta($key,'price-'.$f['key'].'-size',true);
						
					}
				}
			}
			
			$meia_w = ""; $meia_h = "";
			
			// FALLBACK
			if($DIMENTIONS != ""){
				$gg = explode("x",$DIMENTIONS);
				$meia_w = $gg[0];
				$meia_h = $gg[1];
			}
			
			// GET THE FILE ID
			$FILEID = $file_to_download['id'];
			
			// GET TYPE
			// CHECK FILE TYPE
			$fullsize_path = get_attached_file( $FILEID );
			 
			// GET FILE TYPE
			$wp_filetype = wp_check_filetype( $fullsize_path, null );
			
			// DOWNLOAD ARRSY
			$data_array = array(
			"uid" 		=> $userdata->ID,
			"pid" 		=> $key,
			"aid" 		=> $FILEID,
			"width" 	=> $meia_w,
			"height" 	=> $meia_h, 
			"type" 		=> $wp_filetype['type'], 
			);
 
?>

<div class="col-md-6">
<div class="box-grey mb-3"><div class="box-grey-wrap">
<div class="row">

<div class="col-6">
<?php echo do_shortcode('[IMAGE pid='.$key.']'); ?>
</div>

<div class="col-6">

    <h5><?php echo $mainitem['name']; ?></h5>
    
    <ul class="list-inline">
    <li><?php echo __("Size","premiumpress") ?>: <?php echo $mainitem['custom']; ?> <?php echo $DIMENTIONS; ?></li>
    <li><?php echo __("Date Ordered","premiumpress") ?>: <?php echo hook_date($order->order_date." ".$order->order_time); ?></li>
    
    </ul>
    
    <form method="post" action="" class="mt-3">
    <input type="hidden" name="data" value="<?php echo base64_encode( json_encode( $data_array ) ); ?>" />
    <input type="hidden" name="downloadproduct" value="1" />
    <button type='submit' class='btn btn-primary'><i class="fa fa-download"></i> <?php echo __("Download","premiumpress") ?></button>
    </form>
    
     
</div>
 
</div>

</div></div>

</div>

<?php 					 
						}// end foreach
					}// end if
			}// end if 
 
} // end if
 

?> 

</div><!-- end row -->
       

<?php }else{ ?>

<p class="small grey"><?php echo __("No downloads found","premiumpress"); ?></p>

<?php } ?>