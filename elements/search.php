<?php
namespace Elementor;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Box_Shadow;

if ( ! defined( 'ABSPATH' ) ) exit; 

class UT_Elementor_Addons_Lite_Widget_Search extends Widget_Base {

	public function get_name() {
		return 'utal-search';
	}

	public function get_title() {
		return esc_html__( 'Search', 'ut-elementor-addons-lite' );
	}

	public function get_icon() {
		return 'eicon-search ut-widget-icon';
	}

	public function get_categories() {
		return [ 'ut-elementor-addons-lite' ];
	}

	public function get_script_depends(){
		return [
			'ut-elementor-addons-lite-script',
		];
	}

	protected function register_controls() {

		$this->start_controls_section(
			'ut_section_content',
			[
				'label' => esc_html__( 'Search', 'ut-elementor-addons-lite' ),
			]
		);

		$this->add_control(
			'ut_layout', [
				'label' => esc_html__( 'Layout', 'ut-elementor-addons-lite' ),
				'type' => Controls_Manager::SELECT,
				'default'       =>  'default',
				'options'      => array(
					'default'   => esc_html__( 'Default','ut-elementor-addons-lite' ),
					'classic'   => esc_html__( 'Classic','ut-elementor-addons-lite' ),
				),
				'toggle' => true,
			]
		);

		$this->add_control(
			'ut_placeholder', [
				'label' => esc_html__( 'Placeholder', 'ut-elementor-addons-lite' ),
				'type' => Controls_Manager::TEXT,
				'default' => esc_html__( 'Search ...','ut-elementor-addons-lite' ),
				'label_block' => true,
			]
		);

		$this->add_control(
			'ut_search_button_type',
			[
				'label'             => esc_html__( 'Search Button Type', 'ut-elementor-addons-lite' ),
				'type'              => Controls_Manager::SELECT,
				'default'           => 'text',
				'label_on'          => esc_html__( 'Icon', 'ut-elementor-addons-lite' ),
				'label_off'         => esc_html__( 'Text', 'ut-elementor-addons-lite' ),
				'options'      => array(
					'text'   => esc_html__( 'Text','ut-elementor-addons-lite' ),
					'icon'   => esc_html__( 'Icon','ut-elementor-addons-lite' ),
				),
				'condition' => [
					'ut_layout' => 'classic',
				],       
			]
		); 

		$this->add_control(
			'ut_button_text', [
				'label' => esc_html__( 'Button Text', 'ut-elementor-addons-lite' ),
				'type' => Controls_Manager::TEXT,
				'default' => esc_html__('Search','ut-elementor-addons-lite'),
				'label_block' => true,
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'      => 'ut_modal_button_text_typhography',
				'label'     => esc_html__( 'Button Text Typography', 'ut-elementor-addons-lite' ),
				'selector'  => '{{WRAPPER}} .utal-search-icon .utal-search-container form input.search-submit',
			]
		);

		$this->add_responsive_control(
			'ut_align',
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
					]
				],
				'default' => 'right',
				'selectors' => [
					'{{WRAPPER}}' => 'text-align: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'ut_icon_color',
			[
				'label'     => esc_html__( 'Icon Color', 'ut-elementor-addons-lite' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .utal-search-icon svg' => 'fill: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'ut_button_text_color',
			[
				'label'     => esc_html__( 'Button Text Color', 'ut-elementor-addons-lite' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .utal-search-icon .utal-search-container form button.search-submit svg path' => 'fill: {{VALUE}};',
					'{{WRAPPER}}  .utal-search-icon .search-submit' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'ut_button_color',
			[
				'label'     => esc_html__( 'Button Background Color', 'ut-elementor-addons-lite' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .utal-search-icon .search-submit' => 'background-color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'ut_button_hover_color',
			[
				'label'     => esc_html__( 'Button Background Hover Color', 'ut-elementor-addons-lite' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .utal-search-icon .search-submit:hover' => 'background-color: {{VALUE}};',
				],
			]
		);

		$this->end_controls_section();

	}

	protected function render() {
		$settings = $this->get_settings();
		$ut_placeholder = isset( $settings['ut_placeholder'] ) ? $settings['ut_placeholder'] : 'Search ...';
		$ut_button_text = isset( $settings['ut_button_text'] ) ? $settings['ut_button_text'] : 'Search';
		$class = isset( $settings['ut_layout'] ) ? $settings['ut_layout'] : 'default';
		$align_class = isset( $settings['align'] ) ? $settings['align'] : 'right';
		$ut_search_button_type = isset( $settings['ut_search_button_type'] ) ? $settings['ut_search_button_type'] : 'text';
		?>
		
		<div class="utal-search-icon utal <?php echo esc_attr( $class ); ?> <?php echo esc_attr( $align_class ); ?>">
			<?php if ( 'default' == $class ) { ?>
				<svg version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
				viewBox="0 0 512 512" xml:space="preserve">
				<path d="M508.875,493.792L353.089,338.005c32.358-35.927,52.245-83.296,52.245-135.339C405.333,90.917,314.417,0,202.667,0
				S0,90.917,0,202.667s90.917,202.667,202.667,202.667c52.043,0,99.411-19.887,135.339-52.245l155.786,155.786
				c2.083,2.083,4.813,3.125,7.542,3.125c2.729,0,5.458-1.042,7.542-3.125C513.042,504.708,513.042,497.958,508.875,493.792z
				M202.667,384c-99.979,0-181.333-81.344-181.333-181.333S102.688,21.333,202.667,21.333S384,102.677,384,202.667
				S302.646,384,202.667,384z"/>
			</svg>
		<?php } ?>
		<div class="utal-search-container">
			<form role="search" method="get" class="search-form" action="<?php echo esc_url( home_url( '/' ) ); ?>">
				<div class="search-group-wrap">
					<label>
						<span class="screen-reader-text"><?php echo esc_html__( 'Search for:','ut-elementor-addons-lite' ); ?></span>
						<input type="search" class="search-field" placeholder="<?php echo esc_attr( $ut_placeholder ); ?>" value="" name="s">
					</label>
					<?php if ( 'icon' == $ut_search_button_type ) { ?>
						<button type="submit" class="search-submit" value="Submit">
							<svg version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
							viewBox="0 0 512 512" xml:space="preserve">
							<path d="M508.875,493.792L353.089,338.005c32.358-35.927,52.245-83.296,52.245-135.339C405.333,90.917,314.417,0,202.667,0
							S0,90.917,0,202.667s90.917,202.667,202.667,202.667c52.043,0,99.411-19.887,135.339-52.245l155.786,155.786
							c2.083,2.083,4.813,3.125,7.542,3.125c2.729,0,5.458-1.042,7.542-3.125C513.042,504.708,513.042,497.958,508.875,493.792z
							M202.667,384c-99.979,0-181.333-81.344-181.333-181.333S102.688,21.333,202.667,21.333S384,102.677,384,202.667
							S302.646,384,202.667,384z"/>
						</svg>
					</button>
				<?php } else { ?>
					<input type="submit" class="search-submit" value="<?php echo esc_attr( $ut_button_text ); ?>">
				<?php } ?>
			</div>
		</form>
	</div>

	<?php
}
}

Plugin::instance()->widgets_manager->register_widget_type( new UT_Elementor_Addons_Lite_Widget_Search() );
