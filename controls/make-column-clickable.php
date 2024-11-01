<?php
namespace Elementor;

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
  exit;
}

// Create class Column_Clickable
if ( ! class_exists( 'Column_Clickable' ) ) {

  class Column_Clickable {

    // Construtor to load all hooks
    public function __construct() {
      add_action( 'elementor/element/column/layout/before_section_end', array( $this, 'column_link' ));
      add_action( 'elementor/frontend/column/before_render', array( $this, 'before_render_options' ));
    }

// A control for selecting any type of files
    public function column_link( $element ) {
      $element->add_control(
        'ut_column_link',
        [
          'label'       => esc_html__( 'Column Link', 'ut-elementor-addons-lite' ),
          'type'        => Controls_Manager::URL,
          'placeholder' => esc_html__( 'https://your-link.com', 'ut-elementor-addons-lite' ),
        ]
      );
    }

    public function before_render_options( $element ) {
      $settings  = $element->get_settings_for_display();
      if ( isset( $settings['ut_column_link'], $settings['ut_column_link']['url'] ) && ! empty( $settings['ut_column_link']['url'] ) ) {
        wp_enqueue_script( 'ut-column-clickable' );
        $element->add_render_attribute( '_wrapper', 'class', 'column-clickable' );
        $element->add_render_attribute( '_wrapper', 'style', 'cursor: pointer;' );
        $element->add_render_attribute( '_wrapper', 'data-column-clickable', $settings['ut_column_link']['url'] );
        $element->add_render_attribute( '_wrapper', 'data-column-clickable-blank', $settings['ut_column_link']['is_external'] ? '_blank' : '_self' );
      }
    }

  }} new Column_Clickable();