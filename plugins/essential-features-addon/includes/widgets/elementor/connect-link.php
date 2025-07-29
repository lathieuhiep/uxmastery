<?php

use Elementor\Group_Control_Typography;
use Elementor\Icons_Manager;
use Elementor\Utils;
use Elementor\Widget_Base;
use Elementor\Controls_Manager;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

class EFA_Widget_Connect_Link extends Widget_Base {

	// widget name
	public function get_name(): string {
		return 'efa-connect-link';
	}

	// widget title
	public function get_title(): string {
		return esc_html__( 'Link kết nối', 'essential-features-addon' );
	}

	// widget icon
	public function get_icon(): string {
		return 'eicon-editor-link';
	}

	// widget categories
	public function get_categories(): array {
		return array( 'efa-addons' );
	}

	// widget keywords
	public function get_keywords(): array {
		return [ 'link', 'connect' ];
	}

	// widget controls
	protected function register_controls(): void {
		// Content section
		$this->start_controls_section(
			'content_section',
			[
				'label' => esc_html__( 'Nội dung', 'essential-features-addon' ),
				'tab'   => Controls_Manager::TAB_CONTENT,
			]
		);

		// icons
		$this->add_control(
			'icon',
			[
				'label'   => esc_html__( 'Icon', 'essential-features-addon' ),
				'type'    => Controls_Manager::ICONS,
				'default' => [
					'value' => 'fas fa-link',
					'library' => 'fa-solid',
				],
			]
		);

		// text
		$this->add_control(
			'text',
			[
				'label'       => esc_html__( 'Text', 'essential-features-addon' ),
				'type'        => Controls_Manager::TEXT,
				'default'     => esc_html__( 'Connect', 'essential-features-addon' ),
				'placeholder' => esc_html__( 'Connect', 'essential-features-addon' ),
			]
		);

		// link
		$this->add_control(
			'link',
			[
				'label'       => esc_html__( 'Link', 'essential-features-addon' ),
				'type'        => Controls_Manager::URL,
				'placeholder' => esc_html__( 'https://your-link.com', 'essential-features-addon' ),
				'default'     => [
					'url' => '#',
				],
			]
		);

		$this->end_controls_section();

		// Style text
		$this->start_controls_section(
			'style_text',
			[
				'label' => esc_html__( 'Văn bản', 'essential-features-addon' ),
				'tab'   => Controls_Manager::TAB_STYLE
			]
		);

		$this->add_control(
			'text_color',
			[
				'label'     => esc_html__( 'Màu', 'essential-features-addon' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .efa-addon-connect-link .link' => 'color: {{VALUE}}',
					'{{WRAPPER}} .efa-addon-connect-link .link svg' => 'fill: {{VALUE}}',
				],
			]
		);

		$this->add_control(
			'text_color_hover',
            [
                'label'     => esc_html__( 'Màu khi di chuột', 'essential-features-addon' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .efa-addon-connect-link .link:hover' => 'color: {{VALUE}}',
                    '{{WRAPPER}} .efa-addon-connect-link .link:hover svg' => 'fill: {{VALUE}}',
                    '{{WRAPPER}} .efa-addon-connect-link .link:hover .text::before' => 'background-color: {{VALUE}}',
                ],
            ]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'text_typography',
				'label'    => esc_html__( 'Kiểu chữ', 'essential-features-addon' ),
				'selector' => '{{WRAPPER}} .efa-addon-connect-link .link',
			]
		);

		$this->add_control(
			'size',
			[
				'label'      => esc_html__( 'Kích thước', 'essential-features-addon' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => [ 'px', 'em', 'rem' ],
				'range'      => [
					'px' => [
						'min' => 10,
						'max' => 100,
					],
				],
				'default' => [
					'unit' => 'px',
					'size' => 16,
				],
				'selectors'  => [
					'{{WRAPPER}} .efa-addon-connect-link .link svg' => 'width: {{SIZE}}{{UNIT}}; height: {{SIZE}}{{UNIT}}; line-height: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->end_controls_section();
	}

	// widget output on the frontend
	protected function render(): void {
		$settings   = $this->get_settings_for_display();
		$text       = $settings['text'];

		if ( ! empty( $settings['link']['url'] ) ) {
			$this->add_link_attributes( 'link', $settings['link'] );
		}
		?>
		<div class="efa-addon-connect-link">
			<a class="link" <?php $this->print_render_attribute_string( 'link' ); ?>>
				<span class="text"><?php echo esc_html($text); ?></span>
				<?php Icons_Manager::render_icon( $settings['icon'], [ 'aria-hidden' => 'true' ] ); ?>
			</a>
		</div>
		<?php
	}

    protected function content_template() {
    ?>
        <#
        var text = settings.text;
        const iconHTML = elementor.helpers.renderIcon( view, settings.icon, { 'aria-hidden': true }, 'i' , 'object' );
        #>
        <div class="efa-addon-connect-link">
            <a class="link" href="{{ settings.link.url }}">
                <span class="text">{{ text }}</span>
                {{{ iconHTML.value }}}
            </a>
        </div>
    <?php
    }
}