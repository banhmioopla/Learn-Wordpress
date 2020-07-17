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

$term = get_term_by('slug', get_query_var( 'term' ), get_query_var( 'taxonomy' ) );

 
if(_ppt('category_description_'.$term->term_id) != ""){
?>


   <div class="row">
      <div class="col-sm-12">
         <div class="section-title mb-5 text-center text-dark bg-light p-5">
            <h2 class="text-uppercase"><?php echo $term->name; ?></h2>
            <p class="lead"><?php if(_ppt('category_description_'.$term->term_id) != ""){ echo wpautop(_ppt('category_description_'.$term->term_id)); }else{ echo wpautop($term->description); } ?></p>
         </div>
      </div>
   </div>
<?php } ?>