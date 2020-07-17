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

 
	"graph" => array(
	
		"name" => __("Graph","premiumpress-admin"),
		"desc"	=> __("Here you can adjust the default emails sent out by WordPress.","premiumpress-admin"),
		"icon" => "fa-cog",
		"link" => "grahy",
			
	),
	
	
	"users" => array(
	
		"name" => __("New Members","premiumpress-admin"),
		"desc"	=> __("Here you can adjust the default emails sent out by WordPress.","premiumpress-admin"),
		"icon" => "fa-cog",
		"link" => "#",
		"path" => "0-users",		
	),
		
	"orders" => array(
	
		"name" => __("Orders","premiumpress-admin"),
		"desc"	=> __("Here you can adjust the default emails sent out by WordPress.","premiumpress-admin"),
		"icon" => "fa-cog",
		"link" => "#",
		"path" => "0-orders",		
	),	
			
);

$options = hook_v9_adminoptions_1($options);

$i=1;
 
foreach($options as $key => $opt){ ?>

    
   <section class="tab-pane menuitem" id="tab-<?php echo $key; ?>" role="tabpanel" data-name="<?php echo $opt['name']; ?>" data-key="tab-<?php echo $key; ?>" data-icon="<?php echo $opt['icon']; ?>">   
   
   <h4><?php echo $opt['name']; ?></h4>
   
   <p class="lead"><?php echo $opt['desc']; ?></p>
   
   <div class="linebar" /></div>
   
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