<?php

use Elementor\Group_Control_Typography;
use Elementor\Utils;
use Elementor\Widget_Base;
use Elementor\Controls_Manager;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

class EFA_Widget_Book_Curriculum extends Widget_Base {

	// widget name
	public function get_name(): string {
		return 'efa-book-curriculum';
	}

	// widget title
	public function get_title(): string {
		return esc_html__( 'Đặt mua giáo trình', 'essential-features-addon' );
	}

	// widget icon
	public function get_icon(): string {
		return 'eicon-section';
	}

	// widget categories
	public function get_categories(): array {
		return array( 'efa-addons' );
	}

	// widget keywords
	public function get_keywords(): array {
		return [ 'booking'];
	}

	// widget controls
	protected function register_controls(): void {
		// Image or icon
		$this->start_controls_section(
			'image_section',
			[
				'label' => esc_html__( 'Hình ảnh', 'essential-features-addon' ),
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
				'label_block' => true,
			]
		);

		$this->add_control(
			'image',
			[
				'label'   => esc_html__( 'Chọn ảnh', 'essential-features-addon' ),
				'type'    => Controls_Manager::MEDIA,
				'default' => [
					'url' => Utils::get_placeholder_image_src(),
				],
			]
		);

		$this->end_controls_section();

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
				'default'     => esc_html__( 'Học qua giáo trình được xây dựng sẵn', 'essential-features-addon' ),
				'label_block' => true
			]
		);

		$this->add_control(
			'html_tag',
			[
				'label'   => esc_html__( 'HTML Tag', 'essential-features-addon' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'h2',
				'options' => [
					'h1' => 'H1',
					'h2' => 'H2',
					'h3' => 'H3',
					'h4' => 'H4',
					'h5' => 'H5',
					'h6' => 'H6'
				],
			]
		);

		$this->add_control(
			'description',
			[
				'label'   => esc_html__( 'Văn bản', 'essential-features-addon' ),
				'type'    => Controls_Manager::WYSIWYG,
				'default' => esc_html__( '"Giáo trình UI/UX được xây dựng sẵn, thiết kế bài bản từ cơ bản đến nâng cao, giúp bạn học đúng lộ trình và tiết kiệm thời gian."', 'essential-features-addon' ),
			]
		);

		$this->end_controls_section();

		// preview link
		$this->start_controls_section(
			'content_preview_link',
			[
				'label' => esc_html__( 'Xem trước', 'essential-features-addon' ),
				'tab'   => Controls_Manager::TAB_CONTENT,
			]
		);

		$this->add_control(
			'preview_text',
			[
				'label'       => esc_html__( 'Tiêu đề', 'essential-features-addon' ),
				'type'        => Controls_Manager::TEXT,
				'default'     => esc_html__( 'Xem trước giáo trình', 'essential-features-addon' ),
				'label_block' => true
			]
		);

		$this->add_control(
			'preview_link',
			[
				'label'       => esc_html__( 'Url xem trước', 'essential-features-addon' ),
				'type'        => Controls_Manager::URL,
				'placeholder' => esc_html__( 'https://your-link.com', 'essential-features-addon' ),
				'default'     => [
					'url' => '#',
					'is_external' => true,
				],
			]
		);

		$this->end_controls_section();

		// contact link
		$this->start_controls_section(
			'content_contact_link',
			[
				'label' => esc_html__( 'Liên hệ', 'essential-features-addon' ),
				'tab'   => Controls_Manager::TAB_CONTENT,
			]
		);

		$this->add_control(
			'contact_text',
			[
				'label'       => esc_html__( 'Tiêu đề', 'essential-features-addon' ),
				'type'        => Controls_Manager::TEXT,
				'default'     => esc_html__( 'Liên hệ ngay', 'essential-features-addon' ),
				'label_block' => true
			]
		);

		$this->add_control(
			'contact_link',
			[
				'label'       => esc_html__( 'Url xem trước', 'essential-features-addon' ),
				'type'        => Controls_Manager::URL,
				'placeholder' => esc_html__( 'https://your-link.com', 'essential-features-addon' ),
				'default'     => [
					'url' => 'https://zalo.me/2127558141747969331?src=qr',
					'is_external' => true,
				],
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

		$this->add_control(
			'heading_color',
			[
				'label'     => esc_html__( 'Màu', 'essential-features-addon' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .efa-addon-image-text-block .content-box .heading' => 'color: {{VALUE}}',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'heading_typography',
				'label'    => esc_html__( 'Kiểu chữ', 'essential-features-addon' ),
				'selector' => '{{WRAPPER}} .efa-addon-image-text-block .content-box .heading',
			]
		);

		$this->end_controls_section();

		// Style Heading
		$this->start_controls_section(
			'style_description',
			[
				'label' => esc_html__( 'Văn bản', 'essential-features-addon' ),
				'tab'   => Controls_Manager::TAB_STYLE
			]
		);

		$this->add_control(
			'desc_color',
			[
				'label'     => esc_html__( 'Color', 'essential-features-addon' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .efa-addon-image-text-block .content-box .desc' => 'color: {{VALUE}}',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'desc_typography',
				'label'    => esc_html__( 'Kiểu chữ', 'essential-features-addon' ),
				'selector' => '{{WRAPPER}} .efa-addon-image-text-block .content-box .desc',
			]
		);

		$this->end_controls_section();
	}

	// widget output on the frontend
	protected function render(): void {
		$settings      = $this->get_settings_for_display();
		$tag           = $settings['html_tag'];
		$image         = $settings['image'];
		$image_size    = $settings['image_size'];

		// preview link
		if ( ! empty( $settings['preview_link']['url'] ) ) {
			$this->add_link_attributes( 'preview_link', $settings['preview_link'] );
		}

		// contact link
		if ( ! empty( $settings['contact_link']['url'] ) ) {
			$this->add_link_attributes( 'contact_link', $settings['contact_link'] );
		}
		?>
		<div class="efa-addon-book-curriculum">
			<div class="image-box">
				<?php echo wp_get_attachment_image( $image['id'], $image_size ); ?>
			</div>

			<div class="content-box">
				<?php if ( $settings['heading'] ) : ?>
					<<?php echo esc_html( $tag ); ?> class="heading">
						<?php echo esc_html( $settings['heading'] ); ?>
					</<?php echo esc_html( $tag ); ?>>
				<?php endif; ?>

				<?php if ( ! empty( $settings['description'] ) ) : ?>
					<div class="desc">
						<?php echo wpautop( $settings['description'] ); ?>
					</div>
				<?php endif; ?>

				<div class="action-box">
					<a class="btn-link preview-link" <?php $this->print_render_attribute_string( 'preview_link' ); ?>>
						<span class="text"><?php echo esc_html( $settings['preview_text'] ); ?></span>
					</a>

					<a class="btn-link contact-link" <?php $this->print_render_attribute_string( 'contact_link' ); ?>>
						<span class="text"><?php echo esc_html( $settings['contact_text'] ); ?></span>
						<i class="fas fa-arrow-right-long"></i>
					</a>
				</div>
			</div>
		</div>
		<?php
	}

	protected function content_template() {
	?>
        <div class="efa-addon-book-curriculum">
            <div class="image-box">
                <# if ( settings.image.url ) { #>
                <img src="{{ settings.image.url }}" class="{{ settings.image_size }}">
                <# } #>
            </div>

            <div class="content-box">
                <# if ( settings.heading ) { #>
                <{{{ settings.html_tag }}} class="heading">{{{ settings.heading }}}</{{{ settings.html_tag }}}>
                <# } #>

                <# if ( settings.description ) { #>
                <div class="desc">{{{ settings.description }}}</div>
                <# } #>

                <div class="action-box">
                    <# if ( settings.preview_link.url ) { #>
                    <a class="btn-link preview-link" href="{{ settings.preview_link.url }}">
                        <span class="text">{{ settings.preview_text }}</span>
                    </a>
                    <# } #>

                    <# if ( settings.contact_link.url ) { #>
                    <a class="btn-link contact-link" href="{{ settings.contact_link.url }}">
                        <span class="text">{{ settings.contact_text }}</span>
                        <i class="fas fa-arrow-right-long"></i>
                    </a>
                    <# } #>
                </div>
            </div>
        </div>
	<?php
	}
}