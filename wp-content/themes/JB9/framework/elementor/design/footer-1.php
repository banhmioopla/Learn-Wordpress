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
 
global $CORE, $userdata; 
?>

<div class="footer-1">
<div class="container">
    
    <div class="row">    
    <div class="col-md-6">
   		<div class="copy mt-2 text-uppercase">&copy; <?php echo date("Y"); ?> - <?php echo stripslashes(_ppt(array('company','name'))); ?></div>   
    </div>
    <div class="col-md-6">    
             
          <div class="socials float-md-right">
                <?php if(_ppt(array('social','twitter_icon')) != ""){ ?>
                  <a class="social" target="_blank" href="<?php echo _ppt(array('social','twitter')); ?>" title="Twitter"><i class="fa <?php echo _ppt(array('social','twitter_icon')); ?>"></i></a>
                 <?php } ?>
                 
                 <?php if(_ppt(array('social','facebook_icon')) != ""){ ?>
                  <a class="social" target="_blank" href="<?php echo _ppt(array('social','facebook')); ?>" title="Facebook"><i class="fa <?php echo _ppt(array('social','facebook_icon')); ?>"></i></a>
                  <?php } ?>
                  
                  <?php if(_ppt(array('social','dribbble_icon')) != ""){ ?>
                  <a class="social" target="_blank" href="<?php echo _ppt(array('social','dribbble')); ?>" title="Google plus"><i class="fa <?php echo _ppt(array('social','dribbble_icon')); ?>"></i></a> 
                  <?php } ?>
                  
                  <?php if(_ppt(array('social','linkedin_icon')) != ""){ ?>
                  <a class="social" target="_blank" href="<?php echo _ppt(array('social','linkedin')); ?>" title="Dribbble"><i class="fa <?php echo _ppt(array('social','linkedin_icon')); ?>"></i></a>
                  <?php } ?>
                  
                  <?php if(_ppt(array('social','skype')) != ""){ ?>
                  <a class="social" target="_blank" href="<?php echo _ppt(array('social','skype')); ?>" title="Skype"><i class="fa <?php echo _ppt(array('social','skype_icon')); ?>"></i></a>
                  <?php } ?>
                  
                  <?php if(_ppt(array('social','youtube')) != ""){ ?>
                  <a class="social" target="_blank" href="<?php echo _ppt(array('social','youtube')); ?>" title="Skype"><i class="fa <?php echo _ppt(array('social','youtube_icon')); ?>"></i></a>  
                  <?php } ?>
            </div>        
    </div>
    </div> 
</div>
</div>