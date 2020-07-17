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
<div class="hero4">
<div class="row">
<div class="col-md-6 pr-lg-0">

    <div class="banner-boder-zoom">
    <a href="<?php echo $settings['img1_link']; ?>"> 
                  <img src="<?php if(isset($settings['img1']) && strlen($settings['img1']) > 1 ){ echo $settings['img1']; }else{ ?>http://via.placeholder.com/560x515<?php } ?>" class="img-fluid" alt="welcome" />
                  </a>    
    </div>
 
</div>
<div class="col-md-3 pr-lg-0">

    <div class="banner-boder-zoom">
    <a href="<?php echo $settings['img3_link']; ?>">
        <img src="<?php if(isset($settings['img3']) && strlen($settings['img3']) > 1 ){ echo $settings['img3']; }else{ ?>http://via.placeholder.com/272x249<?php } ?>" class="img-fluid" alt="image" />
    </a>   
    </div>
    
    <div class="banner-boder-zoom mt-3">
    <a href="<?php echo $settings['img4_link']; ?>">
        <img src="<?php if(isset($settings['img4']) && strlen($settings['img4']) > 1 ){ echo $settings['img4'];}else{ ?>http://via.placeholder.com/272x249<?php } ?>" class="img-fluid" alt="image" />
    </a>   
    </div>
 
</div>

<div class="col-md-3">

    <div class="banner-boder-zoom">
    <a href="<?php echo $settings['img5_link']; ?>">
        <img src="<?php if(isset($settings['img5']) && strlen($settings['img5']) > 1 ){ echo $settings['img5'];}else{ ?>http://via.placeholder.com/257x515<?php } ?>" class="img-fluid" alt="image" />
    </a>   
    </div>
 
</div>
</div>
</div>