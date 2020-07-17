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
 
    
global $CORE, $settings; ?>
<div class="elementor_footer footerpart  footer_bot <?php if(isset($settings['class'])){ echo $settings['class']." "; } ?>">
<div class="container py-3">
    
    <div class="row">    
    <div class="col-md-6 text-center text-md-left">
   		<div class="copy mt-2 text-uppercase"><?php echo "&copy; ".date("Y")." - ".stripslashes(_ppt(array('company','name')));?></div>   
    </div>
    <div class="col-md-6 hide-mobile">    
             
          <div class="sicons float-md-right">
                <?php if(_ppt(array('social','twitter')) != ""){ ?>
                  <a class="social" target="_blank" href="<?php echo _ppt(array('social','twitter')); ?>"><i class="fa <?php echo _ppt(array('social','twitter_icon')); ?>"></i></a>
                 <?php } ?>
                 
                 <?php if(_ppt(array('social','facebook')) != ""){ ?>
                  <a class="social" target="_blank" href="<?php echo _ppt(array('social','facebook')); ?>"><i class="fa <?php echo _ppt(array('social','facebook_icon')); ?>"></i></a>
                  <?php } ?>
                  
                  <?php if(_ppt(array('social','dribbble')) != ""){ ?>
                  <a class="social" target="_blank" href="<?php echo _ppt(array('social','dribbble')); ?>"><i class="fa <?php echo _ppt(array('social','dribbble_icon')); ?>"></i></a> 
                  <?php } ?>
                  
                  <?php if(_ppt(array('social','linkedin')) != ""){ ?>
                  <a class="social" target="_blank" href="<?php echo _ppt(array('social','linkedin')); ?>"><i class="fa <?php echo _ppt(array('social','linkedin_icon')); ?>"></i></a>
                  <?php } ?>
                  
                  <?php if(_ppt(array('social','skype')) != ""){ ?>
                  <a class="social" target="_blank" href="<?php echo _ppt(array('social','skype')); ?>"><i class="fa <?php echo _ppt(array('social','skype_icon')); ?>"></i></a>
                  <?php } ?>
                  
                  <?php if(_ppt(array('social','youtube')) != ""){ ?>
                  <a class="social" target="_blank" href="<?php echo _ppt(array('social','youtube')); ?>"><i class="fa <?php echo _ppt(array('social','youtube_icon')); ?>"></i></a>  
                  <?php } ?>
            </div>        
    </div>
    </div> 
</div>
</div>