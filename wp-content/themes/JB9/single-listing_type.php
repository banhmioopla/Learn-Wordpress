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

global $CORE, $userdata, $post;

// CHECK FOR LOGIN FIRST
if(_ppt('requirelogin_listings') == '1'){ 
   $CORE->Authorize();
}

// + UPDATE LAST VIEWED
$pv = get_post_meta($post->ID,'pageviewed',true);
if($pv != ""){
update_post_meta($post->ID,'lastviewed', $pv);
}
update_post_meta($post->ID,'pageviewed',date("Y-m-d H:i:s"));


    

function _hook_captchahead(){
?>
<script src='https://www.google.com/recaptcha/api.js'></script>
<?php }
if(_ppt('comment_captcha') == 1 && _ppt('google_recap_sitekey') != ""){
add_action('wp_head','_hook_captchahead');
}

if(_ppt(array('pageassign','defaultlisting')) != "" && _ppt(array('pageassign','defaultlisting')) != "0"){
			
			$GLOBALS['flag-nobreadcrumbs'] = 1;				
			
			get_header($CORE->pageswitch()); 
			
			// INCLUDE NORMAL ACCOUNT OPTIONS
			if($post->post_author == $userdata->ID){
			get_template_part('author', 'toolbox' );
			}
	
			if( substr(_ppt(array('pageassign','defaultlisting')),0,9) == "elementor"){
			echo do_shortcode( "[premiumpress_elementor_template id='".substr(_ppt(array('pageassign','defaultlisting')),10,100)."']");
			}else{
			$thispage = get_page( _ppt(array('pageassign','defaultlisting'))  );
			echo do_shortcode( $thispage->post_content );
			}
			get_footer($CORE->pageswitch());
	
	
}elseif(!_ppt_checkfile("single-listing.php")){



	
	function _pptv9_after_inner_body_open1(){ global $CORE, $settings;
	?>
<div id="mobile-submenu-content" style="display:none;"><div class="p-3 border-bottom">
<select class="form-control" id="mobile-submenu" onchange="selectWidgetBox(this.value)">
<option value="#widget-maindetails"><?php echo __("Show Description","premiumpress") ?></option>
</select>
</div></div>
       
	<?php
	}
	add_action('pptv9_after_inner_body_open','_pptv9_after_inner_body_open1');	

	
   // + DEFAULT SIDEBAR
   if(get_post_meta($post->ID,'pagecolumns',true) == ""){ define('PPTCOL', 1);  }
   
	// + GLOBAL TOP
	get_header($CORE->pageswitch()); 
	
	// INCLUDE NORMAL ACCOUNT OPTIONS
	if($post->post_author == $userdata->ID){
	get_template_part('author', 'toolbox' );
	}

   // + PAGE TOP
   get_template_part( 'page', 'top' ); ?>
   
   <?php if (have_posts()) : while (have_posts()) : the_post(); ?>

<?php 

if(in_array(THEME_KEY, array('dt'))){

 get_template_part( 'widgets/widget-single', 'title' );
 
}elseif(in_array(THEME_KEY, array('cm'))){

 get_template_part( 'widgets/widget-single', 'title-2' );
 
}
 
if(in_array(THEME_KEY, array('vt'))){
			
get_template_part( 'widgets/widget-single', 'video' ); 
			
}elseif(!in_array(THEME_KEY, array('dt','cp','cm'))){

get_template_part( 'widgets/widget-single', 'images' );

}

if(!in_array(THEME_KEY, array('vt'))){

get_template_part( 'widgets/widget-single', 'content' );  
			
}
if(in_array(THEME_KEY, array('mj'))){
			
get_template_part( 'widgets/widget-single', 'reviews' );
			
} 
?>
   
<?php endwhile; endif; ?>

<script>
function selectWidgetBox(h){



	jQuery('.widget').hide();   
	if(h == "#widget-maindetails"){
			  jQuery('#widget-maindetails').show();	
		   jQuery('#widget-single-images').show(); 	
	}else{
		   jQuery('#widget-maindetails').hide();	
		   jQuery('#widget-single-images').hide();
	}
	
	// CLONE BOX
	//jQuery( "#mobile-submenu-content" ).hide().clone().prependTo('#main').show();
	
	jQuery(h).show();		
}

jQuery(document).ready(function() {
   
      jQuery(window).on('resize', function(){
      var win = jQuery(this);        
      SingleMobileMenuDisplay(win.width());
      });
      jQuery(document).ready(function() {
      var win = jQuery(this);       
      SingleMobileMenuDisplay(win.width());
      jQuery('.widget').each(function(index,item){			
      var id = this.id;		
   
   if(id == "widget-single-images"){ }else{
   
      jQuery('#mobile-submenu').append('<option value="#'+id+'">' + jQuery('#'+id).data('title') + '</option>');
   }
      });	
});

function SingleMobileMenuDisplay(winsize){ 
	if (winsize < 991.98) {
	
	
		jQuery('#mobile-submenu-content').show();
    
      if(jQuery('#mobile-submenu').val() == "#widget-maindetails"){
      	jQuery('.widget').hide();
        jQuery('#widget-single-images').show();
   jQuery('#widget-maindetails').show();
      }				
      }else{	  	
        jQuery('#widget-single-images').show();
   jQuery('#widget-maindetails').show();
      	jQuery('#mobile-submenu-content').hide(); 
       jQuery('.widget').show();	  
      }
	} 
});
</script>  
<?php 
   // + PAGE BOTTOM
   get_template_part( 'page', 'bottom' ); 
   
   ?>
   <?php if( THEME_KEY != "ph" && THEME_KEY != "so" ){ ?>
      <section class="py-5 border-top bg-white hide-mobile" id="nearbylistings">
      <div class="container">
         <?php get_template_part( 'widgets/widget-single', 'nearby' );  ?>
      </div>
   </section>
   <?php } ?>
   
   <?php
   
   // + GLOBAL FOOTER
   get_footer($CORE->pageswitch()); }   ?>