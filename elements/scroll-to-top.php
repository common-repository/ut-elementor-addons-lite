<?php
namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) exit; 

class UT_Elementor_Addons_Lite_Widget_Scroll_To_Top extends Widget_Base
{
    use \Elementor\UT_Elementor_Addons_Lite_Queries;

    public function get_name()
    {
        return "utal-scroll-to-top";
    }

    public function get_title()
    {
        return esc_html__( "Scroll To Top", "ut-elementor-addons-lite" );
    }

    public function get_icon()
    {
        return "eicon-arrow-up ut-widget-icon";
    }

    public function get_categories()
    {
        return [ "ut-elementor-addons-lite" ];
    }  

    public function get_script_depends()
    {
        return [ "ut-elementor-addons-lite-script" ];
    }

    protected function register_controls() { 

      $this->start_controls_section(
        'ut_modal_content_section',
        [
            'label' => esc_html__( 'General', 'ut-elementor-addons-lite' )
        ]
    );

      $this->add_responsive_control(
        'ut_scroll_to_top_position_text',
        [
            'label' => esc_html__( 'Position', 'ut-elementor-addons-lite' ),
            'type' => Controls_Manager::SELECT,
            'default' => 'bottom-right',
            'label_block' => false,
            'options' => [
                'bottom-left' => esc_html__( 'Bottom Left', 'ut-elementor-addons-lite' ),
                'bottom-right' => esc_html__( 'Bottom Right', 'ut-elementor-addons-lite' ),
            ],
        ]
    );

      $this->add_responsive_control(
        'ut_scroll_to_top_position_bottom',
        [
            'label' => esc_html__( 'Bottom', 'ut-elementor-addons-lite' ),
            'type' => Controls_Manager::SLIDER,
            'size_units' => ['px', 'em', '%'],
            'range' => [
                'px' => [
                    'min' => 0,
                    'max' => 1000,
                    'step' => 1,
                ],
                'em' => [
                    'min' => 0,
                    'max' => 50,
                    'step' => 1,
                ],
                '%' => [
                    'min' => 0,
                    'max' => 100,
                    'step' => 1,
                ],
            ],
            'default' => [
                'unit' => 'px',
                'size' => 15,
            ],
            'selectors' => [
                '.scrollTop' => 'bottom: {{SIZE}}{{UNIT}}',
            ],
        ]
    );

      $this->add_responsive_control(
        'ut_scroll_to_top_position_left',
        [
            'label' => esc_html__( 'Left', 'ut-elementor-addons-lite' ),
            'type' => Controls_Manager::SLIDER,
            'size_units' => ['px', 'em', '%'],
            'range' => [
                'px' => [
                    'min' => 0,
                    'max' => 1000,
                    'step' => 1,
                ],
                'em' => [
                    'min' => 0,
                    'max' => 50,
                    'step' => 1,
                ],
                '%' => [
                    'min' => 0,
                    'max' => 100,
                    'step' => 1,
                ],
            ],
            'default' => [
                'unit' => 'px',
                'size' => 15,
            ],
            'selectors' => [
                '.scrollTop' => 'left: {{SIZE}}{{UNIT}}',
            ],
            'condition' => [
                'ut_scroll_to_top_position_text' => 'bottom-left',
            ],
        ]
    );

      $this->add_responsive_control(
        'ut_scroll_to_top_position_right',
        [
            'label' => esc_html__( 'Right', 'ut-elementor-addons-lite' ),
            'type' => Controls_Manager::SLIDER,
            'size_units' => ['px', 'em', '%'],
            'range' => [
                'px' => [
                    'min' => 0,
                    'max' => 1000,
                    'step' => 1,
                ],
                'em' => [
                    'min' => 0,
                    'max' => 50,
                    'step' => 1,
                ],
                '%' => [
                    'min' => 0,
                    'max' => 100,
                    'step' => 1,
                ],
            ],
            'default' => [
                'unit' => 'px',
                'size' => 15,
            ],
            'selectors' => [
                '.scrollTop' => 'right: {{SIZE}}{{UNIT}}',
            ],
            'condition' => [
                'ut_scroll_to_top_position_text' => 'bottom-right',
            ],
        ]
    );

      $this->add_responsive_control(
        'ut_scroll_to_top_button_width',
        [
            'label' => esc_html__( 'Width', 'ut-elementor-addons-lite' ),
            'type' => Controls_Manager::SLIDER,
            'size_units' => ['px'],
            'range' => [
                'px' => [
                    'min' => 0,
                    'max' => 1000,
                    'step' => 1,
                ],
            ],
            'default' => [
                'unit' => 'px',
                'size' => 50,
            ],
            'selectors' => [
                '.scrollTop' => 'width: {{SIZE}}{{UNIT}};',
            ],
        ]
    );

      $this->add_responsive_control(
        'ut_scroll_to_top_button_height',
        [
            'label' => esc_html__( 'Height', 'ut-elementor-addons-lite' ),
            'type' => Controls_Manager::SLIDER,
            'size_units' => ['px'],
            'range' => [
                'px' => [
                    'min' => 0,
                    'max' => 1000,
                    'step' => 1,
                ],
            ],
            'default' => [
                'unit' => 'px',
                'size' => 50,
            ],
            'selectors' => [
                '.scrollTop' => 'height: {{SIZE}}{{UNIT}};',
            ],
        ]
    );

      $this->add_responsive_control(
        'ut_scroll_to_top_z_index',
        [
            'label' => esc_html__( 'Z Index', 'ut-elementor-addons-lite' ),
            'type' => Controls_Manager::SLIDER,
            'size_units' => ['px'],
            'range' => [
                'px' => [
                    'min' => 0,
                    'max' => 9999,
                    'step' => 10,
                ],
            ],
            'default' => [
                'unit' => 'px',
                'size' => 9999,
            ],
            'selectors' => [
                '.scrollTop' => 'z-index: {{SIZE}}',
            ],
        ]
    );

      $this->add_responsive_control(
        'ut_scroll_to_top_button_icon',
        [
            'label' => esc_html__( 'Icon', 'ut-elementor-addons-lite' ),
            'type' => Controls_Manager::ICONS,
            'default' => [
                'value' => 'fas fa-chevron-up',
                'library' => 'fa-solid',
            ],
        ]
    );

      $this->add_responsive_control(
        'ut_scroll_to_top_button_icon_size',
        [
            'label' => esc_html__( 'Icon Size', 'ut-elementor-addons-lite' ),
            'type' => Controls_Manager::SLIDER,
            'default'    => [
                'size' => 16,
                'unit' => 'px',
            ],
            'size_units' => ['px'],
            'range'      => [
                'px' => [
                    'min'  => 0,
                    'max'  => 100,
                    'step' => 1,
                ],
            ],
            'selectors' => [
                '.scrollTop i' => 'font-size: {{SIZE}}{{UNIT}};',
                '.scrollTop svg path' => 'width: {{SIZE}}{{UNIT}}; height: {{SIZE}}{{UNIT}};',
            ],
        ]
    );

      $this->add_responsive_control(
        'ut_scroll_to_top_button_icon_color',
        [
            'label' => esc_html__( 'Icon Color', 'ut-elementor-addons-lite' ),
            'type' => Controls_Manager::COLOR,
            'default' => '#ffffff',
            'selectors' => [
                '.scrollTop i' => 'color: {{VALUE}}',
                '.scrollTop svg path' => 'fill: {{VALUE}}',
            ],
        ]
    );

      $this->add_responsive_control(
        'ut_scroll_to_top_button_bg_color',
        [
            'label' => esc_html__( 'Background Color', 'ut-elementor-addons-lite' ),
            'type' => Controls_Manager::COLOR,
            'default' => '#000000',
            'selectors' => [
                '.scrollTop' => 'background-color: {{VALUE}}',
            ],
        ]
    );

      $this->add_responsive_control(
        'ut_scroll_to_top_button_border_radius',
        [
            'label' => esc_html__( 'Border Radius', 'ut-elementor-addons-lite' ),
            'type' => Controls_Manager::SLIDER,
            'size_units' => ['px'],
            'range' => [
                'px' => [
                    'min' => 0,
                    'max' => 50,
                    'step' => 1,
                ],
            ],
            'default' => [
                'unit' => 'px',
                'size' => 5,
            ],
            'selectors' => [
                '.scrollTop' => 'border-radius: {{SIZE}}{{UNIT}}',
            ],
        ]
    );

      $this->end_controls_section();

  }

  protected function render() {
    $settings = $this->get_settings();
    $ut_scroll_to_top_button_icon = isset( $settings[ 'ut_scroll_to_top_button_icon' ] )? $settings[ 'ut_scroll_to_top_button_icon' ] : ''; 
    ?> 

    <div class="scrollTop">
        <span>
            <a href="javascript:void(0);">
                <?php Icons_Manager::render_icon( $ut_scroll_to_top_button_icon, [ 'aria-hidden' => 'true' ] ); ?>
            </a>
        </span>
    </div>

    <?php
}
}
Plugin::instance()->widgets_manager->register_widget_type(
    new UT_Elementor_Addons_Lite_Widget_Scroll_To_Top()
);
