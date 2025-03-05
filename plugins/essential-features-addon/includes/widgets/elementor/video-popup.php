<?php

use Elementor\Utils;
use Elementor\Widget_Base;
use Elementor\Controls_Manager;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

class EFA_Widget_Video_Popup extends Widget_Base {

	// widget name
	public function get_name(): string {
		return 'efa-video-popup';
	}

	// widget title
	public function get_title(): string {
		return esc_html__( 'Video Popup', 'essential-features-addon' );
	}

	// widget icon
	public function get_icon(): string {
		return 'eicon-youtube';
	}

	// widget categories
	public function get_categories(): array {
		return array( 'efa-addons' );
	}

	// widget style dependencies
	public function get_style_depends(): array {
		return [ 'lity' ];
	}

	// widget scripts dependencies
	public function get_script_depends(): array {
		return [ 'lity' ];
	}

	// widget keywords
	public function get_keywords(): array {
		return [ 'video', 'popup' ];
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

		$this->add_control(
			'video_url',
			[
				'label'       => esc_html__( 'URL Video', 'essential-features-addon' ),
				'type'        => Controls_Manager::TEXT,
				'placeholder' => esc_html__( 'https://www.youtube.com/watch?v=video_id', 'essential-features-addon' ),
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
		<div class="efa-addon-video-popup">
			<div class="bg-video">
				<?php echo wp_get_attachment_image( $image['id'], $image_size ); ?>
			</div>

			<a class="btn-video-popup" href="<?php echo esc_url( $settings['video_url'] ); ?>" data-lity>
				<i class="fas fa-play"></i>
			</a>
		</div>
	<?php
	}
}