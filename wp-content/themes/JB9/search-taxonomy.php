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

global $CORE, $LAYOUT, $wpdb, $wp_query;


if(!_ppt_checkfile("search-taxonomy.php")){  

$GLOBALS['flag-settopsearchlisting'] = 1;  

$term = get_term_by('slug', get_query_var( 'term' ), get_query_var( 'taxonomy' ) );

if(strlen(_ppt('category_description_'.$term->term_id)) > 5){
?>

<div class="row">
      <div class="col-12">
         <div class="bg-light p-4 m-2 mb-4 border">
            <h2 class="h4"><?php echo $term->name; ?></h2>
            <p class="lead"><?php if(_ppt('category_description_'.$term->term_id) != ""){ echo wpautop(_ppt('category_description_'.$term->term_id)); }else{ echo wpautop($term->description); } ?></p>
         </div>
      </div>
</div>

<?php } } ?>