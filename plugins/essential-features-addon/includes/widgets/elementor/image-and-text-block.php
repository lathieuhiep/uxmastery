<?php

use Elementor\Group_Control_Typography;
use Elementor\Utils;
use Elementor\Widget_Base;
use Elementor\Controls_Manager;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

class EFA_Widget_Image_And_Text_Block extends Widget_Base {

	// widget name
	public function get_name(): string {
		return 'efa-image-and-text-block';
	}

	// widget title
	public function get_title(): string {
		return esc_html__( 'Hình Ảnh & Nội Dung', 'essential-features-addon' );
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
		return [ 'image', 'editor', 'text' ];
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
			'icon_or_image',
			[
				'label'       => esc_html__( 'Icon hoặc ảnh', 'essential-features-addon' ),
				'type'        => Controls_Manager::SELECT,
				'default'     => 'icon',
				'options'     => [
					'icon'  => esc_html__( 'Dùng icon', 'essential-features-addon' ),
					'image' => esc_html__( 'Dùng ảnh', 'essential-features-addon' )
				],
				'label_block' => true
			]
		);

		$this->add_control(
			'icon',
			[
				'label'       => esc_html__( 'Chọn icon', 'essential-features-addon' ),
				'type'        => Controls_Manager::SELECT2,
				'options'     => efa_flaticon_icons(),
				'multiple'    => false,
				'label_block' => true,
				'condition' => [
					'icon_or_image' => 'icon',
				],
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
				'condition' => [
					'icon_or_image' => 'image',
				],
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
				'condition' => [
					'icon_or_image' => 'image',
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
				'default' => esc_html__( 'Nội dung văn bản', 'essential-features-addon' ),
			]
		);

		$this->end_controls_section();

        // layout settings
		$this->start_controls_section(
			'content_layout_section',
			[
				'label' => esc_html__( 'Bố cục', 'essential-features-addon' ),
				'tab'   => Controls_Manager::TAB_CONTENT,
			]
		);

		$this->add_responsive_control(
			'columns_grid',
			[
				'label' => esc_html__( 'Cột', 'clinic' ),
				'type' => Controls_Manager::SLIDER,
				'range' => [
					'fr' => [
						'min' => 1,
						'max' => 12,
						'step' => 1,
					],
				],
				'size_units' => [ 'fr', 'custom' ],
				'unit_selectors_dictionary' => [
					'custom' => 'grid-template-columns: {{SIZE}}',
				],
				'default' => [
					'unit' => 'fr',
					'size' => 2,
				],
				'mobile_default' => [
					'unit' => 'fr',
					'size' => 1,
				],
				'selectors' => [
					'{{WRAPPER}} .efa-addon-image-text-block:has(.select-box)' => 'grid-template-columns: repeat({{SIZE}}, 1fr)',
				],
				'responsive' => true,
				'editor_available' => true,
			]
		);

		$this->add_responsive_control(
			'row_gap',
			[
				'label' => __( 'Khoảng cách hàng', 'essential-features-addon' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px', 'em', 'rem' ],
				'default' => [
					'size' => 2.4,
					'unit' => 'rem',
				],
				'selectors' => [
					'{{WRAPPER}} .efa-addon-image-text-block:has(.select-box)' => 'row-gap: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'column_gap',
			[
				'label' => __( 'Khoảng cách cột (Column Gap)', 'essential-features-addon' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px', 'em', 'rem' ],
				'default' => [
					'size' => 3.6,
					'unit' => 'rem',
				],
				'selectors' => [
					'{{WRAPPER}} .efa-addon-image-text-block:has(.select-box)' => 'column-gap: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->end_controls_section();

        // Style Icon
		$this->start_controls_section(
			'style_icon',
			[
				'label' => esc_html__( 'Icon', 'essential-features-addon' ),
				'tab'   => Controls_Manager::TAB_STYLE,
                'condition' => [
                    'icon_or_image' => 'icon',
                ],
			]
		);

		$this->add_control(
			'icon_color',
			[
				'label'     => esc_html__( 'Màu', 'essential-features-addon' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .efa-addon-image-text-block .select-box.icon-box' => '--efa-icon-color: {{VALUE}}',
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
		$icon_or_image = $settings['icon_or_image'];
		$icon          = $settings['icon'];
		$image         = $settings['image'];
		$image_size    = $settings['image_size'];
		?>
        <div class="efa-addon-image-text-block">
            <?php if ( ($icon_or_image == 'icon' && $icon) || ( $icon_or_image == 'image' && $image && $image['id'] ) ) : ?>
                <div class="select-box <?php echo esc_attr( $icon_or_image ); ?>-box">
                    <?php if ( $icon_or_image == 'icon' && $icon ) : ?>
                        <i class="icon <?php echo esc_attr( $icon ); ?>"></i>
                    <?php endif; ?>

	                <?php if ( $icon_or_image == 'image' && $image['id'] ) : ?>
		                <?php echo wp_get_attachment_image( $image['id'], $image_size, false, array('class' => 'icon') ); ?>
	                <?php endif; ?>
                </div>
            <?php endif; ?>

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
            </div>
        </div>
		<?php
	}

	protected function content_template() {
		?>
        <#
        var iconOrImage = settings.icon_or_image;
        var icon = settings.icon;
        var image = settings.image;
        var imageSize = settings.image_size;
        var heading = settings.heading;
        var description = settings.description;
        var tag = settings.html_tag || 'h2'; // Nếu không có tag, mặc định là h2
        #>
        <div class="efa-addon-image-text-block">
            <# if ( ( iconOrImage == 'icon' && icon ) || ( iconOrImage == 'image' && image && image.id ) ) { #>
            <div class="select-box {{ iconOrImage }}-box">
                <# if ( iconOrImage == 'icon' && icon ) { #>
                <i class="icon {{ icon }}"></i>
                <# } #>

                <# if ( iconOrImage == 'image' && image.id ) { #>
                <img src="{{ image.url }}" alt="{{ image.alt }}" class="icon attachment-{{ imageSize }}" />
                <# } #>
            </div>
            <# } #>

            <div class="content-box">
                <# if ( heading ) { #>
                    <{{ tag }} class="heading">{{{ heading }}}</{{ tag }}>
                <# } #>

                <# if ( description ) { #>
                <div class="desc">
                    {{{ description }}}
                </div>
            <# } #>
        </div>
        </div>
		<?php
	}
}