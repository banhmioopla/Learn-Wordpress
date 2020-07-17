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
if(isset($_GET['page']) && $_GET['page'] =="premiumpress"){ 
?>

<ul class="sidemenu d-none d-xl-block">
<li class="heading">Theme Information</li>   
<li><a href="https://www.premiumpress.com/tutorials/?lc=<?php echo get_option('wlt_license_key'); ?>"><i class="fa fa-video-camera"></i> Video Tutorials <u>Found Here</u></a></li>
<?php if(!defined('WLT_DEMOMODE')){ ?>
<li><a href="https://www.premiumpress.com/account/"><i class="fa fa-key"></i> License Key: <?php echo get_option('wlt_license_key'); ?></a></li>
<?php } ?>
<li><a href="update-core.php"><i class="fa fa-cog"></i> Ver <?php echo THEME_VERSION; ?> - <?php echo THEME_VERSION_DATE; ?></a></li>
</ul>
<?php } ?>