<?php

class Widget_PremiumPress_Ccats extends \Elementor\Widget_Base {
 
	public function get_name() {
		return 'ccat-content';
	}
 
	public function get_title() {
		return __( '{ Categories }', 'premiumpress-elementor' );
	} 
	public function get_icon() {
		return 'design-folder';
	} 
	public function get_categories() {
		return [ 'premiumpress-content' ];
	} 
	protected function _register_controls() {

		$this->start_controls_section(
			'content_section',
			[
				'label' => __( 'Category Blocks', 'premiumpress-elementor' ),
				'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);
		
       $this->add_control(
            'style',
            [
                'label' => __( 'Style', 'premiumpress-elementor' ),
                'type' => \Elementor\Controls_Manager::SELECT,
                'options' => array(					
					'1' => 'Style 1',
					'2' => 'Style 2',
					'3' => 'Style 3',				
					'4' => 'Style 4',
					'5' => 'Style 5',
					'6' => 'Style 6',
					'7' => 'Style 7',
					'8' => 'Style 8',
					'9' => 'Style 9',
				),
                'default' => '2',

            ]
        );
		
		
        $this->add_control(
            'show',
            [
                'label' => __( 'Display Amount', 'premiumpress-elementor' ),
                'type' => \Elementor\Controls_Manager::NUMBER,
                'default' => '16'
            ]
        );
		
        $this->add_control(
            'offset',
            [
                'label' => __( 'Offset Amount', 'premiumpress-elementor' ),
                'type' => \Elementor\Controls_Manager::NUMBER,
                'default' => '0'
            ]
        );
		
       $this->add_control(
            'orderby',
            [
                'label' => __( 'Order By', 'premiumpress-elementor' ),
                'type' => \Elementor\Controls_Manager::SELECT,
                'options' => array(					
					'name' => 'Name',
					'rand' => 'Random',				
					'menu_order' => 'Menu Order',
				),
                'default' => 'name',

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
			'color',
			[
				'label' => __( 'Color', 'premiumpress-elementor' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'options' => [					
					'bg-light' => __( 'Light', 'premiumpress-elementor' ),
					'bg-dark' => __( 'Dark', 'premiumpress-elementor' ),
					'bg-white' => __( 'White', 'premiumpress-elementor' ),
					'bg-dark bg-primary' => __( 'Primary', 'premiumpress-elementor' ),
		 			'bg-dark bg-secondary' => __( 'Secondary', 'premiumpress-elementor' ),
		 
				],
				'default' => 'bg-light',
			]
		);
		
		$this->end_controls_section();

	}
	protected function render() { global $CORE, $settings;

		$settings = $this->get_settings_for_display();
		
		 
		$settings = array(
            "style" 		=> $settings['style'],
            "order" 		=> $settings['order'],
            "orderby"		=> $settings['orderby'],            
            "show"			=> $settings['show'],
            "offset"		=> $settings['offset'],
			"class"			=> $settings['color'],
             
         );
		get_template_part('framework/elementor/_ccats/ccat-'.$settings['style']);  

	}

}