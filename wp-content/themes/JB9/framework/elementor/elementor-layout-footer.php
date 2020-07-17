<?php

class Widget_PremiumPress_Footer extends \Elementor\Widget_Base {
 
	public function get_name() {
		return 'footer';
	}
 
	public function get_title() {
		return __( '{ Footer }', 'premiumpress-elementor' );
	} 
	public function get_icon() {
		return 'layout-footer';
	} 
	public function get_categories() {
		return [ 'premiumpress-header' ];
	} 
	protected function _register_controls() {

		$this->start_controls_section(
			'section1',
			[
				'label' => __( '1. Footer - Top', 'premiumpress-elementor' ),
				'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);
		
	  $this->add_control(
			'show1',
			[
				'label' 		=> __( 'Display', 'premiumpress-elementor' ),
				'type' 			=> \Elementor\Controls_Manager::SWITCHER,
				'label_on' 		=> __( 'Show', 'premiumpress-elementor' ),
				'label_off' 	=> __( 'Hide', 'premiumpress-elementor' ),
				'return_value' 	=> 'yes',
				'default' 		=> 'yes',
			]
		); 
 
	 	$this->add_control(
			'style_top',
			[
				'label' => __( 'Style', 'premiumpress-elementor' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'options' => [					
					'1' => __( 'Style 1', 'premiumpress-elementor' ),
					'2' => __( 'Style 2', 'premiumpress-elementor' ),
					'3' => __( 'Style 3', 'premiumpress-elementor' ),
					'4' => __( 'Style 4', 'premiumpress-elementor' ),
					'5' => __( 'Style 5', 'premiumpress-elementor' ),
  					//'6' => __( 'Style 6', 'premiumpress-elementor' ),
  					//'7' => __( 'Style 7', 'premiumpress-elementor' ),
  					//'8' => __( 'Style 8', 'premiumpress-elementor' ),
  					
				],
				'default' => '1',
			]
		);
		
	 	$this->add_control(
			'bg_top',
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
				'default' => 'bg-dark',
			]
		);
		
 	  $this->add_control(
			'bordertop_1',
			[
				'label' 		=> __( 'Border Top', 'premiumpress-elementor' ),
				'type' 			=> \Elementor\Controls_Manager::SWITCHER,
				'label_on' 		=> __( 'Show', 'premiumpress-elementor' ),
				'label_off' 	=> __( 'Hide', 'premiumpress-elementor' ),
				'return_value' 	=> 'yes',
				'default' 		=> 'no',
			]
		);
 	  $this->add_control(
			'borderbot_1',
			[
				'label' 		=> __( 'Border Bottom', 'premiumpress-elementor' ),
				'type' 			=> \Elementor\Controls_Manager::SWITCHER,
				'label_on' 		=> __( 'Show', 'premiumpress-elementor' ),
				'label_off' 	=> __( 'Hide', 'premiumpress-elementor' ),
				'return_value' 	=> 'yes',
				'default' 		=> 'no',
			]
		);
		
		$this->end_controls_section();
		
		
		$this->start_controls_section(
			'section2',
			[
				'label' => __( '2. Footer - Bottom', 'premiumpress-elementor' ),
				'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);
		
		
	  $this->add_control(
			'show2',
			[
				'label' 		=> __( 'Display', 'premiumpress-elementor' ),
				'type' 			=> \Elementor\Controls_Manager::SWITCHER,
				'label_on' 		=> __( 'Show', 'premiumpress-elementor' ),
				'label_off' 	=> __( 'Hide', 'premiumpress-elementor' ),
				'return_value' 	=> 'yes',
				'default' 		=> 'yes',
			]
		); 
 
	 	$this->add_control(
			'style_bot',
			[
				'label' => __( 'Style', 'premiumpress-elementor' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'options' => [					
					'1' => __( 'Style 1', 'premiumpress-elementor' ),
					'2' => __( 'Style 2', 'premiumpress-elementor' ),
					'3' => __( 'Style 3', 'premiumpress-elementor' ),
					'4' => __( 'Style 4', 'premiumpress-elementor' ),
					//'5' => __( 'Style 5', 'premiumpress-elementor' ),
   					
				],
				'default' => '1',
			]
		);
	 	$this->add_control(
			'bg_bot',
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
				'default' => 'bg-dark',
			]
		);
 	  $this->add_control(
			'bordertop_2',
			[
				'label' 		=> __( 'Border Top', 'premiumpress-elementor' ),
				'type' 			=> \Elementor\Controls_Manager::SWITCHER,
				'label_on' 		=> __( 'Show', 'premiumpress-elementor' ),
				'label_off' 	=> __( 'Hide', 'premiumpress-elementor' ),
				'return_value' 	=> 'yes',
				'default' 		=> 'yes',
			]
		);
 	  $this->add_control(
			'borderbot_2',
			[
				'label' 		=> __( 'Border Bottom', 'premiumpress-elementor' ),
				'type' 			=> \Elementor\Controls_Manager::SWITCHER,
				'label_on' 		=> __( 'Show', 'premiumpress-elementor' ),
				'label_off' 	=> __( 'Hide', 'premiumpress-elementor' ),
				'return_value' 	=> 'yes',
				'default' 		=> 'no',
			]
		);
		
		$this->end_controls_section();
		

	}
	protected function render() { global $userdata, $CORE, $settings;

		$settings = $this->get_settings_for_display();	
		
		// FOOTER TOP
		if($settings['show1'] == "yes"){
		
			// EXTRA STYLES
			$class = "";		
			$class .= $settings['bg_top']." ";			
			if($settings['bordertop_1'] == "yes"){ 
			$class .= " border-top";
			}			
			if($settings['borderbot_1'] == "yes"){ 
			$class .= " border-bottom";
			}			
			$settings['class'] = $class;
			
			get_template_part('framework/elementor/_footer/footer-top' . $settings['style_top']); 	
			
		}
		
		// FOOTER BOTTOM
		if($settings['show2'] == "yes"){
		
			// EXTRA STYLES
			$class = "";		
			$class .= $settings['bg_bot']." ";			
			if($settings['bordertop_2'] == "yes"){ 
			$class .= " border-top";
			}			
			if($settings['borderbot_2'] == "yes"){ 
			$class .= " border-bottom";
			}			
			$settings['class'] = $class;
			
			get_template_part('framework/elementor/_footer/footer-bot' . $settings['style_bot']); 
		
		}
 

	}

}