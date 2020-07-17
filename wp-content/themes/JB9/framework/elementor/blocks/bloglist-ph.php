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
 
global $CORE, $post, $userdata, $settings;

?>
 
<div class="bloglist-6-scroller-with-big-date">
<?php	
              
               $args = array(
                   'post_type' 			=> 'post',
                   'posts_per_page' 	=> $settings['amount'],
				   'offset' 			=> -1, 
               );
               $wp_query = new WP_Query($args); 
			
			   // COUNT EXISTING ADVERTISERS	 
	  		   $tt = $wpdb->get_results($wp_query->request, OBJECT);
			   
if(!empty($tt)){
 foreach($tt as $p){
			  
	$post = get_post($p->ID);
				  
	$day 	= date("d", strtotime(get_the_date()));
	$month 	= date("M", strtotime(get_the_date()));
	$year 	= date("Y", strtotime(get_the_date()));

?>            

<div class="blox-scroller-box bg-primary">
                <a href="<?php the_permalink(); ?>" class="flex-container">
                	<div class="blox-calendar bg-primary ">
                        <div class="blox-calendar-box">
                            <div class="blox-calendar-date"><?php echo $day; ?></div>
                            <div class="blox-calendar-month"><?php echo $month; ?></div>
                        </div>
                    </div>
                    
                    <div class="blox-scroller-content bg-dark">
                        <div class="blox-heading"><?php the_title(); ?></div>
                        <div class="blox-paragraph"><?php echo do_shortcode('[EXCERPT limit=90]'); ?>...</div>
                    </div>
                </a>
            </div>
   <?php }}?>

<?php wp_reset_query(); ?>  

</div>