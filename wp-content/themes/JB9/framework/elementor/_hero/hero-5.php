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
 
<div class="hero-5">
    <img src="<?php if(isset($settings['img1']) && $settings['img1'] != ""){ echo $settings['img1']; }else{ ?>https://premiumpress.com/_demoimages/elementor/_hero/hero5.jpg<?php } ?>" alt="<?php if(isset($settings['img1_txt1']) && $settings['img1_txt1'] != ""){ echo $settings['img1_txt1']; }  ?>">
   
<div class="container">
<div class="col-md-5 py-5">

 	<h1 class="text-uppercase text-primary"><?php if(isset($settings['img1_txt1']) && $settings['img1_txt1'] != ""){ echo $settings['img1_txt1']; }else{ ?>NEW OFFICIAL WEBSITE<?php } ?></h1>
        <h2><?php if(isset($settings['img1_txt2']) && $settings['img1_txt2'] != ""){ echo $settings['img1_txt2']; }else{ ?>UPTO 50% OFF<?php } ?></h2>
        <div class="uc_paragraph">
        <?php if(isset($settings['img1_txt3']) && $settings['img1_txt3'] != ""){ echo $settings['img1_txt3']; }else{ ?>
        Curabitur quis iaculis sem. Sed fermentum augue eu felis dignissim eleifend. Sed luctus, dolor in vulputate mattis, purus mi pharetra ante.
        <?php } ?>
        
        
        </div>
      
       <a href="<?php if(isset($settings['img1_btnlink']) && $settings['img1_btnlink'] != ""){ echo $settings['img1_btnlink']; }else{ echo home_url()."/?s="; }?>" class="btn btn-outline-dark rounded-0 font-weight-bold text-uppercase">
				 <?php if(isset($settings['img1_btntxt']) && $settings['img1_btntxt'] != ""){ echo $settings['img1_btntxt']; }else{ ?>Search Website<?php } ?>
                 </a> 

</div>
</div>
    
  
</div>
</div>