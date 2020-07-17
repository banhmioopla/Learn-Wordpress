<?php

class Widget_PremiumPress_Slider extends \Elementor\Widget_Base {
 	/**
	 * @var \WP_Query
	 */
	private $_query = null;
	
	public function get_name() {
		return 'pptv9-slider';
	}
 
	public function get_title() {
		return __( '{ Slider }', 'premiumpress-elementor' );
	} 
	public function get_icon() {
		return 'design-slider';
	} 
	public function get_categories() {
		return [ 'premiumpress-content' ];
	} 
	public function get_script_depends() {
		return [ 'imagesloaded' ];
	}
	protected function _register_controls() {
		
		$this->start_controls_section(
			'section_content_sliders',
			[
				'label' => esc_html__( 'Sliders', 'premiumpress-elementor' ),
			]
		);

		$this->add_control(
			'tabs',
			[
				'label' => esc_html__( 'Slider Items', 'premiumpress-elementor' ),
				'type' => \Elementor\Controls_Manager::REPEATER,
				'default' => [
					[
						'tab_title'   => esc_html__( 'Slide #1', 'premiumpress-elementor' ),
						'tab_content' => esc_html__( 'I am item content. Click edit button to change this text.', 'premiumpress-elementor' ),
					],
					[
						'tab_title'   => esc_html__( 'Slide #2', 'premiumpress-elementor' ),
						'tab_content' => esc_html__( 'I am item content. Click edit button to change this text.', 'premiumpress-elementor' ),
					],
					[
						'tab_title'   => esc_html__( 'Slide #3', 'premiumpress-elementor' ),
						'tab_content' => esc_html__( 'I am item content. Click edit button to change this text.', 'premiumpress-elementor' ),
					],
					[
						'tab_title'   => esc_html__( 'Slide #4', 'premiumpress-elementor' ),
						'tab_content' => esc_html__( 'I am item content. Click edit button to change this text.', 'premiumpress-elementor' ),
					],
				],
				'fields' => [
					[
						'name'        => 'tab_title',
						'label'       => esc_html__( 'Title', 'premiumpress-elementor' ),
						'type'        => \Elementor\Controls_Manager::TEXT,
						'dynamic'     => [ 'active' => true ],
						'default'     => esc_html__( 'Slide Title' , 'premiumpress-elementor' ),
						'label_block' => true,
					],
					[
						'name'    => 'tab_image',
						'label'   => esc_html__( 'Image', 'premiumpress-elementor' ),
						'type'    => \Elementor\Controls_Manager::MEDIA,
						'dynamic' => [ 'active' => true ],
					],
					[
						'name'       => 'tab_content',
						'label'      => esc_html__( 'Content', 'premiumpress-elementor' ),
						'type'       => \Elementor\Controls_Manager::WYSIWYG,
						'dynamic'    => [ 'active' => true ],
						'default'    => esc_html__( 'Slide Content', 'premiumpress-elementor' ),
						'show_label' => false,
					],
					[
						'name'        => 'tab_link',
						'label'       => esc_html__( 'Link', 'premiumpress-elementor' ),
						'type'        => \Elementor\Controls_Manager::URL,
						'dynamic'     => [ 'active' => true ],
						'placeholder' => 'http://your-link.com',
						'default'     => [
							'url' => '#',
						],
					],
				],
				'title_field' => '{{{ tab_title }}}',
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_content_layout',
			[
				'label' => esc_html__( 'Layout', 'premiumpress-elementor' ),
			]
		);

		$this->add_responsive_control(
			'height',
			[
				'label'   => esc_html__( 'Height', 'premiumpress-elementor' ),
				'type'    => \Elementor\Controls_Manager::SLIDER,
				'default' => [
					'size' => 600,
				],
				'range' => [
					'px' => [
						'min' => 50,
						'max' => 1024,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .pptv9-slider .pptv9-slide-item' => 'height: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			'origin',
			[
				'label'   => esc_html__( 'Origin', 'premiumpress-elementor' ),
				'type'    => \Elementor\Controls_Manager::SELECT,
				'default' => 'center',
				'options' => ppt_pack_position(),
			]
		);

		$this->add_responsive_control(
			'align',
			[
				'label'   => esc_html__( 'Alignment', 'premiumpress-elementor' ),
				'type'    => \Elementor\Controls_Manager::CHOOSE,
				'options' => [
					'left' => [
						'title' => esc_html__( 'Left', 'premiumpress-elementor' ),
						'icon'  => 'fa fa-align-left',
					],
					'center' => [
						'title' => esc_html__( 'Center', 'premiumpress-elementor' ),
						'icon'  => 'fa fa-align-center',
					],
					'right' => [
						'title' => esc_html__( 'Right', 'premiumpress-elementor' ),
						'icon'  => 'fa fa-align-right',
					],
					'justify' => [
						'title' => esc_html__( 'Justified', 'premiumpress-elementor' ),
						'icon'  => 'fa fa-align-justify',
					],
				],
				'prefix_class' => 'elementor%s-align-',
				'description'  => 'Use align to match position',
				'default'      => 'center',
			]
		);

		$this->add_control(
			'show_title',
			[
				'label'   => esc_html__( 'Show Title', 'premiumpress-elementor' ),
				'type'    => \Elementor\Controls_Manager::SWITCHER,
				'default' => 'yes',
			]
		);


		$this->add_control(
			'show_button',
			[
				'label'   => esc_html__( 'Show Button', 'premiumpress-elementor' ),
				'type'    => \Elementor\Controls_Manager::SWITCHER,
				'default' => 'yes',
			]
		);

		$this->add_control(
			'scroll_to_section',
			[
				'label' => esc_html__( 'Scroll to Section', 'premiumpress-elementor' ),
				'type'  => \Elementor\Controls_Manager::SWITCHER,
			]
		);

		$this->add_control(
			'section_id',
			[
				'label'       => esc_html__( 'Section ID', 'premiumpress-elementor' ),
				'type'        => \Elementor\Controls_Manager::TEXT,
				'placeholder' => 'Section ID Here',
				'description' => 'Enter section ID of this page, ex: #my-section',
				'label_block' => true,
				'condition'   => [
					'scroll_to_section' => 'yes',
				],
			]
		);

		$this->add_control(
			'scroll_to_section_icon',
			[
				'label'       => esc_html__( 'Scroll to Section Icon', 'premiumpress-elementor' ),
				'type'        => \Elementor\Controls_Manager::ICON,
				'label_block' => true,
				'default'     => 'fa fa-angle-double-down',
				'condition'   => [
					'scroll_to_section' => 'yes',
				],
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_content_slider_settings',
			[
				'label' => esc_html__( 'Slider Settings', 'premiumpress-elementor' ),
			]
		);

		$this->add_control(
			'navigation',
			[
				'label'   => esc_html__( 'Navigation', 'premiumpress-elementor' ),
				'type'    => \Elementor\Controls_Manager::SELECT,
				'default' => 'both',
				'options' => [
					'both'   => esc_html__( 'Arrows and Dots', 'premiumpress-elementor' ),
					'arrows' => esc_html__( 'Arrows', 'premiumpress-elementor' ),
					'dots'   => esc_html__( 'Dots', 'premiumpress-elementor' ),
					'none'   => esc_html__( 'None', 'premiumpress-elementor' ),
				],
			]
		);

		$this->add_control(
			'hide_arrows',
			[
				'label'     => esc_html__( 'Hide arrows on mobile devices?', 'premiumpress-elementor' ),
				'type'      => \Elementor\Controls_Manager::SWITCHER,
				'default'   => 'yes',
				'condition' => [
					'navigation' => [ 'arrows', 'both' ],
				],
			]
		);

		$this->add_control(
			'transition',
			[
				'label'   => esc_html__( 'Transition', 'premiumpress-elementor' ),
				'type'    => \Elementor\Controls_Manager::SELECT,
				'default' => 'slide',
				'options' => [
					'slide'     => esc_html__( 'Slide', 'premiumpress-elementor' ),
					'fade'      => esc_html__( 'Fade', 'premiumpress-elementor' ),
					'cube'      => esc_html__( 'Cube', 'premiumpress-elementor' ),
					'coverflow' => esc_html__( 'Coverflow', 'premiumpress-elementor' ),
					'flip'      => esc_html__( 'Flip', 'premiumpress-elementor' ),
				],
			]
		);

		$this->add_control(
			'animation_kenburns',
			[
				'label'        => esc_html__( 'Animation Kenburns', 'premiumpress-elementor' ),
				'prefix_class' => 'pptv9-animation-kenburns-',
				'type'         => \Elementor\Controls_Manager::SWITCHER,
			]
		);

		$this->add_control(
			'effect',
			[
				'label'   => esc_html__( 'Text Effect', 'premiumpress-elementor' ),
				'type'    => \Elementor\Controls_Manager::SELECT,
				'default' => 'slide',
				'options' => [
				'left'    => esc_html__( 'Slide Right to Left', 'premiumpress-elementor' ),
				'bottom'  => esc_html__( 'Slider Bottom to Top', 'premiumpress-elementor' ),
				],
			]
		);

		$this->add_control(
			'autoplay',
			[
				'label'   => esc_html__( 'Autoplay', 'premiumpress-elementor' ),
				'type'    => \Elementor\Controls_Manager::SWITCHER,
				'default' => 'yes',
			]
		);

		$this->add_control(
			'autoplay_speed',
			[
				'label'     => esc_html__( 'Autoplay Speed', 'premiumpress-elementor' ),
				'type'      => \Elementor\Controls_Manager::NUMBER,
				'default'   => 5000,
				'condition' => [
					'autoplay' => 'yes',
				],
			]
		);

		$this->add_control(
			'loop',
			[
				'label'   => __( 'Loop', 'premiumpress-elementor' ),
				'type'    => \Elementor\Controls_Manager::SWITCHER,
				'default' => 'yes',
				
			]
		);

		$this->add_control(
			'pauseonhover',
			[
				'label' => esc_html__( 'Pause on Hover', 'premiumpress-elementor' ),
				'type'  => \Elementor\Controls_Manager::SWITCHER,
				'default' => 'yes',
			]
		);

		$this->add_control(
			'speed',
			[
				'label'   => __( 'Animation Speed (ms)', 'premiumpress-elementor' ),
				'type'    => \Elementor\Controls_Manager::SLIDER,
				'default' => [
					'size' => 500,
				],
				'range' => [
					'min'  => 100,
					'max'  => 5000,
					'step' => 50,
				],
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_content_button',
			[
				'label'     => esc_html__( 'Button', 'premiumpress-elementor' ),
				'condition' => [
					'show_button' => 'yes',
				],
			]
		);

		$this->add_control(
			'button_text',
			[
				'label'       => esc_html__( 'Button Text', 'premiumpress-elementor' ),
				'type'        => \Elementor\Controls_Manager::TEXT,
				'default'     => esc_html__( 'Read More', 'premiumpress-elementor' ),
				'placeholder' => esc_html__( 'Read More', 'premiumpress-elementor' ),
			]
		);

		$this->add_control(
			'icon',
			[
				'label'       => esc_html__( 'Icon', 'premiumpress-elementor' ),
				'type'        => \Elementor\Controls_Manager::ICON,
				'label_block' => true,
			]
		);

		$this->add_control(
			'icon_align',
			[
				'label'   => esc_html__( 'Icon Position', 'premiumpress-elementor' ),
				'type'    => \Elementor\Controls_Manager::SELECT,
				'default' => 'right',
				'options' => [
					'left'  => esc_html__( 'Before', 'premiumpress-elementor' ),
					'right' => esc_html__( 'After', 'premiumpress-elementor' ),
				],
				'condition' => [
					'icon!' => '',
				],
			]
		);

		$this->add_control(
			'icon_indent',
			[
				'label'   => esc_html__( 'Icon Spacing', 'premiumpress-elementor' ),
				'type'    => \Elementor\Controls_Manager::SLIDER,
				'default' => [
					'size' => 8,
				],
				'range' => [
					'px' => [
						'max' => 50,
					],
				],
				'condition' => [
					'icon!' => '',
				],
				'selectors' => [
					'{{WRAPPER}} .pptv9-slider .pptv9-button-icon-align-right' => 'margin-left: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .pptv9-slider .pptv9-button-icon-align-left'  => 'margin-right: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_style_slider',
			[
				'label' => esc_html__( 'Slider', 'premiumpress-elementor' ),
				'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'slider_background_color',
			[
				'label'     => esc_html__( 'Background Color', 'premiumpress-elementor' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'default'   => '#14ABF4',
				'selectors' => [
					'{{WRAPPER}} .pptv9-slider .pptv9-slide-item' => 'background-color: {{VALUE}};',
				],
			]
		);

		$this->add_responsive_control(
			'content_padding',
			[
				'label' => esc_html__( 'Padding', 'premiumpress-elementor' ),
				'type'  => \Elementor\Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 200,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .pptv9-slider .pptv9-slide-item .pptv9-slide-desc' => 'margin: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_style_title',
			[
				'label'     => esc_html__( 'Title', 'premiumpress-elementor' ),
				'tab'       => \Elementor\Controls_Manager::TAB_STYLE,
				'condition' => [
					'show_title' => [ 'yes' ],
				],
			]
		);

		$this->add_control(
			'title_color',
			[
				'label'     => esc_html__( 'Color', 'premiumpress-elementor' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .pptv9-slider .pptv9-slide-item .pptv9-slide-title' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'title_background',
			[
				'label'     => esc_html__( 'Background', 'premiumpress-elementor' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .pptv9-slider .pptv9-slide-item .pptv9-slide-title' => 'background-color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'title_padding',
			[
				'label'      => esc_html__( 'Padding', 'premiumpress-elementor' ),
				'type'       => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors'  => [
					'{{WRAPPER}} .pptv9-slider .pptv9-slide-item .pptv9-slide-title' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name'     => 'title_typography',
				'label'    => esc_html__( 'Typography', 'premiumpress-elementor' ),
				'scheme'   => \Elementor\Scheme_Typography::TYPOGRAPHY_4,
				'selector' => '{{WRAPPER}} .pptv9-slider .pptv9-slide-item .pptv9-slide-title',
			]
		);

		$this->add_responsive_control(
			'title_space',
			[
				'label' => esc_html__( 'Space', 'premiumpress-elementor' ),
				'type'  => \Elementor\Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .pptv9-slider .pptv9-slide-item .pptv9-slide-title' => 'margin-bottom: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_style_text',
			[
				'label' => esc_html__( 'Text', 'premiumpress-elementor' ),
				'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'text_color',
			[
				'label'     => esc_html__( 'Text Color', 'premiumpress-elementor' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .pptv9-slider .pptv9-slide-item .pptv9-slide-text' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'text_background',
			[
				'label'     => esc_html__( 'Background', 'premiumpress-elementor' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .pptv9-slider .pptv9-slide-item .pptv9-slide-text' => 'background-color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'text_padding',
			[
				'label'      => esc_html__( 'Padding', 'premiumpress-elementor' ),
				'type'       => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors'  => [
					'{{WRAPPER}} .pptv9-slider .pptv9-slide-item .pptv9-slide-text' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name'     => 'text_typography',
				'label'    => esc_html__( 'Text Typography', 'premiumpress-elementor' ),
				'scheme'   => \Elementor\Scheme_Typography::TYPOGRAPHY_4,
				'selector' => '{{WRAPPER}} .pptv9-slider .pptv9-slide-item .pptv9-slide-text',
			]
		);

		$this->add_responsive_control(
			'text_space',
			[
				'label' => esc_html__( 'Text Space', 'premiumpress-elementor' ),
				'type'  => \Elementor\Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .pptv9-slider .pptv9-slide-item .pptv9-slide-text' => 'margin-bottom: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_style_button',
			[
				'label'     => esc_html__( 'Button', 'premiumpress-elementor' ),
				'tab'       => \Elementor\Controls_Manager::TAB_STYLE,
				'condition' => [
					'show_button' => 'yes',
				],
			]
		);

		$this->start_controls_tabs( 'tabs_button_style' );

		$this->start_controls_tab(
			'tab_button_normal',
			[
				'label' => esc_html__( 'Normal', 'premiumpress-elementor' ),
			]
		);

		$this->add_control(
			'button_text_color',
			[
				'label'     => esc_html__( 'Text Color', 'premiumpress-elementor' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .pptv9-slider .pptv9-slide-item .pptv9-slide-link' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'background_color',
			[
				'label'     => esc_html__( 'Background Color', 'premiumpress-elementor' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .pptv9-slider .pptv9-slide-item .pptv9-slide-link' => 'background-color: {{VALUE}};',
				],
			]
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			'tab_button_hover',
			[
				'label' => esc_html__( 'Hover', 'premiumpress-elementor' ),
			]
		);

		$this->add_control(
			'hover_color',
			[
				'label'     => esc_html__( 'Text Color', 'premiumpress-elementor' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .pptv9-slider .pptv9-slide-item .pptv9-slide-link:hover' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'button_background_hover_color',
			[
				'label'     => esc_html__( 'Background Color', 'premiumpress-elementor' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .pptv9-slider .pptv9-slide-item .pptv9-slide-link:hover' => 'background-color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'button_hover_border_color',
			[
				'label'     => esc_html__( 'Border Color', 'premiumpress-elementor' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'condition' => [
					'border_border!' => '',
				],
				'selectors' => [
					'{{WRAPPER}} .pptv9-slider .pptv9-slide-item .pptv9-slide-link:hover' => 'border-color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'button_hover_animation',
			[
				'label' => esc_html__( 'Animation', 'premiumpress-elementor' ),
				'type'  => \Elementor\Controls_Manager::HOVER_ANIMATION,
			]
		);

		$this->end_controls_tab();

		$this->end_controls_tabs();

		$this->add_group_control(
			\Elementor\Group_Control_Border::get_type(),
			[
				'name'        => 'border',
				'label'       => esc_html__( 'Border', 'premiumpress-elementor' ),
				'placeholder' => '1px',
				'default'     => '1px',
				'selector'    => '{{WRAPPER}} .pptv9-slider .pptv9-slide-item .pptv9-slide-link',
				'separator'   => 'before',
			]
		);

		$this->add_control(
			'border_radius',
			[
				'label'      => esc_html__( 'Border Radius', 'premiumpress-elementor' ),
				'type'       => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%' ],
				'selectors'  => [
					'{{WRAPPER}} .pptv9-slider .pptv9-slide-item .pptv9-slide-link' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Box_Shadow::get_type(),
			[
				'name'     => 'button_box_shadow',
				'selector' => '{{WRAPPER}} .pptv9-slider .pptv9-slide-item .pptv9-slide-link',
			]
		);

		$this->add_control(
			'button_padding',
			[
				'label'      => esc_html__( 'Padding', 'premiumpress-elementor' ),
				'type'       => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors'  => [
					'{{WRAPPER}} .pptv9-slider .pptv9-slide-item .pptv9-slide-link' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
				'separator' => 'before',
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name'     => 'typography',
				'label'    => esc_html__( 'Typography', 'premiumpress-elementor' ),
				'scheme'   => \Elementor\Scheme_Typography::TYPOGRAPHY_4,
				'selector' => '{{WRAPPER}} .pptv9-slider .pptv9-slide-item .pptv9-slide-link',
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_style_navigation',
			[
				'label'     => __( 'Navigation', 'premiumpress-elementor' ),
				'tab'       => \Elementor\Controls_Manager::TAB_STYLE,
				'condition' => [
					'navigation' => [ 'arrows', 'dots', 'both' ],
				],
			]
		);

		$this->add_control(
			'heading_style_arrows',
			[
				'label'     => __( 'Arrows', 'premiumpress-elementor' ),
				'type'      => \Elementor\Controls_Manager::HEADING,
				'separator' => 'before',
				'condition' => [
					'navigation' => [ 'arrows', 'both' ],
				],
			]
		);

		$this->add_control(
			'arrows_style',
			[
				'label'   => __( 'Arrows Style', 'premiumpress-elementor' ),
				'type'    => \Elementor\Controls_Manager::SELECT,
				'default' => 'light',
				'options' => [
					'dark'  => __( 'Dark', 'premiumpress-elementor' ),
					'light' => __( 'Light', 'premiumpress-elementor' ),
				],
				'condition' => [
					'navigation' => [ 'arrows', 'both' ],
				],
			]
		);

		$this->add_control(
			'arrows_position',
			[
				'label' => __( 'Arrows Position', 'premiumpress-elementor' ),
				'type'  => \Elementor\Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'min' => -100,
						'max' => 100,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .pptv9-slider .swiper-button-next' => 'right: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .pptv9-slider .swiper-button-prev' => 'left: {{SIZE}}{{UNIT}};',
				],
				'condition' => [
					'navigation' => [ 'arrows', 'both' ],
				],
			]
		);

		$this->add_control(
			'arrows_size',
			[
				'label'   => __( 'Arrows Size', 'premiumpress-elementor' ),
				'type'    => \Elementor\Controls_Manager::SLIDER,
				'default' => [
					'size' => 35,
				],
				'range' => [
					'px' => [
						'min' => 25,
						'max' => 80,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .pptv9-slider .swiper-button-prev, {{WRAPPER}} .pptv9-slider .swiper-button-next' => 'height: {{SIZE}}{{UNIT}}; width: {{SIZE}}{{UNIT}}',
				],
				'condition' => [
					'navigation' => [ 'arrows', 'both' ],
				],
			]
		);

		$this->add_control(
			'heading_style_dots',
			[
				'label'     => __( 'Dots', 'premiumpress-elementor' ),
				'type'      => \Elementor\Controls_Manager::HEADING,
				'separator' => 'before',
				'condition' => [
					'navigation' => [ 'dots', 'both' ],
				],
			]
		);

		$this->add_control(
			'dots_color',
			[
				'label'     => __( 'Dots Color', 'premiumpress-elementor' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'default'   => '#ffffff',
				'selectors' => [
					'{{WRAPPER}} .pptv9-slider .swiper-pagination-bullet' => 'background-color: {{VALUE}}',
				],
				'condition' => [
					'navigation' => [ 'dots', 'both' ],
				],
			]
		);

		$this->add_control(
			'active_dot_color',
			[
				'label'     => __( 'Active Dot Color', 'premiumpress-elementor' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'default'   => '#ffffff',
				'selectors' => [
					'{{WRAPPER}} .pptv9-slider .swiper-pagination-bullet-active' => 'background-color: {{VALUE}}',
				],
				'condition' => [
					'navigation' => [ 'dots', 'both' ],
				],
			]
		);

		$this->add_control(
			'dots_position',
			[
				'label' => __( 'Dots Position', 'premiumpress-elementor' ),
				'type'  => \Elementor\Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'min' => -80,
						'max' => 80,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .pptv9-slider .swiper-pagination-bullets' => 'bottom: {{SIZE}}{{UNIT}};',
				],
				'condition' => [
					'navigation' => [ 'dots', 'both' ],
				],
			]
		);

		$this->add_control(
			'dots_size',
			[
				'label' => __( 'Dots Size', 'premiumpress-elementor' ),
				'type'  => \Elementor\Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'min' => 5,
						'max' => 10,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .pptv9-slider .swiper-pagination-bullet' => 'height: {{SIZE}}{{UNIT}};width: {{SIZE}}{{UNIT}};',
				],
				'condition' => [
					'navigation' => [ 'dots', 'both' ],
				],
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_style_scroll_to_top',
			[
				'label'      => esc_html__( 'Scroll to Top', 'premiumpress-elementor' ),
				'tab'        => \Elementor\Controls_Manager::TAB_STYLE,
				'conditions' => [
					'terms' => [
						[
							'name'  => 'scroll_to_section',
							'value' => 'yes',
						],
						[
							'name'     => 'section_id',
							'operator' => '!=',
							'value'    => '',
						],
					],
				],
			]
		);

		$this->start_controls_tabs( 'tabs_scroll_to_top_style' );

		$this->start_controls_tab(
			'scroll_to_top_normal',
			[
				'label' => esc_html__( 'Normal', 'premiumpress-elementor' ),
			]
		);

		$this->add_control(
			'scroll_to_top_color',
			[
				'label'     => esc_html__( 'Color', 'premiumpress-elementor' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .pptv9-slider .pptv9-ep-scroll-to-section a' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'scroll_to_top_background',
			[
				'label'     => esc_html__( 'Background', 'premiumpress-elementor' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .pptv9-slider .pptv9-ep-scroll-to-section a' => 'background-color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Box_Shadow::get_type(),
			[
				'name'     => 'scroll_to_top_shadow',
				'selector' => '{{WRAPPER}} .pptv9-slider .pptv9-ep-scroll-to-section a',
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Border::get_type(),
			[
				'name'        => 'scroll_to_top_border',
				'label'       => esc_html__( 'Border', 'premiumpress-elementor' ),
				'placeholder' => '1px',
				'default'     => '1px',
				'selector'    => '{{WRAPPER}} .pptv9-slider .pptv9-ep-scroll-to-section a',
				'separator'   => 'before',
			]
		);

		$this->add_control(
			'scroll_to_top_radius',
			[
				'label'      => esc_html__( 'Border Radius', 'premiumpress-elementor' ),
				'type'       => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%' ],
				'selectors'  => [
					'{{WRAPPER}} .pptv9-slider .pptv9-ep-scroll-to-section a' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'scroll_to_top_padding',
			[
				'label'      => esc_html__( 'Padding', 'premiumpress-elementor' ),
				'type'       => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors'  => [
					'{{WRAPPER}} .pptv9-slider .pptv9-ep-scroll-to-section a' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'scroll_to_top_icon_size',
			[
				'label' => esc_html__( 'Icon Size', 'premiumpress-elementor' ),
				'type'  => \Elementor\Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'min' => 10,
						'max' => 100,
					],
				],
				'selectors'  => [
					'{{WRAPPER}} .pptv9-slider .pptv9-ep-scroll-to-section a' => 'font-size: {{SIZE}}px;',
				],
			]
		);

		$this->add_responsive_control(
			'scroll_to_top_bottom_space',
			[
				'label' => esc_html__( 'Bottom Space', 'premiumpress-elementor' ),
				'type'  => \Elementor\Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'min'  => 0,
						'max'  => 300,
						'step' => 5,
					],
				],
				'selectors'  => [
					'{{WRAPPER}} .pptv9-slider .pptv9-ep-scroll-to-section' => 'margin-bottom: {{SIZE}}px;',
				],
			]
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			'scroll_to_top_hover',
			[
				'label' => esc_html__( 'Hover', 'premiumpress-elementor' ),
			]
		);

		$this->add_control(
			'scroll_to_top_hover_color',
			[
				'label'     => esc_html__( 'Color', 'premiumpress-elementor' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .pptv9-slider .pptv9-ep-scroll-to-section a:hover' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'scroll_to_top_hover_background',
			[
				'label'     => esc_html__( 'Background', 'premiumpress-elementor' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .pptv9-slider .pptv9-ep-scroll-to-section a:hover' => 'background-color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'scroll_to_top_hover_border_color',
			[
				'label'     => esc_html__( 'Border Color', 'premiumpress-elementor' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'condition' => [
					'scroll_to_top_border_border!' => '',
				],
				'selectors' => [
					'{{WRAPPER}} .pptv9-slider .pptv9-ep-scroll-to-section a:hover' => 'border-color: {{VALUE}};',
				],
			]
		);

		$this->end_controls_tab();

		$this->end_controls_tabs();

		$this->end_controls_section();
	}
	protected function render_loop_header() {
		$settings = $this->get_settings();
		$id       = 'pptv9-slider-' . $this->get_id();

		$this->add_render_attribute( 'slider', 'id', $id );
		$this->add_render_attribute( 'slider', 'class', 'pptv9-slider' );

		$this->add_render_attribute(
			[
				'slider' => [
					'data-settings' => [
						wp_json_encode(array_filter([
							"autoplay"     => ( "yes" == $settings["autoplay"] ) ? [ "delay" => $settings["autoplay_speed"] ] : false,
							"loop"         => ($settings["loop"] == "yes") ? true : false,
							"speed"        => $settings["speed"]["size"],
							"pauseOnHover" => ("yes" == $settings["pauseonhover"]) ? true : false,
							"effect"       => $settings["transition"],
					        "navigation" => [
								"nextEl" => "#" . $id . " .pptv9-navigation-next",
								"prevEl" => "#" . $id . " .pptv9-navigation-prev",
							],
							"pagination" => [
							  "el"         => "#" . $id . " .swiper-pagination",
							  "type"       => "bullets",
							  "clickable"  => true,
							],
				        ]))
					]
				]
			]
		);

		?>
		<div <?php echo $this->get_render_attribute_string( 'slider' ); ?>>
			<div class="swiper-container">
				<?php if ($settings['scroll_to_section'] && $settings['section_id']): ?>
					<div class="pptv9-ep-scroll-to-section pptv9-position-bottom-center">
						<a href="<?php echo esc_url($settings['section_id']); ?>" pptv9-scroll>
							<span class="pptv9-ep-scroll-to-section-icon">
								<i class="<?php echo esc_attr($settings['scroll_to_section_icon']); ?>"></i>
							</span>
						</a>
					</div>
				<?php endif;
	}

	protected function render_loop_footer() {
		$settings    = $this->get_settings_for_display();
		$id          = 'pptv9-slider-' . $this->get_id();
		$hide_arrows = $settings['hide_arrows'] ? ' pptv9-visible@m' : '';

		?>
		</div>
		<?php if ( 'none' !== $settings['navigation'] ) : ?>
			<?php if ( 'arrows' !== $settings['navigation'] ) : ?>
				<div class="swiper-pagination"></div>
			<?php endif; ?>
			
			<?php if ( 'dots' !== $settings['navigation'] ) : 
				$nav_style = ($settings['arrows_style'] == 'light') ? 'swiper-button-white' : 'swiper-button-black'; 
			?>
				<div class="swiper-button-next pptv9-navigation-next <?php echo esc_attr($nav_style.$hide_arrows); ?>"></div>
				<div class="swiper-button-prev pptv9-navigation-prev <?php echo esc_attr($nav_style.$hide_arrows); ?>"></div>
			<?php endif; ?>
		<?php endif; ?>
		</div>

		<?php
	}

	public function render() {
		$settings  = $this->get_settings_for_display();

		$this->render_loop_header();

		?>
        
      
		<div class="swiper-wrapper">
			<?php $counter = 1; ?>
			<?php foreach ( $settings['tabs'] as $item ) : ?>

				<?php 
				$image_src = wp_get_attachment_image_src( $item['tab_image']['id'], 'full' );
				$image     =  $image_src ? $image_src[0] : '';

				$this->add_render_attribute(
					[
						'slide-item' => [
							'class' => [
								'pptv9-slide-item',
								'swiper-slide',
								'pptv9-slide-effect-' . $settings['effect']
							],
						]
					], '', '', true
				);

				$this->add_render_attribute(
					[
						'slider-link' => [
							'class' => [
								'pptv9-slide-link',
								$settings['button_hover_animation'] ? 'elementor-animation-' . $settings['button_hover_animation'] : '',
							],
							'href'   => $item['tab_link']['url'] ? esc_url($item['tab_link']['url']) : '#',
							'target' => $item['tab_link']['is_external'] ? '_blank' : '_self'
						]
					], '', '', true
				);

				?>				
				<div <?php echo $this->get_render_attribute_string( 'slide-item' ); ?>>

					<?php if ($image) : ?>
					<div class="pptv9-slider-image-wrapper">
						<img src="<?php echo esc_url($image); ?>" alt="<?php echo wp_kses_post($item['tab_title']); ?>" pptv9-cover>
					</div>
		        	
					<?php endif; ?>

		        	<div class="pptv9-slide-desc pptv9-position-large pptv9-position-<?php echo ($settings['origin']); ?> pptv9-position-z-index">

						<?php if (( '' !== $item['tab_title'] ) && ( $settings['show_title'] )) : ?>
							<h2 class="pptv9-slide-title pptv9-clearfix"><?php echo wp_kses_post($item['tab_title']); ?></h2>
						<?php endif; ?>

						<?php if ( '' !== $item['tab_content'] ) : ?>
							<div class="pptv9-slide-text"><?php echo $this->parse_text_editor( $item['tab_content'] ); ?></div>
						<?php endif; ?>

						<?php if (( ! empty( $item['tab_link']['url'] )) && ( $settings['show_button'] )): ?>
							<div class="pptv9-slide-link-wrapper">
								<a <?php echo $this->get_render_attribute_string( 'slider-link' ); ?>>

									<?php echo esc_html($settings['button_text']); ?>
								
									<?php if ($settings['icon']) : ?>
										<span class="pptv9-button-icon-align-<?php echo esc_attr($settings['icon_align']); ?>">
											<i class="<?php echo esc_attr($settings['icon']); ?>"></i>
										</span>
									<?php endif; ?>
								</a>
							</div>
						<?php endif; ?>
			  		</div>
				</div>
				<?php
				$counter++;
			endforeach;
			?>
		</div>
		<?php $this->render_loop_footer();
	}

}