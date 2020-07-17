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

if(!_ppt_checkfile("search-results.php")){

global $CORE; 

?>
<a name="topresults"></a>
 
<div class="listing-list-wrapper <?php 

if(isset($_GET['display']) && in_array($_GET['display'], array(0,2))){ echo "small-list clearfix"; }

elseif(isset($_GET['display']) && $_GET['display'] == 1){ echo "clearfix"; }

elseif(in_array(THEME_KEY, array("da","at","rt","sp","mj","cm","vt","so","ct"))){echo "small-list clearfix"; } // default to small list

?>">
  
<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>

   <?php get_template_part( 'content-listing'); //hook_theme_folder(array('content','listing')), str_replace("_type","",$post->post_type) ?> 
 
   <?php wp_reset_postdata(); ?>
   <?php endwhile; ?>
 
   <div class="clearfix"></div>
<?php else: ?>
<?php get_template_part( 'search', 'noresults' ); ?>   
<?php endif; ?> 
</div>
 
<?php } ?>