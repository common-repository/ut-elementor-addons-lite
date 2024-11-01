<?php

namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) exit; 

class UT_Elementor_Addons_Lite_Widget_Content_Ticker extends Widget_Base
{

    use \Elementor\UT_Elementor_Addons_Lite_Queries;

    public function get_name()
    {
        return 'utal-content-ticker';
    }

    public function get_title()
    {
        return  esc_html__( 'Content Ticker', 'ut-elementor-addons-lite' );
    }

    public function get_icon()
    {
        return 'eicon-archive-title ut-widget-icon';
    }

    public function get_categories()
    {
        return [ 'ut-elementor-addons-lite' ];
    }

    public function get_script_depends() {
        return [ 'ut-elementor-addons-lite-script', 'slick' ];
    }

    public function get_style_depends() {
        return [ 'slick' ];
    }

    protected function register_controls()
    {

        $this->start_controls_section(
            'ut_ticker_section',
            [
                'label' => esc_html__( 'Settings', 'ut-elementor-addons-lite' ),
                'tab' => Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'ut_ticker_title',
            [
                'label' => esc_html__( 'Heading Title', 'ut-elementor-addons-lite' ),
                'type' => Controls_Manager::TEXT,
                'default' => esc_html__( 'News Highlights', 'ut-elementor-addons-lite' ),
                'label_block' => true,
            ]
        );

        $this->add_control(
            'icon',
            [
                'label' => esc_html__( 'Icon', 'text-domain' ),
                'type' => \Elementor\Controls_Manager::ICONS,
                'default' => [
                    'value' => 'fas fa-star',
                    'library' => 'solid',
                ],
            ]
        );

        $this->add_control(
            'ticker_type',
            [
                'label'       => esc_html__( 'Content Type', 'ut-elementor-addons-lite' ),
                'type'        => Controls_Manager::SELECT,
                'label_block' => true,
                'default'       =>  'post',
                'options'      => [
                    'post'   => esc_html__( 'Post', 'ut-elementor-addons-lite' ),
                    'custom'   => esc_html__( 'Custom', 'ut-elementor-addons-lite' ),
                ],
            ]
        );

        $this->add_control(
            'ticker_design_style',
            [
                'label' => esc_html__( 'Heading Position', 'ut-elementor-addons-lite' ),
                'type' => \Elementor\Controls_Manager::SELECT,
                'default' => 'default',
                'options' => [
                    'default'  => esc_html__( 'Default', 'ut-elementor-addons-lite' ),
                    'header-top' => esc_html__( 'Top', 'ut-elementor-addons-lite' ),
                    'header-right' => esc_html__( 'Right', 'ut-elementor-addons-lite' ),
                    'header-bottom' => esc_html__( 'Bottom', 'ut-elementor-addons-lite' ),
                ],
            ]
        );

        $this->add_responsive_control(
            'container_min_height',
            [
                'label' => esc_html__( 'Heading Width', 'ut-elementor-addons-lite' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => ['%'],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 1400,
                    ],
                    '%' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .utal-ticker .utal-ticker-title-container' => 'width: {{SIZE}}{{UNIT}};',
                    '{{WRAPPER}} .utal-ticker .ticker-content-container' => 'width: {{SIZE}}{{UNIT}};',
                ],
                'condition' => [
                    'ticker_design_style' => ['default', 'header-right']
                ],
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'section_post_query',
            [
                'label'             => esc_html__( 'Query', 'ut-elementor-addons-lite' ),
                'condition' => [
                    'ticker_type' => 'post'
                ],
            ]
        );

        $this->query_controls(array('control_section' => false,'showposts' => false));

        $this->add_control(
            'showposts',
            [
                'label'             => esc_html__( 'No. of Post', 'ut-elementor-addons-lite' ),
                'type'              => Controls_Manager::NUMBER,
                'min'               => 1,
                'max'               => 10,
                'step'              => 1,
                'default'           => 4,
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'custom_ticker_section',
            [
                'label' => esc_html__( 'Custom Content', 'ut-elementor-addons-lite' ),
                'tab' => Controls_Manager::TAB_CONTENT,
                'condition' => [
                    'ticker_type' => 'custom'
                ],
            ]
        );

        $repeater = new Repeater();

        $repeater->add_control(
            'ticker_content',
            [
                'label' => esc_html__( 'Content', 'ut-elementor-addons-lite' ),
                'type' => Controls_Manager::TEXT,
                'default' => esc_html__( 'Lorem Ipsum is simply dummy text of the printing. ', 'ut-elementor-addons-lite' ),
                'label_block' => true,
            ]
        );

        $repeater->add_control(
            'ticker_link',
            [
                'label' => esc_html__( 'Link', 'ut-elementor-addons-lite' ),
                'type' => \Elementor\Controls_Manager::URL,
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
            'tickers',
            [
                'label' => esc_html__('Tickers', 'ut-elementor-addons-lite'),
                'type' => Controls_Manager::REPEATER,
                'fields' => $repeater->get_controls(),
                'default' => [
                    [
                        'ticker_content' => esc_html__( 'Lorem Ipsum is simply dummy text of the printing.', 'ut-elementor-addons-lite' ),
                    ],
                ],
                'title_field' => '{{{ ticker_content }}}',
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'section_testimonial_slider_setting',
            [
                'label'             => esc_html__( 'Slider Settings', 'ut-elementor-addons-lite' ),
                'tab' => Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_responsive_control(
            'arrows',
            [
                'label'             => esc_html__( 'Arrows', 'ut-elementor-addons-lite' ),
                'type'              => Controls_Manager::SWITCHER,
                'default'           => 'no',
                'label_on'          => esc_html__( 'Yes', 'ut-elementor-addons-lite' ),
                'label_off'         => esc_html__( 'No', 'ut-elementor-addons-lite' ),
                'return_value'      => 'yes',
                'devices' => ['desktop', 'tablet', 'mobile'],
                'desktop_default' => 'yes',
                'tablet_default' => 'yes',
                'mobile_default' => 'yes',
            ]
        );

        $this->add_control(
            'arrows_position',
            [
                'label' => esc_html__( 'Arrows Position', 'ut-elementor-addons-lite' ),
                'type' => \Elementor\Controls_Manager::SELECT,
                'default' => 'rtl',
                'options' => [
                    'rtl'  => esc_html__( 'Right', 'ut-elementor-addons-lite' ),
                    'ltr' => esc_html__( 'Left', 'ut-elementor-addons-lite' ),              
                ],
                'condition' => [
                    'arrows' => 'yes'
                ],
            ]
        );

        $this->add_responsive_control(
            'slidesToShow',
            [
                'label' => esc_html__( 'Slides to Show', 'ut-elementor-addons-lite' ),
                'type' => Controls_Manager::NUMBER,
                'min' => 1,
                'max' => 4,
                'step' => 1,
                'default' => '1',
                'devices' => [ 'desktop', 'tablet', 'mobile' ],
                'desktop_default' => 1,
                'tablet_default' => 1,
                'mobile_default' => 1,
            ]
        );

        $this->slider_settings(array('control_section' => false, 'slidesToShow' => false, 'arrows' => false,'dots' => false,'autoplay_speed'=>false,'autoplay'=>__return_false(  )));

        $this->add_control(
            'autoplay',
            [
                'label'             => esc_html__( 'Autoplay', 'ut-elementor-addons-lite' ),
                'type'              => Controls_Manager::SWITCHER,
                'default'           => 'yes',
                'label_on'          => esc_html__( 'Yes', 'ut-elementor-addons-lite' ),
                'label_off'         => esc_html__( 'No', 'ut-elementor-addons-lite' ),
                'return_value'      => 'yes',
            ]
        );

        $this->add_control(
            'autoplay_speed',
            [
                'label'             => esc_html__( 'Autoplay Speed', 'ut-elementor-addons-lite' ),
                'type'              => Controls_Manager::NUMBER,
                'default'           => '1000',
                'condition' => [
                    'ticker_animation' => ['default','fade']
                ],
            ]
        );

        $this->add_control(
            'autoplay_speed_1',
            [
                'label'             => esc_html__( 'Autoplay Speed', 'ut-elementor-addons-lite' ),
                'type'              => Controls_Manager::NUMBER,
                'default'           => '0',
                'condition' => [
                    'ticker_animation' => ['marquee']
                ],
            ]
        );

        $this->add_control(
            'animation_speed',
            [
                'label'             => esc_html__( 'Animation Speed', 'ut-elementor-addons-lite' ),
                'type'              => Controls_Manager::NUMBER,
                'default'           => '500',
                'description' => esc_html__( 'Set Autoplay Speed 0 and animation 5000 for marquee', 'ut-elementor-addons-lite' ),
                'condition' => [
                    'ticker_animation' => ['default','fade']
                ],
            ]
        );

        $this->add_control(
            'animation_speed_1',
            [
                'label'             => esc_html__( 'Animation Speed', 'ut-elementor-addons-lite' ),
                'type'              => Controls_Manager::NUMBER,
                'default'           => '5000',
                'description' => esc_html__( 'Set Autoplay Speed 0 and animation 5000 for marquee', 'ut-elementor-addons-lite' ),
                'condition' => [
                    'ticker_animation' => ['marquee']
                ],
            ]
        );

        $this->add_control(
            'ticker_direction',
            [
                'label' => esc_html__( 'Animation Direction', 'ut-elementor-addons-lite' ),
                'type' => \Elementor\Controls_Manager::SELECT,
                'default' => 'rtl',
                'options' => [
                    'rtl'  => esc_html__( 'Right to left', 'ut-elementor-addons-lite' ),
                    'ltr' => esc_html__( 'Left to Right', 'ut-elementor-addons-lite' ),
                  //'ttb' => esc_html__('Top to Bottom', 'ut-elementor-addons-lite'),
                    'btt' => esc_html__( 'Bottom to Top', 'ut-elementor-addons-lite' ),
                ],
            ]
        );

        $this->add_control(
            'ticker_animation',
            [
                'label' => esc_html__( 'Animation', 'ut-elementor-addons-lite' ),
                'type' => \Elementor\Controls_Manager::SELECT,
                'default' => 'default',
                'options' => [
                    'default'  => esc_html__( 'Default', 'ut-elementor-addons-lite' ),
                    'marquee'  => esc_html__( 'Marquee', 'ut-elementor-addons-lite' ),
                    'fade' => esc_html__( 'Fade', 'ut-elementor-addons-lite' ),
                ],
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'section_general_style',
            [
                'label' => esc_html__( 'Heading', 'ut-elementor-addons-lite' ),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'ut_ticker_title_color',
            [
                'label'     => esc_html__( 'Color', 'ut-elementor-addons-lite' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .utal-ticker .utal-ticker-title' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'      => 'ut_ticker_title_typography',
                'label'     => esc_html__( 'Typography', 'ut-elementor-addons-lite' ),
                'scheme'    => Core\Schemes\Typography::TYPOGRAPHY_4,
                'selector' => '{{WRAPPER}} .utal-ticker .utal-ticker-title',
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Background::get_type(),
            [
                'name' => 'ut_ticker_title_background',
                'label' => esc_html__( 'Background', 'ut-elementor-addons-lite' ),
                'types' => ['classic', 'gradient', 'video'],
                'selector' => '{{WRAPPER}} .utal-ticker .utal-ticker-title-container',
            ]
        );

        $this->add_responsive_control(
            'ut_content_heading_align',
            [
                'label' => esc_html__( 'Text Alignment', 'ut-elementor-addons-lite' ),
                'type' => Controls_Manager::CHOOSE,
                'options' => [
                    'align-left' => [
                        'title' => esc_html__( 'Left', 'ut-elementor-addons-lite' ),
                        'icon' => 'fa fa-align-left',
                    ],
                    'align-center' => [
                        'title' => esc_html__( 'Center', 'ut-elementor-addons-lite' ),
                        'icon' => 'fa fa-align-center',
                    ],
                    'align-right' => [
                        'title' => esc_html__( 'Right', 'ut-elementor-addons-lite' ),
                        'icon' => 'fa fa-align-right',
                    ],
                ],
                'default' => 'align-left',
                'toggle' => true,
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'ut_section_general_icon_style',
            [
                'label' => esc_html__( 'Icon', 'ut-elementor-addons-lite' ),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'ut_ticker_icon_color',
            [
                'label'     => esc_html__( 'Color', 'ut-elementor-addons-lite' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .utal-ticker .utal-ticker-icon' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'ut_ticker_icon_size',
            [
                'label' => esc_html__( 'Size', 'ut-elementor-addons-lite' ),
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
                ],
                'selectors' => [
                    '{{WRAPPER}} .utal-ticker .utal-ticker-icon' => 'font-size: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'ut_section_general_content_style',
            [
                'label' => esc_html__( 'Content', 'ut-elementor-addons-lite' ),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->start_controls_tabs(
            'ut_category_tabs'
        );

        $this->start_controls_tab(
            'ut_category_tab1',
            [
                'label' => esc_html__( 'Normal', 'ut-elementor-addons-lite' ),
            ]
        );

        $this->add_control(
            'ut_ticker_content_color',
            [
                'label'     => esc_html__( 'Color', 'ut-elementor-addons-lite' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .utal-ticker .utal-ticker-content' => 'color: {{VALUE}};',
                ], 
            ] 
        );

        $this->end_controls_tab();

        $this->start_controls_tab(
            'ut_category_tab2',
            [
                'label' => esc_html__( 'Hover', 'ut-elementor-addons-lite' ),
            ]
        );

        $this->add_control(
            'ut_ticker_content_hover_color',
            [
                'label'     => esc_html__( 'Hover Color', 'ut-elementor-addons-lite' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .utal-ticker .utal-ticker-content:hover' => 'color: {{VALUE}};',
                ],
            ]

        );
        $this->end_controls_tab();

        $this->end_controls_tabs();

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'      => 'ut_ticker_content_typography',
                'label'     => esc_html__('Typography', 'ut-elementor-addons-lite'),
                'scheme'    => Core\Schemes\Typography::TYPOGRAPHY_4,
                'selector' => '{{WRAPPER}} .utal-ticker .utal-ticker-content',
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Background::get_type(),
            [
                'name' => 'ut_ticker_content_background',
                'label' => esc_html__( 'Background', 'ut-elementor-addons-lite' ),
                'types' => ['classic', 'gradient'],
                'selector' => '{{WRAPPER}} .utal-ticker .ticker-content-container',
            ]
        );

        $this->add_control(
            'ut_hr1',
            [
                'type' => \Elementor\Controls_Manager::DIVIDER,
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

        $this->add_group_control(
            \Elementor\Group_Control_Background::get_type(),
            [
                'name' => 'ut_container_bgcolor',
                'label' => esc_html__( 'Background', 'ut-elementor-addons-lite' ),
                'types' => ['classic', 'gradient'],
                'selector' => '{{WRAPPER}} .utal-ticker',
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
                        'max' => 1400,
                    ],
                    '%' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .utal-ticker' => 'min-width: {{SIZE}}{{UNIT}}; width: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'ut_container_height',
            [
                'label' => esc_html__( 'Container Height', 'ut-elementor-addons-lite' ),
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
                    '{{WRAPPER}} .utal-ticker .utal-ticker-wrapper' => 'height: {{SIZE}}{{UNIT}}; min-height: {{SIZE}}{{UNIT}};',
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
                        'icon' => 'fa fa-align-left',
                    ],
                    'align-center' => [
                        'title' => esc_html__( 'Center', 'ut-elementor-addons-lite' ),
                        'icon' => 'fa fa-align-center',
                    ],
                    'align-right' => [
                        'title' => esc_html__( 'Right', 'ut-elementor-addons-lite' ),
                        'icon' => 'fa fa-align-right',
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
                    '{{WRAPPER}} .utal-ticker' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
                    '{{WRAPPER}} .utal-ticker' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],  
            ]
        );

        $this->end_controls_section();

    }

    protected function render()
    {
        $settings = $this->get_settings();
        $this->add_render_attribute('utal-ticker', 'class', 'utal-ticker utal');
        /* Reset all actions in hook before starting*/
        remove_all_actions('utal_pos_top');
        remove_all_actions('utal_pos_middle');
        remove_all_actions('utal_pos_bottom');

        $ticker_type = isset( $settings['ticker_type'] ) ? $settings['ticker_type'] : '';
        $ticker_design_style = isset( $settings['ticker_design_style'] ) ? $settings['ticker_design_style'] : 'default';
        $arrows = isset( $settings['arrows'] ) ? $settings['arrows'] : 'no';
        $arrows_tablet = isset( $settings['arrows_tablet'] ) ? $settings['arrows_tablet'] : 'no';
        $arrows_mobile = isset( $settings['arrows_mobile'] ) ? $settings['arrows_mobile'] : 'no';
        $dots = isset( $settings['dots'] ) ? $settings['dots'] : 'no';
        $autoplay = isset( $settings['autoplay'] ) ? $settings['autoplay'] : 'yes';

        $ticker_animation = isset( $settings['ticker_animation'] ) ? $settings['ticker_animation'] : 'default';
        if($ticker_animation!='marquee'){
            $autoplay_speed = isset( $settings['autoplay_speed'] ) ? $settings['autoplay_speed'] : '1000';
            $animation_speed = isset( $settings['animation_speed'] ) ? $settings['animation_speed'] : '500';
        }else{
            $autoplay_speed = isset( $settings['autoplay_speed_1'] ) ? $settings['autoplay_speed_1'] : '0';
            $animation_speed = isset( $settings['animation_speed_1'] ) ? $settings['animation_speed_1'] : '5000';
        }        
        $slidesToShow = isset( $settings['slidesToShow'] ) ? $settings['slidesToShow'] : 1;
        $slidesToShow_tablet = isset( $settings['slidesToShow_tablet'] ) ? $settings['slidesToShow_tablet'] : 1;
        $slidesToShow_mobile = isset( $settings['slidesToShow_mobile'] ) ? $settings['slidesToShow_mobile'] : 1;
        $infinite_loop = isset( $settings['infinite_loop'] ) ? $settings['infinite_loop'] : 'yes';
        $pauseOnHover = isset( $settings['pauseOnHover'] ) ? $settings['pauseOnHover'] : 'yes';
        $dots_pos = isset( $settings['dots_pos'] ) ? $settings['dots_pos'] : 'inside-box';
        $swipe = isset( $settings['swipe'] ) ? $settings['swipe'] : 'yes';
        $columns = isset( $settings['columns'] ) ? $settings['columns'] : 3;
        $columns_tablet = isset( $settings['columns_tablet'] ) ? $settings['columns_tablet'] : 2;
        $columns_mobile = isset( $settings['columns_mobile'] ) ? $settings['columns_mobile'] : 1;
        $ut_container_text_align = isset( $settings['ut_container_text_align'] ) ? $settings['ut_container_text_align'] : 'align-left';
        $content_heading_align = isset( $settings['content_heading_align'] ) ? $settings['content_heading_align'] : 'align-left';
        $content_heading_align_tablet = isset( $settings['content_heading_align_tablet'] ) ? $settings['content_heading_align_tablet'] : 'align-left';
        $content_heading_align_mobile = isset( $settings['content_heading_align_mobile'] ) ? $settings['content_heading_align_mobile'] : 'align-left';
        $arrows_position = isset( $settings['arrows_position'] ) ? $settings['arrows_position'] : 'rtl';   
        $ticker_direction = isset( $settings['ticker_direction'] ) ? $settings['ticker_direction'] : 'rtl';   

        $new_direction='';
        if($ticker_direction=='ltr'){
            $new_direction='rtl';
        }
        $this->add_render_attribute('utal-ticker-slider', 'class', 'ticker-content-container');
        $this->add_render_attribute('utal-ticker-slider', 'class', 'ticker-arrows-position-'.$arrows_position);
        $this->add_render_attribute('utal-ticker-slider', 'data-arrows', $arrows);
        $this->add_render_attribute('utal-ticker-slider', 'data-arrows-tablet', $arrows_tablet);
        $this->add_render_attribute('utal-ticker-slider', 'data-arrows-mobile', $arrows_mobile);        
        $this->add_render_attribute('utal-ticker-slider', 'data-slidesToShow', $slidesToShow);
        $this->add_render_attribute('utal-ticker-slider', 'data-slidesToShow-tablet', $slidesToShow_tablet);
        $this->add_render_attribute('utal-ticker-slider', 'data-slidesToShow-mobile', $slidesToShow_mobile);
        $this->add_render_attribute('utal-ticker-slider', 'data-infinit_loop', $infinite_loop);
        $this->add_render_attribute('utal-ticker-slider', 'data-pauseOnHover', $pauseOnHover);
        $this->add_render_attribute('utal-ticker-slider', 'data-swipe', $swipe);
        $this->add_render_attribute('utal-ticker-slider', 'data-autoplay', $autoplay);
        $this->add_render_attribute('utal-ticker-slider', 'data-autoplay_speed', $autoplay_speed);
        $this->add_render_attribute('utal-ticker-slider', 'data-direction', $ticker_direction);
        $this->add_render_attribute('utal-ticker-slider', 'data-animation', $ticker_animation);
        $this->add_render_attribute('utal-ticker-slider', 'data-animation-speed', $animation_speed);
        $this->add_render_attribute('utal-ticker-slider', 'dir', $new_direction);

        ?>
        <div <?php echo $this->get_render_attribute_string('utal-ticker'); ?>>
            <div class="utal-ticker-wrapper utal-ticker-design-style-<?php echo $ticker_design_style .' '.$ut_container_text_align; ?> ">

                <?php
                if ($ticker_design_style == 'default' || $ticker_design_style == 'header-top') {
                    ?>
                    <div class="utal-ticker-title-container">
                        <div class="utal-ticker-icon">
                            <?php \Elementor\Icons_Manager::render_icon( $settings['icon'], [ 'aria-hidden' => 'true' ] ); ?>
                        </div>
                        <div class="utal-ticker-title <?php echo  'desktop-'.esc_attr($content_heading_align) .' tablet-'.esc_attr($content_heading_align_tablet) .' mobile-'.esc_attr($content_heading_align_mobile); ?> "><?php echo esc_attr($settings['ut_ticker_title']); ?></div>
                    </div>
                <?php } ?>
                <div <?php echo $this->get_render_attribute_string('utal-ticker-slider'); ?>>
                    <?php 
                    if ($ticker_type == 'post') {
                        $date_pos = isset( $settings['meta_date_pos'] ) ? $settings['meta_date_pos'] : 'middle';
                        $author_pos = isset( $settings['meta_author_pos'] ) ? $settings['meta_author_pos'] : 'middle';
                        $categories_pos = isset( $settings['meta_categories_pos'] ) ? $settings['meta_categories_pos'] : 'top';
                        $date = isset( $settings['meta_date'] ) ? $settings['meta_date'] : '';
                        $author = isset( $settings['meta_author'] ) ? $settings['meta_author'] : '';
                        $categories = isset( $settings['meta_categories'] ) ? $settings['meta_categories'] : '';
                        $date ? add_action('utal_pos_' . $date_pos, 'ut_elementor_addons_lite_post_date') : ''; 
                        $author ? add_action('utal_pos_' . $author_pos, 'ut_elementor_addons_lite_post_author') : ''; 
                        $categories ? add_action('utal_pos_' . $categories_pos, 'ut_elementor_addons_lite_post_categories') : '';
                        $showposts = isset( $settings['showposts'] ) ? $settings['showposts'] : '4';
                        $title_show = isset( $settings['content_title_show'] ) ? $settings['content_title_show'] : 'yes';
                        $title_tag = isset( $settings['content_title_tag'] ) ? $settings['content_title_tag'] : 'h3';
                        $readmore_show = isset( $settings['content_readmore_show'] ) ? $settings['content_readmore_show'] : 'yes';
                        $excerpt_show = isset( $settings['content_excerpts_show'] ) ? $settings['content_excerpts_show'] : 'yes';
                        $excerpt = isset( $settings['content_excerpts'] ) ? $settings['content_excerpts'] : 200;
                        $readmore = isset( $settings['readmore'] ) ? $settings['readmore'] : esc_html__('Read More', 'ut-elementor-addons-lite');
                        $fallback_image = isset( $settings['fallback_image'] ) ? $settings['fallback_image'] : '';
                        $block_args = ut_elementor_addons_lite_query($settings, $first_id = '', $showposts);
                        $query = new \WP_Query($block_args);
                        if ($query->have_posts()) :
                            while ($query->have_posts()) : $query->the_post();
                                ?>
                                <div class="utal-ticker-content">
                                    <a class="utal-ticker-content" href="<?php the_permalink(); ?>">
                                        <span class="utal-ticker-content >"><?php the_title(); ?> </span>
                                    </a>
                                </div>
                                <?php
                            endwhile;
                            wp_reset_postdata();
                        endif;
                    } else {
                        if ($settings['tickers']) {
                            foreach ($settings['tickers'] as $ticker) {
                                $target = $ticker['ticker_link']['is_external'] ? ' target="_blank"' : '';
                                $nofollow = $ticker['ticker_link']['nofollow'] ? ' rel="nofollow"' : '';
                                $url = $ticker['ticker_link']['url'];
                                if ($url != '') {
                                    echo '<div class="utal-ticker-content"><a href="' . $url . '"' . $target . $nofollow . '>';
                                    echo '<span class="utal-ticker-content utal-ticker-content-' . $ticker['_id'] . '" >' . $ticker['ticker_content'] . '</span>';
                                    echo '</a></div>';
                                } else {
                                    echo '<div class="utal-ticker-content">';
                                    echo '<span class="utal-ticker-content utal-ticker-content-' . $ticker['_id'] . '" >' . $ticker['ticker_content'] . '</span>';
                                    echo '</div>';
                                }
                            }
                        }
                    }
                    ?>
                </div>
                <?php
                if ($ticker_design_style == 'header-right' || $ticker_design_style == 'header-bottom') {
                    ?>
                    <div class="utal-ticker-title-container ">
                        <div class="utal-ticker-icon">
                            <?php \Elementor\Icons_Manager::render_icon( $settings['icon'], [ 'aria-hidden' => 'true' ] ); ?>
                        </div>
                        <div class="utal-ticker-title <?php echo  'desktop-'. esc_attr($content_heading_align) .' tablet-'. esc_attr($content_heading_align_tablet) .' mobile-'. esc_attr($content_heading_align_mobile); ?> " ><?php echo esc_attr($settings['ut_ticker_title']); ?></div>
                    </div>
                <?php } ?>
            </div>
        </div>
        
        <?php
    }
}
Plugin::instance()->widgets_manager->register_widget_type(new UT_Elementor_Addons_Lite_Widget_Content_Ticker());
