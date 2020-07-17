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

global $wpdb, $CORE, $CORE_ADMIN, $advance_search;
 
$fields = $wpdb->get_results( "SELECT * FROM {$wpdb->prefix}core_search ORDER BY `order` ASC" );
 
  
?> 

 
<div class="bg-white p-5 shadow" style="border-radius: 7px;">


<div class="tabheader mb-4">
 
 <div class="btn-group float-right" style="margin-top:-4px;">
  <a class="btn dropdown-toggle btn-success" data-toggle="dropdown" href="#">
   Add New Field
    <span class="caret"></span>
  </a>
  <ul class="dropdown-menu asw-elements">
  <!--
      <li style="margin:0px;"><a href="#" onclick="window.scrollTo(0,document.body.scrollHeight);" id="asw-search-add-btn">Search Field</a></li>
      -->
      <li style="margin:0px;"><a href="#" onclick="window.scrollTo(0,document.body.scrollHeight);" id="asw-custom-add-btn">Custom Field</a></li>
      <!--  <li style="margin:0px;"><a href="#" onclick="window.scrollTo(0,document.body.scrollHeight);" id="asw-tax-add-btn">Taxonomy Field</a></li>  
           
      <li style="margin:0px;"><a href="#" onclick="window.scrollTo(0,document.body.scrollHeight);" id="asw-head-add-btn">Heading Separator</a></li> 
      -->
  </ul>
</div>
        

         <h4><span>Custom Search Filters</span></h4>
      </div>
      
      
 
        <input type="hidden" name="searchform" value="1" />
 
    
     <div id="asw-ajax-response"></div>
	
    	<ul class="asw-form-elements">
                            <?php
                            if ( $fields ) {
                                echo $advance_search->build_builder_form( $fields );
                            } else {
                                $advance_search->search_field();
                            }
                            ?>
         </ul>
        <?php //submit_button(); ?>
            <?php do_action('hook_admin_1_tab4_left'); ?>            
 

    <div class="clear"></div>
	<script type="text/html" id="asw-search-template">
    <?php $advance_search->search_field(); ?>
    </script>
            
            <script type="text/html" id="asw-custom-template">
        <?php $advance_search->custom_field(); ?>
            </script>

            <script type="text/html" id="asw-tax-template">
        <?php $advance_search->taxonomy_field(); ?>
            </script>
            
            
            <script type="text/html" id="asw-head-template">
        <?php $advance_search->head_field(); ?>
            </script>
     
 
 
</div> 
<script>
jQuery(document).ready(function(e){var s={init:function(){var s=e("ul.asw-form-elements"),a=e("#asw-custom-template").html(),t=e("#asw-tax-template").html();searchbox=e("#asw-search-template").html(),head=e("#asw-head-template").html(),e(".asw-form-elements").sortable({handle:".hndle"}),e(".asw-form-elements").on("click",".handlediv",this.toggleElement),e(".asw-elements").on("click","#asw-search-add-btn",function(e){e.preventDefault(),s.append(searchbox).slideDown("slow")}),e(".asw-elements").on("click","#asw-head-add-btn",function(e){e.preventDefault(),s.append(head).slideDown("slow")}),e(".asw-elements").on("click","#asw-custom-add-btn",function(e){e.preventDefault(),s.append(a).slideDown("slow")}),e(".asw-elements").on("click","#asw-tax-add-btn",function(e){e.preventDefault(),s.append(t).slideDown()}),e(".asw-form-elements").on("click",".asw-remove-el",function(s){s.preventDefault(),e(this).parents("li").slideUp("slow").remove()}),e("#asw-form").on("submit",this.saveOptions),e("#asw-form").on("change",".asw-custom-type",this.toggleValues)},toggleElement:function(s){s.preventDefault();var a=e(this).parents(".postbox");a.toggleClass("closed")},saveOptions:function(){var s=e(this),a=s.serialize()+"&action=asw_save_options",t=!1;return s.find("input.required").each(function(s,a){var n=e(a).val();""===n&&(e(a).addClass("asw-error"),t=!0),""!==n&&e(a).hasClass("asw-error")&&e(a).removeClass("asw-error")}),t||(s.find("img.ajax-feedback").css("visibility","visible"),e.post(ajaxurl,a,function(a){var t=e.parseJSON(a);s.find("img.ajax-feedback").css("visibility","hidden"),t&&(e("#asw-ajax-response").html(t.nag),e("#asw-preview-content").html(t.form_preview),e(".asw-form-elements").html(t.builder))})),!1},toggleValues:function(){var s=e(this),a=s.val();"select"===a?s.parent().next(".show-if-select").slideDown("fast"):s.parent().next(".show-if-select").slideUp("fast")}};s.init()});	
</script>