<?php
namespace Elementor;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Box_Shadow;

if ( ! defined( 'ABSPATH' ) ) exit; 

class UT_Elementor_Addons_Lite_Widget_Site_Logo extends Widget_Base {

	public function get_name() {
		return 'utal-site-logo';
	}

	public function get_title() {
		return esc_html__( 'Site Logo', 'ut-elementor-addons-lite' );
	}

	public function get_icon() {
		return 'eicon-image ut-widget-icon';
	}

	public function get_categories() {
		return [ 'ut-elementor-addons-lite' ];
	}

	protected function register_controls() {

		$this->start_controls_section(
			'ut_section_content',
			[
				'label' => esc_html__( 'General', 'ut-elementor-addons-lite' ),
			]
		);

		$this->add_control(
			'ut_preview',
			[
				'type' => Controls_Manager::RAW_HTML,
				'raw' => '<center style="background: #f5f5f5;">' . $this->ut_preview_logo() . '</center>',
			]
		);

		$this->add_control(
			'ut_html_tag',
			[
				'label' => esc_html__( 'HTML Tag', 'ut-elementor-addons-lite' ),
				'type' => Controls_Manager::SELECT,
				'options' => [
					'h1' => 'H1',
					'h2' => 'H2',
					'h3' => 'H3',
					'h4' => 'H4',
					'h5' => 'H5',
					'h6' => 'H6',
					'p' => 'p',
					'div' => 'div',
					'span' => 'span',
				],
				'default' => 'div',
			]
		);

		$this->add_responsive_control(
			'ut_sitelogo_alignment',
			[
				'label' => esc_html__( 'Alignment', 'ut-elementor-addons-lite' ),
				'type' => Controls_Manager::CHOOSE,
				'options' => [
					'left' => [
						'title' => esc_html__( 'Left', 'ut-elementor-addons-lite' ),
						'icon' => 'eicon-text-align-left', 
					],
					'center' => [
						'title' => esc_html__( 'Center', 'ut-elementor-addons-lite' ),
						'icon' => 'eicon-text-align-center', 
					],
					'right' => [
						'title' => esc_html__( 'Right', 'ut-elementor-addons-lite' ),
						'icon' => 'eicon-text-align-right', 
					],
					'justify' => [
						'title' => esc_html__( 'Justified', 'ut-elementor-addons-lite' ),
						'icon' => 'eicon-text-align-justify', 
					],
				],
				'selectors' => [
					'{{WRAPPER}}' => 'text-align: {{VALUE}};',
				],
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'ut_section_style',
			[
				'label' => esc_html__( 'General', 'ut-elementor-addons-lite' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_responsive_control(
			'ut_site_logo_width',
			[
				'label' => esc_html__( 'Width', 'ut-elementor-addons-lite' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ '%', 'px', 'rem' ], 
				'range' => [
					'%' => [
						'min' => 1,
						'max' => 100,
					],
					'px' => [
						'min' => 1,
						'max' => 1000,
					],
					'rem' => [
						'min' => 0.1,
						'max' => 10, 
					],
				],
				'selectors' => [
					'{{WRAPPER}} .ut-site-logo img' => 'width: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'ut_site_logo_max_width',
			[
				'label' => esc_html__( 'Max Width', 'ut-elementor-addons-lite' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ '%', 'px', 'rem' ], 
				'range' => [
					'%' => [
						'min' => 1,
						'max' => 100,
					],
					'px' => [
						'min' => 1,
						'max' => 1000, 
					],
					'rem' => [
						'min' => 0.1,
						'max' => 10, 
					],
				],
				'selectors' => [
					'{{WRAPPER}} .ut-site-logo img' => 'max-width: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			'ut_opacity',
			[
				'label' => esc_html__( 'Opacity (%)', 'ut-elementor-addons-lite' ),
				'type' => Controls_Manager::SLIDER,
				'default' => [
					'size' => 1,
				],
				'range' => [
					'px' => [
						'max' => 1,
						'min' => 0.10,
						'step' => 0.01,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .ut-site-logo img' => 'opacity: {{SIZE}};',
				],
			]
		);

		$this->add_control(
			'ut_angle',
			[
				'label' => esc_html__( 'Angle (deg)', 'ut-elementor-addons-lite' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'deg' ],
				'default' => [
					'unit' => 'deg',
					'size' => 0,
				],
				'range' => [
					'deg' => [
						'max' => 360,
						'min' => -360,
						'step' => 1,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .ut-site-logo img' => '-webkit-transform: rotate({{SIZE}}deg); -moz-transform: rotate({{SIZE}}deg); -ms-transform: rotate({{SIZE}}deg); -o-transform: rotate({{SIZE}}deg); transform: rotate({{SIZE}}deg);',
				],
			]
		);

		$this->add_control(
			'ut_hover_animation',
			[
				'label' => esc_html__( 'Hover Animation', 'ut-elementor-addons-lite' ),
				'type' => Controls_Manager::HOVER_ANIMATION,
			]
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' => 'ut_image_border',
				'label' => esc_html__( 'Image Border', 'ut-elementor-addons-lite' ),
				'selector' => '{{WRAPPER}} .ut-site-logo img',
			]
		);

		$this->add_control(
			'ut_image_border_radius',
			[
				'label' => esc_html__( 'Border Radius', 'ut-elementor-addons-lite' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%' ],
				'selectors' => [
					'{{WRAPPER}} .ut-site-logo img' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'ut_image_box_shadow',
				'selector' => '{{WRAPPER}} .ut-site-logo img',
			]
		);

		$this->end_controls_section();

	}

	protected function render() {
		$settings = $this->get_settings();
		$custom_logo_id = get_theme_mod( 'custom_logo' );
		$logo = $custom_logo_id ? wp_get_attachment_image( $custom_logo_id , 'full' ) : '';
		if ( empty( $logo ) )
			return;
		$link = esc_url( get_home_url() );
		$animation_class = ! empty( $settings['ut_hover_animation'] ) ? 'elementor-animation-' . $settings['ut_hover_animation'] : '';
		$html = sprintf( '<%1$s class="ut-site-logo utal %2$s">', $settings['ut_html_tag'], $animation_class );
		$html .= sprintf( '<a href="%1$s">%2$s</a>', $link, $logo );
		$html .= sprintf( '</%s>', $settings['ut_html_tag'] );
		echo $html;
	}

	public function ut_preview_logo() {
		$custom_logo_id = get_theme_mod( 'custom_logo' );
		$logo = $custom_logo_id ? wp_get_attachment_image( $custom_logo_id , 'full' ) : '';
		if ( empty( $logo ) )
			return;
		return $logo;	
	}

}

Plugin::instance()->widgets_manager->register_widget_type( new UT_Elementor_Addons_Lite_Widget_Site_Logo() );
