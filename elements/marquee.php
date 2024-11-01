<?php
namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) exit; 

class UT_Elementor_Addons_Lite_Widget_Marquee extends Widget_Base
{
    use \Elementor\UT_Elementor_Addons_Lite_Queries;

    public function get_name()
    {
        return "utal-marquee";
    }

    public function get_title()
    {
        return esc_html__( "Marquee Text", "ut-elementor-addons-lite" );
    }

    public function get_icon()
    {
        return "eicon-ellipsis-h ut-widget-icon";
    }

    public function get_categories()
    { 
        return [ "ut-elementor-addons-lite" ];
    }

    protected function register_controls()
    {

        $this->start_controls_section(
            'section_detail',
            [
                'label' => esc_html__( 'General', 'ut-elementor-addons-lite' ),
            ]
        );

        $this->add_control(
            'ut_text_box',
            [
                'label' => esc_html__( 'Text Box', 'ut-elementor-addons-lite' ),
                'type' => Controls_Manager::TEXTAREA,
                'default' => esc_html__( 'Ultra Addons Lite for Elementor provides Elementor addons. Enhance your Elementor page building experience with creative elements and extensions.', 'ut-elementor-addons-lite' ),
                'label_block' => true,
            ]
        );

        $this->add_control(
            'ut_marquee_duration', 
            [
                'label' => esc_html__( 'Marquee Duration (Seconds)', 'ut-elementor-addons-lite' ),
                'type' => Controls_Manager::NUMBER,
                'default' => 20,
                'min' => 5,
                'step' => 1,
                'selectors' => array(
                    '{{WRAPPER}} .track' => 'animation-duration: {{VALUE}}s;',
                ),
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'ut_section_marquee_wrapper_style',
            [
                'label' => esc_html__( 'General', 'ut-elementor-addons-lite' ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'     => 'ut_marquee_title_typography',
                'selector' => '{{WRAPPER}} .content h2',
            ]
        );

        $this->add_control(
            'ut_marquee_title_color',
            [
                'label'     => esc_html__( 'Title Color', 'ut-elementor-addons-lite' ),
                'type'      => Controls_Manager::COLOR,
                'default'   => '#000000',
                'selectors' => [
                    '{{WRAPPER}} .content h2' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name'     => 'ut_marquee_background_gradient',
                'types'    => [ 'classic', 'gradient' ],
                'selector' => '{{WRAPPER}} .content h2'
            ]
        );

        $this->add_control(
            'ut_marquee_height',
            [
                'label'     => esc_html__( 'Height', 'ut-elementor-addons-lite' ),
                'type'      => Controls_Manager::SLIDER,
                'default'=>[
                    'unit' => 'px',
                    'size' => '',
                ],
                'range'     => [
                    'px' => [ 
                        'max' => 500,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .marquee'   => 'height: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'ut_marquee_title_margin',
            [
                'label' => esc_html__( 'Margin', 'ut-elementor-addons-lite' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em' ],
                'selectors' => [
                    '{{WRAPPER}} .marquee' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'default'=>[
                    'unit' => 'px',
                    'size' => '20',
                ],
            ]
        );

        $this->add_responsive_control(
            'ut_marquee_title_padding',
            [
                'label' => esc_html__( 'Padding', 'ut-elementor-addons-lite' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em' ],
                'selectors' => [
                    '{{WRAPPER}} .content h2' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'default'=>[
                    'unit' => 'px',
                    'size' => '50',
                ],
            ]
        );

        $this->end_controls_section();

    }

    protected function render()
    {
        $settings = $this->get_settings(); 
        $ut_text_box = isset( $settings[ 'ut_text_box' ] ) ? $settings[ 'ut_text_box' ] : 'Ultra Addons Lite for Elementor provides Elementor addons. Enhance your Elementor page building experience with creative elements and extensions.';
        ?> 

        <?php if( $ut_text_box ) { ?>
            <div class="marquee">
                <div class="track">
                    <div class="content">
                        <h2><?php echo esc_html( $ut_text_box ); ?></h2>
                    </div>
                </div>
            </div>
        <?php } ?>

        <?php
    }
}
Plugin::instance()->widgets_manager->register_widget_type(
    new UT_Elementor_Addons_Lite_Widget_Marquee()
);
