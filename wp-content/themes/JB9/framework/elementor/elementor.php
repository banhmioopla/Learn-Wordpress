<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}


function ppt_get_post_types($args = []){

    $post_type_args = [
        'show_in_nav_menus' => true,
    ];

    if ( ! empty( $args['post_type'] ) ) {
        $post_type_args['name'] = $args['post_type'];
    }

    $_post_types = get_post_types( $post_type_args , 'objects' );

    $post_types  = ['0' => esc_html__( 'Select Type', 'premiumpress-elementor' ) ];

    foreach ( $_post_types as $post_type => $object ) {
        $post_types[ $post_type ] = $object->label;
    }

    return $post_types;
}
function ppt_customfields() {

	global $wpdb; 
	
	$STRING = ""; $STRING1 = ""; $cleanArray = array(); $removeValues = array('map-country','map-state','map-city');
		
		$SQL = "SELECT meta_key FROM $wpdb->postmeta WHERE meta_key !='_".$wpdb->prefix."page_template' 
		AND meta_key !='_edit_last' AND meta_key !='_edit_lock' AND meta_key !='_encloseme' 
		AND meta_key NOT LIKE '%elementor%' 
		AND meta_key NOT LIKE '%menu%'
		AND meta_key NOT LIKE '%envato%'
		AND meta_key NOT LIKE '%elements%' 
		AND meta_key NOT LIKE '_wp%'   
		AND meta_key !='_pingme' GROUP BY meta_key";
	
		$last_posts = (array)$wpdb->get_results($SQL);	 
	
		foreach($last_posts as $value){		
		
			$cleanArray[$value->meta_key] = $value->meta_key;	
		} // end loop
 
return $cleanArray;

}

// Button Size
function ppt_listing_custom() {
    $a = [
        '' => __( 'Default Orderby', 'premiumpress-elementor' ),				
		'featured' => __( 'Featured Items', 'premiumpress-elementor' ),					
		'popular' => __( 'Popular Items', 'premiumpress-elementor' ),			
		'random' => __( 'Random Items', 'premiumpress-elementor' ),
		'new' => __( 'New Items', 'premiumpress-elementor' ),
		'men' => __( 'Men Only', 'premiumpress-elementor' ),
		'women' => __( 'Women Only', 'premiumpress-elementor' ),
		'couples' => __( 'Couples Only', 'premiumpress-elementor' ),
	
		'nearby' => __( 'Nearby Items', 'premiumpress-elementor' ), 
		
		'endingsoon' => __( 'Items Ending Soon', 'premiumpress-elementor' ), 
		
    ];

	if(THEME_KEY != "da"){
	unset($a['men']);
	unset($a['women']);
	unset($a['couples']);
	}
	
	if(THEME_KEY != "at"){
	unset($a['endingsoon']);

	}	
	
	
    return $a;
}

// Button Size
function ppt_shortcodes() {

	 global $shortcode_tags;
    // Sort the shortcodes into alphabetical order
    $shortcodes = $shortcode_tags;
    ksort( $shortcodes );
    // Loop through the array and output all the shortcodes
 	$s=array();
	$names =  array();
	/*
	$names = array(
		'TITLE' => array('Listing - Title' ),
		'EXCERPT' => array('Listing - Excerpt' ),
		'CONTENT' => array('Listing - Description' ),
		'TAGS' => array('Listing - Tags' ),
		'IMAGE' => array('Listing - Image (Single)' ),
		'IMAGES' => array('Listing - Images' ),
		'VIDEO' => array('Listing - Video' ),		
		'CATEGORY' => array('Listing - Category' ),
		'COMMENTS' => array('Listing - Comments' ),
		'CUSTOMFIELD' => array('Listing - Custom Field' ),
		'AMENITITES' => array('Listing - Amenitities' ),	
	);
	*/
	
    foreach( $shortcodes as $code => $function ) { 
	
		if(isset($names[$code])){
		$s[$code] = array($names[$code][0]); 
		}else{
		$s[$code] = array($code); 
		}
	 }
 	
	$rs = array('ADVANCEDSEARCH',  'D_CATEGORIES','C_TAX', 'wp_caption','video','premiumpress_elementor_template','playlist','gallery','embed','caption','audio','VISITORCHART','SELLSPACE','SCREENSHOT','MEMBERSHIP');
	foreach($rs as $rr){
	unset($s[$rr]);
	}
	
    return $s;
}

// Button Size
function ppt_pack_button_sizes() {
    $button_sizes = [
        'xs' => esc_html__( 'Extra Small', 'premiumpress-elementor' ),
        'sm' => esc_html__( 'Small', 'premiumpress-elementor' ),
        'md' => esc_html__( 'Medium', 'premiumpress-elementor' ),
        'lg' => esc_html__( 'Large', 'premiumpress-elementor' ),
        'xl' => esc_html__( 'Extra Large', 'premiumpress-elementor' ),
    ];

    return $button_sizes;
}
 

// Anywhere Template
function ppt_pack_ae_options() {
    
    $data = get_transient( 'ep_anywhere_template' );

    if ( false === $data ) {

        if (post_type_exists('ae_global_templates')) {
            $anywhere = get_posts(array(
                'fields'         => 'ids', // Only get post IDs
                'posts_per_page' => -1,
                'post_type'      => 'ae_global_templates',
            ));

            $anywhere_options = ['0' => esc_html__( 'Select Template', 'premiumpress-elementor' ) ];

            foreach ($anywhere as $key => $value) {
                $anywhere_options[$value] = get_the_title($value);
            }        
        } else {
            $anywhere_options = ['0' => esc_html__( 'AE Plugin Not Installed', 'premiumpress-elementor' ) ];
        }

        set_transient( 'ep_anywhere_template', $anywhere_options, 120 );
    }

    return $data;
}

// Elementor Saved Template 
function ppt_pack_et_options() {
    
 
    return "";
}

// Sidebar Widgets
function ppt_pack_sidebar_options() {

    $data = get_transient( 'ep_sidebar_options' );

    if ( false === $data ) {
        
        global $wp_registered_sidebars;
        $sidebar_options = [];

        if ( ! $wp_registered_sidebars ) {
            $sidebar_options['0'] = esc_html__( 'No sidebars were found', 'premiumpress-elementor' );
        } else {
            $sidebar_options['0'] = esc_html__( 'Select Sidebar', 'premiumpress-elementor' );

            foreach ( $wp_registered_sidebars as $sidebar_id => $sidebar ) {
                $sidebar_options[ $sidebar_id ] = $sidebar['name'];
            }
        }

        set_transient( 'ep_sidebar_options', $sidebar_options, DAY_IN_SECONDS );

    }

    return $data;
}

function ppt_pack_get_menu() {
    $data = get_transient( 'ep_get_menu' );

    if ( false === $data ) {
        $menus = wp_get_nav_menus();
        $items = ['0' => esc_html__( 'Select Menu', 'premiumpress-elementor' ) ];
        foreach ( $menus as $menu ) {
            $items[ $menu->slug ] = $menu->name;
        }

        set_transient( 'ep_get_menu', $items, 300 );
    }

    return $data;
}

function ppt_pack_position() {
    $position_options = [
        ''              => esc_html__('Default', 'premiumpress-elementor'),
        'top-left'      => esc_html__('Top Left', 'premiumpress-elementor') ,
        'top-center'    => esc_html__('Top Center', 'premiumpress-elementor') ,
        'top-right'     => esc_html__('Top Right', 'premiumpress-elementor') ,
        'center'        => esc_html__('Center', 'premiumpress-elementor') ,
        'center-left'   => esc_html__('Center Left', 'premiumpress-elementor') ,
        'center-right'  => esc_html__('Center Right', 'premiumpress-elementor') ,
        'bottom-left'   => esc_html__('Bottom Left', 'premiumpress-elementor') ,
        'bottom-center' => esc_html__('Bottom Center', 'premiumpress-elementor') ,
        'bottom-right'  => esc_html__('Bottom Right', 'premiumpress-elementor') ,
    ];

    return $position_options;
}

function ppt_pack_transition_options() {


    $transition_options = [
        ''                    => esc_html__('None', 'premiumpress-elementor'),
        'fade'                => esc_html__('Fade', 'premiumpress-elementor'),
        'scale-up'            => esc_html__('Scale Up', 'premiumpress-elementor'),
        'scale-down'          => esc_html__('Scale Down', 'premiumpress-elementor'),
        'slide-top'           => esc_html__('Slide Top', 'premiumpress-elementor'),
        'slide-bottom'        => esc_html__('Slide Bottom', 'premiumpress-elementor'),
        'slide-left'          => esc_html__('Slide Left', 'premiumpress-elementor'),
        'slide-right'         => esc_html__('Slide Right', 'premiumpress-elementor'),
        'slide-top-small'     => esc_html__('Slide Top Small', 'premiumpress-elementor'),
        'slide-bottom-small'  => esc_html__('Slide Bottom Small', 'premiumpress-elementor'),
        'slide-left-small'    => esc_html__('Slide Left Small', 'premiumpress-elementor'),
        'slide-right-small'   => esc_html__('Slide Right Small', 'premiumpress-elementor'),
        'slide-top-medium'    => esc_html__('Slide Top Medium', 'premiumpress-elementor'),
        'slide-bottom-medium' => esc_html__('Slide Bottom Medium', 'premiumpress-elementor'),
        'slide-left-medium'   => esc_html__('Slide Left Medium', 'premiumpress-elementor'),
        'slide-right-medium'  => esc_html__('Slide Right Medium', 'premiumpress-elementor'),
    ];

    return $transition_options;
}

// Title Tags
function ppt_pack_title_tags() {
    $title_tags = [
        'h1'   => esc_html__( 'H1', 'premiumpress-elementor' ),
        'h2'   => esc_html__( 'H2', 'premiumpress-elementor' ),
        'h3'   => esc_html__( 'H3', 'premiumpress-elementor' ),
        'h4'   => esc_html__( 'H4', 'premiumpress-elementor' ),
        'h5'   => esc_html__( 'H5', 'premiumpress-elementor' ),
        'h6'   => esc_html__( 'H6', 'premiumpress-elementor' ),
        'div'  => esc_html__( 'div', 'premiumpress-elementor' ),
        'span' => esc_html__( 'span', 'premiumpress-elementor' ),
        'p'    => esc_html__( 'p', 'premiumpress-elementor' ),
    ];

    return $title_tags;
}





//add_action('elementor/widgets/widgets_registered', 'custom_unregister_elementor_widgets');
function custom_unregister_elementor_widgets($obj){
	$elementor_widget_blacklist = array('image','icon','maps');
 
	foreach($elementor_widget_blacklist as $widget_name){
    $obj->unregister_widget_type($widget_name);
  }
 
}
 
 
add_action(
	'elementor/init', function() {
		\Elementor\Plugin::$instance->elements_manager->add_category(
			'premiumpress-header',
			[
				'title' => __( 'PremiumPress - Header/Footer', 'premiumpress-elementor' ),
				'icon' => 'fa fa-bar',
			],
			1
		);
	}
);

add_action(
	'elementor/init', function() {
		\Elementor\Plugin::$instance->elements_manager->add_category(
			'premiumpress-content',
			[
				'title' => __( 'PremiumPress - Content Blocks', 'premiumpress-elementor' ),
				'icon' => 'fa fa-graph',
			],
			1
		);
	}
);

add_action(
	'elementor/init', function() {
		\Elementor\Plugin::$instance->elements_manager->add_category(
			'premiumpress-home',
			[
				'title' => __( 'PremiumPress - Homepage', 'premiumpress-elementor' ),
				'icon' => 'fa fa-plug',
			],
			1
		);
	}
);
add_action(
	'elementor/init', function() {
		\Elementor\Plugin::$instance->elements_manager->add_category(
			'premiumpress-taxonomy',
			[
				'title' => __( 'PremiumPress - Taxonomy Page', 'premiumpress-elementor' ),
				'icon' => 'fa fa-plug',
			],
			1
		);
	}
);
add_action(
	'elementor/init', function() {
		\Elementor\Plugin::$instance->elements_manager->add_category(
			'premiumpress-single',
			[
				'title' => __( 'PremiumPress - Listing Page', 'premiumpress-elementor' ),
				'icon' => 'fa fa-plug',
			],
			1
		);
	}
);
add_action(
	'elementor/init', function() {
		\Elementor\Plugin::$instance->elements_manager->add_category(
			'premiumpress-search',
			[
				'title' => __( 'PremiumPress - Search Page', 'premiumpress-elementor' ),
				'icon' => 'fa fa-plug',
			],
			1
		);
	}
);
add_action(
	'elementor/init', function() {
		\Elementor\Plugin::$instance->elements_manager->add_category(
			'premiumpress-widgets',
			[
				'title' => __( 'PremiumPress - Widgets', 'premiumpress-elementor' ),
				'icon' => 'fa fa-plug',
			],
			1
		);
	}
);
final class Elementor_Test_Extension {

	private static $_instance = null;
	public static function instance() {

		if ( is_null( self::$_instance ) ) {
			self::$_instance = new self();
		}
		return self::$_instance;

	}
	public function __construct() {

		add_action( 'init', [ $this, 'init' ] );
	 

	}
	
	function theme_prefix_register_elementor_locations( $elementor_theme_manager ) {

		$elementor_theme_manager->register_location( 'header' );
		$elementor_theme_manager->register_location( 'footer' ); 
	}

 
	public function init() {
 

		// Include plugin files
		$this->includes();
		
		// Register Theme locations
		add_action( 'elementor/theme/register_locations', [ $this, 'theme_prefix_register_elementor_locations' ] );
		
		// Register widgets
		add_action( 'elementor/widgets/widgets_registered', [ $this, 'register_widgets' ] );
	 	
		// Register Styles	
		add_action( 'elementor/frontend/before_register_styles', [ $this, 'register_site_styles' ] );
		add_action( 'elementor/frontend/before_register_scripts', [ $this, 'register_site_scripts' ] );		
		
		// Display Default Styles
		add_action( 'elementor/frontend/after_register_styles', [ $this, 'enqueue_site_styles' ] );
		add_action( 'elementor/frontend/before_enqueue_scripts', [ $this, 'enqueue_site_scripts' ] );
		
		add_action( 'elementor/editor/after_enqueue_styles', [ $this, 'enqueue_editor_styles' ] );
		 
	}
	
	public function enqueue_editor_styles(){
 
		wp_register_style( 'pptv9-elementor-admin', FRAMREWORK_URI.'elementor/css/elementor-admin.css', [], 1 );
		wp_enqueue_style('pptv9-elementor-admin'); 
	}
	
	public function register_site_styles() {
		 
		wp_register_style( 'pptv9-advanced-button', FRAMREWORK_URI.'elementor/css/elementor-button.css', [], 1 );
		wp_register_style( 'pptv9-social-share', FRAMREWORK_URI.'elementor/css/elementor-social-share.css', [], 1 );

	}
	/**
	 * Register all script that need for any specific widget on call basis.
	 * @return [type] [description]
	 */
	public function register_site_scripts() {
 
 		wp_register_script( 'tilt', FRAMREWORK_URI.'elementor/js/tilt.js', ['jquery'], null, true );		
		wp_register_script( 'morphext', FRAMREWORK_URI.'elementor/js/morphext.js', ['jquery'], '2.4.7', true );		
		wp_register_script( 'typed', FRAMREWORK_URI.'elementor/js/typed.js', ['jquery'], null, true );		
		wp_register_script( 'goodshare', FRAMREWORK_URI.'elementor/js/goodshare.js', ['jquery'], '4.1.2', true );
		wp_register_script( 'search', FRAMREWORK_URI.'elementor/js/search.js', ['jquery'], '4.1.2', true );
		
		
	}

	/**
	 * Loading site related style from here.
	 * @return [type] [description]
	 */
	public function enqueue_site_styles() {

		wp_enqueue_style('premiumpress-elementor-css', FRAMREWORK_URI.'elementor/css/elementor.css');
		wp_enqueue_style('premiumpress-elementor-css'); 	
	}

	/**
	 * Loading site related script that needs all time such as uikit.
	 * @return [type] [description]
	 */
	public function enqueue_site_scripts() {
		 
		wp_enqueue_script( 'premiumpress-elementor-js', FRAMREWORK_URI.'elementor/js/elementor.js', ['jquery', 'elementor-frontend'], 1 );
		
 
	}
 
	public function includes() {
 		
		// V9 { LAYOUT BLOCKS }
		require_once( THEME_PATH . '/framework/elementor/elementor-layout-header.php' ); 
		require_once( THEME_PATH . '/framework/elementor/elementor-layout-footer.php' );		
		require_once( THEME_PATH . '/framework/elementor/elementor-layout-menubar.php' );	
		require_once( THEME_PATH . '/framework/elementor/elementor-layout-logo.php' );	
		require_once( THEME_PATH . '/framework/elementor/elementor-layout-offcanvus.php' );	
		require_once( THEME_PATH . '/framework/elementor/elementor-layout-sidebar.php' );	// CHECK FEB 18TH  2020
		
		// V9 { HOMEPAGE BLOCKS }
		require_once( THEME_PATH . '/framework/elementor/elementor-hero.php' );	// CHECK FEB 18TH  2020
		
		// V9 { DESIGN BLOCKS }
		require_once( THEME_PATH . '/framework/elementor/elementor-design-slider.php' );
		require_once( THEME_PATH . '/framework/elementor/elementor-design-customgallery.php' );
		require_once( THEME_PATH . '/framework/elementor/elementor-design-social.php' );	
		require_once( THEME_PATH . '/framework/elementor/elementor-design-heading.php' );	
		require_once( THEME_PATH . '/framework/elementor/elementor-design-button.php' );
		require_once( THEME_PATH . '/framework/elementor/elementor-design-shortcodes.php' );	
		require_once( THEME_PATH . '/framework/elementor/elementor-design-categories.php' ); // CHECK FEB 18TH  2020	
		require_once( THEME_PATH . '/framework/elementor/elementor-design-newsletter.php' );
		require_once( THEME_PATH . '/framework/elementor/elementor-design-contactform.php' );
		require_once( THEME_PATH . '/framework/elementor/elementor-design-listings.php' ); // CHECK FEB 18TH  2020
		require_once( THEME_PATH . '/framework/elementor/elementor-design-carousel.php' ); // CHECK FEB 18TH  2020
		require_once( THEME_PATH . '/framework/elementor/elementor-design-blog.php' );
		require_once( THEME_PATH . '/framework/elementor/elementor-design-searchbar.php' ); // CHECK FEB 18TH  2020 
		require_once( THEME_PATH . '/framework/elementor/elementor-design-cimgbox.php' );
		require_once( THEME_PATH . '/framework/elementor/elementor-design-cbox.php' );
		require_once( THEME_PATH . '/framework/elementor/elementor-design-title.php' );
		require_once( THEME_PATH . '/framework/elementor/elementor-design-map.php' );
				 
		
		// COUPON EXTAS
		if(defined('THEME_KEY') && THEME_KEY == "cp"){ 
		
		require_once( THEME_PATH . '/framework/elementor/coupon-stores.php' );
		require_once( THEME_PATH . '/framework/elementor/coupon-offers.php' );
		
		}
		
	}
	
	public function register_widgets() {

		// FRAMEWORK BLOCKS
		\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new \Widget_PremiumPress_Header() ); 
		\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new \Widget_PremiumPress_Footer() );	
		\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new \Widget_PremiumPress_Sidebar() );	
		
		// CONTENT BLOCKS
		\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new \Widget_PremiumPress_Ccats() );
		\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new \Widget_PremiumPress_Carousel() );
		\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new \Widget_PremiumPress_Searchbar() );
		\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new \Widget_PremiumPress_Cbox() );
 
		\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new \Widget_PremiumPress_Listings() );
		\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new \Widget_PremiumPress_Blog() );
		 	
	 	//\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new \Widget_PremiumPress_Chr() );
		\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new \Widget_PremiumPress_Ccats() );
		\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new \Widget_PremiumPress_Cimgbox() );
		//\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new \Widget_PremiumPress_Cicons() );
		\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new \Widget_PremiumPress_Slider() );
		\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new \Widget_PremiumPress_CustomGallery() );
		\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new \Widget_PremiumPress_Button() );
		\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new \Widget_PremiumPress_Title() );
		\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new \Widget_PremiumPress_Heading_Animated() );
		\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new \Widget_PremiumPress_Newsletter() );
		\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new \Widget_PremiumPress_SocialShare() );
		\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new \Widget_PremiumPress_Menubar() );
		\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new \Widget_PremiumPress_Offcanvus() );
			
		\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new \Widget_PremiumPress_Logo() );		 
		\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new \Widget_PremiumPress_ContactForm() );		 
		
		// LISTING
		\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new \Widget_PremiumPress_Shortcode() );		 
		
		
		// HOME
		\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new \Widget_PremiumPress_Hero() );
		\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new \Widget_PremiumPress_Map() );		 
		
		
		if(defined('THEME_KEY') && THEME_KEY == "cp"){ 
		
		\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new \Widget_PremiumPress_Coupon_Offers() );
		\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new \Widget_PremiumPress_Coupon_Stores() );
		
		}
		
	}
 

}

Elementor_Test_Extension::instance();
?>