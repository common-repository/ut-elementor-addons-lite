<?php
namespace Elementor;   

if ( ! defined( 'ABSPATH' ) ) exit; 

class UT_Elementor_Addons_Lite_Widget_Pricing extends Widget_Base {

    use \Elementor\UT_Elementor_Addons_Lite_Queries; 

    public function get_name() { 
        return 'utal-pricing-table';
    } 

    public function get_title() {
        return  esc_html__( 'Pricing Table', 'ut-elementor-addons-lite' );
    }

    public function get_icon() {
        return 'eicon-price-table ut-widget-icon'; 
    } 

    public function get_categories() {  
        return [ 'ut-elementor-addons-lite' ]; 
    }

    protected function register_controls() { 

        $this->start_controls_section(
            'ut_section_pricing_table_title',
            [
                'label' => esc_html__( 'Header', 'ut-elementor-addons-lite' ),
            ]
        );

        $this->add_control(
            'ut_pricing_table_title',
            [
                'label'       => esc_html__( 'Title & Description', 'ut-elementor-addons-lite' ),
                'type'        => Controls_Manager::TEXT,
                'label_block' => true,
                'default'     => esc_html__( 'Enter your title', 'ut-elementor-addons-lite' ),
            ]
        );

        $this->add_control(
            'ut_pricing_table_description',
            [
                'type'        => Controls_Manager::TEXTAREA,
                'label_block' => true,
                'default'     => esc_html__( 'Enter your description', 'ut-elementor-addons-lite' ),
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'ut_section_pricing_table_price',
            [
                'label' => esc_html__( 'Pricing', 'ut-elementor-addons-lite' ),
            ]
        );

        $this->add_control(
            'ut_pricing_table_price',
            [
                'label'       => esc_html__( 'Price', 'ut-elementor-addons-lite' ),
                'type'        => Controls_Manager::TEXT,
                'label_block' => false,
                'default'     => '88',
            ]
        );

        $this->add_control(
            'ut_pricing_table_onsale',
            [
                'label'        => esc_html__( 'On Sale?', 'ut-elementor-addons-lite' ),
                'type'         => Controls_Manager::SWITCHER,
                'default'      => 'no',
                'label_on'     => esc_html__( 'Yes', 'ut-elementor-addons-lite' ),
                'label_off'    => esc_html__( 'No', 'ut-elementor-addons-lite' ),
                'return_value' => 'yes',
            ]
        );

        $this->add_control(
            'ut_pricing_table_onsale_price',
            [
                'label'       => esc_html__( 'Sale Price', 'ut-elementor-addons-lite' ),
                'type'        => Controls_Manager::TEXT,
                'label_block' => false,
                'default'     => '70',
                'condition'   => [
                    'ut_pricing_table_onsale' => 'yes',
                ],
            ]
        );

        $this->add_control(
            'ut_pricing_table_price_currency',
            [
                'label'       => esc_html__( 'Currency Symbol', 'ut-elementor-addons-lite' ),
                'type'        => Controls_Manager::TEXT,
                'label_block' => false,
                'default'     => esc_html__( '$', 'ut-elementor-addons-lite' ),
            ]
        );

        $this->add_control(
            'ut_pricing_table_price_period',
            [
                'label'       => esc_html__( 'Period', 'ut-elementor-addons-lite' ),
                'type'        => Controls_Manager::TEXT,
                'label_block' => false,
                'default'     => esc_html__( 'month', 'ut-elementor-addons-lite' ),
            ]
        );

        $this->add_control(
            'ut_pricing_table_period_separator',
            [
                'label'       => esc_html__( 'Period Separator', 'ut-elementor-addons-lite' ),
                'type'        => Controls_Manager::TEXT,
                'label_block' => false,
                'default'     => esc_html__( '/', 'ut-elementor-addons-lite' ),
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'ut_section_pricing_table_feature',
            [
                'label' => esc_html__( 'Features', 'ut-elementor-addons-lite' ),
            ]
        );

        $repeater = new Repeater();

        $repeater->add_control(
            'ut_pricing_table_item',
            [
                'label'       => esc_html__( 'List Item', 'ut-elementor-addons-lite' ),
                'type'        => Controls_Manager::TEXT,
                'label_block' => true,
                'default'     => esc_html__( 'Pricing table list item', 'ut-elementor-addons-lite' ),
            ]
        );

        $repeater->add_control(
            'ut_pricing_table_list_icon_new',
            [
                'label'            => esc_html__( 'List Icon', 'ut-elementor-addons-lite' ),
                'type'             => Controls_Manager::ICONS,
                'default'          => [
                    'value'   => 'fas fa-check',
                    'library' => 'fa-solid',
                ],
            ]
        );

        $this->add_control(
            'ut_feature_list',
            [
                'type'        => Controls_Manager::REPEATER,
                'seperator'   => 'before',
                'default'     => [
                    ['ut_pricing_table_item' => 'Unlimited calls'],
                    ['ut_pricing_table_item' => 'Free hosting'],
                    ['ut_pricing_table_item' => '500 MB of storage space'],
                    ['ut_pricing_table_item' => '500 MB Bandwidth'],
                    ['ut_pricing_table_item' => '24/7 support'],
                ],
                'fields'      => $repeater->get_controls(),
                'title_field' => '{{ ut_pricing_table_item }}',
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'ut_section_pricing_table_footerr',
            [
                'label' => esc_html__( 'Footer', 'ut-elementor-addons-lite' ),
            ]
        );

        $this->add_control(
            'ut_button_section',
            [
                'label'        => esc_html__( 'Button', 'ut-elementor-addons-lite' ),
                'type'         => Controls_Manager::SWITCHER,
                'default'      => 'no',
                'label_on'     => esc_html__( 'Yes', 'ut-elementor-addons-lite' ),
                'label_off'    => esc_html__( 'No', 'ut-elementor-addons-lite' ),
                'return_value' => 'yes',
            ]
        );

        $this->add_control(
            'ut_pricing_table_btn_title',
            [
                'label'       => esc_html__( 'Button Text', 'ut-elementor-addons-lite' ),
                'type'        => Controls_Manager::TEXT,
                'label_block' => true,
                'default'     => esc_html__( 'Choose Plan', 'ut-elementor-addons-lite' ),
                'condition'   => [
                    'ut_button_section' => 'yes',
                ],
            ]
        );

        $this->add_control(
            'ut_button_link',
            [
               'label'       => esc_html__( 'Link', 'ut-elementor-addons-lite' ),
               'type'        => Controls_Manager::URL,
               'label_block' => true,
               'default'     => [
                'url'         => '#',
                'is_external' => ''
            ],
            'show_external' => true,
            'condition'   => [
                'ut_button_section' => 'yes',
            ],
        ]
    );

        $this->end_controls_section();

        $this->start_controls_section(
            'ut_section_pricing_table_header_style',
            [
                'label' => esc_html__( 'Header', 'ut-elementor-addons-lite' ),
                'tab' => Controls_Manager::TAB_STYLE,
            ] 
        );

        $this->add_control(
            'ut_pricing_table_header_bg_color',
            [
                'label'     => esc_html__( 'Background Color', 'ut-elementor-addons-lite' ),
                'type'      => Controls_Manager::COLOR,
                'default'   => '#263238',
                'selectors' => [
                    '{{WRAPPER}} .pricing-table-title-description' => 'background: {{VALUE}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'ut_pricing_table_header_padding',
            [
                'label' => esc_html__( 'Padding', 'ut-elementor-addons-lite' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em' ],
                'selectors' => [
                    '{{WRAPPER}} .pricing-table-title-description' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'default'=>[
                    'unit' => 'px',
                    'size' => '25',
                ],
            ]
        );

        $this->add_control(
            'ut_pricing_table_title_heading',
            [
                'label' => esc_html__( 'Title', 'ut-elementor-addons-lite' ),
                'type' => Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        ); 

        $this->add_control(
            'ut_pricing_table_title_color',
            [
                'label'     => esc_html__( 'Color', 'ut-elementor-addons-lite' ),
                'type'      => Controls_Manager::COLOR,
                'default'   => '#FFFFFF',
                'selectors' => [
                    '{{WRAPPER}} .pricing-table-title h4' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'     => 'ut_pricing_table_title_typography',
                'selector' => '{{WRAPPER}} .pricing-table-title h4',
            ]
        );

        $this->add_control(
            'ut_pricing_table_sub_title_heading',
            [
                'label' => esc_html__( 'Sub Title', 'ut-elementor-addons-lite' ),
                'type' => Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        ); 


        $this->add_control(
            'ut_pricing_table_sub_title_color',
            [
                'label'     => esc_html__( 'Color', 'ut-elementor-addons-lite' ),
                'type'      => Controls_Manager::COLOR,
                'default'   => '#FFFFFF',
                'selectors' => [
                    '{{WRAPPER}} .pricing-table-description' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'     => 'ut_pricing_table_sub_title_typography',
                'selector' => '{{WRAPPER}} .pricing-table-description',
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'ut_section_pricing_wrapper_style',
            [
                'label' => esc_html__( 'Pricing', 'ut-elementor-addons-lite' ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'ut_pricing_table_price_box_separator',
            [
                'label'        => esc_html__( 'Enable Separator', 'ut-elementor-addons-lite' ),
                'type'         => Controls_Manager::SWITCHER,
                'label_on'     => esc_html__( 'ON', 'ut-elementor-addons-lite' ),
                'label_off'    => esc_html__( 'OFF', 'ut-elementor-addons-lite' ),
                'return_value' => 'yes',
                'default'      => 'yes'
            ]
        );

        $this->add_responsive_control(
            'ut_pricing_table_price_box_separator_height',
            [
                'label'     => esc_html__( 'Separator Height', 'ut-elementor-addons-lite' ),
                'type'      => Controls_Manager::NUMBER,
                'default'   => '1',
                'selectors' => [
                    '{{WRAPPER}} .ut-price-bottom-separator' => 'height: {{VALUE}}px;'
                ],
                'condition' => [
                    'ut_pricing_table_price_box_separator' => 'yes'
                ]

            ]
        );

        $this->add_control(
            'ut_pricing_table_price_box_separator_color',
            [
                'label'     => esc_html__( 'Separator Color', 'ut-elementor-addons-lite' ),
                'type'      => Controls_Manager::COLOR,
                'default'   => '#e5e5e5',
                'separator' => 'after',
                'selectors' => [
                    '{{WRAPPER}} .ut-price-bottom-separator'  => 'background-color: {{VALUE}};'
                ],
                'condition' => [
                    'ut_pricing_table_price_box_separator' => 'yes'
                ]
            ]
        );

        $this->add_control(
            'ut_pricing_table_pricing_bg_color',
            [
                'label'     => esc_html__( 'Background Color', 'ut-elementor-addons-lite' ),
                'type'      => Controls_Manager::COLOR,
                'default'   => '#f7f7f7',
                'selectors' => [
                    '{{WRAPPER}} .pricing-table-price-currency-month-wrapper' => 'background: {{VALUE}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'ut_pricing_padding',
            [
                'label' => esc_html__( 'Padding', 'ut-elementor-addons-lite' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em' ],
                'selectors' => [
                    '{{WRAPPER}} .pricing-table-price-currency-month-wrapper' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'default'=>[
                    'unit' => 'px',
                    'size' => '50',
                ],
            ]
        );

        $this->add_control(
            'ut_pricing_orginal_price_title_heading',
            [
                'label' => esc_html__( 'Orginal Price', 'ut-elementor-addons-lite' ),
                'type' => Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        ); 

        $this->add_control(
            'ut_pricing_orginal_price_title_color',
            [
                'label'     => esc_html__( 'Color', 'ut-elementor-addons-lite' ),
                'type'      => Controls_Manager::COLOR,
                'default'   => '#555555',
                'selectors' => [
                    '{{WRAPPER}} del.pricing-table-price' => 'color: {{VALUE}};', 
                    '{{WRAPPER}} .pricing-table-price.originalp' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'     => 'ut_original_price_typography',
                'selector' => '{{WRAPPER}} .pricing-table-price.originalp',
            ]
        );

        $this->add_control(
            'ut_pricing_orginal_price_currency_heading',
            [
                'label' => esc_html__( 'Orginal Price Currency', 'ut-elementor-addons-lite' ),
                'type' => Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );

        $this->add_control(
            'ut_pricing_orginal_price_currency_color',
            [
                'label'     => esc_html__( 'Color', 'ut-elementor-addons-lite' ),
                'type'      => Controls_Manager::COLOR,
                'default'   => '#555555',
                'selectors' => [
                    '{{WRAPPER}} del.pricing-table-curency' => 'color: {{VALUE}};', 
                    '{{WRAPPER}} .pricing-table-curency.originalc' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'     => 'ut_original_price_curency_typography',
                'selector' => '{{WRAPPER}} .pricing-table-curency.originalc ',
            ]
        );

        $this->add_control(
            'ut_pricing_sale_price_heading',
            [
                'label' => esc_html__( 'Sale Price', 'ut-elementor-addons-lite' ),
                'type' => Controls_Manager::HEADING,
                'separator' => 'before',
                'condition'   => [
                    'ut_pricing_table_onsale' => 'yes',
                ],
            ]
        );

        $this->add_control(
            'ut_pricing_sale_price_color',
            [
                'label'     => esc_html__( 'Color', 'ut-elementor-addons-lite' ),
                'type'      => Controls_Manager::COLOR,
                'default'   => '#555555',
                'selectors' => [
                    '{{WRAPPER}} .pricing-table-price' => 'color: {{VALUE}};',
                ],
                'condition'   => [
                    'ut_pricing_table_onsale' => 'yes',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'     => 'ut_sale_price_typography',
                'selector' => '{{WRAPPER}} .pricing-table-price',
                'condition'   => [
                    'ut_pricing_table_onsale' => 'yes',
                ],
            ]
        );

        $this->add_control(
            'ut_pricing_sale_price_currency_heading',
            [
                'label' => esc_html__( 'Sale Price Currency', 'ut-elementor-addons-lite' ),
                'type' => Controls_Manager::HEADING,
                'separator' => 'before',
                'condition'   => [
                    'ut_pricing_table_onsale' => 'yes',
                ],
            ]
        );

        $this->add_control(
            'ut_pricing_sale_price_currencys_color',
            [
                'label'     => esc_html__( 'Color', 'ut-elementor-addons-lite' ),
                'type'      => Controls_Manager::COLOR,
                'default'   => '#555555',
                'selectors' => [
                    '{{WRAPPER}} .pricing-table-curency' => 'color: {{VALUE}};',
                ],
                'condition'   => [
                    'ut_pricing_table_onsale' => 'yes',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'     => 'ut_sale_price_currency_typography',
                'selector' => '{{WRAPPER}} .pricing-table-curency',
                'condition'   => [
                    'ut_pricing_table_onsale' => 'yes',
                ],
            ]
        );

        $this->add_control(
            'ut_pricing_period',
            [
                'label' => esc_html__( 'Pricing Period', 'ut-elementor-addons-lite' ),
                'type' => Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );

        $this->add_control(
            'ut_pricing_period_color',
            [
                'label'     => esc_html__( 'Color', 'ut-elementor-addons-lite' ),
                'type'      => Controls_Manager::COLOR,
                'default'   => '#555555',
                'selectors' => [
                    '{{WRAPPER}} .pricing-table-period-separator' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .pricing-table-month' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'     => 'ut_pricing_period_typography',
                'selectors' => [
                    '{{WRAPPER}} .pricing-table-period-separator',
                    '{{WRAPPER}} .pricing-table-month',
                ],
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'ut_section_pricing_feature_list_wrapper_style',
            [
                'label' => esc_html__( 'Feature List', 'ut-elementor-addons-lite' ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'ut_pricing_table_list_border_bottom',
            [
                'label'        => esc_html__( 'List Border Bottom', 'ut-elementor-addons-lite' ),
                'type'         => Controls_Manager::SWITCHER,
                'label_on'     => esc_html__( 'Show', 'ut-elementor-addons-lite' ),
                'label_off'    => esc_html__( 'Hide', 'ut-elementor-addons-lite' ),
                'return_value' => 'yes',
                'default'      => 'yes'
            ]
        );

        $this->add_control(
            'ut_pricing_table_list_border_bottom_style',
            [
                'label'     => esc_html__( 'List Border Bottom Color', 'ut-elementor-addons-lite' ),
                'type'      => Controls_Manager::COLOR,
                'default'   => '#e5e5e5',
                'selectors' => [
                    '{{WRAPPER}} .pricing-table-list-wrapper .pricing-table-list' => 'border-bottom:1px solid {{VALUE}};'
                ],
                'condition' => [
                    'ut_pricing_table_list_border_bottom' => 'yes'
                ]
            ]
        );

        $this->add_control(
            'ut_pricing_table_feature_list_bg_color',
            [
                'label'     => esc_html__( 'Background Color', 'ut-elementor-addons-lite' ),
                'type'      => Controls_Manager::COLOR,
                'default'   => '#f7f7f7',
                'separator' => 'before',
                'selectors' => [
                    '{{WRAPPER}} .pricing-table-list-wrapper' => 'background: {{VALUE}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'ut_pricing_table_list_padding',
            [
                'label'      => esc_html__( 'Padding', 'ut-elementor-addons-lite' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em' ],
                'default'    => [
                    'top'      => '10',
                    'right'    => '0',
                    'bottom'   => '10',
                    'left'     => '0',
                    'isLinked' => false
                ],
                'selectors'  => [
                    '{{WRAPPER}} .pricing-table-list' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
                ]
            ]
        );

        $this->add_responsive_control(
            'ut_pricing_table_featured_list_icon_space',
            [
                'label'       => esc_html__( 'Icon Space', 'ut-elementor-addons-lite' ),
                'type'        => Controls_Manager::SLIDER,
                'default'     => [
                    'size'    => 7
                ],
                'range'       => [
                    'px'      => [
                        'max' => 24
                    ]
                ],
                'selectors'   => [
                    '{{WRAPPER}} .pricing-table-icon i' => 'margin-right: {{SIZE}}px;'
                ],
                'separator' => 'after'
            ]
        );

        $this->add_control(
            'ut_feature_list_title',
            [
                'label' => esc_html__( 'Title', 'ut-elementor-addons-lite' ),
                'type' => Controls_Manager::HEADING,
            ]
        );

        $this->add_control(
            'ut_pricing_table_feature_list_title_color',
            [
                'label'     => esc_html__( 'Color', 'ut-elementor-addons-lite' ),
                'type'      => Controls_Manager::COLOR,
                'default'   => '#3C3C3C',
                'selectors' => [
                    '{{WRAPPER}} .pricing-table-list-title h6' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'     => 'ut_pricing_table_feature_list_title_typography',
                'selector' => '{{WRAPPER}} .pricing-table-list-title h6',
            ]
        );

        $this->add_control(
            'ut_feature_list_icon',
            [
                'label' => esc_html__( 'Icon', 'ut-elementor-addons-lite' ),
                'type' => Controls_Manager::HEADING,
            ]
        );

        $this->add_control(
            'ut_pricing_table_feature_list_icon_color',
            [
                'label'     => esc_html__( 'Color', 'ut-elementor-addons-lite' ),
                'type'      => Controls_Manager::COLOR,
                'default'   => '#3C3C3C',
                'selectors' => [
                    '{{WRAPPER}} .pricing-table-icon i' => 'color: {{VALUE}};',
                ],
                'separator' => 'before',
            ]
        );

        $this->add_control(
            'ut_pricing_table_feature_list_icon_size',
            [
                'label'     => esc_html__( 'Size', 'ut-elementor-addons-lite' ),
                'type'      => Controls_Manager::SLIDER,
                'default'   => [
                    'size' => 15,
                    'unit' => 'px',
                ],
                'range'     => [
                    'px' => [ 
                        'max' => 50,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .pricing-table-icon i'   => 'font-size: {{SIZE}}{{UNIT}};',
                    '{{WRAPPER}} img.pricing-table-icons'   => 'height: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'ut_section_pricing_button_wrapper_style',
            [
                'label' => esc_html__( 'Button', 'ut-elementor-addons-lite' ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'ut_pricing_table_btn_bg_color',
            [
                'label'     => esc_html__( 'Background Color', 'ut-elementor-addons-lite' ),
                'type'      => Controls_Manager::COLOR,
                'default'   => '#f7f7f7',
                'selectors' => [
                    '{{WRAPPER}} .pricing-table-button' => 'background: {{VALUE}};',
                ],

            ]
        );

        $this->add_responsive_control(
            'ut_pricing_table_btn_margin',
            [
                'label' => esc_html__( 'Margin', 'ut-elementor-addons-lite' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em' ],
                'selectors' => [
                    '{{WRAPPER}} .pricing-table-button a.btn' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'default'=>[
                    'unit' => 'px',
                    'size' => '20',
                ],
            ]
        );

        $this->add_responsive_control(
            'ut_pricing_table_btn_padding',
            [
                'label' => esc_html__( 'Padding', 'ut-elementor-addons-lite' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em' ],
                'selectors' => [
                    '{{WRAPPER}} .pricing-table-button a.btn' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'default'=>[
                    'unit' => 'px',
                    'size' => '20',
                ],
            ]
        );

        $this->add_control(
            'ut_pricing_table_btn_border_radiusss',
            [
                'label'     => esc_html__( 'Border Radius', 'ut-elementor-addons-lite' ),
                'type'      => Controls_Manager::SLIDER,
                'range'     => [
                    'px' => [
                        'max' => 50,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .pricing-table-button a.btn' => 'border-radius: {{SIZE}}px;',
                ],
                'separator' => 'after',
            ]
        );

        $this->add_control(
            'ut_pricing_table_button_title',
            [
                'label' => esc_html__( 'Title', 'ut-elementor-addons-lite' ),
                'type' => Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'     => 'ut_pricing_table_button_typography',
                'selector' => '{{WRAPPER}} .pricing-table-button a.btn',
            ]
        );

        $this->start_controls_tabs('ut_button_tabs');

        $this->start_controls_tab('ut_pricing_table_btn_normal',
           [
            'label' => esc_html__( 'Normal', 'ut-elementor-addons-lite' ),
        ]
    );

        $this->add_control(
            'ut_pricing_table_btn_normal_text_color',
            [
                'label'     => esc_html__( 'Color', 'ut-elementor-addons-lite' ),
                'type'      => Controls_Manager::COLOR,
                'default'   => '#ffffff',
                'selectors' => [
                    '{{WRAPPER}} .pricing-table-button a.btn' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'ut_pricing_table_btn_normal_bg_color',
            [
                'label'     => esc_html__( 'Background Color', 'ut-elementor-addons-lite' ),
                'type'      => Controls_Manager::COLOR,
                'default'   => '#263238',
                'selectors' => [
                    '{{WRAPPER}} .pricing-table-button a.btn' => 'background: {{VALUE}};',
                ],
            ]
        );

        $this->end_controls_tab();

        $this->start_controls_tab('ut_pricing_table_btn_hover', 
            [
                'label' => esc_html__( 'Hover', 'ut-elementor-addons-lite' ),
            ]
        );

        $this->add_control(
            'ut_pricing_table_btn_hover_text_color',
            [
                'label'     => esc_html__( 'Color', 'ut-elementor-addons-lite' ),
                'type'      => Controls_Manager::COLOR,
                'default'   => '#f9f9f9',
                'selectors' => [
                    '{{WRAPPER}} .pricing-table-button a.btn:hover' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'ut_pricing_table_btn_hover_bg_color',
            [
                'label'     => esc_html__( 'Background Color', 'ut-elementor-addons-lite' ),
                'type'      => Controls_Manager::COLOR,
                'default'   => '#2c2c2c',
                'selectors' => [
                    '{{WRAPPER}} .pricing-table-button a.btn:hover' => 'background: {{VALUE}};',
                ],
            ]
        );

        $this->end_controls_tab();

        $this->end_controls_tabs();

        $this->end_controls_section();

    }

    protected function render() {
        $settings = $this->get_settings();
        $this->add_render_attribute( 'ut_button_link', 'class', 'btn' );
        if( $settings['ut_button_link']['url'] ) {
            $this->add_render_attribute( 'ut_button_link', 'href', esc_url( $settings['ut_button_link']['url'] ) );
            if( $settings['ut_button_link']['is_external'] ) {
                $this->add_render_attribute( 'ut_button_link', 'target', '_blank' );
            }
            if( $settings['ut_button_link']['nofollow'] ) {
                $this->add_render_attribute( 'ut_button_link', 'rel', 'nofollow' );
            }
        }
        $this->add_render_attribute('utal-pricing-table', 'class', 'utal-pricing-table'); 
        $ut_pricing_table_description = isset( $settings[ 'ut_pricing_table_description' ] )? $settings[ 'ut_pricing_table_description' ] : 'Enter your description';
        $ut_pricing_table_onsale = isset( $settings[ 'ut_pricing_table_onsale' ] )? $settings[ 'ut_pricing_table_onsale' ] : 'no';
        $ut_pricing_table_onsale_price = isset( $settings[ 'ut_pricing_table_onsale_price' ] )? $settings[ 'ut_pricing_table_onsale_price' ] : '70';
        $ut_pricing_table_price = isset( $settings[ 'ut_pricing_table_price' ] )? $settings[ 'ut_pricing_table_price' ] : '88';
        $ut_pricing_table_title = isset( $settings[ 'ut_pricing_table_title' ] )? $settings[ 'ut_pricing_table_title' ] : 'Enter your title';
        $ut_pricing_table_price_currency = isset( $settings[ 'ut_pricing_table_price_currency' ] )? $settings[ 'ut_pricing_table_price_currency' ] : '$';
        $ut_pricing_table_period_separator = isset( $settings[ 'ut_pricing_table_period_separator' ] )? $settings[ 'ut_pricing_table_period_separator' ] : '/';
        $ut_pricing_table_price_period = isset( $settings[ 'ut_pricing_table_price_period' ] )? $settings[ 'ut_pricing_table_price_period' ] : 'month';
        $ut_pricing_table_btn_title = isset( $settings[ 'ut_pricing_table_btn_title' ] )? $settings[ 'ut_pricing_table_btn_title' ] : 'Choose Plan';
        ?>

        <div class="pricing-table-main-wrapper">
            <div class="pricing-table-title-description">
                <?php if ( $ut_pricing_table_title ) { ?>
                    <div class="pricing-table-title">
                        <h4><?php echo esc_html( $ut_pricing_table_title ); ?></h4>
                    </div>
                <?php } ?>
                <?php if ( $ut_pricing_table_description ) { ?>
                    <div class="pricing-table-description">
                        <?php echo esc_html( $ut_pricing_table_description ); ?>
                    </div>
                <?php } ?>
            </div>

            <?php if ( 'yes' == $ut_pricing_table_onsale ) { ?>
                <div class="pricing-table-price-currency-month-wrapper">
                    <div class="pricing-table-curency-price-del">
                        <?php if ( $ut_pricing_table_price_currency ) { ?>
                            <del class="pricing-table-curency pricing-table-curency originalc">
                                <?php echo esc_html( $ut_pricing_table_price_currency ); ?>
                            </del>
                        <?php } ?>
                        <?php if ( $ut_pricing_table_price ) { ?>
                            <del class="pricing-table-price pricing-table-price originalp">
                                <?php echo esc_html( $ut_pricing_table_price ); ?>
                            </del>
                        <?php } ?>
                    </div>

                    <div class="pricing-table-curency-price">
                        <?php if ( $ut_pricing_table_price_currency ) { ?>
                            <div class="pricing-table-curency">
                                <?php echo esc_html( $ut_pricing_table_price_currency ); ?>
                            </div>
                        <?php } ?>

                        <?php if ( $ut_pricing_table_onsale_price ) { ?>
                            <div class="pricing-table-price">
                                <?php echo esc_html( $ut_pricing_table_onsale_price ); ?>
                            </div>
                        <?php } ?>
                    </div>

                    <div class="pricing-table-seperator-month">
                        <?php if ( $ut_pricing_table_period_separator ) { ?>
                            <div class="pricing-table-period-separator">
                                <?php echo esc_html( $ut_pricing_table_period_separator ); ?>
                            </div>
                        <?php } ?>

                        <?php if ( $ut_pricing_table_price_period ) { ?>
                            <div class="pricing-table-month">
                                <?php echo esc_html( $ut_pricing_table_price_period ); ?>
                            </div>
                        <?php } ?>
                    </div>

                </div>
            <?php } else { ?>
                <div class="pricing-table-price-currency-month-wrapper">
                    <div class="pricing-table-curency-price">
                        <?php if ( $ut_pricing_table_price_currency ) { ?>
                            <div class="pricing-table-curency originalc">
                                <?php echo esc_html( $ut_pricing_table_price_currency ); ?>
                            </div>
                        <?php } ?>

                        <?php if ( $ut_pricing_table_price ) { ?>
                            <div class="pricing-table-price originalp">
                                <?php echo esc_html( $ut_pricing_table_price ); ?>
                            </div>
                        <?php } ?>
                    </div>

                    <div class="pricing-table-seperator-month">
                        <?php if ( $ut_pricing_table_period_separator ) { ?>
                            <div class="pricing-table-period-separator">
                                <?php echo esc_html( $ut_pricing_table_period_separator ); ?>
                            </div>
                        <?php } ?>

                        <?php if ( $ut_pricing_table_price_period){ ?>
                            <div class="pricing-table-month">
                                <?php echo esc_html( $ut_pricing_table_price_period ); ?>
                            </div>
                        <?php } ?>
                    </div>
                </div>
            <?php } ?>

            <div class="ut-price-bottom-separator"></div>

            <?php
            if ( $settings['ut_feature_list'] ) {
                ?>
                <div class="pricing-table-list-wrapper">
                    <?php
                    foreach ( $settings['ut_feature_list'] as $slide ) { 
                        ?>
                        <div class="pricing-table-list">
                            <?php if ( $slide['ut_pricing_table_list_icon_new']['library'] == 'svg' ) { ?>
                                <div class="pricing-table-img">
                                    <img class="pricing-table-icons" src="<?php echo esc_attr( $slide['ut_pricing_table_list_icon_new']['value']['url'] ); ?>" alt="<?php echo esc_attr( get_post_meta($slide['ut_pricing_table_list_icon_new']['value']['id'], '_wp_attachment_image_alt', true) ); ?>" />
                                </div>
                            <?php } else { ?>
                                <div class="pricing-table-icon">
                                    <i class="<?php echo esc_attr( $slide['ut_pricing_table_list_icon_new']['value'] ); ?>"></i>
                                </div>
                            <?php } ?>
                            <?php if ( $slide['ut_pricing_table_item'] ) { ?>
                                <div class="pricing-table-list-title">
                                    <h6><?php echo esc_html( $slide['ut_pricing_table_item'] ); ?></h6>
                                </div>
                            <?php } ?>
                        </div>
                    <?php } ?>
                </div>
            <?php } ?>

            <?php if ( 'yes' == $settings['ut_button_section'] ) { ?>
                <div class="pricing-table-button">
                    <a <?php echo $this->get_render_attribute_string( 'ut_button_link' ); ?>><?php echo esc_html( $ut_pricing_table_btn_title ); ?></a>
                </div>
            <?php } ?>
        </div>

        <?php 
    }
}
Plugin::instance()->widgets_manager->register_widget_type( new UT_Elementor_Addons_Lite_Widget_Pricing() );



