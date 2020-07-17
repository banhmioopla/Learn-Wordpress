<?php
// CHECK THE PAGE IS NOT BEING LOADED DIRECTLY
if (!defined('THEME_VERSION')) {	header('HTTP/1.0 403 Forbidden'); exit; }
// SETUP GLOBALS
global $wpdb, $CORE, $userdata, $CORE_ADMIN;
// LOAD IN MAIN DEFAULTS 
$core_admin_values = get_option("core_admin_values");  

// LOAD IN HEADER
echo $CORE_ADMIN->HEAD(1); ?>


   

<div class="row">

<div class="col-lg-6">

<div class="bg-white p-5 shadow" style="border-radius: 7px;">


<div class="tabheader mb-4">

 
         <h4><span>Payment Gateways</span></h4>
      </div>

 
 
<?php

$plugins = array(

1 => array("title" => "All Themes"),

"v9_gateway_stripe" => array("t" => "Stripe Payment Gateway", "d" => "This plugin will install the Stripe payment gateway onto your website.", "i" => "stripe.png", "link" => "https://stripe.com/"  ),
	

"wlt_gateway_bank" => array("t" => "Bank Details Payment Form", "d" => "This will add a new payment gateway to your PremiumPress powered website.", "i" => "bank.png",  ),

"wlt_gateway_adyen" => array("t" => "Adyen Gateway Plugin", "d" => "This plugin will install a new payment gateway into your website.", "i" => "adyen.png",  ),	

"wlt_gateway_coinpayments" => array("t" => "Coin Payments Gateway Plugin", "d" => "This plugin will install a new payment gateway into your website.", "i" => "coinpayment.png",  ),	

"wlt_gateway_authorize.net" => array("t" => "Authorize.net Payment Gateway", "d" => "This plugin will install a new payment gateway into your website.", "i" => "auth.png",  ),	

"wlt_gateway_molpay" => array("t" => "Molpay Payment Gateway", "d" => "This plugin will install a new payment gateway into your website.", "i" => "molypay.png",  ),	

"wlt_gateway_nab" => array("t" => "NAB Transact Direct Payment Gateway", "d" => "This plugin will install a new payment gateway into your website.", "i" => "nab.png",  ),	

"wlt_gateway_sagepay" => array("t" => "SagePay (AKA Protex) Payment Gateway", "d" => "This plugin will install a new payment gateway into your website.", "i" => "sagepay.png",  ),	

"wlt_gateway_ccavenue" => array("t" => "CCAvenue Payment Gateway", "d" => "This plugin will install a new payment gateway into your website.", "i" => "ccavenue.png",  ),	

"wlt_gateway_paymill" => array("t" => "PayMill Payment Gateway", "d" => "This plugin will install a new payment gateway into your website.", "i" => "paymill.png",  ),	

"wlt_gateway_braintree" => array("t" => "BrainTree Payment Gateway", "d" => "This plugin will install a new payment gateway into your website.", "i" => "braintree.png",  ),	

"wlt_gateway_worldpay" => array("t" => "WorldPay Payment Gateway", "d" => "This plugin will install a new payment gateway into your website.", "i" => "worldpay.png",  ),	

"wlt_gateway_iDeal" => array("t" => "iDeal Payment Gateway", "d" => "This plugin will install a new payment gateway into your website.", "i" => "ideal.png",  ),	

"wlt_gateway_payfast" => array("t" => "PayFast Payment Gateway", "d" => "This plugin will install a new payment gateway into your website.", "i" => "payfast.png",  ),	

"wlt_gateway_paypal_flow" => array("t" => "PayPal Flow Payment Gateway", "d" => "This plugin will install a new payment gateway into your website.", "i" => "paypalflow.png",  ),

//"wlt_gateway_stripe" => array("t" => "Stripe Payment Gateway", "d" => "This plugin will install a new payment gateway into your website.", "i" => "stripe.png",  ),
	
"wlt_gateway_payza" => array("t" => "PayZa Payment Gateway", "d" => "This plugin will install a new payment gateway into your website.", "i" => "payza.png",  ),
	
"wlt_gateway_payumoney" => array("t" => "Payumoney Payment Gateway", "d" => "This plugin will install a new payment gateway into your website.", "i" => "payumoney.png",  ),
 	
	
	
2 => array("title" => "Auction Theme Only"),


	"wlt_gateway_paypal_adaptive" => array("t" => "PayPal Adaptive Payments for Auction Theme", "d" => "This plugin will install a new payment gateway into your website.", "i" => "paypal1.png",  ),
	
 );
 
 

if(!defined('WLT_AUCTION')){	

unset($plugins[2]);
unset($plugins["wlt_gateway_paypal_adaptive"]);
}
 
 

foreach($plugins as $key => $p){ ?>
<?php if(isset($p['title'])){ ?>  

<?php }else{ ?>

 
<div class="row border-bottom mb-4">
<div class="col-md-3">
  <a class="media-left" href="#">
	<img src="https://www.premiumpress.com/_demoimages/gateways/<?php echo $p['i']; ?>" style="width:100px;" class="border rounded-1" />
  </a>
</div>
<div class="col-md-9">
<div class="pl-3">

	<div class="bold h6"><?php echo $p['t']; ?></div>
 
   <p class="desc"><?php echo $p['d']; ?></p>
   
   <a href="<?php echo home_url(); ?>/wp-admin/plugin-install.php?tab=plugin-information&plugin=<?php echo $key; ?>&TB_iframe=true&width=772&height=513" class="btn btn-primary mt-2 mb-3 mr-4">Install Plugin</a>
   
   <?php if(isset($p['link'])) { ?>
    <a href="<?php echo $p['link']; ?>" class="btn btn-primary mt-2 mb-3" target="_blank">Visit Website</a>
  
   <?php } ?>
   
 </div>
  </div>
</div>
<div class="clearfix"></div>

<?php }?>

<?php } ?>


</div></div>

<div class="col-lg-6">

  


<div class="bg-white p-5 shadow" style="border-radius: 7px;">


<div class="tabheader mb-4"> <h4><span>Theme Extras</span></h4> </div>

<?php 
$plugins = array();

$plugins["v9_youtube"] = array("t" => "YouTube Importt Plugin", "d" => "Import videos from YouTube.", "i" => "youtube.png" , "theme" => "video theme");

$plugins["wlt_vimeo"] = array("t" => "Vimeo Video Import Plugin", "d" => "Import Vimeo videos into your website.", "i" => "vim.png", "theme" => "video theme");

$plugins["v9_amazon"] = array("t" => "Amazon Import Plugin", "d" => "Import products from Amazon.", "i" => "amazon.png", "theme" => "shop theme"  );


$plugins["wlt_ebay"] = array("t" => "eBay Import Plugin", "d" => "Import items from eBay.", "i" => "ebay.png", "theme" => "shop theme"  );
	
$plugins["v9_website_thumbnails"] = array("t" => "Website Thumbnails", "d" => "Create website screenshots from listing urls.", "i" => "thumb.png", "theme" => "directory theme"  );

$plugins["v9_appthemes"] = array("t" => "App Themes Transfer", "d" => "Transfer content from an AppThemes installation.", "i" => "appthemes.png" , "theme" => "all themes"  );

$plugins["v9_icodes"] = array("t" => "iCodes Coupon Plugin", "d" => "This plugin lets you import coupon codes from icodes.", "i" => "icodes.png", "theme" => "coupon theme" );

$plugins["wlt_coupilia"] = array("t" => "Coupilia Coupon Plugin", "d" => "This plugin lets you import coupon codes from Coupilia.", "i" => "coup.png", "theme" => "coupon theme" );

$plugins["wlt_datafeedrv4"] = array("t" => "Datafeedr Import Tool", "d" => "This plugin lets you import items using the Datafeedr v4 API.", "i" => "df.png", "theme" => "comparison theme"  );

$plugins["datafeedr-api"] = array("t" => "Datafeedr API", "d" => "This plugin lets you use Datafeedr on your WordPress website.", "i" => "https://ps.w.org/datafeedr-api/assets/icon-256x256.png?rev=1335107", "theme" => "comparison theme"  );

$plugins["datafeedr-comparison-sets"] = array("t" => "Datafeedr Comparison Sets", "d" => "Automatically create price comparison sets for your PremiumPress Website.", "i" => "https://ps.w.org/datafeedr-comparison-sets/assets/icon-256x256.png?rev=1388272", "theme" => "comparison theme"  );

//} 

foreach($plugins as $key => $p){ ?>

<?php if(isset($p['title'])){ ?>  

<?php }else{ ?>

 
<div class="row border-bottom mb-4">
<div class="col-md-3">
  <a class="media-left" href="#">
	<img src="
    <?php if(substr($p['i'],0,4) == "http"){ echo $p['i']; }else{ ?>https://www.premiumpress.com/_demoimages/plugins/<?php echo $p['i']; ?><?php } ?>" style="width:100px;" class="border rounded-1" />
  </a>
</div>
<div class="col-md-9">
<div class="pl-3">
	<div class="bold h6"><?php echo $p['t']; ?></div>
 
   <div class="small"><?php echo $p['d']; ?></div>
   
   <div class="small text-muted my-2">Plugin designed for <strong><?php echo $p['theme']; ?></strong></div>
   
   <a href="<?php echo home_url(); ?>/wp-admin/plugin-install.php?tab=plugin-information&plugin=<?php echo $key; ?>&TB_iframe=true&width=772&height=513" class="btn btn-primary mt-2 mb-3 mr-4">Install Plugin</a>
   
   <?php if(isset($p['link'])) { ?>
    <a href="<?php echo $p['link']; ?>" class="btn btn-primary mt-2 mb-3" target="_blank">Visit Website</a>
  
   <?php } ?>
   
  </div>
  </div>
</div>
<div class="clearfix"></div>

<?php }?>

<?php } ?>







</div>

</div>


</div>

 
<?php // LOAD IN FOOTER
echo $CORE_ADMIN->FOOTER(1); ?>