<?php
namespace AztElementor\Modules\Accordion\Widgets;

// Elementor Classes
use Elementor\Controls_Manager;
use Elementor\Group_Control_Typography;
use Elementor\Scheme_Typography;
use Elementor\Group_Control_Background;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Widget_Base;
use Elementor\Plugin;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class Accordion extends Widget_Base {

	public function get_name() {
		return 'azt-accordion';
	}

	public function get_title() {
		return __( 'Accordion', 'sunio-elementor' );
	}

	public function get_icon() {
		// Upload "eicons.ttf" font via this site: http://bluejamesbond.github.io/CharacterMap/
		return 'azt-icon eicon-accordion';
	}

	public function get_categories() {
		return [ 'sunio-elements' ];
	}

	public function get_script_depends() {
		return [ 'azt-accordion' ];
	}

	public function get_style_depends() {
		return [ 'azt-accordion' ];
	}

	protected function _register_controls() {

		$this->start_controls_section(
			'section_accordion',
			[
				'label' 		=> __( 'Accordion', 'sunio-elementor' ),
			]
		);

		$this->add_control(
			'tabs',
			[
				'label' 		=> __( 'Items', 'sunio-elementor' ),
				'type' 			=> Controls_Manager::REPEATER,
				'default' => [
					[
						'tab_title'   	=> __( 'Accordion #1', 'sunio-elementor' ),
						'tab_content' 	=> __( 'I am text block. Click edit button to change this text. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut elit tellus, luctus nec ullamcorper mattis, pulvinar dapibus leo.', 'sunio-elementor' ),
					],
					[
						'tab_title'   	=> __( 'Accordion #2', 'sunio-elementor' ),
						'tab_content' 	=> __( 'I am text block. Click edit button to change this text. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut elit tellus, luctus nec ullamcorper mattis, pulvinar dapibus leo.', 'sunio-elementor' ),
					],
					[
						'tab_title'   	=> __( 'Accordion #3', 'sunio-elementor' ),
						'tab_content' 	=> __( 'I am text block. Click edit button to change this text. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut elit tellus, luctus nec ullamcorper mattis, pulvinar dapibus leo.', 'sunio-elementor' ),
					],
				],
				'fields' => [
					[
						'name'        	=> 'tab_title',
						'label'       	=> __( 'Title & Content', 'sunio-elementor' ),
						'type'        	=> Controls_Manager::TEXT,
						'default'     	=> __( 'Accordion Title' , 'sunio-elementor' ),
						'label_block' 	=> true,
						'dynamic' 		=> [ 'active' => true ],
					],
					[
						'name'    		=> 'source',
						'label'   		=> __( 'Select Source', 'sunio-elementor' ),
						'type'    		=> Controls_Manager::SELECT,
						'default' 		=> 'custom',
						'options' 		=> [
							'custom'    => __( 'Custom', 'sunio-elementor' ),
							'template' 	=> __( 'Template', 'sunio-elementor' ),
						],
					],
					[
						'name'       	=> 'tab_content',
						'label'      	=> __( 'Content', 'sunio-elementor' ),
						'type'       	=> Controls_Manager::WYSIWYG,
						'default' 		=> __( 'I am text block. Click edit button to change this text. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut elit tellus, luctus nec ullamcorper mattis, pulvinar dapibus leo.', 'sunio-elementor' ),
						'show_label' 	=> false,
						'condition' 	=> [
							'source' => 'custom',
						],
						'dynamic' 		=> [ 'active' => true ],
					],
					[
						'name'        	=> 'templates',
						'label'       	=> __( 'Content', 'sunio-elementor' ),
						'type'        	=> Controls_Manager::SELECT,
						'default' 		=> '0',
						'options' 		=> azt_get_available_templates(),
						'condition' 	=> [
							'source' => 'template',
						],
					],
				],
				'title_field' 	=> '{{{ tab_title }}}',
			]
		);

		$this->add_control(
			'icon',
			[
				'label' 		=> __( 'Icon', 'sunio-elementor' ),
				'type' 			=> Controls_Manager::ICON,
				'label_block' 	=> true,
				'default' 		=> 'fa fa-plus',
			]
		);

		$this->add_control(
			'active_icon',
			[
				'label' 		=> __( 'Active Icon', 'sunio-elementor' ),
				'type' 			=> Controls_Manager::ICON,
				'label_block' 	=> true,
				'default' 		=> 'fa fa-minus',
				'condition'   	=> [
					'icon!' => '',
				],
			]
		);

		$this->add_control(
			'title_html_tag',
			[
				'label' 		=> __( 'HTML Tag', 'sunio-elementor' ),
				'type' 			=> Controls_Manager::SELECT,
				'default' 		=> 'div',
				'options' 		=> azt_get_available_tags(),
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_additional',
			[
				'label' 		=> __( 'Additional Options', 'sunio-elementor' ),
			]
		);

		$this->add_control(
			'multiple',
			[
				'label' 		=> __( 'Open Multiple Items', 'sunio-elementor' ),
				'type' 			=> Controls_Manager::SWITCHER,
			]
		);

		$this->add_control(
			'active_item',
			[
				'label' 		=> __( 'Active Item No', 'sunio-elementor' ),
				'type' 			=> Controls_Manager::NUMBER,
				'min'   		=> 1,
				'max'   		=> 20,
			]
		);

        $this->end_controls_section();

		$this->start_controls_section(
			'section_style',
			[
				'label' 		=> __( 'Item', 'sunio-elementor' ),
				'tab' 			=> Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_responsive_control(
			'align',
			[
				'label' 		=> __( 'Alignment', 'sunio-elementor' ),
				'type' 			=> Controls_Manager::CHOOSE,
				'options' 		=> [
					'left'    => [
						'title' => __( 'Left', 'sunio-elementor' ),
						'icon' 	=> 'fa fa-align-left',
					],
					'center' => [
						'title' => __( 'Center', 'sunio-elementor' ),
						'icon' 	=> 'fa fa-align-center',
					],
					'right' => [
						'title' => __( 'Right', 'sunio-elementor' ),
						'icon' 	=> 'fa fa-align-right',
					],
				],
				'default' 		=> '',
				'selectors' 	=> [
					'{{WRAPPER}} .azt-accordion .azt-accordion-title'   => 'text-align: {{VALUE}};',
					'{{WRAPPER}} .azt-accordion .azt-accordion-content' => 'text-align: {{VALUE}};',
				],
			]
		);

		$this->add_responsive_control(
			'item_spacing',
			[
				'label' 		=> __( 'Item Spacing', 'sunio-elementor' ),
				'type' 			=> Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 100,
					]
				],
				'selectors' 	=> [
					'{{WRAPPER}} .azt-accordion .azt-accordion-item + .azt-accordion-item' => 'margin-top: {{SIZE}}{{UNIT}};',
				],
			]
		);

        $this->end_controls_section();

		$this->start_controls_section(
			'section_title_style',
			[
				'label' 		=> __( 'Title', 'sunio-elementor' ),
				'tab' 			=> Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' 			=> 'title_typography',
				'scheme' 		=> Scheme_Typography::TYPOGRAPHY_4,
				'selector' 		=> '{{WRAPPER}} .azt-accordion .azt-accordion-title',
			]
		);

		$this->start_controls_tabs( 'tabs_title_style' );

		$this->start_controls_tab(
			'tab_title_normal',
			[
				'label' 		=> __( 'Normal', 'sunio-elementor' ),
			]
		);

		$this->add_group_control(
			Group_Control_Background::get_type(),
			array(
				'name'     		=> 'title_background_color',
				'selector' 		=> '{{WRAPPER}} .azt-accordion .azt-accordion-title',
			)
		);

		$this->add_control(
			'title_color',
			[
				'label' 		=> __( 'Color', 'sunio-elementor' ),
				'type' 			=> Controls_Manager::COLOR,
				'selectors' 	=> [
					'{{WRAPPER}} .azt-accordion .azt-accordion-title' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name'     		=> 'title_box_shadow',
				'selector' 		=> '{{WRAPPER}} .azt-accordion .azt-accordion-item .azt-accordion-title',
				'separator' 	=> 'before',
			]
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name'        	=> 'title_border',
				'placeholder' 	=> '1px',
				'default'     	=> '1px',
				'selector'    	=> '{{WRAPPER}} .azt-accordion .azt-accordion-item .azt-accordion-title',
			]
		);

		$this->add_control(
			'title_border_radius',
			[
				'label'      	=> __( 'Border Radius', 'sunio-elementor' ),
				'type'       	=> Controls_Manager::DIMENSIONS,
				'size_units' 	=> [ 'px', '%' ],
				'selectors'  	=> [
					'{{WRAPPER}} .azt-accordion .azt-accordion-item .azt-accordion-title' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'title_padding',
			[
				'label'      	=> __( 'Padding', 'sunio-elementor' ),
				'type'       	=> Controls_Manager::DIMENSIONS,
				'size_units' 	=> [ 'px', 'em', '%' ],
				'selectors'  	=> [
					'{{WRAPPER}} .azt-accordion .azt-accordion-title' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			'tab_title_active',
			[
				'label' 		=> __( 'Active', 'sunio-elementor' ),
			]
		);

		$this->add_group_control(
			Group_Control_Background::get_type(),
			array(
				'name'     		=> 'title_active_background_color',
				'selector' 		=> '{{WRAPPER}} .azt-accordion .azt-accordion-item.azt-active .azt-accordion-title',
			)
		);

		$this->add_control(
			'title_active_color',
			[
				'label' 		=> __( 'Color', 'sunio-elementor' ),
				'type' 			=> Controls_Manager::COLOR,
				'selectors' 	=> [
					'{{WRAPPER}} .azt-accordion .azt-accordion-item.azt-active .azt-accordion-title' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name'     		=> 'title_active_box_shadow',
				'selector' 		=> '{{WRAPPER}} .azt-accordion .azt-accordion-item.azt-active .azt-accordion-title',
				'separator' 	=> 'before',
			]
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name'        	=> 'title_active_border',
				'placeholder' 	=> '1px',
				'default'     	=> '1px',
				'selector'    	=> '{{WRAPPER}} .azt-accordion .azt-accordion-item.azt-active .azt-accordion-title',
			]
		);

		$this->add_control(
			'title_active_border_radius',
			[
				'label'      	=> __( 'Border Radius', 'sunio-elementor' ),
				'type'       	=> Controls_Manager::DIMENSIONS,
				'size_units' 	=> [ 'px', '%' ],
				'selectors'  	=> [
					'{{WRAPPER}} .azt-accordion .azt-accordion-item.azt-active .azt-accordion-title' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->end_controls_tab();

		$this->end_controls_tabs();

        $this->end_controls_section();

		$this->start_controls_section(
			'section_icon_style',
			[
				'label' 		=> __( 'Icon', 'sunio-elementor' ),
				'tab' 			=> Controls_Manager::TAB_STYLE,
				'condition' 	=> [
					'icon!' => '',
				],
			]
		);

		$this->add_control(
			'icon_align',
			[
				'label'   		=> __( 'Alignment', 'sunio-elementor' ),
				'type'    		=> Controls_Manager::CHOOSE,
				'options' 		=> [
					'left' => [
						'title' => __( 'Start', 'sunio-elementor' ),
						'icon'  => 'eicon-h-align-left',
					],
					'right' => [
						'title' => __( 'End', 'sunio-elementor' ),
						'icon'  => 'eicon-h-align-right',
					],
				],
				'default'     	=> is_rtl() ? 'left' : 'right',
				'toggle'      	=> false,
				'label_block' 	=> false,
				'condition'   	=> [
					'icon!' => '',
				],
			]
		);

		$this->start_controls_tabs( 'tabs_icon_style' );

		$this->start_controls_tab(
			'tab_icon_normal',
			[
				'label' 		=> __( 'Normal', 'sunio-elementor' ),
			]
		);

		$this->add_control(
			'icon_color',
			[
				'label' 		=> __( 'Color', 'sunio-elementor' ),
				'type' 			=> Controls_Manager::COLOR,
				'condition' 	=> [
					'icon!' => '',
				],
				'selectors' 	=> [
					'{{WRAPPER}} .azt-accordion .azt-accordion-title .azt-accordion-icon i' => 'color: {{VALUE}};',
				],
			]
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			'tab_icon_active',
			[
				'label' 		=> __( 'Active', 'sunio-elementor' ),
			]
		);

		$this->add_control(
			'icon_active_color',
			[
				'label' 		=> __( 'Color', 'sunio-elementor' ),
				'type' 			=> Controls_Manager::COLOR,
				'condition' 	=> [
					'icon!' => '',
				],
				'selectors' 	=> [
					'{{WRAPPER}} .azt-accordion .azt-accordion-item.azt-active .azt-accordion-title .azt-accordion-icon i' => 'color: {{VALUE}};',
				],
			]
		);

		$this->end_controls_tab();

		$this->end_controls_tabs();

		$this->add_responsive_control(
			'icon_spacing',
			[
				'label' 		=> __( 'Spacing', 'sunio-elementor' ),
				'type' 			=> Controls_Manager::SLIDER,
				'range' 		=> [
					'px' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'condition' 	=> [
					'icon!' => '',
				],
				'selectors' 	=> [
					'{{WRAPPER}} .azt-accordion .azt-accordion-icon.azt-accordion-icon-left'  => 'margin-right: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .azt-accordion .azt-accordion-icon.azt-accordion-icon-right' => 'margin-left: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_content_style',
			[
				'label' 		=> __( 'Content', 'sunio-elementor' ),
				'tab' 			=> Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' 			=> 'content_typography',
				'scheme' 		=> Scheme_Typography::TYPOGRAPHY_4,
				'selector' 		=> '{{WRAPPER}} .azt-accordion .azt-accordion-content',
			]
		);

		$this->add_group_control(
			Group_Control_Background::get_type(),
			array(
				'name'     		=> 'content_background_color',
				'selector' 		=> '{{WRAPPER}} .azt-accordion .azt-accordion-content',
			)
		);

		$this->add_control(
			'content_color',
			[
				'label' 		=> __( 'Color', 'sunio-elementor' ),
				'type' 			=> Controls_Manager::COLOR,
				'selectors' 	=> [
					'{{WRAPPER}} .azt-accordion .azt-accordion-content' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_responsive_control(
			'content_spacing',
			[
				'label' 		=> __( 'Spacing', 'sunio-elementor' ),
				'type' 			=> Controls_Manager::SLIDER,
				'range' 		=> [
					'px' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'separator' 	=> 'before',
				'selectors' 	=> [
					'{{WRAPPER}} .azt-accordion .azt-accordion-content'  => 'margin-top: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name'     		=> 'content_box_shadow',
				'selector' 		=> '{{WRAPPER}} .azt-accordion .azt-accordion-content',
			]
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name'        	=> 'content_border',
				'placeholder' 	=> '1px',
				'default'     	=> '1px',
				'selector'    	=> '{{WRAPPER}} .azt-accordion .azt-accordion-content',
			]
		);

		$this->add_control(
			'content_border_radius',
			[
				'label'      	=> __( 'Border Radius', 'sunio-elementor' ),
				'type'       	=> Controls_Manager::DIMENSIONS,
				'size_units' 	=> [ 'px', '%' ],
				'selectors'  	=> [
					'{{WRAPPER}} .azt-accordion .azt-accordion-content' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'content_padding',
			[
				'label'      	=> __( 'Padding', 'sunio-elementor' ),
				'type'       	=> Controls_Manager::DIMENSIONS,
				'size_units' 	=> [ 'px', 'em', '%' ],
				'selectors'  	=> [
					'{{WRAPPER}} .azt-accordion .azt-accordion-content' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->end_controls_section();

	}

	protected function render() {
		$settings 	= $this->get_settings_for_display();
		$id 		= $this->get_id();
		$title_tag 	= $settings['title_html_tag'];
		$data 		= [
            'multiple' => ( 'yes' == $settings['multiple'] ) ? 'true' : 'false',
        ];

        if ( ! empty( $settings['active_item'] ) ) {
        	$data['active_item'] = $settings['active_item'];
			$this->add_render_attribute( 'wrap', 'class', 'azt-has-active-item' );
		}

		$this->add_render_attribute( 'wrap', 'id', 'azt-accordion-' . esc_attr( $id ) );
		$this->add_render_attribute( 'wrap', 'class', 'azt-accordion' );
    	$this->add_render_attribute( 'wrap', 'data-settings', wp_json_encode( $data ) ); ?>

		<div <?php echo $this->get_render_attribute_string( 'wrap' ); ?>>

			<?php
			foreach ( $settings['tabs'] as $index => $item ) :
				$tab_count 			= $index + 1;
				$tab_title_key 		= $this->get_repeater_setting_key( 'tab_title', 'tabs', $index );
				$tab_content_key 	= $this->get_repeater_setting_key( 'tab_content', 'tabs', $index );

				$this->add_render_attribute( $tab_title_key, 'class', 'azt-accordion-title' );
				$this->add_render_attribute( $tab_content_key, 'class', 'azt-accordion-content' );
				$this->add_inline_editing_attributes( $tab_content_key, 'advanced' ); ?>

				<div class="azt-accordion-item<?php echo ( $tab_count === $settings['active_item'] ) ? ' azt-active' : ''; ?>">
					<<?php echo $title_tag; ?> <?php echo $this->get_render_attribute_string( $tab_title_key ); ?>>
						<?php
						if ( $settings['icon'] ) { ?>
							<span class="azt-accordion-icon azt-accordion-icon-<?php echo esc_attr( $settings['icon_align'] ); ?>" aria-hidden="true">
								<i class="azt-accordion-icon-closed <?php echo esc_attr( $settings['icon'] ); ?>"></i>
								<i class="azt-accordion-icon-opened <?php echo esc_attr( $settings['active_icon'] ); ?>"></i>
							</span>
						<?php
						} ?>

						<?php echo $item['tab_title']; ?>
					</<?php echo $title_tag; ?>>

					<div <?php echo $this->get_render_attribute_string( $tab_content_key ); ?>>
						<?php
		            	if ( 'custom' == $item['source']
		            		&& ! empty( $item['tab_content'] ) ) {
		            		echo wp_kses_post( $item['tab_content'] );
		            	} else if ( 'template' == $item['source']
		            		&& ( '0' != $item['templates'] && ! empty( $item['templates'] ) ) ) {
		            		echo Plugin::instance()->frontend->get_builder_content_for_display( $item['templates'] );
		            	} ?>
					</div>
				</div>
			<?php
			endforeach; ?>

		</div>

	<?php
	}
}