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
<div class="hero4_header">    	      
    <img src="<?php echo $settings['img1']; ?>" alt="<?php echo $settings['txt1']; ?>" >
    
    <div class="uc_container_text_box">
       
       <h1><?php echo $settings['txt1']; ?></h1>
        <div class="uc_paragraph">
        	<?php echo $settings['txt2']; ?>
        </div>
         
       <a href="<?php echo $settings['btn_link']; ?>"><?php echo $settings['btn_txt']; ?></a>
    </div>      
</div>