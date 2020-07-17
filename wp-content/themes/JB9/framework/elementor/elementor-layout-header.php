<?php

class Widget_PremiumPress_Header extends \Elementor\Widget_Base {
 
	public function get_name() {
		return 'header';
	}
 
	public function get_title() {
		return __( '{ Header }', 'premiumpress-elementor' );
	} 
	public function get_icon() {
		return 'layout-header';
	} 
	public function get_categories() {
		return [ 'premiumpress-header' ];
	} 
	protected function _register_controls() {

		$this->start_controls_section(
			'section1',
			[
				'label' => __( '1. Header - Top Area', 'premiumpress-elementor' ),
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
				'default' 		=> 'yes',
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
				'default' 		=> 'yes',
			]
		);
		
		$this->end_controls_section();
		
		
		$this->start_controls_section(
			'section2',
			[
				'label' => __( '2. Header - Logo Area', 'premiumpress-elementor' ),
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
			'style_logo',
			[
				'label' => __( 'Logo Style', 'premiumpress-elementor' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'options' => [					
					'1' => __( 'Style 1', 'premiumpress-elementor' ),
					'2' => __( 'Style 2', 'premiumpress-elementor' ),
					'3' => __( 'Style 3', 'premiumpress-elementor' ),
					'4' => __( 'Style 4', 'premiumpress-elementor' ),
					'5' => __( 'Style 5', 'premiumpress-elementor' ),
  					'6' => __( 'Style 6', 'premiumpress-elementor' ),
  					'7' => __( 'Style 7', 'premiumpress-elementor' ),
  					'8' => __( 'Style 8', 'premiumpress-elementor' ),
  					'9' => __( 'Style 9', 'premiumpress-elementor' ),
  					
				],
				'default' => '1',
			]
		);
		
	 	$this->add_control(
			'bg_logo',
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
				'default' 		=> 'yes',
			]
		);
		
		
		$this->end_controls_section();
		
		$this->start_controls_section(
			'section3',
			[
				'label' => __( '3. Header - Menu Area', 'premiumpress-elementor' ),
				'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);
		
	  $this->add_control(
			'show3',
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
			'style_menu',
			[
				'label' => __( 'Nav Style', 'premiumpress-elementor' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'options' => [					
					'1' => __( 'Style 1', 'premiumpress-elementor' ),
					'2' => __( 'Style 2', 'premiumpress-elementor' ),
					'3' => __( 'Style 3', 'premiumpress-elementor' ),
					'4' => __( 'Style 4', 'premiumpress-elementor' ),
					'5' => __( 'Style 5', 'premiumpress-elementor' ),
  					'6' => __( 'Style 6', 'premiumpress-elementor' ),
  					
				],
				'default' => '1',
			]
		);
		
		
	 	$this->add_control(
			'bg_menu',
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
			'bordertop_3',
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
			'borderbot_3',
			[
				'label' 		=> __( 'Border Bottom', 'premiumpress-elementor' ),
				'type' 			=> \Elementor\Controls_Manager::SWITCHER,
				'label_on' 		=> __( 'Show', 'premiumpress-elementor' ),
				'label_off' 	=> __( 'Hide', 'premiumpress-elementor' ),
				'return_value' 	=> 'yes',
				'default' 		=> 'yes',
			]
		);
		
		$this->end_controls_section();
		
	 
		$this->start_controls_section(
			'section4',
			[
				'label' => __( '4. Header - Breadcrumbs', 'premiumpress-elementor' ),
				'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);
		
	  $this->add_control(
			'show4',
			[
				'label' 		=> __( 'Display', 'premiumpress-elementor' ),
				'type' 			=> \Elementor\Controls_Manager::SWITCHER,
				'label_on' 		=> __( 'Show', 'premiumpress-elementor' ),
				'label_off' 	=> __( 'Hide', 'premiumpress-elementor' ),
				'return_value' 	=> 'yes',
				'default' 		=> 'no',
			]
		);
		
		
	 	$this->add_control(
			'style_bread',
			[
				'label' => __( 'Nav Style', 'premiumpress-elementor' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'options' => [					
					'1' => __( 'Style 1', 'premiumpress-elementor' ),
					'2' => __( 'Style 2', 'premiumpress-elementor' ),
					//'3' => __( 'Style 3', 'premiumpress-elementor' ),
					//'4' => __( 'Style 4', 'premiumpress-elementor' ),
					//'5' => __( 'Style 5', 'premiumpress-elementor' ),
  					
				],
				'default' => '1',
			]
		);
		
		
	 	$this->add_control(
			'bg_bread',
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
			'bordertop_4',
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
			'borderbot_4',
			[
				'label' 		=> __( 'Border Bottom', 'premiumpress-elementor' ),
				'type' 			=> \Elementor\Controls_Manager::SWITCHER,
				'label_on' 		=> __( 'Show', 'premiumpress-elementor' ),
				'label_off' 	=> __( 'Hide', 'premiumpress-elementor' ),
				'return_value' 	=> 'yes',
				'default' 		=> 'yes',
			]
		);
		
		$this->end_controls_section();
		

	}
	protected function render() { global $userdata, $CORE, $settings;
	
		$settings = $this->get_settings_for_display();
		
		
		
		// HEADER TOP
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
			
			get_template_part('framework/elementor/_header/header-top' . $settings['style_top']); 		
		}
		
		// HEADER LOGO
		if($settings['show2'] == "yes"){
					
			// EXTRA STYLES
			$class = "";		
			$class .= $settings['bg_logo']." ";			
			if($settings['bordertop_2'] == "yes"){ 
			$class .= " border-top";
			}			
			if($settings['borderbot_2'] == "yes"){ 
			$class .= " border-bottom";
			}			
			$settings['class'] = $class;
			
			get_template_part('framework/elementor/_header/header-logo' . $settings['style_logo']); 
		}
		
		// HEADER MENU
		if($settings['show3'] == "yes"){
					
			// EXTRA STYLES
			$class = "";		
			$class .= $settings['bg_menu']." ";			
			if($settings['bordertop_3'] == "yes"){ 
			$class .= " border-top";
			}			
			if($settings['borderbot_3'] == "yes"){ 
			$class .= " border-bottom";
			}			
			$settings['class'] = $class;
			
			get_template_part('framework/elementor/_header/header-nav' . $settings['style_menu']); 		
		}	
 
		// HEADER BREADCRUMBS
		if($settings['show4'] == "yes"){
					
			// EXTRA STYLES
			$class = "";		
			$class .= $settings['bg_bread']." ";			
			if($settings['bordertop_4'] == "yes"){ 
			$class .= " border-top";
			}			
			if($settings['borderbot_4'] == "yes"){ 
			$class .= " border-bottom";
			}			
			$settings['class'] = $class;
			
			get_template_part('framework/elementor/_header/header-bread' . $settings['style_bread']); 		
		}	
 		
 
		
	}

}