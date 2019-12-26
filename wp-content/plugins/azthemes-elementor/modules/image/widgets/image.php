<?php

namespace AztElementor\Modules\Image\Widgets;

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

class Image extends Widget_Base
{

    public function get_name()
    {
        return 'azt-image';
    }

    public function get_title()
    {
        return __('Text Image', 'lambor-elementor');
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

    protected function _register_controls()
    {
        $this->start_controls_section(
            'section_icon',
            [
                'label' => __('Text Image', 'sunio-elementor'),
            ]
        );

        $this->add_control(
            'title',
            [
                'label' 		=> __('Title', 'sunio-elementor'),
                'type' 			=> Controls_Manager::TEXT,
                'default' 		=> 'Title',
                'block'         => true,
                'default'       => 'LEATHER SEARIES',

            ]
        );

        $this->add_control(
            'image',
            [
                'label' => __('Choose Image', 'sunio-elementor'),
                'type' => Controls_Manager::MEDIA,
                'dynamic' => [
                    'active' => true,
                ],
                'default' => [
                    'url' => Utils::get_placeholder_image_src(),
                ],
            ]
        );


        $this->end_controls_section();

        $this->start_controls_section(
            'section_style_content',
            [
                'label' => __( 'Content', 'sunio-elementor' ),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'heading_title',
            [
                'label' => __( 'Title', 'sunio-elementor' ),
                'type' => Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );


        $this->add_control(
            'title_color',
            [
                'label' => __( 'Color', 'sunio-elementor' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .text-image .title' => 'color: {{VALUE}};',
                ],
                'scheme' => [
                    'type' => Scheme_Color::get_type(),
                    'value' => Scheme_Color::COLOR_1,
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'title_typography',
                'selector' => '{{WRAPPER}} .text-image .title',
                'scheme' => Scheme_Typography::TYPOGRAPHY_1,
            ]
        );


        $this->end_controls_section();


    }

    protected function render()
    {
        $settings = $this->get_settings_for_display();

        ?>

        <div class="text-image">
            <?php if($settings['image']): ?>
                <div class="image">
                    <img src="<?php echo $settings['image']['url']; ?>">
                </div>
            <?php endif; ?>
            <?php if($settings['title']): ?>
            <div class="title">
                <?php echo esc_html($settings['title']) ?>
            </div>
            <?php endif; ?>
        </div>

        <?php
    }
}
