<?php
// CHECK THE PAGE IS NOT BEING LOADED DIRECTLY
if (!defined('THEME_VERSION')) {	header('HTTP/1.0 403 Forbidden'); exit; }
// SETUP GLOBALS
global $wpdb, $CORE, $userdata, $THEME_SHORTCODES, $CORE_ADMIN, $ADSEARCH;

// LOAD IN OPTIONS FOR ADVANCED SEARCH
wp_enqueue_script( 'jquery-ui-sortable' );
wp_enqueue_script( 'jquery-ui-draggable' );
wp_enqueue_script( 'jquery-ui-droppable' );


// LOAD IN MAIN DEFAULTS 
$core_admin_values = get_option("core_admin_values");  

// LOAD IN HEADER
echo $CORE_ADMIN->HEAD(); ?>

<div class="row">
   <div class="col-md-3 pr-0 mr-0">
   <?php get_template_part('framework/admin/templates/admin', 'mainmenu' ); ?> 
      <div class="list-group" id="sidebarmenu" role="tablist"></div>
      <?php get_template_part('framework/admin/templates/admin', 'supportmenu' ); ?> 
   </div>
   <div class="col-md-9">
      <div class="tab-content">
      	<?php get_template_part('framework/admin/templates/admin', 'form-top' ); ?>


    
        
        <?php get_template_part('framework/admin/templates/admin', '17-search' ); ?>    
           
         <div class="savebtnbox p3"><button type="submit" class="btn btn-lg btn-dark mt-3"><?php echo __("Save Settings","premiumpress-admin"); ?></button> </div>
         <?php get_template_part('framework/admin/templates/admin', 'form-bottom' ); ?>
      </div>
   </div>
</div>
 

<?php // LOAD IN FOOTER
echo $CORE_ADMIN->FOOTER(); ?>