<?php

use Elementor\Group_Control_Background;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Typography;
use Elementor\Icons_Manager;
use Elementor\Widget_Base;
use Elementor\Controls_Manager;

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

class EFA_Widget_Contact_Banner extends Widget_Base {

    public function get_name(): string {
        return 'efa-contact-banner';
    }

    public function get_title(): string {
        return esc_html__( 'Contact Banner', 'essential-features-addon' );
    }

    public function get_icon(): string {
        return 'eicon-call-to-action';
    }

    public function get_categories(): array {
        return [ 'efa-addons' ];
    }

    protected function register_controls(): void {
        // Content Section
        $this->start_controls_section(
            'content_section',
            [
                'label' => esc_html__( 'Nội dung', 'essential-features-addon' ),
                'tab'   => Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'content',
            [
                'label'   => esc_html__( 'Văn bản', 'essential-features-addon' ),
                'type'    => Controls_Manager::WYSIWYG,
                'default' => esc_html__( 'Nội dung văn bản', 'essential-features-addon' ),
            ]
        );

        $this->end_controls_section();

        // Contact Section
        $this->start_controls_section(
            'contact_section',
            [
                'label' => esc_html__( 'Liên hệ', 'essential-features-addon' ),
                'tab'   => Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'button_text',
            [
                'label'       => esc_html__( 'Văn bản nút', 'essential-features-addon' ),
                'type'        => Controls_Manager::TEXT,
                'default'     => esc_html__( 'Liên hệ ngay', 'essential-features-addon' ),
            ]
        );

        $this->add_control(
            'icon',
            [
                'label'   => esc_html__( 'Icon', 'essential-features-addon' ),
                'type'    => Controls_Manager::ICONS,
                'default' => [
                    'value'   => 'fas fa-arrow-right',
                    'library' => 'fa-solid',
                ],
            ]
        );

        $this->end_controls_section();

        // style section for layout
        $this->start_controls_section(
            'layout_section',
            [
                'label' => esc_html__( 'Bố cục', 'essential-features-addon' ),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_responsive_control(
            'layout_margin',
            [
                'label' => esc_html__('Lề ngoài', 'essential-features-addon'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors' => [
                    '{{WRAPPER}} .efa-contact-banner' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'layout_padding',
            [
                'label' => esc_html__('Lề trong', 'essential-features-addon'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors' => [
                    '{{WRAPPER}} .efa-contact-banner' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'layout_border',
                'selector' => '{{WRAPPER}} .efa-contact-banner',
            ]
        );

        $this->add_responsive_control(
            'layout_border_radius',
            [
                'label' => esc_html__('Border Radius', 'essential-features-addon'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors' => [
                    '{{WRAPPER}} .efa-contact-banner' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->end_controls_section();

        // style section for Background
        $this->start_controls_section(
            'background_section',
            [
                'label' => esc_html__( 'Ảnh nền', 'essential-features-addon' ),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name'     => 'background',
                'label'    => esc_html__( 'Background', 'essential-features-addon' ),
                'types'    => [ 'classic', 'gradient' ],
                'selector' => '{{WRAPPER}} .efa-contact-banner',
            ]
        );

        $this->add_control(
            'overlay_color',
            [
                'label'     => esc_html__( 'Màu lớp phủ', 'essential-features-addon' ),
                'type'      => Controls_Manager::COLOR,
                'default'   => '',
                'selectors' => [
                    '{{WRAPPER}} .efa-contact-banner::before' => 'background-color: {{VALUE}}',
                ],
            ]
        );

        $this->end_controls_section();

        // style section for content
        $this->start_controls_section(
            'content_style_section',
            [
                'label' => esc_html__( 'Nội dung', 'essential-features-addon' ),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'content_color',
            [
                'label'     => esc_html__( 'Màu văn bản', 'essential-features-addon' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .efa-contact-banner .content' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'     => 'content_typography',
                'label'    => esc_html__( 'Kiểu chữ', 'essential-features-addon' ),
                'selector' => '{{WRAPPER}} .efa-contact-banner .content',
            ]
        );

        $this->end_controls_section();
    }

    protected function render(): void {
        $settings = $this->get_settings_for_display();

        if ( ! function_exists( 'uxmastery_get_option' ) ) return;

        $zalo_link = uxmastery_get_option( 'opt_contact_zalo' );
        if ( empty( $zalo_link ) ) return;
    ?>
        <div class="efa-contact-banner">
            <div class="warp">
                <div class="item">
                    <div class="content">
                        <?= wpautop( $settings['content'] ) ?>
                    </div>
                </div>

                <div class="item">
                    <a href="<?= esc_url( $zalo_link ) ?>" class="efa-btn-contact-link" target="_blank">
                        <span><?= esc_html( $settings['button_text'] ) ?></span>
                        <?php
                        Icons_Manager::render_icon( $settings['icon'], [
                            'aria-hidden' => 'true',
                            'class'       => 'efa-ic',
                        ] );
                        ?>
                    </a>
                </div>
            </div>
        </div>
    <?php
    }
}