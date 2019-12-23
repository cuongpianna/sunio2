<?php
/**
 * Plugin Name:			sunio Elementor
 * Description:			Add many new powerful and entirely customizable widgets to the popular free page builder - Elementor.
 * Version:				1.0

 * Text Domain: sunio-elementor
 * Domain Path: /languages/
 *
 * @package sunio_Elementor_Extra
 * @category Core
 * @author sunio.net
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Returns the main instance of sunio_Elementor_Extra to prevent the need to use globals.
 *
 * @since  1.0.0
 * @return object sunio_Elementor_Extra
 */
function sunio_Elementor_Extra() {
	return sunio_Elementor_Extra::instance();
} // End sunio_Elementor_Extra()

sunio_Elementor_Extra();

/**
 * Main sunio_Elementor_Extra Class
 *
 * @class sunio_Elementor_Extra
 * @version	1.0.0
 * @since 1.0.0
 * @package	sunio_Elementor_Extra
 */
final class sunio_Elementor_Extra {
	/**
	 * sunio_Elementor_Extra The single instance of sunio_Elementor_Extra.
	 * @var 	object
	 * @access  private
	 * @since 	1.0.0
	 */
	private static $_instance = null;

	/**
	 * The token.
	 * @var     string
	 * @access  public
	 * @since   1.0.0
	 */
	public $token;

	/**
	 * The version number.
	 * @var     string
	 * @access  public
	 * @since   1.0.0
	 */
	public $version;

	// Admin - Start
	/**
	 * The admin object.
	 * @var     object
	 * @access  public
	 * @since   1.0.0
	 */
	public $admin;

	/**
	 * Constructor function.
	 * @access  public
	 * @since   1.0.0
	 * @return  void
	 */
	public function __construct() {
		$this->token 			= 'sunio-elementor';
		$this->plugin_url 		= plugin_dir_url( __FILE__ );
		$this->plugin_path 		= plugin_dir_path( __FILE__ );
		$this->version 			= '1.1.4';

		define( 'sunio_Elementor_Extra__FILE__', __FILE__ );
		define( 'sunio_Elementor_Extra_PATH', $this->plugin_path );
		define( 'AZTHEME_ELEMENTOR_VERSION', $this->version );

		register_activation_hook( __FILE__, array( $this, 'install' ) );

		add_action( 'init', array( $this, 'load_plugin_textdomain' ) );

		add_action( 'plugins_loaded', array( $this, 'setup' ) );
		add_action( 'init', array( $this, 'updater' ), 1 );
	}

	/**
	 * Initialize License Updater.
	 * Load Updater initialize.
	 * @return void
	 */
	public function updater() {

		// Plugin Updater Code
		if ( class_exists( 'sunio_Plugin_Updater' ) ) {
			$license	= new sunio_Plugin_Updater( __FILE__, 'Elementor Widgets', $this->version, 'AzthemeWP' );
		}
	}

	/**
	 * Main sunio_Elementor_Extra Instance
	 *
	 * Ensures only one instance of sunio_Elementor_Extra is loaded or can be loaded.
	 *
	 * @since 1.0.0
	 * @static
	 * @see sunio_Elementor_Extra()
	 * @return Main sunio_Elementor_Extra instance
	 */
	public static function instance() {
		if ( is_null( self::$_instance ) )
			self::$_instance = new self();
		return self::$_instance;
	} // End instance()

	/**
	 * Load the localisation file.
	 * @access  public
	 * @since   1.0.0
	 * @return  void
	 */
	public function load_plugin_textdomain() {
		load_plugin_textdomain( 'sunio-elementor', false, dirname( plugin_basename( __FILE__ ) ) . '/languages/' );
	}

	/**
	 * Cloning is forbidden.
	 *
	 * @since 1.0.0
	 */
	public function __clone() {
		_doing_it_wrong( __FUNCTION__, __( 'Cheatin&#8217; huh?' ), '1.0.0' );
	}

	/**
	 * Unserializing instances of this class is forbidden.
	 *
	 * @since 1.0.0
	 */
	public function __wakeup() {
		_doing_it_wrong( __FUNCTION__, __( 'Cheatin&#8217; huh?' ), '1.0.0' );
	}

	/**
	 * Installation.
	 * Runs on activation. Logs the version number and assigns a notice message to a WordPress option.
	 * @access  public
	 * @since   1.0.0
	 * @return  void
	 */
	public function install() {
		$this->_log_version_number();
	}

	/**
	 * Log the plugin version number.
	 * @access  private
	 * @since   1.0.0
	 * @return  void
	 */
	private function _log_version_number() {
		// Log the version number.
		update_option( $this->token . '-version', $this->version );
	}

	/**
	 * Setup all the things.
	 * Only executes if AzthemeWP or a child theme using AzthemeWP as a parent is active and the extension specific filter returns true.
	 * @return void
	 */
	public function setup() {
		require( sunio_Elementor_Extra_PATH .'includes/plugin.php' );
		require_once( sunio_Elementor_Extra_PATH .'includes/helpers.php' );
	}

} // End Class