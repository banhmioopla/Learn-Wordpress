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

 

	"a1" => array(
	
		"name" => __("Recent Activity","premiumpress-admin"),
		"desc"	=> __("Here you can see recent activity reported from your website.","premiumpress-admin"),
		"icon" => "far fa-comment-alt-smile",
		"path" => "13-top-activity",	
	), 
	 
	"a2" => array(
	
		"name" => __("Keyword Searches","premiumpress-admin"),
		"desc"	=> __("Here is a list of popular user keyword searches.","premiumpress-admin"),
		"icon" => "fa-search",
		"path" => "13-top-searches",	
	),
	
	"cron" => array(
	
		"name" => __("Cron Job Activity","premiumpress-admin"),
		"desc"	=> __("This is for display purposes only and simply helps you monitor your cron job activity.","premiumpress-admin"),
		"icon" => "fa-paragraph",
		"path" => "13-cron",	
	),
	
	/*
	"a3" => array(
	
		"name" => "Website Reports",
		"desc"	=> "Take a look at the available payment gateway plugins.",
		"icon" => "fa-cc-paypal ",
		"path" => "13-reports",	
	),
	*/	
	 
 	
);
$options = hook_v9_adminoptions_1($options);

$i=1;

foreach($options as $key => $opt){ ?>

    
   <section class="tab-pane menuitem" id="tab-<?php echo $key; ?>" role="tabpanel" data-name="<?php echo $opt['name']; ?>" data-key="tab-<?php echo $key; ?>" data-icon="<?php echo $opt['icon']; ?>">   
   
   <div style="position:relative;">
   
       <i class="fa <?php echo $opt['icon']; ?>" style="font-size:100px; position:absolute; top:-10px; right:0px; opacity:0.1"></i>
       
       <div style="margin-right:150px;">
       
       <h4><?php echo $opt['name']; ?></h4>
       
       <p class="lead"><?php echo $opt['desc']; ?></p>
       
       </div>
       
       <div class="linebar" /></div>
   
   </div>
   
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