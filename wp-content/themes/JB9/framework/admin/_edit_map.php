<?php
/* =============================================================================
   USER ACTIONS
   ========================================================================== */
// CHECK THE PAGE IS NOT BEING LOADED DIRECTLY
if (!defined('THEME_VERSION')) {	header('HTTP/1.0 403 Forbidden'); exit; }


global $post, $CORE;

?>
  

<div id="wlt_map_location"  style="width:100%;"></div>


<div id="map_formbox" style="display:none;">

<div style="margin-top:20px;">
<label>Enter Location</label>

 <input type="text" onchange="getMapLocation(this.value);" style="width:100%; margin-bottom:10px;" name="custom[map-location]" id="form_map_location" class="long" tabindex="14" value="<?php echo $MYLOCATION; ?>">
 <input type="hidden" id="map-long" name="custom[map-log]" value="<?php echo get_post_meta($_GET['post'],'map-log',true); ?>">
 <input type="hidden" id="map-lat" name="custom[map-lat]"  value="<?php echo get_post_meta($_GET['post'],'map-lat',true); ?>"> 
</div>

<div class="box-admin">
<label>Country</label>
<div class="input-group"> 
<input type="text" id="map-country" name="custom[map-country]" <?php if(isset($_GET['post'])){ echo 'value="'.get_post_meta($_GET['post'],'map-country',true).'"'; } ?> class="form-control" >
</div></div>

<div class="box-admin">
<label>State/County</label>
<div class="input-group"> 
<input type="text" id="map-state" name="custom[map-state]" <?php if(isset($_GET['post'])){ echo 'value="'.get_post_meta($_GET['post'],'map-state',true).'"'; } ?> class="form-control" >
</div></div>

<div class="box-admin">
<label>City</label>
<div class="input-group"> 
<input type="text" id="map-city" name="custom[map-city]" <?php if(isset($_GET['post'])){ echo 'value="'.get_post_meta($_GET['post'],'map-city',true).'"'; } ?> class="form-control" >
</div></div>
 
<div class="box-admin">
<label>Area</label>
<div class="input-group"> 
<input type="text" id="map-area" name="custom[map-area]" <?php if(isset($_GET['post'])){ echo 'value="'.get_post_meta($_GET['post'],'map-area',true).'"'; } ?> class="form-control" >
</div></div>

<div class="box-admin">
<label>Route/Street</label> 
<div class="input-group">           
<input type="text" id="map-route" name="custom[map-route]" <?php if(isset($_GET['post'])){ echo 'value="'.get_post_meta($_GET['post'],'map-route',true).'"'; } ?> class="form-control" >
</div></div>
       
<div class="box-admin">
<label>Neighborhood</label>   
<div class="input-group">         
<input type="text" id="map-neighborhood" name="custom[map-neighborhood]" <?php if(isset($_GET['post'])){ echo 'value="'.get_post_meta($_GET['post'],'map-neighborhood',true).'"'; } ?> class="form-control" >
</div></div>

<div class="box-admin"> 
<label>Zipcode</label>
<div class="input-group"> 
<input type="text" id="map-zip" name="custom[map-zip]"  value="<?php if(isset($_GET['post'])){ echo get_post_meta($_GET['post'],'map-zip',true); } ?>" class="form-control" >
</div></div>
 
 
</div>
 
<script > 
var geocoder;var map;var marker = '';   var markerArray = [];    

function loadGoogleMapsApi(){


 
 jQuery('#wlt_map_location').css('height', '300px');
 jQuery('#map_formbox').show();


    if(typeof googlemap === "undefined"){
        var script = document.createElement("script");
        script.src = "https://maps.google.com/maps/api/js?callback=loadWLTGoogleMapsApiReady&key=<?php echo _ppt('googlemap_apikey'); ?>";
        document.getElementsByTagName("head")[0].appendChild(script);				
    } else {
        loadWLTGoogleMapsApiReady();
    }
}
function loadWLTGoogleMapsApiReady(){ 
	jQuery("body").trigger("gmap_loaded"); 
}
jQuery("body").bind("gmap_loaded", function(){

			<?php if(isset($_GET['post']) && is_numeric($_GET['post']) && get_post_meta($_GET['post'],'map-log',true) !=""){ ?>
			
			var myLatlng = new google.maps.LatLng(<?php echo get_post_meta($_GET['post'],'map-lat',true); ?>,<?php echo get_post_meta($_GET['post'],'map-log',true); ?>);
			
			var myOptions = { zoom: <?php if(isset($_GET['post'])){ echo 16; }else{ echo 8; } ?>,  center: myLatlng,  mapTypeId: google.maps.MapTypeId.ROADMAP}
			
			<?php }else{ ?>
			var myLatlng = new google.maps.LatLng(0,0);
			var myOptions = { zoom: 1,  center: myLatlng,  mapTypeId: google.maps.MapTypeId.ROADMAP}
			<?php } ?>
			 
			
            map = new google.maps.Map(document.getElementById("wlt_map_location"), myOptions);
			<?php if(isset($_GET['post']) && get_post_meta($_GET['post'],'map-log',true) !=""){ ?>
			var marker = new google.maps.Marker({
					position: myLatlng,
					map: map				 
				});
			markerArray.push(marker);
			<?php } ?>
			
			google.maps.event.addListener(map, 'click', function(event){			
				document.getElementById("map-long").value = event.latLng.lng();	
				document.getElementById("map-lat").value =  event.latLng.lat();
				getMyAddress(event.latLng);	
				addMarker(event.latLng);			
			});

});
function addMarker(location) {

	jQuery(markerArray).each(function(id, marker) {	
        marker.setVisible(false);
    });
	
	marker = new google.maps.Marker({	position: location, 	map: map,	});
	markerArray.push(marker);
	map.panTo(marker.position); 
	map.setCenter(location);  
}	
function getMapLocation(location){
 
			document.getElementById("map-state").value = "";
			var geocoder = new google.maps.Geocoder();if (geocoder) {	geocoder.geocode({"address": location}, function(results, status) {	if (status == google.maps.GeocoderStatus.OK) {
		 
			map.setCenter(results[0].geometry.location);
			addMarker(results[0].geometry.location);
			getMyAddress(results[0].geometry.location,"no");		
			document.getElementById("map-long").value = results[0].geometry.location.lng();	
			document.getElementById("map-lat").value =  results[0].geometry.location.lat();
			map.setZoom(9);		
			}});}
			
}
function getMyAddress(location){var geocoder = new google.maps.Geocoder();if (geocoder) {geocoder.geocode({"latLng": location}, function(results, status) { 

	if (status == google.maps.GeocoderStatus.OK) {
			 
				for (var i = 0; i < results[0].address_components.length; i++) {
				
                          var addr = results[0].address_components[i];
						   
						  switch (addr.types[0]){
						  	
								case "street_number": {
									//document.getElementById("map-address1").value = addr.long_name;
								} break;
								
								
								// area
								case "political": {
									document.getElementById("map-area").value = addr.long_name;
								} break;
								// neighborhood
								case "neighborhood": {
									document.getElementById("map-neighborhood").value = addr.long_name;
								} break;
								// street
								case "route": {
									document.getElementById("map-route").value = addr.long_name;
								} break;
								 
								
								case "locality": 
								case "postal_town": 
								{								 
									//document.getElementById("map-address3").value = addr.long_name;
									document.getElementById("map-city").value = addr.long_name;
								} break;
							
							case "postal_code": {
									document.getElementById("map-zip").value = addr.long_name;
								} break;
							case "administrative_area_level_1": {							
								document.getElementById("map-state").value = addr.long_name;
							} break;
							
							case "administrative_area_level_2": {							 
								document.getElementById("map-state").value = addr.long_name;
							} break;
							
							case "administrative_area_level_3": {						
								document.getElementById("map-state").value = document.getElementById("map-state").value + addr.long_name;
							} break;
							
							case "country": {
								document.getElementById("map-country").value = addr.short_name;	
							} break;						  
						  
						  } // end switch
						  
                } // end for
				 
			
			 document.getElementById("form_map_location").value = results[0].formatted_address;
			map.setCenter(results[0].geometry.location);
			}
});	}}

</script>








    <script >
 
        function add_map(obj) {
			
            var parent = jQuery(obj).parent().parent().parent().parent('div.field_row');
		 	 
            var inputField = jQuery(parent).find(".meta_image_url");

            tb_show('', 'admin.php?page=1');

            window.send_to_editor = function(html) {
			 
				var url = jQuery(html).attr('src');	 
				
				var imageid = jQuery(html).attr('class').replace(/\D/g,'');	
				 
                inputField.val(url);
				
                jQuery(parent).find("div.image_wrap").html('<img src="'+url+'" height="48" style="float:left; max-width:50px;" /><input type="hidden" name="gallery[image_aid][]" value="' + imageid +'">');

                // inputField.closest('p').prev('.awdMetaImage').html('<img height=120 width=120 src="'+url+'"/><p>URL: '+ url + '</p>'); 

                tb_remove();
            };

            return false;  
        }

        
    </script>


