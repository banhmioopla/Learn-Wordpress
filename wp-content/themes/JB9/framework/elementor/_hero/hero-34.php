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
 
 <div class="hero34 <?php if(isset($settings['class'])){ echo $settings['class']; } ?>">
   <div class="wrapper">
      <div class="container">
         <div class="row">
            <div class="col-xl-6 d-none d-xl-block">
            
              
      <img src="<?php if(isset($settings['img1']) && $settings['img1'] != ""){ echo $settings['img1']; }else{ ?>https://www.premiumpress.com/_demoimages/2020/hero_ct.png<?php } ?>" alt="<?php if(isset($settings['img1_txt1']) && $settings['img1_txt1'] != ""){ echo $settings['img1_txt1']; } ?>" class="lazy d-none d-mb-block d-lg-block img-fluid"> 
      
      
     
     
            </div>
            <div class="col-md-12 col-xl-6">
               <h1 class="mt-lg-4 text-primary"><?php if(isset($settings['img1_txt1']) && $settings['img1_txt1'] != ""){ echo $settings['img1_txt1']; }else{ ?>awesome title here<?php } ?></h1>
               <h2><?php if(isset($settings['img1_txt2']) && $settings['img1_txt2'] != ""){ echo $settings['img1_txt2']; }else{ ?>Sed fermentum augue eu felis dignissim eleifend.<?php } ?></h2>
               <p class="mt-4 lead"><?php if(isset($settings['img1_txt3']) && $settings['img1_txt3'] != ""){ echo $settings['img1_txt3']; }else{ ?>
               Curabitur quis iaculis sem. Sed fermentum augue eu felis dignissim eleifend. Curabitur quis iaculis sem. Sed fermentum augue eu felis dignissim eleifend.<?php } ?>
               </p>               
                
               <div class="mb-5">
               
               
              
              
              <a href="<?php if(isset($settings['img1_btnlink']) && $settings['img1_btnlink'] != ""){ echo $settings['img1_btnlink']; }else{ echo home_url()."/?s="; }?>" class="btn btn-primary rounded-0">
            <?php if(isset($settings['img1_btntxt']) && $settings['img1_btntxt'] != ""){ echo $settings['img1_btntxt']; }else{ ?><?php echo __("Search Website","premiumpress") ?><?php } ?> <i class="fa fa-angle-right ml-4 font-weight-bold text-light "></i>
            </a> 
            
            
               </div>
               
                <p class="my-4 small"><?php echo __("Already a member?","premiumpress") ?> <a href="<?php echo wp_login_url(); ?>"><u><?php echo __("Login here","premiumpress") ?></u></a></p>
           
               
            </div>
         </div>
      </div>
   </div>
</div>
