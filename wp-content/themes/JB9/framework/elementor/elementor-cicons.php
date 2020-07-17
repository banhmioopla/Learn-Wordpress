<?php

class Widget_PremiumPress_Cicons extends \Elementor\Widget_Base {
 
	public function get_name() {
		return 'cicons';
	}
 
	public function get_title() {
		return __( '{ Icon Boxes }', 'premiumpress-elementor' );
	} 
	public function get_icon() {
		return 'fa fa-smile-o';
	} 
	public function get_categories() {
		return [ 'premiumpress-content' ];
	} 
	protected function _register_controls() {

		$this->start_controls_section(
			'content_section',
			[
				'label' => __( 'Content Boxes', 'premiumpress-elementor' ),
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
				 
					
				],
				'default' => '1',
			]
		);
	 
	 
	 $i=1;
	 while($i< 5){ 
	$this->end_controls_section();		
		
		
		
		$this->start_controls_section(
			'box'.$i,
			[
				'label' => __( 'Box'.$i, 'premiumpress-elementor' ),			
				 
			]
		); 		 
	 
	$this->add_control(
			'box'.$i.'_icon',
			[
				'label' => __( 'Icon', 'premiumpress-elementor' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => __( 'fa fa-cog', 'premiumpress-elementor' ),
				'placeholder' => "",
			]
		);
		
		$this->add_control(
			'box'.$i.'_txt1',
			[
				'label' => __( 'Title', 'premiumpress-elementor' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => __( 'Awesome title!', 'premiumpress-elementor' ),
				'placeholder' => "",
			]
		);
		
		$this->add_control(
			'box'.$i.'_txt2',
			[
				'label' => __( 'Description', 'premiumpress-elementor' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => __( 'Small description.', 'premiumpress-elementor' ),
				'placeholder' => "",
			]
		);
		
		$i++;
		}
		  
		 
		
		$this->end_controls_section();

	}
	protected function render() { global $userdata, $CORE, $settings;
	
		$settings = $this->get_settings_for_display();		
		 
		get_template_part('framework/elementor/_cicons/cicons-'.$settings['style']);
		
 
		
	}

}