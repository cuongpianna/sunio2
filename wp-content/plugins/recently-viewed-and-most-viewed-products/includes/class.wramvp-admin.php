<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}
if ( ! class_exists( 'wramvp_Admin' ) ) 
{
	/**
	 * class for showing content in admin
	 * @name wramvp_Admin
	 * @author CedCommerce
	 *
	 */
	class wramvp_Admin{
		/**
		 * Single instance of the class
		 */
		protected static $instance;
		
		/**
		 * Returns single instance of the class
		 */
		public function get_instance()
		{
			if(is_null(self::$instance))
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
			add_action('admin_menu', array($this,CED_RVMV_PREFIX.'_add_wramvp_settings'));
			add_action( 'admin_init',array($this,CED_RVMV_PREFIX.'_register_wramvp_settings'));
			add_shortcode( 'wrvp_recently_viewed_products_on_admin', array( $this, CED_RVMV_PREFIX.'_show_recent_viewed_products_on_admin' ) );
			add_shortcode( 'wmvp_most_viewed_products_on_admin', array( $this, CED_RVMV_PREFIX.'_show_most_viewed_products_on_admin' ) );
			add_filter('manage_product_posts_columns', array( $this,CED_RVMV_PREFIX.'_create_rv_mv_col'), 10);
			add_filter('manage_product_posts_custom_column', array( $this,CED_RVMV_PREFIX.'_manage_rv_mv_product'), 10, 2);
			add_filter('manage_edit-product_columns', array( $this,CED_RVMV_PREFIX.'_manage_rv_product_col'), 15, 1);
			add_filter('manage_edit-product_columns', array( $this,CED_RVMV_PREFIX.'_manage_mv_product_col'), 15, 1);
			add_action( 'wp_ajax_set_rvmv_manually', array($this,CED_RVMV_PREFIX.'_set_rvmv_manually' ));
			add_action( 'wp_ajax_nopriv_set_rvmv_manually', array($this,'_set_rvmv_manually' ));
			add_action('wp_ajax_wramvp_send_mail',array($this,'wramvp_send_mail'));

		}
		
		/**
		 * admin settibg
		 * ced_rvmv_add_wramvp_settings
		 * @author CedCommerce
		 *
		 */
		public function wramvp_send_mail()
		{
			if(isset($_POST["flag"]) && $_POST["flag"]==true && !empty($_POST["emailid"]))
			{
				$to = "support@cedcommerce.com";
				$subject = "Wordpress Org Know More";
				$message = 'This user of our woocommerce extension "Recently viewed and most viewed products" wants to know more about marketplace extensions.<br>';
				$message .= 'Email of user : '.$_POST["emailid"];
				$headers = array('Content-Type: text/html; charset=UTF-8');
				$flag = wp_mail( $to, $subject, $message);	
				if($flag == 1)
				{
					echo json_encode(array('status'=>true,'msg'=>__('Soon you will receive the more details of this extension on the given mail.',"recently-viewed-and-most-viewed-products")));
				}
				else
				{
					echo json_encode(array('status'=>false,'msg'=>__('Sorry,an error occurred.Please try again.',"recently-viewed-and-most-viewed-products")));
				}
			}
			else
			{
				echo json_encode(array('status'=>false,'msg'=>__('Sorry,an error occurred.Please try again.',"recently-viewed-and-most-viewed-products")));
			}
			wp_die();
		}
		public function ced_rvmv_add_wramvp_settings()
		{
			add_submenu_page( 'woocommerce', 'recently and most viewed product', 'Recently and Most viewed products', 'manage_options', 'recent-and-most-view-product',array($this,'admin_wramvp_init'));
		}
		/**
		 * creating rv and mv columns
		 * @name ced_rvmv_create_rv_mv_col
		 * @author CedCommerce
		 *
		 */
		public function ced_rvmv_create_rv_mv_col($defaults) {
			
			if ( empty( $defaults ) && ! is_array( $defaults ) ) {
				$defaults = array();
			}
			$new_column_rv_mv=array();
			$new_column_rv_mv['RV'] = '<span>'.__('RV','recently-viewed-and-most-viewed-products').'</span>';
			$new_column_rv_mv['MV'] = '<span>'.__('MV','recently-viewed-and-most-viewed-products').'</span>';
			return array_merge( $new_column_rv_mv, $defaults );
		}
		/**
		 * assigning checkbox and populating rv and mv
		 * @name ced_rvmv_manage_rv_mv_product
		 * @author CedCommerce
		 *
		 */
		public function ced_rvmv_manage_rv_mv_product($column, $post_id)
		{
			switch( $column ) {
				case 'RV' :

				woocommerce_form_field( 'RV_products', array(
					'type'          => 'checkbox',
					'class'         => array('rv-checkbox'),
					'custom_attributes' => array('data-num'=>$post_id),
					), get_post_meta( $post_id, 'RV_products', true ));
				break;

				case 'MV' :

				woocommerce_form_field( 'MV_products', array(
					'type'          => 'checkbox',
					'class'         => array('mv-checkbox'),
					'custom_attributes' => array('data-num'=>$post_id),
					), get_post_meta( $post_id, 'MV_products', true ));
				break;

				default :
				break;
			}
			
		}

		/**
		 * Remove rv column from woo product table for selected roles.
		 * @name ced_rvmv_manage_rv_product_col
		 * @author CedCommerce
		 *
		 */
		public function ced_rvmv_manage_rv_product_col($column){
			
			$roles = get_option( CED_RVMV_PREFIX.'_ced_wrvp_roles' , null);
			$current_user = wp_get_current_user();
			if($roles){
				if(in_array($current_user->roles[0],$roles)){
					unset($column['RV']);
					return $column;
				}
			}
			return $column;
		}

	    /**
		 * Remove mv column from woo product table for selected roles.
		 * @name ced_rvmv_manage_mv_product_col
		 * @author CedCommerce
		 *
		 */
	    public function ced_rvmv_manage_mv_product_col($column){
	    	
	    	$roles = get_option( CED_RVMV_PREFIX.'_ced_wmvp_roles' , null);
	    	$current_user = wp_get_current_user();
	    	if(!empty($roles)){
	    		if(in_array($current_user->roles[0],$roles)){
	    			unset($column['MV']);
	    			return $column;
	    		}
	    	}
	    	return $column;
	    }



		/**
		 * saving rv and mv value through product list page
		 * @name ced_rvmv_set_rvmv_manually
		 * @author CedCommerce
		 * @since 1.0.7
		 */
		public function ced_rvmv_set_rvmv_manually(){

			$checkbox_name = $_POST['checkbox_name'];
			$rvmv_pro_id = $_POST['rvmv_pro_id'];
			$checkbox_value = $_POST['checkbox_value'];
			$rv_set_admin = get_option( 'rv_set_admin' );
			$mv_set_admin = get_option( 'mv_set_admin' );

			if($checkbox_name == 'RV_products'){

				if($checkbox_value == 'true'){
					update_post_meta( $rvmv_pro_id, 'RV_products', 1 );
					update_post_meta($rvmv_pro_id,'recent_view_time', date("Y-m-d h:i:s"));
					$rv_set_admin[] = $rvmv_pro_id;
					update_option( 'rv_set_admin', $rv_set_admin );
					echo __('Added Product to Recently Viewed Product List','recently-viewed-and-most-viewed-products');
					die;

				}else{
					update_post_meta( $rvmv_pro_id, 'RV_products', 0 );
					update_post_meta($rvmv_pro_id,'recent_view_time', "");
					foreach ($rv_set_admin as $key => $value) {
						if($rvmv_pro_id == $value){
							unset($rv_set_admin[$key]);
						}
					}
					$rv_set_admin = array_values($rv_set_admin);
					update_option( 'rv_set_admin', $rv_set_admin );
					echo __('Removed Product from Recently Viewed Product List','recently-viewed-and-most-viewed-products');
					die;
					
				}
				
			}
			
			$mv_count_value = 0;
			if($checkbox_name == 'MV_products'){

				if($checkbox_value == 'true'){
					update_post_meta( $rvmv_pro_id, 'MV_products', 1 );
					$mv_set_admin[] = $rvmv_pro_id;
					update_option( 'mv_set_admin', $mv_set_admin );

					$args = array( 
						'post_type' => 'product',
						'post_status' => 'publish',
						'orderby'=>'meta_value_num', 
						'order'=>'DESC',
						'meta_key'=>'wmvp_total_post_count',
						'posts_per_page'=>1 
						);

					$max_query = new WP_Query( $args );
					
					if ( $max_query->have_posts() ){

						if( $max_query->posts[0]->ID != $rvmv_pro_id){

							$mv_count_value = get_post_meta( $max_query->posts[0]->ID ,'wmvp_total_post_count', true );
							update_post_meta($rvmv_pro_id, 'wmvp_total_post_count', $mv_count_value+1);
						}
						
					}else{
						update_post_meta($rvmv_pro_id, 'wmvp_total_post_count', 1);
					}
					echo __('Added Product to Most Viewed Product List','recently-viewed-and-most-viewed-products');
					die;
					
				}else{
					update_post_meta( $rvmv_pro_id, 'MV_products', 0 );
					update_post_meta($rvmv_pro_id, 'wmvp_total_post_count', 0);
					foreach ($mv_set_admin as $key => $value) {
						if($rvmv_pro_id == $value){
							unset($mv_set_admin[$key]);
						}
					}
					$mv_set_admin = array_values($mv_set_admin);
					update_option( 'mv_set_admin', $mv_set_admin );
					echo __('Removed Product from Most Viewed Product List','recently-viewed-and-most-viewed-products');
					die;
					
				}
				
			}

		}
		/**
		 * initiallization
		 * @name admin_wramvp_init
		 * @author CedCommerce
		 *
		 */
		public function admin_wramvp_init()
		{
			$active_rvmv_tab = isset( $_GET[ 'tab' ] ) ? $_GET[ 'tab' ] : 'rv_setting';
			?>
			<div class="wramvp_main_wrapper">
				<div class="wramvp_wrap">
					<div id="icon-users" class="icon32"><br/></div>
					<h2><?php echo __('Recently and most viewed products','recently-viewed-and-most-viewed-products');?></h2>
					
					<nav class="rvmv_nav nav-tab-wrapper woo-nav-tab-wrapper">

						<a href="?page=recent-and-most-view-product&tab=rv_setting" class="nav-tab <?php echo $active_rvmv_tab == 'rv_setting' ? 'nav-tab-active' : ''; ?>"><?php echo __('Recently Viewed','recently-viewed-and-most-viewed-products'); ?></a>
						<a href="?page=recent-and-most-view-product&tab=mv_setting" class="nav-tab <?php echo $active_rvmv_tab == 'mv_setting' ? 'nav-tab-active' : ''; ?>"><?php echo __('Most Viewed','recently-viewed-and-most-viewed-products'); ?></a>
						
					</nav>

					<?php 

					if($active_rvmv_tab == 'rv_setting' )
					{
						$this->rv_settings();
					}
					elseif($active_rvmv_tab == 'mv_setting' )
					{
						$this->mv_settings();
					}
					if(isset($_GET["ced_wramvp_close"]) && $_GET["ced_wramvp_close"]==true)
					{
						unset($_GET["ced_wramvp_close"]);
						if(!session_id())
							session_start();
						$_SESSION["wramvp_hide_email"]=true;
						wp_redirect(admin_url('admin.php').'?page=recent-and-most-view-product');
						exit();
					}
					
					?>
				</div>
				<?php 
				if(!session_id())
					session_start();
				if(!isset($_SESSION["wramvp_hide_email"])):
					$actual_link = "http://".$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];
				$urlvars = parse_url($actual_link);
				$url_params = $urlvars["query"];
				?>
				<div class="wramvp_img_email_image">
					<div class="wramvp_main_content">
						<div class="wramvp_cross_image">
							<a class="button-primary wramvp_cross_image" href="?<?php echo $url_params?>&ced_wramvp_close=true">x</a>
						</div>
						<div class="ced-recom">
							<h4>Cedcommerce recommendations for you </h4>
						</div>
						<div class="wramvp_main_content__col">
							<p> 
								Looking forward to evolve your eCommerce?
								<a href="http://bit.ly/2LB1lZV" target="_blank">Sell on the TOP Marketplaces</a>
							</p>
							<div class="wramvp_img_banner">
								<a target="_blank" href="http://bit.ly/2LB1lZV"><img src="<?php echo plugins_url().'/recently-viewed-and-most-viewed-products/assets/images/market-place-2.jpg'?>"></a> 
							</div>
						</div>
						<br>
						<div class="wramvp_main_content__col">
							<p> 
								Leverage auto-syncing centralized order management and more with our
								<a href="http://bit.ly/2LB71TJ" target="_blank">Integration Extensions</a> 
							</p>
							<div class="wramvp_img_banner">
								<a target="_blank" href="http://bit.ly/2LB71TJ"><img src="<?php echo plugins_url().'/recently-viewed-and-most-viewed-products/assets/images/market-place.jpg'?>"></a> 
							</div>
						</div>
						<div class="wramvp-support">
							<ul>
								<li><span class="wramvp-support__left">Contact Us :-</span><a href="mailto:support@cedcommerce.com"> support@cedcommerce.com </a>  </li>
								<li><span class="wramvp-support__right">Get expert's advice :-</span><a href="https://join.skype.com/bovbEZQAR4DC"> Join Us</a></li>
							</ul>
						</div>
					</div>
				</div>
			<?php endif;?>
		</div>
		<?php				
	}
		/**
		 * Recently view Setting
		 * @name rv_settings
		 * @author CedCommerce
		 *
		 */
		public function rv_settings(){

			$editable_roles = array_reverse( get_editable_roles() );
			?>
			<form method="post" action="options.php">
				
				<?php settings_fields( 'ced-recently-viewed-product'); ?>
				<?php do_settings_sections( 'ced-recently-viewed-product' ); ?>
				
				<div id="wrvp_error_div" ><p id= "wrvp_error_div_p"><?php echo __('Please fill a valid input in quantity field','recently-viewed-and-most-viewed-products');?></p></div>
				<table class="form-table wrmvp_table_2">
					<tbody>
						<tr valign="top">
							<th scope="row"><label><b><?php echo __('Enable recently viewed product:','recently-viewed-and-most-viewed-products');?></b></label></th>
							<td><input type="checkbox" name="<?php echo CED_RVMV_PREFIX ?>_wrvp_enable" id="<?php echo CED_RVMV_PREFIX ?>_wrvp_enable" value="yes" <?php $wrvp_enable = get_option( CED_RVMV_PREFIX.'_wrvp_enable', null );
								if($wrvp_enable){ echo 'checked';}?>></td>
							</tr>
							<tr class="hidden_wrvp_setting" valign="top">
								<th scope="row"><label class="wmvp_sub_level"><?php echo __('Title to be displayed:','recently-viewed-and-most-viewed-products');?></label></th>
								<td><input type="text" placeholder="Recently viewed product" name="<?php echo CED_RVMV_PREFIX ?>_wrvp_viewed_title" value="<?php $wrvp_viewed_title=get_option( CED_RVMV_PREFIX.'_wrvp_viewed_title', null );
									if($wrvp_viewed_title){echo $wrvp_viewed_title;} ?>"/></td>      
								</tr>
								<tr class="hidden_wrvp_setting" valign="top">
									<th scope="row"><label class="wmvp_sub_level"><?php echo __('Number of product to be displayed:','recently-viewed-and-most-viewed-products');?></label></th>
									<td><input type="number" min="1" max="10" name="<?php echo CED_RVMV_PREFIX ?>_wrvp_total_items_display" id="<?php echo CED_RVMV_PREFIX ?>_wrvp_total_items_display" value="<?php $wrvp_total_items_display=get_option( CED_RVMV_PREFIX.'_wrvp_total_items_display', null );if($wrvp_total_items_display){ echo $wrvp_total_items_display;}else { echo '1';} ?>"/><p class="description prod_title"><?php echo __('NOTE: You cannot display items more than 10.','recently-viewed-and-most-viewed-products'); ?></p></td>
								</tr>
								<tr class="hidden_wrvp_setting">
									<th scope="top"><label class="wmvp_sub_level"><?php echo __('Show only instock recent viewed products:','recently-viewed-and-most-viewed-products');?></label></th>
									<td><input type="checkbox" name="<?php echo CED_RVMV_PREFIX ?>_wrvp_instock" value="yes" <?php $wrvp_instock=get_option( CED_RVMV_PREFIX.'_wrvp_instock' , null);if($wrvp_instock){ echo 'checked';}?>></td>
								</tr>
								<tr class="hidden_wrvp_setting">
									<th scope="top"><label class="wmvp_sub_level"><?php echo __('Select user roles to hide RV column:','recently-viewed-and-most-viewed-products');?></label></th>
									<td><select id="ced_wrvp_roles" multiple name="<?php echo CED_RVMV_PREFIX ?>_ced_wrvp_roles[]" placeholder="select roles">
										<?php 
										
										$roles = get_option( CED_RVMV_PREFIX.'_ced_wrvp_roles' , null);
										
										if($roles){
											foreach($roles as $key=>$value){
												?>
												<option value="<?php echo $value; ?>" selected ><?php echo $value; ?></option>;
												<?php 
											}
										}
										
										foreach ( $editable_roles as $role => $details ) {
											$name = translate_user_role($details['name'] );
											?>
											<option value="<?php echo esc_attr($role) ?>" ><?php echo $name ?></option>;
											<?php } ?>
										</select></td>
									</tr>
									<tr class="hidden_wrvp_setting" valign="top">
										<th scope="row"><label class="wmvp_sub_level"><?php echo __('wrvp_shortcode:','recently-viewed-and-most-viewed-products');?></label></th>
										<td><p class="prod_head"><?php echo '[wrvp_recently_viewed_products]';?></p><p class="description prod_title"><?php echo __('NOTE: You can use parameters "number_of_products_in_row" and "posts_per_page" to decide number of products in a row like "[wrvp_recently_viewed_products number_of_products_in_row="4" posts_per_page="4"]".','recently-viewed-and-most-viewed-products')?></p></td>
									</tr>
								</tbody>
							</table>
							
							<table class="form-table wrmvp_table_2">
								<tbody>
									<tr>
										<td><?php echo do_shortcode('[wrvp_recently_viewed_products_on_admin]');?></td>
									</tr>
								</tbody>
							</table>
							<?php submit_button(); ?>
						</form>	
						<?php 
					}
		/**
		 * Most view Setting
		 * @name mv_settings
		 * @author CedCommerce
		 *
		 */
		public function mv_settings(){
			$editable_roles = array_reverse( get_editable_roles() );
			?>
			<div id="wmvp_error_div"><p id="wmvp_error_div_p" >Please fill a valid input in quantity field</p></div>
			<form method="post" action="options.php">
				<?php settings_fields( 'ced-most-viewed-product'); ?>
				<?php do_settings_sections( 'ced-most-viewed-product' ); ?>
				
				<table class="form-table wrmvp_table_1">
					<tbody>
						<tr valign="top">
							<th scope="row"><label><b><?php echo __('Enable most viewed product:','recently-viewed-and-most-viewed-products');?></b></label></th>
							<td>
								<input 
								type="checkbox" 
								name="<?php echo CED_RVMV_PREFIX ?>_wmvp_enable" 
								id="<?php echo CED_RVMV_PREFIX ?>_wmvp_enable" 
								value="yes" 
								<?php
								$wmvp_enable = get_option( CED_RVMV_PREFIX.'_wmvp_enable', null);
								if($wmvp_enable)
								{ 
									?>
									checked="checked" 
									<?php 
								}
								?>
								>
							</td>
						</tr>
						<tr class="hidden_wmvp_setting" valign="top">
							<th scope="row"><label class="wmvp_sub_level"><?php echo __('Title to be displayed:','recently-viewed-and-most-viewed-products');?></label></th>
							<td><input type="text" placeholder="Most viewed product" name="<?php echo CED_RVMV_PREFIX ?>_wmvp_viewed_title" value="<?php $wmvp_viewed_title = get_option( CED_RVMV_PREFIX.'_wmvp_viewed_title', null ); if($wmvp_viewed_title){echo $wmvp_viewed_title;} ?>"/></td>      
						</tr>
						<tr class="hidden_wmvp_setting" valign="top">
							<th scope="row"><label class="wmvp_sub_level"><?php echo __('Number of product to be displayed:','recently-viewed-and-most-viewed-products');?></label></th>
							<td><input type="number" min="1" max="10" name="<?php echo CED_RVMV_PREFIX ?>_wmvp_total_items_display" id="<?php echo CED_RVMV_PREFIX ?>_wmvp_total_items_display" value="<?php $wmvp_total_items_display = get_option( CED_RVMV_PREFIX.'_wmvp_total_items_display' );  if($wmvp_total_items_display){ echo $wmvp_total_items_display;}else { echo '1';} ?>"/><p class="description prod_title"><?php echo __('NOTE: You cannot display items more than 10.','recently-viewed-and-most-viewed-products')?></p></td>
						</tr>
						<tr class="hidden_wmvp_setting">
							<th scope="top"><label class="wmvp_sub_level"><?php echo __('Show only instock most viewed products:','recently-viewed-and-most-viewed-products');?></label></th>
							<td><input type="checkbox" name="<?php echo CED_RVMV_PREFIX ?>_wmvp_instock" value="yes" <?php $wmvp_instock = get_option( CED_RVMV_PREFIX.'_wmvp_instock', null );  if($wmvp_instock){ echo 'checked';}?>></td>
						</tr>
						<tr class="hidden_wmvp_setting">
							<th scope="top"><label class="wmvp_sub_level"><?php echo __('Select user roles to hide MV column:','recently-viewed-and-most-viewed-products');?></label></th>
							<td><select id="ced_wmvp_roles" multiple name="<?php echo CED_RVMV_PREFIX ?>_ced_wmvp_roles[]" placeholder="select roles">
								<?php 
								
								$roles = get_option( CED_RVMV_PREFIX.'_ced_wmvp_roles' , null);
								
								if($roles){
									foreach($roles as $key=>$value){
										?>
										<option value="<?php echo $value; ?>" selected ><?php echo $value; ?></option>;
										<?php 
									}
								}
								
								foreach ( $editable_roles as $role => $details ) {
									$name = translate_user_role($details['name'] );
									?>
									<option value="<?php echo esc_attr($role) ?>" ><?php echo $name ?></option>;
									<?php } ?>
								</select></td>
							</tr>

							<tr class="hidden_wmvp_setting" valign="top">
								<th scope="row"><label class="wmvp_sub_level"><?php echo __('wmvp_shortcode:','recently-viewed-and-most-viewed-products');?></label></th>
								<td><p class="prod_head"><?php echo '[wmvp_most_viewed_products]';?></p><p class="description prod_title"><?php echo __('NOTE: You can use parameters "number_of_products_in_row" and "posts_per_page" to decide number of products in a row and product per page like "[wmvp_most_viewed_products number_of_products_in_row="4" posts_per_page="4"]".','recently-viewed-and-most-viewed-products');?></p></td>
							</tr>
							
						</tbody>
					</table>
					<table class="form-table wrmvp_table_1">
						<tbody>
							<tr>
								<td><?php echo do_shortcode('[wmvp_most_viewed_products_on_admin]');?></td>
							</tr>
						</tbody>
					</table>
					<?php submit_button(); ?>
				</form>
				<?php
			}


		/**
		 * registering admin setting
		 * @name ced_rvmv_register_wramvp_settings
		 * @author CedCommerce
		 *
		 */
		public function ced_rvmv_register_wramvp_settings()
		{
			register_setting('ced-most-viewed-product', CED_RVMV_PREFIX.'_wmvp_enable');
			register_setting('ced-most-viewed-product', CED_RVMV_PREFIX.'_wmvp_viewed_title');
			register_setting('ced-most-viewed-product', CED_RVMV_PREFIX.'_wmvp_total_items_display');
			register_setting('ced-most-viewed-product', CED_RVMV_PREFIX.'_wmvp_instock');
			register_setting('ced-most-viewed-product', CED_RVMV_PREFIX.'_ced_wmvp_roles');

			register_setting('ced-recently-viewed-product', CED_RVMV_PREFIX.'_wrvp_enable');
			register_setting('ced-recently-viewed-product', CED_RVMV_PREFIX.'_wrvp_viewed_title');
			register_setting('ced-recently-viewed-product', CED_RVMV_PREFIX.'_wrvp_total_items_display');
			register_setting('ced-recently-viewed-product', CED_RVMV_PREFIX.'_wrvp_instock');
			register_setting('ced-recently-viewed-product', CED_RVMV_PREFIX.'_ced_wrvp_roles');

		}
		/**
		 * showing recently viewed on admin setting page
		 * @name ced_rvmv_show_recent_viewed_products_on_admin
		 * @author CedCommerce
		 * @since 1.0.7
		 */
		public function ced_rvmv_show_recent_viewed_products_on_admin($atts)
		{
			
			$atts = extract( shortcode_atts(array(
				'number_of_products_in_row' => "",
				'posts_per_page' => get_option( CED_RVMV_PREFIX.'_wrvp_total_items_display'),
				'title'		=> get_option( CED_RVMV_PREFIX.'_wrvp_viewed_title' )
				), $atts,'wrvp_recently_viewed_products' ) );
			
			
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
			<div>	
				<div>
					<h2><?php $wrvp_viewed_title = get_option( CED_RVMV_PREFIX.'_wrvp_viewed_title', null);
						if($wrvp_viewed_title){ echo $wrvp_viewed_title;} else { echo __('Recently viewed products','recently-viewed-and-most-viewed-products');} ?></h2>
						<?php woocommerce_product_loop_start(); ?>
						<table>
							<tr>
								<?php while ( $products->have_posts() ) : $products->the_post(); ?>
									<?php 
									$wrvp_instock = get_option( CED_RVMV_PREFIX.'_wrvp_instock');
									if($wrvp_instock == 'yes'){
										$create_object = new WC_Product($products->post->ID);
										if($create_object->is_in_stock()){ ?>
										<td>
											<div>
												<a href="<?php the_permalink(); ?>"><?php the_post_thumbnail( 'thumbnail' );  ?></a>
												<div> <?php the_title(); ?></div>
											</div>
										</td>
										<?php } ?>
										<?php }else{ ?>
										<td>
											<div>
												<a href="<?php the_permalink(); ?>"><?php the_post_thumbnail( 'thumbnail' );  ?></a>
												<div> <?php the_title(); ?></div>
											</div>
										</td>
										<?php } ?>
									<?php endwhile; // end of the loop. ?>
								</tr>
							</table>
							<?php woocommerce_product_loop_end(); ?>
						</div>			
					</div>			
					<?php
					endif;
					$content = ob_get_clean();
					wp_reset_postdata();
					return $content;
				}
		/**
		 * define most viewed product
		 * @name ced_rvmv_show_most_viewed_products_on_admin
		 * @author CedCommerce
		 * @since 1.0.7
		 */
		public function ced_rvmv_show_most_viewed_products_on_admin($atts)
		{
			
			$atts = extract( shortcode_atts(array(
				'number_of_products_in_row' => "",
				'posts_per_page' => get_option( CED_RVMV_PREFIX.'_wmvp_total_items_display'),
				'title'		=> get_option( CED_RVMV_PREFIX.'_wmvp_viewed_title' )
				), $atts,'wmvp_most_viewed_products'  ) );
			
			
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

			}else{

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
			
			<div>	
				
				<div>
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
					<table>
						<tr>
							<?php while ( $products->have_posts() ) : $products->the_post(); ?> 

								<?php 
								$wmvp_instock = get_option( CED_RVMV_PREFIX.'_wmvp_instock');
								if($wmvp_instock == 'yes'){
									$create_object = new WC_Product($products->post->ID);
									if($create_object->is_in_stock()){ ?>
									<td>
										<div>
											<a href="<?php the_permalink(); ?>"><?php the_post_thumbnail( 'thumbnail' );  ?></a>
											<div> <?php the_title(); ?></div>
										</div>
									</td>
									<?php } ?>
									<?php }else{ ?>
									<td>
										<div>
											<a href="<?php the_permalink(); ?>"><?php the_post_thumbnail( 'thumbnail' );  ?></a>
											<div> <?php the_title(); ?></div>
										</div>
									</td>
									<?php } ?>
								<?php endwhile; // end of the loop. ?>
							</tr>
						</table>
						<?php woocommerce_product_loop_end(); ?>
					</div>			
				</div>					
				<?php 
				endif;
				$content = ob_get_clean();
				wp_reset_postdata();
				return $content;
			}
		}	
		$wramvp_Admin = new wramvp_Admin();
	}
	?>