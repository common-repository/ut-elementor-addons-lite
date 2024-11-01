<?php
namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) exit; 

class UT_Elementor_Addons_Lite_Widget_Calendly extends Widget_Base
{
    use \Elementor\UT_Elementor_Addons_Lite_Queries;

    public function get_name()
    {
        return "utal-calendly";
    } 

    public function get_title()
    {
        return esc_html__( "Calendly", "ut-elementor-addons-lite" );
    }

    public function get_icon()
    {
        return "eicon-calendar ut-widget-icon";
    }

    public function get_categories()
    {
        return [ "ut-elementor-addons-lite" ];
    }

    protected function register_controls()
    {
        $this->start_controls_section(
            "ut_section_pricing_table_title", 
            [
                "label" => esc_html__( "General", "ut-elementor-addons-lite" ),
            ]
        );

        $this->add_control(
            "ut_calendly_username",
            [
                "label" => esc_html__( "Username", "ut-elementor-addons-lite" ),
                "type" => Controls_Manager::TEXT,
                "placeholder" => esc_html__( "Username here", "ut-elementor-addons-lite" ),
            ]
        );

        $this->add_control(
            "ut_calendly_time", 
            [
                "label" => esc_html__( "Time Slot", "ut-elementor-addons-lite" ),
                "type" => Controls_Manager::SELECT,
                "options" => [
                    "15min" => esc_html__( "15 Minutes", "ut-elementor-addons-lite" ),
                    "30min" => esc_html__( "30 Minutes", "ut-elementor-addons-lite" ),
                    "60min" => esc_html__( "60 Minutes", "ut-elementor-addons-lite" ),
                    "" => esc_html__( "All", "ut-elementor-addons-lite" ),
                ],
                "default" => "",
            ]
        );

        $this->end_controls_section();
    }

    protected function render()
    {
        $settings = $this->get_settings();
        $ut_calendly_username = isset( $settings[ 'ut_calendly_username' ] ) ? $settings[ 'ut_calendly_username' ] : 'Username here';
        $ut_calendly_time = isset( $settings['ut_calendly_time'])!=''?"/{$settings['ut_calendly_time']}":'';
        ?>

        <?php if( $ut_calendly_username ) { ?>
            <div class="calendly-inline-widget" data-url="https://calendly.com/<?php echo esc_attr( $ut_calendly_username ); echo esc_attr( $ut_calendly_time ); ?>" style="height:800px;">
            </div>
            <?php ut_elementor_addons_lite_calendly(); } ?>

            <?php
        }
    }
    Plugin::instance()->widgets_manager->register_widget_type(
        new UT_Elementor_Addons_Lite_Widget_Calendly()
    );
