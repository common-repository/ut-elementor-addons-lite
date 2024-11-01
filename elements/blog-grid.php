<?php
namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) exit; 

class UT_Elementor_Addons_Lite_Widget_Blog_Grid extends Widget_Base {

    use \Elementor\UT_Elementor_Addons_Lite_Queries;

    public function get_name() {
      return 'utal-blog-grid'; 
  }
  
  public function get_title() {
      return  esc_html__( 'Post Grid', 'ut-elementor-addons-lite' );
  }

  public function get_icon() {
      return 'eicon-posts-grid ut-widget-icon';
  }

  public function get_categories() {
      return [ 'ut-elementor-addons-lite' ];
  }

  public function get_script_depends() {
    return [ 'slick', 'ut-elementor-addons-lite-script' ];
}

public function get_style_depends()
{
    return [ 'slick' ];
}

protected function register_controls() {

    $this->start_controls_section(
        'ut_section_detail',
        [
            'label' => esc_html__( 'Section Setting', 'ut-elementor-addons-lite' ),
        ]
    );

    $this->add_control(
        'ut_element_title',
        [
            'label'             => esc_html__( 'Element Title', 'ut-elementor-addons-lite' ),
            'description'       => esc_html__( 'Enter text to change element title.', 'ut-elementor-addons-lite' ),
            'type'              => Controls_Manager::TEXT,
        ]
    );

    $this->add_group_control(
        Group_Control_Image_Size::get_type(),
        [
            'name'              => 'ut_image_size',
            'label'             => esc_html__( 'Image Size', 'ut-elementor-addons-lite' ),
            'default'           => 'full',
            'exclude' => [ 'custom' ],
        ]
    );

    $this->add_responsive_control(
        'ut_item_ratio',
        [
            'label' => esc_html__( 'Image Ratio', 'ut-elementor-addons-lite' ),
            'type' => Controls_Manager::SLIDER,
            'desktop_default' => [
                'size' => 0.66,
            ],
            'tablet_default' => [
                'size' => '',
            ],
            'mobile_default' => [
                'size' => 0.5,
            ],
            'range' => [
                'px' => [
                    'min' => 0.1,
                    'max' => 2,
                    'step' => 0.01,
                ],
            ],
            'selectors' => [
                '{{WRAPPER}} .blog-image' => 'padding-bottom: calc( {{SIZE}} * 100% );',
                '{{WRAPPER}} .utal-blog-grid-wrapper:after' => 'content: "{{SIZE}}"; position: absolute; color: transparent;',
            ],
        ]
    );

    $this->add_responsive_control(
        'ut_image_width',
        [
            'label' => esc_html__( 'Image Width', 'ut-elementor-addons-lite' ),
            'type' => Controls_Manager::SLIDER,
            'range' => [
                '%' => [
                    'min' => 10,
                    'max' => 100,
                ],
                'px' => [
                    'min' => 10,
                    'max' => 600,
                ],
            ],
            'desktop_default' => [
                'size' => 100,
                'unit' => '%',
            ],
            'tablet_default' => [
                'size' => '',
                'unit' => '%',
            ],
            'mobile_default' => [
                'size' => 100,
                'unit' => '%',
            ],
            'size_units' => [ '%', 'px' ],
            'selectors' => [
                '{{WRAPPER}} .blog-image' => 'width: {{SIZE}}{{UNIT}};',
            ],
        ]
    );

    $this->add_responsive_control(
        'ut_post_column',
        [
            'label'       => esc_html__( 'No. of Columns:', 'ut-elementor-addons-lite' ),
            'type'        => Controls_Manager::SELECT,
            'label_block' => true,
            'default'       =>  'column3',
            'options'      => array(
                'column1'   => esc_html__('1','ut-elementor-addons-lite'),
                'column2'   => esc_html__('2','ut-elementor-addons-lite'),
                'column3'   => esc_html__('3','ut-elementor-addons-lite'),
                'column4'   => esc_html__('4','ut-elementor-addons-lite'),
            ),
            'devices' => [ 'desktop', 'tablet', 'mobile' ],
            'desktop_default' => 'column3',
            'tablet_default' => 'column2',
            'mobile_default' => 'column1',
            'condition' =>  [
                'ut_post_carousel' => ''
            ]
        ]
    );

    $this->add_control(
        'ut_post_carousel',
        [
            'label'             => esc_html__( 'Enable Carousel', 'ut-elementor-addons-lite' ),
            'type'              => Controls_Manager::SWITCHER,
            'default'           => '',
            'label_on'          => esc_html__( 'Yes', 'ut-elementor-addons-lite' ),
            'label_off'         => esc_html__( 'No', 'ut-elementor-addons-lite' ),
            'return_value'      => 'yes',                
        ]
    ); 

    $this->add_control(
        'fallback_image',
        [
            'label'       => esc_html__( 'Fallback Image:', 'ut-elementor-addons-lite' ),
            'type'        => Controls_Manager::MEDIA,
            'label_block' => true,
        ]
    );
    
    $this->end_controls_section();

    $this->start_controls_section(
        'ut_section_post_query',
        [
            'label'             => esc_html__( 'Query', 'ut-elementor-addons-lite' ),
        ]
    );       

    $this->add_control(
        'categories',
        [
            'label'             => esc_html__( 'Categories', 'ut-elementor-addons-lite' ),
            'type'              => Controls_Manager::SELECT2,
            'label_block'       => true,
            'multiple'          => true,
            'options'           => ut_elementor_addons_lite_get_post_categories(),

        ]
    );

    $this->add_control(
        'authors',
        [
            'label'             => esc_html__( 'Authors', 'ut-elementor-addons-lite' ),
            'type'              => Controls_Manager::SELECT2,
            'label_block'       => true,
            'multiple'          => true,
            'options'           => ut_elementor_addons_lite_get_authors(),
        ]
    );

    //post tags
    $this->add_control(
        'tags',
        [
            'label'             => esc_html__( 'Tags', 'ut-elementor-addons-lite' ),
            'type'              => Controls_Manager::SELECT2,
            'label_block'       => true,
            'multiple'          => true,
            'options'           => ut_elementor_addons_lite_get_tags(),
        ]
    );
    
    //get all posts
    $this->add_control(
        'exclude_posts',
        [
            'label'             => esc_html__( 'Exclude Posts', 'ut-elementor-addons-lite' ),
            'type'              => Controls_Manager::SELECT2,
            'label_block'       => true,
            'multiple'          => true,
            'options'           => ut_elementor_addons_lite_get_posts(),
        ]
    );

    $this->add_control(
        'order',
        [
            'label'             => esc_html__( 'Order', 'ut-elementor-addons-lite' ),
            'type'              => Controls_Manager::SELECT,
            'options'           => [
             'DESC'           => esc_html__( 'Descending', 'ut-elementor-addons-lite' ),
             'ASC'       => esc_html__( 'Ascending', 'ut-elementor-addons-lite' ),
         ],
         'default'           => 'DESC',
     ]
 );

    $this->add_control(
        'orderby',
        [
            'label'             => esc_html__( 'Order By', 'ut-elementor-addons-lite' ),
            'type'              => Controls_Manager::SELECT,
            'options'           => ut_elementor_addons_lite_get_post_orderby(),
            'default'           => 'date',
        ]
    );

    $this->add_control(
        'offset',
        [
            'label'             => esc_html__( 'Offset', 'ut-elementor-addons-lite' ),
            'type'              => Controls_Manager::NUMBER,
            'default'           => '',
        ]
    );

    $this->add_control(
        'showposts',
        [
            'label'             => esc_html__( 'No. of Post', 'ut-elementor-addons-lite' ),
            'type'              => Controls_Manager::NUMBER,
            'default'           => 3,
        ]
    );
    
    $this->end_controls_section();

    $this->post_excerpts();

    $this->post_meta( array( 'meta_categories_pos' => true, 'meta_date_pos' => true, 'meta_author_pos' => true ) );

        /**
         * Content Tab: Post Excerpts
         */
        $this->start_controls_section(
            'ut_section_carousel_setting',
            [
                'label'             => esc_html__( 'Carousel Setting', 'ut-elementor-addons-lite' ),
                'condition' => [
                    'ut_post_carousel' => 'yes'
                ],
            ]
        );

        $this->slider_settings( array( 'control_section' => false ) );        

        $this->end_controls_section();

        $this->start_controls_section(
            'ut_section_general_style',
            [
                'label' => esc_html__( 'General Styles', 'ut-elementor-addons-lite' ),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'ut_content_element_color',
            [
                'label'     => esc_html__( 'Element Color', 'ut-elementor-addons-lite' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .block-header .block-title span' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'      => 'ut_element_typography',
                'label'     => esc_html__( 'Element Typography', 'ut-elementor-addons-lite' ),
                'scheme'    => Core\Schemes\Typography::TYPOGRAPHY_4,
                'selector' => '{{WRAPPER}} .block-header .block-title span',
            ]
        );

        $this->add_control(
            'ut_element_divider',
            [
                'type' => Controls_Manager::DIVIDER,
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
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'      => 'ut_content_date_typography',
                'label'     => esc_html__( 'Date Typography', 'ut-elementor-addons-lite' ),
                'scheme'    => Core\Schemes\Typography::TYPOGRAPHY_4,
                'selector' => '{{WRAPPER}} .blog-date',
            ]
        );

        $this->add_control(
            'date_divider',
            [
                'type' => Controls_Manager::DIVIDER,
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
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'      => 'ut_content_author_typography',
                'label'     => esc_html__( 'Author Typography', 'ut-elementor-addons-lite' ),
                'scheme'    => Core\Schemes\Typography::TYPOGRAPHY_4,
                'selector' => '{{WRAPPER}} .blog-author',
            ]
        );

        $this->add_control(
            'ut_author_divider',
            [
                'type' => Controls_Manager::DIVIDER,
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'      => 'ut_content_category_typography',
                'label'     => esc_html__( 'Category Typography', 'ut-elementor-addons-lite' ),
                'scheme'    => Core\Schemes\Typography::TYPOGRAPHY_4,
                'selector' => '{{WRAPPER}} .blog-category',
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
            'ut_content_category_color',
            [
                'label'     => esc_html__( 'Category Color', 'ut-elementor-addons-lite' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .blog-category a' => 'color: {{VALUE}};',
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
            'ut_content_category_color_hover',
            [
                'label'     => esc_html__( 'Category Color', 'ut-elementor-addons-lite' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .blog-category a:hover' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->end_controls_tab();

        $this->end_controls_tabs();    

        $this->add_control(
            'ut_category_divider',
            [
                'type' => Controls_Manager::DIVIDER,
            ]
        ); 

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'      => 'ut_content_title_typography',
                'label'     => esc_html__( 'Title Typography', 'ut-elementor-addons-lite' ),
				'selector' => '{{WRAPPER}} h4.blog-post-title a',
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
            'ut_content_title_color',
            [
                'label'     => esc_html__( 'Title Color', 'ut-elementor-addons-lite' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .blog-post-title a' => 'color: {{VALUE}};',
                ],
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
            'ut_content_title_color_hover',
            [
                'label'     => esc_html__( 'Title Color: Hover', 'ut-elementor-addons-lite' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .blog-post-title a:hover' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->end_controls_tab();

        $this->end_controls_tabs();

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
                'label'     => esc_html__( 'Description Typography', 'ut-elementor-addons-lite' ),
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
            'ut_inner_styles',
            [
                'label' => esc_html__( 'Inner Styles', 'ut-elementor-addons-lite' ),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_responsive_control(
            'ut_space_image',
            [
                'label' => esc_html__( 'Image & Content Gap', 'ut-elementor-addons-lite' ),
                'type' => Controls_Manager::SLIDER,
                'desktop_default' => [
                    'size' => 15,
                ],
                'tablet_default' => [
                    'size'  => '',
                ],
                'mobile_default' => [
                    'size'  => '',
                ],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .blog-image' => 'margin-bottom: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'ut_content_margin',
            [
                'label' => esc_html__( 'Content Margin', 'ut-elementor-addons-lite' ),
                'type' => Controls_Manager::DIMENSIONS,
                'selectors' => [
                    '{{WRAPPER}} .blog-content' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'ut_column_gap',
            [
                'label' => esc_html__( 'Column Gap', 'ut-elementor-addons-lite' ),
                'type' => Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                ],
                'selectors' => [
                 '{{WRAPPER}} .utal-blog-grid-wrapper' => 'margin-left: -{{SIZE}}{{UNIT}}; margin-right: -{{SIZE}}{{UNIT}}',
                 '{{WRAPPER}} .blog-post-wrap' => 'padding-left: {{SIZE}}{{UNIT}}; padding-right: {{SIZE}}{{UNIT}};',
             ],
         ]
     );

        $this->add_responsive_control(
            'row_gap',
            [
                'label' => esc_html__( 'Row Gap', 'ut-elementor-addons-lite' ),
                'type' => Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                ],
                'frontend_available' => true,
                'selectors' => [
                   '{{WRAPPER}} .blog-post-wrap' => 'margin-bottom: {{SIZE}}{{UNIT}};',
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
                    'content_readmore_show' => 'yes'
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
                    '{{WRAPPER}} .blog-readmore' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'ut_content_button_bg_color',
            [
                'label'     => esc_html__( 'Button Background Color', 'ut-elementor-addons-lite' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .blog-readmore' => 'background-color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'ut_button_border',
            [
                'label' => esc_html__( 'Style', 'ut-elementor-addons-lite' ),
                'type' => Controls_Manager::SELECT,
                'options' => [
                    '' => esc_html__( 'None', 'ut-elementor-addons-lite' ),
                    'solid' => esc_html__( 'Solid', 'ut-elementor-addons-lite' ),
                    'double' => esc_html__( 'Double', 'ut-elementor-addons-lite' ),
                    'dotted' => esc_html__( 'Dotted', 'ut-elementor-addons-lite' ),
                    'dashed' => esc_html__( 'Dashed', 'ut-elementor-addons-lite' ),
                    'groove' => esc_html__( 'Groove', 'ut-elementor-addons-lite' ),
                ],
                'selectors' => [
                    '{{WRAPPER}} .blog-content a.blog-readmore' => 'border-style: {{VALUE}}',
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
                    '{{WRAPPER}} .blog-content a.blog-readmore' => 'border-width: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'ut_button_border_color',
            [
                'label'     => esc_html__( 'Button Border Color', 'ut-elementor-addons-lite' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .blog-readmore' => 'border-color: {{VALUE}};',
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
                    '{{WRAPPER}} .blog-content a.blog-readmore' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'ut_button_box_shadow',
                'label' => esc_html__( 'Box Shadow', 'ut-elementor-addons-lite' ),
                'selector' => '{{WRAPPER}} .blog-content a.blog-readmore',
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
                    '{{WRAPPER}} .blog-readmore:hover' => 'color: {{VALUE}};border-color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'ut_content_button_bg_color_hover',
            [
                'label'     => esc_html__( 'Button Background Color: Hover', 'ut-elementor-addons-lite' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .blog-readmore:hover' => 'background-color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'ut_button_border_hover',
            [
                'label' => esc_html__( 'Style', 'ut-elementor-addons-lite' ),
                'type' => Controls_Manager::SELECT,
                'options' => [
                    '' => esc_html__( 'None', 'ut-elementor-addons-lite' ),
                    'solid' => esc_html__( 'Solid', 'ut-elementor-addons-lite' ),
                    'double' => esc_html__( 'Double', 'ut-elementor-addons-lite' ),
                    'dotted' => esc_html__( 'Dotted', 'ut-elementor-addons-lite' ),
                    'dashed' => esc_html__( 'Dashed', 'ut-elementor-addons-lite' ),
                    'groove' => esc_html__( 'Groove', 'ut-elementor-addons-lite' ),
                ],
                'selectors' => [
                    '{{WRAPPER}} .blog-content a.blog-readmore:hover' => 'border-style: {{VALUE}}',
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
                    '{{WRAPPER}} .blog-content a.blog-readmore:hover' => 'border-width: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'ut_button_border_color_hover',
            [
                'label'     => esc_html__( 'Button Border Color', 'ut-elementor-addons-lite' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .blog-readmore:hover' => 'border-color: {{VALUE}};',
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
                    '{{WRAPPER}} .blog-content a.blog-readmore:hover' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'ut_button_box_shadow_hover',
                'label' => esc_html__( 'Box Shadow', 'ut-elementor-addons-lite' ),
                'selector' => '{{WRAPPER}} .blog-content a.blog-readmore:hover',
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
                'selector' => '{{WRAPPER}} .blog-readmore',
            ]
        );

        $this->add_responsive_control(
            'ut_button_margin',
            [
                'label' => esc_html__( 'Margin', 'ut-elementor-addons-lite' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em' ],
                'selectors' => [
                    '{{WRAPPER}} .blog-content a.blog-readmore' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
                    '{{WRAPPER}} .blog-content a.blog-readmore' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->end_controls_section();
    }

    protected function render() {
        $settings = $this->get_settings();
        $this->add_render_attribute( 'utal-blog-grid', 'class', 'utal-blog-grid' );
        /* Reset all actions in hook before starting*/
        remove_all_actions('utal_pos_top');
        remove_all_actions('utal_pos_middle');
        remove_all_actions('utal_pos_bottom');
        $offset = isset( $settings[ 'offset' ] )? $settings[ 'offset' ] : '';
        $date = isset( $settings[ 'meta_date' ] )? $settings[ 'meta_date' ] : '';
        $author = isset( $settings[ 'meta_author' ] )? $settings[ 'meta_author' ] : '';
        $categories = isset( $settings[ 'meta_categories' ] )? $settings[ 'meta_categories' ] : '';
        $date_pos = isset( $settings[ 'meta_date_pos' ] )? $settings[ 'meta_date_pos' ] : 'middle';
        $author_pos = isset( $settings[ 'meta_author_pos' ] )? $settings[ 'meta_author_pos' ] : 'middle';
        $categories_pos = isset( $settings[ 'meta_categories_pos' ] )? $settings[ 'meta_categories_pos' ] : 'top';
        $date ? add_action( 'utal_pos_'. $date_pos, 'ut_elementor_addons_lite_post_date' ) : ''; // Check date and add function to hook in action ( utal_pos_top, utal_pos_middle, utal_pos_bottom )
        $author ? add_action( 'utal_pos_'. $author_pos, 'ut_elementor_addons_lite_post_author' ) : '';// Check author and add function to hook in action ( utal_pos_top, utal_pos_middle, utal_pos_bottom )
        $categories ? add_action( 'utal_pos_'. $categories_pos, 'ut_elementor_addons_lite_post_categories' ) : '';// Check categories and add function to hook in action ( utal_pos_top, utal_pos_middle, utal_pos_bottom )
        $showposts = isset( $settings[ 'showposts' ] )? $settings[ 'showposts' ] : 3;
        $excerpt = isset( $settings[ 'content_excerpts' ] )? $settings[ 'content_excerpts' ] : 200;
        $title_show = isset( $settings[ 'content_title_show' ] )? $settings[ 'content_title_show' ] : 'yes';
        $title_tag = isset( $settings[ 'content_title_tag' ] )? $settings[ 'content_title_tag' ] : 'h4';
        $readmore_show = isset( $settings[ 'content_readmore_show' ] )? $settings[ 'content_readmore_show' ] : 'yes';
        $excerpt_show = isset( $settings[ 'content_excerpts_show' ] )? $settings[ 'content_excerpts_show' ] : 'yes';
        $readmore = isset( $settings[ 'readmore' ] )? $settings[ 'readmore' ] : esc_html__('Read More', 'ut-elementor-addons-lite');
        $block_args = ut_elementor_addons_lite_query($settings,$first_id='', $showposts );
        $query = new \WP_Query( $block_args );
        $fallback_image = isset( $settings[ 'fallback_image' ] )? $settings[ 'fallback_image' ] : '';
        $enable_carousel = isset( $settings[ 'ut_post_carousel' ] )? $settings[ 'ut_post_carousel' ] : '';
        $ut_post_column = isset( $settings[ 'ut_post_column' ] )? $settings[ 'ut_post_column' ] : '3';
        $ut_post_column_tablet = isset( $settings[ 'ut_post_column_tablet' ] )? $settings[ 'ut_post_column_tablet' ] : '2';
        $ut_post_column_mobile = isset( $settings[ 'ut_post_column_mobile' ] )? $settings[ 'ut_post_column_mobile' ] : '1';
        $arrows = isset( $settings[ 'arrows' ] )? $settings[ 'arrows' ] : 'no';
        $dots = isset( $settings[ 'dots' ] )? $settings[ 'dots' ] : 'no';
        $dots_pos = isset( $settings[ 'dots_pos' ] )? $settings[ 'dots_pos' ] : 'inside-box';
        $autoplay = isset( $settings[ 'autoplay' ] )? $settings[ 'autoplay' ] : 'no';
        $autoplay_speed = isset( $settings[ 'autoplay_speed' ] )? $settings[ 'autoplay_speed' ] : '2000';
        $slidesToShow = isset( $settings[ 'slidesToShow' ] )? $settings[ 'slidesToShow' ] : 3;
        $slidesToShow_tablet = isset( $settings[ 'slidesToShow_tablet' ] )? $settings[ 'slidesToShow_tablet' ] : 2;
        $slidesToShow_mobile = isset( $settings[ 'slidesToShow_mobile' ] )? $settings[ 'slidesToShow_mobile' ] : 1;
        $infinite_loop = isset( $settings[ 'infinite_loop' ] )? $settings[ 'infinite_loop' ] : 'yes';
        $pauseOnHover = isset( $settings[ 'pauseOnHover' ] )? $settings[ 'pauseOnHover' ] : 'yes';
        $swipe = isset( $settings[ 'swipe' ] )? $settings[ 'swipe' ] : 'yes';

        $this->add_render_attribute('utal-blog-grid-slider', 'class', 'slick-slider');
        $this->add_render_attribute('utal-blog-grid-slider', 'data-arrows', $arrows);       
        $this->add_render_attribute('utal-blog-grid-slider', 'data-dots', $dots);        
        $this->add_render_attribute('utal-blog-grid-slider', 'data-slidesToShow', $slidesToShow);
        $this->add_render_attribute('utal-blog-grid-slider', 'data-slidesToShow-tablet', $slidesToShow_tablet);
        $this->add_render_attribute('utal-blog-grid-slider', 'data-slidesToShow-mobile', $slidesToShow_mobile);
        $this->add_render_attribute('utal-blog-grid-slider', 'data-infinit_loop', $infinite_loop);
        $this->add_render_attribute('utal-blog-grid-slider', 'data-pauseOnHover', $pauseOnHover);
        $this->add_render_attribute('utal-blog-grid-slider', 'data-swipe', $swipe);
        $this->add_render_attribute('utal-blog-grid-slider', 'data-autoplay', $autoplay);
        $this->add_render_attribute('utal-blog-grid-slider', 'data-autoplay_speed', $autoplay_speed);

        $class = '';
        if( !empty($ut_post_column) && !$enable_carousel ){
            $class .= $ut_post_column;
        }
        if( !empty($ut_post_column_tablet) && !$enable_carousel ){
            $class .= ' tablet-' . $ut_post_column_tablet;
        }
        if( !empty($ut_post_column_mobile) && !$enable_carousel ){
            $class .= ' mobile-' . $ut_post_column_mobile;
        }
        if( $enable_carousel ){
            $class .= 'carousel-on';
        }
        $this->add_render_attribute( 'utal-blog-grid', 'class', 'utal' );
        ?>
        <div <?php echo $this->get_render_attribute_string( 'utal-blog-grid' ); ?>>
            <?php 
            if( !empty($settings['ut_element_title']) ):?>
                <div class="block-header">
                    <h4 class="block-title">
                        <span class="title-span"><?php echo esc_html($settings['ut_element_title']);?></span>
                    </h4>
                </div>
                <?php
            endif;?>
            <div class="elementor-grid utal-blog-grid-wrapper <?php echo esc_attr($class). ' ' . esc_attr($dots_pos);?>">
                <?php 
                if ( $query->have_posts() ):
                    if( $enable_carousel ):                       

                        ?>
                        <div <?php echo $this->get_render_attribute_string('utal-blog-grid-slider'); ?>>
                            <?php
                        endif;
                        while ( $query->have_posts() ): $query->the_post();
                            ?>
                            <div class="blog-post-wrap elementor-grid-item">
                                <div class="blog-image">                                    
                                    <?php
                                    $img_src    = '';
                                    if ( has_post_thumbnail() ) {
                                        $img_src    = Group_Control_Image_Size::get_attachment_image_src( get_post_thumbnail_id(), 'ut_image_size', $settings );
                                        echo '<a href="'. esc_url(get_the_permalink()).'"><img src="'.esc_url( $img_src ) .'" alt="'. esc_attr( get_the_title() ).'"></a>';
                                    }
                                    elseif (!empty($fallback_image['id'])) { 
                                        $img_src    = Group_Control_Image_Size::get_attachment_image_src( $fallback_image['id'], 'ut_image_size', $settings );
                                        echo '<a href="'. esc_url(get_the_permalink()).'"><img src="'.esc_url( $img_src ) .'" alt="'. esc_attr( get_the_title() ).'"></a>';
                                    }
                                    do_action('utal_image_after');
                                    ?>
                                </div>
                                <div class="blog-content">
                                    <?php  
                                    do_action( 'utal_pos_top'); // trigger utal_pos_top to display post meta
                                    ($title_show) ? the_title('<'. $title_tag .'  class="blog-post-title"><a href="'. esc_url(get_the_permalink()).'">', '</a></'. $title_tag .' >') : '';  
                                    do_action( 'utal_pos_middle'); // trigger utal_pos_middle to display post meta
                                    if( $excerpt_show == 'yes' ){
                                        echo ut_elementor_addons_lite_letter_count( get_the_excerpt(), $excerpt );
                                    }                                    
                                    if(!empty($readmore) && ($readmore_show == 'yes')){
                                        echo '<div class="utal-readmore"><a class="blog-readmore" href="' . esc_url(get_the_permalink()) . '">'. esc_html( $readmore ) . '</a></div>';
                                    }
                                    do_action( 'utal_pos_bottom'); // trigger utal_pos_bottom to display post meta
                                    ?>
                                </div>
                            </div>
                            <?php
                        endwhile; 
                        wp_reset_postdata();
                        if( $enable_carousel ):
                            echo '</div>';
                        endif;
                    endif;
                    ?>
                </div>
            </div>
            <?php   
        }  
    }

    Plugin::instance()->widgets_manager->register_widget_type( new UT_Elementor_Addons_Lite_Widget_Blog_Grid() );