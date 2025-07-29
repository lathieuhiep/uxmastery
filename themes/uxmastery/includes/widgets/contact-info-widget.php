<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
class BasicTheme_Contact_Info_Widget extends WP_Widget {
	public function __construct() {
		$widget_ops = array(
			'classname'   => 'contact-info-widget',
			'description' => esc_html__( 'Hiển thị thông tin liên hệ', 'uxmastery' ),
		);

		parent::__construct( 'contact-info-widget', 'My Theme: Thông tin liên hệ', $widget_ops );
	}

	public function widget( $args, $instance ): void {
		echo $args['before_widget'];

		if ( ! empty( $instance['title'] ) ) {
			echo $args['before_title'] . apply_filters( 'widget_title', $instance['title'] ) . $args['after_title'];
		}

		$position = ! empty( $instance['position'] ) ? $instance['position'] : 'start';
		?>
		<div class="footer-contact <?php echo esc_attr( $position ); ?>">
            <ul class="list-unstyled">
	            <?php if ( ! empty( $instance['address'] ) ) : ?>
                    <li><span class="text"><?php echo esc_html( $instance['address'] ); ?></span></li>
	            <?php endif; ?>

	            <?php if ( ! empty( $instance['email'] ) ) : ?>
                    <li>
                        <a class="text"
                           href="mailto:<?php echo esc_attr( $instance['email'] ); ?>"><?php echo esc_html( $instance['email'] ); ?></a>
                    </li>
	            <?php endif; ?>

	            <?php if ( ! empty( $instance['phone'] ) ) : ?>
                    <li>
                        <a class="text"
                           href="tel:<?php echo esc_attr( uxmastery_preg_replace_ony_number( $instance['phone'] ) ); ?>"><?php echo esc_html( $instance['phone'] ); ?></a>
                    </li>
	            <?php endif; ?>
            </ul>
		</div>
		<?php
		echo $args['after_widget'];
	}

	public function form( $instance ): void {
		$defaults = [
			'title'   => esc_html__( 'Thông tin liên hệ', 'uxmastery' ),
			'address' => '',
			'email'   => '',
			'phone'   => ''
		];

		$instance = wp_parse_args( (array) $instance, $defaults );

		$position = ! empty( $instance['position'] ) ? $instance['position'] : 'text-left';
        ?>
        <p>
            <label for="<?php echo $this->get_field_id( 'position' ); ?>">Chọn vị trí:</label>
            <select class="widefat" id="<?php echo $this->get_field_id( 'position' ); ?>" name="<?php echo $this->get_field_name( 'position' ); ?>">
                <option value="text-left" <?php selected( $position, 'text-left' ); ?>>Bên trái</option>
                <option value="text-center" <?php selected( $position, 'text-center' ); ?>>Ở giữa</option>
                <option value="text-right" <?php selected( $position, 'text-right' ); ?>>Bên phải</option>
            </select>
        </p>
        <?php

		$fields = [
			'title'   => esc_html__( 'Title:', 'uxmastery' ),
			'address' => esc_html__( 'Địa chỉ:', 'uxmastery' ),
			'email'   => esc_html__( 'Email:', 'uxmastery' ),
			'phone'   => esc_html__( 'Số điện thoại:', 'uxmastery' )
		];

		foreach ( $fields as $key => $label ) {
        ?>
			<p>
				<label for="<?php echo $this->get_field_id( $key ); ?>"><?php echo $label; ?></label>
				<input class="widefat" id="<?php echo $this->get_field_id( $key ); ?>"
				       name="<?php echo $this->get_field_name( $key ); ?>" type="text"
				       value="<?php echo esc_attr( $instance[ $key ] ); ?>">
			</p>
        <?php
		}
	}

	public function update( $new_instance, $old_instance ): array {
		$instance            = [];
		$instance['position'] = ( ! empty( $new_instance['position'] ) ) ? strip_tags( $new_instance['position'] ) : 'text-left';
		$instance['title']   = ( ! empty( $new_instance['title'] ) ) ? strip_tags( $new_instance['title'] ) : '';
		$instance['address'] = ( ! empty( $new_instance['address'] ) ) ? strip_tags( $new_instance['address'] ) : '';
		$instance['email']   = ( ! empty( $new_instance['email'] ) ) ? sanitize_email( $new_instance['email'] ) : '';
		$instance['phone']   = ( ! empty( $new_instance['phone'] ) ) ? strip_tags( $new_instance['phone'] ) : '';

		return $instance;
	}
}

function uxmastery_register_contact_info_widget(): void {
	register_widget( 'BasicTheme_Contact_Info_Widget' );
}

add_action( 'widgets_init', 'uxmastery_register_contact_info_widget' );