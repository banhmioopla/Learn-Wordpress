<?php
// CHECK THE PAGE IS NOT BEING LOADED DIRECTLY
if (!defined('THEME_VERSION')) {	header('HTTP/1.0 403 Forbidden'); exit; }
// SETUP GLOBALS
global $wpdb, $CORE, $userdata, $CORE_ADMIN;
// LOAD IN MAIN DEFAULTS 
$core_admin_values = get_option("core_admin_values");  

// LOAD IN HEADER
echo $CORE_ADMIN->HEAD(1); ?>

 
 
      	<?php get_template_part('framework/admin/templates/admin', 'form-top' ); ?>
         <?php get_template_part('framework/admin/templates/admin', '19-overview' ); ?> 
     <div class="bg-primary p-1 text-center mt-5 shadow" style="border-radius: 7px;">

<button type="submit" class="btn btn-lg btn-primary btn-block"><?php echo __("Save Settings","premiumpress-admin"); ?></button> 

</div> 
         <?php get_template_part('framework/admin/templates/admin', 'form-bottom' ); ?>
 
 
<?php // LOAD IN FOOTER
echo $CORE_ADMIN->FOOTER(1); ?>