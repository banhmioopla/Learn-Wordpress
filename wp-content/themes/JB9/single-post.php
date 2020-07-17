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
   
   $GLOBALS['flag-blog'] = true;
   
   if(!_ppt_checkfile("single-post.php")){
   
   if(!defined('SIDEBAR-LEFT') && !defined('SIDEBAR')){
   define('SIDEBAR', true);
   }
   
   function _hook_head(){
   ?>
	<script src='https://www.google.com/recaptcha/api.js'></script>
    <?php }
   if(_ppt('comment_captcha') == 1 && _ppt('google_recap_sitekey') != ""){
   add_action('wp_head','_hook_head');
   }
   
   global $post, $CORE;
   
   // UPDATE HITS
   $hits = get_post_meta($post->ID,'hits',true);
   if(!is_numeric($hits)){ $hits = 0; }
   update_post_meta($post->ID, 'hits',  $hits + 1 );
   $hits++;
   
   get_header($CORE->pageswitch()); get_template_part( 'page', 'top' );
   
   if (have_posts()) : while (have_posts()) : the_post();  ?>
<section>
   <div class="blog-content mb-4 shadow-sm">
      <?php echo do_shortcode('[IMAGE link=0]'); ?>
      <div class="bg-white p-lg-5 border">
   
         <div class="typography p-3 p-lg-0">
            <h1 class="mb-4"><?php echo do_shortcode('[TITLE]'); ?></h1>
            <div class="text-muted mb-4">
            <i class="fal fa-calendar" aria-hidden="true"></i> <?php echo get_the_date(); ?> <?php the_category(','); ?>
            </div>
            <?php echo do_shortcode('[CONTENT media=0]'); ?>
            
         <?php if ( comments_open() && _ppt('comments') == 1 ){ ?>
                 
            <?php echo do_shortcode('[COMMENTS]'); ?>
       
         <?php } ?>            
         </div>

      </div>
   </div>
</section>
<?php endwhile; endif; ?>
<?php get_template_part( 'page', 'bottom' ); get_footer($CORE->pageswitch()); ?>
<?php } ?>