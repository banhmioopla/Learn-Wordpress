<?php
// CHECK THE PAGE IS NOT BEING LOADED DIRECTLY
if (!defined('THEME_VERSION')) {	header('HTTP/1.0 403 Forbidden'); exit; }
// SETUP GLOBALS
global $wpdb, $CORE, $userdata, $CORE_ADMIN;

// LOAD IN OPTIONS FOR SORTING DATA
wp_enqueue_script( 'jquery-ui-sortable' );
wp_enqueue_script( 'jquery-ui-draggable' );
wp_enqueue_script( 'jquery-ui-droppable' );

// LOAD IN HEADER
echo $CORE_ADMIN->HEAD(); ?>




<div class="row">
   <div class="col-md-3">
    <?php get_template_part('framework/admin/templates/admin', 'mainmenu' ); ?> 
      <div class="list-group" id="sidebarmenu" role="tablist"></div>
      <?php get_template_part('framework/admin/templates/admin', 'supportmenu' ); ?> 
   </div>
   <div class="col-md-9">
      <div class="tab-content">





 
   <div class="tab-pane" style="display:block !important;">
      <?php get_template_part('framework/admin/templates/admin', '4-massimport' ); ?> 
      </div>
 




 



      </div>
   </div>
</div>





<?php // LOAD IN FOOTER
echo $CORE_ADMIN->FOOTER(); ?>