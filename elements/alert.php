<?php
namespace Elementor;   

if ( ! defined( 'ABSPATH' ) ) exit; 

class UT_Elementor_Addons_Lite_Widget_Alert extends Widget_Base {

	use \Elementor\UT_Elementor_Addons_Lite_Queries; 

	public function get_name() { 
		return 'utal-alert';
	} 

	public function get_title() {
		return  esc_html__( 'Alert Message', 'ut-elementor-addons-lite' );
	}

	public function get_icon() {
		return 'eicon-alert ut-widget-icon';
	} 

	public function get_categories() {
		return [ 'ut-elementor-addons-lite' ];
	}

	public function get_script_depends()
	{
		return [
			'ut-elementor-addons-lite-script',
		];
	}

	protected function register_controls() {

		$this->start_controls_section(
			'ut_contain_details',
			[
				'label' => esc_html__( 'General', 'ut-elementor-addons-lite' ),
				'tab'   => Controls_Manager::TAB_CONTENT,
			]
		);

		$this->add_control(
			'ut_alert_content_icon_show',
			[
				'label'        => esc_html__( 'Enable Icon', 'ut-elementor-addons-lite' ),
				'type'         => Controls_Manager::SWITCHER,
				'label_on'     => esc_html__( 'On', 'ut-elementor-addons-lite' ),
				'label_off'    => esc_html__( 'Off', 'ut-elementor-addons-lite' ),
				'default'      => 'yes',
				'return_value' => 'yes'
			]
		);

		$this->add_control(
			'ut_alert_content_icon',
			[
				'label'   => esc_html__( 'Icon', 'ut-elementor-addons-lite' ),
				'type'    => Controls_Manager::ICONS,
				'default' => [
					'value'   => 'fab fa-wordpress-simple',
					'library' => 'fa-brands'
				],
				'condition' => [
					'ut_alert_content_icon_show' => 'yes'
				]
			]
		);

		$this->add_control(
			'ut_alert_content_title_show',
			[
				'label'        => esc_html__( 'Enable Title', 'ut-elementor-addons-lite' ),
				'type'         => Controls_Manager::SWITCHER,
				'label_on'     => esc_html__( 'On', 'ut-elementor-addons-lite' ),
				'label_off'    => esc_html__( 'Off', 'ut-elementor-addons-lite' ),
				'default'      => 'no',
				'return_value' => 'yes'
			]
		);

		$this->add_control(
			'ut_alert_content_title',
			[
				'label'     => esc_html__( 'Title', 'ut-elementor-addons-lite' ),
				'type'      => Controls_Manager::TEXTAREA,
				'default'   => esc_html__( 'Well Done!', 'ut-elementor-addons-lite' ),
				'condition' => [
					'ut_alert_content_title_show' => 'yes'
				],
			]
		);

		$this->add_control(
			'ut_alert_content_description',
			[
				'label'   => esc_html__( 'Description', 'ut-elementor-addons-lite' ),
				'type'    => Controls_Manager::TEXTAREA,
				'default' => esc_html__( 'A simple alert—check it out!', 'ut-elementor-addons-lite' ),
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'ut_alert_style',
			[
				'label' => esc_html__( 'Container', 'ut-elementor-addons-lite' ),
				'tab'   => Controls_Manager::TAB_STYLE
			]
		);

		$this->add_control(
			'ut_alert_background_style',
			[
				'label'     => esc_html__( 'Background', 'ut-elementor-addons-lite' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#ECF9FD',
				'selectors' => [
					'{{WRAPPER}} .ut_alert_main_wrapper' => 'background: {{VALUE}};'
				]
			]
		);

		$this->add_responsive_control(
			'ut_alert_border_radius',
			[
				'label'     => esc_html__( 'Border Radius', 'ut-elementor-addons-lite' ),
				'type'      => Controls_Manager::DIMENSIONS,
				'selectors' => [
					'{{WRAPPER}} .ut_alert_main_wrapper'=> 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
				]
			]
		);

		$this->add_responsive_control(
			'ut_alert_padding',
			[
				'label'      => esc_html__( 'Padding', 'ut-elementor-addons-lite' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'default'    => [
					'top'    => '20',
					'right'  => '20',
					'bottom' => '20',
					'left'   => '20'
				],
				'selectors'  => [
					'{{WRAPPER}} .ut_alert_main_wrapper' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
				]
			]
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name'     => 'ut_alert_border',
				'selector' => '{{WRAPPER}} .ut_alert_main_wrapper'
			]
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name'     => 'ut_alert_box_shadow',
				'selector' => '{{WRAPPER}} .ut_alert_main_wrapper'
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'ut_alert_icon_style',
			[
				'label'     => esc_html__( 'Icon', 'ut-elementor-addons-lite' ),
				'tab'       => Controls_Manager::TAB_STYLE,
				'condition' => [
					'ut_alert_content_icon_show' => 'yes'
				]
			]
		);

		$this->add_responsive_control(
			'ut_alert_icon_size',
			[
				'label'        => esc_html__( 'Size', 'ut-elementor-addons-lite' ),
				'type'         => Controls_Manager::SLIDER,
				'range'        => [
					'px'       => [
						'min'  => 10,
						'max'  => 150,
						'step' => 2
					]
				],
				'default'      => [
					'unit'     => 'px',
					'size'     => 24
				],
				'selectors'    => [
					'{{WRAPPER}} .ut_alert_main_wrapper .ut_alert_icon' => 'font-size: {{SIZE}}px;'
				]
			]
		);

		$this->add_control(
			'ut_alert_icon_color',
			[
				'label'     => esc_html__( 'Color', 'ut-elementor-addons-lite' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#272727',
				'selectors' => [
					'{{WRAPPER}} .ut_alert_main_wrapper .ut_alert_icon' => 'color: {{VALUE}};'
				]
			]
		);

		$this->add_control(
			'ut_alert_icon_bg_color',
			[
				'label'     => esc_html__( 'Background Color', 'ut-elementor-addons-lite' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .ut_alert_main_wrapper .ut_alert_icon' => 'background-color: {{VALUE}};'
				]
			]
		);

		$this->add_responsive_control(
			'ut_alert_icon_padding',
			[
				'label'      => __('Padding', 'ut-elementor-addons-lite'),
				'type'       => Controls_Manager::DIMENSIONS,
				'selectors'  => [
					'{{WRAPPER}} .ut_alert_main_wrapper .ut_alert_icon' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
				]
			]
		);

		$this->add_responsive_control(
			'ut_alert_icon_border_radius',
			[
				'label'      => esc_html__( 'Border Radius', 'ut-elementor-addons-lite' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px'],
				'selectors'  => [
					'{{WRAPPER}} .ut_alert_main_wrapper .ut_alert_icon'=> 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
				]
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'ut_alert_title_style',
			[
				'label'     => esc_html__( 'Title', 'ut-elementor-addons-lite' ),
				'tab'       => Controls_Manager::TAB_STYLE,
				'condition' => [
					'ut_alert_content_title_show' => 'yes'
				]
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'ut_alert_title_typography',
				'selector' => '{{WRAPPER}} .ut_alert_title h6'
			]
		);

		$this->add_control(
			'ut_alert_title_color',
			[
				'label'     => esc_html__( 'Color', 'ut-elementor-addons-lite' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#272727',
				'selectors' => [
					'{{WRAPPER}} .ut_alert_title h6' => 'color: {{VALUE}};'
				]
			]
		);

		$this->add_responsive_control(
			'ut_alert_title_margin',
			[
				'label'      => esc_html__( 'Margin', 'ut-elementor-addons-lite' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%'],
				'selectors'  => [
					'{{WRAPPER}} .ut_alert_title h6' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
				]
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'ut_alert_description_style',
			[
				'label' => esc_html__( 'Description', 'ut-elementor-addons-lite' ),
				'tab'   => Controls_Manager::TAB_STYLE
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'ut_alert_description_typography',
				'selector' => '{{WRAPPER}} .ut_alert_description'
			]
		);

		$this->add_control(
			'ut_alert_description_color',
			[
				'label'     => esc_html__( 'Color', 'ut-elementor-addons-lite' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .ut_alert_description' => 'color: {{VALUE}};'
				]
			]
		);

		$this->add_responsive_control(
			'ut_alert_description_margin',
			[
				'label'      => esc_html__( 'Margin', 'ut-elementor-addons-lite' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%'],
				'selectors'  => [
					'{{WRAPPER}}  .ut_alert_description' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
				]
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'ut_close_icon_detail',
			[
				'label' => esc_html__( 'Close Icon', 'ut-elementor-addons-lite' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'ut_close_icon_color',
			[
				'label'     => esc_html__( 'Color', 'ut-elementor-addons-lite' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .ut_alert_main_wrapper .ut_alert_close_icon svg path' => 'fill: {{VALUE}};'
				]
			]
		);

		$this->add_responsive_control(
			'ut_alert_close_icon_size',
			[
				'label'     => esc_html__( 'Size', 'ut-elementor-addons-lite' ),
				'type'      => Controls_Manager::SLIDER,
				'range'     => [
					'px'    => [
						'min'   => 10,
						'max'   => 150,
						'step'  => 1
					]
				],
				'selectors' => [
					'{{WRAPPER}} .ut_alert_main_wrapper .ut_alert_close_icon svg' => 'width: {{SIZE}}px; height: {{SIZE}}px;',
				]
			]
		);


		$this->end_controls_section();

	} 

	protected function render() {
		$settings = $this->get_settings_for_display(); 
		$this->add_render_attribute('alert_wrapper', 'class', 'alert_wrapper');
		$ut_alert_content_icon_show = isset( $settings[ 'ut_alert_content_icon_show' ] ) ? $settings[ 'ut_alert_content_icon_show' ] : 'yes';
		$ut_alert_content_icon = isset( $settings[ 'ut_alert_content_icon' ] ) ? $settings[ 'ut_alert_content_icon' ] : '';
		$ut_alert_content_title = isset( $settings[ 'ut_alert_content_title' ] ) ? $settings[ 'ut_alert_content_title' ] : 'Well Done!';
		$ut_alert_content_title_show = isset( $settings[ 'ut_alert_content_title_show' ] ) ? $settings[ 'ut_alert_content_title_show' ] : 'no';
		$ut_alert_content_description = isset( $settings[ 'ut_alert_content_description' ] ) ? $settings[ 'ut_alert_content_description' ] : 'A simple alert—check it out!';
		?>

		<div class="ut_alert_main_wrapper">
			<div class="ut_alert_close_icon">
				<svg viewBox="0 0 16 16">
					<path fill-rule="evenodd" d="M2.343 15.071L.929 13.656 6.586 8 .929 2.343 2.343.929 8 6.585 13.657.929l1.414 1.414L9.414 8l5.657 5.656-1.414 1.415L8 9.414l-5.657 5.657z"></path>
				</svg>
			</div>
			<div class="ut_alert_content">	
				<?php
				if ( 'yes' == $ut_alert_content_icon_show && ! empty( $ut_alert_content_icon['value'] ) ) {
					?> 
					<div class="ut_alert_icon">
						<?php 
						Icons_Manager::render_icon( $ut_alert_content_icon, [ 'aria-hidden' => 'true' ] );
						?>
					</div>
				<?php } ?>
				<div class="ut_alert_title_description">
					<?php if ( 'yes' == $ut_alert_content_title_show ) { ?>
						<div class="ut_alert_title">
							<h6><?php echo esc_html( $ut_alert_content_title ); ?></h6>
						</div>
					<?php } ?>
					<?php if ( $ut_alert_content_description ) { ?>
						<div class="ut_alert_description">
							<?php echo esc_html( $ut_alert_content_description );  ?>
						</div>
					<?php } ?>	
				</div>
			</div>
		</div>

		<?php  
	}
}
Plugin::instance()->widgets_manager->register_widget_type( new UT_Elementor_Addons_Lite_Widget_Alert() );