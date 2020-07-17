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
		"desc"	=> "View all of our available payment gateways.",
		"icon" => "fa-paypal ",
		"path" => "plugins-gateways",
	
	),



	"recommended" => array(
	
		"name" => "Popular",
		"desc"	=> "Here are a collection of popular plugins for your PremiumPress framework.",
		"icon" => "fa-plus-square",
		"path" => "plugins-recommended",
	
	),
/*
 	"import" => array(
	
		"name" => "Import Tools",
		"desc"	=> "See the collection of import tools available.",
		"icon" => "fa-arrow-circle-down ",
		"path" => "plugins-import",
	
	),

	
 
	
	"popular" => array(
	
		"name" => "Recommended Plugins",
		"desc"	=> "Recommended plugins for you to download and use.",
		"icon" => "fa-thumbs-o-up",
		"link" => "#",
		"path" => "plugins",
	
	), 
	*/		
		
		
);

$options = hook_v9_adminoptions_1($options);

$i=1;

foreach($options as $key => $opt){ ?>

    
   <section class="tab-pane menuitem" id="tab-<?php echo $key; ?>" role="tabpanel" data-name="<?php echo $opt['name']; ?>" data-key="tab-<?php echo $key; ?>" data-icon="<?php echo $opt['icon']; ?>">   
 
   
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