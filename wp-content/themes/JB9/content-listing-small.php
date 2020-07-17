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

global $CORE, $post; 

?>
<li>
<a href="<?php the_permalink(); ?>">
                 
<?php echo do_shortcode('[IMAGE link=0]'); ?>
 
<div class="content">
<h5 class="h5-xs mb-1"><?php the_title(); ?></h5>
<div class="amount text-muted txt-500"><?php echo do_shortcode('[PRICE]'); ?></div>
</div>
</a>
</li>