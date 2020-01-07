<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

if ( ! class_exists( 'ced_wramvp_Frontend' ) ) 
{	
	/**
	 * class for showing content in front end
	 * @name wramvp_Frontend
	 * @author CedCommerce
	 *
	 */
	class ced_wramvp_Frontend
	{
		/**
		 * Single instance of the class
		 */
		protected static $instance;
		
			
		/**
		 * Most view product list
		 */
		protected $_wmvp_list = array();
		
		/**
		 * Recently view product list
		 */
		protected $_wrvp_list = array();
		
		/**
		 * Returns single instance of the class
		 */
		public static function get_instance()
		{
			if( is_null( self::$instance ) )
			{
				self::$instance = new self();
			}
		
			return self::$instance;
		}
		
		/**
		 * constructor
		 * @author CedCommerce
		 *
		 */
		public function __construct()
		{
			$this->_user_id = get_current_user_id();
			$this->_ced_rvmv_wmvp_enable = get_option( CED_RVMV_PREFIX.'_wmvp_enable' );
			$this->_ced_rvmv_wrvp_enable = get_option( CED_RVMV_PREFIX.'_wrvp_enable');
			
			$this->_instock = false;
			add_shortcode( 'wrvp_recently_viewed_products', array( $this, CED_RVMV_PREFIX.'_show_recent_viewed_products' ) );
			
			add_shortcode('wmvp_most_viewed_products', array( $this, CED_RVMV_PREFIX.'_show_most_viewed_products' ));
			if($this->_ced_rvmv_wmvp_enable == 'yes')
			{
				
				add_action( 'woocommerce_after_single_product', array( $this, CED_RVMV_PREFIX.'_wmvp_print_shortcode' ));
			}
			if($this->_ced_rvmv_wrvp_enable == 'yes')
			{
					
				add_action( 'woocommerce_after_single_product', array( $this, CED_RVMV_PREFIX.'_wrvp_print_shortcode' ));
			}
			add_action( 'woocommerce_after_single_product_summary', array( $this, CED_RVMV_PREFIX.'_wramvp_viewed_products' ));
		}
		/**
		 * function to change number of rows in a coloumn
		 * @name loop_columns
		 * @author CedCommerce
		 */
		function loop_columns($a)
		{
			global $number_of_products_in_row_in_most;
			$numberofproducts = $number_of_products_in_row_in_most;
			if($numberofproducts)
			{
				return $numberofproducts;
			}
			return $a;
		}
		/**
		 * function to change number of rows in a coloumn
		 * @name loop_columns_for_recent
		 * @author CedCommerce
		 */
		function loop_columns_for_recent($a)
		{
			global $number_of_products_in_row_in_recent;
			$numberofproducts = $number_of_products_in_row_in_recent;
			if($numberofproducts)
			{
				return $number_of_products_in_row_in_recent;
			}
			return $a;
		}
		/**
		 * most viewed products
		 * @name wramvp_viewed_products
		 * @author CedCommerce
		 *
		 */
		public function ced_rvmv_wramvp_viewed_products()
		{
			global $product;
			global $post;
			$p_id = $post->ID;
			
			if( is_null( $post ) || $post->post_type != 'product' || !is_product())
				return;
			// Localize the script with new data
			
			wp_enqueue_script( 'custom_js',ced_WRMVP_DIR_URL.'assets/js/ced_case.js', array(), ced_WRMVP_VER,true);
			$js_array = array(
					'_ced_rvmv_wrvp_enable' =>$this->_ced_rvmv_wrvp_enable,
					'_ced_rvmv_wmvp_enable' => $this->_ced_rvmv_wmvp_enable,
					'pro_id'	=>$p_id,//correction
					'wc_return_ajaxurl' =>admin_url('admin-ajax.php')
			);
			wp_localize_script( 'custom_js', 'object_name', $js_array );
			
		}
		
		/**
		 * define most viewed product
		 * @name ced_rvmv_show_most_viewed_products
		 * @author CedCommerce
		 * @since 1.0.7
		 */
		public function ced_rvmv_show_most_viewed_products($atts)
		{
			global $number_of_products_in_row_in_most;
			$atts = extract( shortcode_atts(array(
			'number_of_products_in_row' => "",
			'posts_per_page' => get_option( CED_RVMV_PREFIX.'_wmvp_total_items_display'),
			'title'		=> get_option( CED_RVMV_PREFIX.'_wmvp_viewed_title' )
			), $atts,'wmvp_most_viewed_products'  ) );
			$number_of_products_in_row_in_most = $number_of_products_in_row;
			add_filter('loop_shop_columns', array($this,'loop_columns'), 1, 10 );
			if(!isset($posts_per_page))
			{
				$posts_per_page = 1;
			}
			if($posts_per_page > 10)
				$posts_per_page = 10;
			$args = array(
					'post_type'            => 'product',
					'ignore_sticky_posts'  => 1,
					'no_found_rows'        => 1,
					'posts_per_page'       => $posts_per_page,
					'meta_key'			   => 'wmvp_total_post_count',
					'orderby' 			   => 'meta_value_num',
					'order' 			   => 'DESC'					
			);
			
			$wmvp_instock = get_option( CED_RVMV_PREFIX.'_wmvp_instock');
			if($wmvp_instock == 'yes'){

				$args['meta_query'] = array(
											'relation' => 'AND',
											array(
													'key'     => 'wmvp_total_post_count',
													'value'   => '0',
													'type'    => 'numeric',
													'compare' => '>',
											),
											array(
													'key'     => '_stock_status',
													'value'   => 'instock',
													'compare' => '=',
											),
									);

			}
			else
			{

				$args['meta_query'] = array(
											array(
													'key'     => 'wmvp_total_post_count',
													'value'   => '0',
													'type'    => 'numeric',
													'compare' => '>',
											),
									);
			}
			$products = new WP_Query( $args );
			
			ob_start();
			if ( $products->have_posts() ) : ?>
			<?php if(!is_product() || !is_cart() || !is_shop() || !is_checkout()){?>
				<div class="woocommerce">	
			<?php }?>			
					<div class="ced" data-rows="<?php echo  $number_of_products_in_row_in_most ?>">
						<h2><?php 
								$wmvp_viewed_title = get_option( CED_RVMV_PREFIX.'_wmvp_viewed_title', null);
								if($wmvp_viewed_title)
								{
									echo $wmvp_viewed_title;
								}else{
									echo __('Most viewed products','recently-viewed-and-most-viewed-products');
								} ?>
						</h2>
						<?php woocommerce_product_loop_start(); ?>

							<?php while ( $products->have_posts() ) : $products->the_post(); ?>
									
									<?php wc_get_template_part( 'content', 'product' ); ?>

							<?php endwhile; // end of the loop. ?>

						<?php woocommerce_product_loop_end(); ?>
					</div>
			<?php if(!is_product() || !is_cart() || !is_shop() || !is_checkout()){?>
				</div>
			<?php }?>		
			<?php 
			endif;
			$content = ob_get_clean();
			wp_reset_postdata();
			return $content;
		}
		
		
		/**
		 * defining shortcodes
		 * @name ced_rvmv_wmvp_print_shortcode
		 * @author CedCommerce
		 *
		 */
		public function ced_rvmv_wmvp_print_shortcode()
		{
			echo do_shortcode('[wmvp_most_viewed_products]');
		}
		
		/**
		 * showing recently viewed on single page
		 * @name ced_rmv_wrvp_print_shortcode
		 * @author CedCommerce
		 *
		 */
		public function ced_rvmv_wrvp_print_shortcode()
		{
			
			echo do_shortcode('[wrvp_recently_viewed_products]');
		}
		
		
		/**
		 * showing recently viewed on single page
		 * @name ced_rvmv_show_recent_viewed_products
		 * @author CedCommerce
		 * @since 1.0.7
		 */
		public function ced_rvmv_show_recent_viewed_products($atts)
		{
			global $number_of_products_in_row_in_recent;
			$atts = extract( shortcode_atts(array(
			'number_of_products_in_row' => "",
			'posts_per_page' => get_option( CED_RVMV_PREFIX.'_wrvp_total_items_display'),
			'title'		=> get_option( CED_RVMV_PREFIX.'_wrvp_viewed_title' )
			), $atts,'wrvp_recently_viewed_products' ) );
			$number_of_products_in_row_in_recent = $number_of_products_in_row;
			add_filter('loop_shop_columns', array($this,'loop_columns_for_recent'), 1, 10 );
			
			if(!isset($posts_per_page)){ $posts_per_page = 1;}
			
			if($posts_per_page > 10)
			$posts_per_page = 10;
			
			$args = array(
					'post_type'            => 'product',
					'ignore_sticky_posts'  => 1,
					'no_found_rows'        => 1,
					'posts_per_page'       => $posts_per_page,
					'orderby' => 'recent_view_time',
					'order'  => 'DESC'
					
					
			);

			$wrvp_instock = get_option( CED_RVMV_PREFIX.'_wrvp_instock');
			if($wrvp_instock == 'yes'){

				$args['meta_query'] = array(
											'relation' => 'AND',
											array(
													'key'     => 'recent_view_time',
													'value'   => '',
													'compare' => '!='												
											),
											array(
													'key'     => '_stock_status',
													'value'   => 'instock',
													'compare' => '=',
											),
									);
			}
			else
			{

				$args['meta_query'] = array(
											array(
													'key'     => 'recent_view_time',
													'value'   => '',
													'compare' => '!='
											),
									);
			}

			$products = new WP_Query( $args );
			ob_start();
			
			if ( $products->have_posts() ) : ?>

			<?php if(!is_product() || !is_cart() || !is_shop() || !is_checkout()){?>
				<div class="woocommerce">	
			<?php }?>	
					<div class="ced" data-rows="<?php echo  $number_of_products_in_row ?>">
						<h2><?php 
						  $wrvp_viewed_title = get_option( CED_RVMV_PREFIX.'_wrvp_viewed_title', null);
						  if($wrvp_viewed_title){ echo $wrvp_viewed_title;} else { echo __('Recently viewed products','recently-viewed-and-most-viewed-products');} ?></h2>
							
						<?php woocommerce_product_loop_start(); ?>

							<?php while ( $products->have_posts() ) : $products->the_post(); ?>
									
									<?php wc_get_template_part( 'content', 'product' ); ?>

							<?php endwhile; // end of the loop. ?>

						<?php woocommerce_product_loop_end(); ?>
					</div>
			<?php if(!is_product() || !is_cart() || !is_shop() || !is_checkout()){?>
				</div>
			<?php }?>
			<?php  
			endif;
			$content = ob_get_clean();
			wp_reset_postdata();
			return $content;
		}		
	}
	$wramvp_Frontend = new ced_wramvp_Frontend();
}
?>
