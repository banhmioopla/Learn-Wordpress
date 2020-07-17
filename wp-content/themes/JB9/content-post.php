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
   
   if(!_ppt_checkfile("content-post.php")){
   
   global $CORE, $post;
    
    
   $day 	= date("d", strtotime(get_the_date('Y-m-d',$post->ID)));
   $month 	= date("M", strtotime(get_the_date('Y-m-d',$post->ID)));
   $year 	= date("Y", strtotime(get_the_date('Y-m-d',$post->ID)));
    
   
   ?>
<div class="listing-list-item border-bottom blog">
<div class="listing-wrap clearfix p-4 "  style="box-shadow:none"> 

   <div class="image">
   <a href="<?php echo get_permalink($post->ID); ?>">
      <figure class="mb-0">
         <?php echo do_shortcode('[IMAGE link=0]'); ?> 
      </figure>          
   </a>
   </div> 
 
   <div class="content p-0 pl-md-4">
   
    <!-- title -->
    <a href="<?php echo get_permalink($post->ID); ?>" class="text-dark">
	<h4><?php echo do_shortcode('[TITLE]'); ?></h4>
    </a> 
    
    <!--  list -->
    <ul class="list-links list-inline">

    <li class="list-inline-item"><i class="fal fa-calendar" aria-hidden="true"></i> <?php echo hook_date($post->post_date); ?> </li>
    </ul>
    
    <!-- excerpt -->
    <p class="desc">
    <?php echo do_shortcode('[EXCERPT]'); ?>
    </p>
    
    <!-- link list -->
    <ul class="list-links list-inline">
    <li class="list-inline-item"><a href="<?php echo get_permalink(); ?>" class="btn btn-primary btn-sm text-uppercase btn-block rounded-0 text-white"><?php echo __( 'Read More', 'premiumpress' ); ?></a></li>
    </ul>
    
           
   </div>


</div> 
</div>
<?php } ?>