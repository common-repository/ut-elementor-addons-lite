<?php

namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) exit; 

class UT_Elementor_Addons_Lite_Products extends Widget_Base {
    use \Elementor\UT_Elementor_Addons_Lite_Queries;

    public function get_name() {
     return 'utal-products';
 }

 public function get_title() {
     return esc_html__( 'Woo Products', 'ut-elementor-addons-lite' );
 }

 public function get_icon() {
     return 'eicon-products ut-widget-icon';
 }

 public function get_categories() {
     return array( 'ut-elementor-addons-lite' );
 }

 protected function register_controls() {

   $this->start_controls_section(
      'ut_section_detail',
      [
       'label' => esc_html__( 'General', 'ut-elementor-addons-lite' ),
   ]
);

   $this->add_control(
    'ut_post_column',
    [
        'label'       => esc_html__( 'No. of Columns:', 'ut-elementor-addons-lite' ),
        'type'        => Controls_Manager::SELECT,
        'label_block' => true,
        'default'     => 'column3',
        'options'     => [
            'column1' => '1',
            'column2' => '2',
            'column3' => '3',
            'column4' => '4',
        ],
    ]
);

   $this->add_control(
    'ut_categories',
    [
        'label'             => esc_html__( 'Product Categories', 'ut-elementor-addons-lite' ),
        'type'              => Controls_Manager::SELECT2,
        'label_block'       => true,
        'multiple'          => true,
        'options'           => ut_elementor_addons_lite_get_product_categories(),
    ]
);

   $this->add_control(
    'ut_showposts',
    [
        'label' => esc_html__( 'No. of Products', 'ut-elementor-addons-lite' ),
        'type'  => Controls_Manager::NUMBER,
        'min' => -1,
        'max' => 100,
        'step' => 1,
        'default' => 4,
    ]
);

   $this->end_controls_section();

   $this->start_controls_section(
    'ut_section_general_style',
    [
        'label' => esc_html__( 'General Styles', 'ut-elementor-addons-lite' ),
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
            '{{WRAPPER}} .product img' => 'margin-bottom: {{SIZE}}{{UNIT}};',
        ],
    ]
);

   $this->start_controls_tabs(
    'ut_price_tabs'
);

   $this->start_controls_tab(
    'ut_price_tab1',
    [
        'label' => esc_html__( 'Normal', 'ut-elementor-addons-lite' ),
    ]
);

   $this->add_control(
    'ut_product_title_color',
    [
        'label'     => esc_html__( 'Title Color', 'ut-elementor-addons-lite' ),
        'type'      => Controls_Manager::COLOR,
        'selectors' => [
            '{{WRAPPER}} .utal-products li.product h2.woocommerce-loop-product__title' => 'color: {{VALUE}};',
        ],
    ]
);

   $this->add_control(
    'ut_price_color',
    [
        'label'     => esc_html__( 'Price Color', 'ut-elementor-addons-lite' ),
        'type'      => Controls_Manager::COLOR,
        'selectors' => [
            '{{WRAPPER}} .price' => 'color: {{VALUE}};',
        ],
        'separator' => 'after',
    ]
);

   $this->end_controls_tab();

   $this->start_controls_tab(
    'ut_price_tab2',
    [
        'label' => esc_html__( 'Hover', 'ut-elementor-addons-lite' ),
    ]
);

   $this->add_control(
    'ut_product_title_color_hover',
    [
        'label'     => esc_html__( 'Title Color', 'ut-elementor-addons-lite' ),
        'type'      => Controls_Manager::COLOR,
        'selectors' => [
            '{{WRAPPER}} .utal-products li.product h2.woocommerce-loop-product__title:hover' => 'color: {{VALUE}};',
        ],
    ]
);

   $this->add_control(
    'ut_price_color_hover',
    [
        'label'     => esc_html__( 'Price Color', 'ut-elementor-addons-lite' ),
        'type'      => Controls_Manager::COLOR,
        'selectors' => [
            '{{WRAPPER}} .price:hover' => 'color: {{VALUE}};',
        ],
        'separator' => 'after',
    ]
);

   $this->end_controls_tab();

   $this->end_controls_tabs();

   $this->add_group_control(
    Group_Control_Typography::get_type(),
    [
        'name'      => 'ut_product_title_typography',
        'label'     => esc_html__( 'Title Typography', 'ut-elementor-addons-lite' ),
        'scheme'    => Core\Schemes\Typography::TYPOGRAPHY_4,
        'selector' => '{{WRAPPER}} h2.woocommerce-loop-product__title',
    ]
);

   $this->add_group_control(
    Group_Control_Typography::get_type(),
    [
        'name'      => 'ut_product_price_typography',
        'label'     => esc_html__( 'Price Typography', 'ut-elementor-addons-lite' ),
        'scheme'    => Core\Schemes\Typography::TYPOGRAPHY_4,
        'selector' => '{{WRAPPER}} .price',
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
    'ut_column_gap',
    [
        'label' => esc_html__( 'Columns Gap', 'ut-elementor-addons-lite' ),
        'type' => Controls_Manager::SLIDER,
        'desktop_default' => [
            'size' => 10,
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
            '{{WRAPPER}} .utal-product-wrapper' => 'margin-left: -{{SIZE}}{{UNIT}}; margin-right: -{{SIZE}}{{UNIT}}',
            '{{WRAPPER}} .utal-products ul.utal-product-wrapper li.product' => 'padding-left: {{SIZE}}{{UNIT}}; padding-right: {{SIZE}}{{UNIT}};',
        ],
    ]
);

   $this->add_responsive_control(
    'ut_row_gap',
    [
        'label' => esc_html__( 'Rows Gap', 'ut-elementor-addons-lite' ),
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
            '{{WRAPPER}} ul.utal-product-wrapper li.product' => 'margin-bottom: {{SIZE}}{{UNIT}};',
        ],
    ]
);

   $this->end_controls_section();

   $this->start_controls_section(
    'ut_product_button_styles',
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
    'ut_button_color',
    [
        'label'     => esc_html__( 'Button Text Color', 'ut-elementor-addons-lite' ),
        'type'      => Controls_Manager::COLOR,
        'selectors' => [
            '{{WRAPPER}} a.product_type_grouped,
            {{WRAPPER}} a.add_to_cart_button,
            {{WRAPPER}} a.added_to_cart.wc-forward,
            {{WRAPPER}} a.product_type_simple,
            {{WRAPPER}} a.product_type_external' => 'color: {{VALUE}};',
        ],
    ]
);

   $this->add_control(
    'ut_button_bg_color',
    [
        'label'     => esc_html__( 'Button Background Color', 'ut-elementor-addons-lite' ),
        'type'      => Controls_Manager::COLOR,
        'selectors' => [
            '{{WRAPPER}} a.product_type_grouped,
            {{WRAPPER}} a.add_to_cart_button,
            {{WRAPPER}} a.added_to_cart.wc-forward,
            {{WRAPPER}} a.product_type_simple,
            {{WRAPPER}} a.product_type_external' => 'background-color: {{VALUE}};',
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
        'default' => '',
        'selectors' => [
            '{{WRAPPER}} a.product_type_grouped,
            {{WRAPPER}} a.add_to_cart_button,
            {{WRAPPER}} a.added_to_cart.wc-forward,
            {{WRAPPER}} a.product_type_simple,
            {{WRAPPER}} a.product_type_external' => 'border-style: {{VALUE}}',
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
            '{{WRAPPER}} a.product_type_grouped,
            {{WRAPPER}} a.add_to_cart_button, 
            {{WRAPPER}} a.added_to_cart.wc-forward,
            {{WRAPPER}} a.product_type_simple,
            {{WRAPPER}} a.product_type_external' => 'border-width: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
        ],
    ]
);

   $this->add_control(
    'ut_button_border_color',
    [
        'label'     => esc_html__( 'Button Border Color', 'ut-elementor-addons-lite' ),
        'type'      => Controls_Manager::COLOR,
        'selectors' => [
            '{{WRAPPER}} a.product_type_grouped,
            {{WRAPPER}} a.add_to_cart_button,
            {{WRAPPER}} a.added_to_cart.wc-forward, 
            {{WRAPPER}} a.product_type_simple,
            {{WRAPPER}} a.product_type_external' => 'border-color: {{VALUE}};',
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
            '{{WRAPPER}} a.product_type_grouped,
            {{WRAPPER}} a.add_to_cart_button,
            {{WRAPPER}} a.added_to_cart.wc-forward,
            {{WRAPPER}} a.product_type_simple,
            {{WRAPPER}} a.product_type_external' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
        ],
    ]
);

   $this->add_group_control(
    Group_Control_Box_Shadow::get_type(),
    [
        'name' => 'ut_button_box_shadow',
        'label' => esc_html__( 'Box Shadow', 'ut-elementor-addons-lite' ),
        'selector' => '{{WRAPPER}} a.product_type_grouped, 
        {{WRAPPER}} a.product_type_simple,
        {{WRAPPER}} a.add_to_cart_button, 
        {{WRAPPER}} a.product_type_external',
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
    'ut_button_color_hover',
    [
        'label'     => esc_html__( 'Button Text Color: Hover', 'ut-elementor-addons-lite' ),
        'type'      => Controls_Manager::COLOR,
        'selectors' => [
            '{{WRAPPER}} a.product_type_grouped:hover,
            {{WRAPPER}} a.added_to_cart.wc-forward:hover,
            {{WRAPPER}} a.product_type_simple:hover, 
            {{WRAPPER}} a.add_to_cart_button:hover,
            {{WRAPPER}} a.product_type_external:hover' => 'color: {{VALUE}};border-color: {{VALUE}};',
        ],
    ]
);

   $this->add_control(
    'ut_button_bg_color_hover',
    [
        'label'     => esc_html__( 'Button Background Color: Hover', 'ut-elementor-addons-lite' ),
        'type'      => Controls_Manager::COLOR,
        'selectors' => [
            '{{WRAPPER}} a.product_type_grouped:hover,
            {{WRAPPER}} a.added_to_cart.wc-forward:hover,
            {{WRAPPER}} a.add_to_cart_button:hover, 
            {{WRAPPER}} a.product_type_simple:hover, 
            {{WRAPPER}} a.product_type_external:hover' => 'background-color: {{VALUE}};',
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
        'default' => '',
        'selectors' => [
            '{{WRAPPER}} a.product_type_grouped:hover,
            {{WRAPPER}} a.added_to_cart.wc-forward:hover,
            {{WRAPPER}} a.product_type_simple:hover, 
            {{WRAPPER}} a.add_to_cart_button:hover, 
            {{WRAPPER}} a.product_type_external:hover' => 'border-style: {{VALUE}}',
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
            '{{WRAPPER}} a.product_type_grouped:hover,
            {{WRAPPER}} a.added_to_cart.wc-forward:hover,
            {{WRAPPER}} a.product_type_simple:hover, 
            {{WRAPPER}} a.add_to_cart_button:hover,
            {{WRAPPER}} a.product_type_external:hover' => 'border-width: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
        ],
    ]
);

   $this->add_control(
    'ut_button_border_color_hover',
    [
        'label'     => esc_html__( 'Button Border Color', 'ut-elementor-addons-lite' ),
        'type'      => Controls_Manager::COLOR,
        'selectors' => [
            '{{WRAPPER}} a.product_type_grouped:hover,
            {{WRAPPER}} a.added_to_cart.wc-forward:hover,
            {{WRAPPER}} a.product_type_simple:hover, 
            {{WRAPPER}} a.add_to_cart_button:hover, 
            {{WRAPPER}} a.product_type_external:hover' => 'border-color: {{VALUE}};',
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
            '{{WRAPPER}} a.product_type_grouped:hover,
            {{WRAPPER}} a.added_to_cart.wc-forward:hover,
            {{WRAPPER}} a.product_type_simple:hover, 
            {{WRAPPER}} a.add_to_cart_button:hover,
            {{WRAPPER}} a.product_type_external:hover' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
        ],
    ]
);

   $this->add_group_control(
    Group_Control_Box_Shadow::get_type(),
    [
        'name' => 'ut_button_box_shadow_hover',
        'label' => esc_html__( 'Box Shadow', 'ut-elementor-addons-lite' ),
        'selector' => '{{WRAPPER}} a.product_type_grouped:hover, 
        {{WRAPPER}} a.product_type_simple:hover, 
        {{WRAPPER}} a.added_to_cart.wc-forward:hover,
        {{WRAPPER}} a.add_to_cart_button:hover, 
        {{WRAPPER}} a.product_type_external:hover',
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
        'name'      => 'ut_button_typography',
        'label'     => esc_html__( 'Button Typography', 'ut-elementor-addons-lite' ),
        'scheme'    => Core\Schemes\Typography::TYPOGRAPHY_4,
        'selector' => '{{WRAPPER}} a.product_type_grouped,
        {{WRAPPER}} a.product_type_simple, 
        {{WRAPPER}} a.added_to_cart.wc-forward,
        {{WRAPPER}} a.add_to_cart_button, 
        {{WRAPPER}} a.product_type_external',
    ]
);

   $this->add_responsive_control(
    'ut_button_margin',
    [
        'label' => esc_html__( 'Margin', 'ut-elementor-addons-lite' ),
        'type' => Controls_Manager::DIMENSIONS,
        'size_units' => [ 'px', '%', 'em' ],
        'selectors' => [
            '{{WRAPPER}} a.product_type_grouped, 
            {{WRAPPER}} a.add_to_cart_button,
            {{WRAPPER}} a.added_to_cart.wc-forward, 
            {{WRAPPER}} a.product_type_simple, 
            {{WRAPPER}} a.product_type_external' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
            '{{WRAPPER}} a.product_type_grouped, 
            {{WRAPPER}} a.add_to_cart_button, 
            {{WRAPPER}} a.added_to_cart.wc-forward,
            {{WRAPPER}} a.product_type_simple, 
            {{WRAPPER}} a.product_type_external' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
        ],
    ]
);

   $this->end_controls_section();
}

protected function render() {
    $settings = $this->get_settings();
    $this->add_render_attribute( 'utal-products', 'class', 'utal-products' );
    $ut_showposts = isset( $settings[ 'ut_showposts' ] ) ? $settings[ 'ut_showposts' ] : '3';
    $ut_column = isset( $settings[ 'ut_post_column' ] ) ? $settings[ 'ut_post_column' ] : 'column3';
    $ut_post_column_tablet = isset( $settings[ 'ut_post_column_tablet' ] ) ? $settings[ 'ut_post_column_tablet' ] : '2';
    $ut_post_column_mobile = isset( $settings[ 'ut_post_column_mobile' ] ) ? $settings[ 'ut_post_column_mobile' ] : '1';
    $cats = isset( $settings[ 'ut_categories' ] ) ? $settings[ 'ut_categories' ] : array();

    $class = '';
    if ( ! empty( $ut_column ) ) {
        $class .= $ut_column;
    }
    if ( ! empty( $ut_post_column_tablet ) ) {
        $class .= ' tablet-' . $ut_post_column_tablet;
    }
    if ( ! empty( $ut_post_column_mobile ) ) {
        $class .= ' mobile-' . $ut_post_column_mobile;
    }

    $this->add_render_attribute( 'utal-products', 'class', 'utal' );
    $block_args = array( 
        'post_type' => 'product',
        'posts_per_page' => $ut_showposts,
    );
    if ( ! empty( $cats ) ) {
        $block_args['tax_query']  = array(
            array(
                'taxonomy'  => 'product_cat',
                'field'     => 'id', 
                'terms'     => $cats
            )
        );
    }
    $query = new \WP_Query( $block_args );
    ?>
    <div <?php echo $this->get_render_attribute_string( 'utal-products' ); ?>>
        <ul class="utal-product-wrapper <?php echo esc_attr( $ut_column );?>">
            <?php 
            if( $query->have_posts() ):
                while($query->have_posts()):
                    $query->the_post(); 
                    wc_get_template_part( 'content', 'product' ); 
                endwhile;
                wp_reset_postdata();
            endif;
            ?>
        </ul>
    </div>

    <?php
}
}
Plugin::instance()->widgets_manager->register_widget_type( new UT_Elementor_Addons_Lite_Products() );