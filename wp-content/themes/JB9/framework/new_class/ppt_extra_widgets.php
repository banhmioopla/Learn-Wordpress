<?php

class core_widget_button extends WP_Widget {
    function __construct(){
        // widget actual processes		
		$opts = array(
			'classname' => 'core_widget_button',
			'description' => 'This will display the add listing button.' 
		);
		parent::__construct( 'core_widget_button',  '{ Sidebar - Add Button }' , $opts );		
    }
	
	function form($instance) {
	
	global $wpdb;		 
				
		$defaults = array( 'title' => 'Add Listing' );					
		$instance = wp_parse_args( $instance, $defaults ); 
		?>
        
        <div style="padding:20px;">        
        <div class="widget_title">Button Text</div>                
        <input type="text" style="margin-bottom:20px;" class="widget_input" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php echo esc_attr( $instance['title'] ); ?>" />    
        
        </div>
	<?php 
				
	}
	function update( $new, $old )	{		
		$clean = $new;
		$clean['title'] = $new['title'];			
		return $clean;
	}
	
    function widget($args, $instance) {
	global $settings;	
	$settings = $instance;	
	get_template_part( 'widgets/widget', 'button' ); 
    }
} // END BLANK WIDGET



class core_widget_search extends WP_Widget {
    function __construct(){
        // widget actual processes		
		$opts = array(
			'classname' => 'core_widget_search',
			'description' => 'This will display the search widget.' 
		);
		parent::__construct( 'core_widget_search',  '{ Sidebar - Search Box  }' , $opts );		
    }
	
	
	function form($instance) {
	
	global $wpdb;
		
  		$defaultsFields = array( 
		'title' => 'Quick Search', 
		'show_title' => 'Show Title', 
		'show_cats' => 'Show Field - Category',  
 
		 );
				
		$defaults = array( 'show_title' => '1', 'show_cats' => '1',  );
			
 
		foreach($defaults as $k => $v){
		if($k == "title"){ continue; }
		$clean[$k] = isset( $new[$k] ) ? '1' : '0';
		}	
			
		$instance = wp_parse_args( $instance, $defaults );  		
	  
		?>
        
        <div style="padding:20px;">
        
        <div class="widget_title">Widget Title</div>
                
        <input type="text" style="margin-bottom:20px;" class="widget_input" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php echo esc_attr( $instance['title'] ); ?>" />
         
         
        <?php foreach($defaultsFields as $k => $v){
		if($k == "title"){ continue; }
		 ?>
        <br />
        <input id="<?php echo $this->get_field_id($k); ?>"  name="<?php echo $this->get_field_name($k); ?>"  type="checkbox" 
		<?php echo checked(isset($instance[$k])? $instance[$k]: 0, true, false); ?> /> <?php echo $v; ?>
        <br />
        <?php } ?> 
        
        </div>

	<?php  
				
	}
	function update( $new, $old )	{		
		$clean = $new;	  
		$defaults = array( 'show_title' => '1', 'show_cats' => '1',     );
		foreach($defaults as $k => $v){
		$clean[$k] = isset( $new[$k] ) ? '1' : '0';
		}	
			
		return $clean;
	}
    function widget($args, $instance) {
		global $settings;
		
		$settings = $instance;	 
		 		
		get_template_part( 'widgets/widget', 'search' ); 
	}
 
} // END BLANK WIDGET

class core_widget_categories extends WP_Widget {
    function __construct(){
        // widget actual processes		
		$opts = array(
			'classname' => 'core_widget_categories',
			'description' => 'This will display the categories widget.' 
		);
		parent::__construct( 'core_widget_categories',  '{ Sidebar - Categories }' , $opts );		
    }
	
	
	function form($instance) {
	
	global $wpdb;		 
				
		$defaults = array( 'title' => 'Popular Categories', 'num' => '20', 'show_title' => '1' );					
		$instance = wp_parse_args( $instance, $defaults ); 
	
		?>
        
        <div style="padding:20px;">        
        <div class="widget_title">Widget Title</div>                
        <input type="text" style="margin-bottom:20px;" class="widget_input" id="<?php echo $this->get_field_id( 'title' ); ?>"
         name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php echo esc_attr( $instance['title'] ); ?>" />
        
         <br />
        <input id="<?php echo $this->get_field_id('show_title'); ?>"  name="<?php echo $this->get_field_name('show_title'); ?>" value="1"  type="checkbox" 
		<?php echo checked($instance['show_title'], 1, 0); ?> /> Show Title
         <br />      
       
        
        <div class="widget_title" style="margin-top:30px;">Display Amount</div>                
        <input type="text" style="margin-bottom:20px; width:100px;" class="widget_input" id="<?php echo $this->get_field_id( 'num' ); ?>" name="<?php echo $this->get_field_name( 'num' ); ?>" value="<?php echo esc_attr( $instance['num'] ); ?>" />
       
        </div>
	<?php 
				
	}
	function update( $new, $old )	{	
		$clean = $new;
		$clean['show_title'] = isset( $new['show_title'] ) ? '1' : '0';		
		return $clean;
	}	
    function widget($args, $instance) {
	global $settings;		
	$settings = $instance;	
	get_template_part( 'widgets/widget', 'categories' ); 
    }
} // END BLANK WIDGET











class core_widget_categorylist extends WP_Widget {
    function __construct(){
        // widget actual processes		
		$opts = array(
			'classname' => 'core_widget_categorylist',
			'description' => 'This will display the category list widget.' 
		);
		parent::__construct( 'core_widget_categorylist',  '{ Sidebar - Category List }' , $opts );		
    }
	
	function form($instance) {
	
	global $wpdb;
				
		$defaults = array( 'title' => 'Category List',  );	 			
		$instance = wp_parse_args( $instance, $defaults );  	
	  
		?>
        
        <div style="padding:20px;">
        
        <div class="widget_title">Widget Title</div>
                
        <input type="text" style="margin-bottom:20px;" class="widget_input" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php echo esc_attr( $instance['title'] ); ?>" />
        </div>

	<?php  
				
	}
	function update( $new, $old )	{		
		$clean = $new;	 
		return $clean;
	}
    function widget($args, $instance) {
	global $settings;	
	
	$settings = $instance;	
	get_template_part( 'widgets/widget', 'categorylist' ); 
    }
} // END BLANK WIDGET

class core_widget_recent extends WP_Widget { 
    function __construct(){
        // widget actual processes		
		$opts = array(
			'classname' => 'core_widget_recent',
			'description' => 'This will display the recent listings widget.' 
		);
		parent::__construct( 'core_widget_recent',  '{ Sidebar - Recent Listings }' , $opts );		
    }
	function form($instance) {
	
	global $wpdb;		 
				
		$defaults = array( 'title' => 'Recent Listings', 'num' => '10', 'show_title' => '1' );					
		$instance = wp_parse_args( $instance, $defaults ); 
	
		?>
        
        <div style="padding:20px;">        
        <div class="widget_title">Widget Title</div>                
        <input type="text" style="margin-bottom:20px;" class="widget_input" id="<?php echo $this->get_field_id( 'title' ); ?>"
         name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php echo esc_attr( $instance['title'] ); ?>" />
        
         <br />
        <input id="<?php echo $this->get_field_id('show_title'); ?>"  name="<?php echo $this->get_field_name('show_title'); ?>" value="1"  type="checkbox" 
		<?php echo checked($instance['show_title'], 1, 0); ?> /> Show Title
         <br />      
       
        
        <div class="widget_title" style="margin-top:30px;">Display Amount</div>                
        <input type="text" style="margin-bottom:20px; width:100px;" class="widget_input" id="<?php echo $this->get_field_id( 'num' ); ?>" name="<?php echo $this->get_field_name( 'num' ); ?>" value="<?php echo esc_attr( $instance['num'] ); ?>" />
       
        </div>
	<?php 
				
	}
	function update( $new, $old )	{	
		$clean = $new;
		$clean['show_title'] = isset( $new['show_title'] ) ? '1' : '0';		
		return $clean;
	}	
	
    function widget($args, $instance) {
		global $settings;	
		$settings = $instance;			
	get_template_part( 'widgets/widget', 'listings-recent' ); 
    }
} // END BLANK WIDGET



class core_widget_featured extends WP_Widget {
    function __construct(){
        // widget actual processes		
		$opts = array(
			'classname' => 'core_widget_featured',
			'description' => 'This will display the featured listings widget.' 
		);
		parent::__construct( 'core_widget_featured',  '{ Sidebar - Featured Listings }' , $opts );		
    }
	function form($instance) {
	
	global $wpdb;		 
				
		$defaults = array( 'title' => 'Featured Listings', 'num' => '10', 'show_title' => '1' );					
		$instance = wp_parse_args( $instance, $defaults ); 
	
		?>
        
        <div style="padding:20px;">        
        <div class="widget_title">Widget Title</div>                
        <input type="text" style="margin-bottom:20px;" class="widget_input" id="<?php echo $this->get_field_id( 'title' ); ?>"
         name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php echo esc_attr( $instance['title'] ); ?>" />
        
         <br />
        <input id="<?php echo $this->get_field_id('show_title'); ?>"  name="<?php echo $this->get_field_name('show_title'); ?>" value="1"  type="checkbox" 
		<?php echo checked($instance['show_title'], 1, 0); ?> /> Show Title
         <br />      
       
        
        <div class="widget_title" style="margin-top:30px;">Display Amount</div>                
        <input type="text" style="margin-bottom:20px; width:100px;" class="widget_input" id="<?php echo $this->get_field_id( 'num' ); ?>" name="<?php echo $this->get_field_name( 'num' ); ?>" value="<?php echo esc_attr( $instance['num'] ); ?>" />
       
        </div>
	<?php 
				
	}
	function update( $new, $old )	{	
		$clean = $new;
		$clean['show_title'] = isset( $new['show_title'] ) ? '1' : '0';		
		return $clean;
	}	
	
    function widget($args, $instance) {
		global $settings;	
		$settings = $instance;		
		get_template_part( 'widgets/widget', 'listings' ); 
    }
} // END BLANK WIDGET


class core_widget_social extends WP_Widget {
    function __construct(){
        // widget actual processes		
		$opts = array(
			'classname' => 'core_widget_social',
			'description' => 'This will display basic social icons.' 
		);
		parent::__construct( 'core_widget_social',  '{ Sidebar - Social Media }' , $opts );		
    }
    function widget($args, $instance) {
	global $settings;		
	get_template_part( 'widgets/widget', 'social' ); 
    }
} // END BLANK WIDGET

class core_widget_newsletter extends WP_Widget {
    function __construct(){
        // widget actual processes		
		$opts = array(
			'classname' => 'core_widget_newsletter',
			'description' => 'This will display the newsletter widget.' 
		);
		parent::__construct( 'core_widget_newsletter',  '{ Sidebar - Newsletter }' , $opts );		
    }
	function form($instance) {
	 
	global $wpdb;		 
				
		$defaults = array( 'title' => 'SIGN UP FOR NEWSLETTER', 'show_title' => '1', 'desc' => 'Sign up to get our latest exclusive updates, deals, offers and promotions.' );					
		$instance = wp_parse_args( $instance, $defaults ); 
	 
		?>
        
        <div style="padding:20px;">        
        <div class="widget_title">Title</div>                
        <input type="text" style="margin-bottom:20px;" class="widget_input" id="<?php echo $this->get_field_id( 'title' ); ?>"
         name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php echo esc_attr( $instance['title'] ); ?>" />
        
         <br />
         
         <div class="widget_title">Description</div>                
        <input type="text" style="margin-bottom:20px;" class="widget_input" id="<?php echo $this->get_field_id( 'desc' ); ?>"
         name="<?php echo $this->get_field_name( 'desc' ); ?>" value="<?php echo esc_attr( $instance['desc'] ); ?>" />
        
         <br />
        <input id="<?php echo $this->get_field_id('show_title'); ?>"  name="<?php echo $this->get_field_name('show_title'); ?>" value="1"  type="checkbox" 
		<?php echo checked($instance['show_title'], 1, 0); ?> /> Show Title
         <br />      
       
 
        </div>
	<?php 
				
	}
	function update( $new, $old )	{	
		$clean = $new;
		$clean['show_title'] = isset( $new['show_title'] ) ? '1' : '0';		
		return $clean;
	}
    function widget($args, $instance) {
	global $settings;	
	
	$settings = $instance;		
	get_template_part( 'widgets/widget', 'newsletter' ); 
    }
} // END BLANK WIDGET



class core_widget_single_likes extends WP_Widget {
    function __construct(){
        // widget actual processes		
		$opts = array(
			'classname' => 'core_widget_single_likes',
			'description' => 'This will display the likes bar for single listing pages.' 
		);
		parent::__construct( 'core_widget_single_likes',  '[SINGLE] Likes Bar' , $opts );		
    }
    function widget($args, $instance) {
	global $settings;		
	get_template_part( 'widgets/widget', 'likes' ); 
    }
} // END BLANK WIDGET


class core_widget_single_nearby extends WP_Widget {
    function __construct(){
        // widget actual processes		
		$opts = array(
			'classname' => 'core_widget_single_nearby',
			'description' => 'This will display a related items box.' 
		);
		parent::__construct( 'core_widget_single_nearby',  '[SINGLE] Related' , $opts );		
    }
    function widget($args, $instance) {
	global $settings;		
	get_template_part( 'widgets/widget-single', 'nearby' ); 
    }
} // END BLANK WIDGET


class core_widget_single_title extends WP_Widget {
    function __construct(){
        // widget actual processes		
		$opts = array(
			'classname' => 'core_widget_single_title',
			'description' => 'This will display the page header box.' 
		);
		parent::__construct( 'core_widget_single_title',  '[SINGLE] Title - Full Width' , $opts );		
    }
    function widget($args, $instance) {
	global $settings;		
	get_template_part( 'widgets/widget-single', 'title' ); 
    }
} // END BLANK WIDGET

class core_widget_single_images extends WP_Widget {
    function __construct(){
        // widget actual processes		
		$opts = array(
			'classname' => 'core_widget_single_images',
			'description' => 'This will display the title &amp; image box.' 
		);
		parent::__construct( 'core_widget_single_images',  '[SINGLE] Title + Images' , $opts );		
    }  
    function widget($args, $instance) {
	global $settings; 
	get_template_part( 'widgets/widget-single', 'images' ); 
    }
} // END BLANK WIDGET

class core_widget_single_video extends WP_Widget {
    function __construct(){
        // widget actual processes		
		$opts = array(
			'classname' => 'core_widget_single_video',
			'description' => 'This will display the video box.' 
		);
		parent::__construct( 'core_widget_single_video',  '[SINGLE] Video Box' , $opts );		
    }
    function widget($args, $instance) {
	global $settings;	 
	get_template_part( 'widgets/widget-single', 'video' ); 
    }
} // END BLANK WIDGET

class core_widget_single_content extends WP_Widget {
    function __construct(){
        // widget actual processes		
		$opts = array(
			'classname' => 'core_widget_single_content',
			'description' => 'This will display the listing description box.' 
		);
		parent::__construct( 'core_widget_single_content',  '[SINGLE] Description' , $opts );		
    }
	function form($instance) {	
 		
		$defaultsFields = array( 
		'show_title' => 'Show Title', 
		'show_desc' => 'Show Description',  
		'show_photos' => 'Show Photos', 
		'show_video' => 'Show Video', 
		'show_comments' => 'Show Reviews', 
		 );
				
		$defaults = array( 'show_title' => '0', 'show_desc' => '1',  'show_photos' => '1', 'show_video' => '1', 'show_comments' => '1' );				
		$instance = wp_parse_args( $instance, $defaults );  	
		?>        
        <?php foreach($defaultsFields as $k => $v){ ?>
        <br />
        <input id="<?php echo $this->get_field_id($k); ?>"  name="<?php echo $this->get_field_name($k); ?>"  type="checkbox" 
		<?php echo checked(isset($instance[$k])? $instance[$k]: 0, true, false); ?> /> <?php echo $v; ?>
        <br />
        <?php } ?>        
        <?php		 		
	}
	function update( $new, $old )	{		
		$clean = $old;	 
		
		$defaults = array( 'show_title' => '0', 'show_desc' => '1',  'show_photos' => '1', 'show_video' => '1',  'show_comments' => '1'  );
		foreach($defaults as $k => $v){
		$clean[$k] = isset( $new[$k] ) ? '1' : '0';
		}		
		return $clean;
	}
    function widget($args, $instance) {
	global $settings;	 
	$defaults = array( 'show_title' => '0', 'show_desc' => '1',  'show_photos' => '1', 'show_video' => '1',  'show_comments' => '1'  );
	foreach($defaults as $k => $v){
		if(!isset($instance[$k])){ $instance[$k] = 1; }
		$settings[$k] = $instance[$k];
	}
	get_template_part( 'widgets/widget-single', 'content' ); 
    }
} // END BLANK WIDGET
 
 
class core_widgets_blank extends WP_Widget {

    function __construct(){
        // widget actual processes		
		$opts = array(
			'classname' => 'core_blank',
			'description' => 'A blank space for custom Text/HTML code.' 
		);
		parent::__construct( 'core_blank',  'Blank Widget' , $opts );		
    }
    function form($instance) {   
	$defaults = array('te' => '');
		$instance = wp_parse_args( $instance, $defaults );		
	 ?>
     <div style="  background: #F7F7F7;  border: 1px solid #ddd;  padding: 10px; padding-top:0px;  margin-top: 20px; margin-bottom:20px;"> 

     <p><b>Content:</b></p>  
  	 <p><textarea class="widefat" rows="16" cols="20" id="<?php echo $this->get_field_id( 'te' ); ?>" name="<?php echo $this->get_field_name( 'te' ); ?>"><?php echo esc_attr( $instance['te'] ); ?></textarea></p>
     <?php

		$out = '<p><label for="' . $this->get_field_id('filter') . '">Automatically add paragraphs to text</label>&nbsp;&nbsp;';
		$out .= '<input id="' . $this->get_field_id('filter') . '" name="' . $this->get_field_name('filter') . '" type="checkbox" ' . checked(isset($instance['filter'])? $instance['filter']: 0, true, false) . ' /></p>';
		echo $out;
	?>
    </div>
    <?php
    }
	function update( $new, $old )
	{	
		$clean = $old;
		if (current_user_can('unfiltered_html')) {
		  $clean['te'] = $new['te'];
		} else {
		  $clean['te'] = stripslashes(wp_filter_post_kses(addslashes($new['te'])));
		}
		
		$clean['filter'] = isset($new['filter']);		
		return $clean;
	}
    function widget($args, $instance) {
        // outputs the content of the widget
		
	global $PPT,$CORE; $STRING = ""; @extract($args);
	  
	if ($instance['filter']) {
      $instance['te'] = wpautop($instance['te']);
    }
		echo do_shortcode(stripslashes($instance['te'])); 
 
    }

} // END BLANK WIDGET

 



class core_widget_elementor extends WP_Widget {

    function __construct(){
        // widget actual processes		
		$opts = array(
			'classname' => 'core_widget_elementor',
			'description' => 'This will display an Elentor section.' 
		);
		parent::__construct( 'core_widget_elementor',  '{ Sidebar - Elementor Content }' , $opts );		
    }
	
	
	function form($instance) {
	
	global $wpdb;
		
 		$defaults = array( 'element_id'		=> '' );		
		$instance = wp_parse_args( $instance, $defaults );  		
	 
		 
		$elementorArray = array();
		$args = array('post_type' 			=> 'elementor_library', 'posts_per_page' 	=> 100  );
		$wp_query = new WP_Query($args);
		$tt = $wpdb->get_results($wp_query->request, OBJECT);
		if(!empty($tt)){ foreach($tt as $p){
		$elementorArray[$p->ID] = get_the_title($p->ID);
		} }
		if(!empty($elementorArray)){
		?>
        
        
        <br /><br /><strong>Select Elementor Template</strong> <br /><br />
        
		<select  id="<?php echo $this->get_field_id( 'element_id' ); ?>" name="<?php echo $this->get_field_name( 'element_id' ); ?>">
		<?php  foreach ( $elementorArray as $key => $title ) { ?>
		<option value="<?php echo $key; ?>" <?php if( esc_attr( $instance['element_id'] ) == $key){ echo "selected=selected"; } ?>><?php echo $key; ?> - <?php echo $title; ?></option>
		<?php } ?>
		</select>
		<?php }  
				
	}
	function update( $new, $old )	{		
		$clean = $old;	  
	 	$clean['element_id'] = isset( $new['element_id'] ) ? $new['element_id'] : '0';
		return $clean;
	}
	
    function widget($args, $instance) {	
	
	global $settings;
	if(!isset($instance['element_id'])){ $instance['element_id'] = ""; }
	$settings['element_id'] = $instance['element_id'];
		
	get_template_part( 'widgets/widget', 'elementor' );
 
    }

} // END BLANK WIDGET


class core_widget_blog_categories extends WP_Widget {

    function __construct(){
        // widget actual processes		
		$opts = array(
			'classname' => 'core_widget_blog_categories',
			'description' => 'This will display the blog categories widget.' 
		);
		parent::__construct( 'core_widget_blog_categories',  '{ Blog Sidebar - Categories }' , $opts );		
    }
	function form($instance) {
	
	global $wpdb;		 
				
		$defaults = array( 'title' => 'Popular Categories', 'num' => '20', 'show_title' => '1' );					
		$instance = wp_parse_args( $instance, $defaults ); 
	
		?>
        
        <div style="padding:20px;">        
        <div class="widget_title">Widget Title</div>                
        <input type="text" style="margin-bottom:20px;" class="widget_input" id="<?php echo $this->get_field_id( 'title' ); ?>"
         name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php echo esc_attr( $instance['title'] ); ?>" />
        
         <br />
        <input id="<?php echo $this->get_field_id('show_title'); ?>"  name="<?php echo $this->get_field_name('show_title'); ?>" value="1"  type="checkbox" 
		<?php echo checked($instance['show_title'], 1, 0); ?> /> Show Title
         <br />       
       
        </div>
	<?php 
				
	}
	function update( $new, $old )	{	
		$clean = $new;
		$clean['show_title'] = isset( $new['show_title'] ) ? '1' : '0';		
		return $clean;
	}	
    function widget($args, $instance) {
	global $settings;		
	$settings = $instance;	
		get_template_part( 'widgets/widget', 'blog-categories' );
 
    }

} // END BLANK WIDGET

class core_widget_blog_recent extends WP_Widget {

    function __construct(){
        // widget actual processes		
		$opts = array(
			'classname' => 'core_widget_blog_recent',
			'description' => 'This will display the new blog posts widget.' 
		);
		parent::__construct( 'core_widget_blog_recent',  '{ Blog Sidebar - New Posts  }' , $opts );		
    }
	function form($instance) {
	
	global $wpdb;		 
				
		$defaults = array( 'title' => 'Popular Blog Posts', 'num' => '5', 'show_title' => '1' );					
		$instance = wp_parse_args( $instance, $defaults ); 
	
		?>
        
        <div style="padding:20px;">        
        <div class="widget_title">Widget Title</div>                
        <input type="text" style="margin-bottom:20px;" class="widget_input" id="<?php echo $this->get_field_id( 'title' ); ?>"
         name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php echo esc_attr( $instance['title'] ); ?>" />
        
         <br />
        <input id="<?php echo $this->get_field_id('show_title'); ?>"  name="<?php echo $this->get_field_name('show_title'); ?>" value="1"  type="checkbox" 
		<?php echo checked($instance['show_title'], 1, 0); ?> /> Show Title
         <br />      
       
        
        <div class="widget_title" style="margin-top:30px;">Display Amount</div>                
        <input type="text" style="margin-bottom:20px; width:100px;" class="widget_input" id="<?php echo $this->get_field_id( 'num' ); ?>" name="<?php echo $this->get_field_name( 'num' ); ?>" value="<?php echo esc_attr( $instance['num'] ); ?>" />
       
        </div>
	<?php 
				
	}
	function update( $new, $old )	{	
		$clean = $new;
		$clean['show_title'] = isset( $new['show_title'] ) ? '1' : '0';		
		return $clean;
	}	
    function widget($args, $instance) {
	global $settings;	
		$settings = $instance;
		get_template_part( 'widgets/widget', 'blog-recent' );
 
    }

} // END BLANK WIDGET


class core_widget_single_contactform extends WP_Widget {

    function __construct(){
        // widget actual processes		
		$opts = array(
			'classname' => 'core_widget_single_contactform',
			'description' => 'This will display a contact form for the listing page.' 
		);
		parent::__construct( 'core_widget_single_contactform',  '[LISTING] - Contact Form' , $opts );		
    }
	function form($instance) {	
 		$defaults = array( 'show_title'		=> '1', "title" => "Contact Me");		
		$instance = wp_parse_args( $instance, $defaults );  
		
		?>
        <div style="padding:20px;">        
        <div class="widget_title">Widget Title</div>                
        <input type="text" style="margin-bottom:20px;" class="widget_input" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php echo esc_attr( $instance['title'] ); ?>" />
        
        <?php	
		echo '<input id="' . $this->get_field_id('show_title') . '" 
		name="' . $this->get_field_name('show_title') . '" 
		type="checkbox" ' . checked(isset($instance['show_title'])? $instance['show_title']: 0, true, false) . ' /> Show Widget Title ';
		?>
        </div>
        <?php
        		
	}
	function update( $new, $old )	{		
		$clean = $old;	  
		$clean['show_title'] = isset( $new['show_title'] ) ? '1' : '0';
		$clean['title'] = $new['title'];		
		return $clean;
	}
    function widget($args, $instance) {
		global $settings;
		$settings = $instance;
		get_template_part( 'widgets/widget', 'single-contactform' ); 
 
    }

} // END BLANK WIDGET
 
?>