<?php
namespace Elementor;   

if ( ! defined( 'ABSPATH' ) ) exit; 

class UT_Elementor_Addons_Lite_Widget_Fun_Fact extends Widget_Base {

	use \Elementor\UT_Elementor_Addons_Lite_Queries; 

	public function get_name() { 
		return 'utal-fun-fact';
	} 

	public function get_title() {
		return  esc_html__( 'Fun Fact', 'ut-elementor-addons-lite' );
	}

	public function get_icon() {
		return 'eicon-counter ut-widget-icon';
	} 

	public function get_categories() {
		return [ 'ut-elementor-addons-lite' ];
	}

	public function get_script_depends()
	{
		return [
			'ut-elementor-addons-lite-script'
		];
	}

	protected function register_controls(){

		$this->start_controls_section(
			'ut_contain_detail',
			[
				'label' => esc_html__( 'General', 'ut-elementor-addons-lite' ),
				'tab'   => Controls_Manager::TAB_CONTENT,
			]
		);

		$this->add_control(
			'ut_ff_icon',
			[
				'label' => esc_html__( 'Icon', 'ut-elementor-addons-lite' ),
				'type' => Controls_Manager::ICONS,
				'fa4compatibility' => 'ut_funfact_icon',
				'default' => [
					'value' => 'fab fa-wordpress-simple',
					'library' => 'fa-brands',
				],
			]
		); 

		$this->add_control(
			'ut_number_prefix',
			[
				'label' => esc_html__( 'Number Prefix', 'ut-elementor-addons-lite' ),
				'type' => Controls_Manager::TEXT,
				'default' => esc_html__( '$', 'ut-elementor-addons-lite' ),
				'placeholder' => esc_html__('$', 'ut-elementor-addons-lite'),
			]
		);

		$this->add_control(
			'ut_number',
			[
				'label' => esc_html__( 'Number', 'ut-elementor-addons-lite' ),
				'type' => Controls_Manager::NUMBER,
				'default' => '450',
				'label_block' => false,
			]
		);

		$this->add_control(
			'ut_number_suffix',
			[
				'label' => esc_html__( 'Number Suffix', 'ut-elementor-addons-lite' ),
				'type' => Controls_Manager::TEXT,
				'default' => esc_html__( 'M', 'ut-elementor-addons-lite' ),
				'placeholder' => esc_html__('M+', 'ut-elementor-addons-lite'),
			]
		);

		$this->add_control(
			'ut_ff_title',
			[
				'label' => esc_html__( 'Title', 'ut-elementor-addons-lite' ),
				'type' => Controls_Manager::TEXT,
				'default' => esc_html__('This is the heading', 'ut-elementor-addons-lite'),
				'label_block' => true,
			]
		);

		$this->add_control(
			'ut_hide_show',
			[
				'label' => esc_html__( 'Hide / Show', 'ut-elementor-addons-lite' ),
				'type' => Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);

		$this->add_responsive_control(
			'ut_icon',
			[
				'label'     => esc_html__( 'Hide Icon', 'ut-elementor-addons-lite' ),
				'type'      => Controls_Manager::SWITCHER,
				'selectors' => [
					'{{WRAPPER}} .funfact_main_list .funfact-icon' => 'display: none;',
				],
				'description' => esc_html__('Choose yes to hide image'),
			]
		);

		$this->add_responsive_control(
			'ut_hide_number',
			[
				'label'     => esc_html__( 'Hide Number Counter', 'ut-elementor-addons-lite' ),
				'type'      => Controls_Manager::SWITCHER,
				'selectors' => [
					'{{WRAPPER}} .funfact_main_list .prefix_counter_subfix' => 'display: none;',
				],
				'description' => esc_html__('Choose yes to hide number counter'),
			]
		);

		$this->add_responsive_control(
			'ut_title',
			[
				'label'     => esc_html__( 'Hide Title', 'ut-elementor-addons-lite' ),
				'type'      => Controls_Manager::SWITCHER,
				'selectors' => [
					'{{WRAPPER}} .funfact_main_wrapper .funfact_main_list .name_title' => 'display: none;',
				],
				'description' => esc_html__( 'Choose yes to hide title' ),
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'ut_funfact_section_style_icon',
			[
				'label'     => esc_html__( 'Icons', 'ut-elementor-addons-lite' ),
				'tab'       => Controls_Manager::TAB_STYLE,
			]
		);

		$this->start_controls_tabs( 'ut_icon_colors' );

		$this->start_controls_tab(
			'ut_funfact_icon_colors_normal',
			[
				'label' => esc_html__( 'Normal', 'ut-elementor-addons-lite' ),
			]
		);

		$this->add_responsive_control(
			'ut_funfact_icon_primary_color',
			[
				'label'     => esc_html__( 'Color', 'ut-elementor-addons-lite' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .funfact_main_list .funfact-icon i' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_responsive_control(
			'ut_funfact_icon_secondary_color_normal',
			[
				'label'     => esc_html__( 'Background Color', 'ut-elementor-addons-lite' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .funfact_main_list .funfact-icon i' => 'background-color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name'     => 'ut_funfact_border_group',
				'label'    => esc_html__( 'Border', 'ut-elementor-addons-lite' ),
				'selector' => '{{WRAPPER}} .funfact_main_list .funfact-icon i',
			]
		);

		$this->add_responsive_control(
			'ut_funfact_icon_border_radius',
			[
				'label'      => esc_html__( 'Border Radius', 'ut-elementor-addons-lite' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%'],
				'selectors'  => [
					'{{WRAPPER}} .funfact_main_list .funfact-icon i' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			'ut_funfact_icon_colors_hover',
			[
				'label' => esc_html__( 'Hover', 'ut-elementor-addons-lite' ),
			]
		);

		$this->add_responsive_control(
			'ut_funfact_hover_primary_color',
			[
				'label'     => esc_html__( 'Color', 'ut-elementor-addons-lite' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .funfact_main_list .funfact-icon i:hover' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_responsive_control(
			'ut_funfact_hover_secondary_color',
			[
				'label'     => esc_html__( 'Background Color', 'ut-elementor-addons-lite' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .funfact_main_list .funfact-icon i:hover' => 'background-color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name'      => 'ut_funfact_border_icon_group',
				'label'     => esc_html__( 'Border', 'ut-elementor-addons-lite' ),
				'selector'  => '{{WRAPPER}} .funfact_main_list .funfact-icon i:hover',
			]
		);

		$this->add_responsive_control(
			'ut_funfact_icon_hover_border_radius',
			[
				'label'      => esc_html__( 'Border Radius', 'ut-elementor-addons-lite' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%'],
				'selectors'  => [
					'{{WRAPPER}} .funfact_main_list .funfact-icon i:hover' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->end_controls_tab();

		$this->end_controls_tabs();

		$this->add_responsive_control(
			'ut_funfact_icon_size',
			[
				'label'     => esc_html__( 'Size', 'ut-elementor-addons-lite' ),
				'type'      => Controls_Manager::SLIDER,
				'range'     => [
					'px' => [
						'min' => 6,
						'max' => 300,
					],
				],
				'default'   => [
					'size' => 40,
					'unit' => 'px',
				],
				'selectors' => [
					'{{WRAPPER}} .funfact_main_list .funfact-icon i' => 'font-size: {{SIZE}}{{UNIT}};',
				],
				'separator' => 'before',
			]
		);

		$this->add_responsive_control(
			'ut_funfact_icon_space',
			[
				'label'     => esc_html__( 'Margin', 'ut-elementor-addons-lite' ),
				'type'      => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .funfact_main_list .funfact-icon i' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					'{{WRAPPER}} .funfact_main_list img.funfact_svg_icon' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'ut_funfact_icon_padding',
			[
				'label'     => esc_html__( 'Padding', 'ut-elementor-addons-lite' ),
				'type'      => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .funfact_main_list .funfact-icon i' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					'{{WRAPPER}} .funfact_main_list img.funfact_svg_icon' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[ 
				'name'     => 'ut_funfact_icon_box_shadow_group',
				'selector' => '{{WRAPPER}} .funfact_main_list .funfact-icon i',
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'ut_funfact_section_style_content',
			[
				'label' => esc_html__( 'Content', 'ut-elementor-addons-lite' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'ut_funfact_heading_number',
			[
				'label'     => esc_html__( 'Number Count', 'ut-elementor-addons-lite' ),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);

		$this->add_responsive_control(
			'ut_funfact_description_color',
			[
				'label'     => esc_html__( 'Number Color', 'ut-elementor-addons-lite' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .prefix_counter_subfix .count' => 'color: {{VALUE}};',
					'{{WRAPPER}} .prefix_counter_subfix .number_prefix' => 'color: {{VALUE}};',
					'{{WRAPPER}} .prefix_counter_subfix .number_suffix' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_responsive_control(
			'ut_funfact_number_count_top_space',
			[
				'label'     => esc_html__( 'Top Spacing', 'ut-elementor-addons-lite' ),
				'type'      => Controls_Manager::SLIDER,
				'range'     => [
					'px' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'default'    => [
					'unit' => 'px',
					'size' => 0,
				],
				'selectors' => [
					'{{WRAPPER}} .prefix_counter_subfix ' => 'margin-top: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'ut_funfact_number_count_bottom_space',
			[
				'label'     => esc_html__( 'Bottom Spacing', 'ut-elementor-addons-lite' ),
				'type'      => Controls_Manager::SLIDER,
				'range'     => [
					'px' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'default'    => [
					'unit' => 'px',
					'size' => 0,
				],
				'selectors' => [
					'{{WRAPPER}} .prefix_counter_subfix .count' => 'margin-bottom: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .prefix_counter_subfix .number_prefix' => 'margin-bottom: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .prefix_counter_subfix .number_suffix' => 'margin-bottom: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'ut_funfact_number_count_right_space',
			[
				'label'     => esc_html__( 'Right Spacing', 'ut-elementor-addons-lite' ),
				'type'      => Controls_Manager::SLIDER,
				'range'     => [
					'px' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .prefix_counter_subfix .count' => 'margin-right: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .prefix_counter_subfix .number_prefix' => 'margin-right: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .prefix_counter_subfix .number_suffix' => 'margin-right: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			'ut_funfact_heading_title',
			[
				'label'     => esc_html__( 'Title', 'ut-elementor-addons-lite' ),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);

		$this->add_responsive_control(
			'ut_funfact_title_color',
			[
				'label'     => esc_html__( 'Color', 'ut-elementor-addons-lite' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .funfact_main_wrapper .funfact_main_list .name_title' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'ut_funfact_super_typography',
				'label'    => esc_html__( 'Typography', 'ut-elementor-addons-lite' ),
				'selector' => '{{WRAPPER}} .funfact_main_list .name_title',
			]
		);

		$this->add_responsive_control(
			'ut_funfact_info_box_margin',
			[
				'label'      => esc_html__( 'Margin', 'ut-elementor-addons-lite' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%', 'em'],
				'selectors'  => [
					'{{WRAPPER}} .funfact_main_wrapper .funfact_main_list .name_title ' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'ut_funfact_section_style_wrapper',
			[
				'label'     => esc_html__( 'Background', 'ut-elementor-addons-lite' ),
				'tab'       => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_responsive_control(
			'ut_funfact_background_padding',
			[
				'label'      => esc_html__( 'Padding', 'ut-elementor-addons-lite' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%', 'em'],
				'selectors'  => [
					'{{WRAPPER}} .funfact_main_list' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->start_controls_tabs( 'funfact_wrapper' );

		$this->start_controls_tab(
			'ut_funfact_wrapper_normal',
			[
				'label' => esc_html__( 'Normal', 'ut-elementor-addons-lite' ),
			]
		);
		$this->add_responsive_control(
			'ut_funfact_primary_color_normal',
			[
				'label'     => esc_html__( 'Color', 'ut-elementor-addons-lite' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .funfact_main_list' => 'background: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[ 
				'name'     => 'ut_funfact_icon_box_shadow_groupe',
				'selector' => '{{WRAPPER}} .funfact_main_list',
			]
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			'ut_funfact_wrapper_hover',
			[
				'label' => esc_html__( 'Hover', 'ut-elementor-addons-lite' ),
			]
		);

		$this->add_responsive_control(
			'ut_funfact_primary_color_hover',
			[
				'label'     => esc_html__( 'Color', 'ut-elementor-addons-lite' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => [
					'{{WRAPPER}} .funfact_main_list:hover' => 'background: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[ 
				'name'     => 'ut_funfact_icon_box_shadow_hover',
				'selector' => '{{WRAPPER}} .funfact_main_list:hover',
			]
		);

		$this->end_controls_tabs();

		$this->end_controls_tab();

		$this->end_controls_section();

	}

	protected function render() {
		$settings = $this->get_settings();
		$ut_ff_icon = isset( $settings['ut_ff_icon'] ) ? $settings['ut_ff_icon'] : '';
		$ut_number_prefix = isset( $settings['ut_number_prefix'] ) ? $settings['ut_number_prefix'] : '$';
		$ut_number = isset( $settings['ut_number'] ) ? $settings['ut_number'] : '450';
		$ut_number_suffix = isset( $settings['ut_number_suffix'] ) ? $settings['ut_number_suffix'] : 'M';
		$ut_ff_title = isset( $settings['ut_ff_title'] ) ? $settings['ut_ff_title'] : 'This is the heading';
		$this->add_render_attribute('funfact_wrapper', 'class', 'funfact_wrapper');
		?>

		<div class="funfact_main_wrapper">
			<div class="funfact_main_list">
				<div class="funfact-icon">
					<?php if ( isset( $ut_ff_icon['value']['url'] ) ) { ?>
						<img class="funfact_svg_icon" src="<?php echo esc_attr( $ut_ff_icon['value']['url'] ); ?>" alt="<?php echo esc_attr( get_post_meta( $ut_ff_icon['value']['id'], '_wp_attachment_image_alt', true ) ); ?>" />
					<?php } else { ?>
						<i class="<?php echo esc_attr( $ut_ff_icon['value'] ); ?>"></i>
					<?php } ?>
				</div>

				<div class="prefix_counter_subfix">
					<?php if ( $ut_number_prefix ) { ?>
						<div class="number_prefix">
							<?php echo esc_html( $ut_number_prefix ); ?>
						</div>
					<?php } ?>
					<?php if ( $ut_number ) { ?>
						<div class="number-counter"> 
							<span class="count">
								<?php echo esc_attr( $ut_number ); ?>
							</span>
						</div>
					<?php } ?>
					<?php if ( $ut_number_suffix ) { ?>
						<div class="number_suffix">
							<?php echo esc_html( $ut_number_suffix ); ?>
						</div>
					<?php } ?>
				</div>
				<?php if ( $ut_ff_title ) { ?>
					<div class="name_title">
						<?php echo esc_html( $ut_ff_title ); ?>
					</div>
				<?php } ?>
			</div>
		</div>

		<?php  
	}
}
Plugin::instance()->widgets_manager->register_widget_type( new UT_Elementor_Addons_Lite_Widget_Fun_Fact() );