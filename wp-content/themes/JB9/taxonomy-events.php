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


$GLOBALS['flag-events'] = true;

if(!_ppt_checkfile("taxonomy-events.php")){

	$GLOBALS['flag-requires-sidebar'] = 1; 


	if(defined('IS_MOBILEVIEW')){ 
	
	get_template_part( '_mobile/page' , 'events' ); 
	
	}else{
	
 	$term = get_term_by('slug', get_query_var( 'term' ), get_query_var( 'taxonomy' ) );
 
	get_header($CORE->pageswitch()); ?>
	
	
<main id="main"> 

    <div class="container"> 

	<?php get_template_part( 'page', 'top' ); ?> 
    
    
	<div class="title-block">
                    
	<h1><?php echo $term->name; ?></h1>
    
    <p><?php echo $term->description; ?></p>
                    	
                                            
                    
		</div> <!-- end title -->  
    

	<div class="row">  
				
					<?php	
					
					$paged = ( get_query_var( 'paged' ) ) ? absint( get_query_var( 'paged' ) ) : 1;
					
					$args = array(
						'post_type' 		=> 'event',
						'posts_per_page' 	=> 15,
						'paged' 			=> $paged,
					);
					$wp_query = new WP_Query($args);
					 
					if ( $wp_query->have_posts() ) :
														 
					while ( $wp_query->have_posts() ) :  $wp_query->the_post(); 
					 
					?>
					
					<?php get_template_part( 'content', 'event' ); ?>
				   
					<?php endwhile; endif; ?>
					
	</div><!-- end row -->
	
	<?php echo $CORE->PAGENAV(); ?> 
			 
	<?php wp_reset_query(); ?>
    
    
	<?php get_template_part( 'page', 'bottom' ); ?>  

	</div><!-- end container -->
 
</main><!-- end main -->
			
	<?php get_footer($CORE->pageswitch()); ?>
	
	<?php } ?>

<?php } ?>