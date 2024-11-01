<?php
namespace Elementor;

if (! defined( 'ABSPATH' ) ) exit;

class UT_Elementor_Addons_Lite_Widget_Table_Press extends Widget_Base { 
	use \Elementor\UT_Elementor_Addons_Lite_Queries;

	public $base;

	public function get_name() { 
		return 'utal-table-press';
	} 

	public function get_title() {
		return  esc_html__( 'Table Press', 'ut-elementor-addons-lite' );
	}

	public function get_icon() {
		return 'eicon-table ut-widget-icon';
	} 

	public function get_categories() {
		return [ 'ut-elementor-addons-lite' ];
	}

	public function get_script_depends()
	{
		return [
			'jquery-dataTables',
		];
	}

	protected function register_controls() {

		$this->start_controls_section(
			'ut_tablepress_section_content_table',
			[
				'label' => esc_html__( 'Table', 'ut-elementor-addons-lite' ),
			]
		);

		$this->add_control(
			'ut_tablepress_table_id', 
			[
				'label'   => esc_html__( 'Select Table', 'ut-elementor-addons-lite' ),
				'type'    => Controls_Manager::SELECT,
				'label_block' => 'true',
				'default' => '0',
				'options' => ut_elementor_addons_lite_tablepress_table_list(),
			]
		);

		$this->add_responsive_control(
			'ut_tablepress_navigation_hide',
			[
				'label'     => esc_html__( 'Nav Hide', 'ut-elementor-addons-lite' ),
				'type'      => Controls_Manager::SWITCHER,
				'selectors' => [
					'{{WRAPPER}} .ut-tablepress .dataTables_length' => 'display: none;',
				],
			]
		);

		$this->add_responsive_control(
			'ut_tablepress_search_hide',
			[
				'label'     => esc_html__( 'Search Hide', 'ut-elementor-addons-lite' ),
				'type'      => Controls_Manager::SWITCHER,
				'selectors' => [
					'{{WRAPPER}} .ut-tablepress .dataTables_filter' => 'display: none;',
				],
			]
		);

		$this->add_responsive_control(
			'ut_tablepress_footer_info_hide',
			[
				'label'     => esc_html__( 'Footer Info Hide', 'ut-elementor-addons-lite' ),
				'type'      => Controls_Manager::SWITCHER,
				'selectors' => [
					'{{WRAPPER}} .ut-tablepress .dataTables_info' => 'display: none;',
				],
			]
		);

		$this->add_responsive_control(
			'ut_tablepress_pagination_hide',
			[
				'label'     => esc_html__( 'Pagination Hide', 'ut-elementor-addons-lite' ),
				'type'      => Controls_Manager::SWITCHER,
				'selectors' => [
					'{{WRAPPER}} .ut-tablepress .dataTables_paginate' => 'display: none;',
				],
			]
		);

		$this->add_responsive_control(
			'ut_tablepress_header_align',
			[
				'label'   => esc_html__( 'Header Alignment', 'ut-elementor-addons-lite' ),
				'type'    => Controls_Manager::CHOOSE,
				'options' => [
					'left'    => [
						'title' => esc_html__( 'Left', 'ut-elementor-addons-lite' ),
						'icon'  => 'eicon-text-align-left',
					],
					'center' => [
						'title' => esc_html__( 'Center', 'ut-elementor-addons-lite' ),
						'icon'  => 'eicon-text-align-center',
					],
					'right' => [
						'title' => esc_html__( 'Right', 'ut-elementor-addons-lite' ),
						'icon'  => 'eicon-text-align-right',
					],
				],
				'default'   => 'center',
				'selectors' => [
					'{{WRAPPER}} .ut-tablepress .tablepress th' => 'text-align: {{VALUE}};',
				],
			]
		);

		$this->add_responsive_control(
			'ut_tablepress_body_align',
			[
				'label'   => esc_html__( 'Body Alignment', 'ut-elementor-addons-lite' ),
				'type'    => Controls_Manager::CHOOSE,
				'options' => [
					'left'    => [
						'title' => esc_html__( 'Left', 'ut-elementor-addons-lite' ),
						'icon'  => 'eicon-text-align-left',
					],
					'center' => [
						'title' => esc_html__( 'Center', 'ut-elementor-addons-lite' ),
						'icon'  => 'eicon-text-align-center',
					],
					'right' => [
						'title' => esc_html__( 'Right', 'ut-elementor-addons-lite' ),
						'icon'  => 'eicon-text-align-right',
					],
				],
				'default'   => 'center',
				'selectors' => [
					'{{WRAPPER}} .ut-tablepress table.tablepress tr td' => 'text-align: {{VALUE}};',
				],
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'ut_tablepress_section_style_table',
			[
				'label' => esc_html__( 'Table', 'ut-elementor-addons-lite' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_responsive_control(
			'ut_tablepress_table_text_color',
			[
				'label'     => esc_html__( 'Color', 'ut-elementor-addons-lite' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .ut-tablepress .dataTables_length, {{WRAPPER}} .ut-tablepress .dataTables_filter, {{WRAPPER}} .ut-tablepress .dataTables_info, {{WRAPPER}} .ut-tablepress .paginate_button' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_responsive_control(
			'ut_tablepress_table_header_tools_gap',
			[
				'label' => esc_html__( 'Pagination And Serach Gap', 'ut-elementor-addons-lite' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .ut-tablepress .dataTables_length, {{WRAPPER}} .ut-tablepress .dataTables_filter' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'ut_tablepress_table_footer_tools_gap',
			[
				'label' => esc_html__( 'Footer Text And Navigation gap', 'ut-elementor-addons-lite' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .ut-tablepress .dataTables_info, {{WRAPPER}} .ut-tablepress .dataTables_paginate' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'ut_tablepress_section_style_header',
			[
				'label' => esc_html__( 'Header', 'ut-elementor-addons-lite' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_responsive_control(
			'ut_tablepress_header_background',
			[
				'label'     => esc_html__( 'Background', 'ut-elementor-addons-lite' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#dfe3e6',
				'selectors' => [
					'{{WRAPPER}} .ut-tablepress .tablepress th' => 'background-color: {{VALUE}};',
				],
			]
		);

		$this->add_responsive_control(
			'ut_tablepress_header_active_background',
			[
				'label'     => esc_html__( 'Hover And Active Background', 'ut-elementor-addons-lite' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#ccd3d8',
				'selectors' => [
					'{{WRAPPER}} .ut-tablepress .tablepress .sorting:hover, {{WRAPPER}} .ut-tablepress .tablepress .sorting_asc, {{WRAPPER}} .ut-tablepress .tablepress .sorting_desc' => 'background-color: {{VALUE}};',
				],
			]
		);

		$this->add_responsive_control(
			'ut_tablepress_header_color',
			[
				'label'     => esc_html__( 'Text Color', 'ut-elementor-addons-lite' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#333',
				'selectors' => [
					'{{WRAPPER}} .ut-tablepress .tablepress th' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'ut_tablepress_header_border_style',
			[
				'label'   => esc_html__( 'Border Style', 'ut-elementor-addons-lite' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'solid',
				'options' => [
					'none'   => esc_html__( 'None', 'ut-elementor-addons-lite' ),
					'solid'  => esc_html__( 'Solid', 'ut-elementor-addons-lite' ),
					'double' => esc_html__( 'Double', 'ut-elementor-addons-lite' ),
					'dotted' => esc_html__( 'Dotted', 'ut-elementor-addons-lite' ),
					'dashed' => esc_html__( 'Dashed', 'ut-elementor-addons-lite' ),
					'groove' => esc_html__( 'Groove', 'ut-elementor-addons-lite' ),
				],
				'selectors' => [
					'{{WRAPPER}} .ut-tablepress .tablepress th' => 'border-style: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'ut_tablepress_header_border_width',
			[
				'label'   => esc_html__( 'Border Width', 'ut-elementor-addons-lite' ),
				'type'    => Controls_Manager::SLIDER,
				'default' => [
					'min'  => 0,
					'max'  => 20,
					'size' => 1,
				],
				'selectors' => [
					'{{WRAPPER}} .ut-tablepress .tablepress th' => 'border-width: {{SIZE}}{{UNIT}};',
				],
				'condition' => [
					'ut_tablepress_header_border_style!' => 'none'
				]
			]
		);

		$this->add_control(
			'ut_tablepress_header_border_color',
			[
				'label'     => esc_html__( 'Border Color', 'ut-elementor-addons-lite' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#ccc',
				'selectors' => [
					'{{WRAPPER}} .ut-tablepress .tablepress th' => 'border-color: {{VALUE}};',
				],
				'condition' => [
					'ut_tablepress_header_border_style!' => 'none'
				]
			]
		);

		$this->add_responsive_control(
			'ut_tablepress_header_padding',
			[
				'label'      => esc_html__( 'Padding', 'ut-elementor-addons-lite' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'default'    => [
					'top'    => 1,
					'bottom' => 1,
					'left'   => 1,
					'right'  => 1,
					'unit'   => 'em'
				],
				'selectors' => [
					'{{WRAPPER}} .ut-tablepress .tablepress th' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);		

		$this->end_controls_section();

		$this->start_controls_section(
			'ut_tablepress_section_style_body',
			[
				'label' => esc_html__( 'Body', 'ut-elementor-addons-lite' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'ut_tablepress_cell_border_style',
			[
				'label'   => esc_html__( 'Border Style', 'ut-elementor-addons-lite' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'solid',
				'options' => [
					'none'   => esc_html__( 'None', 'ut-elementor-addons-lite' ),
					'solid'  => esc_html__( 'Solid', 'ut-elementor-addons-lite' ),
					'double' => esc_html__( 'Double', 'ut-elementor-addons-lite' ),
					'dotted' => esc_html__( 'Dotted', 'ut-elementor-addons-lite' ),
					'dashed' => esc_html__( 'Dashed', 'ut-elementor-addons-lite' ),
					'groove' => esc_html__( 'Groove', 'ut-elementor-addons-lite' ),
				],
				'selectors' => [
					'{{WRAPPER}} .ut-tablepress .tablepress td' => 'border-style: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'ut_tablepress_cell_border_width',
			[
				'label'   => esc_html__( 'Border Width', 'ut-elementor-addons-lite' ),
				'type'    => Controls_Manager::SLIDER,
				'default' => [
					'min'  => 0,
					'max'  => 20,
					'size' => 1,
				],
				'selectors' => [
					'{{WRAPPER}} .ut-tablepress .tablepress td' => 'border-width: {{SIZE}}{{UNIT}};',
				],
				'condition' => [
					'ut_tablepress_cell_border_style!' => 'none'
				]
			]
		);

		$this->add_responsive_control(
			'ut_tablepress_cell_padding',
			[
				'label'      => esc_html__( 'Cell Padding', 'ut-elementor-addons-lite' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'default'    => [
					'top'    => 0.5,
					'bottom' => 0.5,
					'left'   => 1,
					'right'  => 1,
					'unit'   => 'em'
				],
				'selectors' => [
					'{{WRAPPER}} .ut-tablepress .tablepress td' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
				'separator' => 'after',
			]
		);

		$this->start_controls_tabs('ut_tablepress_tabs_body_style');

		$this->start_controls_tab(
			'ut_tablepress_tab_normal',
			[
				'label' => esc_html__( 'Normal', 'ut-elementor-addons-lite' ),
			]
		);

		$this->add_control(
			'ut_tablepress_normal_background',
			[
				'label'     => esc_html__( 'Background', 'ut-elementor-addons-lite' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#fff',
				'selectors' => [
					'{{WRAPPER}} .ut-tablepress .tablepress tbody tr:nth-child(odd) td' => 'background-color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'ut_tablepress_normal_color',
			[
				'label'     => esc_html__( 'Text Color', 'ut-elementor-addons-lite' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .ut-tablepress .tablepress tbody tr:nth-child(odd) td' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'ut_tablepress_normal_border_color',
			[
				'label'     => esc_html__( 'Border Color', 'ut-elementor-addons-lite' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#ccc',
				'selectors' => [
					'{{WRAPPER}} .ut-tablepress .tablepress tbody tr:nth-child(odd) td' => 'border-color: {{VALUE}};',
				],
				'condition' => [
					'ut_tablepress_cell_border_style!' => 'none'
				]
			]
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			'ut_tablepress_tab_stripe',
			[
				'label' => esc_html__( 'Stripe', 'ut-elementor-addons-lite' ),
			]
		);

		$this->add_control(
			'ut_tablepress_stripe_background',
			[
				'label'     => esc_html__( 'Background', 'ut-elementor-addons-lite' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#f7f7f7',
				'selectors' => [
					'{{WRAPPER}} .ut-tablepress .tablepress tbody tr:nth-child(even) td' => 'background-color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'ut_tablepress_stripe_color',
			[
				'label'     => esc_html__( 'Text Color', 'ut-elementor-addons-lite' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .ut-tablepress .tablepress tbody tr:nth-child(even) td' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'ut_tablepress_stripe_border_color',
			[
				'label'     => esc_html__( 'Border Color', 'ut-elementor-addons-lite' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#ccc',
				'selectors' => [
					'{{WRAPPER}} .ut-tablepress .tablepress tbody tr:nth-child(even) td' => 'border-color: {{VALUE}};',
				],
				'condition' => [
					'ut_tablepress_cell_border_style!' => 'none'
				]
			]
		);

		$this->end_controls_tab();

		$this->end_controls_tabs();

		$this->add_control(
			'ut_tablepress_body_hover_background', 
			[
				'label'     => esc_html__( 'Hover Background', 'ut-elementor-addons-lite' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .ut-tablepress .tablepress .row-hover tr:hover td' => 'background-color: {{VALUE}};',
				],
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'ut_tablepress_section_search_layout_style',
			[
				'label'      => esc_html__( 'Filter And Search', 'ut-elementor-addons-lite' ),
				'tab'        => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'ut_tablepress_search_icon_color',
			[
				'label'     => esc_html__( 'Color', 'ut-elementor-addons-lite' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .ut-tablepress .dataTables_filter input, {{WRAPPER}} .ut-tablepress .dataTables_length select' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'ut_tablepress_search_background',
			[
				'label'     => esc_html__( 'Background', 'ut-elementor-addons-lite' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .ut-tablepress .dataTables_filter input, {{WRAPPER}} .ut-tablepress .dataTables_length select' => 'background-color: {{VALUE}};',
				],
			]
		);

		$this->add_responsive_control(
			'ut_tablepress_search_padding',
			[
				'label'      => esc_html__( 'Padding', 'ut-elementor-addons-lite' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors'  => [
					'{{WRAPPER}} .ut-tablepress .dataTables_filter input, {{WRAPPER}} .ut-tablepress .dataTables_length select' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name'        => 'ut_tablepress_search_border',
				'label'       => esc_html__( 'Border', 'ut-elementor-addons-lite' ),
				'placeholder' => '1px',
				'default'     => '1px',
				'selector'    => '{{WRAPPER}} .ut-tablepress .dataTables_filter input, {{WRAPPER}} .ut-tablepress .dataTables_length select',
			]
		);

		$this->add_responsive_control(
			'ut_tablepress_search_radius',
			[
				'label'      => esc_html__( 'Radius', 'ut-elementor-addons-lite' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors'  => [
					'{{WRAPPER}} .ut-tablepress .dataTables_filter input, {{WRAPPER}} .ut-tablepress .dataTables_length select' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name'     => 'ut_tablepress_search_box_shadow',
				'selector' => '{{WRAPPER}} .ut-tablepress .dataTables_filter input, {{WRAPPER}} .ut-tablepress .dataTables_length select',
			]
		);

		$this->end_controls_section();

	}

	private function get_shortcode() {
		$settings = $this->get_settings();
		$ut_tablepress_table_id_sanitize = isset( $settings['ut_tablepress_table_id'] ) ? intval( $settings['ut_tablepress_table_id'] ) : 0;

		if ( ! $ut_tablepress_table_id_sanitize ) {
			return;
		}

		if ( \Elementor\Plugin::instance()->editor->is_edit_mode() ) {
			\TablePress::load_controller( 'frontend' );
			$controller = new \TablePress_Frontend_Controller();
			$controller->init_shortcodes();
		}

		$attributes = [
			'id'         => $ut_tablepress_table_id_sanitize,
		];

		$this->add_render_attribute( 'shortcode', $attributes );

		$shortcode   = ['<div class="ut-tablepress ut-wid-con" id="ut_tablepress_'.esc_attr($this->get_id()).'">'];
		$shortcode[] = sprintf( '[table %s]', $this->get_render_attribute_string( 'shortcode' ) );
		$shortcode[] = '</div>';

		$output = implode("", $shortcode);

		return $output;
	}

	public function render() {
		$settings = $this->get_settings();

		if ( class_exists( 'TablePress' ) ) {
			echo do_shortcode( $this->get_shortcode() );
		}

		if ( \Elementor\Plugin::instance()->editor->is_edit_mode() ) { ?>
			<script>
				jQuery(document).ready(function($){
					jQuery('#ut_tablepress_<?php echo esc_attr( $this->get_id() ); ?>').find('.tablepress').dataTable();
				});
			</script>
		<?php }
	}

	public function render_plain_content() {
		echo $this->get_shortcode();
	}
}

Plugin::instance()->widgets_manager->register_widget_type( new UT_Elementor_Addons_Lite_Widget_Table_Press() );
