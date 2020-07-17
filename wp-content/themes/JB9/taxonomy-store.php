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
 
$GLOBALS['flag-search'] = 1;
$GLOBALS['flag-taxonomy'] = 1;

if(_ppt(array('pageassign','defaultstore')) != ""){

	$thispage = get_page( _ppt(array('pageassign','defaultstore'))  );
	get_header($CORE->pageswitch()); 
	echo do_shortcode( $thispage->post_content );
	get_footer($CORE->pageswitch()); 
	
}elseif(!_ppt_checkfile("taxonomy-store.php")){

$term = get_term_by('slug', get_query_var( 'term' ), get_query_var( 'taxonomy' ) );

?>
<?php get_header($CORE->pageswitch());   ?>
<?php hook_taxonomy_title_before(); ?>
<?php if(_ppt("category_hideresults_".$term->term_id) == 1){  ?>
<?php get_template_part( 'search', 'subcategories' ); ?> 
<?php }else{ ?>	
<?php get_template_part( 'search' ); ?>
<?php } ?> 
<?php } ?>