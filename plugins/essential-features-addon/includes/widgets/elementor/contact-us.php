<?php

use Elementor\Group_Control_Typography;
use Elementor\Icons_Manager;
use Elementor\Repeater;
use Elementor\Widget_Base;
use Elementor\Controls_Manager;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

class EFA_Widget_Contact_Us extends Widget_Base {

	// widget name
	public function get_name(): string {
		return 'efa-contact-us';
	}

	// widget title
	public function get_title(): string {
		return esc_html__( 'Liên hệ với chúng tôi', 'essential-features-addon' );
	}

	// widget icon
	public function get_icon(): string {
		return 'eicon-integration';
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
		// phone section
		$this->start_controls_section(
			'content_phone_section',
			[
				'label' => esc_html__( 'Điện thoại', 'essential-features-addon' ),
				'tab'   => Controls_Manager::TAB_CONTENT,
			]
		);

		$this->add_control(
			'phone_title',
			[
				'label' => esc_html__( 'Văn bản', 'essential-features-addon' ),
				'type' => Controls_Manager::TEXT,
				'default' => esc_html__( 'Hotline', 'essential-features-addon' ),
			]
		);

		$this->add_control(
			'phone_number',
			[
				'label' => esc_html__( 'Số điện thoại', 'essential-features-addon' ),
				'type' => Controls_Manager::TEXT,
				'default' => '0911 321 300',
			]
		);

		$this->end_controls_section();

		// content social network section
		$this->start_controls_section(
			'content_social_network_section',
			[
				'label' => esc_html__( 'Mạng xã hội', 'essential-features-addon' ),
				'tab'   => Controls_Manager::TAB_CONTENT,
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
					'{{WRAPPER}} {{CURRENT_ITEM}}.social-network-item::before' => 'background-color: {{VALUE}}'
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
	}

	// widget output on the frontend
	protected function render(): void {
		$settings   = $this->get_settings_for_display();
	?>
		<div class="efa-addon-contact-us">
			<div class="phone-box">
				<h4 class="title">
					<i class="fas fa-phone-volume"></i>
					<span><?php echo esc_html( $settings['phone_title'] ); ?></span>
				</h4>

				<a href="tel:<?php echo esc_html( efa_preg_replace_ony_number( $settings['phone_number'] ) ); ?>" class="number">
					<?php echo esc_html( $settings['phone_number'] ); ?>
				</a>
			</div>

			<div class="social-box">
				<div class="social-box__block">
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
							<a class="social-network-item elementor-repeater-item-<?php echo esc_attr( $item['_id'] ); ?>" <?php echo $this->get_render_attribute_string( $link_key ); ?>>
								<?php Icons_Manager::render_icon( $item['social_icon'], [ 'aria-hidden' => 'true' ] ); ?>
							</a>
						<?php
						    endif;

						endforeach;
                        ?>
					</div>
				</div>

			</div>
		</div>
	<?php
	}
}