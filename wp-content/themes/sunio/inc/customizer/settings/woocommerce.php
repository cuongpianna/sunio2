<?php
/**
 * WooCommerce Customizer Options
 *
 * @package sunio WordPress theme
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! class_exists( 'sunio_WooCommerce_Customizer' ) ) :

	class sunio_WooCommerce_Customizer {

		/**
		 * Setup class.
		 *
		 * @since 1.0
		 */
		public function __construct() {

			add_action( 'customize_register', 	array( $this, 'customizer_options' ) );
			add_filter( 'sunio_head_css', 		array( $this, 'head_css' ) );

		}

		/**Display Featured Image
		 * Customizer options
		 *
		 * @since 1.0.0
		 */
		public function customizer_options( $wp_customize ) {

			/**
			 * Panel
			 */
			$panel = 'sunio_woocommerce_panel';
			$wp_customize->add_panel( $panel , array(
				'title' 			=> esc_html__( 'WooCommerce', 'sunio' ),
				'priority' 			=> 210,
			) );

			/**
			 * Section
			 */
			$wp_customize->add_section( 'sunio_woocommerce_general' , array(
				'title' 			=> esc_html__( 'General', 'sunio' ),
				'description' 		=> esc_html__( 'For some options, you must save and refresh your live site to preview changes.', 'sunio' ),
				'priority' 			=> 10,
				'panel' 			=> $panel,
			) );

			/**
			 * Remove Custom WooCommerce Features
			 */
			$wp_customize->add_setting( 'sunio_woo_remove_custom_features', array(
				'default'           	=> 'no',
				'sanitize_callback' 	=> 'sunio_sanitize_select',
			) );

			$wp_customize->add_control( new sunio_Customizer_Buttonset_Control( $wp_customize, 'sunio_woo_remove_custom_features', array(
				'label'	   				=> esc_html__( 'Remove Custom WooCommerce Features', 'sunio' ),
				'description'	   		=> esc_html__( 'Remove all the custom WooCommerce features added for sunio, you will have the default plugin features.', 'sunio' ),
				'section'  				=> 'sunio_woocommerce_general',
				'settings' 				=> 'sunio_woo_remove_custom_features',
				'priority' 				=> 10,
				'choices' 				=> array(
					'yes' 	=> esc_html__( 'Yes', 'sunio' ),
					'no' 	=> esc_html__( 'No', 'sunio' ),
				),
			) ) );

			/**
			 * Custom WooCommerce Sidebar
			 */
			$wp_customize->add_setting( 'sunio_woo_custom_sidebar', array(
				'default'           	=> true,
				'sanitize_callback' 	=> 'sunio_sanitize_checkbox',
			) );

			$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'sunio_woo_custom_sidebar', array(
				'label'	   				=> esc_html__( 'Custom WooCommerce Sidebar', 'sunio' ),
				'type' 					=> 'checkbox',
				'section'  				=> 'sunio_woocommerce_general',
				'settings' 				=> 'sunio_woo_custom_sidebar',
				'priority' 				=> 10,
			) ) );

			/**
			 * Display Cart When Product Added
			 */
			$wp_customize->add_setting( 'sunio_woo_display_cart_product_added', array(
				'default'           	=> 'no',
				'sanitize_callback' 	=> 'sunio_sanitize_select',
			) );

			$wp_customize->add_control( new sunio_Customizer_Buttonset_Control( $wp_customize, 'sunio_woo_display_cart_product_added', array(
				'label'	   				=> esc_html__( 'Display Cart When Product Added', 'sunio' ),
				'description'	   		=> esc_html__( 'Display the cart when a product is added, work in the shop and the single product pages if ajax is enabled.', 'sunio' ),
				'section'  				=> 'sunio_woocommerce_general',
				'settings' 				=> 'sunio_woo_display_cart_product_added',
				'priority' 				=> 10,
				'choices' 				=> array(
					'yes' 	=> esc_html__( 'Yes', 'sunio' ),
					'no' 	=> esc_html__( 'No', 'sunio' ),
				),
			) ) );

			/**
			 * Categories Widget Style
			 */
			$wp_customize->add_setting( 'sunio_woo_cat_widget_style', array(
				'transport'           	=> 'postMessage',
				'default'           	=> 'default',
				'sanitize_callback' 	=> 'sunio_sanitize_select',
			) );

			$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'sunio_woo_cat_widget_style', array(
				'label'	   				=> esc_html__( 'Categories Widget Style', 'sunio' ),
				'description'	   		=> esc_html__( 'Choose the WooCommerce Categories widget style.', 'sunio' ),
				'type' 					=> 'select',
				'section'  				=> 'sunio_woocommerce_general',
				'settings' 				=> 'sunio_woo_cat_widget_style',
				'priority' 				=> 10,
				'choices' 				=> array(
					'default' 	=> esc_html__( 'Default', 'sunio' ),
					'dropdown' 	=> esc_html__( 'Dropdown', 'sunio' ),
				),
			) ) );

			/**
			 * Heading Wishlist
			 */
			$wp_customize->add_setting( 'sunio_woo_wishlist_heading', array(
				'sanitize_callback' 	=> 'wp_kses',
			) );

			$wp_customize->add_control( new sunio_Customizer_Heading_Control( $wp_customize, 'sunio_woo_wishlist_heading', array(
				'label'    	=> esc_html__( 'Wishlist', 'sunio' ),
				'description' => sprintf( esc_html__( 'You need to activate the %1$sTI WooCommerce Wishlist%2$s plugin to add a wishlist button and icon', 'sunio' ), '<a href="https://wordpress.org/plugins/ti-woocommerce-wishlist/" target="_blank">', '</a>' ),
				'section'  	=> 'sunio_woocommerce_general',
				'priority' 	=> 10,
			) ) );

			/**
			 * Add Wishlist Icon In Header
			 */
			$wp_customize->add_setting( 'sunio_woo_wishlist_icon', array(
				'default'           	=> false,
				'sanitize_callback' 	=> 'sunio_sanitize_checkbox',
			) );

			$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'sunio_woo_wishlist_icon', array(
				'label'	   				=> esc_html__( 'Add Wishlist Icon In Header', 'sunio' ),
				'type' 					=> 'checkbox',
				'section'  				=> 'sunio_woocommerce_general',
				'settings' 				=> 'sunio_woo_wishlist_icon',
				'priority' 				=> 10,
			) ) );

			/**
			 * Heading On Sale Badge
			 */
			$wp_customize->add_setting( 'sunio_woo_sale_badge_heading', array(
				'sanitize_callback' 	=> 'wp_kses',
			) );

			$wp_customize->add_control( new sunio_Customizer_Heading_Control( $wp_customize, 'sunio_woo_sale_badge_heading', array(
				'label'    	=> esc_html__( 'On Sale Badge', 'sunio' ),
				'section'  	=> 'sunio_woocommerce_general',
				'priority' 	=> 10,
			) ) );

			/**
			 * On Sale Badge Style
			 */
			$wp_customize->add_setting( 'sunio_woo_sale_badge_style', array(
				'transport'           	=> 'postMessage',
				'default'           	=> 'square',
				'sanitize_callback' 	=> 'sunio_sanitize_select',
			) );

			$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'sunio_woo_sale_badge_style', array(
				'label'	   				=> esc_html__( 'On Sale Badge Style', 'sunio' ),
				'type' 					=> 'select',
				'section'  				=> 'sunio_woocommerce_general',
				'settings' 				=> 'sunio_woo_sale_badge_style',
				'priority' 				=> 10,
				'choices' 				=> array(
					'square' 	=> esc_html__( 'Square', 'sunio' ),
					'circle' 	=> esc_html__( 'Circle', 'sunio' ),
				),
			) ) );

			/**
			 * On Sale Badge Content
			 */
			$wp_customize->add_setting( 'sunio_woo_sale_badge_content', array(
				'default'           	=> 'sale',
				'sanitize_callback' 	=> 'sunio_sanitize_select',
			) );

			$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'sunio_woo_sale_badge_content', array(
				'label'	   				=> esc_html__( 'On Sale Badge Content', 'sunio' ),
				'type' 					=> 'select',
				'section'  				=> 'sunio_woocommerce_general',
				'settings' 				=> 'sunio_woo_sale_badge_content',
				'priority' 				=> 10,
				'choices' 				=> array(
					'sale' 		=> esc_html__( 'On Sale Text', 'sunio' ),
					'percent' 	=> esc_html__( 'Percentage', 'sunio' ),
				),
			) ) );

			/**
			 * Heading My Account Page
			 */
			$wp_customize->add_setting( 'sunio_woo_account_page_heading', array(
				'sanitize_callback' 	=> 'wp_kses',
			) );

			$wp_customize->add_control( new sunio_Customizer_Heading_Control( $wp_customize, 'sunio_woo_account_page_heading', array(
				'label'    	=> esc_html__( 'My Account Page', 'sunio' ),
				'section'  	=> 'sunio_woocommerce_general',
				'priority' 	=> 10,
			) ) );

			/**
			 * My Account Page Style
			 */
			$wp_customize->add_setting( 'sunio_woo_account_page_style', array(
				'transport' 			=> 'postMessage',
				'default'           	=> 'original',
				'sanitize_callback' 	=> 'sunio_sanitize_select',
			) );

			$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'sunio_woo_account_page_style', array(
				'label'	   				=> esc_html__( 'Login/Register Style', 'sunio' ),
				'type' 					=> 'select',
				'section'  				=> 'sunio_woocommerce_general',
				'settings' 				=> 'sunio_woo_account_page_style',
				'priority' 				=> 10,
				'choices' 				=> array(
					'original' 			=> esc_html__( 'Original', 'sunio' ),
					'side' 				=> esc_html__( 'Side by Side', 'sunio' ),
				),
			) ) );

			/**
			 * Heading Category Page
			 */
			$wp_customize->add_setting( 'sunio_woo_category_page_heading', array(
				'sanitize_callback' 	=> 'wp_kses',
			) );

			$wp_customize->add_control( new sunio_Customizer_Heading_Control( $wp_customize, 'sunio_woo_category_page_heading', array(
				'label'    	=> esc_html__( 'Category Page', 'sunio' ),
				'section'  	=> 'sunio_woocommerce_general',
				'priority' 	=> 10,
			) ) );

			/**
			 * Display Featured Image
			 */
			$wp_customize->add_setting( 'sunio_woo_category_image', array(
				'default'           	=> 'no',
				'sanitize_callback' 	=> 'sunio_sanitize_select',
			) );

			$wp_customize->add_control( new sunio_Customizer_Buttonset_Control( $wp_customize, 'sunio_woo_category_image', array(
				'label'	   				=> esc_html__( 'Display Featured Image', 'sunio' ),
				'description'	   		=> esc_html__( 'Display the categories featured images before the product archives.', 'sunio' ),
				'section'  				=> 'sunio_woocommerce_general',
				'settings' 				=> 'sunio_woo_category_image',
				'priority' 				=> 10,
				'choices' 				=> array(
					'yes' 	=> esc_html__( 'Yes', 'sunio' ),
					'no' 	=> esc_html__( 'No', 'sunio' ),
				),
			) ) );

			/**
			 * Section
			 */
			$wp_customize->add_section( 'sunio_woocommerce_menu_cart' , array(
				'title' 			=> esc_html__( 'Menu Cart', 'sunio' ),
				'description' 		=> esc_html__( 'For some options, you must save and refresh your live site to preview changes.', 'sunio' ),
				'priority' 			=> 10,
				'panel' 			=> $panel,
			) );

			/**
			 * Hide If Empty
			 */
			$wp_customize->add_setting( 'sunio_woo_menu_icon_hide_if_empty', array(
				'default'           	=> false,
				'sanitize_callback' 	=> 'sunio_sanitize_checkbox',
			) );

			$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'sunio_woo_menu_icon_hide_if_empty', array(
				'label'	   				=> esc_html__( 'Hide If Empty Cart', 'sunio' ),
				'type' 					=> 'checkbox',
				'section'  				=> 'sunio_woocommerce_menu_cart',
				'settings' 				=> 'sunio_woo_menu_icon_hide_if_empty',
				'priority' 				=> 10,
			) ) );

			/**
			 * Display Mini Cart On Mobile
			 */
			$wp_customize->add_setting( 'sunio_woo_add_mobile_mini_cart', array(
				'default'           	=> true,
				'sanitize_callback' 	=> 'sunio_sanitize_checkbox',
			) );

			$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'sunio_woo_add_mobile_mini_cart', array(
				'label'	   				=> esc_html__( 'Display Mini Cart On Mobile', 'sunio' ),
				'type' 					=> 'checkbox',
				'section'  				=> 'sunio_woocommerce_menu_cart',
				'settings' 				=> 'sunio_woo_add_mobile_mini_cart',
				'priority' 				=> 10,
			) ) );

			/**
			 * Visibility
			 */
			$wp_customize->add_setting( 'sunio_woo_menu_icon_visibility', array(
				'default'           	=> 'default',
				'sanitize_callback' 	=> 'sunio_sanitize_select',
			) );

			$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'sunio_woo_menu_icon_visibility', array(
				'label'	   				=> esc_html__( 'Visibility', 'sunio' ),
				'type' 					=> 'select',
				'section'  				=> 'sunio_woocommerce_menu_cart',
				'settings' 				=> 'sunio_woo_menu_icon_visibility',
				'priority' 				=> 10,
				'choices' 				=> array(
					'default' 			=> esc_html__( 'Display On All Devices', 'sunio' ),
					'disabled' 			=> esc_html__( 'Disabled On All Devices', 'sunio' ),
					'disabled_desktop' 	=> esc_html__( 'Disabled Only On Desktop', 'sunio' ),
				),
			) ) );

			/**
			 * Bag Style
			 */
			$wp_customize->add_setting( 'sunio_woo_menu_bag_style', array(
				'default'           	=> 'no',
				'sanitize_callback' 	=> 'sunio_sanitize_select',
			) );

			$wp_customize->add_control( new sunio_Customizer_Buttonset_Control( $wp_customize, 'sunio_woo_menu_bag_style', array(
				'label'	   				=> esc_html__( 'Bag Style', 'sunio' ),
				'description'	   		=> esc_html__( 'This setting rep^lace the cart icon by a bag with the items count in it.', 'sunio' ),
				'section'  				=> 'sunio_woocommerce_menu_cart',
				'settings' 				=> 'sunio_woo_menu_bag_style',
				'priority' 				=> 10,
				'choices' 				=> array(
					'yes' 	=> esc_html__( 'Yes', 'sunio' ),
					'no' 	=> esc_html__( 'No', 'sunio' ),
				),
			) ) );

			/**
			 * Bag Style Total
			 */
			$wp_customize->add_setting( 'sunio_woo_menu_bag_style_total', array(
				'default'           	=> false,
				'sanitize_callback' 	=> 'sunio_sanitize_checkbox',
			) );

			$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'sunio_woo_menu_bag_style_total', array(
				'label'	   				=> esc_html__( 'Bag Icon Display Total', 'sunio' ),
				'type' 					=> 'checkbox',
				'section'  				=> 'sunio_woocommerce_menu_cart',
				'settings' 				=> 'sunio_woo_menu_bag_style_total',
				'priority' 				=> 10,
				'active_callback' 		=> 'sunio_cac_has_woo_bag_style',
			) ) );

			/**
			 * Bag Icon Color
			 */
			$wp_customize->add_setting( 'sunio_woo_menu_bag_icon_color', array(
				'transport' 			=> 'postMessage',
				'default' 				=> '#333333',
				'sanitize_callback' 	=> 'sunio_sanitize_color',
			) );

			$wp_customize->add_control( new sunio_Customizer_Color_Control( $wp_customize, 'sunio_woo_menu_bag_icon_color', array(
				'label'	   				=> esc_html__( 'Bag Icon Color', 'sunio' ),
				'section'  				=> 'sunio_woocommerce_menu_cart',
				'settings' 				=> 'sunio_woo_menu_bag_icon_color',
				'priority' 				=> 10,
				'active_callback' 		=> 'sunio_cac_has_woo_bag_style',
			) ) );

			/**
			 * Bag Icon Hover Color
			 */
			$wp_customize->add_setting( 'sunio_woo_menu_bag_icon_hover_color', array(
				'transport' 			=> 'postMessage',
				'default' 				=> '#13aff0',
				'sanitize_callback' 	=> 'sunio_sanitize_color',
			) );

			$wp_customize->add_control( new sunio_Customizer_Color_Control( $wp_customize, 'sunio_woo_menu_bag_icon_hover_color', array(
				'label'	   				=> esc_html__( 'Bag Icon Hover Color', 'sunio' ),
				'section'  				=> 'sunio_woocommerce_menu_cart',
				'settings' 				=> 'sunio_woo_menu_bag_icon_hover_color',
				'priority' 				=> 10,
				'active_callback' 		=> 'sunio_cac_has_woo_bag_style',
			) ) );

			/**
			 * Bag Icon Count Color
			 */
			$wp_customize->add_setting( 'sunio_woo_menu_bag_icon_count_color', array(
				'transport' 			=> 'postMessage',
				'default' 				=> '#333333',
				'sanitize_callback' 	=> 'sunio_sanitize_color',
			) );

			$wp_customize->add_control( new sunio_Customizer_Color_Control( $wp_customize, 'sunio_woo_menu_bag_icon_count_color', array(
				'label'	   				=> esc_html__( 'Bag Icon Count Color', 'sunio' ),
				'section'  				=> 'sunio_woocommerce_menu_cart',
				'settings' 				=> 'sunio_woo_menu_bag_icon_count_color',
				'priority' 				=> 10,
				'active_callback' 		=> 'sunio_cac_has_woo_bag_style',
			) ) );

			/**
			 * Bag Icon Hover Count Color
			 */
			$wp_customize->add_setting( 'sunio_woo_menu_bag_icon_hover_count_color', array(
				'transport' 			=> 'postMessage',
				'default' 				=> '#ffffff',
				'sanitize_callback' 	=> 'sunio_sanitize_color',
			) );

			$wp_customize->add_control( new sunio_Customizer_Color_Control( $wp_customize, 'sunio_woo_menu_bag_icon_hover_count_color', array(
				'label'	   				=> esc_html__( 'Bag Icon Hover Count Color', 'sunio' ),
				'section'  				=> 'sunio_woocommerce_menu_cart',
				'settings' 				=> 'sunio_woo_menu_bag_icon_hover_count_color',
				'priority' 				=> 10,
				'active_callback' 		=> 'sunio_cac_has_woo_bag_style',
			) ) );

			/**
			 * Display
			 */
			$wp_customize->add_setting( 'sunio_woo_menu_icon_display', array(
				'default'           	=> 'icon_count',
				'sanitize_callback' 	=> 'sunio_sanitize_select',
			) );

			$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'sunio_woo_menu_icon_display', array(
				'label'	   				=> esc_html__( 'Display', 'sunio' ),
				'type' 					=> 'select',
				'section'  				=> 'sunio_woocommerce_menu_cart',
				'settings' 				=> 'sunio_woo_menu_icon_display',
				'priority' 				=> 10,
				'choices' 				=> array(
					'icon' 				=> esc_html__( 'Icon', 'sunio' ),
					'icon_total' 		=> esc_html__( 'Icon And Cart Total', 'sunio' ),
					'icon_count' 		=> esc_html__( 'Icon And Cart Count', 'sunio' ),
					'icon_count_total' 	=> esc_html__( 'Icon And Cart Count + Total', 'sunio' ),
				),
				'active_callback' 		=> 'sunio_cac_hasnt_woo_bag_style',
			) ) );

			/**
			 * Style
			 */
			$wp_customize->add_setting( 'sunio_woo_menu_icon_style', array(
				'transport'           	=> 'postMessage',
				'default'           	=> 'drop_down',
				'sanitize_callback' 	=> 'sunio_sanitize_select',
			) );

			$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'sunio_woo_menu_icon_style', array(
				'label'	   				=> esc_html__( 'Style', 'sunio' ),
				'type' 					=> 'select',
				'section'  				=> 'sunio_woocommerce_menu_cart',
				'settings' 				=> 'sunio_woo_menu_icon_style',
				'priority' 				=> 10,
				'choices' 				=> array(
					'drop_down' 		=> esc_html__( 'Drop-Down', 'sunio' ),
					'cart' 				=> esc_html__( 'Go To Cart', 'sunio' ),
					'custom_link' 		=> esc_html__( 'Custom Link', 'sunio' ),
				),
			) ) );

			/**
			 * Custom Link
			 */
			$wp_customize->add_setting( 'sunio_woo_menu_icon_custom_link', array(
				'transport'           	=> 'postMessage',
				'sanitize_callback' 	=> 'esc_url_raw',
			) );

			$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'sunio_woo_menu_icon_custom_link', array(
				'label'	   				=> esc_html__( 'Custom Link', 'sunio' ),
				'description'	   		=> esc_html__( 'The Custom Link style need to be selected', 'sunio' ),
				'type' 					=> 'text',
				'section'  				=> 'sunio_woocommerce_menu_cart',
				'settings' 				=> 'sunio_woo_menu_icon_custom_link',
				'priority' 				=> 10,
			) ) );

			/**
			 * Icon
			 */
			$wp_customize->add_setting( 'sunio_woo_menu_icon', array(
				'transport' 			=> 'postMessage',
				'default'           	=> 'icon-handbag',
				'sanitize_callback' 	=> 'wp_filter_nohtml_kses',
			) );

			$wp_customize->add_control( new sunio_Customizer_Icon_Select_Control( $wp_customize, 'sunio_woo_menu_icon', array(
				'label'	   				=> esc_html__( 'Cart Icon', 'sunio' ),
				'section'  				=> 'sunio_woocommerce_menu_cart',
				'settings' 				=> 'sunio_woo_menu_icon',
				'priority' 				=> 10,
			    'choices' 				=> sunio_get_cart_icons(),
				'active_callback' 		=> 'sunio_cac_hasnt_woo_bag_style',
			) ) );

			/**
			 * Custom Icon
			 */
			$wp_customize->add_setting( 'sunio_woo_menu_custom_icon', array(
				'transport'           	=> 'postMessage',
				'sanitize_callback' 	=> 'wp_filter_nohtml_kses',
			) );

			$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'sunio_woo_menu_custom_icon', array(
				'label'	   				=> esc_html__( 'Custom Icon', 'sunio' ),
				'description'	   		=> esc_html__( 'Enter your full icon class', 'sunio' ),
				'type' 					=> 'text',
				'section'  				=> 'sunio_woocommerce_menu_cart',
				'settings' 				=> 'sunio_woo_menu_custom_icon',
				'priority' 				=> 10,
				'active_callback' 		=> 'sunio_cac_hasnt_woo_bag_style',
			) ) );

			/**
			 * Icon Size
			 */
			$wp_customize->add_setting( 'sunio_woo_menu_icon_size', array(
				'transport' 			=> 'postMessage',
				'sanitize_callback' 	=> 'sunio_sanitize_number_blank',
			) );
			$wp_customize->add_setting( 'sunio_woo_menu_icon_size_tablet', array(
				'transport' 			=> 'postMessage',
				'sanitize_callback' 	=> 'sunio_sanitize_number_blank',
			) );

			$wp_customize->add_setting( 'sunio_woo_menu_icon_size_mobile', array(
				'transport' 			=> 'postMessage',
				'sanitize_callback' 	=> 'sunio_sanitize_number_blank',
			) );

			$wp_customize->add_control( new sunio_Customizer_Slider_Control( $wp_customize, 'sunio_woo_menu_icon_size', array(
				'label'	   				=> esc_html__( 'Icon Size (px)', 'sunio' ),
				'section'  				=> 'sunio_woocommerce_menu_cart',
				'settings' => array(
		            'desktop' 	=> 'sunio_woo_menu_icon_size',
		            'tablet' 	=> 'sunio_woo_menu_icon_size_tablet',
		            'mobile' 	=> 'sunio_woo_menu_icon_size_mobile',
			    ),
				'priority' 				=> 10,
			    'input_attrs' 			=> array(
			        'min'   => 10,
			        'max'   => 100,
			        'step'  => 1,
			    ),
				'active_callback' 		=> 'sunio_cac_hasnt_woo_bag_style',
			) ) );

            /**
             *  Cart Logo
             */

            $wp_customize->add_setting( 'sunio_cart_logo', array(
                'default'           	=> '',
                'sanitize_callback' 	=> 'sunio_sanitize_image',
            ) );

            $wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'sunio_cart_logo', array(
                'label'	   				=> esc_html__( 'Cart Logo', 'sunio' ),
                'section'  				=> 'sunio_woocommerce_menu_cart',
                'settings' 				=> 'sunio_cart_logo',
                'priority' 				=> 10,
            ) ) );

			/**
			 * Center Vertically
			 */
			$wp_customize->add_setting( 'sunio_woo_menu_icon_center_vertically', array(
				'transport' 			=> 'postMessage',
				'sanitize_callback' 	=> 'sunio_sanitize_number_blank',
			) );
			$wp_customize->add_setting( 'sunio_woo_menu_icon_center_vertically_tablet', array(
				'transport' 			=> 'postMessage',
				'sanitize_callback' 	=> 'sunio_sanitize_number_blank',
			) );

			$wp_customize->add_setting( 'sunio_woo_menu_icon_center_vertically_mobile', array(
				'transport' 			=> 'postMessage',
				'sanitize_callback' 	=> 'sunio_sanitize_number_blank',
			) );

			$wp_customize->add_control( new sunio_Customizer_Slider_Control( $wp_customize, 'sunio_woo_menu_icon_center_vertically', array(
				'label'	   				=> esc_html__( 'Center Vertically', 'sunio' ),
				'description'	   		=> esc_html__( 'Use this field to center your icon vertically', 'sunio' ),
				'section'  				=> 'sunio_woocommerce_menu_cart',
				'settings' => array(
		            'desktop' 	=> 'sunio_woo_menu_icon_center_vertically',
		            'tablet' 	=> 'sunio_woo_menu_icon_center_vertically_tablet',
		            'mobile' 	=> 'sunio_woo_menu_icon_center_vertically_mobile',
			    ),
				'priority' 				=> 10,
			    'input_attrs' 			=> array(
			        'min'   => 0,
			        'max'   => 100,
			        'step'  => 1,
			    ),
				'active_callback' 		=> 'sunio_cac_hasnt_woo_bag_style',
			) ) );

			/**
			 * Heading Styling
			 */
			$wp_customize->add_setting( 'sunio_woo_cart_dropdowns_styling_heading', array(
				'sanitize_callback' 	=> 'wp_kses',
			) );

			$wp_customize->add_control( new sunio_Customizer_Heading_Control( $wp_customize, 'sunio_woo_cart_dropdowns_styling_heading', array(
				'label'    	=> esc_html__( 'Cart Dropdown Styling', 'sunio' ),
				'section'  	=> 'sunio_woocommerce_menu_cart',
				'priority' 	=> 10,
			) ) );

			/**
			 * Style
			 */
			$wp_customize->add_setting( 'sunio_woo_cart_dropdown_style', array(
				'transport' 			=> 'postMessage',
				'default'           	=> 'compact',
				'sanitize_callback' 	=> 'sunio_sanitize_select',
			) );

			$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'sunio_woo_cart_dropdown_style', array(
				'label'	   				=> esc_html__( 'Style', 'sunio' ),
				'type' 					=> 'select',
				'section'  				=> 'sunio_woocommerce_menu_cart',
				'settings' 				=> 'sunio_woo_cart_dropdown_style',
				'priority' 				=> 10,
				'choices' 				=> array(
					'compact' 		=> esc_html__( 'Compact', 'sunio' ),
					'spacious' 		=> esc_html__( 'Spacious', 'sunio' ),
				),
			) ) );

			/**
			 * Section
			 */
			$wp_customize->add_section( 'sunio_woocommerce_archives' , array(
				'title' 			=> esc_html__( 'Archives', 'sunio' ),
				'priority' 			=> 10,
				'panel' 			=> $panel,
			) );

            /**
             * Sidebar
             */

            $wp_customize->add_setting( 'sunio_sidebar_type', array(
                'default'           	=> 'woo-sidebar',
                'sanitize_callback' 	=> 'sunio_sanitize_select',
            ) );

            $wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'sunio_sidebar_type', array(
                'label'	   				=> esc_html__( 'Sidebar Type', 'sunio' ),
                'type' 					=> 'select',
                'section'  				=> 'sunio_woocommerce_archives',
                'settings' 				=> 'sunio_sidebar_type',
                'priority' 				=> 10,
                'choices' 				=> array(
                    'woo-sidebar' 	=> esc_html__( 'Woo Sidebar', 'sunio' ),
                    'default-sidebar' 	=> esc_html__( 'Default Sidebar', 'sunio' ),
                ),
                'active_callback' 		=> 'sunio_cac_has_woo_shop_rl_layout',
            ) ) );

			/**
			 * Layout
			 */
			$wp_customize->add_setting( 'sunio_woo_shop_layout', array(
				'default'           	=> 'left-sidebar',
				'sanitize_callback' 	=> 'sunio_sanitize_select',
			) );

			$wp_customize->add_control( new sunio_Customizer_Radio_Image_Control( $wp_customize, 'sunio_woo_shop_layout', array(
				'label'	   				=> esc_html__( 'Layout', 'sunio' ),
				'section'  				=> 'sunio_woocommerce_archives',
				'settings' 				=> 'sunio_woo_shop_layout',
				'priority' 				=> 10,
				'choices' 				=> sunio_customizer_layout(),
			) ) );

			/**
			 * Both Sidebars Style
			 */
			$wp_customize->add_setting( 'sunio_woo_shop_both_sidebars_style', array(
				'default'           	=> 'scs-style',
				'sanitize_callback' 	=> 'sunio_sanitize_select',
			) );

			$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'sunio_woo_shop_both_sidebars_style', array(
				'label'	   				=> esc_html__( 'Both Sidebars: Style', 'sunio' ),
				'type' 					=> 'select',
				'section'  				=> 'sunio_woocommerce_archives',
				'settings' 				=> 'sunio_woo_shop_both_sidebars_style',
				'priority' 				=> 10,
				'choices' 				=> array(
					'ssc-style' 		=> esc_html__( 'Sidebar / Sidebar / Content', 'sunio' ),
					'scs-style' 		=> esc_html__( 'Sidebar / Content / Sidebar', 'sunio' ),
					'css-style' 		=> esc_html__( 'Content / Sidebar / Sidebar', 'sunio' ),
				),
				'active_callback' 		=> 'sunio_cac_has_woo_shop_bs_layout',
			) ) );

			/**
			 * Both Sidebars Content Width
			 */
			$wp_customize->add_setting( 'sunio_woo_shop_both_sidebars_content_width', array(
				'transport' 			=> 'postMessage',
				'sanitize_callback' 	=> 'sunio_sanitize_number_blank',
			) );

			$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'sunio_woo_shop_both_sidebars_content_width', array(
				'label'	   				=> esc_html__( 'Both Sidebars: Content Width (%)', 'sunio' ),
				'type' 					=> 'number',
				'section'  				=> 'sunio_woocommerce_archives',
				'settings' 				=> 'sunio_woo_shop_both_sidebars_content_width',
				'priority' 				=> 10,
			    'input_attrs' 			=> array(
			        'min'   => 0,
			        'max'   => 100,
			        'step'  => 1,
			    ),
				'active_callback' 		=> 'sunio_cac_has_woo_shop_bs_layout',
			) ) );

			/**
			 * Both Sidebars Sidebars Width
			 */
			$wp_customize->add_setting( 'sunio_woo_shop_both_sidebars_sidebars_width', array(
				'transport' 			=> 'postMessage',
				'sanitize_callback' 	=> 'sunio_sanitize_number_blank',
			) );

			$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'sunio_woo_shop_both_sidebars_sidebars_width', array(
				'label'	   				=> esc_html__( 'Both Sidebars: Sidebars Width (%)', 'sunio' ),
				'type' 					=> 'number',
				'section'  				=> 'sunio_woocommerce_archives',
				'settings' 				=> 'sunio_woo_shop_both_sidebars_sidebars_width',
				'priority' 				=> 10,
			    'input_attrs' 			=> array(
			        'min'   => 0,
			        'max'   => 100,
			        'step'  => 1,
			    ),
				'active_callback' 		=> 'sunio_cac_has_woo_shop_bs_layout',
			) ) );

			/**
			 * Mobile Sidebar Order
			 */
			$wp_customize->add_setting( 'sunio_woo_shop_sidebar_order', array(
				'default'           	=> 'content-sidebar',
				'sanitize_callback' 	=> 'sunio_sanitize_select',
			) );

			$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'sunio_woo_shop_sidebar_order', array(
				'label'	   				=> esc_html__( 'Mobile Sidebar Order', 'sunio' ),
				'type' 					=> 'select',
				'section'  				=> 'sunio_woocommerce_archives',
				'settings' 				=> 'sunio_woo_shop_sidebar_order',
				'priority' 				=> 10,
				'choices' 				=> array(
					'content-sidebar' 	=> esc_html__( 'Content / Sidebar', 'sunio' ),
					'sidebar-content' 	=> esc_html__( 'Sidebar / Content', 'sunio' ),
				),
				'active_callback' 		=> 'sunio_cac_has_woo_shop_rl_layout',
			) ) );

			/**
			 * Shop Posts Per Page
			 */
			$wp_customize->add_setting( 'sunio_woo_shop_posts_per_page', array(
				'default'           	=> '12',
				'sanitize_callback' 	=> 'sunio_sanitize_number',
			) );

			$wp_customize->add_control( new sunio_Customizer_Range_Control( $wp_customize, 'sunio_woo_shop_posts_per_page', array(
				'label'	   				=> esc_html__( 'Shop Posts Per Page', 'sunio' ),
				'section'  				=> 'sunio_woocommerce_archives',
				'settings' 				=> 'sunio_woo_shop_posts_per_page',
				'priority' 				=> 10,
			    'input_attrs' 			=> array(
			        'min'   => 1,
			        'max'   => 100,
			        'step'  => 1,
			    ),
			) ) );

			/**
			 * Shop Columns
			 */
			$wp_customize->add_setting( 'sunio_woocommerce_shop_columns', array(
				'transport' 			=> 'postMessage',
				'default'           	=> '4',
				'sanitize_callback' 	=> 'sunio_sanitize_number',
			) );

			$wp_customize->add_setting( 'sunio_woocommerce_tablet_shop_columns', array(
				'transport' 			=> 'postMessage',
				'sanitize_callback' 	=> 'sunio_sanitize_number_blank',
			) );

			$wp_customize->add_setting( 'sunio_woocommerce_mobile_shop_columns', array(
				'transport' 			=> 'postMessage',
				'sanitize_callback' 	=> 'sunio_sanitize_number_blank',
			) );

			$wp_customize->add_control( new sunio_Customizer_Slider_Control( $wp_customize, 'sunio_woocommerce_shop_columns', array(
				'label' 			=> esc_html__( 'Shop Columns', 'sunio' ),
				'section'  			=> 'sunio_woocommerce_archives',
				'settings' => array(
		            'desktop' 	=> 'sunio_woocommerce_shop_columns',
		            'tablet' 	=> 'sunio_woocommerce_tablet_shop_columns',
		            'mobile' 	=> 'sunio_woocommerce_mobile_shop_columns',
			    ),
				'priority' 				=> 10,
			    'input_attrs' 			=> array(
			        'min'   => 1,
			        'max'   => 7,
			        'step'  => 1,
			    ),
			) ) );

			/**
			 * Toolbar Heading
			 */
			$wp_customize->add_setting( 'sunio_woocommerce_shop_toolbar_heading', array(
				'sanitize_callback' 	=> 'wp_kses',
			) );

			$wp_customize->add_control( new sunio_Customizer_Heading_Control( $wp_customize, 'sunio_woocommerce_shop_toolbar_heading', array(
				'label'    				=> esc_html__( 'Toolbar', 'sunio' ),
				'section'  				=> 'sunio_woocommerce_archives',
				'priority' 				=> 10,
			) ) );

			/**
			 * Grid/List Buttons
			 */
			$wp_customize->add_setting( 'sunio_woo_grid_list', array(
				'default'           	=> true,
				'sanitize_callback' 	=> 'sunio_sanitize_checkbox',
			) );

			$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'sunio_woo_grid_list', array(
				'label'	   				=> esc_html__( 'Grid/List Buttons', 'sunio' ),
				'type' 					=> 'checkbox',
				'section'  				=> 'sunio_woocommerce_archives',
				'settings' 				=> 'sunio_woo_grid_list',
				'priority' 				=> 10,
			) ) );

			/**
			 * Catalog View
			 */
			$wp_customize->add_setting( 'sunio_woo_catalog_view', array(
				'default'           	=> 'grid',
				'sanitize_callback' 	=> 'sunio_sanitize_select',
			) );

			$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'sunio_woo_catalog_view', array(
				'label'	   				=> esc_html__( 'Default Catalog View', 'sunio' ),
				'type' 					=> 'select',
				'section'  				=> 'sunio_woocommerce_archives',
				'settings' 				=> 'sunio_woo_catalog_view',
				'priority' 				=> 10,
				'choices' 				=> array(
					'grid'  	=> esc_html__( 'Grid View', 'sunio' ),
					'list' 		=> esc_html__( 'List View', 'sunio' ),
				),
				'active_callback' 		=> 'sunio_cac_has_grid_list_buttons',
			) ) );

			/**
			 * List View Excerpt Length
			 */
			$wp_customize->add_setting( 'sunio_woo_list_excerpt_length', array(
				'default'           	=> '10',
				'sanitize_callback' 	=> 'sunio_sanitize_number',
			) );

			$wp_customize->add_control( new sunio_Customizer_Range_Control( $wp_customize, 'sunio_woo_list_excerpt_length', array(
				'label'	   				=> esc_html__( 'Excerpt Length', 'sunio' ),
				'description'	   		=> esc_html__( 'Length of the short description of the list view.', 'sunio' ),
				'section'  				=> 'sunio_woocommerce_archives',
				'settings' 				=> 'sunio_woo_list_excerpt_length',
				'priority' 				=> 10,
			    'input_attrs' 			=> array(
			        'min'   => 0,
			        'max'   => 500,
			        'step'  => 1,
			    ),
				'active_callback' 		=> 'sunio_cac_has_grid_list_buttons',
			) ) );

			/**
			 * Shop Sort
			 */
			$wp_customize->add_setting( 'sunio_woo_shop_sort', array(
				'default'           	=> false,
				'sanitize_callback' 	=> 'sunio_sanitize_checkbox',
			) );

			$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'sunio_woo_shop_sort', array(
				'label'	   				=> esc_html__( 'Shop Sort', 'sunio' ),
				'type' 					=> 'checkbox',
				'section'  				=> 'sunio_woocommerce_archives',
				'settings' 				=> 'sunio_woo_shop_sort',
				'priority' 				=> 10,
			) ) );

			/**
			 * Shop Result Count
			 */
			$wp_customize->add_setting( 'sunio_woo_shop_result_count', array(
				'default'           	=> false,
				'sanitize_callback' 	=> 'sunio_sanitize_checkbox',
			) );

			$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'sunio_woo_shop_result_count', array(
				'label'	   				=> esc_html__( 'Shop Result Count', 'sunio' ),
				'type' 					=> 'checkbox',
				'section'  				=> 'sunio_woocommerce_archives',
				'settings' 				=> 'sunio_woo_shop_result_count',
				'priority' 				=> 10,
			) ) );

			/**
			 * Off Canvas Filtering Heading
			 */
			$wp_customize->add_setting( 'sunio_woocommerce_shop_off_canvas_filter_heading', array(
				'sanitize_callback' 	=> 'wp_kses',
			) );

			$wp_customize->add_control( new sunio_Customizer_Heading_Control( $wp_customize, 'sunio_woocommerce_shop_off_canvas_filter_heading', array(
				'label'    				=> esc_html__( 'Off Canvas Filtering', 'sunio' ),
				'section'  				=> 'sunio_woocommerce_archives',
				'priority' 				=> 10,
			) ) );

			/**
			 * Off Canvas Filter Button
			 */
			$wp_customize->add_setting( 'sunio_woo_off_canvas_filter', array(
				'default'           	=> false,
				'sanitize_callback' 	=> 'sunio_sanitize_checkbox',
			) );

			$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'sunio_woo_off_canvas_filter', array(
				'label'	   				=> esc_html__( 'Display Filter Button', 'sunio' ),
				'type' 					=> 'checkbox',
				'section'  				=> 'sunio_woocommerce_archives',
				'settings' 				=> 'sunio_woo_off_canvas_filter',
				'priority' 				=> 10,
			) ) );

			/**
			 * Off Canvas Filter Text
			 */
			$wp_customize->add_setting( 'sunio_woo_off_canvas_filter_text', array(
				'default'           	=> esc_html__( 'Filter', 'sunio' ),
				'transport'           	=> 'postMessage',
				'sanitize_callback' 	=> 'wp_kses_post',
			) );

			$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'sunio_woo_off_canvas_filter_text', array(
				'label'	   				=> esc_html__( 'Filter Button Text', 'sunio' ),
				'type' 					=> 'text',
				'section'  				=> 'sunio_woocommerce_archives',
				'settings' 				=> 'sunio_woo_off_canvas_filter_text',
				'priority' 				=> 10,
				'active_callback' 		=> 'sunio_cac_has_woo_filter_button',
			) ) );

			/**
			 * Off Canvas Close Button
			 */
			$wp_customize->add_setting( 'sunio_woo_off_canvas_close_button', array(
				'default'           	=> false,
				'sanitize_callback' 	=> 'sunio_sanitize_checkbox',
			) );

			$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'sunio_woo_off_canvas_close_button', array(
				'label'	   				=> esc_html__( 'Add Close Button', 'sunio' ),
				'type' 					=> 'checkbox',
				'section'  				=> 'sunio_woocommerce_archives',
				'settings' 				=> 'sunio_woo_off_canvas_close_button',
				'priority' 				=> 10,
			) ) );

			/**
		     * Off Canvas Close Button Color
		     */
	        $wp_customize->add_setting( 'sunio_woo_off_canvas_close_button_color', array(
				'default'				=> '#333333',
				'transport'				=> 'postMessage',
				'sanitize_callback' 	=> 'sunio_sanitize_color',
			) );

			$wp_customize->add_control( new sunio_Customizer_Color_Control( $wp_customize, 'sunio_woo_off_canvas_close_button_color', array(
				'label'					=> esc_html__( 'Close Button Color', 'sunio' ),
				'section'				=> 'sunio_woocommerce_archives',
				'settings'				=> 'sunio_woo_off_canvas_close_button_color',
				'priority'				=> 10,
				'active_callback' 		=> 'sunio_cac_has_woo_filter_close_button',
			) ) );

			/**
		     * Off Canvas Close Button Color
		     */
	        $wp_customize->add_setting( 'sunio_woo_off_canvas_close_button_hover_color', array(
				'default'				=> '#777777',
				'transport'				=> 'postMessage',
				'sanitize_callback' 	=> 'sunio_sanitize_color',
			) );

			$wp_customize->add_control( new sunio_Customizer_Color_Control( $wp_customize, 'sunio_woo_off_canvas_close_button_hover_color', array(
				'label'					=> esc_html__( 'Close Button Color: Hover', 'sunio' ),
				'section'				=> 'sunio_woocommerce_archives',
				'settings'				=> 'sunio_woo_off_canvas_close_button_hover_color',
				'priority'				=> 10,
				'active_callback' 		=> 'sunio_cac_has_woo_filter_close_button',
			) ) );

			/**
			 * Products Heading
			 */
			$wp_customize->add_setting( 'sunio_woocommerce_shop_products_heading', array(
				'sanitize_callback' 	=> 'wp_kses',
			) );

			$wp_customize->add_control( new sunio_Customizer_Heading_Control( $wp_customize, 'sunio_woocommerce_shop_products_heading', array(
				'label'    				=> esc_html__( 'Products', 'sunio' ),
				'section'  				=> 'sunio_woocommerce_archives',
				'priority' 				=> 10,
			) ) );

			/**
			 * Products Style
			 */
			$wp_customize->add_setting( 'sunio_woo_products_style', array(
				'default'           	=> 'default',
				'sanitize_callback' 	=> 'sunio_sanitize_select',
			) );

			$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'sunio_woo_products_style', array(
				'label'	   				=> esc_html__( 'Products Style', 'sunio' ),
				'type' 					=> 'select',
				'section'  				=> 'sunio_woocommerce_archives',
				'settings' 				=> 'sunio_woo_products_style',
				'priority' 				=> 10,
				'choices' 				=> array(
					'default'  	=> esc_html__( 'Default Style', 'sunio' ),
					'hover' 	=> esc_html__( 'Hover Style', 'sunio' ),
				),
			) ) );

			/**
			 * Product Elements Positioning
			 */
			$wp_customize->add_setting( 'sunio_woo_product_elements_positioning', array(
				'default' 				=> array( 'image', 'category', 'title', 'price-rating', 'description' , 'button' ),
				'sanitize_callback' 	=> 'sunio_sanitize_multi_choices',
			) );

			$wp_customize->add_control( new sunio_Customizer_Sortable_Control( $wp_customize, 'sunio_woo_product_elements_positioning', array(
				'label'	   				=> esc_html__( 'Elements Positioning', 'sunio' ),
				'section'  				=> 'sunio_woocommerce_archives',
				'settings' 				=> 'sunio_woo_product_elements_positioning',
				'priority' 				=> 10,
				'choices' 				=> array(
					'image'    			=> esc_html__( 'Image', 'sunio' ),
					'category'       	=> esc_html__( 'Category', 'sunio' ),
					'title' 			=> esc_html__( 'Title', 'sunio' ),
					'price-rating' 		=> esc_html__( 'Price/Rating', 'sunio' ),
					'description' 		=> esc_html__( 'Description', 'sunio' ),
					'button' 			=> esc_html__( 'Add To Cart Button', 'sunio' ),
				),
				'active_callback' 		=> 'sunio_cac_has_woo_default_products_style',
			) ) );

			/**
			 * Product Entry Media
			 */
			$wp_customize->add_setting( 'sunio_woo_product_entry_style', array(
				'default'           	=> 'image-swap',
				'sanitize_callback' 	=> 'sunio_sanitize_select',
			) );

			$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'sunio_woo_product_entry_style', array(
				'label'	   				=> esc_html__( 'Product Entry Media', 'sunio' ),
				'type' 					=> 'select',
				'section'  				=> 'sunio_woocommerce_archives',
				'settings' 				=> 'sunio_woo_product_entry_style',
				'priority' 				=> 10,
				'choices' 				=> array(
					'featured-image'  	=> esc_html__( 'Featured Image', 'sunio' ),
					'image-swap' 		=> esc_html__( 'Image Swap', 'sunio' ),
					'gallery-slider'  	=> esc_html__( 'Gallery Slider', 'sunio' ),
				),
				'active_callback' 		=> 'sunio_cac_has_woo_default_products_style',
			) ) );

			/**
			 * Display Quick View Button
			 */
			$wp_customize->add_setting( 'sunio_woo_quick_view', array(
				'default'           	=> true,
				'sanitize_callback' 	=> 'sunio_sanitize_checkbox',
			) );

			$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'sunio_woo_quick_view', array(
				'label'	   				=> esc_html__( 'Display Quick View Button', 'sunio' ),
				'type' 					=> 'checkbox',
				'section'  				=> 'sunio_woocommerce_archives',
				'settings' 				=> 'sunio_woo_quick_view',
				'priority' 				=> 10,
			) ) );

			/**
			 * Product Entry Content Alignment
			 */
			$wp_customize->add_setting( 'sunio_woo_product_entry_content_alignment', array(
				'transport' 			=> 'postMessage',
				'default'           	=> 'center',
				'sanitize_callback' 	=> 'sunio_sanitize_select',
			) );

			$wp_customize->add_control( new sunio_Customizer_Buttonset_Control( $wp_customize, 'sunio_woo_product_entry_content_alignment', array(
				'label'	   				=> esc_html__( 'Content Alignment', 'sunio' ),
				'section'  				=> 'sunio_woocommerce_archives',
				'settings' 				=> 'sunio_woo_product_entry_content_alignment',
				'priority' 				=> 10,
				'choices' 				=> array(
					'left' 		=> esc_html__( 'Left', 'sunio' ),
					'center' 	=> esc_html__( 'Center', 'sunio' ),
					'right' 	=> esc_html__( 'Right', 'sunio' ),
				),
			) ) );

			/**
			 * Pagination Heading
			 */
			$wp_customize->add_setting( 'sunio_woocommerce_shop_pagination_heading', array(
				'sanitize_callback' 	=> 'wp_kses',
			) );

			$wp_customize->add_control( new sunio_Customizer_Heading_Control( $wp_customize, 'sunio_woocommerce_shop_pagination_heading', array(
				'label'    				=> esc_html__( 'Pagination', 'sunio' ),
				'section'  				=> 'sunio_woocommerce_archives',
				'priority' 				=> 10,
			) ) );

			/**
			 * Shop Pagination Style
			 */
			$wp_customize->add_setting( 'sunio_woo_pagination_style', array(
				'default'           	=> 'standard',
				'sanitize_callback' 	=> 'sunio_sanitize_select',
			) );

			$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'sunio_woo_pagination_style', array(
				'label'	   				=> esc_html__( 'Pagination Style', 'sunio' ),
				'type' 					=> 'select',
				'section'  				=> 'sunio_woocommerce_archives',
				'settings' 				=> 'sunio_woo_pagination_style',
				'priority' 				=> 10,
				'choices' 				=> array(
					'standard' 			=> esc_html__( 'Standard', 'sunio' ),
					'infinite_scroll' 	=> esc_html__( 'Infinite Scroll', 'sunio' ),
				),
			) ) );

			/**
			 * Infinite Scroll: Spinners Color
			 */
			$wp_customize->add_setting( 'sunio_woo_infinite_scroll_spinners_color', array(
				'default'           	=> '#333333',
				'transport' 			=> 'postMessage',
				'sanitize_callback' 	=> 'sunio_sanitize_color',
			) );

			$wp_customize->add_control( new sunio_Customizer_Color_Control( $wp_customize, 'sunio_woo_infinite_scroll_spinners_color', array(
				'label'	   				=> esc_html__( 'Infinite Scroll: Spinners Color', 'sunio' ),
				'section'  				=> 'sunio_woocommerce_archives',
				'settings' 				=> 'sunio_woo_infinite_scroll_spinners_color',
				'priority' 				=> 10,
				'active_callback' 		=> 'sunio_cac_has_woo_infinite_scroll',
			) ) );

			/**
			 * Infinite Scroll: Last Text
			 */
			$wp_customize->add_setting( 'sunio_woo_infinite_scroll_last_text', array(
				'default'           	=> esc_html__( 'End of content', 'sunio' ),
				'transport'           	=> 'postMessage',
				'sanitize_callback' 	=> 'wp_kses_post',
			) );

			$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'sunio_woo_infinite_scroll_last_text', array(
				'label'	   				=> esc_html__( 'Infinite Scroll: Last Text', 'sunio' ),
				'type' 					=> 'text',
				'section'  				=> 'sunio_woocommerce_archives',
				'settings' 				=> 'sunio_woo_infinite_scroll_last_text',
				'priority' 				=> 10,
				'active_callback' 		=> 'sunio_cac_has_woo_infinite_scroll',
			) ) );

			/**
			 * Infinite Scroll: Error Text
			 */
			$wp_customize->add_setting( 'sunio_woo_infinite_scroll_error_text', array(
				'default'           	=> esc_html__( 'No more pages to load', 'sunio' ),
				'transport'           	=> 'postMessage',
				'sanitize_callback' 	=> 'wp_kses_post',
			) );

			$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'sunio_woo_infinite_scroll_error_text', array(
				'label'	   				=> esc_html__( 'Infinite Scroll: Error Text', 'sunio' ),
				'type' 					=> 'text',
				'section'  				=> 'sunio_woocommerce_archives',
				'settings' 				=> 'sunio_woo_infinite_scroll_error_text',
				'priority' 				=> 10,
				'active_callback' 		=> 'sunio_cac_has_woo_infinite_scroll',
			) ) );

			/**
			 * Section
			 */
			$wp_customize->add_section( 'sunio_woocommerce_single' , array(
				'title' 			=> esc_html__( 'Single Product', 'sunio' ),
				'priority' 			=> 10,
				'panel' 			=> $panel,
			) );

			/**
			 * Layout
			 */
			$wp_customize->add_setting( 'sunio_woo_product_layout', array(
				'default'           	=> 'left-sidebar',
				'sanitize_callback' 	=> 'sunio_sanitize_select',
			) );

			$wp_customize->add_control( new sunio_Customizer_Radio_Image_Control( $wp_customize, 'sunio_woo_product_layout', array(
				'label'	   				=> esc_html__( 'Layout', 'sunio' ),
				'section'  				=> 'sunio_woocommerce_single',
				'settings' 				=> 'sunio_woo_product_layout',
				'priority' 				=> 10,
				'choices' 				=> sunio_customizer_layout(),
			) ) );

			/**
			 * Both Sidebars Style
			 */
			$wp_customize->add_setting( 'sunio_woo_product_both_sidebars_style', array(
				'default'           	=> 'scs-style',
				'sanitize_callback' 	=> 'sunio_sanitize_select',
			) );

			$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'sunio_woo_product_both_sidebars_style', array(
				'label'	   				=> esc_html__( 'Both Sidebars: Style', 'sunio' ),
				'type' 					=> 'select',
				'section'  				=> 'sunio_woocommerce_single',
				'settings' 				=> 'sunio_woo_product_both_sidebars_style',
				'priority' 				=> 10,
				'choices' 				=> array(
					'ssc-style' 		=> esc_html__( 'Sidebar / Sidebar / Content', 'sunio' ),
					'scs-style' 		=> esc_html__( 'Sidebar / Content / Sidebar', 'sunio' ),
					'css-style' 		=> esc_html__( 'Content / Sidebar / Sidebar', 'sunio' ),
				),
				'active_callback' 		=> 'sunio_cac_has_woo_product_bs_layout',
			) ) );

			/**
			 * Both Sidebars Content Width
			 */
			$wp_customize->add_setting( 'sunio_woo_product_both_sidebars_content_width', array(
				'transport' 			=> 'postMessage',
				'sanitize_callback' 	=> 'sunio_sanitize_number_blank',
			) );

			$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'sunio_woo_product_both_sidebars_content_width', array(
				'label'	   				=> esc_html__( 'Both Sidebars: Content Width (%)', 'sunio' ),
				'type' 					=> 'number',
				'section'  				=> 'sunio_woocommerce_single',
				'settings' 				=> 'sunio_woo_product_both_sidebars_content_width',
				'priority' 				=> 10,
			    'input_attrs' 			=> array(
			        'min'   => 0,
			        'max'   => 100,
			        'step'  => 1,
			    ),
				'active_callback' 		=> 'sunio_cac_has_woo_product_bs_layout',
			) ) );

			/**
			 * Both Sidebars Sidebars Width
			 */
			$wp_customize->add_setting( 'sunio_woo_product_both_sidebars_sidebars_width', array(
				'transport' 			=> 'postMessage',
				'sanitize_callback' 	=> 'sunio_sanitize_number_blank',
			) );

			$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'sunio_woo_product_both_sidebars_sidebars_width', array(
				'label'	   				=> esc_html__( 'Both Sidebars: Sidebars Width (%)', 'sunio' ),
				'type' 					=> 'number',
				'section'  				=> 'sunio_woocommerce_single',
				'settings' 				=> 'sunio_woo_product_both_sidebars_sidebars_width',
				'priority' 				=> 10,
			    'input_attrs' 			=> array(
			        'min'   => 0,
			        'max'   => 100,
			        'step'  => 1,
			    ),
				'active_callback' 		=> 'sunio_cac_has_woo_product_bs_layout',
			) ) );

			/**
			 * Mobile Sidebar Order
			 */
			$wp_customize->add_setting( 'sunio_woo_product_sidebar_order', array(
				'default'           	=> 'content-sidebar',
				'sanitize_callback' 	=> 'sunio_sanitize_select',
			) );

			$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'sunio_woo_product_sidebar_order', array(
				'label'	   				=> esc_html__( 'Mobile Sidebar Order', 'sunio' ),
				'type' 					=> 'select',
				'section'  				=> 'sunio_woocommerce_single',
				'settings' 				=> 'sunio_woo_product_sidebar_order',
				'priority' 				=> 10,
				'choices' 				=> array(
					'content-sidebar' 	=> esc_html__( 'Content / Sidebar', 'sunio' ),
					'sidebar-content' 	=> esc_html__( 'Sidebar / Content', 'sunio' ),
				),
				'active_callback' 		=> 'sunio_cac_has_woo_product_rl_layout',
			) ) );

			/**
			 * Elements Positioning
			 */
			$wp_customize->add_setting( 'sunio_woo_summary_elements_positioning', array(
				'default' 				=> array( 'title', 'rating', 'price', 'excerpt', 'quantity-button', 'meta' ),
				'sanitize_callback' 	=> 'sunio_sanitize_multi_choices',
			) );

			$wp_customize->add_control( new sunio_Customizer_Sortable_Control( $wp_customize, 'sunio_woo_summary_elements_positioning', array(
				'label'	   				=> esc_html__( 'Summary Elements Positioning', 'sunio' ),
				'section'  				=> 'sunio_woocommerce_single',
				'settings' 				=> 'sunio_woo_summary_elements_positioning',
				'priority' 				=> 10,
				'choices' 				=> array(
					'title'    			=> esc_html__( 'Title', 'sunio' ),
                    'review'    		=> esc_html__( 'Review', 'sunio' ),
                    'excerpt' 			=> esc_html__( 'Excerpt', 'sunio' ),
                    'category' 			=> esc_html__( 'Category', 'sunio' ),
                    'price' 			=> esc_html__( 'Price', 'sunio' ),
                    'quantity'    		=> esc_html__( 'Quantity', 'sunio' ),
                    'cart-button'    	=> esc_html__( 'Add To Cart', 'sunio' ),
					'rating'       		=> esc_html__( 'Rating', 'sunio' ),
					'quantity-button' 	=> esc_html__( 'Quantity & Add To Cart', 'sunio' ),
					'meta' 				=> esc_html__( 'Product Meta', 'sunio' ),
				),
			) ) );

			/**
			 * Display Product Navigation
			 */
			$wp_customize->add_setting( 'sunio_woocommerce_display_navigation', array(
				'default'           	=> true,
				'sanitize_callback' 	=> 'sunio_sanitize_checkbox',
			) );

			$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'sunio_woocommerce_display_navigation', array(
				'label'	   				=> esc_html__( 'Display Product Navigation', 'sunio' ),
				'type' 					=> 'checkbox',
				'section'  				=> 'sunio_woocommerce_single',
				'settings' 				=> 'sunio_woocommerce_display_navigation',
				'priority' 				=> 10,
			) ) );

			/**
			 * Enable Ajax Add To Cart
			 */
			$wp_customize->add_setting( 'sunio_woo_product_ajax_add_to_cart', array(
				'default'           	=> false,
				'sanitize_callback' 	=> 'sunio_sanitize_checkbox',
			) );

			$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'sunio_woo_product_ajax_add_to_cart', array(
				'label'	   				=> esc_html__( 'Enable Ajax Add To Cart', 'sunio' ),
				'type' 					=> 'checkbox',
				'section'  				=> 'sunio_woocommerce_single',
				'settings' 				=> 'sunio_woo_product_ajax_add_to_cart',
				'priority' 				=> 10,
			) ) );

			/**
			 * Image Width
			 */
			$wp_customize->add_setting( 'sunio_woo_product_image_width', array(
				'transport' 			=> 'postMessage',
				'default'           	=> '40',
				'sanitize_callback' 	=> 'sunio_sanitize_number',
			) );

			$wp_customize->add_control( new sunio_Customizer_Range_Control( $wp_customize, 'sunio_woo_product_image_width', array(
				'label'	   				=> esc_html__( 'Image Width (%)', 'sunio' ),
				'section'  				=> 'sunio_woocommerce_single',
				'settings' 				=> 'sunio_woo_product_image_width',
				'priority' 				=> 10,
			    'input_attrs' 			=> array(
			        'min'   => 0,
			        'max'   => 100,
			        'step'  => 1,
			    ),
			) ) );

			/**
			 * Summary Width
			 */
			$wp_customize->add_setting( 'sunio_woo_product_summary_width', array(
				'transport' 			=> 'postMessage',
				'default'           	=> '60',
				'sanitize_callback' 	=> 'sunio_sanitize_number',
			) );

			$wp_customize->add_control( new sunio_Customizer_Range_Control( $wp_customize, 'sunio_woo_product_summary_width', array(
				'label'	   				=> esc_html__( 'Summary Width (%)', 'sunio' ),
				'section'  				=> 'sunio_woocommerce_single',
				'settings' 				=> 'sunio_woo_product_summary_width',
				'priority' 				=> 10,
			    'input_attrs' 			=> array(
			        'min'   => 0,
			        'max'   => 100,
			        'step'  => 1,
			    ),
			) ) );

			/**
			 * Thumbnails Layout
			 */
			$wp_customize->add_setting( 'sunio_woo_product_thumbs_layout', array(
				'transport' 			=> 'postMessage',
				'default' 				=> 'horizontal',
				'sanitize_callback' 	=> 'sanitize_text_field',
			) );

			$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'sunio_woo_product_thumbs_layout', array(
				'label'	   				=> esc_html__( 'Thumbnails Layout', 'sunio' ),
				'type' 					=> 'select',
				'section'  				=> 'sunio_woocommerce_single',
				'settings' 				=> 'sunio_woo_product_thumbs_layout',
				'priority' 				=> 10,
				'choices' 				=> array(
					'horizontal' 		=> esc_html__( 'Horizontal', 'sunio' ),
					'vertical' 			=> esc_html__( 'Vertical', 'sunio' ),
				),
			) ) );

			/**
			 * Add To Cart Button Style
			 */
			$wp_customize->add_setting( 'sunio_woo_product_addtocart_style', array(
				'transport' 			=> 'postMessage',
				'default' 				=> 'normal',
				'sanitize_callback' 	=> 'sanitize_text_field',
			) );

			$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'sunio_woo_product_addtocart_style', array(
				'label'	   				=> esc_html__( 'Add To Cart Button Style', 'sunio' ),
				'type' 					=> 'select',
				'section'  				=> 'sunio_woocommerce_single',
				'settings' 				=> 'sunio_woo_product_addtocart_style',
				'priority' 				=> 10,
				'choices' 				=> array(
					'normal' 		=> esc_html__( 'Normal', 'sunio' ),
					'big' 			=> esc_html__( 'Big', 'sunio' ),
					'very-big' 		=> esc_html__( 'Very Big', 'sunio' ),
				),
			) ) );

			/**
			 * Heading Woo Tabs
			 */
			$wp_customize->add_setting( 'sunio_woo_product_tabs_heading', array(
				'sanitize_callback' 	=> 'wp_kses',
			) );

			$wp_customize->add_control( new sunio_Customizer_Heading_Control( $wp_customize, 'sunio_woo_product_tabs_heading', array(
				'label'    				=> esc_html__( 'Tabs', 'sunio' ),
				'section'  				=> 'sunio_woocommerce_single',
				'priority' 				=> 10,
			) ) );

			/**
			 * Tabs Layout
			 */
			$wp_customize->add_setting( 'sunio_woo_product_tabs_layout', array(
				'transport' 			=> 'postMessage',
				'default' 				=> 'horizontal',
				'sanitize_callback' 	=> 'sanitize_text_field',
			) );

			$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'sunio_woo_product_tabs_layout', array(
				'label'	   				=> esc_html__( 'Tabs Layout', 'sunio' ),
				'type' 					=> 'select',
				'section'  				=> 'sunio_woocommerce_single',
				'settings' 				=> 'sunio_woo_product_tabs_layout',
				'priority' 				=> 10,
				'choices' 				=> array(
					'horizontal' 		=> esc_html__( 'Horizontal', 'sunio' ),
					'vertical' 			=> esc_html__( 'Vertical', 'sunio' ),
					'section' 			=> esc_html__( 'Section', 'sunio' ),
				),
			) ) );

			/**
			 * Tabs Position
			 */
			$wp_customize->add_setting( 'sunio_woo_product_meta_tabs_position', array(
				'transport' 			=> 'postMessage',
				'default'           	=> 'left',
				'sanitize_callback' 	=> 'sunio_sanitize_select',
			) );

			$wp_customize->add_control( new sunio_Customizer_Buttonset_Control( $wp_customize, 'sunio_woo_product_meta_tabs_position', array(
				'label'	   				=> esc_html__( 'Tabs Position', 'sunio' ),
				'description'	   		=> esc_html__( 'Only work for the horizontal tabs layout', 'sunio' ),
				'section'  				=> 'sunio_woocommerce_single',
				'settings' 				=> 'sunio_woo_product_meta_tabs_position',
				'priority' 				=> 10,
				'choices' 				=> array(
					'left' 		=> esc_html__( 'Left', 'sunio' ),
					'center' 	=> esc_html__( 'Center', 'sunio' ),
					'right' 	=> esc_html__( 'Right', 'sunio' ),
				),
			) ) );

			/**
			 * Heading Woo Tabs
			 */
			$wp_customize->add_setting( 'sunio_woo_upsells_related_items_heading', array(
				'sanitize_callback' 	=> 'wp_kses',
			) );

			$wp_customize->add_control( new sunio_Customizer_Heading_Control( $wp_customize, 'sunio_woo_upsells_related_items_heading', array(
				'label'    				=> esc_html__( 'Up-Sells & Related Items', 'sunio' ),
				'section'  				=> 'sunio_woocommerce_single',
				'priority' 				=> 10,
			) ) );

			/**
			 * Up-Sells Count
			 */
			$wp_customize->add_setting( 'sunio_woocommerce_upsells_count', array(
				'default'           	=> '3',
				'sanitize_callback' 	=> 'sunio_sanitize_number',
			) );

			$wp_customize->add_control( new sunio_Customizer_Range_Control( $wp_customize, 'sunio_woocommerce_upsells_count', array(
				'label'	   				=> esc_html__( 'Up-Sells Count', 'sunio' ),
				'section'  				=> 'sunio_woocommerce_single',
				'settings' 				=> 'sunio_woocommerce_upsells_count',
				'priority' 				=> 10,
			    'input_attrs' 			=> array(
			        'min'   => 1,
			        'max'   => 100,
			        'step'  => 1,
			    ),
			) ) );

			/**
			 * Up-Sells Columns
			 */
			$wp_customize->add_setting( 'sunio_woocommerce_upsells_columns', array(
				'default'           	=> '3',
				'sanitize_callback' 	=> 'sunio_sanitize_number',
			) );

			$wp_customize->add_control( new sunio_Customizer_Range_Control( $wp_customize, 'sunio_woocommerce_upsells_columns', array(
				'label'	   				=> esc_html__( 'Up-Sells Columns', 'sunio' ),
				'section'  				=> 'sunio_woocommerce_single',
				'settings' 				=> 'sunio_woocommerce_upsells_columns',
				'priority' 				=> 10,
			    'input_attrs' 			=> array(
			        'min'   => 1,
			        'max'   => 7,
			        'step'  => 1,
			    ),
			) ) );

			/**
			 * Display Related Items
			 */
			$wp_customize->add_setting( 'sunio_woocommerce_display_related_items', array(
				'default'           	=> 'on',
				'sanitize_callback' 	=> 'sunio_sanitize_select',
			) );

			$wp_customize->add_control( new sunio_Customizer_Buttonset_Control( $wp_customize, 'sunio_woocommerce_display_related_items', array(
				'label'	   				=> esc_html__( 'Display Related Items', 'sunio' ),
				'section'  				=> 'sunio_woocommerce_single',
				'settings' 				=> 'sunio_woocommerce_display_related_items',
				'priority' 				=> 10,
				'choices' 				=> array(
					'on' 	=> esc_html__( 'Yes', 'sunio' ),
					'off' 	=> esc_html__( 'No', 'sunio' ),
				),
			) ) );

			/**
			 * Related Items Count
			 */
			$wp_customize->add_setting( 'sunio_woocommerce_related_count', array(
				'default'           	=> '4',
				'sanitize_callback' 	=> 'sunio_sanitize_number',
			) );

			$wp_customize->add_control( new sunio_Customizer_Range_Control( $wp_customize, 'sunio_woocommerce_related_count', array(
				'label'	   				=> esc_html__( 'Related Items Count', 'sunio' ),
				'section'  				=> 'sunio_woocommerce_single',
				'settings' 				=> 'sunio_woocommerce_related_count',
				'priority' 				=> 10,
			    'input_attrs' 			=> array(
			        'min'   => 1,
			        'max'   => 100,
			        'step'  => 1,
			    ),
			) ) );

			/**
			 * Related Products Columns
			 */
			$wp_customize->add_setting( 'sunio_woocommerce_related_columns', array(
				'default'           	=> '4',
				'sanitize_callback' 	=> 'sunio_sanitize_number',
			) );

			$wp_customize->add_control( new sunio_Customizer_Range_Control( $wp_customize, 'sunio_woocommerce_related_columns', array(
				'label'	   				=> esc_html__( 'Related Products Columns', 'sunio' ),
				'section'  				=> 'sunio_woocommerce_single',
				'settings' 				=> 'sunio_woocommerce_related_columns',
				'priority' 				=> 10,
			    'input_attrs' 			=> array(
			        'min'   => 1,
			        'max'   => 7,
			        'step'  => 1,
			    ),
			) ) );

			/**
			 * Heading Floating Bar
			 */
			$wp_customize->add_setting( 'sunio_woo_floating_bar_heading', array(
				'sanitize_callback' 	=> 'wp_kses',
			) );

			$wp_customize->add_control( new sunio_Customizer_Heading_Control( $wp_customize, 'sunio_woo_floating_bar_heading', array(
				'label'    				=> esc_html__( 'Floating Bar', 'sunio' ),
				'section'  				=> 'sunio_woocommerce_single',
				'priority' 				=> 10,
			) ) );

			/**
			 * Display Floating Bar
			 */
			$wp_customize->add_setting( 'sunio_woo_display_floating_bar', array(
				'default'           	=> 'off',
				'sanitize_callback' 	=> 'sunio_sanitize_select',
			) );

			$wp_customize->add_control( new sunio_Customizer_Buttonset_Control( $wp_customize, 'sunio_woo_display_floating_bar', array(
				'label'	   				=> esc_html__( 'Display Floating Bar', 'sunio' ),
				'description' 			=> esc_html__( 'The floating bar is to display the add to cart button when you scroll to increase conversions.', 'sunio' ),
				'section'  				=> 'sunio_woocommerce_single',
				'settings' 				=> 'sunio_woo_display_floating_bar',
				'priority' 				=> 10,
				'choices' 				=> array(
					'on' 	=> esc_html__( 'Yes', 'sunio' ),
					'off' 	=> esc_html__( 'No', 'sunio' ),
				),
			) ) );

			/**
		     * Floating Bar Background
		     */
	        $wp_customize->add_setting( 'sunio_woo_floating_bar_bg', array(
				'default'				=> '#2c2c2c',
				'transport'				=> 'postMessage',
				'sanitize_callback' 	=> 'sunio_sanitize_color',
			) );

			$wp_customize->add_control( new sunio_Customizer_Color_Control( $wp_customize, 'sunio_woo_floating_bar_bg', array(
				'label'					=> esc_html__( 'Background Color', 'sunio' ),
				'section'				=> 'sunio_woocommerce_single',
				'settings'				=> 'sunio_woo_floating_bar_bg',
				'priority'				=> 10,
				'active_callback' 		=> 'sunio_cac_has_woo_floating_bar',
			) ) );

			/**
		     * Floating Bar Title Color
		     */
	        $wp_customize->add_setting( 'sunio_woo_floating_bar_title_color', array(
				'default'				=> '#ffffff',
				'transport'				=> 'postMessage',
				'sanitize_callback' 	=> 'sunio_sanitize_color',
			) );

			$wp_customize->add_control( new sunio_Customizer_Color_Control( $wp_customize, 'sunio_woo_floating_bar_title_color', array(
				'label'					=> esc_html__( 'Title Color', 'sunio' ),
				'section'				=> 'sunio_woocommerce_single',
				'settings'				=> 'sunio_woo_floating_bar_title_color',
				'priority'				=> 10,
				'active_callback' 		=> 'sunio_cac_has_woo_floating_bar',
			) ) );

			/**
		     * Floating Bar Price Color
		     */
	        $wp_customize->add_setting( 'sunio_woo_floating_bar_price_color', array(
				'default'				=> '#ffffff',
				'transport'				=> 'postMessage',
				'sanitize_callback' 	=> 'sunio_sanitize_color',
			) );

			$wp_customize->add_control( new sunio_Customizer_Color_Control( $wp_customize, 'sunio_woo_floating_bar_price_color', array(
				'label'					=> esc_html__( 'Price Color', 'sunio' ),
				'section'				=> 'sunio_woocommerce_single',
				'settings'				=> 'sunio_woo_floating_bar_price_color',
				'priority'				=> 10,
				'active_callback' 		=> 'sunio_cac_has_woo_floating_bar',
			) ) );

			/**
		     * Floating Bar Quantity Buttons Background
		     */
	        $wp_customize->add_setting( 'sunio_woo_floating_bar_quantity_buttons_bg', array(
				'default'				=> 'rgba(255,255,255,0.1)',
				'transport'				=> 'postMessage',
				'sanitize_callback' 	=> 'sunio_sanitize_color',
			) );

			$wp_customize->add_control( new sunio_Customizer_Color_Control( $wp_customize, 'sunio_woo_floating_bar_quantity_buttons_bg', array(
				'label'					=> esc_html__( 'Quantity Buttons: Background', 'sunio' ),
				'section'				=> 'sunio_woocommerce_single',
				'settings'				=> 'sunio_woo_floating_bar_quantity_buttons_bg',
				'priority'				=> 10,
				'active_callback' 		=> 'sunio_cac_has_woo_floating_bar',
			) ) );

			/**
		     * Floating Bar Quantity Buttons Hover Background
		     */
	        $wp_customize->add_setting( 'sunio_woo_floating_bar_quantity_buttons_hover_bg', array(
				'default'				=> 'rgba(255,255,255,0.2)',
				'transport'				=> 'postMessage',
				'sanitize_callback' 	=> 'sunio_sanitize_color',
			) );

			$wp_customize->add_control( new sunio_Customizer_Color_Control( $wp_customize, 'sunio_woo_floating_bar_quantity_buttons_hover_bg', array(
				'label'					=> esc_html__( 'Quantity Buttons Hover: Background', 'sunio' ),
				'section'				=> 'sunio_woocommerce_single',
				'settings'				=> 'sunio_woo_floating_bar_quantity_buttons_hover_bg',
				'priority'				=> 10,
				'active_callback' 		=> 'sunio_cac_has_woo_floating_bar',
			) ) );

			/**
		     * Floating Bar Quantity Buttons Color
		     */
	        $wp_customize->add_setting( 'sunio_woo_floating_bar_quantity_buttons_color', array(
				'default'				=> '#ffffff',
				'transport'				=> 'postMessage',
				'sanitize_callback' 	=> 'sunio_sanitize_color',
			) );

			$wp_customize->add_control( new sunio_Customizer_Color_Control( $wp_customize, 'sunio_woo_floating_bar_quantity_buttons_color', array(
				'label'					=> esc_html__( 'Quantity Buttons: Color', 'sunio' ),
				'section'				=> 'sunio_woocommerce_single',
				'settings'				=> 'sunio_woo_floating_bar_quantity_buttons_color',
				'priority'				=> 10,
				'active_callback' 		=> 'sunio_cac_has_woo_floating_bar',
			) ) );

			/**
		     * Floating Bar Quantity Buttons Hover Color
		     */
	        $wp_customize->add_setting( 'sunio_woo_floating_bar_quantity_buttons_hover_color', array(
				'default'				=> '#ffffff',
				'transport'				=> 'postMessage',
				'sanitize_callback' 	=> 'sunio_sanitize_color',
			) );

			$wp_customize->add_control( new sunio_Customizer_Color_Control( $wp_customize, 'sunio_woo_floating_bar_quantity_buttons_hover_color', array(
				'label'					=> esc_html__( 'Quantity Buttons Hover: Color', 'sunio' ),
				'section'				=> 'sunio_woocommerce_single',
				'settings'				=> 'sunio_woo_floating_bar_quantity_buttons_hover_color',
				'priority'				=> 10,
				'active_callback' 		=> 'sunio_cac_has_woo_floating_bar',
			) ) );

			/**
		     * Floating Bar Quantity Input Color
		     */
	        $wp_customize->add_setting( 'sunio_woo_floating_bar_quantity_input_bg', array(
				'default'				=> 'rgba(255,255,255,0.2)',
				'transport'				=> 'postMessage',
				'sanitize_callback' 	=> 'sunio_sanitize_color',
			) );

			$wp_customize->add_control( new sunio_Customizer_Color_Control( $wp_customize, 'sunio_woo_floating_bar_quantity_input_bg', array(
				'label'					=> esc_html__( 'Quantity Input: Background', 'sunio' ),
				'section'				=> 'sunio_woocommerce_single',
				'settings'				=> 'sunio_woo_floating_bar_quantity_input_bg',
				'priority'				=> 10,
				'active_callback' 		=> 'sunio_cac_has_woo_floating_bar',
			) ) );

			/**
		     * Floating Bar Quantity Input Color
		     */
	        $wp_customize->add_setting( 'sunio_woo_floating_bar_quantity_input_color', array(
				'default'				=> '#ffffff',
				'transport'				=> 'postMessage',
				'sanitize_callback' 	=> 'sunio_sanitize_color',
			) );

			$wp_customize->add_control( new sunio_Customizer_Color_Control( $wp_customize, 'sunio_woo_floating_bar_quantity_input_color', array(
				'label'					=> esc_html__( 'Quantity Input: Color', 'sunio' ),
				'section'				=> 'sunio_woocommerce_single',
				'settings'				=> 'sunio_woo_floating_bar_quantity_input_color',
				'priority'				=> 10,
				'active_callback' 		=> 'sunio_cac_has_woo_floating_bar',
			) ) );

			/**
		     * Floating Bar Add To Cart Background
		     */
	        $wp_customize->add_setting( 'sunio_woo_floating_bar_addtocart_bg', array(
				'default'				=> '#ffffff',
				'transport'				=> 'postMessage',
				'sanitize_callback' 	=> 'sunio_sanitize_color',
			) );

			$wp_customize->add_control( new sunio_Customizer_Color_Control( $wp_customize, 'sunio_woo_floating_bar_addtocart_bg', array(
				'label'					=> esc_html__( 'Add To Cart: Background', 'sunio' ),
				'section'				=> 'sunio_woocommerce_single',
				'settings'				=> 'sunio_woo_floating_bar_addtocart_bg',
				'priority'				=> 10,
				'active_callback' 		=> 'sunio_cac_has_woo_floating_bar',
			) ) );

			/**
		     * Floating Bar Add To Cart Hover Background
		     */
	        $wp_customize->add_setting( 'sunio_woo_floating_bar_addtocart_hover_bg', array(
				'default'				=> '#f1f1f1',
				'transport'				=> 'postMessage',
				'sanitize_callback' 	=> 'sunio_sanitize_color',
			) );

			$wp_customize->add_control( new sunio_Customizer_Color_Control( $wp_customize, 'sunio_woo_floating_bar_addtocart_hover_bg', array(
				'label'					=> esc_html__( 'Add To Cart Hover: Background', 'sunio' ),
				'section'				=> 'sunio_woocommerce_single',
				'settings'				=> 'sunio_woo_floating_bar_addtocart_hover_bg',
				'priority'				=> 10,
				'active_callback' 		=> 'sunio_cac_has_woo_floating_bar',
			) ) );

			/**
		     * Floating Bar Add To Cart Color
		     */
	        $wp_customize->add_setting( 'sunio_woo_floating_bar_addtocart_color', array(
				'default'				=> '#000000',
				'transport'				=> 'postMessage',
				'sanitize_callback' 	=> 'sunio_sanitize_color',
			) );

			$wp_customize->add_control( new sunio_Customizer_Color_Control( $wp_customize, 'sunio_woo_floating_bar_addtocart_color', array(
				'label'					=> esc_html__( 'Add To Cart: Color', 'sunio' ),
				'section'				=> 'sunio_woocommerce_single',
				'settings'				=> 'sunio_woo_floating_bar_addtocart_color',
				'priority'				=> 10,
				'active_callback' 		=> 'sunio_cac_has_woo_floating_bar',
			) ) );

			/**
		     * Floating Bar Add To Cart Hover Color
		     */
	        $wp_customize->add_setting( 'sunio_woo_floating_bar_addtocart_hover_color', array(
				'default'				=> '#000000',
				'transport'				=> 'postMessage',
				'sanitize_callback' 	=> 'sunio_sanitize_color',
			) );

			$wp_customize->add_control( new sunio_Customizer_Color_Control( $wp_customize, 'sunio_woo_floating_bar_addtocart_hover_color', array(
				'label'					=> esc_html__( 'Add To Cart Hover: Color', 'sunio' ),
				'section'				=> 'sunio_woocommerce_single',
				'settings'				=> 'sunio_woo_floating_bar_addtocart_hover_color',
				'priority'				=> 10,
				'active_callback' 		=> 'sunio_cac_has_woo_floating_bar',
			) ) );

			/**
			 * Section
			 */
			$wp_customize->add_section( 'sunio_woocommerce_cart' , array(
				'title' 			=> esc_html__( 'Cart', 'sunio' ),
				'description' 		=> esc_html__( 'For some options, you must save and refresh your live site to preview changes.', 'sunio' ),
				'priority' 			=> 10,
				'panel' 			=> $panel,
			) );

			/**
			 * Distraction Free Cart
			 */
			$wp_customize->add_setting( 'sunio_woo_distraction_free_cart', array(
				'default'           	=> false,
				'sanitize_callback' 	=> 'sunio_sanitize_checkbox',
			) );

			$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'sunio_woo_distraction_free_cart', array(
				'label'	   				=> esc_html__( 'Distraction Free Cart', 'sunio' ),
				'type' 					=> 'checkbox',
				'section'  				=> 'sunio_woocommerce_cart',
				'settings' 				=> 'sunio_woo_distraction_free_cart',
				'priority' 				=> 10,
			) ) );

			/**
			 * Cross-Sells Count
			 */
			$wp_customize->add_setting( 'sunio_woocommerce_cross_sells_count', array(
				'default'           	=> '2',
				'sanitize_callback' 	=> 'sunio_sanitize_number',
			) );

			$wp_customize->add_control( new sunio_Customizer_Range_Control( $wp_customize, 'sunio_woocommerce_cross_sells_count', array(
				'label'	   				=> esc_html__( 'Cart: Cross-Sells Count', 'sunio' ),
				'section'  				=> 'sunio_woocommerce_cart',
				'settings' 				=> 'sunio_woocommerce_cross_sells_count',
				'priority' 				=> 10,
			    'input_attrs' 			=> array(
			        'min'   => 1,
			        'max'   => 10,
			        'step'  => 1,
			    ),
			) ) );

			/**
			 * Cross-Sells Columns
			 */
			$wp_customize->add_setting( 'sunio_woocommerce_cross_sells_columns', array(
				'default'           	=> '2',
				'sanitize_callback' 	=> 'sunio_sanitize_number',
			) );

			$wp_customize->add_control( new sunio_Customizer_Range_Control( $wp_customize, 'sunio_woocommerce_cross_sells_columns', array(
				'label'	   				=> esc_html__( 'Cart: Cross-Sells Columns', 'sunio' ),
				'section'  				=> 'sunio_woocommerce_cart',
				'settings' 				=> 'sunio_woocommerce_cross_sells_columns',
				'priority' 				=> 10,
			    'input_attrs' 			=> array(
			        'min'   => 1,
			        'max'   => 7,
			        'step'  => 1,
			    ),
			) ) );

			/**
			 * Section
			 */
			$wp_customize->add_section( 'sunio_woocommerce_checkout' , array(
				'title' 			=> esc_html__( 'Checkout', 'sunio' ),
				'priority' 			=> 10,
				'panel' 			=> $panel,
			) );

			/**
			 * Distraction Free Checkout
			 */
			$wp_customize->add_setting( 'sunio_woo_distraction_free_checkout', array(
				'default'           	=> false,
				'sanitize_callback' 	=> 'sunio_sanitize_checkbox',
			) );

			$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'sunio_woo_distraction_free_checkout', array(
				'label'	   				=> esc_html__( 'Distraction Free Checkout', 'sunio' ),
				'type' 					=> 'checkbox',
				'section'  				=> 'sunio_woocommerce_checkout',
				'settings' 				=> 'sunio_woo_distraction_free_checkout',
				'priority' 				=> 10,
			) ) );

			/**
			 * Multi-Step Checkout
			 */
			$wp_customize->add_setting( 'sunio_woo_multi_step_checkout', array(
				'default'           	=> false,
				'sanitize_callback' 	=> 'sunio_sanitize_checkbox',
			) );

			$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'sunio_woo_multi_step_checkout', array(
				'label'	   				=> esc_html__( 'Multi-Step Checkout', 'sunio' ),
				'type' 					=> 'checkbox',
				'section'  				=> 'sunio_woocommerce_checkout',
				'settings' 				=> 'sunio_woo_multi_step_checkout',
				'priority' 				=> 10,
			) ) );

			/**
			 * Multi-Step Checkout Timeline Style
			 */
			$wp_customize->add_setting( 'sunio_woo_multi_step_checkout_timeline_style', array(
				'transport'				=> 'postMessage',
				'default'           	=> 'arrow',
				'sanitize_callback' 	=> 'sunio_sanitize_select',
			) );

			$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'sunio_woo_multi_step_checkout_timeline_style', array(
				'label'	   				=> esc_html__( 'Timeline Style', 'sunio' ),
				'type' 					=> 'select',
				'section'  				=> 'sunio_woocommerce_checkout',
				'settings' 				=> 'sunio_woo_multi_step_checkout_timeline_style',
				'priority' 				=> 10,
				'choices' 				=> array(
					'arrow' 		=> esc_html__( 'Arrow', 'sunio' ),
					'square' 		=> esc_html__( 'Square', 'sunio' ),
				),
				'active_callback' 		=> 'sunio_cac_has_woo_multistep_checkout',
			) ) );

			/**
		     * Multi-Step Checkout Timeline Background
		     */
	        $wp_customize->add_setting( 'sunio_woo_checkout_timeline_bg', array(
				'default'				=> '#eeeeee',
				'transport'				=> 'postMessage',
				'sanitize_callback' 	=> 'sunio_sanitize_color',
			) );

			$wp_customize->add_control( new sunio_Customizer_Color_Control( $wp_customize, 'sunio_woo_checkout_timeline_bg', array(
				'label'					=> esc_html__( 'Timeline: Background', 'sunio' ),
				'section'				=> 'sunio_woocommerce_checkout',
				'settings'				=> 'sunio_woo_checkout_timeline_bg',
				'priority'				=> 10,
				'active_callback' 		=> 'sunio_cac_has_woo_multistep_checkout',
			) ) );

			/**
		     * Multi-Step Checkout Timeline Color
		     */
	        $wp_customize->add_setting( 'sunio_woo_checkout_timeline_color', array(
				'default'				=> '#333333',
				'transport'				=> 'postMessage',
				'sanitize_callback' 	=> 'sunio_sanitize_color',
			) );

			$wp_customize->add_control( new sunio_Customizer_Color_Control( $wp_customize, 'sunio_woo_checkout_timeline_color', array(
				'label'					=> esc_html__( 'Timeline: Color', 'sunio' ),
				'section'				=> 'sunio_woocommerce_checkout',
				'settings'				=> 'sunio_woo_checkout_timeline_color',
				'priority'				=> 10,
				'active_callback' 		=> 'sunio_cac_has_woo_multistep_checkout',
			) ) );

			/**
		     * Multi-Step Checkout Timeline Number Background
		     */
	        $wp_customize->add_setting( 'sunio_woo_checkout_timeline_number_bg', array(
				'default'				=> '#ffffff',
				'transport'				=> 'postMessage',
				'sanitize_callback' 	=> 'sunio_sanitize_color',
			) );

			$wp_customize->add_control( new sunio_Customizer_Color_Control( $wp_customize, 'sunio_woo_checkout_timeline_number_bg', array(
				'label'					=> esc_html__( 'Timeline Number: Background', 'sunio' ),
				'section'				=> 'sunio_woocommerce_checkout',
				'settings'				=> 'sunio_woo_checkout_timeline_number_bg',
				'priority'				=> 10,
				'active_callback' 		=> 'sunio_cac_has_woo_multistep_checkout',
			) ) );

			/**
		     * Multi-Step Checkout Timeline Number Color
		     */
	        $wp_customize->add_setting( 'sunio_woo_checkout_timeline_number_color', array(
				'default'				=> '#cccccc',
				'transport'				=> 'postMessage',
				'sanitize_callback' 	=> 'sunio_sanitize_color',
			) );

			$wp_customize->add_control( new sunio_Customizer_Color_Control( $wp_customize, 'sunio_woo_checkout_timeline_number_color', array(
				'label'					=> esc_html__( 'Timeline Number: Color', 'sunio' ),
				'section'				=> 'sunio_woocommerce_checkout',
				'settings'				=> 'sunio_woo_checkout_timeline_number_color',
				'priority'				=> 10,
				'active_callback' 		=> 'sunio_cac_has_woo_multistep_checkout',
			) ) );

			/**
		     * Multi-Step Checkout Timeline Number Color
		     */
	        $wp_customize->add_setting( 'sunio_woo_checkout_timeline_number_border_color', array(
				'default'				=> '#cccccc',
				'transport'				=> 'postMessage',
				'sanitize_callback' 	=> 'sunio_sanitize_color',
			) );

			$wp_customize->add_control( new sunio_Customizer_Color_Control( $wp_customize, 'sunio_woo_checkout_timeline_number_border_color', array(
				'label'					=> esc_html__( 'Timeline Number: Border Color', 'sunio' ),
				'section'				=> 'sunio_woocommerce_checkout',
				'settings'				=> 'sunio_woo_checkout_timeline_number_border_color',
				'priority'				=> 10,
				'active_callback' 		=> 'sunio_cac_has_woo_multistep_checkout',
			) ) );

			/**
		     * Multi-Step Checkout Timeline Background
		     */
	        $wp_customize->add_setting( 'sunio_woo_checkout_timeline_active_bg', array(
				'default'				=> '#13aff0',
				'transport'				=> 'postMessage',
				'sanitize_callback' 	=> 'sunio_sanitize_color',
			) );

			$wp_customize->add_control( new sunio_Customizer_Color_Control( $wp_customize, 'sunio_woo_checkout_timeline_active_bg', array(
				'label'					=> esc_html__( 'Timeline Active: Background', 'sunio' ),
				'section'				=> 'sunio_woocommerce_checkout',
				'settings'				=> 'sunio_woo_checkout_timeline_active_bg',
				'priority'				=> 10,
				'active_callback' 		=> 'sunio_cac_has_woo_multistep_checkout',
			) ) );

			/**
		     * Multi-Step Checkout Timeline Color
		     */
	        $wp_customize->add_setting( 'sunio_woo_checkout_timeline_active_color', array(
				'default'				=> '#ffffff',
				'transport'				=> 'postMessage',
				'sanitize_callback' 	=> 'sunio_sanitize_color',
			) );

			$wp_customize->add_control( new sunio_Customizer_Color_Control( $wp_customize, 'sunio_woo_checkout_timeline_active_color', array(
				'label'					=> esc_html__( 'Timeline Active: Color', 'sunio' ),
				'section'				=> 'sunio_woocommerce_checkout',
				'settings'				=> 'sunio_woo_checkout_timeline_active_color',
				'priority'				=> 10,
				'active_callback' 		=> 'sunio_cac_has_woo_multistep_checkout',
			) ) );

		}

		/**
		 * Get CSS
		 *
		 * @since 1.0.0
		 */
		public static function head_css( $output ) {

			// Global vars
			$menu_icon_size										= get_theme_mod( 'sunio_woo_menu_icon_size' );
			$menu_icon_size_tablet								= get_theme_mod( 'sunio_woo_menu_icon_size_tablet' );
			$menu_icon_size_mobile								= get_theme_mod( 'sunio_woo_menu_icon_size_mobile' );
			$menu_icon_center_vertically						= get_theme_mod( 'sunio_woo_menu_icon_center_vertically' );
			$menu_icon_center_vertically_tablet					= get_theme_mod( 'sunio_woo_menu_icon_center_vertically_tablet' );
			$menu_icon_center_vertically_mobile					= get_theme_mod( 'sunio_woo_menu_icon_center_vertically_mobile' );


			// Styling vars
			$infinite_scroll_spinners_color 					= get_theme_mod( 'sunio_woo_infinite_scroll_spinners_color', '#333333' );
			$woo_product_image_width 							= get_theme_mod( 'sunio_woo_product_image_width', '40' );
			$woo_product_summary_width 							= get_theme_mod( 'sunio_woo_product_summary_width', '60' );
			$floating_bar_bg 									= get_theme_mod( 'sunio_woo_floating_bar_bg', '#2c2c2c' );
			$floating_bar_title_color 							= get_theme_mod( 'sunio_woo_floating_bar_title_color', '#ffffff' );
			$floating_bar_price_color 							= get_theme_mod( 'sunio_woo_floating_bar_price_color', '#ffffff' );
			$floating_bar_quantity_buttons_bg 					= get_theme_mod( 'sunio_woo_floating_bar_quantity_buttons_bg', 'rgba(255,255,255,0.1)' );
			$floating_bar_quantity_buttons_hover_bg 			= get_theme_mod( 'sunio_woo_floating_bar_quantity_buttons_hover_bg', 'rgba(255,255,255,0.2)' );
			$floating_bar_quantity_buttons_color 				= get_theme_mod( 'sunio_woo_floating_bar_quantity_buttons_color', '#ffffff' );
			$floating_bar_quantity_buttons_hover_color 			= get_theme_mod( 'sunio_woo_floating_bar_quantity_buttons_hover_color', '#ffffff' );
			$floating_bar_quantity_input_bg 					= get_theme_mod( 'sunio_woo_floating_bar_quantity_input_bg', 'rgba(255,255,255,0.2)' );
			$floating_bar_quantity_input_color 					= get_theme_mod( 'sunio_woo_floating_bar_quantity_input_color', '#ffffff' );
			$floating_bar_addtocart_bg 							= get_theme_mod( 'sunio_woo_floating_bar_addtocart_bg', '#ffffff' );
			$floating_bar_addtocart_hover_bg 					= get_theme_mod( 'sunio_woo_floating_bar_addtocart_hover_bg', '#f1f1f1' );
			$floating_bar_addtocart_color 						= get_theme_mod( 'sunio_woo_floating_bar_addtocart_color', '#000000' );
			$floating_bar_addtocart_hover_color 				= get_theme_mod( 'sunio_woo_floating_bar_addtocart_hover_color', '#000000' );
			$checkout_timeline_bg 								= get_theme_mod( 'sunio_woo_checkout_timeline_bg', '#eeeeee' );
			$checkout_timeline_color 							= get_theme_mod( 'sunio_woo_checkout_timeline_color', '#333333' );
			$checkout_timeline_number_bg 						= get_theme_mod( 'sunio_woo_checkout_timeline_number_bg', '#ffffff' );
			$checkout_timeline_number_color 					= get_theme_mod( 'sunio_woo_checkout_timeline_number_color', '#cccccc' );
			$checkout_timeline_number_border_color 				= get_theme_mod( 'sunio_woo_checkout_timeline_number_border_color', '#cccccc' );
			$checkout_timeline_active_bg 						= get_theme_mod( 'sunio_woo_checkout_timeline_active_bg', '#13aff0' );
			$checkout_timeline_active_color 					= get_theme_mod( 'sunio_woo_checkout_timeline_active_color', '#ffffff' );
			$quantity_border_color 								= get_theme_mod( 'sunio_quantity_border_color', '#e4e4e4' );
			$quantity_border_color_focus 						= get_theme_mod( 'sunio_quantity_border_color_focus', '#bbbbbb' );
			$quantity_color 									= get_theme_mod( 'sunio_quantity_color', '#777777' );
			$quantity_plus_minus_color 							= get_theme_mod( 'sunio_quantity_plus_minus_color', '#cccccc' );
			$quantity_plus_minus_color_hover 					= get_theme_mod( 'sunio_quantity_plus_minus_color_hover', '#cccccc' );
			$quantity_plus_minus_border_color_hover 			= get_theme_mod( 'sunio_quantity_plus_minus_border_color_hover', '#e0e0e0' );
			$toolbar_border_color 								= get_theme_mod( 'sunio_toolbar_border_color', '#eaeaea' );
			$toolbar_off_canvas_filter_color 					= get_theme_mod( 'sunio_toolbar_off_canvas_filter_color', '#999999' );
			$toolbar_off_canvas_filter_border_color 			= get_theme_mod( 'sunio_toolbar_off_canvas_filter_border_color', '#eaeaea' );
			$toolbar_off_canvas_filter_hover_color 				= get_theme_mod( 'sunio_toolbar_off_canvas_filter_hover_color', '#13aff0' );
			$toolbar_off_canvas_filter_hover_border_color 		= get_theme_mod( 'sunio_toolbar_off_canvas_filter_hover_border_color', '#13aff0' );
			$toolbar_grid_list_color 							= get_theme_mod( 'sunio_toolbar_grid_list_color', '#999999' );
			$toolbar_grid_list_border_color 					= get_theme_mod( 'sunio_toolbar_grid_list_border_color', '#eaeaea' );
			$toolbar_grid_list_hover_color 						= get_theme_mod( 'sunio_toolbar_grid_list_hover_color', '#13aff0' );
			$toolbar_grid_list_active_color 					= get_theme_mod( 'sunio_toolbar_grid_list_active_color', '#13aff0' );
			$toolbar_select_color 								= get_theme_mod( 'sunio_toolbar_select_color', '#999999' );
			$toolbar_select_border_color 						= get_theme_mod( 'sunio_toolbar_select_border_color', '#dddddd' );
			$toolbar_number_of_products_color 					= get_theme_mod( 'sunio_toolbar_number_of_products_color', '#555555' );
			$toolbar_number_of_products_inactive_color 			= get_theme_mod( 'sunio_toolbar_number_of_products_inactive_color', '#999999' );
			$toolbar_number_of_products_border_color 			= get_theme_mod( 'sunio_toolbar_number_of_products_border_color', '#999999' );
			$category_color 									= get_theme_mod( 'sunio_category_color', '#999999' );
			$category_color_hover 								= get_theme_mod( 'sunio_category_color_hover', '#13aff0' );
			$product_title_color 								= get_theme_mod( 'sunio_product_title_color', '#333333' );
			$product_title_color_hover 							= get_theme_mod( 'sunio_product_title_color_hover', '#13aff0' );
			$product_entry_price_color 							= get_theme_mod( 'sunio_product_entry_price_color', '#57bf6d' );
			$product_entry_del_price_color 						= get_theme_mod( 'sunio_product_entry_del_price_color', '#666666' );
			$product_entry_hover_thumbnails_border_color 		= get_theme_mod( 'sunio_product_entry_hover_thumbnails_border_color', '#13aff0' );
			$product_entry_hover_quickview_background 			= get_theme_mod( 'sunio_product_entry_hover_quickview_background', '#ffffff' );
			$product_entry_hover_quickview_hover_background 	= get_theme_mod( 'sunio_product_entry_hover_quickview_hover_background', '#ffffff' );
			$product_entry_hover_quickview_color 				= get_theme_mod( 'sunio_product_entry_hover_quickview_color', '#444444' );
			$product_entry_hover_quickview_hover_color 			= get_theme_mod( 'sunio_product_entry_hover_quickview_hover_color', '#13aff0' );
			$product_entry_hover_wishlist_background 			= get_theme_mod( 'sunio_product_entry_hover_wishlist_background', '#ffffff' );
			$product_entry_hover_wishlist_hover_background 		= get_theme_mod( 'sunio_product_entry_hover_wishlist_hover_background', '#ffffff' );
			$product_entry_hover_wishlist_color 				= get_theme_mod( 'sunio_product_entry_hover_wishlist_color', '#444444' );
			$product_entry_hover_wishlist_hover_color 			= get_theme_mod( 'sunio_product_entry_hover_wishlist_hover_color', '#13aff0' );
			$product_entry_addtocart_bg_color 					= get_theme_mod( 'sunio_product_entry_addtocart_bg_color' );
			$product_entry_addtocart_bg_color_hover 			= get_theme_mod( 'sunio_product_entry_addtocart_bg_color_hover' );
			$product_entry_addtocart_color 						= get_theme_mod( 'sunio_product_entry_addtocart_color', '#848494' );
			$product_entry_addtocart_color_hover 				= get_theme_mod( 'sunio_product_entry_addtocart_color_hover', '#13aff0' );
			$product_entry_addtocart_border_color 				= get_theme_mod( 'sunio_product_entry_addtocart_border_color', '#e4e4e4' );
			$product_entry_addtocart_border_color_hover 		= get_theme_mod( 'sunio_product_entry_addtocart_border_color_hover', '#13aff0' );
			$product_entry_addtocart_border_style 				= get_theme_mod( 'sunio_product_entry_addtocart_border_style', 'double' );
			$product_entry_addtocart_border_size 				= get_theme_mod( 'sunio_product_entry_addtocart_border_size' );
			$product_entry_addtocart_border_radius 				= get_theme_mod( 'sunio_product_entry_addtocart_border_radius' );
			$quick_view_button_bg 								= get_theme_mod( 'sunio_woo_quick_view_button_bg', 'rgba(0,0,0,0.6)' );
			$quick_view_button_hover_bg 						= get_theme_mod( 'sunio_woo_quick_view_button_hover_bg', 'rgba(0,0,0,0.9)' );
			$quick_view_button_color 							= get_theme_mod( 'sunio_woo_quick_view_button_color', '#ffffff' );
			$quick_view_button_hover_color 						= get_theme_mod( 'sunio_woo_quick_view_button_hover_color', '#ffffff' );
			$quick_view_overlay_bg 								= get_theme_mod( 'sunio_woo_quick_view_overlay_bg', 'rgba(0,0,0,0.15)' );
			$quick_view_overlay_spinner_outside_color 			= get_theme_mod( 'sunio_woo_quick_view_overlay_spinner_outside_color', 'rgba(0,0,0,0.1)' );
			$quick_view_overlay_spinner_inner_color 			= get_theme_mod( 'sunio_woo_quick_view_overlay_spinner_inner_color', '#ffffff' );
			$quick_view_modal_bg 								= get_theme_mod( 'sunio_woo_quick_view_modal_bg', '#ffffff' );
			$quick_view_modal_close_color 						= get_theme_mod( 'sunio_woo_quick_view_modal_close_color', '#333333' );
			$off_canvas_sidebar_bg 								= get_theme_mod( 'sunio_woo_off_canvas_sidebar_bg', '#ffffff' );
			$off_canvas_sidebar_widgets_border 					= get_theme_mod( 'sunio_woo_off_canvas_sidebar_widgets_border', 'rgba(84,84,84,0.15)' );
			$single_product_title_color 						= get_theme_mod( 'sunio_single_product_title_color', '#333333' );
			$single_product_price_color 						= get_theme_mod( 'sunio_single_product_price_color', '#57bf6d' );
			$single_product_del_price_color 					= get_theme_mod( 'sunio_single_product_del_price_color', '#555555' );
			$single_product_description_color 					= get_theme_mod( 'sunio_single_product_description_color', '#aaaaaa' );
			$single_product_meta_title_color 					= get_theme_mod( 'sunio_single_product_meta_title_color', '#333333' );
			$single_product_meta_link_color 					= get_theme_mod( 'sunio_single_product_meta_link_color', '#aaaaaa' );
			$single_product_meta_link_color_hover 				= get_theme_mod( 'sunio_single_product_meta_link_color_hover', '#13aff0' );
			$single_product_navigation_border_radius 			= get_theme_mod( 'sunio_single_product_navigation_border_radius', '30' );
			$single_product_navigation_hover_bg 				= get_theme_mod( 'sunio_single_product_navigation_hover_bg', '#13aff0' );
			$single_product_navigation_color 					= get_theme_mod( 'sunio_single_product_navigation_color', '#333333' );
			$single_product_navigation_hover_color 				= get_theme_mod( 'sunio_single_product_navigation_hover_color', '#ffffff' );
			$single_product_navigation_border_color 			= get_theme_mod( 'sunio_single_product_navigation_border_color', '#e9e9e9' );
			$single_product_navigation_hover_border_color 		= get_theme_mod( 'sunio_single_product_navigation_hover_border_color', '#13aff0' );
			$single_product_tabs_borders_color 					= get_theme_mod( 'sunio_single_product_tabs_borders_color', '#e9e9e9' );
			$single_product_tabs_text_color 					= get_theme_mod( 'sunio_single_product_tabs_text_color', '#999999' );
			$single_product_tabs_text_color_hover 				= get_theme_mod( 'sunio_single_product_tabs_text_color_hover', '#13aff0' );
			$single_product_tabs_active_text_color 				= get_theme_mod( 'sunio_single_product_tabs_active_text_color', '#13aff0' );
			$single_product_tabs_active_text_borders_color 		= get_theme_mod( 'sunio_single_product_tabs_active_text_borders_color', '#13aff0' );
			$single_product_tabs_product_desc_title_color 		= get_theme_mod( 'sunio_single_product_tabs_product_description_title_color', '#333333' );
			$single_product_tabs_product_desc_color 			= get_theme_mod( 'sunio_single_product_tabs_product_description_color', '#929292' );
			$account_login_register_color 						= get_theme_mod( 'sunio_account_login_register_color', '#333333' );
			$account_nav_borders_color 							= get_theme_mod( 'sunio_account_navigation_borders_color', '#e9e9e9' );
			$account_nav_icons_color 							= get_theme_mod( 'sunio_account_navigation_icons_color', '#13aff0' );
			$account_nav_links_color 							= get_theme_mod( 'sunio_account_navigation_links_color', '#333333' );
			$account_nav_links_color_hover 						= get_theme_mod( 'sunio_account_navigation_links_color_hover', '#13aff0' );
			$account_addresses_bg 								= get_theme_mod( 'sunio_account_addresses_bg', '#f6f6f6' );
			$account_addresses_title_color 						= get_theme_mod( 'sunio_account_addresses_title_color', '#333333' );
			$account_addresses_title_border_color 				= get_theme_mod( 'sunio_account_addresses_title_border_color', '#ffffff' );
			$account_addresses_content_color 					= get_theme_mod( 'sunio_account_addresses_content_color', '#898989' );
			$account_addresses_button_bg 						= get_theme_mod( 'sunio_account_addresses_button_bg', '#ffffff' );
			$account_addresses_button_bg_hover 					= get_theme_mod( 'sunio_account_addresses_button_bg_hover', '#f8f8f8' );
			$account_addresses_button_color 					= get_theme_mod( 'sunio_account_addresses_button_color', '#898989' );
			$account_addresses_button_color_hover 				= get_theme_mod( 'sunio_account_addresses_button_color_hover', '#555555' );
			$cart_borders_color 								= get_theme_mod( 'sunio_cart_borders_color', '#e9e9e9' );
			$cart_head_bg 										= get_theme_mod( 'sunio_cart_head_bg', '#f7f7f7' );
			$cart_head_titles_color 							= get_theme_mod( 'sunio_cart_head_titles_color', '#444444' );
			$cart_totals_table_titles_color 					= get_theme_mod( 'sunio_cart_totals_table_titles_color', '#444444' );
			$cart_remove_button_color 							= get_theme_mod( 'sunio_cart_remove_button_color', '#bbbbbb' );
			$cart_remove_button_color_hover 					= get_theme_mod( 'sunio_cart_remove_button_color_hover', '#333333' );
			$checkout_notices_borders_color 					= get_theme_mod( 'sunio_checkout_notices_borders_color', '#e9e9e9' );
			$checkout_notices_icon_color 						= get_theme_mod( 'sunio_checkout_notices_icon_color', '#dddddd' );
			$checkout_notices_color 							= get_theme_mod( 'sunio_checkout_notices_color', '#777777' );
			$checkout_notices_link_color 						= get_theme_mod( 'sunio_checkout_notices_link_color', '#13aff0' );
			$checkout_notices_link_color_hover 					= get_theme_mod( 'sunio_checkout_notices_link_color_hover', '#333333' );
			$checkout_notices_form_border_color 				= get_theme_mod( 'sunio_checkout_notices_form_border_color', '#e9e9e9' );
			$checkout_titles_color 								= get_theme_mod( 'sunio_checkout_titles_color', '#333333' );
			$checkout_titles_border_bottom_color 				= get_theme_mod( 'sunio_checkout_titles_border_bottom_color', '#e9e9e9' );
			$checkout_table_main_bg 							= get_theme_mod( 'sunio_checkout_table_main_bg', '#f7f7f7' );
			$checkout_table_titles_color 						= get_theme_mod( 'sunio_checkout_table_titles_color', '#444444' );
			$checkout_table_borders_color 						= get_theme_mod( 'sunio_checkout_table_borders_color', '#e9e9e9' );
			$checkout_payment_methods_bg 						= get_theme_mod( 'sunio_checkout_payment_methods_bg', '#f8f8f8' );
			$checkout_payment_methods_borders_color 			= get_theme_mod( 'sunio_checkout_payment_methods_borders_color', '#e9e9e9' );
			$checkout_payment_box_bg 							= get_theme_mod( 'sunio_checkout_payment_box_bg', '#ffffff' );
			$checkout_payment_box_color 						= get_theme_mod( 'sunio_checkout_payment_box_color', '#515151' );

			// Both sidebars shop page layout
			$archives_layout 									= get_theme_mod( 'sunio_woo_shop_layout', 'left-sidebar' );
			$bs_archives_content_width 							= get_theme_mod( 'sunio_woo_shop_both_sidebars_content_width' );
			$bs_archives_sidebars_width 						= get_theme_mod( 'sunio_woo_shop_both_sidebars_sidebars_width' );

			// Both sidebars single product layout
			$single_layout 										= get_theme_mod( 'sunio_woo_product_layout', 'left-sidebar' );
			$bs_single_content_width 							= get_theme_mod( 'sunio_woo_product_both_sidebars_content_width' );
			$bs_single_sidebars_width 							= get_theme_mod( 'sunio_woo_product_both_sidebars_sidebars_width' );

			// Define css var
			$css = '';

			// Menu cart icon size
			if ( ! empty( $menu_icon_size ) ) {
				$css .= '.wcmenucart i{font-size:'. $menu_icon_size .'px;}';
			}

			// Menu cart icon size tablet
			if ( ! empty( $menu_icon_size_tablet ) ) {
				$css .= '@media (max-width: 768px){.sunio-mobile-menu-icon a.wcmenucart{font-size:'. $menu_icon_size_tablet .'px;}}';
			}

			// Menu cart icon size mobile
			if ( ! empty( $menu_icon_size_mobile ) ) {
				$css .= '@media (max-width: 480px){.sunio-mobile-menu-icon a.wcmenucart{font-size:'. $menu_icon_size_mobile .'px;}}';
			}

			// Menu cart icon center vertically
			if ( ! empty( $menu_icon_center_vertically ) ) {
				$css .= '.wcmenucart i{top:'. $menu_icon_center_vertically .'px;}';
			}

			// Menu cart icon center vertically tablet
			if ( ! empty( $menu_icon_center_vertically_tablet ) ) {
				$css .= '@media (max-width: 768px){.sunio-mobile-menu-icon a.wcmenucart{top:'. $menu_icon_center_vertically_tablet .'px;}}';
			}

			// Menu cart icon center vertically mobile
			if ( ! empty( $menu_icon_center_vertically_mobile ) ) {
				$css .= '@media (max-width: 480px){.sunio-mobile-menu-icon a.wcmenucart{top:'. $menu_icon_center_vertically_mobile .'px;}}';
			}

			// Cart dropdown width
			if ( ! empty( $cart_dropdown_width ) && '350' != $cart_dropdown_width ) {
				$css .= '.current-shop-items-dropdown{width:'. $cart_dropdown_width .'px;}';
			}

			// Bag icon style color
			if ( ! empty( $woo_menu_bag_icon_color ) && '#333333' != $woo_menu_bag_icon_color ) {
				$css .= '.wcmenucart-cart-icon .wcmenucart-count{border-color:'. $woo_menu_bag_icon_color .';}';
				$css .= '.wcmenucart-cart-icon .wcmenucart-count:after{border-color:'. $woo_menu_bag_icon_color .';}';
			}

			// Bag icon style hover color
			if ( ! empty( $woo_menu_bag_icon_hover_color ) && '#13aff0' != $woo_menu_bag_icon_hover_color ) {
				$css .= '.bag-style:hover .wcmenucart-cart-icon .wcmenucart-count, .show-cart .wcmenucart-cart-icon .wcmenucart-count{background-color:'. $woo_menu_bag_icon_hover_color .'; border-color:'. $woo_menu_bag_icon_hover_color .';}';
				$css .= '.bag-style:hover .wcmenucart-cart-icon .wcmenucart-count:after, .show-cart .wcmenucart-cart-icon .wcmenucart-count:after{border-color:'. $woo_menu_bag_icon_hover_color .';}';
			}

			// Bag icon style count color
			if ( ! empty( $woo_menu_bag_icon_count_color ) && '#333333' != $woo_menu_bag_icon_count_color ) {
				$css .= '.wcmenucart-cart-icon .wcmenucart-count, .woo-menu-icon .wcmenucart-total span{color:'. $woo_menu_bag_icon_count_color .';}';
			}

			// Bag icon style hover count color
			if ( ! empty( $woo_menu_bag_icon_hover_count_color ) && '#ffffff' != $woo_menu_bag_icon_hover_count_color ) {
				$css .= '.bag-style:hover .wcmenucart-cart-icon .wcmenucart-count, .show-cart .wcmenucart-cart-icon .wcmenucart-count{color:'. $woo_menu_bag_icon_hover_count_color .';}';
			}

			// Cart dropdown background
			if ( ! empty( $cart_dropdown_bg ) && '#ffffff' != $cart_dropdown_bg ) {
				$css .= '.current-shop-items-dropdown{background-color:'. $cart_dropdown_bg .';}';
			}

			// Cart dropdown borders
			if ( ! empty( $cart_dropdown_borders ) && '#e6e6e6' != $cart_dropdown_borders ) {
				$css .= '.widget_shopping_cart ul.cart_list li .azt-grid-wrap .azt-grid.thumbnail, .widget_shopping_cart ul.cart_list li, .woocommerce ul.product_list_widget li:first-child, .widget_shopping_cart .total{border-color:'. $cart_dropdown_borders .';}';
			}

			// Cart dropdown link color
			if ( ! empty( $cart_dropdown_link_color ) && '#333333' != $cart_dropdown_link_color ) {
				$css .= '.widget_shopping_cart ul.cart_list li .azt-grid-wrap .azt-grid a{color:'. $cart_dropdown_link_color .';}';
			}

			// Cart dropdown link hover color
			if ( ! empty( $cart_dropdown_link_color_hover ) && '#13aff0' != $cart_dropdown_link_color_hover ) {
				$css .= '.widget_shopping_cart ul.cart_list li .azt-grid-wrap .azt-grid a:hover{color:'. $cart_dropdown_link_color_hover .';}';
			}

			// Cart dropdown remove link color
			if ( ! empty( $cart_dropdown_remove_link_color ) && '#b3b3b3' != $cart_dropdown_remove_link_color ) {
				$css .= '.widget_shopping_cart ul.cart_list li .azt-grid-wrap .azt-grid a.remove{color:'. $cart_dropdown_remove_link_color .';border-color:'. $cart_dropdown_remove_link_color .';}';
			}

			// Cart dropdown remove link hover color
			if ( ! empty( $cart_dropdown_remove_link_color_hover ) && '#13aff0' != $cart_dropdown_remove_link_color_hover ) {
				$css .= '.widget_shopping_cart ul.cart_list li .azt-grid-wrap .azt-grid a.remove:hover{color:'. $cart_dropdown_remove_link_color_hover .';border-color:'. $cart_dropdown_remove_link_color_hover .';}';
			}

			// Cart dropdown quantity color
			if ( ! empty( $cart_dropdown_quantity_color ) && '#b2b2b2' != $cart_dropdown_quantity_color ) {
				$css .= '.widget_shopping_cart ul.cart_list li .azt-grid-wrap .azt-grid .quantity{color:'. $cart_dropdown_quantity_color .';}';
			}

			// Cart dropdown price color
			if ( ! empty( $cart_dropdown_price_color ) && '#57bf6d' != $cart_dropdown_price_color ) {
				$css .= '.widget_shopping_cart ul.cart_list li .azt-grid-wrap .azt-grid .amount{color:'. $cart_dropdown_price_color .';}';
			}

			// Cart dropdown subtotal background
			if ( ! empty( $cart_dropdown_subtotal_bg ) && '#fafafa' != $cart_dropdown_subtotal_bg ) {
				$css .= '.widget_shopping_cart .total{background-color:'. $cart_dropdown_subtotal_bg .';}';
			}

			// Cart dropdown subtotal color
			if ( ! empty( $cart_dropdown_subtotal_color ) && '#797979' != $cart_dropdown_subtotal_color ) {
				$css .= '.widget_shopping_cart .total strong{color:'. $cart_dropdown_subtotal_color .';}';
			}

			// Cart dropdown total price color
			if ( ! empty( $cart_dropdown_total_price_color ) && '#57bf6d' != $cart_dropdown_total_price_color ) {
				$css .= '.widget_shopping_cart .total .amount{color:'. $cart_dropdown_total_price_color .';}';
			}

			// Cart dropdown cart button background color
			if ( ! empty( $cart_dropdown_cart_button_bg ) ) {
				$css .= '.widget_shopping_cart_content .buttons .button:first-child{background-color:'. $cart_dropdown_cart_button_bg .';}';
			}

			// Cart dropdown cart button hover background color
			if ( ! empty( $cart_dropdown_cart_button_hover_bg ) ) {
				$css .= '.widget_shopping_cart_content .buttons .button:first-child:hover{background-color:'. $cart_dropdown_cart_button_hover_bg .';}';
			}

			// Cart dropdown cart button color
			if ( ! empty( $cart_dropdown_cart_button_color ) ) {
				$css .= '.widget_shopping_cart_content .buttons .button:first-child{color:'. $cart_dropdown_cart_button_color .';}';
			}

			// Cart dropdown cart button hover color
			if ( ! empty( $cart_dropdown_cart_button_hover_color ) ) {
				$css .= '.widget_shopping_cart_content .buttons .button:first-child:hover{color:'. $cart_dropdown_cart_button_hover_color .';}';
			}

			// Cart dropdown cart button border color
			if ( ! empty( $cart_dropdown_cart_button_border_color ) ) {
				$css .= '.widget_shopping_cart_content .buttons .button:first-child{border-color:'. $cart_dropdown_cart_button_border_color .';}';
			}

			// Cart dropdown cart button hover border color
			if ( ! empty( $cart_dropdown_cart_button_hover_border_color ) ) {
				$css .= '.widget_shopping_cart_content .buttons .button:first-child:hover{border-color:'. $cart_dropdown_cart_button_hover_border_color .';}';
			}

			// Cart dropdown checkout button background color
			if ( ! empty( $cart_dropdown_checkout_button_bg ) ) {
				$css .= '.widget_shopping_cart_content .buttons .checkout{background-color:'. $cart_dropdown_checkout_button_bg .';}';
			}

			// Cart dropdown checkout button hover background color
			if ( ! empty( $cart_dropdown_checkout_button_hover_bg ) ) {
				$css .= '.widget_shopping_cart_content .buttons .checkout:hover{background-color:'. $cart_dropdown_checkout_button_hover_bg .';}';
			}

			// Cart dropdown checkout button color
			if ( ! empty( $cart_dropdown_checkout_button_color ) ) {
				$css .= '.widget_shopping_cart_content .buttons .checkout{color:'. $cart_dropdown_checkout_button_color .';}';
			}

			// Cart dropdown checkout button hover color
			if ( ! empty( $cart_dropdown_checkout_button_hover_color ) ) {
				$css .= '.widget_shopping_cart_content .buttons .checkout:hover{color:'. $cart_dropdown_checkout_button_hover_color .';}';
			}

			// Mobile cart sidebar background color
			if ( ! empty( $woo_mobile_cart_sidebar_bg ) && '#ffffff' != $woo_mobile_cart_sidebar_bg ) {
				$css .= '#sunio-cart-sidebar-wrap .sunio-cart-sidebar{background-color:'. $woo_mobile_cart_sidebar_bg .';}';
			}

			// Mobile cart sidebar background color
			if ( ! empty( $woo_mobile_cart_sidebar_close_button_color ) && '#000000' != $woo_mobile_cart_sidebar_close_button_color ) {
				$css .= '#sunio-cart-sidebar-wrap .sunio-cart-close .close-wrap>div, #sunio-cart-sidebar-wrap .sunio-cart-close .close-wrap>div:before{background-color:'. $woo_mobile_cart_sidebar_close_button_color .';}';
			}

			// Mobile cart sidebar background color
			if ( ! empty( $woo_mobile_cart_sidebar_title_color ) && '#555555' != $woo_mobile_cart_sidebar_title_color ) {
				$css .= '#sunio-cart-sidebar-wrap h4{color:'. $woo_mobile_cart_sidebar_title_color .';}';
			}

			// Mobile cart sidebar background color
			if ( ! empty( $woo_mobile_cart_sidebar_divider_color ) && 'rgba(0,0,0,0.1)' != $woo_mobile_cart_sidebar_divider_color ) {
				$css .= '#sunio-cart-sidebar-wrap .divider{background-color:'. $woo_mobile_cart_sidebar_divider_color .';}';
			}

			// Off canvas close button color
			if ( ! empty( $off_canvas_close_button_color ) && '#333333' != $off_canvas_close_button_color ) {
				$css .= '.sunio-off-canvas-close svg{fill:'. $off_canvas_close_button_color .';}';
			}

			// Off canvas close button hover color
			if ( ! empty( $off_canvas_close_button_hover_color ) && '#777777' != $off_canvas_close_button_hover_color ) {
				$css .= '.sunio-off-canvas-close:hover svg{fill:'. $off_canvas_close_button_hover_color .';}';
			}

			// Infinite scroll spinners color
			if ( ! empty( $infinite_scroll_spinners_color ) && '#333333' != $infinite_scroll_spinners_color ) {
				$css .= '.woocommerce .loader-ellips__dot{background-color:'. $infinite_scroll_spinners_color .';}';
			}

			// Product image width
			if ( ! empty( $woo_product_image_width ) && '52' != $woo_product_image_width ) {
				$css .= '.woocommerce div.product div.images, .woocommerce.content-full-width div.product div.images{width:'. $woo_product_image_width .'%;}';
			}

			// Product summary width
			if ( ! empty( $woo_product_summary_width ) && '44' != $woo_product_summary_width ) {
				$css .= '.woocommerce div.product div.summary, .woocommerce.content-full-width div.product div.summary{width:'. $woo_product_summary_width .'%;}';
			}

			// Add floating bar background
			if ( ! empty( $floating_bar_bg ) && '#2c2c2c' != $floating_bar_bg ) {
				$css .= '.azt-floating-bar{background-color:'. $floating_bar_bg .';}';
			}

			// Add floating bar title color
			if ( ! empty( $floating_bar_title_color ) && '#ffffff' != $floating_bar_title_color ) {
				$css .= '.azt-floating-bar p.selected, .azt-floating-bar h2.entry-title{color:'. $floating_bar_title_color .';}';
			}

			// Add floating bar price color
			if ( ! empty( $floating_bar_price_color ) && '#ffffff' != $floating_bar_price_color ) {
				$css .= '.azt-floating-bar .product_price del .amount, .azt-floating-bar .product_price .amount, .azt-floating-bar .out-of-stock{color:'. $floating_bar_price_color .';}';
			}

			// Add floating bar quantity buttons background
			if ( ! empty( $floating_bar_quantity_buttons_bg ) && 'rgba(255,255,255,0.1)' != $floating_bar_quantity_buttons_bg ) {
				$css .= '.azt-floating-bar form.cart .quantity .minus, .azt-floating-bar form.cart .quantity .plus{background-color:'. $floating_bar_quantity_buttons_bg .';}';
			}

			// Add floating bar quantity buttons hover background
			if ( ! empty( $floating_bar_quantity_buttons_hover_bg ) && 'rgba(255,255,255,0.2)' != $floating_bar_quantity_buttons_hover_bg ) {
				$css .= '.azt-floating-bar form.cart .quantity .minus:hover, .azt-floating-bar form.cart .quantity .plus:hover{background-color:'. $floating_bar_quantity_buttons_hover_bg .';}';
			}

			// Add floating bar quantity buttons color
			if ( ! empty( $floating_bar_quantity_buttons_color ) && '#ffffff' != $floating_bar_quantity_buttons_color ) {
				$css .= '.azt-floating-bar form.cart .quantity .minus, .azt-floating-bar form.cart .quantity .plus{color:'. $floating_bar_quantity_buttons_color .';}';
			}

			// Add floating bar quantity buttons hover color
			if ( ! empty( $floating_bar_quantity_buttons_hover_color ) && '#ffffff' != $floating_bar_quantity_buttons_hover_color ) {
				$css .= '.azt-floating-bar form.cart .quantity .minus:hover, .azt-floating-bar form.cart .quantity .plus:hover{color:'. $floating_bar_quantity_buttons_hover_color .';}';
			}

			// Add floating bar quantity input background
			if ( ! empty( $floating_bar_quantity_input_bg ) && 'rgba(255,255,255,0.2)' != $floating_bar_quantity_input_bg ) {
				$css .= '.azt-floating-bar form.cart .quantity .qty{background-color:'. $floating_bar_quantity_input_bg .';}';
			}

			// Add floating bar quantity input color
			if ( ! empty( $floating_bar_quantity_input_color ) && '#ffffff' != $floating_bar_quantity_input_color ) {
				$css .= '.azt-floating-bar form.cart .quantity .qty{color:'. $floating_bar_quantity_input_color .';}';
			}

			// Add add to cart background
			if ( ! empty( $floating_bar_addtocart_bg ) && '#ffffff' != $floating_bar_addtocart_bg ) {
				$css .= '.azt-floating-bar button.button{background-color:'. $floating_bar_addtocart_bg .';}';
			}

			// Add add to cart hover background
			if ( ! empty( $floating_bar_addtocart_hover_bg ) && '#f1f1f1' != $floating_bar_addtocart_hover_bg ) {
				$css .= '.azt-floating-bar button.button:hover, .azt-floating-bar button.button:focus{background-color:'. $floating_bar_addtocart_hover_bg .';}';
			}

			// Add add to cart color
			if ( ! empty( $floating_bar_addtocart_color ) && '#000000' != $floating_bar_addtocart_color ) {
				$css .= '.azt-floating-bar button.button{color:'. $floating_bar_addtocart_color .';}';
			}

			// Add add to cart hover color
			if ( ! empty( $floating_bar_addtocart_hover_color ) && '#000000' != $floating_bar_addtocart_hover_color ) {
				$css .= '.azt-floating-bar button.button:hover, .azt-floating-bar button.button:focus{color:'. $floating_bar_addtocart_hover_color .';}';
			}

			// Add checkout timeline bg
			if ( ! empty( $checkout_timeline_bg ) && '#eeeeee' != $checkout_timeline_bg ) {
				$css .= '#azt-checkout-timeline .timeline-wrapper{background-color:'. $checkout_timeline_bg .';}#azt-checkout-timeline.arrow .timeline-wrapper:before{border-top-color:'. $checkout_timeline_bg .'; border-bottom-color:'. $checkout_timeline_bg .';}#azt-checkout-timeline.arrow .timeline-wrapper:after{border-left-color:'. $checkout_timeline_bg .'; border-right-color:'. $checkout_timeline_bg .';}';
			}

			// Add checkout timeline color
			if ( ! empty( $checkout_timeline_color ) && '#333333' != $checkout_timeline_color ) {
				$css .= '#azt-checkout-timeline .timeline-wrapper{color:'. $checkout_timeline_color .';}';
			}

			// Add checkout timeline number background color
			if ( ! empty( $checkout_timeline_number_bg ) && '#ffffff' != $checkout_timeline_number_bg ) {
				$css .= '#azt-checkout-timeline .timeline-step{background-color:'. $checkout_timeline_number_bg .';}';
			}

			// Add checkout timeline number color
			if ( ! empty( $checkout_timeline_number_color ) && '#ffffff' != $checkout_timeline_number_color ) {
				$css .= '#azt-checkout-timeline .timeline-step{color:'. $checkout_timeline_number_color .';}';
			}

			// Add checkout timeline number border color
			if ( ! empty( $checkout_timeline_number_border_color ) && '#ffffff' != $checkout_timeline_number_border_color ) {
				$css .= '#azt-checkout-timeline .timeline-step{border-color:'. $checkout_timeline_number_border_color .';}';
			}

			// Add checkout timeline active background color
			if ( ! empty( $checkout_timeline_active_bg ) && '#13aff0' != $checkout_timeline_active_bg ) {
				$css .= '#azt-checkout-timeline .active .timeline-wrapper{background-color:'. $checkout_timeline_active_bg .';}#azt-checkout-timeline.arrow .active .timeline-wrapper:before{border-top-color:'. $checkout_timeline_active_bg .'; border-bottom-color:'. $checkout_timeline_active_bg .';}#azt-checkout-timeline.arrow .active .timeline-wrapper:after{border-left-color:'. $checkout_timeline_active_bg .'; border-right-color:'. $checkout_timeline_active_bg .';}';
			}

			// Add checkout timeline active color
			if ( ! empty( $checkout_timeline_active_color ) && '#ffffff' != $checkout_timeline_active_color ) {
				$css .= '#azt-checkout-timeline .active .timeline-wrapper{color:'. $checkout_timeline_active_color .';}';
			}

			// Add onsale bg
			if ( ! empty( $onsale_bg ) && '#3FC387' != $onsale_bg ) {
				$css .= '.woocommerce span.onsale{background-color:'. $onsale_bg .';}';
			}

			// Add onsale color
			if ( ! empty( $onsale_color ) && '#ffffff' != $onsale_color ) {
				$css .= '.woocommerce span.onsale{color:'. $onsale_color .';}';
			}

			// Add out of stock bg
			if ( ! empty( $outofstock_bg ) && '#000000' != $outofstock_bg ) {
				$css .= '.woocommerce ul.products li.product.outofstock .outofstock-badge{background-color:'. $outofstock_bg .';}';
			}

			// Add out of stock color
			if ( ! empty( $outofstock_color ) && '#ffffff' != $outofstock_color ) {
				$css .= '.woocommerce ul.products li.product.outofstock .outofstock-badge{color:'. $outofstock_color .';}';
			}

			// Add stars color before
			if ( ! empty( $stars_color_before ) && '#dfdbdf' != $stars_color_before ) {
				$css .= '.woocommerce .star-rating:before{color:'. $stars_color_before .';}';
			}

			// Add stars color
			if ( ! empty( $stars_color ) && '#f9ca63' != $stars_color ) {
				$css .= '.woocommerce .star-rating span{color:'. $stars_color .';}';
			}

			// Add quantity border color
			if ( ! empty( $quantity_border_color ) && '#e4e4e4' != $quantity_border_color ) {
				$css .= '.quantity .qty,.quantity .qty-changer a{border-color:'. $quantity_border_color .';}';
			}

			// Add quantity border color focus
			if ( ! empty( $quantity_border_color_focus ) && '#bbbbbb' != $quantity_border_color_focus ) {
				$css .= 'body .quantity .qty:focus{border-color:'. $quantity_border_color_focus .';}';
			}

			// Add quantity color
			if ( ! empty( $quantity_color ) && '#777777' != $quantity_color ) {
				$css .= '.quantity .qty{color:'. $quantity_color .';}';
			}

			// Add quantity plus/minus color
			if ( ! empty( $quantity_plus_minus_color ) && '#cccccc' != $quantity_plus_minus_color ) {
				$css .= '.quantity .qty-changer a{color:'. $quantity_plus_minus_color .';}';
			}

			// Add quantity plus/minus color hover
			if ( ! empty( $quantity_plus_minus_color_hover ) && '#cccccc' != $quantity_plus_minus_color_hover ) {
				$css .= '.quantity .qty-changer a:hover{color:'. $quantity_plus_minus_color_hover .';}';
			}

			// Add quantity plus/minus border color hover
			if ( ! empty( $quantity_plus_minus_border_color_hover ) && '#e0e0e0' != $quantity_plus_minus_border_color_hover ) {
				$css .= '.quantity .qty-changer a:hover{border-color:'. $quantity_plus_minus_border_color_hover .';}';
			}

			// Add toolbar border color
			if ( ! empty( $toolbar_border_color ) && '#eaeaea' != $toolbar_border_color ) {
				$css .= '.woocommerce .sunio-toolbar{border-color:'. $toolbar_border_color .';}';
			}

			// Add toolbar off canvas filter color
			if ( ! empty( $toolbar_off_canvas_filter_color ) && '#999999' != $toolbar_off_canvas_filter_color ) {
				$css .= '.woocommerce .sunio-off-canvas-filter{color:'. $toolbar_off_canvas_filter_color .';}';
			}

			// Add toolbar off canvas filter border color
			if ( ! empty( $toolbar_off_canvas_filter_border_color ) && '#eaeaea' != $toolbar_off_canvas_filter_border_color ) {
				$css .= '.woocommerce .sunio-off-canvas-filter{border-color:'. $toolbar_off_canvas_filter_border_color .';}';
			}

			// Add toolbar off canvas filter hover color
			if ( ! empty( $toolbar_off_canvas_filter_hover_color ) && '#13aff0' != $toolbar_off_canvas_filter_hover_color ) {
				$css .= '.woocommerce .sunio-off-canvas-filter:hover{color:'. $toolbar_off_canvas_filter_hover_color .';}';
			}

			// Add toolbar off canvas filter hover border color
			if ( ! empty( $toolbar_off_canvas_filter_hover_border_color ) && '#13aff0' != $toolbar_off_canvas_filter_hover_border_color ) {
				$css .= '.woocommerce .sunio-off-canvas-filter:hover{border-color:'. $toolbar_off_canvas_filter_hover_border_color .';}';
			}

			// Add toolbar grid/list color
			if ( ! empty( $toolbar_grid_list_color ) && '#999999' != $toolbar_grid_list_color ) {
				$css .= '.woocommerce .sunio-grid-list a{color:'. $toolbar_grid_list_color .';}';
			}

			// Add toolbar grid/list border color
			if ( ! empty( $toolbar_grid_list_border_color ) && '#eaeaea' != $toolbar_grid_list_border_color ) {
				$css .= '.woocommerce .sunio-grid-list a{border-color:'. $toolbar_grid_list_border_color .';}';
			}

			// Add toolbar grid/list hover color
			if ( ! empty( $toolbar_grid_list_hover_color ) && '#13aff0' != $toolbar_grid_list_hover_color ) {
				$css .= '.woocommerce .sunio-grid-list a:hover{color:'. $toolbar_grid_list_hover_color .';border-color:'. $toolbar_grid_list_hover_color .';}';
			}

			// Add toolbar grid/list active color
			if ( ! empty( $toolbar_grid_list_active_color ) && '#13aff0' != $toolbar_grid_list_active_color ) {
				$css .= '.woocommerce .sunio-grid-list a.active{color:'. $toolbar_grid_list_active_color .';border-color:'. $toolbar_grid_list_active_color .';}';
			}

			// Add toolbar select color
			if ( ! empty( $toolbar_select_color ) && '#999999' != $toolbar_select_color ) {
				$css .= '.woocommerce .woocommerce-ordering .theme-select,.woocommerce .woocommerce-ordering .theme-select:after{color:'. $toolbar_select_color .';}';
			}

			// Add toolbar select border color
			if ( ! empty( $toolbar_select_border_color ) && '#dddddd' != $toolbar_select_border_color ) {
				$css .= '.woocommerce .woocommerce-ordering .theme-select,.woocommerce .woocommerce-ordering .theme-select:after{border-color:'. $toolbar_select_border_color .';}';
			}

			// Add toolbar number of products color
			if ( ! empty( $toolbar_number_of_products_color ) && '#555555' != $toolbar_number_of_products_color ) {
				$css .= '.woocommerce .result-count li.view-title,.woocommerce .result-count li a.active, .woocommerce .result-count li a:hover{color:'. $toolbar_number_of_products_color .';}';
			}

			// Add toolbar number of products inactive color
			if ( ! empty( $toolbar_number_of_products_inactive_color ) && '#999999' != $toolbar_number_of_products_inactive_color ) {
				$css .= '.woocommerce .result-count li a{color:'. $toolbar_number_of_products_inactive_color .';}';
			}

			// Add toolbar number of products border color
			if ( ! empty( $toolbar_number_of_products_border_color ) && '#999999' != $toolbar_number_of_products_border_color ) {
				$css .= '.woocommerce .result-count li:after{color:'. $toolbar_number_of_products_border_color .';}';
			}

			// Product padding
			if ( isset( $product_top_padding ) && '' != $product_top_padding
				|| isset( $product_right_padding ) && '' != $product_right_padding
				|| isset( $product_bottom_padding ) && '' != $product_bottom_padding
				|| isset( $product_left_padding ) && '' != $product_left_padding ) {
				$css .= '.woocommerce .products .product-inner{padding:'. sunio_spacing_css( $product_top_padding, $product_right_padding, $product_bottom_padding, $product_left_padding ) .'}';
			}

			// Tablet product padding
			if ( isset( $tablet_product_top_padding ) && '' != $tablet_product_top_padding
				|| isset( $tablet_product_right_padding ) && '' != $tablet_product_right_padding
				|| isset( $tablet_product_bottom_padding ) && '' != $tablet_product_bottom_padding
				|| isset( $tablet_product_left_padding ) && '' != $tablet_product_left_padding ) {
				$css .= '@media (max-width: 768px){.woocommerce .products .product-inner{padding:'. sunio_spacing_css( $tablet_product_top_padding, $tablet_product_right_padding, $tablet_product_bottom_padding, $tablet_product_left_padding ) .'}}';
			}

			// Mobile product padding
			if ( isset( $mobile_product_top_padding ) && '' != $mobile_product_top_padding
				|| isset( $mobile_product_right_padding ) && '' != $mobile_product_right_padding
				|| isset( $mobile_product_bottom_padding ) && '' != $mobile_product_bottom_padding
				|| isset( $mobile_product_left_padding ) && '' != $mobile_product_left_padding ) {
				$css .= '@media (max-width: 480px){.woocommerce .products .product-inner{padding:'. sunio_spacing_css( $mobile_product_top_padding, $mobile_product_right_padding, $mobile_product_bottom_padding, $mobile_product_left_padding ) .'}}';
			}

			// Product image margin
			if ( isset( $product_image_top_margin ) && '' != $product_image_top_margin
				|| isset( $product_image_right_margin ) && '' != $product_image_right_margin
				|| isset( $product_image_bottom_margin ) && '' != $product_image_bottom_margin
				|| isset( $product_image_left_margin ) && '' != $product_image_left_margin ) {
				$css .= '.woocommerce ul.products li.product .woo-entry-inner li.image-wrap{margin:'. sunio_spacing_css( $product_image_top_margin, $product_image_right_margin, $product_image_bottom_margin, $product_image_left_margin ) .'}';
			}

			// Tablet product image margin
			if ( isset( $tablet_product_image_top_margin ) && '' != $tablet_product_image_top_margin
				|| isset( $tablet_product_image_right_margin ) && '' != $tablet_product_image_right_margin
				|| isset( $tablet_product_image_bottom_margin ) && '' != $tablet_product_image_bottom_margin
				|| isset( $tablet_product_image_left_margin ) && '' != $tablet_product_image_left_margin ) {
				$css .= '@media (max-width: 768px){.woocommerce ul.products li.product .woo-entry-inner li.image-wrap{margin:'. sunio_spacing_css( $tablet_product_image_top_margin, $tablet_product_image_right_margin, $tablet_product_image_bottom_margin, $tablet_product_image_left_margin ) .'}}';
			}

			// Mobile product image margin
			if ( isset( $mobile_product_image_top_margin ) && '' != $mobile_product_image_top_margin
				|| isset( $mobile_product_image_right_margin ) && '' != $mobile_product_image_right_margin
				|| isset( $mobile_product_image_bottom_margin ) && '' != $mobile_product_image_bottom_margin
				|| isset( $mobile_product_image_left_margin ) && '' != $mobile_product_image_left_margin ) {
				$css .= '@media (max-width: 480px){.woocommerce ul.products li.product .woo-entry-inner li.image-wrap{margin:'. sunio_spacing_css( $mobile_product_image_top_margin, $mobile_product_image_right_margin, $mobile_product_image_bottom_margin, $mobile_product_image_left_margin ) .'}}';
			}

			// Product border style if border width
			if ( isset( $product_top_border_width ) && '' != $product_top_border_width
				|| isset( $product_right_border_width ) && '' != $product_right_border_width
				|| isset( $product_bottom_border_width ) && '' != $product_bottom_border_width
				|| isset( $product_left_border_width ) && '' != $product_left_border_width
				|| isset( $tablet_product_top_border_width ) && '' != $tablet_product_top_border_width
				|| isset( $tablet_product_right_border_width ) && '' != $tablet_product_right_border_width
				|| isset( $tablet_product_bottom_border_width ) && '' != $tablet_product_bottom_border_width
				|| isset( $tablet_product_left_border_width ) && '' != $tablet_product_left_border_width
				|| isset( $mobile_product_top_border_width ) && '' != $mobile_product_top_border_width
				|| isset( $mobile_product_right_border_width ) && '' != $mobile_product_right_border_width
				|| isset( $mobile_product_bottom_border_width ) && '' != $mobile_product_bottom_border_width
				|| isset( $mobile_product_left_border_width ) && '' != $mobile_product_left_border_width ) {
				$css .= '.woocommerce .products .product-inner{border-style: solid}';
			}

			// Product border width
			if ( isset( $product_top_border_width ) && '' != $product_top_border_width
				|| isset( $product_right_border_width ) && '' != $product_right_border_width
				|| isset( $product_bottom_border_width ) && '' != $product_bottom_border_width
				|| isset( $product_left_border_width ) && '' != $product_left_border_width ) {
				$css .= '.woocommerce .products .product-inner{border-width:'. sunio_spacing_css( $product_top_border_width, $product_right_border_width, $product_bottom_border_width, $product_left_border_width ) .'}';
			}

			// Tablet product border width
			if ( isset( $tablet_product_top_border_width ) && '' != $tablet_product_top_border_width
				|| isset( $tablet_product_right_border_width ) && '' != $tablet_product_right_border_width
				|| isset( $tablet_product_bottom_border_width ) && '' != $tablet_product_bottom_border_width
				|| isset( $tablet_product_left_border_width ) && '' != $tablet_product_left_border_width ) {
				$css .= '@media (max-width: 768px){.woocommerce .products .product-inner{border-width:'. sunio_spacing_css( $tablet_product_top_border_width, $tablet_product_right_border_width, $tablet_product_bottom_border_width, $tablet_product_left_border_width ) .'}}';
			}

			// Mobile product border width
			if ( isset( $mobile_product_top_border_width ) && '' != $mobile_product_top_border_width
				|| isset( $mobile_product_right_border_width ) && '' != $mobile_product_right_border_width
				|| isset( $mobile_product_bottom_border_width ) && '' != $mobile_product_bottom_border_width
				|| isset( $mobile_product_left_border_width ) && '' != $mobile_product_left_border_width ) {
				$css .= '@media (max-width: 480px){.woocommerce .products .product-inner{border-width:'. sunio_spacing_css( $mobile_product_top_border_width, $mobile_product_right_border_width, $mobile_product_bottom_border_width, $mobile_product_left_border_width ) .'}}';
			}

			// Product border radius
			if ( isset( $product_top_border_radius ) && '' != $product_top_border_radius
				|| isset( $product_right_border_radius ) && '' != $product_right_border_radius
				|| isset( $product_bottom_border_radius ) && '' != $product_bottom_border_radius
				|| isset( $product_left_border_radius ) && '' != $product_left_border_radius ) {
				$css .= '.woocommerce .products .product-inner{border-radius:'. sunio_spacing_css( $product_top_border_radius, $product_right_border_radius, $product_bottom_border_radius, $product_left_border_radius ) .'}';
			}

			// Tablet product border radius
			if ( isset( $tablet_product_top_border_radius ) && '' != $tablet_product_top_border_radius
				|| isset( $tablet_product_right_border_radius ) && '' != $tablet_product_right_border_radius
				|| isset( $tablet_product_bottom_border_radius ) && '' != $tablet_product_bottom_border_radius
				|| isset( $tablet_product_left_border_radius ) && '' != $tablet_product_left_border_radius ) {
				$css .= '@media (max-width: 768px){.woocommerce .products .product-inner{border-radius:'. sunio_spacing_css( $tablet_product_top_border_radius, $tablet_product_right_border_radius, $tablet_product_bottom_border_radius, $tablet_product_left_border_radius ) .'}}';
			}

			// Mobile product border radius
			if ( isset( $mobile_product_top_border_radius ) && '' != $mobile_product_top_border_radius
				|| isset( $mobile_product_right_border_radius ) && '' != $mobile_product_right_border_radius
				|| isset( $mobile_product_bottom_border_radius ) && '' != $mobile_product_bottom_border_radius
				|| isset( $mobile_product_left_border_radius ) && '' != $mobile_product_left_border_radius ) {
				$css .= '@media (max-width: 480px){.woocommerce .products .product-inner{border-radius:'. sunio_spacing_css( $mobile_product_top_border_radius, $mobile_product_right_border_radius, $mobile_product_bottom_border_radius, $mobile_product_left_border_radius ) .'}}';
			}

			// Add background color
			if ( ! empty( $product_background_color ) ) {
				$css .= '.woocommerce .products .product-inner, .woocommerce ul.products li.product .woo-product-info, .woocommerce ul.products li.product .woo-product-gallery{background-color:'. $product_background_color .';}';
			}

			// Add border color
			if ( ! empty( $product_border_color ) ) {
				$css .= '.woocommerce .products .product-inner{border-color:'. $product_border_color .';}';
			}

			// Add category color
			if ( ! empty( $category_color ) && '#999999' != $category_color ) {
				$css .= '.woocommerce ul.products li.product li.category a{color:'. $category_color .';}';
			}

			// Add category color hover
			if ( ! empty( $category_color_hover ) && '#13aff0' != $category_color_hover ) {
				$css .= '.woocommerce ul.products li.product li.category a:hover{color:'. $category_color_hover .';}';
			}

			// Add product entry title color
			if ( ! empty( $product_title_color ) && '#333333' != $product_title_color ) {
				$css .= '.woocommerce ul.products li.product li.title a{color:'. $product_title_color .';}';
			}

			// Add product entry title color hover
			if ( ! empty( $product_title_color_hover ) && '#13aff0' != $product_title_color_hover ) {
				$css .= '.woocommerce ul.products li.product li.title a:hover{color:'. $product_title_color_hover .';}';
			}

			// Add product entry price color
			if ( ! empty( $product_entry_price_color ) && '#57bf6d' != $product_entry_price_color ) {
				$css .= '.woocommerce ul.products li.product .price, .woocommerce ul.products li.product .price .amount{color:'. $product_entry_price_color .';}';
			}

			// Add product entry del price color
			if ( ! empty( $product_entry_del_price_color ) && '#666666' != $product_entry_del_price_color ) {
				$css .= '.woocommerce ul.products li.product .price del .amount{color:'. $product_entry_del_price_color .';}';
			}

			// Add product hover thumbnails border color
			if ( ! empty( $product_entry_hover_thumbnails_border_color ) && '#13aff0' != $product_entry_hover_thumbnails_border_color ) {
				$css .= '.woocommerce ul.products li.product .woo-product-gallery .active a, .woocommerce ul.products li.product .woo-product-gallery a:hover{border-color:'. $product_entry_hover_thumbnails_border_color .';}';
			}

			// Add product hover quick view background
			if ( ! empty( $product_entry_hover_quickview_background ) && '#ffffff' != $product_entry_hover_quickview_background ) {
				$css .= '.woocommerce ul.products li.product .woo-entry-buttons li a.azt-quick-view{background-color:'. $product_entry_hover_quickview_background .';}';
			}

			// Add product hover quick view hover background
			if ( ! empty( $product_entry_hover_quickview_hover_background ) && '#ffffff' != $product_entry_hover_quickview_hover_background ) {
				$css .= '.woocommerce ul.products li.product .woo-entry-buttons li a.azt-quick-view:hover{background-color:'. $product_entry_hover_quickview_hover_background .';}';
			}

			// Add product hover quick view color
			if ( ! empty( $product_entry_hover_quickview_color ) && '#444444' != $product_entry_hover_quickview_color ) {
				$css .= '.woocommerce ul.products li.product .woo-entry-buttons li a.azt-quick-view{color:'. $product_entry_hover_quickview_color .';}';
			}

			// Add product hover quick view hover color
			if ( ! empty( $product_entry_hover_quickview_hover_color ) && '#13aff0' != $product_entry_hover_quickview_hover_color ) {
				$css .= '.woocommerce ul.products li.product .woo-entry-buttons li a.azt-quick-view:hover{color:'. $product_entry_hover_quickview_hover_color .';}';
			}

			// Add product hover wishlist background
			if ( ! empty( $product_entry_hover_wishlist_background ) && '#ffffff' != $product_entry_hover_wishlist_background ) {
				$css .= '.woocommerce ul.products li.product .woo-entry-buttons li a.tinvwl_add_to_wishlist_button{background-color:'. $product_entry_hover_wishlist_background .';}';
			}

			// Add product hover wishlist hover background
			if ( ! empty( $product_entry_hover_wishlist_hover_background ) && '#ffffff' != $product_entry_hover_wishlist_hover_background ) {
				$css .= '.woocommerce ul.products li.product .woo-entry-buttons li a.tinvwl_add_to_wishlist_button:hover{background-color:'. $product_entry_hover_wishlist_hover_background .';}';
			}

			// Add product hover wishlist color
			if ( ! empty( $product_entry_hover_wishlist_color ) && '#444444' != $product_entry_hover_wishlist_color ) {
				$css .= '.woocommerce ul.products li.product .woo-entry-buttons li a.tinvwl_add_to_wishlist_button{color:'. $product_entry_hover_wishlist_color .';}';
			}

			// Add product hover wishlist hover color
			if ( ! empty( $product_entry_hover_wishlist_hover_color ) && '#13aff0' != $product_entry_hover_wishlist_hover_color ) {
				$css .= '.woocommerce ul.products li.product .woo-entry-buttons li a.tinvwl_add_to_wishlist_button:hover{color:'. $product_entry_hover_wishlist_hover_color .';}';
			}

			// Add product entry add to cart background color
			if ( ! empty( $product_entry_addtocart_bg_color ) ) {
				$css .= '.woocommerce ul.products li.product .button,.woocommerce ul.products li.product .product-inner .added_to_cart{background-color:'. $product_entry_addtocart_bg_color .';}';
			}

			// Add product entry add to cart background color hover
			if ( ! empty( $product_entry_addtocart_bg_color_hover ) ) {
				$css .= '.woocommerce ul.products li.product .button:hover,.woocommerce ul.products li.product .product-inner .added_to_cart:hover{background-color:'. $product_entry_addtocart_bg_color_hover .';}';
			}

			// Add product entry add to cart color
			if ( ! empty( $product_entry_addtocart_color ) && '#848494' != $product_entry_addtocart_color ) {
				$css .= '.woocommerce ul.products li.product .button,.woocommerce ul.products li.product .product-inner .added_to_cart{color:'. $product_entry_addtocart_color .';}';
			}

			// Add product entry add to cart color hover
			if ( ! empty( $product_entry_addtocart_color_hover ) && '#13aff0' != $product_entry_addtocart_color_hover ) {
				$css .= '.woocommerce ul.products li.product .button:hover,.woocommerce ul.products li.product .product-inner .added_to_cart:hover{color:'. $product_entry_addtocart_color_hover .';}';
			}

			// Add product entry add to cart border color
			if ( ! empty( $product_entry_addtocart_border_color ) && '#e4e4e4' != $product_entry_addtocart_border_color ) {
				$css .= '.woocommerce ul.products li.product .button,.woocommerce ul.products li.product .product-inner .added_to_cart{border-color:'. $product_entry_addtocart_border_color .';}';
			}

			// Add product entry add to cart border color hover
			if ( ! empty( $product_entry_addtocart_border_color_hover ) && '#13aff0' != $product_entry_addtocart_border_color_hover ) {
				$css .= '.woocommerce ul.products li.product .button:hover,.woocommerce ul.products li.product .product-inner .added_to_cart:hover{border-color:'. $product_entry_addtocart_border_color_hover .';}';
			}

			// Add product entry add to cart border style
			if ( ! empty( $product_entry_addtocart_border_style ) && 'double' != $product_entry_addtocart_border_style ) {
				$css .= '.woocommerce ul.products li.product .button,.woocommerce ul.products li.product .product-inner .added_to_cart{border-style:'. $product_entry_addtocart_border_style .';}';
			}

			// Add product entry add to cart border size
			if ( ! empty( $product_entry_addtocart_border_size ) && '3' != $product_entry_addtocart_border_size ) {
				$css .= '.woocommerce ul.products li.product .button,.woocommerce ul.products li.product .product-inner .added_to_cart{border-width:'. $product_entry_addtocart_border_size .';}';
			}

			// Add product entry add to cart border radius
			if ( ! empty( $product_entry_addtocart_border_radius ) ) {
				$css .= '.woocommerce ul.products li.product .button,.woocommerce ul.products li.product .product-inner .added_to_cart{border-radius:'. $product_entry_addtocart_border_radius .';}';
			}

			// Add quick view button background
			if ( ! empty( $quick_view_button_bg ) && 'rgba(0,0,0,0.6)' != $quick_view_button_bg ) {
				$css .= '.azt-quick-view{background-color:'. $quick_view_button_bg .';}';
			}

			// Add quick view button hover background
			if ( ! empty( $quick_view_button_hover_bg ) && 'rgba(0,0,0,0.9)' != $quick_view_button_hover_bg ) {
				$css .= '.azt-quick-view:hover{background-color:'. $quick_view_button_hover_bg .';}';
			}

			// Add quick view button color
			if ( ! empty( $quick_view_button_color ) && '#ffffff' != $quick_view_button_color ) {
				$css .= '.azt-quick-view{color:'. $quick_view_button_color .';}';
			}

			// Add quick view button hover color
			if ( ! empty( $quick_view_button_hover_color ) && '#ffffff' != $quick_view_button_hover_color ) {
				$css .= '.azt-quick-view:hover{color:'. $quick_view_button_hover_color .';}';
			}

			// Add quick view overlay background
			if ( ! empty( $quick_view_overlay_bg ) && 'rgba(0,0,0,0.15)' != $quick_view_overlay_bg ) {
				$css .= '.image-wrap.loading:after{background-color:'. $quick_view_overlay_bg .';}';
			}

			// Add quick view overlay spinner outside color
			if ( ! empty( $quick_view_overlay_spinner_outside_color ) && 'rgba(0,0,0,0.1)' != $quick_view_overlay_spinner_outside_color ) {
				$css .= '.image-wrap.loading:before{border-color:'. $quick_view_overlay_spinner_outside_color .';}';
			}

			// Add quick view overlay spinner inner color
			if ( ! empty( $quick_view_overlay_spinner_inner_color ) && '#ffffff' != $quick_view_overlay_spinner_inner_color ) {
				$css .= '.image-wrap.loading:before{border-left-color:'. $quick_view_overlay_spinner_inner_color .';}';
			}

			// Add quick view modal background
			if ( ! empty( $quick_view_modal_bg ) && '#ffffff' != $quick_view_modal_bg ) {
				$css .= '.azt-qv-content-inner{background-color:'. $quick_view_modal_bg .';}';
			}

			// Add quick view modal close button color
			if ( ! empty( $quick_view_modal_close_color ) && '#333333' != $quick_view_modal_close_color ) {
				$css .= '.azt-qv-content-inner .azt-qv-close{color:'. $quick_view_modal_close_color .';}';
			}

			// Add off canvas background
			if ( ! empty( $off_canvas_sidebar_bg ) && '#ffffff' != $off_canvas_sidebar_bg ) {
				$css .= '#sunio-off-canvas-sidebar-wrap .sunio-off-canvas-sidebar{background-color:'. $off_canvas_sidebar_bg .';}';
			}

			// Add off canvas border color
			if ( ! empty( $off_canvas_sidebar_widgets_border ) && 'rgba(84,84,84,0.15)' != $off_canvas_sidebar_widgets_border ) {
				$css .= '#sunio-off-canvas-sidebar-wrap .sidebar-box{border-color:'. $off_canvas_sidebar_widgets_border .';}';
			}

			// Add single product title color
			if ( ! empty( $single_product_title_color ) && '#333333' != $single_product_title_color ) {
				$css .= '.woocommerce div.product .product_title{color:'. $single_product_title_color .';}';
			}

			// Add single product price color
			if ( ! empty( $single_product_price_color ) && '#57bf6d' != $single_product_price_color ) {
				$css .= '.price,.amount{color:'. $single_product_price_color .';}';
			}

			// Add single product del price color
			if ( ! empty( $single_product_del_price_color ) && '#555555' != $single_product_del_price_color ) {
				$css .= '.price del,del .amount{color:'. $single_product_del_price_color .';}';
			}

			// Add single product description color
			if ( ! empty( $single_product_description_color ) && '#aaaaaa' != $single_product_description_color ) {
				$css .= '.woocommerce div.product div[itemprop="description"]{color:'. $single_product_description_color .';}';
			}

			// Add single product meta title color
			if ( ! empty( $single_product_meta_title_color ) && '#333333' != $single_product_meta_title_color ) {
				$css .= '.product_meta .posted_in,.product_meta .tagged_as{color:'. $single_product_meta_title_color .';}';
			}

			// Add single product meta link color
			if ( ! empty( $single_product_meta_link_color ) && '#aaaaaa' != $single_product_meta_link_color ) {
				$css .= '.product_meta .posted_in a,.product_meta .tagged_as a{color:'. $single_product_meta_link_color .';}';
			}

			// Add single product meta link color hover
			if ( ! empty( $single_product_meta_link_color_hover ) && '#13aff0' != $single_product_meta_link_color_hover ) {
				$css .= '.product_meta .posted_in a:hover,.product_meta .tagged_as a:hover{color:'. $single_product_meta_link_color_hover .';}';
			}

			// Add single product navigation border radius
			if ( isset( $single_product_navigation_border_radius ) && '30' != $single_product_navigation_border_radius && '' != $single_product_navigation_border_radius ) {
				$css .= '.azt-product-nav li a.azt-nav-link{-webkit-border-radius: '. $single_product_navigation_border_radius .'px; -moz-border-radius: '. $single_product_navigation_border_radius .'px; -ms-border-radius: '. $single_product_navigation_border_radius .'px; border-radius: '. $single_product_navigation_border_radius .'px;}';
			}

			// Add single product navigation background color
			if ( ! empty( $single_product_navigation_bg ) ) {
				$css .= '.azt-product-nav li a.azt-nav-link{background-color:'. $single_product_navigation_bg .';}';
			}

			// Add single product navigation background color
			if ( ! empty( $single_product_navigation_hover_bg ) && '#13aff0' != $single_product_navigation_hover_bg ) {
				$css .= '.azt-product-nav li a.azt-nav-link:hover{background-color:'. $single_product_navigation_hover_bg .';}';
			}

			// Add single product navigation color
			if ( ! empty( $single_product_navigation_color ) && '#333333' != $single_product_navigation_color ) {
				$css .= '.azt-product-nav li a.azt-nav-link{color:'. $single_product_navigation_color .';}';
			}

			// Add single product navigation color
			if ( ! empty( $single_product_navigation_hover_color ) && '#ffffff' != $single_product_navigation_hover_color ) {
				$css .= '.azt-product-nav li a.azt-nav-link:hover{color:'. $single_product_navigation_hover_color .';}';
			}

			// Add single product navigation border color
			if ( ! empty( $single_product_navigation_border_color ) && '#e9e9e9' != $single_product_navigation_border_color ) {
				$css .= '.azt-product-nav li a.azt-nav-link{border-color:'. $single_product_navigation_border_color .';}';
			}

			// Add single product navigation border color
			if ( ! empty( $single_product_navigation_hover_border_color ) && '#13aff0' != $single_product_navigation_hover_border_color ) {
				$css .= '.azt-product-nav li a.azt-nav-link:hover{border-color:'. $single_product_navigation_hover_border_color .';}';
			}

			// Add product entry add to cart background color
			if ( ! empty( $single_product_addtocart_bg_color ) ) {
				$css .= '.woocommerce div.product div.summary button.single_add_to_cart_button{background-color:'. $single_product_addtocart_bg_color .';}';
			}

			// Add product entry add to cart background color hover
			if ( ! empty( $single_product_addtocart_bg_color_hover ) ) {
				$css .= '.woocommerce div.product div.summary button.single_add_to_cart_button:hover{background-color:'. $single_product_addtocart_bg_color_hover .';}';
			}

			// Add product entry add to cart color
			if ( ! empty( $single_product_addtocart_color ) ) {
				$css .= '.woocommerce div.product div.summary button.single_add_to_cart_button{color:'. $single_product_addtocart_color .';}';
			}

			// Add product entry add to cart color hover
			if ( ! empty( $single_product_addtocart_color_hover ) ) {
				$css .= '.woocommerce div.product div.summary button.single_add_to_cart_button:hover{color:'. $single_product_addtocart_color_hover .';}';
			}

			// Add product entry add to cart border color
			if ( ! empty( $single_product_addtocart_border_color ) ) {
				$css .= '.woocommerce div.product div.summary button.single_add_to_cart_button{border-color:'. $single_product_addtocart_border_color .';}';
			}

			// Add product entry add to cart border color hover
			if ( ! empty( $single_product_addtocart_border_color_hover ) ) {
				$css .= '.woocommerce div.product div.summary button.single_add_to_cart_button:hover{border-color:'. $single_product_addtocart_border_color_hover .';}';
			}

			// Add product entry add to cart border style
			if ( ! empty( $single_product_addtocart_border_style ) ) {
				$css .= '.woocommerce div.product div.summary button.single_add_to_cart_button{border-style:'. $single_product_addtocart_border_style .';}';
			}

			// Add product entry add to cart border size
			if ( ! empty( $single_product_addtocart_border_size ) ) {
				$css .= '.woocommerce div.product div.summary button.single_add_to_cart_button{border-width:'. $single_product_addtocart_border_size .';}';
			}

			// Add product entry add to cart border radius
			if ( ! empty( $single_product_addtocart_border_radius ) ) {
				$css .= '.woocommerce div.product div.summary button.single_add_to_cart_button{border-radius:'. $single_product_addtocart_border_radius .';}';
			}

			// Add single product tabs borders color
			if ( ! empty( $single_product_tabs_borders_color ) && '#e9e9e9' != $single_product_tabs_borders_color ) {
				$css .= '.woocommerce div.product .woocommerce-tabs ul.tabs{border-color:'. $single_product_tabs_borders_color .';}';
			}

			// Add single product tabs text color
			if ( ! empty( $single_product_tabs_text_color ) && '#999999' != $single_product_tabs_text_color ) {
				$css .= '.woocommerce div.product .woocommerce-tabs ul.tabs li a{color:'. $single_product_tabs_text_color .';}';
			}

			// Add single product tabs text color hover
			if ( ! empty( $single_product_tabs_text_color_hover ) && '#13aff0' != $single_product_tabs_text_color_hover ) {
				$css .= '.woocommerce div.product .woocommerce-tabs ul.tabs li a:hover{color:'. $single_product_tabs_text_color_hover .';}';
			}

			// Add single product tabs active text color
			if ( ! empty( $single_product_tabs_active_text_color ) && '#13aff0' != $single_product_tabs_active_text_color ) {
				$css .= '.woocommerce div.product .woocommerce-tabs ul.tabs li.active a{color:'. $single_product_tabs_active_text_color .';}';
			}

			// Add single product tabs active text borders color
			if ( ! empty( $single_product_tabs_active_text_borders_color ) && '#13aff0' != $single_product_tabs_active_text_borders_color ) {
				$css .= '.woocommerce div.product .woocommerce-tabs ul.tabs li.active a{border-color:'. $single_product_tabs_active_text_borders_color .';}';
			}

			// Add single product tabs product description title color
			if ( ! empty( $single_product_tabs_product_desc_title_color ) && '#333333' != $single_product_tabs_product_desc_title_color ) {
				$css .= '.woocommerce div.product .woocommerce-tabs .panel h2{color:'. $single_product_tabs_product_desc_title_color .';}';
			}

			// Add single product tabs product description color
			if ( ! empty( $single_product_tabs_product_desc_color ) && '#929292' != $single_product_tabs_product_desc_color ) {
				$css .= '.woocommerce div.product .woocommerce-tabs .panel p{color:'. $single_product_tabs_product_desc_color .';}';
			}

			// Add account Login/Register color
			if ( ! empty( $account_login_register_color ) && '#333333' != $account_login_register_color ) {
				$css .= '.woocommerce .azt-account-links li .azt-account-link, .woocommerce .azt-account-links li.orDisplay Related Items{color:'. $account_login_register_color .';}';
			}

			// Add account navigation borders color
			if ( ! empty( $account_nav_borders_color ) && '#e9e9e9' != $account_nav_borders_color ) {
				$css .= '.woocommerce-MyAccount-navigation ul,.woocommerce-MyAccount-navigation ul li{border-color:'. $account_nav_borders_color .';}';
			}

			// Add account navigation icons color
			if ( ! empty( $account_nav_icons_color ) && '#13aff0' != $account_nav_icons_color ) {
				$css .= '.woocommerce-MyAccount-navigation ul li a:before{color:'. $account_nav_icons_color .';}';
			}

			// Add account navigation links color
			if ( ! empty( $account_nav_links_color ) && '#333333' != $account_nav_links_color ) {
				$css .= '.woocommerce-MyAccount-navigation ul li a{color:'. $account_nav_links_color .';}';
			}

			// Add account navigation links color hover
			if ( ! empty( $account_nav_links_color_hover ) && '#13aff0' != $account_nav_links_color_hover ) {
				$css .= '.woocommerce-MyAccount-navigation ul li a:hover{color:'. $account_nav_links_color_hover .';}';
			}

			// Add account addresses background color
			if ( ! empty( $account_addresses_bg ) && '#f6f6f6' != $account_addresses_bg ) {
				$css .= '.woocommerce-MyAccount-content .addresses .woocommerce-Address .title, .woocommerce-MyAccount-content .addresses .woocommerce-Address address{background-color:'. $account_addresses_bg .';}';
			}

			// Add account addresses title color
			if ( ! empty( $account_addresses_title_color ) && '#333333' != $account_addresses_title_color ) {
				$css .= '.woocommerce-MyAccount-content .addresses .woocommerce-Address .title h3{color:'. $account_addresses_title_color .';}';
			}

			// Add account addresses title border color
			if ( ! empty( $account_addresses_title_border_color ) && '#ffffff' != $account_addresses_title_border_color ) {
				$css .= '.woocommerce-MyAccount-content .addresses .woocommerce-Address .title{border-color:'. $account_addresses_title_border_color .';}';
			}

			// Add account addresses content color
			if ( ! empty( $account_addresses_content_color ) && '#898989' != $account_addresses_content_color ) {
				$css .= '.woocommerce-MyAccount-content .addresses .woocommerce-Address address{color:'. $account_addresses_content_color .';}';
			}

			// Add account addresses button background color
			if ( ! empty( $account_addresses_button_bg ) && '#ffffff' != $account_addresses_button_bg ) {
				$css .= '.woocommerce-MyAccount-content .addresses .woocommerce-Address .title a{background-color:'. $account_addresses_button_bg .';}';
			}

			// Add account addresses button background color hover
			if ( ! empty( $account_addresses_button_bg_hover ) && '#f8f8f8' != $account_addresses_button_bg_hover ) {
				$css .= '.woocommerce-MyAccount-content .addresses .woocommerce-Address .title a:hover{background-color:'. $account_addresses_button_bg_hover .';}';
			}

			// Add account addresses button color
			if ( ! empty( $account_addresses_button_color ) && '#898989' != $account_addresses_button_color ) {
				$css .= '.woocommerce-MyAccount-content .addresses .woocommerce-Address .title a{color:'. $account_addresses_button_color .';}';
			}

			// Add account addresses button color hover
			if ( ! empty( $account_addresses_button_color_hover ) && '#555555' != $account_addresses_button_color_hover ) {
				$css .= '.woocommerce-MyAccount-content .addresses .woocommerce-Address .title a:hover{color:'. $account_addresses_button_color_hover .';}';
			}

			// Add cart borders color
			if ( ! empty( $cart_borders_color ) && '#e9e9e9' != $cart_borders_color ) {
				$css .= '.woocommerce-cart table.shop_table,.woocommerce-cart table.shop_table th,.woocommerce-cart table.shop_table td,.woocommerce-cart .cart-collaterals .cross-sells,.woocommerce-page .cart-collaterals .cross-sells,.woocommerce-cart .cart-collaterals h2,.woocommerce-cart .cart-collaterals .cart_totals,.woocommerce-page .cart-collaterals .cart_totals,.woocommerce-cart .cart-collaterals .cart_totals table th,.woocommerce-cart .cart-collaterals .cart_totals .order-total th,.woocommerce-cart table.shop_table td,.woocommerce-cart .cart-collaterals .cart_totals tr td,.woocommerce-cart .cart-collaterals .cart_totals .order-total td{border-color:'. $cart_borders_color .';}';
			}

			// Add cart head background
			if ( ! empty( $cart_head_bg ) && '#f7f7f7' != $cart_head_bg ) {
				$css .= '.woocommerce-cart table.shop_table thead,.woocommerce-cart .cart-collaterals h2{background-color:'. $cart_head_bg .';}';
			}

			// Add cart head titles color
			if ( ! empty( $cart_head_titles_color ) && '#444444' != $cart_head_titles_color ) {
				$css .= '.woocommerce-cart table.shop_table thead th,.woocommerce-cart .cart-collaterals h2{color:'. $cart_head_titles_color .';}';
			}

			// Add cart totals table titles color
			if ( ! empty( $cart_totals_table_titles_color ) && '#444444' != $cart_totals_table_titles_color ) {
				$css .= '.woocommerce-cart .cart-collaterals .cart_totals table th{color:'. $cart_totals_table_titles_color .';}';
			}

			// Add cart remove button color
			if ( ! empty( $cart_remove_button_color ) && '#bbbbbb' != $cart_remove_button_color ) {
				$css .= '.woocommerce table.shop_table a.remove{color:'. $cart_remove_button_color .';}';
			}

			// Add cart remove button color hover
			if ( ! empty( $cart_remove_button_color_hover ) && '#333333' != $cart_remove_button_color_hover ) {
				$css .= '.woocommerce table.shop_table a.remove:hover{color:'. $cart_remove_button_color_hover .';}';
			}

			// Add checkout notices borders color
			if ( ! empty( $checkout_notices_borders_color ) && '#e9e9e9' != $checkout_notices_borders_color ) {
				$css .= '.woocommerce-checkout .woocommerce-info{border-color:'. $checkout_notices_borders_color .';}';
			}

			// Add checkout notices icon color
			if ( ! empty( $checkout_notices_icon_color ) && '#dddddd' != $checkout_notices_icon_color ) {
				$css .= '.woocommerce-checkout .woocommerce-info:before{color:'. $checkout_notices_icon_color .';}';
			}

			// Add checkout notices color
			if ( ! empty( $checkout_notices_color ) && '#777777' != $checkout_notices_color ) {
				$css .= '.woocommerce-checkout .woocommerce-info{color:'. $checkout_notices_color .';}';
			}

			// Add checkout notices link color
			if ( ! empty( $checkout_notices_link_color ) && '#13aff0' != $checkout_notices_link_color ) {
				$css .= '.woocommerce-checkout .woocommerce-info a{color:'. $checkout_notices_link_color .';}';
			}

			// Add checkout notices link color hover
			if ( ! empty( $checkout_notices_link_color_hover ) && '#333333' != $checkout_notices_link_color_hover ) {
				$css .= '.woocommerce-checkout .woocommerce-info a:hover{color:'. $checkout_notices_link_color_hover .';}';
			}

			// Add checkout notices form border color
			if ( ! empty( $checkout_notices_form_border_color ) && '#e9e9e9' != $checkout_notices_form_border_color ) {
				$css .= '.woocommerce-checkout form.login,.woocommerce-checkout form.checkout_coupon{border-color:'. $checkout_notices_form_border_color .';}';
			}

			// Add checkout titles color
			if ( ! empty( $checkout_titles_color ) && '#333333' != $checkout_titles_color ) {
				$css .= '.woocommerce .woocommerce-checkout #customer_details h3,.woocommerce .woocommerce-checkout h3#order_review_heading{color:'. $checkout_titles_color .';}';
			}

			// Add checkout notices titles border bottom color
			if ( ! empty( $checkout_titles_border_bottom_color ) && '#e9e9e9' != $checkout_titles_border_bottom_color ) {
				$css .= '.woocommerce .woocommerce-checkout #customer_details h3,.woocommerce .woocommerce-checkout h3#order_review_heading{border-color:'. $checkout_titles_border_bottom_color .';}';
			}

			// Add checkout table main background
			if ( ! empty( $checkout_table_main_bg ) && '#f7f7f7' != $checkout_table_main_bg ) {
				$css .= '.woocommerce table.shop_table thead,.woocommerce-checkout-review-order-table tfoot th{background-color:'. $checkout_table_main_bg .';}';
			}

			// Add checkout table titles color
			if ( ! empty( $checkout_table_titles_color ) && '#444444' != $checkout_table_titles_color ) {
				$css .= '.woocommerce-checkout table.shop_table thead th,.woocommerce-checkout table.shop_table tfoot th{color:'. $checkout_table_titles_color .';}';
			}

			// Add checkout table borders color
			if ( ! empty( $checkout_table_borders_color ) && '#e9e9e9' != $checkout_table_borders_color ) {
				$css .= '.woocommerce-checkout table.shop_table,.woocommerce-checkout table.shop_table th,.woocommerce-checkout table.shop_table td,.woocommerce-checkout table.shop_table tfoot th,.woocommerce-checkout table.shop_table tfoot td{border-color:'. $checkout_table_borders_color .';}';
			}

			// Add checkout payment methods background
			if ( ! empty( $checkout_payment_methods_bg ) && '#f8f8f8' != $checkout_payment_methods_bg ) {
				$css .= '.woocommerce-checkout #payment{background-color:'. $checkout_payment_methods_bg .';}';
			}

			// Add checkout payment methods borders color
			if ( ! empty( $checkout_payment_methods_borders_color ) && '#e9e9e9' != $checkout_payment_methods_borders_color ) {
				$css .= '.woocommerce-checkout #payment,.woocommerce-checkout #payment ul.payment_methods{border-color:'. $checkout_payment_methods_borders_color .';}';
			}

			// Add checkout payment box background
			if ( ! empty( $checkout_payment_box_bg ) && '#ffffff' != $checkout_payment_box_bg ) {
				$css .= '.woocommerce-checkout #payment div.payment_box{background-color:'. $checkout_payment_box_bg .';}';
			}

			// Add checkout payment box color
			if ( ! empty( $checkout_payment_box_color ) && '#515151' != $checkout_payment_box_color ) {
				$css .= '.woocommerce-checkout #payment div.payment_box{color:'. $checkout_payment_box_color .';}';
			}

			// If shop page Both Sidebars layout
			if ( 'both-sidebars' == $archives_layout ) {

				// Both Sidebars layout shop page content width
				if ( ! empty( $bs_archives_content_width ) ) {
					$css .=
						'@media only screen and (min-width: 960px){
							body.woocommerce.archive.content-both-sidebars .content-area {width: '. $bs_archives_content_width .'%;}
							body.woocommerce.archive.content-both-sidebars.scs-style .widget-area.sidebar-secondary,
							body.woocommerce.archive.content-both-sidebars.ssc-style .widget-area {left: -'. $bs_archives_content_width .'%;}
						}';
				}

				// Both Sidebars layout shop page sidebars width
				if ( ! empty( $bs_archives_sidebars_width ) ) {
					$css .=
						'@media only screen and (min-width: 960px){
							body.woocommerce.archive.content-both-sidebars .widget-area{width:'. $bs_archives_sidebars_width .'%;}
							body.woocommerce.archive.content-both-sidebars.scs-style .content-area{left:'. $bs_archives_sidebars_width .'%;}
							body.woocommerce.archive.content-both-sidebars.ssc-style .content-area{left:'. $bs_archives_sidebars_width * 2 .'%;}
						}';
				}

			}

			// If single product Both Sidebars layout
			if ( 'both-sidebars' == $single_layout ) {

				// Both Sidebars layout single product content width
				if ( ! empty( $bs_single_content_width ) ) {
					$css .=
						'@media only screen and (min-width: 960px){
							body.single-product.content-both-sidebars .content-area {width: '. $bs_single_content_width .'%;}
							body.single-product.content-both-sidebars.scs-style .widget-area.sidebar-secondary,
							body.single-product.content-both-sidebars.ssc-style .widget-area {left: -'. $bs_single_content_width .'%;}
						}';
				}

				// Both Sidebars layout single product sidebars width
				if ( ! empty( $bs_single_sidebars_width ) ) {
					$css .=
						'@media only screen and (min-width: 960px){
							body.single-product.content-both-sidebars .widget-area{width:'. $bs_single_sidebars_width .'%;}
							body.single-product.content-both-sidebars.scs-style .content-area{left:'. $bs_single_sidebars_width .'%;}
							body.single-product.content-both-sidebars.ssc-style .content-area{left:'. $bs_single_sidebars_width * 2 .'%;}
						}';
				}

			}

			// Return CSS
			if ( ! empty( $css ) ) {
				$output .= '/* WooCommerce CSS */'. $css;
			}

			// Return output css
			return $output;

		}

	}

endif;

return new sunio_WooCommerce_Customizer();