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

global $CORE, $userdata, $wpdb, $settings; ?>

<div class="elementor_header elementor_nav header-nav5 <?php if(isset($settings['class'])){ echo $settings['class']; } ?>" <?php if(isset($settings['id'])){ echo "id='".$settings['id']."'"; } ?>>
<div id="main-category-wrap">
    <div id="navMenu">
      <div id="navMenu-wrapper">
        <ul id="cat-items">
          <div id="menuSelector"></div><?php
  		 
		echo wp_list_categories( array(
                                 								'taxonomy'  	=> 'listing',
                                 								'depth'         => 1,	
                                 								'hierarchical'  => 1,		
                                 								'hide_empty'    => 0,
                                 								'echo'			=> false,
                                 								'title_li' 		=> '',
                                 								'show_count' 	=> 0,
                                 								'orderby' 		=> 'term_order',
                                 							  
                                 								) );
  		?></ul>
        <div class="navMenu-paddles">
          <button class="navMenu-paddle-left i fa fa-angle-left"> </button>
          <button class="navMenu-paddle-right icon-chevronright fa fa-angle-right"> </button>
        </div>
      </div>
    </div>
</div>
</div>
<script src='http://ajax.googleapis.com/ajax/libs/jqueryui/1.8.5/jquery-ui.min.js'></script>
<script>
jQuery(function() {
  var items = jQuery('#cat-items').width(); 
  
  jQuery('#main-category-wrap').addClass('container py-0');
  
   if( jQuery("#cat-items li").length > 9){
   
   jQuery('#navMenu-wrapper').addClass('addon');
  
  }else{
  jQuery('.navMenu-paddles').hide();
  }
  
  var itemSelected = document.getElementsByClassName('cat-item');
  navPointerScroll(jQuery(itemSelected));
  
  jQuery("#cat-items").scrollLeft(200).delay(200).animate({
    scrollLeft: "-=200"
  }, 2000, "easeOutQuad");
 
	jQuery('.navMenu-paddle-right').click(function () {
		jQuery("#cat-items").animate({
			scrollLeft: '+='+items
		});
	});
	jQuery('.navMenu-paddle-left').click(function () {
		jQuery( "#cat-items" ).animate({
			scrollLeft: "-="+items
		});
	});

  if(!/Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent) ) {
    var scrolling = false;

    jQuery(".navMenu-paddle-right").bind("mouseover", function(event) {
        scrolling = true;
        scrollContent("right");
    }).bind("mouseout", function(event) {
        scrolling = false;
    });

    jQuery(".navMenu-paddle-left").bind("mouseover", function(event) {
        scrolling = true;
        scrollContent("left");
    }).bind("mouseout", function(event) {
        scrolling = false;
    });

    function scrollContent(direction) {
        var amount = (direction === "left" ? "-=3px" : "+=3px");
        jQuery("#cat-items").animate({
            scrollLeft: amount
        }, 1, function() {
            if (scrolling) {
                scrollContent(direction);
            }
        });
    }
  }
  
  

});

function navPointerScroll(ele) {

	var parentScroll = jQuery("#cat-items").scrollLeft();
	var offset = (jQuery(ele).offset().left - jQuery('#cat-items').offset().left);
	var totalelement = offset + jQuery(ele).outerWidth()/2;

	var rt = ((jQuery(ele).offset().left) - (jQuery('#navMenu-wrapper').offset().left) + (jQuery(ele).outerWidth())/2);
	jQuery('#menuSelector').animate({
		left: totalelement + parentScroll
	})
}
</script>