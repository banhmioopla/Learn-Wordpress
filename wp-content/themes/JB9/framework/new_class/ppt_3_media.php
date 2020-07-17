<?php


class framework_media extends framework_layout {

	// SET THE ACCEPTED FILE TYPES
  	public $allowed_image_types = array('image/jpg','image/jpeg','image/png');	 //'image/gif',	
	public $allowed_video_types = array('video/x-flv', 'video/mp4', 'video/webm', 'video/ogg', 'video/ovg','video/mpeg','video/quicktime');
	public $allowed_music_types = array('audio/mpeg','audio/mp3');
	public $allowed_doc_types = array('application/pdf','application/msword','application/octet-stream');
	
	public $media_set = array(); // STORES ARRAY OF MEDIA FILES ALREADY SET
 
	
	/* =============================================================================
	[MEDIA] - SHORTCODE FOR DISPLAYING ALL FILES
	========================================================================== */
	function wlt_shortcode_media($atts, $content = null){  global $userdata, $CORE, $post;  $STRING = "";

		// EXTRACT OPTIONS
		extract( shortcode_atts( array('type' => 'all', 'items' => 4, 'postid' => '', 'size' => '800', 'galleryonly' => false, 'galtype' => 1, 'limit' => 100), $atts ) );
 		
		// FIX FOR PRINT PAGE IMAGES
		if($postid != ""){ $pid = $postid; }else{ $pid = $post->ID; }
		
		
		// FIX FOR GALLERY ONLY IMAGES
		if($galleryonly){ $type = "gallery"; }
		
		// 1. GET MEDIA
		$files = $this->media_get($pid, $type); 
	 	if(!is_array($files)){ $files = array(); }
		 
		//2. CHECK OUTPUT
		if( count($files) == 0){ // FALLBACK IMAGES 
			
			// CHECK IF WE HAVE A VIDEO INSTEAD JUST ENCASE
			$videos = get_post_meta($pid,"video_array", true); 
			
			if(!empty($videos) && isset($videos[0]) ){		 
			
			// ADD THE ARRAY TO MEDIA SET
			$this->media_set = array_merge($this->media_set, array($videos[0]['id']));
			
			$videos[0]['src'] = str_replace("http://https","http",$videos[0]['src']);
			
			if($videos[0]['type'] == "youtube"){
			
				$YOUTUBELINK = get_post_meta($post->ID,'Youtube_link',true);
				if($YOUTUBELINK == ""){
				$YOUTUBELINK = get_post_meta($post->ID,'youtube',true);
				}
			
				$youid = explode("v=",$YOUTUBELINK);
				$thisid = explode("&",$youid[1]);
				$STRING = '
				<div class="hidden-sm hidden-xs videobox'.$post->ID.'">
					<video width="640" height="360" id="player1" preload="none" style="width: 100%; height: 100%;" autoplay="true">
						<source type="video/youtube" src="'.$YOUTUBELINK.'" />				 	
					</video>
				</div>
				<div class="visible-sm visible-xs videobox'.$post->ID.'">
						<iframe style="width:100%; height:100%;" src="//www.youtube.com/embed/'.$thisid[0].'" frameborder="0" allowfullscreen></iframe>
				</div><input value="0"  class="videotime'.$post->ID.'" type="hidden">';
				 
				
				// FIX FOR FIREFOX BROWSERS
				$browser = "";
				if (isset($_SERVER['HTTP_USER_AGENT'])) {
					$agent = $_SERVER['HTTP_USER_AGENT'];
				}
				if (isset($agent) && strlen(strstr($agent, 'Firefox')) > 0) {
					$vimg = $CORE->GETIMAGE($post->ID, false, array('pathonly' => true) );					 
					$STRING = '<a href="'.$YOUTUBELINK.'" target="_blank"><img src="'.$vimg.'" style="width:100%;" class="img-fluid" /></a>';
		 		}
				
				
				// ADD THE ARRAY TO MEDIA SET
				$this->media_set = array_merge($this->media_set, array("youtube"));
				 
				return $STRING;
			  } 
			
		 		return '';
				
			}elseif(!$galleryonly){
			 
				// ELSE SHOW FALLBACK IMAGE	 
				return  '<img src="'.$this->_FALLBACK($pid).'" alt="no image" data-src="'.$this->_FALLBACK($pid).'" class="img-fluid noimage">';
			
			}			
		
		}elseif( count($files) == 1 || ( count($files) > 1 && $limit == 1 ) ){ // ONLY 1 IMAGES		
		 
			// ADD THE ARRAY TO MEDIA SET
			if(isset($files[0]['id'])){
			$this->media_set = array_merge($this->media_set, array($files[0]['id']));
			}
			
			// REMOVE LINK AS ITS JUST 1 FILE
			//files[0]['nolink'] = 1;
			  
			// RETURN FILE
			echo $CORE->media_display($files[0], $size);
			
			
		}else{ // IMAGE GALLERY
		 
		$files = $CORE->multisort( $files , array('order') );
		
		// BUILD IMAGE GALLERY FIRST
		 
		if($galtype == 2){
		$STRING .= $this->media_display_gallery2($files);
		return $STRING;	
		}else{
		$STRING .= $this->media_display_gallery($files);
		}
		
		  
		// NOW SHOW EXTRA FILES
		if(is_array($files) && !empty($files)){
					 
			foreach($files as $file){
			 	
				// DONT SHOW ALREADY SHOWN FILES
				if(!in_array($file['id'], $this->media_set)){			
			
					// ADD THE ARRAY TO MEDIA SET
					$this->media_set = array_merge($this->media_set, array($file['id']));
					
					// GET DATA
					$STRING .= $CORE->media_display($file);
				
				} // end if

			} // end loop files
			
			return $STRING;			 
		
		} // END ELSE
	
		
		}
		
	}
	
	
	
	
	
	
	



// Remove height/width attributes on avatar img tags.
function avatar_remove_dimensions( $avatar ) {

    $avatar = preg_replace( "/(width|height)=\'\d*\'\s/", "", $avatar );

    return $avatar;

}

function get_the_post_thumbnail_src($img)
{
  return (preg_match('~\bsrc="([^"]++)"~', $img, $matches)) ? $matches[1] : '';
}

/*
	this function gets a list of
	featured listings
*/
function media_get_features($limit = "5"){ global $wpdb;
 
	$SQL = "SELECT ".$wpdb->posts.".* FROM ".$wpdb->posts."

				INNER JOIN ".$wpdb->postmeta." AS t1 ON ( t1.post_id = ".$wpdb->posts.".ID AND t1.meta_key = 'featured' AND t1.meta_value = 'yes')

				WHERE ".$wpdb->posts.".post_status= 'publish' AND ".$wpdb->posts.".post_type='listing_type'  ORDER BY RAND() LIMIT ".$limit;	

	 

	$images = array();

	$posts = $wpdb->get_results($SQL);	 

	foreach($posts as $post){ 

	$images[] = array('id' => $post->ID, 'post_title' => $post->post_title, 'post_content' => $post->post_content, 'images' => $this->media_get($post->ID,"image"), 'link' => get_permalink($post->ID)   );

	} 
  

	return $images;	
 		

}



/*
	this functionc creates the standatd gallery display
	within all themes
*/
function media_display_gallery2($files){ global $post; $gallery1 = ""; $gallery2 = "";
 	
	foreach($files as $file){
	 
		
		if(isset($file['type']) && in_array($file['type'],$this->allowed_image_types)){ 
		
		
			$this->media_set = array_merge($this->media_set, array($file['id']));
		
			// GET IMAGE AGAIN ENCASE THE ADMIN HAS MADE CHANGES
			if(strpos($file['src'],'amazon') == false){
			
				$image_src = wp_get_attachment_image_src( $file['id'], array(600,600) );				
				$src = hook_image_display($image_src[0]);
			  		
			}else{
		 
				$src = $file['src'];
			}
			$file['thumbnail'] = str_replace("-http","http", $file['thumbnail']);
				
			// ALT
			$alt = "";
			if(isset($file['name'])){
				$alt = $file['name'];
			}
			
			// GALLERY ITEMS
			if($src == ""){
			$src = $file['thumbnail'];
			} 
			
			$gallery1 	.= "<a href='".$src."' data-gal='prettyPhoto[ppt_gal_".$post->ID."]'><img src='".$src."' alt='".$alt."' class='img-fluid'  /></a>";			 
			$gallery2 	.= "<div><div class='image'><img src='".$file['thumbnail']."' alt='".$alt." &nbsp;' class='img-fluid'  /></div></div>";
		
		}
	}
	
	if(strlen($gallery1) > 1){ 
	ob_start();
	?>
	<?php echo $gallery2; ?>
	<?php
	return ob_get_clean(); 
	}

}
/*
	this functionc creates the standatd gallery display
	within all themes
*/
function media_display_gallery($files){ global $post; $gallery1 = ""; $gallery2 = "";
 	
	foreach($files as $file){
 	
		if(isset($file['type']) && in_array($file['type'],$this->allowed_image_types)){ 
		
		
			$this->media_set = array_merge($this->media_set, array($file['id']));
		
			// GET IMAGE AGAIN ENCASE THE ADMIN HAS MADE CHANGES
			if(strpos($file['src'],'amazon') == false){
			
				$image_src = wp_get_attachment_image_src( $file['id'], array(600,600) );				
				$src = hook_image_display($image_src[0]);
			  		
			}else{
		 
				$src = $file['src'];
			}
			$file['thumbnail'] = str_replace("-http","http", $file['thumbnail']);
				
			// ALT
			$alt = "";
			if(isset($file['name'])){
				$alt = $file['name'];
			}
			
			// GALLERY ITEMS
			if($src == ""){
			$src = $file['thumbnail'];
			} 
			if($file['thumbnail'] == ""){
			$file['thumbnail'] = $src;
			}
			
			if(defined('IS_MOBILEVIEW')){
			
			$gallery1 	.= '<a class="show-gallery" href="'.$src.'"><img src="'.$file['thumbnail'].'" alt="'.$alt.'" class="img-fluid"  /></a>';
			 			 
			$gallery2 	.= "<img src='".$file['thumbnail']."' alt='".$alt." &nbsp;' class='img-fluid owl-lazy' style='cursor:pointer' />";
		
			}else{
			
			
			
			$gallery1 	.= "<a href='".$src."' data-gal='prettyPhoto[ppt_gal_".$post->ID."]'><img src='".$src."' alt='".$alt."' class=' img-fluid'  /></a>";			 
			$gallery2 	.= "<img src='".$file['thumbnail']."' alt='".$alt." &nbsp;' class='img-fluid owl-lazy' style='cursor:pointer' />";
		
			}
			
		}
	}
	
	if(strlen($gallery1) > 1){ 
	
	if(defined('IS_MOBILEVIEW')){
	ob_start();
	?>
    <div class="single-store-slider owl-carousel owl-has-dots gallery store-product-slider mt-4">
    <?php echo $gallery1; ?>
    </div>
    <?php
	return ob_get_clean();	
	}else{
	ob_start();
	?>
	<div class="wlt_shortcode_images">
					
					<div id="slider" style="display:none;">
					  <?php echo $gallery1; ?>
					</div>    
				
					<div class="navs d-none d-sm-block">
					  <a class="btn prev"><i class='fa fa-angle-left'></i></a>
					  <a class="btn next"><i class='fa fa-angle-right'></i></a>
					</div>
				 
				 
					<div class="carousel">
					   
						<div id="slider-carousel">
						 <?php echo $gallery2; ?>
						</div>
						
					</div>
				 
	</div>
    
    <script>
	
	jQuery(document).ready(function() {
	
		function e() {
			var e = this.currentItem;
			jQuery("#slider-carousel").find(".owl-item").removeClass("synced").eq(e).addClass("synced"), void 0 !== jQuery("#slider-carousel").data("owlCarousel") && o(e)
		}
	
		function o(e) {
			var o = r.data("owlCarousel").owl.visibleItems,
				i = e,
				t = !1;
			for (var l in o)
				if (i === o[l]) var t = !0;
			t === !1 ? i > o[o.length - 1] ? r.trigger("owl.goTo", i - o.length + 2) : (i - 1 === -1 && (i = 0), r.trigger("owl.goTo", i)) : i === o[o.length - 1] ? r.trigger("owl.goTo", o[1]) : i === o[0] && r.trigger("owl.goTo", i - 1)
		}
		var i = jQuery("#slider"), r = jQuery("#slider-carousel");
		
		i.owlCarousel({
			singleItem: !0,
			slideSpeed: 1e3,
			navigation: !1,
			pagination: !1,
			afterAction: e,
			responsiveRefreshRate: 200, autoHeight : true,
			
		}), r.owlCarousel({ stagePadding: 50, margin:10, 
			items: 4,
			lazyLoad: !0,
			itemsDesktop: [1199, 10],
			itemsDesktopSmall: [979, 10],
			itemsTablet: [768, 8],
			itemsMobile: [479, 4],
			pagination: !1,
			responsiveRefreshRate: 100, 
			afterInit: function(e) {
				e.find(".owl-item").eq(0).addClass("synced")
			}
		}), jQuery("#slider-carousel").on("click", ".owl-item", function(e) {
			e.preventDefault();
			var o = jQuery(this).data("owlItem");
			i.trigger("owl.goTo", o)
		});
		
	  jQuery(".next").click(function(){
		i.trigger('owl.next');  r.trigger('owl.next');
	  });
	  jQuery(".prev").click(function(){
		i.trigger('owl.prev');  r.trigger('owl.prev');
	  });
		
	}); </script>
	<?php
	return ob_get_clean(); 
	}
	
	}

}

/*
This function builds the output for each media type
*/
function media_display( $file = array('type' => 'image'), $size = 300 ){
	
	if(!isset($file['type'])){return; }
	
	$STRING = "";
	 
	switch($file['type']){
	
		case "youtube": {
		
		
		} break;
		
		case "audio/mp3":
		case "audio/mpeg": {
		
			$STRING .= do_shortcode('[audio src="'.$file['src'].'"]');
		
		} break;
		 
		case "application/pdf":
		case "application/octet-stream":
		case "application/msword": { 
		
			$STRING = '<a href="'.$file['src'].'" target="_blank">'. __("Download","premiumpress").'</a>';
		
		} break;
		
		case 'video/x-flv':
		case 'video/mp4':
		case 'video/webm':
		case 'video/ogg':
		case 'video/ovg': {
			
			
			 
			// not in the amdin area
			if(is_admin()){			 
			$STRING = '<img src="'.str_replace(" ", "-",$file['thumbnail']).'" class="img-fluid" alt="'.$file['name'].'">';
			}else{
			
				// CHECK FOR IMAGE ATTACHMENT
				if(get_the_post_thumbnail_url($file['id']) != "" && !is_single()){
				
				$STRING = '<img src="'.get_the_post_thumbnail_url($file['id']).'" class="img-fluid" alt="'.$name.'">';
				
				}elseif(isset($file['thumbnail']) && strlen($file['thumbnail']) > 1){
				
				$thumb = wp_get_attachment_url( $file['id'] );
				
				$STRING = '<a href="'.$thumb.'" target="_blank"><img src="'.str_replace(" ", "-",$file['thumbnail']).'" class="img-fluid" alt="'.$file['name'].'"></a>';
				
				}else{ 
				
				$STRING = do_shortcode('[video src="'.$file['src'].'" width="800px" height="450px"]');
				
				}		
			
			}
			
		
		} break;
		
		case 'image/jpg':
		case 'image/jpeg':
		case 'image/gif':
		case 'image/png': {
		
		 	$name = "";
			
			// CHECK IMAGE SIZE 
			if(isset($file['id']) && is_numeric($file['id']) && $file['id'] > 0 ){	
			 
			$image = wp_get_attachment_image_src( $file['id'] , "large" );	
			 
			
				if(isset($file['name'])){
				$name = $file['name'];
				}
			 
				$STRING = '<img src="'.hook_image_display($image[0]).'" class="img-fluid" alt="'.$name.'">';
			
			}elseif(isset($file['thumbnail']) && $file['thumbnail'] != ""){
				$STRING = '<img src="'.str_replace(" ", "-",$file['thumbnail']).'" class="img-fluid" alt="'.$name.'">';
			}else{
				$STRING = '<img src="'.str_replace(" ", "-",$file['src']).'" class="img-fluid" alt="'.$name.'">';
			}
			
			if(!isset($file['nolink'])){
			$STRING = '<a href="'.$file['src'].'" data-gal="prettyPhoto" target="_blank">'. $STRING .'</a>';
			}
		
		} break;
		
		default: { 
		
			// CATCH ALL BROKEN THINGS
			$STRING = "";
			
		} break;
	
	}
 
	return $STRING;


}
	
/*
This function will get all media item for this listing

*/
 
function media_get($postID, $type = 'all'){ global $post, $wpdb, $CORE; $meida_array = array();
 

// GET THE FILE TYPE STORAGE KEY
if($type == "image" || $type == "images"|| $type == "singleimage" || $type == "gallery" ){
	$get_type = array("image_array");	$includeImages = true;		
}elseif($type == "video"){
	$get_type = array("video_array");
}elseif($type == "music"){
	$get_type = array("music_array");					
}elseif($type == "doc"){
	$get_type = array("doc_array");		
}elseif($type == "allbutmusic"){
	$get_type = array("image_array", "video_array", "doc_array");	 $includeImages = true;	
}else{
	$get_type = array("image_array", "video_array", "doc_array", "music_array");	 $includeImages = true;			
}
 

// DEMO IMG EXTRAS
if(defined('WLT_DEMOMODE') && isset($post->post_author) && $post->post_author == 1 && isset($GLOBALS['sampledata'])  ){  
		   
	$did = filter_var($post->post_title, FILTER_SANITIZE_NUMBER_INT);	
	 
	if(isset($GLOBALS['sampledata']) && isset($GLOBALS['sampledata'][$did]) ){				
	 
	$big = $GLOBALS['sampledata'][$did]['f'];
	$thumb = $GLOBALS['sampledata'][$did]['t'];
	
	$meida_array[] = array(
		"class" => "img-fluid", 
		"src" => trim($big), 
		"thumbnail" => trim($thumb),
		"order" => 0,
		"type" => "image/jpg",
		"id" => get_post_thumbnail_id($postID),
	 );
	 
	 return  $meida_array;
	 
	 }
	
}



// LOOP SELECTED MEDIA AND GET THE DATA
foreach($get_type as $typec){
	$g = get_post_meta($postID,$typec, true); 	 
	if(is_array($g)){		
	$meida_array = array_merge($meida_array, $CORE->multisort( $g , array('order') ) );	
	}
} 
 

// CHECK FOR ADMIN SET FEATURED IMAGE  
if ( empty($meida_array) && ($type == "image" || $type == "images" || $type == "all" || $type == "image_array" || $type == "singleimage" ) && has_post_thumbnail($postID) ) {
	
	if(is_single()){
	$size = "full";
	}else{
	$size = "thumbnail";
	}
	
	$thumb = hook_image_display(get_the_post_thumbnail_url($postID, $size));
 
	$meida_array[] = array(
		"class" => "wlt_thumbnail img-fluid", 
		"src" => trim($thumb), 
		"thumbnail" => trim($thumb),
		"order" => 0,
		"type" => "image/jpg",
		"id" => get_post_thumbnail_id($postID),
	 );
}
 
// CHECK IF ITS EMPTY
if(!is_admin() && empty($meida_array) ){

	// GET POST CONTENT
	$SQL = "SELECT DISTINCT post_content FROM ".$wpdb->prefix."posts WHERE ".$wpdb->prefix."posts.ID = '".$postID."' LIMIT 1";	
	$r = $wpdb->get_results($SQL, ARRAY_A);
	
	if(isset($r[0])){
	$content = $r[0]['post_content'];
	}else{
	$content = "";
	}
	

	// CHECK TO SEE IF THE CONTENT CONTAINS A VIDEO LINK AND USE THIS AS THE VIDEO
	preg_match_all('!http://[a-z0-9\-\.\/]+\.(?:jpe?g|flv)!Ui', $content, $matches);
	if(is_array($matches)){
		foreach($matches as $mm){	
			if(!isset($mm[0]) || ( isset($mm[0]) && $mm[0] == "") ){ continue; }
			$meida_array = array( array("class" => "", "src" => trim($mm[0]), "thumbnail" => str_replace(" ", "-",trim($mm[0])))); 
		}
	} 	
}
 


 
 
// CHECK IF THE LISTING CONTENT CONTAINS IMAGE GALLERIES
if ( ( empty($meida_array) || $type == "gallery" ) && isset($includeImages) && is_numeric($postID) ){
	
	// GET POST CONTENT
	$SQL = "SELECT DISTINCT post_content FROM ".$wpdb->prefix."posts WHERE ".$wpdb->prefix."posts.ID = '".$postID."' LIMIT 1";	
	$r = $wpdb->get_results($SQL, ARRAY_A);
	
	if(isset($r[0])){
	$content = $r[0]['post_content'];
	}else{
	$content = "";
	}
	
	if($content != "" &&
	(
	strpos($content,"gallery ids") != false || 
	strpos($content,"gallery column") != false || 
	strpos($content,"gallery link") != false 
	)
	){
	
 
 		 
		// GET THE ATTACHMENT IDS TO BUILD THE NEW GALLERY
		preg_match('/\[gallery.*ids=.(.*).\]/', get_the_content($postID), $ids);
		$wordpress_default_gallery_ids = explode(",", $ids[1]);
		
		// GET THE CURRENT WP UPLOAD DIR
		$uploads = wp_upload_dir(); 
		$user_attachments = array(); $i=0;
		foreach($wordpress_default_gallery_ids as $img_id){
			if(is_numeric($img_id)){			
				$f = wp_get_attachment_metadata($img_id);	 	
				if(isset($f['file'])){	
					$user_attachments[$i]['src'] 		= $uploads['baseurl']."/".$f['file'];			
					$user_attachments[$i]['thumbnail'] 	= $user_attachments[$i]['src']; //$uploads['url']."/".$f['sizes']['thumbnail']['file'];
					$user_attachments[$i]['name'] 		= $f['image_meta']['title'];
					$user_attachments[$i]['id'] 		= $img_id;
					$user_attachments[$i]['class'] 		= "";
					$user_attachments[$i]['type'] 		= "image/jpeg";
					$user_attachments[$i]['order'] 		= $i;
				}				 
				$i++;
			}
		}
		
		if(!empty($user_attachments)){
		$meida_array = array_merge($meida_array, $user_attachments);
		}
		
	} // end if post content
}



// CHECK FOR IMAGE CUSTOM FIELDS
if($type == "image" || $type == "images" || $type == "all" || $type == "gallery"){

	$custom_image = get_post_meta($postID,'image', true);
	if($custom_image != "" && get_post_meta($postID,'image_aid', true) == "" ){
	
		$upload_dir = wp_upload_dir();
		$custom_image = str_replace("wpdir-", $upload_dir['baseurl'].'/', $custom_image); 
		$custom_image = str_replace("childdir-", get_stylesheet_directory_uri().'/', $custom_image); 
			
		$meida_array[] = array(
			"class" => "wlt_thumbnail img-fluid", 
			"src" => trim($custom_image), 
			"thumbnail" => trim($custom_image),
			"order" => 0,
			"type" => "image/jpeg",
			"id" => 'none',
		 );
	}

}

// RETURN 1 IMAGE ONLY AND USE CALLBACK IF NON EXIST
if($type == "singleimage"){

	$src = ""; $thumb = "";
	if(empty($meida_array) || ( !isset($meida_array[0]['src']) && $meida_array[0]['src'] != "" ) ){
		$image = $this->_FALLBACK($postID);
		preg_match( '@src="([^"]+)"@' , $image , $match ); 
		$src 	= $match[1];
		$thumb 	=  $match[1];
	}else{	
		$src 	= $meida_array[0]['src'];
		$thumb 	= $meida_array[0]['thumbnail'];
		
	}
	
	return array("src" => $src, "thumbnail" => $thumb);
}


 


return $meida_array;

 
}
	
	
	
	
	
	
	
	
	
	
	
	
	
	 
	
	
	
	
	
	
	

function remove_thumbnail_dimensions( $html, $post_id, $post_image_id ) {
    $html = preg_replace( '/(width|height)=\"\d*\"\s/', "", $html );
    return $html;
}
 
	function meks_disable_srcset( $sources ) {
		return false;
	}
	
	
function _GETFEATUREDDATA($limit = "5"){ global $wpdb;

	$SQL = "SELECT ".$wpdb->posts.".* FROM ".$wpdb->posts."
				INNER JOIN ".$wpdb->postmeta." AS t1 ON ( t1.post_id = ".$wpdb->posts.".ID AND t1.meta_key = 'featured' AND t1.meta_value = 'yes')
				WHERE ".$wpdb->posts.".post_status= 'publish' AND ".$wpdb->posts.".post_type='listing_type'  ORDER BY RAND() LIMIT ".$limit;	
	 
	$images = array();
	$posts = $wpdb->get_results($SQL);	 
	foreach($posts as $post){ 
	$images[] = array('id' => $post->ID, 'post_title' => $post->post_title, 'post_content' => $post->post_content, 'images' => $this->media_get($post->ID,"images"), 'link' => get_permalink($post->ID)   );
	}
  
	return $images;	
		
}
	


/*
This function handles all images where no featured one is set

*/
function _FALLBACK($postID = 0){ global $post, $CORE; 
  
 
	$fallback_image = _ppt('fallback_image');	
	if($fallback_image == "" || strpos( strtolower($fallback_image), "undefined index") !== false){ 
	
		if(isset($GLOBALS['flag-single'])){
	 	$fallback_image = "https://via.placeholder.com/800x400.png?text=No%20Image&postid=".$postID; 
		}else{
		$fallback_image = "https://via.placeholder.com/1024x748.png?text=No%20Image&postid=".$postID;  
		}	
	}	 
	
	return hook_fallback_image_display($fallback_image);
 
}
	

 
	
/* ========================================================================
 UPLOAD OPTIONS
========================================================================== */

function UPLOAD_DELETE($id){
 
	// DATA IS STORED AS POSTid---ATTACHMENTID	
	$bits = explode("---",$id);
	
	// GET EXISTS MEDIA ARRAYS
	$get_type = array("image_array", "video_array", "doc_array", "music_array");			
	// LOOP ARRAYS TO GET ALL MEDIA DATA
	foreach($get_type as $type){		
		// GET THE MEDIA DATA FOR THIS ARRAY
		$data = get_post_meta($bits[0],$type,true);	 
		if(is_array($data)){
		// LOOP THROUGH, CHECK AND DELETE
			$new_array = array();			
			foreach($data as $media){
				if($media['id'] != $bits[1]){
					$new_array[] = $media;
				}else{
					$delsrc 	= $media['filepath'];
					$delthumbsrc = $media['thumbnail'];				
					
				}// end if
			}// end foreach	
			// UPDATE MEDIA FILE ARRAY
			update_post_meta($bits[0],$type,$new_array);	
		}// end if
	} // end foreach
	// LOOP THROUGH AND REMOVE THE ONE WE DONT WANT
	
	// DELETE FILE FROM WORDPRESS MEDIA LIBUARY
	if ( false === wp_delete_attachment($bits[1], true) ){	
		//die("could not delete file");
	} 
	
	// FALLBACK IF SYSTEM IS NOT DELETING IMAGES
	if(isset($delsrc) && strlen($delsrc) > 1 && file_exists($delsrc)){ @unlink($delsrc); } 
	if(isset($delthumbsrc) && strlen($delthumbsrc) > 1){ 	
		$ff = explode("/",$delsrc);
		$fg = explode($ff[count($ff)-1],$delsrc);
		$fd = explode("/",$delthumbsrc);
		$thumbspath = $fg[0].$fd[count($fd)-1]; 
		if(file_exists($thumbspath)){					
		@unlink($thumbspath);
		}
	} 

}

function UPLOAD_DELETEALL($postid){
 
	// GET EXISTS MEDIA ARRAYS
	$get_type = array("image_array", "video_array", "doc_array", "music_array");			
	// LOOP ARRAYS TO GET ALL MEDIA DATA
	foreach($get_type as $type){		
		// GET THE MEDIA DATA FOR THIS ARRAY
		$data = get_post_meta($postid,$type,true);	 
		
		if(is_array($data)){
		// LOOP THROUGH, CHECK AND DELETE		
			foreach($data as $media){
				if(isset($media['filepath'])){
					@unlink($media['filepath']);					
				}
			}// end foreach
		
			// EMPTY THE TYPE DATA
			update_post_meta($postid,$type,'');	
			
		}// end if
	} // end foreach
	// LOOP THROUGH AND REMOVE THE ONE WE DONT WANT
	
	// DELETE FILE FROM WORDPRESS MEDIA LIBUARY
	wp_delete_attachment($postid, true);
 

}
 

function UPLOADSPACELEFT($postID){ global $CORE, $userdata;

	// check for package id
	$packageID = get_post_meta($postID, "packageID", true);
	 
	if(is_numeric($packageID)){
	 
		return _ppt('pak'.$packageID.'_uploads');
		 
	}
	
	if(user_can($userdata->ID, 'administrator') ){
		return 100;
	}else{
		if(is_numeric(_ppt('default_listing_uploads'))){
		return _ppt('default_listing_uploads');
		}else{
		return 100;
		}	
	}
	
	
	
	

}

function UPLOADSPACE($postID){
	
	global $wpdb;

	// COUNT THE TOTAL UPLOADS FOR THIS LSITING
	$get_type = array("image_array", "video_array", "doc_array", "music_array"); $COUNT = 0;
	
	foreach($get_type as $type){
		$g = get_post_meta($postID,$type, true); 
		if(is_array($g) && !empty($g) ){	
		$COUNT += count($g);
		}
	}
	return round($COUNT,0);

}

function UPLOAD($data){
 
	if(!is_array($data)){ return $data; }

	//SPLIT THE DATA	
	$postID 	= $data[0];
	$file 		= $data[1];	
	$featured 	= $data[2];

	global $wpdb, $userdata; 
	
	// MAKE USER ID
	if(isset($userdata->data->ID) && is_numeric($userdata->data->ID)){
		$userID = $userdata->data->ID;
	}elseif(isset($userdata->ID) && is_numeric($userdata->ID)){
		$userID = $userdata->ID;
	}
	
	
	if($postID == 0){ // ASSUME WERE TRYING TO CREATE A NEW POST FOR THIS IMAGE
	
		/*
		CHECK IF USER HAS ADDED A LISTING WITHIN THE LAST 5 MINUTES
		THEN GRAN THAT ID
		*/
		
		$SQL = "SELECT ID FROM ".$wpdb->prefix."posts WHERE post_title = ('temp post') AND post_author = '".$userdata->ID."' LIMIT 1";						 
		$hasid = $wpdb->get_results($SQL, OBJECT);
		 
		if(!empty($hasid)){
		 			
		$postID = $hasid[0]->ID;
		
		}else{
		
		$my_post = array();
		$my_post['post_title'] 		= "temp post";
		$my_post['post_type'] 		= "listing_type";
		$my_post['post_content'] 	= ""; 			
		$postID = wp_insert_post( $my_post );
		
		}
	
		
	
	}else{
	
		// VERIFY THIS POST ID BELONGS TO THIS AUTHOR
		$verify_post = get_post($postID);
	 
		if(!isset($userID) || ( $verify_post->post_author != $userID && $userdata->roles[0] != "administrator" )){
			$e = array();
			return $e['error'] = "INVALID USER";
		}
	}
	

	
	// LOAD IN WORDPRESS FILE UPLOAOD CLASSES
	$dir_path = str_replace("wp-content","",WP_CONTENT_DIR);
	if(!function_exists('get_file_description')){
	if(!defined('ABSPATH')){
	require $dir_path . "/wp-load.php";
	}
	require $dir_path . "/wp-admin/includes/file.php";
	require $dir_path . "/wp-admin/includes/media.php";	
	}
	if(!function_exists('wp_generate_attachment_metadata') ){
	require $dir_path . "/wp-admin/includes/image.php";
	}
	// required for wp_handle_upload() to upload the file
	$upload_overrides = array( 'test_form' => FALSE );
 
	// load up a variable with the upload direcotry
	$uploads = wp_upload_dir();
  
	// create an array of the $_FILES for each file
	$file_array = array(
		'name' 		=> $file['name'],
		'type'		=> $file['type'],
		'tmp_name'	=> $file['tmp_name'],
		'error'		=> $file['error'],
		'size'		=> $file['size'],
	);
 	 
	// check to see if the file name is not empty
	if ( !empty( $file_array['name'] ) ) {
		
		 $wp_filetype = wp_check_filetype( basename( $file_array['name'] ), null ); 
		 
		// checks the file type and stores in in a variable
		if(in_array($file_array['type'], $this->allowed_image_types)){
		 
			$image_info = getimagesize($file_array["tmp_name"]);
	  	
			// MUST HAVE 150PX
			if($image_info[0] < 150 && $image_info[1] < 150){		
			return array("error" => __("Sorry, This image is too small. Please select a bigger image.","premiumpress"));			
			}
		}
  
  		// SETUP ALLOWED FILE TYPES	 
		$allowed_file_types = $this->allowed_image_types;	 
		$allowed_file_types = array_merge($allowed_file_types,$this->allowed_video_types);
		if(!in_array($file_array['type'], $allowed_file_types)) {
		
			return array("error" => __("Sorry, We do not accept this type of file."." (".$file_array['type'].") ","premiumpress"));
		}
		
		// die(print_r($allowed_file_types));
        // If the uploaded file is the right format
        if(in_array($file_array['type'], $allowed_file_types)) {
			  
			// upload the file to the server
			$uploaded_file = wp_handle_upload( $file_array, $upload_overrides );
	 	
			// CHECK FOR ERRORS
			if(isset($uploaded_file['error']) ){		
				return $uploaded_file;
			}
			
			// set up the array of arguments for "wp_insert_post();"
			$attachment = array(			 
				'post_mime_type' => $wp_filetype['type'],
				'post_title' => preg_replace('/\.[^.]+$/', '', basename( $file['name'] ) ),
				'post_content' => '',
				'post_author' => $userID,
				'post_status' => 'inherit',
				'post_type' => 'attachment',
				'post_parent' => $postID,
				'guid' => $uploaded_file['url']
			);	
			
			// INCLUDE UPLOAD SCRIPTS
			$dir_path = str_replace("wp-content","",WP_CONTENT_DIR);
			if(!function_exists('wp_handle_upload')){
			require $dir_path . "/wp-admin/includes/file.php";
			}
		
			// insert the attachment post type and get the ID
			$attachment_id = wp_insert_post( $attachment );
	
			// generate the attachment metadata
			$attach_data = wp_generate_attachment_metadata( $attachment_id, $uploaded_file['file'] );
		 	 
			// update the attachment metadata
			$rr = wp_update_attachment_metadata( $attachment_id,  $attach_data );
			
			// ADD IN MISSING DATABASE TABLE KEY	
			$thumbnail = "";
			if(!empty($attach_data)){	//<-- this is for image uploads			
		
				add_post_meta($attachment_id,'_wp_attached_file',$attach_data['file']);
				if(isset($attach_data['sizes']['thumbnail']['file'])){
					$thumbnail = $uploads['url']."/".$attach_data['sizes']['thumbnail']['file'];
				}else{
					$thumbnail = $uploads['url']."/".$file['name'];
				}
				
				// GET IMAGE DIMENTIONS AND DPI				
				$image_attributes = wp_get_attachment_image_src( $attachment_id , 'full' );				 
				if(isset($image_attributes[2])){				
					$dimentions = $image_attributes[1]."x".$image_attributes[2];
					$dpi = $this->_format_dpi(addslashes($uploaded_file['file']));
				} 
			
			
			}else{ //<-- this is for video uploads
			 
				$newmetadata = array(
					'filepath' 	=> addslashes($uploaded_file['file']),  
					'name' 		=> $file['name'], 
					'mime_type'	=> $file['type'], 
					'filesize' 	=> $file['size'], 
					'postID'	=> $postID,  
				);
				
				// CHECK IF IS A VIDEO FILE
				$vd = wp_read_video_metadata(addslashes($uploaded_file['file']));				
				if(is_array($vd) && !empty($vd)){				
					$newmetadata = array_merge($vd, $newmetadata);
				}
			 	
				// SAVE MEDTA DATA
				add_post_meta($attachment_id, '_wp_attachment_metadata', $newmetadata );
				
				// SAVE MISSING FILENAME
				add_post_meta($attachment_id, '_wp_attached_file',  addslashes($uploaded_file['file']) );
 				
			} 
		
				
			// BUILD ARRAY TO SAVE IMAGE INTO DATABASE
			// AS THE ATTACHMENT FOR THE POST
			if(!isset($dpi)){ $dpi = 0; }
			if(!isset($dimentions)){ $dimentions = 0; }
			$save_file_array = array(
				'name' 		=> $file['name'],
				'type'		=> $file['type'],
				'postID'	=> $postID,
				'size'		=> $file['size'],
				'src' 		=> $uploaded_file['url'],						
				'thumbnail' => str_replace(" ", "-",addslashes($thumbnail)),						
				'filepath' 	=> addslashes($uploaded_file['file']),
				'id'		=> $attachment_id,
				'default' 	=> $featured,
				'order'		=> 0,						
				'dimentions' => $dimentions,						
				'dpi' 		=> $dpi,						
			);	
				 
				// AUTO DETECT FILE TYPE AND ADD TO CORRECT ARRAY
				// WE NEED TO ADD NICER THUMBNAILS FOR NON-IMAGE TYPES (VIDEOS ETC)
				if(in_array($file['type'],$this->allowed_image_types)){ 

					$storage_key = "image_array";					
			
					// SET THE MEDIA TYPE
					if(THEME_KEY == "ph"){
						update_post_meta($postID,'media_type', 1);
						if($image_attributes[1] > $image_attributes[0]){
						update_post_meta($postID,'orientation', 1);	
						}else{
						update_post_meta($postID,'orientation', 2);	
						}
					}										
						
				}elseif(in_array($file['type'],$this->allowed_video_types)){
				
					$save_file_array["thumbnail"] = "https://via.placeholder.com/150x100.png?text=No+Preview";
				
					$storage_key = "video_array";	
				 	if(THEME_KEY == "ph"){
						update_post_meta($postID,'media_type', 2);
						update_post_meta($postID,'orientation', 2);	
					}			
				 	
					// BUILD IN SUPPORT FOR FFMEG AND THUMBNAIL CREATION
					if (exec('/usr/local/bin/ffmpeg -version') != 127){ 
					  
						$video = $uploaded_file['file'];
						$thumbnail  = "/".str_replace(".","_",str_replace(" ","",$file['name']))."_ffmpeg.jpg";														
					    $g = shell_exec('/usr/local/bin/ffmpeg -i "'.$video.'" -deinterlace -an -ss 4 -t 00:00:01 -r 1 -y -vcodec mjpeg -f mjpeg "'.$uploads['path'].$thumbnail.'" 2>&1'); 					 
					 	
						if (file_exists($uploads['path'].$thumbnail)) { 	
							$save_file_array["thumbnail"] =  $uploads['url'].$thumbnail; 
							
							
							// NOW SAVE AND ATTACH THIS IMAGE TO THE
							// WORDPRESS MEDIA SYSTEM FOR BETTER INTEGRATION 
							$wp_filetype = wp_check_filetype( $uploads['path'].$thumbnail, null );				
							// Set attachment data
							$at1 = array(
								'post_mime_type' => $wp_filetype['type'],
								'post_title'     => sanitize_file_name( $thumbnail ),
								'post_content'   => '',
								'post_status'    => 'inherit'
							);
							// Create the attachment
							$attach_id = wp_insert_attachment( $at1, $uploads['path'].$thumbnail, $postID );
							// Define attachment metadata
							$at2 = wp_generate_attachment_metadata( $attach_id, $uploads['path'].$thumbnail );
							// Assign metadata to attachment
							wp_update_attachment_metadata( $attach_id, $at2 );
							// And finally assign featured image to post
							set_post_thumbnail( $attachment_id, $attach_id );	// $attachment_id is from the first upload (above)
	 						
							
						}
					}
 					
				}elseif(in_array($file['type'],$this->allowed_music_types)){
					
					$storage_key = "music_array";	
					$save_file_array["thumbnail"] = "https://via.placeholder.com/650x600.png?text=PremiumPress+Themes";
												
				
				}elseif(in_array($file['type'],$this->allowed_doc_types)){
					
					$storage_key = "doc_array";		
					$save_file_array["thumbnail"] = "https://via.placeholder.com/650x600.png?text=PremiumPress+Themes";						
					
				}else{
					$storage_key = "image_array"; // fallback to image array
				} 
				
				
				
				// ADD TO MY IMAGE GALLERY ARRAY
				$my_existing_images = get_post_meta($postID,$storage_key, true);
				if(is_array($my_existing_images)){
					
					$new_array = array();
					$new_array[] = $save_file_array;
					foreach($my_existing_images as $img ){ $new_array[] = $img; }						
				}else{				
					$new_array = array();
					$new_array[] = $save_file_array;									
				}				 		
				// SAVE
				update_post_meta($postID,$storage_key,$new_array);	
				
				// CHECK FOR FEATURED
				if($featured && in_array($file_array['type'], $this->allowed_image_types) ){
				set_post_thumbnail($postID, $attachment_id);
				}
			
			
			// format responce
			$responce = array();
			$responce["name"] 				= $file_array['name'];
			$responce["size"] 				= $file['size'];
			$responce["type"] 				= $file_array['type'];
			if(!empty($attach_data)){
			$responce["url"] 				= $uploads['url']."/".$attach_data['sizes']['thumbnail']['file'];
			}else{
			$responce["url"] 				= "";
			}
			
			$responce["thumbnail_url"] 		= $save_file_array["thumbnail"];
			$responce["delete_url"] 		= $postID."---".$attachment_id; // CUSTOM FOR DELETION SCRIPT
			$responce["delete_type"] 		= "DELETE";
			$responce["aid"] 				= $attachment_id;
			$responce["pid"] 				= $postID;
			$responce["link"] 				= get_permalink($postID);			 
		 
			return hook_upload_return(array($responce));
			  
		}else{
		// print_r($file_array);
		return array("error" => __("Sorry, We do not accept this type of file.","premiumpress"));
		
		}
 
	} // end if		 

}

/*
	this function returns the file type
*/
function _format_type($type){

	$g = explode("/", $type); 
	return $g[1];

}


function _format_dpi($filename){

    $a = fopen($filename,'r');
    $string = fread($a,20);
    fclose($a);

    $data = bin2hex(substr($string,14,4));
    $x = substr($data,0,4);
    $y = substr($data,4,4);

    $ff = array(hexdec($x),hexdec($y));
	
	if($ff[0] < 72){
		return 72;
	}else{
		return $ff[1];
	}
}
 
function _format_bytes($a_bytes)
{
    if ($a_bytes < 1024) {
        return $a_bytes .' B';
    } elseif ($a_bytes < 1048576) {
        return round($a_bytes / 1024, 2) .' Kb';
    } elseif ($a_bytes < 1073741824) {
        return round($a_bytes / 1048576, 2) . ' Mb';
    } elseif ($a_bytes < 1099511627776) {
        return round($a_bytes / 1073741824, 2) . ' Gb';
    } elseif ($a_bytes < 1125899906842624) {
        return round($a_bytes / 1099511627776, 2) .' Tb';
    } elseif ($a_bytes < 1152921504606846976) {
        return round($a_bytes / 1125899906842624, 2) .' PiB';
    } elseif ($a_bytes < 1180591620717411303424) {
        return round($a_bytes / 1152921504606846976, 2) .' EiB';
    } elseif ($a_bytes < 1208925819614629174706176) {
        return round($a_bytes / 1180591620717411303424, 2) .' ZiB';
    } else {
        return round($a_bytes / 1208925819614629174706176, 2) .' YiB';
    }
}	
 
	
	
	
	
/* =============================================================================
IMAGE WATER MARK CODE
	========================================================================== */

	

function watermark_create(){

if(isset($_GET['ppt_wm']) && strlen($_GET['ppt_wm']) > 1){
 
	$uploads = wp_upload_dir(); 
 
	// process image
	$IMG = base64_decode(urldecode($_GET['ppt_wm']) );
	$IMG = str_replace("__","/",$IMG);
	
	if(file_exists($uploads['basedir'].$IMG)){
 	
		// image file
		$imagetobewatermark = $uploads['basedir'].$IMG;
		list ($width, $height) = getimagesize($imagetobewatermark);
		$res = imagecreatetruecolor($width, $height);
		
		$mark = imagecreatefromjpeg($imagetobewatermark);
		
		//$mark = imagecreatefrompng($imagetobewatermark);
		//make sure here to use the ressource, not the filepath
		imagecopy($res, $mark, 0, 0, 0, 0, $width, $height);
		 
		//font data
		$font = THEME_PATH.'/framework/fonts/watermark.ttf';
		$fontsize = "25";
		$watermarktext = _ppt('watermark_text');
		
		// setup box
		$bbox = imagettfbbox($fontsize, 0, $font, $watermarktext);
		$x = $bbox[0] + (imagesx($res)) - ($bbox[4] / 2) - 130;
		$y = $bbox[1] + (imagesy($res)) - ($bbox[5] / 2) - 30;
		
		//make sure here to use the ressource, not the filepath
		$white_75  = imagecolorallocatealpha($res, 255, 255, 255, 96);
	 
		//make sure here to use the ressource, not the filepath
		imagettftext($res, $fontsize, 0, $x, $y, $white_75, $font, $watermarktext);
		
		header("Content-type:image/jpeg");
		//make sure here to use the ressource, not the filepath
		imagepng($res);
		//make sure here to use the ressource, not the filepath
		imagedestroy($res);
		die();
	
	}else{
	
	return $uploads['baseurl'].$IMG;
	
	}
}
}

function watermark($image){

if(_ppt('watermark') != 1){ return $image; }
 
// RETURN IF IS LINKED IMAGE
if( strpos($image, "upload") === false){
return $image;
}

// setup
$canContinue = false;

// GET UPLOADS DIR
$uploads = wp_upload_dir();

// CHECK IMG TAG
preg_match_all('/<img[^>]*src=\"([^\"]+)\"/i',$image, $result); 
if(isset($result[1][0])){
	
	$canContinue = true;
	$path = $result[1][0];

}elseif(in_array(substr($image,-4), array(".jpg",".png","jpeg")) ){

	$canContinue = true;
	$path = $image;
	
}


if($canContinue){

	$ext = substr($path,-4);

	if(in_array($ext, array(".jpg",".png","jpeg")) ){
	
		$imgdata = str_replace($uploads['baseurl'], "", $path);
		$imgdata = str_replace("/","__", $imgdata); 
		
		$image = str_replace($path, home_url()."/index.php?ppt_wm=".base64_encode(urlencode($imgdata) ), $image);
		 
	}
}
 
 
return $image;

}	
	
	
	
	
function reArrayFiles(&$file_post) {

    $file_ary = array();
    $file_count = count($file_post['name']);
    $file_keys = array_keys($file_post);

    for ($i=0; $i<$file_count; $i++) {
        foreach ($file_keys as $key) {
            $file_ary[$i][$key] = $file_post[$key][$i];
        }
    }

    return $file_ary;
}	
	
	
	
	
/* =============================================================================
	GET IMAGE STANDARD
	========================================================================== */

function FALLBACK_IMAGE($postid){ global $MEDIA;

	return $this->_FALLBACK($postid);
	
}
function GETIMAGE($postID, $link=true, $atrs = array()){ global $wpdb, $post, $CORE; if(!is_numeric($postID)){ return; } $image = "";
 
// CHECK IF WE HAVE A THUMBNAIL
if ( has_post_thumbnail($postID) ) { 					
	if(isset($GLOBALS['flag-single'])){ 
	$image .= hook_image_display(get_the_post_thumbnail($postID, 'full', array('class'=> "wlt_thumbnail")));
	}else{
	if($link){	$permalink = get_permalink($postID); $image .= '<a href="'.$permalink.'" class="frame">'; }
	$image .= hook_image_display(get_the_post_thumbnail($postID, array(183,110), array('class'=> "wlt_thumbnail")));	 	
	if($link){ $image .= '<div class="clearfix"></div></a>'; }	
	} 
// CHECK FOR FALLBACK IMAGE				
}else{
	 
	$fimage = $this->FALLBACK_IMAGE($postID); 
 
	if($fimage != ""){ 
		 
			if($link){ $permalink = get_permalink($postID); $image .= '<a  href="'.$permalink.'" class="frame">'; }
			$image .= $fimage; 
			if($link){ $image .= '<div class="clearfix"></div></a>'; }
		 
	}
}
if(isset($atrs['pathonly'])){ 
$array = array();
preg_match( '/src="([^"]*)"/i', $image, $array ) ;
	if(isset($array[1])){
	return $array[1];
	}else{
	return "";
	}
}
return preg_replace('/\\<(.*?)(width="(.*?)")(.*?)(height="(.*?)")(.*?)\\>/i', '<$1$4$7>', $image);
}

 

	
	 
	
}

?>