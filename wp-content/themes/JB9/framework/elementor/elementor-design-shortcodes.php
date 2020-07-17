<?php

class Widget_PremiumPress_Shortcode extends \Elementor\Widget_Base {
 
	public function get_name() {
		return 'shortcode';
	}
 
	public function get_title() {
		return __( '{ Shortcodes }', 'premiumpress-elementor' );
	} 
	public function get_icon() {
		return 'design-code';
	} 
	public function get_categories() {
		return [ 'premiumpress-content' ];
	} 
	protected function _register_controls() {
 
		$this->start_controls_section(
			'content_section',
			[
				'label' => __( 'Shortcodes', 'premiumpress-elementor' ),
				'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);
		
		 
		
		$this->add_control(
			'code',
			[
				'label' => __( 'Select Shortcode', 'premiumpress-elementor' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'options' => ppt_shortcodes(),
				'default' => 'TITLE',
				 
			]
		);
		
		/*
		$this->add_control(
			'image_pathonly',
			[
				'label' => __( 'URL Only', 'premiumpress-elementor' ),
				'type'         => \Elementor\Controls_Manager::SWITCHER,	
				'condition' => ['code' => 'IMAGE'],
				 
			]
		);
		*/
		
	
		$this->add_control(
			'images_style',
			[
				'label' => __( 'Gallery Style', 'premiumpress-elementor' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'options' => [					
					'1' => __( 'Style 1', 'premiumpress-elementor' ),					
					//'2' => __( 'Style 2', 'premiumpress-elementor' ),								  
				],
				'default' => '1',
				'condition' => ['code' => 'IMAGES'],
				 
			]
		);
		// DYNAMIC CONTENT
		$this->add_control(
			'menu_parent_arrow',
			[
				'label'        => __( 'Dynamic Content', 'ppremiumpress-elementor' ),
				'type'         => \Elementor\Controls_Manager::SWITCHER,				 
			]
		);
		
		$this->add_control(
			'comments_style',
			[
				'label' => __( 'Comments Style', 'premiumpress-elementor' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'options' => [					
					'1' => __( 'Style 1', 'premiumpress-elementor' ),					
					//'2' => __( 'Style 2', 'premiumpress-elementor' ),								  
				],
				'default' => '1',
				'condition' => ['code' => 'COMMENTS'],
				 
			]
		);
		
		
		
		$this->add_control(
			'custom_html_style',
			[
				'label' => __( 'Custom HTML', 'premiumpress-elementor' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				 
				'options' => [
					'h1' => 'H1',
					'h2' => 'H2',
					'h3' => 'H3',
					'h4' => 'H4',
					'h5' => 'H5',
					'h6' => 'H6',
					'div' => 'div',
					'span' => 'span',
					'p' => 'p',
					'' => 'none',
				],
				'default' => '',
				'condition' => ['code' => 'TITLE'],
				 
			]
		);
		
		
			$this->add_control(
			'customfield_id',
			[
				'label' => __( 'Custom Field', 'premiumpress-elementor' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'options' => ppt_customfields(),
				'default' => '1',
				'condition' => ['code' => 'CUSTOMFIELD'],
				 
			]
		);
		
		// BACKGROUND IMG
		$this->add_control(
			'image_bg_only',
			[
				'label' => __( 'Background Image?', 'premiumpress-elementor' ),
				'type'         => \Elementor\Controls_Manager::SWITCHER,	
				'condition' => ['menu_parent_arrow' => 'yes', 'code' => 'IMAGE'],
				 
			]
		);
		// DYNAMIC CONTENT ID
		$this->add_control(
			'attach_cssid',
			[
				'label' => __( 'CSS ID', 'premiumpress-elementor' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => __( '', 'premiumpress-elementor' ),
				'placeholder' => "",
				
				'condition' => ['menu_parent_arrow' => 'yes'],
			]
		);
	  
	 
		$this->end_controls_section();

	}
	protected function render() { global $args; $customvalue = "";
	
	$settings = $this->get_settings_for_display();
	
	//echo $settings['code']."<--";
 
	switch($settings['code']){
		
		default:{		 
			
			if(isset($settings['customfield_id']) && $settings['customfield_id'] != ""){
			$data = do_shortcode('['.$settings['code'].' field='.$settings['customfield_id'].']');			
			
			}elseif(is_numeric($settings['comments_style'])){
			$data = do_shortcode('['.$settings['code'].' style='.$settings['comments_style'].']');			
			
			}elseif($settings['image_bg_only'] == "yes" ){
			$data = do_shortcode('['.$settings['code'].' pathonly=1]');
			
			}elseif($settings['custom_html_style'] != "" ){
			$data = "<".$settings['custom_html_style'].">".do_shortcode('['.$settings['code'].']')."</".$settings['custom_html_style'].">";
		
			}else{
			$data = do_shortcode('['.$settings['code'].']');
			}
					
		} break;			
		
	}
	 
	
	if(!isset($_REQUEST['action'])){
		if($settings['menu_parent_arrow'] == "yes" && $settings['attach_cssid'] != "" && $data != ""){
		
			?>
			<script>
			jQuery(document).ready(function() {
			
				<?php if($settings['image_bg_only'] == "yes"){ ?>
				jQuery('#<?php echo $settings['attach_cssid']; ?>').css("background-image","url('<?php echo $data; ?>')");
				
				
				<?php }elseif($settings['code'] == "image" ){ ?>
				jQuery('#<?php echo $settings['attach_cssid']; ?>').css("background-image","url('<?php echo $data; ?>')");
				<?php }elseif($settings['code'] == "category"){ ?>
				jQuery('#<?php echo $settings['attach_cssid']; ?>').html("<?php echo $data; ?>");
				<?php }else{ ?>
				jQuery('#<?php echo $settings['attach_cssid']; ?>').text("<?php echo strip_tags($data); ?>");
				<?php } ?>
			});
			</script>
			<?php
			
		}else{
		
		echo $data;
		
		}
	}else{
	
	echo $data;
	
	}
	
	
	
} // end render
}// end classs