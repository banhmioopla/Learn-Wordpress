<?php
/*

LIST OF SHORTCODES
1. TITLE
2. EXCERPT
3. CONTENT
4. TAGS
5. IMAGE (SINGLE)
6. IMAGES 
7. VIDEO (SINGLE)
8. VIDEOS 
9. CATEGORY
10. CATEGORYICON
11. CUSTOM FIELD

*/

class premiumpress_elementor_shortcode {

	private static $_instance = null;
 
	private static $elementor_frontend;

	public static function instance() {

		if ( is_null( self::$_instance ) ) {
			self::$_instance = new self();
		}
		return self::$_instance;

	}
	public function __construct() {
 
		if ( defined( 'ELEMENTOR_VERSION' ) ) {
			self::$elementor_frontend = new \Elementor\Frontend();

			add_shortcode( 'premiumpress_elementor_template', array( $this, 'elemenntor_add_template' ) );
		}
	}
	public function elemenntor_add_template( $atts ) {
		$atts = shortcode_atts( array(
	        'id' => '',
	    ), $atts, 'elementor_add_template' );

	    if ( $atts['id'] !== '' ) {
	    	return self::$elementor_frontend->get_builder_content_for_display( $atts['id'] );
	    }
	}
}
premiumpress_elementor_shortcode::instance();

class framework_shortcodes extends framework_search {

/* =============================================================================
	[URL] - SHORTCODE
	========================================================================== */
function pptv9_shortcode_url($atts, $content = null){ global $wpdb,  $wp_query, $CORE, $post;  
		
	return home_url()."/";		
}
/* =============================================================================
	[ID] - SHORTCODE
	========================================================================== */
function pptv9_shortcode_postid($atts, $content = null){ global $wpdb,  $wp_query, $CORE, $post;  
	 	
	return $post->ID;		
}
	/* =============================================================================
		[TITLE] - SHORTCODE
		========================================================================== */
function pptv9_shortcode_title( $atts = "", $content = null ) { global $userdata, $CORE, $post; 
 	
	   	extract( shortcode_atts( array(  "link" => false  ), $atts ) );
	 
	 	// elementor preview
		if( 
		( isset($_REQUEST['action']) && !in_array($_REQUEST['action'], array("contactform", "sendgift", "invitechat")) )
		
		|| isset($_REQUEST['preview_id']) || isset($_REQUEST['elementor_library']) ){
	 
		return "This is an example listing title.";
		
		}
		
		 
 
		if($CORE->_language_current(1) != "en_us"){
			
			$title = get_post_meta($post->ID,'post_title_'.$CORE->_language_current(1), true);
		
			if($title != ""){ $rTitle =  $title; }		
			$rTitle = $post->post_title;		
		
		}else{
			if(isset($post->post_title)){
			$rTitle = $post->post_title;
			}else{
			$rTitle = "";
			}
		} 
		
		
		if($link){
		return "<a href='".get_permalink($post->ID)."'>".$rTitle."</a>";
		}
		
		return $rTitle;
}
/* =============================================================================
	 
	========================================================================== */


function pptv9_shortcode_excerpt($atts, $content = null){ global $wpdb, $wp_query, $CORE, $post;  
	
		extract( shortcode_atts( array( 'size' => 200, 'readmore' => true, 'end' => '',  'text_after' => '', 'striptags' => false ), $atts ) );
		
		$rd = "";
	 
		// elementor preview
				if( 
		( isset($_REQUEST['action']) && !in_array($_REQUEST['action'], array("contactform", "sendgift", "invitechat")) )
		
		|| isset($_REQUEST['preview_id']) || isset($_REQUEST['elementor_library']) ){
		
		$content = 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut elit tellus, luctus nec ullamcorper mattis, pulvinar dapibus leo. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut elit tellus, luctus nec ullamcorper mattis, pulvinar dapibus leo.Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut elit tellus, luctus nec ullamcorper mattis, pulvinar dapibus leo.';
		
		}else{
	 
			// GET CONTENT		
			if(strlen($post->post_excerpt) < 5 ){ 
				$content = $post->post_content; 
			}else{			
				$content = $post->post_excerpt;
			}	
			 
			// CLEAN
			$content = preg_replace( "/\r|\n/", "",strip_tags(substr(preg_replace('/\[gallery[^>]+\]/i', "", $content), 0, $size)));	  
			 
			// ADD ON DASHES 
			if(strlen($content) > $size){	
					$rd = "...";					
			}else{			
					$rd = "";			
			}
		
	}
		 
		return "<span class='wlt_shortcode_excerpt' ".$CORE->ITEMSCOPE("itemprop","description").">".$content.$rd.$end.$text_after."</span>";			
		 
			
}
/* =============================================================================
	 
	========================================================================== */


function pptv9_shortcode_content($atts, $content = null){ global $wpdb, $wp_query, $CORE, $post; $STRING = "";  
	
		extract( shortcode_atts( array( 'size' => 0 ), $atts ) );
		
		// elementor preview
				if( 
		( isset($_REQUEST['action']) && !in_array($_REQUEST['action'], array("contactform", "sendgift", "invitechat")) )
		
		|| isset($_REQUEST['preview_id']) || isset($_REQUEST['elementor_library']) ){
		
		$content = '<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut elit tellus, luctus nec ullamcorper mattis, pulvinar dapibus leo. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut elit tellus, luctus nec ullamcorper mattis, pulvinar dapibus leo.Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut elit tellus, luctus nec ullamcorper mattis, pulvinar dapibus leo.</p><p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut elit tellus, luctus nec ullamcorper mattis, pulvinar dapibus leo.</p><p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut elit tellus, luctus nec ullamcorper mattis, pulvinar dapibus leo.</p><p>Ut elit tellus, luctus nec ullamcorper mattis, pulvinar dapibus leo.  luctus nec ullamcorper mattis, pulvinar dapibus leo. Ut elit tellus, luctus nec ullamcorper mattis, pulvinar dapibus leo.</p>';
		
		}else{

		if($CORE->_language_current(1) != "en_us"){		
		
			$content = get_post_meta($post->ID, 'post_content_'.$CORE->_language_current(1), true);
			if($content == ""){
				$content = apply_filters( 'the_content', $post->post_content );
				$content = str_replace( ']]>', ']]&gt;', $content );
			}			
			
		}else{			 
			$content = apply_filters( 'the_content', $post->post_content );
			$content = str_replace( ']]>', ']]&gt;', $content );			 
		}		
		 
		 
		
	  } // end elementor	 
		if($size > 0){ 
			ob_start();
			?> 
            <div class="post_content_box"><?php echo $content; ?></div>
			<script>
				jQuery(document).ready(function() {
				 
				  jQuery('.post_content_box').expander({
					slicePoint: '<?php echo $size; ?>',   
					expandSpeed: 0,
					userCollapseText: '<?php echo __('read more','premiumpress'); ?>',
					expandText: '<?php echo __('read less','premiumpress'); ?>',
				  }); 
				 
				}); 
				</script>
		<?php
		return ob_get_clean(); 
		
		}else{
		
		return  wpautop($content);
		
		} 
	
	
		   
}


/* =============================================================================
		[TAGS] - SHORTCODE
		========================================================================== */
	function pptv9_shortcode_tags( $atts, $content = null ) {
	
		global $userdata, $CORE, $post, $shortcode_tags; $STRING = "";
		
		extract( shortcode_atts( array('text' => '', 'class' => 'my-3 mt-5'  ), $atts ) );
	
		// elementor preview
		if( ( isset($_REQUEST['action']) && !in_array($_REQUEST['action'], array("contactform", "sendgift", "invitechat")) )
		
		|| isset($_REQUEST['preview_id']) || isset($_REQUEST['elementor_library']) ){
		$STRING .= "<div class='pptv9_tags btn-group  ".$class."'>";
		$STRING .= "<a href='#' rel='tag' class='btn btn-sm btn btn-outline-dark border-0'>Tag 1</a>&nbsp;";
		$STRING .= "<a href='#' rel='tag' class='btn btn-sm btn btn-outline-dark border-0'>Tag 2</a>&nbsp;";
		$STRING .= "<a href='#' rel='tag' class='btn btn-sm btn btn-outline-dark border-0'>Tag 3</a>&nbsp;";
		$STRING .= "<a href='#' rel='tag' class='btn btn-sm btn btn-outline-dark border-0'>Tag 4</a>&nbsp;";
		$STRING .= "</div>";
		}else{	
		
			
			$t = wp_get_post_tags($post->ID);
		
			if(is_array($t) && !empty($t) ){
				$STRING .= "<div class='pptv9_tags btn-group ".$class."'>";
				foreach($t as $tag){				  
					$STRING .= "<a href='".get_term_link($tag->term_id, $tag->taxonomy)."' rel='tag' class='btn btn-sm btn btn-outline-dark'>".esc_attr($text)."".$tag->name."</a>&nbsp;";
				}
				$STRING .= "</div>";
			}
		}
		
		// RETURN
		return $STRING;
	}



/* =============================================================================
		[IMAGE] - SHORTCODE
	========================================================================== */
		 
	function pptv9_shortcode_image( $atts, $content = null ) {
	  
		global $userdata, $CORE,   $post;  $image = ""; $sd = ""; $linkextra = ""; if(!isset($GLOBALS['imagecount'])){ $GLOBALS['imagecount'] = 1; }else{ $GLOBALS['imagecount']++; }
		
		extract( shortcode_atts( array(
		
		'pid' => '', 
		"pathonly" => false,
		'aclass' => 'wlt_image_link',
		'link' => 1, 	 
		"class" => "wlt_image img-fluid", 
 		'limit' => 100,
		'size' => 'thumbnail',
		'showdata' => false,
		), $atts ) );
		
		
		// GET THE POST ID
		if(isset($post->ID) && $pid == "" ){
			$pid = $post->ID;
		}
		
		
		$data = $this->media_get($pid,"images");
	 
		$name = "";
		if(isset($data[0]['name'])){
		$name = $data[0]['name'];
		}
		
		// FALLBACK
		if(isset($data[0]['thumbnail']) && $data[0]['thumbnail'] == ""){
		$data[0]['thumbnail'] = $data[0]['src'];
		}
		
		
		if(isset($data[0]) && $size == "thumbnail"){
	 	
			// GET IMAGE DIMENTIONS
			if($showdata){
			list($width, $height, $type, $attr) = @getimagesize($data[0]['thumbnail']);
			$sd = ' data-width="'.$width.'" data-height="'.$height.'"';
	 		}
			
			$image = '<img src="'.$data[0]['thumbnail'].'" alt="'.$name.'" data-src="'.$data[0]['thumbnail'].'" class="'.$class.'" '.$sd.'>';
			
		}elseif(isset($data[0])){
			
			// GET IMAGE DIMENTIONS
			if($showdata){
			list($width, $height, $type, $attr) = @getimagesize($data[0]['thumbnail']);
			$sd = ' data-width="'.$width.'" data-height="'.$height.'"';
	 		}
			
			$image = '<img data-src="'.$data[0]['src'].'" alt="'.$name.'" data-src="'.$data[0]['thumbnail'].'" class="lazy '.$class.'" '.$sd.'>';
		
		}else{
				
			$data = $this->media_get($pid,"video");
			if(isset($data[0])){			
			
				$image = '<img data-src="'.$data[0]['thumbnail'].'" alt="'.$name.'" data-src="'.$data[0]['thumbnail'].'" class="lazy '.$class.'" '.$sd.'>';
			
			}else{
			
			$image = '<img data-src="'.$this->_FALLBACK($pid).'" alt="no image" data-src="'.$this->_FALLBACK($pid).'" class="lazy '.$class.'">';
			
			} 
			
		}
		
		if($link){
			$permalink = get_permalink($pid); 
			$image = '<a href="'.$permalink.'" class="'.$aclass.''.$linkextra.'">'.$image.'</a>';
		}
		
		if($pathonly){		
			preg_match( '@src="([^"]+)"@' , $image , $match );
			if(isset($match[1]) && !empty($match[1]) && substr($match[1],0 , 4) == "http"){
				return $match[1];
			}
			
			preg_match( "@src='([^']+)'@" , $img , $match );
			if(isset($match[1]) && !empty($match[1]) && substr($match[1],0 , 4) == "http"){
				return $match[1];
			}
		}
		
		return $image;
		
		
	}


/* =============================================================================
		[IMAGES] - SHORTCODE
	========================================================================== */

function pptv9_shortcode_images($atts, $content = null){  global $userdata, $CORE, $settings, $post;

		// EXTRACT OPTIONS
		extract( shortcode_atts( array( 'postid' => '', 'limit' => 100, 'style' => 1), $atts ) );
 		
		// FIX FOR PRINT PAGE IMAGES
		if($postid != ""){ $pid = $postid; }else{ $pid = $post->ID; }
		
		// 1. GET MEDIA
		if( ( isset($_REQUEST['action']) && !in_array($_REQUEST['action'], array("contactform", "sendgift", "invitechat")) )
		
		|| isset($_REQUEST['preview_id']) || isset($_REQUEST['elementor_library']) ){
			$i = 1;
			while($i < 10){
			$files[$i] = array(
			"name" => "Example Image",
			"thumbnail" => FRAMREWORK_URI.'elementor/img/item-'.$i.'.png',
			"src" => FRAMREWORK_URI.'elementor/img/item-'.$i.'.png',
			"ID" => 1,
			);
			$i++; }
		
		}else{
		$files = $this->media_get($pid, "images"); 
	 	if(!is_array($files)){ $files = array(); }
		}
		
		// LOAD GALLERY
		$settings['images'] = $files;
		
		// GET FILE
		get_template_part('framework/elementor/shortcodes/images-'.$style);		
}
/* =============================================================================
		[GALLERY] - SHORTCODE
	========================================================================== */

function pptv9_shortcode_gallery($atts, $content = null){  global $userdata, $CORE, $settings, $post;

		// EXTRACT OPTIONS
		extract( shortcode_atts( array( 'postid' => '', 'limit' => 100, 'style' => 1), $atts ) );
 		
		// FIX FOR PRINT PAGE IMAGES
		if($postid != ""){ $pid = $postid; }else{ $pid = $post->ID; }
		
		// 1. GET MEDIA
		if( ( isset($_REQUEST['action']) && !in_array($_REQUEST['action'], array("contactform", "sendgift", "invitechat")) )
		
		|| isset($_REQUEST['preview_id']) || isset($_REQUEST['elementor_library']) ){
			$i = 1;
			while($i < 10){
			$files[$i] = array(
			"name" => "Example Image",
			"thumbnail" => FRAMREWORK_URI.'elementor/img/item-'.$i.'.png',
			"src" => FRAMREWORK_URI.'elementor/img/item-'.$i.'.png',
			"ID" => 1,
			);
			$i++; }
		
		}else{
		$files = $this->media_get($pid, "images"); 
	 	if(!is_array($files)){ $files = array(); }
		}
		
		// LOAD GALLERY
		$settings['images'] = $files;
		
		// GET FILE
		get_template_part('framework/elementor/shortcodes/image-gallery');		
}



/* =============================================================================
		[VIDEOS] - SHORTCODE
	========================================================================== */

function pptv9_shortcode_videos($atts, $content = null){  global $userdata, $CORE, $settings, $post;

		// EXTRACT OPTIONS
		extract( shortcode_atts( array( 'postid' => '', 'limit' => 100, 'style' => 1), $atts ) );
 		
		// FIX FOR PRINT PAGE IMAGES
		if($postid != ""){ $pid = $postid; }else{ $pid = $post->ID; }
		
		// 1. GET MEDIA
		if( ( isset($_REQUEST['action']) && !in_array($_REQUEST['action'], array("contactform", "sendgift", "invitechat")) )
		
		|| isset($_REQUEST['preview_id']) || isset($_REQUEST['elementor_library']) ){
			$i = 1;
			while($i < 10){
			$files[$i] = array(
			"name" => "Example Video",
			"thumbnail" => FRAMREWORK_URI.'elementor/img/item-'.$i.'.png',
			"src" => FRAMREWORK_URI.'elementor/img/item-'.$i.'.png',
			"ID" => 1,
			);
			$i++; }
		
		}else{
		$files = $this->media_get($pid, "video"); 
	 	if(!is_array($files)){ $files = array(); }
		}
		 
		// LOAD GALLERY
		$settings['videos'] = $files;
		
		// GET FILE
		get_template_part('framework/elementor/shortcodes/videos-'.$style);		
}

/* =============================================================================
	 [VIDEO] - SHORTCODE
	========================================================================== */

	// YOUTUBE AND VIDEO DISPLAY
	function pptv9_shortcode_video($atts, $content = null){ global $post;
	
		// EXTRACT OPTIONS
		extract( shortcode_atts( array('height' => '640', 'width' => '1100', 'post_id' => $post->ID, 'image' => "", "autoplay" => 0), $atts ) );
 		
		if( ( isset($_REQUEST['action']) && !in_array($_REQUEST['action'], array("contactform", "sendgift", "invitechat")) )
		
		|| isset($_REQUEST['preview_id']) || isset($_REQUEST['elementor_library']) ){
		
			$videlink = "https://www.youtube.com/watch?v=-az0qZtuL_A";
			$image = "https://www.premiumpress.com/wp-content/themes/PREMIUMPRESS3/template/web2019/img/image-youtube.png";
		
		}else{
		 	 
			// CHECK YOUTUBE FIRST		 	
			$videlink = get_post_meta($post_id,'videolink',true);		
			// CHECK FOR YOUTUBE LINK
			if($videlink == ""){
				$videlink = get_post_meta($post_id,'Youtube_link',true);
				if(strlen($videlink) < 15){ 
				$videlink = ""; 
				
				}
			}		
			if($videlink == ""){
			$videid = get_post_meta($post_id,'youtube_id',true);
			if($videid != ""){			
				$videlink = "https://www.youtube.com/watch?v=".$videid;	
			}
			
			// NOW CHECK NON-YOUTUBE
			if($videlink == ""){
									
				$files = $this->media_get($post_id, "all"); 
				   	 
	 			if(!is_array($files)){ $files = array(); }	
			
				if(isset($files[0]['src']) && in_array($files[0]['type'], $this->allowed_video_types)  ){
				
					$ff = wp_get_attachment_url( $files[0]['id'] );
					  				 
						$videlink 	= $ff;
						$image 		= $files[0]['thumbnail'];
					 
				}	
						
			}
			
			
			// GIVE UP!
			if($videlink == ""){			
				return "";
			}		
			
		}
		}
		
	
	$CONTENT = "";
	if(strlen($videlink) > 1){
		// BUILD COMMENT BLOCK
		ob_start();
		try {
		
		if(THEME_KEY == 'vt'){		
		$autos = "on";
		}else{		
		$autos = "off";
		}
		 
		?><div id="videoplayer">
		<?php  echo do_shortcode('[video src="'.$videlink.'"  autoplay="'.$autoplay.'"  width="'.$width.'" height="'.$height.'" poster="'.$image.'" autoplay='.$autos.'][/video]'); ?>    
		</div><?php
		
		}catch (Exception $e) {
			ob_end_clean();
			throw $e;
		}  
		$CONTENT  = ob_get_clean();	
	}
	return $CONTENT;
	}


/* =============================================================================
	 
	========================================================================== */


function pptv9_shortcode_cats( $atts, $content = null ){ global $post, $CORE;
	
	extract( shortcode_atts( array( 'limit' => 1, 'pid' => '', 'type' => THEME_TAXONOMY, 'link' => 1, 'class' => '' ), $atts ) );	
		
	// elementor preview
	if( ( isset($_REQUEST['action']) && !in_array($_REQUEST['action'], array("contactform", "sendgift", "invitechat")) )
		
		|| isset($_REQUEST['preview_id']) || isset($_REQUEST['elementor_library']) ){	
		$string = "<a href='#' class='".$class."'>Example Category</a>";		
	}else{
 	 
	if($pid != "" && is_numeric($pid)){
	$POSTID = $pid;
	}else{
		if(isset($post->ID)){
		$POSTID = $post->ID;
		}else{
		$POSTID = 0;
		}
	}
 
 	$string = ""; $lc = 0;
	
	$categories = get_the_terms( $POSTID, $type, "", ', ', '' );
 
	if(is_array($categories)){
	foreach($categories as $cat){
	 
		// CHECK FOR CATEGORY TRANSLATIONS
		$catTrans = _ppt('category_translation');		
		$lang = $CORE->_language_current(1);
		
		// DEFAULT 
		$cat_name = $cat->name;
		
		// CHECK FOR TRANSLATION
		if($catTrans != "" && $lang != "en_us"){ 
		 
			if(isset($catTrans[$lang]) && isset($catTrans[$lang][$cat->term_id]) ){			
				$cat_name = $catTrans[$lang][$cat->term_id];			
			}
				
		} 
		
		if($lc == $limit){ continue; }	
		$lc++;
		
		if($link == 1){
		$string .= "<a href='".get_term_link($cat->term_id)."' class='".$class."'>".$cat_name."</a>";
		}else{
		$string .= $cat_name;
		}
		
		if($limit > 1){
		$string .= ", ";
		}
			
	
	}
	}
	
	}
  
	if($limit > 1){
	return substr($string,0,-2);
	}else{
	return $string;
	}
	
		 
	}
	/* =============================================================================
		[CATEGORYICON] - SHORTCODE
		========================================================================== */

	function pptv9_shortcode_categoryicon($atts, $content = null){ global $post;
	
		extract( shortcode_atts( array('icon' => "fa-tag", "class" => "",  "tooltip" => 1), $atts ) );
	
		$terms = wp_get_post_terms( $post->ID, "listing" );
		
		 
		if(isset($terms[0]->term_id) && isset($GLOBALS['CORE_THEME']['category_icon_small_'.$terms[0]->term_id]) && $GLOBALS['CORE_THEME']['category_icon_small_'.$terms[0]->term_id] != ""){
		
			$icon =  $GLOBALS['CORE_THEME']['category_icon_small_'.$terms[0]->term_id];
			
			$term_link = get_term_link( $terms[0] );
			
			$toolcode = "";
			if($tooltip == 1){			
				$toolcode = 'data-toggle="tooltip" data-placement="top" title="'.$terms[0]->name.'"';
				$class .= " wlt_tooltip ";			
			}
			
			return "<a href='".$term_link."' class='wlt_shortcode_categoryicon ".$class."' ".$toolcode."><i class='fa ".$icon."'></i></a>";
			
		
		}
	
	}
	/* =============================================================================
		[CATEGORYIMAGE] - SHORTCODE
		========================================================================== */

 function pptv9_shortcode_categoryimage( $atts = "", $content = null ) { global $userdata, $CORE, $wpdb, $post; $img = "";  
 	
	   	extract( shortcode_atts( array(  'term_id' => '', 'tax' => 'listing', 'pathonly' => 0, 'link' => 0), $atts ) );
		
		// TERMS
		$terms = get_term_by('term_id', $term_id, $tax);
		
		if(empty($terms)){
			$term_list = wp_get_post_terms( $post->ID, $tax, array( 'fields' => 'ids' ) );
			
			if(isset($term_list[0])){
			 
			$terms = get_term_by('term_id', $term_list[0], $tax);
			
			} 
		}

		
		 
			if(isset($terms)){			 
		 		
				// GET BIG IMAGE
		 		if( strlen(_ppt('storeimage_'.$terms->term_id)) > 1 ){
				
					$merchant_logo = _ppt('storeimage_'.$terms->term_id);
					
					$l = get_term_link($terms, 'store');
					
					$img = "<a href='".$l."'><img src='".str_replace("&","&amp;",$merchant_logo)."' alt='".$terms->slug."' class='img-fluid' /></a>";
		
				}elseif( strlen(_ppt('category_image_'.$terms->term_id)) > 1 ){
				
					$merchant_logo = _ppt('category_image_'.$terms->term_id);
					
					$l = get_term_link($terms, 'store');
					
					$img = "<a href='".$l."'><img src='".str_replace("&","&amp;",$merchant_logo)."' alt='".$terms->slug."' class='img-fluid' /></a>";
		
				}elseif(isset($terms->term_id) && _ppt('category_icon_'.$terms->term_id) != ""){
					
					$img = "<img src='"._ppt('category_icon_'.$terms->term_id)."' alt='".$terms->slug."' class='img-fluid' />";
				
				}
				  
			
				if(strlen($img) > 1){	
			 
					if($pathonly){		
						preg_match( '@src="([^"]+)"@' , $img , $match );					 
						if(isset($match[1]) && !empty($match[1]) && substr($match[1],0 , 4) == "http"){
							return $match[1];
						}					
						preg_match( "@src='([^']+)'@" , $img , $match );					 
						if(isset($match[1]) && !empty($match[1]) && substr($match[1],0 , 4) == "http"){
							return $match[1];
						}					
					}
								
					if($link == 1){
						return $img;
					}else{
						return  preg_replace('/<a.*?(<img.*?>)<\/a>/', '$1', $img);
					}					
				}
				 
			
			}
			
	
}

	/* =============================================================================
		[COMMENTS] - SHORTCODE
		========================================================================== */
	function pptv9_shortcode_comments($atts, $content = null){ global $userdata, $CORE, $post; $STRING = "";  $comment_string = ""; 
	
		// EXTRACT OPTIONS
		extract( shortcode_atts( array( 'pid' => '', 'style' => 1), $atts ) );
		
		if(is_numeric($pid)){
		$post = get_post($pid);
		}
		
		$GLOBALS['comment-style'] = $style;
		
		if( ( isset($_REQUEST['action']) && !in_array($_REQUEST['action'], array("contactform", "sendgift", "invitechat")) )
		
		|| isset($_REQUEST['preview_id']) || isset($_REQUEST['elementor_library']) ){
		
			// GET FILE
			get_template_part('framework/elementor/shortcodes/comment-'.$GLOBALS['comment-style'],'example');	
		
		}else{		
		
			// CHECK IF WE'VE ENABLED COMMENTS
			if(_ppt('comments') == 0){ return; }
			
			if($post->post_status == "pending"){ return; }
			
			if($post->comment_status != "open"){ return; }
			   
			// BUILD COMMENT BLOCK
			ob_start();
				try {
				 
				comments_template();  // GET THE DEFAULT WORDPRESS TEMPLATE FOR COMMENTS
				
				}
				catch (Exception $e) {
					ob_end_clean();
					throw $e;
			}  
			$comment_form = ob_get_clean();
			$STRING = $comment_form;		 
			
			return $STRING;
		
		}
	}

	/* =============================================================================
		[CUSTOMFIELD] - SHORTCODE
		========================================================================== */
	function pptv9_shortcode_customfield($atts, $content = null){ global $wpdb,  $wp_query, $CORE, $post;  
	
		extract( shortcode_atts( array( 'field' => '', 'default' => '0' ), $atts ) );
		
		if( ( isset($_REQUEST['action']) && !in_array($_REQUEST['action'], array("contactform", "sendgift", "invitechat")) )
		
		|| isset($_REQUEST['preview_id']) || isset($_REQUEST['elementor_library']) ){
			$f = $field;
		}else{
		
			$f = get_post_meta($post->ID, $field, true);						
			if($f == ""){			
				return "";			
			}elseif(is_array($f)){
				$j = "";
				foreach($f as $g){
				if($g == "--"){ continue; }
				$j .= $g.", ";
				}
				$j = substr($j,0,-2);
				$f = $j;					
			}			
		} 

		return $f;	
	}

/* =============================================================================
	 
	========================================================================== */





function pptv9_shortcode_amenities( $atts = "", $content = null ) { global $userdata, $CORE, $wpdb, $post;   
 	
	extract( shortcode_atts( array(  'xxxxxxxx' => ''), $atts ) );
	
	if( ( isset($_REQUEST['action']) && !in_array($_REQUEST['action'], array("contactform", "sendgift", "invitechat")) )
		
		|| isset($_REQUEST['preview_id']) || isset($_REQUEST['elementor_library']) ){
	
		?>    
		<div class="amenities"><ul class="list-unstyled row">
				 <?php             
				$dtamenitites = get_option("dtamenitites"); 
				if(is_array($dtamenitites)){ $i=0; $setKeys = array(); $selectedcatlist = array();
				foreach($dtamenitites['name'] as $data){ ?>
			  
		 
				<li class="col-md-6"><?php echo $dtamenitites['name'][$i]; ?></li>
				 
				 
				<?php $i++;  }} ?>
				</ul>    
		</div>
		<?php
	}else{
		
		if(_ppt('amenities') == 0){ return; }
	 
		$uam = get_post_meta($post->ID, 'amenities', true);
		 
		if(is_array($uam)){
		?>    
		<div class="amenities"><ul class="list-unstyled row">
				 <?php             
				$dtamenitites = get_option("dtamenitites"); 
				if(is_array($dtamenitites)){ $i=0; $setKeys = array(); $selectedcatlist = array();
				foreach($dtamenitites['name'] as $data){ if($dtamenitites['name'][$i] != "" ){  ?>
			  
				<?php if(is_array($uam) && in_array($dtamenitites['key'][$i], $uam)){ ?>
				<li class="col-md-6"><?php echo $dtamenitites['name'][$i]; ?></li>
				<?php } ?>
				 
				<?php $i++; } }} ?>
				</ul>    
		</div>
		<?php
		}
	}
}

/* =============================================================================
	 
	========================================================================== */















 
	/* =============================================================================
	[MEMBERSHIP] - SHORTCODE
	========================================================================== */
	function wlt_membership_filter($atts, $content = null){  global $userdata, $CORE, $post;
		
		extract( shortcode_atts( array('show' => '' ), $atts ) );	
	
		// MAKE SURE ITS ENABLED	  
		if(_ppt('enable_memberships') != 1 || is_admin() ){ return $content; }
		
		$allowed_ids 		= explode(",",$atts['show']);
		$displaytext = _ppt('listingaccessmsg');		
		
		// IF EMPTY, RETURN CONTENT
		if(empty($allowed_ids)){
		return $content;
		}
		
		// IF NOT LOGGED IN AND IDS ARE SET - HIDE CONTENT
		if(!empty($allowed_ids) && !$userdata->ID){		
		return $displaytext;		
		}
		
		// GET MY MEMBERSHIP
		$cm = $CORE->get_subscription($userdata->ID);
		 
		// CAN VIEW CONTENT 	 
		if(isset($cm['key']) && is_array($allowed_ids)){	
			foreach($allowed_ids as $k){
		 		if(trim($k) == trim($cm['key'])){
				return $content;
				}
			} 
			return $displaytext;
		}else{
			return $displaytext;
		}	
	}

 
function ppt_shortcode_hits( $atts = "", $content = null ) { global $userdata, $CORE, $wpdb, $post; $STRING = "";  
 	
	   	extract( shortcode_atts( array(  'pid' => ''), $atts ) );
		
		if($pid != "" && is_numeric($pid)){
		$POSTID = $pid;
		}else{
		$POSTID = $post->ID;
		}
		
		$hits = get_post_meta($POSTID,'hits',true);
 
 		if($hits == ""){
		return 0;
		}else{
		return number_format($hits);
		}
	
}


function ppt_shortcode_mainmenu( $atts = "", $content = null ) { global $userdata, $CORE, $wpdb, $post; $STRING = "";  
 	
	   	extract( shortcode_atts( array(  'class' => 'nav sf-menu', 'cclass' => "", "topnav" => false, "footer" => false, "mobile" => false, "menu" => "", "items_wrap" => "", "style" => 0  ), $atts ) );
		 
		// CHECK FOR LANGUAGE SETUP		
		if($footer){
		$menu_name_default =  'footermenu_en_US';
		$menu_name = 'footermenu_'.$CORE->_language_current();
		}elseif($topnav){
		$menu_name_default =  'topmenu_en_US';
		$menu_name = 'topmenu_'.$CORE->_language_current();
		}else{
		$menu_name_default =  'mainmenu_en_US';
		$menu_name =  'mainmenu_'.$CORE->_language_current();
		}
		
		if($mobile){
		$menu_name_default =  'mobilemenu_en_US';
		$menu_name = 'mobilemenu_'.$CORE->_language_current();
		}
		
		if($menu != ""){
		$menu_name_default =  $menu.'_en_US';
		$menu_name = $menu.'_'.$CORE->_language_current();
		}
		 
	   
		// GET MENUS
		$locations = get_nav_menu_locations();
		
		// FALLBACK TO DEFAULT IF NO MENU ADDED
		if ( ( $locations ) && isset( $locations[ $menu_name ] ) && $locations[ $menu_name ] != 0 ) {		
		}else{
		$menu_name = 'mainmenu_en_US';		 
		}
		 
		// CHECK EXISTS AND THEN OUTPUT
        if ( ( $locations ) && isset( $locations[ $menu_name ] ) && $locations[ $menu_name ] != 0 ) {
	 
                
			$nav_menu = wp_get_nav_menu_object($locations[$menu_name]);
			
			if($style != 1){
				$args = array( 
				
						'container_class' 	=> $cclass,
						'theme_location' 	=> $menu_name,
						'menu' 				=> $nav_menu->term_id,
						'menu_class' 		=> $class,
						'fallback_cb'    	=> '',
						'echo'           	=> false,
						'walker' 			=> new Bootstrap_Walker(),
						 
												
				) ;
			}else{
				$args = array( 
						'container'=> false, 
						'menu_class'=> false,
						'theme_location' 	=> $menu_name,
						'menu' 				=> $nav_menu->term_id,				
						'fallback_cb'    	=> '',
						'echo'           	=> false,
						'walker' 			=> new Bootstrap_Walker1(),
						 
												
				) ;
			}
			
			if( $items_wrap != ""){
				$args['items_wrap'] = $items_wrap();
			 
			}
			
			if($mobile){
			unset($args['container_class']);
			$args['container'] = '';
			$args['walker'] = new Bootstrap_Walker_Mobile();	
			}
			 
			$STRING = wp_nav_menu( $args );  // end menu
			if($mobile){
			//$STRING = preg_replace(array(        '#^<ul[^>]*>#',        '#</ul>$#'    ), '', $STRING);	
			}

		
		}
		 	
	return $STRING;

}
 
	/* =============================================================================
		[RATING] - SHORTCODE
		========================================================================== */
	function wlt_shortcode_rating( $atts = "", $content = null ) {
	
		global $wpdb, $userdata, $CORE, $post, $shortcode_tags; $STRING = "";  $default_options = 'all';
	 	
		
		
		extract( shortcode_atts( 
		array('size' => '24', 
		'id' => '', 
		'style' =>'', 
		'results' => false,   
		'readonly' => false, 
		'class' => '', 
		'submit' => false, 
		'score' => 0,		
		'only_score' => 0,
		'only_votes' => 0		
		), $atts ) );
		$size = esc_attr($size);
		$id = esc_attr($id);

		$style = esc_attr($style);
		$results = esc_attr($results);
 
 		$readonly = esc_attr($readonly); 
 
		// GET THE ID OF THE STAR ITEM
		if(isset($id) && is_numeric($id) ){ 
			$thisID = $id;
		}elseif(isset($post->ID)){
			$thisID = $post->ID;
		}else{
			return;
		} 
 		
			
		// GET THE RATING DATA
		$ratingT = get_post_meta($thisID, 'starrating_total', true);
		if($ratingT == ""){ $ratingT =0; }
		$ratingV = get_post_meta($thisID, 'starrating_votes', true);
		if($ratingV == ""){ $ratingV = 0; }			
		$rating = get_post_meta($thisID, 'starrating', true);		 
 
		if($rating == ""){ $rating = "0"; } 
		
		// RETURN VOTES
		if($only_votes ==1){
		return $ratingT;
		}
		
		// RETURN SCORE
		if($only_score == 1 || $score == 1){
		return round($rating,1);
		}
		
		$readonly = "data-readonly";
		if($submit){			
			$readonly = "";
			$rating = 5;
		}
		
		$txt= "";
		if($results == 1){
		$txt = " <span class='resultbit' data-toggle='tooltip' data-placement='top' title='".round($rating,1)." ".__( 'stars with', 'premiumpress' )." ".$ratingV." ".__( 'votes', 'premiumpress' )."'>(".round($rating,1)."/5)</span>"; //".$ratingV."
		
		}
		
		
		$STRING .= '<input type="hidden" class="rating"  data-filled="fa fa-star rating-rated '.$class.'" data-empty="far fa-star '.$class.'"  '.$readonly.' value="'.$rating.'"/>'.$txt;	 
			 
		return $STRING;
		
	}
	
	
	
	/* =============================================================================
		[FIELDS] - SHORTCODE
		========================================================================== */	
	function wlt_shortcode_fields( $atts, $content = null ) {
	
		global $userdata, $CORE, $post; $STRING = ""; 
	
	   	extract( shortcode_atts( array( 'style' => '', 'postid' => '' ), $atts ) );
		 
  		  
		if(is_numeric($postid) && strlen($postid) > 0){ $THISPOSTID = $postid; }else{ $THISPOSTID = $post->ID; }
		
	  	
			// GET CATEGORY FOR THIS LISTING
			$incats = wp_get_post_terms( $THISPOSTID, "listing" );
			$incatsarray = array();
			if(is_array($incats)){
			foreach($incats as $cad){
			$incatsarray[$cad->term_id] = $cad->term_id;
			}
			}
			 	
			// GET FIELDS
			$regfields = get_option("cfields"); 
			
			// START COUNTER
			$i=0;
			
			// CHECK HAS VALUES
			if(is_array($regfields) && isset($regfields['dbkey']) ){ 
			
				// LOOP
				foreach($regfields['dbkey'] as $field){						 
						 
				// CHECK IF THIS IS A HIDDEN FIELD
				if(!isset($regfields['dbkey'][$i]) || (isset($regfields['dbkey'][$i]) && $regfields['dbkey'][$i] == "")  ){ $i++; continue; }					
				  
				// CHECK THIS FIELD IS FOR THIS CATEGORY				 
				$canShow = false;
				if(!empty($regfields['cat'][$i])){
					foreach($regfields['cat'][$i] as $fc){					 
						if(in_array($fc, $incatsarray)){						
							$canShow = true;
						}
					}				
				}
				 
				// SHOW ALL CATS
				if(!isset($regfields['cat'][$i][0]) || isset($regfields['cat'][$i][0]) && $regfields['cat'][$i][0] == ""){
				$canShow = true;
				}
								
				if(!$canShow){ $i++; continue; }		
					 
				// CHECK IF IS HEADLINE
				if($regfields['fieldtype'][$i] == "title"){ 						
						
						$STRING .="<div class='field-title py-3 my-4 text-uppercase h6 text-center bg-light'>".$regfields['name'][$i]."</div>";
						$i++; 
						continue;
				}
						  
					 		  
						// CHECK FOR YOUTUBE LINK
						if($regfields['dbkey'][$i] == "youtube"){
						
							$v_check = get_post_meta($THISPOSTID, $regfields['dbkey'][$i], true);	
							$yb = explode("v=",$v_check);
							 
							if(isset($yb[1])){
								$yf = explode("&",$yb[1]);					
								$STRING .= '<div class="youtubebox"><iframe width="480" height="360" src="//www.youtube.com/embed/'.$yf[0].'" frameborder="0" allowfullscreen></iframe></div>';
							}
							
							$i++; 
							continue;
						
						}elseif($regfields['fieldtype'][$i] == "taxonomy"){	
										
							$value = get_the_terms( $THISPOSTID, $regfields['taxonomy'][$i] );
						
						}else{
						
							$v_check = get_post_meta($THISPOSTID, $regfields['dbkey'][$i], true);						 
							// CHECK IF ITS BLANK
							if($v_check == ""){ $i++; continue; }
								
							// CHECK FOR EMAIL							
							if(!is_array($v_check) && strpos($v_check,"@") !== false){								
								$v_check = "<a href='mailto:".$v_check."' rel='nofollow' style='text-decoration:underline;'>".$v_check."</a>";								
							
							// IF LINKS MAKE OUTBOUND
							}elseif(!is_array($v_check) && substr($v_check,0,4) == "http"){	
									if(get_option('permalink_structure') == ""){
									$link = $v_check;								
									}else{
									//$link = get_home_url()."/out/".$THISPOSTID."/".$regfields['dbkey'][$i]."/";
									$link = $v_check;
									}
									$v_check = "<a href='".$link."' rel='nofollow' target='_blank' style='text-decoration:underline;'>".__("Visit link here","premiumpress")."</a>";													
							
							// CHECK BOX DISPLAY						 						
							}elseif(is_array($v_check)){
								$nstring = "";						 					 				 									
								foreach($v_check as $vk=>$vd){
									if(!is_array($vd) && $vd != "" && $vd != "--" && $vd !="Array"){
									 
									$nstring .= "".$vd.", ";
									}
								}
								$nstring = substr($nstring,0,-2);
								$v_check = $nstring;						
							}
							if($regfields['dbkey'][$i] == "price"){						 
							$v_check = hook_price($v_check);						
							}
							
							if($regfields['dbkey'][$i] == "phone" || $regfields['dbkey'][$i] == "phonenumber"){						 
							$v_check = "<a href='tel:".$v_check."'>".$v_check."</a>";						
							}
							
							if($regfields['fieldtype'][$i] == "textarea"){	
							$v_check = wpautop($v_check);
							}
							
							// INTEGRATION FOR COUPONS
							if( isset($GLOBALS['CORE_THEME']['coupon']['code_key']) && $GLOBALS['CORE_THEME']['coupon']['code_key'] == $regfields['dbkey'][$i]  ){
								$v_check = '[CBUTTON]';
							}
							if($regfields['dbkey'][$i] == "expires" || $regfields['dbkey'][$i] == "expiry_date"){						 
							$v_check = $this->date_timediff( $v_check );						
							}
							if($regfields['dbkey'][$i] == "start_date"){						 
							$v_check = $this->format_date( $v_check );						
							}
							
														
							$value = $v_check;
						}
						$values = "";
						 
						// DONT SHOW BLANK FIELDS
						if($value == ""){ $i++; continue; }
						
						if(is_array($value)){ 
						
							foreach($value as $val){			
								if(is_object($val)){
								$values .= " <a href='".get_term_link($val->slug, $regfields['taxonomy'][$i]). "'>".$val->name."</a>";
								}if(!is_array($val) && !is_object($val) && strlen($val) > 2){ $values .= " ".$val; 
								}elseif(is_array($val)){ 
									foreach($val as $val1){ 						 
										$values .= " ".$val1; 						 
									} // end foreach
								} // end if
							} // end foreach
						
						}else{ $values = $value; }	
							
							 
							if(!is_object($values)){ 
							
								// ADD ON DATE FORMAT
								if($regfields['fieldtype'][$i] == "date"){ $values = hook_date($values); }
								 
								 ob_start();
							?>
                            <?php if($regfields['name'][$i] != "" && strlen($regfields['name'][$i]) > 1){ ?>
									<div class="row mb-3 fieldrow fieldtype-<?php echo $regfields['fieldtype'][$i]; ?>">
                                        <div class="col-md-4">                                        
                                            <span class="title"><?php echo $regfields['name'][$i]; ?></span>                 
                                        </div>
                                        <div class="col-md-8">                                        
                                        	<span class="text"><?php echo $values; ?></span>                                        
                                        </div>                                     
                                    </div>
                             <?php } ?> 
                           <?php
						   
						   		$STRING .= ob_get_clean(); 
						   
							}
							
							// NEXT FIELD
							$i++;
						} 
		} 
 		
		if($STRING  == ""){ return; } 
		
		$STRING  = "<div class='wlt_shortcode_fields ".$style."'>". hook_shortcode_fields_show($STRING). "</div>";
		
		// RETURN CODE
		return do_shortcode($STRING); 
	  
	}
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	function wlt_shortcode_location($atts, $content = null){  global $userdata, $CORE, $post; $STRING = ""; 
		
		extract( shortcode_atts( array('info' => false, 'before_text' => '', 'after_text' => '' ), $atts ) );
 
		if(get_post_meta($post->ID,'map-location',true) != ""){	
		 
				
				if($info){
				
				
				$STRING 	= $before_text."<span class='wlt_shortcode_location'>".get_post_meta($post->ID,'map-location',true).' <i class="fa fa-info-circle wlt_pop_location_'.$post->ID.'" 
				style="cursor:pointer;"  
				rel="popover" 
				data-placement="top"
				data-original-title="'.__("Useful Links","premiumpress").'" 
				data-trigger="hover"></i>	
				</span>'.$after_text.'
				
				<div id="wlt_pop_location_'.$post->ID.'_content" style="display:none;">	
				<a href="https://www.google.com/maps/dir//'.str_replace(",","",str_replace(" ","+",get_post_meta($post->ID,'map-location',true))).'" target="_blank">'.__("Get Directions","premiumpress").'</a> | 	
				<a href="'.get_home_url().'/?s=&amp;zipcode='.str_replace(" ","%20",get_post_meta($post->ID,'map-zip',true)).'&amp;radius=50&amp;showmap=1&amp;orderby=distance&amp;order=desc">'.__("Listings Nearby","premiumpress").'</a> 
				</div>';	
				
				$STRING 	.= "<script>jQuery(document).ready(function(){
				
				jQuery('.wlt_pop_location_".$post->ID."').popover({ 
					html: true,
					trigger: 'manual',
					container: jQuery(this).attr('id'),
					placement: 'top',
					content: function () {
						return jQuery('#wlt_pop_location_".$post->ID."_content').html();
					}
				}).on('mouseover', function(){
				
			   
				}).on('mouseenter', function () {
					var _this = this;
					jQuery(this).popover('show');
					jQuery(this).siblings('.popover').on('mouseleave', function () {
						jQuery(_this).popover('hide');
					});
				}).on('mouseleave', function () {
					var _this = this;
					setTimeout(function () {
						if (!jQuery('.popover:hover').length) {
							jQuery(_this).popover('hide')
						}
					}, 100);
				});});</script>";
				
			}else{
			
			$STRING 	= $before_text. "<span class='wlt_shortcode_location'>".get_post_meta($post->ID,'map-location',true).'</span>'.$after_text;
			
			}	
		
		}	
		
		return $STRING;

	}
	
 	/* =============================================================================
	[FLAG] - SHORTCODE
	========================================================================== */
	function wlt_shortcode_flag(){ global $post; $STRING = "";
	
		$country = get_post_meta($post->ID,'map-country',true);
		if(isset($GLOBALS['core_country_list'][$country])){		  
			$STRING = '<span class="flag flag-'.strtolower($country).' wlt_locationflag"></span>';			
		} 
		
		return $STRING;
	
	}
	
 	/* =============================================================================
	[CITY] - SHORTCODE
	========================================================================== */
	function wlt_shortcode_city($atts, $content = null){  global $userdata, $CORE, $post; $STRING = ""; 
		
		extract( shortcode_atts( array('link' => ''  ), $atts ) );
		 
		$city = get_post_meta($post->ID,'map-city',true);
		
		if($link == 1){
		
		return '<a href="'.home_url().'/?s=&city='.get_post_meta($post->ID,'map-city', true).'">'.$city.'</a>';
		
		}
		 
		return $city;
		
	}
	
 	/* =============================================================================
	[COUNTRY] - SHORTCODE
	========================================================================== */
	function wlt_shortcode_country($atts, $content = null){  global $userdata, $CORE, $post; $STRING = ""; 
		
		extract( shortcode_atts( array('link' => ''  ), $atts ) );
		 
		$country = get_post_meta($post->ID,'map-country',true);
		if($country == ""){
		return __("Unknown","premiumpress");
		}
		if(isset($GLOBALS['core_country_list'][$country])){
			$STRING = __( $GLOBALS['core_country_list'][$country] , 'premiumpress' );
		}else{
			$STRING = $country;
		}
		
		if($link == 1){
		
		$STRING = "<a href='".home_url()."/?s=&country=".$country."'>".$STRING."</a>";		
		
		}
		
		return $STRING;
		
	}
	/* =============================================================================
		[FAVS] - SHORTCODE
		========================================================================== */
	function wlt_shortcode_favs( $atts, $content = null){ global $userdata, $CORE, $post; $STRING = ""; 
	
	// EXTRACT OPTIONS
	extract( shortcode_atts( array('icon' => 0, 'icon_class' => "fa-heart", 'icon_remove' => "fa-heart", 'class' => '', 'tooltip' => 0, 'span' => true, 'text' => __("Add Favorites","premiumpress"), 'text_remove' => __("Remove Favorites","premiumpress") ), $atts ) );
	
	 
		$GLOBALS['favi'] = $post->ID.rand(0,9000).round(microtime(true) * 1000);
		 
		
		if($tooltip == 1){
		$class .= " wlt_tooltip";
		}
 
 		// ONLY SHOW IF ENABLED
		//if($GLOBALS['CORE_THEME']['show_account_favs'] == '1'){ } 
		
				$show_add = true;
				$ThisLink = site_url('wp-login.php?action=login&redirect_to='.get_permalink($post->ID), 'login_post');
				//*** check if this listing is already in their favs list so we can display remove favs **/
				if($userdata->ID){
						$ThisLink = "javascript:void(0);";
						
						
						$extn = "_list";
						if(defined('WP_ALLOW_MULTISITE')){
							$extn .= get_current_blog_id();
						}						 
						$my_list = get_user_meta($userdata->ID, 'favorite'.$extn,true);	
						 
						if(is_array($my_list) && in_array($post->ID, $my_list) ){
							$show_add = false;
						}
				}						
				 
				
				if($show_add){
				
					$STRING .= '<a id="button_favs_a'.$GLOBALS['favi'].'" class="list_favorites_add '.$class.'" ';
					
					if($tooltip == 1){
					$STRING .= ' data-toggle="tooltip" data-placement="top" title="'.__("Add Favorites","premiumpress").'"';
					}
					
					$STRING .= ' href="'.$ThisLink.'"';
					if($userdata->ID){
					$STRING .= 'onclick="WLTAddF(\''.str_replace("http://","",get_home_url()).'\', \'favorite\', '.$post->ID.', \'core_ajax_callback\', \'button_favs_a'.$GLOBALS['favi'].'\');jQuery(this).addClass(\'list_favorites_remove\');"';
					}
					$STRING .= '>';
					
					if($content == ""){
					
						if($icon == 1){
						$STRING .= '<i class="fa '.$icon_class.'-o"></i> <span>'.$text.'</span>';
						}else{
						$STRING .= '<span>'.$text.'</span>';
						}
					
					}else{
					$STRING .= $content;
					}
					
					$STRING .= '</a>'; 
				
				}else{
				
					$STRING .= '<a id="button_favs_r'.$GLOBALS['favi'].'" class="list_favorites_remove '.$class.'"';
					if($tooltip == 1){
					$STRING .= ' data-toggle="tooltip" data-placement="top" title="'.__("Remove Favorites","premiumpress").'"';
					}
					$STRING .= 'href="'.$ThisLink.'"';
					if($userdata->ID){
					$STRING .= 'onclick="WLTAddF(\''.str_replace("http://","",get_home_url()).'\', \'favorite\', '.$post->ID.', \'core_ajax_callback\', \'button_favs_r'.$GLOBALS['favi'].'\');jQuery(this).addClass(\'list_favorites_add\').removeClass(\'list_favorites_remove \');"';
					}
					$STRING .= '>';
					
					if($content == ""){
						
						if($icon == 1){
						$STRING .= '<i class="fa '.$icon_remove.'"></i> <span>'.$text_remove.'</span>';
						}else{
						$STRING .= '<span>'.$text_remove.'</span>';
						}
					
					}else{
					$STRING .= $content;
					}
					
					
					$STRING .= '</a>';				
				} 
 
		
		if(!$span){
		
			return $STRING;
		
		}else{		
			// RETURN CODE
			return "<span class='wlt_shortcode_favs'>".$STRING."</span>"; 
		}
	}	
 
	
 
	
	
	
	/* =============================================================================
		[GOOGLEMAP] - SHORTCODE
		========================================================================== */
	function wlt_google_maps_display($atts, $content = null){  global $wpdb, $post, $CORE; 
	
	extract( shortcode_atts( array('tab' => false, 'init' => true, 'text_before' => '', 'text_after' => '', 'color' => '', 'zoom' => '', 'streetview' => false), $atts ) ); 
	
 	
	//3. IF ITS NOT EMPTY, LETS CHECK THE VALUE IS NOT EMPTY	
	$default_zoom = 7; 
	if($zoom == "" && isset($GLOBALS['CORE_THEME']['google_zoom1']) && is_numeric($GLOBALS['CORE_THEME']['google_zoom1'])){
	$default_zoom = $GLOBALS['CORE_THEME']['google_zoom1'];
	}elseif($zoom  != "" && is_numeric($zoom) ){
	$default_zoom = $zoom; 
	}
	 
	$map_long  = get_post_meta($post->ID,'map-log',true);
	
	if($map_long == ""){ return; }
	$packagefields = get_option("packagefields");
	
	//if( get_post_meta($post->ID,'showgooglemap',true) != "yes" && !defined('WLT_DEMOMODE') && count($packagefields) != 0 ){ return; }
	
	$color = _ppt('display_mapcolor_search'); 
	
	ob_start();
	
	?>
    
    <?php if(!isset($GLOBALS['mapadded'])){ ?>
	<script src="https://maps.googleapis.com/maps/api/js?v=3&amp;language=<?php echo $GLOBALS['CORE_THEME']['google_lang']; ?>&amp;region=<?php echo $GLOBALS['CORE_THEME']['google_region']; ?>&key=<?php echo  trim(stripslashes($GLOBALS['CORE_THEME']['googlemap_apikey'])); ?>" ></script>
    <?php } ?>
    
    <div id="wlt_google_maps_div"></div>
	
	<script >
	var map = null, marker = null; 
	
	function initialize() {
	
	<?php if($color == "grey"){ ?>
	
	var styles = [{"featureType":"water","elementType":"geometry","stylers":[{"color":"#e9e9e9"},{"lightness":17}]},{"featureType":"landscape","elementType":"geometry","stylers":[{"color":"#f5f5f5"},{"lightness":20}]},{"featureType":"road.highway","elementType":"geometry.fill","stylers":[{"color":"#ffffff"},{"lightness":17}]},{"featureType":"road.highway","elementType":"geometry.stroke","stylers":[{"color":"#ffffff"},{"lightness":29},{"weight":0.2}]},{"featureType":"road.arterial","elementType":"geometry","stylers":[{"color":"#ffffff"},{"lightness":18}]},{"featureType":"road.local","elementType":"geometry","stylers":[{"color":"#ffffff"},{"lightness":16}]},{"featureType":"poi","elementType":"geometry","stylers":[{"color":"#f5f5f5"},{"lightness":21}]},{"featureType":"poi.park","elementType":"geometry","stylers":[{"color":"#dedede"},{"lightness":21}]},{"elementType":"labels.text.stroke","stylers":[{"visibility":"on"},{"color":"#ffffff"},{"lightness":16}]},{"elementType":"labels.text.fill","stylers":[{"saturation":36},{"color":"#333333"},{"lightness":40}]},{"elementType":"labels.icon","stylers":[{"visibility":"off"}]},{"featureType":"transit","elementType":"geometry","stylers":[{"color":"#f2f2f2"},{"lightness":19}]},{"featureType":"administrative","elementType":"geometry.fill","stylers":[{"color":"#fefefe"},{"lightness":20}]},{"featureType":"administrative","elementType":"geometry.stroke","stylers":[{"color":"#fefefe"},{"lightness":17},{"weight":1.2}]}];
	
	<?php }elseif($color == "yellow"){ ?>
	
	var styles = [{"featureType":"all","elementType":"geometry.fill","stylers":[{"color":"#ffd44d"},{"visibility":"on"}]},{"featureType":"all","elementType":"geometry.stroke","stylers":[{"visibility":"off"}]},{"featureType":"all","elementType":"labels","stylers":[{"visibility":"on"}]},{"featureType":"all","elementType":"labels.text.fill","stylers":[{"color":"#ffe38c"},{"lightness":"-52"},{"saturation":"-62"}]},{"featureType":"all","elementType":"labels.text.stroke","stylers":[{"visibility":"off"}]},{"featureType":"administrative","elementType":"geometry.fill","stylers":[{"visibility":"on"}]},{"featureType":"administrative.country","elementType":"geometry","stylers":[{"visibility":"on"},{"weight":"1.00"},{"gamma":"1.00"}]},{"featureType":"administrative.country","elementType":"geometry.fill","stylers":[{"visibility":"on"}]},{"featureType":"administrative.province","elementType":"geometry","stylers":[{"color":"#f05858"},{"visibility":"on"}]},{"featureType":"administrative.neighborhood","elementType":"geometry.fill","stylers":[{"visibility":"on"},{"hue":"#ffd800"}]},{"featureType":"administrative.land_parcel","elementType":"all","stylers":[{"visibility":"off"}]},{"featureType":"administrative.land_parcel","elementType":"geometry.fill","stylers":[{"lightness":"0"}]},{"featureType":"administrative.land_parcel","elementType":"labels.text.fill","stylers":[{"visibility":"on"},{"color":"#ccb570"}]},{"featureType":"landscape","elementType":"labels","stylers":[{"visibility":"off"}]},{"featureType":"landscape","elementType":"labels.text","stylers":[{"visibility":"on"}]},{"featureType":"landscape.man_made","elementType":"labels.text","stylers":[{"visibility":"on"}]},{"featureType":"landscape.man_made","elementType":"labels.text.fill","stylers":[{"visibility":"on"},{"lightness":"7"}]},{"featureType":"landscape.natural","elementType":"geometry.fill","stylers":[{"lightness":"32"}]},{"featureType":"landscape.natural.landcover","elementType":"geometry.fill","stylers":[{"lightness":"9"}]},{"featureType":"landscape.natural.terrain","elementType":"geometry.fill","stylers":[{"lightness":"32"}]},{"featureType":"poi","elementType":"labels","stylers":[{"visibility":"off"}]},{"featureType":"poi","elementType":"labels.text.fill","stylers":[{"lightness":"23"}]},{"featureType":"poi.park","elementType":"geometry.fill","stylers":[{"lightness":"0"}]},{"featureType":"poi.park","elementType":"labels.text.fill","stylers":[{"lightness":"41"}]},{"featureType":"road","elementType":"geometry","stylers":[{"lightness":57},{"visibility":"on"},{"gamma":"1"},{"weight":"0.55"}]},{"featureType":"road","elementType":"geometry.fill","stylers":[{"color":"#eac552"},{"lightness":"-3"},{"saturation":"-10"}]},{"featureType":"road","elementType":"labels.text.fill","stylers":[{"visibility":"on"},{"lightness":"15"},{"color":"#483e1e"}]},{"featureType":"road","elementType":"labels.icon","stylers":[{"visibility":"off"}]},{"featureType":"transit","elementType":"labels","stylers":[{"visibility":"off"}]},{"featureType":"water","elementType":"geometry.fill","stylers":[{"lightness":"20"},{"visibility":"on"}]},{"featureType":"water","elementType":"labels","stylers":[{"visibility":"on"}]},{"featureType":"water","elementType":"labels.text","stylers":[{"visibility":"on"}]},{"featureType":"water","elementType":"labels.text.fill","stylers":[{"lightness":"52"}]},{"featureType":"water","elementType":"labels.text.stroke","stylers":[{"visibility":"off"}]}];
 	
		<?php }elseif($color == "blue"){ ?>
		
			var styles = [{"featureType":"administrative","elementType":"labels.text.fill","stylers":[{"color":"#444444"}]},{"featureType":"landscape","elementType":"all","stylers":[{"color":"#f2f2f2"}]},{"featureType":"poi","elementType":"all","stylers":[{"visibility":"off"}]},{"featureType":"road","elementType":"all","stylers":[{"saturation":-100},{"lightness":45}]},{"featureType":"road.highway","elementType":"all","stylers":[{"visibility":"simplified"}]},{"featureType":"road.arterial","elementType":"labels.icon","stylers":[{"visibility":"off"}]},{"featureType":"transit","elementType":"all","stylers":[{"visibility":"off"}]},{"featureType":"water","elementType":"all","stylers":[{"color":"#46bcec"},{"visibility":"on"}]}];			
		 
		
		<?php } ?>
		
		<?php if($streetview == 1){ ?>
		
		var fenway = {lat:<?php echo  trim(get_post_meta($post->ID,'map-lat',true)); ?>, lng:<?php echo trim(get_post_meta($post->ID,'map-log',true)); ?> };
		  var map = new google.maps.Map(document.getElementById('wlt_google_maps_div'), {
			center: fenway,
			zoom: 13
		  });
		var panorama = new google.maps.StreetViewPanorama(
			document.getElementById('wlt_google_maps_div'), {
			position: fenway,
			pov: {
			  heading: 34,
			  pitch: 10
			}
		  });
  		map.setStreetView(panorama);
		
		<?php }else{ ?>
		
	 	var myLatlng = new google.maps.LatLng('<?php echo  get_post_meta($post->ID,'map-lat',true); ?>','<?php echo get_post_meta($post->ID,'map-log',true); ?>');		 
		map = new google.maps.Map(document.getElementById("wlt_google_maps_div"), { zoom:<?php echo $default_zoom; ?>,  center: myLatlng,  mapTypeId: google.maps.MapTypeId.ROADMAP} ); //disableDefaultUI: true
		
		//map.setOptions({styles: styles});
 
		marker = new google.maps.Marker({
			position: myLatlng,
			map: map,
			icon: new google.maps.MarkerImage('<?php echo get_template_directory_uri(); ?>/framework/img/map/icon.png'),
			draggable: false, 
        	animation: google.maps.Animation.DROP,					 
		}); 
		<?php } ?> 
		
 
	}	
	</script>
	
	<?php if($init){ ?>
	<script > 
		jQuery(document).ready(function () {
			setTimeout(function(){ initialize();  }, 1000);
		 
		});
	</script> 
	
	<?php } ?>
	
	<?php if($tab){ ?>
    
		<script > 
		jQuery(document).ready(function () {
			jQuery('#Tabs a').click(function (e) {
			setTimeout(function(){ initialize(); }, 1000);
			});
		});
		</script>
	
    <?php } ?>
 
	
	<?php
	
	$STRING = ob_get_clean(); 
	
	 
	return $text_before.$STRING.$text_after;
 
	
	}
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	 
	function wlt_shortcode_dcats($atts, $content = null){ global $wpdb, $CORE; $STRING = "";  
	
		extract( shortcode_atts( array( 'show_count' => '', 'title' => '', 'limit' => 20, 'div' => '.wlt_shortcode_dcats', 'class' => 'default' ), $atts ) ); 
		 	 
 
		$categories = wp_list_categories( array(
        'taxonomy'  	=> 'listing',
		'depth'         => 5,	
		'hierarchical'  => true,		
		'hide_empty'    => 0,
		'echo'			=> false,
        'title_li' 		=> '',
		 'orderby' 		=> 'term_order',
		 'walker'		=> new walker_shortcode_dcats,
		'limit' 		=> 500,
    	) ); 
	
		?>
   		
        <button class="hidden-sm-up navbar-toggler" type="button" data-toggle="collapse" data-target="#wlt_shortcode_dcats" aria-controls="header_menu" aria-expanded="false" >
            &#9776; <?php echo __("Categories","premiumpress"); ?>
        </button>
        <div class="navbar-toggleable-xs clearfix" id="wlt_shortcode_dcats">
         	 
        
            <div class=" wlt_shortcode_dcats <?php echo $class; ?> clearfix">
            
                <ul class="m-b-0 sf-menu sf-vertical">
                <?php echo $categories; ?>
                </ul>
            
            </div>
        	
            <div class="clearfix"></div>
            
        </div>
        
 
     <script>jQuery(document).ready(function(){ 
		 
		$counter = 1;
		jQuery("<?php echo $div; ?> li.cat-parent").each(function(){
			if($counter > <?php echo $limit; ?>)
			{
				this.remove();
			}
			$counter++;
		});
		
		}); 
		
		</script> 
 

      <?php 
		
		// RETURN
		return $STRING;		 
	
	}
	
	
	


	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	 
 

	
	function wlt_shortcode_hitcounter( $atts, $content = null ){ global $post;
	
		extract( shortcode_atts( array(  "today" => false, "postid" => "" ), $atts ) );	
		
		if($postid != "" && is_numeric($postid) ){ $PID = $postid; }else{ $PID = $post->ID; }
    
		$data = get_post_meta($PID,'hits_array',$data);
	 
		if($today){
		
			if(!is_array($data) || empty($data) ){
			return 0;
			}
			
			foreach($data as $lookme){
			
				foreach($lookme as $kk => $ff){
				 
					if( $kk = date('Y-m-d') ){
					 
						return count($ff);
					
					}				
				}				
			} 
 
			
			return 0;
		}
		
		
	
	}
	function wlt_shortcode_likes( $atts, $content = null ){ global $post;
	
		extract( shortcode_atts( array(  "today" => false, "postid" => "" ), $atts ) );	
		
		if($postid != "" && is_numeric($postid) ){ $PID = $postid; }else{ $PID = $post->ID; }
    
	
		$rating_up 	= get_post_meta($PID, 'ratingup', true);
		if(is_numeric($rating_up)){
		return $rating_up; 	
		}else{
		return 0;
		}
	}
	

	
	function wlt_shortcode_screenshot( $atts, $content = null ){ global $post;
	
	extract( shortcode_atts( array( 'url' => "http://premiumpress.com", "class" => "img-fluid", "alt" => "" ), $atts ) );	
	
	
	$url = str_replace("https://","", str_replace("http://","", $url ));
	
	if(_ppt('coupon_popupwindow') == '1'){ 
	
	return "<img src='http://api.pagepeeker.com/v2/thumbs.php?size=x&url=".$url."' class='".$class." wlt_shortcode_screenshot' alt='".$alt."' />";
	
	}else{
	
	return "<img src='http://free.pagepeeker.com/v2/thumbs.php?size=x&url=".$url."' class='".$class." wlt_shortcode_screenshot' alt='".$alt."' />";
	}
     
	
		 
	}
	
 
	
	


 


function wlt_shortcode_socialbtns($atts, $content = null){ global $wpdb, $post;
	
extract( shortcode_atts( array( 'size' => '32' ), $atts ) );	

if(is_single()){
	$link = get_permalink($post->ID);
	$title = $post->post_title;
}else{
	$link = home_url();
	$title = "";
}

$link  = str_replace("&","&amp;", $link );

ob_start();
?>
 
<a href="https://api.addthis.com/oexchange/0.8/forward/facebook/offer?url=<?php echo $link; ?>&amp;pubid=ra-53d6f43f4725e784&amp;ct=1&amp;title=<?php echo $title; ?>&amp;pco=tbxnj-1.0" target="_blank">
<img src="<?php echo get_template_directory_uri(); ?>/framework/img/social/facebook<?php echo $size; ?>.png" alt="Facebook"/></a>
<a href="https://api.addthis.com/oexchange/0.8/forward/twitter/offer?url=<?php echo $link; ?>&amp;pubid=ra-53d6f43f4725e784&amp;ct=1&amp;title=<?php echo $title; ?>&amp;pco=tbxnj-1.0" target="_blank">
<img src="<?php echo get_template_directory_uri(); ?>/framework/img/social/twitter<?php echo $size; ?>.png" alt="Twitter"/></a>
<a href="https://api.addthis.com/oexchange/0.8/forward/linkedin/offer?url=<?php echo $link; ?>&amp;pubid=ra-53d6f43f4725e784&amp;ct=1&amp;title=<?php echo $title; ?>&amp;pco=tbxnj-1.0" target="_blank">
<img src="<?php echo get_template_directory_uri(); ?>/framework/img/social/linkedin<?php echo $size; ?>.png" alt="LinkedIn"/></a>
<a href="https://api.addthis.com/oexchange/0.8/forward/google_plusone_share/offer?url=<?php echo $link; ?>&amp;pubid=ra-53d6f43f4725e784&amp;ct=1&amp;title=<?php echo $title; ?>&amp;pco=tbxnj-1.0" target="_blank"><img src="<?php echo get_template_directory_uri(); ?>/framework/img/social/googleplus<?php echo $size; ?>.png"  alt="Google+"/></a>

<?php 
return ob_get_clean(); 

}	
 
	
	function shortcodelist(){
	
	return hook_shortcodelist(array());
	
	}
 
	

	 
	/* =============================================================================
	[DISTANCE] - SHORTCODE
	========================================================================== */
	function wlt_distance($atts, $content = null){  global $userdata, $CORE, $post, $wp_query;
	
	 
		extract( shortcode_atts( array('postid' => '', 'icon' => '', 'text_before' => '', 'text_after' => ''.__("away","premiumpress").'', 'info' => false ), $atts ) );
  	 
		
		// GET POST ID
		if($postid == ""){ $postid = $post->ID; }
		 	
		// GET DATA
		$item_long  	= get_post_meta($postid,'map-log',true);
		$item_lat  		= get_post_meta($postid,'map-lat',true);
		
		if($item_long == ""){ return; }
 		
		if(isset($GLOBALS['search_google_lat'])){
		
			$my_long 	= $GLOBALS['search_google_long'];
			$my_lat 	= $GLOBALS['search_google_lat'];
			$my_zip 	= "";	 
		 
		}elseif(isset($_SESSION['mylocation']) && is_numeric($_SESSION['mylocation']['log']) && is_numeric($_SESSION['mylocation']['lat']) ){
		
			$my_long 	= $_SESSION['mylocation']['log'];
			$my_lat 	= $_SESSION['mylocation']['lat'];
			$my_zip 	= $_SESSION['mylocation']['zip'];
		
		}else{
		
			return;		
		} 
 
		
		// WORK OUT THE DIFFERENCE		
		$theta = $item_long - $my_long;
		 
		if(is_numeric($item_lat) && is_numeric($my_lat) && is_numeric($item_lat) && is_numeric($my_lat) && is_numeric($theta) ){
		$dist = sin(deg2rad($item_lat)) * sin(deg2rad($my_lat)) +  cos(deg2rad($item_lat)) * cos(deg2rad($my_lat)) * cos(deg2rad($theta));
		$dist = acos($dist);
		$dist = rad2deg($dist);	 
		$miles =  $dist * 60 * 1.1515;	 
		}
		
		// QUICK DISPLAY
		
		 
		
		// GET THE UNIT
		$unit = strtoupper(_ppt('geolocation_unit'));			
		if ($unit == "K") {			 
			$rt = number_format(($miles * 1.609344)) ." ".__("kilometers","premiumpress");	
			
			if($miles < 1){		
			return __("Less than 1km away","premiumpress");		
			}		
			
		} else if ($unit == "N") {
			$rt = number_format(($miles * 0.8684)) ." ".__("nautical miles","premiumpress");	
			
			if($miles < 1){		
			return __("Less than 1 mile away.","premiumpress");		
			}
			
		} else {
		   $rt = number_format($miles) ." ".__("miles","premiumpress");
		   if($miles < 1){		
			return __("Less than 1 mile away.","premiumpress");		
			}    
		}
		
		// DISPLAY ICON
		$II = "";
		if($icon != ""){
		$II = "<i class='".$icon."'></i>";
		}
		 
		if($info == 0 || isset($GLOBALS['flag-home']) ){
		
		return "<span class='wlt_shortcode_distance'>".$II." ".$text_before." ".$rt." ".$text_after."</span>";
		
		}else{
		
		
		
		return "<span class='wlt_shortcode_distance'>".$II." ".$text_before." ".$rt."
		<i class='fa fa-info-circle wlt_pop_distance_".$post->ID."' 
		style='cursor:pointer;'  
		rel='popover' 
		data-placement='top'
		data-original-title='".__("Useful Links","premiumpress")."' 
		data-trigger='hover'></i>
		".$text_after." 
		</span>
			
			
			<div id='wlt_pop_distance_".$post->ID."_content' style='display:none;'>	
		
			<a href='https://www.google.com/maps/dir//".str_replace(",","",str_replace(" ","+",get_post_meta($post->ID,'map-location',true)))."/".$my_lat.",".trim($my_long)."' target='_blank'>".__("Get Directions","premiumpress")."</a> <br /> 	
		 
			<a href='".get_home_url()."/?s=&amp;zipcode=".str_replace(" ","%20",$my_zip)."&amp;radius=50&amp;showmap=1&amp;orderby=distance&amp;order=desc'>".__("Get Directions","premiumpress")."</a> <br /> 
			
			<a href='#' onclick='GMApMyLocation();' data-toggle='modal' data-target='#MyLocationModal'> ".__("Change Location","premiumpress")." </a>
		
		</div>
			
			<script>jQuery(document).ready(function(){
		
	 jQuery('.wlt_pop_distance_".$post->ID."').popover({ 
			html: true,
			trigger: 'manual',
			container: jQuery(this).attr('id'),
			placement: 'top',
			content: function () {
				return jQuery('#wlt_pop_distance_".$post->ID."_content').html();
			}
		}).on('mouseover', function(){
		
	   
		}).on('mouseenter', function () {
			var _this = this;
			jQuery(this).popover('show');
			jQuery(this).siblings('.popover').on('mouseleave', function () {
				jQuery(_this).popover('hide');
			});
		}).on('mouseleave', function () {
			var _this = this;
			setTimeout(function () {
				if (!jQuery('.popover:hover').length) {
					jQuery(_this).popover('hide')
				}
			}, 100);
		});
		
		 
	});</script>";
	
	}
		
	}	
 

	 

	/* =============================================================================
		[CATEGORY] - SHORTCODE
		========================================================================== */
	function wlt_page_categories( $atts, $content = null ) { global $userdata, $CORE, $post; $STRING = "";
 
		extract( shortcode_atts( array( 'show' => false ,'hide' => false, 'count' => "no", "type" => THEME_TAXONOMY ), $atts ) );
		 
		// build query
		$args = array(
				  'taxonomy'     => $type,
				  'orderby'      => 'name',
				  'show_count'   => 0,
				  'pad_counts'   => $count,
				  'hierarchical' => 0,
				  'title_li'     => '',
				  'include'		 => $show,
				  'exclude'		 => $hide,
				  'hide_empty'   => 0,
				 
		);
		 	
		
		$STRING .= '<div class="shortcode_category_block">';
		
		$categories = get_categories($args);  $nc = 1; $lc = 0;
				
		foreach ($categories as $category) { 
		 
		
				// HIDE PARENT
				if($category->parent != 0){ continue; }
				
				if($nc == 1){ $STRING .= '<div class="row-old">'; }
									
				$STRING .= '<ul class="col-md-4"><li class="head">
							<a href="'.get_term_link($category).'"><span>'.$category->name.'</span></a> ';
							if($count == "yes"){ $STRING .= '('.$category->count.')'; }
					
				// CHECK FOR SUB CATS	
				$s = wp_list_categories("echo=0&taxonomy=".THEME_TAXONOMY."&hide_empty=0&title_li=&child_of=".$category->term_id);				
				if(strlen($s) > 25){
				$STRING .= '<ul class="categorysublist">'.$s.'</ul>';
				}	
				
				$STRING .= '</li></ul>';			
				if($nc == 3){ $STRING .= '</div> <div class="clearfix"></div>'; $nc = 0; }
				$nc++;	
				$lc++;	
		 
		}			
		if($nc != 1){	$STRING .= '</ul> <div class="clearfix"></div>'; }
				 
		$STRING .= '</div>';
		return $STRING; 
	
	}

 
	/* =============================================================================
		[IMAGEAUTHOR] - SHORTCODE
		========================================================================== */
	function wlt_shortcode_author($atts, $content = null){ global $wpdb,  $wp_query, $CORE, $post;  
	
		extract( shortcode_atts( array( 'size' => '', 'circle' => false), $atts ) );
		
		if($circle){
		return str_replace("avatar ","avatar img-circle ",str_replace('photo"','photo img-circle"',get_avatar($post->post_author,$size)));
		}else{
		return str_replace('photo"','photo img-circle"',get_avatar($post->post_author,$size));
		}
		
	}	


 
	
	/* =============================================================================
		[LISTINGS] - SHORTCODE
		========================================================================== */
function wlt_page_listings( $atts, $content = null ) {
	
	global $wpdb, $post; $STRING = ""; $extra=""; $i=1; $stopcount = 4; $args = "";  
	
	extract( shortcode_atts( array( 
	'dataonly' => false, 
	'query' => '', 
	'show' => get_option('posts_per_page'), 
	'type' => THEME_TAXONOMY.'_type',  
	'cat' => '', 
	'orderby' => 'ID', 
	'order' => 'desc', 
	'grid' => false, 
	'authorid' => 0,
	'custom' => "", 
	'customvalue' => "",
	'small' => false,
	'extrasmall' => false,
	'nav' => false,
	'debug' => false,
	'offset' => 0,
	'carousel' => 0,
	'search' => "",
	 ), $atts ) );
 	
  
	// GET CURRENT PAGED ITEM
	if( ( is_front_page() || isset($GLOBALS['flag-home']) ) && isset($_GET['pd']) && is_numeric($_GET['pd']) ){
	 $paged = $_GET['pd'];
	
	}elseif( isset($_GET['pa']) && is_numeric($_GET['pa']) ){
	 $paged = $_GET['pa'];
	
	
	}else{
	 $paged = ( get_query_var( 'paged' ) ) ? absint( get_query_var( 'paged' ) ) : 1;
	}
  
  
   $query = str_replace("#038;","&",$query);
  	
   if(strlen($query) > 1 ){
		// ADD ON POST TYPE FOR THOSE WHO FORGET
		if(strpos($query,'post_type') == false && $type ==  THEME_TAXONOMY.'_type'  ){
		$args = $query ."&post_type=".THEME_TAXONOMY."_type&pa=".$paged;
		}else{
		$args = $query."&pa=".$paged;
		}
		$args = hook_custom_queries($args);
	}
 

   
	if($args == ""){
	// SWITCH QUERY TYPE
	switch($custom){
	
	case "lastused": {

			$args = array('posts_per_page' => $show, 
			'post_type' => $type, 'orderby' => $orderby, 'order' => $order, 'paged'  => $paged, 'offset'  => $offset,
			'meta_query' => array (
					array (
					  'key' => "lastused",
						'compare' => 'LIKE',
						'value' => date('Y-m-d'),
						'type' => 'DATETIME'
					 
					)
				  ) 
			 );
		
		} break;
	
		case "gender": {

			$args = array('posts_per_page' => $show, 
			'post_type' => $type, 'orderby' => $orderby, 'order' => $order, 'paged'  => $paged, 'offset'  => $offset,
			'meta_query' => array (
					array (
					  'key' => 'dagender',
					  'value' => $customvalue,
					)
				  ) 
			 );
		
		} break;
		
	 
	
		case "featured": {

			$args = array('posts_per_page' => $show, 
			'post_type' => $type, 'orderby' => $orderby, 'order' => $order, 'paged'  => $paged, 'offset'  => $offset,
			'meta_query' => array (
			
			
			'relation'    => 'AND',	
					
							array(
							
							'relation'    => 'OR',	
										 
							'featured'    => array(
								'key' 			=> 'featured',
								'type' 			=> 'NUMERIC',
								'value' 		=> 1,
								'compare' 		=> '=',								 			
							),			 
							'featured1'   => array(
								'key' 			=> 'featured',								
								'value' 		=> "yes",
								'compare' 		=> '=',	
												
							),	
							
												
						),
			 
			
			
					 
				  ) 
			 );
			   
		} break;
		
		case "popular": {

			if(defined('WLT_AUCTION')){
			
			$args = array('posts_per_page' => $show, 
			'post_type' => $type, 'orderby' => 'meta_value_num', 'order' => 'desc', 'paged'  => $paged, 'offset'  => $offset,
			'meta_query' => array (
					array (
					  'key' => 'hits',	
					  'orderby' => 'meta_value_num'				  
					),
					 array( 
						'key' => 'listing_expiry_date',																
						'orderby' => 'meta_value',						 
						'compare' => '>=',
						'value' => current_time( 'mysql' ),
						'type' => 'DATETIME'							 
					),
				  ) 
			 );
			  
			}else{
			
			$args = array('posts_per_page' => $show, 
			'post_type' => $type, 'orderby' => 'meta_value_num', 'order' => 'desc', 'paged'  => $paged, 'offset'  => $offset,
			'meta_query' => array (
					array (
					  'key' => 'hits',	
					  'orderby' => 'meta_value_num'				  
					)
				  ) 
			 );
			 
			 }
			 
			
		
		} break;
		
		case "rating": {

			$args = array('posts_per_page' => $show, 
			'post_type' => $type, 'orderby' => 'meta_value_num', 'order' => 'desc', 'paged'  => $paged, 'offset'  => $offset,
			'meta_query' => array (
					array (
					'key' => 'starrating_total',																
					'orderby' => 'meta_value_num'				  
					)
				  ) 
			 );
		
		} break;
		
		case "author": {
		 
		$args = array('posts_per_page' => $show,  'post_type' => $type,  'orderby' => 'rand', 'offset'  => $offset, 'paged'  => $paged, 'author' => $authorid   );
		 
		
		} break;	
		
		case "endsooncoupon": {
		
			 $k = "expiry_date";

			$args = array('posts_per_page' => $show, 
			'post_type' => $type, 'orderby' => 'meta_value', 'order' => 'asc', 'paged'  => $paged, 'offset'  => $offset,
			'meta_query' => array (
				 				 
					array( 
						'key' => $k,																
						'orderby' => 'meta_value',						 
						'compare' => '>=',
						'value' => current_time( 'mysql' ),
						'type' => 'DATETIME'							 
					),	
				  ) 
			 );
		 
		
		} break;
		
		case "endingsoon": 
		case "endsoon": {
		
			 
			$args = array('posts_per_page' => $show, 
			'post_type' => $type, 'orderby' => 'meta_value', 'order' => 'asc', 'paged'  => $paged, 'offset'  => $offset,
			'meta_query' => array (
					array( 
						'key' => 'listing_expiry_date',																
						'orderby' => 'meta_value',						 
						'compare' => '>=',
						'value' => current_time( 'mysql' ),
						'type' => 'DATETIME'							 
					),
				  ) 
			 );
		
		} break;
		
		case "random": {

			$args = array('posts_per_page' => $show,  'post_type' => $type,  'orderby' => 'rand', 'paged'  => $paged, 'offset'  => $offset  );
		
		
		// ADD IN HITS
			if($orderby == "hits"){
			
				$args = array_merge($args, 			
				array( 'meta_query' => array (
				
					'relation'    => 'AND',	
					
							array(
							
							'relation'    => 'OR',	
										 
							'featured'    => array(
								'key' 			=> 'featured',
								'type' 			=> 'NUMERIC',
								'value' 		=> 1,
								'compare' 		=> '=',								 			
							),			 
							'featured1'   => array(
								'key' 			=> 'featured',								
								'value' 		=> "yes",
								'compare' 		=> '=',	
												
							),						
						),			
				), )  );
				
				}
				
				
				if(isset($_GET['country']) && strlen($_GET['country']) < 5){
				
				
				$args = array_merge($args, 			
				array( 'meta_query' => array (
				
					'relation'    => 'AND',	
					
							array(
							
							 			 
							'map-country'    => array(
								'key' 			=> 'map-country',								 
								'value' 		=> $_GET['country'],
								'compare' 		=> '=',								 			
							),			 
							 						
						),			
				), )  );
				
				}
				
		} break;
		
		case "nearby": {
		
			// GET CITY
			$city = get_post_meta($post->ID,'map-city',true);
			
			// GET CATEGORY
			$term_list = wp_get_post_terms($post->ID, 'listing', array("fields" => "all"));	
			
			$args = array('posts_per_page' => $show, 
			'post_type' => $type,   'order' => 'desc', 'paged'  => $paged, 'offset'  => $offset, 'post__not_in' => array($post->ID),
			'meta_query' => array (
					array (
					'key' => 'map-city',																
					'value' => $city				  
					)
				  ) 
			 );
			 if(isset($term_list[0])){	
			 			
				$args['tax_query'] = array( array( 'taxonomy' => "listing", 'field' => 'term_id', 'terms' =>  $term_list[0]->term_id, 'operator'=> 'IN' )  );
				 
			}
			 
			 
		} break;
 
		
		case "related": {
		
	 
			if(THEME_KEY == "cp"){				  
			$term_list = wp_get_post_terms($post->ID, 'store', array("fields" => "all"));			
			}else{			
			$term_list = wp_get_post_terms($post->ID, 'listing', array("fields" => "all"));		
			}
			 
 
 			if(THEME_KEY == "cp" && isset($term_list[0]) ){	
				$args = array('posts_per_page' => $show,  'orderby' => 'title', 'order' => 'des',  'post_type' => 'listing_type', 'post__not_in' => array($post->ID), 				
				'tax_query' => array( array('taxonomy' => "store", 'field' => 'term_id', 'terms' =>  $term_list[0]->term_id, 'operator'=> 'IN' ) ),				
				 );
			}elseif(isset($term_list[0])){				
				$args = array('posts_per_page' => $show,  'orderby' => 'title', 'order' => 'des',  'post_type' => 'listing_type', 'post__not_in' => array($post->ID), 				
				'tax_query' => array( array('taxonomy' => "listing", 'field' => 'term_id', 'terms' =>  $term_list[0]->term_id, 'operator'=> 'IN' ) ),				
				 );
			}else{
				$args = array( 'post_type' => THEME_TAXONOMY.'_type', 'posts_per_page' => $show, 'orderby' => 'ID', 'order' => 'desc', 'paged'  => $paged, 'post__not_in' => array($post->ID)  );
			}
		
		} break;
		
		case "new": {

			$args = array('posts_per_page' => $show,  'post_type' => $type,  'orderby' => 'ID', 'order' => 'desc', 'paged'  => $paged, 'offset'  => $offset );
		
		} break;	
		
		default: {
		
		
			/*** default string ***/
			$args = array('posts_per_page' => $show, 'post_type' => $type, 'orderby' => $orderby, 'order' => $order, 'paged'  => $paged, 'offset'  => $offset );
	   	
			// ADD IN HITS
			if($orderby == "hits"){
			
				$args = array_merge($args, 			
				array( 'meta_query' => array (
				
					'relation'    => 'AND',	
					
							array(
							
							'relation'    => 'OR',	
										 
							'hits'    => array(
								'key' 			=> 'hits',
								'type' 			=> 'NUMERIC',								 								 			
							),					
						),				
				), )  );
				
				}
			
		}
	 
	} // end switch 
	
	
	// REMOVE IF 0
	if($offset == 0){
	unset($args['offset']);	
	}
	
	
	// CUSTOM CATEGORY
 	if(is_array($cat)){
 		$args['tax_query'][] = array(
							'taxonomy' => "listing",
							'field' => 'term_id',
							'terms' => $cat,
							'operator'=> 'IN'	,
							//'include_children' => true,						
		); 
	}elseif($cat != ""){
	 
 		$args['tax_query'][] = array(
							'taxonomy' => "listing",
							'field' => 'term_id',
							'terms' => explode(",", $cat),
							'operator'=> 'IN'	,
							//'include_children' => true,						
		); 
		
		
	}
	


	// COUPON HIDE EXPIRED
	if(THEME_KEY == "cp"){
		if(_ppt('coupon_showexpired') == '1'){}else{		
		
			// ADDON
			if(isset($args['meta_query'])){		
			
				$args['meta_query'] = array_merge($args['meta_query'],  
						array(  
							'expiry_date'   =>  
							array( 
								'key' 			=> 'expiry_date',																
								'orderby' 		=> 'expiry_date',						 
								'compare' 		=> '>=',
								'value' 		=> current_time( 'mysql' ),
								'type' 			=> 'DATETIME',
							),					  
						)
				);		
			
			}else{
			
				$args = array_merge($args, 			
					array( 'meta_query' => array (				
						'relation'    => 'AND',	
								'expiry_date'   =>  array( 
								'key' => 'expiry_date',																
								'orderby' => 'expiry_date',						 
								'compare' => '>=',
								'value' => current_time( 'mysql' ),
								'type' => 'DATETIME',
							), 
						), 
					)
				);
					
			}// end if 
			 
		}
	}
	
	
	if(THEME_KEY == "at"){
	
	
			// ADDON
			if(isset($args['meta_query'])){		
			
				$args['meta_query'] = array_merge($args['meta_query'],  
						array(  
							'expiry_date'   =>  
							array( 
								'key' => "listing_expiry_date",
								'compare' => '>=',
								'value' => current_time( 'mysql' ),
								'type' => 'DATETIME'	
							),					  
						)
				);		
			
			}else{
			 
				$args = array_merge($args, 			
					array( 'meta_query' => array (				
						'relation'    => 'AND',	
								'expiry_date'   =>  array( 
								'key' => "listing_expiry_date",
								'compare' => '>=',
								'value' => current_time( 'mysql' ),
								'type' => 'DATETIME'	
							), 
						), 
					)
				);
					
			}// end if 
		 	 
			 
		
	}
	
	if(THEME_KEY == "da" && isset($_GET['male'])){	
	
	
			// ADDON
			if(isset($args['meta_query'])){		
			
				$args['meta_query'] = array_merge($args['meta_query'],  
						array(  
							'dagender'   =>  
							array( 
								'key' => "dagender",
								'compare' => '=',
								'value' => "1",
							),					  
						)
				);		
			
			}else{
			 
				$args = array_merge($args, 			
					array( 'meta_query' => array (				
						'relation'    => 'AND',	
								'dagender'   =>  array( 
								'key' => "dagender",
								'compare' => '=',
								'value' => "1",
							), 
						), 
					)
				);
					
			}// end if 
		 	 
			 
		
	}elseif(THEME_KEY == "da" && isset($_GET['female'])){
	
			// ADDON
			if(isset($args['meta_query'])){		
			
				$args['meta_query'] = array_merge($args['meta_query'],  
						array(  
							'dagender'   =>  
							array( 
								'key' => "dagender",
								'compare' => '=',
								'value' => "2",
							),					  
						)
				);		
			
			}else{
			 
				$args = array_merge($args, 			
					array( 'meta_query' => array (				
						'relation'    => 'AND',	
								'dagender'   =>  array( 
								'key' => "dagender",
								'compare' => '=',
								'value' => "2",
							), 
						), 
					)
				);
					
			}// end if 
		
	}

	 
	if(isset($search) && strlen($search) > 1){
		 	 
		$args = array_merge($args, array( 's' => $search )  );
 		
	}
	
	
	
	
	
	
 
	// HOOK QUERY
	$args = hook_custom_queries($args);
 
 	// debug
	//if($debug){
	//print_r($args);
	//}
	
	} // end if query is empty
	
	
	// SAVE QUERIES AND ADD-ON NO FOUND ROWS
	if(!$nav && is_array($args) ){	 
	 
		$args = array_merge($args, array('no_found_rows' => true ) );
	}  

	 
 
	  
	$query1 = new WP_Query( $args );
 
	if ( $query1->have_posts() ) {
 	
	 	 
		$o = 0; $MAINSTRINGSTRING = "";
		ob_start();
		
		if($extrasmall && $carousel){	
		
		echo "";
		
		}elseif($extrasmall && !$carousel){	
		
		echo "<div class='listing-list-wrapper extrasmall-list clearfix'><ul>"; 		
		
		}elseif($small && !$carousel){	
		
		echo "<div class='listing-list-wrapper small-list clearfix'>"; 
		
		}
 		
		while ( $query1->have_posts() ) { $query1->the_post();
		    
			
			if($extrasmall && $carousel){	
		
			get_template_part( 'content-listing-top10'); 
		 
			}elseif($extrasmall && !$carousel){	
			
			get_template_part( 'content-listing-small'); 
			
			}else{	
			
			get_template_part( 'content-listing'); 
			
 			}
			
			
			$o++;			
		}
		
		if($extrasmall && $carousel){	
		
		echo "";
		
		}elseif($extrasmall && !$carousel){				
		
		echo "</ul></div>"; 
		
		}elseif($small && !$carousel){	
		
		echo "</div>"; 
		
		}
		
		$MAINSTRINGSTRING .= ob_get_contents();	
		ob_end_clean(); 
		
		
		// REMOVE EQUAL HIGH FROM CAROUSELS
		if($carousel){
		
		$MAINSTRINGSTRING = str_replace("eqh ","", str_replace("w-lg-30","", str_replace("w-lg-20","", $MAINSTRINGSTRING)));
		 
		}
		
		$STRING .= $MAINSTRINGSTRING;
		
		
		
		//$fg = hook_items_after_filter( array("string" => $STRING, "args" => $args, "show" => $show-$o ) );	 
		//$STRING .= $fg['string'];
	 
	
	} 
	// END QUERY
	wp_reset_query();
	
	if($nav){
	 
		// GET IDS ONLY INSTEAD OF ALL DATA
		$args = array_merge($args,array( 'fields' => "ids", ) );
	 	
		 
		// PERFORM QUERY
		$the_query = new WP_Query( $args ); 
		 
		$big = 999999999; // need an unlikely integer
		
	 
		if(is_front_page() || isset($GLOBALS['flag-home'])){
			$base = home_url()."/page/%#%/?s=";		 
			$format = "?pd=%#%";
		}else{
			
		} 
		
		$base = str_replace( $big, '%#%', esc_url( get_pagenum_link( $big ) ) );
		$format = "?pa=%#%";
		
		$posts_per_page_g = $args['posts_per_page'];
		if(!is_numeric($posts_per_page_g)){
		$posts_per_page_g = get_option('posts_per_page');
		}
		
		 
		 
		$STRING .= '<div class="col-12">
		
		<ul class="pagination justify-content-center">'.str_replace("current","active",str_replace("page-numbers","btn btn-secondary num",str_replace("<span","<li class='page-item'><span",str_replace("span/>","span/></li>",str_replace("a/>","a/></li>",str_replace("<a","<li class='page-item'><a rel='nofollow'",paginate_links( array(
			'base' 		=> '%_%',
			'format' 	=> "?pa=%#%",
			'current' 	=> max( 1, $paged ),
			'total' 	=> ceil($the_query->found_posts/$posts_per_page_g),
		) ).'</ul></div>'))))));
	
	}
	
	return $STRING; 	
	
}
 
 

	/* =============================================================================
		[CONTACT] - SHORTCODE
		========================================================================== */
	function wlt_shortcode_contact( $atts, $content = null){ global $userdata, $post, $CORE; $STRING = "";
	 
		// EXTRACT OPTIONS
		extract( shortcode_atts( array('style' => "0", 'button' => "0", "class" => "btn  btn-primary", "text" => __("Contact Author","premiumpress") ), $atts ) );
		 
		if($button == 1){ $style = 1; }
		
		// SWITCH STYLE
		switch($style){
		
			case "0": {
			
			$STRING  = $this->SHOW_CONTACTFORM(3);
			
			} break;
		
			case "1": {
			
			$STRING .= "<a href='#wlt_shortcode_contactmodal_".$post->ID."' role='button' data-toggle='modal' class='".$class."  wlt_shortcode_contact_button'>".$text."</a>";
			
			$STRING .= '<!-- CONTACT FORM MODAL -->
			<div id="wlt_shortcode_contactmodal_'.$post->ID.'" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="wlt_shortcode_contactmodalLabel_'.$post->ID.'" aria-hidden="true">
			  <div class="modal-dialog"><div class="modal-content">
			  <div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">x</button>
				<h4 id="myModalLabel">'.__("Contact Author","premiumpress").'</h4>
			  </div>
			  <form action="#" method="post" id="ContactForm" onsubmit="return CheckFormData'.$style.'();">
			  <div class="modal-body">'.$this->SHOW_CONTACTFORM(1).'</div>
			  <div class="modal-footer">
			  <button type="submit" class="btn btn-primary" style="float:none;">'.__("Send Message","premiumpress").'</button>
			  <button class="btn" data-dismiss="modal" aria-hidden="true">'.__("Close","premiumpress").'</button>
			  </div>
			  </form>
			  </div></div></div>
			<!-- END CONTACT FORM MODAL	 -->';			
			
			} break; // END STYLE 1
			
			case "2": {
			 
			$STRING  = $this->SHOW_CONTACTFORM(2);
			
			} break;
		
			default: { $STRING = $this->SHOW_CONTACTFORM(); } break;
		}// end switch
		
		return $STRING;
		
	} 	
function SHOW_CONTACTFORM($style=0){ global $CORE, $post; $STRING = ""; $rn1 = rand("0", "9"); $rn2 = rand("0", "9");	

	// POST VALUES AND BASIC VALIDATION
	 
	if(isset($_POST['contact_n1'])){
	$val1 = esc_attr($_POST['contact_n1']); 
	$val2 = esc_attr($_POST['contact_e1']); 
	$val3 = esc_attr($_POST['contact_p1']); 
	$val4 = esc_attr($_POST['contact_m1']); 
	}else{
	$val1= "";
	$val2= "";
	$val3= "";
	$val4= "";
	}
	

	
	// BUILD CORE FIELD FIELDS
	$formField = '<table class="table table-bordered table-striped">
           
            <tbody>
			
              <tr>
			  <td>'.__("Your Name","premiumpress").' <span class="required">*</span></td>
              <td><input class="col-md-12 form-control" type="text" name="contact_n1" id="name" value="'.$val1.'"></td>
              </tr>
			  
              <tr>
			  <td>'.__("Your Email","premiumpress").' <span class="required">*</span></td>
              <td><input class="col-md-12 form-control" type="text" name="contact_e1" id="email1" value="'.$val2.'"></td>
              </tr>
			  
              <tr>
			  <td>'.__("Your Phone","premiumpress").'</td>
              <td><input class="col-md-12 form-control" name="contact_p1" value="'.$val3.'" type="text"></td>
              </tr> 
			  
              <tr>
			  <td>'.__("Your Message","premiumpress").' <span class="required">*</span></td>
              <td><textarea class="col-md-12 form-control" name="contact_m1" id="message">'.$val4.'</textarea></td>
              </tr>
			  
			   <tr>
			  <td>'.__("What is the sum of:","premiumpress").' <span class="required">*</span></td>
              <td><input class="col-md-6 form-control" type="text" id="code" name="contact_code" placeholder="'.$rn1." + ".$rn2.'"></td>
              </tr>			  
               
            </tbody>
          </table>';
		  
	$formField2 = '<form action="#" method="post" id="ContactForm2" onsubmit="return CheckFormData'.$style.'();" class="well" role="form">
			<input type="hidden" name="code_value" value="'.($rn1+$rn2).'" />
			<input type="hidden" name="action" value="contactform" />
			<input type="hidden" name="pid" value="'.$post->ID.'" /> 
			
			<h3>'.__("Contact Author","premiumpress").' <small class="pull-right">'.__("Complete the fields below to contact this listing author.","premiumpress").'</small> </h3>
			<hr />
			<div class="row">
            <div class="col-md-6">
			
				<div class="form-group">
                <label>'.__("Your Name","premiumpress").' <span class="required">*</span></label> 
                <input class="col-md-12 form-control" type="text" name="contact_n1" id="name'.$style.'" value="'.$val1.'">
				<div class="clearfix"></div>
				</div>
                
				<div class="form-group">
                <label>'.__("Your Email","premiumpress").' <span class="required">*</span></label>
                <input class="col-md-12 form-control" type="text" name="contact_e1" id="email'.$style.'" value="'.$val2.'">
				<div class="clearfix"></div>
                </div>
				
				<div class="form-group">
                <label>'.__("Your Phone","premiumpress").'</label>
				<input class="col-md-12 form-control" name="contact_p1" value="'.$val3.'" type="text">
				<div class="clearfix"></div>
				</div>
                
                <div class="form-group">
                <label>'.__("Your Message","premiumpress").' <span class="required">*</span></label>
				<input class="col-md-6 form-control" type="text" id="code'.$style.'" name="contact_code" placeholder="'.$rn1." + ".$rn2.'">
				<div class="clearfix"></div>
				</div>
				
    		</div>
            <div class="col-md-6">
                <label>'.__("What is the sum of:","premiumpress").' <span class="required">*</span></label> 
                <textarea class="col-md-12 form-control" name="contact_m1" id="message'.$style.'" rows=10>'.$val4.'</textarea>
            </div>
			</div>           
			 
            <button class="btn btn-primary pull-right active" style="margin-top:10px; margin-right:10px;" type= "submit">'.__("Send Message","premiumpress").'</button>
			
	   <div class="clearfix"></div>
	</form>';
	
	

	
	$formField3 = '<form action="#" method="post" id="ContactForm2" onsubmit="return CheckFormData'.$style.'();" class="contact" role="form">
			<input type="hidden" name="code_value" value="'.($rn1+$rn2).'" />
			<input type="hidden" name="action" value="contactform" />
			<input type="hidden" name="pid" value="'.$post->ID.'" /> 
			
	 <h4>'.__("Have a question?","premiumpress").'</h4>
			 
	 <ul>
			
			<li> <input type="text" name="contact_n1" id="name'.$style.'" value="'.$val1.'" placeholder="'.__("Your Name","premiumpress").'"></li>
            <li><input  type="text" name="contact_e1" id="email'.$style.'" value="'.$val2.'" placeholder="'.__("Your Email","premiumpress").'"></li>
			<li><input  name="contact_p1" value="'.$val3.'" type="text" placeholder="'.__("Your Phone","premiumpress").'"></li>
			<li><input type="text" id="code'.$style.'" name="contact_code" placeholder="'.__("Your Message","premiumpress").' '.$rn1." + ".$rn2.'"></li>			 
            <li><textarea name="contact_m1" id="message'.$style.'" rows=5 placeholder="'.__("What is the sum of:","premiumpress").' ">'.$val4.'</textarea></li>		      
            <li><button class="btn btn-warning btn-lg"  type= "submit">'.__("Send Message","premiumpress").'</button></li>
			
	  </ul>
	  
	  
	</form>';
	
	// MSG SENT
	if(isset($GLOBALS['contactformsent'])){
		$formField1 = '<h4 class="text-center">'.__("Message Sent","premiumpress").'</h4>';
		$formField2 = '<h4 class="text-center">'.__("Message Sent","premiumpress").'</h4>';
		$formField3 = '<h4 class="text-center">'.__("Message Sent","premiumpress").'</h4>';
	}
	
	
	// SWITCH DISPLAY STYLE
	switch($style){
	
		case "0": {
		
		$STRING = $formField3;
		
		} break;
	
		case "1": {
		
		$STRING = '		
		<input type="hidden" name="code_value" value="'.($rn1+$rn2).'" />
		<input type="hidden" name="action" value="contactform" />
		<input type="hidden" name="pid" value="'.$post->ID.'" /> 
		'.$formField.'';
		
		} break;
		
		case "2": {
		
		$STRING = $formField2;
		
		} break; 
	
		default: {
		
		$STRING = '			 
			<form action="#" method="post" id="ContactForm" onsubmit="return CheckFormData'.$style.'();">
			<input type="hidden" name="code_value" value="'.($rn1+$rn2).'" />
			<input type="hidden" name="action" value="contactform" />
			<input type="hidden" name="pid" value="'.$post->ID.'" /> 
			'.$formField.'
			<hr />
			<button type="submit" class="btn btn-primary" style="float:none;">'.__("Send Message","premiumpress").'</button></form>';
		
		} break;
	}
	
 

		
		$STRING .= '<script >
		function CheckFormData'.$style.'(){
		var name 	= document.getElementById("name'.$style.'"); 
		var email1 	= document.getElementById("email'.$style.'");
		var code 	= document.getElementById("code'.$style.'");
		var message = document.getElementById("message'.$style.'");	 
		
		if(name.value == \'\')
		{
			alert(\''.__("Please complete all required fields.","premiumpress").'\');
			name.focus();
			name.style.border = \'thin solid red\';
			return false;
		}
		
		if(email1.value == \'\')
		{
			alert(\''.__("Please enter a valid email address.","premiumpress").'\');
			email1.focus();
			email1.style.border = \'thin solid red\';
			return false;
		}	
		
		if( !isValidEmail( email1.value ) ) {	
		
			alert(\''.__("You have entered and invalid email address.","premiumpress").'\');
			email1.focus();
			email1.style.border = \'thin solid red\';
			return false;
		}	
		
		if(code.value == \'\')
		{
			alert(\''.__("Please complete all required fields.","premiumpress").'\');
			code.focus();
			code.style.border = \'thin solid red\';
			return false;
		}
		
		if(code.value != '.($rn1 + $rn2).')
		{
			alert(\''.__("Security Code Incorrect","premiumpress").'\');
			code.focus();
			code.style.border = \'thin solid red\';
			return false;
		} 
		
		if(message.value == \'\')
		{
			alert(\''.__("Please complete all required fields.","premiumpress").'\');
			message.focus();
			message.style.border = \'thin solid red\';
			return false;
		} 
		
		return true;
		} 
		</script>';
        
        return $STRING;
}
	/* =============================================================================
		[USERID] - SHORTCODE
		========================================================================== */
	function wlt_shortcode_userid( $atts, $content = null){ global $userdata;
	
		if($userdata->ID){ return $userdata->ID; }else{ return 0; }
	} 
 
	/* =============================================================================
		[TIMELEFT] - SHORTCODE
		========================================================================== */
	 	
		
	function wlt_shortcode_timeleft( $atts, $content = null ) {
	
 
		global $wpdb, $userdata, $CORE, $post, $shortcode_tags; $STRING = ""; 
		
		extract( shortcode_atts( array('postid' => "", "text_before" => "", "text_ended" => "", "key" => "listing_expiry_date" ), $atts ) );
		
		// SETUP ID FOR CUSTOM DISPLAY	
		$milliseconds = str_replace("+","",round(microtime(true) * 100));
		$milliseconds .= rand( 0, 10000 );
		 
		// CHECK FOR CUSTOM POST ID
		if($postid == ""){ $postid = $post->ID; }
		
		
		
		// GET VALUE FROM LISTING
		$expiry_date = get_post_meta($postid,$key,true);		 
		
		if($expiry_date == "" || strlen($expiry_date) < 3){ 		 
			return "ended"; 
		}
		
	  
		if(strlen($expiry_date) == 10){ $expiry_date = $expiry_date." 00:00:00"; }
		
		// REFRESH PAGE EXTR
		$run_extra =  ""; $run_extrab  = "";
		
		$spanid = $postid."".$milliseconds;
	  
		ob_start();
		?>
        <span class='timeleft_<?php echo $spanid; ?>'></span>
        
		<script> 
			
			jQuery(document).ready(function() {		
			
				var dateStr = '<?php echo $expiry_date; ?>'
				var a=dateStr.split(' ');
				var d=a[0].split('-');
				var t=a[1].split(':');
				var date1 = new Date(d[0],(d[1]-1),d[2],t[0],t[1],t[2]);	
						 
				jQuery('.timeleft_<?php echo $spanid; ?>').countdown({
				timezone: <?php echo get_option('gmt_offset'); ?>, 
				until: date1, 
				onExpiry: WLTvalidateexpiry<?php echo $postid; ?>,
				compact: true,
				alwaysExpire: true,				 
				});
				
			});
			
			function WLTvalidateexpiry<?php echo $postid; ?>(){		 
			 
			 	   jQuery.ajax({
					   type: "POST",
					   url: '<?php echo home_url(); ?>/',
					data: {
					action: "validateexpiry",						 	
					   pid: '<?php echo $postid; ?>',
					  },
					   success: function(response) {
					 
					   },
					   error: function(e) {
						   
					   }
				   });
						
			 };
			
		</script>
		<?php	 
			
			$STRING = ob_get_clean(); 
			
			return $STRING;
	}	

 
 
	/* =============================================================================
		[TIMESINCE] - SHORTCODE
		========================================================================== */
	function wlt_shortcode_timesince( $atts, $content = null ) { global $post, $CORE;
	
		$vv = $CORE->date_timediff($post->post_date);		 
	
		return $vv['string-small'];
	
		 
	} 
 

	/* =============================================================================
		[ADVANCEDSEARCH] - SHORTCODE
		========================================================================== */
	function wlt_shortcode_advancedsearch( $atts = "", $content = null ) {
	
	global $userdata, $CORE, $post, $shortcode_tags;
	
	extract( shortcode_atts( array('home' => "no"), $atts ) );
 
	if($home == "yes"){
	
	return core_search_form(null,'home');
	
	}else{
	
	return core_search_form(null,'wlt_shortcode_advancedsearch');
	
	}
	
	}

 

	/* =============================================================================
		[VISITORCHART] - SHORTCODE
		========================================================================== */
	function wlt_shortcode_visitorchart( $atts, $content = null ) {
	
		global $userdata, $CORE, $post, $shortcode_tags; $STRING = ""; $DATASTRING = ""; $MAPSTRING = ""; $showWorldMap = true;
		extract( shortcode_atts( array('postid' => "", 'sellspace' => 0, "trigger" => true ), $atts ) );
		
		
	 // GET THE POST ID 
		$post_id = esc_attr($postid);
		if($post_id == ""){ $post_id = $post->ID; $showWorldMap = false; }
		  
		// GET THE DAT
		if($sellspace == 1){
		$showWorldMap = false;	 
		$hits_data = unserialize(get_post_meta($postid,'impressions_array',true));		
		}else{
		$hits_data = get_post_meta($postid,'hits_array',true);
	 	}
	 
		if(!is_array($hits_data)){ if(is_admin() || $sellspace == 1 ){ return "<div class='novisitors'>No Visitor Data Recordered</div>"; }else{ return; } }
		
		//array_reverse($hits_data);
	 
		
		$country_a = array();
		foreach($hits_data as $date => $date_data){
			$totalhits = 0;
			// FIRST LOOP THROUGH ALL OF THE DATA AND GET THE COUNTRY + HITS
			foreach($date_data as $dd){
				$totalhits += $dd['hits'];
				if($dd['country'] == ""){ continue; }				
				if(!isset($country_a[$dd['country']])){ $country_a[$dd['country']] = 1; }else{ $country_a[$dd['country']]++; }		
			}
			
			$date_display = hook_date($date);
			$date_display = str_replace("12:00 am","",str_replace(", 2013","",str_replace(", 2014","",$date_display)));
			$DATASTRING .=  "['".trim($date_display)."',".count($date_data).", ".$totalhits."],";
			
			// LOOP COUNTRY
			foreach($country_a as $ck=>$kk){
			$MAPSTRING .=  "['".$ck."',  ".$kk."],";
			}
		}
		
		if(is_admin()){
		$txt1 = "Date";
		$txt2 = "Unique Visitors";
		$txt3 = "Visitors";
		$txt4 = "Visitor History";
		}else{
		$txt1 = __("Date","premiumpress");
		$txt2 = __("Unique Visitors","premiumpress");
		$txt3 = __("Visitors","premiumpress");
		$txt4 = __("Visitor History","premiumpress");	
		}
		
		// CREATE UNIQUE ID IF ITS SELLSPACE
		$drawID = "";
		if($sellspace == 1){
			$drawID = $postid;
		}
				
		// RETURN VALUE	
		$STRING .= '<script  src="https://www.google.com/jsapi"></script>
		<script >
		  
		  google.load("visualization", "1", {packages:["corechart"]});
		  google.setOnLoadCallback(drawChart'.$drawID.');
		  
		  function drawChart'.$drawID.'() {
			var data = google.visualization.arrayToDataTable([
			  [\''.$txt1.'\', \''.$txt2.'\', \''.$txt3.'\'],'.substr($DATASTRING,0,-1).']);
			var options = {title: \''.$txt4.'\',width:\'100%\',height:\'100%\'};
			var chart = new google.visualization.LineChart(document.getElementById(\'chart_div'.$postid.'\'));
			chart.draw(data, options);	
			
		  }  
	 
		jQuery(document).ready(function () {	
			jQuery(window).resize(function(){
				drawChart'.$drawID.'(); ';
				if($showWorldMap){
				$STRING .= 'drawRegionsMap();';
				}
				$STRING .= '});
		});
		</script><div id="chart_div'.$postid.'"></div>';
		
		
	 	if($showWorldMap){
		$STRING .= "<script type='text/javascript'>
		 google.load('visualization', '1', {'packages': ['geochart']});
		 google.setOnLoadCallback(drawRegionsMap);
		  function drawRegionsMap() {
			var data = google.visualization.arrayToDataTable([
			  ['Country', '".$txt2."'],".substr($MAPSTRING,0,-1)."]);
				var options = {
			  width:'100%',
			  height:'100%',
			};
			var chart = new google.visualization.GeoChart(document.getElementById('chart1_div".$postid."'));
			chart.draw(data, options);
		};	
	
		</script><div id='chart1_div".$postid."'></div>";
		}
		
		if($sellspace == 1){
		ob_start(); ?>
        
        <script>
		jQuery(document).ready(function(){ 
			 
				jQuery( ".graphtab" ).click(function() {
				 setTimeout(function(){ drawChart<?php echo $postid; ?>(); }, 500);  
				});
				
		});	
		</script> 
        <?php $STRING .= ob_get_clean(); 
		
		}
		
		
		return $STRING;  
	}	

	
	
	

}


?>