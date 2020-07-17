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
 
 	"orders" => array(
	
		"name" => "Orders",
		"desc"	=> "Here you can view all website orders.",
		"icon" => "fal fa-file-invoice-dollar",
		"path" => "6-orders",
	
	),  
 
 	"cashout" => array(
	
		"name" => "Cashout Requests",
		"desc"	=> "Here you can view user requests to cash out payments.",
		"icon" => "fa-tag",
		"path" => "6-withdrawal",
	
	),
 	
 		
		
);

if(THEME_KEY == "sp"){
unset($options['cashout']);
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