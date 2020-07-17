<?php
class ep_menu_walker extends \Walker_Nav_Menu {
    var $has_child = false;
    public function start_lvl(&$output, $depth = 0, $args = array()) {      
        $output .= '<div class="pptv9-navbar-dropdown"><ul class="pptv9-nav pptv9-navbar-dropdown-nav">';
    }

    public function end_lvl(&$output, $depth = 0, $args = array()) {
        $output .= '</ul></div>';
    }

    public function start_el(&$output, $item, $depth = 0, $args = array(), $id = 0) {
        $data    = array();
        $class   = '';
        $classes = empty($item->classes) ? array() : (array) $item->classes;
        if($classes) {
            $class = trim(preg_replace('/menu-item(.+)/', '', implode(' ', $classes)));
        }
        //new class
        $classes = array();
        $data['style'] = '';

        if($args->walker->has_children){
            $classes[] =' pptv9-parent';
        }
       
        if($item->current || $item->current_item_parent || $item->current_item_ancestor) {
            $classes[] = ' pptv9-active';
        }
        if($item->dropdown_child && $depth > 0) {
            $classes[] = ' sub-dropdown';
        }
        // set id
        $data['data-id'] = $item->ID;

        // is current item ?
        if (in_array('current-menu-item', $classes) || in_array('current_page_item', $classes)) {
            $data['data-menu-active'] = 2;

        // home/frontpage item
        } elseif (preg_replace('/#(.+)$/', '', $item->url) == 'index.php' && (is_home() || is_front_page())) {
            $data['data-menu-active'] = 2;
        }      
        if($item->full_width){
              $data['full_width'] = $item->full_width;
        } elseif($item->style_position) {
            if ($item->style_position == 'bottom-left') {
                $data_uk_dropdown = (is_rtl()) ? 'bottom-right' : 'bottom-left';  
            } elseif ($item->style_position == 'bottom-right') {
                $data_uk_dropdown = (is_rtl()) ? 'bottom-left' : 'bottom-right';  
            } else {
                $data_uk_dropdown = $item->style_position;
            }
            $data['dropdown_style'] =  ($data_uk_dropdown);     
        }
        $attributes = '';
        foreach ($data as $name => $value) {      
            $attributes .= sprintf(' %s="%s"', $name, $value);
        }
        
        // create item output
        $id = apply_filters('nav_menu_item_id', '', $item, $args);
       
        if($classes) {
            $class .= implode(' ', $classes);                    
        }
        if($class) {
           $class = ' class="'.$class.'"';
        } else {
            $class = '';
        }  

        $output .= '<li'.(strlen($id) ? sprintf(' id="%s"', esc_attr($id)) : '').$attributes . $class.'>';

        // set link attributes
        $attributes = '';
        foreach (array('attr_title' => 'title', 'target' => 'target', 'xfn' => 'rel', 'url' => 'href') as $var => $attr) {
            if (!empty($item->$var)) {
                $attributes .= sprintf(' %s="%s"', $attr, $item->$var);
            }
        }

        // escape link title
        $item->title = $item->title; //htmlspecialchars($item->title, ENT_COMPAT, "UTF-8");
        $classes     = trim(preg_replace('/menu-item(.+)/', '', implode(' ', $classes)));
        
        // is separator ?
        if ($item->url == '#') {
            $isline = preg_match("/^\s*\-+\s*$/", $item->title);

            $type = "header";
            if ($isline) {
                $type = 'separator-line';
            } elseif ($item->hasChildren) {
                $type = 'separator-text';
            }

            $format     = '%s<a href="#" %s>%s</a>%s';
            $classes    = ' seperator';
            $attributes = ' class="'.$classes.'" data-type="'.$type.'"';
        } else {
            $format = '%s<a%s>%s</a>%s';
        }

        // create link output
        $item_output = sprintf($format, $args->before, $attributes, $args->link_before.apply_filters('the_title', $item->title, $item->ID).$args->link_after, $args->after);

        $output .= apply_filters('walker_nav_menu_start_el', $item_output, $item, $depth, $args);
    }

    public function end_el(&$output, $item, $depth = 0, $args = array(), $id = 0) {
        $output .= '</li>';
    }

    function display_element ($element, &$children_elements, $max_depth, $depth = 0, $args, &$output) {
        // attach to element so that it's available in start_el()
        $element->hasChildren = isset($children_elements[$element->ID]) && !empty($children_elements[$element->ID]);
        return parent::display_element($element, $children_elements, $max_depth, $depth, $args, $output);
    }
}
class Widget_PremiumPress_Menubar extends \Elementor\Widget_Base {

	public function get_name() {
		return 'pptv9-navbar';
	}

	public function get_title() {
		return '{ Menu Bar }';
	}

	public function get_icon() {
		return 'layout-menu';
	}

	public function get_categories() {
		return [ 'premiumpress-header' ];
	}

	public function get_keywords() {
		return [ 'navbar', 'menu' ];
	}

	protected function _register_controls() {
		
		$this->start_controls_section(
			'section_navbar_content',
			[
				'label' => esc_html__( 'Navbar', 'ppremiumpress-elementor' ),
			]
		);

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
			'align',
			[
				'label'   => esc_html__( 'Alignment', 'ppremiumpress-elementor' ),
				'type'    => \Elementor\Controls_Manager::CHOOSE,
				'options' => [
					'flex-start' => [
						'title' => esc_html__( 'Left', 'ppremiumpress-elementor' ),
						'icon'  => 'eicon-h-align-left',
					],
					'center' => [
						'title' => esc_html__( 'Center', 'ppremiumpress-elementor' ),
						'icon'  => 'eicon-h-align-center',
					],
					'flex-end'  => [
						'title' => esc_html__( 'Right', 'ppremiumpress-elementor' ),
						'icon'  => 'eicon-h-align-right',
					],
				],
				'selectors' => [
					'{{WRAPPER}} .pptv9-navbar-container' => 'justify-content: {{VALUE}};',
				],
			]
		);

		$this->add_responsive_control(
			'menu_offset',
			[
				'label' => esc_html__( 'Offset', 'ppremiumpress-elementor' ),
				'type'  => \Elementor\Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'min' => -150,
						'max' => 150,
					],
				],
				'size_units' => [ 'px' ],
				'selectors'  => [
					'{{WRAPPER}} .pptv9-navbar-nav' => 'transform: translateX({{SIZE}}{{UNIT}});',
				],
			]
		);

		$this->add_responsive_control(
			'text_padding',
			[
				'label'      => esc_html__( 'Padding', 'ppremiumpress-elementor' ),
				'type'       => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors'  => [
					'{{WRAPPER}} .pptv9-navbar-nav > li > a' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'menu_height',
			[
				'label' => esc_html__( 'Menu Height', 'ppremiumpress-elementor' ),
				'type'  => \Elementor\Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'min' => 20,
						'max' => 150,
					],
				],
				'size_units' => [ 'px'],
				'selectors'  => [
					'{{WRAPPER}} .pptv9-navbar-nav > li > a' => 'min-height: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			'menu_parent_arrow',
			[
				'label'        => __( 'Parent Indicator', 'ppremiumpress-elementor' ),
				'type'         => \Elementor\Controls_Manager::SWITCHER,
				'prefix_class' => 'pptv9-navbar-parent-indicator-',
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'dropdown_content',
			[
				'label' => esc_html__( 'Dropdown', 'ppremiumpress-elementor' ),
			]
		);

		$this->add_responsive_control(
			'dropdown_align',
			[
				'label'     => esc_html__( 'Dropdown Alignment', 'ppremiumpress-elementor' ),
				'type'      => \Elementor\Controls_Manager::CHOOSE,
				'options'   => [
					'left'   => [
						'title' => esc_html__( 'Left', 'ppremiumpress-elementor' ),
						'icon'  => 'eicon-h-align-left',
					],
					'center' => [
						'title' => esc_html__( 'Center', 'ppremiumpress-elementor' ),
						'icon'  => 'eicon-h-align-center',
					],
					'right'  => [
						'title' => esc_html__( 'Right', 'ppremiumpress-elementor' ),
						'icon'  => 'eicon-h-align-right',
					],
				],
			]
		);

		$this->add_responsive_control(
			'dropdown_link_align',
			[
				'label'   => esc_html__( 'Item Alignment', 'ppremiumpress-elementor' ),
				'type'    => \Elementor\Controls_Manager::CHOOSE,
				'options' => [
					'left' => [
						'title' => esc_html__( 'Left', 'ppremiumpress-elementor' ),
						'icon'  => 'fa fa-align-left',
					],
					'center' => [
						'title' => esc_html__( 'Center', 'ppremiumpress-elementor' ),
						'icon'  => 'fa fa-align-center',
					],
					'right' => [
						'title' => esc_html__( 'Right', 'ppremiumpress-elementor' ),
						'icon'  => 'fa fa-align-right',
					],
				],
				'selectors' => [
					'{{WRAPPER}} .pptv9-navbar-dropdown-nav > li > a' => 'text-align: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'dropdown_padding',
			[
				'label'      => esc_html__( 'Dropdown Padding', 'ppremiumpress-elementor' ),
				'type'       => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%' ],
				'selectors'  => [
					'{{WRAPPER}} .pptv9-navbar-dropdown' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'dropdown_width',
			[
				'label' => esc_html__( 'Dropdown Width', 'ppremiumpress-elementor' ),
				'type'  => \Elementor\Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'min' => 150,
						'max' => 350,
					],
				],
				'size_units' => [ 'px'],
				'selectors'  => [
					'{{WRAPPER}} .pptv9-navbar-dropdown' => 'width: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'dropdown_additional',
			[
				'label' => esc_html__( 'Additional', 'ppremiumpress-elementor' ),
			]
		);

		$this->add_control(
			'dropdown_delay_show',
			[
				'label' => esc_html__( 'Delay Show', 'ppremiumpress-elementor' ),
				'type'  => \Elementor\Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 2000,
					],
				],
			]
		);

		$this->add_control(
			'dropdown_delay_hide',
			[
				'label' => esc_html__( 'Delay Hide', 'ppremiumpress-elementor' ),
				'type'  => \Elementor\Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 2000,
					],
				],
				'default' => ['size' => 800],
			]
		);

		$this->add_control(
			'dropdown_duration',
			[
				'label' => esc_html__( 'Dropdown Duration', 'ppremiumpress-elementor' ),
				'type'  => \Elementor\Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 2000,
					],
				],
				'default' => ['size' => 200],
			]
		);

		$this->add_control(
			'dropdown_offset',
			[
				'label' => esc_html__( 'Dropdown Offset', 'ppremiumpress-elementor' ),
				'type'  => \Elementor\Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 200,
					],
				],
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_menu_style',
			[
				'label' => esc_html__( 'Navbar', 'ppremiumpress-elementor' ),
				'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'navbar_style',
			[
				'label'   => __( 'Navbar Style', 'ppremiumpress-elementor' ),
				'type'    => \Elementor\Controls_Manager::SELECT,
				'default' => '',
				'options' => [
					''  => __( 'Select Style', 'ppremiumpress-elementor' ),
					'1' => __( 'Style 1', 'ppremiumpress-elementor' ),
					'2' => __( 'Style 2', 'ppremiumpress-elementor' ),
					'3' => __( 'Style 3', 'ppremiumpress-elementor' ),
				],
				'prefix_class' => 'pptv9-navbar-style-',
			]
		);

		$this->start_controls_tabs( 'menu_link_styles' );

		$this->start_controls_tab( 'menu_link_normal', [ 'label' => esc_html__( 'Normal', 'ppremiumpress-elementor' ) ] );

		$this->add_control(
			'menu_link_color',
			[
				'label'     => esc_html__( 'Color', 'ppremiumpress-elementor' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .pptv9-navbar-nav > li > a' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'menu_link_background',
			[
				'label'     => esc_html__( 'Background', 'ppremiumpress-elementor' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .pptv9-navbar-nav > li > a' => 'background-color: {{VALUE}};',
				],
			]
		);

		$this->add_responsive_control(
			'menu_spacing',
			[
				'label' => esc_html__( 'Gap', 'ppremiumpress-elementor' ),
				'type'  => \Elementor\Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 25,
					],
				],
				'size_units' => [ 'px'],
				'selectors'  => [
					'{{WRAPPER}} .pptv9-navbar-nav' => 'margin-left: -{{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .pptv9-navbar-nav > li' => 'margin-left: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Border::get_type(),
			[
				'name'     => 'menu_border',
				'label'    => esc_html__( 'Border', 'ppremiumpress-elementor' ),
				'default'  => '1px',
				'selector' => '{{WRAPPER}} .pptv9-navbar-nav > li > a',
			]
		);

		$this->add_control(
			'menu_border_radius',
			[
				'label'      => esc_html__( 'Border Radius', 'ppremiumpress-elementor' ),
				'type'       => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%' ],
				'selectors'  => [
					'{{WRAPPER}} .pptv9-navbar-nav > li > a' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name'     => 'menu_typography_normal',
				'label'    => esc_html__( 'Typography', 'ppremiumpress-elementor' ),
				'scheme'   => \Elementor\Scheme_Typography::TYPOGRAPHY_1,
				'selector' => '{{WRAPPER}} .pptv9-navbar-nav > li > a',
			]
		);

		$this->add_control(
			'menu_parent_arrow_color',
			[
				'label'     => esc_html__( 'Parent Indicator Color', 'ppremiumpress-elementor' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}}.pptv9-navbar-parent-indicator-yes .pptv9-navbar-nav > li.pptv9-parent a:after' => 'color: {{VALUE}};',
				],
				'condition' => ['menu_parent_arrow' => 'yes'],
			]
		);

		$this->end_controls_tab();

		$this->start_controls_tab( 'menu_link_hover', [ 'label' => esc_html__( 'Hover', 'ppremiumpress-elementor' ) ] );

		$this->add_control(
			'navbar_hover_style_color',
			[
				'label'     => esc_html__( 'Style Color', 'ppremiumpress-elementor' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .pptv9-navbar-nav > li:hover > a:before' => 'background-color: {{VALUE}};',
					'{{WRAPPER}} .pptv9-navbar-nav > li:hover > a:after'  => 'background-color: {{VALUE}};',
				],
				'condition' => [
					'navbar_style!' => '',
				],
			]
		);

		$this->add_control(
			'menu_link_color_hover',
			[
				'label'     => esc_html__( 'Color', 'ppremiumpress-elementor' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .pptv9-navbar-nav > li > a:hover' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'link_background_hover',
			[
				'label'     => esc_html__( 'Background Color', 'ppremiumpress-elementor' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .pptv9-navbar-nav > li > a:hover' => 'background-color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'menu_border_color_hover',
			[
				'label'     => esc_html__( 'Border Color', 'ppremiumpress-elementor' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .pptv9-navbar-nav > li > a:hover' => 'border-color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'menu_border_radius_hover',
			[
				'label'      => esc_html__( 'Border Radius', 'ppremiumpress-elementor' ),
				'type'       => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%' ],
				'selectors'  => [
					'{{WRAPPER}} .pptv9-navbar-nav > li > a:hover' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name'     => 'menu_typography_hover',
				'label'    => esc_html__( 'Typography', 'ppremiumpress-elementor' ),
				'scheme'   => \Elementor\Scheme_Typography::TYPOGRAPHY_1,
				'selector' => '{{WRAPPER}} .pptv9-navbar-nav > li > a:hover',
			]
		);

		$this->add_control(
			'menu_parent_arrow_color_hover',
			[
				'label'     => esc_html__( 'Parent Indicator Color', 'ppremiumpress-elementor' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}}.pptv9-navbar-parent-indicator-yes .pptv9-navbar-nav > li.pptv9-parent a:hover::after' => 'color: {{VALUE}};',
				],
				'condition' => ['menu_parent_arrow' => 'yes'],
			]
		);


		$this->end_controls_tab();

		$this->start_controls_tab( 'menu_link_active', [ 'label' => esc_html__( 'Active', 'ppremiumpress-elementor' ) ] );

		$this->add_control(
			'navbar_active_style_color',
			[
				'label'     => esc_html__( 'Style Color', 'ppremiumpress-elementor' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .pptv9-navbar-nav > li.pptv9-active > a:before' => 'background-color: {{VALUE}};',
					'{{WRAPPER}} .pptv9-navbar-nav > li.pptv9-active > a:after'  => 'background-color: {{VALUE}};',
				],
				'condition' => [
					'navbar_style!' => '',
				],
			]
		);

		$this->add_control(
			'menu_hover_color_active',
			[
				'label'     => esc_html__( 'Color', 'ppremiumpress-elementor' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .pptv9-navbar-nav > li.pptv9-active > a' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'menu_hover_background_color_active',
			[
				'label'     => esc_html__( 'Background', 'ppremiumpress-elementor' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .pptv9-navbar-nav > li.pptv9-active > a' => 'background-color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Border::get_type(),
			[
				'name'     => 'menu_border_active',
				'label'    => esc_html__( 'Border', 'ppremiumpress-elementor' ),
				'default'  => '1px',
				'selector' => '{{WRAPPER}} .pptv9-navbar-nav > li.pptv9-active > a',
			]
		);

		$this->add_control(
			'menu_border_radius_active',
			[
				'label'      => esc_html__( 'Border Radius', 'ppremiumpress-elementor' ),
				'type'       => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%' ],
				'selectors'  => [
					'{{WRAPPER}} .pptv9-navbar-nav > li.pptv9-active > a' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name'     => 'menu_typography_active',
				'label'    => esc_html__( 'Typography', 'ppremiumpress-elementor' ),
				'scheme'   => \Elementor\Scheme_Typography::TYPOGRAPHY_1,
				'selector' => '{{WRAPPER}} .pptv9-navbar-nav > li.pptv9-active > a',
			]
		);

		$this->add_control(
			'menu_parent_arrow_color_active',
			[
				'label'     => esc_html__( 'Parent Indicator Color', 'ppremiumpress-elementor' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}}.pptv9-navbar-parent-indicator-yes .pptv9-navbar-nav > li.pptv9-parent.pptv9-active a:after' => 'color: {{VALUE}};',
				],
				'condition' => ['menu_parent_arrow' => 'yes'],
			]
		);

		$this->end_controls_tab();

		$this->end_controls_tabs();

		$this->end_controls_section();

		$this->start_controls_section(
			'dropdown_color',
			[
				'label' => esc_html__( 'Dropdown', 'ppremiumpress-elementor' ),
				'type'  => \Elementor\Controls_Manager::SECTION,
				'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'dropdown_background',
			[
				'label'     => esc_html__( 'Dropdown Background', 'ppremiumpress-elementor' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .pptv9-navbar-dropdown' => 'background-color: {{VALUE}};',
				],
			]
		);

		$this->start_controls_tabs( 'dropdown_link_styles' );

		$this->start_controls_tab( 'dropdown_link_normal', [ 'label' => esc_html__( 'Normal', 'ppremiumpress-elementor' ) ] );

		$this->add_control(
			'dropdown_link_color',
			[
				'label'     => esc_html__( 'Color', 'ppremiumpress-elementor' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .pptv9-navbar-dropdown-nav > li > a' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'dropdown_link_background',
			[
				'label'     => esc_html__( 'Background', 'ppremiumpress-elementor' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .pptv9-navbar-dropdown-nav > li > a' => 'background-color: {{VALUE}};',
				],
			]
		);

		$this->add_responsive_control(
			'dropdown_link_spacing',
			[
				'label' => esc_html__( 'Gap', 'ppremiumpress-elementor' ),
				'type'  => \Elementor\Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 25,
					],
				],
				'size_units' => [ 'px'],
				'selectors'  => [
					'{{WRAPPER}} .pptv9-navbar-dropdown-nav > li + li' => 'margin-top: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			'dropdown_link_padding',
			[
				'label'      => esc_html__( 'Padding', 'ppremiumpress-elementor' ),
				'type'       => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors'  => [
					'{{WRAPPER}} .pptv9-navbar-dropdown-nav > li > a' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Border::get_type(),
			[
				'name'     => 'dropdown_link_border',
				'label'    => esc_html__( 'Border', 'ppremiumpress-elementor' ),
				'default'  => '1px',
				'selector' => '{{WRAPPER}} .pptv9-navbar-dropdown-nav > li > a',
			]
		);

		$this->add_control(
			'dropdown_link_radius',
			[
				'label'      => esc_html__( 'Border Radius', 'ppremiumpress-elementor' ),
				'type'       => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%' ],
				'selectors'  => [
					'{{WRAPPER}} .pptv9-navbar-dropdown-nav > li > a' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name'     => 'dropdown_link_typography',
				'label'    => esc_html__( 'Typography', 'ppremiumpress-elementor' ),
				'scheme'   => \Elementor\Scheme_Typography::TYPOGRAPHY_1,
				'selector' => '{{WRAPPER}} .pptv9-navbar-dropdown-nav > li > a',
			]
		);

		$this->add_control(
			'dropdown_parent_arrow_color',
			[
				'label'     => esc_html__( 'Parent Indicator Color', 'ppremiumpress-elementor' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}}.pptv9-navbar-parent-indicator-yes .pptv9-navbar-dropdown-nav > li.pptv9-parent a:after' => 'color: {{VALUE}};',
				],
				'condition' => ['menu_parent_arrow' => 'yes'],
			]
		);

		$this->end_controls_tab();

		$this->start_controls_tab( 'dropdown_link_hover', [ 'label' => esc_html__( 'Hover', 'ppremiumpress-elementor' ) ] );

		$this->add_control(
			'dropdown_link_hover_color',
			[
				'label'     => esc_html__( 'Color', 'ppremiumpress-elementor' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .pptv9-navbar-dropdown-nav > li > a:hover' => 'color: {{VALUE}};',
				],
			]
		);


		$this->add_control(
			'dropdown_link_hover_bg_color',
			[
				'label'     => esc_html__( 'Background Color', 'ppremiumpress-elementor' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .pptv9-navbar-dropdown-nav > li > a:hover' => 'background-color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'dropdown_border_hover_color',
			[
				'label'     => esc_html__( 'Border Color', 'ppremiumpress-elementor' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .pptv9-navbar-dropdown-nav > li > a:hover' => 'border-color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'dropdown_radius_hover',
			[
				'label'      => esc_html__( 'Border Radius', 'ppremiumpress-elementor' ),
				'type'       => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%' ],
				'selectors'  => [
					'{{WRAPPER}} .pptv9-navbar-dropdown-nav > li > a:hover' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name'     => 'dropdown_typography_hover',
				'label'    => esc_html__( 'Typography', 'ppremiumpress-elementor' ),
				'scheme'   => \Elementor\Scheme_Typography::TYPOGRAPHY_1,
				'selector' => '{{WRAPPER}} .pptv9-navbar-dropdown-nav > li > a:hover',
			]
		);

		$this->add_control(
			'dropdown_parent_arrow_color_hover',
			[
				'label'     => esc_html__( 'Parent Indicator Color', 'ppremiumpress-elementor' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}}.pptv9-navbar-parent-indicator-yes .pptv9-navbar-dropdown-nav > li.pptv9-parent a:hover::after' => 'color: {{VALUE}};',
				],
				'condition' => ['menu_parent_arrow' => 'yes'],
			]
		);

		$this->end_controls_tab();

		$this->start_controls_tab( 'dropdown_link_active', [ 'label' => esc_html__( 'Active', 'ppremiumpress-elementor' ) ] );

			$this->add_control(
				'dropdown_active_color',
				[
					'label'     => esc_html__( 'Color', 'ppremiumpress-elementor' ),
					'type'      => \Elementor\Controls_Manager::COLOR,
					'selectors' => [
						'{{WRAPPER}} .pptv9-navbar-dropdown-nav > li.pptv9-active > a' => 'color: {{VALUE}};',
					],
				]
			);

			$this->add_control(
				'dropdown_active_bg_color',
				[
					'label'     => esc_html__( 'Background', 'ppremiumpress-elementor' ),
					'type'      => \Elementor\Controls_Manager::COLOR,
					'selectors' => [
						'{{WRAPPER}} .pptv9-navbar-dropdown-nav > li.pptv9-active > a' => 'background-color: {{VALUE}};',
					],
				]
			);

			$this->add_group_control(
				\Elementor\Group_Control_Border::get_type(),
				[
					'name'     => 'dropdown_active_border',
					'label'    => esc_html__( 'Border', 'ppremiumpress-elementor' ),
					'default'  => '1px',
					'selector' => '{{WRAPPER}} .pptv9-navbar-dropdown-nav > li.pptv9-active > a',
				]
			);

			$this->add_control(
				'dropdown_active_radius',
				[
					'label'      => esc_html__( 'Border Radius', 'ppremiumpress-elementor' ),
					'type'       => \Elementor\Controls_Manager::DIMENSIONS,
					'size_units' => [ 'px', '%' ],
					'selectors'  => [
						'{{WRAPPER}} .pptv9-navbar-dropdown-nav > li.pptv9-active > a' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					],
				]
			);
			$this->add_group_control(
				\Elementor\Group_Control_Typography::get_type(),
				[
					'name'     => 'dropdown_typography_active',
					'label'    => esc_html__( 'Typography', 'ppremiumpress-elementor' ),
					'scheme'   => \Elementor\Scheme_Typography::TYPOGRAPHY_1,
					'selector' => '{{WRAPPER}} .pptv9-navbar-dropdown-nav > li.pptv9-active > a',
				]
			);

			$this->add_control(
				'dropdown_parent_arrow_color_active',
				[
					'label'     => esc_html__( 'Parent Indicator Color', 'ppremiumpress-elementor' ),
					'type'      => \Elementor\Controls_Manager::COLOR,
					'selectors' => [
						'{{WRAPPER}}.pptv9-navbar-parent-indicator-yes .pptv9-navbar-dropdown-nav > li.pptv9-parent.pptv9-active a:after' => 'color: {{VALUE}};',
					],
					'condition' => ['menu_parent_arrow' => 'yes'],
				]
			);


		$this->end_controls_tab();

		$this->end_controls_tabs();

		$this->end_controls_section();
	}

	protected function render() {

		$settings = $this->get_settings();
		$id       = 'pptv9-navbar-' . $this->get_id();
		$nav_menu = ! empty( $settings['navbar'] ) ? wp_get_nav_menu_object( $settings['navbar'] ) : false;

		if ( ! $nav_menu ) {
			return;
		}

		$nav_menu_args = array(
			'fallback_cb'    => false,
			'container'      => false,
			'menu_id'        => 'pptv9-navmenu',
			'menu_class'     => 'pptv9-navbar-nav',
			'theme_location' => 'default_navmenu', // creating a fake location for better functional control
			'menu'           => $nav_menu,
			'echo'           => true,
			'depth'          => 0,
			'walker'        => new ep_menu_walker
		);

		$this->add_render_attribute(
			[
				'navbar-attr' => [
					'class' => [
						'pptv9-navbar-container',
						'pptv9-navbar',
						'pptv9-navbar-transparent'
					],
					'pptv9-navbar' => [
						wp_json_encode(array_filter([
							"align"      => $settings["dropdown_align"] ? $settings["dropdown_align"] : "left",
							"delay-show" => $settings["dropdown_delay_show"]["size"] ? $settings["dropdown_delay_show"]["size"] : false,
							"delay-hide" => $settings["dropdown_delay_hide"]["size"] ? $settings["dropdown_delay_hide"]["size"] : false,
							"offset"     => $settings["dropdown_offset"]["size"] ? $settings["dropdown_offset"]["size"] : false,
							"duration"   => $settings["dropdown_duration"]["size"] ? $settings["dropdown_duration"]["size"] : false
						]))
					]
				]
			]
		);

		?>
		<div id="<?php esc_attr($id); ?>" class="pptv9-navbar-wrapper">
			<nav <?php echo $this->get_render_attribute_string( 'navbar-attr' ); ?>>
				<?php wp_nav_menu( apply_filters( 'widget_nav_menu_args', $nav_menu_args, $nav_menu, $settings ) ); ?>
			</nav>
		</div>
		<?php
	}
}