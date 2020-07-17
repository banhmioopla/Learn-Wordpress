<?php

class Widget_PremiumPress_Cpars extends \Elementor\Widget_Base {
 
	public function get_name() {
		return 'cpars';
	}
 
	public function get_title() {
		return __( '{ Paragraph Blocks }', 'premiumpress-elementor' );
	} 
	public function get_icon() {
		return 'fa fa-list-alt';
	} 
	public function get_categories() {
		return [ 'premiumpress-content' ];
	} 
	protected function _register_controls() {

		$this->start_controls_section(
			'content_section',
			[
				'label' => __( 'Paragraph Blocks', 'premiumpress-elementor' ),
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
					'5' => __( 'Style 5', 'premiumpress-elementor' ),	
					'6' => __( 'Style 6', 'premiumpress-elementor' ),	
					'7' => __( 'Style 7', 'premiumpress-elementor' ),	
					
					 
				],
				'default' => '1',
			]
		);
		
		$this->add_control(
			'image',
			[
				'label' => __( 'Image', 'premiumpress-elementor' ),
				'type' => \Elementor\Controls_Manager::MEDIA,
				'default' => [
					'url' => '',
				]
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
				'default' => __( 'Curabitur et ligula. Ut molestie a, ultricies porta urna. Vestibulum commodo volutpat a, convallis ac, laoreet.', 'premiumpress-elementor' ),
				'placeholder' => "",
			]
		);
		
		
		$this->add_control(
			'txt3',
			[
				'label' => __( 'Text 2', 'premiumpress-elementor' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => __( 'Curabitur et ligula. Ut molestie a, ultricies porta urna. Vestibulum commodo volutpat a, convallis ac, laoreet.', 'premiumpress-elementor' ),
				'placeholder' => "",
			]
		);
		  
		
		$this->add_control(
			'btn_txt',
			[
				'label' => __( 'Button Text', 'premiumpress-elementor' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => __( 'Read More', 'premiumpress-elementor' ),
				'placeholder' => "",
			]
		);
		
		$this->add_control(
			'btn_link',
			[
				'label' => __( 'Button Link', 'premiumpress-elementor' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => __( 'http://www.google.com', 'premiumpress-elementor' ),
				'placeholder' => "",
			]
		);
	 
		
		$this->end_controls_section();

	}
	protected function render() { global $userdata, $CORE, $settings;
	
		$settings = $this->get_settings_for_display();
		
		$settings['img1'] = $settings['image']['url'];
		
		get_template_part('framework/elementor/_cpars/cpars-'.$settings['style']);  
			
 
		
	}

}