<?php
namespace Elementor;   

if ( ! defined( 'ABSPATH' ) ) exit; 

class UT_Elementor_Addons_Lite_Widget_Modal_Popup extends Widget_Base {

	use \Elementor\UT_Elementor_Addons_Lite_Queries; 

	public function get_name() { 
		return 'utal-modal-popup';
	} 

	public function get_title() {
		return  esc_html__( 'Modal Popup', 'ut-elementor-addons-lite' );
	}

	public function get_icon() { 
		return 'eicon-download-button ut-widget-icon';
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
			'ut_modal_content_section',
			[
				'label' => esc_html__( 'General', 'ut-elementor-addons-lite' )
			]
		);

		$this->add_control(
			'ut_modal_content',
			[
				'label'   => esc_html__( 'Modal Type', 'ut-elementor-addons-lite' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'image',
				'options' => [
					'image'          => esc_html__( 'Image', 'ut-elementor-addons-lite' ),
					'html_content'   => esc_html__( 'HTML Content', 'ut-elementor-addons-lite' ),
					'youtube'        => esc_html__( 'Youtube Video', 'ut-elementor-addons-lite' ),
					'vimeo'          => esc_html__( 'Vimeo Video', 'ut-elementor-addons-lite' ),
					'external-video' => esc_html__( 'Self Hosted Video', 'ut-elementor-addons-lite' ),
					'external_page'  => esc_html__( 'External Page', 'ut-elementor-addons-lite' ),
					'shortcode'      => esc_html__( 'Shortcode', 'ut-elementor-addons-lite' )
				]
			]
		);

		$this->add_control(
			'ut_modal_image',
			[
				'label'      => esc_html__( 'Image', 'ut-elementor-addons-lite' ),
				'type'       => Controls_Manager::MEDIA,
				'default'    => [
					'url' 	 => Utils::get_placeholder_image_src()
				],
				'condition'  => [
					'ut_modal_content' => 'image'
				]
			]
		);

		$this->add_group_control(
			Group_Control_Image_Size::get_type(),
			[
				'name'      => 'thumbnail',
				'default'   => 'full',
				'condition' => [
					'ut_modal_content' => 'image'
				]
			]
		);

		$this->add_control(
			'ut_modal_html_content',
			[
				'label'     => esc_html__( 'Add your content here (HTML/Shortcode)', 'ut-elementor-addons-lite' ),
				'type'      => Controls_Manager::WYSIWYG,
				'default'   => esc_html__( 'Add your popup content here', 'ut-elementor-addons-lite' ),
				'condition' => [
					'ut_modal_content' => 'html_content'
				]
			]
		);

		$this->add_control(
			'ut_modal_html_content_color',
			[
				'label'     => esc_html__( 'Text Color', 'ut-elementor-addons-lite' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .ut-modal-html-content' => 'color: {{VALUE}};'
				],
				'condition'   => [
					'ut_modal_content' => 'html_content'
				]
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'      => 'ut_modal_html_content_typhography',
				'label'     => esc_html__( 'Typography', 'ut-elementor-addons-lite' ),
				'selector'  => '{{WRAPPER}} .ut-modal-html-content',
				'condition'   => [
					'ut_modal_content' => 'html_content'
				]
			]
		);

		$this->add_control(
			'ut_modal_html_content_background',
			[
				'label'     => esc_html__( 'Background Color', 'ut-elementor-addons-lite' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .ut-modal-html-content' => 'background-color: {{VALUE}};'
				],
				'condition'   => [
					'ut_modal_content' => 'html_content'
				]
			]
		);

		$this->add_control(
			'ut_modal_html_content_border_radius',
			[
				'label'     => esc_html__( 'Border Radius', 'ut-elementor-addons-lite' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%' ],
				'selectors' => [
					'{{WRAPPER}} .ut-modal-html-content' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
				],
				'condition'   => [
					'ut_modal_content' => 'html_content'
				]
			]
		);

		$this->add_control(
			'ut_modal_youtube_video_url',
			[
				'label'       => esc_html__( 'Provide Youtube Video URL', 'ut-elementor-addons-lite' ),
				'type'        => Controls_Manager::TEXT,
				'label_block' => true,
				'default'     => 'https://www.youtube.com/watch?v=55oDyazPdTU',
				'placeholder' => esc_html__( 'Place Youtube Video URL', 'ut-elementor-addons-lite' ),
				'title'       => esc_html__( 'Place Youtube Video URL', 'ut-elementor-addons-lite' ),
				'condition'   => [
					'ut_modal_content' => 'youtube'
				],
			]
		);

		$this->add_control(
			'ut_modal_vimeo_video_url',
			[
				'label'       => esc_html__( 'Provide Vimeo Video URL', 'ut-elementor-addons-lite' ),
				'type'        => Controls_Manager::TEXT,
				'label_block' => true,
				'default'     => 'https://vimeo.com/76979871',
				'placeholder' => esc_html__( 'Place Vimeo Video URL', 'ut-elementor-addons-lite' ),
				'title'       => esc_html__( 'Place Vimeo Video URL', 'ut-elementor-addons-lite' ),
				'condition'   => [
					'ut_modal_content' => 'vimeo'
				],
			]
		);

		$this->add_control(
			'ut_modal_external_video',
			[
				'label'      => esc_html__( 'External Video', 'ut-elementor-addons-lite' ),
				'type'       => Controls_Manager::MEDIA,
				'media_type' => 'video',
				'condition'  => [
					'ut_modal_content' => 'external-video'
				]
			]
		);

		$this->add_control(
			'ut_modal_external_page_url',
			[
				'label'       => esc_html__( 'Provide External URL', 'ut-elementor-addons-lite' ),
				'type'        => Controls_Manager::TEXT,
				'label_block' => true,
				'default'     => 'https://uncodethemes.com/',
				'placeholder' => esc_html__( 'Place External Page URL', 'ut-elementor-addons-lite' ),
				'condition'   => [
					'ut_modal_content' => 'external_page'
				],
			]
		);

		$this->add_control(
			'ut_modal_shortcode',
			[
				'label'       => esc_html__( 'Enter your shortcode', 'ut-elementor-addons-lite' ),
				'type'        => Controls_Manager::TEXT,
				'label_block' => true,
				'placeholder' => esc_html__( '[shortcode]', 'ut-elementor-addons-lite' ),
				'condition'   => [
					'ut_modal_content' => 'shortcode'
				]
			]
		);

		$this->add_control(
			'ut_modal_shortcode_background',
			[
				'label'     => esc_html__( 'Background Color', 'ut-elementor-addons-lite' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .ut-modal-shortcode' => 'background-color: {{VALUE}};'
				],
				'condition'   => [
					'ut_modal_content' => 'shortcode'
				]
			]
		);

		$this->add_responsive_control(
			'ut_modal_shortcode_padding',
			[
				'label'        => esc_html__( 'Padding', 'ut-elementor-addons-lite' ),
				'type'         => Controls_Manager::DIMENSIONS,
				'size_units'   => [ 'px', '%' ],
				'selectors'    => [
					'{{WRAPPER}} .ut-modal-shortcode' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
				],
				'condition'   => [
					'ut_modal_content' => 'shortcode'
				]
			]
		);

		$this->add_control(
			'ut_modal_shortcode_border_radius',
			[
				'label'     => esc_html__( 'Border Radius', 'ut-elementor-addons-lite' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%' ],
				'selectors' => [
					'{{WRAPPER}} .ut-modal-shortcode' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
				],
				'condition'   => [
					'ut_modal_content' => 'shortcode'
				]
			]
		);

		$this->add_control(
			'ut_modal_btn_text',
			[
				'label'       => esc_html__( 'Button Text', 'ut-elementor-addons-lite' ),
				'type'        => Controls_Manager::TEXT,
				'default'     => esc_html__( 'Click Me', 'ut-elementor-addons-lite' ),
				'separator' => 'before',
			]
		);

		$this->add_control(
			'ut_modal_btn_icon',
			[
				'label'       => esc_html__( 'Button Icon', 'ut-elementor-addons-lite' ),
				'label_block' => true,
				'type'        => Controls_Manager::ICONS,
				'default'     => [
					'value'   => 'fab fa-wordpress-simple',
					'library' => 'fa-brands'
				]
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'ut_modal_display_settings',
			[
				'label' => esc_html__( 'Button', 'ut-elementor-addons-lite' ),
				'tab'   => Controls_Manager::TAB_STYLE
			]
		);

		$this->add_responsive_control(
			'ut_modal_btn_align',
			[
				'label'         => esc_html__( 'Alignment', 'ut-elementor-addons-lite' ),
				'type'          => Controls_Manager::CHOOSE,
				'default'       => 'center',
				'toggle'        => false,
				'separator'     => 'before',
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
					'{{WRAPPER}} .ut-modal-button' => 'text-align: {{VALUE}};'
				]
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'      => 'ut_modal_btn_typhography',
				'label'     => esc_html__( 'Button Typography', 'ut-elementor-addons-lite' ),
				'selector'  => '{{WRAPPER}} .ut-modal-button a span'
			]
		);

		$this->add_responsive_control(
			'ut_modal_btn_radius',
			[
				'label'      => esc_html__( 'Border Radius', 'ut-elementor-addons-lite' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%' ],
				'selectors'  => [
					'{{WRAPPER}} .ut-modal-button a' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					'{{WRAPPER}} .ut-modal-button a::before' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
				]
			]
		);

		$this->add_responsive_control(
			'ut_modal_btn_padding',
			[
				'label'        => esc_html__( 'Padding', 'ut-elementor-addons-lite' ),
				'type'         => Controls_Manager::DIMENSIONS,
				'size_units'   => [ 'px', '%' ],
				'selectors'    => [
					'{{WRAPPER}} .ut-modal-button a' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
				]
			]
		);

		$this->start_controls_tabs( 
			'ut_modal_btn_typhography_color', 
			[
				'separator' => 'before' 
			] 
		);

		$this->start_controls_tab(
			'ut_modal_btn_typhography_color_normal_tab', 
			[ 
				'label' => esc_html__( 'Normal', 'ut-elementor-addons-lite' )
			]
		);

		$this->add_control(
			'ut_modal_btn_typhography_color_normal',
			[
				'label'     => esc_html__( 'Text Color', 'ut-elementor-addons-lite' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#ffffff',
				'selectors' => [
					'{{WRAPPER}} .ut-modal-button a' => 'color: {{VALUE}};'
				]
			]
		);

		$this->add_control(
			'ut_modal_btn_background_normal',
			[
				'label'     => esc_html__( 'Background Color', 'ut-elementor-addons-lite' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#F64670',
				'selectors' => [
					'{{WRAPPER}} .ut-modal-button a' => 'background-color: {{VALUE}};'
				]
			]
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name'     => 'ut_modal_btn_border_normal',
				'selector' => '{{WRAPPER}} .ut-modal-button a'
			]
		);

		$this->end_controls_tab();

		$this->start_controls_tab( 
			'ut_modal_btn_typhography_color_hover_tab', 
			[ 
				'label' => esc_html__( 'Hover', 'ut-elementor-addons-lite' )
			] 
		);

		$this->add_control(
			'ut_modal_btn_color_hover',
			[
				'label'     => esc_html__( 'Text Color', 'ut-elementor-addons-lite' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#F64670',
				'selectors' => [
					'{{WRAPPER}} .ut-modal-button a:hover' => 'color: {{VALUE}};'
				]
			]
		);

		$this->add_control(
			'ut_modal_btn_background_hover',
			[
				'label'     => esc_html__( 'Background Color', 'ut-elementor-addons-lite' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#ffffff',
				'selectors' => [
					'{{WRAPPER}} .ut-modal-button a::before' => 'background-color: {{VALUE}};'
				]
			]
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name'     => 'ut_modal_btn_border_hover',
				'selector' => '{{WRAPPER}} .ut-modal-button a:hover'
			]
		);

		$this->end_controls_tab();

		$this->end_controls_tabs();

		$this->add_control(
			'ut_modal_btn_icon_align',
			[
				'label'     => esc_html__( 'Icon Position', 'ut-elementor-addons-lite' ),
				'type'      => Controls_Manager::SELECT,
				'default'   => 'left',
				'options'   => [
					'left'  => esc_html__( 'Before', 'ut-elementor-addons-lite' ),
					'right' => esc_html__( 'After', 'ut-elementor-addons-lite' )
				],
				'condition' => [
					'ut_modal_btn_icon[value]!' => ''
				],
				'separator' => 'before' 
			]
		);

		$this->add_responsive_control(
			'ut_modal_btn_icon_indent',
			[
				'label'       => esc_html__( 'Icon Spacing', 'ut-elementor-addons-lite' ),
				'type'        => Controls_Manager::SLIDER,
				'range'       => [
					'px'      => [
						'max' => 50
					]
				],
				'default'     => [
					'unit'    => 'px',
					'size'    => 6
				],
				'selectors'   => [
					'{{WRAPPER}} .ut-modal-button a span.ut-modal-action-icon-left i' => 'margin-right: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .ut-modal-button a span.ut-modal-action-icon-right i' => 'margin-left: {{SIZE}}{{UNIT}};'
				],
				'condition'   => [
					'ut_modal_btn_icon[value]!' => ''
				]
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'ut_modal_close_btn_style',
			[
				'label' => esc_html__( 'Close Button', 'ut-elementor-addons-lite' ),
				'tab'   => Controls_Manager::TAB_STYLE
			]
		);

		$this->add_control(
			'ut_modal_close_btn_color',
			[
				'label'     => esc_html__( 'Color', 'ut-elementor-addons-lite' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#ffffff',
				'selectors' => [
					'{{WRAPPER}} .modal_popup_element .ut-close-btn span::before, {{WRAPPER}} .modal_popup_element .ut-close-btn span::after'  => 'background: {{VALUE}};'
				]
			]
		);

		$this->end_controls_section();

	}

	protected function render() {
		$settings = $this->get_settings_for_display();
		$ut_modal_youtube_video_url = isset( $settings['ut_modal_youtube_video_url'] ) ? $settings['ut_modal_youtube_video_url'] : 'https://www.youtube.com/watch?v=55oDyazPdTU';
		$ut_modal_vimeo_video_url = isset( $settings['ut_modal_vimeo_video_url'] ) ? $settings['ut_modal_vimeo_video_url'] : 'https://vimeo.com/76979871';
		$ut_modal_content = isset( $settings['ut_modal_content'] ) ? $settings['ut_modal_content'] : 'image';
		$ut_modal_btn_icon_align = isset( $settings['ut_modal_btn_icon_align'] ) ? $settings['ut_modal_btn_icon_align'] : 'left';
		$ut_modal_btn_icon = isset( $settings['ut_modal_btn_icon'] ) ? $settings['ut_modal_btn_icon'] : '';
		$ut_modal_html_content = isset( $settings['ut_modal_html_content'] ) ? $settings['ut_modal_html_content'] : 'Add your popup content here';
		$ut_modal_external_video = isset( $settings['ut_modal_external_video'] ) ? $settings['ut_modal_external_video'] : '';
		$ut_modal_external_page_url = isset( $settings['ut_modal_external_page_url'] ) ? $settings['ut_modal_external_page_url'] : 'https://uncodethemes.com/';
		$ut_modal_shortcode = isset( $settings['ut_modal_shortcode'] ) ? $settings['ut_modal_shortcode'] : '[shortcode]';

		if( 'youtube' == $ut_modal_content ) {
			$youtube_id = '';
			$regular_pattern = '/(?:youtube(?:-nocookie)?\.com\/(?:[^\/]+\/.+\/|(?:v|e(?:mbed)?\/)|.*[?&]v=)|youtu\.be\/)([^"&?\/ ]{11})/i';
			if (preg_match($regular_pattern, $ut_modal_youtube_video_url, $matches)) {
				$youtube_id = $matches[1] ?? '';
			} else {
				$shorts_pattern = '/youtube\.com\/shorts\/([^"&?\/ ]{11})/i';
				if (preg_match($shorts_pattern, $ut_modal_youtube_video_url, $matches)) {
					$youtube_id = $matches[1] ?? '';
				}
			}
		}

		if( 'vimeo' == $ut_modal_content ) {
			$vimeo_url       = $ut_modal_vimeo_video_url;
			$vimeo_id_select = explode('/', $vimeo_url);
			$vidid           = explode( '&', str_replace('https://vimeo.com', '', end($vimeo_id_select) ) );
			$vimeo_id        = $vidid[0];
		}

		$this->add_render_attribute('modal_popup_wrapper', 'class', 'modal_popup_wrapper');
		?>

		<div class="ut-modal-wrapper">

			<div class="ut-modal-button">
				<a href="#">
					<span class="ut-modal-action-icon-<?php echo esc_attr( $ut_modal_btn_icon_align );?>">
						<?php if( 'left' == $ut_modal_btn_icon_align && ! empty( $ut_modal_btn_icon['value'] ) ) {
							Icons_Manager::render_icon( $ut_modal_btn_icon, [ 'aria-hidden' => 'true' ] );
						}
						echo esc_html( $settings['ut_modal_btn_text'] );
						if( 'right' == $ut_modal_btn_icon_align && !empty( $ut_modal_btn_icon['value'] ) ) {
							Icons_Manager::render_icon( $ut_modal_btn_icon, [ 'aria-hidden' => 'true' ] );
						} ;?>
					</span>	
				</a>
			</div>

			<div class="modal_popup_element">

				<?php if ( 'image' == $ut_modal_content ) { ?>
					<?php echo Group_Control_Image_Size::get_attachment_image_html( $settings, 'thumbnail', 'ut_modal_image' ); ?>
				<?php } elseif ( 'html_content' == $ut_modal_content ) { ?>
					<div class="ut-modal-html-content">
						<?php echo wp_kses_post( $ut_modal_html_content );?>
					</div>
				<?php } elseif ( 'youtube' == $ut_modal_content ) { ?>
					<iframe src="https://www.youtube.com/embed/<?php echo esc_attr( $youtube_id );?>" frameborder="0" allowfullscreen></iframe>
				<?php } elseif ( 'vimeo' == $ut_modal_content ) { ?>
					<iframe id="vimeo-video" class="vimeoplayer" src="https://player.vimeo.com/video/<?php echo esc_attr( $vimeo_id );?>" frameborder="0" allowfullscreen ></iframe>
				<?php } elseif ( 'external-video' == $ut_modal_content ) { ?>
					<video class="ut-video-hosted" src="<?php echo esc_url( $ut_modal_external_video['url'] );?>" controls="" controlslist="nodownload">
					</video>
				<?php } elseif ( 'external_page' == $ut_modal_content ) { ?>
					<iframe src="<?php echo esc_url( $ut_modal_external_page_url ); ?>" frameborder="0" allowfullscreen ></iframe>
				<?php } elseif ( 'shortcode' == $ut_modal_content ) { ?>
					<div class="ut-modal-shortcode">
						<?php echo do_shortcode( $ut_modal_shortcode ); ?>
					</div>
				<?php } ?>

				<div class="ut-close-btn">
					<span></span>
				</div>

			</div>
		</div>

		<?php
	}
}

Plugin::instance()->widgets_manager->register_widget_type( new UT_Elementor_Addons_Lite_Widget_Modal_Popup() );