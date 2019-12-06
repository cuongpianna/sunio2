<?php
/**
 * Custom Code Customizer Options
 *
 * @package sunio WordPress theme
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! class_exists( 'sunio_Custom_Code_Customizer' ) ) :

	class sunio_Custom_Code_Customizer {

		/**
		 * Setup class.
		 *
		 * @since 1.0
		 */
		public function __construct() {

			add_action( 'customize_register', 	array( $this, 'customizer_options' ) );
			add_action( 'sunio_footer_js', 		array( $this, 'output_custom_js' ), 9999 );

		}

		/**
		 * Customizer options
		 *
		 * @since 1.0.0
		 */
		public function customizer_options( $wp_customize ) {

			/**
			 * Section
			 */
			$section = 'sunio_custom_code_panel';
			$wp_customize->add_section( $section , array(
				'title' 			=> esc_html__( 'Custom CSS/JS', 'sunio-extra' ),
				'priority' 			=> 210,
			) );

			/**
			 * Custom JS
			 */
			$wp_customize->add_setting( 'sunio_custom_js', array(
				'transport' 			=> 'postMessage',
				'sanitize_callback' 	=> false,
			) );

			$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'sunio_custom_js', array(
				'label'	   				=> esc_html__( 'Custom JS', 'sunio-extra' ),
				'description'	   		=> esc_html__( 'You need to reload to see the changes. No need to add the <script> tags.', 'sunio-extra' ),
				'type' 					=> 'textarea',
				'section'  				=> $section,
				'settings' 				=> 'sunio_custom_js',
				'priority' 				=> 10,
			) ) );

		}

		/**
		 * Outputs the custom JS
		 *
		 * @since 1.0.0
		 */
		public function output_custom_js( $output ) {

			if ( $js = get_theme_mod( 'sunio_custom_js', false ) ) {
				$output .= $js;
			}
			return $output;

		}

	}

endif;

return new sunio_Custom_Code_Customizer();