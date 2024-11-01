<?php
namespace Elementor;   

if ( ! defined( 'ABSPATH' ) ) exit; 

class UT_Elementor_Addons_Lite_Widget_Icon_box extends Widget_Base {

    use \Elementor\UT_Elementor_Addons_Lite_Queries;

    public function get_name() { 
        return 'utal-icon-box';
    }

    public function get_title() {
        return  esc_html__( 'Icon Box', 'ut-elementor-addons-lite' );
    } 

    public function get_icon() { 
        return 'eicon-info-box ut-widget-icon';
    }

    public function get_categories() {
        return [ 'ut-elementor-addons-lite' ];
    }

    public function get_script_depends()
    {
        return [ 
            'ut-elementor-addons-lite-script',
            'slick', 
        ];
    }

    public function get_style_depends()
    {
        return [ 'slick' ];
    }   

    protected function register_controls(){

        $this->start_controls_section(
            'ut_icon_box',
            [
                'label' => esc_html__( 'General', 'ut-elementor-addons-lite' ),
                'tab'   => Controls_Manager::TAB_CONTENT,
            ]
        );

        $repeater = new Repeater();

        $repeater->add_control(
            'ut_iconbox_title',
            [
                'label' => esc_html__( 'Title & Description', 'ut-elementor-addons-lite' ),
                'type' => Controls_Manager::TEXT,
                'default' => esc_html__( 'This is the heading', 'ut-elementor-addons-lite' ),
                'label_block' => true,
            ]
        );

        $repeater->add_control(
            'ut_iconbox_description',
            [
                'type' => Controls_Manager::WYSIWYG,
                'default' => esc_html__( 'This is the description', 'ut-elementor-addons-lite' ),
                'label_block' => true,
            ]
        );

        $repeater->add_control(
            'ut_iconbox_button_label',
            [
                'label' => esc_html__( 'Button Label', 'ut-elementor-addons-lite' ),
                'type' => Controls_Manager::TEXT,
                'default' => esc_html__( 'Read More', 'ut-elementor-addons-lite' ),
                'label_block' => false,
            ]
        );

        $repeater->add_control(
            'ut_iconbox_button_link',
            [
                'label' => esc_html__( 'Button Link', 'ut-elementor-addons-lite' ),
                'type' => Controls_Manager::TEXT,
                'placeholder' => esc_html__( 'https://your-link.com', 'ut-elementor-addons-lite' ),
                'label_block' => true,
            ]
        );

        $repeater->add_control( 
            'ut_iconbox_icons',
            [
                'label' => esc_html__( 'Icon', 'ut-elementor-addons-lite' ),
                'type' => Controls_Manager::ICONS,
                'fa4compatibility' => 'ut_iconbox_icon',
                'default' => [ 
                    'value' => 'fab fa-wordpress-simple',
                    'library' => 'fa-brands',
                ],  
            ]
        );

        $this->add_control(
            'iconbox',
            [
                'label' => esc_html__( 'Icon box', 'ut-elementor-addons-lite' ),
                'type' => Controls_Manager::REPEATER,
                'fields' => $repeater->get_controls( ),
                'default' => [
                    [
                        'ut_iconbox_title' => esc_html__( 'This is the heading', 'ut-elementor-addons-lite' ),
                        'ut_iconbox_description' => esc_html__( 'This is the description', 'ut-elementor-addons-lite' ),
                        'ut_iconbox_button_label' => esc_html__( 'Read More', 'ut-elementor-addons-lite' ),
                        'ut_iconbox_button_link' => esc_html__( '', 'ut-elementor-addons-lite' ),
                        'ut_iconbox_icons' => esc_html__( 'fas fa-snowflake', 'ut-elementor-addons-lite' ),
                    ],
                ],
                'title_field' => '{{{ ut_iconbox_title }}}',
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'ut_setting_detail',
            [
                'label' => esc_html__( 'Hide / Show Settings', 'ut-elementor-addons-lite' ),
                'tab'   => Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_responsive_control(
            'ut_icon',
            [
                'label'     => esc_html__( 'Hide Icon', 'ut-elementor-addons-lite' ),
                'type'      => Controls_Manager::SWITCHER,
                'selectors' => [
                    '{{WRAPPER}} .iconbox_main_wrapper .iconbox_main_list .iconbox-icon' => 'display: none;',
                ],
                'description' => esc_html__( 'Choose yes to hide image' ),
            ]
        );

        $this->add_responsive_control(
            'ut_hide_title',
            [
                'label'     => esc_html__( 'Hide Title', 'ut-elementor-addons-lite' ),
                'type'      => Controls_Manager::SWITCHER,
                'selectors' => [
                    '{{WRAPPER}} .iconbox_main_wrapper .iconbox_main_list .name_title' => 'display: none;',
                ],
                'description' => esc_html__( 'Choose yes to hide title' ),
            ]
        );

        $this->add_responsive_control(
            'ut_description',
            [
                'label'     => esc_html__( 'Hide Description', 'ut-elementor-addons-lite' ),
                'type'      => Controls_Manager::SWITCHER,
                'selectors' => [
                    '{{WRAPPER}} .iconbox_main_wrapper .iconbox_main_list .name_description' => 'display: none;',
                ],
                'description' => esc_html__( 'Choose yes to hide number counter' ),
            ]
        );

        $this->add_responsive_control(
            'ut_button',
            [
                'label'     => esc_html__( 'Hide Button', 'ut-elementor-addons-lite' ),
                'type'      => Controls_Manager::SWITCHER,
                'selectors' => [
                    '{{WRAPPER}} .iconbox_main_wrapper .iconbox_main_list .btn' => 'display: none;',
                ],
                'description' => esc_html__( 'Choose yes to hide number button' ),
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(  
            'ut_slider_setting',
            [ 
                'label' => esc_html__( 'Slider Settings', 'ut-elementor-addons-lite' ),
            ]
        );

        $this->add_control(
            'ut_iconbox_slider_to_show',
            [
                'label' => esc_html__( 'Slide to Show', 'ut-elementor-addons-lite' ),
                'type' => Controls_Manager::NUMBER,
                'min' => 1,
                'max' => 5,
                'step' => 1,
                'default' => '3',   
            ]
        );

        $this->add_control(
            'ut_iconbox_slider_to_scroll',
            [
                'label' => esc_html__( 'Slide to Scroll', 'ut-elementor-addons-lite' ),
                'type' => Controls_Manager::NUMBER,
                'min' => 1,
                'max' => 5,
                'step' => 1,
                'default' => '1',   
            ]
        );

        $this->add_control( 
            'ut_iconbox_slider_dots',
            [
                'label' => esc_html__( 'Dots', 'ut-elementor-addons-lite' ),
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'default' => 'yes',
                'options' => [
                    'yes'  => esc_html__( 'Yes', 'ut-elementor-addons-lite' ),
                    'no' => esc_html__( 'No', 'ut-elementor-addons-lite' ),
                ],  
            ]
        );

        $this->add_control( 
            'ut_iconbox_slider_arrow',
            [
                'label' => esc_html__( 'Arrows', 'ut-elementor-addons-lite' ),
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'default' => 'yes',
                'options' => [
                    'yes'  => esc_html__( 'Yes', 'ut-elementor-addons-lite' ),
                    'no' => esc_html__( 'No', 'ut-elementor-addons-lite' ),
                ],  
            ]
        );

        $this->add_control( 
            'ut_iconbox_slider_pauseonhover',
            [
                'label' => esc_html__( 'Pause on Hover', 'ut-elementor-addons-lite' ),
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'default' => 'no',
                'options' => [
                    'yes'  => esc_html__( 'Yes', 'ut-elementor-addons-lite' ),
                    'no' => esc_html__( 'No', 'ut-elementor-addons-lite' ),
                ],              
            ]
        );

        $this->add_control(
            'ut_iconbox_autoplay',
            [
                'label' => esc_html__(  'Autoplay', 'ut-elementor-addons-lite'  ),
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'default' => 'yes',
                'options' => [
                    'yes'  => esc_html__( 'Yes', 'ut-elementor-addons-lite' ),
                    'no' => esc_html__( 'No', 'ut-elementor-addons-lite' ),
                ],              
            ]
        );

        $this->add_control(
            'ut_iconbox_autoplay_speed',
            [
                'label' => esc_html__( 'Autoplay Speed', 'ut-elementor-addons-lite' ),
                'type' => Controls_Manager::TEXT,
                'default' => '4000',            
            ]
        );

        $this->add_control(
            'ut_iconbox_tablet_detail',
            [
                'label' => esc_html__( 'Tablet Settings', 'ut-elementor-addons-lite' ),
                'type' => Controls_Manager::HEADING,
                'separator' => 'before',            
            ]
        ); 
        $this->add_control(
            'ut_iconbox_tablet_slider_to_show',
            [
                'label' => esc_html__( 'Slide to Show', 'ut-elementor-addons-lite' ),
                'type' => Controls_Manager::NUMBER,
                'default' => '1',                           
            ]
        );

        $this->add_control(
            'ut_iconbox_tablet_slider_to_scroll',
            [
                'label' => esc_html__( 'Slide to Scroll', 'ut-elementor-addons-lite' ),
                'type' => Controls_Manager::NUMBER,
                'min' => 1,
                'max' => 5,
                'step' => 1,
                'default' => '1',   
            ]
        );

        $this->add_control( 
            'ut_iconbox_tablet_slider_dots',
            [
                'label' => esc_html__( 'Dots', 'ut-elementor-addons-lite' ),
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'default' => 'yes',
                'options' => [
                    'yes'  => esc_html__( 'Yes', 'ut-elementor-addons-lite' ),
                    'no' => esc_html__( 'No', 'ut-elementor-addons-lite' ),
                ],  
            ]
        );

        $this->add_control( 
            'ut_iconbox_tablet_slider_arrow',
            [
                'label' => esc_html__( 'Arrows', 'ut-elementor-addons-lite' ),
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'default' => 'yes',
                'options' => [
                    'yes'  => esc_html__( 'Yes', 'ut-elementor-addons-lite' ),
                    'no' => esc_html__( 'No', 'ut-elementor-addons-lite' ),
                ],      
            ]
        );

        $this->add_control(
            'ut_iconbox_tablet_autoplay',
            [
                'label' => esc_html__( 'Autoplay', 'ut-elementor-addons-lite' ),
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'default' => 'yes',
                'options' => [
                    'yes'  => esc_html__( 'Yes', 'ut-elementor-addons-lite' ),
                    'no' => esc_html__( 'No', 'ut-elementor-addons-lite' ),
                ],  
            ]
        );

        $this->add_control(
            'ut_iconbox_tablet_autoplay_speed',
            [
                'label' => esc_html__( 'Autoplay Speed', 'ut-elementor-addons-lite' ),
                'type' => Controls_Manager::TEXT,
                'default' => '4000',
                'separator' => 'after',     
            ]
        );

        $this->add_control(
            'ut_iconbox_mobile_detail',
            [
                'label' => esc_html__( 'Mobile Settings', 'ut-elementor-addons-lite' ),
                'type' => Controls_Manager::HEADING,    
            ]
        ); 

        $this->add_control(
            'ut_iconbox_mobile_slider_to_show',
            [
                'label' => esc_html__( 'Slide to Show', 'ut-elementor-addons-lite' ),
                'type' => Controls_Manager::NUMBER,
                'default' => '1',   
            ]
        );

        $this->add_control( 
            'ut_iconbox_mobile_slider_dots', 
            [
                'label' => esc_html__( 'Dots', 'ut-elementor-addons-lite' ),
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'default' => 'yes',
                'options' => [
                    'yes'  => esc_html__( 'Yes', 'ut-elementor-addons-lite' ),
                    'no' => esc_html__( 'No', 'ut-elementor-addons-lite' ),
                ],      
            ]
        );

        $this->add_control( 
            'ut_iconbox_mobile_slider_arrow',
            [
                'label' => esc_html__( 'Arrows', 'ut-elementor-addons-lite' ),
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'default' => 'yes',
                'options' => [
                    'yes'  => esc_html__( 'Yes', 'ut-elementor-addons-lite' ),
                    'no' => esc_html__( 'No', 'ut-elementor-addons-lite' ),
                ],  
            ]
        );

        $this->add_control(
            'ut_iconbox_mobile_autoplay',
            [
                'label' => esc_html__( 'Autoplay', 'ut-elementor-addons-lite' ),
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'default' => 'yes',
                'options' => [
                    'yes'  => esc_html__( 'Yes', 'ut-elementor-addons-lite' ),
                    'no' => esc_html__( 'No', 'ut-elementor-addons-lite' ),
                ],  
            ]
        );

        $this->add_control(
            'ut_iconbox_mobile_autoplay_speed',
            [
                'label' => esc_html__( 'Autoplay Speed', 'ut-elementor-addons-lite' ),
                'type' => Controls_Manager::TEXT,
                'default' => '4000',
                'separator' => 'after', 
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'ut_icon_box_section_style_icon',
            [
                'label' => esc_html__( 'Icon', 'ut-elementor-addons-lite' ),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->start_controls_tabs( 'ut_icon_box_icon_colors' );

        $this->start_controls_tab(
            'ut_icon_box_icon_colors_normal',
            [
                'label' => esc_html__( 'Normal', 'ut-elementor-addons-lite' ),
            ]
        );

        $this->add_control(
            'ut_icon_box_icon_primary_color',
            [
                'label' => esc_html__( 'Color', 'ut-elementor-addons-lite' ),
                'type' => Controls_Manager::COLOR,
                'default' => '#656565',
                'selectors' => [
                    '{{WRAPPER}} .iconbox_main_wrapper .iconbox_main_list .iconbox-icon > i' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->end_controls_tab();

        $this->start_controls_tab(
            'ut_icon_box_icon_colors_hover',
            [
                'label' => esc_html__( 'Hover', 'ut-elementor-addons-lite' ),
            ]
        );

        $this->add_control(
            'ut_icon_box_hover_primary_color',
            [
                'label' => esc_html__( 'Color', 'ut-elementor-addons-lite' ),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} .iconbox_main_list .iconbox-icon i:hover' => 'color: {{VALUE}};',  
                ],
            ]
        );

        $this->end_controls_tab();

        $this->end_controls_tabs();

        $this->add_responsive_control(
            'ut_icon_box_icon_size',
            [
                'label' => esc_html__( 'Icon Size', 'ut-elementor-addons-lite' ),
                'type' => Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'min' => 6,
                        'max' => 300,
                    ],
                ],
                'default' => [
                    'size' => 40,
                    'unit' => 'px',
                ],
                'selectors' => [
                    '{{WRAPPER}} .iconbox_main_list .iconbox-icon i' => 'font-size: {{SIZE}}{{UNIT}};',
                ],
                'separator' => 'before',
            ]
        );

        $this->add_responsive_control(
            'ut_svg_icon_size',
            [
                'label' => esc_html__( 'SVG Size', 'ut-elementor-addons-lite' ),
                'type' => Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'min' => 6,
                        'max' => 300,
                    ],
                ],
                'default' => [
                    'size' => 40,
                    'unit' => 'px',
                ],
                'selectors' => [
                    '{{WRAPPER}} img.iconboxs' => 'height: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'ut_icon_box_icon_vertical_align',
            [
                'label' => esc_html__( 'Vertical Position ', 'ut-elementor-addons-lite' ),
                'type' => Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'min' => -200,
                        'max' => 200,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .iconbox_main_list .iconbox-icon' => ' -webkit-transform: translateY({{SIZE}}{{UNIT}}); -ms-transform: translateY({{SIZE}}{{UNIT}}); transform: translateY({{SIZE}}{{UNIT}});',
                    '{{WRAPPER}} .iconbox_svg img.iconboxs' => ' -webkit-transform: translateY({{SIZE}}{{UNIT}}); -ms-transform: translateY({{SIZE}}{{UNIT}}); transform: translateY({{SIZE}}{{UNIT}});',
                    '{{WRAPPER}} .iconbox-svg' => ' -webkit-transform: translateY({{SIZE}}{{UNIT}}); -ms-transform: translateY({{SIZE}}{{UNIT}}); transform: translateY({{SIZE}}{{UNIT}});',
                ],
                'separator' => 'after',
            ]
        );

        $this->add_responsive_control(
            'ut_icon_box_icon_space',
            [
                'label' => esc_html__( 'Margin', 'ut-elementor-addons-lite' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em' ],
                'selectors' => [
                    '{{WRAPPER}} .iconbox_main_list .iconbox-icon ' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    '{{WRAPPER}} .iconbox_svg img.iconboxs' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    '{{WRAPPER}} .iconbox-svg' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'default' => [
                    'top' => '',
                    'right' => '',
                    'bottom' => '',
                    'left' => '',
                    'unit' => 'px',
                    'isLinked' => 'true',
                ]
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'ut_icon_section_style_content',
            [
                'label' => esc_html__( 'Content', 'ut-elementor-addons-lite' ),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'ut_icon_heading_title',
            [
                'label' => esc_html__( 'Title', 'ut-elementor-addons-lite' ),
                'type' => Controls_Manager::HEADING,
            ]
        );

        $this->add_control(
            'ut_icon_title_color',
            [
                'label' => esc_html__( 'Normal Color', 'ut-elementor-addons-lite' ),
                'type' => Controls_Manager::COLOR,
                'default' => '#000000',
                'selectors' => [
                    '{{WRAPPER}} .iconbox_main_wrapper .name_title' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'ut_icon_title_color_hover',
            [
                'label' => esc_html__( 'Hover Color', 'ut-elementor-addons-lite' ),
                'type' => Controls_Manager::COLOR,
                'default' => '#000000',
                'selectors' => [
                    '{{WRAPPER}} .iconbox_main_wrapper:hover .name_title' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'ut_icon_title_typography_group',
                'selector' => '{{WRAPPER}} .iconbox_main_wrapper .name_title',
            ]
        );

        $this->add_responsive_control(
            'ut_icon_title_bottom_space',
            [
                'label' => esc_html__( 'Margin', 'ut-elementor-addons-lite' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em' ],
                'selectors' => [
                    '{{WRAPPER}} .iconbox_main_wrapper  .name_title' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'default'=>[
                    'unit' => 'px',
                    'size' => '20',
                ],
                'separator' => 'before',
            ]
        );

        $this->add_responsive_control(
            'ut_icon_title_padding',
            [
                'label' => esc_html__( 'Padding', 'ut-elementor-addons-lite' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em' ],
                'selectors' => [
                    '{{WRAPPER}} .iconbox_main_wrapper .name_title' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'default'    => [
                    'top' => '0',
                    'right' => '0',
                    'bottom' => '0',
                    'left' => '0',
                    'unit' => 'px',
                    'isLinked' => '',
                ],
            ]
        );

        $this->add_control(
            'ut_icon_heading_description',
            [
                'label' => esc_html__( 'Description', 'ut-elementor-addons-lite' ),
                'type' => Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );

        $this->add_control(
            'ut_icon_description_color',
            [
                'label' => esc_html__( 'Normal Color', 'ut-elementor-addons-lite' ),
                'type' => Controls_Manager::COLOR,
                'default' => '#656565',
                'selectors' => [
                    '{{WRAPPER}} .iconbox_main_wrapper .name_description > p' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'ut_icon_description_color_hover',
            [
                'label' => esc_html__( 'Hover Color', 'ut-elementor-addons-lite' ),
                'type' => Controls_Manager::COLOR,
                'default' => '#656565',
                'selectors' => [
                    '{{WRAPPER}} .iconbox_main_wrapper:hover .name_description > p' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'ut_icon_description_typography_group',
                'selector' => '{{WRAPPER}} .iconbox_main_wrapper .name_description > p',
            ]
        );

        $this->add_responsive_control(
            'ut_icon_box_margin',
            [
                'label' => esc_html__( 'Margin', 'ut-elementor-addons-lite' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em' ],
                'selectors' => [
                    '{{WRAPPER}} .name_description p' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'default' => [
                    'size' => 15,
                    'unit' => 'px',
                ],
                'separator' => 'before',
            ]
        );

        $this->add_responsive_control(
            'ut_icon_box_padding',
            [
                'label' => esc_html__( 'Padding', 'ut-elementor-addons-lite' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em' ],
                'selectors' => [
                    '{{WRAPPER}} .name_description p' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'default' => [
                    'size' => 15,
                    'unit' => 'px',
                ],
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'ut_icon_box_section_style',
            [
                'label' => esc_html__( 'Button', 'ut-elementor-addons-lite' ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'ut_icon_box_typography_group',
                'label' =>esc_html__( 'Typography', 'ut-elementor-addons-lite' ),
                'selector' => '{{WRAPPER}} .btn',
            ]
        );

        $this->start_controls_tabs( 'tabs_button_style' );

        $this->start_controls_tab(
            'ut_icon_box_tab_button_normal',
            [
                'label' => esc_html__( 'Normal', 'ut-elementor-addons-lite' ),
            ]
        );

        $this->add_control(
            'ut_icon_box_button_text_color',
            [
                'label' => esc_html__( 'Text Color', 'ut-elementor-addons-lite' ),
                'type' => Controls_Manager::COLOR,
                'default' => '#000000',
                'selectors' => [
                    '{{WRAPPER}} .btn' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'ut_icon_box_btn_bg_color_normals',
            [
                'label'     => esc_html__('Background Color', 'ut-elementor-addons-lite'),
                'type'      => Controls_Manager::COLOR,
                'default'   => '#f7f7f7',
                'selectors' => [
                    '{{WRAPPER}} .btn' => 'background: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name' => 'ut_icon_box_btn_background_group',
                'label' => esc_html__( 'Background', 'ut-elementor-addons-lite' ),
                'types' => [ 'classic', 'gradient' ],
                'selector' => '{{WRAPPER}} .btn',
            ]
        );

        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'ut_icon_box_button_box_shadow',
                'label' => esc_html__( 'Box Shadow', 'ut-elementor-addons-lite' ),
                'selector' => '{{WRAPPER}} .btn',
            ] 
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'ut_icon_box_button_border_color_group',
                'label' => esc_html__( 'Border', 'ut-elementor-addons-lite' ),
                'selector' => '{{WRAPPER}} .btn',
            ]
        );

        $this->end_controls_tab();

        $this->start_controls_tab(
            'ut_icon_box_tab_button_hover',
            [
                'label' => esc_html__( 'Hover', 'ut-elementor-addons-lite' ),
            ]
        );

        $this->add_control(
            'ut_icon_box_btn_hover_color',
            [
                'label' => esc_html__( 'Text Color', 'ut-elementor-addons-lite' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .btn:hover' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'ut_icon_box_btn_bg_color_hovers',
            [
                'label'     => esc_html__('Background Color', 'ut-elementor-addons-lite'),
                'type'      => Controls_Manager::COLOR,
                'default'   => '#f7f7f7',
                'selectors' => [
                    '{{WRAPPER}} .btn:hover' => 'background: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name' => 'ut_icon_box_btn_background_hover_group',
                'label' => esc_html__( 'Background', 'ut-elementor-addons-lite' ),
                'types' => [ 'classic', 'gradient' ],
                'selector' => '{{WRAPPER}} .btn:hover',
            ]
        );

        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'ut_icon_box_button_box_shadow_hover_group',
                'label' => esc_html__( 'Box Shadow', 'ut-elementor-addons-lite' ),
                'selector' => '{{WRAPPER}} .btn:hover',
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'ut_icon_box_button_border_hv_color_group',
                'label' => esc_html__( 'Border', 'ut-elementor-addons-lite' ),
                'selector' => '{{WRAPPER}} .btn:hover',
            ]
        );

        $this->end_controls_tab();

        $this->add_responsive_control(
            'ut_icon_box_text_padding',
            [
                'label' =>esc_html__( 'Padding', 'ut-elementor-addons-lite' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', 'em', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .btn' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'separator' => 'before',
            ]
        );

        $this->add_responsive_control(
            'ut_icon_box_text_margin',
            [
                'label' =>esc_html__( 'Margin', 'ut-elementor-addons-lite' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', 'em', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .btn' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        ); 

        $this->add_responsive_control(
            'ut_icon_box_btn_border_radius',
            [
                'label' =>esc_html__( 'Border Radius', 'ut-elementor-addons-lite' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px'],
                'default' => [
                    'top' => '',
                    'right' => '',
                    'bottom' => '' ,
                    'left' => '',
                ],
                'selectors' => [
                    '{{WRAPPER}} .btn' =>  'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->end_controls_tabs();

    }

    protected function render() {
        $settings = $this->get_settings();
        $html_tag = isset( $settings[ 'html_tag' ] ) ? $settings[ 'html_tag' ] : '';
        $slider_dots = isset( $settings[ 'ut_iconbox_slider_dots' ] ) ? $settings[ 'ut_iconbox_slider_dots' ] : 'yes';
        $slider_arrow = isset( $settings[ 'ut_iconbox_slider_arrow' ] ) ? $settings[ 'ut_iconbox_slider_arrow' ] : 'yes';
        $slider_pauseonhover = isset( $settings[ 'ut_iconbox_slider_pauseonhover' ] ) ? $settings[ 'ut_iconbox_slider_pauseonhover' ] : 'no';
        $slider_to_show = isset( $settings[ 'ut_iconbox_slider_to_show' ] ) ? $settings[ 'ut_iconbox_slider_to_show' ] : '3';
        $slider_to_scroll = isset( $settings[ 'ut_iconbox_slider_to_scroll' ] ) ? $settings[ 'ut_iconbox_slider_to_scroll' ] : '1';
        $autoplay = isset( $settings[ 'ut_iconbox_autoplay' ] ) ? $settings[ 'ut_iconbox_autoplay' ] : 'yes';
        $autoplay_speed = isset( $settings[ 'ut_iconbox_autoplay_speed' ] ) ? $settings[ 'ut_iconbox_autoplay_speed' ] : '4000';
        $tablet_slider_to_show = isset( $settings[ 'ut_iconbox_tablet_slider_to_show' ] ) ? $settings[ 'ut_iconbox_tablet_slider_to_show' ] : '1';
        $tablet_slider_dots = isset( $settings[ 'ut_iconbox_tablet_slider_dots' ] ) ? $settings[ 'ut_iconbox_tablet_slider_dots' ] : 'yes';
        $tablet_slider_arrow = isset( $settings[ 'ut_iconbox_tablet_slider_arrow' ] ) ? $settings[ 'ut_iconbox_tablet_slider_arrow' ] : 'yes';
        $tablet_autoplay = isset( $settings[ 'ut_iconbox_tablet_autoplay' ] ) ? $settings[ 'ut_iconbox_tablet_autoplay' ] : 'yes';
        $tablet_autoplay_speed = isset( $settings[ 'ut_iconbox_tablet_autoplay_speed' ] ) ? $settings[ 'ut_iconbox_tablet_autoplay_speed' ] : '4000';
        $mobile_slider_to_show = isset( $settings[ 'ut_iconbox_mobile_slider_to_show' ] ) ? $settings[ 'ut_iconbox_mobile_slider_to_show' ] : '1';
        $mobile_slider_dots = isset( $settings[ 'ut_iconbox_mobile_slider_dots' ] ) ? $settings[ 'ut_iconbox_mobile_slider_dots' ] : 'yes';
        $mobile_slider_arrow = isset( $settings[ 'ut_iconbox_mobile_slider_arrow' ] ) ? $settings[ 'ut_iconbox_mobile_slider_arrow' ] : 'yes';
        $mobile_autoplay = isset( $settings[ 'ut_iconbox_mobile_autoplay' ] ) ? $settings[ 'ut_iconbox_mobile_autoplay' ] : 'yes';
        $mobile_autoplay_speed = isset( $settings[ 'ut_iconbox_mobile_autoplay_speed' ] ) ? $settings[ 'ut_iconbox_mobile_autoplay_speed' ] : '4000';
        $tablet_slider_to_scroll = isset( $settings[ 'ut_iconbox_tablet_slider_to_scroll' ] ) ? $settings[ 'ut_iconbox_tablet_slider_to_scroll' ] : '1';

        $this->add_render_attribute('utal-iconbox_wrapper', 'class', 'iconbox_wrapper');
        $this->add_render_attribute('utal-iconbox_wrapper', 'data-slider_dots', $slider_dots); 
        $this->add_render_attribute('utal-iconbox_wrapper', 'data-slider_arrow', $slider_arrow); 
        $this->add_render_attribute('utal-iconbox_wrapper', 'data-pauseonhover', $slider_pauseonhover);
        $this->add_render_attribute('utal-iconbox_wrapper', 'data-slidertoshow', $slider_to_show); 
        $this->add_render_attribute('utal-iconbox_wrapper', 'data-slidertoscroll', $slider_to_scroll);
        $this->add_render_attribute('utal-iconbox_wrapper', 'data-autoplayspeed', $autoplay_speed);  
        $this->add_render_attribute('utal-iconbox_wrapper', 'data-autoplay', $autoplay); 
        $this->add_render_attribute('utal-iconbox_wrapper', 'data-tablet_slider_to_show', $tablet_slider_to_show);
        $this->add_render_attribute('utal-iconbox_wrapper', 'data-tablet_slider_to_scroll', $tablet_slider_to_scroll);
        $this->add_render_attribute('utal-iconbox_wrapper', 'data-tablet_slider_dots', $tablet_slider_dots); 
        $this->add_render_attribute('utal-iconbox_wrapper', 'data-tablet_slider_arrow', $tablet_slider_arrow);
        $this->add_render_attribute('utal-iconbox_wrapper', 'data-tablet_autoplay', $tablet_autoplay);
        $this->add_render_attribute('utal-iconbox_wrapper', 'data-tablet_autoplay_speed', $tablet_autoplay_speed);
        $this->add_render_attribute('utal-iconbox_wrapper', 'data-mobile_slider_to_show', $mobile_slider_to_show); 
        $this->add_render_attribute('utal-iconbox_wrapper', 'data-mobile_slider_dots', $mobile_slider_dots); 
        $this->add_render_attribute('utal-iconbox_wrapper', 'data-mobile_slider_arrow', $mobile_slider_arrow); 
        $this->add_render_attribute('utal-iconbox_wrapper', 'data-mobile_autoplay', $mobile_autoplay);
        $this->add_render_attribute('utal-iconbox_wrapper', 'data-mobile_autoplay_speed', $mobile_autoplay_speed);
        ?>

        <?php
        if ( $settings['iconbox'] ) {
            ?>
            <div class="iconbox_main_wrapper" <?php echo $this->get_render_attribute_string('utal-iconbox_wrapper'); ?>>
                <?php
                foreach ( $settings['iconbox'] as $slide ) { 
                    ?>
                    <div class="iconbox_main_list">
                        <?php if ( 'svg' == $slide['ut_iconbox_icons']['library'] ) { ?>
                            <div class="iconbox-svg">
                                <img class="iconboxs" src="<?php echo esc_attr( $slide['ut_iconbox_icons']['value']['url'] ); ?>" alt="<?php echo esc_attr( get_post_meta($slide['ut_iconbox_icons']['value']['id'], '_wp_attachment_image_alt', true) ); ?>" />
                            </div>
                        <?php } else { ?>
                            <div class="iconbox-icon">
                                <i class="<?php echo esc_attr( $slide['ut_iconbox_icons']['library'] ); ?> <?php echo esc_attr( $slide['ut_iconbox_icons']['value'] ); ?>"></i>
                            </div>
                        <?php } ?>
                        <?php if ( $slide['ut_iconbox_title'] ) { ?>
                            <div class="name_title">
                                <?php echo esc_html( $slide['ut_iconbox_title'] ); ?> 
                            </div>
                        <?php } ?>
                        <?php if ( $slide['ut_iconbox_description'] ) { ?> 
                            <div class="name_description">
                                <p><?php echo wp_kses_post( $slide['ut_iconbox_description'] ); ?></p>
                            </div>
                        <?php } ?>
                        <?php if ( $slide['ut_iconbox_button_link'] ) { ?>
                            <a href="<?php echo esc_url( $slide['ut_iconbox_button_link'] ); ?>">
                                <button class="btn"><?php echo esc_html( $slide['ut_iconbox_button_label'] ); ?></button>   
                            </a>    
                        <?php } ?>                      
                    </div>
                <?php } ?>
            </div>

        <?php }  
    }
}

Plugin::instance()->widgets_manager->register_widget_type( new UT_Elementor_Addons_Lite_Widget_Icon_box() );