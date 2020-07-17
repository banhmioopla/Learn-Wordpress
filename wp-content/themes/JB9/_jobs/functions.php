<?php
define('THEME_NAME','Jobs Theme');
  
// SET THE THEME FOLDER
define('THEME_FOLDER','_jobs'); 
define('THEME_KEY','jb');

// SET THE ADMIN LABEL
define('THEME_LISING_CAPTION', 'jobs');

// SET THE ADMIN PANEL BOX
define('THEME_LISING_IMAGES', true);

// SET THE ADMIN MAP PANEL
define('THEME_LISING_MAP', true);
define('GOOGLE-MAPS', true);


class widget_jobs_content extends WP_Widget {
    function __construct(){
        // widget actual processes		
		$opts = array(
			'classname' => 'widget_jobs_content',
			'description' => 'This will display the jobs content box.' 
		);
		parent::__construct( 'widget_jobs_content',  '[JB] - Content Area' , $opts );		
    }
	function form($instance) {	
 		
		$defaultsFields = array( 'show_desc' => 'Show Description',  'show_r' => 'Show Responsibilities', 'show_q' => 'Show Qualifications', 'show_l' => 'Show Location' );		
		$defaults = array( 'show_desc' => '1',  'show_r' => '1', 'show_q' => '1', 'show_l' => '1' );				
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
		
		$defaults = array( 'show_desc' => '1',  'show_r' => '1', 'show_q' => '1', 'show_l' => '1' );
		foreach($defaults as $k => $v){
		$clean[$k] = isset( $new[$k] ) ? '1' : '0';
		}		
		return $clean;
	}
    function widget($args, $instance) {
	global $settings;	 
	$defaults = array( 'show_desc' => '1',  'show_r' => '1', 'show_q' => '1', 'show_l' => '1' );
	foreach($defaults as $k => $v){
		if(!isset($instance[$k])){ $instance[$k] = 1; }
		$settings[$k] = $instance[$k];
	}
	get_template_part( '_jobs/widgets/widget', 'content' ); 
    }
} // END BLANK WIDGET


 
class widget_jobs_register extends WP_Widget {
    function __construct(){
        // widget actual processes		
		$opts = array(
			'classname' => 'widget_jobs_register',
			'description' => 'This will display the register box.' 
		);
		parent::__construct( 'widget_jobs_register',  '[JB] - Register Box' , $opts );		
    }

    function widget($args, $instance) {	
	get_template_part( '_jobs/widgets/widget', 'register' ); 
    }
} // END BLANK WIDGET
class widget_jobs_details extends WP_Widget {
    function __construct(){
        // widget actual processes		
		$opts = array(
			'classname' => 'widget_jobs_details',
			'description' => 'This will display the details box.' 
		);
		parent::__construct( 'widget_jobs_details',  '[JB] - Company Details' , $opts );		
    }
    function widget($args, $instance) {
	global $settings;		
	get_template_part( '_jobs/widgets/widget', 'companydetails' ); 
    }
} // END BLANK WIDGET
class widget_jobs_details1 extends WP_Widget {
    function __construct(){
        // widget actual processes		
		$opts = array(
			'classname' => 'widget_jobs_details1',
			'description' => 'This will display the details1 box.' 
		);
		parent::__construct( 'widget_jobs_details1',  '[JB] - Job Details' , $opts );		
    }

    function widget($args, $instance) {
	global $settings;
		
	get_template_part( '_jobs/widgets/widget', 'jobdetails' ); 
    }
} // END BLANK WIDGET
 
class widget_jobs_title extends WP_Widget {
    function __construct(){
        // widget actual processes		
		$opts = array(
			'classname' => 'widget_jobs_title',
			'description' => 'This will display the header box.' 
		);
		parent::__construct( 'widget_jobs_title',  '[JB] - Page Header' , $opts );		
    }

    function widget($args, $instance) {
	global $settings;
		
	get_template_part( '_jobs/widgets/widget', 'title' ); 
    }
} // END BLANK WIDGET

$CORE_JOBS	= new core_jobs; 
class core_jobs{

	function _register_widgets(){ 
	 
	register_widget( 'widget_jobs_content' );
	register_widget( 'widget_jobs_details' );
	register_widget( 'widget_jobs_details1' );
	register_widget( 'widget_jobs_register' );
	register_widget( 'widget_jobs_title' );
	
	}
	
	function _hook_v9_admin_elementor_templates($c){
		
		$c['defaultlisting'] = array(
			//"image" 		=> get_template_directory_uri()."/".THEME_FOLDER.'/template/screenshot.png',
			"name" 			=> "Listing Page",
			"description" 	=> "Here you can install the listing page template file that can be modified using the Elementor page builder plugin.",
			"video" 		=> "",
			"file" 			=> __DIR__ ."/elementor/single-listing.json",
			"listingpage"	=> true,
			"page_template"	=> "elementor_header_footer",
			"noview" 		=> true,
		);	
		
		return $c;
	}
 
	function __construct(){
	
	// REGISTER WIDGETS
	add_action( 'widgets_init', array($this, '_register_widgets' ) );
	 
		if(is_admin()){	
		
			// ADD ON  PAGE LINK
			add_action('hook_admin_1_tab1_subtab2_pagelist', array($this,'_updatepagelist' ));	
			
			// ADD ON DETAILS TAB
		  	add_action('hook_v9_admin_edit_options', array($this, 	'_admin_fields' ) );		 
	 		
			// ADD DEFAULT ELEMENTOR TEMPLATE TO ADMIN PABEL
			add_filter('hook_v9_admin_elementor_templates', array($this, '_hook_v9_admin_elementor_templates'),10 ); 
			
		}		
		
		// ACCOUNT PAGE OPTIONS		
		add_filter('hook_v9_account_options', array($this, '_hook_v9_account_options'));
		
		add_action('hook_account_mydetails_after' ,  array($this, '_hook_v9_myaccount' ) ); 		
		
		// AJAX SEARCH
		add_action('init', array($this,'ajax_actions'));
	 	
		// LOAD IN FOOTER SCRIPTS
		add_action('wp_footer', array($this, '_wp_footer') );
		
		add_shortcode( 'PRICE',  array($this, 'ppt_shortcode_salary' ) );
		add_shortcode( 'SALARY',  array($this, 'ppt_shortcode_salary' ) );
		add_shortcode( 'STATUS',  array($this, 'ppt_shortcode_jobstatus' ) );
		add_shortcode( 'TYPE', array($this,'ppt_shortcode_type') );
		add_shortcode( 'COMPANY', array($this,'ppt_shortcode_company') );
		add_shortcode( 'HOURS', array($this,'ppt_shortcode_hours') );
		add_shortcode( 'EXPERIENCE', array($this,'ppt_shortcode_experience') );
		
		add_shortcode( 'APPLICANTS', array($this,'ppt_shortcode_applicants') );
		
		// add in new emails
		add_action('hook_email_list_filter', array($this, '_newemails' ) );	
 	  
		// add in new custom fields for submisison page
	 	add_action('hook_add_fieldlist',  array($this, '_hook_customfields' ) );
		
		// HOOK CUSTOM SEARCH FIELDS		
		add_filter('hook_search_addons', array($this, '_hook_search_addons') );
 		 
		// ADDON BANNERS
		add_action('hook_sellspace',  array($this, '_hook_sellspace')  ); 
		
		// ADDON REGISTER FORM
		add_action('register_form',  array($this, '_register_form')  ); 
		
		
		
		// REGISTER RESUME TYPE
		register_post_type( 'wlt_resume', 
			array(
			'hierarchical' => true,	
			  'labels' => array('name' => 'Resume'),
			  'public' => true,
			  'query_var' => true,
			  'show_ui' => true,			 
			  'exclude_from_search' => true,
			  'rewrite' => array('slug' => 'resume'),
			  'supports' 			=> array ( 'title', 'editor','author', 'post-formats', 'comments','excerpt', 'thumbnail', 'custom-fields', 'publicize', 'wpcom-markdown' ),
			  //'taxonomies' => array('category'),    
	 
		) );
		
		register_post_type( 'ppt_jobs', 
					array(
					'hierarchical' => true,	
					  'labels' => array('name' => 'Job Applications'),
					  'public' => true,
					  'query_var' => true,
					  'show_ui' => true, // dont show UI
					  'rewrite' => array('slug' => 'job')	,
					   'supports' => array ( 'title',  'custom-fields'  ),    
			 
		) ); 
		
	}
	
	function _register_form(){ global $CORE, $post, $wpdb, $userdata;
	
	?>
    
<div class="col-xs-12 col-md-12 form-group ">
<div class="row"><div class="col-md-12">
<label class="col-form-label"><?php echo __("User Type","premiumpress") ?></label>                 
</div><div class="col-md-12">            	   
        
<select name="custom[usertype]" class="form-control rounded-0" id="field-usertype">				
<option value="1" <?php if(isset($_GET['type']) && $_GET['type'] == 1){ ?>selected="selected"<?php } ?>><?php echo __("Employer","premiumpress") ?></option>
<option value="2" <?php if(isset($_GET['type']) && $_GET['type'] == 2){ ?>selected="selected"<?php } ?>><?php echo __("Job Seeker","premiumpress") ?></option>	 
</select>
        
</div></div></div>
<?php	
	
	}

 	function _newemails($c){ global $CORE, $post, $wpdb, $userdata;
	
		$new_emails = array("n8" => array('break' => '<i class="fa fa fa-legal"></i> Job Board Emails'),
		
		"application_statuschange" => array(
		
		'name' => 'Application Status Change',  		
		'desc' => 'This email is sent to applicate when their job application status has changed.',
		
		'default_subject' => "Application Status Change",
		'default_body' => 'Dear User<br><br>Your job application has been updated. <br><br> Please login and review your job center. <br><br> (website) <br><br>Kind Regards<br>Management.',
		'default_sms' => "Application Status Change",
		
		'shortcodes' => array( ), 
		
		
		),
		
		"newapply" => array(
		
		'name' => 'New Application',  		
		'desc' => 'This email is sent to the employer when they receive a new job application.',
		
		'default_subject' => "New Job Application",
		'default_body' => 'Dear User<br><br>Your job has received a new job application.<br><br> Please login and review your job center. <br><br> (website) <br><br>Kind Regards<br>Management.',
		'default_sms' => "New Job Application",
		
		'shortcodes' => array( ), 
		
		
		),
		 
		);
		
		return array_merge($c, $new_emails);
	
	}



function _hook_v9_myaccount(){ global $userdata;
?>
 <div class="col-md-6">
                     <div class="form-group">
                        <label class="control-label"> <?php echo __("My User Type","premiumpress"); ?></label>
                        <div class="controls">
                          
                          <select class="form-control" name="custom[usertype]">
                          
                          <option value="1" <?php selected( get_user_meta($userdata->ID,'usertype', true), 1 ); ?>><?php echo __("I'm an employer","premiumpress") ?></option>
                          <option value="2" <?php selected( get_user_meta($userdata->ID,'usertype', true), 2 ); ?>><?php echo __("I'm a job seeker","premiumpress") ?></option>
                          
                          </select>
                                   
                        </div>
                     </div>
                  </div>
<?php
}

	/*
		this function hooks the search fields
		and adds in the new ones
	*/
	function _hook_search_addons($addon){ global $userdata;
	 
		if( isset($_GET['exp']) && is_numeric($_GET['exp']) ){
			
			$addon["experience"]   = array(							
					'key' => "experience",
					'compare' => '=',
					'value' => $_GET['exp'],				 				
			);	
			 
		}
		
		return $addon;
	
	}


	/*
	 ADD-ON FOR THE MEMBERS ACCOUNT AREA
	*/
	function _hook_v9_account_options($list){ global $wpdb, $userdata;
	 
	//unset($list['orders']);
	//unset($list['dashboard']);	
	//unset($list['photo']);	
	//
	
	$utype = get_user_meta($userdata->ID,'usertype', true);
	
	  if($utype == 2){ // JOB SEEKER
	  $n = array(
			
			"d" => array(
				"name" => __("My Resume","premiumpress"),
				"desc" => __("Here you upload your resume.","premiumpress"),
				"link" => _ppt(array('links','resume')),
				"icon" => "fa-book",		
			), 
			);
			
			unset($list['listings']);
			unset($list['add']);	
			
	  }else{
	   $n = array(
			"e" => array(
				"name" => __("My Applications","premiumpress"),
				"desc" => __("Here you view jobs your applied for.","premiumpress"),
				"link" => _ppt(array('links','apply')),
				"icon" => "fa-book",		
			), 
			
			);	
	  }
			
			
		 
	return array_merge($n,$list);
	}

	// ADD NEW PAGE SELECTION FOR CHECKOUT IN THE ADMIN
	function _updatepagelist($c){
	 
	$c['resume'] = array("name" => "Resume");
	$c['apply'] = array("name" => "Applications");
	
	return $c;
	}

	
	function ajax_actions(){ global $CORE, $post, $wpdb;
	
	
	if(isset($_GET['qs'])){
 
		
		$ar = array();
		if(is_numeric($_GET['search'])){
		$args = array('post_type' => 'listing_type', 'paged'  => 1, 'p' =>  $_GET['search']  );
		}else{
		$args = array('posts_per_page' => 8, 'post_type' => 'listing_type', 'orderby' => 'name', 'order' => 'asc', 'paged'  => 1, 's' => esc_html($_GET['search']) );
		}
		
		 
		$custom_query = new WP_Query( $args );
	 
		if ( $custom_query->have_posts() ) :
		while( $custom_query->have_posts() ) : $custom_query->the_post(); 
		
	  	$name = get_the_title();
		if(is_numeric($_GET['search'])){
		$name = get_the_title()." (Ad ID ".$_GET['search'].")";
		}
		
		$ar['mylist'][] = array(
		'id' => $custom_query->post->ID, 
		'name' => $name, 
		'img' => do_shortcode('[IMAGE post_id="'.$custom_query->post->ID.'" link=0 pathonly=1]'), 
		'link' => get_permalink($custom_query->post->ID), 
		'text' => __("Price","premiumpress").": ".do_shortcode('[PRICE]')." / ".__("Status","premiumpress").": ".do_shortcode('[STATUS]'),
		 );  
		
		endwhile; endif;
		 
		echo json_encode($ar);
		die();
	}
	}
	

function _hook_sellspace($c){


$c["sidebar350"] = array(		 
			"n" => "Sidebar Right",
			"sw" => "350",
			"sh" => "300",
			"p" => "sidebar",
			"min" => 1,
			"max" => 1,
); 	
		

return $c;

}
	
	
function _wp_footer(){ ?>
<div id="ajaxLoginModal" class="modal fade login-modal-wrapper" data-width="500" data-backdrop="static" data-keyboard="false" tabindex="-1" style="display: none;"></div>
<div id="ajaxRegisterModal" class="modal fade login-modal-wrapper" data-width="500" data-backdrop="static" data-keyboard="false" tabindex="-1" style="display: none;"></div>
 
<script>

jQuery(document).ready(function() {
 
 
	jQuery("input.typeahead").typeahead({		 	
		onSelect: function(item) { 
		  window.location = item.extra;
		},
		ajax: {
			url: "<?php echo home_url(); ?>/?qs=1",
			timeout: 500,
			triggerLength: 1,
			method: "get",
			preDispatch: function (query) { 
				return {
					search: query
				}
			},
			preProcess: function (data) {
			 
				if (data.success === false) {
					// Hide the list, there was some error
					return false;
				}
			 
				return data.mylist;
			}
		},	
	});

	var $modal = jQuery('#ajaxLoginModal');

	jQuery(document).on('click', '.btn-ajax-login' ,function(){
		// create the backdrop and wait for next modal to be triggered
	  
		jQuery('body').modalmanager('loading');

		setTimeout(function(){
			 $modal.load('<?php echo home_url(); ?>/?core_aj=1&action=loginform', '', function(){
				$modal.modal();
			});
		}, 1000);
	});
	
	var $modal2 = jQuery('#ajaxRegisterModal');

	jQuery(document).on('click', '.btn-ajax-register' ,function(){
		// create the backdrop and wait for next modal to be triggered
	  
		jQuery('body').modalmanager('loading');

		setTimeout(function(){
			 $modal2.load('<?php echo home_url(); ?>/?core_aj=1&action=registerform', '', function(){
				$modal2.modal();
			});
		}, 1000);
	});
 

});

</script>
    <?php }
	
 	function _hook_v9_admin_options($c){
	
	return $c;
	
		$new = array();
		$new["settings"] = array(	
			"name" => __("Job Board Settings","premiumpress-admin"),
			"desc"	=> __("Here are additional options for the classifieds theme.","premiumpress-admin"),
			"icon" => "fa fa-folder",
			"link" => "#",
			"path" => array(hook_theme_folder( array('jobboard-admin', 'settings', true) ),'settings'),
		); 
		
		if(!is_array($c)){ return $new; }
	
		return array_merge($c,$new);
		 
	}
	
 
 
	
	/*
		this function sets up all of the custom boxes for pages
		within the admin area
	*/
 

function _admin_fields(){ global $post, $CORE; 
	
	?> 
 
 

    <div class="box-admin">
        <label>Price</label>
        <div class="input-group"> 
        <span class="add-on input-group-prepend"><span class="input-group-text"><?php echo hook_currency_symbol(''); ?></span></span>     
        <input class="form-control hasaddon" id="ppriceff" name="custom[price]" value="<?php if( isset($_GET['post']) ){  echo get_post_meta($post->ID, "price", true); } ?>" />
        </div>
    </div>
    
    <script>
	jQuery( "#ppriceff" ).change(function() {	   
		jQuery( "#ppriceff" ).val( jQuery( "#ppriceff" ).val().replace(',', '') );	  
	});
	</script>
    
    
 
    
    
        <div class="box-admin">
        <label><?php echo __("Pricing Setup","premiumpress"); ?></label>
        <div class="input-group">   
        <select name="custom[status]" class="form-control" style="width:99%;">
        <?php
        
            $values = array("" => "", 
		"1" => __("Hourly Rate","premiumpress"), 
		"2" => __("Budget Amount","premiumpress"),  
		"3" => __("Fixed Salary (monthly)","premiumpress"), 
		"4" => __("Fixed Salary (annually)","premiumpress"),
		);
            
            ?>
             
            <?php foreach($values as $k => $v){ ?>
            <option value="<?php echo $k; ?>" <?php if(isset($_GET['post']) && $CORE->get_edit_data('status', $_GET['post']) == $k){ echo "selected=selected"; } ?>><?php echo $v; ?></option>
            <?php } ?>
        
        </select>
        </div>
    </div>
    
    
     <div class="box-admin">
        <label><?php echo __("Job Type","premiumpress"); ?></label>
        <div class="input-group">   
        <select name="custom[jobtype]" class="form-control" style="width:99%;">
        <?php
        
            $values = array(
		"fulltime" 		=> __("Full-time","premiumpress"), 
		"parttime" 		=> __("Part-time","premiumpress"), 
		"contract" 	=> __("Contract","premiumpress"), 
		"internship" 	=> __("Internship","premiumpress"), 
		"temporary" 	=> __("Temporary","premiumpress")		 
		 ); 
            
            ?>
             
            <?php foreach($values as $k => $v){ ?>
            <option value="<?php echo $k; ?>" <?php if(isset($_GET['post']) && $CORE->get_edit_data('status', $_GET['post']) == $k){ echo "selected=selected"; } ?>><?php echo $v; ?></option>
            <?php } ?>
        
        </select>
        </div>
    </div>
    
    
     <div class="box-admin">
        <label><?php echo __("Hours","premiumpress"); ?></label>
        <div class="input-group">  
        <input class="form-control" id="ppriceff" name="custom[hours]" value="<?php if( isset($_GET['post']) ){  echo get_post_meta($post->ID, "hours", true); } ?>" />
        </div>
    </div>
    
     <div class="box-admin">
        <label><?php echo __("Company Name","premiumpress"); ?></label>
        <div class="input-group">  
        <input class="form-control" id="ppriceff" name="custom[company]" value="<?php if( isset($_GET['post']) ){  echo get_post_meta($post->ID, "company", true); } ?>" />
        </div>
    </div>
 
 
      <div class="box-admin">
        <label>Affiliate Link</label>
        <div class="input-group">  
          <input class="form-control" style="width:100%;" name="custom[aff_link]" value="<?php if( isset($_GET['post']) ){  echo get_post_meta($post->ID, "aff_link", true); } ?>"/>
     
        </div>
        <em>optional</em>
    </div>
     
<div class="box-admin-textarea">
        <label><?php echo __("Job Responsibilities","premiumpress"); ?></label>
        <div class="input-group"> 
        <textarea style="width:100%; height:150px;" name="custom[responsibilities]"><?php if( isset($_GET['post']) ){  echo get_post_meta($post->ID, "responsibilities", true); } ?></textarea>
        </div>
</div>

<div class="box-admin-textarea">
        <label><?php echo __("Job Qualifications","premiumpress"); ?></label>
        <div class="input-group">  
        <textarea style="width:100%; height:150px;" name="custom[qualifications]"><?php if( isset($_GET['post']) ){  echo get_post_meta($post->ID, "qualifications", true); } ?></textarea>
        </div>
</div>  
    
	
	<?php
	}
	
 
	function ppt_shortcode_experience( $atts, $content = null ) {
	
		global $userdata, $CORE, $post;
	 
		
		$tt = get_post_meta($post->ID,'experience', true);
		switch($tt){		
			case 1: {
			return __("High school diploma or equivalent","premiumpress");
			} break;
			case 2: {
			return __("Some college, no degree","premiumpress");
			} break;
			case 3: {
			return __("Postsecondary non-degree award","premiumpress");
			} break;
			case 4: {
			return __("Associate's degree","premiumpress");
			} break;
			case 5: {
			return __("Bachelor's degree","premiumpress");
			} break;
			case 6: {
			return __("Master's degree","premiumpress");
			} break;
			case 7: {
			return __("Doctoral or professional degree","premiumpress");
			} break;						
			default: {
			return __("No Experience Required","premiumpress");
			} break;
		}
	}
 
	function ppt_shortcode_type( $atts, $content = null ) {
	
		global $userdata, $CORE, $post;
		
		$tt = get_post_meta($post->ID,'jobtype', true);
		switch($tt){		
			case "parttime": {
			return __("Part-time","premiumpress");
			} break;
			case "contract": {
			return __("Contract","premiumpress");
			} break;
			case "internship": {
			return __("Internship","premiumpress");
			} break;
			case "temporary": {
			return __("Temporary","premiumpress");
			} break;
			case "fulltime":
			default: {
			return __("Full-time","premiumpress");
			} break;
		}
	}
		
 
	// SHORTCODE FOR JOB STATUS
	function ppt_shortcode_company( $atts, $content = null ) {
	
		global $userdata, $CORE, $post, $shortcode_tags;  
		 
		$company = get_post_meta($post->ID, 'company', true);
		
		if($company == ""){ return __("Online Trading Company","premiumpress"); }	
		
		return $company; 
		
	}
	// SHORTCODE FOR JOB STATUS
	function ppt_shortcode_applicants( $atts, $content = null ) {
	
		global $userdata, $wpdb, $CORE, $post, $shortcode_tags;  
		  
		 $SQL = "SELECT count(*) AS total FROM ".$wpdb->posts."

		INNER JOIN ".$wpdb->postmeta." AS t1 ON ( t1.post_id = ".$wpdb->posts.".ID AND t1.meta_key = 'post_id' AND t1.meta_value = '".$post->ID."')

		WHERE ".$wpdb->posts.".post_status= 'publish' AND ".$wpdb->posts.".post_type='ppt_jobs'";	
  	 
		$tt = $wpdb->get_results($SQL); 
		 
		if(empty($tt)){
			return 0;
		}
		
		return $tt[0]->total; 
		
	}
 
	
	function ppt_shortcode_hours( $atts, $content = null ) {
	
		global $userdata, $CORE, $post, $shortcode_tags;  
		 
		$hours = get_post_meta($post->ID, 'hours', true);
		
		if($hours == ""){ return __("Unknown","premiumpress"); }
		
		return $hours." ".__("Hrs","premiumpress");
			 
		
	}
 
	
	// SHORTCODE FOR JOB STATUS
	function ppt_shortcode_jobstatus( $atts, $content = null ) {
	
		global $userdata, $CORE, $post, $shortcode_tags;  
		
		extract( shortcode_atts( array('text' => $default_options  ), $atts ) );		
		
		$is_accepted = get_post_meta($post->ID, 'has_accepted_bid', true);
		if($is_accepted != ""){ return " <span class='label label-success'>".$CORE->_e(array('listvalues','6'))."</span>"; }
		
	}
			
	function ppt_shortcode_salary ( $atts = "", $content = null ) { global $userdata, $CORE, $wpdb, $post;  
 	
	   	extract( shortcode_atts( array(  'xxxxxxxx' => ''), $atts ) ); 
		 
		$label = hook_price(get_post_meta($post->ID,'price', true))." ";
		
		if(_ppt(array('currency','code')) == "EUR"){
		$label = str_replace(".",",",$label);
		}
			
		$tt = get_post_meta($post->ID,'pricetype', true);
		if($tt != ""){		 
			switch($tt){
				case "2": { $label .= __("Budget Amount","premiumpress"); } break;
				case "3": { $label .= __("Fixed Salary (monthly)","premiumpress"); } break;
				case "4": { $label .= __("Fixed Salary (annually)","premiumpress"); } break;
				default: { $label .= __("Hourly Rate","premiumpress"); }
			}		
		}
		
		return $label;
	
	}	
	

 


 
 	
	
	/*
		this function adds new fields
		to the submission form
	*/
	function _hook_customfields($c){ global $CORE;
	
		$o = 50;
		
		
		$c[$o]['title'] 	= __("Job Responsibilities","premiumpress");
		$c[$o]['name'] 		= "responsibilities";
		$c[$o]['type'] 		= "textarea";
		$c[$o]['fullspan']	= 1;
		$c[$o]['class'] 	= "form-control";
		$o++;
		
		$c[$o]['title'] 	= __("Job Qualifications","premiumpress");
		$c[$o]['name'] 		= "qualifications";
		$c[$o]['type'] 		= "textarea";
		$c[$o]['fullspan']	= 1;
		$c[$o]['class'] 	= "form-control";
		$o++; 
				
		$c[$o]['title'] 	= __("Company Name","premiumpress");
		$c[$o]['name'] 		= "company";
		$c[$o]['type'] 		= "text";
		$c[$o]['defaultvalue'] 	= "0";
		$c[$o]['class'] 	= "form-control";
		$o++;
		
		$c[$o]['title'] 	= __("Job Type","premiumpress");
		$c[$o]['name'] 		= "jobtype";
		$c[$o]['type'] 		= "select";
		$c[$o]['class'] 	= "form-control";				
		$c[$o]['listvalues'] = array(
		"fulltime" 		=> __("Full-time","premiumpress"), 
		"parttime" 		=> __("Part-time","premiumpress"), 
		"contract" 	=> __("Contract","premiumpress"), 
		"internship" 	=> __("Internship","premiumpress"), 
		"temporary" 	=> __("Temporary","premiumpress")		 
		 ); 		 
		$o++;
				
		$c[$o]['title'] 	= __("Price","premiumpress");
		$c[$o]['name'] 		= "price";
		$c[$o]['type'] 		= "price";
		$c[$o]['defaultvalue'] 	= "0";
		$c[$o]['class'] 	= "form-control";
		$o++;		
		
		$c[$o]['title'] 	= __("Pricing Setup","premiumpress");
		$c[$o]['name'] 		= "pricetype";
		$c[$o]['type'] 		= "select";
		$c[$o]['class'] 	= "form-control";		
		$c[$o]['listvalues'] = array("" => "", 
		"1" => __("Hourly Rate","premiumpress"), 
		"2" => __("Budget Amount","premiumpress"),  
		"3" => __("Fixed Salary (monthly)","premiumpress"), 
		"4" => __("Fixed Salary (annually)","premiumpress"),
		);		 
		$o++;
		
		$c[$o]['title'] 	= __("Hours","premiumpress");
		$c[$o]['name'] 		= "hours";
		$c[$o]['type'] 		= "text";
		$c[$o]['defaultvalue'] 	= "0";
		$c[$o]['class'] 	= "form-control";
		$o++;

		$c[$o]['title'] 	= __("Experience","premiumpress");
		$c[$o]['name'] 		= "experience";
		$c[$o]['type'] 		= "select";
		$c[$o]['class'] 	= "form-control";		
		$c[$o]['listvalues'] = array("" => __("No Experience Required","premiumpress"), 
		"1" => __("High school diploma or equivalent","premiumpress"), 
		"2" => __("Some college, no degree","premiumpress"),  
		"3" => __("Postsecondary non-degree award","premiumpress"), 
		"4" => __("Associate's degree","premiumpress"),
		"5" => __("Bachelor's degree","premiumpress"),
		"6" => __("Master's degree","premiumpress"),
		"7" => __("Doctoral or professional degree","premiumpress"),
		); 
		
			
		return $c;
	}
	
 
 

	

}	// END CLASS
 

?>