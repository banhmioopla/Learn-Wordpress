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

global $wpdb, $CORE, $CORE_ADMIN, $ADSEARCH;

		
$core_admin_values = get_option("core_admin_values");

$fields = $wpdb->get_results( "SELECT * FROM {$wpdb->prefix}core_search ORDER BY `order` ASC" );

?>


 

 

 
 <div class="card">
<div class="card-header">

<div class="dropdown float-right">
  <a class="btn btn-primary btn-sm"  id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="color:#fff;">
   Add New Field
    <span class="caret"></span>
  </a>
  <div class="dropdown-menu asw-elements">
       <a href="#" onclick="window.scrollTo(0,document.body.scrollHeight);" id="asw-search-add-btn" class="dropdown-item">Search Field</a> 
      <a href="#" onclick="window.scrollTo(0,document.body.scrollHeight);" id="asw-custom-add-btn" class="dropdown-item">Custom Field</a> 
      <a href="#" onclick="window.scrollTo(0,document.body.scrollHeight);" id="asw-tax-add-btn" class="dropdown-item">Taxonomy Field</a>        
       <a href="#" onclick="window.scrollTo(0,document.body.scrollHeight);" id="asw-head-add-btn" class="dropdown-item">Heading Separator</a> 
  </div>
</div>


<span>
Search Fields
</span>
</div>
<div class="card-body"> 



 

<input type="hidden" name="searchform" value="1" />

 
<div class="clearfix"></div>
          

          
          
          
            
            
            
            
            
            
       
    <div class="content">
    
     <div id="asw-ajax-response"></div>
	
    	<ul class="asw-form-elements mb-2">
                            <?php
                            if ( $fields ) {
                                echo $ADSEARCH->build_builder_form( $fields );
                            } else {
                                $ADSEARCH->search_field();
                            }
                            ?>
         </ul> 
    
    </div> 
 
 
  
</div><!-- end card block -->
</div><!-- end card -->


	<script type="text/html" id="asw-search-template">
    <?php $ADSEARCH->search_field(); ?>
    </script>
            
            <script type="text/html" id="asw-custom-template">
        <?php $ADSEARCH->custom_field(); ?>
            </script>

            <script type="text/html" id="asw-tax-template">
        <?php $ADSEARCH->taxonomy_field(); ?>
            </script>
            
            
            <script type="text/html" id="asw-head-template">
        <?php $ADSEARCH->head_field(); ?>
            </script>
            
            <script>
jQuery(document).ready(function() {	
    jQuery( ".asw-form-elements" ).sortable(); 

}); </script>
  