<?php

namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) exit; 

class UT_Elementor_Addons_Lite_Widget_Carousel extends Widget_Base
{

    use \Elementor\UT_Elementor_Addons_Lite_Queries;

    public function get_name()
    {
        return 'utal-carousel';
    }

    public function get_title()
    {
        return  esc_html__( 'Carousel', 'ut-elementor-addons-lite' );
    }

    public function get_icon()
    {
        return 'eicon-slider-push ut-widget-icon';
    }

    public function get_categories()
    {
        return [ 'ut-elementor-addons-lite' ];
    }

    public function get_script_depends() {
        return [ 'slick','ut-elementor-addons-lite-script' ];
    }

    public function get_style_depends()
    {
        return ['slick'];
    }

    protected function register_controls()
    {

        $this->start_controls_section(
            'ut_section_detail',
            [
                'label' => esc_html__( 'Content Setting', 'ut-elementor-addons-lite' ),
            ]
        );

        $repeater = new Repeater();

        $repeater->add_control(
            'slider_image',
            [
                'label' => esc_html__( 'Choose Image', 'ut-elementor-addons-lite' ),
                'type' => \Elementor\Controls_Manager::MEDIA,
                'default' => [
                    'url' => \Elementor\Utils::get_placeholder_image_src(),
                ],
            ]
        );

        $repeater->add_control(
            'slide_title',
            [
                'label' => esc_html__( 'Slide Title', 'ut-elementor-addons-lite' ),
                'type' => Controls_Manager::TEXT,
                'default' => esc_html__( 'Slide Title', 'ut-elementor-addons-lite' ),
                'label_block' => true,
            ]
        );

        $repeater->add_control(
            'slide_content',
            [
                'label' => esc_html__( 'Slide Content', 'ut-elementor-addons-lite' ),
                'type' => Controls_Manager::WYSIWYG,
                'default' => esc_html__( 'List Content', 'ut-elementor-addons-lite' ),
                'show_label' => false,
            ]
        );

        $repeater->add_control(
            'slide_button',
            [
                'label' => esc_html__( 'Slide Button', 'ut-elementor-addons-lite' ),
                'type' => Controls_Manager::TEXT,
                'default' => esc_html__( 'Read More', 'ut-elementor-addons-lite' ),
                'label_block' => true,
            ]
        );

        $repeater->add_control(
            'slide_button_link',
            [
                'label' => esc_html__( 'Link', 'ut-elementor-addons-lite' ),
                'type' => Controls_Manager::URL,
                'placeholder' => esc_html__( 'https://your-link.com', 'ut-elementor-addons-lite' ),
                'show_external' => true,
                'default' => [
                    'url' => '',
                    'is_external' => true,
                    'nofollow' => true,
                ],
            ]
        );

        $this->add_control(
            'slides',
            [
                'label' => esc_html__( 'Slides', 'ut-elementor-addons-lite' ),
                'type' => Controls_Manager::REPEATER,
                'fields' => $repeater->get_controls( ),
                'default' => [
                    [
                        'slide_title' => esc_html__( 'Slide 1', 'ut-elementor-addons-lite' ),
                        'slide_content' => esc_html__( 'Slide Content.', 'ut-elementor-addons-lite' ),
                        'slide_button' => esc_html__( 'Read More', 'ut-elementor-addons-lite' ),
                        'slide_button_link' => [
                            'url' => '',
                            'is_external' => true,
                            'nofollow' => true,
                        ],
                    ],
                    [
                        'slide_title' => esc_html__( 'Slide 2', 'ut-elementor-addons-lite' ),
                        'slide_content' => esc_html__( 'Slide Content.', 'ut-elementor-addons-lite' ),
                        'slide_button' => esc_html__( 'Read More', 'ut-elementor-addons-lite' ),
                        'slide_button_link' => [
                            'url' => '',
                            'is_external' => false,
                            'nofollow' => true,
                        ],
                    ],
                ],
                'title_field' => '{{{ slide_title }}}',
            ]
        );

        $this->add_responsive_control(
            'slider_image_position',
            [
                'label' => esc_html__( 'Image Position', 'ut-elementor-addons-lite' ),
                'type' => Controls_Manager::CHOOSE,
                'options' => [
                    'left' => [
                        'title' => esc_html__( 'Left', 'ut-elementor-addons-lite' ),
                        'icon' => 'eicon-h-align-left',
                    ],
                    'center' => [
                        'title' => esc_html__( 'Top', 'ut-elementor-addons-lite' ),
                        'icon' => 'eicon-v-align-top',
                    ],
                    'bottom' => [
                        'title' => esc_html__( 'Bottom', 'ut-elementor-addons-lite' ),
                        'icon' => 'eicon-v-align-bottom',
                    ],
                    'right' => [
                        'title' => esc_html__( 'Right', 'ut-elementor-addons-lite' ),
                        'icon' => 'eicon-h-align-right',
                    ],
                ],
                'default' => 'align-left',
                'prefix_class' => 'ut-image-position-',
                'toggle' => true,
            ]
        );

        $this->add_group_control(
            Group_Control_Image_Size::get_type(),
            [
                'name'              => 'slider_image_size',
                'label'             => esc_html__( 'Image Size', 'ut-elementor-addons-lite' ),
                'default'           => 'full',
            ]
        );

        $this->end_controls_section();

        /* slider settings */
        $this->slider_settings(array('slidesToShow' => true));

        $this->start_controls_section(
            'ut_section_general_style',
            [
                'label' => esc_html__( 'General Styles', 'ut-elementor-addons-lite' ),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_responsive_control(
            'ut_slider_height',
            [
                'label' => esc_html__( 'Slider Min. Height', 'ut-elementor-addons-lite' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => ['px', '%', 'vh'],                
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 1500,
                        'step' => 1,
                    ],
                    '%' => [
                        'min' => 0,
                        'max' => 100,
                        'step' => 1,
                    ],
                    'vh' => [
                        'min' => 0,
                        'max' => 100,
                        'step' => 1,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .utal-slider .slide-wrap .slide-image, {{WRAPPER}} .custom-slide-wrap' => 'min-height: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'ut_content_title_color',
            [
                'label'     => esc_html__( 'Title Color', 'ut-elementor-addons-lite' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .slide-title a, {{WRAPPER}} .slide-title' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'      => 'ut_content_title_typography',
                'label'     => esc_html__( 'Title Typography', 'ut-elementor-addons-lite' ),
                'scheme'    => Core\Schemes\Typography::TYPOGRAPHY_4,
                'selector' => '{{WRAPPER}} .slide-title',
            ]
        );

        $this->add_control(
            'ut_title_divider',
            [
                'type' => Controls_Manager::DIVIDER,
            ]
        );

        $this->add_control(
            'ut_content_description_color',
            [
                'label'     => esc_html__( 'Description Color', 'ut-elementor-addons-lite' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .content-excerpt' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'      => 'ut_content_excerpt_typography',
                'label'     => esc_html__('Description Typography', 'ut-elementor-addons-lite'),
                'scheme'    => Core\Schemes\Typography::TYPOGRAPHY_4,
                'selector' => '{{WRAPPER}} .content-excerpt',
            ]
        );

        $this->add_control(
            'ut_desc_divider',
            [
                'type' => Controls_Manager::DIVIDER,
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'ut_section_content_container',
            [
                'label' => esc_html__( 'Content Container', 'ut-elementor-addons-lite' ),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'ut_container_bgcolor',
            [
                'label'     => esc_html__( 'Background', 'ut-elementor-addons-lite' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .slide-content-wrap' => 'background-color: {{VALUE}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'ut_container_width',
            [
                'label' => esc_html__( 'Width', 'ut-elementor-addons-lite' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => ['px', '%'],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 800,
                    ],
                    '%' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .utal-carousel .slide-wrap .slide-content-wrap' => 'min-width: {{SIZE}}{{UNIT}}; width: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'ut_container_height',
            [
                'label' => esc_html__( 'Container Min. Height', 'ut-elementor-addons-lite' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => ['px', '%', 'vh'],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 1500,
                        'step' => 1,
                    ],
                    '%' => [
                        'min' => 0,
                        'max' => 100,
                        'step' => 1,
                    ],
                    'vh' => [
                        'min' => 0,
                        'max' => 100,
                        'step' => 1,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .utal-carousel .slide-wrap .slide-content-wrap' => 'min-height: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'ut_container_text_align',
            [
                'label' => esc_html__( 'Text Alignment', 'ut-elementor-addons-lite' ),
                'type' => Controls_Manager::CHOOSE,
                'options' => [
                    'align-left' => [
                        'title' => esc_html__( 'Left', 'ut-elementor-addons-lite' ),
                        'icon' => 'eicon-text-align-left',
                    ],
                    'align-center' => [
                        'title' => esc_html__( 'Center', 'ut-elementor-addons-lite' ),
                        'icon' => 'eicon-text-align-center',
                    ],
                    'align-right' => [
                        'title' => esc_html__( 'Right', 'ut-elementor-addons-lite' ),
                        'icon' => 'eicon-text-align-right',
                    ],
                ],
                'default' => 'align-left',
                'toggle' => true,
            ]
        );

        $this->add_responsive_control(
            'ut_container_margin',
            [
                'label' => esc_html__( 'Margin', 'ut-elementor-addons-lite' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors' => [
                    '{{WRAPPER}} .utal-carousel .slide-wrap .slide-content-wrap' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'ut_container_padding',
            [
                'label' => esc_html__( 'Padding', 'ut-elementor-addons-lite' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors' => [
                    '{{WRAPPER}} .slide-content-wrap' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'ut_readmore_button_styles',
            [
                'label' => esc_html__( 'Button Styles', 'ut-elementor-addons-lite' ),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->start_controls_tabs(
            'ut_button_tabs'
        );

        $this->start_controls_tab(
            'ut_button_tab1',
            [
                'label' => esc_html__( 'Normal', 'ut-elementor-addons-lite' ),
            ]
        );

        $this->add_control(
            'ut_content_button_color',
            [
                'label'     => esc_html__( 'Button Text Color', 'ut-elementor-addons-lite' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .slide-readmore' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'ut_content_button_bg_color',
            [
                'label'     => esc_html__( 'Button Background Color', 'ut-elementor-addons-lite' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .slide-readmore' => 'background-color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'ut_button_border',
            [
                'label' => esc_html__( 'Style', 'ul-elementor-addons-lite' ),
                'type' => Controls_Manager::SELECT,
                'options' => [
                    '' => esc_html__('None', 'ul-elementor-addons-lite'),
                    'solid' => esc_html__('Solid', 'ul-elementor-addons-lite'),
                    'double' => esc_html__('Double', 'ul-elementor-addons-lite'),
                    'dotted' => esc_html__('Dotted', 'ul-elementor-addons-lite'),
                    'dashed' => esc_html__('Dashed', 'ul-elementor-addons-lite'),
                    'groove' => esc_html__('Groove', 'ul-elementor-addons-lite'),
                ],
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} a.slide-readmore' => 'border-style: {{VALUE}}',
                ],
            ]
        );

        $this->add_responsive_control(
            'ut_button_border_width',
            [
                'label' => esc_html__( 'Border Width', 'ut-elementor-addons-lite' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors' => [
                    '{{WRAPPER}} a.slide-readmore' => 'border-width: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'ut_button_border_color',
            [
                'label'     => esc_html__( 'Button Border Color', 'ut-elementor-addons-lite' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .slide-readmore' => 'border-color: {{VALUE}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'ut_button_border_radius',
            [
                'label' => esc_html__( 'Border Radius', 'ut-elementor-addons-lite' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors' => [
                    '{{WRAPPER}} a.slide-readmore' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'button_box_shadow',
                'label' => esc_html__( 'Box Shadow', 'ut-elementor-addons-lite' ),
                'selector' => '{{WRAPPER}} a.slide-readmore',
            ]
        );

        $this->end_controls_tab();

        $this->start_controls_tab(
            'ut_button_tab2',
            [
                'label' => esc_html__( 'Hover', 'ut-elementor-addons-lite' ),
            ]
        );

        $this->add_control(
            'ut_content_button_color_hover',
            [
                'label'     => esc_html__( 'Button Text Color: Hover', 'ut-elementor-addons-lite' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .slide-readmore:hover' => 'color: {{VALUE}};border-color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'ut_content_button_bg_color_hover',
            [
                'label'     => esc_html__( 'Button Background Color: Hover', 'ut-elementor-addons-lite' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .slide-readmore:hover' => 'background-color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'ut_button_border_hover',
            [
                'label' => esc_html__( 'Style', 'ul-elementor-addons-lite' ),
                'type' => Controls_Manager::SELECT,
                'options' => [
                    '' => esc_html__('None', 'ul-elementor-addons-lite'),
                    'solid' => esc_html__('Solid', 'ul-elementor-addons-lite'),
                    'double' => esc_html__('Double', 'ul-elementor-addons-lite'),
                    'dotted' => esc_html__('Dotted', 'ul-elementor-addons-lite'),
                    'dashed' => esc_html__('Dashed', 'ul-elementor-addons-lite'),
                    'groove' => esc_html__('Groove', 'ul-elementor-addons-lite'),
                ],
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} a.slide-readmore:hover' => 'border-style: {{VALUE}}',
                ],
            ]
        );

        $this->add_responsive_control(
            'ut_button_border_width_hover',
            [
                'label' => esc_html__( 'Border Width', 'ut-elementor-addons-lite' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors' => [
                    '{{WRAPPER}} a.slide-readmore:hover' => 'border-width: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'ut_button_border_color_hover',
            [
                'label'     => esc_html__( 'Button Border Color', 'ut-elementor-addons-lite' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .slide-readmore:hover' => 'border-color: {{VALUE}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'ut_button_border_radius_hover',
            [
                'label' => esc_html__( 'Border Radius', 'ut-elementor-addons-lite' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors' => [
                    '{{WRAPPER}} a.slide-readmore:hover' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'ut_button_box_shadow_hover',
                'label' => esc_html__( 'Box Shadow', 'ut-elementor-addons-lite' ),
                'selector' => '{{WRAPPER}} a.slide-readmore:hover',
            ]
        );

        $this->end_controls_tab();

        $this->end_controls_tabs();

        $this->add_control(
            'ut_button_divider',
            [
                'type' => Controls_Manager::DIVIDER,
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'      => 'ut_content_button_typography',
                'label'     => esc_html__('Button Typography', 'ut-elementor-addons-lite'),
                'scheme'    => Core\Schemes\Typography::TYPOGRAPHY_4,
                'selector' => '{{WRAPPER}} .slide-readmore',
            ]
        );

        $this->add_responsive_control(
            'ut_button_margin',
            [
                'label' => esc_html__( 'Margin', 'ut-elementor-addons-lite' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors' => [
                    '{{WRAPPER}} a.slide-readmore' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'ut_button_padding',
            [
                'label' => esc_html__( 'Padding', 'ut-elementor-addons-lite' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors' => [
                    '{{WRAPPER}} a.slide-readmore' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->end_controls_section();

        /* overlay */
        $this->start_controls_section(
            'ut_section_background_overlay',
            [
                'label' => esc_html__( 'Slider Overlay', 'ul-elementor-addons-lite' ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->start_controls_tabs( 'ut_tabs_background_overlay' );

        $this->start_controls_tab(
            'ut_tab_background_overlay_normal',
            [
                'label' => esc_html__( 'Normal', 'ul-elementor-addons-lite' ),
            ]
        );

        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name' => 'ut_background_overlay',
                'selector' => '{{WRAPPER}} .utal-carousel-overlay',
            ]
        );

        $this->add_control(
            'ut_background_overlay_opacity',
            [
                'label' => esc_html__( 'Opacity', 'ul-elementor-addons-lite' ),
                'type' => Controls_Manager::SLIDER,
                'default' => [
                    'size' => .5,
                ],
                'range' => [
                    'px' => [
                        'max' => 1,
                        'step' => 0.01,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .utal-carousel-overlay' => 'opacity: {{SIZE}};',
                ],
            ]
        );

        $this->end_controls_tab();

        $this->start_controls_tab(
            'ut_tab_background_overlay_hover',
            [
                'label' => esc_html__( 'Hover', 'ul-elementor-addons-lite' ),
            ]
        );

        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name' => 'ut_background_overlay_hover',
                'selector' => '{{WRAPPER}}:hover .utal-carousel-overlay',
            ]
        );

        $this->add_control(
            'ut_background_overlay_hover_opacity',
            [
                'label' => esc_html__( 'Opacity', 'ul-elementor-addons-lite' ),
                'type' => Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'max' => 1,
                        'step' => 0.1,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}}:hover .utal-carousel-overlay' => 'opacity: {{SIZE}};',
                ],
            ]
        );

        $this->end_controls_tab();

        $this->end_controls_tabs();

        $this->add_control(
            'ut_background_overlay_hover_transition',
            [
                'label' => esc_html__( 'Transition Duration', 'ul-elementor-addons-lite' ),
                'type' => Controls_Manager::SLIDER,                
                'range' => [
                    'px' => [
                        'max' => 5000,
                        'step' => 100,
                    ],
                ],
                'selector' => '{{WRAPPER}}:hover .utal-carousel-overlay',
                'separator' => 'before',
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'ut_image_section',
            [
                'label' => esc_html__( 'Image', 'ut-elementor-addons-lite' ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_responsive_control(
            'ut_pimage_radius',
            [
                'label' => esc_html__( 'Image Radius', 'ut-elementor-addons-lite' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => ['px', 'em', '%'],
                'selectors' => [
                    '{{WRAPPER}} .slide-image figure' => 'border-radius: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->end_controls_section();
    }

    protected function render()
    {
        $settings = $this->get_settings();
        $this->add_render_attribute('utal-carousel', 'class', 'utal-carousel');
        $this->add_render_attribute('utal-carousel', 'class', 'utal');
        /* Reset all actions in hook before starting*/
        $slider_type = isset($settings['slider_type']) ? $settings['slider_type'] : '';
        $slider_position = isset($settings['slider_position']) ? $settings['slider_position'] : 'right-bottom';
        $arrows = isset($settings['arrows']) ? $settings['arrows'] : 'no';
        $dots = isset($settings['dots']) ? $settings['dots'] : 'no';
        $autoplay = isset($settings['autoplay']) ? $settings['autoplay'] : 'no';
        $autoplay_speed = isset($settings['autoplay_speed']) ? $settings['autoplay_speed'] : '2000';
        $slidesToShow = isset($settings['slidesToShow']) ? $settings['slidesToShow'] : 3;
        $slidesToShow_tablet = isset($settings['slidesToShow_tablet']) ? $settings['slidesToShow_tablet'] : 2;
        $slidesToShow_mobile = isset($settings['slidesToShow_mobile']) ? $settings['slidesToShow_mobile'] : 1;
        $infinite_loop = isset($settings['infinite_loop']) ? $settings['infinite_loop'] : 'yes';
        $pauseOnHover = isset($settings['pauseOnHover']) ? $settings['pauseOnHover'] : 'yes';
        $dots_pos = isset($settings['dots_pos']) ? $settings['dots_pos'] : 'inside-box';
        $swipe = isset($settings['swipe']) ? $settings['swipe'] : 'yes';
        $container_text_align = isset($settings['container_text_align']) ? $settings['container_text_align'] : 'align-left';
        $pos = explode("-", $slider_position);

        $this->add_render_attribute('utal-carousel-slider', 'class', 'slick-slider');
        $this->add_render_attribute('utal-carousel-slider', 'data-arrows', $arrows);
        $this->add_render_attribute('utal-carousel-slider', 'data-dots', $dots);
        $this->add_render_attribute('utal-carousel-slider', 'data-infinit_loop', $infinite_loop);
        $this->add_render_attribute('utal-carousel-slider', 'data-pauseOnHover', $pauseOnHover);
        $this->add_render_attribute('utal-carousel-slider', 'data-swipe', $swipe);
        $this->add_render_attribute('utal-carousel-slider', 'data-autoplay', $autoplay);
        $this->add_render_attribute('utal-carousel-slider', 'data-autoplay_speed', $autoplay_speed);
        $this->add_render_attribute('utal-carousel-slider', 'data-slidesToShow', $slidesToShow);
        $this->add_render_attribute('utal-carousel-slider', 'data-slidesToShow-tablet', $slidesToShow_tablet);
        $this->add_render_attribute('utal-carousel-slider', 'data-slidesToShow-mobile', $slidesToShow_mobile);
        ?>
        <div <?php echo $this->get_render_attribute_string('utal-carousel'); ?>>
            <div class="utal-slider-wrapper <?php echo esc_attr($pos[0]) . ' ' . esc_attr($pos[1]) . ' ' . esc_attr($dots_pos) . ' ' . esc_attr($container_text_align); ?>">
                <div <?php echo $this->get_render_attribute_string('utal-carousel-slider'); ?>>
                    <?php
                    if ($settings['slides']) {
                        foreach ($settings['slides'] as $slide) {
                            $target = (isset($slide['slide_button_link']['is_external']) && ($slide['slide_button_link']['is_external'])) ? ' target="_blank"' : '';
                            $nofollow = (isset($slide['slide_button_link']['nofollow']) && ($slide['slide_button_link']['nofollow'])) ? ' rel="nofollow"' : '';
                            $url = (isset($slide['slide_button_link']['url']) && ($slide['slide_button_link']['url'])) ? $slide['slide_button_link']['url'] : '';
                            $slider = $slide['slider_image'];
                            echo '<div class="slide-wrap custom-slide-wrap elementor-repeater-item-' . $slide['_id'] . '">';
                            $slide_image = Group_Control_Image_Size::get_attachment_image_src($slider['id'], 'slider_image_size', $settings);
                            echo '<div class="slide-image">';
                            if ($url != '') {
                                echo '<a href="' . esc_url($url) . '"' . $target . $nofollow . '>';
                            }
                            echo '<figure><span class="utal-carousel-overlay overlay"></span>';
                            if (empty($slider['id'])) {
                                echo '<img src="' . esc_url($slider['url']) . '">';
                            } else {
                                echo '<img src="' . esc_url($slide_image) . '" alt="' . esc_attr($slide['slide_title']) . '">';
                            }

                            echo '</figure>';
                            if ($url != '') {
                                echo '</a>';
                            }
                            echo '</div>';
                            echo '<div class="slide-content-wrap ' . esc_attr($container_text_align) . '">';
                            if ($url != '') {
                                echo '<a href="' . esc_url($url) . '"' . $target . $nofollow . '>';
                            }
                            echo '<h3 class="slide-title">' . $slide['slide_title'] . '</h3>';
                            if ($url != '') {
                                echo '</a>';
                            }
                            echo '<div class="content-excerpt">' . $slide['slide_content'] . '</div>';
                            if ($url != '') {
                                echo '<div class="readmore-wrap"><a class="slide-readmore" href="' . esc_url($url) . '"' . $target . $nofollow . '>' . $slide['slide_button'] . ' </a></div>';
                            }
                            echo '</div></div>';
                        }
                    }
                    ?>
                </div>
            </div>
        </div>
        
        <?php
    }
}
Plugin::instance()->widgets_manager->register_widget_type(new UT_Elementor_Addons_Lite_Widget_Carousel());
