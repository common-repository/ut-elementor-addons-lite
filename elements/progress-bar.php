<?php

namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) exit; 

class UT_Elementor_Addons_Lite_Widget_Progress_Bar extends Widget_Base
{

    public function get_title()
    {
        return esc_html__( 'Progress Bar', 'ut-elementor-addons-lite' );
    }

    public function get_icon()
    {
        return 'eicon-skill-bar ut-widget-icon';
    }

    public function get_categories()
    {
        return ['ut-elementor-addons-lite'];
    }

    public function get_name()
    {
        return 'utal-progress-bar';
    }

    public function get_script_depends()
    {
        return [
            'ut-elementor-addons-lite-script',
            'jquery-lineProgressbar',
            'jquery-easypiechart',
            'waypoints',
        ];
    }

    public function get_style_depends()
    {
        return [ 'jquery-lineProgressbar' ];
    }   

    protected function register_controls()
    {

        $this->start_controls_section(
            'ut_main_settings',
            [
                'label' => esc_html__( 'Progress Bar Settings', 'ut-elementor-addons-lite' ),
            ]
        );

        $this->add_control(
            'ut_progress_type',
            [
                'label' => esc_html__( 'Display Style', 'ut-elementor-addons-lite' ),
                'type' => Controls_Manager::SELECT,
                'default' => 'line',
                'options' => [
                    'line' => esc_html__( 'Line Bar', 'ut-elementor-addons-lite' ),
                    'circle' => esc_html__( 'Circle', 'ut-elementor-addons-lite' ),
                ]
            ]
        );

        $this->add_control(
            'ut_progress_title',
            [
                'label' => esc_html__( 'Title', 'ut-elementor-addons-lite' ),
                'type' => Controls_Manager::TEXT,
                'default' => esc_html__( 'WordPress', 'ut-elementor-addons-lite' ),
            ]
        );

        $this->add_control(
            'ut_progress_value',
            [
                'label' => esc_html__( 'Value', 'ut-elementor-addons-lite' ),
                'type' => Controls_Manager::NUMBER,
                'default' => 20,
                'max' => 100,
                'min' => 0,
            ]
        );

        $this->add_control(
            'ut_show_stripe',
            [
                'label' => esc_html__( 'Enable Stripe', 'ut-elementor-addons-lite' ),
                'type' => Controls_Manager::SWITCHER,
                'return_value' => 'true',
                'condition' => ['ut_progress_type' => 'line']
            ]
        );

        $this->add_control(
            'ut_show_animation',
            [
                'label' => esc_html__( 'Enable Stripe Animation', 'ut-elementor-addons-lite' ),
                'type' => Controls_Manager::SWITCHER,
                'return_value' => 'true',
                'condition' => [
                    'ut_progress_type' => 'line',
                    'ut_show_stripe' => 'true'
                ]
            ]
        );

        $this->add_responsive_control(
            'ut_progress_height',
            [
                'label' => esc_html__( 'Height', 'ut-elementor-addons-lite' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => ['px'],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 100,
                        'step' => 1,
                    ]
                ],
                'default' => [
                    'unit' => 'px',
                    'size' => 5,
                ],
                'condition' => ['ut_progress_type' => 'line']
            ]
        );

        $this->add_control(
            'ut_pcircle_height',
            [
                'label' => esc_html__( 'Size', 'ut-elementor-addons-lite' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => ['px'],
                'range' => [
                    'px' => [
                        'min' => 50,
                        'max' => 500,
                        'step' => 10,
                    ]
                ],
                'default' => [
                    'unit' => 'px',
                    'size' => 110,
                ],
                'condition' => ['ut_progress_type' => 'circle']
            ]
        );

        $this->add_control(
            'ut_pline_height',
            [
                'label' => esc_html__( 'Thickness', 'ut-elementor-addons-lite' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => ['px'],
                'range' => [
                    'px' => [
                        'min' => 1,
                        'max' => 100,
                        'step' => 1,
                    ]
                ],
                'default' => [
                    'unit' => 'px',
                    'size' => 10,
                ],
                'condition' => ['ut_progress_type' => 'circle']
            ]
        );

        $this->add_control(
            'ut_pcircle_atime',
            [
                'label' => esc_html__( 'Animation Time(ms)', 'ut-elementor-addons-lite' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => ['px'],
                'range' => [
                    'px' => [
                        'min' => 500,
                        'max' => 10000,
                        'step' => 100,
                    ]
                ],
                'default' => [
                    'unit' => 'px',
                    'size' => 1000,
                ],
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'ut_progressbar_style',
            [
                'label'     => esc_html__( 'Progressbar', 'ut-elementor-addons-lite' ),
                'tab'       => Controls_Manager::TAB_STYLE,
                'condition' => ['ut_progress_type' => 'line']
            ]
        );

        $this->add_control(
            'progress_bg_style',
            [
                'label' => esc_html__( 'Background', 'ut-elementor-addons-lite' ),
                'type' => Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );

        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name' => 'ut_progress_background',
                'show_label' => false,
                'label' => esc_html__( 'Progress Bar Background', 'ut-elementor-addons-lite' ),
                'types' => ['classic', 'gradient'],
                'selector' => '{{WRAPPER}} .progressbar',
            ]
        );

        $this->add_control(
            'progress_color_style',
            [
                'label' => esc_html__( 'Filing Color', 'ut-elementor-addons-lite' ),
                'type' => Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );

        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name' => 'ut_progress_color',
                'label'     => esc_html__( 'Progress Bar Color', 'ut-elementor-addons-lite' ),
                'types' => ['classic', 'gradient'],
                'selector' => '{{WRAPPER}} .proggress',
            ]
        );

        $this->add_responsive_control(
            'ut_progress_radius',
            [
                'label' => esc_html__( 'Border Radius', 'ut-elementor-addons-lite' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => ['px'],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 100,
                        'step' => 1,
                    ]
                ],
                'default' => [
                    'unit' => 'px',
                    'size' => 0,
                ]
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'ut_progresscircle_style',
            [
                'label'     => esc_html__( 'Progressbar Style', 'ut-elementor-addons-lite' ),
                'tab'       => Controls_Manager::TAB_STYLE,
                'condition' => ['ut_progress_type' => 'circle']
            ]
        );

        $this->add_control(
            'ut_progress_cbg_color',
            [
                'label' => esc_html__( 'Background', 'ut-elementor-addons-lite' ),
                'type' => Controls_Manager::COLOR,
                'default' => '#eee',
            ]
        );

        $this->add_control(
            'ut_progress_cheading_style',
            [
                'label' => esc_html__( 'Filing Color', 'ut-elementor-addons-lite' ),
                'type' => Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );

        $this->add_control(
            'ut_progress_cline_filing_type',
            [
                'label' => esc_html__( 'Type', 'ut-elementor-addons-lite' ),
                'type' => Controls_Manager::SELECT,
                'default' => 'normal',
                'options' => [
                    'normal' => esc_html__( 'Normal', 'ut-elementor-addons-lite' ),
                    'gradient' => esc_html__( 'Gradient', 'ut-elementor-addons-lite' ),
                ]
            ]
        );

        $this->add_control(
            'ut_progress_cline_color',
            [
                'label' => esc_html__( 'Color', 'ut-elementor-addons-lite' ),
                'type' => Controls_Manager::COLOR,
                'default' => '#000',
                'condition' => ['ut_progress_cline_filing_type' => 'normal']
            ]
        );

        $this->add_control(
            'ut_progress_cgrident_color1',
            [
                'label' => esc_html__( 'Color 1', 'ut-elementor-addons-lite' ),
                'type' => Controls_Manager::COLOR,
                'default' => '#ffe57e',
                'condition' => ['ut_progress_cline_filing_type' => 'gradient']
            ]
        );

        $this->add_control(
            'ut_progress_cgrident_color2',
            [
                'label' => esc_html__( 'Color 2', 'ut-elementor-addons-lite' ),
                'type' => Controls_Manager::COLOR,
                'default' => '#de5900',
                'condition' => ['ut_progress_cline_filing_type' => 'gradient']
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'ut_title_style_settings',
            [
                'label' => esc_html__( 'Title ', 'ut-elementor-addons-lite' ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_responsive_control(
            'ut_title_alignment',
            [
                'label' => esc_html__( 'Alignment', 'ut-elementor-addons-lite' ),
                'type' => Controls_Manager::CHOOSE,
                'options' => [
                    'left' => [
                        'title' => esc_html__( 'Left', 'ut-elementor-addons-lite' ),
                        'icon' => 'fa fa-align-left',
                    ],
                    'center' => [
                        'title' => esc_html__( 'Center', 'ut-elementor-addons-lite' ),
                        'icon' => 'fa fa-align-center',
                    ],
                    'right' => [
                        'title' => esc_html__( 'Right', 'ut-elementor-addons-lite' ),
                        'icon' => 'fa fa-align-right',
                    ]
                ],
                'selectors' => [
                    '{{WRAPPER}} .ut-progress-bar .progress-title' => 'text-align: {{VALUE}};',
                ]
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'ut_cat_title_typography',
                'selector' => '{{WRAPPER}} .ut-progress-bar .progress-title',
            ]
        );

        $this->add_control(
            'ut_title_color',
            [
                'label' => esc_html__( 'Color', 'ut-elementor-addons-lite' ),
                'type' => Controls_Manager::COLOR,
                'default' => '#4d4d4d',
                'selectors' => [
                    '{{WRAPPER}} .ut-progress-bar .progress-title' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'ut_title_padding',
            [
                'label' => esc_html__( 'Padding', 'ut-elementor-addons-lite' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors' => [
                    '{{WRAPPER}} .ut-progress-bar .progress-title' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'ut_value_style_settings',
            [
                'label' => esc_html__( 'Value', 'ut-elementor-addons-lite' ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'ut_value_typography',
                'selector' => '{{WRAPPER}} .ut-progress-bar .progress-value',
            ]
        );

        $this->add_control(
            'ut_value_color',
            [
                'label' => esc_html__( 'Color', 'ut-elementor-addons-lite' ),
                'type' => Controls_Manager::COLOR,
                'default' => '#4d4d4d',
                'selectors' => [
                    '{{WRAPPER}} .ut-progress-bar .progress-value' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'ut_value_padding',
            [
                'label' => esc_html__( 'Padding', 'ut-elementor-addons-lite' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors' => [
                    '{{WRAPPER}} .ut-progress-bar .progress-value' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->end_controls_section();
    }

    protected function render()
    {
        $settings = $this->get_settings_for_display();
        $ut_progress_type = $settings['ut_progress_type'];
        $ut_progress_title = $settings['ut_progress_title'];
        $ut_progress_value = $settings['ut_progress_value'];
        $progress_height = $settings['ut_progress_height']['size'];
        $progress_radius = $settings['ut_progress_radius']['size'];
        $progress_strip = $settings['ut_show_stripe'] == 'true' ? 'progress-bar-striped' : '';
        $progress_amin = $settings['ut_show_animation'] == 'true' ? 'striped-animation' : '';
        $c_filing_type = isset($settings['ut_progress_cline_filing_type']) ? $settings['ut_progress_cline_filing_type'] : 'normal';
        $c_filing_color1 = isset($settings['ut_progress_cgrident_color1']) ? $settings['ut_progress_cgrident_color1'] : '#ffe57e';
        $c_filing_color2 = isset($settings['ut_progress_cgrident_color2']) ? $settings['ut_progress_cgrident_color2'] : '#de5900';

        $this->add_render_attribute('ut-progressbar', 'class', 'ut-progress-bar ' . $ut_progress_type);
        $this->add_render_attribute('ut-progressbar', 'data-id', $this->get_id());
        $this->add_render_attribute('ut-progressbar', 'data-type', $ut_progress_type);
        if ($ut_progress_type == 'line') {
            $this->add_render_attribute('ut-progressbar', 'data-value', $ut_progress_value);
            $this->add_render_attribute('ut-progressbar', 'data-height', $progress_height);
            $this->add_render_attribute('ut-progressbar', 'data-radius', $progress_radius);
            $this->add_render_attribute('ut-progressbar', 'class', $progress_strip);
            $this->add_render_attribute('ut-progressbar', 'class', $progress_amin);
            $this->add_render_attribute('ut-progressbar', 'data-amintime', $settings['ut_pcircle_atime']['size']);
        } else {
            $this->add_render_attribute('ut-progressbar', 'data-bg', $settings['progress_cbg_color']);
            $this->add_render_attribute('ut-progressbar', 'data-color', $settings['progress_cline_color']);
            $this->add_render_attribute('ut-progressbar', 'data-cheight', $settings['ut_pcircle_height']['size']);
            $this->add_render_attribute('ut-progressbar', 'data-lheight', $settings['ut_pline_height']['size']);
            $this->add_render_attribute('ut-progressbar', 'data-amintime', $settings['ut_pcircle_atime']['size']);
            $this->add_render_attribute('ut-progressbar', 'data-ctype', $c_filing_type);
            $this->add_render_attribute('ut-progressbar', 'data-gcolor1', $c_filing_color1);
            $this->add_render_attribute('ut-progressbar', 'data-gcolor2', $c_filing_color2);
        }
        ?>
        <div <?php echo $this->get_render_attribute_string("ut-progressbar") ?>>
            <?php if ( '' != $ut_progress_title ) { ?>
                <div class="progress-title">
                    <?php
                    echo esc_html( $ut_progress_title );
                    if ( 'line' == $ut_progress_type ) {
                        ?>
                        <span class="progress-value"><?php echo ' - ' . esc_html( $ut_progress_value ) . '%'; ?></span>
                    <?php } ?>
                </div>
            <?php }
            if ( 'line' == $ut_progress_type ) { ?>
                <div id="ut-progressbar-<?php echo esc_attr( $this->get_id() ); ?>" class="progress-bar"></div>
            <?php } else { ?>
                <div id="ut-progressbar-<?php echo esc_attr( $this->get_id() ); ?>" data-percent="<?php echo esc_attr( $ut_progress_value ); ?>" class="progress-circle">
                    <span class="progress-value"><?php echo esc_html( $ut_progress_value ) . '%'; ?></span>
                </div>
            <?php } ?>
            <?php
            if (\Elementor\Plugin::instance()->editor->is_edit_mode()) {
                $this->render_editor_script();
            }
            ?>
        </div>
        <?php
    }

    protected function content_template()
    {
    }

    public function render_plain_content($instance = [])
    {
    }

/**
* Render Countdown script
* 
* @access protected
*/
protected function render_editor_script()
{ ?>
    <script type="text/javascript">
      jQuery(document).ready(function($) {
        $('.ut-progress-bar').each(function() {
            var $node_id = '<?php echo $this->get_id(); ?>',
            $scope = $('[data-id="' + $node_id + '"]'),
            pbar = $(this),
            $ut_progress_type = pbar.data('type'),
            $progress_id = pbar.data('id');
            if(pbar.closest($scope).length < 1) {
                return;
            }
            pbar.waypoint(function() {
                if( 'line' == $ut_progress_type ) {
                    var $progress_val = pbar.data('value'),
                    $progress_height = pbar.data('height'),
                    $progress_radius = pbar.data('radius'),
                    $progress_amintime = pbar.data('amintime');
                    pbar.find('#ut-progressbar-' + $progress_id).LineProgressbar({
                        percentage: $progress_val,
                        fillBackgroundColor: true,
                        backgroundColor: true,
                        height: $progress_height + 'px',
                        radius: $progress_radius + 'px',
                        ShowProgressCount: false,
                        duration: $progress_amintime
                    });
                } else {
                    var $bgColor = pbar.data('bg'),
                    $color = pbar.data('color'),
                    $lHeight = pbar.data('lheight'),
                    $cheight = pbar.data('cheight');
                    $animate = pbar.data('amintime');
                    $ctype = pbar.data('ctype');
                    $gcolor1 = pbar.data('gcolor1');
                    $gcolor2 = pbar.data('gcolor2');
                    if($ctype == 'gradient') {
                        $barcolor = function(percent) {
                            var ctx = this.renderer.getCtx();
                            var canvas = this.renderer.getCanvas();
                            var gradient = ctx.createLinearGradient(0, 0, canvas.width, 180);
                            gradient.addColorStop(0.3, $gcolor1);
                            gradient.addColorStop(0, $gcolor2);
                            return gradient;
                        }
                    } else {
                        $barcolor = $color;
                    }
                    pbar.find('#ut-progressbar-' + $progress_id).easyPieChart({
                //barColor: $color,
                        trackColor: $bgColor,
                        lineWidth: $lHeight,
                        scaleLength: 0,
                        size: $cheight,
                        lineCap: 'butt',
                        animate: ({
                            duration: $animate,
                            enabled: true
                        }),
                        barColor: $barcolor,
                    });
                }
            }, {
                triggerOnce: true,
                offset: 'bottom-in-view'
            });
        });
    });
</script>

<?php
}
}

Plugin::instance()->widgets_manager->register_widget_type(new UT_Elementor_Addons_Lite_Widget_Progress_Bar());
