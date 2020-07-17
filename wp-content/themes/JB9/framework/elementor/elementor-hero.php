<?php

class Widget_PremiumPress_Hero extends \Elementor\Widget_Base {
 
	public function get_name() {
		return 'home-hero';
	}
 
	public function get_title() {
		return __( '{ Hero }', 'premiumpress-elementor' );
	} 
	public function get_icon() {
		return 'home-hero';
	} 
	public function get_categories() {
		return [ 'premiumpress-home' ];
	} 
	protected function _register_controls() {

		$this->start_controls_section(
			'content_section',
			[
				'label' => __( 'Hero', 'premiumpress-elementor' ),
				'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		); 
		
	
	// HERO ARRAY
	$harray = array("0" => "Default Hero design");
	$i=1; 
	while($i < 39){
		$harray[$i] = "Style ".$i;
		$i++;
	}
		 
	 $this->add_control(
			'style',
			[
				'label' => __( 'Hero Design', 'premiumpress-elementor' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'options' => $harray,
				'default' => '0',
			]
		); 

	
		$this->add_control(
			'img1_txt1',
			[
				'label' => __( 'Heading', 'premiumpress-elementor' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => __( 'This is my awesome title text', 'premiumpress-elementor' ),
					'condition' => ['style' => array(
				'0','1','2','3','4','5','6','7','8','9','10',
				'11','12','13','14','15','16','17','18','19',
				'20','21','22','23','24','25','26','27','29','30',
				'31','32','33','34','37')
				],
			]
		);
		
		$this->add_control(
			'img1_txt2',
			[
				'label' => __( 'Sub Text', 'premiumpress-elementor' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => 'Subheading text here',
					'condition' => ['style' => array(
				'0','1','2','3','4','5','6','7','8','9','10',
				'11','12','13','14','15','16','17','18','19',
				'20','21','22','23','24','25','26','27','29','30',
				'31','32','33','34','37')
				],
			]
		);	
		
		$this->add_control(
			'img1_txt3',
			[
				'label' => __( 'Description', 'premiumpress-elementor' ),
				'type' => \Elementor\Controls_Manager::TEXTAREA,
				'default' => 'Curabitur quis iaculis sem. Sed fermentum augue eu felis dignissim eleifend. Sed luctus, dolor in vulputate mattis, purus mi pharetra ante.',
				
				'condition' => ['style' => array('3','6','7','8', '17','18','21', '11','13', '34')],
			]
		);
		
		$this->add_control(
			'btn1',
			[
				'label' => __( 'Button Text', 'premiumpress-elementor' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => __( 'Button Text', 'premiumpress-elementor' ),
				'condition' => ['style' => array(
				'1','2','3','4','5','6','7','8','9','10',
				'11','12','13','14','15','16','17','18','19',
				'20','21','22','23','24','25','26','29','30',
				'31','32','33','33','34','37')
				],
			]
		);
		
		$this->add_control(
			'btn1_link',
			[
				'label' => __( 'Button Link', 'premiumpress-elementor' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => _ppt(array('links','search')),
				'condition' => ['style' => array(
				'1','2','3','4','5','6','7','8','9','10',
				'11','12','13','14','15','16','17','18','19',
				'20','21','22','23','24','25','26','29','30',
				'31','32','33','33','34','36','37')
				],
			]
		);
  




		
		$this->add_control(
			'img1',
			[
				'label' => __( 'Background Image', 'premiumpress-elementor' ),
				'type' => \Elementor\Controls_Manager::MEDIA,
				'default' => [
					'url' => '',
				]
			]
		); 
		
		$this->add_control(
			'img2',
			[
				'label' => __( 'Image 2', 'premiumpress-elementor' ),
				'type' => \Elementor\Controls_Manager::MEDIA,
				'default' => [
					'url' => '',
				],
				'condition' => ['style' => array('26','28', '38','35')],
				
			]
		); 
		
		$this->add_control(
			'img3',
			[
				'label' => __( 'Image 3', 'premiumpress-elementor' ),
				'type' => \Elementor\Controls_Manager::MEDIA,
				'default' => [
					'url' => '',
				],
				'condition' => ['style' => array('28','38','35')],
			]
		); 
		
		$this->add_control(
			'img4',
			[
				'label' => __( 'Image 4', 'premiumpress-elementor' ),
				'type' => \Elementor\Controls_Manager::MEDIA,
				'default' => [
					'url' => '',
				],
				'condition' => ['style' => array('28','38','35')],
			]
		); 
		
		$this->add_control(
			'img5',
			[
				'label' => __( 'Image 5', 'premiumpress-elementor' ),
				'type' => \Elementor\Controls_Manager::MEDIA,
				'default' => [
					'url' => '',
				],
				'condition' => ['style' => array('35')],
			]
		); 	 
		
		
		$this->add_control(
			'img6',
			[
				'label' => __( 'Image 6', 'premiumpress-elementor' ),
				'type' => \Elementor\Controls_Manager::MEDIA,
				'default' => [
					'url' => '',
				],
				'condition' => ['style' => array('99')],
			]
		); 
		
		$this->add_control(
			'img7',
			[
				'label' => __( 'Image 7', 'premiumpress-elementor' ),
				'type' => \Elementor\Controls_Manager::MEDIA,
				'default' => [
					'url' => '',
				],
				'condition' => ['style' => array('99')],
			]
		); 
		
		$this->add_control(
			'img8',
			[
				'label' => __( 'Image 8', 'premiumpress-elementor' ),
				'type' => \Elementor\Controls_Manager::MEDIA,
				'default' => [
					'url' => '',
				],
				'condition' => ['style' => array('99')],
			]
		); 
		
		$this->add_control(
			'img9',
			[
				'label' => __( 'Image 9', 'premiumpress-elementor' ),
				'type' => \Elementor\Controls_Manager::MEDIA,
				'default' => [
					'url' => '',
				],
				'condition' => ['style' => array('99')],
			]
		); 
		
		$this->add_control(
			'img10',
			[
				'label' => __( 'Image 10', 'premiumpress-elementor' ),
				'type' => \Elementor\Controls_Manager::MEDIA,
				'default' => [
					'url' => '',
				],
				'condition' => ['style' => array('99')],
			]
		); 
		
	 
		
		$this->add_control(
			'img1_link',
			[
				'label' => __( 'Image 1 Link', 'premiumpress-elementor' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => home_url().'/',
				'condition' => ['style' => array('28','35','38')]
			]
		); 
		
		$this->add_control(
			'img2_link',
			[
				'label' => __( 'Image 2 Link', 'premiumpress-elementor' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => home_url().'/',
				'condition' => ['style' => array('28','35','38')]
			]				
		); 
		
		$this->add_control(
			'img3_link',
			[
				'label' => __( 'Image 3 Link', 'premiumpress-elementor' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => home_url().'/',
				'condition' => ['style' => array('28','35','38')],
			]				
		); 
		
		$this->add_control(
			'img4_link',
			[
				'label' => __( 'Image 4 Link', 'premiumpress-elementor' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => home_url().'/',
				'condition' => ['style' => array('28','35','38')],
			]				
		);
		
		$this->add_control(
			'img5_link',
			[
				'label' => __( 'Image 5 Link', 'premiumpress-elementor' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => home_url().'/',
				'condition' => ['style' => array('35')],
			]				
		);

		$this->add_control(
			'img6_link',
			[
				'label' => __( 'Image 6 Link', 'premiumpress-elementor' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => home_url().'/',
				'condition' => ['style' => array('99')],
			]				
		);

		$this->add_control(
			'img7_link',
			[
				'label' => __( 'Image 7 Link', 'premiumpress-elementor' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => home_url().'/',
				'condition' => ['style' => array('99')],
			]				
		);

		$this->add_control(
			'img8_link',
			[
				'label' => __( 'Image 8 Link', 'premiumpress-elementor' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => home_url().'/',
				'condition' => ['style' => array('99')],
			]				
		);

		$this->add_control(
			'img9_link',
			[
				'label' => __( 'Image 9 Link', 'premiumpress-elementor' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => home_url().'/',
				'condition' => ['style' => array('99')],
			]				
		);

		$this->add_control(
			'img10_link',
			[
				'label' => __( 'Image 10 Link', 'premiumpress-elementor' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => home_url().'/',
				'condition' => ['style' => array('99')],
			]				
		);
		
	 
	
		$this->end_controls_section();
		
		$this->start_controls_section(
			'extra_section3',
			[
				'label' => __( 'Hero Text Area 2', 'premiumpress-elementor' ),
				
				'condition' => ['style' => array('13','26')],			
				 
			]
				
		); 
		
		$this->add_control(
			'img2_txt1',
			[
				'label' => __( 'Title Text', 'premiumpress-elementor' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => __( 'This is my awesome title text', 'premiumpress-elementor' ),
				'condition' => ['style' => array('26','13')],
			]
		);
		
		$this->add_control(
			'img2_txt2',
			[
				'label' => __( 'Subtitle Text', 'premiumpress-elementor' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => 'Subheading text here',
				'condition' => ['style' => array('26','13')],
			]
		);	
		
		$this->add_control(
			'btn2',
			[
				'label' => __( 'Button Text', 'premiumpress-elementor' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => __( 'Button Text', 'premiumpress-elementor' ),
				'condition' => ['style' => array('26','13')],
			]
		);
		
		$this->add_control(
			'btn2_link',
			[
				'label' => __( 'Button Link', 'premiumpress-elementor' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => _ppt(array('links','search')),
				'condition' => ['style' => array('26','13')],
			]
		);
		
		$this->end_controls_section();
		
		$this->start_controls_section(
			'extra_section5',
			[
				'label' => __( 'Hero Text Area 3', 'premiumpress-elementor' ),	
				'condition' => ['style' => array('13')],			
				 
			]
		); 
		
		$this->add_control(
			'img3_txt1',
			[
				'label' => __( 'Title Text', 'premiumpress-elementor' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => __( 'This is my awesome title text', 'premiumpress-elementor' ),
			]
		);
		
		$this->add_control(
			'img3_txt2',
			[
				'label' => __( 'Subtitle Text', 'premiumpress-elementor' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => 'Subheading text here',
			]
		);	
		
		$this->add_control(
			'btn3',
			[
				'label' => __( 'Button Text', 'premiumpress-elementor' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => __( 'Button Text', 'premiumpress-elementor' ),
				'condition' => ['style' => array('99')],
			]
		);
		
		$this->add_control(
			'btn3_link',
			[
				'label' => __( 'Button Link', 'premiumpress-elementor' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => _ppt(array('links','search')),
				'condition' => ['style' => array('99')],
			]
		); 
		
		$this->end_controls_section();
			
		$this->start_controls_section(
			'extra_section6',
			[
				'label' => __( 'Hero Text Area 4', 'premiumpress-elementor' ),	
				'condition' => ['style' => array('13')],			
				 
			]
		); 
		
		$this->add_control(
			'img4_txt1',
			[
				'label' => __( 'Title Text', 'premiumpress-elementor' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => __( 'This is my awesome title text', 'premiumpress-elementor' ),
			]
		);
		
		$this->add_control(
			'img4_txt2',
			[
				'label' => __( 'Subtitle Text', 'premiumpress-elementor' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => 'Subheading text here',
			]
		);	
		
		$this->add_control(
			'btn4',
			[
				'label' => __( 'Button Text', 'premiumpress-elementor' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => __( 'Button Text', 'premiumpress-elementor' ),
				'condition' => ['style' => array('99')],
			]
		);
		
		$this->add_control(
			'btn4_link',
			[
				'label' => __( 'Button Link', 'premiumpress-elementor' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => _ppt(array('links','search')),
				'condition' => ['style' => array('99')],
			]
		); 
		
		$this->end_controls_section(); 

		

	}
	protected function render() { global $post, $CORE, $settings;
	
	$data = $this->get_settings_for_display();
	
	
	$settings = array(
	
	// IMAGES
	"img1" 			=> $data['img1']['url'],
	"img2" 			=> $data['img2']['url'],
	"img3" 			=> $data['img3']['url'],
	"img4" 			=> $data['img4']['url'],
	"img5" 			=> $data['img5']['url'],
	"img6" 			=> $data['img6']['url'],
	"img7" 			=> $data['img7']['url'],
	"img8" 			=> $data['img8']['url'],
	"img9" 			=> $data['img9']['url'],
	"img10" 		=> $data['img10']['url'],	
	
		// LINKS 
		"img1_link" 	=> $data['img1_link'],
		"img2_link" 	=> $data['img2_link'],
		"img3_link" 	=> $data['img3_link'],
	
			
		"img1_txt1" 	=> $data['img1_txt1'],	
		"img1_txt2" 	=> $data['img1_txt2'],
		"img1_txt3" 	=> $data['img1_txt3'],
		"img1_btnlink" 	=> $data['btn1_link'],
		"img1_btntxt" 	=> $data['btn1'],				
				
		"img2_txt1" 	=> $data['img2_txt1'],	
		"img2_txt2" 	=> $data['img2_txt2'],
		"img2_btnlink" 	=> $data['btn2_link'],
		"img2_btntxt" 	=> $data['btn2'],

		"img3_txt1" 	=> $data['img3_txt1'],	
		"img3_txt2" 	=> $data['img3_txt2'],
		"img3_lbtnink" 	=> $data['btn3_link'],
		"img3_btntxt" 	=> $data['btn3'],		
		
		"img4_txt1" 	=> $data['img4_txt1'],	
		"img4_txt2" 	=> $data['img4_txt2'],
		"img4_lbtnink" 	=> $data['btn4_link'],
		"img4_btntxt" 	=> $data['btn4'],		
		 
		 	
		// LINKS		
		"img4_link" 	=> $data['img4_link'],
		"img5_link" 	=> $data['img5_link'],
 		"img6_link" 	=> $data['img6_link'],
 		"img7_link" 	=> $data['img7_link'],
 		"img8_link" 	=> $data['img8_link'],
 		"img9_link" 	=> $data['img9_link'],
 		"img10_link" 	=> $data['img10_link'],
  
		
				//"noload" => 1
			
	);
	
	get_template_part('framework/elementor/_hero/hero-'.$data['style']);	
	 
	
		
	}

}