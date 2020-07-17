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
	
		"name" => __("Emails &amp; SMS","premiumpress-admin"),
		"desc"	=> __("Here you can adjust the default emails and SMS sent out by the theme.","premiumpress-admin"),
		"icon" => "fa-cog",
		"link" => "#",
		"path" => "3-basic",		
	),
	
	
	"sms" => array(
	
		"name" => __("SMS Settings","premiumpress-admin"),
		"desc"	=> __("Here you can setup your SMS account settings.","premiumpress-admin"),
		"icon" => "fa fa-mobile",
		"link" => "#",
		"path" => "3-sms",	
	
	),
	
	"advsettings" => array(
	
		"name" => __("Email Settings","premiumpress-admin"),
		"desc"	=> __("Set up your E-Mail address and name.","premiumpress-admin"),
		"icon" => "fa-exchange",
		"link" => "#",
		"path" => "3-settings",		
	),
	
	 
	"send" => array(
	
		"name" => __("Send Email","premiumpress-admin"),
		"desc"	=> __("Here you can send an quick email to users.","premiumpress-admin"),
		"icon" => "fas fa-paper-plane",
		"path" => "3-send",	 
	),

	
/*
	"email" => array(
	
		"name" => "Add/Edit System Emails",
		"desc"	=> "Create and edit email templates used by your website.",
		"icon" => "fa fa-envelope-open",
		"link" => "#",
	
	),

	"ass" => array(
	
		"name" => "Automated Emails",
		"desc"	=> "Assign emails to different events to automate email actions.",
		"icon" => "fa fa-exchange",
		"link" => "#",
	
	),
	
 	"alerts" => array(
	
		"name" => "Email and SMS Alerts",
		"desc"	=> "Adjust the settings of your E-Mail Alerts, SMS alerts are also available here.",
		"icon" => "fa-bell-o ",
		"link" => "#",
	
	),*/
	
	
 

 	"logs" => array(
	
		"name" => __("Email Logs","premiumpress-admin"),
		"desc"	=> __("Here you can see logs of recently sent emails.","premiumpress-admin"),
		"icon" => "fal fa-scanner-keyboard",
		"link" => "#",
		"path" => "3-logs",	
	
	), 

		
);

$options = hook_v9_admin_email_options($options);

 
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