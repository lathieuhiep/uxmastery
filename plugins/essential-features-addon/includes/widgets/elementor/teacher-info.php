<?php

use Elementor\Group_Control_Typography;
use Elementor\Widget_Base;
use Elementor\Controls_Manager;

if ( ! defined( 'ABSPATH' ) ) exit;

class EFA_Widget_Teacher_Info extends Widget_Base {

    public function get_name(): string
    {
        return 'efa-teacher-info';
    }

    public function get_title(): string
    {
        return esc_html__( 'Thông tin giảng viên', 'essential-features-addon' );
    }

    public function get_icon(): string
    {
        return 'eicon-person';
    }

    public function get_categories(): array
    {
        return [ 'efa-addons' ];
    }

    protected function register_controls(): void
    {
        // section content
        $this->start_controls_section(
            'section_content',
            [
                'label' => esc_html__( 'Nội dung', 'essential-features-addon' ),
                'tab'   => Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'avatar',
            [
                'label'   => esc_html__( 'Ảnh đại diện', 'essential-features-addon' ),
                'type'    => Controls_Manager::MEDIA,
                'default' => [ 'id' => 0, 'url' => 'https://placehold.jp/200x200.png' ],
                'dynamic' => [ 'active' => true ],
            ]
        );

        $this->add_control(
            'name',
            [
                'label'   => esc_html__( 'Tên giảng viên', 'essential-features-addon' ),
                'type'    => Controls_Manager::TEXT,
                'label_block' => true,
                'default' => esc_html__( 'Sarah Nguyen', 'essential-features-addon' ),
            ]
        );

        $this->add_control(
            'description',
            [
                'label'   => esc_html__( 'Mô tả chi tiết', 'essential-features-addon' ),
                'type'    => Controls_Manager::WYSIWYG,
                'default' => esc_html__( 'Chuyên gia đào tạo UI/UX, hơn 10 năm kinh nghiệm.', 'essential-features-addon' ),
            ]
        );

        $this->end_controls_section();

        // section contact
        $this->start_controls_section(
            'section_contact',
            [
                'label' => esc_html__( 'Liên hệ', 'essential-features-addon' ),
                'tab'   => Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'contact_text',
            [
                'label'   => esc_html__( 'Text nút liên hệ', 'essential-features-addon' ),
                'type'    => Controls_Manager::TEXT,
                'label_block' => true,
                'default' => esc_html__( 'Đăng ký mua giáo trình', 'essential-features-addon' ),
            ]
        );

        $this->add_control(
            'contact_link',
            [
                'label'       => esc_html__( 'Link nút liên hệ', 'essential-features-addon' ),
                'type'        => Controls_Manager::URL,
                'placeholder' => esc_html__( 'https://your-link.com', 'essential-features-addon' ),
                'default'     => [ 'url' => 'https://zalo.me/2127558141747969331?src=qr', 'is_external' => true ],
            ]
        );

        $this->add_control(
            'price_note',
            [
                'label'   => esc_html__( 'Dòng mô tả nhỏ (giá...)', 'essential-features-addon' ),
                'type'    => Controls_Manager::TEXT,
                'label_block' => true,
                'default' => esc_html__( 'Chi phí từ', 'essential-features-addon' ),
            ]
        );

        $this->add_control(
            'price',
            [
                'label'   => esc_html__( 'Giá', 'essential-features-addon' ),
                'type'    => Controls_Manager::TEXT,
                'label_block' => true,
                'default' => esc_html__( '140.000vnd', 'essential-features-addon' ),
            ]
        );

        $this->end_controls_section();

        // style content
        $this->start_controls_section(
            'style_content',
            [
                'label' => esc_html__( 'Nội dung', 'essential-features-addon' ),
                'tab'   => Controls_Manager::TAB_STYLE
            ]
        );

        $this->add_control(
            'name_color',
            [
                'label'     => esc_html__( 'Màu tên', 'essential-features-addon' ),
                'type'      => Controls_Manager::COLOR,
                'default'   => '',
                'selectors' => [
                    '{{WRAPPER}} .efa-addon-teacher-box .avatar .name' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'     => 'name_typography',
                'label'    => esc_html__( 'Kiểu chữ tên', 'essential-features-addon' ),
                'selector' => '{{WRAPPER}} .efa-addon-teacher-box .avatar .name',
            ]
        );

        $this->add_control(
            'divider_content_1',
            [
                'type' => Controls_Manager::DIVIDER,
            ]
        );

        $this->add_control(
            'description_color',
            [
                'label'     => esc_html__( 'Màu nội dung', 'essential-features-addon' ),
                'type'      => Controls_Manager::COLOR,
                'default'   => '',
                'selectors' => [
                    '{{WRAPPER}} .efa-addon-teacher-box .desc' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'     => 'description_typography',
                'label'    => esc_html__( 'Kiểu chữ nội dung', 'essential-features-addon' ),
                'selector' => '{{WRAPPER}} .efa-addon-teacher-box .desc',
            ]
        );

        $this->end_controls_section();

        // style contact
        $this->start_controls_section(
            'style_contact',
            [
                'label' => esc_html__( 'Liên hệ', 'essential-features-addon' ),
                'tab'   => Controls_Manager::TAB_STYLE
            ]
        );

        $this->add_control(
            'contact_color',
            [
                'label'     => esc_html__( 'Màu', 'essential-features-addon' ),
                'type'      => Controls_Manager::COLOR,
                'default'   => '',
                'selectors' => [
                    '{{WRAPPER}} .efa-addon-btn-link' => '--btn-link-color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'     => 'name_typography',
                'selector' => '{{WRAPPER}} .efa-addon-btn-link',
            ]
        );

        $this->add_control(
            'contact_background_color',
            [
                'label'     => esc_html__( 'Màu nền', 'essential-features-addon' ),
                'type'      => Controls_Manager::COLOR,
                'default'   => '',
                'selectors' => [
                    '{{WRAPPER}} .efa-addon-btn-link' => '--btn-link-background-color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'divider_contact_1',
            [
                'type' => Controls_Manager::DIVIDER,
            ]
        );

        $this->add_control(
            'contact_color_hover',
            [
                'label'     => esc_html__( 'Màu hover', 'essential-features-addon' ),
                'type'      => Controls_Manager::COLOR,
                'default'   => '',
                'selectors' => [
                    '{{WRAPPER}} .efa-addon-btn-link:hover' => '--btn-link-color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'contact_background_color_hover',
            [
                'label'     => esc_html__( 'Màu nền hover', 'essential-features-addon' ),
                'type'      => Controls_Manager::COLOR,
                'default'   => '',
                'selectors' => [
                    '{{WRAPPER}} .efa-addon-btn-link:hover' => '--btn-link-background-color: {{VALUE}};',
                ],
            ]
        );

        $this->end_controls_section();

        // style price note
        $this->start_controls_section(
            'style_price_note',
            [
                'label' => esc_html__( 'Giá', 'essential-features-addon' ),
                'tab'   => Controls_Manager::TAB_STYLE
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'     => 'price_box_typography',
                'selector' => '{{WRAPPER}} .price-note-box',
            ]
        );

        $this->add_control(
            'price_text_color',
            [
                'label'     => esc_html__( 'Màu chữ', 'essential-features-addon' ),
                'type'      => Controls_Manager::COLOR,
                'default'   => '',
                'selectors' => [
                    '{{WRAPPER}} .price-note-box .text' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'price_color',
            [
                'label'     => esc_html__( 'Màu giá', 'essential-features-addon' ),
                'type'      => Controls_Manager::COLOR,
                'default'   => '',
                'selectors' => [
                    '{{WRAPPER}} .price-note-box .price' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->end_controls_section();
    }

    protected function render(): void
    {
        $settings = $this->get_settings_for_display();

        $this->add_render_attribute( 'wrapper', 'class', 'efa-addon-teacher-box' );

        $avatar = $settings['avatar'];
        $contact_link = $settings['contact_link'];

        if ( $contact_link['url'] ) {
            $this->add_link_attributes( 'contact_link', $contact_link );
        }
        ?>

        <div <?php echo $this->get_render_attribute_string( 'wrapper' ); ?>>
            <div class="avatar">
                <?php
                if ( ! empty( $avatar['id'] ) ) :
                    echo wp_get_attachment_image( $avatar['id'], 'medium', false, [
                        'class' => 'avatar-img',
                        'alt'   => esc_attr( $settings['name'] ),
                    ] );
                elseif ( ! empty( $settings['avatar']['url'] ) ) :
                    printf(
                        '<img class="avatar-img" src="%s" alt="%s" />',
                        esc_url( $settings['avatar']['url'] ),
                        esc_attr( $settings['name'] )
                    );
                endif;
                ?>

                <h3 class="name"><?php echo esc_html( $settings['name'] ); ?></h3>
            </div>

            <div class="content">
                <?php if ( $settings['description'] ) : ?>
                    <div class="desc"><?php echo wpautop( $settings['description'] ); ?></div>
                <?php endif; ?>

                <div class="contact-box">
                    <?php if ( $settings['contact_text'] ) : ?>
                        <a class="efa-addon-btn-link btn-contact" <?php $this->print_render_attribute_string( 'contact_link' ); ?>>
                            <span><?php echo esc_html( $settings['contact_text'] ); ?></span>
                            <i class="efa-icon-mask efa-icon-mask-arrow-right"></i>
                        </a>
                    <?php endif; ?>

                    <?php if ( $settings['price_note'] || $settings['price'] ) : ?>
                        <div class="price-note-box">
                            <span class="text"><?php echo esc_html( $settings['price_note'] ); ?></span>
                            <span class="price"><?php echo esc_html( $settings['price'] ); ?></span>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>

        <?php
    }
}