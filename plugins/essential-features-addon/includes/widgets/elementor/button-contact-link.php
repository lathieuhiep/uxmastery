<?php

use Elementor\Group_Control_Typography;
use Elementor\Icons_Manager;
use Elementor\Widget_Base;
use Elementor\Controls_Manager;

if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly.
}

class EFA_Widget_Button_contact_Link extends Widget_Base {

    // widget name
    public function get_name(): string {
        return 'efa-button-contact-link';
    }

    // widget title
    public function get_title(): string {
        return esc_html__( 'Nút liên hệ zalo', 'essential-features-addon' );
    }

    // widget icon
    public function get_icon(): string {
        return 'eicon-button';
    }

    // widget categories
    public function get_categories(): array {
        return array( 'efa-addons' );
    }

    // widget keywords
    public function get_keywords(): array
    {
        return ['button', 'link', 'contact', 'zalo'];
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
            'text',
            [
                'label'       => esc_html__( 'Văn bản', 'essential-features-addon' ),
                'type'        => Controls_Manager::TEXT,
                'default'     => esc_html__( 'Liên hệ ngay', 'essential-features-addon' ),
                'label_block' => true
            ]
        );

        $this->add_control(
            'icon',
            [
                'label' => esc_html__( 'Icon', 'textdomain' ),
                'type' => Controls_Manager::ICONS,
                'default' => [
                    'value' => 'fas fa-arrow-right',
                    'library' => 'fa-solid',
                ],
            ]
        );

        $this->add_control(
            'custom_panel_alert',
            [
                'type' => Controls_Manager::ALERT,
                'alert_type' => 'warning',
                'heading' => esc_html__( 'Lưu ý', 'essential-features-addon' ),
                'content' => esc_html__( 'Addon này mặc định lấy link zalo được thiết lập trong theme options của theme "uxmastery"', 'essential-features-addon' ),
            ]
        );

        $this->end_controls_section();
    }

    // widget output on the frontend
    protected function render(): void {
        $settings = $this->get_settings_for_display();

        // Get the Zalo link from theme options

        if ( !function_exists( 'get_option' ) && ! function_exists( 'uxmastery_get_option' ) ) return; // Ensure get_option function exists

        $zalo = uxmastery_get_option('opt_contact_zalo');

        if ( empty( $zalo ) ) return;
    ?>
        <div class="efa-button-contact-link">
            <a href="<?php echo esc_url( $zalo ); ?>" class="link" target="_blank">
                <span><?php echo esc_html( $settings['text'] ); ?></span>

                <?php Icons_Manager::render_icon( $settings['icon'], [
                    'aria-hidden' => 'true',
                    'class' => 'efa-ic'
                ] ); ?>
            </a>
        </div>
    <?php
    }
}