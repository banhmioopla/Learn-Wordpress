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

 

	"gateways" => array(
	
		"name" => "Payment Gateways",
		"desc"	=> "Take a look at the available payment gateway plugins.",
		"icon" => "fab fa-paypal",
		"path" => "20-gateways",	
	), 
	 
 	"currency" => array(
	
		"name" => "Currency Settings",
		"desc"	=> "Change displayed currency and also edit currency rates.",
		"icon" => "fas fa-dollar-sign ",
		"path" => "20-currency",	
	),
	
 	"coupons" => array(
	
		"name" => "Coupon Codes",
		"desc"	=> "Here you can add manage your website coupon codes.",
		"icon" => "fa fa-tag",
		"path" => "20-coupons",
	
	),		
	

	"credit" => array(
	
		"name" => "Token System",
		"desc"	=> "The token system is another form of payment allowing you to charge real monies for virtual tokens.",
		"icon" => "fa-money",
		"path" => "20-credit",
	
	), 
	
	"plugins" => array(
	
		"name" => "Token System",
		"desc"	=> "The token system is another form of payment allowing you to charge real monies for virtual tokens.",
		"icon" => "fa-money",
		"path" => "plugins-gateways",
	
	), 
	
 	
);
if(!defined('WLT_CREDITSYSTEM')){
unset($options['credit']);
}

$i=1;
 ?>
<div class="bg-danger shadow rounded-1" id="MainNavArea" style="display:none;">
   <ul class="nav nav-tabs" id="MainTabs" role="tablist">
      <?php $i=1; foreach($options as $key => $opt){ ?>
      <li class="nav-item">
         <a class="nav-link <?php if($i == 1){ echo "active"; } ?>" id="tab-<?php echo $key; ?>" data-toggle="tab" href="#<?php echo $key; ?>" role="tab" aria-controls="<?php echo $key; ?>" aria-selected="true">
         <i class="fa <?php echo $opt['icon']; ?> mr-2"></i>
         <?php echo $opt['name']; ?>
         </a>
      </li>
      <?php $i++; } ?>
   </ul>
</div>
<div class="tab-content">
   <?php
      $i=1;
      foreach($options as $key => $opt){ ?>
   <section class="tab-pane menuitem fade <?php if($i == 1){ echo "show active"; } ?>" id="<?php echo $key; ?>" role="tabpanel" data-name="<?php echo $opt['name']; ?>" data-key="tab-<?php echo $key; ?>" data-icon="<?php echo $opt['icon']; ?>">   
      <?php if(isset($opt['link']) && strlen($opt['link']) > 1){  ?>
      <a href="<?php echo $opt['link']; ?>" class="btn btn-lg btn-outline-primary"> <span class="pr-3">Continue </span> <i class="fa fa-angle-right"></i> </a>
      <?php }else{ ?>
      <?php 
         if(is_array($opt['path'])){ 
         	echo get_template_part( $opt['path'][0], $opt['path'][1] );
         }else{ 
         	get_template_part('framework/admin/templates/admin', $opt['path'] );
         } 
         ?> 
      <?php } ?>
   </section>
   <?php $i++; } ?>
</div>