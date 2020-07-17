<?php global $CORE, $userdata, $wpdb, $post, $settings; $gallery1 = ""; $gallery2 = "";


 
foreach($settings['images'] as $file){ 

		// SKIP NO SRC
		if($file['src'] == ""){ continue; }  
 	
		if(isset($file['type']) && in_array($file['type'],$CORE->allowed_image_types)){ 
		
		
			$CORE->media_set = array_merge($CORE->media_set, array($file['id']));
		
			// GET IMAGE AGAIN ENCASE THE ADMIN HAS MADE CHANGES
			if(strpos($file['src'],'amazon') == false){
			
				$image_src = wp_get_attachment_image_src( $file['id'], array(800,400) );				
				$src = hook_image_display($image_src[0]);
			  		
			}else{
		 
				$src = $file['src'];
			}
			
			if($file['thumbnail'] == ""){ $file['thumbnail'] = $src; }
			
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
		 
			
			$gallery1 	.= "<a href='".$src."' data-gal='prettyPhoto[ppt_gal_".$post->ID."]'><img src='".$src."' alt='".$alt."' class='img-fluid'  /></a>";			 
			$gallery2 	.= "<div class='thumb'><img src='".$file['thumbnail']."' alt='".$alt." &nbsp;' class='img-fluid owl-lazy' style='cursor:pointer' /></div>";
		
			
			
		}
	} 



if(count($settings['images']) < 2){

?>
<div class="text-center border bg-white mb-2 <?php if(in_array(THEME_KEY, array('so','mj'))){ ?><?php }else{ ?>p-3 p-lg-5<?php } ?>  gallerywrapper">
<?php echo $gallery1; ?>
</div>

<?php }else{ ?>

<div class="ppt-image-gallery">
					
					<div id="slider" style="display:none;">
					  <?php echo $gallery1; ?>
					</div>    
				
					<div class="navs d-none d-sm-block">
					  <a class="btn rounded-0 text-white prev bg-primary"><i class='fa fa-angle-left'></i></a>
					  <a class="btn rounded-0 text-white next bg-primary float-right"><i class='fa fa-angle-right'></i></a>
					</div>
				 
				 
					<div class="carousel mt-3 p-0">
					   
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
<?php } ?>