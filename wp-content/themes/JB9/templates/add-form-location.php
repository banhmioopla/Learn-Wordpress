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
   
    
   global $CORE;
   
   ?>
<div class="<?php if(defined('IS_MOBILEVIEW') ){ }else{?>card rounded-0<?php } ?>">
   <div class="card-header" id="headingThree">
      <h5 class="mb-0">
         <button class="btn btn-link btn-block text-left text-uppercase font-weight-bold text-dark collapsed" data-toggle="collapse" data-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
         <?php echo __("Location","premiumpress"); ?>
         </button>
      </h5>
   </div>
   <div id="collapseThree" class="collapse" aria-labelledby="headingThree" data-parent="#accordion">
      <div class="<?php if(defined('IS_MOBILEVIEW') ){ ?>mt-3<?php }else{?>card-body<?php } ?>">
      
      
      <?php if(_ppt('google') == 0){ ?>
      
      <div class="col-md-12">
               <div id="mapform-extra">
                  <div class="row">
                     <div class="col-md-6">
                        <label class="small mt-2"><?php echo __("Country","premiumpress"); ?></label>
                        
                        
                         <select class="form-control" tabindex="6" id="map-country" name="custom[map-country]">
                        <?php 
						
						// USER COUNTRY		
						$selected_country = "";				
						if(isset($_GET['eid'])){ $selected_country = get_post_meta($_GET['eid'],'map-country',true); }												
                        foreach($GLOBALS['core_country_list'] as $key=>$value){
                                   if(isset($selected_country) && $selected_country == $key){ $sel ="selected=selected"; }else{ $sel =""; }
                                   echo "<option ".$sel." value='".$key."'>".$value."</option>";} ?>
                        </select> 
                       
                        <div class="clearfix"></div>
                     </div>
                     <div class="col-md-6">
                        <label class="small mt-2"><?php echo __("State/County","premiumpress"); ?></label>
                        <input type="text" id="map-state" name="custom[map-state]" <?php if(isset($_GET['eid'])){ echo 'value="'.get_post_meta($_GET['eid'],'map-state',true).'"'; } ?> class="form-control rounded-0 form-control rounded-0-sm">
                        <div class="clearfix"></div>
                     </div>
                     <div class="col-md-6">
                        <label class="small mt-2"><?php echo __("City","premiumpress"); ?></label>
                        <input type="text" id="map-city" name="custom[map-city]" <?php if(isset($_GET['eid'])){ echo 'value="'.get_post_meta($_GET['eid'],'map-city',true).'"'; } ?> class="form-control rounded-0 form-control rounded-0-sm">
                        <div class="clearfix"></div>
                     </div>
                     <div class="col-md-6">
                        <label class="small mt-2"><?php echo __("Area","premiumpress"); ?></label>
                        <input type="text" id="map-area" name="custom[map-area]" <?php if(isset($_GET['eid'])){ echo 'value="'.get_post_meta($_GET['eid'],'map-area',true).'"'; } ?> class="form-control rounded-0 form-control rounded-0-sm">
                        <div class="clearfix"></div>
                     </div>
                     <div class="col-md-6">
                        <label class="small mt-2"><?php echo __("Route/Street","premiumpress"); ?></label>           
                        <input type="text" id="map-route" name="custom[map-route]" <?php if(isset($_GET['eid'])){ echo 'value="'.get_post_meta($_GET['eid'],'map-route',true).'"'; } ?> class="form-control rounded-0 form-control rounded-0-sm">
                        <div class="clearfix"></div>
                     </div>
                     <div class="col-md-6">
                        <label class="small mt-2"><?php echo __("Neighborhood","premiumpress"); ?></label>           
                        <input type="text" id="map-neighborhood" name="custom[map-neighborhood]" <?php if(isset($_GET['eid'])){ echo 'value="'.get_post_meta($_GET['eid'],'map-neighborhood',true).'"'; } ?> class="form-control rounded-0 form-control rounded-0-sm">
                        <div class="clearfix"></div>
                     </div>
                  
                  <div class="col-md-6">
                 <label class="small mt-2"><?php echo __("Postal code/zipcode","premiumpress"); ?> </label>
               <input type="text" class="form-control rounded-0 required mb-3" id="form_zipbox" name="custom[map-zip]" value="<?php if(isset($_GET['eid'])){ echo get_post_meta($_GET['eid'],'map-zip',true); } ?>">
                        <div class="clearfix"></div>
                    
                  </div>
                  </div>
                  
                  <input type="hidden" id="map-location" name="custom[map-location]" <?php if(isset($_GET['eid'])){ echo 'value="'.get_post_meta($_GET['eid'],'map-location',true).'"'; } ?> class="form-control rounded-0 form-control rounded-0-sm">
                 
               </div>
            </div>  
      
      
      
      <?php }elseif(_ppt('google') == 1){ ?>
      
         <input type="hidden" class="form-control" id="map-long" name="custom[map-log]" <?php if(isset($_GET['eid'])){ echo 'value="'.get_post_meta($_GET['eid'],'map-log',true).'"'; } ?>>
         <input type="hidden" class="form-control" id="map-lat" name="custom[map-lat]" <?php if(isset($_GET['eid'])){ echo 'value="'.get_post_meta($_GET['eid'],'map-lat',true).'"'; } ?>> 
         <div class="row">
            <div class="col-md-12">
               <label><?php echo __("Enter your postal code/zipcode","premiumpress"); ?> <span class="red">*</span> </label>
               <input type="text" class="form-control rounded-0 required mb-3" placeholder="<?php echo __("town, city or zipcode...","premiumpress"); ?>" id="form_zipbox" name="custom[map-zip]" value="<?php if(isset($_GET['eid'])){ echo get_post_meta($_GET['eid'],'map-zip',true); } ?>">
               <div id="showmapbox">
                  <div id="wlt_map_location" style="height:300px;width:100%;"></div>
               </div>
               <!-- map canvus -->
               <div id="map-location-display" class="mt-4"><?php if(isset($_GET['eid'])){ echo get_post_meta($_GET['eid'],'map-location',true); } ?></div>
            </div>
            <div class="col-md-12">
               <div id="mapform-extra" style="<?php if(isset($_GET['eid']) && get_post_meta($_GET['eid'],'map-zip',true) == "" || !isset($_GET['eid'])){ echo "display:none"; } ?>">
                  <div class="row">
                     <div class="col-md-6">
                        <label class="small mt-2"><?php echo __("Country","premiumpress"); ?></label>
                        <input type="text" id="map-country" name="custom[map-country]" <?php if(isset($_GET['eid'])){ echo 'value="'.get_post_meta($_GET['eid'],'map-country',true).'"'; } ?> class="form-control rounded-0 form-control rounded-0-sm">
                        <div class="clearfix"></div>
                     </div>
                     <div class="col-md-6">
                        <label class="small mt-2"><?php echo __("State/County","premiumpress"); ?></label>
                        <input type="text" id="map-state" name="custom[map-state]" <?php if(isset($_GET['eid'])){ echo 'value="'.get_post_meta($_GET['eid'],'map-state',true).'"'; } ?> class="form-control rounded-0 form-control rounded-0-sm">
                        <div class="clearfix"></div>
                     </div>
                     <div class="col-md-6">
                        <label class="small mt-2"><?php echo __("City","premiumpress"); ?></label>
                        <input type="text" id="map-city" name="custom[map-city]" <?php if(isset($_GET['eid'])){ echo 'value="'.get_post_meta($_GET['eid'],'map-city',true).'"'; } ?> class="form-control rounded-0 form-control rounded-0-sm">
                        <div class="clearfix"></div>
                     </div>
                     <div class="col-md-6">
                        <label class="small mt-2"><?php echo __("Area","premiumpress"); ?></label>
                        <input type="text" id="map-area" name="custom[map-area]" <?php if(isset($_GET['eid'])){ echo 'value="'.get_post_meta($_GET['eid'],'map-area',true).'"'; } ?> class="form-control rounded-0 form-control rounded-0-sm">
                        <div class="clearfix"></div>
                     </div>
                     <div class="col-md-6">
                        <label class="small mt-2"><?php echo __("Route/Street","premiumpress"); ?></label>           
                        <input type="text" id="map-route" name="custom[map-route]" <?php if(isset($_GET['eid'])){ echo 'value="'.get_post_meta($_GET['eid'],'map-route',true).'"'; } ?> class="form-control rounded-0 form-control rounded-0-sm">
                        <div class="clearfix"></div>
                     </div>
                     <div class="col-md-6">
                        <label class="small mt-2"><?php echo __("Neighborhood","premiumpress"); ?></label>           
                        <input type="text" id="map-neighborhood" name="custom[map-neighborhood]" <?php if(isset($_GET['eid'])){ echo 'value="'.get_post_meta($_GET['eid'],'map-neighborhood',true).'"'; } ?> class="form-control rounded-0 form-control rounded-0-sm">
                        <div class="clearfix"></div>
                     </div>
                  </div>
                  <input type="hidden" id="map-location" name="custom[map-location]" <?php if(isset($_GET['eid'])){ echo 'value="'.get_post_meta($_GET['eid'],'map-location',true).'"'; } ?> class="form-control rounded-0 form-control rounded-0-sm">
                 
               </div>
            </div>            
            
         </div>
         




<script > 
   var geocoder;var map;var marker = ''; var markers = [];
   	
   function initializeLocationMap() {
   
   if(typeof(map) != "undefined"){ return; }
      
     // GET DEFAULT LOCATION
      <?php if(isset($_GET['eid']) && get_post_meta($_GET['eid'],'map-log',true) !=""){   
      $DF_LOCATON = get_post_meta($_GET['eid'],'map-lat',true).",".get_post_meta($_GET['eid'],'map-log',true);
      }else{
      $DF_LOCATON = _ppt('google_coords');   
      } 
      if($DF_LOCATON == ""){ $DF_LOCATON ="0,0"; }
      
      ?>
      
     // CREATE MAP CANVUS
     var myOptions = {mapTypeId: google.maps.MapTypeId.ROADMAP, zoomControl: true, scaleControl: true }
     map = new google.maps.Map(document.getElementById("wlt_map_location"), myOptions); 
        
     // LOAD MAP LOCATIONS
     var defaultBounds = new google.maps.LatLngBounds(
         new google.maps.LatLng(<?php echo $DF_LOCATON; ?>) );
      map.fitBounds(defaultBounds);
   
     // ADD ON MARKER
     <?php if(isset($_GET['eid']) && get_post_meta($_GET['eid'],'map-log',true) !=""){ ?>
     var marker = new google.maps.Marker({
     	position: new google.maps.LatLng(<?php echo get_post_meta($_GET['eid'],'map-lat',true); ?>,<?php echo get_post_meta($_GET['eid'],'map-log',true); ?>),
     	map: map,
     	animation: google.maps.Animation.DROP,	
   	icon: new google.maps.MarkerImage('<?php echo get_template_directory_uri(); ?>/framework/img/map/icon.png'),			 
     });
     <?php } ?> 
   
     // ADD SEARCH BOX
     //map.controls[google.maps.ControlPosition.TOP_LEFT].push(document.getElementById('form_zipbox'));
     var searchBox = new google.maps.places.SearchBox(document.getElementById('form_zipbox'));
     
     //jQuery('#showmapbox').hide();
   
     // EVENT
      google.maps.event.addListener(searchBox, 'places_changed', function() {
       var places = searchBox.getPlaces();
   
       if (places.length == 0) {
         return;
       }
       for (var i = 0, marker; marker = markers[i]; i++) {
         marker.setMap(null);
       }
   	
       // For each place, get the icon, place name, and location. 
       var bounds = new google.maps.LatLngBounds();
       for (var i = 0, place; place = places[i]; i++) {
         var image = {
           url: place.icon,
           size: new google.maps.Size(71, 71),
           origin: new google.maps.Point(0, 0),
           anchor: new google.maps.Point(17, 34),
           scaledSize: new google.maps.Size(25, 25)
         }; 
   	  
   
           addMarker(place.geometry.location);
   	    document.getElementById("map-long").value = place.geometry.location.lng();	
       	document.getElementById("map-lat").value =  place.geometry.location.lat();
   	    getMyAddress(place.geometry.location,true)
   
         bounds.extend(place.geometry.location);
       }
   
       map.fitBounds(bounds);	
   	map.setZoom(15);	 
     });
     
     // LISTEN FOR PLACES ONCLICK
     searchBox.addListener('places_changed', function() {
   	var places = searchBox.getPlaces();
   	jQuery('#form_zipbox').val(places[0].name);
   	jQuery('#showmapbox').show();
   
     });
   
     // EVENT
     google.maps.event.addListener(map, 'bounds_changed', function() {
       var bounds = map.getBounds();
       searchBox.setBounds(bounds);
   	//map.setZoom(15);	
     });
     
     // EVENT
     google.maps.event.addListener(map, 'click', function(event){			
     	document.getElementById("map-long").value = event.latLng.lng();	
       document.getElementById("map-lat").value =  event.latLng.lat();
       getMyAddress(event.latLng,"yes");	
       addMarker(event.latLng);
   	
     });
     
     
    
     
   } // END INIT
   
   
   jQuery("#form_map_location").focusout(function() {
   setTimeout(function(){  getMapLocation(jQuery("#form_map_location").val()); }, 500);
   
   });
   
   // HANDLE WHEN THE USED DOESNT SELECT ANYTHING FROM PLACES
   jQuery(document).on('change', '#form_zipbox', function() {
    getMapLocation(jQuery('#form_zipbox').val());
   });
   
   function getMapLocation(location){
                           document.getElementById("map-state").value = "";
                           var geocoder = new google.maps.Geocoder();
                               if (geocoder) {	geocoder.geocode({"address": location}, function(results, status) {	if (status == google.maps.GeocoderStatus.OK) {
   						 	 
                               map.setCenter(results[0].geometry.location);
                               addMarker(results[0].geometry.location);
                               getMyAddress(results[0].geometry.location,"no");			
                               document.getElementById("map-long").value = results[0].geometry.location.lng();	
                               document.getElementById("map-lat").value =  results[0].geometry.location.lat();
                               map.setZoom(15);	 // MAP ZOOM LEVEL	
                               }});}			
   }
   
    function getMyAddress(location,setaddress){
                            
                           jQuery('#showmapbox').show();
                           google.maps.event.trigger(map, 'resize');
                           var geocoder = new google.maps.Geocoder();
                           var country = "";
                           if (geocoder) {geocoder.geocode({"latLng": location}, function(results, status) { if (status == google.maps.GeocoderStatus.OK) {
                           
   						jQuery('#map-country').val = "";
   						jQuery('#map-state').val = "";  
   						jQuery('#map-route').val = "";  
   						jQuery('#map-area').val = "";  
   						jQuery('#map-neighborhood').val = "";  
   						jQuery('#map-location').val = ""; 
   						jQuery('#mapform-extra').show(); 
   
   						
   						
                           for (var i = 0; i < results[0].address_components.length; i++) {
   						
   						 
   							  var addr = results[0].address_components[i];
   							  //alert(addr.types[0]+' = '+ addr.long_name);
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
   									jQuery('#form_zipbox').val(addr.short_name);
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
   						
   						// NOW SET THE DISPLAY VALUES 
   			  			document.getElementById("map-location").value = results[0].formatted_address;
   						jQuery('#map-location-display').html('<i class="fa fa-map-marker" aria-hidden="true"></i> '+results[0].formatted_address);
                           
                           map.setCenter(results[0].geometry.location);		
                           map.setZoom(16);	
                           
                           }
   						
   						});
   						
   						}} 
                           
                           
                           function addMarker(location) {
   						if (marker=='') {	
   						
   						
   						marker = new google.maps.Marker({	position: location, 	map: map, draggable:true,     animation: google.maps.Animation.DROP,	});
   						
   						
   						google.maps.event.addListener (marker, 'dragend', function (event){
   						document.getElementById("map-long").value = event.latLng.lng();	
                           document.getElementById("map-lat").value =  event.latLng.lat();
                           getMyAddress(event.latLng,"yes");	
                           addMarker(event.latLng);
   						});
   						
   						
   						}						
                           marker.setPosition(location);
   						map.setCenter(location); 						
   						}
    
    
   // LOAD MAP BOX
   jQuery(document).ready(function() {                         
   	
   		setTimeout(function(){  initializeLocationMap(); }, 1000);
   	 
   });
    
</script>

         <?php } ?>
      </div>
   </div>
</div>