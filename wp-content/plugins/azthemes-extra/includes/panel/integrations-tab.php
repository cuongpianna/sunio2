<?php
/**
 * Integrations page in Theme Panel
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
class AZT_Integrations {

	/**
	 * Start things up
	 */
	public function __construct() {
		add_action( 'sunio_theme_panel_after_tab', array( $this, 'tab' ) );
		add_action( 'admin_init', array( $this, 'register_settings' ) );
		add_action( 'sunio_theme_panel_after_content', array( $this, 'content' ) );
	}

	/**
	 * Integrations tab
	 *
	 * @since   1.4.13
	 */
	public static function tab() {
		//Get current tab
		$curr_tab = !empty( $_GET['tab'] ) ? $_GET['tab'] : 'features';

		// Integrations url
		$integrations_url = add_query_arg(
			array(
				'page' 	=> 'sunio-panel',
				'tab' 	=> 'integrations',
			),
			'admin.php'
		); ?>

		<a href="<?php echo esc_url( $integrations_url ); ?>" class="nav-tab <?php echo $curr_tab == 'integrations' ? 'nav-tab-active' : ''; ?>"><?php esc_attr_e( 'Integrations', 'sunio' ); ?></a>

	<?php
	}

	/**
	 * Get settings.
	 *
	 * @since   1.4.13
	 */
	public static function get_settings() {

		$settings = array(
			'mailchimp_api_key'        	=> get_option( 'azt_mailchimp_api_key' ),
			'mailchimp_list_id'        	=> get_option( 'azt_mailchimp_list_id' ),
		);

		return apply_filters( 'sunio_integrations_settings', $settings );
	}

	/**
	 * Integrations content
	 *
	 * @since   1.4.13
	 */
	public static function content() {
		//Get current tab
		$curr_tab = !empty( $_GET['tab'] ) ? $_GET['tab'] : 'features';

		// Get settings
		$settings = self::get_settings(); ?>

		<div class="sunio-settings clr" <?php echo $curr_tab == 'integrations' ? '' : 'style="display:none;"'; ?>>
			<form method="post" action="options.php">

				<?php settings_fields( 'azt_integrations' ); ?>

				<div class="sunio-panels clr">

					<h2 id="mailchimp"><?php esc_html_e( 'MailChimp', 'sunio' ); ?></h2>
					<p class="description">
						<?php echo
							esc_html__( 'Used for the MailChimp widget and the Newsletter widget of the sunio Elementor Widgets extension. Follow this article to get your API Key and List ID.', 'sunio' ); ?>
					</p>

					<table class="form-table">
						<tbody>
							<tr id="azt_mailchimp_api_key_tr">
								<th scope="row">
									<label for="azt_mailchimp_api_key"><?php esc_html_e( 'API Key', 'sunio' ); ?></label>
								</th>
								<td>
									<input name="azt_integrations[mailchimp_api_key]" type="text" id="azt_mailchimp_api_key" value="<?php echo esc_attr( $settings['mailchimp_api_key'] ); ?>" class="regular-text">
								</td>
							</tr>
							<tr id="azt_mailchimp_list_id_tr">
								<th scope="row">
									<label for="azt_mailchimp_list_id"><?php esc_html_e( 'List ID', 'sunio' ); ?></label>
								</th>
								<td>
									<input name="azt_integrations[mailchimp_list_id]" type="text" id="azt_mailchimp_list_id" value="<?php echo esc_attr( $settings['mailchimp_list_id'] ); ?>" class="regular-text">
								</td>
							</tr>
						</tbody>
					</table>

					<?php do_action( 'sunio_integrations_after_content' ); ?>

					<?php submit_button(); ?>

				</div>

			</form>
		</div><!-- .sunio-settings -->

	<?php
	}

	/**
	 * Register a setting and its sanitization callback.
	 *
	 * @since   1.4.13
	 */
	public function register_settings() {
		register_setting( 'azt_integrations', 'azt_integrations', array( $this, 'sanitize_settings' ) );
	}

	/**
	 * Main Sanitization callback
	 *
	 * @since   1.4.13
	 */
	public static function sanitize_settings() {

		// Get settings
		$settings = self::get_settings();

		foreach( $settings as $key => $setting ) {
			if ( isset( $_POST['azt_integrations'][$key] ) ) {
				update_option( 'azt_'. $key, sanitize_text_field( wp_unslash( $_POST['azt_integrations'][$key] ) ) );
			}
		}

	}

}
new AZT_Integrations();