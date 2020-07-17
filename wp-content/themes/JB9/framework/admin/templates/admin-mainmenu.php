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


global $CORE, $userdata;
?>

<div class="userava">
<a href="user-edit.php?user_id=<?php echo $userdata->ID; ?>">  <?php echo get_avatar( $userdata->ID, 25 ); ?> <span><?php echo $userdata->user_login; ?></span> <i class="fa fa-pencil" aria-hidden="true"></i> </a>
 
</div>

<ul id="sidebarmenu1">

 

<a class="show list-group-item list-group-item-action" href="admin.php?page=premiumpress" <?php if( $_GET['page'] == "premiumpress" ? $c = "class='active'" : $c = ""); echo  $c; ?> > <i class="fa fa-tachometer" aria-hidden="true"></i> <span>Dashboard</span> </a>



<?php if(THEME_KEY == "ph"){ ?>

<a class="show list-group-item list-group-item-action" href="admin.php?page=massimport" <?php if( $_GET['page'] == "massimport" ? $c = "class='active'" : $c = ""); echo  $c; ?> > <i class="fa fa-image" aria-hidden="true"></i> <span>Mass Import</span> </a>

 
<?php } ?>
 
 
<a class="show list-group-item list-group-item-action" href="admin.php?page=2" <?php if( $_GET['page'] == "2" ? $c = "class='active'" : $c = ""); echo  $c; ?>>  <i class="fa fa-cogs" aria-hidden="true"></i> <span>Configuration</span> </a>
<div  class="nav ppt_submenu submenu_2" role="tablist"></div>

<a class="show list-group-item list-group-item-action" href="admin.php?page=15" <?php if( $_GET['page'] == "15" ? $c = "class='active'" : $c = ""); echo  $c; ?>>  <i class="fa fa-paint-brush" aria-hidden="true"></i> <span>Design Setup</span> </a>

<div class="nav ppt_submenu submenu_15" role="tablist"></div>

 

<?php if(!defined('WLT_SHOP')){ if(defined('THEME_KEY') && THEME_KEY != "cm"){ ?>


<a class="show list-group-item list-group-item-action" href="admin.php?page=5" <?php if( $_GET['page'] == "5" ? $c = "class='active'" : $c = ""); echo  $c; ?>><i class="fa fa-list" aria-hidden="true"></i> <span>Listings &amp; Packages</span> </a>
<div class="nav ppt_submenu submenu_5" role="tablist"></div>

<a class="show list-group-item list-group-item-action" href="admin.php?page=18" <?php if( $_GET['page'] == "18" ? $c = "class='active'" : $c = ""); echo  $c; ?>><i class="fas fa-user-tag"></i> <span>Memberships</span> </a>

<div class="nav ppt_submenu submenu_18" role="tablist"></div>
 
 
 
<?php } }?>



 
<a class="show list-group-item list-group-item-action" href="admin.php?page=3" <?php if( $_GET['page'] == "3" ? $c = "class='active'" : $c = ""); echo  $c; ?>> <i class="far fa-envelope"></i> <span>Email &amp; SMS</span> </a>
 <div  class="nav ppt_submenu submenu_3" role="tablist"></div>
 
 
 
<a class="show list-group-item list-group-item-action" href="admin.php?page=22" <?php if( $_GET['page'] == "22" ? $c = "class='active'" : $c = ""); echo  $c; ?>> <i class="far fa-newspaper"></i> <span>Newsletter</span> </a>
 <div  class="nav ppt_submenu submenu_22" role="tablist"></div>

 
 <a class="show list-group-item list-group-item-action" href="admin.php?page=20" <?php if( $_GET['page'] == "20" ? $c = "class='active'" : $c = ""); echo  $c; ?>><i class="far fa-sack-dollar"></i> <span>Payment &amp; Currency</span> </a>
 <div  class="nav ppt_submenu submenu_20" role="tablist"></div>   


<?php if(defined('WLT_CART')){ ?>
<a class="show list-group-item list-group-item-action" href="admin.php?page=cart" <?php if( $_GET['page'] == "22" ? $c = "class='active'" : $c = ""); echo  $c; ?>><i class="fa fa-newspaper-o" aria-hidden="true"></i> <span>Tax &amp; Shipping</span> </a>
 <div  class="nav ppt_submenu submenu_cart" role="tablist"></div>

<?php } ?>


 
<a class="show list-group-item list-group-item-action" href="admin.php?page=6" <?php if( $_GET['page'] == "6" ? $c = "class='active'" : $c = ""); echo  $c; ?>><i class="fa fa-briefcase" aria-hidden="true"></i> <span>Order Manager</span> </a>
 <div  class="nav ppt_submenu submenu_6" role="tablist"></div>
 

<?php /* 
<a class="show list-group-item list-group-item-action" href="admin.php?page=13" <?php if( $_GET['page'] == "13" ? $c = "class='active'" : $c = ""); echo  $c; ?> > <i class="fa fa-pie-chart" aria-hidden="true"></i> <span>Reports</span> </a>
*/ ?>
 
 
<a class="show list-group-item list-group-item-action" href="admin.php?page=4" <?php if( $_GET['page'] == "4" ? $c = "class='active'" : $c = ""); echo  $c; ?>><i class="fa fa-wrench" aria-hidden="true"></i> <span>Toolbox</span> </a>
 <div  class="nav ppt_submenu submenu_4" role="tablist"></div>
 



 
<a class="show list-group-item list-group-item-action" href="admin.php?page=10" <?php if( $_GET['page'] == "10" ? $c = "class='active'" : $c = ""); echo  $c; ?>><i class="fa fa-plug" aria-hidden="true"></i> <span>Plugins</span> </a>
 <div  class="nav ppt_submenu submenu_10" role="tablist"></div>



<?php if(THEME_KEY != "sp"){ ?>
 <a class="show list-group-item list-group-item-action" href="admin.php?page=19" <?php if( $_GET['page'] == "7" ? $c = "class='active'" : $c = ""); echo  $c; ?>><i class="fa fa-bullhorn" aria-hidden="true"></i> <span>Advertising</span> </a>
 <div  class="nav ppt_submenu submenu_19" role="tablist"></div>

<?php } ?>
 
  

 <a class="show list-group-item list-group-item-action" href="admin.php?page=13" <?php if( $_GET['page'] == "7" ? $c = "class='active'" : $c = ""); echo  $c; ?>> <i class="fas fa-chart-line"></i> <span>Reports</span> </a>
 <div  class="nav ppt_submenu submenu_13" role="tablist"></div>

</ul>