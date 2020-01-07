<?php
namespace AztElementor\Modules\heading2\Widgets;

// Elementor Classes
use Elementor\Controls_Manager;
use Elementor\Group_Control_Typography;
use Elementor\Scheme_Typography;
use Elementor\Group_Control_Background;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Widget_Base;
use Elementor\Plugin;

if (!defined('ABSPATH')) exit; // Exit if accessed directly

class heading2 extends Widget_Base
{

    public function get_name()
    {
        return 'azt-heading2';
    }

    public function get_title()
    {
        return __('Sunio Heading', 'sunio-elementor');
    }

    public function get_icon()
    {
        // Upload "eicons.ttf" font via this site: http://bluejamesbond.github.io/CharacterMap/
        return 'azt-icon eicon-heading';
    }

    public function get_categories()
    {
        return ['sunio-elements'];
    }


    public function get_style_depends()
    {
        return ['azt-heading'];
    }

    protected function _register_controls()
    {

        $this->start_controls_section(
            'section_heading',
            [
                'label' 		=> __('Heading', 'sunio-elementor'),
            ]
        );


        $this->add_control(
            'title',
            [
                'label' 		=> __('Title', 'sunio-elementor'),
                'type' 			=> Controls_Manager::TEXT,
                'default' 		=> 'Tin tức sự kiện mới nhất',
            ]
        );

        $this->add_control(
            'text1',
            [
                'label' 		=> __('Text1', 'sunio-elementor'),
                'type' 			=> Controls_Manager::TEXT,
                'default' 		=> 'Tin tức',
            ]
        );

        $this->add_control(
            'text2',
            [
                'label' 		=> __('Text2', 'sunio-elementor'),
                'type' 			=> Controls_Manager::TEXT,
                'default' 		=> 'mới',
            ]
        );


        $this->end_controls_section();
    }

    protected function render()
    {
        $settings 	= $this->get_settings_for_display();
        ?>
        <div class="sunio-heading2">
            <div class="title"><?php echo $settings['title'];?></div>

            <div class="under">
                <span class="left"><?php echo $settings['text1']?></span>
                <span class="right"><?php echo $settings['text2']?></span>
            </div>
        </div>

        <?php
    }
}
