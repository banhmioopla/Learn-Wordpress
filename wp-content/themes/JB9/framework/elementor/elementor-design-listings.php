<?php

class Widget_PremiumPress_Listings extends \Elementor\Widget_Base {
 
	public function get_name() {
		return 'listings';
	}
 
	public function get_title() {
		return __( '{ Listings }', 'premiumpress-elementor' );
	} 
	public function get_icon() {
		return 'design-list';
	} 
	public function get_categories() {
		return [ 'premiumpress-content' ];
	} 
	protected function _register_controls() {
	
		$options = array();
		$terms = get_terms( array(
			'taxonomy' => 'listing',
			'hide_empty' => true,
		));
	
		if ( ! empty( $terms ) && ! is_wp_error( $terms ) ){
			foreach ( $terms as $term ) {
				$options[ $term->term_id ] = $term->name;
			}
		}
	
	

		$this->start_controls_section(
			'content_section',
			[
				'label' => __( THEME_LISING_CAPTION.' Block', 'premiumpress-elementor' ),
				'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);
		
		 

        $this->add_control(
            'limit',
            [
                'label' => __( 'Number of Posts', 'premiumpress-elementor' ),
                'type' => \Elementor\Controls_Manager::NUMBER,
                'default' => '9'
            ]
        );
		 
		
		$this->add_control(
			'small',
			[
				'label'   => esc_html__( 'Grid Display', 'premiumpress-elementor' ),
				'type'    => \Elementor\Controls_Manager::SWITCHER,
				'default' => '0',
			]
		);
		
		 
	
	
		if(THEME_KEY == "da"){
			$this->add_control(
				'custom',
				[
					'label' => __( 'Custom', 'premiumpress-elementor' ),
					'type' => \Elementor\Controls_Manager::SELECT,
					'options' => ppt_listing_custom(),
					'default' => '',
				]
			);
		}else{
			$this->add_control(
				'custom',
				[
					'label' => __( 'Custom', 'premiumpress-elementor' ),
					'type' => \Elementor\Controls_Manager::SELECT,
					'options' => [	
						'' => __( 'Default Orderby', 'premiumpress-elementor' ),				
						'featured' => __( 'Featured Items', 'premiumpress-elementor' ),					
						//'endingsoon' => __( 'Items Ending Soon', 'premiumpress-elementor' ),
						'popular' => __( 'Popular Items', 'premiumpress-elementor' ),
						'rating' => __( 'Rated Items', 'premiumpress-elementor' ),
						'random' => __( 'Random Items', 'premiumpress-elementor' ),
						'new' => __( 'New Items', 'premiumpress-elementor' ),
						'nearby' => __( 'Nearby Items', 'premiumpress-elementor' ), 
						
					],
					'default' => '',
				]
			);

		}

        $this->add_control(
            'orderby',
            [
                'label' => __( 'Default Order By', 'premiumpress-elementor' ),
                'type' => \Elementor\Controls_Manager::SELECT,
                'options' => array(
					'ID' => 'Post ID',
					'author' => 'Post Author',
					'title' => 'Title',
					'date' => 'Date',
					'modified' => 'Last Modified Date',				
					'rand' => 'Random',				
					'menu_order' => 'Menu Order',
				),
                'default' => 'date',

            ]
        );

        $this->add_control(
            'order',
            [
                'label' => __( 'Order', 'premiumpress-elementor' ),
                'type' => \Elementor\Controls_Manager::SELECT,
                'options' => [
                    'asc' => 'Ascending',
                    'desc' => 'Descending'
                ],
                'default' => 'desc',

            ]
        );
		
		
		$this->add_control(
            'cat',
            [
                'label' => __( 'Category', 'premiumpress-elementor' ),
                'type' => \Elementor\Controls_Manager::SELECT2,
				'label_block' => true,
				'multiple' => true,
				'options' =>  $options,
                
				'default' => ''
            ]
        );
	 

		$this->end_controls_section();

	}
	protected function render() { global $args; $customvalue = "";
	
	$settings = $this->get_settings_for_display();
 	
	// CATEGORY IDS
	 $cats = "";
	 if(is_array($settings['cat'])){
		 foreach($settings['cat'] as $c){
		 $cats .= $c.",";
		 }
		 $cats = substr($cats,0, -1);
	 }
	 
	// OUTPUT
	?>
    
  
         
    <?php 
	
	if($settings['custom'] == "men"){	
	$settings['custom'] = "gender";	
	$customvalue = 1;
	}
	
	if($settings['custom'] == "women"){	
	$settings['custom'] = "gender";	
	$customvalue = 2;
	}
	
	if($settings['custom'] == "couples"){	
	$settings['custom'] = "gender";	
	$customvalue = 3;
	}
	
	$data = do_shortcode('[LISTINGS 
	dataonly="1" 
	cat="'.$cats.'" 
	show="'.$settings['limit'].'" 
	custom="'.$settings['custom'].'" 
	customvalue="'.$customvalue.'"
	small="'.$settings['small'].'" 
	order="'.$settings['orderby'].'" 
	orderby="'.$settings['orderby'].'" 
	debug="0"	
	]');
	
	echo $data; 	
	
	?>  
  

	<?php

	}

}