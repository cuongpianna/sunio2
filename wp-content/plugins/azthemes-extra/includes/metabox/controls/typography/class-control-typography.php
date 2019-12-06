<?php
/**
 * Typography control class.
 *
 * @package     sunio WordPress theme
 * @subpackage  Controls
 * @see   		https://github.com/justintadlock/butterbean
 * @license     http://www.gnu.org/licenses/old-licenses/gpl-2.0.html
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Typography control
 *
 * @since  1.0.0
 * @access public
 */
class sunio_ButterBean_Control_Typography extends ButterBean_Control {

	/**
	 * The type of control.
	 *
	 * @since  1.0.0
	 * @access public
	 * @var    string
	 */
	public $type = 'typography';

	/**
	 * Array 
	 *
	 * @since  1.0.0
	 * @access public
	 * @var    string
	 */
	public $l10n = array();

	/**
	 * Creates a new control object.
	 *
	 * @since  1.0.0
	 * @access public
	 * @param  object  $manager
	 * @param  string  $name
	 * @param  array   $args
	 * @return void
	 */
	public function __construct( $manager, $name, $args = array() ) {

		// Let the parent class do its thing.
		parent::__construct( $manager, $name, $args );

		// Make sure we have labels.
		$this->l10n = wp_parse_args(
			$this->l10n,
			array(
				'family'      	=> esc_html__( 'Font Family', 'sunio-portfolio' ),
				'size'        	=> esc_html__( 'Font Size',   'sunio-portfolio' ),
				'weight'      	=> esc_html__( 'Font Weight', 'sunio-portfolio' ),
				'style'      	=> esc_html__( 'Font Style',  'sunio-portfolio' ),
				'transform' 	=> esc_html__( 'Text Transform', 'sunio-portfolio' ),
				'line_height' 	=> esc_html__( 'Line Height', 'sunio-portfolio' ),
				'spacing' 		=> esc_html__( 'Letter Spacing', 'sunio-portfolio' ),
			)
		);
	}

	/**
	 * Adds custom data to the json array. This data is passed to the Underscore template.
	 *
	 * @since  1.0.0
	 * @access public
	 * @return void
	 */
	public function to_json() {
		parent::to_json();

		// Loop through each of the settings and set up the data for it.
		foreach ( $this->settings as $setting_key => $setting_id ) {

			$this->json[ $setting_key ] = array(
				'name'  => $this->get_field_name( $setting_key ),
				'value' => $this->get_value( $setting_key ),
				'label' => isset( $this->l10n[ $setting_key ] ) ? $this->l10n[ $setting_key ] : ''
			);

			if ( 'family' === $setting_key )
				$this->json[ $setting_key ]['choices'] = $this->get_font_families();

			elseif ( 'weight' === $setting_key )
				$this->json[ $setting_key ]['choices'] = $this->get_font_weight_choices();

			elseif ( 'style' === $setting_key )
				$this->json[ $setting_key ]['choices'] = $this->get_font_style_choices();

			elseif ( 'transform' === $setting_key )
				$this->json[ $setting_key ]['choices'] = $this->get_text_transform_choices();
		}

	}

	/**
	 * Returns the available font families.
	 *
	 * @since  1.0.0
	 * @access public
	 * @return array
	 */
	function get_font_families() {

		$fonts 	= array( esc_html__( 'Default', 'sunio-portfolio' ) );
		$id 	= '';

		// Add custom fonts from child themes
		if ( function_exists( 'sunio_add_custom_fonts' ) ) {
			$get_fonts = sunio_add_custom_fonts();
			if ( $get_fonts && is_array( $get_fonts ) ) {
				foreach ( $get_fonts as $font ) {
					$fonts[$font] = $font;
				}
			}
		}

		// Get Standard font options
		if ( $std_fonts = sunio_standard_fonts() ) {
			foreach ( $std_fonts as $font ) {
				$fonts[$font] = $font;
			}
		}

		// Google font options
		if ( $google_fonts = sunio_google_fonts_array() ) {
			foreach ( $google_fonts as $font ) {
				$fonts[$font] = $font;
			}
		}

		return $fonts;

	}

	/**
	 * Returns the available font weights.
	 *
	 * @since  1.0.0
	 * @access public
	 * @return array
	 */
	public function get_font_weight_choices() {

		return array(
			'' 		=> esc_html__( 'Default', 'sunio-portfolio' ),
			'100' 	=> esc_html__( 'Thin: 100', 'sunio-portfolio' ),
			'200' 	=> esc_html__( 'Light: 200', 'sunio-portfolio' ),
			'300' 	=> esc_html__( 'Book: 300', 'sunio-portfolio' ),
			'400' 	=> esc_html__( 'Normal: 400', 'sunio-portfolio' ),
			'500' 	=> esc_html__( 'Medium: 500', 'sunio-portfolio' ),
			'600' 	=> esc_html__( 'Semibold: 600', 'sunio-portfolio' ),
			'700' 	=> esc_html__( 'Bold: 700', 'sunio-portfolio' ),
			'800' 	=> esc_html__( 'Extra Bold: 800', 'sunio-portfolio' ),
			'900' 	=> esc_html__( 'Black: 900', 'sunio-portfolio' ),
		);
	}

	/**
	 * Returns the available font styles.
	 *
	 * @since  1.0.0
	 * @access public
	 * @return array
	 */
	public function get_font_style_choices() {

		return array(
			''  		=> esc_html__( 'Default', 'sunio-portfolio' ),
			'normal'  	=> esc_html__( 'Normal', 'sunio-portfolio' ),
			'italic'  	=> esc_html__( 'Italic', 'sunio-portfolio' ),
		);
	}

	/**
	 * Returns the available text transform.
	 *
	 * @since  1.0.0
	 * @access public
	 * @return array
	 */
	public function get_text_transform_choices() {

		return array(
			''  			=> esc_html__( 'Default', 'sunio-portfolio' ),
			'capitalize'  	=> esc_html__( 'Capitalize', 'sunio-portfolio' ),
			'lowercase'  	=> esc_html__( 'Lowercase', 'sunio-portfolio' ),
			'uppercase' 	=> esc_html__( 'Uppercase', 'sunio-portfolio' )
		);
	}

}
