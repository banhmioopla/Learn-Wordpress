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

global $CORE, $userdata, $post, $settings; 


if(is_single()){
	$link = get_permalink($post->ID);
	$title = $post->post_title;
}else{
	$link = home_url();
	$title = "";
}

$link  = str_replace("&","&amp;", $link );

if(!_ppt_checkfile("widget-button.php")){?>


<a href="<?php echo _ppt(array('links','add')); ?>" class="btn btn-lg btn-primary py-3 rounded-0 btn-block mb-4 text-uppercase font-weight-bold">

<?php

if(isset($settings['title']) && strlen($settings['title']) > 1 ){ echo $settings['title']; }else{

switch(strtoupper(THEME_KEY)){				
					case "DT": { echo '<i class="fas fa-map-marked-alt mr-3"></i> '.__("Add Business","premiumpress");  } break;
					case "AT": { echo '<i class="fas fa-plus mr-3"></i> '.__("Add Auction","premiumpress");  } break;					
					case "CP": { echo '<i class="fas fa-plus mr-3"></i> '.__("Add Coupon","premiumpress");  } break;
					case "DP": { echo '<i class="fas fa-plus mr-3"></i> '.__("Add Profile","premiumpress");  } break;
					case "JB":
					case "MJ": { echo '<i class="fas fa-plus mr-3"></i> '.__("Add Job","premiumpress");  } break;
					case "CT": { echo'<i class="fas fa-plus mr-3"></i> '. __("Add Classified","premiumpress");  } break;
					case "VT": { echo'<i class="fas fa-plus mr-3"></i> '. __("Add Video","premiumpress");  } break;
					case "SO": { echo'<i class="fas fa-plus mr-3"></i> '. __("Add Software","premiumpress");  } break;
					
					
					case "DA": { 
					 
					 if($userdata->ID){
					 echo'<i class="fas fa-pencil mr-3"></i> '. __("Edit Profile","premiumpress"); 
					 }else{
					 echo'<i class="fal fa-users-medical mr-3"></i> '. __("Add Profile","premiumpress"); 
					 }
					 
					  } break;
					
					
					default: { echo '<i class="fas fa-plus mr-3"></i> '.__("Add Listing","premiumpress");  } break;				
}// end switch

}
?>
 
 
 </a>

<?php } ?>