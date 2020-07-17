/* =============================================================================
  GOOGLE MAP DATA
   ========================================================================== */
var InfoBox; 
var map;
var google;
var maps;
var MapTriggered;
var AllMarkers = [];

 
 
function loadGoogleMapsApi(){
	
    if (typeof google === 'object' && typeof google.maps === 'object') {
		
		loadWLTGoogleMapsApiReady(); 
		
	} else {
	 	
		// FIX FOR NEW GOOGLE MAPS KEY
		gapikey = jQuery('#newgooglemapsapikey').val();
 
        var script = document.createElement("script");		
        script.src = "https://maps.google.com/maps/api/js?libraries=places,geometry&callback=loadWLTGoogleMapsApiReady&region="+ wlt_map_options[0]['region'] + "&key=" + gapikey +"&language="+ wlt_map_options[0]['lang']; 
        document.getElementsByTagName("head")[0].appendChild(script);		
		
		// DELAY REQUIRED FOR API TO LOAD BEFORE SCRIPTS
		setTimeout(function(){ loadmymaps(); },2000);
			
        
    }
 
}
function loadWLTGoogleMapsApiReady(){   jQuery("body").trigger("gmap_loaded"); }
//jQuery("body").bind("gmap_loaded", function(){
			
			
 function init_canvas_projection() {
        function CanvasProjectionOverlay() {}
        CanvasProjectionOverlay.prototype = new google.maps.OverlayView();
        CanvasProjectionOverlay.prototype.constructor = CanvasProjectionOverlay;
        CanvasProjectionOverlay.prototype.onAdd = function(){};
        CanvasProjectionOverlay.prototype.draw = function(){};
        CanvasProjectionOverlay.prototype.onRemove = function(){};
        
        self.canvasProjectionOverlay = new CanvasProjectionOverlay();
        self.canvasProjectionOverlay.setMap(self.map);
 }
function loadmymaps(){
 	 							
	// GET DATA
	var mdata = wlt_map_options[0];	
	//console.log(mdata);
 
	
	jQuery('#wlt_google_map_wrapper').show();
	if(typeof mdata['color'] !== "undefined"){
	jQuery('#wlt_google_map_wrapper').addClass(mdata['color']);
	}
	
	// DONT RETRIGGER THE MAP
	if(MapTriggered == "yes"){ return; }	 
	
	
	setTimeout(function(){
	// LOAD IN THE INFO BOX
    var script1 = document.createElement("script");
    script1.src = mdata['path']+"/framework/js/backup_js/js.mapinfo.js";
    document.getElementsByTagName("head")[0].appendChild(script1);
	 },100);

 	
	// SET TIMEOUT FUNCTION
 	setTimeout(function(){ 
 
		var options = {center: new google.maps.LatLng(mdata['long'],mdata['lat']), zoom: mdata['zoom'], panControl: true, zoomControl: true, scaleControl: false, mapTypeControl: false, disableDefaultUI: false }; // google.maps.MapTypeId.HYBRID, google.maps.MapTypeId.SATELLITE, google.maps.MapTypeId.TERRAIN
		 
		map = new google.maps.Map(document.getElementById(mdata['id']), options); 
		var image = new google.maps.MarkerImage(mdata['icon']);
		
		init_canvas_projection();
 
		var markerClicked = 0;
		var activeMarker = false;
		var MapTriggered = "yes";		
		var marker = '';
		var markers = [];
		
		// SINGLE MARKER ONLY
		if(typeof wlt_map_options[0]['single'] !== "undefined"){
 
 			// HIDE CONTROLS
			jQuery(".wlt_map1_controls").hide();
			 
		} 
		
		// STYLES
		if(typeof mdata['color'] !== "undefined"){
			
		if(mdata['color'] == "blue"){
		var styles = [{"featureType":"administrative","elementType":"labels.text.fill","stylers":[{"color":"#444444"}]},{"featureType":"landscape","elementType":"all","stylers":[{"color":"#f2f2f2"}]},{"featureType":"poi","elementType":"all","stylers":[{"visibility":"off"}]},{"featureType":"road","elementType":"all","stylers":[{"saturation":-100},{"lightness":45}]},{"featureType":"road.highway","elementType":"all","stylers":[{"visibility":"simplified"}]},{"featureType":"road.arterial","elementType":"labels.icon","stylers":[{"visibility":"off"}]},{"featureType":"transit","elementType":"all","stylers":[{"visibility":"off"}]},{"featureType":"water","elementType":"all","stylers":[{"color":"#46bcec"},{"visibility":"on"}]}];			
		map.setOptions({styles: styles});
		}
		
		if(mdata['color'] == "grey"){
		var styles = [{"featureType":"water","elementType":"geometry","stylers":[{"color":"#e9e9e9"},{"lightness":17}]},{"featureType":"landscape","elementType":"geometry","stylers":[{"color":"#f5f5f5"},{"lightness":20}]},{"featureType":"road.highway","elementType":"geometry.fill","stylers":[{"color":"#ffffff"},{"lightness":17}]},{"featureType":"road.highway","elementType":"geometry.stroke","stylers":[{"color":"#ffffff"},{"lightness":29},{"weight":0.2}]},{"featureType":"road.arterial","elementType":"geometry","stylers":[{"color":"#ffffff"},{"lightness":18}]},{"featureType":"road.local","elementType":"geometry","stylers":[{"color":"#ffffff"},{"lightness":16}]},{"featureType":"poi","elementType":"geometry","stylers":[{"color":"#f5f5f5"},{"lightness":21}]},{"featureType":"poi.park","elementType":"geometry","stylers":[{"color":"#dedede"},{"lightness":21}]},{"elementType":"labels.text.stroke","stylers":[{"visibility":"on"},{"color":"#ffffff"},{"lightness":16}]},{"elementType":"labels.text.fill","stylers":[{"saturation":36},{"color":"#333333"},{"lightness":40}]},{"elementType":"labels.icon","stylers":[{"visibility":"off"}]},{"featureType":"transit","elementType":"geometry","stylers":[{"color":"#f2f2f2"},{"lightness":19}]},{"featureType":"administrative","elementType":"geometry.fill","stylers":[{"color":"#fefefe"},{"lightness":20}]},{"featureType":"administrative","elementType":"geometry.stroke","stylers":[{"color":"#fefefe"},{"lightness":17},{"weight":1.2}]}];
		map.setOptions({styles: styles});
		}
		
		if(mdata['color'] == "green"){
		var styles = [{"featureType":"water","elementType":"geometry","stylers":[{"visibility":"on"},{"color":"#aee2e0"}]},{"featureType":"landscape","elementType":"geometry.fill","stylers":[{"color":"#abce83"}]},{"featureType":"poi","elementType":"geometry.fill","stylers":[{"color":"#769E72"}]},{"featureType":"poi","elementType":"labels.text.fill","stylers":[{"color":"#7B8758"}]},{"featureType":"poi","elementType":"labels.text.stroke","stylers":[{"color":"#EBF4A4"}]},{"featureType":"poi.park","elementType":"geometry","stylers":[{"visibility":"simplified"},{"color":"#8dab68"}]},{"featureType":"road","elementType":"geometry.fill","stylers":[{"visibility":"simplified"}]},{"featureType":"road","elementType":"labels.text.fill","stylers":[{"color":"#5B5B3F"}]},{"featureType":"road","elementType":"labels.text.stroke","stylers":[{"color":"#ABCE83"}]},{"featureType":"road","elementType":"labels.icon","stylers":[{"visibility":"off"}]},{"featureType":"road.local","elementType":"geometry","stylers":[{"color":"#A4C67D"}]},{"featureType":"road.arterial","elementType":"geometry","stylers":[{"color":"#9BBF72"}]},{"featureType":"road.highway","elementType":"geometry","stylers":[{"color":"#EBF4A4"}]},{"featureType":"transit","stylers":[{"visibility":"off"}]},{"featureType":"administrative","elementType":"geometry.stroke","stylers":[{"visibility":"on"},{"color":"#87ae79"}]},{"featureType":"administrative","elementType":"geometry.fill","stylers":[{"color":"#7f2200"},{"visibility":"off"}]},{"featureType":"administrative","elementType":"labels.text.stroke","stylers":[{"color":"#ffffff"},{"visibility":"on"},{"weight":4.1}]},{"featureType":"administrative","elementType":"labels.text.fill","stylers":[{"color":"#495421"}]},{"featureType":"administrative.neighborhood","elementType":"labels","stylers":[{"visibility":"off"}]}]
		map.setOptions({styles: styles});
		}
		
		}else{
			
	 var styles = [{"featureType":"water","stylers":[{"visibility":"on"},{"color":"#acbcc9"}]},{"featureType":"landscape","stylers":[{"color":"#f2e5d4"}]},{"featureType":"road.highway","elementType":"geometry","stylers":[{"color":"#c5c6c6"}]},{"featureType":"road.arterial","elementType":"geometry","stylers":[{"color":"#e4d7c6"}]},{"featureType":"road.local","elementType":"geometry","stylers":[{"color":"#fbfaf7"}]},{"featureType":"poi.park","elementType":"geometry","stylers":[{"color":"#c5dac6"}]},{"featureType":"administrative","stylers":[{"visibility":"on"},{"lightness":33}]},{"featureType":"road"},{"featureType":"poi.park","elementType":"labels","stylers":[{"visibility":"on"},{"lightness":20}]},{},{"featureType":"road","stylers":[{"lightness":20}]}];
	 map.setOptions({styles: styles});
	 
		}
 	
	// PLOT MAP DATA IF NOT SINGLE
	if(mdata['data'] == "" ){
		//GetMapData();
	} else {
		MapPlotData(mdata['data']);	 
	}
	
	google.maps.event.addListenerOnce(map, 'idle', function(){
    
		// CHECK FOR DYNAMIC MAP DATA
		if(mdata['data'] == "" ){
		MapPlotDynamicData();
		}
		
		 
	}); 
 
	// AFTER LOADED
	google.maps.event.addListenerOnce(map, 'idle', function(){
	
		if(typeof wlt_map_options[0]['single'] == "undefined"){			
			
			// DISPLAY CATS
			MapCreateCats();
			
			// MAKE DRAGGABLE
			//jQuery( "#wlt_map_toolbox" ).draggable({ containment: "#wlt_google_map", scroll: false, });
			 	
			// ADD ON RADIUS
			if(typeof wlt_map_options[0]['radius'] !== "undefined"){
			MapRadius();
			} 
		
		}
		
		// ZOOM TO ADMIN -- DOESNT FOCUS!
	 	if(mdata['data'].length == 1){
		map.setZoom(10);
		}
		
	});
 
    

 }, 1000);
	
	
	
	

};

function MapDrawLine(markerID){
	 
	jQuery(AllMarkers).each(function(id, marker) {	 
		if(marker.id == markerID){ 
			
			var myLat = 0; var myLong = 0;
		 	
			// Check for geolocation support	
			//if (navigator.geolocation) {
				// Get current position
				 
				//navigator.geolocation.getCurrentPosition(function (position) {
					 	 
						var myLat = jQuery('#mylat').val();//position.coords.latitude;
						var myLong = jQuery('#mylog').val();//position.coords.longitude;						
						//console.log("Position Set:" + position.coords.longitude + ", " + position.coords.latitude);	
						
						if(myLat == ""){ alert('Please set your location at the top left of the website.'); return; }
						
						var lineCoordinates = [ marker.position, new google.maps.LatLng(myLat, myLong) ];
						var line = new google.maps.Polyline({
							path: lineCoordinates,
							geodesic: true,
							strokeColor: '#FF0000',
							strokeOpacity: 1.0,
							strokeWeight: 2
						});
					
						line.setMap(map);
 
						//Initialize the Path Array
						var path = new google.maps.MVCArray();
				 
						//Initialize the Direction Service
						var service = new google.maps.DirectionsService();
				 
						//Set the Path Stroke Color
						var poly = new google.maps.Polyline({ map: map, strokeColor: '#4986E7' });
						 
						//Loop and Draw Path Route between the Points on MAP
						 var src = new google.maps.LatLng(myLat, myLong);
						 var des = marker.position;
						path.push(src);
						poly.setPath(path);
						
						service.route({
									origin: src,
									destination: des,
									travelMode: google.maps.DirectionsTravelMode.DRIVING
								}, function (result, status) {
									if (status == google.maps.DirectionsStatus.OK) {
										for (var i = 0, len = result.routes[0].overview_path.length; i < len; i++) {
											path.push(result.routes[0].overview_path[i]);
										}
									}
						  });		
										
						map.setCenter(marker.position);
						map.setZoom(9);	
						
						
					//} ); 

			//}
						
		}
	
	});


	
}
function MapMyLocation(zoom){
   
	// CHECK IF CURRENT LOCATION IS ALREADY SAVED
	if(typeof jQuery('#mylog').val() !== "undefined" && jQuery('#mylog').val() != ""){
	 
		var me = new google.maps.LatLng(jQuery('#mylat').val(), jQuery('#mylog').val());
	
		marker = new google.maps.Marker({	position: me, 	map: map,   animation: google.maps.Animation.DROP,	});
		marker.setPosition(me);
	 	
		map.setCenter(me);
		if(zoom){	map.setZoom(wlt_map_options[0]['zoom']); }
	
	}else{ 
	
		var me = new google.maps.LatLng(wlt_map_options[0]['long'],wlt_map_options[0]['lat']);
	
		marker = new google.maps.Marker({	position: me, 	map: map,   animation: google.maps.Animation.DROP,	});
		marker.setPosition(me);
	 	
		map.setCenter(me);
		if(zoom){	map.setZoom(wlt_map_options[0]['zoom']); }
 
	} 
		
	
	
}
function MapSetTypeID(type){ 
	map.setMapTypeId(type);
}
function MapCreateCats(){
	
	exists = [];

	jQuery(AllMarkers).each(function(id, marker) {	 	
		
		if(jQuery.inArray(marker.catid, exists) === -1 ){
			
			jQuery("#mapcatlist").append('<li><input type="checkbox" class="cck" value="1" onChange="toggleMarkers(this, ' + marker.catid + ');" checked="checked" > ' + marker.catname + '</li>');
            exists.push(marker.catid); 
           	
        }	
        
    });
}

function toggleMarkers(e, catid){
 
	if ( jQuery(e).is(':checked') ){
	visible = true;
	} else {
	visible = false;
	}

    jQuery(AllMarkers).each(function(id, marker) {
	 
		if(marker.catid == catid || catid == 0 ){
			marker.setVisible(visible);
		}
        
    });
	
	if(catid == 0){
		jQuery('.cck').attr('checked', visible);
	}
}
function MapRadius(){

	var radiusdata = wlt_map_options[0]['radius'];
 
	var ziplog = radiusdata[0]['long'];
	var ziplat = radiusdata[0]['lat']
	
	// ADD ON SEARCH RADIUS MARKER
	var marker = new google.maps.Marker({
	position: new google.maps.LatLng(ziplat,ziplog),
	map: map,
	url: '#',
	//shadow: shadow,	
	//icon: image,
	info: radiusdata[0]['zip'],					
	});	
	var circle = new google.maps.Circle({
	  map: map,
	  radius: radiusdata[0]['dis'],  
	  fillColor: '#AA0000'
	});
	circle.bindTo('center', marker, 'position');
	
	map.panTo(marker.position); 
	map.setZoom(10); 
 
	
}

function convert_offset(latlng, x_offset, y_offset) {
	
        var proj = canvasProjectionOverlay.getProjection();
        var point = proj.fromLatLngToContainerPixel(latlng);
        point.x = point.x + x_offset;
        point.y = point.y + y_offset;
        return proj.fromContainerPixelToLatLng(point);
    }

function MapPlotData(mapdata){
  
	var ClusterwMarkers = [];
 
	var bounds = new google.maps.LatLngBounds();
  	
	current_marker = 0,
	    open_info_window = null,
	    x_center_offset = 0, // x,y offset in px when map gets built with marker bounds
	    y_center_offset = 0,
	    x_info_offset = -0, // x,y offset in px when map pans to marker -- to accomodate infoBubble
	    y_info_offset = -180;
		 
		
	jQuery.each(mapdata, function(index, item) {
					 			  
	 			 
					var latLng = new google.maps.LatLng(item.lat, item.long);
					bounds.extend(latLng);
									
					var markerContent = document.createElement('DIV');   
					if(typeof wlt_map_options[0]['mapicon'] !== "undefined"){
				 	mapicon = wlt_map_options[0]['mapicon'];	
					}else{
					mapicon = "map-icon";	
					}
					
					
					markerContent.innerHTML =  '<div class="'+ mapicon +' cat_'+ item.catid +'">&nbsp;</div>';
					
					/*
					var marker = new RichMarker({
						position: latLng,
						map: map,
						id: item.id,
						//url: coord[2],
						draggable: false,
						content: markerContent,
						flat: true,
						animation: google.maps.Animation.DROP, 
						catid:	item.catid,
						catname: item.catname,
						info: '<div class="wlt-marker-wrapper clearfix"><div class="wlt-marker-content"><div class="col-md-12 media" style="background-image:url('+ item.img +'); background-size: cover; "><div class="ficons"><div class="close" onClick=\'javascript:infoBox.close();\'><span class="fa fa-close"></span></div></div></div><div class="col-md-12 content py-3"><div class="titleb"><a href="'+ item.url +'">'+ item.title  +'</a></div><div class="txt">'+ item.desc +'</div></div></div></div>',	 
										
					});*/
					
					var marker = new google.maps.Marker({
						id: item.id,
						map: map, 
						animation: google.maps.Animation.DROP,
						draggable: false,
						flat: true,
						fullScreenControl: true,
						fullscreenControlOptions: {
							position: google.maps.ControlPosition.BOTTOM_LEFT
						},
						//icon: mapPin,   
						position: latLng,
					});

		 			//map.setCenter(convert_offset(bounds.getCenter(), x_center_offset, y_center_offset));
				 	 
					// ADD TO ALL MARKERS ARRAY
					AllMarkers.push(marker);
					ClusterwMarkers.push(marker);
					
					
					
/*					
var contentString = '<div class="wlt-marker-wrapper clearfix"><div class="wlt-marker-content"><div class="col-md-12 media" style="background-image:url('+ item.img +'); background-size: cover; "><div class="ficons"><div class="close" onClick=\'javascript:infoBox.close();\'><span class="fa fa-close"></span></div></div></div><div class="col-md-12 content py-3"><div class="titleb"><a href="'+ item.url +'">'+ item.title  +'</a></div><div class="txt">'+ item.desc +'</div></div></div></div>';
	*/				
					
					
			var contentString =
			'<div class="infobox">'+
			'<div class="info-image clearfix">'+			
					'<a href="'+item.url+'"><img src="'+
						item.img+
					'" /></a>'+			
			'</div>'+
			'<div class="listing-details">'+				
					'<div class="top mb-0"><a href="'+item.url+'">'+item.title+'</a></div>'+
					'<div class="bottom mb-0">'+item.extra1+'</div>'+			
				'<div class="extra mb-0"><strong>'+item.extra2+'</strong></div>'+
			'</div>';
					
					 
					var infobox = new InfoBox({
						content: contentString,
						disableAutoPan: true,
						maxWidth: 0,
						alignBottom: true,
						pixelOffset: new google.maps.Size( -125, -64 ),
						zIndex: null,
						closeBoxMargin: "8px 0 -20px -20px",
						//closeBoxURL: imagesURL+'/images/infobox-close.png',
						infoBoxClearance: new google.maps.Size(1, 1),
						isHidden: false,
						pane: "floatPane",
						enableEventPropagation: false
					});
			
					google.maps.event.addListener(marker, 'click', function() {
			
						if(open_info_window) open_info_window.close();
						
							infobox.open(self.map, marker);
							self.map.panTo(convert_offset(this.position, x_info_offset, y_info_offset));
							open_info_window = infobox;
						 
					});	
					
					
					
					// ADD TO BOUNDS
					bounds.extend(latLng);	
					
	});	
	
 
	
	
	
	// FIT ALL BOUNDS ONTO THE MAP
	map.fitBounds(bounds); 
	
	// BUILD MARKERS
	if(wlt_map_options[0]['cluster'] == "yes"){
    var clusterStyles = [ { url: wlt_map_options[0]['path']+'/framework/img/cluster.png', height: 34, width: 34  } ];
	var markerCluster = new MarkerClusterer(map, ClusterwMarkers, { styles: clusterStyles, maxZoom: 19 }); 	
	}
	
}


function GetMapData(){

	jQuery.ajax({				
			url : wlt_map_options[0]['l'],
			type: "POST",
			data: {'core_aj' : 1, 'wlt_ajax': 'mapdata', 'data' : wlt_map_options[0]['data']  },
			dataType : 'json',
			success : function(response) {
				 //console.log(response);
				 // PLOT THE DATA ON THE MAP
				 MapPlotData(response.mapdata);
				
			},
			error : function(err){

        		// do error checking
        		//alert("something went wrong");
        		//console.error(err);
        	}
		});
	

};

function MapPlotDynamicData(){
	
jQuery( ".dynamic_map" ).each(function( index ) {
 
 	// GET ONJECT DATA
	var jsonObj = jQuery( this ).val();
	if(jsonObj != ""){
		
		var obj = jQuery.parseJSON(jsonObj);
	  	//console.log(obj);
		 MapPlotData(obj);
		
	}
 
});	
	
}