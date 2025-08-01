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

        // Lấy URL ảnh từ ID đã lưu
        $image_id = ! empty( $instance['image_id'] ) ? $instance['image_id'] : '';
        $image_size = ! empty( $instance['image_size'] ) ? $instance['image_size'] : 'full';

        if ( $image_id ) :
            ?>

            <div class="contact-image">
                <a href="<?php echo esc_url( home_url('/') ); ?>">
                    <?php echo wp_get_attachment_image( $image_id, $image_size ); ?>
                </a>
            </div>

        <?php endif; ?>

        <ul class="info-list">
            <?php if ( ! empty( $instance['email'] ) ) : ?>
                <li>
                    <i class="ic-mask ic-mask-huge-send"></i>
                    <a class="text" href="mailto:<?php echo esc_attr( $instance['email'] ); ?>">
                        <?php echo esc_html( $instance['email'] ); ?>
                    </a>
                </li>
            <?php endif; ?>

            <?php if ( ! empty( $instance['phone'] ) ) : ?>
                <li>
                    <i class="ic-mask ic-mask-phone-incoming"></i>
                    <a class="text" href="tel:<?php echo esc_attr( uxmastery_preg_replace_ony_number( $instance['phone'] ) ); ?>">
                        <?php echo esc_html( $instance['phone'] ); ?>
                    </a>
                </li>
            <?php endif; ?>

            <?php if ( ! empty( $instance['address'] ) ) : ?>
                <li>
                    <i class="ic-mask ic-mask-location"></i>
                    <span class="text"><?php echo esc_html( $instance['address'] ); ?></span>
                </li>
            <?php endif; ?>
        </ul>

        <?php
        echo $args['after_widget'];
    }

    public function form( $instance ): void {
        $defaults = [
            'title'   => esc_html__( 'Thông tin liên hệ', 'uxmastery' ),
            'address' => '',
            'email'   => '',
            'phone'   => '',
            'image_id' => '',
            'image_size' => 'full'
        ];

        $instance = wp_parse_args( (array) $instance, $defaults );

        $image_id = ! empty( $instance['image_id'] ) ? $instance['image_id'] : '';
        $image_size = ! empty( $instance['image_size'] ) ? $instance['image_size'] : 'full';
        $image_url = $image_id ? wp_get_attachment_url( $image_id ) : '';

        $fields = [
            'title'   => esc_html__( 'Title:', 'uxmastery' ),
            'address' => esc_html__( 'Địa chỉ:', 'uxmastery' ),
            'email'   => esc_html__( 'Email:', 'uxmastery' ),
            'phone'   => esc_html__( 'Số điện thoại:', 'uxmastery' )
        ];
        ?>
        <div class="custom-img-widget-wrap">
            <input type="hidden"
                   class="custom-img-id-input"
                   id="<?php echo $this->get_field_id( 'image_id' ); ?>"
                   name="<?php echo $this->get_field_name( 'image_id' ); ?>"
                   value="<?php echo esc_attr( $image_id ); ?>" />

            <label for="<?php echo $this->get_field_id( 'image_id' ); ?>">
                <?php esc_html_e( 'Ảnh đại diện:', 'uxmastery' ); ?>
            </label>

            <div class="custom-img-preview-wrapper">
                <img class="custom-img-preview"
                     src="<?php echo esc_attr( $image_url ) ?: ''; ?>"
                     style="<?php echo empty($image_url) ? 'display:none;' : ''; ?>"  alt=""/>
            </div>

            <button type="button" class="button custom-img-upload">
                <?php esc_html_e( 'Chọn ảnh', 'uxmastery' ); ?>
            </button>

            <button type="button" class="button custom-img-remove" style="<?php echo empty($image_url) ? 'display:none;' : ''; ?>">
                <?php esc_html_e('Gỡ ảnh', 'uxmastery'); ?>
            </button>
        </div>

        <p>
            <label for="<?php echo $this->get_field_id( 'image_size' ); ?>"><?php esc_html_e( 'Kích thước ảnh:', 'uxmastery' ); ?></label>
            <select class="widefat" id="<?php echo $this->get_field_id( 'image_size' ); ?>" name="<?php echo $this->get_field_name( 'image_size' ); ?>">
                <?php
                $available_sizes = array( 'thumbnail', 'medium', 'large', 'full' );
                foreach ( $available_sizes as $size ) {
                    echo '<option value="' . esc_attr( $size ) . '"' . selected( $image_size, $size, false ) . '>' . esc_html( $size ) . '</option>';
                }
                ?>
            </select>
        </p>

        <?php foreach ( $fields as $key => $label ) : ?>
            <p>
                <label for="<?php echo $this->get_field_id( $key ); ?>"><?php echo $label; ?></label>
                <input class="widefat" id="<?php echo $this->get_field_id( $key ); ?>"
                       name="<?php echo $this->get_field_name( $key ); ?>" type="text"
                       value="<?php echo esc_attr( $instance[ $key ] ); ?>">
            </p>
        <?php
        endforeach;
    }

    public function update( $new_instance, $old_instance ): array {
        $instance = [];
        // Lưu ID ảnh thay vì URL
        $instance['image_id'] = (!empty($new_instance['image_id'])) ? absint($new_instance['image_id']) : '';
        $instance['image_size'] = (!empty($new_instance['image_size'])) ? sanitize_text_field($new_instance['image_size']) : 'full';
        $instance['title'] = (!empty($new_instance['title'])) ? sanitize_text_field($new_instance['title']) : '';
        $instance['address'] = (!empty($new_instance['address'])) ? sanitize_text_field($new_instance['address']) : '';
        $instance['email'] = (!empty($new_instance['email'])) ? sanitize_email($new_instance['email']) : '';
        $instance['phone'] = (!empty($new_instance['phone'])) ? sanitize_text_field($new_instance['phone']) : '';

        return $instance;
    }
}

function uxmastery_register_contact_info_widget(): void {
    register_widget( 'BasicTheme_Contact_Info_Widget' );
}

add_action( 'widgets_init', 'uxmastery_register_contact_info_widget' );