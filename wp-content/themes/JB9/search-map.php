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

if(!_ppt_checkfile("search-map.php")){

global $CORE, $wp_query; 

if($wp_query->found_posts > 0){

?>
<script>
   var maps;
   var google;
   var mapmarkerdata = [];
</script>
 <div id="wlt_google_map_mapsearch-wrapper" class="border-bottom hide-mobile mb-4" style="display:none;">
            <div id="wlt_google_map">&nbsp;</div>
         </div>
<script> 
   <?php $defaults = $CORE->wlt_google_getdefaults();  ?>
   
   var wlt_map_options = [{
   
       path: "<?php echo get_template_directory_uri(); ?>", 
       id: "wlt_google_map", 
       region: "<?php echo $defaults['region']; ?>", 
       lang: "<?php echo $defaults['lang'] ?>", 
       long: <?php echo $defaults['long']; ?>, 
       lat: <?php echo $defaults['lat']; ?>, 	
       zoom: <?php echo $defaults['zoom'] ?>,
       data: mapmarkerdata,	 
       color: "<?php echo _ppt('display_mapcolor_search'); ?>",
       key: "<?php echo _ppt('display_mapcolor_search'); ?>",
       cluster: "<?php if(_ppt('googlemap_cluster') == 1){ echo "yes"; }else{ echo "no"; } ?>",
           
       <?php if(isset($_GET['zipcode']) && strlen($_GET['zipcode']) > 1 ){  $radius = $CORE->wlt_google_getradius(); ?>
       
       radius: [{ "zip":"<?php echo $radius['zip']; ?>", "long":"<?php echo $radius['long']; ?>", "lat":"<?php echo $radius['lat']; ?>", "dis":<?php echo $radius['dis']; ?> }],
       
       <?php } ?>
   
   }];
</script>
<script>

   var AllMarkers;
   var map;
   var infobox;
   
   // FIRE GOOGLE MAPS DATA
   jQuery(document).ready(function() {   	
	
		// HIDE ALL HEADER/FOOTER ELEMENTS
		//jQuery('.elementor_header').hide().css("cssText", "display:none !important;");
		//jQuery('.elementor_footer').hide().css("cssText", "display:none !important;");		
		 
	   // SETUP MAP DISPLAY
	   
setTimeout(function(){
jQuery('#wlt_google_map_mapsearch-wrapper').show();
  loadGoogleMapsApi();
}, 5000);
	     
		   
	   jQuery('.wlt_map1_controls').show();
	   jQuery('#wlt_map_toolbox').hide();
         
   });
 
</script>
<textarea id="mapdatabox" class="dynamic_map" style="display:none;"><?php  //echo $CORE->wlt_googlemap_data(1); ?></textarea>
<input type="hidden" value="<?php echo _ppt('googlemap_apikey'); ?>" id="newgooglemapsapikey" />
<?php } } ?>