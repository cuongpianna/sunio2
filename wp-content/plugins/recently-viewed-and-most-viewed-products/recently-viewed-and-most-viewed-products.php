<?php
/**
 * Plugin Name: Recently viewed and most viewed products
 * Plugin URI: http://cedcommerce.com/
 * Description: Show recently viewed and most viewed product on single product page. Add shortcode to display recently viewed and most viewed product on your site.
 * Text Domain: recently-viewed-and-most-viewed-products
 * Domain Path: /languages
 * Version: 1.0.11
 * Author: CedCommerce
 * Author URI: http://cedcommerce.com/
 */

/**
 * Exit if accessed directly
 */
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}
define('CED_RVMV_PREFIX', 'ced_rvmv');
define('ced_RVMV_DIR_PATH', plugin_dir_path(__FILE__));
define('ced_WRMVP_DIR_PATH', plugin_dir_path(__FILE__));
define('ced_WRMVP_DIR_URL', plugin_dir_url(__FILE__));
define('ced_WRMVP_VER', '1.0.11');
/**
 * Check if woocommerce is active
 **/
$activated = true;

if (function_exists('is_multisite') && is_multisite())
{
	include_once( ABSPATH . 'wp-admin/includes/plugin.php' );
	if ( !is_plugin_active( 'woocommerce/woocommerce.php' ) )
	{
		$activated = false;
	}
}
else
{
	if (!in_array('woocommerce/woocommerce.php', apply_filters('active_plugins', get_option('active_plugins'))))
	{
		$activated = false;
	}
}

if($activated)
{
	/**
	 * Check if class exist
	 **/
	if( ! class_exists( 'ced_recent_most_viewed' ) )
	{
		class ced_recent_most_viewed
		{
			/**
			 * Hook into the appropriate actions when the class is constructed.
			 */
			public function __construct()
			{
				$plugin = plugin_basename(__FILE__);
				add_filter( 'plugin_row_meta', array( __CLASS__, 'ced_wrvamvp_plugin_row_meta' ), 10, 2 );
				add_action('plugins_loaded',array($this,CED_RVMV_PREFIX.'_load_text_domain'));
				add_action( 'plugins_loaded', array($this,CED_RVMV_PREFIX.'_wramvp_install'), 11 );
				add_filter( 'plugin_action_links_' . plugin_basename(__FILE__), array($this,CED_RVMV_PREFIX.'_add_wramvp_setting_links' ));
				add_action('wramvp_init', array($this,CED_RVMV_PREFIX.'_recently_and_most_view_product_init'));
				add_action( 'wp_ajax_recent_product_info', array($this,'update_recent_product_info' ));
				add_action( 'wp_ajax_most_viewed_product_info', array($this,CED_RVMV_PREFIX.'_update_most_viewed_product_info' ));
				add_action( 'wp_ajax_nopriv_recent_product_info', array($this,'update_recent_product_info' ));
				add_action( 'wp_ajax_nopriv_most_viewed_product_info', array($this,CED_RVMV_PREFIX.'_update_most_viewed_product_info' ));
				add_action('admin_enqueue_scripts',array ( $this,'add_ced_bar_script'));
				add_action('init',array ( $this,'add_ced_bar_script_init'));
			}
			/**
			 * Adding plugin's row data
			 * @name ced_wrvamvp_plugin_row_meta
			 * @author CedCommerce
			 */
			public static function ced_wrvamvp_plugin_row_meta( $links, $file ) {static $plugin;
				if (! isset ( $plugin ) ) {
					$plugin = plugin_basename ( __FILE__ );
				}
				if ( $file == $plugin ) {
					$row_meta = array(
							'docs'    => '<a href="' . esc_url( apply_filters( 'ced_wrvamvp_docs_url', 'http://demo.cedcommerce.com/woocommerce/recent-most-viewed/doc/index.html' ) ) . '" title="' . esc_attr( __( 'View Recently viewed and most viewed products Documentation', 'recently-viewed-and-most-viewed-products' ) ) . '">' . __( 'Docs', 'order-product-identifier' ) . '</a>',
							'Back-endDemo' => '<a href="' . esc_url( apply_filters( 'ced_wrvamvp_blog_url', 'http://demo.cedcommerce.com/woocommerce/recent-most-viewed/wp-admin/' ) ) . '" title="' . esc_attr( __( 'View Recently viewed and most viewed products backend url', 'recently-viewed-and-most-viewed-products' ) ) . '">' . __( 'Back end url', 'recently-viewed-and-most-viewed-products' ) . '</a>',
							'front-endDemo' => '<a href="' . esc_url( apply_filters( 'ced_wrvamvp_blog_url', 'http://demo.cedcommerce.com/woocommerce/recent-most-viewed/' ) ) . '" title="' . esc_attr( __( 'Recently viewed and most viewed products front enf url', 'recently-viewed-and-most-viewed-products' ) ) . '">' . __( 'Front end url', 'recently-viewed-and-most-viewed-products' ) . '</a>',
			
					);
						
					return array_merge( $links, $row_meta );
				}
					
				return (array) $links;
			}
			/**
			 * Init scripts
			 * @name add_ced_bar_script_init
			 */
			function add_ced_bar_script_init()
			{
				$plugin_dir = plugin_dir_url(__FILE__);
				wp_enqueue_script('init_enqueue_script', $plugin_dir.'assets/js/ced_init.js',array('jquery'),ced_WRMVP_VER, true);
				wp_localize_script('init_enqueue_script','ajax_url',admin_url('admin-ajax.php'));
				wp_enqueue_style('init_enqueue_style', $plugin_dir.'assets/css/ced_init.css', array(), ced_WRMVP_VER);
				wp_enqueue_style( 'rvmv-select2-css', plugins_url( 'woocommerce/assets/css/select2.css' ) );
				wp_enqueue_script( 'rvmv-select2-js', plugins_url( 'woocommerce/assets/js/select2/select2.min.js' ), array( 'jquery' ), ced_WRMVP_VER, true );
			    wp_enqueue_style( 'rvmv-select2-css' );
			    wp_enqueue_script( 'rvmv-select2-js' );
			    wp_enqueue_script('ced_select2_script', $plugin_dir.'assets/js/ced_select2.js',array('jquery'),ced_WRMVP_VER, true);
			}
			
			/**
			 * Admin Scripts
			 * @name add_ced_bar_script
			 */
			function add_ced_bar_script()
			{
					$plugin_dir = plugin_dir_url(__FILE__);
					wp_enqueue_style('jquery-js', $plugin_dir.'assets/css/ced_bar.css', array(), ced_WRMVP_VER);
					wp_enqueue_script('custom-dropbox-upload', $plugin_dir.'assets/js/ced_bar.js',array('jquery'), ced_WRMVP_VER, true);
					$js_array = array(
							'wc_return_ajaxurl' =>admin_url('admin-ajax.php'),
							'loading_url'		=>plugin_dir_url(__FILE__)
					);
					wp_localize_script( 'custom-dropbox-upload', 'object_custom_name', $js_array );
			}
			
			/**
			 * loading text domain
			 * @name ced_rvmv_load_text_domain
			 * @author CedCommerce
			 */
			function ced_rvmv_load_text_domain()
			{
				$domain = "recently-viewed-and-most-viewed-products";
				$locale = apply_filters( 'plugin_locale', get_locale(), $domain );
				load_textdomain( $domain, ced_WRMVP_DIR_PATH .'languages/'.$domain.'-' . $locale . '.mo' );
				load_plugin_textdomain( 'recently-viewed-and-most-viewed-products', false, plugin_basename( dirname(__FILE__) ) . '/languages' );
			}
			
			/**
			 * showing admin notices
			 * @name ced_rvmv_wramvp_install_ced_admin_notice
			 * @author CedCommerce
			 *
			 */
			function ced_rvmv_wramvp_install_ced_admin_notice() 
			{
				?>
					<div class="error">
						<p>
							<?php _e( 'woocommerce Most Viewed Products is enabled but not effective. It requires ced in order to work.', 'recently-viewed-and-most-viewed-products' ); ?>
						</p>
					</div>
				<?php
			}
			/**
			 * showing admin notices
			 * @name ced_rvmv_wramvp_install
			 * @author CedCommerce
			 *
			 */
			function ced_rvmv_wramvp_install() 
			{
				if ( ! function_exists( 'WC' ) ) 
				{
					add_action( 'admin_notices', CED_RVMV_PREFIX.'_wramvp_install_ced_admin_notice' );
				}
				else 
				{
					do_action( 'wramvp_init' );
				}
			}
				
			/**
			 * showing admin notices
			 * @name ced_rvmv_add_wramvp_setting_links
			 * @author CedCommerce
			 *
			 */
			function ced_rvmv_add_wramvp_setting_links ( $links ) 
			{
				$settingslinks = array(

						'<a href="' . admin_url( 'admin.php?page=recent-and-most-view-product' ) . '">Settings</a>',
				);
				return array_merge( $settingslinks, $links );
			}
			
			/**
			 * including necesaary files
			 * @name ced_rvmv_recently_and_most_view_product_init
			 * @author CedCommerce
			 *
			 */
			function ced_rvmv_recently_and_most_view_product_init()
			{
				require_once('includes/class.wramvp-admin.php');
				require_once('includes/class.wramvp-frontend.php');
			}
				
			/**
			 * updating recent products
			 * @name ced_rvmv_rvmv_ajx_check
			 * @author CedCommerce
			 * @since 1.0.7
			 */
			function update_recent_product_info()
			{
				
				$wrvp_list = array();
				$product_id = $_POST['product_id'];
				
				$user_id = get_current_user_id();
				update_post_meta($product_id,'recent_view_time', date("Y-m-d h:i:s"));
				$get_rv_admin = get_option( 'rv_set_admin' );

				if( isset($get_rv_admin) && !empty($get_rv_admin))
				{
					sleep(1);
					foreach ($get_rv_admin as $key => $value) 
					{
						update_post_meta($value,'recent_view_time', date("Y-m-d h:i:s"));
					}
				}
				return ;
			}
			/**
			 * updating most viewed products
			 * @name ced_rvmv_update_most_viewed_product_info
			 * @author CedCommerce
			 * @since 1.0.7
			 */
			function ced_rvmv_update_most_viewed_product_info()
			{
				
				$product_id = $_POST['product_id'];
				
				$user_id = get_current_user_id();
				
				$user_id = get_current_user_id();
				$tot_post_count = get_post_meta($product_id,'wmvp_total_post_count',true);
				if($tot_post_count)
				{
					$new_post_count = $tot_post_count + 1;
					update_post_meta($product_id, 'wmvp_total_post_count',$new_post_count);
				}
				else
				{
					update_post_meta($product_id, 'wmvp_total_post_count',1);
				}
				$current_pro_count = get_post_meta($product_id,'wmvp_total_post_count',true);
				$get_mv_admin = get_option( 'mv_set_admin' );
				
				if( isset($get_mv_admin) && !empty($get_mv_admin))
				{
					$args = array( 'post_type' => 'product',
								   'post_status' => 'publish',
								   'orderby'=>'meta_value_num', 
								   'order'=>'DESC',
								   'meta_key'=>'wmvp_total_post_count',
								   'posts_per_page'=>1 );

					$max_query = new WP_Query( $args );

					if ( $max_query->have_posts() )
					{
						$max_value = get_post_meta( $max_query->posts[0]->ID ,'wmvp_total_post_count', true );
						
						foreach ($get_mv_admin as $key => $value) 
						{
							$admin_id_value_exist_max = get_post_meta( $value ,'wmvp_total_post_count', true );
							if( isset($admin_id_value_exist_max) && !empty($admin_id_value_exist_max) )
							{
								if( $admin_id_value_exist_max != $max_value && in_array($max_query->posts[0]->ID, $get_mv_admin))
								{
									update_post_meta($value, 'wmvp_total_post_count', $max_value);
								}
								else if( $value != $max_query->posts[0]->ID && $admin_id_value_exist_max != $max_value)
								{
									update_post_meta($value, 'wmvp_total_post_count', $max_value+1);
								}
								else if( $current_pro_count == $max_value && $product_id != $value)
								{	
									update_post_meta($value, 'wmvp_total_post_count', $max_value+1);
								}
								else if( $admin_id_value_exist_max != $max_value )
								{
									update_post_meta($value, 'wmvp_total_post_count', $max_value+1);
								}
							}
							else
							{
								update_post_meta($value, 'wmvp_total_post_count', $max_value+1);
							}								
						}
					}				
				}				
				return;
			}
		}
		$GLOBALS['ced_recently'] = new ced_recent_most_viewed();
	}
}
else
{
	/**
	 * showing admin notices on error 
	 * @name ced_rvmv_plugin_error_notice
	 * @author CedCommerce
	 *
	 */
	function ced_rvmv_plugin_error_notice()
	{
		?>
		<div class="error notice is-dismissible">
		<p><?php _e( 'Woocommerce is not activated. Please install Woocommerce to use the Recently viewed and most viewed products plugin !', 'recently-viewed-and-most-viewed-products' ); ?></p>
		</div>
		
		<?php
	}
	
	add_action( 'admin_init', CED_RVMV_PREFIX.'_plugin_deactivate' );
	
	/**
	 * deactivating plugin on error
	 * @name ced_rvmv_plugin_deactivate
	 * @author CedCommerce
	 *
	 */
	function ced_rvmv_plugin_deactivate() 
	{
		deactivate_plugins( plugin_basename( __FILE__ ) );
		add_action( 'admin_notices', CED_RVMV_PREFIX.'_plugin_error_notice' );
	}
}
?>