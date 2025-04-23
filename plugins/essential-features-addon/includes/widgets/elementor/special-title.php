<?php

use Elementor\Group_Control_Typography;
use Elementor\Widget_Base;
use Elementor\Controls_Manager;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

class EFA_Widget_Special_Title extends Widget_Base {

	// widget name
	public function get_name(): string {
		return 'efa-special-title';
	}

	// widget title
	public function get_title(): string {
		return esc_html__( 'Tiêu đề đặc biệt', 'essential-features-addon' );
	}

	// widget icon
	public function get_icon(): string {
		return 'eicon-pencil';
	}

	// widget categories
	public function get_categories(): array {
		return array( 'efa-addons' );
	}

	// widget keywords
	public function get_keywords(): array
	{
		return ['heading', 'text'];
	}

	// widget controls
	protected function register_controls(): void {
		// Content
		$this->start_controls_section(
			'content_section',
			[
				'label' => esc_html__( 'Nội dung', 'essential-features-addon' ),
				'tab'   => Controls_Manager::TAB_CONTENT,
			]
		);

		$this->add_control(
			'heading',
			[
				'label'       => esc_html__( 'Tiêu đề', 'essential-features-addon' ),
				'type'        => Controls_Manager::TEXT,
				'default'     => esc_html__( 'Tiêu đề', 'essential-features-addon' ),
				'label_block' => true
			]
		);

		$this->add_control(
			'html_tag',
			[
				'label'   => esc_html__( 'HTML Tag', 'essential-features-addon' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'h2',
				'options' => efa_html_tag_heading(),
			]
		);

		$this->end_controls_section();

		// Style Heading
		$this->start_controls_section(
			'style_heading',
			[
				'label' => esc_html__( 'Tiêu đề', 'essential-features-addon' ),
				'tab'   => Controls_Manager::TAB_STYLE
			]
		);

		$this->add_responsive_control(
			'heading_margin',
			[
				'label' => esc_html__('Margin', 'essential-features-addon'),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%', 'em'],
				'selectors' => [
					'{{WRAPPER}} .efa-addon-special-title .heading' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			'heading_color',
			[
				'label'     => esc_html__( 'Màu', 'essential-features-addon' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .efa-addon-special-title .heading' => 'color: {{VALUE}}',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'heading_typography',
				'label'    => esc_html__( 'Kiểu chữ', 'essential-features-addon' ),
				'selector' => '{{WRAPPER}} .efa-addon-special-title .heading',
			]
		);

		$this->end_controls_section();

		// Style line
		$this->start_controls_section(
			'style_line',
			[
				'label' => esc_html__( 'Đường kẻ', 'essential-features-addon' ),
				'tab'   => Controls_Manager::TAB_STYLE
			]
		);

		$this->add_control(
			'line_color',
			[
				'label'     => esc_html__( 'Màu', 'essential-features-addon' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .efa-addon-special-title .heading::before' => 'background-color: {{VALUE}}',
				],
			]
		);

		$this->end_controls_section();
	}

	// widget output on the frontend
	protected function render(): void {
		$settings = $this->get_settings_for_display();
		$tag = $settings['html_tag'];
	?>
		<div class="efa-addon-special-title">
			<<?php echo esc_html( $tag ); ?> class="heading">
				<?php echo esc_html( $settings['heading'] ); ?>
			</<?php echo esc_html( $tag ); ?>>
		</div>
	<?php
	}

	protected function content_template() {
	?>
		<#
		var tag = settings.html_tag;
		#>

		<div class="efa-addon-special-title">
			<{{{ tag }}} class="heading">
				{{{ settings.heading }}}
			</{{{ tag }}}>
		</div>
		<?php
	}

}