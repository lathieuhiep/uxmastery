<?php

use Elementor\Group_Control_Typography;
use Elementor\Widget_Base;
use Elementor\Controls_Manager;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

class EFA_Widget_Hero extends Widget_Base {

	// widget name
	public function get_name(): string {
		return 'efa-hero';
	}

	// widget title
	public function get_title(): string {
		return esc_html__( 'Hero', 'essential-features-addon' );
	}

	// widget icon
	public function get_icon(): string {
		return 'eicon-form-horizontal';
	}

	// widget categories
	public function get_categories(): array {
		return array( 'efa-addons' );
	}

	// widget keywords
	public function get_keywords(): array {
		return [ 'contact' ];
	}

	// widget controls
	protected function register_controls(): void {
		// content section
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

		$this->add_control(
			'description',
			[
				'label'   => esc_html__( 'Văn bản', 'essential-features-addon' ),
				'type'    => Controls_Manager::WYSIWYG,
				'default' => esc_html__( 'Nội dung văn bản', 'essential-features-addon' ),
			]
		);

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

		// contact form section
		$this->start_controls_section(
			'contact_form_section',
			[
				'label' => esc_html__( 'Form liên hệ', 'essential-features-addon' ),
				'tab'   => Controls_Manager::TAB_CONTENT,
			]
		);

		$this->add_control(
			'cf_heading',
			[
				'label'       => esc_html__( 'Tiêu đề', 'essential-features-addon' ),
				'type'        => Controls_Manager::TEXT,
				'default'     => esc_html__( 'Tiêu đề', 'essential-features-addon' ),
				'label_block' => true
			]
		);

		$this->add_control(
			'cf_desc',
			[
				'label'   => esc_html__( 'Văn bản', 'essential-features-addon' ),
				'type'    => Controls_Manager::TEXTAREA,
				'default' => esc_html__( 'Nội dung văn bản', 'essential-features-addon' ),
			]
		);

		$this->add_control(
			'contact_form_list',
			[
				'label'       => esc_html__( 'Chọn mẫu liên hệ', 'essential-features-addon' ),
				'type'        => Controls_Manager::SELECT,
				'label_block' => true,
				'options'     => efa_get_form_cf7(),
				'default'     => '0',
			]
		);

		$this->end_controls_section();

		// style heading
		$this->start_controls_section(
			'style_heading',
			[
				'label' => esc_html__( 'Tiêu đề', 'essential-features-addon' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'heading_color',
			[
				'label'     => esc_html__( 'Màu', 'essential-features-addon' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .efa-addon-hero .box-content .headline' => 'color: {{VALUE}}',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'heading_typography',
				'label'    => esc_html__( 'Kiểu chữ', 'essential-features-addon' ),
				'selector' => '{{WRAPPER}} .efa-addon-hero .box-content .headline',
			]
		);

		$this->end_controls_section();

		// style desc
		$this->start_controls_section(
			'style_desc',
			[
				'label' => esc_html__( 'Nội dung', 'essential-features-addon' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'desc_color',
			[
				'label'     => esc_html__( 'Màu', 'essential-features-addon' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .efa-addon-hero .box-content .bio' => 'color: {{VALUE}}',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'desc_typography',
				'label'    => esc_html__( 'Kiểu chữ', 'essential-features-addon' ),
				'selector' => '{{WRAPPER}} .efa-addon-hero .box-content .bio',
			]
		);

		$this->end_controls_section();

		// style icon
		$this->start_controls_section(
			'style_icon',
			[
				'label' => esc_html__( 'Icon', 'essential-features-addon' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'icon_color',
			[
				'label'     => esc_html__( 'Màu', 'essential-features-addon' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .efa-icon-mask' => '--efa-icon-color: {{VALUE}}',
				],
			]
		);

		$this->end_controls_section();

		// style heading cf7
		$this->start_controls_section(
			'style_cf_heading',
			[
				'label' => esc_html__( 'Tiêu đề form', 'essential-features-addon' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'cf_heading_color',
			[
				'label'     => esc_html__( 'Màu', 'essential-features-addon' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .popup-contact-form .box-heading .cf-heading' => '--efa-heading-color: {{VALUE}}',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'cf_heading_typography',
				'label'    => esc_html__( 'Kiểu chữ', 'essential-features-addon' ),
				'selector' => '{{WRAPPER}} .popup-contact-form .box-heading .cf-heading',
			]
		);

		$this->end_controls_section();

		// style desc cf7
		$this->start_controls_section(
			'style_cf_desc',
			[
				'label' => esc_html__( 'Văn bản form', 'essential-features-addon' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'cf_desc_color',
			[
				'label'     => esc_html__( 'Màu', 'essential-features-addon' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .popup-contact-form .box-heading .cf-desc' => 'color: {{VALUE}}',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'cf_desc_typography',
				'label'    => esc_html__( 'Kiểu chữ', 'essential-features-addon' ),
				'selector' => '{{WRAPPER}} .popup-contact-form .box-heading .cf-desc',
			]
		);

		$this->end_controls_section();

        // style contact form
        $this->start_controls_section(
            'style_contact_form',
            [
                'label' => esc_html__( 'Form liên hệ', 'essential-features-addon' ),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'btn_submit_color',
            [
                'label'     => esc_html__( 'Màu chữ nút submit', 'essential-features-addon' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .popup-contact-form .wpcf7-form .wpcf7-submit' => 'color: {{VALUE}}',
                ],
            ]
        );

		$this->add_control(
			'btn_submit_bk_color',
			[
				'label'     => esc_html__( 'Màu nền nút submit', 'essential-features-addon' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .popup-contact-form .wpcf7-form .wpcf7-submit' => 'background-color: {{VALUE}}',
				],
			]
		);

        $this->end_controls_section();
	}

	// widget output on the frontend
	protected function render(): void {
		$settings   = $this->get_settings_for_display();
		$tag        = $settings['html_tag'];
		$desc       = $settings['description'];
		$cf7        = $settings['contact_form_list'];
		$cf_heading = $settings['cf_heading'];
		$cf_desc    = $settings['cf_desc'];

		if ( ! empty( $settings['link']['url'] ) ) {
			$this->add_link_attributes( 'link', $settings['link'] );
		}
		?>
        <div class="efa-addon-hero">
            <div class="box-item box-content">
				<?php if ( $settings['heading'] ) : ?>
                    <<?php echo esc_html( $tag ); ?> class="headline fly-up-title" data-text="<?php echo esc_attr( $settings['heading'] ); ?>"></<?php echo esc_html( $tag ); ?>>
			    <?php endif; ?>

			<?php if ( ! empty( $desc ) ) : ?>
                <div class="bio">
					<?php echo wpautop( $desc ); ?>
                </div>
			<?php endif; ?>

            <a class="scroll-to" <?php $this->print_render_attribute_string( 'link' ); ?>>
                <i class="efa-icon-mask efa-icon-mask-down-chevron"></i>
            </a>
        </div>

        <div class="box-item box-action">
            <div class="popup-contact-form">
                <div class="box-heading">
                    <div class="cf-heading heading-title">
						<?php echo esc_html( $cf_heading ); ?>
                    </div>

                    <div class="cf-desc">
						<?php echo esc_html( $cf_desc ); ?>
                    </div>
                </div>

				<?php
				if ( $cf7 ) :
					echo do_shortcode( '[contact-form-7 id="' . $settings['contact_form_list'] . '" ]' );
				endif;
				?>
            </div>
        </div>
        </div>
		<?php
	}
}