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

 
/* =============================================================================
   DISPLAY PACKAGES
   ========================================================================== */ 

 
// PACKAGE /MEMEBERSHIP DATA
$csubscriptions = get_option("csubscriptions"); 


	
	// CHECK FOR HIDDEN PACKAGES
	$hideME = array();	
	$f = get_user_meta($userdata->ID, 'wlt_subscription',true);
	if(is_array($f)){
 
		if(is_array($csubscriptions) && !empty($csubscriptions) ){ 
		 
			$i=0; 
			foreach($csubscriptions['name'] as $xxx){ 
				if(strlen($xxx) > 0){
				 
					if(is_array($csubscriptions['hide'][$i]) && $f['key'] == $csubscriptions['key'][$i] ){
					
						foreach($csubscriptions['hide'][$i] as $j  ){  
							
							$hideME[] = $j;
						
						}
					
					} // end if
				
				
				}
			$i++;
			}
			
		} // end if
	
	}// end if
 

// LOOP ID
$i = 1; $shown = 0;
 
// START LLOOP 
if(is_array($csubscriptions) && !empty($csubscriptions) ){ $i=0; 

foreach($csubscriptions['name'] as $data){ 

	if($csubscriptions['name'][$i] != "" ){
	
	if(in_array($csubscriptions['key'][$i], $hideME)){ $i++; continue; } 
 
	// HIDE ALSO IF EXISTING PACKAGE HAS THIS MEMBERSHIP
	//if(isset($GLOBALS['current_membership']) && is_numeric($GLOBALS['current_membership']) && $GLOBALS['current_membership'] == $field['ID']){ continue; }
	
	// WORK OUR PRICE
	$PRICE = hook_price($csubscriptions['price'][$i]);
	if($csubscriptions['price'][$i] == 0){
		$p0 = "";
		$p1 = __("FREE","premiumpress");
		$p2 = "";
		$isfree = true;
	}else{
		$pb = explode(".",$PRICE);
		$p0 = hook_currency_symbol('');
		$p1 = $pb[0];
		if(isset($pb[1])){
		$p2 = $pb[1];	
		}else{
		$p2 = "00";
		}
		$isfree = false;
	}
 
	// WORK OUR DAYS
	$DAYS = $csubscriptions['days'][$i];
	
	if($DAYS == 30){
	
	$days = __("Month","premiumpress");
	
	
	}elseif($DAYS == 365){
	
	$days = __("Year","premiumpress");
	
	}elseif(!is_numeric($DAYS)){
	$days = " ";
	}else{
	$days = $DAYS ." ".__("Days","premiumpress");
	}
	
	// INCREASE 
	$shown++;




?>
  
<div class="col-md-4 col-sm-6 col-xs-12 pricing-tab price-color<?php echo $i; ?> <?php if($csubscriptions['active'][$i] == 1){ ?>pricing-active<?php } ?> ">
						<div class="price-head text-center">
							<h3><?php echo stripslashes($csubscriptions['name'][$i]); ?></h3>
							<p class="price-text"><?php echo stripslashes($csubscriptions['subtitle'][$i]); ?></p>
							<p class="price-label">
								<span class="unit"><?php echo $p0; ?></span>
                                <?php  if($isfree){ ?>
                                <span class="free"><?php echo $p1; ?></span>
                                <?php }else{ ?>
                                <span class="number"><?php echo preg_replace("/[^0-9,.]/", "", $p1); ?></span>
                                <?php } ?>
								
				 				<span class="cents"><?php echo $p2; ?></span>
                                <?php  if(!$isfree){ ?>
								<span class="delay"><?php echo $days; ?>&nbsp;</span>
                                <?php } ?>
							</p> 
                             <?php if($csubscriptions['icon'][$i] != ""){ ?>
							<div class="price-icon text-center">
								<i class="fa <?php echo $csubscriptions['icon'][$i]; ?>" aria-hidden="true"></i>
							</div>
                            <?php } ?>
                            
                            <?php if($csubscriptions['stars'][$i] > 0){ ?>
                            <div class="ribbon">
								<div class="base">
                                <?php $s=0; while($s < $csubscriptions['stars'][$i]){ ?>
									<span class="fa fa-star"></span>
								<?php $s++; } ?>
								</div>
							</div>
                            <?php } ?>
						</div>
						<div class="price-content text-center">
							<div class="desc">
                            
                            <?php if(isset($csubscriptions['desc'][$i])){ echo wpautop( stripslashes($csubscriptions['desc'][$i]) ); } ?>
                            </div>
							<div class="text-center">
								<a class="btn submit white caps"  <?php if($userdata->ID){ ?> href="javascript:void(0);" onclick="processSubscription('<?php echo 
								$CORE->order_encode(array(
								
								"uid" => $userdata->ID, 
								
								"amount" => $csubscriptions['price'][$i], 
								
								"local_currency_amount" => $csubscriptions['price'][$i],
								"local_currency_code" => $CORE->_currency_get_code(),
								
								"order_id" => "SUBS-".str_replace("-s","",$csubscriptions['key'][$i])."-".$userdata->ID."-".rand(), 
								 
								"description" => stripslashes($csubscriptions['name'][$i]),								
								
								"recurring" => $csubscriptions['recurring'][$i]
								
								) 								
								); 
								?>');"<?php }else{ ?>href="<?php echo site_url('wp-login.php?action=login', 'login_post'); ?>"<?php } ?>><?php echo __("Select Package","premiumpress") ?></a>	
							</div>
						</div>
</div>

 
 
<?php } $i++; } } ?> 