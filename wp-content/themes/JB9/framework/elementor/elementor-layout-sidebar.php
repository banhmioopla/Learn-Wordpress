<?php

class Widget_PremiumPress_Sidebar extends \Elementor\Widget_Base {
 
	public function get_name() {
		return 'ppt-sidebar';
	}
 
	public function get_title() {
		return __( '{ Sidebar }', 'premiumpress-elementor' );
	} 
	public function get_icon() {
		return 'layout-sidebar';
	} 
	public function get_categories() {
		return [ 'premiumpress-header' ];
	} 
	protected function _register_controls() {

		$this->start_controls_section(
			'section1',
			[
				'label' => __( 'This will display the default sidebar for your theme. There is no need to configure anything here. Use the widgets as normal if you want to change the sidebar elements.', 'premiumpress-elementor' ),
				'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
				 
			]
		);
		
 
	 
		$this->end_controls_section();
		

	}
	protected function render() { global $userdata, $CORE, $settings;

		$settings = $this->get_settings_for_display();	
		
		$settings['no-width'] = 1;
		
		get_sidebar(); 

	}

}