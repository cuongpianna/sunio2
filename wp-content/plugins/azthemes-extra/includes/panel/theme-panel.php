<?php
/**
 * Theme Panel
 *
 * @package sunio_Extra
 * @category Core
 * @author sunio
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

// Start Class
class sunio_Extra_Theme_Panel {

	/**
	 * Start things up
	 */
	public function __construct() {

		// Add panel menu
		add_action( 'admin_menu', 				array( 'sunio_Extra_Theme_Panel', 'add_page' ), 0 );

		// // Add panel submenu
	    add_action( 'admin_menu', 				array( 'sunio_Extra_Theme_Panel', 'add_menu_subpage' ) );

		// // Add custom CSS for the theme panel
		 add_action( 'admin_enqueue_scripts', 	array( 'sunio_Extra_Theme_Panel', 'css' ) );

		// // Register panel settings
		 add_action( 'admin_init', 				array( 'sunio_Extra_Theme_Panel', 'register_settings' ) );


	}

    
	/**
	 * Return customizer panels
	 *
	 * @since 1.0.8
	 */
	private static function get_panels() {

		$panels = array(
			'azt_general_panel' => array(
				'label'     => esc_html__( 'General Panel', 'sunio' ),
			),
			'azt_typography_panel' => array(
				'label'     => esc_html__( 'Typography Panel', 'sunio' ),
			),
			'azt_topbar_panel' => array(
				'label'     => esc_html__( 'Top Bar Panel', 'sunio' ),
			),
			'azt_header_panel' => array(
				'label'     => esc_html__( 'Header Panel', 'sunio' ),
			),
			'azt_blog_panel' => array(
				'label'     => esc_html__( 'Blog Panel', 'sunio' ),
			),
			'azt_sidebar_panel' => array(
				'label'     => esc_html__( 'Sidebar Panel', 'sunio' ),
			),
			'azt_footer_widgets_panel' => array(
				'label'     => esc_html__( 'Footer Widgets Panel', 'sunio' ),
			),
			'azt_footer_bottom_panel' => array(
				'label'     => esc_html__( 'Footer Bottom Panel', 'sunio' ),
			)
		);

		// Apply filters and return
		return apply_filters( 'azt_theme_panels', $panels );

	}

	

	/**
	 * Registers a new menu page
	 *
	 * @since 1.0.0
	 */
	public static function add_page() {
	  	add_menu_page(
			esc_html__( 'Theme Panel', 'sunio' ),
			'Theme Panel', // This menu cannot be translated because it's used for the $hook prefix
			apply_filters( 'sunio_theme_panel_capabilities', 'manage_options' ),
			'sunio-panel',
			'',
			'dashicons-admin-generic',
			null
		);
	}

	/**
	 * Registers a new submenu page
	 *
	 * @since 1.0.0
	 */
	public static function add_menu_subpage(){
		add_submenu_page(
			'sunio-general',
			esc_html__( 'General', 'sunio' ),
			esc_html__( 'General', 'sunio' ),
			apply_filters( 'sunio_theme_panel_capabilities', 'manage_options' ),
			'sunio-panel',
			array( 'sunio_Extra_Theme_Panel', 'create_admin_page' )
		);
	}

	/**
	 * Register a setting and its sanitization callback.
	 *
	 * @since 1.0.0
	 */
	public static function register_settings() {
		register_setting( 'azt_panels_settings', 'azt_panels_settings', array( 'sunio_Extra_Theme_Panel', 'validate_panels' ) );
		 
	}


	/**
	 * Main Sanitization callback
	 *
	 * @since 1.2.2
	 */
	public static function validate_panels( $settings ) {

		// Get panels array
		$panels = self::get_panels();

		foreach ( $panels as $key => $val ) {

			$settings[$key] = ! empty( $settings[$key] ) ? true : false;

		}

		// Return the validated/sanitized settings
		return $settings;

	}

	/**
	 * Get settings.
	 *
	 * @since 1.2.2
	 */
	public static function get_setting( $option = '' ) {

		$defaults = self::get_default_settings();

		$settings = wp_parse_args( get_option( 'azt_panels_settings', $defaults ), $defaults );

		return isset( $settings[ $option ] ) ? $settings[ $option ] : false;

	}

	/**
	 * Get default settings value.
	 *
	 * @since 1.2.2
	 */
	public static function get_default_settings() {

		// Get panels array
		$panels = self::get_panels();

		// Add array
		$default = array();

		foreach ( $panels as $key => $val ) {
			$default[$key] = 1;
		}

		// Return
		return apply_filters( 'azt_default_panels', $default );

	}

	
	/**
	 * Settings page output
	 *
	 * @since 1.0.0
	 */
	public static function create_admin_page() {

		// Get panels array
		$theme_panels = self::get_panels();
	?>

		<div class="wrap sunio-theme-panel clr">

			<h1><?php esc_attr_e( 'Theme Panel', 'sunio' ); ?></h1>

			<h2 class="nav-tab-wrapper">
				<?php
				//Get current tab
				$curr_tab	= !empty( $_GET['tab'] ) ? $_GET['tab'] : 'features';

				// Feature url
				$feature_url = add_query_arg(
					array(
						'page' 	=> 'sunio-panel',
						'tab' 	=> 'features',
					),
					'admin.php'
				); ?>

				<?php do_action( 'sunio_theme_panel_before_tab' ); ?>

				<a href="<?php echo esc_url( $feature_url ); ?>" class="nav-tab <?php echo $curr_tab == 'features' ? 'nav-tab-active' : ''; ?>"><?php esc_attr_e( 'Features', 'sunio' ); ?></a>

				<?php do_action( 'sunio_theme_panel_after_tab' ); ?>
			</h2>

			<?php do_action( 'sunio_theme_panel_before_content' ); ?>

			<div class="sunio-settings clr" <?php echo $curr_tab == 'features' ? '' : 'style="display:none;"'; ?>>

					<form id="sunio-theme-panel-form" method="post" action="options.php">

						<?php settings_fields( 'azt_panels_settings' ); ?>

						<div class="sunio-panels clr">

							<h2 class="sunio-title"><?php esc_html_e( 'Customizer Sections', 'sunio' ); ?></h2>

							<p class="sunio-desc"><?php esc_html_e( 'Disable the Customizer panels that you do not have or need anymore to load it quickly. Your settings are saved, so do not worry.', 'sunio' ); ?></p>

							<?php
							// Loop through theme pars and add checkboxes
							foreach ( $theme_panels as $key => $val ) :

								// Var
								$label  = isset ( $val['label'] ) ? $val['label'] : '';
								$desc  	= isset ( $val['desc'] ) ? $val['desc'] : '';

								// Get settings
								$settings = self::get_setting( $key ); ?>

								<div id="<?php echo esc_attr( $key ); ?>" class="column-wrap clr">

									<label for="sunio-switch-[<?php echo esc_attr( $key ); ?>]" class="column-name clr">
										<h3 class="title"><?php echo esc_attr( $label ); ?></h3>
									    <input type="checkbox" name="azt_panels_settings[<?php echo esc_attr( $key ); ?>]" value="true" id="sunio-switch-[<?php echo esc_attr( $key ); ?>]" <?php checked( $settings ); ?>>
										<?php if ( $desc ) { ?>
											<div class="desc"><?php echo esc_attr( $desc ); ?></div>
										<?php } ?>
									</label>

								</div>

							<?php endforeach; ?>

							<?php submit_button(); ?>

						</div>

					</form>

					<?php do_action( 'azt_theme_panel_after' ); ?>

			</div><!-- .sunio-settings -->

			<?php do_action( 'sunio_theme_panel_after_content' ); ?>

		</div>

	<?php
	}

	
	/**
	 * Theme panel CSS
	 *
	 * @since 1.0.0
	 */
	public static function css( $hook ) {

		// Only load scripts when needed
		if ( 'toplevel_page_sunio-panel' != $hook ) {
			return;
		}

		// CSS
		wp_enqueue_style( 'sunio-theme-panel', plugins_url( '/assets/css/panel.min.css', __FILE__ ) );

	}

}
new sunio_Extra_Theme_Panel();