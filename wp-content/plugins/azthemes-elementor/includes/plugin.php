<?php
namespace AztElementor;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

/**
 * Main Plugin Class
 *
 * Register elementor widget.
 *
 * @since 1.0.0
 */
class AztElementorPlugin {

	/**
	 * @var Manager
	 */
	public $modules_manager;

	/**
	 * @var WPML
	 */
	public $wpml_compatibility;

	/**
	 * @var Plugin
	 */
	private static $_instance;
	/**
	 * @var Module_Base[]
	 */
	private $modules = [];

	/**
	 * Constructor
	 *
	 * @since 1.0.0
	 *
	 * @access public
	 */
	public function __construct() {
		spl_autoload_register( [ $this, 'autoload' ] );

		add_action( 'elementor/init', [ $this, 'init' ], 0 );
		add_action( 'elementor/init', [ $this, 'init_panel_section' ], 0 );
		add_action( 'elementor/elements/categories_registered', [ $this, 'init_panel_section' ] );

		// Modules to enqueue styles
		$this->modules = [
			'accordion',
			'heading',
			'principle',
			'woo_products_tabs',
			'newsletter',
            'navigation'
		];
	}

	/**
	 * Autoload Classes
	 *
	 * @since 1.0.0
	 */
	public function autoload( $class ) {
		if ( 0 !== strpos( $class, __NAMESPACE__ ) ) {
			return;
		}

		$class_to_load = $class;

		if ( ! class_exists( $class_to_load ) ) {
			$filename = strtolower(
				preg_replace(
					[ '/^' . __NAMESPACE__ . '\\\/', '/([a-z])([A-Z])/', '/_/', '/\\\/' ],
					[ '', '$1-$2', '-', DIRECTORY_SEPARATOR ],
					$class_to_load
				)
			);
			$filename = sunio_Elementor_Extra_PATH . $filename . '.php';
			if ( is_readable( $filename ) ) {
				include( $filename );
			}
		}
	}

	/**
	 * Init
	 *
	 * @since 1.0.0
	 *
	 * @access private
	 */
	public function init() {

		// Elementor hooks
		$this->add_actions();

		// Include extensions
		$this->includes();

		// Components
		$this->init_components();

		do_action( 'owp_elementor/init' );
	}

	/**
	 * Plugin instance
	 * 
	 * @since 1.0.0
	 * @return Plugin
	 */
	public static function instance() {
		if ( is_null( self::$_instance ) ) {
			self::$_instance = new self();
		}

		return self::$_instance;
	}

	/**
	 * Add Actions
	 *
	 * @since 1.0.0
	 *
	 * @access private
	 */
	private function add_actions() {

		// Front-end Scripts
		add_action( 'elementor/frontend/after_register_scripts', [ $this, 'register_scripts' ] );
		add_action( 'elementor/frontend/after_register_styles', [ $this, 'register_styles' ] );

		// Preview Styles
		add_action( 'elementor/preview/enqueue_styles', [ $this, 'preview_styles' ] );

		// Editor Style
		//add_action( 'elementor/editor/after_enqueue_styles', [ $this, 'editor_style' ] );
	}

	/**
	 * Register scripts
	 *
	 * @since 1.0.0
	 *
	 * @access public
	 */
	public function register_scripts() {

		$suffix 		= defined( 'SCRIPT_DEBUG' ) && SCRIPT_DEBUG ? '' : '.min';

		wp_register_script( 'azt-accordion',
			plugins_url( '/assets/js/accordion' . $suffix . '.js', sunio_Elementor_Extra__FILE__ ),
			[ 'jquery' ],
			false,
			true
		);
		wp_register_script( 'azt-woo_categories',
			plugins_url( '/assets/js/woo_categories' . $suffix . '.js', sunio_Elementor_Extra__FILE__ ),
			[ 'jquery' ],
			false,
			true
		);
		wp_register_script( 'azt-woo_product_tabs',
			plugins_url( '/assets/js/woo_product_tabs' . $suffix . '.js', sunio_Elementor_Extra__FILE__ ),
			[ 'jquery' ],
			false,
			true
		);
		wp_register_script( 'azt-newsletter',
			plugins_url( '/assets/js/newsletter' . $suffix . '.js', sunio_Elementor_Extra__FILE__ ),
			[ 'jquery' ],
			false,
			true
		);

        wp_register_script( 'azt-brands',
            plugins_url( '/assets/js/brands' . $suffix . '.js', sunio_Elementor_Extra__FILE__ ),
            [ 'jquery' ],
            false,
            true
        );
	}

	/**
	 * Register styles
	 *
	 * @since 1.0.0
	 *
	 * @access public
	 */
	public function register_styles() {

		$suffix = defined( 'SCRIPT_DEBUG' ) && SCRIPT_DEBUG ? '' : '.min';

//		foreach ( $this->modules as $module_name ) {
//			wp_register_style( 'azt-'. $module_name .'', plugins_url( '/assets/css/'. $module_name .'/style' . $suffix . '.css', sunio_Elementor_Extra__FILE__ ) );
//		}

        wp_register_style( 'azt-sunio', plugins_url( '/assets/css/style' . $suffix . '.css', sunio_Elementor_Extra__FILE__ ) );
	}

	/**
	 * Enqueue styles in the editor
	 *
	 * @since 1.0.0
	 *
	 * @access public
	 */
	public function preview_styles() {

		// sunio-style
		//wp_enqueue_style('sunio-style');
		foreach ( $this->modules as $module_name ) {
			wp_enqueue_style( 'azt-'. $module_name .'' );
		}

		// Fix the Woo Slider issue in the preview
		// $suffix = defined( 'SCRIPT_DEBUG' ) && SCRIPT_DEBUG ? '' : '.min';
		// wp_enqueue_style( 'azt-elementor-preview', plugins_url( '/assets/css/elementor/preview' . $suffix . '.css', sunio_Elementor_Extra__FILE__ ) );
	}

	/**
	 * Enqueue style in the editor
	 *
	 * @since 1.0.0
	 *
	 * @access public
	 */
	public function editor_style() {
		$suffix = defined( 'SCRIPT_DEBUG' ) && SCRIPT_DEBUG ? '' : '.min';
		wp_enqueue_style( 'azt-elementor-editor', plugins_url( '/assets/css/elementor/editor' . $suffix . '.css', sunio_Elementor_Extra__FILE__ ) );
	}

	/**
	 * Include components
	 *
	 * @since 1.0.0
	 *
	 * @access private
	 */
	private function includes() {
		// Modules
		include_once( sunio_Elementor_Extra_PATH .'includes/managers/modules.php' );

	}

	/**
	 * Sections init
	 *
	 * @since 1.0.0
	 *
	 * @access private
	 */
	public function init_panel_section() {
		// Theme branding
		if ( function_exists( 'azthemewp_theme_branding' ) ) {
			$brand = azthemewp_theme_branding();
		} else {
			$brand = 'AzthemeWP';
		}

		// Add element category in panel
		\Elementor\Plugin::instance()->elements_manager->add_category(
			'sunio-elements',
			array( 'title'  => $brand . ' ' . esc_html__( 'Elements', 'sunio-elementor' ), ),
			1
		);
	}

	/**
	 * Components init
	 *
	 * @since 1.0.0
	 *
	 * @access private
	 */
	private function init_components() {
		$this->modules_manager 			= new Modules_Manager();
	}
}

if ( ! defined( 'OWP_ELEMENTOR_TESTS' ) ) {
	// In tests we run the instance manually.
	AztElementorPlugin::instance();
}