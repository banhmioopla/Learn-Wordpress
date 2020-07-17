<?php

class Widget_PremiumPress_Title extends \Elementor\Widget_Base {
 
	public function get_name() {
		return 'ctitle';
	}
 
	public function get_title() {
		return __( '{ Titles }', 'premiumpress-elementor' );
	} 
	public function get_icon() {
		return 'fa fa-header';
	} 
	public function get_categories() {
		return [ 'premiumpress-content' ];
	} 
	protected function _register_controls() {

		$this->start_controls_section(
			'content_section',
			[
				'label' => __( 'Title Blocks', 'premiumpress-elementor' ),
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
					'2' => __( 'Style 2', 'premiumpress-elementor' ),
					'3' => __( 'Style 3', 'premiumpress-elementor' ),	
					'4' => __( 'Style 4', 'premiumpress-elementor' ),	
			 		 
				],
				'default' => '1',
			]
		); 
		
			
		$this->add_control(
			'txt1',
			[
				'label' => __( 'Text 1', 'premiumpress-elementor' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => __( 'This is a title', 'premiumpress-elementor' ),
				'placeholder' => "",
			]
		);
		
		$this->add_control(
			'txt2',
			[
				'label' => __( 'Text 2', 'premiumpress-elementor' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => __( 'Vestibulum commodo volutpat a, convallis ac, laoreet.', 'premiumpress-elementor' ),
				'placeholder' => "",
			]
		);
		
		
		$this->end_controls_section();

	}
	protected function render() { global $userdata, $CORE, $settings;
	
		$settings = $this->get_settings_for_display();
		 
		switch($settings['style']){
		
			case "1": {
			get_template_part('framework/elementor/_ctitle/ctitle-1');  
			} break;
			case "2": {			
			get_template_part('framework/elementor/_ctitle/ctitle-2');  		
			} break;			
			case "3": {
			get_template_part('framework/elementor/_ctitle/ctitle-3');  
			} break;			
		  	case "4": {
			get_template_part('framework/elementor/_ctitle/ctitle-4');  
			} break;
			default: {			
			 		
			} break;
		
		} 
		
 
		
	}

}