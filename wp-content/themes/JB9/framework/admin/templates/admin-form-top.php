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
 
?>
 
 
 
 	<?php if(isset($GLOBALS['error_message']) ){ ?>
	<div class="py-2">
	<div class="alert font-weight-bold <?php if(isset($GLOBALS['error_type'])){ echo $GLOBALS['error_type']; }else{ echo "alert-success"; } ?>">
	<button type="button" class="close" data-dismiss="alert">x</button>
	<?php echo $GLOBALS['error_message']; ?>
	</div>
    </div>
    <?php } ?>

 <?php if(!defined('HIDE-SAVEFORM')){ if( !isset($_GET['page']) || (isset($_GET['page']) && $_GET['page'] != "revslider" ) ){ ?>
	<form method="post" name="admin_save_form" id="admin_save_form" <?php if(isset($license) && $license ==""){ ?>onsubmit="return VALIDATE_INSTALL_DATA();"<?php } ?> enctype="multipart/form-data">
	<input type="hidden" name="submitted" value="yes" />
	<input type="hidden" name="tab" class="ShowThisTab" value="<?php if(isset($_POST['tab'])){ echo $_POST['tab']; } ?>" />
 
	<?php } } ?>
	

<?php if(isset($_GET['firstinstall']) && isset($_GET['page']) && $_GET['page'] == 2 ){  ?> 
	<script >
    jQuery(document).ready(function () { document.admin_save_form.submit(); })
    </script>
    <input type="hidden" name="newinstall" value="premiumpress" />
     <input type="hidden" name="page" value="premiumpress" />
    
    <?php if(defined('WLT_CART')){ ?>
    <input type="hidden" name="admin_values[google]" value="0" />
    <?php } ?>
<?php } ?>



<input type="hidden" name="admin_values[admin_color]" id="admin_color" value="<?php echo _ppt("admin_color"); ?>" />