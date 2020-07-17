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
   
   global $CORE, $post, $userdata, $CORE_AUCTION;
 
   if(in_array(THEME_KEY, array('rt','dt','vt','mj')) ){ $sn = 4; }else{ $sn = 5; }
   
   ?>
   
 
<div style="margin-right:-10px;">
<div class="owl-carousel small-list p-0" id="nearby" data-autoPlay="1" data-items="<?php echo $sn; ?>" data-stagePadding="10">
<?php


if(defined('WLT_DEMOMODE')){
echo do_shortcode('[LISTINGS dataonly=1 show=20 small=1 carousel=1 ]');
}else{
echo do_shortcode('[LISTINGS dataonly=1 show=20 small=1 carousel=1 custom="related" ]');
} ?> 
</div>
</div>
 
<script>
jQuery(document).ready(function() {
jQuery("#nearby").owlCarousel({ items : <?php echo $sn; ?>, autoPlay : true, loop:true, stagePadding:10, margin:10, });

	// SHOW HIDE BOX IS NO CONTENT	
	 setTimeout(function(){  
		if(jQuery('#widget-nearby').height() < 200){ 
			jQuery('#widget-nearby').hide();
		}
	}, 1000);

});	
</script> 