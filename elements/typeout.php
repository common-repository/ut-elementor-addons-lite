<?php
namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) exit; 

class UT_Elementor_Addons_Lite_Widget_Typed extends Widget_Base
{

    public function get_name()
    {
        return "utal-typeout";
    }

    public function get_title()
    {
        return esc_html__( "Type Out", "ut-elementor-addons-lite" );
    }

    public function get_icon()
    {
        return "eicon-animation-text ut-widget-icon";
    }

    public function get_categories()
    {
        return [ "ut-elementor-addons-lite" ];
    }  

    public function get_script_depends()
    {
        return [
            'typed',
            'ut-elementor-addons-lite-script',
        ];
    }

    protected function register_controls() { 

        $this->start_controls_section(
            'ut_type_out_section',
            [
                'label' => esc_html__( 'General', 'ut-elementor-addons-lite' )
            ]
        );

        $this->add_control(
            'ut_type_out_before_text',
            [
                'label'   => esc_html__( 'Before Text', 'ut-elementor-addons-lite' ),
                'type'    => Controls_Manager::TEXTAREA,
                'default' => esc_html__( 'This is', 'ut-elementor-addons-lite' ),
            ]
        );

        $this->add_control(
            'ut_type_out_animated_heading',
            [
                'label'       => esc_html__( 'Animated Text', 'ut-elementor-addons-lite' ),
                'type'        => Controls_Manager::TEXTAREA,
                'placeholder' => esc_html__( 'Enter your animated text with comma separated.', 'ut-elementor-addons-lite' ),
                'description' => esc_html__( 'Write animated heading with comma separated. Example: Ultra, Addons, Lite', 'ut-elementor-addons-lite' ),
                'default'     => esc_html__( 'Ultra, Addons, Lite', 'ut-elementor-addons-lite' ),
            ]
        );

        $this->add_control(
            'ut_type_out_text_after_text',
            [
                'label'   => esc_html__( 'After Text', 'ut-elementor-addons-lite' ),
                'type'    => Controls_Manager::TEXTAREA,
                'default' => esc_html__( 'For You.', 'ut-elementor-addons-lite' ),
            ]
        );

        $this->add_control(
            'ut_type_out_title_heading',
            [
                'label' => esc_html__( 'Settings', 'ut-elementor-addons-lite' ),
                'type' => Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );

        $this->add_control(
            'ut_type_out_speed',
            [
                'label' => esc_html__( 'Type Speed', 'ut-elementor-addons-lite' ),
                'type' => Controls_Manager::NUMBER,
                'default' => 60,
                'min'     => 10,
                'max'     => 200,
                'step'    => 10,
            ]
        );

        $this->add_control(
            'ut_type_out_start_delay',
            [
                'label'     => esc_html__( 'Start Delay', 'ut-elementor-addons-lite' ),
                'type'      => Controls_Manager::NUMBER,
                'default'   => 1000,
                'min'       => 1000,
                'max'       => 10000,
            ]
        );

        $this->add_control(
            'ut_type_out_delay_speed',
            [
                'label' => esc_html__('Back Type Speed', 'ut-elementor-addons-lite'),
                'type' => Controls_Manager::NUMBER,
                'default'   => 60,
                'min'       => 10,
                'max'       => 200,
                'step'      => 10,
            ]
        );

        $this->add_control(
            'ut_type_out_back_delay',
            [
                'label'     => esc_html__( 'Back Delay', 'ut-elementor-addons-lite' ),
                'type'      => Controls_Manager::NUMBER,
                'default'   => 1000,
                'min'       => 1000,
                'max'       => 10000,
            ]
        );

        $this->add_control(
            'ut_type_out_text_loop',
            [
                'label'        => esc_html__( 'Loop', 'ut-elementor-addons-lite' ),
                'type'         => Controls_Manager::SWITCHER,
                'label_on'     => esc_html__( 'ON', 'ut-elementor-addons-lite' ),
                'label_off'    => esc_html__( 'OFF', 'ut-elementor-addons-lite' ),
                'return_value' => 'true',
                'default'      => 'true', 
            ]
        );

        $this->add_control(
            'ut_type_out_text_show_cursor',
            [
                'label'        => esc_html__( 'Show Cursor', 'ut-elementor-addons-lite' ),
                'type'         => Controls_Manager::SWITCHER,
                'label_on' => esc_html__('On', 'ut-elementor-addons-lite'),
                'label_off' => esc_html__('Off', 'ut-elementor-addons-lite'),
                'return_value' => 'true',
                'default'      => 'true', 
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'ut_type_out_section_style',
            [
                'label' => esc_html__( 'General', 'ut-elementor-addons-lite' ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );
        
        $this->add_control(
            'ut_type_out_heading_tag',
            [
                'label'   => esc_html__( 'HTML Tag', 'ut-elementor-addons-lite' ),
                'type'    => Controls_Manager::CHOOSE,
                'default' => 'h3',
                'toggle'  => false,
                'options' => [
                    'h1'  => [
                        'title' => esc_html__( 'H1', 'ut-elementor-addons-lite' ),
                        'icon'  => 'eicon-editor-h1'
                    ],
                    'h2'  => [
                        'title' => esc_html__( 'H2', 'ut-elementor-addons-lite' ),
                        'icon'  => 'eicon-editor-h2'
                    ],
                    'h3'  => [
                        'title' => esc_html__( 'H3', 'ut-elementor-addons-lite' ),
                        'icon'  => 'eicon-editor-h3'
                    ],
                    'h4'  => [
                        'title' => esc_html__( 'H4', 'ut-elementor-addons-lite' ),
                        'icon'  => 'eicon-editor-h4'
                    ],
                    'h5'  => [
                        'title' => esc_html__( 'H5', 'ut-elementor-addons-lite' ),
                        'icon'  => 'eicon-editor-h5'
                    ],
                    'h6'  => [
                        'title' => esc_html__( 'H6', 'ut-elementor-addons-lite' ),
                        'icon'  => 'eicon-editor-h6'
                    ]
                ]
            ]
        );

        $this->add_control(
            'ut_type_out_alignment', 
            [
                'label' => esc_html__('Alignment', 'ut-elementor-addons-lite'),
                'type' => Controls_Manager::CHOOSE,
                'default'       => 'center',
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
                    '{{WRAPPER}} .ut_post_out_wrapper' => 'text-align: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [        
                'name' => 'ut_type_out_title_typography',        
                'selector' => '{{WRAPPER}} .ut_post_out_wrapper h1, {{WRAPPER}} .ut_post_out_wrapper h2, {{WRAPPER}} .ut_post_out_wrapper h3, {{WRAPPER}} .ut_post_out_wrapper h4, {{WRAPPER}} .ut_post_out_wrapper h5, {{WRAPPER}} .ut_post_out_wrapper h6',    ]
            );

        $this->add_control(
            'ut_type_out_pre_animated_text_color',
            [
                'label'     => esc_html__( 'Color', 'ut-elementor-addons-lite' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .ut_post_out_wrapper h1' => 'color: {{VALUE}}',
                    '{{WRAPPER}} .ut_post_out_wrapper h2' => 'color: {{VALUE}}',
                    '{{WRAPPER}} .ut_post_out_wrapper h3' => 'color: {{VALUE}}',
                    '{{WRAPPER}} .ut_post_out_wrapper h4' => 'color: {{VALUE}}',
                    '{{WRAPPER}} .ut_post_out_wrapper h5' => 'color: {{VALUE}}',
                    '{{WRAPPER}} .ut_post_out_wrapper h6' => 'color: {{VALUE}}',
                ]
            ]
        );

        $this->add_control(
            'ut_animated_text_color',
            [
                'label' => esc_html__( 'Animated Text Color', 'ut-elementor-addons-lite' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} span.ut_post_out_animate_heading' => 'color: {{VALUE}};',
                ],
                'separator' => 'before',
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'ut_animated_text_typography',
                'label' => esc_html__( 'Animated Text Typography', 'ut-elementor-addons-lite' ),
                'selector' => '{{WRAPPER}} span.ut_post_out_animate_heading',
            ]
        );

        $this->end_controls_section();

    } 

    protected function render() {
        $settings = $this->get_settings_for_display();
        $ut_type_out_animated_heading = isset( $settings['ut_type_out_animated_heading'] ) ? esc_attr($settings['ut_type_out_animated_heading']) : 'Ultra, Addons, Lite';
        $ut_type_out_speed = isset( $settings['ut_type_out_speed'] ) ? esc_attr($settings['ut_type_out_speed']) : 60;
        $ut_type_out_delay_speed = isset( $settings['ut_type_out_delay_speed'] ) ? esc_attr($settings['ut_type_out_delay_speed']) : 60;
        $ut_type_out_text_show_cursor = isset( $settings['ut_type_out_text_show_cursor'] ) ? esc_attr($settings['ut_type_out_text_show_cursor']) : 'true';
        $ut_type_out_start_delay = isset( $settings['ut_type_out_start_delay'] ) ? esc_attr($settings['ut_type_out_start_delay']) : 1000;
        $ut_type_out_back_delay = isset( $settings['ut_type_out_back_delay'] ) ? esc_attr($settings['ut_type_out_back_delay']) : 1000;
        $ut_type_out_text_loop = isset( $settings['ut_type_out_text_loop'] ) ? esc_attr($settings['ut_type_out_text_loop']) : 'true';

        $this->add_render_attribute( 'utal-type_out', [
            'data-ut_type_out_animated_heading' => $ut_type_out_animated_heading,
            'data-ut_type_out_speed' => $ut_type_out_speed,
            'data-ut_type_out_delay_speed' => $ut_type_out_delay_speed, 
            'data-ut_type_out_text_show_cursor' => $ut_type_out_text_show_cursor,
            'data-ut_type_out_start_delay' => $ut_type_out_start_delay,
            'data-ut_type_out_back_delay' => $ut_type_out_back_delay,
            'data-ut_type_out_text_loop' => $ut_type_out_text_loop,
        ]); 
        ?> 

        <div class="ut_post_out_wrapper" <?php echo $this->get_render_attribute_string( 'utal-type_out' ); ?>>
            <?php
            $ut_id = esc_attr( rand( 11111,99999 ) );
            $ut_before_text = esc_html( $settings['ut_type_out_before_text'] );
            $ut_after_text = esc_html( $settings['ut_type_out_text_after_text'] );
            $ut_tag = esc_attr( $settings['ut_type_out_heading_tag'] );
            ?>
            <<?php echo esc_html( $ut_tag ); ?>><?php echo $ut_before_text; ?> <span id="typed_<?php echo $ut_id; ?>" class="ut_post_out_animate_heading"></span> <?php echo $ut_after_text; ?></<?php echo esc_html($ut_tag); ?>>
        </div>

        <?php
    }
}
Plugin::instance()->widgets_manager->register_widget_type(
    new UT_Elementor_Addons_Lite_Widget_Typed()
);
