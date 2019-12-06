<?php
/**
 * Recommends plugins for use with the theme via the TGMA Script
 *
 * @package sunio WordPress theme
 */

function sunio_tgmpa_register() {

	// Get array of recommended plugins
	$plugins = array(
			
		array(
			'name'				=> 'Elementor',
			'slug'				=> 'elementor', 
			'required'			=> false,
			'force_activation'	=> false,
		),
		array(
            'name'                     => esc_html__('sunio Elementor','sunio'),
            'slug'                     => 'sunio-elementor',
            'required'                 => true,
            'source'                   => get_template_directory() . '/plugins/sunio-elementor.zip',
        ),
        array(
            'name'                     => esc_html__('sunio Extra','sunio'),
            'slug'                     => 'sunio-extra',
            'required'                 => true,
            'source'                   => get_template_directory() . '/plugins/sunio-extra.zip',
        ),
        array(
            'name'                     => esc_html__('sunio Sticky Header','sunio'),
            'slug'                     => 'sunio-stick-header',
            'required'                 => true,
            'source'                   => get_template_directory() . '/plugins/sunio-sticky-header.zip',
        ),
	);


	// Register notice
	tgmpa( $plugins, array(
		'id'           => 'sunio_theme',
		'domain'       => 'sunio',
		'menu'         => 'install-required-plugins',
		'has_notices'  => true,
		'is_automatic' => true,
		'dismissable'  => true,
	) );

}
add_action( 'tgmpa_register', 'sunio_tgmpa_register' );