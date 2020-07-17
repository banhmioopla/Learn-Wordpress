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
<style>
.hero26 .text-area { position: absolute;  max-width: 400px; padding:20px;  }
.hero26 .text-area img { display:none;}
.hero26 .owl-slider .item img{    display: block;    width: 100%;    height: auto; }
.hero26 .owl-slider .owl-buttons { position:absolute; top:45%;     width: 100%; }
.hero26 .owl-slider .owl-next { float:right; margin-top:-40px;  }
.hero26 .owl-slider .owl-buttons div { text-align: center;    height: 35px; line-height: 30px;    font-size: 30px;    width: 30px;    border-radius: 0px; }
.hero26 .btn { position:relative; min-width:250px; }
.hero26 .text-area .iconb {     position: absolute;    right: 0px;    bottom: 0px;    width: 50px;    line-height: 55px;    border-left: 1px solid #ffffff6e;    text-align: center; } 
@media (max-width: 576px) { 
.hero26 .owl-wrapper-outer { min-height:290px;}
.hero26 .owl-wrapper-outer .btn { display:block; margin: 40px -20px; }
.hero26 .text-area { padding:20px;  }
.hero26 .text-area h1 { font-size:30px; }
.hero26 img { display:none !important;}
#ppt-hero-slider .owl-buttons { display:none; }
.popular-tabs .nav-tabs {    display: none;}
}

@media (min-width: 768px) {
.hero26 .text-area { padding:20px }
}
 
@media (min-width: 992px) { 
.hero26 .text-area {  bottom: 80px;    left: 70px;} 
}
 
</style>


<div class="hero26 pt-3 <?php if(isset($settings['class'])){ echo $settings['class']; } ?>">
   <div class="container-fluid">
      <div class="row">
         <div class="col-lg-3">
         </div>
         <div class="col-lg-9 owl-slider px-0 pl-lg-4">
            <div id="ppt-hero26-slider">
            
            
            
               <div class="item bg-primary">
                  <div class="text-area">
                     
                     <h1 class="mb-4 text-primary font-weight-bold"><?php if(isset($settings['img1_txt1']) && $settings['img1_txt1'] != ""){ echo $settings['img1_txt1']; }else{ ?>TAKING CARE OF YOURSELF<?php } ?></h1>
                     
                     <p class="lead mt-3">
					 <?php if(isset($settings['img1_txt2']) && $settings['img1_txt2'] != ""){ echo $settings['img1_txt2']; }else{ ?>
        Curabitur quis iaculis sem. Sed fermentum augue eu felis dignissim eleifend. Sed luctus, dolor in vulputate mattis, purus mi pharetra ante.
        <?php } ?>
        </p>
                     
                     <a href="<?php if(isset($settings['img1_btnlink']) && $settings['img1_btnlink'] != ""){ echo $settings['img1_btnlink']; }else{ echo home_url()."/?s="; }?>" class="btn btn-secondary px-5 text-left rounded-0 py-3 mt-lg-4 text-uppercase font-weight-bold"> <?php if(isset($settings['img1_btntxt']) && $settings['img1_btntxt'] != ""){ echo $settings['img1_btntxt']; }else{ echo __("Search Website","premiumpress"); } ?> <span class="iconb"><i class="fa fa-angle-right font-weight-bold text-white"></i></span>
                     </a> 
                     
                  </div>
                  <img src="<?php if(isset($settings['img1']) && strlen($settings['img1']) > 0){ echo $settings['img1']; }else{ ?>https://premiumpress.com/_demoimages/elementor/_hero/hero26.jpg<?php } ?>"
                   class="img-user" alt="welcome" />   
               </div>
               
               
               
               <div class="item bg-primary">  
                   <div class="text-area">
                  
                  <?php if(isset($settings['img2_txt1']) && $settings['img2_txt1'] != ""){  ?>
                       <h1 class="mb-4 text-primary font-weight-bold"><?php echo $settings['img2_txt1']; ?></h1>
                  <?php } ?>
                     
                   <?php if(isset($settings['img2_txt2']) && $settings['img2_txt2'] != ""){ ?>
                     <p class="lead mt-3"><?php echo $settings['img1_txt2'];?></p>
					<?php } ?>  
                
                <?php if(isset($settings['img2_btnlink']) && $settings['img2_btnlink'] != ""){ ?>
                
                 <a href="<?php echo $settings['img2_btnlink']; ?>"
                  class="btn btn-secondary px-5 text-left rounded-0 py-3 mt-lg-4 text-uppercase font-weight-bold">
				  <?php echo $settings['img2_btntxt']; ?> 
                  <span class="iconb"><i class="fa fa-angle-right font-weight-bold text-white"></i></span>
                  </a> 
                  
                 <?php } ?>
                
                                
                  </div>
                  
                  
                  
                  <a href="<?php if(isset($settings['img2_btnlink']) && $settings['img2_btnlink'] != ""){ echo $settings['img2_btnlink']; }else{ echo $CORE->homeCotent('hero', 'img2_btnlink'); } ?>"> 
                  <img src="<?php if(isset($settings['img2']) && strlen($settings['img2']) > 0){ echo $settings['img2']; }else{ ?>https://premiumpress.com/_demoimages/elementor/_hero/hero26.jpg<?php } ?>" 
                  class="img-fluid" alt="welcome" />
                  </a> 
                     
               </div>
               
            </div>
         </div>
         <div class="clearfix"></div>
      </div>
   </div>
</div>
<script>
jQuery(document).ready(function() {
  
	// HERO SLIDER
	jQuery("#ppt-hero26-slider").owlCarousel({    
         navigation : true, // Show next and prev buttons
         slideSpeed : 300,
         paginationSpeed : 400,
         singleItem:true,
   	  	 autoHeight : true,
         navigationText : ["<i class='fa fa-angle-left text-white'></i>","<i class='fa fa-angle-right text-white'></i>"],    
     }); 
   
});  
</script>