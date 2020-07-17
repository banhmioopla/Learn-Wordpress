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


// LOAD IN MAIN DEFAULTS 
$core_admin_values = get_option("core_admin_values");  
   
// FIELDS

$fields = array(
 	
"name" => array("title" => "Name", "default" => "John Doe Company"),
"ceoname" => array("title" => "CEO Name", "default" => "John Doe"),	
"address" => array("title" => "Address", "default" => "Horse Guards Parade, London, United Kingdom"),
"email" => array("title" => "Email", "default" => ""),
"phone" => array("title" => "Phone", "default" => ""),	
"fax" => array("title" => "Fax", "default" => ""),


);

?> 



<div class="row">
<div class="col-lg-6">

   <div class="bg-white p-5 shadow" style="border-radius: 7px;">
   
<div class="tabheader mb-3">
         <h4><span>My Company Details</span></h4>
</div>


<?php foreach($fields as $key => $data){  ?> 
<div class="row mb-2">
    <div class="col-md-4">
        <label class="txt500"><?php echo $data['title']; ?></label>
    </div>
    <div class="col-md-8">         
    
    <?php if($key == "address"){ ?>
    <textarea name="admin_values[company][<?php echo $key; ?>]"  style="height:100px !important;"  class="form-control"><?php echo _ppt(array('company',$key)); ?></textarea> 
    <?php }else{ ?>
	 <input type="text" name="admin_values[company][<?php echo $key; ?>]"  class="form-control"   value="<?php if(_ppt(array('company',$key)) == ""){ echo $data['default']; }else{ echo _ppt(array('company',$key)); } ?>">
	<?php } ?>
                           
       
    </div>
</div>  
<?php } ?>

 <div class="clearfix"></div>


<?php if(THEME_KEY != "sp"){ ?>

<div class="mt-3 mb-3">
 
<label class="txt500">Map Cooradinates</label> <span id="mapl1"><?php echo _ppt(array('company','map-log')); ?></span> / <span id="mapl2"><?php echo _ppt(array('company','map-lat')); ?></span>


<style>
#pac-input { width:400px; position:absolute; top:20px; margin-top:10px; }
</style>

 
<input id="pac-input" class="form-control" type="text" placeholder="Search Box" style="display:none;">


<div id="wlt_map_location" class="bg-light mb-4" style="height:250px;width:100%;position:relative;">
<button class="btn rounded-0 btn-outline-dark" type="button" onclick="loadGoogleMapsApi();" style="position:absolute;top:40%; left:40%;">Load Map</button>
</div>

 <input type="hidden" id="map-long" name="admin_values[company][map-log]" value="<?php echo _ppt(array('company','map-log')); ?>">
 <input type="hidden" id="map-lat" name="admin_values[company][map-lat]"  value="<?php echo _ppt(array('company','map-lat')); ?>"> 
 
</div> 
<script > 

jQuery(document).ready(function(){
<?php if( _ppt(array('company','map-log')) !="" ){ ?>
loadGoogleMapsApi();
<?php } ?>
});


var geocoder;var map;var marker = '';   var markerArray = [];    

function loadGoogleMapsApi(){
	
	jQuery('#wlt_map_location').show();
    if(typeof googlemap === "undefined"){
        var script = document.createElement("script");
        script.src = "https://maps.google.com/maps/api/js?callback=loadWLTGoogleMapsApiReady&key=<?php echo _ppt('googlemap_apikey'); ?>&libraries=places";
        document.getElementsByTagName("head")[0].appendChild(script);				
    } else {
        loadWLTGoogleMapsApiReady();
    }
	
	jQuery('#pac-input').show();
}
function loadWLTGoogleMapsApiReady(){ 
	jQuery("body").trigger("gmap_loaded"); 
}
jQuery("body").bind("gmap_loaded", function(){

			<?php if( _ppt(array('company','map-log')) !="" ){ ?>
			
			var myLatlng = new google.maps.LatLng(<?php echo _ppt(array('company','map-lat')); ?>,<?php echo  _ppt(array('company','map-log')); ?>);
			var myOptions = { zoom: 8,  center: myLatlng,  mapTypeId: google.maps.MapTypeId.ROADMAP}
			
			<?php }else{ ?>
			var myLatlng = new google.maps.LatLng(0,0);
			var myOptions = { zoom: 1,  center: myLatlng,  mapTypeId: google.maps.MapTypeId.ROADMAP}
			<?php } ?>
			 
			
            map = new google.maps.Map(document.getElementById("wlt_map_location"), myOptions);
			
			
		// Create the search box and link it to the UI element.
        var input = document.getElementById('pac-input');
        var searchBox = new google.maps.places.SearchBox(input);
        map.controls[google.maps.ControlPosition.TOP_LEFT].push(input);

	  // LISTEN FOR PLACES ONCLICK
	  searchBox.addListener('places_changed', function() {
		var places = searchBox.getPlaces();
		 
		addMarker(places[0].geometry.location);
		
				document.getElementById("map-long").value = places[0].geometry.location.lng();	
				document.getElementById("map-lat").value =  places[0].geometry.location.lat();
				
				jQuery('#mapl1').html(places[0].geometry.location.lng());
				jQuery('#mapl2').html(places[0].geometry.location.lat());
		   
	
	  });
 
			
			
			<?php if( _ppt(array('company','map-log')) != "" ){ ?>
			var marker = new google.maps.Marker({
					position: myLatlng,
					map: map				 
				});
			markerArray.push(marker);
			<?php } ?>
			
			 
			
			google.maps.event.addListener(map, 'click', function(event){			
				document.getElementById("map-long").value = event.latLng.lng();	
				document.getElementById("map-lat").value =  event.latLng.lat();
				
				jQuery('#mapl1').html(event.latLng.lng());
				jQuery('#mapl2').html(event.latLng.lat());
				 
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
		 	
			document.getElementById("map-long").value = results[0].geometry.location.lng();	
			document.getElementById("map-lat").value =  results[0].geometry.location.lat();
			map.setZoom(9);		
			}});}
			
}
 

</script>




<?php } ?>



<div class="mt-3 mb-3">
<label class="txt500">Mission Statement</label>
<textarea name="admin_values[company][mission]" style="height:200px !important;"  class="form-control"><?php if(isset($core_admin_values['company']) && isset($core_admin_values['company']['mission'])){ echo $core_admin_values['company']['mission']; }else{ ?>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.<?php } ?></textarea>
</div>










   </div>
</div>

<div class="col-lg-6">


 
<div class="bg-white p-5 shadow" style="border-radius: 7px;">
   
<div class="tabheader">
         <h4><span>Social Media</span></h4>
      </div>
      
      

  <div class="row mt-4">
 <?php $type = array(
 "twitter" => array("n" => "Twitter", "icon" => "fa-twitter"),
 "dribbble" => array("n" => "Link", "icon" => "fa-link"),
 "facebook" => array("n" => "Facebook", "icon" => "fa-facebook"),
 "linkedin" => array("n" => "Linkedin", "icon" => "fa-linkedin"),
 "youtube" => array("n" => "Youtube", "icon" => "fa-youtube"),
 "skype" => array("n" => "Skype", "icon" => "fa-skype"), 
  ); 
 
foreach($type as $k1=>$v1){ ?>
 <div class="col-12 pl-0" >
   <!------------ FIELD -------------->          
<div class=" py-2">
	<div class="row">
        <div class="col-md-4">
        	<label class="mb-2 col-md-4 txt500"><?php if($v1['icon']  == _ppt(array('social',$k1.'_icon'))  ){  echo $v1['n']; } ?></label>
        </div>
        <div class="col-md-8">

      <input type="text"  name="admin_values[social][<?php echo $k1; ?>]" value="<?php echo _ppt(array('social',$k1)); ?>" class="form-control">
     
     <div class="input-group my-2">
     <div class="input-group-prepend">
    <span class="input-group-text"><i class="fa <?php if(_ppt(array('social',$k1.'_icon')) == ""){ $hi = $v1['icon']; }else{ $hi = $core_admin_values['social'][$k1.'_icon']; } 
	 
	echo $hi;
	
	?>"></i> </span>
  </div>
    <input type="text"  name="admin_values[social][<?php echo $k1; ?>_icon]" value="<?php echo $hi; ?>" class="form-control margin-top1">  

        </div>
    </div> 
     
    </div>
</div>
<!------------ END FIELD -------------->
</div>
<?php } ?> 

</div>

      
      


 

<div class="clearfix"></div>


<div class="alert alert-info rounded-0 my-4 small">You can change the icons and/or use alternative social networks by using a different icon. <a href="https://fontawesome.com/v4.7.0/icons/" target="_blank">Icons Here</a></div>

      

</div> 



 


 
</div>
</div>
 
<div class="bg-primary p-1 text-center mt-5 shadow" style="border-radius: 7px;">

<button type="submit" class="btn btn-lg btn-primary btn-block"><?php echo __("Save Settings","premiumpress-admin"); ?></button> 

</div> 