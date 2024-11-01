<?php

namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) exit; 

class UT_Elementor_Addons_Lite_Widget_testimonial extends Widget_Base
{

    use \Elementor\UT_Elementor_Addons_Lite_Queries;

    public function get_name()
    {
        return 'utal-testimonial';
    }

    public function get_title()
    {
        return  esc_html__( 'Testimonial', 'ut-elementor-addons-lite' );
    }

    public function get_icon()
    {
        return 'eicon-testimonial ut-widget-icon';
    }

    public function get_categories()
    {
        return ['ut-elementor-addons-lite'];
    }

    public function get_script_depends() {
        return [ 'ut-elementor-addons-lite-script', 'slick' ];
    }

    public function get_style_depends()
    {
        return [ 'slick' ];
    }

    protected function register_controls()
    {

        $this->start_controls_section(
            'ut_testimonial_section',
            [
                'label' => esc_html__( 'General', 'ut-elementor-addons-lite' ),
                'tab' => Controls_Manager::TAB_CONTENT,

            ]
        );

        $repeater = new Repeater();

        $repeater->add_control(
            'ut_testimonial_name',
            [
                'label' => esc_html__( 'Name', 'ut-elementor-addons-lite' ),
                'type' => Controls_Manager::TEXT,
                'default' => esc_html__( 'John Doe', 'ut-elementor-addons-lite' ),
                'label_block' => false,
            ]
        );

        $repeater->add_control(
            'ut_testimonial_company',
            [
                'label' => esc_html__('Sub Title', 'ut-elementor-addons-lite'),
                'type' => Controls_Manager::TEXT,
                'default' => esc_html__('Company Name', 'ut-elementor-addons-lite'),
                'label_block' => false,
            ]
        );

        $repeater->add_control(
            'ut_testimonial_image',
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
                'default' => 'thumbnail',
            ]
        );

        $repeater->add_control(
            'ut_testimonial_link',
            [
                'label' => esc_html__( 'Link', 'ut-elementor-addons-lite' ),
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
            'ut_testimonial_content',
            [
                'label' => esc_html__( 'Description', 'ut-elementor-addons-lite' ),
                'type' => Controls_Manager::WYSIWYG,
                'default' => esc_html__( 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. In ut leo euismod, tempor libero eget, varius tortor. Vestibulum est turpis, viverra eget dolor non, mollis elementum arcu.', 'ut-elementor-addons-lite' ),
                'show_label' => true,
            ]
        );

        $this->add_control(
            'testimonials',
            [
                'label' => esc_html__( 'Testimonials', 'ut-elementor-addons-lite' ),
                'type' => Controls_Manager::REPEATER,
                'fields' => $repeater->get_controls(),
                'default' => [
                    [
                        'ut_testimonial_name' => esc_html__( 'John Doe', 'ut-elementor-addons-lite' ),
                        'ut_testimonial_company' => esc_html__( 'Company Name', 'ut-elementor-addons-lite' ),
                        'ut_testimonial_link' => '',
                        'ut_testimonial_content' => esc_html__( 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. In ut leo euismod, tempor libero eget, varius tortor. Vestibulum est turpis, viverra eget dolor non, mollis elementum arcu.', 'ut-elementor-addons-lite' ),
                    ],
                ],
                'title_field' => '{{{ ut_testimonial_name }}}',
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'ut_section_testimonial_setting',
            [
                'label'             => esc_html__( 'Settings', 'ut-elementor-addons-lite' ),
            ]
        );

        $this->add_control(
            'ut_testimonial_image_position',
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

        $this->add_control(
            'slider',
            [
                'label'             => esc_html__( 'Enable Slider', 'ut-elementor-addons-lite' ),
                'type'              => Controls_Manager::SWITCHER,
                'default'           => 'yes',
                'label_on'          => esc_html__( 'Yes', 'ut-elementor-addons-lite' ),
                'label_off'         => esc_html__( 'No', 'ut-elementor-addons-lite' ),
                'return_value'      => 'yes',

            ]
        );
        
        $this->add_responsive_control(
            'columns',
            [
                'label' => esc_html__( 'Columns to Show', 'ut-elementor-addons-lite' ),
                'type' => Controls_Manager::NUMBER,
                'min' => 1,
                'max' => 4,
                'step' => 1,
                'devices' => ['desktop', 'tablet', 'mobile'],
                'desktop_default' => 1,
                'tablet_default' => 1,
                'mobile_default' => 1,
                'condition' => [
                    'slider' => ''
                ],
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'ut_section_testimonial_slider_setting',
            [
                'label'             => esc_html__( 'Slider Settings', 'ut-elementor-addons-lite' ),
                'tab' => Controls_Manager::TAB_CONTENT,
                'condition' => [
                    'slider' => 'yes'
                ],
            ]
        );

        $this->add_responsive_control(
            'arrows',
            [
                'label'             => esc_html__( 'Arrows', 'ut-elementor-addons-lite' ),
                'type'              => Controls_Manager::SWITCHER,
                'default'           => 'no',
                'label_on'          => esc_html__( 'Yes', 'ut-elementor-addons-lite' ),
                'label_off'         => esc_html__( 'No', 'ut-elementor-addons-lite' ),

            ]
        );

        $this->add_responsive_control(
            'dots',
            [
                'label'             => esc_html__( 'Dots', 'ut-elementor-addons-lite' ),
                'type'              => Controls_Manager::SWITCHER,
                'default'           => 'no',
                'label_on'          => esc_html__( 'Yes', 'ut-elementor-addons-lite' ),
                'label_off'         => esc_html__( 'No', 'ut-elementor-addons-lite' ),
                'return_value'      => 'yes',
                'devices' => ['desktop', 'tablet', 'mobile'],
                'desktop_default' => 'yes',
                'tablet_default' => 'yes',
                'mobile_default' => 'yes', 
            ]
        );

        $this->slider_settings(array('control_section' => false, 'slidesToShow' => true,'arrows' => false,'dots' => false,));
        
        $this->end_controls_section();

        $this->start_controls_section(
            'ut_section_general_style',
            [
                'label' => esc_html__( 'Name', 'ut-elementor-addons-lite' ),
                'tab'   => Controls_Manager::TAB_STYLE,
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
            'ut_content_title_color',
            [
                'label'     => esc_html__( 'Name', 'ut-elementor-addons-lite' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .utal-testimonial .utal-slide-title a, {{WRAPPER}} .utal-testimonial .utal-slide-title' => 'color: {{VALUE}};',
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
            'ut_content_title_color_hover',
            [
                'label'     => esc_html__( 'Color hover', 'ut-elementor-addons-lite' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .utal-testimonial .utal-slide-title a:hover, {{WRAPPER}} .utal-testimonial .utal-slide-title:hover'=> 'color: {{VALUE}};',
                ],
            ]
        );
        $this->end_controls_tab();
        
        $this->end_controls_tabs();

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'      => 'ut_content_title_typography',
                'label'     => esc_html__( 'Typography', 'ut-elementor-addons-lite' ),
                'scheme'    => Core\Schemes\Typography::TYPOGRAPHY_4,
                'selector' => '{{WRAPPER}} .utal-testimonial .utal-slide-title',
            ]
        );

        $this->add_control(
            'ut_content_title_align',
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
                        'icon' => 'eicon-text-align-center',
                    ],
                ],
                'default' => 'align-left',
                'toggle' => true,
            ]
        );
        $this->end_controls_section();

        $this->start_controls_section(
            'ut_section_company_style',
            [
                'label' => esc_html__( 'Sub Title', 'ut-elementor-addons-lite' ),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );  

        $this->add_control(
            'ut_content_company_color',
            [
                'label'     => esc_html__( 'Color', 'ut-elementor-addons-lite' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .utal-testimonial .utal-content-company' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'      => 'ut_content_company_typography',
                'label'     => esc_html__( 'Typography', 'ut-elementor-addons-lite' ),
                'scheme'    => Core\Schemes\Typography::TYPOGRAPHY_4,
                'selector' => '{{WRAPPER}} .utal-testimonial .utal-content-company',
            ]
        );

        $this->add_control(
            'ut_content_company_align',
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
                        'icon' => 'eicon-text-align-center',
                    ],
                ],
                'default' => 'align-left',
                'toggle' => true,
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'ut_section_content_style',
            [
                'label' => esc_html__( 'Description', 'ut-elementor-addons-lite' ),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );  

        $this->add_control(
            'ut_content_description_color',
            [
                'label'     => esc_html__( 'Color', 'ut-elementor-addons-lite' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .utal-testimonial .utal-content-excerpt' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'      => 'ut_content_excerpt_typography',
                'label'     => esc_html__( 'Typography', 'ut-elementor-addons-lite' ),
                'scheme'    => Core\Schemes\Typography::TYPOGRAPHY_4,
                'selector' => '{{WRAPPER}} .utal-testimonial .utal-content-excerpt',
            ]
        );

        $this->add_control(
            'ut_content_description_align',
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
                        'icon' => 'eicon-text-align-center',
                    ],
                ],
                'default' => 'align-left',
                'toggle' => true,
            ]
        );        

        $this->end_controls_section();

        $this->start_controls_section(
            'ut_section_image_style',
            [
                'label' => esc_html__( 'Image', 'ut-elementor-addons-lite' ),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );  

        $this->add_control(
            'ut_content_image_style',
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
            'ut_content_image_width',
            [
                'label'     => esc_html__( 'Width', 'ut-elementor-addons-lite' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => [ 'px', '%' ],
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
             'size' => 100,
         ],
         'selectors' => [
             '{{WRAPPER}} .utal-testimonial figure img' => 'width: {{SIZE}}{{UNIT}};',
         ],
         'condition' => [
            'ut_testimonial_image_position' => ['layout-3']
        ],

    ]
);

        $this->add_responsive_control(
            'ut_content_image_size',
            [
                'label'     => esc_html__( 'Size', 'ut-elementor-addons-lite' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => [ 'px'],
                'range' => [
                 'px' => [
                  'min' => 0,
                  'max' => 1000,
                  'step' => 5,
              ],					
          ],

          'selectors' => [
             '{{WRAPPER}} .utal-testimonial figure img' => 'width: {{SIZE}}{{UNIT}}; height: {{SIZE}}{{UNIT}};',
         ],
         'condition' => [
            'ut_testimonial_image_position' => ['layout-1','layout-2']
        ],

    ]
);

        $this->add_responsive_control(
            'ut_content_image_max_width',
            [
                'label'     => esc_html__( 'Max. Width', 'ut-elementor-addons-lite' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => [ 'px', '%' ],
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
             'size' => 100,
         ],
         'selectors' => [
             '{{WRAPPER}} .utal-testimonial figure img' => 'max-width: {{SIZE}}{{UNIT}};',
         ],
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
                    '{{WRAPPER}} .utal-testimonial .slide-content-wrap' => 'background-color: {{VALUE}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'ut_container_width',
            [
                'label' => esc_html__( 'Width', 'ut-elementor-addons-lite' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => ['px', '%'],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 1400,
                    ],
                    '%' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .utal-testimonial .utal-slide-wrap .slide-content-wrap' => 'min-width: {{SIZE}}{{UNIT}}; width: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'ut_container_height',
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
                    '{{WRAPPER}} .utal-testimonial .utal-slide-wrap .slide-content-wrap' => 'min-height: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'ut_container_margin',
            [
                'label' => esc_html__( 'Margin', 'ut-elementor-addons-lite' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors' => [
                    '{{WRAPPER}} .utal-testimonial .utal-slide-wrap .slide-content-wrap' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'ut_container_padding',
            [
                'label' => esc_html__( 'Padding', 'ut-elementor-addons-lite' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors' => [
                    '{{WRAPPER}} .utal-testimonial .slide-content-wrap' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->end_controls_section();

    }

    protected function render()
    {
        $settings = $this->get_settings();
        $this->add_render_attribute('utal-testimonial', 'class', 'utal-testimonial');
        /* Reset all actions in hook before starting*/
        remove_all_actions('utal_pos_top');
        remove_all_actions('utal_pos_middle');
        remove_all_actions('utal_pos_bottom');
        $sliderEnable = isset($settings['slider']) ? $settings['slider'] : 'no';
        $arrows = isset($settings['arrows']) ? $settings['arrows'] : 'no';
        $arrows_tablet = isset($settings['arrows_tablet']) ? $settings['arrows_tablet'] : 'no';
        $arrows_mobile = isset($settings['arrows_mobile']) ? $settings['arrows_mobile'] : 'no';
        $dots = isset($settings['dots']) ? $settings['dots'] : 'no';
        $dots_tablet = isset($settings['dots_tablet']) ? $settings['dots_tablet'] : 'no';
        $dots_mobile = isset($settings['dots_mobile']) ? $settings['dots_mobile'] : 'no';
        $autoplay = isset($settings['autoplay']) ? $settings['autoplay'] : 'no';
        $autoplay_speed = isset($settings['autoplay_speed']) ? $settings['autoplay_speed'] : '2000';
        $slidesToShow = isset($settings['slidesToShow']) ? $settings['slidesToShow'] : 3;
        $slidesToShow_tablet = isset($settings['slidesToShow_tablet']) ? $settings['slidesToShow_tablet'] : 2;
        $slidesToShow_mobile = isset($settings['slidesToShow_mobile']) ? $settings['slidesToShow_mobile'] : 1;
        $infinite_loop = isset($settings['infinite_loop']) ? $settings['infinite_loop'] : 'yes';
        $pauseOnHover = isset($settings['pauseOnHover']) ? $settings['pauseOnHover'] : 'yes';
        $dots_pos = isset($settings['dots_pos']) ? $settings['dots_pos'] : 'inside-box';
        $swipe = isset($settings['swipe']) ? $settings['swipe'] : 'yes';
        $columns = isset($settings['columns']) ? $settings['columns'] : 3;
        $columns_tablet = isset($settings['columns_tablet']) ? $settings['columns_tablet'] : 2;
        $columns_mobile = isset($settings['columns_mobile']) ? $settings['columns_mobile'] : 1;
        $design_style = isset($settings['ut_testimonial_image_position']) ? $settings['ut_testimonial_image_position'] : 'default';
        $container_text_align = isset($settings['container_text_align']) ? $settings['container_text_align'] : 'align-left';
        $name_text_align = isset($settings['content_title_align']) ? $settings['content_title_align'] : 'align-left';
        $company_text_align = isset($settings['content_company_align']) ? $settings['content_company_align'] : 'align-left';
        $description_text_align = isset($settings['content_description_align']) ? $settings['content_description_align'] : 'align-left';
        $content_image_style = isset($settings['content_image_style']) ? $settings['content_image_style'] : 'square';
        $this->add_render_attribute('utal-testimonial', 'class', 'utal utal-'.$design_style);
        if ($sliderEnable == 'yes') {
            $this->add_render_attribute('utal-testimonial-slider', 'class', 'slick-slider');
            $this->add_render_attribute('utal-testimonial-slider', 'data-arrows', $arrows);
            $this->add_render_attribute('utal-testimonial-slider', 'data-arrows-tablet', $arrows_tablet);
            $this->add_render_attribute('utal-testimonial-slider', 'data-arrows-mobile', $arrows_mobile);
            $this->add_render_attribute('utal-testimonial-slider', 'data-dots', $dots);
            $this->add_render_attribute('utal-testimonial-slider', 'data-dots-tablet', $dots_tablet);
            $this->add_render_attribute('utal-testimonial-slider', 'data-dots-mobile', $dots_mobile);
            $this->add_render_attribute('utal-testimonial-slider', 'data-slidesToShow', $slidesToShow);
            $this->add_render_attribute('utal-testimonial-slider', 'data-slidesToShow-tablet', $slidesToShow_tablet);
            $this->add_render_attribute('utal-testimonial-slider', 'data-slidesToShow-mobile', $slidesToShow_mobile);
            $this->add_render_attribute('utal-testimonial-slider', 'data-infinit_loop', $infinite_loop);
            $this->add_render_attribute('utal-testimonial-slider', 'data-pauseOnHover', $pauseOnHover);
            $this->add_render_attribute('utal-testimonial-slider', 'data-swipe', $swipe);
            $this->add_render_attribute('utal-testimonial-slider', 'data-autoplay', $autoplay);
            $this->add_render_attribute('utal-testimonial-slider', 'data-autoplay_speed', $autoplay_speed);
            ?>
            
            <div <?php echo $this->get_render_attribute_string('utal-testimonial'); ?>>
                <div class="utal-slider-wrapper utal-testimonial dots-<?php echo esc_attr($dots_pos); ?> <?php echo esc_attr($container_text_align); ?>"> 
                    <div <?php echo $this->get_render_attribute_string('utal-testimonial-slider'); ?>>
                        <?php
                        if ( $settings['testimonials'] ) {
                            foreach ($settings['testimonials'] as $slide) {
                                $link=$slide['ut_testimonial_link']['url'] ? $slide['ut_testimonial_link']['url'] : '#';
                                $target = $slide['ut_testimonial_link']['is_external'] ? ' target="_blank"' : '';
                                $nofollow = $slide['ut_testimonial_link']['nofollow'] ? ' rel="nofollow"' : '';

                                ob_start();
                                echo '<div class="utal-bio">';
                                if($link!='') {
                                    echo '<a href="' . $link . '"' . $target . $nofollow . '>';
                                } 
                                echo '<div class="utal-slide-title '.esc_attr($name_text_align).'">' . esc_html($slide['ut_testimonial_name']) . '</div> <div class="utal-content-company '.esc_attr($company_text_align).'">' . esc_html($slide['ut_testimonial_company']) . '</div>';
                                if($link!='') {
                                    echo '</a>';
                                }
                                echo '</div>';
                                $bio = ob_get_clean();

                                ob_start();
                                $image=$slide['ut_testimonial_image']['id'];
                                if($image==''){
                                    echo '<figure class="utal-slide-image-wrap utal-image-'.$content_image_style.'"><img src="'.\Elementor\Utils::get_placeholder_image_src().'"></figure >';

                                }else{
                                    echo '<figure class="utal-slide-image-wrap utal-image-'.$content_image_style.'">'.wp_get_attachment_image($slide['ut_testimonial_image']['id'], $slide['thumbnail_size']).'</figure >';
                                }
                                $image = ob_get_clean();

                                ob_start();
                                echo '<div class="utal-content-excerpt '.esc_attr($description_text_align).'">' . wp_kses_post($slide['ut_testimonial_content']) . '</div>';
                                $content=ob_get_clean();

                            //echo $link;
                                echo '<div class="utal-slide-wrap custom-slide-wrap elementor-repeater-item-' . $slide['_id'] . '"><div class="slide-content-wrap '.$design_style.'">';
                                if ($design_style == 'layout-1') {
                                    echo $content;
                                    echo '<div class="utal-image-bio">';
                                    echo $image;
                                    echo $bio;
                                    echo '</div>';
                                }
                                if ($design_style == 'layout-2') {
                                    echo $image;
                                    echo $bio;
                                    echo $content;
                                    
                                }
                                if ($design_style == 'layout-3') {
                                    echo '<div class="utal-image">';
                                    echo $image;                                    
                                    echo '</div>';
                                    echo '<div class="utal-content-bio">';
                                    echo $content;
                                    echo $bio;
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
        } else { ?>
            <div <?php echo $this->get_render_attribute_string('utal-testimonial'); ?>>
                <div class="utal-testimonial-wrapper <?php echo esc_attr($container_text_align); ?>">
                    <div class="d-flex col-desktop-<?php echo esc_attr($columns); ?> col-tab-<?php echo esc_attr($columns_tablet); ?> col-mob-<?php echo esc_attr($columns_mobile); ?> ">
                        <?php
                        if ($settings['testimonials']) {
                            foreach ($settings['testimonials'] as $slide) {
                                $link=$slide['ut_testimonial_link']['url'] ? $slide['ut_testimonial_link']['url'] : '';
                                $target = $slide['ut_testimonial_link']['is_external'] ? ' target="_blank"' : '';
                                $nofollow = $slide['ut_testimonial_link']['nofollow'] ? ' rel="nofollow"' : '';

                                ob_start();
                                echo '<div class="utal-bio">';
                                if($link!='') {
                                    echo '<a href="' . esc_url($link) . '"' . $target . $nofollow . '>';
                                } 
                                echo '<div class="utal-slide-title '.esc_attr($name_text_align).'">' . esc_html($slide['ut_testimonial_name']) . '</div> <div class="utal-content-company '.esc_attr($company_text_align).'">' . esc_html($slide['ut_testimonial_company']) . '</div>';
                                if($link!='') {
                                    echo '</a>';
                                }
                                echo '</div>';
                                $bio = ob_get_clean();

                                ob_start(); 
                                $image=$slide['ut_testimonial_image']['id'];
                                if($image==''){
                                    echo '<figure class="utal-slide-image-wrap utal-image-'.esc_attr($content_image_style).'"><img src="'.esc_url(\Elementor\Utils::get_placeholder_image_src()).'"></figure >';

                                }else{
                                    echo '<figure class="utal-slide-image-wrap utal-image-'.esc_attr($content_image_style).'">'.wp_kses_post(wp_get_attachment_image($slide['ut_testimonial_image']['id']), $slide['thumbnail_size']).'</figure >';
                                }
                                $image = ob_get_clean();

                                ob_start();
                                echo '<div class="utal-content-excerpt '.esc_attr($description_text_align).'">' . wp_kses_post($slide['ut_testimonial_content']) . '</div>';
                                $content=ob_get_clean();

                            //echo $link;
                                echo '<div class="utal-slide-wrap custom-slide-wrap elementor-repeater-item-' . esc_attr($slide['_id']) . '"><div class="slide-content-wrap '.esc_attr($design_style).'">';
                                if ($design_style == 'layout-1') {
                                    echo $content;
                                    echo '<div class="utal-image-bio">';
                                    echo $image;
                                    echo $bio;
                                    echo '</div>';
                                }
                                if ($design_style == 'layout-2') {
                                    echo $image;
                                    echo $bio;
                                    echo $content;
                                    
                                }
                                if ($design_style == 'layout-3') {
                                    echo '<div class="utal-image">';
                                    echo $image;
                                    
                                    echo '</div>';
                                    echo '<div class="utal-content-bio">';
                                    echo $content;
                                    echo $bio;
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
}
Plugin::instance()->widgets_manager->register_widget_type(new UT_Elementor_Addons_Lite_Widget_testimonial());
