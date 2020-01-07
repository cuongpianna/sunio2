<?php

namespace AztElementor\Modules\Hotline\Widgets;

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

class Hotline extends Widget_Base
{

    public function get_name()
    {
        return 'azt-hotline';
    }

    public function get_title()
    {
        return __('Hot Line', 'lambor-elementor');
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
                'label' => __('Hot line', 'sunio-elementor'),
            ]
        );

        $this->add_control(
            'label',
            [
                'label' 		=> __('Label', 'sunio-elementor'),
                'type' 			=> Controls_Manager::TEXT,
                'block'         => true,
                'default'       => 'HOTLINE',

            ]
        );

        $this->add_control(
            'title',
            [
                'label' 		=> __('Hotline', 'sunio-elementor'),
                'type' 			=> Controls_Manager::TEXT,
                'default' 		=> '1900 63 39 14',
                'block'         => true,

            ]
        );



        $this->end_controls_section();



    }

    protected function render()
    {
        $settings = $this->get_settings_for_display();

        ?>

        <div class="sunio-hotline">
            <div class="left">
                <i class="fas fa-phone"></i>
                <?php echo $settings['label'];?>
            </div>
            <div class="right">
                <?php echo $settings['title'];?>
            </div>
        </div>

        <?php
    }
}


