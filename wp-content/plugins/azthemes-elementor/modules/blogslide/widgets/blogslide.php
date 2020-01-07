<?php
namespace AztElementor\Modules\Blogslide\Widgets;

// Elementor Classes

use Elementor\Controls_Manager;
use Elementor\Group_Control_Typography;
use Elementor\Scheme_Typography;
use Elementor\Group_Control_Background;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Widget_Base;
use Elementor\Plugin;
use Elementor\Repeater;
use Elementor\Icons_Manager;
use Elementor\Scheme_Color;
use Elementor\Utils;

if (!defined('ABSPATH')) exit; // Exit if accessed directly

class Blogslide extends Widget_Base
{

    public function get_name()
    {
        return 'azt-blogslide';
    }

    public function get_title()
    {
        return __('Blog slide', 'sunio-elementor');
    }

    public function get_icon()
    {
        // Upload "eicons.ttf" font via this site: http://bluejamesbond.github.io/CharacterMap/
        return 'azt-icon eicon-posts-carousel';
    }

    public function get_categories()
    {
        return ['sunio-elements'];
    }


    public function get_style_depends()
    {
        return ['azt-sunio'];
    }

    public function get_script_depends() {
        return ['azt-blogslide'];
    }

    protected function _register_controls()
    {

        $args = array(
            'orderby' => 'name',
            'order' => 'ASC'
        );

        $categories=get_categories($args);
        $cate_array = array();
        $arrayCateAll = array( 'all' => 'All categories ' );
        if ($categories) {
            foreach ( $categories as $cate ) {
                $cate_array[$cate->cat_name] = $cate->slug;
            }
        } else {
            $cate_array["No content Category found"] = 0;
        }

        $this->start_controls_section(
            'section_blog',
            [
                'label' => __( 'Blogs', 'sunio-elementor' ),
            ]
        );


        $this->add_control(
            'category',
            [
                'label' 		=> __('Category', 'sunio'),
                'type' 			=> Controls_Manager::SELECT,
                'default' => 'all',
                'options' => array_merge($arrayCateAll,$cate_array),
            ]
        );


        $slides_to_show = range( 1, 10 );
        $slides_to_show = array_combine( $slides_to_show, $slides_to_show );

        $this->add_control(
            'total_post',
            [
                'label' => __( 'Total Post', 'sunio-elementor' ),
                'type' => Controls_Manager::TEXT,
                'default' => 3,
                'min' => 3,
            ]
        );

        $this->add_control(
            'slides_to_show',
            [
                'label' 	=> __( 'Slides to Show', 'sunio-elementor' ),
                'type' 		=> Controls_Manager::SELECT,
                'options' 	=> [
                        '' => __( 'Default', 'sunio-elementor' ),
                    ] + $slides_to_show,
                'default' 	=> 3,
            ]
        );



        $this->add_control(
            'navigation',
            [
                'label' 		=> __( 'Navigation', 'sunio-elementor' ),
                'type' 			=> Controls_Manager::SELECT,
                'default' 		=> 'arrows',
                'options' 		=> [
                    'both' 		=> __( 'Arrows and Dots', 'sunio-elementor' ),
                    'arrows' 	=> __( 'Arrows', 'sunio-elementor' ),
                    'dots' 		=> __( 'Dots', 'sunio-elementor' ),
                    'none' 		=> __( 'None', 'sunio-elementor' ),
                ],
                'frontend_available' => true,
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'section_additional_options',
            [
                'label' => __( 'Additional Options', 'sunio-elementor' ),
            ]
        );

        $this->add_control(
            'pause_on_hover',
            [
                'label' => __( 'Pause on Hover', 'sunio-elementor' ),
                'type' => Controls_Manager::SELECT,
                'default' => 'yes',
                'options' => [
                    'yes' => __( 'Yes', 'sunio-elementor' ),
                    'no' => __( 'No', 'sunio-elementor' ),
                ],
                'frontend_available' => true,
            ]
        );

        $this->add_control(
            'autoplay',
            [
                'label' => __( 'Autoplay', 'sunio-elementor' ),
                'type' => Controls_Manager::SELECT,
                'default' => 'yes',
                'options' => [
                    'yes' => __( 'Yes', 'sunio-elementor' ),
                    'no' => __( 'No', 'sunio-elementor' ),
                ],
                'frontend_available' => true,
            ]
        );

        $this->add_control(
            'autoplay_speed',
            [
                'label' => __( 'Autoplay Speed', 'sunio-elementor' ),
                'type' => Controls_Manager::NUMBER,
                'default' => 1000,
                'frontend_available' => true,
            ]
        );

        $this->add_control(
            'infinite',
            [
                'label' => __( 'Infinite Loop', 'sunio-elementor' ),
                'type' => Controls_Manager::SELECT,
                'default' => 'yes',
                'options' => [
                    'yes' => __( 'Yes', 'sunio-elementor' ),
                    'no' => __( 'No', 'sunio-elementor' ),
                ],
                'frontend_available' => true,
            ]
        );

        $this->add_control(
            'effect',
            [
                'label' => __( 'Effect', 'sunio-elementor' ),
                'type' => Controls_Manager::SELECT,
                'default' => 'slide',
                'options' => [
                    'slide' => __( 'Slide', 'sunio-elementor' ),
                    'fade' => __( 'Fade', 'sunio-elementor' ),
                ],
                'condition' => [
                    'slides_to_show' => '1',
                ],
                'frontend_available' => true,
            ]
        );

        $this->add_control(
            'speed',
            [
                'label' => __( 'Animation Speed', 'sunio-elementor' ),
                'type' => Controls_Manager::NUMBER,
                'default' => 500,
                'frontend_available' => true,
            ]
        );

        $this->end_controls_section();




    }

    protected function render()
    {
        $settings = $this->get_settings_for_display();

        $this->add_render_attribute( 'blog_list', 'class', ['sunio-elementor-blog-list-items', 'owl-carousel', 'owl-theme']);

        $this->add_render_attribute( 'blog_item', 'class', 'sunio-elementor-blog-item' );
        $show_dots = ( in_array( $settings['navigation'], [ 'dots', 'both' ] ) );
        $show_arrows = ( in_array( $settings['navigation'], [ 'arrows', 'both' ] ) );
        $total_count = $settings['total_post'];
        $category = $settings['category'];

            $show_slide_class = 'sunio-blog-slide';
            // Data settings
            $carousel_settings = [
                'arrows' 			=> 'true' ? $show_arrows > 0 : 'false',
                'dots' 				=> 'true' ? $show_dots > 0 : 'false',
                'slides_to_show' 	=> $settings['slides_to_show'],
                'pause_on_hover'	=> 'true' ? $settings['pause_on_hover'] == 'yes' : 'false',
                'autoplay'			=> 'true' ? $settings['autoplay'] == 'yes' : 'false',
                'infinite'			=> 'true' ? $settings['infinite'] == 'yes' : 'false',
                'autoplay_speed'    => $settings['autoplay_speed'],

            ];
            $this->add_render_attribute( 'data', 'data-settings', wp_json_encode( $carousel_settings ) );


        $args =array();
        if ($category == 'all') {
            $args=array('post_type' => 'post', 'posts_per_page' => $total_count);
        } else {
            $args=array('post_type' => 'post', 'category_name'=>$category,'posts_per_page' => $total_count);
        }
        $blog = new \WP_Query($args);

        ?>
        <div class="sunio-blog-slider-wrapper <?php echo $show_slide_class ?>">
            <div <?php echo $this->get_render_attribute_string( 'blog_list' ); ?>
                <?php echo $this->get_render_attribute_string( 'data' ); ?>
            >
                <?php
                $i = 0;
                if($blog->have_posts()) : while($blog->have_posts()) : $blog->the_post();
                    $i++;
                    $thumbnail_url = wp_get_attachment_image_url(get_post_thumbnail_id() , 'full' );
                    ?>
                    <div <?php echo $this->get_render_attribute_string( 'blog_item' ); ?> >
                        <div class="blog-slide-image">
                            <div class="over-lay"></div>
                            <a class="overlay" href="<?php  the_permalink() ?>">
                                <img src="<?php echo $thumbnail_url ?>" alt="<?php esc_attr_e(get_the_title()); ?>">
                            </a>
                        </div>
                        <div class="blog-slide-content">
                            <div class="post-title">
                                <h2><a class="second_font" href="<?php the_permalink() ?>"><?php echo get_the_title() ?></a></h2>
                            </div>
                            <div class="post-excerpt">
                                <p><?php echo get_the_excerpt() ?></p>
                            </div>

                            <a href="<?php echo the_permalink(); ?>" class="more">Xem tiếp <i class="fas fa-arrow-right"></i></a>
                        </div>
                    </div>
                <?php
                endwhile; endif; wp_reset_postdata();
                ?>
            </div>
        </div>

        <?php
    }
}
