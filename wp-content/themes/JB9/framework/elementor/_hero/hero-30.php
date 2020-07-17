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
 

 <div class="hero30 text-white <?php if(isset($settings['class'])){ echo $settings['class']; } ?>" style="background:url('<?php if(isset($settings['img1']) && $settings['img1'] != ""){ echo $settings['img1']; }else{ ?>https://premiumpress.com/_demoimages/elementor/_hero/hero30.jpg<?php } ?>'); background-size: cover; position:relative;">
 
 
   <div class="container py-4">
      <div class="row">
         <div class="col-md-8 offset-md-2 text-center py-5">
            <div class="wrap py-5 my-5 ">
               
               <h1><?php if(isset($settings['img1_txt1']) && $settings['img1_txt1'] != ""){ echo $settings['img1_txt1']; }else{ ?>Awesome Title Here<?php } ?></h1>
               
               <p class="my-3 pb-4 lead"><?php if(isset($settings['img1_txt2']) && $settings['img1_txt2'] != ""){ echo $settings['img1_txt2']; }else{ ?>
            Curabitur quis iaculis sem. Sed fermentum augue eu felis dignissim eleifend. 
            <?php } ?></p>
            <div class="formwrap mt-5">
               <form action="<?php echo home_url(); ?>/" method="get" name="searchform" id="searchform">
                  <div class="input-group">
                  
                     <input type="text" name="s" placeholder="<?php echo __("I'm looking for...","premiumpress") ?>" class="form-control">   
                     
                     <div class="input-group-prepend" style="position:relative;">
                      <button class="btn btn-primary px-5"><?php echo __("Search","premiumpress") ?></button>
                     </div> 
                     
                  </div>
               </form>
               </div>
            </div>
         </div>
      </div>
   </div>
</div>