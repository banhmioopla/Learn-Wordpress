<?php

class Widget_PremiumPress_Newsletter extends \Elementor\Widget_Base {
 
	public function get_name() {
		return 'newsletter';
	}
 
	public function get_title() {
		return __( '{ Newsletter Form }', 'premiumpress-elementor' );
	} 
	public function get_icon() {
		return 'design-newsletter';
	} 
	public function get_categories() {
		return [ 'premiumpress-content' ];
	} 
	protected function _register_controls() {

		$this->start_controls_section(
			'content_section',
			[
				'label' => __( 'Newsletter', 'premiumpress-elementor' ),
				'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);
		 
	 $this->add_control(
			'style',
			[
				'label' => __( 'Style', 'premiumpress-elementor' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'options' => [					
					'' => __( 'Default', 'premiumpress-elementor' ),					
					 		 
				],
				'default' => '',
			]
		);
		 
		
		$this->end_controls_section();

	}
	protected function render() { global $userdata, $CORE, $settings;
	
		$settings = $this->get_settings_for_display();		
		
		 get_template_part( 'templates/widget', 'newsletter' );
		
	}

}