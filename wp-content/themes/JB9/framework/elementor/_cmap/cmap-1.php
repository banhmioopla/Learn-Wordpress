<?php global $CORE, $userdata, $wpdb, $settings; 


   wp_enqueue_script('map', FRAMREWORK_URI.'js/backup_js/js.map.js');
	wp_enqueue_script('map'); 

?>

<script>
   var maps;
   var google;
   var mapmarkerdata = [];
</script>
 <div id="wlt_google_map_mapsearch-wrapper" class="border-bottom hide-mobile" style="display:none;">
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
   
   }];
 
</script>
<script>
   // FIRE GOOGLE MAPS DATA
   jQuery(document).ready(function() {
   	
	 
    // SETUP MAP DISPLAY
	setTimeout(function(){
	jQuery('#wlt_google_map_mapsearch-wrapper').show();
	  loadGoogleMapsApi();
	}, 5000);    
       
   jQuery('.wlt_map1_controls').show();
   jQuery('#wlt_map_toolbox').hide();
         
   });
   
   var AllMarkers;
   var map;
   var infobox;
   
   jQuery(document).ready(function() {
  
   var HeightOffset = 30;   	
   <?php if ( is_admin_bar_showing() ) { ?>
   var HeightOffset = 30;   
   <?php } ?>
   
   jQuery('#mapsearch-wrapper .column-map').css('top',jQuery('#header').height()+HeightOffset );
   
   document.addEventListener('scroll', function (event) {
		//console.log(window.innerHeight);
   	jQuery('#mapsearch-wrapper .column-map').css('top',0);
   
	}, true /*Capture event*/);
  
   jQuery('.map-item').on('mouseover',function() {
   var listing_id = jQuery(this).data('marker-id');
   if(listing_id !== undefined) {		
   
   jQuery(AllMarkers).each(function(id, marker) {	 	
   
   if(marker.id == listing_id ){
   	
   	map.panTo(marker.position); 
   	map.setZoom(16); 
   	
   	google.maps.event.trigger(marker, 'click');
   	
   }        
   }); 			
   
   }
   });
   });
   
   
   
</script>
<?php
$args = array(
		'post_type' => THEME_TAXONOMY.'_type',
		'orderby' => 'ID',
		'order' => 'desc',
		'no_found_rows' => true,
		'posts_per_page' => 100,
			'meta_query' => array (
				array (
				'key' => 'map-lat',
				'value' => '',
				 'compare' => '!='
				)		 
			),
		);
$query1 = new WP_Query($args); 
while ( $query1->have_posts() ) { $query1->the_post();
   
$long 		= get_post_meta($post->ID,'map-log',true);	
if($long != ""){ 
	$lat 		= get_post_meta($post->ID,'map-lat',true);
	$ib = 		$CORE->media_get($post->ID,"image");				 	
	$image = $ib[0]['thumbnail'];
   		
	$extra1 = "";
	$extra2 = "";
				
	$extra1 = get_post_meta($post->ID,'map-city',true);
	if(get_post_meta($post->ID,'map-area',true) != ""){
				$extra1 .= ", ".get_post_meta($post->ID,'map-area',true);
	}
   		 	
   		?>
<script>
   mapmarker = {
   
   	"id"	: "<?php echo $post->ID; ?>",	
   	"lat" 	: "<?php echo $lat; ?>",
   	"long" 	: "<?php echo $long; ?>", 
   	"url"  	: "<?php echo the_permalink($post->ID); ?>",
   	"title" : "<?php echo esc_html(str_replace("'","",substr(strip_tags($post->post_title),0,28))); ?>",
   	"desc" 	: "",
   	"img" 	: "<?php echo $image; ?>",	
   	"extra1" : "<?php echo do_shortcode('[LOCATION]'); ?>",
   	"extra2" : "<?php echo do_shortcode('[CATEGORY link=0 limit=1]'); ?>",
   };	
   
   mapmarkerdata.push(mapmarker);	
   
</script>

<?php }  wp_reset_query();} ?>


<input type="hidden" value="<?php echo _ppt('googlemap_apikey'); ?>" id="newgooglemapsapikey" />