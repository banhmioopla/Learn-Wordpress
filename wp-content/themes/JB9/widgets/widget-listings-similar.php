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
   
   global $CORE, $userdata, $settings, $post; 
   
   if(!_ppt_checkfile("widget-listings-similar.php")){
   
   $cat = get_the_terms($post->ID, 'listing');	
   
   ?>
<div class="widget blog-recent">
   <div class="widget-wrap">
      <div class="widget-block">
         <?php 
   
   // WIDGET OPTION
   // SHOW TITLE
  if(!isset($settings['show_title']) || ( isset($settings['show_title']) && $settings['show_title'] != 0) ){ ?>
         <div class="widget-title"><span><?php echo __("Similar Listings","premiumpress") ?></span></div>
         <?php } ?>
         <div class="widget-content">
            <ul class="sidebar-post list-unstyled">
               <?php	
                  
                $args = array('posts_per_page' => 5, 
				'post_type' => 'listing_type', 'orderby' => 'name', 'order' => 'desc', 'paged'  => 1, 'offset'  => 0 );
				 
				 if(isset($categories[0])){
				 $args['tax_query'][] = array(
							'taxonomy' => "listing",
							'field' => 'term_id',
							'terms' => $categories[0]->term_id,
							'operator'=> 'IN'	,
							//'include_children' => true,						
				 );
				 } 
				  
                  $wp_query = new WP_Query($args);                   
                  if ( $wp_query->have_posts() ) :                                                       
                  while ( $wp_query->have_posts() ) :  $wp_query->the_post();                  
                  ?>
               <li class="clearfix">
                  <a href="<?php the_permalink(); ?>">
                     <div class="image mt-0">
                        <?php if ( has_post_thumbnail() ) { ?>
                        <?php the_post_thumbnail(array(80,80, 'class'=> " img-fluid")); ?>
                        <?php }else{ ?>
                        <?php echo do_shortcode('[IMAGE link=0]'); ?> 
                        <?php } ?>
                     </div>
                     <div class="content">
                        <h6><?php the_title(); ?></h6>
                        <p class="recent-post-sm-meta">
                        <?php echo do_shortcode('[PRICE]'); ?>
                        </p>
                     </div>
                  </a>
               </li>
               <?php endwhile; endif; ?> 
               <?php wp_reset_query(); ?>
            </ul>
         </div>
      </div>
   </div>
</div>
<?php } ?>