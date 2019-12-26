<?php

namespace AztElementor\Modules\Brands\Widgets;

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

class Brands extends Widget_Base
{

    public function get_name()
    {
        return 'azt-brands';
    }

    public function get_title()
    {
        return __('Brand List', 'lambor-elementor');
    }

    public function get_icon()
    {
        // Upload "eicons.ttf" font via this site: http://bluejamesbond.github.io/CharacterMap/
        return 'azt-icon eicon-blockquote';
    }

    public function get_categories()
    {
        return ['sunio-elements'];
    }


    public function get_style_depends()
    {
        return ['azt-sunio'];
    }

    public function get_script_depends()
    {
        return ['azt-brands'];
    }

    protected function _register_controls()
    {
        $this->start_controls_section(
            'section_icon',
            [
                'label' => __('Brand List', 'lambor-elementor'),
            ]
        );

        $repeater = new Repeater();

        $repeater->add_control(
            'image',
            [
                'label' => __('Choose Image', 'lambor-elementor'),
                'type' => Controls_Manager::MEDIA,
                'dynamic' => [
                    'active' => true,
                ],
                'default' => [
                    'url' => Utils::get_placeholder_image_src(),
                ],
            ]
        );

        $this->add_control(
            'brand_list',
            [
                'label' => '',
                'type' => Controls_Manager::REPEATER,
                'fields' => $repeater->get_controls(),
                'default' => [
                    [
                    ],
                ],
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'quote_carousel',
            [
                'label' => __('Quote Carousel', 'lambor-elementor'),
            ]
        );

        $slides_to_show = range(1, 10);
        $slides_to_show = array_combine($slides_to_show, $slides_to_show);

        $item_per_row = range(1, 4);
        $item_per_row = array_combine($item_per_row, $item_per_row);

        $this->add_control(
            'slides_to_show',
            [
                'label' => __('Slides to Show', 'lambor-elementor'),
                'type' => Controls_Manager::SELECT,
                'options' => [
                        '' => __('Default', 'lambor-elementor'),
                    ] + $slides_to_show,
                'frontend_available' => true,
                'default' => 7,
            ]
        );

        $this->add_control(
            'item_per_row',
            [
                'label' => __('Item Per Row', 'lambor-elementor'),
                'type' => Controls_Manager::SELECT,
                'options' => [
                        '' => __('Default', 'lambor-elementor'),
                    ] + $slides_to_show,
                'frontend_available' => true,
                'default' => 4,
            ]
        );


        $this->add_control(
            'navigation',
            [
                'label' => __('Navigation', 'lambor-elementor'),
                'type' => Controls_Manager::SELECT,
                'default' => 'both',
                'options' => [
                    'both' => __('Arrows and Dots', 'lambor-elementor'),
                    'arrows' => __('Arrows', 'lambor-elementor'),
                    'dots' => __('Dots', 'lambor-elementor'),
                    'none' => __('None', 'lambor-elementor'),
                ],
                'frontend_available' => true,
                'default' => 'arrows'
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'section_additional_options',
            [
                'label' => __('Additional Options', 'lambor-elementor'),
            ]
        );

        $this->add_control(
            'pause_on_hover',
            [
                'label' => __('Pause on Hover', 'lambor-elementor'),
                'type' => Controls_Manager::SELECT,
                'default' => 'yes',
                'options' => [
                    'yes' => __('Yes', 'lambor-elementor'),
                    'no' => __('No', 'lambor-elementor'),
                ],
                'frontend_available' => true,
            ]
        );

        $this->add_control(
            'autoplay',
            [
                'label' => __('Autoplay', 'lambor-elementor'),
                'type' => Controls_Manager::SELECT,
                'default' => 'yes',
                'options' => [
                    'yes' => __('Yes', 'lambor-elementor'),
                    'no' => __('No', 'lambor-elementor'),
                ],
                'frontend_available' => true,
            ]
        );

        $this->add_control(
            'autoplay_speed',
            [
                'label' => __('Autoplay Speed', 'lambor-elementor'),
                'type' => Controls_Manager::NUMBER,
                'default' => 1000,
                'frontend_available' => true,
            ]
        );

        $this->add_control(
            'infinite',
            [
                'label' => __('Infinite Loop', 'lambor-elementor'),
                'type' => Controls_Manager::SELECT,
                'default' => 'yes',
                'options' => [
                    'yes' => __('Yes', 'lambor-elementor'),
                    'no' => __('No', 'lambor-elementor'),
                ],
                'frontend_available' => true,
            ]
        );

        $this->add_control(
            'effect',
            [
                'label' => __('Effect', 'lambor-elementor'),
                'type' => Controls_Manager::SELECT,
                'default' => 'slide',
                'options' => [
                    'slide' => __('Slide', 'lambor-elementor'),
                    'fade' => __('Fade', 'lambor-elementor'),
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
                'label' => __('Animation Speed', 'lambor-elementor'),
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

        $show_dots = (in_array($settings['navigation'], ['dots', 'both']));
        $show_arrows = (in_array($settings['navigation'], ['arrows', 'both']));

        $item_per_row = $settings['item_per_row'];

        // Data settings
        $carousel_settings = [
            'arrows' => 'true' ? $show_arrows > 0 : 'false',
            'dots' => 'true' ? $show_dots > 0 : 'false',
            'slides_to_show' => $settings['slides_to_show'],
            'pause_on_hover' => 'true' ? $settings['pause_on_hover'] == 'yes' : 'false',
            'autoplay' => 'true' ? $settings['autoplay'] == 'yes' : 'false',
            'infinite' => 'true' ? $settings['infinite'] == 'yes' : 'false',
            'autoplay_speed' => $settings['autoplay_speed'],

        ];

        $this->add_render_attribute('data', 'data-settings', wp_json_encode($carousel_settings));
        ?>

        <div class="brand-lists owl-carousel owl-theme" data-settings=<?php echo wp_json_encode($carousel_settings)?>>
            <?php
            $column = 0;
            foreach ($settings['brand_list'] as $index => $item):
                $column++;
                ?>
                <?php if($column % $item_per_row == 1): ?>
                <div class="brand-row item">
                <?php endif; ?>
                    <div class="brand-wrap">
                        <img src="<?php echo esc_html__($item['image']['url']); ?>" alt="">
                    </div>

                <?php if($column % $item_per_row == 0): ?>

                </div>

            <?php endif; ?>

            <?php endforeach; ?>
        </div>

        <?php
    }
}
