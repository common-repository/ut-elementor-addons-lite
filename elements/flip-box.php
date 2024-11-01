<?php

namespace  Elementor;

if ( ! defined( 'ABSPATH' ) ) exit; 

class UT_Elementor_Addons_Lite_Widget_Blog_Flip_Box extends Widget_Base
{

	public function get_name()
	{
		return 'utal-flip-box';
	}

	public function get_title()
	{
		return esc_html__( 'Flip Box', 'ut-elementor-addons-lite' );
	}

	public function get_icon()
	{
		return 'eicon-flip-box ut-widget-icon';
	}

	public function get_categories()
	{
		return ['ut-elementor-addons-lite'];
	}

	protected function register_controls()
	{

		$this->start_controls_section(
			'ut_section_flipbox_content_settings',
			[
				'label' => esc_html__( 'Flipbox Settings', 'ut-elementor-addons-lite' ),
			]
		);

		$this->add_control(
			'ut_flipbox_type',
			[
				'label'       	=> esc_html__( 'Flipbox Type', 'ut-elementor-addons-lite' ),
				'type' 			=> Controls_Manager::SELECT,
				'default' 		=> 'animate-left',
				'label_block' 	=> false,
				'options' 		=> [
					'animate-left'  		=> esc_html__( 'Flip Left', 'ut-elementor-addons-lite' ),
					'animate-right' 		=> esc_html__( 'Flip Right', 'ut-elementor-addons-lite' ),
					'animate-up' 			=> esc_html__( 'Flip Top', 'ut-elementor-addons-lite' ),
					'animate-down' 		=> esc_html__( 'Flip Bottom', 'ut-elementor-addons-lite' ),
					'animate-zoom-in' 	=> esc_html__( 'Zoom In', 'ut-elementor-addons-lite' ),
					'animate-zoom-out' 	=> esc_html__( 'Zoom Out', 'ut-elementor-addons-lite' ),
				],
			]
		);

		$this->add_control(
			'ut_flipbox_setting_heading',
			[
				'label' => esc_html__( 'Alignment', 'ut-elementor-addons-lite' ),
				'type' => Controls_Manager::HEADING,
				'divider' => 'before'
			]
		);

		$this->add_control(
			'ut_flipbox_setting_contentv_align',
			[
				'label' => esc_html__( 'Vertical Alignment ', 'ut-elementor-addons-lite' ),
				'type' => Controls_Manager::CHOOSE,
				'default'       => 'v-align-middle',
				'options' => [
					'v-align-top' => [
						'title' => esc_html__( 'Top', 'ut-elementor-addons-lite' ),
						'icon' => 'eicon-v-align-top',
					],
					'v-align-middle' => [
						'title' => esc_html__( 'Middle', 'ut-elementor-addons-lite' ),
						'icon' => 'eicon-v-align-middle',
					],
					'v-align-bottom' => [
						'title' => esc_html__( 'Bottom', 'ut-elementor-addons-lite' ),
						'icon' => 'eicon-v-align-bottom',
					],
				],
				'toggle' => true,
			]
		);

		$this->add_control(
			'ut_flipbox_icon_front_alignment', 
			[
				'label' => esc_html__( 'Horizontal Alignment', 'ut-elementor-addons-lite' ),
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
					'{{WRAPPER}} .ut-elements-flip-box-front-container .ut-elements-flip-inner-container' => 'justify-content: {{VALUE}};',
					'{{WRAPPER}} .ut-elements-flip-box-rear-container .ut-elements-flip-inner-container' => 'justify-content: {{VALUE}};',
				],
				'separator'	=> 'after',
			]
		);

		$this->add_control(
			'ut_flipbox_height',
			[
				'label' => esc_html__( 'Height', 'ut-elementor-addons-lite' ),
				'type' => Controls_Manager::SLIDER,
				'size_units'	=> ['px', '%'],
				'range' => [
					'px' => [
						'min'	=> 0,
						'step'	=> 1,
						'max'	=> 600,
					],
					'%'	=> [
						'min'	=> 0,
						'step'	=> 3,
						'max'	=> 100
					]
				],
				'selectors' => [
					'{{WRAPPER}} .ut-elements-flip-box-container'	=> 'height: {{SIZE}}{{UNIT}};'
				]
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'ut_flipbox_content',
			[
				'label' => esc_html__( 'Flipbox Content', 'ut-elementor-addons-lite' ),
			]
		);

		$this->add_control(
			'ut_flipbox_setting_contenth_align',
			[
				'label' => esc_html__( 'Box Content Alignment', 'ut-elementor-addons-lite' ),
				'type' => Controls_Manager::CHOOSE,
				'default'       => 'h-align-middle',
				'options' => [
					'h-align-left' => [
						'title' => esc_html__( 'Left', 'ut-elementor-addons-lite' ),
						'icon' => 'eicon-h-align-left',
					],
					'h-align-middle' => [
						'title' => esc_html__( 'Middle', 'ut-elementor-addons-lite' ),
						'icon' => 'eicon-v-align-middle',
					],
					'h-align-right' => [
						'title' => esc_html__( 'Right', 'ut-elementor-addons-lite' ),
						'icon' => 'eicon-h-align-right',
					],
				],
				'toggle' => true,
			]
		);

		$this->start_controls_tabs( 'ut_flipbox_content_tabs' );

		$this->start_controls_tab(
			'ut_flipbox_content_front',
			[
				'label'	=> esc_html__( 'Front', 'ut-elementor-addons-lite' ),
			]
		);

		$this->add_control(
			'ut_flipbox_front_content_head',
			[
				'label' => esc_html__( 'Front', 'ut-elementor-addons-lite' ),
				'type' => Controls_Manager::HEADING,
			]
		);

		$this->add_control(
			'ut_flipbox_img_or_icon',
			[
				'label' => esc_html__( 'Type', 'ut-elementor-addons-lite' ),
				'type' => Controls_Manager::SELECT,
				'options' => [
					'none'	=> esc_html__( 'None', 'ut-elementor-addons-lite' ),
					'img'	=> esc_html__( 'Image', 'ut-elementor-addons-lite' ),
					'icon'	=> esc_html__( 'Icon', 'ut-elementor-addons-lite' )
				],
				'default' => 'icon',
			]
		);

		$this->add_control(
			'ut_flipbox_image',
			[
				'label' => esc_html__( 'Image', 'ut-elementor-addons-lite' ),
				'type' => Controls_Manager::MEDIA,
				'default' => [
					'url' => Utils::get_placeholder_image_src(),
				],
				'condition' => [
					'ut_flipbox_img_or_icon' => 'img'
				]
			]
		);

		$this->add_control(
			'ut_flipbox_icon_new',
			[
				'label' => esc_html__( 'Icon', 'ut-elementor-addons-lite' ),
				'type' => Controls_Manager::ICONS,
				'fa4compatibility' => 'ut_flipbox_icon',
				'default' => [
					'value' => 'fas fa-snowflake',
					'library' => 'fa-solid',
				],
				'condition' => [
					'ut_flipbox_img_or_icon' => 'icon'
				]
			]
		);

		$this->add_responsive_control(
			'ut_flipbox_image_resizer',
			[
				'label' => esc_html__( 'Image Resizer', 'ut-elementor-addons-lite' ),
				'type' => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'max' => 500,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .ut-elements-flip-box-front-container .ut-elements-flip-box-icon-image > img.ut-flipbox-image-as-icon' => 'width: {{SIZE}}{{UNIT}};'
				],
				'condition'	=> [
					'ut_flipbox_img_or_icon' => 'img'
				]
			]
		);

		$this->add_group_control(
			Group_Control_Image_Size::get_type(),
			[
				'name' => 'thumbnail',
				'default' => 'thumbnail',
				'condition' => [
					'ut_flipbox_image[url]!' => '',
					'ut_flipbox_img_or_icon'	=> 'img'
				],
			]
		);

		$this->add_control(
			'ut_flipbox_front_title',
			[
				'label' => esc_html__( 'Title', 'ut-elementor-addons-lite' ),
				'type' => Controls_Manager::TEXT,
				'label_block' => true,
				'default' => esc_html__('Front Title', 'ut-elementor-addons-lite'),
			]
		);

		$this->add_control(
			'ut_flipbox_front_text',
			[
				'label' => esc_html__( 'Content', 'ut-elementor-addons-lite' ),
				'type' => Controls_Manager::WYSIWYG,
				'label_block' => true,
				'default' => esc_html__( 'This is front side content.', 'ut-elementor-addons-lite' ),
			]
		);

		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name' => 'ut_flipbox_front_bg_color',
				'label' => esc_html__( 'Front Background Color', 'ut-elementor-addons-lite' ),
				'types' => ['classic', 'gradient'],
				'selector' => '{{WRAPPER}} .ut-elements-flip-box-front-container .ut-elements-flip-inner-container',
				'separator'	=> 'after',
			]
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			'ut_flipbox_content_back',
			[
				'label'	=> esc_html__( 'Back', 'ut-elementor-addons-lite' ),
			]
		);

		$this->add_control(
			'ut_flipbox_back_content_head',
			[
				'label' => esc_html__( 'Back', 'ut-elementor-addons-lite' ),
				'type' => Controls_Manager::HEADING,
			]
		);

		$this->add_control(
			'ut_flipbox_img_or_icon_back',
			[
				'label' => esc_html__( 'Type', 'ut-elementor-addons-lite' ),
				'type' => Controls_Manager::SELECT,
				'options' => [
					'none'	=> esc_html__( 'None', 'ut-elementor-addons-lite' ),
					'img'	=> esc_html__('Image', 'ut-elementor-addons-lite' ),
					'icon'	=> esc_html__('Icon', 'ut-elementor-addons-lite' )
				],
				'default' => 'icon'
			]
		);

		$this->add_control(
			'ut_flipbox_image_back',
			[
				'label' => esc_html__( 'Image', 'ut-elementor-addons-lite' ),
				'type' => Controls_Manager::MEDIA,
				'default' => [
					'url' => Utils::get_placeholder_image_src(),
				],
				'condition'	=> [
					'ut_flipbox_img_or_icon_back'	=> 'img'
				]
			]
		);

		$this->add_control(
			'ut_flipbox_icon_back_new',
			[
				'label' => esc_html__( 'Icon', 'ut-elementor-addons-lite' ),
				'type' => Controls_Manager::ICONS,
				'fa4compatibility' => 'ut_flipbox_icon_back',
				'default' => [
					'value' => 'fas fa-snowflake',
					'library' => 'fa-solid',
				],
				'condition'	=> [
					'ut_flipbox_img_or_icon_back' => 'icon'
				]
			]
		);

		$this->add_responsive_control(
			'ut_flipbox_image_resizer_back',
			[
				'label' => esc_html__( 'Image Resizer', 'ut-elementor-addons-lite' ),
				'type' => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'max' => 500,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .ut-elements-flip-box-rear-container .ut-elements-flip-box-icon-image > img.ut-flipbox-image-as-icon' => 'width: {{SIZE}}{{UNIT}};'
				],
				'condition'	=> [
					'ut_flipbox_img_or_icon_back' => 'img'
				]
			]
		);

		$this->add_group_control(
			Group_Control_Image_Size::get_type(),
			[
				'name' => 'thumbnail_back',
				'default' => 'thumbnail',
				'condition' => [
					'ut_flipbox_image[url]!' => '',
					'ut_flipbox_img_or_icon_back' => 'img'
				],
			]
		);

		$this->add_control(
			'ut_flipbox_back_title',
			[
				'label' => esc_html__( 'Title', 'ut-elementor-addons-lite' ),
				'type' => Controls_Manager::TEXT,
				'label_block' => true,
				'default' => esc_html__( 'Back Title', 'ut-elementor-addons-lite' ),
			]
		);

		$this->add_control(
			'ut_flipbox_back_text',
			[
				'label' => esc_html__( 'Content', 'ut-elementor-addons-lite' ),
				'type' => Controls_Manager::WYSIWYG,
				'label_block' => true,
				'default' => esc_html__( 'This is back side content.', 'ut-elementor-addons-lite' ),
			]
		);

		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name' => 'ut_flipbox_back_bg_color',
				'label' => esc_html__( 'Back Background Color', 'ut-elementor-addons-lite' ),
				'types' => ['classic', 'gradient'],
				'selector' => '{{WRAPPER}} .ut-elements-flip-box-rear-container .ut-elements-flip-inner-container'
			]
		);

		$this->end_controls_tab();

		$this->end_controls_tabs();

		$this->add_control(
			'ut_flipbox_overlay_heading',
			[
				'label' => esc_html__( 'Overlay', 'ut-elementor-addons-lite' ),
				'type' => Controls_Manager::HEADING,
				'divider' => 'after'
			]
		);

		$this->add_control(
			'bg_overlay_opacity',
			[
				'label' => esc_html__( 'Opacity', 'ut-elementor-addons-lite' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => ['px'],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 1,
						'step' => 0.1,
					]
				],
				'selectors' => [
					'{{WRAPPER}} .ut-elements-flip-box-container span.overlay' => 'opacity: {{SIZE}};',
				],
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Background::get_type(),
			[
				'name' => 'bg_overlay',
				'label' => esc_html__( 'Overlay Background', 'ut-elementor-addons-lite' ),
				'types' => ['classic', 'gradient'],
				'selector' => '{{WRAPPER}} .ut-elements-flip-box-container span.overlay',
			]
		);		

		$this->end_controls_section();

		$this->start_controls_section(
			'ut_flixbox_link_section',
			[
				'label' => esc_html__( 'Link', 'ut-elementor-addons-lite' ),
			]
		);

		$this->add_control(
			'flipbox_link_type',
			[
				'label'                 => esc_html__( 'Link Type', 'ut-elementor-addons-lite' ),
				'type'                  => Controls_Manager::SELECT,
				'default'               => 'none',
				'options'               => [
					'none'      => esc_html__( 'None', 'ut-elementor-addons-lite' ),
					'box'       => esc_html__( 'Box', 'ut-elementor-addons-lite' ),
					'title'     => esc_html__( 'Title', 'ut-elementor-addons-lite' ),
					'button'    => esc_html__( 'Button', 'ut-elementor-addons-lite' ),
				],
			]
		);

		$this->add_control(
			'flipbox_link',
			[
				'label'                 => esc_html__( 'Link', 'ut-elementor-addons-lite' ),
				'type'                  => Controls_Manager::URL,
				'placeholder'           => 'https://www.your-link.com',
				'default'               => [
					'url' => '#',
				],
				'condition'             => [
					'flipbox_link_type!'   => 'none',
				],
			]
		);

		$this->add_control(
			'flipbox_button_text',
			[
				'label'                 => esc_html__( 'Button Text', 'ut-elementor-addons-lite' ),
				'type'                  => Controls_Manager::TEXT,
				'dynamic'               => [
					'active'   => true,
				],
				'default'               => esc_html__( 'Get Started', 'ut-elementor-addons-lite' ),
				'condition'             => [
					'flipbox_link_type'   => 'button',
				],
			]
		);

		$this->add_control(
			'button_icon_new',
			[
				'label'                 => esc_html__( 'Button Icon', 'ut-elementor-addons-lite' ),
				'type'                  => Controls_Manager::ICONS,
				'fa4compatibility' 		=> 'button_icon',
				'condition'             => [
					'flipbox_link_type'   => 'button',
				],
			]
		);

		$this->add_control(
			'button_icon_position',
			[
				'label'                 => esc_html__( 'Icon Position', 'ut-elementor-addons-lite' ),
				'type'                  => Controls_Manager::SELECT,
				'default'               => 'after',
				'options'               => [
					'after'     => esc_html__('After', 'ut-elementor-addons-lite'),
					'before'    => esc_html__('Before', 'ut-elementor-addons-lite'),
				],
				'condition'             => [
					'flipbox_link_type'     => 'button',
					'button_icon!'  => '',
				],
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'ut_section_flipbox_style_settings',
			[
				'label' => esc_html__( 'Filp Box Style', 'ut-elementor-addons-lite' ),
				'tab' => Controls_Manager::TAB_STYLE
			]
		);

		$this->add_responsive_control(
			'ut_flipbox_front_back_padding',
			[
				'label' => esc_html__( 'Content Padding', 'ut-elementor-addons-lite' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => ['px', 'em', '%'],
				'selectors' => [
					'{{WRAPPER}} .ut-elements-flip-box-front-container .ut-elements-flip-inner-container' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					'{{WRAPPER}} .ut-elements-flip-box-rear-container .ut-elements-flip-inner-container' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' => 'ut_filbpox_border',
				'label' => esc_html__( 'Border Style', 'ut-elementor-addons-lite' ),
				'selector' => '{{WRAPPER}} .ut-elements-flip-box-front-container .ut-elements-flip-inner-container, {{WRAPPER}} .ut-elements-flip-box-rear-container .ut-elements-flip-inner-container',
			]
		);

		$this->add_control(
			'ut_flipbox_border_radius',
			[
				'label' => esc_html__( 'Border Radius', 'ut-elementor-addons-lite' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%', 'em'],
				'selectors' => [
					'{{WRAPPER}} .ut-elements-flip-box-front-container .ut-elements-flip-inner-container' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					'{{WRAPPER}} .ut-elements-flip-box-rear-container .ut-elements-flip-inner-container' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				]
			]
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'ut_flipbox_shadow',
				'selector' => '{{WRAPPER}} .ut-elements-flip-box-front-container .ut-elements-flip-inner-container, {{WRAPPER}} .ut-elements-flip-box-rear-container .ut-elements-flip-inner-container'
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'ut_section_flipbox_imgae_style_settings',
			[
				'label' => esc_html__( 'Image Style', 'ut-elementor-addons-lite' ),
				'tab' => Controls_Manager::TAB_STYLE,
				'condition' => [
					'ut_flipbox_img_or_icon' => 'img'
				]
			]
		);

		$this->add_control(
			'ut_filpbox_img_border_radius',
			[
				'label' => esc_html__( 'Border Radius', 'ut-elementor-addons-lite' ),
				'type' => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'max' => 100,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .ut-elements-flip-box-icon-image img' => 'border-radius: {{SIZE}}px;',
					'{{WRAPPER}} .ut-elements-flip-box-icon-image img' => 'border-radius: {{SIZE}}px;',
				],
				'condition' => [
					'ut_flipbox_img_or_icon' => 'img',
				]
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'ut_section_flipbox_icon_style_settings',
			[
				'label' => esc_html__( 'Icon Style', 'ut-elementor-addons-lite' ),
				'tab' => Controls_Manager::TAB_STYLE,
				'condition' => [
					'ut_flipbox_img_or_icon' => 'icon'
				]
			]
		);

		$this->start_controls_tabs( 'ut_section_icon_style_settings' );

		$this->start_controls_tab( 'ut_section_icon_front_style_settings',
			[
				'label' => esc_html__( 'Front', 'ut-elementor-addons-lite' )
			]);

		$this->add_control(
			'ut_flipbox_front_icon_color',
			[
				'label' => esc_html__( 'Color', 'ut-elementor-addons-lite' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .ut-elements-flip-box-front-container .ut-elements-flip-box-icon-image i' => 'color: {{VALUE}};',
				],
				'condition' => [
					'ut_flipbox_img_or_icon' => 'icon'
				]
			]
		);

		$this->add_control(
			'ut_flipbox_front_icon_typography',
			[
				'label' => esc_html__( 'Icon Size', 'ut-elementor-addons-lite' ),
				'type' => Controls_Manager::SLIDER,
				'size_units'	=> ['px'],
				'default'	=> [
					'size'	=> 40,
					'unit'	=> 'px'
				],
				'range' => [
					'px' => [
						'min'	=> 0,
						'step'	=> 1,
						'max'	=> 150,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .ut-elements-flip-box-front-container .ut-elements-flip-box-icon-image i'	=> 'font-size: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .ut-elements-flip-box-front-container .ut-elements-flip-box-icon-image img.ut-flipbox-svg-icon'	=> 'width: {{SIZE}}{{UNIT}};'
				],
				'condition' => [
					'ut_flipbox_img_or_icon' => 'icon'
				]
			]
		);

		$this->add_responsive_control(
			'ut_flipbox_icon_front_padding',
			[
				'label' => esc_html__( 'Padding', 'ut-elementor-addons-lite' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => ['px', 'em'],
				'selectors' => [
					'{{WRAPPER}} .ut-elements-flip-box-front-container .ut-elements-flip-box-icon-image' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
				],
			]
		);

		$this->end_controls_tab();

		$this->start_controls_tab( 'ut_section_icon_back_style_settings',
			[
				'label' => esc_html__( 'Back', 'ut-elementor-addons-lite' ),
			]);

		$this->add_control(
			'ut_flipbox_back_icon_heading',
			[
				'label' => esc_html__( 'Icon Style', 'ut-elementor-addons-lite' ),
				'type' => Controls_Manager::HEADING,
				'condition'	=> [
					'ut_flipbox_img_or_icon_back'	=> 'icon'
				]
			]
		);

		$this->add_control(
			'ut_flipbox_back_icon_color',
			[
				'label' => esc_html__( 'Color', 'ut-elementor-addons-lite' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .ut-elements-flip-box-rear-container .ut-elements-flip-box-icon-image i' => 'color: {{VALUE}};',
				],
				'condition'	=> [
					'ut_flipbox_img_or_icon_back' => 'icon'
				]
			]
		);

		$this->add_control(
			'ut_flipbox_back_icon_typography',
			[
				'label' => esc_html__( 'Icon Size', 'ut-elementor-addons-lite' ),
				'type' => Controls_Manager::SLIDER,
				'size_units'	=> ['px'],
				'default'	=> [
					'size'	=> 40,
					'unit'	=> 'px'
				],
				'range' => [
					'px' => [
						'min'	=> 0,
						'step'	=> 1,
						'max'	=> 150,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .ut-elements-flip-box-rear-container .ut-elements-flip-box-icon-image i'	=> 'font-size: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .ut-elements-flip-box-rear-container .ut-elements-flip-box-icon-image img'	=> 'width: {{SIZE}}{{UNIT}};'
				],
				'condition'	=> [
					'ut_flipbox_img_or_icon_back' => 'icon'
				]
			]
		);

		$this->add_responsive_control(
			'ut_flipbox_icon_back_padding',
			[
				'label' => esc_html__( 'Padding', 'ut-elementor-addons-lite' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => ['px', 'em'],
				'selectors' => [
					'{{WRAPPER}} .ut-elements-flip-box-rear-container .ut-elements-flip-box-icon-image' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
				],
			]
		);

		$this->end_controls_tab();

		$this->end_controls_tabs();

		$this->end_controls_section();

		$this->start_controls_section(
			'ut_section_flipbox_title_style_settings',
			[
				'label' => esc_html__( 'Color &amp; Typography', 'ut-elementor-addons-lite' ),
				'tab' => Controls_Manager::TAB_STYLE
			]
		);

		$this->start_controls_tabs( 'ut_section_flipbox_typo_style_settings' );

		$this->start_controls_tab( 'ut_section_flipbox_typo_style_front_settings', 
			[
				'label' => esc_html__( 'Front', 'ut-elementor-addons-lite' ),
			]);

		$this->add_control(
			'ut_flipbox_front_title_heading',
			[
				'label' => esc_html__( 'Title Style', 'ut-elementor-addons-lite' ),
				'type' => Controls_Manager::HEADING
			]
		);

		$this->add_control(
			'ut_flipbox_front_title_color',
			[
				'label' => esc_html__( 'Color', 'ut-elementor-addons-lite' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .ut-elements-flip-box-front-container .ut-elements-flip-box-heading' => 'color: {{VALUE}};',
				]
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'ut_flipbox_front_title_typography',
				'selector' => '{{WRAPPER}} .ut-elements-flip-box-front-container .ut-elements-flip-box-heading'
			]
		);

		$this->add_control(
			'ut_flipbox_front_content_heading',
			[
				'label' => esc_html__( 'Content Style', 'ut-elementor-addons-lite' ),
				'type' => Controls_Manager::HEADING,
				'separator' => 'before'
			]
		);

		$this->add_control(
			'ut_flipbox_front_content_color',
			[
				'label' => esc_html__( 'Color', 'ut-elementor-addons-lite' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .ut-elements-flip-box-front-container .ut-elements-flip-box-content' => 'color: {{VALUE}};',
				]
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'ut_flipbox_front_content_typography',
				'selector' => '{{WRAPPER}} .ut-elements-flip-box-front-container .ut-elements-flip-box-content'
			]
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			'ut_section_flipbox_typo_style_back_settings', 
			[
				'label' => esc_html__( 'Back', 'ut-elementor-addons-lite' ),
			]
		);

		$this->add_control(
			'ut_flipbox_back_title_heading',
			[
				'label' => esc_html__( 'Title Style', 'ut-elementor-addons-lite' ),
				'type' => Controls_Manager::HEADING
			]
		);

		$this->add_control(
			'ut_flipbox_back_title_color',
			[
				'label' => esc_html__( 'Color', 'ut-elementor-addons-lite' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .ut-elements-flip-box-rear-container .ut-elements-flip-box-heading' => 'color: {{VALUE}};',
				]
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'ut_flipbox_back_title_typography',
				'selector' => '{{WRAPPER}} .ut-elements-flip-box-rear-container .ut-elements-flip-box-heading'
			]
		);

		$this->add_control(
			'ut_flipbox_back_content_heading',
			[
				'label' => esc_html__( 'Content Style', 'ut-elementor-addons-lite' ),
				'type' => Controls_Manager::HEADING,
				'separator' => 'before'
			]
		);

		$this->add_control(
			'ut_flipbox_back_content_color',
			[
				'label' => esc_html__( 'Color', 'ut-elementor-addons-lite' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .ut-elements-flip-box-rear-container .ut-elements-flip-box-content' => 'color: {{VALUE}};',
				]
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'ut_flipbox_back_content_typography',
				'selector' => '{{WRAPPER}} .ut-elements-flip-box-rear-container .ut-elements-flip-box-content'
			]
		);

		$this->end_controls_tab();

		$this->end_controls_tabs();

		$this->end_controls_section();

		$this->start_controls_section(
			'ut_section_flipbox_button_style_settings',
			[
				'label' => esc_html__( 'Button Style', 'ut-elementor-addons-lite' ),
				'tab' => Controls_Manager::TAB_STYLE,
				'condition'	=> [
					'flipbox_link_type'	=> 'button'
				]
			]
		);

		$this->start_controls_tabs( 'flipbox_button_style_settings' );

		$this->start_controls_tab(
			'flipbox_button_normal_style',
			[
				'label'	=> esc_html__( 'Normal', 'ut-elementor-addons-lite' ),
			]
		);
		$this->add_responsive_control(
			'ut_flipbox_button_margin',
			[
				'label' => esc_html__( 'Margin', 'ut-elementor-addons-lite' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => ['px', 'em'],
				'selectors' => [
					'{{WRAPPER}} .ut-elements-flip-box-container .flipbox-button' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
				],
			]
		);

		$this->add_responsive_control(
			'ut_flipbox_button_padding',
			[
				'label' => esc_html__( 'Padding', 'ut-elementor-addons-lite' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => ['px', 'em'],
				'selectors' => [
					'{{WRAPPER}} .ut-elements-flip-box-container .flipbox-button' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
				],
			]
		);

		$this->add_control(
			'ut_flipbox_button_color',
			[
				'label' => esc_html__( 'Color', 'ut-elementor-addons-lite' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .ut-elements-flip-box-container .flipbox-button' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'ut_flipbox_button_bg_color',
			[
				'label' => esc_html__( 'Background', 'ut-elementor-addons-lite' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .ut-elements-flip-box-container .flipbox-button' => 'background: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'ut_flipbox_button_border_radius',
			[
				'label' => esc_html__( 'Border Radius', 'ut-elementor-addons-lite' ),
				'type' => Controls_Manager::SLIDER,
				'size_units'	=> ['px'],
				'range' => [
					'px' => [
						'min'	=> 0,
						'step'	=> 1,
						'max'	=> 100,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .ut-elements-flip-box-container .flipbox-button'	=> 'border-radius: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'		=> 'ut_flipbox_button_typography',
				'selector'	=> '{{WRAPPER}} .ut-elements-flip-box-container .flipbox-button'
			]
		);
		$this->end_controls_tab();

		$this->start_controls_tab(
			'flipbox_button_hover_style',
			[
				'label'	=> esc_html__( 'Hover', 'ut-elementor-addons-lite' ),
			]
		);

		$this->add_control(
			'ut_flipbox_button_hover_color',
			[
				'label' => esc_html__( 'Color', 'ut-elementor-addons-lite' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .ut-elements-flip-box-container .flipbox-button:hover' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'ut_flipbox_button_hover_bg_color',
			[
				'label' => esc_html__( 'Background', 'ut-elementor-addons-lite' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .ut-elements-flip-box-container .flipbox-button:hover' => 'background: {{VALUE}};',
				],
			]
		);

		$this->end_controls_tab();

		$this->end_controls_tabs();

		$this->end_controls_section();
	}

	protected function render()
	{

		$settings = $this->get_settings();
		$flipbox_image = $this->get_settings('ut_flipbox_image');
		$flipbox_image_url = Group_Control_Image_Size::get_attachment_image_src($flipbox_image['id'], 'thumbnail', $settings);
		(empty($flipbox_image_url)) ? $flipbox_image_url = $flipbox_image['url'] : $flipbox_image_url = $flipbox_image_url;

		$flipbox_if_html_tag = 'div';
		$flipbox_if_html_title_tag = 'h2';
		$this->add_render_attribute('flipbox-container', 'class', 'ut-elements-flip-box-flip-card');
		$this->add_render_attribute('flipbox-title-container', 'class', 'ut-elements-flip-box-heading');

		$front_icon_migrated = isset($settings['__fa4_migrated']['ut_flipbox_icon_new']);
		$front_icon_is_new = empty($settings['ut_flipbox_icon']);
		$back_icon_migrated = isset($settings['__fa4_migrated']['ut_flipbox_icon_back_new']);
		$back_icon_is_new = empty($settings['ut_flipbox_icon_back']);
		$button_icon_migrated = isset($settings['__fa4_migrated']['button_icon_new']);
		$button_icon_is_new = empty($settings['button_icon']);

		$valign = isset($settings['ut_flipbox_setting_contentv_align']) ? $settings['ut_flipbox_setting_contentv_align'] : '';
		$halign = isset($settings['ut_flipbox_setting_contenth_align']) ? $settings['ut_flipbox_setting_contenth_align'] : '';
		$content_front_align = isset($settings['ut_flipbox_content_falignment']) ? $settings['ut_flipbox_content_falignment'] : '';
		$content_back_align = isset($settings['ut_flipbox_content_balignment']) ? $settings['ut_flipbox_content_balignment'] : '';
		$content_align = isset($settings['ut_flipbox_content_alignment']) ? $settings['ut_flipbox_content_alignment'] : '';
		$icon_front_align = isset($settings['ut_flipbox_icon_front_alignment']) ? $settings['ut_flipbox_icon_front_alignment'] : '';
		$icon_back_align = isset($settings['ut_flipbox_icon_back_alignment']) ? $settings['ut_flipbox_icon_back_alignment'] : '';

		if ($settings['flipbox_link_type'] != 'none') {
			if (!empty($settings['flipbox_link']['url'])) {
				if ($settings['flipbox_link_type'] == 'box') {
					$flipbox_if_html_tag = 'a';

					$this->add_render_attribute('flipbox-container', 'href', esc_url($settings['flipbox_link']['url']));

					if ($settings['flipbox_link']['is_external']) {
						$this->add_render_attribute('flipbox-container', 'target', '_blank');
					}

					if ($settings['flipbox_link']['nofollow']) {
						$this->add_render_attribute('flipbox-container', 'rel', 'nofollow');
					}
				} elseif ($settings['flipbox_link_type'] == 'title') {
					$flipbox_if_html_title_tag = 'a';

					$this->add_render_attribute(
						'flipbox-title-container',
						[
							'class'	=> 'flipbox-linked-title',
							'href' => $settings['flipbox_link']['url']
						]
					);

					if ($settings['flipbox_link']['is_external']) {
						$this->add_render_attribute('flipbox-title-container', 'target', '_blank');
					}

					if ($settings['flipbox_link']['nofollow']) {
						$this->add_render_attribute('flipbox-title-container', 'rel', 'nofollow');
					}
				} elseif ($settings['flipbox_link_type'] == 'button') {
					$this->add_render_attribute(
						'flipbox-button-container',
						[
							'class'	=> 'flipbox-button',
							'href'	=> $settings['flipbox_link']['url']
						]
					);

					if ($settings['flipbox_link']['is_external']) {
						$this->add_render_attribute('flipbox-button-container', 'target', '_blank');
					}

					if ($settings['flipbox_link']['nofollow']) {
						$this->add_render_attribute('flipbox-button-container', 'rel', 'nofollow');
					}
				}
			}
		}

		$flipbox_image_back = $this->get_settings('ut_flipbox_image_back');
		$flipbox_back_image_url = Group_Control_Image_Size::get_attachment_image_src($flipbox_image_back['id'], 'thumbnail_back', $settings);
		$flipbox_back_image_url = empty($flipbox_back_image_url) ? $flipbox_back_image_url : $flipbox_back_image_url;
		if ('img' == $settings['ut_flipbox_img_or_icon_back']) {
			$this->add_render_attribute(
				'flipbox-back-icon-image-container',
				[
					'src'	=> $flipbox_back_image_url,
					'alt'	=> esc_attr(get_post_meta($flipbox_image_back['id'], '_wp_attachment_image_alt', true))
				]
			);
		}
		$layout = isset($settings['ut_flipbox_design_layout']) ? $settings['ut_flipbox_design_layout'] : 'layout-1';
		$this->add_render_attribute(
			'ut_flipbox_main_wrap',
			[
				'class'	=> [
					'ut-elements-flip-box-container',
					'ut-animate-flip',
					'ut-' . esc_attr($settings['ut_flipbox_type']),
					$layout,
					$valign,
					$halign,
					$content_front_align,
					$content_back_align,
					$content_align,
					$icon_front_align,
					$icon_back_align,
				]
			]
		);

		?>

		<div <?php echo $this->get_render_attribute_string('ut_flipbox_main_wrap'); ?>>

			<<?php echo $flipbox_if_html_tag, ' ', $this->get_render_attribute_string('flipbox-container'); ?>>
			<div class="ut-elements-flip-box-front-container">
				<div class="ut-elements-flip-inner-container">
					<span class="overlay"></span>
					<div class="flip-content">
						<div class="ut-elements-flip-box-icon-image">
							<?php if ('icon' === $settings['ut_flipbox_img_or_icon']) : ?>
								<?php if ($front_icon_is_new || $front_icon_migrated) { ?>
									<?php if (isset($settings['ut_flipbox_icon_new']['value']['url'])) : ?>
										<img class="ut-flipbox-svg-icon" src="<?php echo esc_attr($settings['ut_flipbox_icon_new']['value']['url']); ?>" alt="<?php echo esc_attr(get_post_meta($settings['ut_flipbox_icon_new']['value']['id'], '_wp_attachment_image_alt', true)); ?>" />
									<?php else : ?>
										<i class="<?php echo esc_attr($settings['ut_flipbox_icon_new']['value']); ?>"></i>
									<?php endif; ?>
								<?php } else { ?>
									<i class="<?php echo esc_attr($settings['ut_flipbox_icon']); ?>"></i>
								<?php } ?>
							<?php elseif ('img' === $settings['ut_flipbox_img_or_icon']) : ?>
								<img class="ut-flipbox-image-as-icon" src="<?php echo esc_url($flipbox_image_url); ?>" alt="<?php echo esc_attr(get_post_meta($flipbox_image['id'], '_wp_attachment_image_alt', true)); ?>">
							<?php endif; ?>
						</div>
						<h2 class="ut-elements-flip-box-heading"><?php echo esc_html($settings['ut_flipbox_front_title']); ?></h2>
						<div class="ut-elements-flip-box-content"> 
							<?php echo wp_kses_post($settings['ut_flipbox_front_text']); ?>
						</div>
						<?php if ($settings['flipbox_link_type'] == 'button' && !empty($settings['flipbox_button_text'])) : ?>
							<a <?php echo $this->get_render_attribute_string('flipbox-button-container'); ?>>
								<?php if ('before' == $settings['button_icon_position']) : ?>
									<?php if ($button_icon_is_new || $button_icon_migrated) { ?>
										<i class="<?php echo esc_attr($settings['button_icon_new']['value']); ?>"></i>
									<?php } else { ?>
										<i class="<?php echo esc_attr($settings['button_icon']); ?>"></i>
									<?php } ?>
								<?php endif; ?>
								<?php echo esc_attr($settings['flipbox_button_text']); ?>
								<?php if ('after' == $settings['button_icon_position']) : ?>
									<?php if ($button_icon_is_new || $button_icon_migrated) { ?>
										<i class="<?php echo esc_attr( $settings['button_icon_new']['value'] ); ?>"></i>
									<?php } else { ?>
										<i class="<?php echo esc_attr($settings['button_icon']); ?>"></i>
									<?php } ?>
								<?php endif; ?>
							</a>
						<?php endif; ?>
					</div>
				</div>
			</div>

			<div class="ut-elements-flip-box-rear-container">
				<div class="ut-elements-flip-inner-container">
					<span class="overlay"></span>
					<div class="flip-content">
						<?php if ('none' != $settings['ut_flipbox_img_or_icon_back']) : ?>
							<div class="ut-elements-flip-box-icon-image">
								<?php if ('img' == $settings['ut_flipbox_img_or_icon_back']) : ?>
									<img class="ut-flipbox-image-as-icon" <?php echo $this->get_render_attribute_string('flipbox-back-icon-image-container'); ?>>
								<?php elseif ('icon' == $settings['ut_flipbox_img_or_icon_back']) : ?>
									<?php if ($back_icon_is_new || $back_icon_migrated) { ?>
										<?php if (isset($settings['ut_flipbox_icon_back_new']['value']['url'])) : ?>
											<img class="ut-flipbox-svg-icon" src="<?php echo esc_attr($settings['ut_flipbox_icon_back_new']['value']['url']); ?>" alt="<?php echo esc_attr(get_post_meta($settings['ut_flipbox_icon_back_new']['value']['id'], '_wp_attachment_image_alt', true)); ?>" />
										<?php else : ?>
											<i class="<?php echo esc_attr($settings['ut_flipbox_icon_back_new']['value']); ?>"></i>
										<?php endif; ?>
									<?php } else { ?>
										<i class="<?php echo esc_attr($settings['ut_flipbox_icon_back']); ?>"></i>
									<?php } ?>
								<?php endif; ?>
							</div>
						<?php endif; ?>

						<<?php echo $flipbox_if_html_title_tag, ' ', $this->get_render_attribute_string('flipbox-title-container'); ?>><?php echo esc_html($settings['ut_flipbox_back_title']); ?></<?php echo $flipbox_if_html_title_tag; ?>>
						<div class="ut-elements-flip-box-content">
							<?php echo wp_kses_post($settings['ut_flipbox_back_text']); ?>
						</div>

						<?php if ($settings['flipbox_link_type'] == 'button' && !empty($settings['flipbox_button_text'])) : ?>
							<a <?php echo $this->get_render_attribute_string('flipbox-button-container'); ?>>
								<?php if ('before' == $settings['button_icon_position']) : ?>
									<?php if ($button_icon_is_new || $button_icon_migrated) { ?>
										<i class="<?php echo esc_attr($settings['button_icon_new']['value']); ?>"></i>
									<?php } else { ?>
										<i class="<?php echo esc_attr($settings['button_icon']); ?>"></i>
									<?php } ?>
								<?php endif; ?>
								<?php echo esc_attr($settings['flipbox_button_text']); ?>
								<?php if ('after' == $settings['button_icon_position']) : ?>
									<?php if ($button_icon_is_new || $button_icon_migrated) { ?>
										<i class="<?php echo esc_attr($settings['button_icon_new']['value']); ?>"></i>
									<?php } else { ?>
										<i class="<?php echo esc_attr($settings['button_icon']); ?>"></i>
									<?php } ?>
								<?php endif; ?>
							</a>
						<?php endif; ?>
					</div>
				</div>
			</div>
			</<?php echo $flipbox_if_html_tag; ?>>
		</div>
		
		<?php
	}
}
Plugin::instance()->widgets_manager->register_widget_type(new UT_Elementor_Addons_Lite_Widget_Blog_Flip_Box());
