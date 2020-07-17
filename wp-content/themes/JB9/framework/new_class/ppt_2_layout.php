<?php

function _pptv9_after_wp_footer(){

?>
 
<script> var ajax_site_url = "<?php echo home_url(); ?>/"; </script>
<?php if(_ppt('currency_jquery') == '1'){  ?>
<script>

const formatter = new Intl.NumberFormat('<?php
if(_ppt(array('currency','code')) == "EUR"){ echo "it-IT"; }elseif(_ppt(array('currency','code')) == "JPY"){ echo "ja-JP"; }else{ echo "en-US"; } ?>', {
  style: 'currency',
  currencyDisplay: 'symbol',
  currency: '<?php echo _ppt(array('currency','code')); ?>',
  minimumFractionDigits: <?php if(is_numeric(_ppt(array('currency','dec')))){ echo _ppt(array('currency','dec')); }else{ echo 2; } ?>
});

jQuery(document).ready(function(){
	
	// LOOP AND REPLACE
	jQuery('.js_price').each(function(i, obj) {									  
		totalprice = parseFloat(jQuery(obj).html());									  
		jQuery(obj).html(formatter.format(totalprice));											 
	});

});
</script>

<?php if(strlen(get_option('custom_js')) > 10){ echo stripslashes(get_option('custom_js')); } ?>


<?php } ?>

<?php
}
function _pptv9_after_body_close(){



// NEW GOOGLE MAPS API KEY
	if(_ppt('googlemap_apikey') != "" ){
	?>
    <input type="hidden" value="<?php echo trim(stripslashes(_ppt('googlemap_apikey'))); ?>" id="newgooglemapsapikey" />
      
    
    <?php
	}

?>

<?php if(_ppt('google') == 1){ ?>
<!-- Location Modal -->
<div id="ajaxLocationModal" class="modal fade search-modal-wrapper" data-width="500" data-backdrop="static" data-keyboard="false" tabindex="-1" style="display: none;"></div>

<script>

	var $modal1 = jQuery('#ajaxLocationModal');

	jQuery(document).on('click', '.btn-ajax-location' ,function(){
		// create the backdrop and wait for next modal to be triggered
	  
		jQuery('body').modalmanager('loading');

		setTimeout(function(){
			 $modal1.load('<?php echo home_url(); ?>/?core_aj=1&action=locationform', '', function(){
				$modal1.modal();
				GMApMyLocation();
			});
		}, 1000);		
	});
 
</script> 
	<form method="post" action="#" name="mylocationsform" id="mylocationsform">
	<input type="hidden" name="updatemylocation" value="1" />
	<input type="hidden" name="log" value="" id="mylog" />
	<input type="hidden" name="lat" value="" id="mylat" />
	<input type="hidden" name="country" value="" id="myco" />
	<input type="hidden" name="zip" value="" id="myzip" />
    <input type="hidden" name="address" value="" id="myaddress" />
    </form>
<?php } ?>

<div id="core_footer_ajax"></div>
<!-- Quick View Modal -->
<div id="quickview" class="modal fade" tabindex="-1" role="dialog">
   <div class="modal-dialog">
      <div id="quickview-content"></div>
   </div>
</div>

<!-- end quick view modal -->
<noscript id="deferred-styles">
<?php ppt_footer_styles(); ?>
</noscript>

    <script>
      var loadDeferredStyles = function() {
        var addStylesNode = document.getElementById("deferred-styles");
        var replacement = document.createElement("div");
        replacement.innerHTML = addStylesNode.textContent;
        document.body.appendChild(replacement)
        addStylesNode.parentElement.removeChild(addStylesNode);
      };
      var raf = requestAnimationFrame || mozRequestAnimationFrame ||
          webkitRequestAnimationFrame || msRequestAnimationFrame;
      if (raf) raf(function() { window.setTimeout(loadDeferredStyles, 0); });
      else window.addEventListener('load', loadDeferredStyles);
    </script>
<?php

}

function _pptv9_before_inner_body_close(){ global $settings;

echo "<footer>";
	
	if(defined('NOHEADERFOOTER')){
	
		// DO NOTHING
		
	}elseif(_ppt(array('pageassign','footer')) != "" && _ppt(array('pageassign','footer')) != "0" ){
	
	 
		if( substr(_ppt(array('pageassign','footer')),0,9) == "elementor"){
		echo do_shortcode( "[premiumpress_elementor_template id='".substr(_ppt(array('pageassign','footer')),10,100)."']");
		}else{
		$thispage = get_page( _ppt(array('pageassign','footer'))  );
		echo do_shortcode( $thispage->post_content );
		}
		
	}elseif ( ! function_exists( 'elementor_theme_do_location' ) || ! elementor_theme_do_location( 'footer' ) ) {
	
				
   				$settings = array('class' => _ppt('footer_bg') ); 
				 	 
				switch(_ppt('footer_blockstyle')){
						
						case "0": {
						get_template_part( 'footer', 'menu' ); 
						} break;
						case "1": {
						get_template_part('framework/elementor/_footer/footer-top1'); 
						} break;
						case "2": {	
						get_template_part('framework/elementor/_footer/footer-top2');	
						} break;
						case "3": {	
						get_template_part('framework/elementor/_footer/footer-top3');	
						} break;
						case "4": {	
						get_template_part('framework/elementor/_footer/footer-top4');	
						} break;
						case "5": {	
						get_template_part('framework/elementor/_footer/footer-top5');	
						} break;
						default: {
						get_template_part( 'footer', 'menu' ); 
						} break;
										 
				}
			 
				// DEFAULT CHILD THEME NOT SELECTED
				if(_ppt('footer_blockstyle') != 0){
				
					$settings = array('class' => _ppt('footer_bg')." border-top" );
										
					switch(_ppt('footer_style')){
						
						case "0": {	
						get_template_part('framework/elementor/_footer/footer-basic');	
						} break;
						case "1": {
						get_template_part('framework/elementor/_footer/footer-center'); 
						} break;
						case "2": {	
						get_template_part('framework/elementor/_footer/footer-basic');	
						} break;
						case "3": {	
						get_template_part('framework/elementor/_footer/footer-cards');	
						} break;
					  
					}
				
				}
		
	}
	
	echo "</footer>";
	
	// GOOGLE ANALYTICS
	if(_ppt('google_tracking') == '1'){
		ob_start();
		?>
		<script>
		  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
		  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
		  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
		  })(window,document,'script','//www.google-analytics.com/analytics.js','ga');
		
		  ga('create', '<?php echo stripslashes(_ppt('google_trackingcode')); ?>', 'auto');
		  ga('send', 'pageview');
		
		</script>
		<?php
		echo ob_get_clean(); 
	} 
}

/*
used in the header to create custom
header layouts 
*/
function _pptv9_after_inner_body_open(){ global $settings;



  	
	echo "<header>";  		
		   
		 if(defined('NOHEADERFOOTER')){
	
		// DO NOTHING		
		}elseif(_ppt(array('pageassign','header')) != "" && _ppt(array('pageassign','header')) != "0"){ 
		
			if(is_front_page() &&_ppt('header_hometransparent') == 1){
		 	
			get_template_part('framework/elementor/_header/header-transparent'); 
			
			}elseif( substr(_ppt(array('pageassign','header')),0,9) == "elementor"){
			echo do_shortcode( "[premiumpress_elementor_template id='".substr(_ppt(array('pageassign','header')),10,100)."']");
			}else{
			$thispage = get_page( _ppt(array('pageassign','header'))  );
			echo do_shortcode( $thispage->post_content );
			}
	
		 }elseif ( ! function_exists( 'elementor_theme_do_location' ) || ! elementor_theme_do_location( 'header' ) ) {
		 
 			
		   // SHOW TOP NAV IF CHILD THEME IS NOT SET AS DESIGN
		   if(_ppt('header_topnav') == 1 && _ppt('header_style') != "0"){
		     
				// SHOE HOMEPAGE
				if(is_front_page() || isset($GLOBALS['flag-home']) ){
					if(_ppt('header_topnavhome') == 1){
						$canShow = true;
						}else{
						$canShow = false; 
						}
				}else{
					$canShow = true;
				}
			 
				if($canShow){
				
					$settings = array('class' => _ppt('header_topnavbg') );	
						 	
					if(_ppt('header_topnavstyle') == ""){ 
						$ts = "header-top2"; 				
					}elseif(is_numeric(_ppt('header_topnavstyle'))){
						$ts = "header-top"._ppt('header_topnavstyle');
					}else{ 
						$ts = _ppt('header_topnavstyle'); 
					}
			 		
				get_template_part('framework/elementor/_header/'.$ts); 	
			   }	   
		   }
   
   
 		   if( ( is_front_page() || isset($GLOBALS['flag-home']) ) && ( _ppt('header_hometransparent') == 1 || isset($GLOBALS['flag-home-transparent']) ) ){
		   
		   get_template_part('framework/elementor/_header/header-transparent'); 
		   
		   }else{
		   
			switch(_ppt('header_style')){
				
				case "1": {
				get_template_part('framework/elementor/_header/header-classic'); 
				} break;
				case "2": {	
				get_template_part('framework/elementor/_header/header-transparent'); 	
				} break;
				case "3": {					
				get_template_part('framework/elementor/_header/header-magazine'); 	
				} break;
				case "4": {	
				get_template_part('framework/elementor/_header/header-search'); 	
				} break;
				case "5": {	
				get_template_part('framework/elementor/_header/header-searchextra'); 	
				} break;		
				case "6": {	
				get_template_part('framework/elementor/_header/header-searchlogin'); 	
				} break;
				case "7": {	
				get_template_part('framework/elementor/_header/header-searchicons'); 	
				} break;
				case "8": {	
				get_template_part('framework/elementor/_header/header-center'); 	
				} break;
				case "9": {	
				get_template_part('framework/elementor/_header/header-simple'); 	
				} break;
				case "10": {	
				get_template_part('framework/elementor/_header/header-creative'); 	
				} break;
				case "11": {	
				get_template_part('framework/elementor/_header/header-creativeright'); 	
				} break;
				default: {				
					get_template_part( 'header', 'menu' );				
				}			
			}
			
			} // end transparent
		 
			
		 }
	
	echo "</header>";
		 
		 // BREADCRUMBS		 
		if( _ppt('breadcrumbs') == 1 && (
		
		
		
		!defined('NOHEADERFOOTER') && !is_front_page() && !is_search() && !isset($GLOBALS['flag-account']) && !isset($GLOBALS['flag-home']) && !isset($GLOBALS['flag-nobreadcrumbs']) && !isset($GLOBALS['flag-search'])  && !isset($GLOBALS['flag-add']) && !is_singular(array('listing_type','post')) && $GLOBALS['pagenow'] != 'wp-login.php' )  ){ 
		
			if(_ppt(array('pageassign','breadcrumbs')) != "" && _ppt(array('pageassign','breadcrumbs')) != "0"){ 
		
				if( substr(_ppt(array('pageassign','breadcrumbs')),0,9) == "elementor"){
				echo do_shortcode( "[premiumpress_elementor_template id='".substr(_ppt(array('pageassign','breadcrumbs')),10,100)."']");
				}else{
				$thispage = get_page( _ppt(array('pageassign','breadcrumbs'))  );
				echo do_shortcode( $thispage->post_content );
				}
	
			}else{
			
			
				switch(_ppt('breadcrumbs_style')){
				
					 
					case "2": {	
					get_template_part('framework/elementor/_header/header-bread2'); 	
					} break;
					case "3": {	
					get_template_part('framework/elementor/_header/header-bread3'); 	
					} break;
					
					default: {
					
						get_template_part('framework/elementor/_header/header-bread1'); 
					
					}
				}
			 
			}
		
		}
 

}


class PremiumPress_Elementor_Importer {


	function process_export_import_content( $content, $method ) {
	
	
		$d = \Elementor\plugin::$instance->db->iterate_data(
			$content, function( $element_data ) use ( $method ) {
			
				$element = \Elementor\plugin::$instance->elements_manager->create_element_instance( $element_data );

				// If the widget/element isn't exist, like a plugin that creates a widget but deactivated
				if ( ! $element ) {
					return null;
				}

				return $this->process_element_export_import_content( $element, $method );
			}
		);
		 ;
		return $d;
	}
	 
	function process_element_export_import_content( $element, $method ) {
		$element_data = $element->get_data();

		if ( method_exists( $element, $method ) ) {
			// TODO: Use the internal element data without parameters.
			$element_data = $element->{$method}( $element_data );
		}

		foreach ( $element->get_controls() as $control ) {
			$control_class = \Elementor\plugin::$instance->controls_manager->get_control( $control['type'] );

			// If the control isn't exist, like a plugin that creates the control but deactivated.
			if ( ! $control_class ) {
				return $element_data;
			}

			if ( method_exists( $control_class, $method ) ) {
				$element_data['settings'][ $control['name'] ] = $control_class->{$method}( $element->get_settings( $control['name'] ), $control );
			}

			// On Export, check if the control has an argument 'export' => false.
			if ( 'on_export' === $method && isset( $control['export'] ) && false === $control['export'] ) {
				unset( $element_data['settings'][ $control['name'] ] );
			}
		}

		return $element_data;
	}
	
	public function removeMy(&$element, $index){
	
	if(!defined('CHILD_THEME_PATH_IMG')){
	define('CHILD_THEME_PATH_IMG','');
	}
			    
		 $element = 
		 str_replace('[link-add]', _ppt(array('links','add')),
		 str_replace('[link-login]', wp_login_url(), 
		 str_replace('[link-register]', wp_registration_url(), 
		 str_replace('[link-myaccount]', _ppt(array('links','myaccount')), 
		 str_replace('[link-aboutus]', _ppt(array('links','about')), 
		 str_replace('[link-contact]', _ppt(array('links','contact')),
		 str_replace('[link-search]', home_url()."/?s=",
		 str_replace('[path-images]', addslashes(CHILD_THEME_PATH_IMG), $element ) ) ) ) ) ) ) );		 
	}

    public function import_elementor_file( $file, $title) {
 	 
		$data = json_decode( file_get_contents( $file ), true );
		
		 
		if ( empty( $data ) ) {
			return new \WP_Error( 'file_error', 'Invalid File. Data cannot be read.' );
		}
		
		$content = $data['content'];
		
		// REPLACE {IMAGE} WITH CHILD THEME PATH
		array_walk_recursive($content, array($this, "removeMy" ) );
 
		
		if ( ! is_array( $content ) ) {
			return new \WP_Error( 'file_error', 'Invalid File. No contents.' );
		}
		  
		$content = $this->process_export_import_content( $content, 'on_import' );
	 	
        // Import the data
        return $this->import_data( $content, $title );

    }
    private function import_data( $data, $title ) {	 
		 		 
		$local = \Elementor\plugin::instance()->templates_manager->save_template( [
		'post_id' => 1,
		'source' => 'local',		
		'content' => json_encode($data , true),
		'type' => 'page',
		//'page_settings' => json_encode($data1->page_settings),
		] );
	 
		 
		// NOW UPDATE NAME OF TEMPLATE ETC USINF $local['template_id']		
		 $my_post = array(
			  'ID'           => $local['template_id'],
			  'post_title'   => $title,
		  );
		
		// Update the post into the database
		 wp_update_post( $my_post );
		 
		 
		 //$page_settings_data = \Elementor\plugin::process_element_export_import_content( array('id' => $local['template_id'], 'settings' => 'default' ), 'on_import' );
		 //die(print_r($page_settings_data);
		  
		 // SET PAGE TEMPLATE CANVUS		 
		 update_post_meta($local['template_id'], '_wp_page_template', 'elementor_canvas');
				
		 return $local['template_id'];
	 
    }

}

class framework_layout extends framework_functions {


function style_header($default, $settings){ global $settings;

	// GET SETTINGS
	$headerstyle = _ppt('headerstyle');
	
	if(is_array($headerstyle) && _ppt('allow_headerstyles') == 1 ){
	 
		if(isset($headerstyle['top']) && $headerstyle['top'] != "0"){
		
			// ADD-ON CSS
			if(isset($headerstyle['topclass'])){
			$settings['class'] = $headerstyle['topclass'];
			}
			  
			get_template_part(  'framework/elementor/_header/'.$headerstyle['top']);
		
		}
		
		if(isset($headerstyle['main']) && $headerstyle['main'] != "0"){
		
			// ADD-ON CSS
			if(isset($headerstyle['mainclass'])){
			$settings['class'] = $headerstyle['mainclass'];
			}
			
			get_template_part(  'framework/elementor/_header/'.$headerstyle['main']);
		
		}
		
		if(isset($headerstyle['menu']) && $headerstyle['menu'] != "0"){
			
			
			// ADD-ON CSS
			if(isset($headerstyle['menuclass'])){
			$settings['class'] = $headerstyle['menuclass'];
			}
			
			get_template_part(  'framework/elementor/_header/'.$headerstyle['menu']);		
		}
	
	
	}else{
	 
	get_template_part( $default );
	
	} 

}

function style_footer($default, $settings){ global $settings;

	// GET SETTINGS
	$footerstyle = _ppt('footerstyle');
	
	if(is_array($footerstyle) && _ppt('allow_footerstyles') == 1 ){
	 
		if(isset($footerstyle['top']) && $footerstyle['top'] != "0"){
		
			// ADD-ON CSS
			if(isset($footerstyle['topclass'])){
			$settings['class'] = $footerstyle['topclass'];
			}
			  
			get_template_part(  'framework/elementor/_footer/'.$footerstyle['top'] );
		
		}
		
		if(isset($footerstyle['bot']) && $footerstyle['bot'] != "0"){
		
			// ADD-ON CSS
			if(isset($footerstyle['botclass'])){
			$settings['class'] = $footerstyle['botclass'];
			}
			
			get_template_part(  'framework/elementor/_footer/'.$footerstyle['bot'] );
		
		}
		 
	
	
	}else{
	 
	get_template_part( $default );
	
	} 

}
 

/*
	this function performs the rating
	for newly added comments
*/


function delete_comment_extra( $comment_id ){
    //$filter = current_filter();
		
		// GET META
		$update_postid = get_comment_meta($comment_id, 'ratingpid', true);
		
		if(is_numeric($update_postid)){
		
			$vv = get_post_meta( $update_postid, 'starrating_votes', true);
			$vv = $vv -1;
			update_post_meta($update_postid, 'starrating_votes', $vv);
			
			// DELETE ALL
			delete_comment_meta( $commentid, 'ratingpid', '' ); 
		 
		}
		
		return $comment_id;
  
 }

function insert_comment_extra($commentid) { global $post;

 		 
		if(isset($_POST['score']) && is_numeric($_POST['score']) && is_numeric($_POST['comment_post_ID']) ){		
		
			$postid = $_POST['comment_post_ID'];  
		 	
			// SAVE STAR RATING VALUE
			$totalvotes = get_post_meta($postid, 'starrating_votes', true);
			$totalamount = get_post_meta($postid, 'starrating_total', true);
			
			if(!is_numeric($totalamount)){ $totalamount = $_POST['score']; }else{ $totalamount += $_POST['score']; }
			if(!is_numeric($totalvotes)){ $totalvotes = 1; }else{ $totalvotes++; }	
			 
			$save_rating = round(($totalamount/$totalvotes),2);
			update_post_meta($postid, 'starrating', $save_rating);
			update_post_meta($postid, 'starrating_total', $totalamount);
			update_post_meta($postid, 'starrating_votes', $totalvotes);
			
			// SAVE COMMEN META INCASE WE DELETE IT
			add_comment_meta( $commentid, 'ratingpid', $postid );				
			add_comment_meta( $commentid, 'ratingtotal', $score );
			add_comment_meta( $commentid, 'rating1', $_POST['score'] );
		 
						
		}
			
		if(isset($_POST['rating1']) && is_numeric($_POST['rating1']) && is_numeric($_POST['comment_post_ID']) ){	
		 
		 	$postid = $_POST['comment_post_ID'];  
		 	
			// SAVE STAR RATING VALUE
			$totalvotes = get_post_meta($postid, 'starrating_votes', true);
			$totalamount = get_post_meta($postid, 'starrating_total', true);
			
			
			// ADD UP ALL THE STARS
			// DEVIDE THEM BY 5
			// MULTIPLY BY 100
			
			$score = round( ( $_POST['rating1']+$_POST['rating2']+$_POST['rating3']+$_POST['rating4'] ) / 4 ,2);
			  
			if(!is_numeric($totalamount)){ $totalamount = $score; }else{ $totalamount += $score; }
			if(!is_numeric($totalvotes)){ $totalvotes = 1; }else{ $totalvotes++; }	
			 
			$save_rating = round(($totalamount/$totalvotes),2);
			update_post_meta($postid, 'starrating', $save_rating);
			update_post_meta($postid, 'starrating_total', $totalamount);
			update_post_meta($postid, 'starrating_votes', $totalvotes);
			
			// SAVE COMMEN META INCASE WE DELETE IT
			add_comment_meta( $commentid, 'ratingpid', $postid );				
			add_comment_meta( $commentid, 'ratingtotal', $score );
			add_comment_meta( $commentid, 'rating1', $_POST['rating1'] );
			add_comment_meta( $commentid, 'rating2', $_POST['rating2'] );
			add_comment_meta( $commentid, 'rating3', $_POST['rating3'] );
			add_comment_meta( $commentid, 'rating4', $_POST['rating4'] );	
			
					
		}
}
/*
	this function redirects the user
	after they have submitted a comment
*/
function redirect_after_comment($location){
		$newurl = substr($location, 0, strpos($location, "#comment"));
		return $newurl . '?newcomment=1';
}
/*
	this function processed the comment
	form
*/
function _preprocess_comment( $comment_data ) { global $CORE, $userdata, $post, $comment;	 
		 
		// BASIC FORM VALIDATION
		if(!is_admin() && !isset($_POST['nocaptcha'])){
		
		 	$canContinue = true;
			if(_ppt('comment_captcha') == 1 && _ppt('google_recap_sitekey') != "" ){		 	
				$canContinue = google_validate_recaptcha();		 
			}elseif(_ppt('comment_captcha') == 1){
				if( !isset($_POST['reg1']) ||  ( isset($_POST['reg1']) && ( $_POST['reg1'] + $_POST['reg2'] ) != $_POST['reg_val'] ) ){		
				$canContinue = false;
				}
			}
			
			if(!$canContinue){
			wp_die( __("The verification code was invalid. Press back and try again.","premiumpress") );
			}
		} 
		
		// RETURN COMMENT DATA
		return $comment_data;
}
 
 

	/* ========================================================================
	 CORE BODY CSS TAGS
	========================================================================== */ 
	function BODYCLASS($classes){
	
		global $wpdb, $post, $pagenow; $c = ""; $extra = "";
	 
		if($pagenow == "wp-login.php"){
		$classes[] = "ppt_login";
		}  	
		
		if( ( !defined('WLT_DEMOMODE') && _ppt('page_layout') == 1 ) || (defined('WLT_DEMOMODE') && isset($GLOBALS['CORE_THEME']['page_layout']) && $GLOBALS['CORE_THEME']['page_layout'] ==1 ) ){ 
		$classes[] = "boxed";
		}
		
		
		
		if(defined('WLT_DEMOMODE')){
		$classes[] = "demomode";
		}
 		
		if(isset($_GET['mapsearch'])){ 
		$classes[] = "mapsearch";		
		}	
		
		if(isset($GLOBALS['flag-home'])){ 
		$classes[] = "home";		
		}	
		
		if(isset($GLOBALS['flag-search'])){ 
		$classes[] = "search";		
		}
		
		if(defined('PPTCOL-LEFT') ){ 
		$classes[] = "sidebar-left";		
		}else{
		$classes[] = "sidebar-right";
		}
		 
		$classes[] = "theme-".THEME_KEY;		
		 
		
		return $classes;	
	}
	
/* ========================================================================
 CORE BODY COLUMN LAYOUTS
========================================================================== */ 
function BODYCOLUMNS(){ global $post;return;}
function CSS($tag,$return=false){}

/* =============================================================================
	PAGE TITLE ADJUSTMENTS
========================================================================== */

function TITLE( $title, $sep = "" ) {
	global $paged, $page, $CORE; $extra = "";
	
	// HOME PAGE OBJECTS
	if(isset($_GET['home_paged'])){
		$extra .= " | ".__("Page","premiumpress")." ".$_GET['home_paged'];
	}
 
    return $title.$extra;
}

/* =============================================================================
	 LOGO // CREATE WEBSITE LOGO  // TEXT OR IMAGE
	========================================================================== */
function Logo($data = ""){
 
		// DEFAULTS
		$lightVersion = false;
		$linkOnly = true;
		$logo = "";
		
		if(is_array($data)){
			$linkOnly 	= $data[0];
			$lightVersion = $data[1];
		}elseif(is_numeric($data)){
			$linkOnly = $data;
		}else{
			return;
		}
		
		if(defined('WLT_DEMOMODE') && isset($GLOBALS['flag-home-transparent']) ){
		
		$logo = $GLOBALS['CORE_THEME']['light_logo_url'];
	 
		}elseif(defined('WLT_DEMOMODE') && isset($_SESSION['skin']) && strlen($_SESSION['skin']) > 1){
		
		$logo = home_url()."/wp-content/themes/childtheme_".$_SESSION['skin']."/img/logo.png";
		 		 
		}else{
		
			// LOGO DATA
			if($lightVersion){
			$logo = _ppt('light_logo_url');
			
				if($logo == ""){
				$logo = _ppt('logo_url');
				}
				
			}else{
			$logo = _ppt('logo_url');
			}
		
		}
		
		
		
		
		if($logo == ""){
		return "";
		}
		
		// LINK ONLY
		if(isset($linkOnly) && $linkOnly == 1){
		return $logo;
		}
		
		
		// FULL PATH
		return "<img src='".$logo."' alt='logo' class='img-fluid' />";	
		
		//if(defined('WLT_DEMOMODE')){
 
}	
	
	/* =============================================================================
		GLOBAL ERROR CLASS
	========================================================================== */
	function ERRORCLASS($msg="",$type=""){
	$STRING = "";
	 
	if(( isset($GLOBALS['error_message']) || strlen($msg) > 1 ) && ( !isset($GLOBALS['error_message_set']) ) ){
	
		if(strlen($msg) > 1){ $error_message = $msg; }else{ $error_message = $GLOBALS['error_message']; }
		if(strlen($type) > 1){ $error_type = $type; }else{ if(!isset($GLOBALS['error_type'])){ $error_type = "success"; }else{ $error_type = $GLOBALS['error_type']; } }
		
		$STRING = '<div class="alert alert-'.$error_type.'">
		  <button type="button" class="close" data-dismiss="alert">x</button>
		  '.$error_message.'
		</div>';
		
		$GLOBALS['error_message_set'] = 1;
	}
	return $STRING;
	}
	
	
	/* =============================================================================
		  IS FLUID LAYOUT
		========================================================================== */
	 
	function homeCotent($key1, $key2, $exta = ""){ global $CORE;	 
		
		
		if(defined('WLT_DEMOMODE')){
			// CHECK FOR DEFAULT VALUES
			$homedata = hook_admin_2_homeedit(array());			
			if(!empty($homedata) && isset($homedata[$key1]['data'][$key2]['d'])){			
				return $homedata[$key1]['data'][$key2]['d'];			
			}		
		}
		
		$lang = $CORE->_language_current(1);
		
		$lang = "en_us";
		
	 	$HDATA = _ppt('hdata_'.$lang);
		   
		if(substr($key2,-4) == "_aid"){
				 
			if($exta == "post_title"){
				return get_the_title($HDATA[$key1][$key2]);
			}
				
		}elseif(isset($HDATA[$key1][$key2]) && $HDATA[$key1][$key2] != ""){ 
		
				return stripslashes($HDATA[$key1][$key2]); 
				
		}else{
		
			// CHECK FOR DEFAULT VALUES
			$homedata = hook_admin_2_homeedit(array());
			
			if(!empty($homedata) && isset($homedata[$key1]['data'][$key2]['d'])){
			
				return $homedata[$key1]['data'][$key2]['d'];
			
			}else{
			
				return;
			
			}
		}
	
	return;
	
	} 

	
	
	



 





function hook_sidebar_bottom(){ global $CORE;
	echo $CORE->BANNER('sidebar_right_bottom'); 
}
function hook_sidebar_bottom1(){ global $CORE;
	echo $CORE->BANNER('sidebar_left_bottom'); 
}
function hook_map_display(){ global $CORE;

if( isset($GLOBALS['CORE_THEME']['display_search_map'] ) && $GLOBALS['CORE_THEME']['display_search_map']  == "2" ){ 

echo $this->wlt_googlemap_html(false);  

}

echo $CORE->BANNER('sidebar_right_top'); 

}

function hook_map_display1(){ global $CORE;
 
if( isset($GLOBALS['CORE_THEME']['display_search_map'] ) && $GLOBALS['CORE_THEME']['display_search_map']  == "1" ){ 

echo $this->wlt_googlemap_html(false);  

}

echo $CORE->BANNER('sidebar_left_top'); 


}

 
	
function login_form(){ if(isset($_GET['redirect']) || isset($_GET['redirect_to']) ){ ?>
 <input type="hidden" name="redirect_to" value="<?php if(isset($_GET['redirect'])){  echo esc_attr($_GET['redirect']); }elseif(isset($_GET['redirect_to'])){  echo esc_attr($_GET['redirect_to']); }else{ echo $GLOBALS['CORE_THEME']['links']['myaccount']; } ?>" />
<?php    
} }
 
 
 
function _hook_callback_success(){ global $payment_data;

   $gc = stripslashes(get_option('google_conversion'));
   
   if(isset($payment_data['orderid'])){        
   echo str_replace("[orderid]",$payment_data['orderid'], $gc ); 
   }
   
   if(isset($payment_data['description'])){
   $gc = str_replace("[description]",$payment_data['description'], $gc);
   }
   
   if(isset($payment_data['total'])){
   $gc = str_replace("[total]",$payment_data['total'], $gc);
   }
   
   echo $gc;	
	
}
function image_avatar($avatar, $id_or_email, $size, $default){ global $wpdb;
	 
	 	// GET USERID
		if(is_object($id_or_email)){
			if(isset($id_or_email->ID))
				$id_or_email = $id_or_email->ID;
			//Comment
			else if($id_or_email->user_id)
				$id_or_email = $id_or_email->user_id;
			else if($id_or_email->comment_author_email)
				$id_or_email = $id_or_email->comment_author_email;
		}
		
		$userid = false;
		if(is_numeric($id_or_email))
			$userid = (int)$id_or_email;
		else if(is_string($id_or_email))
			$userid = (int)$wpdb->get_var("SELECT ID FROM $wpdb->users WHERE user_email = '" . esc_sql($id_or_email) . "'");
		
		// FALLBACK IF NOT AVATAR
		if(!$userid){ return $avatar; }
		
		// CHECK IF ISSET
		$userphoto = get_user_meta($userid,'userphoto',true);
		 
		if(is_array($userphoto) && isset($userphoto['path'])){
			return "<img src='".$userphoto['img']."' class='avatar img-fluid userphoto' alt='image' />";
		}else{
			return str_replace('avatar ','avatar img-fluid userphoto ',$avatar);
		}
}
 
 	
function _hook_single1(){ $GLOBALS['flag_single_content'] = true; }
function _hook_single2(){ unset($GLOBALS['flag_single_content']); }
function _facebookmeta(){ global $post, $CORE;  if($post->post_excerpt == ""){ $exce = $post->post_content; }else{ $exce = $post->post_excerpt; } ?>


<meta property="og:url" content="<?php echo get_permalink($post->ID); ?>" />
<meta property="og:type" content="article" />
<meta property="og:title" content="<?php echo esc_html(strip_tags($post->post_title)); ?>" />
<meta property="og:description" content="<?php echo substr(esc_html(strip_tags($exce)),0,255); ?>" />
<meta property="og:image" content="<?php echo $CORE->GETIMAGE($post->ID, false, array('pathonly' => true) ); ?>" />
<meta property="og:image:width" content="700" />
<meta property="og:image:height" content="700" />
<?php }
function _facebookmeta_cat(){ global $post, $CORE;   $term = get_term_by('slug', get_query_var( 'term' ), get_query_var( 'taxonomy' ) ); 
	
	// RETURN IF NOT FOUND
	if(!isset($term->term_id)){ return; } 
	
	// CHECK FOR IMAGE
	if( isset($term->term_id) && isset($GLOBALS['CORE_THEME']['category_icon_'.$term->term_id]) ){
	
	$image = str_replace("&", "&amp;",$GLOBALS['CORE_THEME']['category_icon_'.$term->term_id]);
 	
	 ?>
	<meta property="og:url" content="<?php echo 'http://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI']; ?>" />
    <meta property="og:type" content="article" />
	<meta property="og:title" content="<?php echo esc_html($term->name); ?>" />
	<meta property="og:description" content="<?php echo substr(esc_html(strip_tags($term->description)),0,255); ?>" />
	<meta property="og:image" content="<?php echo $image; ?>" />	
	<?php } ?>

<?php }
function handle_post_type_template($single_template) { global $post, $userdata, $CORE, $FRAMEWORK;

	
	// CHECK PAGE ACCESS
	_ppt_pageaccess();


	
	/*
		Check if the admin has setup global page access
		and if so check we can access this page
			
	*/	
 
	if($userdata->ID && ( $post->post_author == $userdata->ID ) ){
	 
	}else{
 
	$access = _ppt('listingaccess'); 
	 
	if($access != "" && ( !current_user_can('editor') || !current_user_can('administrator')  ) ){	
		if($access == 1){
		
			$CORE->Authorize();
		
		}elseif($access == "subs"){ // any subscription thats active
			
			$f = get_user_meta($userdata->ID, 'wlt_subscription',true);			 
			if($userdata->ID && is_array($f)){	
					 		
				$da = $CORE->date_timediff($f['date_expires'],'');
				if($da['expired'] == 0){				  
				}else{				
				
					header("location: "._ppt('listingaccess_redirect') );
					exit();
				}
				
			}else{
				
				if($userdata->ID){
				header("location: "._ppt('listingaccess_redirect') );
				exit();
				}else{
				// NOT A MEMBER OR NOT LOGGED IN
				header("location: ".site_url('wp-login.php?action=login', 'login_post')."&redirect=".get_permalink($post->ID));
				exit();	
				}		
			}
		
		}else{ // unique subscription
		
			$f = get_user_meta($userdata->ID, 'wlt_subscription',true);			 
			if($userdata->ID && is_array($f)){
				$da = $CORE->date_timediff($f['date_expires'],'');
				if($da['expired'] == 0 && $f['key'] == $access){				  
				}else{				
			 
					header("location: "._ppt('listingaccess_redirect') );
					exit();
				}
							
			}else{
				// NOT A MEMBER OR NOT LOGGED IN
				header("location: ".site_url('wp-login.php?action=login', 'login_post')."&redirect=".get_permalink($post->ID));
				exit();			
			}
		}
		
		// end if	
		
	}// end access
	
	}
	
	 
  if ($post->post_type == THEME_TAXONOMY."_type") { 

		// SET FLAG
	 	$GLOBALS['flag-single'] = 1;
		
		// SINGLE PAGE FILTERS
		add_filter('hook_single_before', array($this, '_hook_single1') );
		add_filter('hook_single_after', array($this, '_hook_single2') );
		
		// ADD ON FACEBOOK META
		add_action('wp_head',  array($this, '_facebookmeta') ); 
 		
		
		// UPDATE VIEW COUNTER
		$CORE->user_hitcounter();
		
		// UPDATE VIEW COUNTER
		if(isset($userdata->ID) && $post->post_type == "listing_type"){
		$CORE->user_recentlyviewed($userdata->ID, $post->ID, false);
		 }
		 
		// CHECK FOR FORCED LOGIN
		if(isset($GLOBALS['CORE_THEME']['requirelogin']) && $GLOBALS['CORE_THEME']['requirelogin'] == 1){ $CORE->Authorize(); }
		
		// CHECK IF EXPIRED
		$CORE->expire_listing($post->ID);
	 
			
		// CHECK FOR TIMEOUT ACCESS
		$canWatch = $CORE->TIMEOUTACCESS($post->ID);
	
		
		// EXTRA FOR FEEDBACK
		if(isset($_GET['ftyou'])){
		
			$GLOBALS['error_type'] 		= "success"; //ok,warn,error,info
			$GLOBALS['error_message'] 	= __("Feedback Added Successfully.","premiumpress") ;
				
		}	
		
		
  		if(defined('IS_MOBILEVIEW')){
	 
		$single_template = str_replace("single-listing_type.php","_mobile/single-mobile.php", $single_template);	
		
		 
		}
			
     
	 }
	 
	 // ADD BOOTSTRAP img-fluid CODE
	 add_filter( 'the_content', array($this, '_make_images_responsive' ) );
	 
	 if(defined('IS_MOBILEVIEW')){ 
	 
	 return str_replace("single-post.php","_mobile/single-post-mobile.php",$single_template);
	 }
	 
	 
	 //RETURN	 
     return $single_template;  
}

function _make_images_responsive($content) {
  
  $content = str_replace("wp-image","img-fluid wp-image", $content);
  
  return $content;
}

function handle_home_template($template_dir) { 
    
	// SET FLAG
	$GLOBALS['flag-home'] = 1; 
	


	// MOBILE HOME PAGE
	if(defined('IS_MOBILEVIEW') && file_exists(str_replace("home.php","home-mobile.php",$template_dir))){	
	 
		return str_replace("home.php","/_mobile/home-mobile.php",$template_dir);	
	
	}elseif(defined('IS_MOBILEVIEW')){
	
		return TEMPLATEPATH."/_mobile/home-mobile.php";
	
	} 
 	
	//RETURN
	return $template_dir;
}
 
function handle_search_template($template_dir) { 
 
	// SETUP PAGE GLOBALS
	global $wp_query, $post, $CORE, $category;
	
	$GLOBALS['flag-search'] = 1;
	
	// ADD ON FACEBOOK META
	add_action('wp_head',  array($this, '_facebookmeta_cat') ); 
 	 
	// MOBILE VIEW
	if(defined('IS_MOBILEVIEW') && is_object($post) && $post->post_type == THEME_TAXONOMY."_type"){	 
			
		return THEME_PATH. "/_mobile/search-mobile.php";
		
	} 
 
 	// EXTRAS
	if(is_object($post) && $post->post_type == THEME_TAXONOMY."_type"){ 	 	 
		 	
		// EXTRA FOR LISTING CATEGORIES
		if($template_dir == ""){			
			$template_dir = THEME_PATH. "search.php";			
		} 
	
	}
		
	//RETURN
	return $template_dir;
}


function gallerypage_results_top(){ global $CORE, $post, $paged, $wp_query;

if(!defined('WLT_CART')){  
 		
	// GLOBALS
	$category = $wp_query->get_queried_object();
 
	if(isset($category->slug) && ( !isset($paged) || $paged < 2 ) ){ 
	 	
			$top_category_results_string = "";	 $top_category_results_string_e = ""; $i=0; $c=0;
			if(is_object($category)){ 
			$args = array(
			'post_type' => THEME_TAXONOMY.'_type',
				'posts_per_page' => '10',
				'orderby' => 'rand',
				'tax_query' => array(
					array(
						'taxonomy' => THEME_TAXONOMY,
						 'field' => 'id',
						 'terms' => array( $category->term_id ),
					)
				),
				'meta_query' => array(
				   array(
					   'key' => 'topcategory',
					   'value' => 'yes',				 
				   )
			   ),
			);
			
			$my_query = new WP_Query($args);
			
			 
			while ( $my_query->have_posts() ) {
				$my_query->the_post();
			 
				
				if($i%4){ $ff = ""; }else{ $ff = " butleft"; $i=1; }
				
					// CONTENT LISTING 
					$GLOBALS['item_class_size'] = 'col-md-4 catoplist';
						
					ob_start();							
					get_template_part( hook_theme_folder(array('content','listing')), 'listing' );
					echo "<style>.wlt_search_results .itemid".$post->ID." { display:none; } .wlt_search_results .catoplist.itemid".$post->ID."  { display:block; } .wlt_search_results .swaped .wlt_starrating { display:none; }</style>";
					$top_category_results_string .= ob_get_contents();
					ob_end_clean();
					
					unset($GLOBALS['item_class_size']);
				 
				
				if($c > 1){
				$top_category_results_string_e .='jQuery("#catoplist .wlt_search_results .item:gt('.$c.')").hide();';
				}
				$i++; $c++;
				 
			}
		}
		if(isset($top_category_results_string) && strlen($top_category_results_string) > 5){
		
   		// ECHO OUTPUT
		echo $top_category_results_string; 
		 
		
		if($c > 3 && isset($GLOBALS['CORE_THEME']['topofcategoryrotate']) && $GLOBALS['CORE_THEME']['topofcategoryrotate'] == 1 ){ ?>
            <script type="application/javascript">
            jQuery(document).ready(function() {
                var swapLast = function() {
                <?php echo $top_category_results_string_e; ?>
                    jQuery(".wlt_search_results .catoplist:last").delay(7000).slideUp('slow', function() {
                        jQuery(this).delay(5000).remove();
						jQuery(this).addClass('swaped');
                        jQuery(".wlt_search_results").delay(7000).prepend(jQuery(this));
                        jQuery(this).delay(7000).slideDown('slow', function() {
                            swapLast();
				 
                        });
                    });
                }
                
                swapLast();
            });
            </script>
            <?php } ?>
        <?php }
		}		

}// end defined WLT_CART 

}

function gallerypage_results_title($c){ global $CORE, $category, $wp_query;
 
	// EXTRASD FOR ZIPCODE SEARCHES
	$title_extra = "";
	if(isset($_GET['zipcode']) && strlen($_GET['zipcode']) > 2){
			$saved_searches = get_option('wlt_saved_zipcodes');
			
			
			if(isset($saved_searches[$_GET['zipcode']]['log'])){
			$longitude 	= $saved_searches[$_GET['zipcode']]['log'];
			}else{ $longitude =0; }
			
			if(isset($saved_searches[$_GET['zipcode']]['lat'])){
			$latitude 	= $saved_searches[$_GET['zipcode']]['lat'];
			}else{ $latitude =0; }			
		 
			$title_extra 	= "(". esc_html($_GET['zipcode']).") <span class='right' style='text-decoration:underline;font-size:16px;'><a href='https://www.google.com/maps/place/".$latitude.",".$longitude."/' rel='nofollow' target='_blank'>".$latitude.",".		$longitude."</a></span>";
		$GLOBALS['CORE_THEME']['default_gallery_map'] = 1;
	}elseif(isset($_GET['s'])){
			$title_extra = ": ".strip_tags($_GET['s']);
	}
		
	if(isset($category->name) && strlen($category->name) > 1){ 
			$c = $category->name; 
	}else{
			$c = __("Search Results","premiumpress")." ".$title_extra;
	} 
	 
return $c;
}
function handle_page_template($template_dir) { global $post, $userdata, $wp_query, $CORE;
 
	if ( is_page_template() ) {
		
		// EXTRAS FOR CALLBACK PAGE
		if(strpos($template_dir, "tpl-callback") !== false){
	  	
		// SET FLAG
		$GLOBALS['flag-callback'] = 1;
		
		// PAYMENT DATA GLOBAL
		global $payment_status, $payment_data;
	 
	 	// ADD HOOK FOR PAYPAL
		add_action('hook_callback','core_paypal_callback');
		add_action('hook_callback','core_usercredit_callback');
		add_action('hook_callback','core_token_callback');
		add_action('hook_callback','core_admin_test_callback');
		add_action('hook_callback','core_free_order_callback');
		 
		// GET PAYMENT RESPONSDE
		$payment_data = hook_callback($_POST);
	 	 
 		if(is_array($payment_data) ){
		$payment_status = "success";
		}else{
		$payment_status = "error";
		}
		
		// DESTROY CART SESSION		 
		unset($_SESSION['wlt_cart']); 
		// DELETE STORED SESSION COOKIE
		if (ini_get("session.use_cookies")) {
			$params = session_get_cookie_params();
			setcookie(session_name(), '', time() - 42000,
				$params["path"], $params["domain"],
				$params["secure"], $params["httponly"]
			);
		}
		
		// AUTO FOR FORCING PAYMENT SUCCESS
		if(isset($_GET['auth'])){ $payment_status = "success"; }		
		   
		// EMAIL OPTIONS
		if(isset($payment_status) && $payment_status != "" && is_array($payment_data) && !empty($payment_data) ){
		 
			switch($payment_status){
				case "thankyou":
				case "success": { 
				
				if(!defined('WLT_CART')){
				
			 		$sentAlready = get_user_meta($payment_data['user_id'],'email_sent_order_new_sccuess',true);
					 
					if( $sentAlready != date('Y-m-d H') ){	
					 
						// SEND EMAIL	
						$data = array(		
								"username" 		=> $payment_data['user_login_name'],	
								"description" 	=> $payment_data['order_description'],
								"order_id" 		=> $payment_data['order_id'],								
								"order_email" 	=> $payment_data['order_email'],								 
						); 
											
						$CORE->email_system($payment_data['user_id'], 'order_new_sccuess', $data);		
						$CORE->email_system('admin', 'admin_order_new', $data);	
											
						update_user_meta($payment_data['user_id'],'email_sent_order_new_sccuess', date('Y-m-d H') );												
					 
					}				
				} 
					
				
				} break;
				default: { 
					
					// SEND ORDER FAILED
					/*
					if(is_array($payment_data) && isset($payment_data['user_id']) ){
					
						$sentAlready = get_user_meta($payment_data['user_id'],'email_sent_order_new_failed',true);
						if( $sentAlready == "" ){					
						
							//$CORE->SENDEMAIL($payment_data['order_email'],'order_new_failed'); 
							update_user_meta($payment_data['user_id'],'email_sent_order_new_failed', date('Y-m-d H') );		
											
						}elseif(!defined('WLT_CART') && $sentAlready == date('Y-m-d H')){
						
						}else{
							//$CORE->SENDEMAIL($payment_data['order_email'],'order_new_failed'); 
							update_user_meta($payment_data['user_id'],'email_sent_order_new_failed', date('Y-m-d H') );
						}
					
					}
					*/ 
				 
				} break;
			   }
		 
			 
		}
		
 
			
		} // END IF CALLBACK
 
	}elseif(is_front_page() && defined('IS_MOBILEVIEW') && file_exists(str_replace("home.php","home-mobile.php",$template_dir)) ){
	
		$GLOBALS['flag-home'] = 1; 
	  		
		return TEMPLATEPATH."/_mobile/home-mobile.php";		
		 
	}else{
	 
		if(is_front_page() && $CORE->_language_current(1) != "en_us" && $CORE->_language_current(1) != ""){
			
			// CHECK FOR LANGUAGE TEMPLATE
			$lang = $CORE->_language_current(1);
			if(_ppt('home_link_'.$lang) != ""){
				header('location:'._ppt('home_link_'.$lang));
			}
		
		}else{
		
			// CHECK PAGE ACCESS
			_ppt_pageaccess();
		
		}
	    
		
		// SET FLAG
		$GLOBALS['flag-page'] = 1;
		 
 		// CHECK FOR PAGE WIDGET
		$GLOBALS['page_width'] 	= get_post_meta($post->ID, 'width', true);
		if($GLOBALS['page_width'] =="full"){ $GLOBALS['nosidebar-right'] = true; $GLOBALS['nosidebar-left'] = true; }
		 
	}
	
	//RETURN
	return $template_dir;
}
function handle_author_template($template_dir) { global $post,$userdata, $authorID, $listingcount, $wp_query, $CORE;
   
	// SET FLAG 
	$GLOBALS['flag-author'] = 1;
	
	if(isset($_POST['action']) && $_POST['action'] !=""){

		switch($_POST['action']){
		
			case "delfeedback": {	
			 
			$my_post 				= array();
			$my_post['ID'] 			= $_POST['fid'];
			$my_post['post_status'] = "draft";
			wp_update_post( $my_post );	
			
			$GLOBALS['error_message'] 	= "Feedback Deleted";				
			
			} break;
		
		}	
	} 
  
	// GET THE AUTHOR ID 
	if(isset($_GET['author']) && is_numeric($_GET['author'])){
	$authorID = $_GET['author'];
	}else{	
	$author = get_user_by( 'slug', get_query_var( 'author_name' ) );
	$authorID = $author->ID;
	}
 
	//RETURN
	return $template_dir;
}
	
	
	
	
/* =============================================================================
   BREADCRUMBS 
   ========================================================================== */		

function BREADCRUMBS($before = '', $after = '') {
 
 global $CORE, $post, $wp_query;
 
  $delimiter = ''; 
 
  $STRING = "";

    $homeLink = get_bloginfo('url');
    $STRING .= $before .' <a href="' . $homeLink . '" class="bchome breadcrumb-item">'.__('Home','premiumpress').'</a> ' . $delimiter . ' '. $after;
 	
	if ( is_category() ) {
 
      $cat_obj = $wp_query->get_queried_object();
      $thisCat = $cat_obj->term_id;
      $thisCat = get_category($thisCat);
      $parentCat = get_category($thisCat->parent);
	 
      if ($thisCat->parent != 0 && is_numeric($parentCat) ) $STRING .=(get_category_parents($parentCat, TRUE, ' ' . $delimiter . ' '));
	  
      $STRING .= $before . '<a href="'.$GLOBALS['CORE_THEME']['links']['blog'].'" class="breadcrumb-item">'.__("Blog","premiumpress").'</a>'.$after. ' '. $before.'<a href="#" class="breadcrumb-item">' . single_cat_title('', false) . '</a>' . $after;
 
    } elseif ( is_author() ) {
	
       global $author, $authorID;
      $userdata = get_userdata($author);
      $STRING .= $before . "<a href='#' rel='nofollow' class='breadcrumb-item'>".get_the_author_meta( 'display_name', $authorID)."</a>" . $after;
 
 
    } elseif ( is_day() ) {
      $STRING .= '<a href="' . get_year_link(get_the_time('Y')) . '" class="breadcrumb-item">' . get_the_time('Y') . '</a> ' . $delimiter . ' ';
      $STRING .= '<a href="' . get_month_link(get_the_time('Y'),get_the_time('m')) . '" class="breadcrumb-item">' . get_the_time('F') . '</a> ' . $delimiter . ' ';
      $STRING .= $before . get_the_time('d') . $after;
 
    } elseif ( is_month() ) {
      $STRING .= '<a href="' . get_year_link(get_the_time('Y')) . '" class="breadcrumb-item">' . get_the_time('Y') . '</a> ' . $delimiter . ' ';
      $STRING .= $before . get_the_time('F') . $after;
 
    } elseif ( is_year() ) {
      $STRING .= $before . get_the_time('Y') . $after;
 
    } elseif ( is_single() && !is_attachment() ) {
	
      if ( get_post_type() != 'post' ) {
	  // ADD IN FIRST CATEGORY TO THE BREADCRUMBS FOR USER TO RETURN TO
	    $term_list = wp_get_post_terms($post->ID, THEME_TAXONOMY, array("fields" => "all"));
		if(isset($term_list[0]->name)){
		 $STRING .=  $before ."<a href='".get_term_link($term_list[0]->slug, THEME_TAXONOMY)."' class='breadcrumb-item'>".$term_list[0]->name.'</a> '.$after;
		}

        //$post_type = get_post_type_object(get_post_type());
       // $slug = $post_type->rewrite;
       // $STRING .=  $delimiter . ' ';
       // $STRING .= $before . get_the_title() . $after;
      } else {
	  
        $cat = get_the_category();
		if(!empty($cat)){
		$cat = $cat[0];
		
		$STRING .= $before .'<a href="'._ppt(array('links','blog')).'"  class="breadcrumb-item">'.__("Blog","premiumpress").'</a>'. $after; 
		$STRING .= $before . "".str_replace("<a ","<a class='breadcrumb-item' ",get_category_parents($cat, TRUE, ''))."". $after;
        $STRING .= $before . "<a href='#' rel='nofollow' class='breadcrumb-item'>".get_the_title()."</a>" . $after;
		}
      }
 	
	} elseif (isset($_GET['s']) || isset($_GET['advanced_search']) ){
	
	$STRING .= $before . "<a href='#' rel='nofollow' class='breadcrumb-item'>".__('Search','premiumpress') ."</a>" . $after;//$post_type->labels->singular_name
	
    } elseif ( !is_single() && !is_page() && get_post_type() != 'post' && !is_404() ) {
	
	// CHECK IF ITS A CATEGORY FOR OUR CUSTOM POST TYPE	
	$category = $wp_query->get_queried_object();
	 
	
	 if(isset($category->taxonomy) && $category->taxonomy != THEME_TAXONOMY){

	  if(isset($category->term_taxonomy_id)){
			 $pterm = get_term_by('id', $category->term_id, $category->taxonomy);
			 $gg1 = get_term_link($pterm->slug, $category->taxonomy);
			 if( !is_wp_error( $gg1 ) ) {
			  $STRING .= $before . "<a href='".$gg1."' class='breadcrumb-item'>".str_replace("_"," ",str_replace("-"," ",$pterm->taxonomy)). "</a>". $before." <a href='".$gg1."' class='breadcrumb-item'>".$pterm->name ."</a>" . $after;
			 }		 
		 }
	 
	 }elseif(isset($category->name)){
	 
	 
		 $gg = get_term_link($category);
			 
		 if( !is_wp_error( $gg ) ) {		 
		 // CHECK FOR PARENT CATEGORY
		 if($category->parent != "0"){
			 $pterm = get_term_by('id', $category->parent, $category->taxonomy);
			 $gg1 = get_term_link($pterm->slug, $category->taxonomy);
			 if( !is_wp_error( $gg1 ) ) {
				 // CHECK FOR PARENT CATEGORY
				 if($pterm->parent != "0"){
					 $pterm2 = get_term_by('id', $pterm->parent, $pterm->taxonomy);
					 $gg2 = get_term_link($pterm2->slug, $pterm2->taxonomy);
					 if( !is_wp_error( $gg2 ) ) {
					 	$STRING .= $before . "<a href='".$gg2."' class='breadcrumb-item'>".$pterm2->name ."</a>" . $after;
					 }		 
				 }
			 
			  $STRING .= $before . "<a href='".$gg1."' class='breadcrumb-item'>".$pterm->name ."</a>" . $after;
			 }		 
		 }		 
	 	 $STRING .= $before . "<a href='".$gg."' class='breadcrumb-item'>".$category->name ."</a>" . $after;
		 }
	 }elseif(!isset($GLOBALS['flag-home'])){	
	 
		 $post_type = get_post_type_object(get_post_type());
		 
		 if(isset($post_type->labels->singular_name)){
		 $STRING .= $before ."<a href='#' class='breadcrumb-item'>".__("Category","premiumpress")."</a>" . $after; //$post_type->labels->singular_name
		 }
		 
	  }
 
    } elseif ( is_attachment() ) {
      $parent = get_post($post->post_parent);
      $cat = get_the_category($parent->ID); $cat = $cat[0];
	  
      //$STRING .= get_category_parents($cat, TRUE, ' ' . $delimiter . ' ');
      $STRING .= $before .'<a href="' . get_permalink($parent) . '" class="breadcrumb-item">' . $parent->post_title . '</a>'. $after;
	  
      $STRING .= $before . "<a href='#' class='breadcrumb-item'>".get_the_title()."</a>" . $after;
 
    } elseif ( is_page() && !$post->post_parent && !is_front_page()   ) {
      $STRING .= $before . "<a href='#' class='breadcrumb-item'>".get_the_title()."</a>" . $after;
 
    } elseif ( is_page() && $post->post_parent  && !is_front_page() ) {
      $parent_id  = $post->post_parent;
      $breadcrumbs = array();
      while ($parent_id) {
	  if(!is_object($parent_id)){
        $page = get_page($parent_id);
        $breadcrumbs[] = $before .'<a href="' . get_permalink($page->ID) . '" class="breadcrumb-item">' . get_the_title($page->ID) . '</a>'. $after;
        $parent_id  = $page->post_parent;
		}
      }
      $breadcrumbs = array_reverse($breadcrumbs);
      foreach ($breadcrumbs as $crumb){
		  $STRING .= $crumb . ' ' . $delimiter . '';
	  }
      $STRING .= $before ."<a href='#' class='breadcrumb-item'>" . get_the_title() . "</a>". $after;
 
    } elseif ( is_search() ) {
      $STRING .= $before . 'Search results for "' . get_search_query() . '"' . $after;
 
    } elseif ( is_tag() ) {
      $STRING .= $before . 'Posts tagged "' . single_tag_title('', false) . '"' . $after;
 

    } elseif ( is_404() ) {
      $STRING .= $before . "<a href='#' rel='nofollow' class='breadcrumb-item'>".'Error 404'.'</a>' . $after;
    }else{
	
	}
 
    if ( get_query_var('paged') ) {
      if ( is_category() || is_day() || is_month() || is_year() || is_search() || is_tag() || is_author() ) $STRING .= '  ';
      $STRING .= $before . "<a href='#' class='breadcrumb-item'>".__("Page","premiumpress") . ' ' . get_query_var('paged')."</a>". $after;
      if ( is_category() || is_day() || is_month() || is_year() || is_search() || is_tag() || is_author() ) $STRING .= ' ';
    }
  
  //}
  
  return $STRING;
}	
	 
	
}

?>