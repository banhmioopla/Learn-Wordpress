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
<div id="hero-5" class="hero-5">
<div class="row">
<div class="col-3 d-none d-xl-block">

    <div class="row">
        <div class="col-md-12 mb-3">
        	<div class="banner-boder-zoom">
            <a href="<?php echo $settings['img1_link']; ?>"> 
            <img src="<?php if(isset($settings['img1']) && strlen($settings['img1']) > 1  ){ echo $settings['img1']; }else{ ?>http://via.placeholder.com/225x660<?php } ?>" class="img-fluid wow fadeInLeft" alt="welcome" />
            </a>    
            </div>
        </div> 
    </div> 
        
</div>
<div class="col-lg-9 col-md-12 px-0">

    <div class="row">
        <div class="col-md-12 mb-3">
        	<div class="banner-boder-zoom">
            <a href="<?php echo $settings['img2_link']; ?>"> 
            <img src="<?php if(isset($settings['img2']) && strlen($settings['img2']) > 1 ){ echo $settings['img2']; }else{ ?>http://via.placeholder.com/820x480<?php } ?>" class="img-fluid wow fadeInLeft" alt="welcome" />
            </a>  
            </div>  
        </div>
    </div>    
    <div class="row">
        <div class="col-md-6 pr-2 d-none d-sm-block">
            <div class="banner-boder-zoom">
            <a href="<?php echo $settings['img3_link']; ?>"> 
            <img src="<?php if(isset($settings['img3']) && strlen($settings['img3']) > 1 ){ echo $settings['img3']; }else{ ?>http://via.placeholder.com/395x170<?php } ?>" class="img-fluid" alt="welcome" />
            </a>
            </div>
        </div>
        <div class="col-md-6 pl-2 d-none d-sm-block">
            <div class="banner-boder-zoom">
            <a href="<?php echo $settings['img4_link']; ?>"> 
            <img src="<?php if(isset($settings['img4']) && strlen($settings['img4']) > 1 ){ echo $settings['img4']; }else{ ?>http://via.placeholder.com/395x170<?php } ?>" class="img-fluid" alt="welcome" />
            </a>
            </div>
        </div>    
    </div>
</div> 
</div>           
</div>
      