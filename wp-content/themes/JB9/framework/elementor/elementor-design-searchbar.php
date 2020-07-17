<?php

class Widget_PremiumPress_Searchbar extends \Elementor\Widget_Base {
 
	public function get_name() {
		return 'ccsearch';
	}
 
	public function get_title() {
		return __( '{ Search Box }', 'premiumpress-elementor' );
	} 
	public function get_icon() {
		return 'design-search';
	} 
	public function get_categories() {
		return [ 'premiumpress-content' ];
	} 
	protected function _register_controls() {

		$this->start_controls_section(
			'section1',
			[
				'label' => __( 'Search Blocks', 'premiumpress-elementor' ),
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
					//'3' => __( 'Style 3', 'premiumpress-elementor' ),	 
				],
				'default' => '1',
			]
		); 
 
		
		$this->end_controls_section();

	}
	protected function render() { global $userdata, $CORE, $settings;
	
		$settings = $this->get_settings_for_display();
		 
		get_template_part('framework/elementor/_searchbox/sbox-'.$settings['style']); 
	 
		
	}

}