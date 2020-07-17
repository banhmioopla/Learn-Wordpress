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

 
if(defined('IS_MOBILEVIEW')){	

	get_template_part( '_mobile/page' , 'blog' ); 	

}else{ 

// FORCE SIDEBAR
if(!defined('SIDEBAR')){
define('SIDEBAR', true);
}

if($post->post_type == "post"){
	$GLOBALS['flag-blog'] = true;
	unset($GLOBALS['flag-search']);
}
get_header($CORE->pageswitch());
get_template_part( 'page', 'top' ); ?>
<div class="row pr-lg-3"> 
<?php
if ( have_posts() ) : while ( have_posts() ) : the_post();  	
	get_template_part( 'content', 'post' );
endwhile; endif; ?>
</div>
<?php
echo $CORE->PAGENAV();
wp_reset_query(); 
get_template_part( 'page', 'bottom' );
get_footer($CORE->pageswitch());
}  ?>