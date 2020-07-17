<?php global $CORE, $userdata, $wpdb, $settings; 

if(isset($settings['show'])){ 	$show = $settings['show']; }else{ $show = 5; }
if(isset($settings['custom'])){ $custom = $settings['custom']; }else{ $custom  = "new"; }
if(isset($settings['small']) && $settings['small'] == 1){ $small = "extrasmall=1"; }else{ $small  = ""; }
if(isset($settings['padding'])){ $padding = $settings['padding']; }else{ $padding  = "50"; }

if(!isset($settings['cats'])){ $cats = ""; }else{ $cats = $settings['cats']; }
?>

<style>
.carousel3 { position:relative; } 
.carousel3 .nav-tabs{    margin: 0; background: #f7f7f7;   }
.carousel3 .nav-tabs li{    list-style: none;    display: inline;       margin-right: 2px;    height: 55px;    line-height: 60px;    float: left; margin-right:30px;     }
.carousel3 .nav-tabs li:hover, .carousel3 .nav-tabs li.active{    }
.carousel3 .nav-tabs li:hover a,.carousel3 .nav-tabs li.active a{    color: #333;}
.carousel3 .nav-tabs li a{    font-size: 16px;   color: #333;    font-weight: bold; font-size:14px; }
.carousel3 .tab-container{   padding-top: 30px;}
.carousel3 .tab-content { padding:0px; border-top:0px; border-bottom:0px; margin-top:30px; border-top: 1px solid #eaeaea; border-left: 1px solid #eaeaea; border-right: 1px solid #eaeaea;  }
.carousel3 .owl-btns { position:absolute; right:0; top:10px; }
.carousel3 .owl-btns button {  cursor:pointer;  }
.carousel3 .itemdata { padding:0px 10px; }
.carousel3 .listing-small { margin-bottom:0px !important; }
.carousel3 .owl-wrapper .owl-item:first-child .listing-small{ margin-left:-10px; }
</style>

<div class="carousel3 <?php if(isset($settings['class'])){ echo $settings['class']; } ?>">	

 
      <div class="owl-btns btn-group mr-2">
         <button type="button" class="owl-prev"><i class="fa fa-angle-left" aria-hidden="true"></i></button>
         <button type="button" class="owl-next"><i class="fa fa-angle-right" aria-hidden="true"></i></button>  
      </div>
      <ul class="nav nav-tabs">
         <li class="section-title bg-primary">
            <span class="text-white px-3 font-weight-bold"><?php if(isset($settings['title'])){ echo $settings['title']; }else{ echo __("Hot Picks","premiumpress"); } ?></span>
         </li>
         <li class="active"><a data-toggle="tab" href="#t1" role="tab"><?php echo __("New Items","premiumpress") ?></a></li>
         <li><a data-toggle="tab" href="#t2" role="tab"><?php echo __("Popular Items","premiumpress") ?></a></li>
         <li><a data-toggle="tab" href="#t3" role="tab"><?php echo __("Featured Items","premiumpress") ?></a></li>
      </ul>
      <div class="tab-content">
         <div class="tab-pane active" id="t1" role="tabpanel">
            <div id="t1-<?php echo $settings['eid']; ?>" class="owl-carousel small-list">
               <?php echo str_replace("col-md-3 col-6","",do_shortcode('[LISTINGS dataonly=1 show=20 carousel=1 cat="'.$cats.'" custom="new" '.$small.' ]')); ?> 
            </div>
         </div>
         <div class="tab-pane" id="t2" role="tabpanel">
            <div id="t2-<?php echo $settings['eid']; ?>" class="owl-carousel small-list">
               <?php echo str_replace("col-md-3 col-6","",do_shortcode('[LISTINGS dataonly=1 show=20 carousel=1 custom="popular"  '.$small.' ]')); ?> 
            </div>
         </div>
         <div class="tab-pane" id="t3" role="tabpanel">
            <div id="t3-<?php echo $settings['eid']; ?>" class="owl-carousel small-list">
               <?php echo str_replace("col-md-3 col-6","",do_shortcode('[LISTINGS dataonly=1 show=20 carousel=1  custom="featured" '.$small.' ]')); ?> 
            </div>
         </div>
      </div>
</div>
 

<script>
jQuery(document).ready(function() {
 
    // POPULAR ITEMS
   	jQuery('.nav-tabs a').click(function (e) { 
   	 	jQuery(this).removeClass('active');
		
		setTimeout(function(){
		
		 equalheight('.owl-wrapper .owl-item'); 
		
		}, 1000); 
		//setTimeout(function(){equalheight('.listing-small .wrap'); }, 2000); 
   	});
	
	//setTimeout(function(){equalheight('.carousel3 .owl-wrapper'); }, 1000); 
      
    var owl = jQuery("#t1-<?php echo $settings['eid']; ?>").owlCarousel({ items : <?php echo $show; ?>, autoPlay : true, loop:true, }); 
    var owl1 = jQuery("#t2-<?php echo $settings['eid']; ?>").owlCarousel({ items : <?php echo $show; ?>, autoPlay : false, loop:true, }); 
    var owl2 = jQuery("#t3-<?php echo $settings['eid']; ?>").owlCarousel({ items : <?php echo $show; ?>, autoPlay : false, loop:true, }); 
     
    // Custom Navigation Events
    jQuery(".owl-next").click(function(){    owl.trigger('owl.next');  })
    jQuery(".owl-prev").click(function(){    owl.trigger('owl.prev');  })
 
   
});  
</script>