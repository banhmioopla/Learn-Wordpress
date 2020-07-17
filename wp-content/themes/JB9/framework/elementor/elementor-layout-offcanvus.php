<?php

class Widget_PremiumPress_Offcanvus extends \Elementor\Widget_Base {
 
	public function get_name() {
		return 'pptv9-offcanvas';
	}

	public function get_title() {
		return '{ Mobile Menu }';
	}

	public function get_icon() {
		return 'layout-offcanvas';
	}

	public function get_categories() {
		return [ 'premiumpress-header' ];
	}

	public function get_keywords() {
		return [ 'offcanvas', 'menu', 'navigator' ];
	}

	protected function _register_controls() {

		$this->start_controls_section(
			'section_content_layout',
			[
				'label' => esc_html__( 'Layout', 'premiumpress-elementor' ),
			]
		);

		$this->add_control(
			'layout',
			[
				'label'   => esc_html__( 'Layout', 'premiumpress-elementor' ),
				'type'    => \Elementor\Controls_Manager::SELECT,
				'default' => 'default',
				'options' => [
					'default' => esc_html__( 'Default', 'premiumpress-elementor' ),
					//'custom'  => esc_html__( 'Custom Link', 'premiumpress-elementor' ),
				],				
			]
		);

/*
	 

		$this->add_control(
			'source',
			[
				'label'   => esc_html__( 'Select Source', 'premiumpress-elementor' ),
				'type'    => \Elementor\Controls_Manager::SELECT,
				'default' => 'sidebar',
				'options' => [
					'sidebar'   => esc_html__( 'Sidebar', 'premiumpress-elementor' ),
					'elementor' => esc_html__( 'Elementor Template', 'premiumpress-elementor' ),
					'anywhere'  => esc_html__( 'AE Template', 'premiumpress-elementor' ),
				],				
			]
		);

        $this->add_control(
            'template_id',
            [
                'label'       => __( 'Choose Template', 'premiumpress-elementor' ),
                'type'        => \Elementor\Controls_Manager::SELECT,
                'default'     => '0',
                'options'     => ppt_pack_et_options(),
                'label_block' => 'true',
                'condition'   => ['source' => 'elementor'],
            ]
        );

        $this->add_control(
            'sidebars',
            [
                'label'       => esc_html__( 'Choose Sidebar', 'premiumpress-elementor' ),
                'type'        => \Elementor\Controls_Manager::SELECT,
                'default'     => '0',
                'options'     => ppt_pack_sidebar_options(),
                'label_block' => 'true',
                'condition'   => ['source' => 'sidebar'],
            ]
        );

        $this->add_control(
            'anywhere_id',
            [
                'label'       => esc_html__( 'Choose Template', 'premiumpress-elementor' ),
                'type'        => \Elementor\Controls_Manager::SELECT,
                'default'     => '0',
                'options'     => ppt_pack_ae_options(),
                'label_block' => 'true',
                'condition'   => ['source' => 'anywhere'],
                'render_type' => 'template',
            ]
        );
*/


		$this->add_control(
			'navbar',
			[
				'label'   => esc_html__( 'Select Menu', 'ppremiumpress-elementor' ),
				'type'    => \Elementor\Controls_Manager::SELECT,
				'options' => ppt_pack_get_menu(),
				'default' => 0,
			]
		);

		$this->add_responsive_control(
			'offcanvas_width',
			[
				'label'      => esc_html__( 'Width', 'premiumpress-elementor' ),
				'type'       => \Elementor\Controls_Manager::SLIDER,
				'size_units' => [ 'px', 'vw' ],
				'range'      => [
					'px' => [
						'min' => 240,
						'max' => 1200,
					],
					'vw' => [
						'min' => 10,
						'max' => 100,
					]
				],
				'selectors' => [
					'#pptv9-offcanvas-{{ID}}.pptv9-offcanvas .pptv9-offcanvas-bar' => 'width: {{SIZE}}{{UNIT}};',
				],
				'condition' => [
					'offcanvas_animations!' => ['push', 'reveal'],
				]
			]
		);

		$this->add_control(
			'custom_content_before_switcher',
			[
				'label' => esc_html__( 'Custom Content Before', 'premiumpress-elementor' ),
				'type'  => \Elementor\Controls_Manager::SWITCHER,
			]
		);

		$this->add_control(
			'custom_content_after_switcher',
			[
				'label' => esc_html__( 'Custom Content After', 'premiumpress-elementor' ),
				'type'  => \Elementor\Controls_Manager::SWITCHER,
			]
		);

		$this->add_control(
			'offcanvas_overlay',
			[
				'label'        => esc_html__( 'Overlay', 'premiumpress-elementor' ),
				'type'         => \Elementor\Controls_Manager::SWITCHER,
			]
		);

		$this->add_control(
			'offcanvas_animations',
			[
				'label'     => esc_html__( 'Animations', 'premiumpress-elementor' ),
				'type'      => \Elementor\Controls_Manager::SELECT,
				'default'   => 'slide',
				'options'   => [
					'slide'  => esc_html__( 'Slide', 'premiumpress-elementor' ),
					'push'   => esc_html__( 'Push', 'premiumpress-elementor' ),
					'reveal' => esc_html__( 'Reveal', 'premiumpress-elementor' ),
					'none'   => esc_html__( 'None', 'premiumpress-elementor' ),
				],
			]
		);

		$this->add_control(
			'offcanvas_flip',
			[
				'label'        => esc_html__( 'Flip', 'premiumpress-elementor' ),
				'type'         => \Elementor\Controls_Manager::SWITCHER,
			]
		);

		$this->add_control(
			'offcanvas_close_button',
			[
				'label'   => esc_html__( 'Close Button', 'premiumpress-elementor' ),
				'type'    => \Elementor\Controls_Manager::SWITCHER,
				'default' => 'yes',
			]
		);


		$this->end_controls_section();
		
		$this->start_controls_section(
			'section_content_custom_before',
			[
				'label'     => esc_html__( 'Custom Content Before', 'premiumpress-elementor' ),
				'condition' => [
					'custom_content_before_switcher' => 'yes',
				]
			]
		);

		$this->add_control(
			'custom_content_before',
			[
				'label'   => esc_html__( 'Custom Content Before', 'premiumpress-elementor' ),
				'type'    => \Elementor\Controls_Manager::WYSIWYG,
				'dynamic' => [ 'active' => true ],
				'default' => esc_html__( 'This is your custom content for before of your offcanvas.', 'premiumpress-elementor' ),
			]
		);
		
		$this->end_controls_section();


		$this->start_controls_section(
			'section_content_custom_after',
			[
				'label'     => esc_html__( 'Custom Content After', 'premiumpress-elementor' ),
				'condition' => [
					'custom_content_after_switcher' => 'yes',
				]
			]
		);


		$this->add_control(
			'custom_content_after',
			[
				'label'   => esc_html__( 'Custom Content After', 'premiumpress-elementor' ),
				'type'    => \Elementor\Controls_Manager::WYSIWYG,
				'dynamic' => [ 'active' => true ],
				'default' => esc_html__( 'This is your custom content for after of your offcanvas.', 'premiumpress-elementor' ),
			]
		);
		
		$this->end_controls_section();


		$this->start_controls_section(
			'section_content_offcanvas_button',
			[
				'label' => esc_html__( 'Button', 'premiumpress-elementor' ),
				'condition'   => [
					'layout' => 'default',
				],
			]
		);

		$this->add_control(
			'button_text',
			[
				'label'       => esc_html__( 'Button Text', 'premiumpress-elementor' ),
				'type'        => \Elementor\Controls_Manager::TEXT,
				'dynamic'     => [ 'active' => true ],
				'default'     => esc_html__( '', 'premiumpress-elementor' ),
				 
			]
		);

		$this->add_responsive_control(
			'button_align',
			[
				'label'   => esc_html__( 'Button Alignment', 'premiumpress-elementor' ),
				'type'    => \Elementor\Controls_Manager::CHOOSE,
				'options' => [
					'left'    => [
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
				'default'      => 'left',
			]
		);

		$this->add_responsive_control(
			'button_offset',
			[
				'label' => esc_html__( 'Offset', 'premiumpress-elementor' ),
				'type'  => \Elementor\Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'min' => -150,
						'max' => 150,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .pptv9-offcanvas-button' => 'transform: translateX({{SIZE}}{{UNIT}});',
				],
			]
		);

		$this->add_control(
			'size',
			[
				'label'   => __( 'Size', 'premiumpress-elementor' ),
				'type'    => \Elementor\Controls_Manager::SELECT,
				'default' => 'sm',
				'options' => ppt_pack_button_sizes(),
			]
		);

		$this->add_control(
			'button_icon',
			[
				'label'       => esc_html__( 'Button Icon', 'premiumpress-elementor' ),
				'type'        => \Elementor\Controls_Manager::ICON,
				'label_block' => true,
				'default'     => 'fa fa-bars',
			]
		);

		$this->add_control(
			'button_icon_align',
			[
				'label'   => esc_html__( 'Icon Position', 'premiumpress-elementor' ),
				'type'    => \Elementor\Controls_Manager::SELECT,
				'default' => 'left',
				'options' => [
					'left'  => esc_html__( 'Before', 'premiumpress-elementor' ),
					'right' => esc_html__( 'After', 'premiumpress-elementor' ),
				],
				'condition' => [
					'button_icon!' => '',
				],
			]
		);

		$this->add_control(
			'button_icon_indent',
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
					'button_icon!' => '',
				],
				'selectors' => [
					'{{WRAPPER}} .pptv9-offcanvas-button .pptv9-offcanvas-button-icon.elementor-align-icon-right' => 'margin-left: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .pptv9-offcanvas-button .pptv9-offcanvas-button-icon.elementor-align-icon-left'  => 'margin-right: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_style_offcanvas_content',
			[
				'label' => esc_html__( 'Offcanvas', 'premiumpress-elementor' ),
				'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'offcanvas_content_color',
			[
				'label'     => esc_html__( 'Text Color', 'premiumpress-elementor' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'#pptv9-offcanvas-{{ID}}.pptv9-offcanvas .pptv9-offcanvas-bar *' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'offcanvas_content_link_color',
			[
				'label'     => esc_html__( 'Link Color', 'premiumpress-elementor' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'#pptv9-offcanvas-{{ID}}.pptv9-offcanvas .pptv9-offcanvas-bar a'   => 'color: {{VALUE}};',
					'#pptv9-offcanvas-{{ID}}.pptv9-offcanvas .pptv9-offcanvas-bar a *' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'offcanvas_content_link_hover_color',
			[
				'label'     => esc_html__( 'Link Hover Color', 'premiumpress-elementor' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'#pptv9-offcanvas-{{ID}}.pptv9-offcanvas .pptv9-offcanvas-bar a:hover' => 'color: {{VALUE}} !important;',
				],
			]
		);

		$this->add_control(
			'offcanvas_content_background_color',
			[
				'label'     => esc_html__( 'Background Color', 'premiumpress-elementor' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'#pptv9-offcanvas-{{ID}}.pptv9-offcanvas .pptv9-offcanvas-bar' => 'background-color: {{VALUE}} !important;',
				],
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Box_Shadow::get_type(),
			[
				'name'      => 'offcanvas_content_shadow',
				'selector'  => '#pptv9-offcanvas-{{ID}}.pptv9-offcanvas > div',
				'separator' => 'before',
			]
		);

		$this->add_responsive_control(
			'offcanvas_content_padding',
			[
				'label'      => esc_html__( 'Padding', 'premiumpress-elementor' ),
				'type'       => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors'  => [
					'#pptv9-offcanvas-{{ID}}.pptv9-offcanvas .pptv9-offcanvas-bar' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
				'separator' => 'before',
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_style_offcanvas_widget',
			[
				'label'     => esc_html__( 'Widget', 'premiumpress-elementor' ),
				'tab'       => \Elementor\Controls_Manager::TAB_STYLE,
				'condition' => [
					'source' => 'sidebar',
				],
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Border::get_type(),
			[
				'name'        => 'offcanvas_widget_border',
				'label'       => esc_html__( 'Border', 'premiumpress-elementor' ),
				'placeholder' => '1px',
				'default'     => '1px',
				'selector'    => '#pptv9-offcanvas-{{ID}}.pptv9-offcanvas .pptv9-offcanvas-bar .widget',
				'separator'   => 'before',
			]
		);

		$this->add_responsive_control(
			'widget_border_radius',
			[
				'label'      => esc_html__( 'Radius', 'premiumpress-elementor' ),
				'type'       => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%' ],
				'selectors'  => [
					'#pptv9-offcanvas-{{ID}}.pptv9-offcanvas .pptv9-offcanvas-bar .widget' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'offcanvas_widget_padding',
			[
				'label'      => esc_html__( 'Padding', 'premiumpress-elementor' ),
				'type'       => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors'  => [
					'#pptv9-offcanvas-{{ID}}.pptv9-offcanvas .pptv9-offcanvas-bar .widget' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
				'separator' => 'before',
			]
		);

		$this->add_responsive_control(
			'offcanvas_vertical_spacing',
			[
				'label'     => esc_html__( 'Vertical Spacing', 'premiumpress-elementor' ),
				'type'      => \Elementor\Controls_Manager::SLIDER,
				'selectors' => [
					'#pptv9-offcanvas-{{ID}}.pptv9-offcanvas .pptv9-offcanvas-bar .widget:not(:first-child)' => 'margin-top: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_style_offcanvas_button',
			[
				'label' => esc_html__( 'Button', 'premiumpress-elementor' ),
				'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
				'condition'   => [
					'layout' => 'default',
				],
			]
		);

		$this->start_controls_tabs( 'tabs_offcanvas_button_style' );

		$this->start_controls_tab(
			'tab_offcanvas_button_normal',
			[
				'label' => esc_html__( 'Normal', 'premiumpress-elementor' ),
			]
		);

		$this->add_control(
			'offcanvas_button_text_color',
			[
				'label'     => esc_html__( 'Button Text Color', 'premiumpress-elementor' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .pptv9-offcanvas-button' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'offcanvas_button_background_color',
			[
				'label'     => esc_html__( 'Button Background Color', 'premiumpress-elementor' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .pptv9-offcanvas-button' => 'background-color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Box_Shadow::get_type(),
			[
				'name'      => 'offcanvas_button_shadow',
				'selector'  => '{{WRAPPER}} .pptv9-offcanvas-button',
				'separator' => 'before',
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Border::get_type(),
			[
				'name'        => 'offcanvas_button_border',
				'label'       => esc_html__( 'Border', 'premiumpress-elementor' ),
				'placeholder' => '1px',
				'default'     => '1px',
				'selector'    => '{{WRAPPER}} .pptv9-offcanvas-button',
				'separator'   => 'before',
			]
		);

		$this->add_control(
			'offcanvas_button_border_radius',
			[
				'label'      => esc_html__( 'Radius', 'premiumpress-elementor' ),
				'type'       => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%' ],
				'selectors'  => [
					'{{WRAPPER}} .pptv9-offcanvas-button' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			'offcanvas_button_padding',
			[
				'label'      => esc_html__( 'Padding', 'premiumpress-elementor' ),
				'type'       => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors'  => [
					'{{WRAPPER}} .pptv9-offcanvas-button' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
				'separator' => 'before',
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name'      => 'offcanvas_button_typography',
				'label'     => esc_html__( 'Typography', 'premiumpress-elementor' ),
				'scheme'    => \Elementor\Scheme_Typography::TYPOGRAPHY_4,
				'selector'  => '{{WRAPPER}} .pptv9-offcanvas-button',
				'separator' => 'before',
			]
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			'tab_offcanvas_button_hover',
			[
				'label' => esc_html__( 'Hover', 'premiumpress-elementor' ),
			]
		);

		$this->add_control(
			'offcanvas_button_hover_color',
			[
				'label'     => esc_html__( 'Button Text Color', 'premiumpress-elementor' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .pptv9-offcanvas-button:hover' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'offcanvas_button_background_hover_color',
			[
				'label'     => esc_html__( 'Button Background Color', 'premiumpress-elementor' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .pptv9-offcanvas-button:hover' => 'background-color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'offcanvas_button_hover_border_color',
			[
				'label'     => esc_html__( 'Button Border Color', 'premiumpress-elementor' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'condition' => [
					'offcanvas_button_border_border!' => '',
				],
				'selectors' => [
					'{{WRAPPER}} .pptv9-offcanvas-button:hover' => 'border-color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'hover_animation',
			[
				'label' => esc_html__( 'Button Animation', 'premiumpress-elementor' ),
				'type'  => \Elementor\Controls_Manager::HOVER_ANIMATION,
			]
		);

		$this->end_controls_tab();

		$this->end_controls_tabs();

		$this->end_controls_section();

		$this->start_controls_section(
			'section_style_close_button',
			[
				'label'     => esc_html__( 'Close Button', 'premiumpress-elementor' ),
				'tab'       => \Elementor\Controls_Manager::TAB_STYLE,
				'condition' => [
					'offcanvas_close_button' => 'yes'
				]
			]
		);

		$this->start_controls_tabs( 'tabs_close_button_style' );

		$this->start_controls_tab(
			'tab_close_button_normal',
			[
				'label' => esc_html__( 'Normal', 'premiumpress-elementor' ),
			]
		);

		$this->add_control(
			'close_button_color',
			[
				'label'     => esc_html__( 'Color', 'premiumpress-elementor' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'#pptv9-offcanvas-{{ID}}.pptv9-offcanvas .pptv9-offcanvas-close' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'close_button_bg',
			[
				'label'     => esc_html__( 'Background', 'premiumpress-elementor' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'#pptv9-offcanvas-{{ID}}.pptv9-offcanvas .pptv9-offcanvas-close' => 'background-color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Box_Shadow::get_type(),
			[
				'name'      => 'close_button_shadow',
				'selector'  => '#pptv9-offcanvas-{{ID}}.pptv9-offcanvas .pptv9-offcanvas-close',
				'separator' => 'before',
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Border::get_type(),
			[
				'name'        => 'close_button_border',
				'label'       => esc_html__( 'Border', 'premiumpress-elementor' ),
				'placeholder' => '1px',
				'default'     => '1px',
				'selector'    => '#pptv9-offcanvas-{{ID}}.pptv9-offcanvas .pptv9-offcanvas-close',
				'separator'   => 'before',
			]
		);

		$this->add_control(
			'close_button_radius',
			[
				'label'      => esc_html__( 'Radius', 'premiumpress-elementor' ),
				'type'       => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%' ],
				'selectors'  => [
					'#pptv9-offcanvas-{{ID}}.pptv9-offcanvas .pptv9-offcanvas-close' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			'close_button_padding',
			[
				'label'      => esc_html__( 'Padding', 'premiumpress-elementor' ),
				'type'       => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors'  => [
					'#pptv9-offcanvas-{{ID}}.pptv9-offcanvas .pptv9-offcanvas-close' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
				'separator' => 'before',
			]
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			'tab_close_button_hover',
			[
				'label' => esc_html__( 'Hover', 'premiumpress-elementor' ),
			]
		);

		$this->add_control(
			'close_button_hover_color',
			[
				'label'     => esc_html__( 'Color', 'premiumpress-elementor' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'#pptv9-offcanvas-{{ID}}.pptv9-offcanvas .pptv9-offcanvas-close:hover' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'close_button_hover_bg',
			[
				'label'     => esc_html__( 'Background', 'premiumpress-elementor' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'#pptv9-offcanvas-{{ID}}.pptv9-offcanvas .pptv9-offcanvas-close:hover' => 'background-color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'close_button_hover_border_color',
			[
				'label'     => esc_html__( 'Border Color', 'premiumpress-elementor' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'condition' => [
					'close_button_border_border!' => '',
				],
				'selectors' => [
					'#pptv9-offcanvas-{{ID}}.pptv9-offcanvas .pptv9-offcanvas-close:hover' => 'border-color: {{VALUE}};',
				],
			]
		);

		$this->end_controls_tab();

		$this->end_controls_tabs();

		$this->end_controls_section();
	}

	protected function render() {
		$settings = $this->get_settings_for_display();
		$id       = 'pptv9-offcanvas-' . $this->get_id();
		 
		$nav_menu = ! empty( $settings['navbar'] ) ? wp_get_nav_menu_object( $settings['navbar'] ) : false;

		//if ( ! $nav_menu ) {
		//	return;
		//}

		$nav_menu_args = array(
			'fallback_cb'    => false,
			'container'      => false,
			'menu_id'        => 'pptv9-navmenu-offcanvus',
			'menu_class'     => 'pptv9-navbar-nav-offcanvus',
			'theme_location' => 'default_navmenu', // creating a fake location for better functional control
			'menu'           => $nav_menu,
			'echo'           => true,
			'depth'          => 0,
			'walker'        => new ep_menu_walker
		);
		

		$this->add_render_attribute( 'offcanvas', 'class', 'pptv9-offcanvas' );
		$this->add_render_attribute( 'offcanvas', 'id', $id );
        $this->add_render_attribute(
        	[
        		'offcanvas' => [
        			'data-settings' => [
        				wp_json_encode(array_filter([
							'id'      =>  $id,
							'layout'  => $settings['layout'],
        		        ]))
        			]
        		]
        	]
        );

		$this->add_render_attribute( 'offcanvas', 'pptv9-offcanvas', 'mode: ' . $settings['offcanvas_animations'] . ';' );

		if ($settings['offcanvas_overlay']) {
			$this->add_render_attribute( 'offcanvas', 'pptv9-offcanvas', 'overlay: true;' );
		}

		if ($settings['offcanvas_flip']) {
			$this->add_render_attribute( 'offcanvas', 'pptv9-offcanvas', 'flip: true;' );
		}

		

		?>

		
		<?php $this->render_button(); ?>

		
	    <div <?php echo $this->get_render_attribute_string( 'offcanvas' ); ?>>
	        <div class="pptv9-offcanvas-bar">
				
				<?php if ($settings['offcanvas_close_button']) : ?>
	        		<button class="pptv9-offcanvas-close" type="button" pptv9-close></button>
	        	<?php endif; ?> 
			 
		        	<?php if ($settings['custom_content_before_switcher'] === 'yes' and !empty($settings['custom_content_before'])) : ?>
		        	<div class="pptv9-offcanvas-custom-content-before text-left">
		            	<?php echo wp_kses_post($settings['custom_content_before']); ?>		        		
		        	</div>
		        	<?php endif; ?>


<nav <?php echo $this->get_render_attribute_string( 'navbar-attr' ); ?>>
				<?php wp_nav_menu( apply_filters( 'widget_nav_menu_args', $nav_menu_args, $nav_menu, $settings ) ); ?>
			</nav>
             

	            	<?php if ($settings['custom_content_after_switcher'] === 'yes' and !empty($settings['custom_content_after'])) : ?>
	            	<div class="pptv9-offcanvas-custom-content-after text-left">
	                	<?php echo wp_kses_post($settings['custom_content_after']); ?>		        		
	            	</div>
	            	<?php endif; ?>
	           
	        </div>
	    </div>

		<?php
	}

	protected function render_button() {
		$settings = $this->get_settings_for_display();
		$id       = 'pptv9-offcanvas-' . $this->get_id();

		if ( 'default' !== $settings['layout'] ) {
			return;
		}

		$this->add_render_attribute( 'button', 'class', ['pptv9-offcanvas-button', 'elementor-button'] );

		if ( ! empty( $settings['size'] ) ) {
			$this->add_render_attribute( 'button', 'class', 'elementor-size-' . $settings['size'] );
		}

		if ( $settings['hover_animation'] ) {
			$this->add_render_attribute( 'button', 'class', 'elementor-animation-' . $settings['hover_animation'] );
		}

		$this->add_render_attribute( 'button', 'pptv9-toggle', 'target: #' . esc_attr($id) );
		$this->add_render_attribute( 'button', 'href', '#' );

		$this->add_render_attribute( 'content-wrapper', 'class', 'elementor-button-content-wrapper' );
		$this->add_render_attribute( 'icon-align', 'class', 'elementor-align-icon-' . $settings['button_icon_align'] );
		$this->add_render_attribute( 'icon-align', 'class', 'pptv9-offcanvas-button-icon elementor-button-icon' );

		$this->add_render_attribute( 'text', 'class', 'elementor-button-text' );

		?>

		<div class="pptv9-offcanvas-button-wrapper">
			<a <?php echo $this->get_render_attribute_string( 'button' ); ?> >
			
				<span <?php echo $this->get_render_attribute_string( 'content-wrapper' ); ?>>
					<?php if ( ! empty( $settings['button_icon'] ) ) : ?>
					<span <?php echo $this->get_render_attribute_string( 'icon-align' ); ?>>
						<i class="<?php echo esc_attr( $settings['button_icon'] ); ?>" aria-hidden="true"></i>
					</span>
					<?php endif; ?>
					<?php if ( ! empty( $settings['button_text'] ) ) : ?>
						<span <?php echo $this->get_render_attribute_string( 'text' ); ?>><?php echo $settings['button_text']; ?></span>
					<?php endif; ?>
				</span>

			</a>
		</div>
		<?php
	}
}
