<?php
namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) exit; 

class UT_Elementor_Addons_Lite_Widget_Slider extends Widget_Base {

    use \Elementor\UT_Elementor_Addons_Lite_Queries;

    public function get_name() {
        return 'utal-slider';
    }

    public function get_title() {
        return  esc_html__( 'Slider', 'ut-elementor-addons-lite' );
    }

    public function get_icon() {
        return ' eicon-post-slider ut-widget-icon';
    }

    public function get_categories() {
        return [ 'ut-elementor-addons-lite' ];
    }

    public function get_script_depends() {
        return [ 'ut-elementor-addons-lite-script', 'slick' ];
    }

    public function get_style_depends(){
        return [ 'slick' ];
    }

    protected function register_controls() {  

        $this->start_controls_section(
            'ut_section_detail',
            [
                'label' => esc_html__( 'Section Setting', 'ut-elementor-addons-lite' ),
            ]
        );

        $this->add_responsive_control(
            'ut_slider_weight',
            [
                'label' => esc_html__( 'Slider Width', 'ut-elementor-addons-lite' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => [ 'px', '%' ],
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
                    '{{WRAPPER}} .utal-slider .slide-wrap .slide-image, {{WRAPPER}} .slide-wrap.custom-slide-wrap.elementor-repeater-item-d9a55aa, {{WRAPPER}} iframe.youtube_video_slider, {{WRAPPER}} video.custom_slider' => 'width: {{SIZE}}{{UNIT}} !important;',
                ],
            ]
        );

        $this->add_responsive_control(
            'ut_slider_height',
            [
                'label' => esc_html__( 'Slider Min. Height', 'ut-elementor-addons-lite' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => [ 'px', '%', 'vh' ],
                'desktop_default' => [
                    'size' => '500',
                    'unit' => 'px',
                ],
                'default' => [
                    'unit' => 'vh',
                    'size' => 64,
                ], 
                'tablet_default' => [
                    'size' => '',
                    'unit' => 'px',
                ],
                'mobile_default' => [
                    'size' => '',
                    'unit' => 'px',
                ],
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
                    '{{WRAPPER}} .utal-slider .slide-wrap .slide-image, {{WRAPPER}} .custom-slide-wrap, {{WRAPPER}} iframe.youtube_video_slider, {{WRAPPER}} video.custom_slider' => 'min-height: {{SIZE}}{{UNIT}};',
                ],
                'separator' => 'after',
            ]
        );

        $this->add_control(
            'ut_slider_type',
            [
                'label'       => esc_html__( 'Slider Type', 'ut-elementor-addons-lite' ),
                'type'        => Controls_Manager::SELECT,
                'label_block' => true,
                'default'       =>  'category',
                'options'      => [
                    'category'   => esc_html__( 'Category','ut-elementor-addons-lite' ),
                    'custom'   => esc_html__( 'Custom','ut-elementor-addons-lite' ),
                ],
            ]
        );

        $this->add_control(
            'ut_slider_position',
            [
                'label'       => esc_html__( 'Slider Content Position', 'ut-elementor-addons-lite' ),
                'type'        => Controls_Manager::SELECT,
                'label_block' => true,
                'default'       =>  'right-bottom',
                'options'      => array(
                    'left-top'   => esc_html__( 'Left Top','ut-elementor-addons-lite' ),
                    'left-center'   => esc_html__( 'Left Center','ut-elementor-addons-lite' ),
                    'left-bottom'   => esc_html__( 'Left Bottom','ut-elementor-addons-lite' ),
                    'center-top'   => esc_html__( 'Center Top','ut-elementor-addons-lite' ),
                    'center-center'   => esc_html__( 'Center Center','ut-elementor-addons-lite' ),
                    'center-bottom'   => esc_html__( 'Center Bottom','ut-elementor-addons-lite' ),
                    'right-top'   => esc_html__( 'Right Top','ut-elementor-addons-lite' ),
                    'right-center'   => esc_html__( 'Right Center','ut-elementor-addons-lite' ),
                    'right-bottom'   => esc_html__( 'Right Bottom','ut-elementor-addons-lite' ),
                ),
            ]
        );

        $this->add_group_control(
            Group_Control_Image_Size::get_type(),
            [
                'name'              => 'ut_image_size',
                'label'             => esc_html__( 'Image Size', 'ut-elementor-addons-lite' ),
                'default'           => 'full',
                'exclude' => [ 'custom' ],
                'condition' => [
                    'ut_slider_type' => 'category'
                ],
            ]
        );

        $this->add_control(
            'ut_fallback_image',
            array(
                'label'       => esc_html__( 'Fallback Image:', 'ut-elementor-addons-lite' ),
                'type'        => Controls_Manager::MEDIA,
                'label_block' => true,
                'condition' => [
                    'ut_slider_type' => 'category'
                ],
            )
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'ut_section_post_query',
            [
                'label'             => esc_html__( 'Query', 'ut-elementor-addons-lite' ),
                'condition' => [
                    'ut_slider_type' => 'category'
                ],
            ]
        );

        $this->query_controls( array( 'control_section' => false ) );

        $this->end_controls_section();

        $this->start_controls_section(
            'ut_section_post_excerpts',
            [
                'label'             => esc_html__( 'Post Content', 'ut-elementor-addons-lite' ),
                'condition' => [
                    'ut_slider_type' => 'category'
                ],
            ]
        );

        $this->add_control(
            'ut_content_title_show',
            [
                'label'             => esc_html__( 'Post Title', 'ut-elementor-addons-lite' ),
                'type'              => Controls_Manager::SWITCHER,
                'default'           => 'yes',
                'label_on'          => esc_html__( 'Show', 'ut-elementor-addons-lite' ),
                'label_off'         => esc_html__( 'Hide', 'ut-elementor-addons-lite' ),
                'return_value'      => 'yes',
            ]
        );

        $this->add_control(
            'ut_content_title_tag',
           [
                'label'       => esc_html__( 'Post Title Tag', 'ut-elementor-addons-lite' ),
                'desc'       => esc_html__( 'Choose heading tag for Post title.', 'ut-elementor-addons-lite' ),
                'type'        => Controls_Manager::SELECT,
                'label_block' => true,
                'default'       =>  'h3',
                'options'      => array(
                    'h1'   => esc_html__( 'H1','ut-elementor-addons-lite' ),
                    'h2'   => esc_html__( 'H2','ut-elementor-addons-lite' ),
                    'h3'   => esc_html__( 'H3','ut-elementor-addons-lite' ),
                    'h4'   => esc_html__( 'H4','ut-elementor-addons-lite' ),
                    'h5'   => esc_html__( 'H5','ut-elementor-addons-lite' ),
                    'h6'   => esc_html__( 'H6','ut-elementor-addons-lite' ),
                ),
                'condition' => [
                    'ut_content_title_show' => 'yes'
                ],
            ]
        );

        $this->add_control(
            'ut_content_excerpts_show',
            [
                'label'             => esc_html__( 'Excerpt', 'ut-elementor-addons-lite' ),
                'type'              => Controls_Manager::SWITCHER,
                'default'           => 'yes',
                'label_on'          => esc_html__( 'Show', 'ut-elementor-addons-lite' ),
                'label_off'         => esc_html__( 'Hide', 'ut-elementor-addons-lite' ),
                'return_value'      => 'yes',
            ]
        );

        $this->add_control(
            'ut_content_excerpts',
            [
                'label'             => esc_html__( 'Post Excerpt Length', 'ut-elementor-addons-lite' ),
                'type'              => Controls_Manager::NUMBER,
                'default'           => '',
                'description'       => esc_html__( 'Enter Length for contents in letters or leave blank to hide content','ut-elementor-addons-lite' ),
                'condition' => [
                    'ut_content_excerpts_show' => 'yes'
                ],
            ]
        );

        $this->add_control(
            'ut_content_readmore_show',
            [
                'label'             => esc_html__( 'Read More', 'ut-elementor-addons-lite' ),
                'type'              => Controls_Manager::SWITCHER,
                'default'           => 'yes',
                'label_on'          => esc_html__( 'Show', 'ut-elementor-addons-lite' ),
                'label_off'         => esc_html__( 'Hide', 'ut-elementor-addons-lite' ),
                'return_value'      => 'yes',
            ]
        );

        $this->add_control(
            'ut_readmore',
            [
                'label'             => esc_html__( 'Read More Text', 'ut-elementor-addons-lite' ),
                'description'       => esc_html__( 'Enter text for Read More button or leave it blank to hide', 'ut-elementor-addons-lite' ),
                'type'              => Controls_Manager::TEXT,
                'condition' => [
                    'ut_content_readmore_show' => 'yes'
                ],
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'ut_section_post_meta',
            [
                'label'             => esc_html__( 'Post Meta', 'ut-elementor-addons-lite' ),
                'condition' => [
                    'ut_slider_type' => 'category'
                ],
            ]
        );

        $this->post_meta(  array( 'control_section' => false,'meta_categories_pos' => true, 'meta_date_pos' => true, 'meta_author_pos' => true ) );  

        $this->end_controls_section();

        $this->start_controls_section(
            'ut_custom_slider_section',
            [
                'label' => esc_html__( 'Custom Slider', 'ut-elementor-addons-lite' ),
                'tab' => Controls_Manager::TAB_CONTENT,
                'condition' => [
                    'ut_slider_type' => 'custom'
                ],
            ]
        );

        $repeater = new Repeater();

        $repeater->add_control(
            'ut_video_background_type',
            [
                'label'       => esc_html__( 'Type', 'ut-elementor-addons-lite' ),
                'type'        => Controls_Manager::SELECT,
                'label_block' => true,
                'default'       =>  'background',
                'options'      => array(
                    'background'   => esc_html__( 'Background Image', 'ut-elementor-addons-lite' ),
                    'video'   => esc_html__( 'Youtube Video', 'ut-elementor-addons-lite' ),
                    'custom'   => esc_html__( 'Self Hosted Video', 'ut-elementor-addons-lite' ),
                ),
            ]
        );

        $repeater->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name' => 'background',
                'label' => esc_html__( 'Background', 'ut-elementor-addons-lite' ),
                'types' => [ 'classic' ],
                'selector' => '{{WRAPPER}} {{CURRENT_ITEM}}',
                'condition' => [
                    'ut_video_background_type' => 'background'
                ],
            ]
        );

        $repeater->add_control(
            'ut_file_link',
            [
                'label' => esc_html__( 'Select Video File ', 'ut-elementor-addons-lite' ),
                'type' => Controls_Manager::MEDIA,
                'media_type' => 'video',
                'placeholder' => esc_html__( 'URL to File', 'ut-elementor-addons-lite' ),
                'description' => esc_html__( 'Select file from media library or upload', 'ut-elementor-addons-lite' ),
                'condition' => [
                    'ut_video_background_type' => 'custom'
                ]
            ]
        );

        $repeater->add_control(
            'ut_youtube_url',
            [
                'label'   => esc_html__( 'URL', 'ut-elementor-addons-lite' ),
                'type'    => Controls_Manager::TEXT,
                'label_block' => true,
                'default' => 'https://www.youtube.com/watch?v=71EZb94AS1k&t=1s',
                'description' => esc_html__('https://www.youtube.com/watch?v=71EZb94AS1k', 'ut-elementor-addons-lite'),
                'condition' => [
                    'ut_video_background_type' => 'video'
                ]
            ]
        );

        $repeater->add_control(
            'ut_sub_title', [
                'label' => esc_html__( 'Sub Title', 'ut-elementor-addons-lite' ),
                'type' => Controls_Manager::TEXT,
                'default' => esc_html__( 'Sub Title' , 'ut-elementor-addons-lite' ),
                'label_block' => true,
            ]
        );

        $repeater->add_control(
            'ut_slide_title', [
                'label' => esc_html__( 'Slide Title', 'ut-elementor-addons-lite' ),
                'type' => Controls_Manager::TEXT,
                'default' => esc_html__( 'Slide Title' , 'ut-elementor-addons-lite' ),
                'label_block' => true,
            ]
        );

        $repeater->add_control(
            'ut_slide_content', [
                'label' => esc_html__( 'Slide Content', 'ut-elementor-addons-lite' ),
                'type' => Controls_Manager::WYSIWYG,
                'default' => esc_html__( 'List Content' , 'ut-elementor-addons-lite' ),
                'show_label' => false,
            ]
        );

        $repeater->add_control(
            'ut_slide_button', [
                'label' => esc_html__( 'Slide Button', 'ut-elementor-addons-lite' ),
                'type' => Controls_Manager::TEXT,
                'default' => esc_html__( 'Read More' , 'ut-elementor-addons-lite' ),
                'label_block' => true,
            ]
        );

        $repeater->add_control(
            'ut_slide_button_link',
            [
                'label' => esc_html__( 'Link', 'ut-elementor-addons-lite' ),
                'type' => Controls_Manager::URL,
                'placeholder' => esc_html__( 'https://your-link.com', 'ut-elementor-addons-lite' ),
                'show_external' => true,
                'default' => [
                    'url' => '',
                    'is_external' => false,
                    'nofollow' => true,
                ],
            ]
        );

        $this->add_control(
            'slides',
            [
                'label' => esc_html__( 'Slides', 'ut-elementor-addons-lite' ),
                'type' => Controls_Manager::REPEATER,
                'fields' => $repeater->get_controls(),
                'default' => [
                    [
                        'ut_slide_title' => esc_html__( 'Slide 1', 'ut-elementor-addons-lite' ),
                        'ut_sub_title' => esc_html__( 'Sub 1', 'ut-elementor-addons-lite' ),
                        'ut_slide_content' => esc_html__( 'Slide Content.', 'ut-elementor-addons-lite' ),
                        'ut_slide_button' => esc_html__( 'Read More' , 'ut-elementor-addons-lite' ),
                        'ut_video_background_type' => esc_html__( '' , 'ut-elementor-addons-lite' ),
                        'ut_youtube_url' => esc_html__( '' , 'ut-elementor-addons-lite' ),
                        'ut_file_link' => esc_html__( '' , 'ut-elementor-addons-lite' ),
                        'ut_slide_button_link' => [
                            'url' => '',
                            'is_external' => false,
                            'nofollow' => true,
                        ],
                    ],
                ],
                'title_field' => '{{{ ut_slide_title }}}',
            ]
        );

        $this->end_controls_section();

        $this->slider_settings( array('slidesToShow' => false) );        

        $this->start_controls_section(
            'ut_section_general_style',
            [
                'label' => esc_html__( 'General Styles', 'ut-elementor-addons-lite' ),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'ut_content_date_color',
            [
                'label'     => esc_html__( 'Date Color', 'ut-elementor-addons-lite' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .blog-date' => 'color: {{VALUE}};',
                ],
                'condition' => [
                    'ut_slider_type' => 'category'
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'      => 'ut_content_date_typography',
                'label'     => esc_html__( 'Date Typography', 'ut-elementor-addons-lite' ),
                'scheme'    => Core\Schemes\Typography::TYPOGRAPHY_4,
                'selector' => '{{WRAPPER}} .blog-date',
                'condition' => [
                    'ut_slider_type' => 'category'
                ],
            ]
        );

        $this->add_control(
            'ut_date_divider',
            [
                'type' => Controls_Manager::DIVIDER,
                'condition' => [
                    'ut_slider_type' => 'category'
                ],
            ]
        );
        $this->add_control(
            'ut_content_author_color',
            [
                'label'     => esc_html__( 'Author Color', 'ut-elementor-addons-lite' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .blog-author' => 'color: {{VALUE}};',
                ],
                'condition' => [
                    'ut_slider_type' => 'category'
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'      => 'ut_content_author_typography',
                'label'     => esc_html__( 'Author Typography', 'ut-elementor-addons-lite' ),
                'scheme'    => Core\Schemes\Typography::TYPOGRAPHY_4,
                'selector' => '{{WRAPPER}} .blog-author',
                'condition' => [
                    'ut_slider_type' => 'category'
                ],
            ]
        );

        $this->add_control(
            'ut_author_divider',
            [
                'type' => Controls_Manager::DIVIDER,
                'condition' => [
                    'ut_slider_type' => 'category'
                ],
            ]
        );

        $this->start_controls_tabs(
            'ut_category_tabs'
        );

        $this->start_controls_tab(
            'ut_category_tab1',
            [
                'label' => esc_html__( 'Normal', 'ut-elementor-addons-lite' ),
                'condition' => [
                    'ut_slider_type' => 'category'
                ],
            ]
        );

        $this->add_control(
            'ut_content_category_color',
            [
                'label'     => esc_html__( 'Category Color', 'ut-elementor-addons-lite' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .blog-category a' => 'color: {{VALUE}};',
                ],
                'condition' => [
                    'ut_slider_type' => 'category'
                ],
            ]
        );

        $this->end_controls_tab();

        $this->start_controls_tab(
            'ut_category_tab2',
            [
                'label' => esc_html__( 'Hover', 'ut-elementor-addons-lite' ),
                'condition' => [
                    'ut_slider_type' => 'category'
                ],
            ]
        );

        $this->add_control(
            'ut_content_category_color_hover',
            [
                'label'     => esc_html__( 'Category Color hover', 'ut-elementor-addons-lite' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .blog-category a:hover' => 'color: {{VALUE}};',
                ],
                'condition' => [
                    'ut_slider_type' => 'category'
                ],
            ]
        );

        $this->end_controls_tab();

        $this->end_controls_tabs();     

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'      => 'ut_content_category_typography',
                'label'     => esc_html__( 'Category Typography', 'ut-elementor-addons-lite' ),
                'scheme'    => Core\Schemes\Typography::TYPOGRAPHY_4,
                'selector' => '{{WRAPPER}} .blog-category',
                'condition' => [
                    'ut_slider_type' => 'category'
                ],
            ]
        );

        $this->add_control(
            'ut_category_divider',
            [
                'type' => Controls_Manager::DIVIDER,
                'condition' => [
                    'ut_slider_type' => 'category'
                ],
            ]
        );  

        $this->start_controls_tabs(
            'ut_title_tabs'
        );

        $this->start_controls_tab(
            'ut_title_tab1',
            [
                'label' => esc_html__( 'Normal', 'ut-elementor-addons-lite' ),
            ]
        );

        $this->add_control(
            'ut_sub_title_color',
            [
                'label'     => esc_html__( 'Sub Title Color', 'ut-elementor-addons-lite' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .sub-title a, {{WRAPPER}} .sub-title' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'      => 'ut_sub_title_typography',
                'label'     => esc_html__( 'Sub Title Typography', 'ut-elementor-addons-lite' ),
                'scheme'    => Core\Schemes\Typography::TYPOGRAPHY_4,
                'selector' => '{{WRAPPER}} .sub-title',
            ]
        );

        $this->add_control(
            'ut_content_title_color',
            [
                'label'     => esc_html__( 'Content Title Color', 'ut-elementor-addons-lite' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .slide-title a, {{WRAPPER}} .slide-title' => 'color: {{VALUE}};',
                ],
                'separator' => 'before',
            ]
        );

        $this->end_controls_tab();

        $this->start_controls_tab(
            'ut_title_tab2',
            [
                'label' => esc_html__( 'Hover', 'ut-elementor-addons-lite' ),
            ]
        );

        $this->add_control(
            'ut_sub_title_color_hover',
            [
                'label'     => esc_html__( 'Sub Title Color', 'ut-elementor-addons-lite' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .sub-title a:hover, {{WRAPPER}} .sub-title:hover' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'      => 'ut_sub_title_typography_hover',
                'label'     => esc_html__( 'Sub Title Typography', 'ut-elementor-addons-lite' ),
                'scheme'    => Core\Schemes\Typography::TYPOGRAPHY_4,
                'selector' => '{{WRAPPER}} .sub-title:hover',
            ]
        );

        $this->add_control(
            'ut_content_title_color_hover',
            [
                'label'     => esc_html__( 'Content Title Color: Hover', 'ut-elementor-addons-lite' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .slide-title a:hover, {{WRAPPER}} .slide-title:hover' => 'color: {{VALUE}};',
                ],
                'separator' => 'before',
            ]
        );

        $this->end_controls_tab();

        $this->end_controls_tabs();

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'      => 'ut_content_title_typography',
                'label'     => esc_html__( 'Content Title Typography', 'ut-elementor-addons-lite' ),
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
                'label'     => esc_html__( 'Content Description Color', 'ut-elementor-addons-lite' ),
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
                'label'     => esc_html__( 'Content Description Typography', 'ut-elementor-addons-lite' ),
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
                'size_units' => [ 'px', '%' ],
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
                    '{{WRAPPER}} .utal-slider .slide-wrap .slide-content-wrap' => 'min-width: {{SIZE}}{{UNIT}}; width: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'ut_container_height',
            [
                'label' => esc_html__( 'Container Min. Height', 'ut-elementor-addons-lite' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => [ 'px', '%', 'vh' ],
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
                    '{{WRAPPER}} .utal-slider .slide-wrap .slide-content-wrap' => 'min-height: {{SIZE}}{{UNIT}};',
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
                'size_units' => [ 'px', '%', 'em' ],
                'selectors' => [
                    '{{WRAPPER}} .utal-slider .slide-wrap .slide-content-wrap' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'ut_container_padding',
            [
                'label' => esc_html__( 'Padding', 'ut-elementor-addons-lite' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em' ],
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
                'condition' => [
                    'ut_content_readmore_show' => 'yes'
                ]
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
                    '' => esc_html__( 'None', 'ul-elementor-addons-lite' ),
                    'solid' => esc_html__( 'Solid', 'ul-elementor-addons-lite' ),
                    'double' => esc_html__( 'Double', 'ul-elementor-addons-lite' ),
                    'dotted' => esc_html__( 'Dotted', 'ul-elementor-addons-lite' ),
                    'dashed' => esc_html__( 'Dashed', 'ul-elementor-addons-lite' ),
                    'groove' => esc_html__( 'Groove', 'ul-elementor-addons-lite' ),
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
                'size_units' => [ 'px', '%', 'em' ],
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
                'size_units' => [ 'px', '%', 'em' ],
                'selectors' => [
                    '{{WRAPPER}} a.slide-readmore' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'ut_button_box_shadow',
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
                    '' => esc_html__( 'None', 'ul-elementor-addons-lite' ),
                    'solid' => esc_html__( 'Solid', 'ul-elementor-addons-lite' ),
                    'double' => esc_html__( 'Double', 'ul-elementor-addons-lite' ),
                    'dotted' => esc_html__( 'Dotted', 'ul-elementor-addons-lite' ),
                    'dashed' => esc_html__( 'Dashed', 'ul-elementor-addons-lite' ),
                    'groove' => esc_html__( 'Groove', 'ul-elementor-addons-lite' ),
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
                'size_units' => [ 'px', '%', 'em' ],
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
                'size_units' => [ 'px', '%', 'em' ],
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
                'label'     => esc_html__( 'Button Typography', 'ut-elementor-addons-lite' ),
                'scheme'    => Core\Schemes\Typography::TYPOGRAPHY_4,
                'selector' => '{{WRAPPER}} .slide-readmore',
            ]
        );

        $this->add_responsive_control(
            'ut_button_margin',
            [
                'label' => esc_html__( 'Margin', 'ut-elementor-addons-lite' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em' ],
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
                'size_units' => [ 'px', '%', 'em' ],
                'selectors' => [
                    '{{WRAPPER}} a.slide-readmore' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->end_controls_section();

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
                'selector' => '{{WRAPPER}} .utal-slider-overlay',
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
                    '{{WRAPPER}} .utal-slider-overlay' => 'opacity: {{SIZE}};',
                ],
                'condition' => [
                    'background_overlay_background' => [ 'classic', 'gradient' ],
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Css_Filter::get_type(),
            [
                'name' => 'ut_css_filters',
                'selector' => '{{WRAPPER}} .utal-slider-overlay',
            ]
        );

        $this->add_control(
            'ut_overlay_blend_mode',
            [
                'label' => esc_html__( 'Blend Mode', 'ul-elementor-addons-lite' ),
                'type' => Controls_Manager::SELECT,
                'options' => [
                    '' => esc_html__( 'Normal', 'ul-elementor-addons-lite' ),
                    'multiply' => 'Multiply',
                    'screen' => 'Screen',
                    'overlay' => 'Overlay',
                    'darken' => 'Darken',
                    'lighten' => 'Lighten',
                    'color-dodge' => 'Color Dodge',
                    'saturation' => 'Saturation',
                    'color' => 'Color',
                    'luminosity' => 'Luminosity',
                ],
                'selectors' => [
                    '{{WRAPPER}} .utal-slider-overlay' => 'mix-blend-mode: {{VALUE}}',
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
                'selector' => '{{WRAPPER}}:hover utal-slider-overlay',
            ]
        );

        $this->add_control(
            'ut_background_overlay_hover_opacity',
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
                    '{{WRAPPER}}:hover utal-slider-overlay' => 'opacity: {{SIZE}};',
                ],
                'condition' => [
                    'background_overlay_hover_background' => [ 'classic', 'gradient' ],
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Css_Filter::get_type(),
            [
                'name' => 'ut_css_filters_hover',
                'selector' => '{{WRAPPER}}:hover utal-slider-overlay',
            ]
        );

        $this->add_control(
            'ut_background_overlay_hover_transition',
            [
                'label' => esc_html__( 'Transition Duration', 'ul-elementor-addons-lite' ),
                'type' => Controls_Manager::SLIDER,
                'default' => [
                    'size' => 0.3,
                ],
                'range' => [
                    'px' => [
                        'max' => 3,
                        'step' => 0.1,
                    ],
                ],
                'render_type' => 'ui',
                'separator' => 'before',
            ]
        );

        $this->end_controls_tab();

        $this->end_controls_tabs();

        $this->end_controls_section(); 

        $this->start_controls_section(
            'ut_slider_navigation_section',
            [
                'label' => esc_html__( 'Slider Navigation', 'ut-elementor-addons-lite' ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'ut_arrow_heading',
            [
                'label' => esc_html__( 'Arrow', 'ut-elementor-addons-lite' ),
                'type' => Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );

        $this->add_control(
            'ut_arrow_active_colords',
            [
                'label' =>esc_html__( 'Color', 'ut-elementor-addons-lite' ),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} .utal button.slick-arrow:before' => 'background-color: {{VALUE}};',
                    '{{WRAPPER}} .utal button.slick-arrow:after' => 'background-color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'ut_arrow_border_color',
            [
                'label' =>esc_html__( 'Border Color', 'ut-elementor-addons-lite' ),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} button.slick-arrow' => 'border: 2px solid {{VALUE}} !important;',
                ],
            ]
        );

        $this->add_control(
            'ut_arrow_active_color',
            [
                'label' =>esc_html__( 'Hover Background Color', 'ut-elementor-addons-lite' ),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} button.slick-prev.slick-arrow:hover' => 'background-color: {{VALUE}};',
                    '{{WRAPPER}} button.slick-next.slick-arrow:hover' => 'background-color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'ut_dots_heading',
            [
                'label' => esc_html__( 'Dots', 'ut-elementor-addons-lite' ),
                'type' => Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        ); 

        $this->add_control(
            'ut_dots_active',
            [
                'label' =>esc_html__( 'Active Color', 'ut-elementor-addons-lite' ),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} ul.slick-dots li.slick-active button' => 'background-color:  {{VALUE}};',
                ],
            ]
        );

        $this->add_control( 
            'ut_dots_inactive',
            [
                'label' =>esc_html__( 'In Active Color', 'ut-elementor-addons-lite' ),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} ul.slick-dots li button' => 'background-color:  {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'ut_dots_size',
            [
                'label' =>esc_html__( 'Size', 'ut-elementor-addons-lite' ),
                'type' => Controls_Manager::SLIDER,
                "size_units" => ["px", "%"],
                "range" => [
                    "px" => [
                        "min" => 1,
                        "max" => 100,
                        "step" => 5,
                    ],
                    "%" => [
                        "min" => 1,
                        "max" => 100,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} ul.slick-dots li button' => 'height: {{SIZE}}{{UNIT}}; width: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->end_controls_section();
    }

    protected function render() {
        $settings = $this->get_settings();
        $this->add_render_attribute( 'utal-slider', 'class', 'utal-slider' );
        $this->add_render_attribute( 'utal-slider', 'class', 'utal' );
        /* Reset all actions in hook before starting*/
        remove_all_actions('utal_pos_top');
        remove_all_actions('utal_pos_middle');
        remove_all_actions('utal_pos_bottom');
        $ut_slider_type = isset( $settings[ 'ut_slider_type' ] )? $settings[ 'ut_slider_type' ] : '';
        $ut_slider_position = isset( $settings[ 'ut_slider_position' ] )? $settings[ 'ut_slider_position' ] : 'right-bottom';
        $arrows = isset( $settings[ 'arrows' ] )? $settings[ 'arrows' ] : 'no';
        $dots = isset( $settings[ 'dots' ] )? $settings[ 'dots' ] : 'no';
        $autoplay = isset( $settings[ 'autoplay' ] )? $settings[ 'autoplay' ] : 'no';
        $autoplay_speed = isset( $settings[ 'autoplay_speed' ] )? $settings[ 'autoplay_speed' ] : '2000';
        $slidesToShow = isset( $settings[ 'slidesToShow' ] )? $settings[ 'slidesToShow' ] : 3;
        $slidesToShow_tablet = isset( $settings[ 'slidesToShow_tablet' ] )? $settings[ 'slidesToShow_tablet' ] : 2;
        $slidesToShow_mobile = isset( $settings[ 'slidesToShow_mobile' ] )? $settings[ 'slidesToShow_mobile' ] : 1;
        $infinite_loop = isset( $settings[ 'infinite_loop' ] )? $settings[ 'infinite_loop' ] : 'yes';
        $pauseOnHover = isset( $settings[ 'pauseOnHover' ] )? $settings[ 'pauseOnHover' ] : 'yes';
        $dots_pos = isset( $settings[ 'dots_pos' ] )? $settings[ 'dots_pos' ] : 'inside-box';
        $swipe = isset( $settings[ 'swipe' ] )? $settings[ 'swipe' ] : 'yes';
        $container_text_align = isset( $settings[ 'container_text_align' ] )? $settings[ 'container_text_align' ] : 'align-left';
        $pos = explode("-",$ut_slider_position);

        $this->add_render_attribute('utal-carousel-slider', 'class', 'slick-slider');
        $this->add_render_attribute('utal-carousel-slider', 'data-arrows', $arrows);       
        $this->add_render_attribute('utal-carousel-slider', 'data-dots', $dots);         
        $this->add_render_attribute('utal-carousel-slider', 'data-infinit_loop', $infinite_loop);
        $this->add_render_attribute('utal-carousel-slider', 'data-pauseOnHover', $pauseOnHover);
        $this->add_render_attribute('utal-carousel-slider', 'data-swipe', $swipe);
        $this->add_render_attribute('utal-carousel-slider', 'data-autoplay', $autoplay);
        $this->add_render_attribute('utal-carousel-slider', 'data-autoplay_speed', $autoplay_speed);
        ?>

        <div <?php echo $this->get_render_attribute_string( 'utal-slider' ); ?>>
            <div class="utal-slider-wrapper <?php echo esc_attr($pos[0]). ' '. esc_attr($pos[1]) . ' ' . esc_attr($dots_pos);?>">
                <div <?php echo $this->get_render_attribute_string('utal-carousel-slider'); ?> >
                    <?php
                    if( $ut_slider_type == 'category'):
                        $date_pos = isset( $settings[ 'meta_date_pos' ] )? $settings[ 'meta_date_pos' ] : 'middle';
                        $author_pos = isset( $settings[ 'meta_author_pos' ] )? $settings[ 'meta_author_pos' ] : 'middle';
                        $categories_pos = isset( $settings[ 'meta_categories_pos' ] )? $settings[ 'meta_categories_pos' ] : 'top';
                        $date = isset( $settings[ 'meta_date' ] )? $settings[ 'meta_date' ] : '';
                        $author = isset( $settings[ 'meta_author' ] )? $settings[ 'meta_author' ] : '';
                        $categories = isset( $settings[ 'meta_categories' ] )? $settings[ 'meta_categories' ] : '';
$date ? add_action( 'utal_pos_'. $date_pos, 'ut_elementor_addons_lite_post_date' ) : ''; // Check date and add function to hook in action ( utal_pos_top, utal_pos_middle, utal_pos_bottom )
$author ? add_action( 'utal_pos_'. $author_pos, 'ut_elementor_addons_lite_post_author' ) : '';// Check author and add function to hook in action ( utal_pos_top, utal_pos_middle, utal_pos_bottom )
$categories ? add_action( 'utal_pos_'. $categories_pos, 'ut_elementor_addons_lite_post_categories' ) : '';// Check categories and add function to hook in action ( utal_pos_top, utal_pos_middle, utal_pos_bottom )
$showposts = isset( $settings[ 'showposts' ] )? $settings[ 'showposts' ] : '';
$title_show = isset( $settings[ 'ut_content_title_show' ] )? $settings[ 'ut_content_title_show' ] : 'yes';
$title_tag = isset( $settings[ 'ut_content_title_tag' ] )? $settings[ 'ut_content_title_tag' ] : 'h3';
$readmore_show = isset( $settings[ 'ut_content_readmore_show' ] )? $settings[ 'ut_content_readmore_show' ] : 'yes';
$excerpt_show = isset( $settings[ 'ut_content_excerpts_show' ] )? $settings[ 'ut_content_excerpts_show' ] : 'yes';
$excerpt = isset( $settings[ 'ut_content_excerpts' ] )? $settings[ 'ut_content_excerpts' ] : 200;
$readmore = isset( $settings[ 'ut_readmore' ] )? $settings[ 'ut_readmore' ] : esc_html__('Read More', 'ut-elementor-addons-lite');
$ut_fallback_image = isset( $settings[ 'ut_fallback_image' ] )? $settings[ 'ut_fallback_image' ] : '';
$block_args = ut_elementor_addons_lite_query($settings,$first_id='', $showposts );
$query = new \WP_Query( $block_args );
if ( $query->have_posts() ):
    while ( $query->have_posts() ): $query->the_post();
        ?>
        <div class="slide-wrap">
            <div class="utal-slider-overlay"></div>
            <div class="slide-image">                                    
                <?php
                $img_src    = '';
                if ( has_post_thumbnail() ) {
                    $img_src    = Group_Control_Image_Size::get_attachment_image_src( get_post_thumbnail_id(), 'ut_image_size', $settings );
                    echo '<a href="'. esc_url(get_the_permalink()).'"><img src="'.esc_url( $img_src ) .'" alt="'. esc_attr( get_the_title() ).'"></a>';
                }
                elseif (!empty($ut_fallback_image['id'])) { 
                    $img_src    = Group_Control_Image_Size::get_attachment_image_src( $ut_fallback_image['id'], 'ut_image_size', $settings );
                    echo '<a href="'. esc_url(get_the_permalink()).'"><img src="'.esc_url( $img_src ) .'" alt="'. esc_attr( get_the_title() ).'"></a>';
                }?>
            </div>
            <?php  
            echo '<div class="slide-content-wrap '. esc_attr($container_text_align) .'">';
do_action( 'utal_pos_top'); // trigger utal_pos_top to display post meta
($title_show) ? the_title('<'. $title_tag .'  class="slide-title"><a href="'. esc_url(get_the_permalink()).'">', '</a></'. $title_tag .' >') : ''; 
do_action( 'utal_pos_middle'); // trigger utal_pos_middle to display post meta
if( $excerpt_show == 'yes' ){
    echo ut_elementor_addons_lite_letter_count( get_the_excerpt(), $excerpt );
}         
do_action( 'utal_pos_bottom'); // trigger utal_pos_bottom to display post meta
if(!empty($readmore) && ($readmore_show == 'yes')){
    echo '<div class="readmore-wrap"><a class="slide-readmore utal-readmore" href="' . esc_url(get_the_permalink()) . '">'. esc_html( $readmore ) . '</a></div>';
}
echo '</div>';
?>
</div>
<?php
endwhile;
wp_reset_postdata();                        
endif;
else: 
    if ( $settings['slides'] ) {
        foreach (  $settings['slides'] as $slide ) {
            parse_str( parse_url( $slide['ut_youtube_url'], PHP_URL_QUERY ), $my_array_of_vars );
            $urls = $my_array_of_vars['v'];
            $target = (isset($slide['ut_slide_button_link']['is_external']) && ($slide['ut_slide_button_link']['is_external'])) ? ' target="_blank"' : '';
            $nofollow = (isset($slide['ut_slide_button_link']['nofollow']) && ($slide['ut_slide_button_link']['nofollow'])) ? ' rel="nofollow"' : '';
            $url = (isset($slide['ut_slide_button_link']['url']) && ($slide['ut_slide_button_link']['url'])) ? $slide['ut_slide_button_link']['url'] : '';

            echo '<div class="slide-wrap custom-slide-wrap elementor-repeater-item-' . $slide['_id'] . '"><div class="utal-slider-overlay"></div>';
            if ($slide['ut_video_background_type'] == 'video') { 

                if( !empty( $urls ) ){
                    echo '<iframe class="youtube_video_slider" width="100%" height="600" src="https://www.youtube.com/embed/'. $urls .'?mute=1&autoplay=1&modestbranding=1&loop=1&rel=0&amp;controls=0&amp;showinfo=0" frameborder="0" allowfullscreen></iframe>';
                }

            } else { 
                if( !empty( $slide['ut_file_link']['url'] ) ) {
                    echo '<video width="100%" class="custom_slider" muted="muted" loop="loop" autoplay="autoplay" controls=""><source src='. $slide['ut_file_link']['url'] .' type="video/mp4"><source src="mov_bbb.ogg" type="video/ogg"></video>';
                }
            }

            if( !empty( $slide['ut_sub_title'] ) || !empty( $slide['ut_slide_title'] ) || !empty( $slide['ut_slide_content'] ) || !empty( $slide['ut_slide_button'] ) ){
                echo '<div class="slide-content-wrap '. esc_attr($container_text_align) .'">';
                if( !empty( $slide['ut_sub_title'] ) ){
                    echo '<h6 class="sub-title">' . $slide['ut_sub_title'] . '</h6>';
                }
                if( !empty( $slide['ut_slide_title'] ) ){
                    echo '<h3 class="slide-title">' . $slide['ut_slide_title'] . '</h3>';
                }
                if( !empty( $slide['ut_slide_content'] ) ){
                    echo '<div class="content-excerpt">' . $slide['ut_slide_content'] . '</div>';
                }
                if( !empty( $slide['ut_slide_content'] ) ){
                    echo '<div class="readmore-wrap"><a class="slide-readmore" href="' . esc_url($url) . '"' . $target . $nofollow . '>' . $slide['ut_slide_button'] . ' </a></div>';
                }
                echo '</div>';
            }
            echo '</div>';
        }
    }
endif;
?>
</div>
</div>
</div>
<?php   
}  
}

Plugin::instance()->widgets_manager->register_widget_type( new UT_Elementor_Addons_Lite_Widget_Slider() );