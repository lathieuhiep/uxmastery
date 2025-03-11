<?php

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
					<<?php echo esc_html( $tag ); ?> class="headline">
						<?php echo esc_html( $settings['heading'] ); ?>
					</<?php echo esc_html( $tag ); ?>>
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

	/**
	 * Render shortcode widget output in the editor.
	 *
	 * Written as a Backbone JavaScript template and used to generate the live preview.
	 *
	 */
	protected function content_template() {
    ?>
        <div class="efa-addon-hero">
            <div class="box-item box-content">
                <# if ( settings.heading ) { #>
                    <{{{ settings.html_tag }}} class="headline">
                        {{{ settings.heading }}}
                    </{{{ settings.html_tag }}}>
                <# } #>

                <# if ( settings.description ) { #>
                <div class="bio">
                    {{{ settings.description }}}
                </div>
                <# } #>

                <a class="scroll-to" href="{{{ settings.link.url }}}">
                    <i class="efa-icon-mask efa-icon-mask-down-chevron"></i>
                </a>
            </div>

            <div class="box-item box-action">
                <div class="popup-contact-form">
                    <div class="box-heading">
                        <div class="cf-heading heading-title">
                            {{{ settings.cf_heading }}}
                        </div>

                        <div class="cf-desc">
                            {{{ settings.cf_desc }}}
                        </div>
                    </div>

                    <# if ( settings.contact_form_list ) { #>
                    <div class="contact-form">
                        <!-- Shortcode rendering is handled by PHP in the render() method -->
                        <span class="cf7-shortcode-placeholder">[contact-form-7 id="{{{ settings.contact_form_list }}}]</span>
                    </div>
                    <# } #>
                </div>
            </div>
        </div>
    <?php
	}

}