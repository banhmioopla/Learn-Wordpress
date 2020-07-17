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


 
 
$plugins = array();
 
 
 $plugins["v9_icodes"] = array("t" => "iCodes Coupon Plugin", "d" => "This plugin lets you import coupon codes from icodes.", "i" => "icodes.png" );

if(THEME_KEY == "cp"){

$plugins["v9_icodes"] = array("t" => "iCodes Coupon Plugin", "d" => "This plugin lets you import coupon codes from icodes.", "i" => "icodes.png" );

}elseif(THEME_KEY == "cm"){

$plugins["datafeedr-api"] = array("t" => "Datafeedr API", "d" => "This plugin lets you use Datafeedr on your WordPress website.", "i" => "https://ps.w.org/datafeedr-api/assets/icon-256x256.png?rev=1335107" );

$plugins["datafeedr-comparison-sets"] = array("t" => "Datafeedr Comparison Sets", "d" => "Automatically create price comparison sets for your PremiumPress Website.", "i" => "https://ps.w.org/datafeedr-comparison-sets/assets/icon-256x256.png?rev=1388272" );


}
 
?>
<div class="bg-white p-5 shadow" style="border-radius: 7px;">
<?php
foreach($plugins as $key => $p){ ?>

<?php if(isset($p['title'])){ ?>  

<?php }else{ ?>

 
<div class="row">
<div class="col-md-3">
  <a class="media-left" href="#">
	<img src="
    <?php if(substr($p['i'],0,4) == "http"){ echo $p['i']; }else{ ?>https://www.premiumpress.com/_demoimages/plugins/<?php echo $p['i']; ?><?php } ?>" style="width:130px;" />
  </a>
</div>
<div class="col-md-8">

	<div class="bold h6"><?php echo $p['t']; ?></div>
 
   <p class="desc"><?php echo $p['d']; ?></p>
   
   <a href="<?php echo home_url(); ?>/wp-admin/plugin-install.php?tab=plugin-information&plugin=<?php echo $key; ?>&TB_iframe=true&width=772&height=513" class="btn btn-primary mt-2 mb-3 mr-4">Install Plugin</a>
   
   <?php if(isset($p['link'])) { ?>
    <a href="<?php echo $p['link']; ?>" class="btn btn-primary mt-2 mb-3" target="_blank">Visit Website</a>
  
   <?php } ?>
   
  
  </div>
</div>
<div class="clearfix"></div>

<?php }?>

<?php } ?>
</div>