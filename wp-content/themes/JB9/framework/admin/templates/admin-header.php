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
if (!defined('THEME_VERSION')) {	header('HTTP/1.0 403 Forbidden'); exit; }  global $wpdb, $CORE;   
 
 
// INCLUDE POP-UP MEDIA BOX
wp_enqueue_script('media-upload');
wp_enqueue_script('thickbox');
wp_enqueue_style('thickbox'); 
 
// LOAD IN MAIN DEFAULTS 
$core_admin_values = get_option("core_admin_values");  

?>


<link href="<?php echo get_bloginfo('template_url')."/framework/"; ?>css/backup_css/css.bootstrap.css" rel="stylesheet">  
<link href="<?php echo get_bloginfo('template_url')."/framework/admin/"; ?>css/premiumpress.css" rel="stylesheet">  

<script src="https://kit.fontawesome.com/5381299f20.js"></script>

<script src="<?php echo get_bloginfo('template_url')."/framework/admin/"; ?>js/admin.js"></script> 

<script src="<?php echo get_bloginfo('template_url')."/framework/js/backup_js/"; ?>js.bootstrap.js"></script> 

<script src="<?php echo get_bloginfo('template_url')."/framework/admin/"; ?>js/ajax.js"></script>
<script src="<?php echo get_bloginfo('template_url')."/framework/admin/"; ?>js/admin-global.js"></script>

 

<div id="premiumpress" class="mt-3">
<header>
<div class="row">
   <div class="col-md-3">
      <div class="logo"><a href="admin.php?page=premiumpress"></a></div>
   </div>
   <div class="col-md-9 d-none d-xl-block">
      <ul class="list-inline float-right mr-4">
        <li class="list-inline-item"> <a href="admin.php?page=13&tab=tab-a1" class="btn rounded-0 btn-outline-light1"><u><i class="fa fa-bell-o"></i> Website Alerts</u></a> </li>        
        <li class="list-inline-item"><a href="<?php echo home_url(); ?>/" class="btn rounded-0 btn-outline-light1" target="_blank" style="background:#00000026"> <i class="fa fa-link"></i> View My Website </a> </li>        
      </ul>
   </div>
</div>
</header>
<div class="subnav">

<div class="row">
    <div class="col-md-6">
    <h3 class="ml-3 pt-3 h4 text-light">
    
    <?php 
	$text = array(
	
		1 => "",
		2 => "<i class='fa fa-cogs'></i> Configuration",
		15 => "<i class='fa fa-paint-brush'></i> Design Setup",
		5 => "<i class='fa fa-list'></i> Listings &amp; Packages",
		18 => "<i class='fa fa-user-circle'></i> Memberships",
		3 => "<i class='fa fa-envelope-open-o'></i> Emails",
		22 => "<i class='fa fa-newspaper-o'></i> Newsletters",
		20 => "<i class='fa fa-paypal'></i> Payment &amp; Currency",
		6 => "<i class='fa fa-briefcase'></i> Order Manager",
		19 => "<i class='fa fa-bullseye'></i> Advertising",
		13 => "<i class='fa fa-bell'></i> Reports",
		4 => "<i class='fa fa-wrench'></i> Toolbox",
		10 => "<i class='fa fa-plug'></i> Plugins",
		
		"mobile" => "<i class='fa fa-mobile-phone'></i> Mobile Display",
		
		"massimport" => "<i class='fa fa-image'></i> Mass Import",
	);
	
	
	// 
	if(THEME_KEY == "da"){ 
		$text[5] = "<i class='fa fa-list'></i> Profile Setup";			 
	} 
	
	if(isset($_GET['page']) && array_key_exists($_GET['page'], $text)){
		echo $text[$_GET['page']];
	}else{
		echo "<i class='fa fa-dashboard'></i> Dashboard";
	}
	
		 
	
	?> 
    
    
    
    </h3>
    </div>
    <div class="col-md-6 text-right">
    
    <div>
    <?php
	
	$result = count_users();
	$count_posts 	= wp_count_posts(THEME_TAXONOMY.'_type'); 
	?>
    <a href="admin.php?page=users" class="btn btn-outline-light text-uppercase" style="margin-top: 15px;    margin-right: 20px; font-size:12px;"> <i class="fa fa-user"></i> <?php echo  $result['total_users']; ?> <span>Members</span> </a>  <a href="admin.php?page=manage" class="btn btn-outline-light text-uppercase" style="margin-top: 15px;    margin-right: 20px; font-size:12px;"> <i class="fa fa-database"></i> <?php echo number_format($count_posts->publish,0); ?> <span><?php echo THEME_TAXONOMY; ?>'s</span> </a>
    
    </div>
    
    </div>
</div>
</div>
 
<main class="main-body content">