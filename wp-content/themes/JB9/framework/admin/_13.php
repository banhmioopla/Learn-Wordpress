<?php
// CHECK THE PAGE IS NOT BEING LOADED DIRECTLY
if (!defined('THEME_VERSION')) {	header('HTTP/1.0 403 Forbidden'); exit; }
// SETUP GLOBALS
global $wpdb, $CORE, $userdata, $CORE_ADMIN;
// LOAD IN MAIN DEFAULTS 
$core_admin_values = get_option("core_admin_values");  
 
 
if(function_exists('current_user_can') && current_user_can('administrator')){
	// DELETE THE RECENT SEARCHES
	if(isset($_GET['delrs']) && isset($_GET['key']) ){
		$saved_searches_array = get_option('recent_searches');
		unset($saved_searches_array[str_replace(" ","_",$_GET['key'])]);
		update_option('recent_searches',$saved_searches_array);
	}elseif(isset($_GET['delrsall'])){
		update_option('recent_searches','');
	}
	
	if(isset($_GET['forcecron']) && $_GET['forcecron'] == 1){
	
	premiumpress_hourly_event_hook_do();
	
	}
}// end if
 
// LOAD IN HEADER
echo $CORE_ADMIN->HEAD(1); ?>

<?php get_template_part('framework/admin/reports', '' ); ?> 

<?php // LOAD IN FOOTER
echo $CORE_ADMIN->FOOTER(1); ?>