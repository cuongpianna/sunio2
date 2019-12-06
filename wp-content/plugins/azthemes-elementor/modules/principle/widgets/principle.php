<?php
namespace AztElementor\Modules\principle\Widgets;

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

class principle extends Widget_Base
{

	public function get_name()
	{
		return 'azt-principle';
	}

	public function get_title()
	{
		return __('Principle', 'sunio-elementor');
	}

	public function get_icon()
	{
		// Upload "eicons.ttf" font via this site: http://bluejamesbond.github.io/CharacterMap/
		return 'azt-icon eicon-archive-title';
	}

	public function get_categories()
	{
		return ['sunio-elements'];
	}


	public function get_style_depends()
	{
		return ['azt-principle'];
	}

	protected function _register_controls()
	{

		$this->start_controls_section(
			'section_heading',
			[
				'label' 		=> __('Principle', 'sunio-elementor'),
			]
		);

		$this->add_control(
			'icon',
			[
				'label' 		=> __('Icon', 'sunio-elementor'),
				'type' 			=> Controls_Manager::ICON,
				'label_block' 	=> true,
				'default' 		=> 'fa fa-plus',
			]
		);
		$this->add_control(
			'icon_color',
			[
				'label' 		=> __('Icon color', 'sunio-elementor'),
				'type' 			=> Controls_Manager::COLOR,
				'default' 		=> '#333',
				'selectors' 	=> [
					'{{WRAPPER}} .azt-principle-icon' => 'color: {{VALUE}} !important;',
				]
			]
		);

		$this->add_control(
			'title',
			[
				'label' 		=> __('Title', 'sunio-elementor'),
				'type' 			=> Controls_Manager::TEXT,
				'default' 		=> 'Title',
			]
		);
		$this->add_control(
			'title_color',
			[
				'label' 		=> __('Title color', 'sunio-elementor'),
				'type' 			=> Controls_Manager::COLOR,
				'default' 		=> '#333',
				'selectors' 	=> [
					'{{WRAPPER}} .azt-principle-title' => 'color: {{VALUE}};',
				]
			]
		);
		$this->add_control(
			'description',
			[
				'label' 		=> __('Desc', 'sunio-elementor'),
				'type' 			=> Controls_Manager::TEXTAREA,
				'default' 		=> '#929292',
			]
		);
		$this->add_control(
			'des_color',
			[
				'label' 		=> __('Description color', 'sunio-elementor'),
				'type' 			=> Controls_Manager::COLOR,
				'default' 		=> '',
				'selectors' 	=> [
					'{{WRAPPER}} .azt-principle-description' => 'color: {{VALUE}};',
				]
			]
		);
		$this->add_control(
			'show_button',
			[
				'label' 		=> __('Show button', 'sunio-elementor'),
				'type' 			=> Controls_Manager::SWITCHER,
				'default' 		=> 'no',
			]
		);
		$this->add_control(
			'text_button',
			[
				'label' 		=> __('Text button', 'sunio-elementor'),
				'type' 			=> Controls_Manager::TEXT,
				'default' 		=> 'Button',
				'condition' => [
					'show_button' => 'yes',
				],
			]
		);
		$this->add_control(
			'url_button',
			[
				'label' 		=> __('Url', 'sunio-elementor'),
				'type' 			=> Controls_Manager::TEXT,
				//'default' 		=> 'Button',
				'condition' => [
					'show_button' => 'yes',
				],
			]
		);
		$this->add_control(
			'azt_url_target',
			[
				'label' 		=> __('Target', 'sunio-elementor'),
				'type' 			=> Controls_Manager::SELECT,
			//	'default' 		=> 'Chose',
				'options' 		=> azt_get_url_target(),
			]
		);
		$this->add_control(
			'text_color',
			[
				'label' 		=> __('Text color', 'sunio-elementor'),
				'type' 			=> Controls_Manager::COLOR,
				'default' 		=> '#fff',
				'selectors' 	=> [
					'{{WRAPPER}} .azt-principle-button' => 'color: {{VALUE}};',
				],
				'condition' => [
					'show_button' => 'yes',
				],
			]
		);
		$this->add_control(
			'button_color',
			[
				'label' 		=> __('Button background', 'sunio-elementor'),
				'type' 			=> Controls_Manager::COLOR,
				'default' 		=> '#1c58f6',
				'selectors' 	=> [
					'{{WRAPPER}} .azt-principle-button' => 'background-color: {{VALUE}};border: 1px solid {{VALUE}};',
				],
				'condition' => [
					'show_button' => 'yes',
				],
			]
		);
		$this->add_control(
			'text_align',
			[
				'label' 		=> __('Heading align', 'sunio'),
				'type' 			=> Controls_Manager::CHOOSE,
				'options' 		=> [
					'left'    => [
						'title' => __('Left', 'sunio-elementor'),
						'icon' 	=> 'fa fa-align-left',
					],
					'center' => [
						'title' => __('Center', 'sunio-elementor'),
						'icon' 	=> 'fa fa-align-center',
					],
					'right' => [
						'title' => __('Right', 'sunio-elementor'),
						'icon' 	=> 'fa fa-align-right',
					],
				],
				'selectors' => [
					'{{WRAPPER}} .azt-principle' => 'text-align: {{VALUE}};',
				],
				'default' 		=> 'center',
			]
		);
		$this->add_control(
			'title_html_tag',
			[
				'label' 		=> __('HTML Tag', 'sunio-elementor'),
				'type' 			=> Controls_Manager::SELECT,
				'default' 		=> 'div',
				'options' 		=> azt_get_available_tags(),
			]
		);


		$this->end_controls_section();
	}

	protected function render()
	{
		$settings 	= $this->get_settings_for_display();
		$id 		= $this->get_id();
		$title_tag 	= $settings['title_html_tag'];
		$url_target 	= $settings['azt_url_target'];
		?>
	<<?php echo $title_tag; ?> class="azt-principle">
		<div class="azt-principle-icon"><i class="fa <?php echo $settings['icon'] ?>"></i></div>
		<h4 class="azt-principle-title"><?php echo $settings["title"] ?></h4>
		<p class="azt-principle-description">
			<?php echo $settings["description"] ?>
		</p>
		
		<?php if ('yes' == $settings['show_button']) {   ?>
			<a class="azt-principle-button button small " onclick="window.open('<?php echo $settings['url_button'] ?>', '<?php echo $url_target; ?>')"><?php echo $settings['text_button'] ?></a>
		<?php } ?>
	</<?php echo $title_tag; ?>>
<?php
}
}
