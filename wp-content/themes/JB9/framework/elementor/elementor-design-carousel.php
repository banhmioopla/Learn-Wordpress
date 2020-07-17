<?php

class Widget_PremiumPress_Carousel extends \Elementor\Widget_Base {
 
	public function get_name() {
		return 'ccarousel';
	}
 
	public function get_title() {
		return __( '{ Listing Carousel }', 'premiumpress-elementor' );
	} 
	public function get_icon() {
		return 'design-carousel';
	} 
	public function get_categories() {
		return [ 'premiumpress-content' ];
	} 
	protected function _register_controls() {

		$this->start_controls_section(
			'section1',
			[
				'label' => __( 'Carousel Blocks', 'premiumpress-elementor' ),
				'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);
		 
	 $this->add_control(
			'style',
			[
				'label' => __( 'Style', 'premiumpress-elementor' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'options' => [					
					'1' => __( 'Style 1', 'premiumpress-elementor' ),					
					//'2' => __( 'Style 2', 'premiumpress-elementor' ),
					'3' => __( 'Style 2', 'premiumpress-elementor' ),	 
				],
				'default' => '1',
			]
		); 
		 
		 $this->add_control(
			'custom',
			[
				'label' => __( 'Data Search', 'premiumpress-elementor' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'options' => ppt_listing_custom(),
				'default' => 'new',
			]
		); 
		
        $this->add_control(
            'show',
            [
                'label' => __( 'Display Amount', 'premiumpress-elementor' ),
                'type' => \Elementor\Controls_Manager::NUMBER,
                'default' => '5'
            ]
        );
		
		$this->add_control(
			'small',
			[
				'label' => __( 'Small Version', 'premiumpress-elementor' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'options' => [					
					'0' => __( 'No', 'premiumpress-elementor' ),					
					'1' => __( 'Yes', 'premiumpress-elementor' ),
					   
				],
				'default' => '0',
				'description' => 'The option is not used by default; however, some themes may show it.',
			]
		);
		
	
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
	protected function render() { global $userdata, $CORE, $settings;
	
		$settings = $this->get_settings_for_display();
		
		$id       = 'ccarousel-' . $this->get_id();
		
		$settings['eid'] = $id;
		
		if($settings['custom'] == "men"){	
		$settings['custom'] = "gender";	
		$settings['customvalue'] = 1;
		}
		
		if($settings['custom'] == "women"){	
		$settings['custom'] = "gender";	
		$settings['customvalue'] = 2;
		}
		
		if($settings['custom'] == "couples"){	
		$settings['custom'] = "gender";	
		$settings['customvalue'] = 3;
		}
		
		// CATEGORY IDS
		 $cats = "";
		 if(is_array($settings['cat'])){
			 foreach($settings['cat'] as $c){
			 $cats .= $c.",";
			 }
			 $cats = substr($cats,0, -1);
		 }
		 
		 $settings['cats'] = $cats;
		 
		get_template_part('framework/elementor/_carousel/carousel'.$settings['style']); 
	 
		
	}

}