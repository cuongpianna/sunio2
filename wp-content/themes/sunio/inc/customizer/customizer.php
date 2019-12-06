<?php
/**
 * sunio Customizer Class
 *
 * @package sunio WordPress theme
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! class_exists( 'sunio_Customizer' ) ) :

	/**
	 * The sunio Customizer class
	 */
	class sunio_Customizer {

		/**
		 * Setup class.
		 *
		 * @since 1.0
		 */
		public function __construct() {

			add_action( 'customize_register',					array( $this, 'custom_controls' ) );
			add_action( 'customize_register',					array( $this, 'controls_helpers' ) );
			add_action( 'after_setup_theme',					array( $this, 'register_options' ) );
			add_action( 'customize_preview_init', 				array( $this, 'customize_preview_init' ) );
			add_action( 'customize_controls_enqueue_scripts', 	array( $this, 'custom_customize_enqueue' ), 7 );

		}

		/**
		 * Adds custom controls
		 *
		 * @since 1.0.0
		 */
		public function custom_controls( $wp_customize ) {

			// Path
			$dir = sunio_INC_DIR . 'customizer/controls/';

			// Load customize control classes
			require_once( $dir . 'buttonset/class-control-buttonset.php' 					);
			require_once( $dir . 'color/class-control-color.php' 							);		
			require_once( $dir . 'dimensions/class-control-dimensions.php' 					);
			require_once( $dir . 'dropdown-pages/class-control-dropdown-pages.php' 			);
			require_once( $dir . 'heading/class-control-heading.php' 						);
			require_once( $dir . 'icon-select/class-control-icon-select.php' 				);
			require_once( $dir . 'multicheck/class-control-multicheck.php' 					);
			require_once( $dir . 'multiple-select/class-control-multiple-select.php' 		);
			require_once( $dir . 'radio-image/class-control-radio-image.php' 				);
			require_once( $dir . 'range/class-control-range.php' 							);
			require_once( $dir . 'slider/class-control-slider.php' 							);
			require_once( $dir . 'sortable/class-control-sortable.php' 						);
			require_once( $dir . 'text/class-control-text.php' 								);
			require_once( $dir . 'textarea/class-control-textarea.php' 						);
			require_once( $dir . 'typo/class-control-typo.php' 								);
			require_once( $dir . 'typography/class-control-typography.php' 					);

			// Register JS control types
			$wp_customize->register_control_type( 'sunio_Customizer_Buttonset_Control' 		);
			$wp_customize->register_control_type( 'sunio_Customizer_Color_Control' 			);
			$wp_customize->register_control_type( 'sunio_Customizer_Dimensions_Control' 		);
			$wp_customize->register_control_type( 'sunio_Customizer_Dropdown_Pages' 			);
			$wp_customize->register_control_type( 'sunio_Customizer_Heading_Control' 			);
			$wp_customize->register_control_type( 'sunio_Customizer_Icon_Select_Control' 		);
			$wp_customize->register_control_type( 'sunio_Customize_Multicheck_Control' 		);
			$wp_customize->register_control_type( 'sunio_Customize_Multiple_Select_Control' 	);
			$wp_customize->register_control_type( 'sunio_Customizer_Range_Control' 			);
			$wp_customize->register_control_type( 'sunio_Customizer_Slider_Control' 			);
			$wp_customize->register_control_type( 'sunio_Customizer_Radio_Image_Control' 		);
			$wp_customize->register_control_type( 'sunio_Customizer_Sortable_Control' 		);
			$wp_customize->register_control_type( 'sunio_Customizer_Text_Control' 			);
			$wp_customize->register_control_type( 'sunio_Customizer_Textarea_Control' 		);
			$wp_customize->register_control_type( 'sunio_Customizer_Typo_Control' 			);
			$wp_customize->register_control_type( 'sunio_Customizer_Typography_Control' 		);

			if ( true != apply_filters( 'sunio_licence_tab_enable', false ) ) {
				require_once( $dir . 'upsell/class-control-upsell.php' 								);
				$wp_customize->register_section_type( 'sunio_Customizer_Upsell_Section_Control' 	);
			}

		}

		/**
		 * Adds customizer helpers
		 *
		 * @since 1.0.0
		 */
		public function controls_helpers() {
			require_once( sunio_INC_DIR .'customizer/customizer-helpers.php' );
			require_once( sunio_INC_DIR .'customizer/sanitization-callbacks.php' );
		}

		/**
		 * Adds customizer options
		 *
		 * @since 1.0.0
		 */
		public function register_options() {
			
			// Var
			$dir = sunio_INC_DIR .'customizer/settings/';

			// Customizer files array
			$files = array(
				'general',
				'typography',
				'topbar',
				'header',
				'blog',
				'sidebar',
				'footer-widgets',
				'footer-bottom',
			);

			foreach ( $files as $key ) {

				$setting = str_replace( '-', '_', $key );

				// If sunio Extra is activated
				if ( class_exists( 'sunio_Extra_Theme_Panel' ) ) {
					if ( sunio_Extra_Theme_Panel::get_setting( 'azt_'. $setting .'_panel' ) ) {
						require_once( $dir . $key .'.php' );
					}
				} else {

					require_once( $dir . $key .'.php' );

				}

			}

			// If WooCommerce is activated
			if ( sunio_WOOCOMMERCE_ACTIVE ) {
				require_once( $dir .'woocommerce.php' );
			}
		}

		/**
		 * Loads js file for customizer preview
		 *
		 * @since 1.0.0
		 */
		public function customize_preview_init() {
			wp_enqueue_script( 'sunio-customize-preview', sunio_INC_DIR_URI . 'customizer/assets/js/customize-preview.min.js', array( 'customize-preview' ), sunio_THEME_VERSION, true );
		}

		/**
		 * Load scripts for customizer
		 *
		 * @since 1.0.0
		 */
		public function custom_customize_enqueue() {
			wp_enqueue_style( 'font-awesome', sunio_CSS_DIR_URI .'third/font-awesome.min.css', false, '4.7.0' );
			wp_enqueue_style( 'simple-line-icons', sunio_INC_DIR_URI .'customizer/assets/css/customizer-simple-line-icons.css', false, '2.4.0' );
			wp_enqueue_style( 'sunio-general', sunio_INC_DIR_URI . 'customizer/assets/min/css/general.min.css' );
			wp_enqueue_script( 'sunio-general', sunio_INC_DIR_URI . 'customizer/assets/min/js/general.min.js', array( 'jquery', 'customize-base' ), false, true );

			if ( is_rtl() ) {
				wp_enqueue_style( 'sunio-controls-rtl', sunio_INC_DIR_URI . 'customizer/assets/min/css/rtl.min.css' );
			}
		}

	}

endif;

return new sunio_Customizer();
