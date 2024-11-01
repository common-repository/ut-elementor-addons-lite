<?php

namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) exit; 

class UT_Elementor_Addons_Lite_Widget_Nav_Menu extends Widget_Base {

    public function get_name()
    {
        return 'ut-nav-menu';
    }
    
    public function get_title()
    {

        return esc_html__( 'Nav Menu', 'ut-elementor-addons-lite' );
    }

    public function get_icon()
    {
        return 'eicon-nav-menu ut-widget-icon';
    }

    public function get_script_depends() {
        return [
            'ut-elementor-addons-lite-script',
        ];
    }

    public function get_categories()
    {

        return [ 'ut-elementor-addons-lite' ];
    }

    private function get_available_menus() {
        $ut_get_menu = wp_get_nav_menus();
        $options = [];
        foreach ( $ut_get_menu as $ut_menu_item ) {
            $options[ $ut_menu_item->slug ] = $ut_menu_item->name;
        }
        return $options;
    }

    protected function register_controls()
    {

        $this->start_controls_section(
            'ut_section_content',
            [
                'label' => esc_html__( 'Nav Menu', 'ut-elementor-addons-lite' ),
            ]
        );

        $ut_menu_functions = $this->get_available_menus();

        if ( ! empty( $ut_menu_functions ) ) {

            $this->add_control(
                'ut_navmenu',
                [
                    'label'   => esc_html__( 'Menu', 'ut-elementor-addons-lite' ),
                    'type'    => Controls_Manager::SELECT,
                    'options'               => $ut_menu_functions,
                    'default'               => array_keys($ut_menu_functions)[0],
                    'separator'             => 'after',
                    'description' => sprintf(__('Go to the <a href="%s" target="_blank">Menus screen</a> to manage your menus.', 'ut-elementor-addons-lite'), admin_url('nav-menus.php')),
                ]
            );
        } else {
            $this->add_control(
                'ut_menu_link',
                [
                    'type' => Controls_Manager::RAW_HTML,
                    'raw' => sprintf(__('<strong>There are no menus in your site.</strong><br>Go to the <a href="%s" target="_blank">Menus screen</a> to create one.', 'ut-elementor-addons-lite'), admin_url('nav-menus.php?action=edit&menu=0')),
                    'separator' => 'after',
                    'content_classes' => 'ut-addons-panel-alert ut-addons-panel-alert-info',
                ]
            );
        }

        $this->add_control(
            'ut_mobile_menu_style',
            [
                'label'   => esc_html__( 'Mobile Menu Style', 'ut-elementor-addons-lite' ),
                'type'    => Controls_Manager::SELECT,
                'options' => [
                    'default'  => esc_html__( 'Default', 'ut-elementor-addons-lite' ),
                    'hamburger' => esc_html__( 'Hamburger ', 'ut-elementor-addons-lite' ),
                ],
                'default' => 'default',
            ]
        );

        $this->add_responsive_control(
            'ut_nav_menu_align',
            [
                'label' => esc_html__( 'Alignment', 'ut-elementor-addons-lite' ),
                'type' => Controls_Manager::CHOOSE,
                'options' => [
                    'flex-start' => [
                        'title' => esc_html__( ' Left', 'ut-elementor-addons-lite' ),
                        'icon' => 'eicon-text-align-left',
                    ],
                    'center' => [
                        'title' => esc_html__( 'Center', 'ut-elementor-addons-lite' ),
                        'icon' => 'eicon-text-align-center',
                    ],
                    'flex-end' => [
                        'title' => esc_html__( 'Right', 'ut-elementor-addons-lite' ),
                        'icon' => 'eicon-text-align-right',
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .ut-custom-menu ul.custom-menu' => 'justify-content: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'layout',
            [
                'label'                 => esc_html__( 'Layout', 'ut-elementor-addons-lite' ),
                'type'                  => Controls_Manager::SELECT,
                'default'               => 'horizontal',
                'options'               => [
                    'horizontal' => esc_html__( 'Horizontal', 'ut-elementor-addons-lite' ),
                    'vertical' => esc_html__( 'Vertical', 'ut-elementor-addons-lite' ),
                ]
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'ut_section_style_main-menu',
            [
                'label' => esc_html__( 'Main Menu', 'ut-elementor-addons-lite' ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'ut_heading_menu_item',
            [
                'type' => Controls_Manager::HEADING,
                'label' => esc_html__( 'Menu Item', 'ut-elementor-addons-lite' ),
            ]
        );

        $this->start_controls_tabs( 'ut_tabs_menu_item_style' );

        $this->start_controls_tab(
            'ut_tab_menu_item_normal',
            [
                'label' => esc_html__( 'Normal', 'ut-elementor-addons-lite' ),
            ]
        );

        $this->add_responsive_control(
            'ut_color_menu_item',
            [
                'label'                 => esc_html__( 'Text Color', 'ut-elementor-addons-lite' ),
                'type'                  => Controls_Manager::COLOR,
                'selectors'             => [
                    '{{WRAPPER}} .ut-custom-menu .menu-item a,{{WRAPPER}} .menu-item-has-children::after' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_responsive_control(
            'ut_nav_menu_background_normal',
            [
                'label'     => esc_html__( 'Background Color', 'ut-elementor-addons-lite' ),
                'type'      => Controls_Manager::COLOR,
                'separator' => 'after',
                'selectors' => [
                    '{{WRAPPER}} .ut-custom-menu .menu-item a,{{WRAPPER}} .menu-item-has-children::after' => 'background-color: {{VALUE}}',
                ]
            ]
        );

        $this->end_controls_tab();

        $this->start_controls_tab(
            'ut_tab_menu_item_hover',
            [
                'label' => esc_html__( 'Hover', 'ut-elementor-addons-lite' ),
            ]
        );

        $this->add_responsive_control(
            'ut_color_menu_item_hover',
            [
                'label'                 => esc_html__( 'Text Color', 'ut-elementor-addons-lite' ),
                'type'                  => Controls_Manager::COLOR,
                'selectors'             => [
                    '{{WRAPPER}} .ut-custom-menu .menu-item:hover > a,
                    {{WRAPPER}} .ut-custom-menu .menu-item:focus > a, 
                    {{WRAPPER}} .menu-item-has-children:hover::after' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_responsive_control(
            'ut_nav_menu_background_hover',
            [
                'label'     => esc_html__( 'Background Color', 'ut-elementor-addons-lite' ),
                'type'      => Controls_Manager::COLOR,
                'separator' => 'after',
                'selectors' => [
                    '{{WRAPPER}} .ut-custom-menu .menu-item:hover > a,
                    {{WRAPPER}} .ut-custom-menu .menu-item:focus > a, 
                    {{WRAPPER}} .menu-item-has-children:hover::after' => 'background-color: {{VALUE}}',
                ]
            ]
        );

        $this->end_controls_tab();

        $this->start_controls_tab(
            'ut_tab_menu_item_active',
            [
                'label' => esc_html__( 'Active', 'ut-elementor-addons-lite' ),
            ]
        );

        $this->add_responsive_control(
            'ut_color_menu_item_active',
            [
                'label'                 => esc_html__( 'Text Color', 'ut-elementor-addons-lite' ),
                'type'                  => Controls_Manager::COLOR,
                'selectors'             => [
                    '{{WRAPPER}} .ut-custom-menu .menu-item.current-menu-item > a' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_responsive_control(
            'ut_nav_menu_background_active',
            [
                'label'     => esc_html__( 'Background Color', 'ut-elementor-addons-lite' ),
                'type'      => Controls_Manager::COLOR,
                'separator' => 'after',
                'selectors' => [
                    '{{WRAPPER}} .ut-custom-menu .menu-item.current-menu-item > a' => 'background-color: {{VALUE}};'
                ]
            ]
        );

        $this->end_controls_tab();

        $this->end_controls_tabs();

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'                  => 'ut_menu_typography',
                'scheme'                => Core\Schemes\Typography::TYPOGRAPHY_1,
                'separator'             => 'before',
                'selector'              => '{{WRAPPER}} .ut-custom-menu .menu-item',
            ]
        );

        $this->add_responsive_control(
            'ut_nav_menu_padding',
            [
                'label'        => esc_html__( 'Padding', 'ut-elementor-addons-lite' ),
                'type'         => Controls_Manager::DIMENSIONS,
                'size_units'   => [ 'px', '%' ],
                'selectors'    => [
                    '{{WRAPPER}} .ut-custom-menu .menu-item a' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
                ],
            ]
        );

        $this->add_responsive_control(
            'ut_nav_menu_column_gap',
            [
                'label'        => esc_html__( 'Space Between Items', 'ut-elementor-addons-lite' ),
                'type'         => Controls_Manager::SLIDER,
                'size_units'   => [ 'px', '%' ],
                'selectors'    => [
                    '{{WRAPPER}} .ut-custom-menu ul.custom-menu' => 'gap: {{SIZE}}{{UNIT}};'
                ],
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'ut_section_style_sub-menu',
            [
                'label'                 => esc_html__( 'Sub Menu', 'ut-elementor-addons-lite' ),
                'tab'                   => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'ut_sub_menu_item',
            [
                'type'                  => Controls_Manager::HEADING,
                'label'                 => esc_html__( 'Sub Menu Item', 'ut-elementor-addons-lite' ),
            ]
        );

        $this->start_controls_tabs('ut_tabs_submenu_item_style');

        $this->start_controls_tab(
            'ut_tab_submenu_item_normal',
            [
                'label'                 => esc_html__( 'Normal', 'ut-elementor-addons-lite' ),
            ]
        );

        $this->add_responsive_control(
            'ut_bgcolor_submenu_item',
            [
                'label'                 => esc_html__( 'Background Color', 'ut-elementor-addons-lite' ),
                'type'                  => Controls_Manager::COLOR,
                'scheme'                => [
                    'type'     => Core\Schemes\Color::get_type(),
                    'value'    => Core\Schemes\Color::COLOR_3,
                ],
                'default'               => '#000000',
                'selectors'             => [
                    '{{WRAPPER}} .submenus .sub-menu .menu-item a' => 'background-color: {{VALUE}}',
                ],
            ]
        );

        $this->add_responsive_control(
            'ut_color_submenu_item',
            [
                'label'                 => esc_html__( 'Text Color', 'ut-elementor-addons-lite' ),
                'type'                  => Controls_Manager::COLOR,
                'scheme'                => [
                    'type'     => Core\Schemes\Color::get_type(),
                    'value'    => Core\Schemes\Color::COLOR_3,
                ],
                'default'               => '#FFFFFF',
                'selectors'             => [
                    '{{WRAPPER}} .ut-custom-menu .sub-menu .menu-item a,{{WRAPPER}} ul.sub-menu .menu-item-has-children::after' => 'color: {{VALUE}}',
                ],
                'separator' => 'after',
            ]
        );

        $this->end_controls_tab();

        $this->start_controls_tab(
            'ut_tab_submenu_item_hover',
            [
                'label'                 => esc_html__( 'Hover', 'ut-elementor-addons-lite' ),
            ]
        );

        $this->add_responsive_control(
            'ut_bgcolor_submenu_item_hover',
            [
                'label'                 => esc_html__( 'Background Color', 'ut-elementor-addons-lite' ),
                'type'                  => Controls_Manager::COLOR,
                'scheme'                => [
                    'type'     => Core\Schemes\Color::get_type(),
                    'value'    => Core\Schemes\Color::COLOR_4,
                ],
                'default'               => '#61CE70',
                'selectors'             => [
                    '{{WRAPPER}} .submenus .sub-menu .menu-item:hover > a,{{WRAPPER}} ul.sub-menu .menu-item-has-children:hover::after' => 'background-color: {{VALUE}}',
                ],
            ]
        );

        $this->add_responsive_control(
            'ut_color_submenu_item_hover',
            [
                'label'                 => esc_html__( 'Text Color', 'ut-elementor-addons-lite' ),
                'type'                  => Controls_Manager::COLOR,
                'scheme'                => [
                    'type'     => Core\Schemes\Color::get_type(),
                    'value'    => Core\Schemes\Color::COLOR_4,
                ],
                'default'               => '#FFFFFF',
                'selectors'             => [
                    '{{WRAPPER}} .ut-custom-menu .sub-menu .menu-item:hover > a,{{WRAPPER}} ul.sub-menu .menu-item-has-children:hover::after' => 'color: {{VALUE}} !important',
                ],
                'separator' => 'after',
            ]
        );

        $this->end_controls_tab();

        $this->start_controls_tab(
            'ut_tab_submenu_item_active',
            [
                'label' => esc_html__( 'Active', 'ut-elementor-addons-lite' ),
            ]
        );

        $this->add_responsive_control(
            'ut_bgcolor_submenu_item_active',
            [
                'label'                 => esc_html__( 'Background Color', 'ut-elementor-addons-lite' ),
                'type'                  => Controls_Manager::COLOR,
                'selectors'             => [
                    '{{WRAPPER}} .submenus .sub-menu .menu-item.current-menu-item > a' => 'background-color: {{VALUE}}',
                ],
            ]
        );

        $this->add_responsive_control(
            'ut_color_submenu_item_active',
            [
                'label'                 => esc_html__( 'Text Color', 'ut-elementor-addons-lite' ),
                'type'                  => Controls_Manager::COLOR,
                'selectors'             => [
                    '{{WRAPPER}} .ut-custom-menu .sub-menu .menu-item.current-menu-item > a,{{WRAPPER}} ul.sub-menu .menu-item-has-children.current-menu-item::after' => 'color: {{VALUE}}',
                ],
                'separator' => 'after',
            ]
        );

        $this->end_controls_tab();

        $this->end_controls_tabs();

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'                  => 'ut_submenu_typography',
                'scheme'                => Core\Schemes\Typography::TYPOGRAPHY_1,
                'separator'             => 'before',
                'selector'              => '{{WRAPPER}} .ut-custom-menu .sub-menu .menu-item a',
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name'              => 'ut_submenu_item_border',
                'label'             =>  esc_html__( 'Submenu Item Border', 'ut-elementor-addons-lite' ),
                'selector'          => '{{WRAPPER}} .ut-custom-menu ul.sub-menu li:not(:last-child) a',
            ]
        );

        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name' => 'ut_submenu_background',
                'label' => esc_html__( 'Background', 'ut-elementor-addons-lite' ),
                'types' => ['classic', 'gradient'],
                'selector' => '{{WRAPPER}} .ut-custom-menu .sub-menu',
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name'              => 'ut_submenu_border',
                'selector'          => '{{WRAPPER}} .ut-custom-menu .sub-menu',
            ]
        );

        $this->add_control(
            'ut_submenu_border_radius',
            [
                'label'         => esc_html__( 'Border Radius', 'ut-elementor-addons-lite' ),
                'type'          => Controls_Manager::SLIDER,
                'size_units'    => ['px', '%', 'em'],
                'selectors'     => [
                    '{{WRAPPER}} .ut-custom-menu .sub-menu' => 'border-radius: {{SIZE}}{{UNIT}};'
                ]
            ]
        );

        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name'              => 'ut_submenu_box_shadow',
                'selector'          => '{{WRAPPER}} .ut-custom-menu .sub-menu',
            ]
        );

        $this->add_control(
            'ut_submenu_indent',
            [
                'label'         => esc_html__( 'Submenu Indent', 'ut-elementor-addons-lite' ),
                'type'          => Controls_Manager::SLIDER,
                'size_units'    => ['px'],
                'selectors'     => [
                    '{{WRAPPER}} .ut-custom-menu>ul>li>ul.sub-menu' => 'margin-top: {{SIZE}}{{UNIT}};'
                ]
            ]
        );

        $this->add_responsive_control(
            'ut_submenu_margin',
            [
                'label' => esc_html__( 'Margin', 'ut-elementor-addons-lite' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors' => [
                    '{{WRAPPER}} .ut-custom-menu .sub-menu .menu-item' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'separator' => 'before',
            ]
        );

        $this->add_responsive_control(
            'ut_submenu_padding',
            [
                'label' => esc_html__( 'Padding', 'ut-elementor-addons-lite' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors' => [
                    '{{WRAPPER}} .ut-custom-menu .sub-menu .menu-item a' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->end_controls_section();

        /* Reponsive Menu Style */
        $this->start_controls_section(
            'ut_section_style_resp-menu',
            [
                'label'                 => esc_html__( 'Responsive Menu', 'ut-elementor-addons-lite' ),
                'tab'                   => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'ut_resp_notice',
            [
                'type' => Controls_Manager::RAW_HTML,
                'raw' => '<em>' . esc_html__( 'Please switch to responsive mode to configure settings.', 'ut-elementor-addons-lite' ) . '</em>',
            ]
        );

        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name' => 'ut_respmenu_background',
                'label' => esc_html__( 'Background', 'ut-elementor-addons-lite' ),
                'types' => ['classic', 'gradient'],
                'selector' => '{{WRAPPER}} .ut-custom-menu ul.custom-menu.mobile-layout-hamburger.mobile-bg, {{WRAPPER}} .ut-custom-menu ul.custom-menu.mobile-layout-hamburger.mobile-bg ul',
            ]
        );

        $this->add_responsive_control(
            'ut_resp_toggle_color',
            [
                'label'                 => esc_html__( 'Toggle Button Color', 'ut-elementor-addons-lite' ),
                'type'                  => Controls_Manager::COLOR,
                'selectors'             => [
                    '{{WRAPPER}} .hamburger__line-in::before, {{WRAPPER}} .hamburger__line-in::after' => 'background-color: {{VALUE}}',
                ],
            ]
        );

        $this->add_control(
            'ut_resp_sub_menu_item',
            [
                'type'                  => Controls_Manager::HEADING,
                'label'                 => esc_html__( 'Menu Item', 'ut-elementor-addons-lite' ),
            ]
        );

        $this->add_responsive_control(
            'ut_resp_color_submenu_item',
            [
                'label'                 => esc_html__( 'Text Color', 'ut-elementor-addons-lite' ),
                'type'                  => Controls_Manager::COLOR,
                'scheme'                => [
                    'type'     => Core\Schemes\Color::get_type(),
                    'value'    => Core\Schemes\Color::COLOR_3,
                ],
                'selectors'             => [
                    '{{WRAPPER}} .ut-custom-menu ul.custom-menu.is-active.mobile-layout-hamburger .menu-item a,
                    {{WRAPPER}} .ut-custom-menu ul.sub-menu li.prev-menu,
                    {{WRAPPER}} .ut-custom-menu ul.custom-menu.is-active.mobile-layout-hamburger .menu-item.menu-item-has-children::after' => 'color: {{VALUE}} !important',
                ],
            ]
        );

        $this->add_responsive_control(
            'ut_resp_close_color',
            [
                'label'                 => esc_html__( 'Close Color', 'ut-elementor-addons-lite' ),
                'type'                  => Controls_Manager::COLOR,
                'scheme'                => [
                    'type'     => Core\Schemes\Color::get_type(),
                    'value'    => Core\Schemes\Color::COLOR_4,
                ],
                'selectors'             => [
                    '{{WRAPPER}} .mobile-layout-hamburger span.close' => 'color: {{VALUE}} !important',
                ],
            ]
        );

        $this->end_controls_section();

    }

    protected function render()
    {
        $settings = $this->get_settings();
        $this->add_render_attribute('ut-custom-menu', 'class', 'ut-custom-menu utal');
        $this->add_render_attribute('ut-custom-menu', 'class', 'layout-' . $settings['layout']);
        $mobile_menu_layout = isset( $settings['ut_mobile_menu_style'] ) ? $settings['ut_mobile_menu_style'] : 'default';
        $ut_navmenu = isset( $settings['ut_navmenu'] ) ? $settings['ut_navmenu'] : '';
        ?>

        <div <?php echo $this->get_render_attribute_string( "ut-custom-menu" ); ?>>
            <?php if ( 'hamburger' == $mobile_menu_layout ) { ?>
                <button class="hamburger hamburger--nav menu-toggle" aria-controls="primary-menu" aria-expanded="false">
                    <div class="hamburger__line hamburger__line--01">
                        <div class="hamburger__line-in hamburger__line-in--01"></div>
                    </div> 
                    <div class="hamburger__line hamburger__line--02">
                        <div class="hamburger__line-in hamburger__line-in--02"></div>
                    </div>
                    <div class="hamburger__line hamburger__line--03">
                        <div class="hamburger__line-in hamburger__line-in--03"></div>
                    </div>
                </button>
            <?php }  ?>
            <?php
            $args = apply_filters( 'ut_nav_menu_args', [
                'menu'        => esc_attr( $ut_navmenu ),
                'menu_class'  => 'menu custom-menu mobile-layout-'.esc_attr( $mobile_menu_layout ),
                'fallback_cb' => '__return_empty_string',
                'container'   => '',
            ] );
            wp_nav_menu( $args );
            ?>
        </div>

        <?php
    }
}
Plugin::instance()->widgets_manager->register_widget_type(new UT_Elementor_Addons_Lite_Widget_Nav_Menu());