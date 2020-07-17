<?php

class Widget_PremiumPress_Coupon_Stores extends \Elementor\Widget_Base {
 
	public function get_name() {
		return 'coupon-stores';
	}
 
	public function get_title() {
		return __( '{ Stores }', 'premiumpress-elementor' );
	} 
	public function get_icon() {
		return 'design-list';
	} 
	public function get_categories() {
		return [ 'premiumpress-content' ];
	} 
	protected function _register_controls() {
	
		$this->start_controls_section(
			'content_section',
			[
				'label' => __( 'Stores Block', 'premiumpress-elementor' ),
				'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		); 

        $this->add_control(
            'show',
            [
                'label' => __( 'Number of Posts', 'premiumpress-elementor' ),
                'type' => \Elementor\Controls_Manager::NUMBER,
                'default' => '8'
            ]
        );
		  

		$this->end_controls_section();

	}
	protected function render() { global $args, $settings; 
	
	$settings = $this->get_settings_for_display();
	 
	// OUTPUT
	get_template_part('_coupon/elementor/stores'); 
	 
	
	
	}

}