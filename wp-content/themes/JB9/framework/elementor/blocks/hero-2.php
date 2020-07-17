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
<div id="hero-2" class="owl-slider hero-2">
	
    
	<div class="item">
	<div class="text-area">
    				 <?php if(isset($settings['img1_txt1'])){ ?>
                     <h1 class="mb-4"><?php echo $settings['img1_txt1']; ?></h1>
                     <?php } ?>
                     
                     <?php if(isset($settings['img1_txt2'])){ ?>
                     <p class="lead mt-3"><?php echo $settings['img1_txt2']; ?></p>
                     <?php } ?>
                     
                     <?php if(isset($settings['img1_btntxt']) && strlen($settings['img1_btntxt']) > 1 ){ ?>
                     <a href="<?php echo $settings['img1_btnlink']; ?>" class="btn btn-secondary px-5 text-left rounded-0 py-3 mt-lg-4">
					 <?php echo $settings['img1_btntxt']; ?> <span class="iconb"><i class="fa fa-angle-right"></i></span>
                     </a>
                     <?php } ?>
                  </div>
                  
	<div>
    <?php if(isset($settings['img1_link_full'])){ ?>
    <a href="<?php echo $settings['img1_link_full']; ?>">
    <?php } ?>
    <img src="<?php if(isset($settings['img1']) && strlen($settings['img1']) > 1 ){ echo $settings['img1']; }else{ ?>http://via.placeholder.com/1140x450<?php } ?>" class="img-fluid " alt="image" /></div>
    <?php if(isset($settings['img1_link_full'])){ ?>
    </a>
    <?php } ?>
	</div> 
    
    <?php if(isset($settings['img2']) && strlen($settings['img2']) > 1 ){ ?>
	<div class="item">
	<div class="text-area">
    
    				<?php if(isset($settings['img2_txt1'])){ ?>
                     <h1 class="mb-4"><?php echo $settings['img2_txt1']; ?></h1>
                     <?php } ?>
                     
                     <?php if(isset($settings['img2_txt2'])){ ?>
                     <p class="lead mt-3"><?php echo $settings['img2_txt2']; ?></p>
                     <?php } ?>
                     
                     <?php if(isset($settings['img2_btntxt']) && strlen($settings['img2_btntxt']) > 1 ){ ?>
                     <a href="<?php echo $settings['img2_btnlink']; ?>" class="btn btn-secondary px-5 text-left rounded-0 py-3 mt-lg-4">
					 <?php echo $settings['img2_btntxt'] ?> <span class="iconb"><i class="fa fa-angle-right"></i></span>
                     </a>
                     <?php } ?>
                     
                  </div>
                  
	<div>
    <?php if(isset($settings['img2_link_full'])){ ?>
    <a href="<?php echo $settings['img2_link_full']; ?>">
    <?php } ?>
    
    <img src="<?php if(isset($settings['img2'])){ echo $settings['img2']; }else{ ?>http://via.placeholder.com/1140x450<?php } ?>" class="img-fluid " alt="image" />
    
	<?php if(isset($settings['img2_link_full'])){ ?>
    </a>
    <?php } ?>
    
    </div>  
	</div>   
    <?php } ?>
    
    <?php if(isset($settings['img3']) && strlen($settings['img3']) > 1 ){ ?>
	<div class="item">
	<div class="text-area">
                     <h1 class="mb-4"><?php echo $settings['img3_txt1']; ?></h1>
                     <p class="lead mt-3"><?php echo $settings['img3_txt2']; ?></p>
                     <a href="<?php echo $settings['img3_btnlink']; ?>" class="btn btn-secondary px-5 text-left rounded-0 py-3 mt-lg-4">
					 <?php echo $settings['img3_btntxt'] ?> <span class="iconb"><i class="fa fa-angle-right"></i></span>
                     </a>
                  </div>
                  
	<div><img src="<?php if(isset($settings['img3'])){ echo $settings['img3']; }else{ ?>http://via.placeholder.com/1140x450<?php } ?>" class="img-fluid " alt="image" /></div>  
	</div>   
    <?php } ?>
             
</div>
     
<?php if(!isset($settings['noload'])){ ?>
<script>
jQuery(document).ready(function() {
  
	// HERO SLIDER
	jQuery("#hero-2").owlCarousel({    
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