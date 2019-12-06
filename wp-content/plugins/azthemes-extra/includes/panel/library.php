<?php
/**
 * My Library
 *
 * @package 	sunio_Extra
 * @category 	Core
 * @author 		sunio
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

// Start Class
class sunio_Extra_My_Library {

	/**
	 * Start things up
	 */
	public function __construct() {
		add_action( 'init', array( $this, 'library_post_type' ) );

		if ( is_admin() ) {
			add_action( 'admin_menu', array( $this, 'add_page' ), 1 );
			add_filter( 'sunio_main_metaboxes_post_types', array( $this, 'add_metabox' ), 20 );
			add_action( 'add_meta_boxes_sunio_library', array( $this, 'shortcode_metabox' ) );
			add_filter( 'manage_edit-sunio_library_columns', array( $this, 'edit_columns' ) );
			add_action( 'manage_sunio_library_posts_custom_column', array( $this, 'custom_columns' ), 10, 2 );
		}

		add_action( 'template_redirect', array( $this, 'block_template_frontend' ) );
	}

	/**
	 * Add sub menu page
	 *
	 * @since 1.2.10
	 */
	public function add_page() {

		// Name
		$name = esc_html__( 'My Library', 'sunio' );
		$name = apply_filters( 'sunio_my_library_text', $name );

		add_submenu_page(
			'sunio-panel',
			esc_html__( 'My Library', 'sunio' ),
			$name,
			'manage_options',
			'edit.php?post_type=sunio_library'
		);

	}

	/**
	 * Register library post type
	 *
	 * @since 1.2.10
	 */
	public static function library_post_type() {

		// Name
		$name = esc_html__( 'My Library', 'sunio' );
		$name = apply_filters( 'sunio_my_library_text', $name );

		// Register the post type
		register_post_type( 'sunio_library', apply_filters( 'sunio_library_args', array(
			'labels' => array(
				'name' 					=> $name,
				'singular_name' 		=> esc_html__( 'Template', 'sunio' ),
				'add_new' 				=> esc_html__( 'Add New', 'sunio' ),
				'add_new_item' 			=> esc_html__( 'Add New Template', 'sunio' ),
				'edit_item' 			=> esc_html__( 'Edit Template', 'sunio' ),
				'new_item' 				=> esc_html__( 'Add New Template', 'sunio' ),
				'view_item' 			=> esc_html__( 'View Template', 'sunio' ),
				'search_items' 			=> esc_html__( 'Search Template', 'sunio' ),
				'not_found' 			=> esc_html__( 'No Templates Found', 'sunio' ),
				'not_found_in_trash' 	=> esc_html__( 'No Templates Found In Trash', 'sunio' ),
				'menu_name' 			=> esc_html__( 'My Library', 'sunio' ),
			),
			'public' 					=> true,
			'hierarchical'          	=> false,
			'show_ui'               	=> true,
			'show_in_menu' 				=> false,
			'show_in_nav_menus'     	=> false,
			'can_export'            	=> true,
			'exclude_from_search'   	=> true,
			'capability_type' 			=> 'post',
			'rewrite' 					=> false,
			'supports' 					=> array( 'title', 'editor', 'thumbnail', 'author', 'elementor' ),
		) ) );

	}

	/**
	 * Add the sunio Settings metabox into the custom post type
	 *
	 * @since 1.2.10
	 */
	public static function add_metabox( $types ) {
		$types[] = 'sunio_library';
		return $types;
	}

	/**
	 * Make the post type inaccessible
	 *
	 * @since 1.2.10
	 */
	public static function block_template_frontend() {
		if ( is_singular( 'sunio_library' ) && ! self::is_current_user_can_edit() ) {
			wp_redirect( site_url(), 301 );
			die;
		}
	}

	/**
	 * If the current user can edit
	 *
	 * @since 1.2.10
	 */
	public static function is_current_user_can_edit( $post_id = 0 ) {
		if ( empty( $post_id ) ) {
			$post_id = get_the_ID();
		}

		if ( 'trash' === get_post_status( $post_id ) ) {
			return false;
		}

		$post_type_object = get_post_type_object( get_post_type( $post_id ) );
		if ( empty( $post_type_object ) ) {
			return false;
		}

		if ( ! isset( $post_type_object->cap->edit_post ) ) {
			return false;
		}

		$edit_cap = $post_type_object->cap->edit_post;
		if ( ! current_user_can( $edit_cap, $post_id ) ) {
			return false;
		}

		if ( get_option( 'page_for_posts' ) === $post_id ) {
			return false;
		}

		return true;
	}

	/**
	 * Add shorcode metabox
	 * The $this variable is not used to get the display_meta_box() function because it doesn't work on older PHP version.
	 *
	 * @since 1.2.2
	 */
	public static function shortcode_metabox( $post ) {

		add_meta_box(
			'library-shortcode-metabox',
			esc_html__( 'Shortcode', 'sunio' ),
			array( 'sunio_Extra_My_Library', 'display_metabox' ),
			'sunio_library',
			'side',
			'low'
		);

	}

	/**
	 * Add shorcode metabox
	 *
	 * @since 1.2.2
	 */
	public static function display_metabox( $post ) { ?>

		<input type="text" class="widefat" value='[sunio_library id="<?php echo $post->ID; ?>"]' readonly />

	<?php
	}

	/**
	 * Add the shortcode column
	 *
	 * @since 1.2.2
	 */
	public static function edit_columns( $columns ) {
		$columns['sunio_library_shortcode'] = esc_html__( 'Shortcode', 'sunio' );
		return $columns;
	}

	/**
	 * Display the shortcode column
	 *
	 * @since 1.2.2
	 */
	public static function custom_columns( $column, $post_id ) {

		switch ( $column ) :

			// Display the shortcode in the column view
			case 'sunio_library_shortcode':

				$shortcode = esc_attr( sprintf( '[sunio_library id="%d"]', $post_id ) );
				printf( '<input type="text" value="%s" readonly style="min-width: 200px;" />', $shortcode );

			break;

		endswitch;

	}

}
new sunio_Extra_My_Library();