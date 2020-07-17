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
   
   $GLOBALS['flag-searchpage'] = 1;
    
   if(_ppt(array('pageassign','defaultsearchresults')) != ""){
   
   	$thispage = get_page( _ppt(array('pageassign','defaultsearchresults'))  );
   	get_header($CORE->pageswitch()); 
   	echo do_shortcode( $thispage->post_content );
   	get_footer($CORE->pageswitch()); 
   	
   }elseif(!_ppt_checkfile("search.php")){ 
   
   if(in_array(THEME_KEY, array("dt")) &&  _ppt('search_maps') == 1 ){ 
   	wp_enqueue_script('map', FRAMREWORK_URI.'js/backup_js/js.map.js');
   	wp_enqueue_script('map'); 
   }
   
   ?>
<?php get_header($CORE->pageswitch());  ?>
<?php get_template_part( 'page', 'top' ); ?>



<?php if(isset($GLOBALS['flag-taxonomy'])){ ?>
<?php get_template_part( 'search', 'taxonomy' ); ?>             
<?php } ?>
<?php get_template_part( 'search', 'top' ); ?>
<?php get_template_part( 'search', 'results' ); ?>
<?php echo $CORE->PAGENAV(); ?>
<?php echo $CORE->BANNER('search_page_bot','text-center my-4'); ?>
<?php get_template_part( 'page', 'bottom' ); ?>
<?php get_footer($CORE->pageswitch()); ?>
<?php } ?>