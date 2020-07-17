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

	//"s0" => array( "sep" => true, "name" => "General Settings", ),

	"company" => array(
	
		"name" => __("Company Info","premiumpress-admin"),
		"desc"	=> __("Enter company details, setup your social media buttons and more!","premiumpress-admin"),
		"icon" => "1.png",
		"link" => "#",
		"path" => "2-company",
	),
  
	"pagelinks" => array(
	
		"name" => __("Page &amp; Button Links","premiumpress-admin"),
		"desc"	=> __("Here you can set the button links on your website.","premiumpress-admin"),
		"icon" => "5.png",
		"link" => "#",
		"path" => "2-pagelinks",	
	),

	"user" => array(
	
		"name" => __("User Settings","premiumpress-admin"),
		"desc"	=> __("Adjust your user settings and setup registration fields here.","premiumpress-admin"),
		"icon" => "3.png",
		"link" => "#",
		"path" => "2-user-general",	
	),	 

	"gateways" => array(
	
		"name" => __("Payment &amp; Currency","premiumpress-admin"),
		"desc"	=> "Enable payment options, coupon codes &amp; currency display values here.",
		"icon" => "8.png",
		"link" => "#",
		"path" => "2-gateways",	
	),
	
	"email" => array(
	
		"name" => __("Email &amp; SMS","premiumpress-admin"),
		"desc"	=> "Configure your website email and SMS mobile settings here.",
		"icon" => "16.png",
		"link" => "#",
		"path" => "2-email",	
	),
	
 
	"maps" => array(
	
		"name" => "Google",
		"desc"	=> __("Configure Google Maps, Google Analytics and Google reCaptcha here!","premiumpress-admin"),
		"icon" => "2.png",
		"link" => "#",
		"path" => "2-maps",	
	),
		
	"languages" => array(
	
		"name" => __("Languages","premiumpress-admin"),
		"desc"	=> __("Here you can setup language options for your website.","premiumpress-admin"),
		"icon" => "7.png",
		"link" => "#",
		"path" => "2-language",		
	),	
 
	"sociallogin" => array(
	
		"name" => __("Social Login","premiumpress-admin"),
		"desc"	=> __("Allow users to register/login using their social media accounts.","premiumpress-admin"),
		"icon" => "6.png",
		"link" => "#",
		"path" => "2-socialogin",	
	),		
	
	"search" => array(
	
		"name" => __("Search","premiumpress-admin"),
		"desc"	=> __("Here you can manage some of the search page options.","premiumpress-admin"),
		"icon" => "4.png",
		"link" => "#",
		"path" => "2-search",		
	),
	
	"plugins" => array(
	
		"name" => "Extra Plugins",
		"desc"	=> "The token system is another form of payment allowing you to charge real monies for virtual tokens.",
		"icon" => "fa-money",
		"path" => "plugins-gateways",
		"hideme" => 1,
	
	), 
	
 
 
);

if(THEME_KEY == "sp"){
unset($options['maps']);
}




$options = hook_v9_admin_options($options);

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