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

<div class="row">
<div class="col-md-12"> 
<div id="hero-36" class="owl-slider hero-2 hero-36">
               <div class="item">
                  <a href="<?php if(isset($settings['img1_link'])){ echo $settings['img1_link']; } ?>"> 
                  <img src="<?php if(isset($settings['img1']) && strlen($settings['img1']) > 1 ){ echo $settings['img1']; }else{ ?>http://via.placeholder.com/1140x500<?php } ?>" class="img-fluid mb-0" alt="welcome" />
                  </a>    
               </div>
               <?php if(isset($settings['img2']) && strlen($settings['img2']) > 1 ){ ?>
                <div class="item">
                  <a href="<?php if(isset($settings['img2_link'])){ echo $settings['img2_link']; } ?>"> 
                  <img src="<?php if(isset($settings['img2']) && strlen($settings['img2']) > 1 ){ echo $settings['img2']; }else{ ?>http://via.placeholder.com/1140x500<?php } ?>" class="img-fluid mb-0" alt="welcome" />
                  </a>    
               </div>
               <?php } ?>
            </div> 
</div> 

</div>
<?php if(!isset($settings['noload'])){ ?>
<script>
jQuery(document).ready(function() {
  
	// HERO SLIDER
	jQuery("#hero-36").owlCarousel({    
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