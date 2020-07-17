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

 
	
	"ns1" => array(
	
		"name" => "Newsletter Settings",
		"desc"	=> "Create a conformation E-Mail to send to your new subscribers.",
		"icon" => "fa-cog",
		"path" => "22-newsletter",
	),	
	
	
 	"newslettertab1" => array(	
		"name" => "Subscribers",
		"desc"	=> "Add and edit subscribers to your newsletter.",
		"icon" => "fa-users",
		"path" => "20-subscribers",
	
	),

	"newslettertab2" => array(	
		"name" => "Confirmation Email",
		"desc"	=> "Create a conformation E-Mail to send to your new subscribers.",
		"icon" => "fa-user-plus ",
		"path" => "22-confirmation",	
	),
 
	
 	"newslettertab3" => array(	
		"name" => "Import Subscribers",
		"desc"	=> "Import lots of subscribers at once with this bulk import tool.",
		"icon" => "fa-fast-forward ",
		//"link" => "#newslettertab3",
		//"skip" => true,
		"path" => "22-import",	
	),

 	"newslettertab4" => array(
	
		"name" => "Send Newsletter",
		"desc"	=> "Create and send a newsletter to all your subscribers.",
		"icon" => "fa-paper-plane ",
		//"link" => "#newslettertab4",
		//"skip" => true,
		"path" => "22-send",
	),
		
);


$options = hook_v9_adminoptions_1($options);

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