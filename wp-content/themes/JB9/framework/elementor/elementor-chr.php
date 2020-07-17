<?php

class Widget_PremiumPress_Chr extends \Elementor\Widget_Base {
 
	public function get_name() {
		return 'chr';
	}
 
	public function get_title() {
		return __( '{ Paragraph Break }', 'premiumpress-elementor' );
	} 
	public function get_icon() {
		return 'fa fa-underline';
	} 
	public function get_categories() {
		return [ 'premiumpress-content' ];
	} 
	protected function _register_controls() {

		$this->start_controls_section(
			'content_section',
			[
				'label' => __( 'HR Styles', 'premiumpress-elementor' ),
				'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);
		 
	 $this->add_control(
			'style',
			[
				'label' => __( 'Style', 'premiumpress-elementor' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'options' => [					
					'hrfade' => __( 'fade', 'premiumpress-elementor' ),					
					'hrfade-2' => __( 'fade-2', 'premiumpress-elementor' ),
					 
					 
					 'dots' => __( 'dots', 'premiumpress-elementor' ),
					 'accessory' => __( 'accessory', 'premiumpress-elementor' ),
					 'pill' => __( 'pill', 'premiumpress-elementor' ),
					 'vertical-lines' => __( 'vertical-lines', 'premiumpress-elementor' ),
					 'horizontal-lines' => __( 'horizontal-lines', 'premiumpress-elementor' ),
					 'slash-1' => __( 'slash-1', 'premiumpress-elementor' ),
					 'slash-2' => __( 'slash-2', 'premiumpress-elementor' ),
					 'slash-3' => __( 'slash-3', 'premiumpress-elementor' ),
					 'bookends' => __( 'bookends', 'premiumpress-elementor' ),
					 'bookends-dots' => __( 'bookends-dots', 'premiumpress-elementor' ),
					 'flair' => __( 'flair', 'premiumpress-elementor' ),
					 'wave' => __( 'wave', 'premiumpress-elementor' ),
					 'shine' => __( 'shine', 'premiumpress-elementor' ),
					 'charlie' => __( 'charlie', 'premiumpress-elementor' ),
					 'no_line' => __( 'no_line', 'premiumpress-elementor' ),
						 
				],
				'default' => 'fade',
			]
		); 
		
		$this->add_control(
			'class',
			[
				'label' => __( 'CSS Class', 'premiumpress-elementor' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => __( 'col-md-8', 'premiumpress-elementor' ),
				'placeholder' => "",
			]
		);
		 
		
		$this->end_controls_section();

	}
	protected function render() { global $userdata, $CORE, $settings;
	
		$settings = $this->get_settings_for_display();		
		
		get_template_part('framework/elementor/_extra/chr-1'); 
		
	}

}