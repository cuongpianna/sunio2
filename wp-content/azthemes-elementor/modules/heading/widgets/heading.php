<?php
namespace AztElementor\Modules\heading\Widgets;

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

class heading extends Widget_Base
{

	public function get_name()
	{
		return 'azt-heading';
	}

	public function get_title()
	{
		return __('Section Header', 'sunio-elementor');
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

	// public function get_script_depends() {
	// 	return [ 'azt-heading' ];
	// }

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
				'default' 		=> 'Title',
			]
		);
		$this->add_control(
			'title_color',
			[
				'label' 		=> __('Title Color', 'sunio'),
				'type' 			=> Controls_Manager::COLOR,
				'default' 		=> '#e1e1e1',
				'selectors' 	=> [
					'{{WRAPPER}} .azt-heading-title' => 'Color:{{VALUE}};',
				]
			]
		);
		$this->add_control(
			'show_line',
			[
				'label' 		=> __('Show line', 'sunio'),
				'type' 			=> Controls_Manager::SWITCHER,
				'default' 		=> 'yes',
			]
		);
		$this->add_control(
			'text_color',
			[
				'label' 		=> __('Text Color', 'sunio'),
				'type' 			=> Controls_Manager::COLOR,
				'default' 		=> '#e1e1e1',
				'selectors' 	=> [
					'{{WRAPPER}} .azt-heading-title-break' => 'border-color: {{VALUE}};border-top: 2px solid {{VALUE}};',
				],
				'condition' => [
					'show_line' => 'yes',
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
						'title' => __('Left', 'sunio'),
						'icon' 	=> 'fa fa-align-left',
					],
					'center' => [
						'title' => __('Center', 'sunio'),
						'icon' 	=> 'fa fa-align-center',
					],
					'right' => [
						'title' => __('Right', 'sunio'),
						'icon' 	=> 'fa fa-align-right',
					],
				],
				'selectors' => [
					'{{WRAPPER}} .azt-heading' => 'text-align: {{VALUE}};',
				],
				'default' 		=> 'center',
			]
		);
		$this->add_control(
			'description',
			[
				'label' 		=> __('Desc', 'sunio-elementor'),
				'type' 			=> Controls_Manager::TEXTAREA,
				'default' 		=> '',
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
		?>
	<<?php echo $title_tag; ?> class="azt-heading">
		<h2 class="azt-heading-title">
			<?php echo $settings['title'] ?>
		</h2>
		<?php if ('yes' == $settings['show_line']) {   ?>
			<hr class="azt-heading-title-break" style="" />
		<?php } ?>
		<p class="azt-heading-desc"><?php echo $settings['description'] ?></p>
	</<?php echo $title_tag; ?>>

<?php
}
}
