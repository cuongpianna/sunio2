<?php
namespace AztElementor\Modules\Woocommerce\Widgets;

// Elementor Classes
use Elementor\Controls_Manager;
use Elementor\Group_Control_Typography;
use Elementor\Scheme_Typography;
use Elementor\Group_Control_Background;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Widget_Base;
use Elementor\Utils;
use Elementor\Group_Control_Image_Size;
class Woo_Categories extends Widget_Base {

	public function get_name() {
		return 'azt-woo_categories';
	}

	public function get_title() {
		return __( 'Woo - Categories', 'sunio-elementor-widgets' );
	}

	public function get_icon() {
		// Upload "eicons.ttf" font via this site: http://bluejamesbond.github.io/CharacterMap/
		return 'azt-icon eicon-woocommerce';
	}
	public function get_style_depends()
	{
		return ['azt-woo_categories'];
	}
	public function get_categories() {
		return [ 'sunio-elements' ];
	}

	protected function get_product_categories() {

		$product_cat = array();

		$cat_args = array(
			'orderby'    => 'name',
			'order'      => 'asc',
			'hide_empty' => false,
		);

		$product_categories = get_terms( 'product_cat', $cat_args );

		if ( ! empty( $product_categories ) ) {
			foreach ( $product_categories as $key => $category ) {
				$product_cat[ $category->slug ] = $category->name;
			}
		}

		return $product_cat;
	}
	protected function _register_controls() {
		$this->start_controls_section(
		'section_heading',
		[
			'label' 		=> __('Product Categories', 'sunio'),
		]
		);
		$this->add_control(
			'category_filter',
			[
				'label'     	=> __( 'Select Categories', 'sunio' ),
				'type'      	=> Controls_Manager::SELECT2,
				'multiple'  	=> false,
				'default'   	=> '',
				'options'   	=> $this->get_product_categories(),
				
			]
		);
		$this->add_control(
			'image',
			[
				'label'   		=> __( 'Image', 'sunio' ),
				'type'    		=> Controls_Manager::MEDIA,
				'default' 		=> [
					'url' => Utils::get_placeholder_image_src(),
				],
				'dynamic' 		=> [ 'active' => true ],
			]
		);

		$this->add_group_control(
			Group_Control_Image_Size::get_type(),
			[
				'name' 			=> 'image', // Usage: `{name}_size` and `{name}_custom_dimension`, in this case `image_size` and `image_custom_dimension`.
				'label' 		=> __( 'Image Size', 'sunio' ),
				'default' 		=> 'large',
			]
		);
		$this->add_control(
			'link',
			[
				'label'   		=> __( 'Link', 'sunio' ),
				'type'    		=> Controls_Manager::URL,
				'placeholder' 	=> __( 'https://your-link.com', 'sunio' ),
				'dynamic' 		=> [ 'active' => true ],
			]
		);
		$this->add_control(
			'text_button',
			[
				'label' 		=> __('Read more', 'sunio'),
				'type' 			=> Controls_Manager::TEXT,
				'default' 		=> 'Shop now',
			]
		);
		$this->end_controls_section();
	}

	

	public function render() { 
		$settings 	= $this->get_settings_for_display();
		$link 			= $settings['link'];
		$taxonomy = 'product_cat';
 		$slug =count($settings['category_filter'][0])==1?$settings['category_filter']:$settings['category_filter'][0];
  		$categories = get_term_by( 'slug', $slug, $taxonomy );
	?>
		<div class="azt-product-category">
			<?php
			if ( ! empty( $link['url'] ) ) {
				$this->add_render_attribute( 'link', 'class', 'azt-banner-link' );
				$this->add_render_attribute( 'link', 'href', $link['url'] );

				if ( $link['is_external'] ) {
					$this->add_render_attribute( 'link', 'target', '_blank' );
				}

				if ( $link['nofollow'] ) {
					$this->add_render_attribute( 'link', 'rel', 'nofollow' );
				}

				$this->add_render_attribute( 'link', 'class', 'azt-brands-link' );

				echo '<a ' . $this->get_render_attribute_string( 'link' ) . '>';
			} else {
				if($categories!=null)
				{
					$linkcate= get_term_link(  $categories->term_id, 'product_cat' );
					echo '<a href='.$linkcate.'>';
				}
			} ?>
				<?php echo Group_Control_Image_Size::get_attachment_image_html( $settings ); ?>
			</a>
			
				<?php
					if ( ! empty( $link['url'] ) ) {
						$this->add_render_attribute( 'link', 'class', 'azt-banner-link' );
						$this->add_render_attribute( 'link', 'href', $link['url'] );

						if ( $link['is_external'] ) {
							$this->add_render_attribute( 'link', 'target', '_blank' );
						}

						if ( $link['nofollow'] ) {
							$this->add_render_attribute( 'link', 'rel', 'nofollow' );
						}

						$this->add_render_attribute( 'link', 'class', 'azt-brands-link' );

						echo '<a ' . $this->get_render_attribute_string( 'link' ) . '>';
					} else {
						if($categories!=null){
							$linkcate= get_term_link(  $categories->term_id, 'product_cat' );
							echo '<a href='.$linkcate.'>';
						}
					} ?>
					<div class="azt-infor-wapper">
						<div class="azt-info-text">
							<h4 class="azt-info-name">
								<?php echo $categories->name; ?>
							</h4>
							<span class="azt-banner-text">
								<?php echo $settings['text_button']; ?>
							</span> 
						</div>
					</div>
				</a>
		</div>
	<?php 
	}

	

}