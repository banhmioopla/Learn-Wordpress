<?php

class Widget_PremiumPress_Button extends \Elementor\Widget_Base {
 	/**
	 * @var \WP_Query
	 */
	private $_query = null;
	
	public function get_name() {
		return 'pptv9-advanced-button';
	} 
	public function get_title() {
		return __( '{ Button }', 'premiumpress-elementor' );
	} 
	public function get_icon() {
		return 'design-plus';
	} 
	public function get_categories() {
		return [ 'premiumpress-content' ];
	} 

	public function get_keywords() {
		return [ 'button', 'advanced', 'link' ];
	}
	public function get_style_depends() {
		return [ 'pptv9-advanced-button' ];
	}
	protected function _register_controls() {
		$this->start_controls_section(
			'section_button',
			[
				'label' => esc_html__( 'Button', 'premiumpress-elementor' ),
			]
		);

		$this->add_control(
			'text',
			[
				'label'       => esc_html__( 'Text', 'premiumpress-elementor' ),
				'type'        => \Elementor\Controls_Manager::TEXT,
				'dynamic'     => [ 'active' => true ],
				'default'     => esc_html__( 'Click me', 'premiumpress-elementor' ),
				'placeholder' => esc_html__( 'Click me', 'premiumpress-elementor' ),
			]
		);

		$this->add_control(
			'link',
			[
				'label'       => esc_html__( 'Link', 'premiumpress-elementor' ),
				'type'        => \Elementor\Controls_Manager::URL,
				'dynamic'     => [ 'active' => true ],
				'placeholder' => esc_html__( 'https://your-link.com', 'premiumpress-elementor' ),
				'default'     => [
					'url' => '#',
				],
			]
		);

		$this->add_control(
			'button_size',
			[
				'label'   => esc_html__( 'Button Size', 'premiumpress-elementor' ),
				'type'    => \Elementor\Controls_Manager::SELECT,
				'default' => 'md',
				'options' => [
					'xs' => esc_html__( 'Extra Small', 'premiumpress-elementor' ),
					'sm' => esc_html__( 'Small', 'premiumpress-elementor' ),
					'md' => esc_html__( 'Medium', 'premiumpress-elementor' ),
					'lg' => esc_html__( 'Large', 'premiumpress-elementor' ),
					'xl' => esc_html__( 'Extra Large', 'premiumpress-elementor' ),
				],
			]
		);

		$this->add_control(
			'onclick',
			[
				'label'   => esc_html__( 'OnClick', 'premiumpress-elementor' ),
				'type'    => \Elementor\Controls_Manager::SWITCHER,
			]
		);

		$this->add_control(
			'onclick_event',
			[
				'label'       => esc_html__( 'OnClick Event', 'premiumpress-elementor' ),
				'type'        => \Elementor\Controls_Manager::TEXT,
				'placeholder' => 'myFunction()',
				'description' => sprintf( esc_html__('For details please look <a href="%s" target="_blank">here</a>'), 'https://www.w3schools.com/jsref/event_onclick.asp' ),
				'condition' => [
					'onclick' => 'yes'
				]
			]
		);

		$this->add_responsive_control(
			'align',
			[
				'label'        => esc_html__( 'Alignment', 'premiumpress-elementor' ),
				'type'         => \Elementor\Controls_Manager::CHOOSE,
				'prefix_class' => 'elementor%s-align-',
				'default'      => '',
				'options'      => [
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
					'left'   => esc_html__( 'Left', 'premiumpress-elementor' ),
					'right'  => esc_html__( 'Right', 'premiumpress-elementor' ),
					'top'    => esc_html__( 'Top', 'premiumpress-elementor' ),
					'bottom' => esc_html__( 'Bottom', 'premiumpress-elementor' ),
				],
				'condition' => [
					'icon!' => '',
				],
			]
		);

		$this->add_control(
			'icon_indent',
			[
				'label' => esc_html__( 'Icon Spacing', 'premiumpress-elementor' ),
				'type'  => \Elementor\Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'max' => 100,
					],
				],
					'default' => [
						'size' => 8,
					],
				'condition' => [
					'icon!' => '',
				],
				'selectors' => [
					'{{WRAPPER}} .pptv9-advanced-button .pptv9-button-icon-align-right'  => 'margin-left: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .pptv9-advanced-button .pptv9-button-icon-align-left'   => 'margin-right: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .pptv9-advanced-button .pptv9-button-icon-align-top'    => 'margin-bottom: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .pptv9-advanced-button .pptv9-button-icon-align-bottom' => 'margin-top: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_content_style',
			[
				'label'     => esc_html__( 'Style', 'premiumpress-elementor' ),
				'tab'       => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'button_effect',
			[
				'label'   => esc_html__( 'Effect', 'premiumpress-elementor' ),
				'type'    => \Elementor\Controls_Manager::SELECT,
				'default' => 'a',
				'options' => [
					'a' => esc_html__( 'Effect A', 'premiumpress-elementor' ),
					'b' => esc_html__( 'Effect B', 'premiumpress-elementor' ),
					'c' => esc_html__( 'Effect C', 'premiumpress-elementor' ),
					'd' => esc_html__( 'Effect D', 'premiumpress-elementor' ),
					'e' => esc_html__( 'Effect E', 'premiumpress-elementor' ),
					'f' => esc_html__( 'Effect F', 'premiumpress-elementor' ),
					'g' => esc_html__( 'Effect G', 'premiumpress-elementor' ),
					'h' => esc_html__( 'Effect H', 'premiumpress-elementor' ),
					'i' => esc_html__( 'Effect I', 'premiumpress-elementor' ),
				],
				'render_type' => 'template',
			]
		);

		$this->add_control(
			'attention_button',
			[
				'label' => esc_html__( 'Attention', 'premiumpress-elementor' ),
				'type'  => \Elementor\Controls_Manager::SWITCHER,
			]
		);

		$this->start_controls_tabs( 'tabs_advanced_button_style' );

		$this->start_controls_tab(
			'tab_advanced_button_normal',
			[
				'label' => esc_html__( 'Normal', 'premiumpress-elementor' ),
			]
		);

		$this->add_control(
			'advanced_button_text_color',
			[
				'label'     => esc_html__( 'Text Color', 'premiumpress-elementor' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .pptv9-advanced-button' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Background::get_type(),
			[
				'name'      => 'button_background',
				'types'     => [ 'classic', 'gradient' ],
				'selector'  => '{{WRAPPER}} .pptv9-advanced-button, 
								{{WRAPPER}} .pptv9-advanced-button.pptv9-advanced-button-effect-i .pptv9-advanced-button-content-wrapper:after,
								{{WRAPPER}} .pptv9-advanced-button.pptv9-advanced-button-effect-i .pptv9-advanced-button-content-wrapper:before,
								{{WRAPPER}} .pptv9-advanced-button.pptv9-advanced-button-effect-h:hover',
				'separator' => 'after',
			]
		);

		$this->add_control(
			'button_border_style',
			[
				'label'   => esc_html__( 'Border Style', 'premiumpress-elementor' ),
				'type'    => \Elementor\Controls_Manager::SELECT,
				'default' => 'solid',
				'options' => [
					'none'   => esc_html__( 'None', 'premiumpress-elementor' ),
					'solid'  => esc_html__( 'Solid', 'premiumpress-elementor' ),
					'dotted' => esc_html__( 'Dotted', 'premiumpress-elementor' ),
					'dashed' => esc_html__( 'Dashed', 'premiumpress-elementor' ),
					'groove' => esc_html__( 'Groove', 'premiumpress-elementor' ),
				],
				'selectors'  => [
					'{{WRAPPER}} .pptv9-advanced-button' => 'border-style: {{VALUE}};',
				],
			]
		);

		$this->add_responsive_control(
			'button_border_width',
			[
				'label' => esc_html__( 'Border Width', 'premiumpress-elementor' ),
				'type'  => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%' ],
				'default' => [
					'top'    => 3,
					'right'  => 3,
					'bottom' => 3,
					'left'   => 3,
				],
				'selectors'  => [
					'{{WRAPPER}} .pptv9-advanced-button' => 'border-width: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
				'condition' => [
					'button_border_style!' => 'none'
				]
			]
		);

		$this->add_control(
			'button_border_color',
			[
				'label'     => esc_html__( 'Border Color', 'premiumpress-elementor' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'default'   => '#666',
				'selectors' => [
					'{{WRAPPER}} .pptv9-advanced-button' => 'border-color: {{VALUE}};',
				],
				'condition' => [
					'button_border_style!' => 'none'
				],
				'separator' => 'after',
			]
		);

		$this->add_responsive_control(
			'advanced_button_radius',
			[
				'label'      => esc_html__( 'Border Radius', 'premiumpress-elementor' ),
				'type'       => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%' ],
				'selectors'  => [
					'{{WRAPPER}} .pptv9-advanced-button' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Box_Shadow::get_type(),
			[
				'name'     => 'advanced_button_shadow',
				'selector' => '{{WRAPPER}} .pptv9-advanced-button',
			]
		);

		$this->add_responsive_control(
			'advanced_button_padding',
			[
				'label'      => esc_html__( 'Padding', 'premiumpress-elementor' ),
				'type'       => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors'  => [
					'{{WRAPPER}} .pptv9-advanced-button' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name'     => 'advanced_button_typography',
				'scheme'   => \Elementor\Scheme_Typography::TYPOGRAPHY_4,
				'selector' => '{{WRAPPER}} .pptv9-advanced-button',
			]
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			'tab_advanced_button_hover',
			[
				'label' => esc_html__( 'Hover', 'premiumpress-elementor' ),
			]
		);

		$this->add_control(
			'advanced_button_hover_text_color',
			[
				'label'     => esc_html__( 'Text Color', 'premiumpress-elementor' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .pptv9-advanced-button:hover' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Background::get_type(),
			[
				'name'      => 'button_hover_background',
				'types'     => [ 'classic', 'gradient' ],
				'selector'  => '{{WRAPPER}} .pptv9-advanced-button:after, 
								{{WRAPPER}} .pptv9-advanced-button:hover,
								{{WRAPPER}} .pptv9-advanced-button.pptv9-advanced-button-effect-i,
								{{WRAPPER}} .pptv9-advanced-button.pptv9-advanced-button-effect-h:after',
			]
		);

		$this->add_control(
			'button_hover_border_style',
			[
				'label'   => esc_html__( 'Border Style', 'premiumpress-elementor' ),
				'type'    => \Elementor\Controls_Manager::SELECT,
				'default' => 'solid',
				'options' => [
					'none'   => esc_html__( 'None', 'premiumpress-elementor' ),
					'solid'  => esc_html__( 'Solid', 'premiumpress-elementor' ),
					'dotted' => esc_html__( 'Dotted', 'premiumpress-elementor' ),
					'dashed' => esc_html__( 'Dashed', 'premiumpress-elementor' ),
					'groove' => esc_html__( 'Groove', 'premiumpress-elementor' ),
				],
				'selectors'  => [
					'{{WRAPPER}} .pptv9-advanced-button:hover' => 'border-style: {{VALUE}};',
				],
				'separator' => 'before',
			]
		);

		$this->add_responsive_control(
			'button_hover_border_width',
			[
				'label' => esc_html__( 'Border Width', 'premiumpress-elementor' ),
				'type'  => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%' ],
				'default' => [
					'top'    => 3,
					'right'  => 3,
					'bottom' => 3,
					'left'   => 3,
				],
				'selectors'  => [
					'{{WRAPPER}} .pptv9-advanced-button:hover' => 'border-width: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
				'condition' => [
					'button_hover_border_style!' => 'none'
				]
			]
		);

		$this->add_control(
			'button_hover_border_color',
			[
				'label'     => esc_html__( 'Border Color', 'premiumpress-elementor' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .pptv9-advanced-button:hover' => 'border-color: {{VALUE}};',
				],
				'condition' => [
					'button_hover_border_style!' => 'none'
				]
			]
		);

		$this->add_responsive_control(
			'advanced_button_hover_radius',
			[
				'label'      => esc_html__( 'Border Radius', 'premiumpress-elementor' ),
				'type'       => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%' ],
				'selectors'  => [
					'{{WRAPPER}} .pptv9-advanced-button:hover' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Box_Shadow::get_type(),
			[
				'name'     => 'advanced_button_hover_shadow',
				'selector' => '{{WRAPPER}} .pptv9-advanced-button:hover',
			]
		);

		$this->add_control(
			'hover_animation',
			[
				'label' => esc_html__( 'Hover Animation', 'premiumpress-elementor' ),
				'type' => \Elementor\Controls_Manager::HOVER_ANIMATION,
			]
		);

		$this->end_controls_tab();

		$this->end_controls_tabs();

		$this->end_controls_section();

		$this->start_controls_section(
			'section_style_icon',
			[
				'label'     => esc_html__( 'Icon', 'premiumpress-elementor' ),
				'tab'       => \Elementor\Controls_Manager::TAB_STYLE,
				'condition' => [
					'icon!' => '',
				],
			]
		);

		$this->start_controls_tabs( 'tabs_advanced_button_icon_style' );

		$this->start_controls_tab(
			'tab_advanced_button_icon_normal',
			[
				'label' => esc_html__( 'Normal', 'premiumpress-elementor' ),
			]
		);

		$this->add_control(
			'advanced_button_icon_color',
			[
				'label'     => esc_html__( 'Color', 'premiumpress-elementor' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .pptv9-advanced-button .pptv9-advanced-button-icon' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Background::get_type(),
			[
				'name'      => 'advanced_button_icon_background',
				'types'     => [ 'classic', 'gradient' ],
				'selector'  => '{{WRAPPER}} .pptv9-advanced-button .pptv9-advanced-button-icon:after',
				'separator' => 'after',
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Border::get_type(),
			[
				'name'        => 'advanced_button_icon_border',
				'placeholder' => '1px',
				'default'     => '1px',
				'selector'    => '{{WRAPPER}} .pptv9-advanced-button .pptv9-advanced-button-icon:after',
			]
		);

		$this->add_control(
			'advanced_button_icon_padding',
			[
				'label'      => esc_html__( 'Padding', 'premiumpress-elementor' ),
				'type'       => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors'  => [
					'{{WRAPPER}} .pptv9-advanced-button .pptv9-advanced-button-icon:after' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			'advanced_button_icon_radius',
			[
				'label'      => esc_html__( 'Border Radius', 'premiumpress-elementor' ),
				'type'       => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%' ],
				'selectors'  => [
					'{{WRAPPER}} .pptv9-advanced-button .pptv9-advanced-button-icon:after' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Box_Shadow::get_type(),
			[
				'name'     => 'advanced_button_icon_shadow',
				'selector' => '{{WRAPPER}} .pptv9-advanced-button .pptv9-advanced-button-icon:after',
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name'      => 'advanced_button_icon_typography',
				'scheme'    => \Elementor\Scheme_Typography::TYPOGRAPHY_4,
				'selector'  => '{{WRAPPER}} .pptv9-advanced-button .pptv9-advanced-button-icon',
				'separator' => 'before',
			]
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			'tab_advanced_button_icon_hover',
			[
				'label' => esc_html__( 'Hover', 'premiumpress-elementor' ),
			]
		);

		$this->add_control(
			'advanced_button_icon_hover_color',
			[
				'label'     => esc_html__( 'Color', 'premiumpress-elementor' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .pptv9-advanced-button:hover .pptv9-advanced-button-icon' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Background::get_type(),
			[
				'name'      => 'advanced_button_icon_hover_background',
				'types'     => [ 'classic', 'gradient' ],
				'selector'  => '{{WRAPPER}} .pptv9-advanced-button:hover .pptv9-advanced-button-icon:after',
				'separator' => 'after',
			]
		);

		$this->add_control(
			'icon_hover_border_color',
			[
				'label'     => esc_html__( 'Border Color', 'premiumpress-elementor' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'condition' => [
					'icon_border_border!' => '',
				],
				'selectors' => [
					'{{WRAPPER}} .pptv9-advanced-button:hover .pptv9-advanced-button-icon:after' => 'border-color: {{VALUE}};',
				],
			]
		);

		$this->end_controls_tab();

		$this->end_controls_tabs();

		$this->end_controls_section();
	}

	public function render_text() {
		$settings = $this->get_settings();
		$this->add_render_attribute( 'content-wrapper', 'class', 'pptv9-advanced-button-content-wrapper' );
		$this->add_render_attribute( 'content-wrapper', 'class', ( 'top' == $settings['icon_align'] ) ? 'pptv9-flex pptv9-flex-column' : '' );
		$this->add_render_attribute( 'content-wrapper', 'class', ( 'bottom' == $settings['icon_align'] ) ? 'pptv9-flex pptv9-flex-column-reverse' : '' );
		$this->add_render_attribute( 'content-wrapper', 'data-text', esc_attr($settings['text']));

		$this->add_render_attribute( 'icon-align', 'class', 'elementor-align-icon-' . $settings['icon_align'] );
		$this->add_render_attribute( 'icon-align', 'class', 'pptv9-advanced-button-icon' );

		$this->add_render_attribute( 'text', 'class', 'pptv9-advanced-button-text' );
		$this->add_inline_editing_attributes( 'text', 'none' );

		?>
		<div <?php echo $this->get_render_attribute_string( 'content-wrapper' ); ?>>
			<?php if ( ! empty( $settings['icon'] ) ) : ?>
				<div class="pptv9-advanced-button-icon pptv9-button-icon-align-<?php echo esc_attr($settings['icon_align']); ?>">
					<i class="<?php echo esc_attr( $settings['icon'] ); ?>" aria-hidden="true"></i>
				</div>
			<?php endif; ?>
			<div <?php echo $this->get_render_attribute_string( 'text' ); ?>><?php echo $settings['text']; ?></div>
		</div>
		<?php
	}

	protected function render() {
		$settings = $this->get_settings_for_display();

		$this->add_render_attribute( 'wrapper', 'class', 'pptv9-advanced-button-wrapper' );

		if ( ! empty( $settings['link']['url'] ) ) {
			$this->add_render_attribute( 'advanced_button', 'href', $settings['link']['url'] );

			if ( $settings['link']['is_external'] ) {
				$this->add_render_attribute( 'advanced_button', 'target', '_blank' );
			}

			if ( $settings['link']['nofollow'] ) {
				$this->add_render_attribute( 'advanced_button', 'rel', 'nofollow' );
			}

		}

		if ( $settings['link']['nofollow'] ) {
			$this->add_render_attribute( 'advanced_button', 'rel', 'nofollow' );
		}

		if ($settings['onclick']) {
			$this->add_render_attribute( 'advanced_button', 'onclick', $settings['onclick_event'] );
		}

		if ($settings['attention_button']) {
			$this->add_render_attribute( 'advanced_button', 'class', 'pptv9-ep-attention-button' );
		}

		$this->add_render_attribute( 'advanced_button', 'class', 'pptv9-advanced-button' );		
		$this->add_render_attribute( 'advanced_button', 'class', 'pptv9-advanced-button-effect-' . esc_attr($settings['button_effect']) );
		$this->add_render_attribute( 'advanced_button', 'class', 'pptv9-advanced-button-size-' . esc_attr($settings['button_size']) );
		

		if ( $settings['hover_animation'] ) {
			$this->add_render_attribute( 'advanced_button', 'class', 'elementor-animation-' . $settings['hover_animation'] );
		}

		?>
		<div <?php echo $this->get_render_attribute_string( 'wrapper' ); ?>>
			<a <?php echo $this->get_render_attribute_string( 'advanced_button' ); ?>>
				<?php $this->render_text(); ?>
			</a>
		</div>
		<?php
	}


	protected function _content_template() {
		?>
		<#
		view.addRenderAttribute( 'text', 'class', 'pptv9-advanced-button-text' );

		view.addInlineEditingAttributes( 'text', 'none' );
		
		
		view.addRenderAttribute( 'button', 'onclick', settings.onclick_event );

		var animation = (settings.hover_animation) ? ' elementor-animation-' + settings.hover_animation : '';
		var attention = (settings.attention_button) ? ' pptv9-ep-attention-button' : '';

		view.addRenderAttribute( 'content-wrapper', 'class', 'pptv9-advanced-button-content-wrapper' );

		if (settings.icon_align == 'bottom') {
			view.addRenderAttribute( 'content-wrapper', 'class', 'pptv9-flex pptv9-flex-column-reverse' );
		}
		
		view.addRenderAttribute( 'content-wrapper', 'data-text', settings.readmore_text);

		#>
		<div class="elementor-button-wrapper">
			<a class="pptv9-advanced-button pptv9-advanced-button-effect-{{ settings.button_effect }} pptv9-advanced-button-size-{{ settings.button_size }}{{animation}}{{attention}}" href="{{ settings.link.url }}" role="button" {{{ view.getRenderAttributeString( 'button' ) }}}>
				<div {{{ view.getRenderAttributeString( 'content-wrapper' ) }}}>
					<# if ( settings.icon ) { #>
					<div class="pptv9-advanced-button-icon pptv9-button-icon-align-{{ settings.icon_align }}">
						<i class="{{ settings.icon }}" aria-hidden="true"></i>
					</div>
					<# } #>
					<div {{{ view.getRenderAttributeString( 'text' ) }}}>{{{ settings.text }}}</div>
				</div>
			</a>
		</div>
		<?php
	}
}
?>