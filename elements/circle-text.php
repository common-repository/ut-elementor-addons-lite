<?php
namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) exit; 

class UT_Elementor_Addons_Lite_Widget_CircleText extends Widget_Base
{
    use \Elementor\UT_Elementor_Addons_Lite_Queries;

    public function get_name()
    {
        return "utal-circletext";
    }

    public function get_title() 
    {
        return esc_html__( "Text Rotator", "ut-elementor-addons-lite" );
    }

    public function get_icon()
    {
        return "eicon-loading ut-widget-icon";
    }

    public function get_categories()
    {
        return [ "ut-elementor-addons-lite" ];
    }

    public function get_script_depends()
    {
        return [
            'circletype',
            'ut-elementor-addons-lite-script',
        ];
    }

    protected function register_controls()
    {

        $this->start_controls_section(
            'ut_section_detail',
            [
                'label' => esc_html__( 'General', 'ut-elementor-addons-lite' ),
            ]
        );

        $this->add_control(
            'ut_text',
            [
                'label' => esc_html__( 'Text', 'ut-elementor-addons-lite' ),
                'type' => Controls_Manager::TEXTAREA,
                'default' => esc_html__( 'MEET THE TRENDS OF THE SEASON', 'ut-elementor-addons-lite' ),
                'label_block' => true,
            ]
        );
        
        $this->add_control(
            'ut_text_rotate_duration', 
            [
                'label' => esc_html__( 'Text Rotate Duration (Seconds)', 'ut-elementor-addons-lite' ),
                'type' => Controls_Manager::NUMBER,
                'default' => 10,
                'min' => 1,
                'step' => 1,
                'selectors' => array(
                    '{{WRAPPER}} .circular-text' => 'animation-duration: {{VALUE}}s;',
                ),
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'ut_section_text_rotator_wrapper_style',
            [
                'label' => esc_html__( 'General', 'ut-elementor-addons-lite' ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'     => 'ut_text_rotator_title_typography',
                'selector' => '{{WRAPPER}} .circle',
            ]
        );

        $this->add_control(
            'ut_text_rotator_title_color',
            [
                'label'     => esc_html__( 'Title Color', 'ut-elementor-addons-lite' ),
                'type'      => Controls_Manager::COLOR,
                'default'   => '#000303',
                'selectors' => [
                    '{{WRAPPER}} .circle' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'ut_text_rotator_margin',
            [
                'label' => esc_html__( 'Margin', 'ut-elementor-addons-lite' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em' ],
                'selectors' => [
                    '{{WRAPPER}} .circular-text' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'default'=>[
                    'unit' => 'px',
                    'size' => '0',
                ],
            ]
        );

        $this->end_controls_section();

    }

    protected function render()
    {
        $settings = $this->get_settings(); 
        $ut_text = isset( $settings[ 'ut_text' ] )? $settings[ 'ut_text' ] : 'MEET THE TRENDS OF THE SEASON';
        ?> 

        <?php if ( $ut_text ) { ?>
            <div class="circular-text">
               <?php $id = esc_attr( rand( 11111,99999 ) ); ?>
               <div id="showreel_<?php echo esc_attr( $id );?>"  class="circle ut_circle">
                <?php echo esc_html( $ut_text ); ?>
            </div>
        </div>
    <?php } ?>

    <?php
}
}

Plugin::instance()->widgets_manager->register_widget_type(
    new UT_Elementor_Addons_Lite_Widget_CircleText()
);
