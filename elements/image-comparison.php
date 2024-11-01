<?php

namespace Elementor; 

if ( ! defined( 'ABSPATH' ) ) exit; 

class UT_Elementor_Addons_Lite_Widget_Image extends Widget_Base
{

	use \Elementor\UT_Elementor_Addons_Lite_Queries; 

	public function get_name()
	{
		return 'utal-image-com'; 
	}

	public function get_title() {
		return  esc_html__( 'Image Comparison', 'ut-elementor-addons-lite' );
	}

	public function get_icon() { 
		return 'eicon-image-before-after ut-widget-icon';
	}

	public function get_categories() {
		return [ 'ut-elementor-addons-lite' ];
	}

	public function get_script_depends()
	{
		return [
			'jquery-event-move',
			'jquery-twentytwenty',
			'ut-elementor-addons-lite-script',
		];
	}

	public function get_style_depends()
	{
		return [ 'twentytwenty' ];
	}	

	protected function register_controls() {

		$this->start_controls_section(  
			'ut_section_detail',
			[
				'label' => esc_html__( 'General', 'ut-elementor-addons-lite' ),
			]
		);

		$this->add_control(
			'ut_img_comparison_before_heading_section',
			[
				'label' => esc_html__( 'Before', 'ut-elementor-addons-lite' ),
				'type' => Controls_Manager::HEADING,
				'separator' => 'before',
			]
		); 

		$this->add_control(
			'ut_image_before',
			[
				'label'   => esc_html__( 'Choose Image', 'ut-elementor-addons-lite' ),
				'type'    => Controls_Manager::MEDIA,
				'default' => [
					'url' => \Elementor\Utils::get_placeholder_image_src(),
				],
			]
		);

		$this->add_group_control(
			Group_Control_Image_Size::get_type(),
			[
				'name'      => 'ut_thumbnail',
				'default'   => 'full',
				'condition' => [
					'ut_image_before[url]!' => ''
				]
			]
		);

		$this->add_control(
			'ut_img_comparison_after_heading_section',
			[
				'label' => esc_html__( 'After', 'ut-elementor-addons-lite' ),
				'type' => Controls_Manager::HEADING,
				'default' => 'Before',
			]
		);

		$this->add_control(
			'ut_image_after',
			[
				'label'   => esc_html__( 'Choose Image', 'ut-elementor-addons-lite' ),
				'type'    => Controls_Manager::MEDIA,
				'default' => [
					'url' => \Elementor\Utils::get_placeholder_image_src(),
				],
			]
		);

		$this->add_group_control(
			Group_Control_Image_Size::get_type(),
			[
				'name'      => 'ut_thumbnail_two',
				'default'   => 'full',
				'condition' => [
					'ut_image_after[url]!' => ''
				]
			]
		);

		$this->end_controls_section();
		
		$this->start_controls_section(  
			'ut_setting_detail',
			[ 
				'label' => esc_html__( 'Settings', 'ut-elementor-addons-lite' ),
			]
		);

		$this->add_control(
			'ut_img_comparison_offset',
			[
				'label' => esc_html__('Offset', 'ut-elementor-addons-lite'),
				'type' => \Elementor\Controls_Manager::SELECT,
				'default' => '0.5',
				'options' => [
					'0.0' =>'0',
					'0.1' =>'1',
					'0.2' =>'2',
					'0.3' =>'3',
					'0.4' =>'4',
					'0.5' =>'5',
					'0.6' =>'6',
					'0.7' =>'7',
					'0.8' =>'8',
					'0.9' =>'9',
					'1.0' =>'10',
				]
			]
		);
		
		$this->add_control(
			'ut_orientation',
			[
				'label' => esc_html__( 'Handle Bar Type', 'ut-elementor-addons-lite' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'default' => 'horizontal',
				'options' => [
					'horizontal'  => esc_html__( 'Horizontal', 'ut-elementor-addons-lite' ),
					'vertical' => esc_html__( 'Vertical', 'ut-elementor-addons-lite' ),
				]
			]
		);

		$this->add_control(
			'ut_overlay_enable',
			[
				'label'        => esc_html__( 'Enable Overlay On Hover', 'ut-elementor-addons-lite' ),
				'type'         => Controls_Manager::SWITCHER,
				'default'      => 'off',
				'label_on'     => esc_html__( 'On', 'ut-elementor-addons-lite' ),
				'label_off'    => esc_html__( 'Off', 'ut-elementor-addons-lite' ),
				'return_value' => 'on'
			]
		);

		$this->add_control(
			'ut_overlay_color',
			[
				'label'     => esc_html__( 'Overlay Color', 'ut-elementor-addons-lite' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => 'rgba(0,0,0,0.5)',
				'condition' => [
					'ut_overlay_enable' => 'on'
				],
				'selectors' => [
					'{{WRAPPER}} .ut-image-comparision .twentytwenty-overlay:hover' => 'background-color: {{VALUE}};'
				]
			]
		);

		$this->add_control(
			'ut_before_title',
			[
				'label' => esc_html__( 'Overlay Before Text(On Hover)', 'ut-elementor-addons-lite' ),
				'type' => Controls_Manager::TEXT,
				'default'   => esc_html__('Before'),
				'condition' => [
					'ut_overlay_enable' => 'on'
				]
			]
		);

		$this->add_control(
			'ut_after_title',
			[
				'label' => esc_html__( 'Overlay After Text(On Hover)', 'ut-elementor-addons-lite' ),
				'type' => Controls_Manager::TEXT,
				'default'   => esc_html__('After'),
				'condition' => [
					'ut_overlay_enable' => 'on'
				]
			]
		);

		$this->add_control(
			'ut_move_slider',
			[
				'label' => esc_html__( 'Move Slider', 'ut-elementor-addons-lite' ),
				'type' => Controls_Manager::SELECT,
				'default' => 'move_with_handle_only',
				'options' => [
					'move_slider_on_hover'  => esc_html__( 'Move Slider On Hover', 'ut-elementor-addons-lite' ),
					'move_with_handle_only' => esc_html__( 'Move With Handle Only', 'ut-elementor-addons-lite' ),
					'click_to_move' => esc_html__( 'Click To Move', 'ut-elementor-addons-lite' ),
				],
			]
		);
		
		$this->end_controls_section();

		$this->start_controls_section(
			'ut_section_image_comparision_styles_presets',
			[
				'label' => esc_html__( 'Container', 'ut-elementor-addons-lite' ),
				'tab'   => Controls_Manager::TAB_STYLE
			]
		);


		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name'     => 'ut_img_comparison_border',
				'selector' => '{{WRAPPER}} .ut-image-comparision'
			]
		);


		$this->add_responsive_control(
			'ut_img_comparison_border_radius',
			[
				'label'        => esc_html__( 'Border Radius', 'ut-elementor-addons-lite' ),
				'type'         => Controls_Manager::DIMENSIONS,
				'size_units'   => [ 'px', '%' ],
				'default'      => [
					'top'      => '',
					'right'    => '',
					'bottom'   => '',
					'left'     => '',
					'isLinked' => true
				],
				'selectors'    => [
					'{{WRAPPER}} .ut-image-comparision' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
				]
			]
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name'     => 'ut_image_comparison_box_shadow',
				'selector' => '{{WRAPPER}} .ut-image-comparision'
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'ut_image_comparison_handler',
			[
				'label' => esc_html__( 'Handler', 'ut-elementor-addons-lite' ),
				'tab'   => Controls_Manager::TAB_STYLE
			]
		);

		$handel_bar = is_rtl() ? 'right' : 'left';
		$handel_revers = is_rtl() ? 'left' : 'right';

		$this->add_responsive_control(
			'ut_image_comparison_handler_width',
			[
				'label' => esc_html__( 'Width', 'ut-elementor-addons-lite' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px', '%' ],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'default' => [
					'unit' => 'px',
					'size' => 38,
				],
				'selectors' => [
					'{{WRAPPER}} .ut-image-comparision .twentytwenty-handle' => 'width: {{SIZE}}{{UNIT}}; margin-left: calc( -{{SIZE}}{{UNIT}} / 2 - {{ut_image_comparison_handler_border.size}}{{ut_image_comparison_handler_border.unit}} )',
					'{{WRAPPER}} .ut-image-comparision .twentytwenty-vertical .twentytwenty-handle:before' => 'margin-'. $handel_bar .': calc( {{SIZE}}{{UNIT}} / 2 + {{ut_image_comparison_handler_border.size}}{{ut_image_comparison_handler_border.unit}} );',
					'{{WRAPPER}} .ut-image-comparision .twentytwenty-vertical .twentytwenty-handle:after' => 'margin-'. $handel_revers .': calc( calc( {{SIZE}}{{UNIT}} ) / 2  + {{ut_image_comparison_handler_border.size}}{{ut_image_comparison_handler_border.unit}} );',
				],
			]
		);

		if ( is_rtl() ) {
			$this->add_responsive_control(
				'ut_image_comparison_handler_width_rtl',
				[
					'label' => esc_html__( 'Width', 'ut-elementor-addons-lite' ),
					'type' => Controls_Manager::SLIDER,
					'size_units' => [ 'px', '%' ],
					'range' => [
						'px' => [
							'min' => 0,
							'max' => 100,
						],
					],
					'default' => [
						'unit' => 'px',
						'size' => 38,
					],
					'selectors' => [
						'{{WRAPPER}} .ut-image-comparision .twentytwenty-handle' => 'width: {{SIZE}}{{UNIT}}; margin-left: calc( -{{SIZE}}{{UNIT}} / 2 - {{ut_image_comparison_handler_border.size}}{{ut_image_comparison_handler_border.unit}} )',
						'{{WRAPPER}} .ut-image-comparision .twentytwenty-vertical .twentytwenty-handle:before' => 'margin-'. $handel_bar .': calc( {{SIZE}}{{UNIT}} / 2 + {{ut_image_comparison_handler_border.size}}{{ut_image_comparison_handler_border.unit}} );',
						'{{WRAPPER}} .ut-image-comparision .twentytwenty-vertical .twentytwenty-handle:after' => 'margin-'. $handel_revers .': calc( calc( {{SIZE}}{{UNIT}} * 2 ) / 2  + {{ut_image_comparison_handler_border.size}}{{ut_image_comparison_handler_border.unit}} );',
					],
				]
			);
		}

		$this->add_responsive_control(
			'ut_image_comparison_handler_height',
			[
				'label' => esc_html__( 'Height', 'ut-elementor-addons-lite' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px', '%' ],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'default' => [
					'unit' => 'px',
					'size' => 38,
				],
				'selectors' => [
					'{{WRAPPER}} .ut-image-comparision .twentytwenty-handle' => 'height: {{SIZE}}{{UNIT}}; margin-top: calc( -{{SIZE}}{{UNIT}} / 2 - {{ut_image_comparison_handler_border.size}}{{ut_image_comparison_handler_border.unit}} );',
					'{{WRAPPER}} .ut-image-comparision .twentytwenty-horizontal .twentytwenty-handle:before' => 'margin-bottom: calc( {{SIZE}}{{UNIT}} / 2 + {{ut_image_comparison_handler_border.size}}{{ut_image_comparison_handler_border.unit}} );',
					'{{WRAPPER}} .ut-image-comparision .twentytwenty-horizontal .twentytwenty-handle:after' => 'margin-top: calc( {{SIZE}}{{UNIT}} / 2 + {{ut_image_comparison_handler_border.size}}{{ut_image_comparison_handler_border.unit}} );',
				],
			]
		);

		$this->add_control(
			'ut_image_comparison_handler_background',
			[
				'label' => esc_html__( 'Handler Background', 'ut-elementor-addons-lite' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .ut-image-comparision .twentytwenty-handle' => 'background: {{VALUE}}',
				],
			]
		);

		$this->add_control(
			'ut_image_comparison_handler_bar_color',
			[
				'label' => esc_html__( 'Handler Bar Color', 'ut-elementor-addons-lite' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .ut-image-comparision .twentytwenty-handle:before,{{WRAPPER}} .twentytwenty-handle:after' => 'background: {{VALUE}}',
				],
			]
		);

		$this->add_control(
			'ut_image_comparison_handler_border_color',
			[
				'label' => esc_html__( 'Handler Border Color', 'ut-elementor-addons-lite' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .ut-image-comparision .twentytwenty-handle' => 'border-color: {{VALUE}}',
				],
			]
		);

		$this->add_control(
			'ut_image_comparison_handler_icon_color',
			[
				'label' => esc_html__( 'Handler Icon Color', 'ut-elementor-addons-lite' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .ut-image-comparision .twentytwenty-vertical .twentytwenty-up-arrow' => 'border-bottom-color: {{VALUE}}',
					'{{WRAPPER}} .ut-image-comparision .twentytwenty-horizontal .twentytwenty-right-arrow' => 'border-left-color: {{VALUE}}',
					'{{WRAPPER}} .ut-image-comparision .twentytwenty-vertical .twentytwenty-down-arrow' => 'border-top-color: {{VALUE}}',
					'{{WRAPPER}} .ut-image-comparision .twentytwenty-horizontal .twentytwenty-left-arrow' => 'border-right-color: {{VALUE}}'
				],
			]
		);

		$this->add_responsive_control(
			'ut_image_comparison_handler_border',
			[
				'label' => esc_html__( 'Handler Border', 'ut-elementor-addons-lite' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px' ],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 10,
					],
				],
				'default' => [
					'unit' => 'px',
					'size' => 3,
				],
				'selectors' => [
					'{{WRAPPER}} .ut-image-comparision .twentytwenty-handle' => 'border-width: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .ut-image-comparision .twentytwenty-vertical .twentytwenty-handle:before, 
					{{WRAPPER}} .ut-image-comparision .twentytwenty-vertical .twentytwenty-handle:after' => 'height: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .ut-image-comparision .twentytwenty-horizontal .twentytwenty-handle:before, 
					{{WRAPPER}} .ut-image-comparision .twentytwenty-horizontal .twentytwenty-handle:after' => 'width: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'ut_image_comparison_handler_radius',
			[
				'label' => esc_html__( 'Radius', 'ut-elementor-addons-lite' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%' ],
				'selectors' => [
					'{{WRAPPER}} .ut-image-comparision .twentytwenty-handle' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'ut_image_comparison_label',
			[
				'label' => esc_html__( 'Label', 'ut-elementor-addons-lite' ),
				'tab'   => Controls_Manager::TAB_STYLE,
				'condition' => [
					'ut_overlay_enable' => 'on'
				]
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'ut_image_comparison_label_typography',
				'label' => __( 'Typography', 'ut-elementor-addons-lite' ),
				'selector' => '{{WRAPPER}} .ut-image-comparision .twentytwenty-before-label:before, {{WRAPPER}} .ut-image-comparision .twentytwenty-after-label:before',
			]
		);

		$this->add_control(
			'ut_image_comparison_label_background',
			[
				'label' => esc_html__( 'Background Color', 'ut-elementor-addons-lite' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .ut-image-comparision .twentytwenty-before-label:before,
					{{WRAPPER}} .ut-image-comparision .twentytwenty-after-label:before' => 'background: {{VALUE}}',
				],
			]
		);

		$this->add_control(
			'ut_image_comparison_label_text_color',
			[
				'label' => esc_html__( 'Text Color', 'ut-elementor-addons-lite' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .ut-image-comparision .twentytwenty-before-label:before,
					{{WRAPPER}} .ut-image-comparision .twentytwenty-after-label:before' => 'color: {{VALUE}}',
				],
			]
		);

		$this->add_responsive_control(
			'ut_image_comparison_label_padding',
			[
				'label' => esc_html__( 'Padding', 'ut-elementor-addons-lite' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%' ],
				'selectors' => [
					'{{WRAPPER}} .ut-image-comparision .twentytwenty-before-label:before,
					{{WRAPPER}} .ut-image-comparision .twentytwenty-after-label:before' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' => 'ut_image_comparison_label_border',
				'label' => esc_html__( 'Border', 'ut-elementor-addons-lite' ),
				'selector' => '{{WRAPPER}} .ut-image-comparision .twentytwenty-before-label:before, {{WRAPPER}} .ut-image-comparision .twentytwenty-after-label:before',
			]
		);

		$this->add_responsive_control(
			'ut_image_comparison_label_border_radius',
			[
				'label' => esc_html__( 'Border radius', 'ut-elementor-addons-lite' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%' ],
				'selectors' => [
					'{{WRAPPER}} .ut-image-comparision .twentytwenty-before-label:before,
					{{WRAPPER}} .ut-image-comparision .twentytwenty-after-label:before' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->end_controls_section();

	}
	protected function render() {
		$settings = $this->get_settings_for_display();
		$ut_move_slider = isset( $settings[ 'ut_move_slider' ] ) ? $settings[ 'ut_move_slider' ] : 'move_with_handle_only';
		$ut_overlay_enable = isset( $settings[ 'ut_overlay_enable' ] ) ? $settings[ 'ut_overlay_enable' ] : 'off';
		$this->add_render_attribute( 'utal-image-comparision', [
			'data-ut_before_title'       => esc_attr( $settings['ut_before_title'] ),
			'data-ut_after_title'        => esc_attr( $settings['ut_after_title'] ),
			'data-ut_img_comparison_offset' => esc_attr( $settings['ut_img_comparison_offset'] ),
			'data-ut_orientation'        => esc_attr( $settings['ut_orientation'] )
		]); 

		if ( 'on' !== $ut_overlay_enable ) {
			$this->add_render_attribute( 'utal-image-comparision', 'data-no_overlay', true );
		}

		if ( 'move_slider_on_hover' == $ut_move_slider ) {
			$this->add_render_attribute( 'utal-image-comparision', 'data-move_slider_on_hover', true );
		}
		if ( 'move_with_handle_only' == $ut_move_slider ) {
			$this->add_render_attribute( 'utal-image-comparision', 'data-move_with_handle_only', true );
		}
		if ( 'click_to_move' == $ut_move_slider ) {
			$this->add_render_attribute( 'utal-image-comparision', 'data-click_to_move', true );
		}

		?>
		<div class="ut-image-comparision" <?php echo $this->get_render_attribute_string('utal-image-comparision'); ?>>
			<div class="twentytwenty">
				<?php echo Group_Control_Image_Size::get_attachment_image_html( $settings, 'ut_thumbnail', 'ut_image_before' ); ?>
				<?php echo Group_Control_Image_Size::get_attachment_image_html( $settings, 'ut_thumbnail_two', 'ut_image_after' ); ?>
			</div>
		</div>  
		<?php 	
	}
}
Plugin::instance()->widgets_manager->register_widget_type(new UT_Elementor_Addons_Lite_Widget_Image());
