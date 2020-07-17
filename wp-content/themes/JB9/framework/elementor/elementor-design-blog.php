<?php

class Widget_PremiumPress_Blog extends \Elementor\Widget_Base {
 
	public function get_name() {
		return 'blog';
	}
 
	public function get_title() {
		return __( '{ Blog }', 'premiumpress-elementor' );
	} 
	public function get_icon() {
		return 'design-blog';
	} 
	public function get_categories() {
		return [ 'premiumpress-content' ];
	} 
	protected function _register_controls() {

		$this->start_controls_section(
			'content_section',
			[
				'label' => __( 'Blog Posts', 'premiumpress-elementor' ),
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
				'default' => '3',
			]
		);
		
		$this->end_controls_section();

	}
	protected function render() {

		$settings = $this->get_settings_for_display();
		
		get_template_part('framework/elementor/_blog/blog'.$settings['style']);  

	}

}