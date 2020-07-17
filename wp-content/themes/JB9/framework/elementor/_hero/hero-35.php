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
 
global $CORE, $post, $userdata, $settings; 
 
?>

<div class="row" >
<div class="col-md-8 pr-lg-0"> 
<div id="hero-3" class="owl-slider hero-3">
               <div class="item">
                  <a href="<?php echo $settings['img1_link']; ?>"> 
                  <img src="<?php if(isset($settings['img1']) && strlen($settings['img1']) > 1 ){ echo $settings['img1']; }else{ ?>http://via.placeholder.com/750x470<?php } ?>" class="img-fluid" alt="welcome" />
                  </a>    
               </div>
                <div class="item">
                  <a href="<?php echo $settings['img2_link']; ?>"> 
                  <img src="<?php if(isset($settings['img2']) && strlen($settings['img2']) > 1 ){ echo $settings['img2']; }else{ ?>http://via.placeholder.com/750x470<?php } ?>" class="img-fluid" alt="welcome" />
                  </a>    
               </div>
            </div> 
</div>
<div class="col-md-4">
	
    <div class="row">
    <div class="banner-boder-zoom mb-4 col-md-12 col-6">
    <a href="<?php echo $settings['img3_link']; ?>">
        <img src="<?php if(isset($settings['img3']) && strlen($settings['img3']) > 1 ){ echo $settings['img3']; }else{ ?>http://via.placeholder.com/350x140<?php } ?>" class="img-fluid" alt="image" />
    </a>   
    </div>
    
    <div class="banner-boder-zoom mb-4 col-md-12 col-6">
    <a href="<?php echo $settings['img4_link']; ?>">
        <img src="<?php if(isset($settings['img4']) && strlen($settings['img4']) > 1 ){ echo $settings['img4'];}else{ ?>http://via.placeholder.com/350x140<?php } ?>" class="img-fluid" alt="image" />
    </a>   
    </div>
    
    <div class="banner-boder-zoom col-md-12 d-none d-md-block">
    <a href="<?php echo $settings['img5_link']; ?>">
        <img src="<?php if(isset($settings['img5']) && strlen($settings['img5']) > 1 ){ echo $settings['img5']; }else{ ?>http://via.placeholder.com/350x140<?php } ?>" class="img-fluid" alt="image" />
    </a>   
    </div>
    </div>
         
</div>

</div>
<?php if(!isset($settings['noload'])){ ?>
<script>
jQuery(document).ready(function() {
  
	// HERO SLIDER
	jQuery("#hero-3").owlCarousel({    
         navigation : true,
		 animateOut: 'slideOutDown',
   		 animateIn: 'flipInX',
         slideSpeed : 300,
         paginationSpeed : 400,
         singleItem:true,
   	  	 autoHeight : true,
         navigationText : ["<i class='fa fa-angle-left text-white'></i>","<i class='fa fa-angle-right text-white'></i>"],    
     });

});
</script>
<?php } ?>