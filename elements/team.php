<?php

namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) exit; 

class UT_Elementor_Addons_Lite_Widget_Team extends Widget_Base
{

    use \Elementor\UT_Elementor_Addons_Lite_Queries;

    public function get_name()
    {
        return 'utal-team';
    }

    public function get_title()
    {
        return  esc_html__( 'Team', 'ut-elementor-addons-lite' );
    }

    public function get_icon()
    {
        return 'eicon-person ut-widget-icon';
    }

    public function get_categories()
    {
        return ['ut-elementor-addons-lite'];
    }

    protected function register_controls()
    {

        $this->start_controls_section(
            'ut_team_section',
            [
                'label' => esc_html__( 'General', 'ut-elementor-addons-lite' ),
                'tab' => Controls_Manager::TAB_CONTENT,

            ]
        );

        $repeater = new Repeater();

        $repeater->add_control(
            'ut_team_name',
            [
                'label' => esc_html__( 'Name', 'ut-elementor-addons-lite' ),
                'type' => Controls_Manager::TEXT,
                'default' => esc_html__( 'John Doe', 'ut-elementor-addons-lite' ),
                'label_block' => false,
            ]
        );

        $repeater->add_control(
            'ut_team_sub_title',
            [
                'label' => esc_html__( 'Sub Title', 'ut-elementor-addons-lite' ),
                'type' => Controls_Manager::TEXT,
                'default' => esc_html__( 'Company Name', 'ut-elementor-addons-lite' ),
                'label_block' => false,
            ]
        );

        $repeater->add_control(
            'ut_team_image',
            [
                'label' => esc_html__( 'Choose Image', 'ut-elementor-addons-lite' ),
                'type' => \Elementor\Controls_Manager::MEDIA,
                'default' => [
                    'url' => \Elementor\Utils::get_placeholder_image_src(),
                ],
            ]
        );

        $repeater->add_group_control(
            \Elementor\Group_Control_Image_Size::get_type(),
            [ 
                'name' => 'thumbnail', 
                'exclude' => ['custom'],
                'include' => [],
                'default' => 'full',
            ]
        );

        $repeater->add_control(
            'ut_team_fb_link',
            [
                'label' => esc_html__( 'Facebook Link', 'ut-elementor-addons-lite' ),
                'type' => \Elementor\Controls_Manager::URL,
                'placeholder' => 'https://your-link.com',
                'show_external' => false,

            ]
        );

        $repeater->add_control(
            'ut_team_tw_link',
            [
                'label' => esc_html__( 'Twitter Link', 'ut-elementor-addons-lite' ),
                'type' => \Elementor\Controls_Manager::URL,
                'placeholder' => 'https://your-link.com',
                'show_external' => false,
                'default' => [
                    'url' => '',
                    'is_external' => true,
                    'nofollow' => true,
                ],
            ]
        );

        $repeater->add_control(
            'ut_team_yt_link',
            [
                'label' => esc_html__( 'Youtube Link', 'ut-elementor-addons-lite' ),
                'type' => \Elementor\Controls_Manager::URL,
                'placeholder' => 'https://your-link.com',
                'show_external' => false,
                'default' => [
                    'url' => '',
                    'is_external' => true,
                    'nofollow' => true,
                ],
            ]
        );

        $repeater->add_control(
            'ut_team_ln_link',
            [
                'label' => esc_html__( 'Linkedin Link', 'ut-elementor-addons-lite' ),
                'type' => \Elementor\Controls_Manager::URL,
                'placeholder' => 'https://your-link.com',
                'show_external' => true,
                'default' => [
                    'url' => '',
                    'is_external' => true,
                    'nofollow' => true,
                ],
            ]
        );

        $repeater->add_control(
            'ut_team_ins_link',
            [
                'label' => esc_html__( 'Instagram Link', 'ut-elementor-addons-lite' ),
                'type' => \Elementor\Controls_Manager::URL,
                'placeholder' => 'https://your-link.com',
                'show_external' => true,
                'default' => [
                    'url' => '',
                    'is_external' => true,
                    'nofollow' => true,
                ],
            ]
        );

        $repeater->add_control(
            'ut_team_web_link',
            [
                'label' => esc_html__( 'Web Link', 'ut-elementor-addons-lite' ),
                'type' => \Elementor\Controls_Manager::URL,
                'placeholder' => 'https://your-link.com',
                'show_external' => true,
                'default' => [
                    'url' => '',
                    'is_external' => true,
                    'nofollow' => true,
                ],
            ]
        );

        $this->add_control(
            'teams',
            [
                'label' => esc_html__( 'Teams', 'ut-elementor-addons-lite' ),
                'type' => Controls_Manager::REPEATER,
                'fields' => $repeater->get_controls(),
                'default' => [
                    [
                        'ut_team_name' => esc_html__( 'John Doe', 'ut-elementor-addons-lite' ),
                        'ut_team_sub_title' => esc_html__('Developer', 'ut-elementor-addons-lite' ),

                    ],
                ],
                'title_field' => '{{{ ut_team_name }}}',
            ]
        );      

        $this->end_controls_section();

        $this->start_controls_section(
            'ut_section_settings_style',
            [
                'label'             => esc_html__( 'Settings', 'ut-elementor-addons-lite' ),
                'tab'   => Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'ut_team_design_layout',
            [
                'label' => esc_html__( 'Design Layout', 'ut-elementor-addons-lite' ),
                'type' => \Elementor\Controls_Manager::SELECT,
                'default' => 'layout-1',
                'options' => [
                    'layout-1'  => esc_html__( 'Layout 1', 'ut-elementor-addons-lite' ),
                    'layout-2' => esc_html__( 'Layout 2', 'ut-elementor-addons-lite' ),
                    'layout-3' => esc_html__( 'Layout 3', 'ut-elementor-addons-lite' ),

                ],
            ]
        );

        $this->add_responsive_control(
            'ut_columns',
            [
                'label' => esc_html__( 'Columns to Show', 'ut-elementor-addons-lite' ),
                'type' => Controls_Manager::NUMBER,
                'min' => 1,
                'max' => 4,
                'step' => 1,
                'devices' => ['desktop', 'tablet', 'mobile'],
                'desktop_default' => 3,
                'tablet_default' => 2,
                'mobile_default' => 1,

            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'section_general_name_style',
            [
                'label' => esc_html__( 'Name', 'ut-elementor-addons-lite' ),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'content_title_color',
            [
                'label'     => esc_html__( 'Color', 'ut-elementor-addons-lite' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .utal-team .utal-team-title' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'      => 'content_title_typography',
                'label'     => esc_html__( 'Typography', 'ut-elementor-addons-lite' ),
                'scheme'    => Core\Schemes\Typography::TYPOGRAPHY_4,
                'selector' => '{{WRAPPER}} .utal-team .utal-team-title',
            ]
        );

        $this->add_control(
            'ut_content_title_align',
            [
                'label' => esc_html__( 'Alignment', 'ut-elementor-addons-lite' ),
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
                'default' => 'align-center',
                'toggle' => true,
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'section_subtitle_style',
            [
                'label' => esc_html__( 'Sub Title', 'ut-elementor-addons-lite' ),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'content_subtitle_color',
            [
                'label'     => esc_html__( 'Color', 'ut-elementor-addons-lite' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .utal-team .utal-subtitle' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'      => 'content_subtitle_typography',
                'label'     => esc_html__( 'Typography', 'ut-elementor-addons-lite' ),
                'scheme'    => Core\Schemes\Typography::TYPOGRAPHY_4,
                'selector' => '{{WRAPPER}} .utal-team .utal-subtitle',
            ]
        );

        $this->add_control(
            'ut_content_subtitle_align',
            [
                'label' => esc_html__( 'Alignment', 'ut-elementor-addons-lite' ),
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
                'default' => 'align-center',
                'toggle' => true,
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'section_icon_style',
            [
                'label' => esc_html__( 'Icons', 'ut-elementor-addons-lite' ),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_responsive_control(
            'ticker_icon_size',
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
                    '{{WRAPPER}} .utal-team .utal-team-social' => 'font-size: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'ut_content_icon_align',
            [
                'label' => esc_html__( 'Alignment', 'ut-elementor-addons-lite' ),
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
                'default' => 'align-center',
                'toggle' => true,
            ]
        );

        $this->start_controls_tabs(
            'category_tabs'
        );

        $this->start_controls_tab(
            'category_tab1',
            [
                'label' => esc_html__( 'Normal', 'ut-elementor-addons-lite' ),
            ]
        );

        $this->add_control(
            'content_fb_color',
            [
                'label'     => esc_html__( 'Facebook Color', 'ut-elementor-addons-lite' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .utal-team .utal-team-social .utal-team-facebook' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'content_fb_bg_color',
            [
                'label'     => esc_html__( 'Facebook Background Color', 'ut-elementor-addons-lite' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .utal-team .utal-team-social .utal-team-facebook' => 'background-color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'hr',
            [
                'type' => \Elementor\Controls_Manager::DIVIDER,
            ]
        );

        $this->add_control(
            'content_tw_color',
            [
                'label'     => esc_html__( 'Twitter Color', 'ut-elementor-addons-lite' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .utal-team .utal-team-social .utal-team-twitter' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'content_tw_bg_color',
            [
                'label'     => esc_html__( 'Twitter Background Color', 'ut-elementor-addons-lite' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .utal-team .utal-team-social .utal-team-twitter' => 'background-color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'hr1',
            [
                'type' => \Elementor\Controls_Manager::DIVIDER,
            ]
        );

        $this->add_control(
            'content_yt_color',
            [
                'label'     => esc_html__( 'Youtube Color', 'ut-elementor-addons-lite' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .utal-team .utal-team-social .utal-team-youtube' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'content_yt_bg_color',
            [
                'label'     => esc_html__( 'Youtube Background Color', 'ut-elementor-addons-lite' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .utal-team .utal-team-social .utal-team-youtube' => 'background-color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'hr2',
            [
                'type' => \Elementor\Controls_Manager::DIVIDER,
            ]
        );

        $this->add_control(
            'content_ln_color',
            [
                'label'     => esc_html__( 'Linkedin Color', 'ut-elementor-addons-lite' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .utal-team .utal-team-social .utal-team-linkedin' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'content_ln_bg_color',
            [
                'label'     => esc_html__( 'Linkedin Background Color', 'ut-elementor-addons-lite' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .utal-team .utal-team-social .utal-team-linkedin' => 'background-color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'hr3',
            [
                'type' => \Elementor\Controls_Manager::DIVIDER,
            ]
        );

        $this->add_control(
            'content_in_color',
            [
                'label'     => esc_html__( 'Instagram Color', 'ut-elementor-addons-lite' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .utal-team .utal-team-social .utal-team-instagram' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'content_in_bg_color',
            [
                'label'     => esc_html__( 'Instagram Background Color', 'ut-elementor-addons-lite' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .utal-team .utal-team-social .utal-team-instagram' => 'background-color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'hr4',
            [
                'type' => \Elementor\Controls_Manager::DIVIDER,
            ]
        );

        $this->add_control(
            'content_wb_color',
            [
                'label'     => esc_html__( 'Web Color', 'ut-elementor-addons-lite' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .utal-team .utal-team-social .utal-team-web' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'content_wb_bg_color',
            [
                'label'     => esc_html__( 'Web Background Color', 'ut-elementor-addons-lite' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .utal-team .utal-team-social .utal-team-web' => 'background-color: {{VALUE}};',
                ],
            ]
        );

        $this->end_controls_tab();

        $this->start_controls_tab(
            'category_tab2',
            [
                'label' => esc_html__( 'Hover', 'ut-elementor-addons-lite' ),
            ]
        );

        $this->add_control(
            'content_fb_color_hover',
            [
                'label'     => esc_html__( 'Facebook Color: Hover', 'ut-elementor-addons-lite' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .utal-team .utal-team-social .utal-team-facebook:hover' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'content_fb_bg_color_hover',
            [
                'label'     => esc_html__( 'Facebook Background Color: Hover', 'ut-elementor-addons-lite' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .utal-team .utal-team-social .utal-team-facebook:hover' => 'background-color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'hr_1',
            [
                'type' => \Elementor\Controls_Manager::DIVIDER,
            ]
        );

        $this->add_control(
            'content_tw_color_hover',
            [
                'label'     => esc_html__( 'Twitter Color: Hover', 'ut-elementor-addons-lite' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .utal-team .utal-team-social .utal-team-twitter:hover' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'content_tw_bg_color_hover',
            [
                'label'     => esc_html__( 'Twitter Background Color: Hover', 'ut-elementor-addons-lite' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .utal-team .utal-team-social .utal-team-twitter:hover' => 'background-color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'hr_2',
            [
                'type' => \Elementor\Controls_Manager::DIVIDER,
            ]
        );

        $this->add_control(
            'content_yt_color_hover',
            [
                'label'     => esc_html__( 'Youtube Color: Hover', 'ut-elementor-addons-lite' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .utal-team .utal-team-social .utal-team-youtube:hover' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'content_yt_bg_color_hover',
            [
                'label'     => esc_html__( 'Youtube Background Color: Hover', 'ut-elementor-addons-lite' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .utal-team .utal-team-social .utal-team-youtube:hover' => 'background-color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'hr_3',
            [
                'type' => \Elementor\Controls_Manager::DIVIDER,
            ]
        );

        $this->add_control(
            'content_ln_color_hover',
            [
                'label'     => esc_html__( 'Linkedin Color: Hover', 'ut-elementor-addons-lite' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .utal-team .utal-team-social .utal-team-linkedin:hover' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'content_ln_bg_color_hover',
            [
                'label'     => esc_html__( 'Linkedin Background Color: Hover', 'ut-elementor-addons-lite' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .utal-team .utal-team-social .utal-team-linkedin:hover' => 'background-color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'hr_4',
            [
                'type' => \Elementor\Controls_Manager::DIVIDER,
            ]
        );

        $this->add_control(
            'content_in_color_hover',
            [
                'label'     => esc_html__( 'Instagram Color: Hover', 'ut-elementor-addons-lite' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .utal-team .utal-team-social .utal-team-instagram:hover' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'content_in_bg_color_hover',
            [
                'label'     => esc_html__( 'Instagram Background Color: Hover', 'ut-elementor-addons-lite' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .utal-team .utal-team-social .utal-team-instagram:hover' => 'background-color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'hr_5',
            [
                'type' => \Elementor\Controls_Manager::DIVIDER,
            ]
        );

        $this->add_control(
            'content_wb_color_hover',
            [
                'label'     => esc_html__( 'Web Color: Hover', 'ut-elementor-addons-lite' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .utal-team .utal-team-social .utal-team-web:hover' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'content_wb_bg_color_hover',
            [
                'label'     => esc_html__( 'Web Background Color: Hover', 'ut-elementor-addons-lite' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .utal-team .utal-team-social .utal-team-web:hover' => 'background-color: {{VALUE}};',
                ],
            ]
        );

        $this->end_controls_tab();

        $this->end_controls_tabs();

        $this->end_controls_section();

        $this->start_controls_section(
            'section_image_style',
            [
                'label' => esc_html__( 'Image', 'ut-elementor-addons-lite' ),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'ut_team_image_style',
            [
                'label'     => esc_html__( 'Image Style', 'ut-elementor-addons-lite' ),
                'type' => \Elementor\Controls_Manager::SELECT,
                'default' => 'square',
                'options' => [
                    'square'  => esc_html__( 'Square', 'ut-elementor-addons-lite' ),
                    'circle' => esc_html__( 'Circle', 'ut-elementor-addons-lite' ),

                ],
            ]
        );

        $this->add_responsive_control(
            'team_image_width',
            [
                'label'     => esc_html__( 'Width', 'ut-elementor-addons-lite'),
                'type' => Controls_Manager::SLIDER,
                'size_units' => ['px', '%'],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 1000,
                        'step' => 5,
                    ],
                    '%' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                ],
                'default' => [
                    'unit' => '%',
                    'size' => 50,
                ],
                'selectors' => [
                    '{{WRAPPER}} .utal-team .utal-team-image' => 'width: {{SIZE}}{{UNIT}};',
                ],
                'condition' => [
                    'ut_team_image_style' => ['square']
                ],
            ]
        );

        $this->add_responsive_control(
            'team_image_max_width',
            [
                'label'     => esc_html__( 'Max. Width', 'ut-elementor-addons-lite' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => ['px', '%'],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 1000,
                        'step' => 5,
                    ],
                    '%' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                ],
                'default' => [
                    'unit' => '%',
                    'size' => 50,
                ],
                'selectors' => [
                    '{{WRAPPER}} .utal-team .utal-team-image' => 'max-width: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->end_controls_section();

    //start new section Content Container
        $this->start_controls_section(
            'section_content_container',
            [
                'label' => esc_html__( 'Content Container', 'ut-elementor-addons-lite' ),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->start_controls_tabs(
            'new_category_tabs'
        );

        $this->start_controls_tab(
            'category_tab_1',
            [
                'label' => esc_html__( 'Normal', 'ut-elementor-addons-lite' ),
            ]
        );

        $this->add_control(
            'container_bgcolor',
            [
                'label'     => esc_html__( 'Background', 'ut-elementor-addons-lite' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .utal-team .slide-content-wrap' => 'background-color: {{VALUE}};',
                ],
            ]
        );

        $this->end_controls_tab();

        $this->start_controls_tab(
            'category_tab_2',
            [
                'label' => esc_html__( 'Hover', 'ut-elementor-addons-lite' ),
            ]
        );

        $this->add_control(
            'container_bgcolor_hover',
            [
                'label'     => esc_html__( 'Background: Hover', 'ut-elementor-addons-lite' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .utal-team .slide-content-wrap:hover' => 'background-color: {{VALUE}};',
                ],
            ]
        );

        $this->end_controls_tab();

        $this->end_controls_tabs();

        $this->add_responsive_control(
            'container_width',
            [
                'label' => esc_html__( 'Width', 'ut-elementor-addons-lite' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => ['px', '%'],
                'separator' => 'before',
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 1200,
                    ],
                    '%' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .utal-team  .utal-team-wrapper' => 'min-width: {{SIZE}}{{UNIT}}; width: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'container_height',
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
                    '{{WRAPPER}} .utal-team .utal-team-wrapper' => 'min-height: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'container_margin',
            [
                'label' => esc_html__( 'Margin', 'ut-elementor-addons-lite' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors' => [
                    '{{WRAPPER}} .utal-team .utal-team-wrap' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'container_padding',
            [
                'label' => esc_html__( 'Padding', 'ut-elementor-addons-lite' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors' => [
                    '{{WRAPPER}} .utal-team .slide-content-wrap' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->end_controls_section();

    }

    protected function render()
    {
        $settings = $this->get_settings();
        /* Reset all actions in hook before starting*/
        remove_all_actions( 'utal_pos_top' );
        remove_all_actions( 'utal_pos_middle' );
        remove_all_actions( 'utal_pos_bottom' );

        $design_style = isset( $settings['ut_team_design_layout'] ) ? $settings['ut_team_design_layout'] : 'layout-1';
        $columns = isset( $settings['ut_columns'] ) ? $settings['ut_columns'] : 3;
        $columns_tablet = isset( $settings['columns_tablet'] ) ? $settings['columns_tablet'] : 2;
        $columns_mobile = isset( $settings['columns_mobile'] ) ? $settings['columns_mobile'] : 1;
        $container_text_align = isset( $settings['container_text_align'] ) ? $settings['container_text_align'] : 'align-left';
        $name_text_align = isset( $settings['ut_content_title_align'] ) ? $settings['ut_content_title_align'] : 'align-left';
        $subtitle_text_align = isset( $settings['ut_content_subtitle_align'] ) ? $settings['ut_content_subtitle_align'] : 'align-left';
        $icon_text_align = isset( $settings['ut_content_icon_align'] ) ? $settings['ut_content_icon_align'] : 'align-left';
        $content_image_style = isset( $settings['ut_team_image_style'] ) ? $settings['ut_team_image_style'] : 'square';

        $this->add_render_attribute('utal-team', 'class', 'utal utal-team utal-' . $design_style);
        ?>
        <div <?php echo $this->get_render_attribute_string('utal-team'); ?>>
            <div class="utal-team-wrapper <?php echo esc_attr($container_text_align); ?>">
                <div class="d-flex col-desktop-<?php echo esc_attr($columns); ?> col-tab-<?php echo esc_attr($columns_tablet); ?> col-mob-<?php echo esc_attr($columns_mobile); ?> ">
                    <?php
                    if ( $settings['teams'] ) {
                        foreach ( $settings['teams'] as $team ) {
                            $fb_flink = $tw_flink = $yt_flink = $ln_flink = $ins_flink = $web_flink ='';

                            $fb_link = $team['ut_team_fb_link']['url'] ? $team['ut_team_fb_link']['url'] : '';
                            $fb_target = $team['ut_team_fb_link']['is_external'] ? ' target="_blank"' : '';
                            $fb_nofollow = $team['ut_team_fb_link']['nofollow'] ? ' rel="nofollow"' : '';
                            if($fb_link!=''){
                                $fb_flink='<a class="utal-team-facebook" hre="'.$fb_link.'"'.$fb_target.''. $fb_nofollow.' > <i aria-hidden="true" class="fab fa-facebook"></i></a>'; 
                            }

                            $tw_link = $team['ut_team_tw_link']['url'] ? $team['ut_team_tw_link']['url'] : '';
                            $tw_target = $team['ut_team_tw_link']['is_external'] ? ' target="_blank"' : '';
                            $tw_nofollow = $team['ut_team_tw_link']['nofollow'] ? ' rel="nofollow"' : '';
                            if($tw_link!=''){
                                $tw_flink='<a class="utal-team-twitter" href="'.$tw_link.'"'.$tw_target.''. $tw_nofollow.' ><i aria-hidden="true" class="fab fa-twitter"></i></a>'; 
                            }

                            $yt_link = $team['ut_team_yt_link']['url'] ? $team['ut_team_yt_link']['url'] : '';
                            $yt_target = $team['ut_team_yt_link']['is_external'] ? ' target="_blank"' : '';
                            $yt_nofollow = $team['ut_team_yt_link']['nofollow'] ? ' rel="nofollow"' : '';
                            if($yt_link!=''){
                                $yt_flink='<a class="utal-team-youtube" href="'.$yt_link.'"'.$yt_target.''. $yt_nofollow.' ><i aria-hidden="true" class="fab fa-youtube"></i></a>'; 
                            }

                            $ln_link = $team['ut_team_ln_link']['url'] ? $team['ut_team_ln_link']['url'] : '';
                            $ln_target = $team['ut_team_ln_link']['is_external'] ? ' target="_blank"' : '';
                            $ln_nofollow = $team['ut_team_ln_link']['nofollow'] ? ' rel="nofollow"' : '';
                            if($ln_link!=''){
                                $ln_flink='<a class="utal-team-linkedin" href="'.$ln_link.'"'.$ln_target.''. $ln_nofollow.' ><i aria-hidden="true" class="fab fa-linkedin-in"></i></a>'; 
                            }

                            $ins_link = $team['ut_team_ins_link']['url'] ? $team['ut_team_ins_link']['url'] : '';
                            $ins_target = $team['ut_team_ins_link']['is_external'] ? ' target="_blank"' : '';
                            $ins_nofollow = $team['ut_team_ins_link']['nofollow'] ? ' rel="nofollow"' : '';
                            if($ins_link!=''){
                                $ins_flink='<a class="utal-team-instagram" href="'.$ins_link.'"'.$ins_target.''. $ins_nofollow.' ><i aria-hidden="true" class="fab  fa-instagram"></i></a>'; 
                            }

                            $web_link = $team['ut_team_web_link']['url'] ? $team['ut_team_web_link']['url'] : '';
                            $web_target = $team['ut_team_web_link']['is_external'] ? ' target="_blank"' : '';
                            $web_nofollow = $team['ut_team_web_link']['nofollow'] ? ' rel="nofollow"' : '';
                            if($web_link!=''){
                                $web_flink='<a class="utal-team-web" href="'.$web_link.'"'.$web_target.''. $web_nofollow.' ><i aria-hidden="true" class="fas fa-globe"></i></a>'; 
                            }

                            ob_start();
                            if( !empty( $fb_flink ) || !empty( $tw_flink ) || !empty( $yt_flink ) || !empty( $ln_flink ) || !empty( $ins_flink ) || !empty( $web_flink ) ){
                                echo '<div class="utal-team-social text-'.$icon_text_align.'">';
                                echo $fb_flink.$tw_flink.$yt_flink.$ln_flink.$ins_flink.$web_flink;
                                echo '</div>';
                            }
                            $social = ob_get_clean();

                            ob_start();
                            $image=$team['ut_team_image']['id'];
                            if($image==''){
                                echo '<figure class="utal-team-image-wrap"><img src="'.\Elementor\Utils::get_placeholder_image_src().'"></figure >';

                            }else{
                                echo '<figure class="utal-team-image-wrap">'. wp_get_attachment_image($team['ut_team_image']['id'], $team['thumbnail_size']).'</figure >';
                            }
                            $image = ob_get_clean();

                            ob_start();
                            echo '<div class="utal-team-bio-wrap"><div class="utal-team-title text-'. esc_attr($name_text_align).'">' . esc_html($team['ut_team_name']) . '</div> <div class="utal-subtitle text-'. esc_attr($subtitle_text_align).'">' . esc_html($team['ut_team_sub_title']) . '</div></div>';
                            $bio = ob_get_clean();

                        //echo $link;
                            echo '<div class="utal-team-wrap elementor-repeater-item-' . $team['_id'] . '"><div class="slide-content-wrap utal-image-'.$content_image_style.' ' . $design_style . '">';
                            if ($design_style == 'layout-1') {

                                echo '<div class="utal-team-image">';
                                echo $image;                                
                                echo '</div>';
                                echo $bio;
                                echo $social;
                            }
                            if ($design_style == 'layout-2') {
                                echo '<div class="utal-team-image">';
                                echo $image;                                
                                echo '</div>';
                                echo '<div class="utal-team-bio-social">';
                                echo $bio;
                                echo $social;
                                echo '</div>';
                            }
                            if ($design_style == 'layout-3') {                                
                                echo $image;
                                echo '<div class="utal-team-bio-social">';                                
                                echo $bio;
                                echo $social;
                                echo '</div>';
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
Plugin::instance()->widgets_manager->register_widget_type(new UT_Elementor_Addons_Lite_Widget_Team());
