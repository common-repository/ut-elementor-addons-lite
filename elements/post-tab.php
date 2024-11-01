<?php
namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) exit; 

class UT_Elementor_Addons_Lite_Widget_PostTab extends Widget_Base {

    public function get_name()
    {
        return "utal-posttab";
    }

    public function get_title() 
    {
        return esc_html__( "Post Tab", "ut-elementor-addons-lite" );
    }

    public function get_icon()
    {
        return "eicon-tabs ut-widget-icon";
    }

    public function get_categories()
    {
        return [ "ut-elementor-addons-lite" ];
    }

    public function get_script_depends()
    {
        return [ "ut-elementor-addons-lite-script" ];
    }

    protected function register_controls()
    {

        $this->start_controls_section(
            'ut_post_tab_query_section_detail',
            [
                'label' => esc_html__( 'Query', 'ut-elementor-addons-lite' ),
            ]
        );

        $this->add_control(
            'ut_post_cat',
            [
                'label' => esc_html__( 'Select Categories', 'ut-elementor-addons-lite' ),
                'type' => Controls_Manager::SELECT2,
                'options' => ut_elementor_addons_lite_get_post_categories(),
                'label_block' => true,
                'multiple'  => true,
            ]
        );

        $this->add_control(
            'ut_post_count',
            [
                'label'         => esc_html__( 'Total Number of Post Per Category', 'ut-elementor-addons-lite' ),
                'type'          => Controls_Manager::NUMBER,
                'default'       => 3,
                'description'   => esc_html__( 'Enter the number of posts to display.', 'ut-elementor-addons-lite' ),
            ]
        );

        $this->add_control(
            'ut_excerpt_length',
            [
                'label' => esc_html__( 'Excerpt Length', 'ut-elementor-addons-lite' ),
                'type' => Controls_Manager::NUMBER,
                'default' => 15,
                'min' => 1,
                'max' => 100,
                'step' => 1,
                'description' => esc_html__( 'Enter the number of words you want to display in the excerpt.', 'ut-elementor-addons-lite' ),
            ]
        );

        $this->add_control(
            'ut_order_type',
            [
                'label' => esc_html__( 'Order By', 'ut-elementor-addons-lite' ),
                'type' => Controls_Manager::SELECT,
                'options' => [
                    'date' => esc_html__( 'Date', 'ut-elementor-addons-lite' ),
                    'title' => esc_html__( 'Title', 'ut-elementor-addons-lite' ),
                    'rand' => esc_html__( 'Random', 'ut-elementor-addons-lite' ),
                    'menu_order' => esc_html__( 'Menu Order', 'ut-elementor-addons-lite' ),
                    'day' => esc_html__( 'Day', 'ut-elementor-addons-lite' ),
                ],
                'default' => 'day',
                'description' => esc_html__( 'Select the order type for the posts.', 'ut-elementor-addons-lite' ),
            ]
        ); 

        $this->add_control(
            'ut_order',
            [
                'label' => esc_html__( 'Order', 'ut-elementor-addons-lite' ),
                'type' => Controls_Manager::SELECT,
                'options' => [
                    'ASC' => esc_html__( 'Ascending', 'ut-elementor-addons-lite' ),
                    'DESC' => esc_html__( 'Descending', 'ut-elementor-addons-lite' ),
                ],
                'default' => 'DESC',
                'description' => esc_html__( 'Select the order for the posts.', 'ut-elementor-addons-lite' ),
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'ut_post_tab_settings_detail',
            [
                'label' => esc_html__( 'Settings', 'ut-elementor-addons-lite' ),
                'tab'   => Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'ut_post_tab_filer_align', 
            [
                'label' => esc_html__( 'Filter Tab Alignment', 'ut-elementor-addons-lite' ),
                'type' => Controls_Manager::CHOOSE,
                'default'       => 'left',
                'options'       => [
                    'left'      => [
                        'title' => esc_html__( 'Left', 'ut-elementor-addons-lite' ),
                        'icon'  => 'eicon-text-align-left'
                    ],
                    'center'    => [
                        'title' => esc_html__( 'Center', 'ut-elementor-addons-lite' ),
                        'icon'  => 'eicon-text-align-center'
                    ],
                    'right'     => [
                        'title' => esc_html__( 'Right', 'ut-elementor-addons-lite' ),
                        'icon'  => 'eicon-text-align-right'
                    ]
                ],
                'selectors'     => [
                    '{{WRAPPER}} .ut_post_tab_filter_title' => 'justify-content: {{VALUE}};',
                ],
                'description'   => esc_html__( 'Select the alignment for the filter tab.', 'ut-elementor-addons-lite' ),
                'condition' => [
                    'ut_post_tab_filter_position' => 'ut_top_filter',
                ],
            ]
        );

        $this->add_control(
            'ut_post_tab_filer_align_for_left_and_right', 
            [
                'label' => esc_html__( 'Filter Tab Alignment', 'ut-elementor-addons-lite' ),
                'type' => Controls_Manager::CHOOSE,
                'default'       => 'flex-start',
                'options'       => [
                    'flex-start'      => [
                        'title' => esc_html__( 'Top', 'ut-elementor-addons-lite' ),
                        'icon'  => 'eicon-v-align-top'
                    ],
                    'center'    => [
                        'title' => esc_html__( 'Middle', 'ut-elementor-addons-lite' ),
                        'icon'  => 'eicon-v-align-middle'
                    ],
                    'flex-end'     => [
                        'title' => esc_html__( 'Bottom', 'ut-elementor-addons-lite' ),
                        'icon'  => 'eicon-v-align-bottom'
                    ]
                ],
                'selectors'     => [
                    '{{WRAPPER}} .ut_post_tab_filter_title' => 'justify-content: {{VALUE}};',
                ],
                'description'   => esc_html__( 'Select the alignment for the filter tab.', 'ut-elementor-addons-lite' ),
                'condition' => [
                    'ut_post_tab_filter_position' => ['ut_left_filter', 'ut_right_filter'],
                ],
            ]
        );

        $this->add_control(
            'ut_post_tab_filter_position',
            [
                'label'     => esc_html__( 'Filter Tab Position', 'ut-elementor-addons-lite' ),
                'type'      => Controls_Manager::CHOOSE,
                'default'   => 'ut_top_filter',
                'options'        => [
                    'ut_left_filter'  => [
                        'title' => esc_html__( 'Left', 'ut-elementor-addons-lite' ),
                        'icon'  => 'eicon-h-align-left',
                    ],
                    'ut_top_filter'   => [
                        'title' => esc_html__( 'Top', 'ut-elementor-addons-lite' ),
                        'icon'  => 'eicon-v-align-top',
                    ],
                    'ut_right_filter' => [
                        'title' => esc_html__( 'Right', 'ut-elementor-addons-lite' ),
                        'icon'  => 'eicon-h-align-right',
                    ],
                ],
                'description' => esc_html__( 'Select the position of the filter tab.', 'ut-elementor-addons-lite' ),
            ]
        );

        $this->add_control(
            'ut_post_tab_col',
            [
                'label'     => esc_html__( 'Select Column', 'ut-elementor-addons-lite' ),
                'type'      => Controls_Manager::SELECT,
                'default'   => 'ut_column-3',
                'options'   => [
                    'ut_column-1'     => esc_html__( '1 Column', 'ut-elementor-addons-lite' ),
                    'ut_column-2'     => esc_html__( '2 Column', 'ut-elementor-addons-lite' ),
                    'ut_column-3'     => esc_html__( '3 Column', 'ut-elementor-addons-lite' ),
                    'ut_column-4'     => esc_html__( '4 Column', 'ut-elementor-addons-lite' ),
                ],
                'description'   => esc_html__( 'Select the number of columns to display.', 'ut-elementor-addons-lite' ),
            ]
        );

        $this->add_control(
            'ut_show_user_meta',
            [
                'label'        => esc_html__( 'Show User Meta', 'ut-elementor-addons-lite' ),
                'type'         => Controls_Manager::SWITCHER,
                'label_on'     => esc_html__( 'Show', 'ut-elementor-addons-lite' ),
                'label_off'    => esc_html__( 'Hide', 'ut-elementor-addons-lite' ),
                'return_value' => 'yes',
                'default'      => 'yes',
            ]
        );

        $this->add_control(
            'ut_show_date_meta',
            [
                'label'        => esc_html__( 'Show Date Meta', 'ut-elementor-addons-lite' ),
                'type'         => Controls_Manager::SWITCHER,
                'label_on'     => esc_html__( 'Show', 'ut-elementor-addons-lite' ),
                'label_off'    => esc_html__( 'Hide', 'ut-elementor-addons-lite' ),
                'return_value' => 'yes',
                'default'      => 'yes',
            ]
        );

        $this->add_control(
            'ut_excerpt',
            [
                'label'        => esc_html__( 'Show Excerpt', 'ut-elementor-addons-lite' ),
                'type'         => Controls_Manager::SWITCHER,
                'label_on'     => esc_html__( 'Show', 'ut-elementor-addons-lite' ),
                'label_off'    => esc_html__( 'Hide', 'ut-elementor-addons-lite' ),
                'return_value' => 'yes',
                'default'      => 'yes',
            ]
        );

        $this->add_control(
            'ut_display_comments',
            [
                'label' => esc_html__( 'Show Comments', 'ut-elementor-addons-lite' ),
                'type' => Controls_Manager::SWITCHER,
                'label_on' => esc_html__( 'Show', 'ut-elementor-addons-lite' ),
                'label_off' => esc_html__( 'Hide', 'ut-elementor-addons-lite' ),
                'return_value' => 'yes',
                'default' => 'yes',
            ]
        );

        $this->add_control(
            'ut_display_categories',
            [
                'label' => esc_html__( 'Show Categories', 'ut-elementor-addons-lite' ),
                'type' => Controls_Manager::SWITCHER,
                'label_on' => esc_html__( 'Show', 'ut-elementor-addons-lite' ),
                'label_off' => esc_html__( 'Hide', 'ut-elementor-addons-lite' ),
                'return_value' => 'yes',
                'default' => 'yes',
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'ut_post_tab_section_style',
            [
                'label' => esc_html__( 'Tab', 'ut-elementor-addons-lite' ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name' => 'ut_post_tab_background_color',
                'label' => esc_html__( 'Background', 'ut-elementor-addons-lite' ),
                'types' => [ 'classic', ],
                'exclude' => [
                    'image'
                ],
                'selector' => '{{WRAPPER}} .ut_post_tab_filter_title',
            ]
        );

        $this->add_responsive_control(
            'ut_post_tab_padding',
            [
                'label'      => esc_html__( 'Padding', 'ut-elementor-addons-lite' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', 'em', '%' ],
                'selectors'  => [
                    '{{WRAPPER}} .ut_post_tab_filter_title' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'ut_post_tab_margin',
            [
                'label' => esc_html__( 'Margin', 'ut-elementor-addons-lite' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em' ],
                'selectors' => [
                    '{{WRAPPER}} .ut_post_tab_filter_title' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'ut_post_tab_radius',
            [
                'label'      => esc_html__( 'Border Radius', 'ut-elementor-addons-lite' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%' ],
                'selectors'  => [
                    '{{WRAPPER}} .ut_post_tab_filter_title' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name'     => 'ut_post_tab_shadow',
                'label'    => esc_html__( 'Box Shadow', 'ut-elementor-addons-lite' ),
                'selector' => '{{WRAPPER}} .ut_post_tab_main_wrapper .ut_post_tab_filter_title',
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name'     => 'ut_post_tab_border',
                'label'    => esc_html__( 'Border', 'ut-elementor-addons-lite' ),
                'selector' => '{{WRAPPER}} .ut_post_tab_main_wrapper .ut_post_tab_filter_title',
            ]
        );

        $this->add_responsive_control(
            'ut_tab_item',
            [
                'label'     => esc_html__( 'Tab Item', 'ut-elementor-addons-lite' ),
                'type'      => Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );

        $this->add_responsive_control(
            'ut_post_tabs_gap',
            [
                'label' => esc_html__( 'Tab Gap', 'ut-elementor-addons-lite' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => ['px'],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .ut_post_tab_main_wrapper .ut_post_tab_filter_title' => 'gap: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'ut_tab_item_margin',
            [
                'label'      => esc_html__( 'Margin', 'ut-elementor-addons-lite' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%' ],
                'selectors'  => [
                    '{{WRAPPER}} .ut_post_tab_main_wrapper .ut_post_tab_filter_title .ut-post-tabs' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'ut_tab_item_padding',
            [
                'label'      => esc_html__( 'Padding', 'ut-elementor-addons-lite' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', 'em', '%' ],
                'selectors'  => [
                    '{{WRAPPER}} .ut_post_tab_main_wrapper .ut_post_tab_filter_title .ut-post-tabs' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'     => 'ut_post_tab_title_typography',
                'selector' => '{{WRAPPER}} .ut_post_tab_main_wrapper .ut_post_tab_filter_title .ut-post-tabs',
            ]
        );

        $this->add_responsive_control(
            'ut_post_tab_item_border_radiuss',
            [
                'label' => esc_html__( 'Border Radius', 'ut-elementor-addons-lite' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em' ],
                'selectors' => [
                    '{{WRAPPER}} .ut_post_tab_main_wrapper .ut_post_tab_filter_title .ut-post-tabs' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'ut_post_tab_item_normal_border',
                'label' => esc_html__( 'Border', 'ut-elementor-addons-lite' ),
                'selector' => '{{WRAPPER}} .ut_post_tab_main_wrapper .ut_post_tab_filter_title .ut-post-tabs',
            ]
        );

        $this->start_controls_tabs(
            'ut_post_tab_normal_hover_and_active_tabs'
        );

        $this->start_controls_tab(
            'ut_post_tab_normal_tab',
            [
                'label' => esc_html__( 'Normal', 'ut-elementor-addons-lite' ),
            ]
        );

        $this->add_control(
            'ut_post_tab_normal_item_color',
            [
                'label' => esc_html__( 'Color', 'ut-elementor-addons-lite' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .ut_post_tab_main_wrapper .ut_post_tab_filter_title .ut-post-tabs' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name' => 'ut_post_tab_normal_item_background_color',
                'label' => esc_html__( 'Background', 'ut-elementor-addons-lite' ),
                'types' => [ 'classic', ],
                'exclude' => [
                    'image'
                ],
                'selector' => '{{WRAPPER}} .ut_post_tab_main_wrapper .ut_post_tab_filter_title .ut-post-tabs',
            ]
        );

        $this->end_controls_tab();

        $this->start_controls_tab(
            'ut_post_tab_hover_tab',
            [
                'label' => esc_html__( 'Hover', 'ut-elementor-addons-lite' ),
            ]
        );

        $this->add_control(
            'ut_post_tab_hover_item_color',
            [
                'label' => esc_html__( 'Color', 'ut-elementor-addons-lite' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .ut_post_tab_main_wrapper .ut_post_tab_filter_title .ut-post-tabs:hover' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name' => 'ut_post_tab_hover_item_background_color',
                'label' => esc_html__( 'Background', 'ut-elementor-addons-lite' ),
                'types' => [ 'classic', ],
                'exclude' => [
                    'image'
                ],
                'selector' => '{{WRAPPER}} .ut_post_tab_main_wrapper .ut_post_tab_filter_title .ut-post-tabs:hover',
            ]
        );

        $this->add_control(
            'ut_post_tab_normal_item_border_hover',
            [
                'label' => esc_html__( 'Border Color', 'ut-elementor-addons-lite' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .ut_post_tab_main_wrapper .ut_post_tab_filter_title .ut-post-tabs:hover' => 'border-color: {{VALUE}}',
                ],
            ]
        );

        $this->end_controls_tab();

        $this->start_controls_tab(
            'ut_post_tab_active_tab',
            [
                'label' => esc_html__( 'Active', 'ut-elementor-addons-lite' ),
            ]
        );

        $this->add_control(
            'ut_post_tab_active_item_color',
            [
                'label' => esc_html__( 'Color', 'ut-elementor-addons-lite' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .ut_post_tab_main_wrapper .ut_post_tab_filter_title .ut-post-tabs.active' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name' => 'ut_post_tab_active_item_background_color',
                'label' => esc_html__( 'Background', 'ut-elementor-addons-lite' ),
                'types' => [ 'classic', ],
                'exclude' => [
                    'image'
                ],
                'selector' => '{{WRAPPER}} .ut_post_tab_main_wrapper .ut_post_tab_filter_title .ut-post-tabs.active',
            ]
        );

        $this->add_control(
            'ut_post_tab_normal_item_border_active',
            [
                'label' => esc_html__( 'Border Color', 'ut-elementor-addons-lite' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .ut_post_tab_main_wrapper .ut_post_tab_filter_title .ut-post-tabs.active' => 'border-color: {{VALUE}}',
                ],
            ]
        );

        $this->end_controls_tab();

        $this->end_controls_tabs();

        $this->end_controls_section();

        $this->start_controls_section(
            'ut_section_post_tab_content',
            [
                'label' => esc_html__( 'Content', 'ut-elementor-addons-lite' ),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_responsive_control(
            'ut_post_tab_filter_column_gap',
            [
                'label' => esc_html__( 'Filter Tab Column Gap', 'ut-elementor-addons-lite' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => ['px'],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .ut_post_tab_main_wrapper.ut_right_filter, .ut_post_tab_main_wrapper.ut_left_filter' => 'grid-column-gap: {{SIZE}}{{UNIT}};',
                ],
                'condition' => [
                    'ut_post_tab_filter_position' => 'ut_left_filter',
                    'ut_post_tab_filter_position' => 'ut_right_filter',
                ],
            ]
        );

        $this->add_responsive_control(
            'ut_post_tab_content_column_gap',
            [
                'label' => esc_html__( 'Tab Content Column Gap', 'ut-elementor-addons-lite' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => ['px'],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .ut_post_tab_main_wrapper .ut-post-tab-contents' => 'gap: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name' => 'ut_post_tab_main_wrapper_background',
                'label' => esc_html__( 'Background', 'ut-elementor-addons-lite' ),
                'types' => [ 'classic', ],
                'exclude' => [
                    'image'
                ],
                'selector' => '{{WRAPPER}} .ut_post_tab_content_list_wrapper',
            ]
        );

        $this->add_responsive_control(
            'ut_post_tab_main_wrapper_padding',
            [
                'label'      => esc_html__( 'Padding', 'ut-elementor-addons-lite' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', 'em', '%' ],
                'selectors'  => [
                    '{{WRAPPER}} .ut_post_tab_content_list_wrapper' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'ut_post_tab_main_wrapper_margin',
            [
                'label' => esc_html__( 'Margin', 'ut-elementor-addons-lite' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em' ],
                'selectors' => [
                    '{{WRAPPER}} .ut_post_tab_content_list_wrapper' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'ut_post_tab_main_wrapper_radius',
            [
                'label'      => esc_html__( 'Border Radius', 'ut-elementor-addons-lite' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%' ],
                'selectors'  => [
                    '{{WRAPPER}} .ut_post_tab_content_list_wrapper' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'ut_post_content_image',
            [
                'label' => esc_html__( 'Image', 'ut-elementor-addons-lite' ),
                'type'  => Controls_Manager::HEADING,
            ]
        );

        $this->add_responsive_control(
            'ut_post_item_content_img_margin_btm',
            [
                'label' => esc_html__( 'Margin', 'ut-elementor-addons-lite' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em' ],
                'selectors' => [
                    '{{WRAPPER}} .ut_post_tab_thumb' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'default'=>[
                    'unit' => 'px',
                    'size' => '0',
                ],
            ]
        );

        $this->add_responsive_control(
            'ut_image_boder_radius',
            [
                'label'      => esc_html__( 'Border Radius', 'ut-elementor-addons-lite' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%' ],
                'selectors'  => [
                    '{{WRAPPER}} .ut_post_tab_main_wrapper .ut_post_tab_thumb img' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'ut_post_content_title',
            [
                'label'     => esc_html__( 'Title', 'ut-elementor-addons-lite' ),
                'type'      => Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );

        $this->add_responsive_control(
            'ut_post_content_title_margin',
            [
                'label' => esc_html__( 'Margin', 'ut-elementor-addons-lite' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em' ],
                'selectors' => [
                    '{{WRAPPER}} .ut_post_tab_main_wrapper .ut_post_list_wrapper .ut_post_tab_title a' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'default'=>[
                    'unit' => 'px',
                    'size' => '0',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'     => 'ut_post_content_title_typography',
                'selector' => '{{WRAPPER}} .ut_post_tab_title h2 a',
            ]
        );

        $this->start_controls_tabs( 'ut_title_tabs' );

        $this->start_controls_tab(
            'ut_title_normal_tab',
            [
                'label' => esc_html__( 'Normal', 'ut-elementor-addons-lite' ),
            ]
        );

        $this->add_control(
            'ut_title_color',
            [
                'label'     => esc_html__( 'Color', 'ut-elementor-addons-lite' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .ut_post_tab_title h2 a' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->end_controls_tab();

        $this->start_controls_tab(
            'ut_title_hover_tab',
            [
                'label' => esc_html__( 'Hover', 'ut-elementor-addons-lite' ),
            ]
        );

        $this->add_control(
            'ut_title_hvr_color',
            [
                'label'     => esc_html__( 'Color', 'ut-elementor-addons-lite' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .ut_post_tab_title h2 a:hover' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->end_controls_tab();

        $this->end_controls_tabs();

        $this->add_responsive_control(
            'ut_post_content_meta',
            [
                'label'     => esc_html__( 'User and Date Meta', 'ut-elementor-addons-lite' ),
                'type'      => Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );

        $this->add_responsive_control(
            'ut_post_tabs_user_and_date_gap',
            [
                'label' => esc_html__( 'User and Date Meta Gap', 'ut-elementor-addons-lite' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => ['px'],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 200,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .ut_post_tab_main_wrapper .ut_post_tab_content .ut_post_tab_meta_wrapper' => 'gap: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'ut_meta_margin',
            [
                'label' => esc_html__( 'Margin', 'ut-elementor-addons-lite' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em' ],
                'selectors' => [
                    '{{WRAPPER}} .ut_post_tab_meta_wrapper span' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'     => 'ut_meta_typography',
                'label'    => esc_html__( 'Typography', 'ut-elementor-addons-lite' ),
                'selector' => '{{WRAPPER}} .ut_post_tab_main_wrapper .ut_post_tab_content .ut_post_tab_meta_wrapper span, .ut_post_tab_meta_wrapper span a',
            ]
        );

        $this->start_controls_tabs( 'ut_meta_tabs' );

        $this->start_controls_tab(
            'ut_meta_normal_tab',
            [
                'label' => esc_html__( 'Normal', 'ut-elementor-addons-lite' ),
            ]
        );

        $this->add_control(
            'ut_meta_normal_color',
            [
                'label'     => esc_html__( 'Normal Color', 'ut-elementor-addons-lite' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .ut_post_tab_meta_wrapper span i' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .ut_post_tab_meta_wrapper span a' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->end_controls_tab();

        $this->start_controls_tab(
            'ut_meta_hover_tab',
            [
                'label' => esc_html__( 'Hover', 'ut-elementor-addons-lite' ),
            ]
        );

        $this->add_control(
            'ut_meta_hover_color',
            [
                'label'     => esc_html__( 'Hover Color', 'ut-elementor-addons-lite' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .ut_post_tab_meta_wrapper span:hover i' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .ut_post_tab_meta_wrapper span:hover a' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->end_controls_tab();

        $this->end_controls_tabs();

        $this->add_responsive_control(
            'ut_post_tab_comment_categories_meta',
            [
                'label'     => esc_html__( 'Comment and Categories Meta', 'ut-elementor-addons-lite' ),
                'type'      => Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );

        $this->add_responsive_control(
            'ut_post_tab_comment_categories_meta_gap',
            [
                'label' => esc_html__( 'Comment and Categories Meta Gap', 'ut-elementor-addons-lite' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => ['px'],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 200,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .ut_post_tab_comments_categories_wrapper' => 'gap: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'ut_post_tab_comment_meta',
            [
                'label' => esc_html__( 'Margin', 'ut-elementor-addons-lite' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em' ],
                'selectors' => [
                    '{{WRAPPER}} .ut_post_tab_comments_categories_wrapper' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'     => 'ut_post_tab_comment_categories_meta_typography',
                'label'    => esc_html__( 'Typography', 'ut-elementor-addons-lite' ),
                'selector' => '{{WRAPPER}} .ut_comments_count, .ut_post_tab_comments_categories_wrapper>div[class*="ut_"]',
            ]
        );

        $this->start_controls_tabs( 'ut_post_tab_comment_categories_meta_tabs' );

        $this->start_controls_tab(
            'ut_post_tab_comment_categories_meta_normal_tabs',
            [
                'label' => esc_html__( 'Normal', 'ut-elementor-addons-lite' ),
            ]
        );

        $this->add_control(
            'ut_post_tab_comment_categories_meta_normal_color',
            [
                'label'     => esc_html__( 'Normal Color', 'ut-elementor-addons-lite' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .ut_post_tab_comments_categories_wrapper>div[class*="ut_"] i' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .ut_comments_count' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .ut_post_tab_comments_categories_wrapper>div[class*="ut_"] a' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->end_controls_tab();

        $this->start_controls_tab(
            'ut_post_tab_comment_categories_meta_hover_tabs',
            [
                'label' => esc_html__( 'Hover', 'ut-elementor-addons-lite' ),
            ]
        );

        $this->add_control(
            'ut_post_tab_comment_categories_meta_hover_color',
            [
                'label'     => esc_html__( 'Hover Color', 'ut-elementor-addons-lite' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .ut_post_tab_comments_categories_wrapper>div[class*="ut_"]:hover i' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .ut_comments_count:hover' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .ut_post_tab_comments_categories_wrapper>div[class*="ut_"]:hover a' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->end_controls_tab();

        $this->end_controls_tabs();

        $this->add_responsive_control(
            'ut_post_content_excerpt',
            [
                'label'     => esc_html__( 'Excerpt', 'ut-elementor-addons-lite' ),
                'type'      => Controls_Manager::HEADING,
                'separator' => 'before',
                'condition' => [
                    'ut_excerpt' => 'yes',
                ],
            ]
        );

        $this->add_responsive_control(
            'ut_excerpt_margin',
            [
                'label'      => esc_html__( 'Margin', 'ut-elementor-addons-lite' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%' ],
                'selectors'  => [
                    '{{WRAPPER}} .ut_post_tab_main_wrapper .ut_post_tab_content .ut_post_tab_excerpt' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'condition' => [
                    'ut_excerpt' => 'yes',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'     => 'ut_excerpt_typography',
                'label'    => esc_html__( 'Typography', 'ut-elementor-addons-lite' ),
                'selector' => '{{WRAPPER}} .ut_post_tab_main_wrapper .ut_post_tab_content .ut_post_tab_excerpt',
                'condition' => [
                    'ut_excerpt' => 'yes',
                ],
            ]
        );

        $this->add_control(
            'ut_excerpt_color',
            [
                'label'     => esc_html__( 'Color', 'ut-elementor-addons-lite' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .ut_post_tab_main_wrapper .ut_post_tab_content .ut_post_tab_excerpt' => 'color: {{VALUE}};',
                ],
                'condition' => [
                    'ut_excerpt' => 'yes',
                ],
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'ut_post_content_mobile_dropdown',
            [
                'label' => esc_html__( 'Mobile Dropdown', 'ut-elementor-addons-lite' ),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_responsive_control(
            'ut_post_tab_dropdown_color',
            [
                'label'     => esc_html__( 'Color', 'ut-elementor-addons-lite' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .ut_post_tab_main_wrapper .ut_post_dropdown_filter .ut-post-dropdown' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'ut_post_tab_dropdown_background_color',
            [
                'label'     => esc_html__( 'Background Color', 'ut-elementor-addons-lite' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .ut_post_tab_main_wrapper .ut_post_dropdown_filter .ut-post-dropdown' => 'background: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name'     => 'ut_post_tab_dropdown_border',
                'label'    => esc_html__( 'Border', 'ut-elementor-addons-lite' ),
                'selector' => '{{WRAPPER}} .ut_post_tab_main_wrapper .ut_post_dropdown_filter .ut-post-dropdown',
            ]
        );

        $this->end_controls_section();

    }

    protected function render()
    {
        $settings = $this->get_settings(); 
        $ut_post_cat = isset( $settings['ut_post_cat'] ) ? $settings['ut_post_cat'] : '';
        $ut_post_count = isset( $settings['ut_post_count'] ) ? $settings['ut_post_count'] : 3;
        $ut_post_tab_col = isset( $settings['ut_post_tab_col'] ) ? $settings['ut_post_tab_col'] : 'ut_column-3';
        $ut_excerpt_length = isset( $settings['ut_excerpt_length'] ) ? $settings['ut_excerpt_length'] : 15;
        $ut_order_type = isset( $settings['ut_order_type'] ) ? $settings['ut_order_type'] : 'day';
        $ut_order = isset( $settings['ut_order'] ) ? $settings['ut_order'] : 'DESC';
        $ut_post_tab_filter_position = isset( $settings['ut_post_tab_filter_position'] ) ? $settings['ut_post_tab_filter_position'] : 'left';
        $ut_display_comments = isset( $settings['ut_display_comments'] ) ? $settings['ut_display_comments'] : 'yes';
        $ut_display_categories = isset( $settings['ut_display_categories'] ) ? $settings['ut_display_categories'] : 'yes';
        ?> 

        <div class="ut_post_tab_main_wrapper <?php echo esc_attr( $ut_post_tab_filter_position ); ?>">

            <div class="ut_post_dropdown_filter">
                <select class="ut-post-dropdown" data-toggle-target=".ut-post-tab-contents-">
                    <?php
                    $args = array(
                        'taxonomy' => 'category',
                        'hide_empty' => -1,
                        'include' => $ut_post_cat,
                    );
                    $subcat = get_categories($args);
                    foreach ($subcat as $cat) {
                        $term_id = $cat->term_id; 
                        $cat_name = $cat->name;
                        ?>
                        <option value="<?php echo esc_attr( $term_id ); ?>"><?php echo esc_html( $cat_name ); ?></option>
                    <?php } ?>
                </select>
            </div>

            <div class="ut_post_tab_filter_title">
                <?php
                $args = array(
                    'taxonomy'    => 'category',
                    'hide_empty'    => -1,
                    'include' => $ut_post_cat,
                );
                $subcat = get_categories($args);
                $count=1;
                foreach ( $subcat as $cat ) {
                    $term_id = $cat->term_id; 
                    $cat_name = $cat->name;
                    ?>
                    <a href="#" class="ut-post-tabs <?php if ( $count ==1 ) { ?>active<?php } ?>" data-toggle-target=".ut-post-tab-contents-<?php echo esc_attr( $term_id ); ?>"><?php echo esc_html( $cat_name ); ?></a>
                    <?php $count++; } ?>
                </div>

                <div class="clearfix"></div>

                <div class="ut_post_tab_content_list_wrapper">
                    <?php
                    $count=1;
                    foreach ( $subcat as $cat ) {
                        $term_id = $cat->term_id;
                        ?>
                        <div class="ut-post-tab-contents <?php echo esc_attr( $ut_post_tab_col ); ?> <?php if ( $count ==1 ) { ?>active<?php } ?> ut-post-tab-contents-<?php echo esc_attr( $term_id ); ?>">
                            <?php 
                            $args = array(
                                'post_type' => 'post',
                                'posts_per_page' => $ut_post_count,
                                'orderby' => $ut_order_type,
                                'order' => $ut_order,
                                'tax_query' => array(
                                    array(
                                        'taxonomy' => 'category',
                                        'field'    => 'term_id',
                                        'terms'    => $term_id,
                                    ),
                                ),
                            );
                            $query = new \WP_Query($args);
                            if ( $query->have_posts() ) {
                                while ( $query->have_posts() ) {
                                    $query->the_post();
                                    ?>
                                    <div class="ut_post_list_wrapper tablet_2 mobile_1">
                                        <div class="ut_post_tab_content">
                                            <div class="ut_post_tab_thumb">
                                                <?php if ( has_post_thumbnail() ) { ?>
                                                    <a href="<?php echo esc_url( get_the_permalink() ); ?>"><?php the_post_thumbnail( 'full' ); ?></a>
                                                <?php } ?>
                                            </div>
                                            <div class="ut_post_tab_meta_wrapper">
                                                <?php
                                                if ( 'yes' == $settings['ut_show_user_meta'] ) {
                                                    ?>
                                                    <span class="ut_post_tab_meta_author">
                                                        <i class="fa fa-pen-square"></i>
                                                        <a href="<?php echo esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ); ?>"><?php the_author(); ?></a>
                                                    </span>
                                                <?php } ?>
                                                <?php
                                                if ( 'yes' == $settings['ut_show_date_meta'] ) {
                                                    ?>
                                                    <span class="ut_post_tab_meta_date">
                                                        <i class="fa fa-calendar-check"></i>
                                                        <a href="<?php echo esc_url( get_day_link( get_the_time( 'Y' ), get_the_time( 'm' ), get_the_time( 'd' ) ) ); ?>"><?php echo esc_html( get_the_date() ); ?></a>
                                                    </span>
                                                <?php } ?>
                                            </div>
                                            <div class="ut_post_tab_title_excerpt_wrapper">
                                                <div class="ut_post_tab_title"> 
                                                    <h2><a href="<?php echo esc_url( get_the_permalink() ); ?>"><?php echo esc_html( get_the_title() ); ?></a></h2>  
                                                </div>
                                                <?php
                                                if ( 'yes' == $settings['ut_excerpt'] ) {
                                                    if ( ! empty(get_the_excerpt() ) ) {
                                                        ?>
                                                        <div class="ut_post_tab_excerpt">
                                                            <p><?php echo esc_html( wp_trim_words( get_the_excerpt(), $ut_excerpt_length ) ); ?></p>
                                                        </div>
                                                    <?php }} ?>
                                                </div>
                                                <div class="ut_post_tab_comments_categories_wrapper">
                                                    <?php if ( 'yes' == $ut_display_comments ) { ?>
                                                        <div class="ut_comments_count">
                                                            <i class="fa fa-comments"></i>
                                                            <?php comments_number(); ?>
                                                        </div>
                                                    <?php } ?>
                                                    <?php if ( 'yes' == $ut_display_categories ) { ?>
                                                        <div class="ut_post_categories">
                                                            <i class="fa fa-folder"></i>
                                                            <?php the_category(); ?>
                                                        </div>
                                                    <?php } ?>
                                                </div>
                                            </div>
                                        </div>
                                    <?php }} wp_reset_postdata(); ?>
                                </div>
                                <?php $count++; } ?>
                            </div>
                        </div>

                        <?php 
                    }
                }

                Plugin::instance()->widgets_manager->register_widget_type(
                    new UT_Elementor_Addons_Lite_Widget_PostTab()
                );
