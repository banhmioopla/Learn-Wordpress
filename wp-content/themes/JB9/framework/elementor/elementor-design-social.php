<?php

class Module {


	private static $medias = [
		'facebook' => [
			'title' => 'Facebook',
			'has_counter' => true,
		],
		'googleplus' => [
			'title' => 'Google+',
		],
		'twitter' => [
			'title' => 'Twitter',
		],
		'pinterest' => [
			'title' => 'Pinterest',
			'has_counter' => true,
		],
		'linkedin' => [
			'title' => 'Linkedin',
			'has_counter' => true,
		],
		'vkontakte' => [
			'title' => 'Vkontakte',
			'has_counter' => true,
		],
		'odnoklassniki' => [
			'title' => 'OK',
			'has_counter' => true,
		],
		'moimir' => [
			'title' => 'Mail.Ru',
			'has_counter' => true,
		],
		'livejournal' => [
			'title' => 'LiveJournal',
		],
		'tumblr' => [
			'title' => 'Tumblr',
			'has_counter' => true,
		],
		'blogger' => [
			'title' => 'Blogger',
		],
		'digg' => [
			'title' => 'Digg',
		],
		'evernote' => [
			'title' => 'Evernote',
		],
		'reddit' => [
			'title' => 'Reddit',
			'has_counter' => true,
		],
		'delicious' => [
			'title' => 'Delicious',
			'has_counter' => true,
		],
		'stumbleupon' => [
			'title' => 'StumbleUpon',
			'has_counter' => true,
		],
		'pocket' => [
			'title' => 'Pocket',
			'has_counter' => true,
		],
		'surfingbird' => [
			'title' => 'Surfingbird',
			'has_counter' => true,
		],
		'liveinternet' => [
			'title' => 'LiveInternet',
		],
		'buffer' => [
			'title' => 'Buffer',
			'has_counter' => true,
		],
		'instapaper' => [
			'title' => 'Instapaper',
		],
		'xing' => [
			'title' => 'Xing',
			'has_counter' => true,
		],
		'wordpress' => [
			'title' => 'Wordpress',
		],
		'baidu' => [
			'title' => 'Baidu',
		],
		'renren' => [
			'title' => 'Renren',
		],
		'weibo' => [
			'title' => 'Weibo',
		],
		// Mobile Device Sharing
		'skype' => [
			'title' => 'Skype',
		],
		'telegram' => [
			'title' => 'Telegram',
		],
		'viber' => [
			'title' => 'Viber',
		],
		'whatsapp' => [
			'title' => 'WhatsApp',
		],
		'line' => [
			'title' => 'LINE',
		],
	];

	public static function get_social_media( $media_name = null ) {
		if ( $media_name ) {
			return isset( self::$medias[ $media_name ] ) ? self::$medias[ $media_name ] : null;
		}

		return self::$medias;
	}

	public function get_name() {
		return 'social';
	}

	public function get_widgets() {

		$widgets = [
			'Social_Share',
		];

		return $widgets;
	}
}

class Widget_PremiumPress_SocialShare extends \Elementor\Widget_Base {

	protected $_has_template_content = false;

	private static $medias_class = [
		'googleplus' => 'fab fa-google-plus',
		'pocket'     => 'fa fa-get-pocket',
		'email'      => 'fa fa-envelope',
		'vkontakte'  => 'fa fa-vk',
	];

	private static function get_social_media_class( $media_name ) {
		if ( isset( self::$medias_class[ $media_name ] ) ) {
			return self::$medias_class[ $media_name ];
		}

		return 'fa fab fa-' . $media_name;
	}


	public function get_name() {
		return 'pptv9-social-share';
	}

	public function get_title() {
		return esc_html__( '{ Social Share }', 'premiumpress-elementor' );
	}

	public function get_icon() {
		return 'design-facebook';
	}

	public function get_categories() {
		return [ 'premiumpress-content' ];
	}

	public function get_keywords() {
		return [ 'social', 'link', 'share' ];
	}

	public function get_style_depends() {
		return ['pptv9-social-share'];
	}
	
	public function get_script_depends() {
		return [ 'goodshare' ];
	}

	protected function _register_controls() {
		$this->start_controls_section(
			'section_buttons_content',
			[
				'label' => esc_html__( 'Share Buttons', 'premiumpress-elementor' ),
			]
		);

		$repeater = new \Elementor\Repeater();

		$medias = Module::get_social_media();

		$medias_names = array_keys( $medias );

		$repeater->add_control(
			'button',
			[
				'label' => esc_html__( 'Social Media', 'premiumpress-elementor' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'options' => array_reduce( $medias_names, function( $options, $media_name ) use ( $medias ) {
					$options[ $media_name ] = $medias[ $media_name ]['title'];

					return $options;
				}, [] ),
				'default' => 'facebook',
			]
		);

		$repeater->add_control(
			'text',
			[
				'label' => esc_html__( 'Custom Label', 'premiumpress-elementor' ),
				'type' => \Elementor\Controls_Manager::TEXT,
			]
		);

		$this->add_control(
			'share_buttons',
			[
				'type'    => \Elementor\Controls_Manager::REPEATER,
				'fields'  => array_values( $repeater->get_controls() ),
				'default' => [
					[
						'button' => 'facebook',
					],
					[
						'button' => 'googleplus',
					],
					[
						'button' => 'twitter',
					],
					[
						'button' => 'pinterest',
					],
				],
				'title_field' => '{{{ button }}}',
			]
		);

		$this->add_control(
			'view',
			[
				'label'       => esc_html__( 'View', 'premiumpress-elementor' ),
				'type'        => \Elementor\Controls_Manager::SELECT,
				'label_block' => false,
				'options'     => [
					'icon-text' => 'Icon & Text',
					'icon'      => 'Icon',
					'text'      => 'Text',
				],
				'default'      => 'icon-text',
				'separator'    => 'before',
				'prefix_class' => 'pptv9-social-share-buttons-view-',
				'render_type'  => 'template',
			]
		);

		$this->add_control(
			'show_label',
			[
				'label'     => esc_html__( 'Label', 'premiumpress-elementor' ),
				'type'      => \Elementor\Controls_Manager::SWITCHER,
				'default'   => 'yes',
				'condition' => [
					'view' => 'icon-text',
				],
			]
		);

		$this->add_control(
			'show_counter',
			[
				'label'     => esc_html__( 'Count', 'premiumpress-elementor' ),
				'type'      => \Elementor\Controls_Manager::SWITCHER,
				'condition' => [
					'view!' => 'icon',
				],
			]
		);

		$this->add_control(
			'style',
			[
				'label'   => esc_html__( 'Style', 'premiumpress-elementor' ),
				'type'    => \Elementor\Controls_Manager::SELECT,
				'options' => [
					'flat'     => esc_html__( 'Flat', 'premiumpress-elementor' ),
					'framed'   => esc_html__( 'Framed', 'premiumpress-elementor' ),
					'gradient' => esc_html__( 'Gradient', 'premiumpress-elementor' ),
					'minimal'  => esc_html__( 'Minimal', 'premiumpress-elementor' ),
					'boxed'    => esc_html__( 'Boxed Icon', 'premiumpress-elementor' ),
				],
				'default'      => 'flat',
				'prefix_class' => 'pptv9-social-share-buttons-style-',
			]
		);

		$this->add_control(
			'shape',
			[
				'label'   => esc_html__( 'Shape', 'premiumpress-elementor' ),
				'type'    => \Elementor\Controls_Manager::SELECT,
				'options' => [
					'square'  => esc_html__( 'Square', 'premiumpress-elementor' ),
					'rounded' => esc_html__( 'Rounded', 'premiumpress-elementor' ),
					'circle'  => esc_html__( 'Circle', 'premiumpress-elementor' ),
				],
				'default'      => 'square',
				'prefix_class' => 'pptv9-social-share-buttons-shape-',
			]
		);

		$this->add_responsive_control(
			'columns',
			[
				'label'   => esc_html__( 'Columns', 'premiumpress-elementor' ),
				'type'    => \Elementor\Controls_Manager::SELECT,
				'default' => '0',
				'options' => [
					'0' => 'Auto',
					'1' => '1',
					'2' => '2',
					'3' => '3',
					'4' => '4',
					'5' => '5',
					'6' => '6',
				],
				'prefix_class' => 'pptv9-ep-grid%s-',
			]
		);

		$this->add_control(
			'alignment',
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
						'title' => esc_html__( 'Justify', 'premiumpress-elementor' ),
						'icon'  => 'fa fa-align-justify',
					],
				],
				'prefix_class' => 'pptv9-social-share-buttons-align-',
				'condition'    => [
					'columns' => '0',
				],
			]
		);

		$this->add_control(
			'share_url_type',
			[
				'label'   => esc_html__( 'Target URL', 'premiumpress-elementor' ),
				'type'    => \Elementor\Controls_Manager::SELECT,
				'options' => [
					'current_page' => esc_html__( 'Current Page', 'premiumpress-elementor' ),
					'custom'       => esc_html__( 'Custom', 'premiumpress-elementor' ),
				],
				'default'   => 'current_page',
				'separator' => 'before',
			]
		);

		$this->add_control(
			'share_url',
			[
				'label'         => esc_html__( 'URL', 'premiumpress-elementor' ),
				'type'          => \Elementor\Controls_Manager::URL,
				'show_external' => false,
				'placeholder'   => 'http://your-link.com',
				'condition'     => [
					'share_url_type' => 'custom',
				],
				'show_label'         => false,
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_buttons_style',
			[
				'label' => esc_html__( 'Share Buttons', 'premiumpress-elementor' ),
				'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_responsive_control(
			'column_gap',
			[
				'label'   => esc_html__( 'Columns Gap', 'premiumpress-elementor' ),
				'type'    => \Elementor\Controls_Manager::SLIDER,
				'default' => [
					'size' => 10,
				],
				'selectors' => [
					'{{WRAPPER}} .pptv9-social-share-button' => 'margin-right: calc({{SIZE}}{{UNIT}} / 2); margin-left: calc({{SIZE}}{{UNIT}} / 2);',
					'{{WRAPPER}} .pptv9-ep-grid'             => 'margin-right: calc(-{{SIZE}}{{UNIT}} / 2); margin-left: calc(-{{SIZE}}{{UNIT}} / 2);',
				],
			]
		);

		$this->add_responsive_control(
			'row_gap',
			[
				'label'   => esc_html__( 'Rows Gap', 'premiumpress-elementor' ),
				'type'    => \Elementor\Controls_Manager::SLIDER,
				'default' => [
					'size' => 10,
				],
				'selectors' => [
					'{{WRAPPER}} .pptv9-social-share-button' => 'margin-bottom: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'button_size',
			[
				'label' => esc_html__( 'Button Size', 'premiumpress-elementor' ),
				'type'  => \Elementor\Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'min'  => 0.5,
						'max'  => 2,
						'step' => 0.1,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .pptv9-social-share-button' => 'font-size: calc({{SIZE}}{{UNIT}} * 10);',
				],
			]
		);

		$this->add_responsive_control(
			'icon_size',
			[
				'label' => esc_html__( 'Icon Size', 'premiumpress-elementor' ),
				'type'  => \Elementor\Controls_Manager::SLIDER,
				'range' => [
					'em' => [
						'min'  => 0.5,
						'max'  => 4,
						'step' => 0.1,
					],
					'px' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'default' => [
					'unit' => 'em',
				],
				'tablet_default' => [
					'unit' => 'em',
				],
				'mobile_default' => [
					'unit' => 'em',
				],
				'size_units' => [ 'em', 'px' ],
				'selectors'  => [
					'{{WRAPPER}} .pptv9-social-share-icon i' => 'font-size: {{SIZE}}{{UNIT}};',
				],
				'condition' => [
					'view!' => 'text',
				],
			]
		);

		$this->add_responsive_control(
			'button_height',
			[
				'label' => esc_html__( 'Button Height', 'premiumpress-elementor' ),
				'type'  => \Elementor\Controls_Manager::SLIDER,
				'range' => [
					'em' => [
						'min'  => 1,
						'max'  => 7,
						'step' => 0.1,
					],
					'px' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'default' => [
					'unit' => 'em',
				],
				'tablet_default' => [
					'unit' => 'em',
				],
				'mobile_default' => [
					'unit' => 'em',
				],
				'size_units' => [ 'em', 'px' ],
				'selectors'  => [
					'{{WRAPPER}} .pptv9-social-share-button' => 'height: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'border_size',
			[
				'label'      => esc_html__( 'Border Size', 'premiumpress-elementor' ),
				'type'       => \Elementor\Controls_Manager::SLIDER,
				'size_units' => [ 'px', 'em' ],
				'default'    => [
					'size' => 2,
				],
				'range' => [
					'px' => [
						'min' => 1,
						'max' => 20,
					],
					'em' => [
						'max'  => 2,
						'step' => 0.1,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .pptv9-social-share-button' => 'border-width: {{SIZE}}{{UNIT}};',
				],
				'condition' => [
					'style' => [ 'framed', 'boxed' ],
				],
			]
		);

		$this->add_control(
			'color_source',
			[
				'label'       => esc_html__( 'Color', 'premiumpress-elementor' ),
				'type'        => \Elementor\Controls_Manager::SELECT,
				'label_block' => false,
				'options'     => [
					'original' => 'Original Color',
					'custom'   => 'Custom Color',
				],
				'default'      => 'original',
				'prefix_class' => 'pptv9-social-share-buttons-color-',
				'separator'    => 'before',
			]
		);

		$this->start_controls_tabs( 'tabs_button_style' );

		$this->start_controls_tab(
			'tab_button_normal',
			[
				'label'     => esc_html__( 'Normal', 'premiumpress-elementor' ),
				'condition' => [
					'color_source' => 'custom',
				],
			]
		);

		$this->add_control(
			'primary_color',
			[
				'label'     => esc_html__( 'Primary Color', 'premiumpress-elementor' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}}.pptv9-social-share-buttons-style-flat .pptv9-social-share-button,
					 {{WRAPPER}}.pptv9-social-share-buttons-style-gradient .pptv9-social-share-button,
					 {{WRAPPER}}.pptv9-social-share-buttons-style-boxed .pptv9-social-share-button .pptv9-social-share-icon,
					 {{WRAPPER}}.pptv9-social-share-buttons-style-minimal .pptv9-social-share-button .pptv9-social-share-icon' => 'background-color: {{VALUE}}',
					'{{WRAPPER}}.pptv9-social-share-buttons-style-framed .pptv9-social-share-button,
					 {{WRAPPER}}.pptv9-social-share-buttons-style-minimal .pptv9-social-share-button,
					 {{WRAPPER}}.pptv9-social-share-buttons-style-boxed .pptv9-social-share-button' => 'color: {{VALUE}}; border-color: {{VALUE}}',
				],
				'condition' => [
					'color_source' => 'custom',
				],
			]
		);

		$this->add_control(
			'secondary_color',
			[
				'label'     => esc_html__( 'Secondary Color', 'premiumpress-elementor' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}}.pptv9-social-share-buttons-style-flat .pptv9-social-share-icon, 
					 {{WRAPPER}}.pptv9-social-share-buttons-style-flat .pptv9-social-share-text, 
					 {{WRAPPER}}.pptv9-social-share-buttons-style-gradient .pptv9-social-share-icon,
					 {{WRAPPER}}.pptv9-social-share-buttons-style-gradient .pptv9-social-share-text,
					 {{WRAPPER}}.pptv9-social-share-buttons-style-boxed .pptv9-social-share-icon,
					 {{WRAPPER}}.pptv9-social-share-buttons-style-minimal .pptv9-social-share-icon' => 'color: {{VALUE}}',
				],
				'condition' => [
					'color_source' => 'custom',
				],
				'separator' => 'after',
			]
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			'tab_button_hover',
			[
				'label'     => esc_html__( 'Hover', 'premiumpress-elementor' ),
				'condition' => [
					'color_source' => 'custom',
				],
			]
		);

		$this->add_control(
			'primary_color_hover',
			[
				'label'     => esc_html__( 'Primary Color', 'premiumpress-elementor' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}}.pptv9-social-share-buttons-style-flat .pptv9-social-share-button:hover,
					 {{WRAPPER}}.pptv9-social-share-buttons-style-gradient .pptv9-social-share-button:hover' => 'background-color: {{VALUE}}',
					'{{WRAPPER}}.pptv9-social-share-buttons-style-framed .pptv9-social-share-button:hover,
					 {{WRAPPER}}.pptv9-social-share-buttons-style-minimal .pptv9-social-share-button:hover,
					 {{WRAPPER}}.pptv9-social-share-buttons-style-boxed .pptv9-social-share-button:hover' => 'color: {{VALUE}}; border-color: {{VALUE}}',
					'{{WRAPPER}}.pptv9-social-share-buttons-style-boxed .pptv9-social-share-button:hover .pptv9-social-share-icon, 
					 {{WRAPPER}}.pptv9-social-share-buttons-style-minimal .pptv9-social-share-button:hover .pptv9-social-share-icon' => 'background-color: {{VALUE}}',
				],
				'condition' => [
					'color_source' => 'custom',
				],
			]
		);

		$this->add_control(
			'secondary_color_hover',
			[
				'label'     => esc_html__( 'Secondary Color', 'premiumpress-elementor' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}}.pptv9-social-share-buttons-style-flat .pptv9-social-share-button:hover .pptv9-social-share-icon, 
					 {{WRAPPER}}.pptv9-social-share-buttons-style-flat .pptv9-social-share-button:hover .pptv9-social-share-text, 
					 {{WRAPPER}}.pptv9-social-share-buttons-style-gradient .pptv9-social-share-button:hover .pptv9-social-share-icon,
					 {{WRAPPER}}.pptv9-social-share-buttons-style-gradient .pptv9-social-share-button:hover .pptv9-social-share-text,
					 {{WRAPPER}}.pptv9-social-share-buttons-style-boxed .pptv9-social-share-button:hover .pptv9-social-share-icon,
					 {{WRAPPER}}.pptv9-social-share-buttons-style-minimal .pptv9-social-share-button:hover .pptv9-social-share-icon' => 'color: {{VALUE}}',
				],
				'condition' => [
					'color_source' => 'custom',
				],
				'separator' => 'after',
			]
		);

		$this->end_controls_tab();

		$this->end_controls_tabs();

		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name'     => 'typography',
				'label'    => esc_html__( 'Typography', 'premiumpress-elementor' ),
				'selector' => '{{WRAPPER}} .pptv9-social-share-title, {{WRAPPER}} .pptv9-social-share-button-counter',
				'exclude'  => [ 'line_height' ],
			]
		);

		$this->add_control(
			'text_padding',
			[
				'label'      => esc_html__( 'Text Padding', 'premiumpress-elementor' ),
				'type'       => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors'  => [
					'{{WRAPPER}} a.elementor-button' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
				'separator' => 'before',
				'condition' => [
					'view' => 'text',
				],
			]
		);

		$this->end_controls_section();
	}

	private function has_counter( $media_name ) {
		$settings = $this->get_active_settings();

		return 'icon' !== $settings['view'] && 'yes' === $settings['show_counter'] && ! empty( Module::get_social_media( $media_name )['has_counter'] );
	}
	
	public function render() {

		$settings  = $this->get_active_settings();

		if ( empty( $settings['share_buttons'] ) ) {
			return;
		}

		$show_text = 'text' === $settings['view'] ||  $settings['show_label'];
		?>
		<div class="pptv9-social-share pptv9-ep-grid">
			<?php
			foreach ( $settings['share_buttons'] as $button ) {
				$social_name = $button['button'];
				$has_counter = $this->has_counter( $social_name );

				if ( 'custom' === $settings['share_url_type'] ) {
					$this->add_render_attribute( 'social-attrs', 'data-url', esc_url( $settings['share_url']['url'] ), true );
				}

				$this->add_render_attribute(
					[
						'social-attrs' => [
							'class' => [
								'pptv9-social-share-button',
								'pptv9-social-share-button-' . $social_name
							],
							'data-social' => $social_name,
						]
					], '', '', true
				);

				?>
				<div class="pptv9-social-share-item pptv9-ep-grid-item">
					<div <?php echo $this->get_render_attribute_string( 'social-attrs' ); ?>>
						<?php if ( 'icon' === $settings['view'] || 'icon-text' === $settings['view'] ) : ?>
							<span class="pptv9-social-share-icon">
								<i class="<?php echo self::get_social_media_class( $social_name ); ?>"></i>
							</span>
						<?php endif; ?>
						<?php if ( $show_text || $has_counter ) : ?>
							<div class="pptv9-social-share-text pptv9-inline">
								<?php if ( 'yes' === $settings['show_label'] || 'text' === $settings['view'] ) : ?>
									<span class="pptv9-social-share-title">
										<?php echo $button['text'] ? $button['text'] : Module::get_social_media( $social_name )['title']; ?>
									</span>
								<?php endif; ?>
								<?php if ( $has_counter ) : ?>
									<span class="pptv9-social-share-counter" data-counter="<?php echo $social_name; ?>"></span>
								<?php endif; ?>
							</div>
						<?php endif; ?>
					</div>
				</div>
				<?php
			}
			?>
		</div>

		
		<?php

		
	}

	
}
