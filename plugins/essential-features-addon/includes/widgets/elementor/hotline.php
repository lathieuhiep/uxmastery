<?php

use Elementor\Widget_Base;
use Elementor\Controls_Manager;

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly.
}

class EFA_Widget_Hotline extends Widget_Base
{
    // widget name
    public function get_name(): string
    {
        return 'efa-hotline';
    }

    // widget title
    public function get_title(): string
    {
        return esc_html__('Hotline', 'essential-features-addon');
    }

    // widget icon
    public function get_icon(): string
    {
        return 'eicon-tel-field';
    }

    // widget categories
    public function get_categories(): array
    {
        return array('efa-addons');
    }

    // widget keywords
    public function get_keywords(): array
    {
        return ['hotline', 'phone', 'contact', 'essential-features-addon'];
    }

    // widget controls
    protected function register_controls(): void
    {
        // content section
        $this->start_controls_section(
            'content_section',
            [
                'label' => esc_html__('Điện thoại', 'essential-features-addon'),
                'tab' => Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'phone_title',
            [
                'label' => esc_html__('Văn bản', 'essential-features-addon'),
                'type' => Controls_Manager::TEXT,
                'default' => esc_html__('Hotline', 'essential-features-addon'),
            ]
        );

        $this->add_control(
            'phone_number',
            [
                'label' => esc_html__('Số điện thoại', 'essential-features-addon'),
                'type' => Controls_Manager::TEXT,
                'default' => '0911 321 300',
            ]
        );

        $this->end_controls_section();

        // layout section
        $this->start_controls_section(
            'section_layout',
            [
                'label' => esc_html__( 'Căn chỉnh', 'essential-features-addon' ),
            ]
        );

        $this->add_responsive_control(
            'align_items',
            [
                'label'   => esc_html__( 'Căn chỉnh dọc (align-items)', 'essential-features-addon' ),
                'type'    => Controls_Manager::CHOOSE,
                'options' => [
                    'flex-start' => [
                        'title' => esc_html__( 'Trên', 'essential-features-addon' ),
                        'icon'  => 'eicon-v-align-top',
                    ],
                    'center' => [
                        'title' => esc_html__( 'Giữa', 'essential-features-addon' ),
                        'icon'  => 'eicon-v-align-middle',
                    ],
                    'flex-end' => [
                        'title' => esc_html__( 'Dưới', 'essential-features-addon' ),
                        'icon'  => 'eicon-v-align-bottom',
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .efa-addon-hotline' => 'align-items: {{VALUE}};',
                ],
                'default' => 'center',
            ]
        );

        $this->add_responsive_control(
            'justify_content',
            [
                'label'   => esc_html__( 'Căn chỉnh ngang (justify-content)', 'essential-features-addon' ),
                'type'    => Controls_Manager::CHOOSE,
                'options' => [
                    'flex-start' => [
                        'title' => esc_html__( 'Trái', 'essential-features-addon' ),
                        'icon'  => 'eicon-h-align-left',
                    ],
                    'center' => [
                        'title' => esc_html__( 'Giữa', 'essential-features-addon' ),
                        'icon'  => 'eicon-h-align-center',
                    ],
                    'flex-end' => [
                        'title' => esc_html__( 'Phải', 'essential-features-addon' ),
                        'icon'  => 'eicon-h-align-right',
                    ],
                    'space-between' => [
                        'title' => esc_html__( 'Cách đều', 'essential-features-addon' ),
                        'icon'  => 'eicon-justify-space-between-h',
                    ],
                    'space-around' => [
                        'title' => esc_html__( 'Quanh đều', 'essential-features-addon' ),
                        'icon'  => 'eicon-justify-space-around-h',
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .efa-addon-hotline' => 'justify-content: {{VALUE}};',
                ],
                'default' => 'flex-start',
            ]
        );

        $this->end_controls_section();
    }

    // widget output on the frontend
    protected function render(): void
    {
        $settings = $this->get_settings_for_display();
    ?>
        <div class="efa-addon-hotline efa-flex-layout">
            <h4 class="title">
                <i class="efa-icon-mask efa-icon-mask-phone-calling"></i>
                <span><?php echo esc_html($settings['phone_title']); ?></span>
            </h4>

            <a href="tel:<?php echo esc_html(efa_preg_replace_ony_number($settings['phone_number'])); ?>"
               class="number">
                <?php echo esc_html($settings['phone_number']); ?>
            </a>
        </div>
    <?php
    }

    // widget output in the editor
    protected function content_template() {
    ?>
        <div class="efa-addon-hotline efa-flex-layout">
            <h4 class="title">
                <i class="efa-icon-mask efa-icon-mask-phone-calling"></i>
                <span>{{{ settings.phone_title }}}</span>
            </h4>

            <a href="tel:{{ settings.phone_number.replace(/[^0-9]/g, '') }}" class="number">
                {{{ settings.phone_number }}}
            </a>
        </div>
    <?php
    }
}