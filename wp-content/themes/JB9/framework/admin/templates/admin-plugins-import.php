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


// LOAD IN MAIN DEFAULTS 
$core_admin_values = get_option("core_admin_values");  
  
?> 


 
 
<?php

$plugins = array(

 
 
1 => array("title" => "Import Tool Add-ons"),

	"wlt_csv" => array("t" => "CSV Import Plugin", "d" => "This plugin will let you import/export listing data via CSV.", "i" => "csv.png",  ),
	
	"wlt_youtube" => array("t" => "YouTube Video Import Plugin", "d" => "This plugin lets you import Youtube videos into your website.", "i" => "youtube.png",  ),
	
	"wlt_vimeo" => array("t" => "Vimeo Video Import Plugin", "d" => "This plugin lets you import Vimeo videos into your website.", "i" => "vimeo.jpg",  ),
	
	"wlt_icodes" => array("t" => "iCodes Coupon Plugin", "d" => "This plugin lets you import coupon codes from icodes.", "i" => "icodes.png",  ),

	"wlt_amazon" => array("t" => "Amazon Import Plugin", "d" => "This plugin lets you import products from Amazon.", "i" => "amazon.png",  ),

	"wlt_ebay" => array("t" => "eBay Import Plugin", "d" => "This plugin lets you import items from eBay", "i" => "ebay.png",  ),
	
	
	"wlt_prosperent" => array("t" => "Prosperent Import Tool", "d" => "This plugin lets you import items using the Prosperent API.", "i" => "pro.png",  ),
	
	
	"wlt_datafeedrv4" => array("t" => "Datafeedr Import Tool", "d" => "This plugin lets you import items using the Datafeedr v4 API.", "i" => "df.png",  ),
	
	
	"wlt_indeed" => array("t" => "Indeed Jobs Import Tool", "d" => "This plugin lets you import jobs using the Indeed API.", "i" => "indeed.png",  ),
	
 

);


if(defined('WLT_CART')){
unset($plugins['wlt_website_thumbnails']);
unset($plugins['wlt_youtube']);
}else{
unset($plugins['wlt_shipping_ups']);
}

if(!defined('WLT_JOBS')){	
unset($plugins['wlt_indeed']);
}
 
if(!defined('WLT_COUPON')){
unset($plugins['wlt_icodes']);
}




foreach($plugins as $key => $p){ ?>
<?php if(isset($p['title'])){ ?>  

<?php }else{ ?>
<div class="bold font-size18"><?php echo $p['t']; ?></div>
<hr />

<div class="row">
<div class="col-md-3">
  <a class="media-left" href="#">
	<img src="<?php echo get_template_directory_uri(); ?>/framework/admin/img/gateways/<?php echo $p['i']; ?>" style="width:100px;" />
  </a>
</div>
<div class="col-md-8">
 
   <div><?php echo $p['d']; ?></div>
   
   <a href="<?php echo home_url(); ?>/wp-admin/plugin-install.php?tab=plugin-information&plugin=<?php echo $key; ?>&TB_iframe=true&width=772&height=513" class="btn btn-primary mt-3 mb-3">Install Now</a>
  
  </div>
</div>
<div class="clearfix"></div>

<?php }?>

<?php } ?>