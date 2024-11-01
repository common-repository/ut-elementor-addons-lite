<?php
namespace Elementor;   

if ( ! defined( 'ABSPATH' ) ) exit; 

class UT_Elementor_Addons_Lite_Widget_Video extends Widget_Base {

	use \Elementor\UT_Elementor_Addons_Lite_Queries;

	public function get_name() {
		return 'utal-video';
	} 

	public function get_title() { 
		return  esc_html__( 'Video Popup', 'ut-elementor-addons-lite' );
	}

	public function get_icon() {
		return 'eicon-youtube ut-widget-icon'; 
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

	protected function register_controls(){

		$this->start_controls_section(
			'ut-video-contain_detail', 
			[
				'label' => esc_html__( 'Video Background Image', 'ut-elementor-addons-lite' ),
				'tab'   => Controls_Manager::TAB_CONTENT,
			]
		);

		$this->add_control(
			'ut-image',
			[
				'label' => esc_html__( 'Background Image', 'ut-elementor-addons-lite' ),
				'type' => \Elementor\Controls_Manager::MEDIA,
				'default' => [
					'url' => \Elementor\Utils::get_placeholder_image_src(),
				],
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'ut-video-type-detail', 
			[
				'label' => esc_html__( 'Video Type', 'ut-elementor-addons-lite' ),
				'tab'   => Controls_Manager::TAB_CONTENT,
			],
		);

		$this->add_control(
			'video_type',
			[
				'label'       => esc_html__('Type', 'ut-elementor-addons-lite'),
				'type'        => Controls_Manager::SELECT,
				'label_block' => true,
				'default'       =>  'video',
				'options'      => [
					'video'   => esc_html__('Youtube Video', 'ut-elementor-addons-lite'),
					'custom'   => esc_html__('Self Hosted Video', 'ut-elementor-addons-lite'),
				],
			]
		);

		$this->add_control(
			'youtube_url',
			[
				'label'   => __( 'URL', 'ut-elementor-addons-lite' ),
				'type'    => Controls_Manager::TEXT,
				'label_block' => true,
				'default' => 'https://www.youtube.com/watch?v=71EZb94AS1k&t=1s',
				'description' => 'https://www.youtube.com/watch?v=71EZb94AS1k',
				'condition' => [
					'video_type' => 'video'
				]
			]
		);

		$this->add_control(
			'file_link',
			[
				'label' => esc_html__( 'Select Video File ', 'ut-elementor-addons-lite' ),
				'type' => Controls_Manager::MEDIA,
				'media_type' => 'video',
				'placeholder' => esc_html__( 'URL to File', 'ut-elementor-addons-lite' ),
				'description' => esc_html__( 'Select file from media library or upload', 'ut-elementor-addons-lite' ),
				'condition' => [
					'video_type' => 'custom'
				]
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'ut-play-btn_detail', 
			[
				'label' => esc_html__( 'Play Button', 'ut-elementor-addons-lite' ),
				'tab'   => Controls_Manager::TAB_CONTENT,
			]
		);

		$this->add_control(
			'play_btn_title',
			[
				'label' => esc_html__( 'Title', 'ut-elementor-addons-lite' ),
				'type' => Controls_Manager::TEXT,
			]
		);

		$this->add_control(
			'ut-play-button-type', 
			[
				'label'       => esc_html__('Type', 'ut-elementor-addons-lite'),
				'type'        => Controls_Manager::SELECT,
				'label_block' => true,
				'default'       =>  'play_btn_icon',
				'options'      => [
					'play_btn_icon'   => esc_html__('Icon', 'ut-elementor-addons-lite'),
					'play_btn_image'   => esc_html__('Image', 'ut-elementor-addons-lite'),
				],
			]
		);

		$this->add_control(
			'ut_play_button_icon',
			[
				'label' => esc_html__( 'Icon', 'ut-elementor-addons-lite' ),
				'type' => Controls_Manager::ICONS,
				'default' => [
					'value' => 'far fa-play-circle',
					'library' => 'fa-solid',
				],
				'condition' => [
					'ut-play-button-type' => 'play_btn_icon'
				]
			]
		);

		$this->add_control(
			'ut_play_button_image',
			[
				'label' => esc_html__( 'Image', 'ut-elementor-addons-lite' ),
				'type' => Controls_Manager::MEDIA,
				'default' => [
					'url' => Utils::get_placeholder_image_src(),
				],
				'condition' => [
					'ut-play-button-type' => 'play_btn_image'
				]
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'ut-background-image',
			[
				'label' => esc_html__( 'Container', 'ut-elementor-addons-lite' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' => 'ut-background-image-border',
				'label' => esc_html__( 'Border', 'ut-elementor-addons-lite' ),
				'selector' => '{{WRAPPER}} .video-content',
			]
		);

		$this->add_control(
			'ut-background-image-radius',
			[
				'label' => esc_html__( 'Border Radius', 'ut-elementor-addons-lite' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .video-content' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'ut-background-image-height',
			[
				'label' => esc_html__( 'Background Image Height', 'ut-elementor-addons-lite' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px', '%' ],
				'range' => [
					'px' => [
						'min' => 1,
						'max' => 1000,
						'step' => 5,
					],
					'%' => [
						'min' => 1,
						'max' => 100,
					],
				],
				'default' => [
					'unit' => 'px',
					'size' => 500,
				],
				'selectors' => [
					'{{WRAPPER}} .video_main_wrapper .video-content' => 'height: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			'ut-background-image-overlay',
			[
				'label' =>esc_html__( 'Background Image Overlay', 'ut-elementor-addons-lite' ),
				'type' => Controls_Manager::COLOR,
				'default' => '#4B313166',
				'selectors' => [
					'{{WRAPPER}} .video-content::before' => 'background-color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'ut-background-image-overlay-radius',
			[
				'label' =>esc_html__( 'Background Image Overlay Radius', 'ut-elementor-addons-lite' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .video-content::before' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'ut-icon',
			[
				'label' => esc_html__( 'Icon', 'ut-elementor-addons-lite' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_responsive_control(
			'ut-icon-padding',
			[
				'label' => esc_html__( 'Padding', 'ut-elementor-addons-lite' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px' ],
				'selectors' => [
					'{{WRAPPER}} .video_main_wrapper .open_video i' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					'{{WRAPPER}} img.video_icon' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'ut-icon-margin',
			[
				'label' => esc_html__( 'Margin', 'ut-elementor-addons-lite' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px' ],
				'selectors' => [
					'{{WRAPPER}} .video_main_wrapper .open_video i' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					'{{WRAPPER}} img.video_icon' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->start_controls_tabs( 'ut_video_popup_button_style_tabs' );

		$this->start_controls_tab(
			'ut_video_popup_button_normal',
			[
				'label' =>esc_html__( 'Normal', 'ut-elementor-addons-lite' ),
			]
		);

		$this->add_control(
			'ut_video_popup_btn_text_color',
			[
				'label' =>esc_html__( 'Color', 'ut-elementor-addons-lite' ),
				'type' => Controls_Manager::COLOR,
				'default' => '#181515',
				'selectors' => [
					'{{WRAPPER}} .video_main_wrapper .open_video i' => 'color: {{VALUE}};',
					'{{WRAPPER}} img.video_icon' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'ut-icon-background-color',
			[
				'label' =>esc_html__( 'Background Color', 'ut-elementor-addons-lite' ),
				'type' => Controls_Manager::COLOR,
				'default' => '#ffffff',
				'selectors' => [
					'{{WRAPPER}} .video_main_wrapper .open_video i' => 'background-color: {{VALUE}};',
				],
			]
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			'ut_video_popup_btn_tab_button_hover',
			[
				'label' =>esc_html__( 'Hover', 'ut-elementor-addons-lite' ),
			]
		);

		$this->add_control(
			'ut_video_popup_btn_hover_color',
			[
				'label' =>esc_html__( 'Color', 'ut-elementor-addons-lite' ),
				'type' => Controls_Manager::COLOR,
				'default' => '#000000',
				'selectors' => [
					'{{WRAPPER}} .video_main_wrapper .open_video i:hover' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'ut-icon-background-color-hover',
			[
				'label' =>esc_html__( 'Background Color ', 'ut-elementor-addons-lite' ),
				'type' => Controls_Manager::COLOR,
				'default' => '#ffffff',
				'selectors' => [
					'{{WRAPPER}} .video_main_wrapper .open_video i:hover' => 'background-color: {{VALUE}};',
				],
			]
		);

		$this->end_controls_tab();

		$this->end_controls_tabs();

		$this->add_responsive_control(
			'ut_video_popup_icon_size',
			[
				'label' => esc_html__( 'Icon Size', 'ut-elementor-addons-lite' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px', '%' ],
				'range' => [
					'px' => [
						'min' => 1,
						'max' => 100,
						'step' => 5,
					],
					'%' => [
						'min' => 1,
						'max' => 100,
					],
				],
				'default' => [
					'unit' => 'px',
					'size' => 50,
				],
				'selectors' => [
					'{{WRAPPER}} .video-popup-btn i' => 'font-size: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'ut-play-button',
			[
				'label' =>esc_html__( 'Play Button Image', 'ut-elementor-addons-lite' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_responsive_control(
			'ut-play-button-size',
			[
				'label' => esc_html__( 'Play Button Image Size', 'ut-elementor-addons-lite' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px', '%' ],
				'range' => [
					'px' => [
						'min' => 1,
						'max' => 500,
						'step' => 5,
					],
					'%' => [
						'min' => 1,
						'max' => 100,
					],
				],
				'default' => [
					'unit' => 'px',
					'size' => 200,
				],
				'selectors' => [
					'{{WRAPPER}} .play_btn_img img' => 'height: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'ut-play-button-padding',
			[
				'label' => esc_html__( 'Padding', 'ut-elementor-addons-lite' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .play_btn_img' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'ut-play-button-margin',
			[
				'label' => esc_html__( 'Margin', 'ut-elementor-addons-lite' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .play_btn_img' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);


		$this->end_controls_section();

		$this->start_controls_section(
			'ut-title',
			[
				'label' => esc_html__( 'Title', 'ut-elementor-addons-lite' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_responsive_control(
			'ut-title-color',
			[
				'label'     => esc_html__( 'Color', 'ut-elementor-addons-lite' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#F9F5F5',
				'selectors' => [
					'{{WRAPPER}} .play_btn_title' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'ut-title-typography',
				'label'    => esc_html__( 'Typography', 'ut-elementor-addons-lite' ),
				'selector' => '{{WRAPPER}} .play_btn_title',
			]
		);

		$this->add_responsive_control(
			'ut-title-padding',
			[
				'label'      => esc_html__( 'Padding', 'ut-elementor-addons-lite' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%', 'em'],
				'selectors'  => [
					'{{WRAPPER}} .play_btn_title' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
				'default'    => [
					'size' => 15,
					'unit' => 'px',
				],
			]
		);

		$this->add_responsive_control(
			'ut-title-margin',
			[
				'label'      => esc_html__( 'Margin', 'ut-elementor-addons-lite' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%', 'em'],
				'selectors'  => [
					'{{WRAPPER}} .play_btn_title' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
				'default'    => [
					'size' => 15,
					'unit' => 'px',
				],
			]
		);

		$this->end_controls_section();

	}

	protected function render() {
		$settings = $this->get_settings();
		$ut_play_button_icon = isset( $settings[ 'ut_play_button_icon' ] ) ? $settings[ 'ut_play_button_icon' ] : '';
		$ut_play_button_image = isset( $settings[ 'ut_play_button_image' ] ) ? $settings[ 'ut_play_button_image' ] : '';
		$play_btn_title = isset( $settings[ 'play_btn_title' ] ) ? $settings[ 'play_btn_title' ] : '';
		$button_type = isset( $settings[ 'ut-play-button-type' ] ) ? $settings[ 'ut-play-button-type' ] : 'play_btn_icon';
		$images = isset( $settings[ 'ut-image' ] ) ? $settings[ 'ut-image' ] : '';
		$youtube_url = isset( $settings[ 'youtube_url' ] ) ? $settings[ 'youtube_url' ] : 'https://www.youtube.com/watch?v=71EZb94AS1k&t=1s';
		$file_link = isset( $settings[ 'file_link' ] ) ? $settings[ 'file_link' ] : '';	
		$video_type = isset( $settings[ 'video_type' ] ) ? $settings[ 'video_type' ] : 'video';	
		// Extract video ID from YouTube URL
		$youtube_id = '';

        // Regular YouTube video URL
		$regular_pattern = '/(?:youtube(?:-nocookie)?\.com\/(?:[^\/]+\/.+\/|(?:v|e(?:mbed)?\/)|.*[?&]v=)|youtu\.be\/)([^"&?\/ ]{11})/i';
		if (preg_match($regular_pattern, $youtube_url, $matches)) {
			$youtube_id = $matches[1] ?? '';
		} else {
           // YouTube shorts URL
			$shorts_pattern = '/youtube\.com\/shorts\/([^"&?\/ ]{11})/i';
			if (preg_match($shorts_pattern, $youtube_url, $matches)) {
				$youtube_id = $matches[1] ?? '';
			}
		}
		?>

		<div class="video_main_wrapper">			
			<div class="video-content" style="background-image: url(<?php echo esc_url( $images['url'] ); ?>);">
				<a href="#" <?php if ( $video_type == 'video' ) { ?>data-youtube="<?php echo esc_attr( $youtube_id ); ?>"<?php } else { ?>data-video_link="<?php echo esc_url( $file_link['url'] ); ?>"<?php } ?> class="open_video video-popup-btn ut_video_popup_video_glow  glow-btn">
					<div class="play_btn_image_icon_wrapper"> 
						<div class="play_btn_image_icon"> 
							<?php if ( 'play_btn_icon' == $button_type ) { ?>
								<?php if ( isset( $ut_play_button_icon['value']['url'] ) ) { ?>
									<img class="video_icon" src="<?php echo esc_url( $ut_play_button_icon['value']['url'] ); ?>" alt="<?php echo esc_attr( get_post_meta( $ut_play_button_icon['value']['id'], '_wp_attachment_image_alt', true ) ); ?>" />
								<?php } else { ?>
									<div class="play_btn_icon">
										<i class="<?php echo esc_attr( $ut_play_button_icon['value'] ); ?>"></i>
									</div>
								<?php } ?> 
							<?php } else { ?>
								<?php if ( $ut_play_button_image['url'] ) { ?>
									<div class="play_btn_img">
										<img src="<?php echo esc_url( $ut_play_button_image['url'] ); ?>">
									</div>
								<?php } ?>
							<?php } ?>
						</div>
						<?php if ( $play_btn_title ) { ?>
							<div class="play_btn_title">
								<?php echo esc_html( $play_btn_title ); ?>
							</div>
						<?php } ?>
					</div>			 		
				</a> 
			</div>

			<div class="main__content_internship videos fade">
				<span class="close_video">
					<svg xmlns="http://www.w3.org/2000/svg" x="0px" y="0px" width="50" height="50" viewBox="0 0 50 50" style=" fill:#000000;"><path d="M 7.71875 6.28125 L 6.28125 7.71875 L 23.5625 25 L 6.28125 42.28125 L 7.71875 43.71875 L 25 26.4375 L 42.28125 43.71875 L 43.71875 42.28125 L 26.4375 25 L 43.71875 7.71875 L 42.28125 6.28125 L 25 23.5625 Z"></path></svg>
				</span>
				<div class="video_main video_internship">
					<iframe class="elementor-video" frameborder="0" allowfullscreen="1" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" title="YouTube video player" width="100%" height="600" src="" id="widget2"></iframe>
				</div>
			</div>
		</div>

		<?php 
	}  
}
Plugin::instance()->widgets_manager->register_widget_type( new UT_Elementor_Addons_Lite_Widget_Video() );

