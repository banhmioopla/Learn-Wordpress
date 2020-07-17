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

 
if(!_ppt_checkfile("sidebar-wrap-top.php")){  if(isset($GLOBALS['flag-nosidebar'])){ return; } ?>

 
<div class="row">



<div class="<?php if(isset($GLOBALS['flag-single']) && in_array(THEME_KEY , array('cm') ) ){ ?>col-lg-7 <?php }elseif(isset($GLOBALS['flag-single'])){ ?>col-lg-8<?php }else{ ?>col-lg-9<?php } ?> pagemiddle">

<div id="main-inner">

<?php } ?>