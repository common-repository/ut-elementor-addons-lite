<?php
/**
* Plugin Name: Ultra Addons Lite for Elementor
* Plugin URI:  https://ultrapress.uncodethemes.com
* Description: Ultra Addons Lite for Elementor offers a variety of add-ons to enhance your page-building experience. Elevate your Elementor pages with creative elements and extensions, adding power and flexibility to your page builder. Our user-friendly elements are designed to simplify your next WordPress website build. Each element comes with a multitude of options, allowing you to control every aspect of your design. With your imagination, you can achieve virtually any design.
* Version:     1.1.7
* Author:      UltraPress
* Author URI:  https://ultrapress.org/
* License:     GPL-2.0-or-later
* License URI: https://www.gnu.org/licenses/gpl-2.0.html
* Domain Path: /languages
* Text Domain: ut-elementor-addons-lite
*/

defined( 'ABSPATH' ) or die( 'No script kiddies please!' );

// Check if the class UT_Elementor_Addons_Lite doesn't exist.
if ( ! class_exists( 'UT_Elementor_Addons_Lite' ) )
{

    class UT_Elementor_Addons_Lite
    {

/**
 * Constructor function for initializing the plugin.
 * - Defines constants.
 * - Includes necessary files.
 * - Hooks into various actions for plugin functionality.
 */
function __construct()
{
  $this->define_constants();
  $this->ut_elementor_addons_lite_includes();
  add_action( 'init', [ $this, 'ut_elementor_addons_lite_init' ] );
  add_action( 'plugins_loaded', [ $this, 'ut_init_plugin'] );
  add_action( 'elementor/init', [ $this, 'ut_elementor_addons_lite_widget_categories'] );
  add_action( 'elementor/frontend/after_register_scripts', [ $this,'register_frontend_assets' ] );
  add_action( 'elementor/frontend/after_enqueue_styles', [ $this, 'register_frontend_style' ] );
  add_action( 'elementor/editor/after_enqueue_styles', [ $this, 'ut_elementor_admin' ] );
  add_action('elementor/widgets/widgets_registered', [ $this,'ut_elementor_addons_lite_register' ]);
}


 /**
 * Initializes the plugin by checking if Elementor is loaded, 
 * and if not, displays an admin notice prompting to install Elementor.
 */
 function ut_init_plugin()
 {
    if ( ! did_action( 'elementor/loaded' ) )
    {
        add_action( 'admin_notices', 'ut_required_plugins_admin_notice' );
    }
}


 /**
 * Initializes the plugin by loading its text domain for localization.
 */
 function ut_elementor_addons_lite_init()
 {
    load_plugin_textdomain( 'ut-elementor-addons-lite', false, dirname( plugin_basename( __FILE__ ) ) . '/languages' );
}


/**
 * Defines constants used throughout the plugin.
 * - Defines directory paths for CSS, JS, and package assets.
 * - Defines the plugin directory path and version.
 */
function define_constants()
{
    defined( 'UTAL_CSS_DIR' ) or define( 'UTAL_CSS_DIR', plugin_dir_url( __FILE__ ) . 'assets/css' );
    defined( 'UTAL_JS_DIR' ) or define( 'UTAL_JS_DIR', plugin_dir_url( __FILE__ ) . 'assets/js' );
    defined( 'UTAL_PACKAGE_DIR' ) or define( 'UTAL_PACKAGE_DIR', plugin_dir_url( __FILE__ ) . 'assets/package' );
    defined( 'UTAL_PATH' ) or define( 'UTAL_PATH', plugin_dir_path( __FILE__ ) );
    defined( 'UTAL_PLUGIN_VERSION' ) or define( 'UTAL_PLUGIN_VERSION', '1.0.2' );
}


/**
 * Includes necessary files for plugin functionality.
 * - Includes query functions.
 * - Includes Elementor helper functions.
 * - Includes file to make columns clickable.
 */
function ut_elementor_addons_lite_includes()
{
    require_once UTAL_PATH . 'includes/queries.php';
    require_once UTAL_PATH . 'includes/elementor-helper.php';
    require_once UTAL_PATH . 'controls/make-column-clickable.php';
}


/**
 * Registers widget categories for Ultra Addons Lite plugin.
 * - Defines the category groups.
 * - Iterates over the groups to add them to Elementor.
 */
function ut_elementor_addons_lite_widget_categories()
{
    $groups = array(
        'ut-elementor-addons-lite' => esc_html__( 'Ultra Addons Lite', 'ut-elementor-addons-lite' )
    );
    foreach ( $groups as $key => $value )
    {
        \Elementor\Plugin::$instance
        ->elements_manager
        ->add_category( $key, ['title' => $value], 1 );
    }
}


/**
 * Registers all custom Elementor widgets for Ultra Addons Lite plugin.
 * - Requires all widget files.
 * - Checks if WooCommerce is active, if so, includes the products widget file.
 */
function ut_elementor_addons_lite_register()
{
    require_once plugin_dir_path( __FILE__ ) . 'elements/site-logo.php';
    require_once plugin_dir_path( __FILE__ ) . 'elements/nav-menu.php';
    require_once plugin_dir_path( __FILE__ ) . 'elements/search.php';
    require_once plugin_dir_path( __FILE__ ) . 'elements/blog-grid.php';
    require_once plugin_dir_path( __FILE__ ) . 'elements/blog-list.php';
    require_once plugin_dir_path( __FILE__ ) . 'elements/blog-block.php';
    require_once plugin_dir_path( __FILE__ ) . 'elements/slider.php';
    require_once plugin_dir_path( __FILE__ ) . 'elements/testimonial.php';
    require_once plugin_dir_path( __FILE__ ) . 'elements/content-ticker.php';
    require_once plugin_dir_path( __FILE__ ) . 'elements/team.php';
    require_once plugin_dir_path( __FILE__ ) . 'elements/flip-box.php';
    require_once plugin_dir_path( __FILE__ ) . 'elements/progress-bar.php';
    require_once plugin_dir_path( __FILE__ ) . 'elements/carousel.php';
    require_once plugin_dir_path( __FILE__ ) . 'elements/funfact.php';
    require_once plugin_dir_path( __FILE__ ) . 'elements/image-comparison.php';
    require_once plugin_dir_path( __FILE__ ) . 'elements/icon-box.php';
    require_once plugin_dir_path( __FILE__ ) . 'elements/tablepress.php';
    require_once plugin_dir_path( __FILE__ ) . 'elements/video.php';
    require_once plugin_dir_path( __FILE__ ) . 'elements/pricing-table.php';
    require_once plugin_dir_path( __FILE__ ) . 'elements/calendly.php';
    require_once plugin_dir_path( __FILE__ ) . 'elements/scroll-to-top.php';
    require_once plugin_dir_path( __FILE__ ) . 'elements/marquee.php';
    require_once plugin_dir_path( __FILE__ ) . 'elements/circle-text.php';
    require_once plugin_dir_path( __FILE__ ) . 'elements/alert.php';
    require_once plugin_dir_path( __FILE__ ) . 'elements/modal-popup.php';
    require_once plugin_dir_path( __FILE__ ) . 'elements/typeout.php';
    require_once plugin_dir_path( __FILE__ ) . 'elements/post-tab.php';

    if ( in_array( 'woocommerce/woocommerce.php', apply_filters( 'active_plugins', get_option( 'active_plugins' ) ) ) )
    {
        require_once plugin_dir_path( __FILE__ ) . 'elements/products.php';
    }
}


/**
 * Registers and enqueues frontend styles for Ultra Addons Lite plugin.
 * - Registers various stylesheets required for frontend functionality.
 * - Enqueues the main frontend stylesheet along with responsive styles and Font Awesome icons.
 */
function register_frontend_style()
{
    wp_register_style( 'jquery-lineProgressbar', UTAL_PACKAGE_DIR . '/progress-bar/jquery.lineProgressbar.min.css', array() , UTAL_PLUGIN_VERSION );
    wp_register_style( 'slick', UTAL_CSS_DIR . '/slick.css', array() , UTAL_PLUGIN_VERSION );
    wp_register_style( 'twentytwenty', UTAL_PACKAGE_DIR . '/image-comparision/twentytwenty.css', array() , UTAL_PLUGIN_VERSION );
    wp_register_style( 'jquery-dataTables', UTAL_PACKAGE_DIR . '/tablepress/jquery.dataTables.min.css', array() , UTAL_PLUGIN_VERSION );
    wp_enqueue_style( 'ut-elementor-addons-lite-frontend', UTAL_CSS_DIR . '/frontend.css', array() , UTAL_PLUGIN_VERSION );
    wp_enqueue_style( 'ut-elementor-addons-lite-responsive', UTAL_CSS_DIR . '/responsive.css', array() , UTAL_PLUGIN_VERSION );
    wp_enqueue_style( 'font-awesome-5-all', UTAL_CSS_DIR . '/all.min.css', array() , UTAL_PLUGIN_VERSION );
}


/**
 * Enqueues custom styles for Elementor editor in the WordPress admin.
 */
function ut_elementor_admin()
{
    wp_enqueue_style( 'ut-elementor-editor', UTAL_CSS_DIR . '/admin/elementor-editor.css', array() , UTAL_PLUGIN_VERSION );
}


/**
 * Registers frontend JavaScript assets.
 */
function register_frontend_assets()
{
 wp_register_script( 'ut-elementor-addons-lite-script', UTAL_JS_DIR . '/custom.js', array( 'jquery' ), UTAL_PLUGIN_VERSION, true );   
 wp_register_script( 'slick', UTAL_JS_DIR . '/slick.js', array( 'jquery' ), UTAL_PLUGIN_VERSION, true );
 wp_register_script( 'waypoints', UTAL_JS_DIR . '/waypoints.min.js', array( 'jquery' ), UTAL_PLUGIN_VERSION, true );
 wp_register_script( 'calendly', UTAL_JS_DIR . '/calendly.js', array( 'jquery' ), UTAL_PLUGIN_VERSION, true );  
 wp_register_script( 'jquery-lineProgressbar', UTAL_PACKAGE_DIR . '/progress-bar/jquery.lineProgressbar.js', array( 'jquery' ), UTAL_PLUGIN_VERSION, true );
 wp_register_script( 'jquery-easypiechart', UTAL_PACKAGE_DIR . '/easypiechart/jquery.easypiechart.min.js', array( 'jquery' ), UTAL_PLUGIN_VERSION, true ); 
 wp_register_script( 'jquery-event-move', UTAL_PACKAGE_DIR . '/image-comparision/jquery.event.move.js', array( 'jquery' ), UTAL_PLUGIN_VERSION, true );  
 wp_register_script( 'jquery-twentytwenty', UTAL_PACKAGE_DIR . '/image-comparision/jquery.twentytwenty.js', array( 'jquery' ), UTAL_PLUGIN_VERSION, true ); 
 wp_register_script( 'jquery-dataTables', UTAL_PACKAGE_DIR . '/tablepress/jquery.dataTables.min.js', array( 'jquery' ), UTAL_PLUGIN_VERSION, true );
 wp_register_script( 'ut-column-clickable', UTAL_JS_DIR . '/column-clickable.js', array( 'jquery' ), UTAL_PLUGIN_VERSION, true ); 
 wp_register_script( 'circletype', UTAL_JS_DIR . '/circletype.js', array( 'jquery' ), UTAL_PLUGIN_VERSION, true );
 wp_register_script( 'typed', UTAL_JS_DIR . '/typed.js', array( 'jquery' ), UTAL_PLUGIN_VERSION, true );
}
}


/**
 * Initializes the controls after Elementor controls are registered.
 */
function init()
{
    add_action( 'elementor/controls/controls_registered', [ $this, 'init_controls' ] );
}


/**
 * Displays an admin notice if Elementor plugin is not installed and activated.
 */
function ut_required_plugins_admin_notice()
{
    $message = sprintf(
        __(
            '%1$s requires %2$s to be installed and activated to function properly. %3$s',
            'ut-elementor-addons-lite'
        ),
        '<strong>' . esc_html__( 'Ultra Addons Lite for Elementor', 'ut-elementor-addons-lite' ) . '</strong>',
        '<strong>' . esc_html__( 'Elementor', 'ut-elementor-addons-lite' ) . '</strong>',
        '<a href="' . esc_url( admin_url( 'plugin-install.php?s=Elementor&tab=search&type=term' ) ) . '">' . esc_html__( 'Please click here to install/activate Elementor', 'ut-elementor-addons-lite' ) . '</a>'
    );
    printf('<div class="notice notice-warning is-dismissible"><p style="padding: 5px 0">%1$s</p></div>', $message);
}


// Instantiate UT_Elementor_Addons_Lite object.
$UT_Elementor_Addons_Lite_obj = new UT_Elementor_Addons_Lite();

}

