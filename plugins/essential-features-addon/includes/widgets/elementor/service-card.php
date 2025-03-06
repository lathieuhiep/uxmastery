<?php

use Elementor\Utils;
use Elementor\Widget_Base;
use Elementor\Controls_Manager;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

class EFA_Widget_Service_Card extends Widget_Base {

	// widget name
	public function get_name(): string {
		return 'efa-service-card';
	}

	// widget title
	public function get_title(): string {
		return esc_html__( 'Card', 'essential-features-addon' );
	}

	// widget icon
	public function get_icon(): string {
		return 'eicon-clone';
	}

	// widget categories
	public function get_categories(): array {
		return array( 'efa-addons' );
	}

	// widget scripts dependencies
	public function get_script_depends(): array {
		return [ 'counterup', 'efa-elementor-script' ];
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

		$this->add_control(
			'image_size',
			[
				'label'       => esc_html__( 'Độ phân giải ảnh', 'lpbcolor' ),
				'type'        => Controls_Manager::SELECT,
				'default'     => 'large',
				'options'     => efa_image_size_options(),
				'label_block' => true
			]
		);

		$this->add_control(
			'image',
			[
				'label'   => esc_html__( 'Chọn ảnh', 'essential-features-addon' ),
				'type'    => Controls_Manager::MEDIA,
				'default' => [
					'url' => Utils::get_placeholder_image_src(),
				]
			]
		);

		$this->add_responsive_control(
			'height',
			[
				'label'      => esc_html__( 'Kích thước', 'essential-features-addon' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => [ 'px', 'em', 'rem' ],
				'range'      => [
					'px' => [
						'min' => 10,
						'max' => 1000,
					],
				],
				'default' => [
					'unit' => 'px',
					'size' => 420,
				],
				'selectors'  => [
					'{{WRAPPER}} .efa-addon-service-card__image' => 'height: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->end_controls_section();

		// counter section
		$this->start_controls_section(
			'counter_section',
			[
				'label' => esc_html__( 'Số liệu', 'essential-features-addon' ),
				'tab'   => Controls_Manager::TAB_CONTENT,
			]
		);

		$this->add_control(
			'counter',
			[
				'label'       => esc_html__( 'Số liệu', 'essential-features-addon' ),
				'type'        => Controls_Manager::NUMBER,
				'default'     => 25,
				'label_block' => false
			]
		);

		$this->add_control(
			'counter_text',
			[
				'label'       => esc_html__( 'Văn bản', 'essential-features-addon' ),
				'type'        => Controls_Manager::TEXT,
				'default'     => '',
				'label_block' => true
			]
		);

		$this->end_controls_section();
	}

	// widget output on the frontend
	protected function render(): void {
		$settings   = $this->get_settings_for_display();
		$image      = $settings['image'];
		$image_size = $settings['image_size'];
    ?>
		<div class="efa-addon-service-card">
            <div class="efa-addon-service-card__image">
	            <?php echo wp_get_attachment_image( $image['id'], $image_size ); ?>
            </div>

            <div class="efa-addon-service-card__counters">
                <div class="counters">
                    <div class="counting-holder">
                        <span class="counting"><?php echo esc_html( $settings['counter'] ); ?></span>+
                    </div>

                    <p class="counting-desc"><?php echo esc_html( $settings['counter_text'] ); ?></p>
                </div>
            </div>
        </div>
    <?php
	}

	protected function content_template() {
    ?>
        <#
        var image = settings.image;
        var imageSize = settings.image_size;
        var counter = settings.counter;
        var counterText = settings.counter_text;
        #>
        <div class="efa-addon-service-card">
            <# if (image && image.id) { #>
            <div class="efa-addon-service-card__image">
                <img src="{{ image.url }}" alt="Service" class="attachment-{{ imageSize }}" />
            </div>
            <# } #>

            <div class="efa-addon-service-card__counters">
                <div class="counters">
                    <div class="counting-holder">
                        <span class="counting">{{ counter }}</span>+
                    </div>
                    <p class="counting-desc">{{ counterText }}</p>
                </div>
            </div>
        </div>
		<?php
	}
}