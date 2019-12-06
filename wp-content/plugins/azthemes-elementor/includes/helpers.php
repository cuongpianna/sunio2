<?php
/**
 * Helpers functions
 *
 * @package AzthemeWP WordPress theme
 */

// No direct access, please
if ( ! defined( 'ABSPATH' ) ) exit;

/**
 * Get title tags
 *
 * @since 1.1.0
 *
 */
if ( ! function_exists( 'azt_get_available_tags' ) ) {

	function azt_get_available_tags() {

	    $tags = array(
	    	'h1' 	=> __( 'H1', 'sunio-elementor' ),
			'h2' 	=> __( 'H2', 'sunio-elementor' ),
			'h3' 	=> __( 'H3', 'sunio-elementor' ),
			'h4' 	=> __( 'H4', 'sunio-elementor' ),
			'h5' 	=> __( 'H5', 'sunio-elementor' ),
			'h6' 	=> __( 'H6', 'sunio-elementor' ),
			'div' 	=> __( 'div', 'sunio-elementor' ),
			'span' 	=> __( 'span', 'sunio-elementor' ),
			'p' 	=> __( 'p', 'sunio-elementor' ),
		);
		$tags = apply_filters( 'azt_title_tags', $tags );

	    return $tags;
	}

}

if ( ! function_exists( 'azt_get_url_target' ) ) {

	function azt_get_url_target() {

	    $urlTarget = array(
			'' 	=> __( 'Default', 'sunio-elementor' ),
			'_blank' 	=> __( 'Opens the linked document in a new window or tab', 'sunio-elementor' ),
			'_self' 	=> __( 'Opens the linked document in the same frame as it was clicked (this is default)', 'sunio-elementor' ),
			'_parent' 	=> __( 'Opens the linked document in the parent frame', 'sunio-elementor' ),
			'_top' 	=> __( 'Opens the linked document in the full body of the window
			', 'sunio-elementor' ),
			'framename' 	=> __( 'Opens the linked document in a named frame
			', 'sunio-elementor' ),
		);
		$urlTarget = apply_filters( 'azt_url_target', $urlTarget );

	    return $urlTarget;
	}

}

/**
 * Get available sidebars
 *
 * @since 1.1.0
 *
 */
if ( ! function_exists( 'azt_get_available_sidebars' ) ) {

	function azt_get_available_sidebars() {
		global $wp_registered_sidebars;

	    $sidebars = array();

	    if ( ! $wp_registered_sidebars ) {
	        $sidebars['0'] = __( 'No sidebars were found', 'sunio-elementor' );
	    } else {
	        $sidebars['0'] = __( '-- Select --', 'sunio-elementor' );

	        foreach ( $wp_registered_sidebars as $id => $sidebar ) {
	            $sidebars[ $id ] = $sidebar['name'];
	        }
	    }

	    return $sidebars;
	}

}


/**
 * Get available templates
 *
 * @since 1.1.0
 *
 */
if ( ! function_exists( 'azt_get_available_templates' ) ) {

	function azt_get_available_templates() {
		$templates = get_posts( array(
            'post_type'         => 'elementor_library',
            'posts_per_page'    => -1
        ) );

		$result = array( __( '-- Select --', 'sunio-elementor' ) );
		
        if ( ! empty( $templates ) && ! is_wp_error( $templates ) ) {
            foreach ( $templates as $item ) {
                $result[ $item->ID ] = $item->post_title;
            }
        }

		return $result;
	}

}

/**
 * Check if Advanced Custom Fields plugin is active
 *
 * @since 1.1.0
 *
 */
if ( ! function_exists( 'is_acf_active' ) ) {

	function is_acf_active() {
		$return = false;

		if ( class_exists( 'acf' ) ) {
			$return = true;
		}

		return $return;
	}

}

/**
 * Check if Contact Form 7 plugin is active
 *
 * @since 1.1.0
 *
 */
if ( ! function_exists( 'is_contact_form_7_active' ) ) {

	function is_contact_form_7_active() {
		$return = false;

		if ( class_exists( 'WPCF7_ContactForm' ) ) {
			$return = true;
		}

		return $return;
	}

}

/**
 * Check if WPForms plugin is active
 *
 * @since 1.1.0
 *
 */
if ( ! function_exists( 'is_wpforms_active' ) ) {

	function is_wpforms_active() {
		$return = false;

		if ( class_exists( '\WPForms\WPForms' ) ) {
			$return = true;
		}

		return $return;
	}

}

/**
 * Check if Gravity Forms plugin is active
 *
 * @since 1.1.0
 *
 */
if ( ! function_exists( 'is_gravity_forms_active' ) ) {

	function is_gravity_forms_active() {
		$return = false;

		if ( class_exists( 'GFCommon' ) ) {
			$return = true;
		}

		return $return;
	}

}

/**
 * Check if Caldera Forms plugin is active
 *
 * @since 1.1.0
 *
 */
if ( ! function_exists( 'is_caldera_forms_active' ) ) {

	function is_caldera_forms_active() {
		$return = false;

		if ( class_exists( 'Caldera_Forms' ) ) {
			$return = true;
		}

		return $return;
	}

}

/**
 * Check if Ninja Forms plugin is active
 *
 * @since 1.1.0
 *
 */
if ( ! function_exists( 'is_ninja_forms_active' ) ) {

	function is_ninja_forms_active() {
		$return = false;

		if ( class_exists( 'Ninja_Forms' ) ) {
			$return = true;
		}

		return $return;
	}

}

/**
 * Check if WooCommerce plugin is active
 *
 * @since 1.1.0
 *
 */
if ( ! function_exists( 'is_woocommerce_active' ) ) {

	function is_woocommerce_active() {
		$return = false;

		if ( class_exists( 'WooCommerce' ) ) {
			$return = true;
		}

		return $return;
	}

}

/**
 * Check if WPML String Translation plugin is active
 *
 * @since 1.1.0
 *
 */
if ( ! function_exists( 'is_wpml_string_translation_active' ) ) {

	function is_wpml_string_translation_active() {
		include_once( ABSPATH . 'wp-admin/includes/plugin.php' );

		return is_plugin_active( 'wpml-string-translation/plugin.php' );
	}

}

/**
 * Custom excerpts based on wp_trim_words
 *
 * @since	1.0.0
 * @link	http://codex.wordpress.org/Function_Reference/wp_trim_words
 */
if ( ! function_exists( 'azt_excerpt' ) ) {

	function azt_excerpt( $length = 15 ) {

		// Get global post
		global $post;

		// Get post data
		$id			= $post->ID;
		$excerpt	= $post->post_excerpt;
		$content 	= $post->post_content;

		// Display custom excerpt
		if ( $excerpt ) {
			$output = $excerpt;
		}

		// Check for more tag
		elseif ( strpos( $content, '<!--more-->' ) ) {
			$output = get_the_content( $excerpt );
		}

		// Generate auto excerpt
		else {
			$output = wp_trim_words( strip_shortcodes( get_the_content( $id ) ), $length );
		}

		// Echo output
		echo wp_kses_post( $output );

	}

}

/**
 * Ajax search
 *
 * @since	1.0.7
 */
if ( ! function_exists( 'azt_ajax_search' ) ) {

	function azt_ajax_search() {

		$search 	= sanitize_text_field( $_POST[ 'search' ] );
        $post_type  = 'any';
        $args  		= array(
            's'                => $search,
            'post_type'        => $post_type,
            'post_status'      => 'publish',
            'posts_per_page'   => 5,
        );
		$query 		= new WP_Query( $args );
		$output 	= '';

		// Icons
		if ( is_RTL() ) {
			$icon = 'left';
		} else {
			$icon = 'right';
		}

		if ( $query->have_posts() ) {

			$output .= '<ul>';
			
				while( $query->have_posts() ) : $query->the_post();
					$output .= '<li>';
						$output .= '<a href="'. get_permalink() .'" class="search-result-link clr">';

							if ( has_post_thumbnail() ) {
								$output .= get_the_post_thumbnail( get_the_ID(), 'thumbnail', array( 'alt' => get_the_title(), 'itemprop' => 'image', ) );
							}

							$output .= '<div class="result-title">' . get_the_title() . '</div>';
							$output .= '<i class="icon fa fa-arrow-'. $icon .'" aria-hidden="true"></i>';
						$output .= '</a>';
					$output .= '</li>';
				endwhile;

				if ( $query->found_posts > 1 ) {
	            	$search_link = get_search_link( $search );
	            	
	            	/*if ( strpos( $search_link, '?' ) !== false ) {
	            		$search_link .= '?post_type='. $post_type;
	            	}*/

	                $output .= '<li><a href="' . $search_link . '" class="all-results"><span>' . sprintf( esc_html__( 'View all %d results', 'sunio-elementor' ), $query->found_posts ) . '<i class="fa fa-long-arrow-'. $icon .'" aria-hidden="true"></i></span></a></li>';
	            }

            $output .= '</ul>';
		
		} else {
			
			$output .= '<div class="azt-no-search-results">';
            $output .= '<h6>' . esc_html__( 'No results', 'sunio-elementor' ) . '</h6>';
            $output .= '<p>' . esc_html__( 'No search results could be found, please try another search.', 'sunio-elementor' ) . '</p>';
            $output .= '</div>';
			
		}
		
		wp_reset_query();

		echo $output;
		
		die();

    }

    add_action( 'wp_ajax_azt_ajax_search', 'azt_ajax_search' );
    add_action( 'wp_ajax_nopriv_azt_ajax_search', 'azt_ajax_search' );

}

/**
 * Newsletter Form
 *
 * @since	1.1.0
 */
if ( ! function_exists( 'azt_newsletter_form' ) ) {

	function azt_newsletter_form() {

		$apikey 	= get_option( 'owp_mailchimp_api_key' );
        $list_id 	= get_option( 'owp_mailchimp_list_id' );
        $email 		= ( isset( $_POST['email'] ) ) ? $_POST['email'] : '';
        $status 	= FALSE;

        if ( $email && $apikey && $list_id ) {

            $root = 'https://api.mailchimp.com/2.0';

            if ( strstr( $apikey, '-' ) ) {
                list( $key, $dc ) = explode( '-', $apikey, 2 );
            }

            $root = str_replace( 'https://api', 'https://' . $dc . '.api', $root );
            $root = rtrim( $root, '/' ) . '/';

            $params = array(
                'apikey' 			=> $apikey,
                'id' 				=> $list_id,
                'email' 			=> array( 'email' => $email ),
                'double_optin' 		=> FALSE,
                'send_welcome' 		=> FALSE,
                'replace_interests' => FALSE,
                'update_existing' 	=> TRUE
            );

            $ch 	= curl_init();
            $params = json_encode( $params );

            curl_setopt( $ch, CURLOPT_URL, $root . '/lists/subscribe' . '.json' );

            curl_setopt( $ch, CURLOPT_HTTPHEADER, array( 'Content-Type: application/json',
                'Authorization: ' . $apikey
            ) );
            curl_setopt( $ch, CURLOPT_RETURNTRANSFER, TRUE );

            curl_setopt( $ch, CURLOPT_POSTFIELDS, $params );

            $response_body  = curl_exec( $ch );
            $httpCode 		= curl_getinfo( $ch, CURLINFO_HTTP_CODE );

            curl_close( $ch );

            if ( $httpCode == 200 ) {
                $status = TRUE;
            }
        }

        wp_send_json( array( 'status' => $status ) );

    }

    add_action( 'wp_ajax_azt_newsletter_form', 'azt_newsletter_form' );
    add_action( 'wp_ajax_nopriv_azt_newsletter_form', 'azt_newsletter_form' );

}