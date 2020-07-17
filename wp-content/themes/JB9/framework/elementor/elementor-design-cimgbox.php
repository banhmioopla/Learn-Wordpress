<?php

class Widget_PremiumPress_Cimgbox extends \Elementor\Widget_Base {
 
	public function get_name() {
		return 'cimgbox';
	}
 
	public function get_title() {
		return __( '{ Image Blocks }', 'premiumpress-elementor' );
	} 
	public function get_icon() {
		return 'design-imagebox';
	} 
	public function get_categories() {
		return [ 'premiumpress-content' ];
	} 
	protected function _register_controls() {

		$this->start_controls_section(
			'content_section',
			[
				'label' => __( 'Image Blocks', 'premiumpress-elementor' ),
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
		
		
		
		$i=1; while($i < 7){ 
		$this->end_controls_section();
		
		$this->start_controls_section(
			'extra_section'.$i,
			[
				'label' => __( 'Image Box '.$i, 'premiumpress-elementor' ),			
				 
			]
		); 		
		
		$this->add_control(
			'img'.$i,
			[
				'label' => __( 'Image', 'premiumpress-elementor' ),
				'type' => \Elementor\Controls_Manager::MEDIA,
				'default' => [
					'url' => '',
				]
			]
		); 
		
		
		$this->add_control(
			'txt'.$i,
			[
				'label' => __( 'Title Text', 'premiumpress-elementor' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => __( 'Title Text', 'premiumpress-elementor' ),
				'placeholder' => "",
			]
		);
		
		$this->add_control(
			'link'.$i,
			[
				'label' => __( 'Link', 'premiumpress-elementor' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => __( home_url()."?s=", 'premiumpress-elementor' ),
				'placeholder' => "",
			]
		);
		
		$i++; }
		
		
		 
	 
		
		$this->end_controls_section();

	}
	protected function render() { global $userdata, $CORE, $settings;
	
		$settings = $this->get_settings_for_display();
 		
		$i=1; while($i < 7){ 
 		$settings['sampledata'][$i] = array(			
			"name" => $settings['txt'.$i], 
			"img" => $settings['img'.$i]['url'], 
			"link" => $settings['link'.$i],				 		  
		);
		$i++; 
		}
		
		get_template_part('framework/elementor/_cimgbox/cimgbox-'.$settings['style']);  
			
 
		
	}

}