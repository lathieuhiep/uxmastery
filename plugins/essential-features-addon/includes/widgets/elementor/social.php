<?php

use Elementor\Group_Control_Border;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Icons_Manager;
use Elementor\Repeater;
use Elementor\Widget_Base;
use Elementor\Controls_Manager;

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly.
}

class EFA_Widget_Social extends Widget_Base
{
    // widget name
    public function get_name(): string
    {
        return 'efa-social';
    }

    // widget title
    public function get_title(): string
    {
        return esc_html__('Mạng xã hội', 'essential-features-addon');
    }

    // widget icon
    public function get_icon(): string
    {
        return 'eicon-social-icons';
    }

    // widget categories
    public function get_categories(): array
    {
        return array('efa-addons');
    }

    // widget keywords
    public function get_keywords(): array
    {
        return ['social', 'essential-features-addon'];
    }

    // widget controls
    protected function register_controls(): void
    {
        // content section
        $this->start_controls_section(
            'social_section',
            [
                'label' => esc_html__('Mạng xã hội', 'essential-features-addon'),
                'tab' => Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'social_title',
            [
                'label' => esc_html__( 'Văn bản', 'essential-features-addon' ),
                'type' => Controls_Manager::TEXT,
                'default' => esc_html__( 'Mạng xã hội', 'essential-features-addon' ),
            ]
        );

        $repeater = new Repeater();

        $repeater->add_control(
            'social_list_title', [
                'label'       => esc_html__( 'Tên', 'essential-features-addon' ),
                'type'        => Controls_Manager::TEXT,
                'default'     => esc_html__( 'Tên #1', 'essential-features-addon' ),
                'label_block' => true,
            ]
        );

        $repeater->add_control(
            'social_icon',
            [
                'label'       => esc_html__( 'Icon', 'essential-features-addon' ),
                'type'        => Controls_Manager::ICONS,
                'default' => [
                    'value' => 'fab facebook-f',
                    'library' => 'fab',
                ],
                'recommended' => [
                    'fa-brands' => [
                        'facebook-f',
                        'twitter',
                        'google',
                        'linkedin-in',
                        'youtube',
                        'instagram'
                    ],
                ]
            ]
        );

        $repeater->add_control(
            'social_link',
            [
                'label'       => esc_html__( 'Link', 'essential-features-addon' ),
                'type'        => Controls_Manager::URL,
                'placeholder' => esc_html__( 'https://your-link.com', 'essential-features-addon' ),
                'default'     => [
                    'url'         => '',
                    'is_external' => true,
                    'nofollow'    => true,
                ],
            ]
        );

        $repeater->add_control(
            'social_color',
            [
                'label' => esc_html__( 'Background Color', 'essential-features-addon' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} {{CURRENT_ITEM}}.item::before' => 'background-color: {{VALUE}}'
                ],
            ]
        );

        $this->add_control(
            'social_networks',
            [
                'label'       => esc_html__( 'Social Networks', 'essential-features-addon' ),
                'type'        => Controls_Manager::REPEATER,
                'fields'      => $repeater->get_controls(),
                'default'     => [
                    [
                        'list_title' => __( 'Tên #1', 'essential-features-addon' ),
                    ],
                ],
                'title_field' => '{{{ social_list_title }}}',
            ]
        );

        $this->end_controls_section();

        // style section
        $this->start_controls_section(
            'social_style_section',
            [
                'label' => esc_html__('Style', 'essential-features-addon'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_responsive_control(
            'box_padding',
            [
                'label' => esc_html__('Khoảng cách bên trong', 'essential-features-addon'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em', 'rem'],
                'default' => [
                    'unit' => 'px'
                ],
                'selectors' => [
                    '{{WRAPPER}} .efa-addon-social' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'box_border',
                'label' => esc_html__('Border', 'essential-features-addon'),
                'selector' => '{{WRAPPER}} .efa-addon-social',
            ]
        );

        $this->add_responsive_control(
            'box_border_radius',
            [
                'label' => esc_html__('Bo góc', 'essential-features-addon'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em', 'rem'],
                'default' => [
                    'unit' => 'px'
                ],
                'selectors' => [
                    '{{WRAPPER}} .efa-addon-social' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'box_shadow',
                'selector' => '{{WRAPPER}} .efa-addon-social',
            ]
        );

        $this->end_controls_section();
    }

    // widget output on the frontend
    protected function render(): void
    {
        $settings = $this->get_settings_for_display();
    ?>
        <div class="efa-addon-social">
            <h4 class="title">
                <?php echo esc_html( $settings['social_title'] ); ?>
            </h4>

            <div class="list">
                <?php
                foreach ( $settings['social_networks'] as $index => $item ) :
                    $url = $item['social_link']['url'];

                    if ( $url ) :
                        $link_key = 'link_' . $index;
                        $this->add_link_attributes( $link_key, $item['social_link'] );
                ?>
                    <a class="item elementor-repeater-item-<?php echo esc_attr( $item['_id'] ); ?>"
                        <?php echo $this->get_render_attribute_string( $link_key ); ?>
                    >
                        <?php Icons_Manager::render_icon( $item['social_icon'], [ 'aria-hidden' => 'true' ] ); ?>
                    </a>
                <?php
                    endif;
                endforeach;
                ?>
            </div>
        </div>
    <?php
    }

    // widget output in the editor
    protected function content_template() {
    ?>
        <div class="efa-addon-social">
            <h4 class="title">
                {{ settings.social_title }}
            </h4>

            <div class="list">
                <# if ( settings.social_networks && settings.social_networks.length ) {
                    _.each( settings.social_networks, function( item ) {

                    var link   = item.social_link || {};
                    var hasUrl = link.url && link.url.length;

                    if ( hasUrl ) {
                        var target = link.is_external ? ' target="_blank"' : '';
                        var rel    = link.nofollow ? ' rel="nofollow"' : '';
                        var custom = link.custom_attributes ? ' ' + link.custom_attributes : '';

                        // Render icon theo chuẩn Elementor
                        var iconHTML = elementor.helpers.renderIcon( view, item.social_icon, { 'aria-hidden': true }, 'i', 'object' );
                #>
                    <a class="item elementor-repeater-item-{{ item._id }}"
                       href="{{ link.url }}"{{{ target }}}{{{ rel }}}{{{ custom }}}>
                        <# if ( iconHTML && iconHTML.value ) { #>
                            {{{ iconHTML.value }}}
                        <# } #>
                    </a>
                <#
                        } // end if hasUrl
                    }); // end each
                } #>
            </div>
        </div>
    <?php
    }
}