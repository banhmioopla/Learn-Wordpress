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

 
if(!_ppt_checkfile("sidebar-left-wrap-top-after.php")){  if(isset($GLOBALS['flag-nosidebar'])){ return; } ?>

<div class="<?php 

if(isset($GLOBALS['flag-single']) && in_array(THEME_KEY , array('cm') ) ){ echo "col-lg-7"; }elseif(defined('PPTCOL-LEFT') && isset($GLOBALS['flag-single']) ){ echo "col-lg-8"; }else{ echo "col-lg-9"; } ?> pagemiddle">

<div id="main-inner">

<?php } ?>