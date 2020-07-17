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
 

<div class="hero33 <?php if(isset($settings['class'])){ echo $settings['class']; } ?>" <?php if(isset($settings['img2']) && $settings['img2'] != ""){?>style="background-image: url('<?php echo $settings['img2']; ?>');
    background-position: center center;  background-repeat: no-repeat;  background-size: cover;"<?php } ?>>
   <div class="container py-4 text-center text-lg-left">
   
     
     
      <img src="<?php if(isset($settings['img1']) && $settings['img1'] != ""){ echo $settings['img1']; }else{ ?>https://www.premiumpress.com/_demoimages/2020/hero_ct.png<?php } ?>" alt="<?php if(isset($settings['img1_txt1']) && $settings['img1_txt1'] != ""){ echo $settings['img1_txt1']; } ?>" class="d-none d-mb-block d-lg-block"> 
     
     
      <div class="row">
         <div class="col-xl-7 col-md-10 pl-lg-5 py-lg-4">
            <div>
               <h1 class="text-black mt-4"><?php if(isset($settings['img1_txt1']) && $settings['img1_txt1'] != ""){ echo $settings['img1_txt1']; }else{ ?>awesome title here<?php } ?></h1>
               
               <p class="my-3 pb-4 lead text-black"><?php if(isset($settings['img1_txt2']) && $settings['img1_txt2'] != ""){ echo $settings['img1_txt2']; }else{ ?>
            Curabitur quis iaculis sem. Sed fermentum augue eu felis dignissim eleifend.
            <?php } ?></p>
               
               
            <a href="<?php if(isset($settings['img1_btnlink']) && $settings['img1_btnlink'] != ""){ echo $settings['img1_btnlink']; }else{ echo home_url()."/?s="; }?>" class="btn btn-lg rounded-0">
            <?php if(isset($settings['img1_btntxt']) && $settings['img1_btntxt'] != ""){ echo $settings['img1_btntxt']; }else{ ?><?php echo __("Search Website","premiumpress") ?><?php } ?> <i class="fa fa-angle-right ml-4 font-weight-bold text-light "></i>
            </a> 
       
               <p class="my-4 lead"><?php echo __("Already a member?","premiumpress") ?> <a href="<?php echo wp_login_url(); ?>" class="text-white "><u><?php echo __("Login here","premiumpress") ?></u></a></p>
           
            </div>
         </div>
      </div>
   </div>
</div>