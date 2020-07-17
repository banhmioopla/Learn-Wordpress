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

 
$options = array(

	"settings" => array(
	
		"name" => "Checkout",
		"desc"	=> "These are the basic shopping cart settings.",
		"icon" => "checkout.png",
		"link" => "#", 
		"path" => "cart-settings",		
	),


	"basic" => array(
	
		"name" => "Shipping",
		"desc"	=> "Setup shipping options for your shopping cart here.",
		"icon" => "ship.png",
		"link" => "#",
		//"skip" => true,
		"path" => "cart-shipping",	 
 
	), 
	"basic_tax" => array(
	
		"name" => "Tax",
		"desc"	=> "Create and edit tax options for your website.",
		"icon" => "tax.png",
		"link" => "#",
		"path" => "cart-tax",	
	
	),
	
	"regions" => array(
	
		"name" => "Regions",
		"desc"	=> "Group countries and apply tax and shipping options for specific groups.",
		"icon" => "r.png",
		"link" => "#",
		"path" => "shipping-regions",	
	
	),


 
 
	
);

$options = hook_v9_adminoptions_1($options);

$i=1;
?>
 
<div id="mainsection">
<div class="row">
<?php $i=1; foreach($options as $key => $opt){ if( isset($opt['hideme']) ){ $i++; continue; } ?>
<div class="col-lg-6 mb-4">
<div class="bg-white shadow-sm p-4" style="border-radius: 7px;">
<div class="row">
<div class="col-2">
<img src="<?php echo get_bloginfo('template_url')."/framework/admin/"; ?>images/icons/<?php echo $opt['icon']; ?>" width="64" >
</div>
<div class="col-7">
<h5 class="mb-2 txt-500"><?php echo $opt['name']; ?></h5>
<p class="text-muted pb-0" style="font-size:16px;" style="min-height:40px;"><?php echo $opt['desc']; ?></p>
</div>
<div class="col-3">
<a class="btn btn-dark btn-sm btn-block mt-4" href="javascript:void(0);" onclick="showthispage('<?php echo $key; ?>');">View</a>
</div>
</div>
</div>
</div>
<?php $i++; } ?>
</div>
</div>


<?php $i=1; foreach($options as $key => $opt){ 

	
?>
   <section id="<?php echo $key; ?>" role="tabpanel" data-name="<?php echo $opt['name']; ?>" data-key="tab-<?php echo $key; ?>" data-icon="<?php echo $opt['icon']; ?>" style="display:none;">   
      
     
      <?php 
         if(is_array($opt['path'])){ 
         	echo get_template_part( $opt['path'][0], $opt['path'][1] );
         }else{ 
         	get_template_part('framework/admin/templates/admin', $opt['path'] );
         } 
         ?> 
      
   </section>
<?php $i++; } ?>