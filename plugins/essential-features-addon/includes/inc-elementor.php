<?php
if ( ! defined( 'ABSPATH' ) ) exit;

// register widget elementor
function efa_register_widget_elementor_addon( $widgets_manager ): void
{
    $classes = [
        '\EFA_Widget_Book_Curriculum',
        '\EFA_Widget_Button_Contact_Link',
        '\EFA_Widget_Carousel_Images',
        '\EFA_Widget_Connect_Link',
        '\EFA_Widget_Contact_Banner',
        '\EFA_Widget_Dual_Post_Block',
        '\EFA_Widget_Gallery_Grid',
        '\EFA_Widget_Heading_With_Editor',
        '\EFA_Widget_Hero',
        '\EFA_Widget_Hotline',
        '\EFA_Widget_Image_And_Text_Block',
        '\EFA_Widget_Post_Grid',
        '\EFA_Widget_Service_Card',
        '\EFA_Widget_Service_Grid',
        '\EFA_Widget_Service_Grid_V2',
        '\EFA_Widget_Social',
        '\EFA_Widget_Special_Title',
        '\EFA_Widget_Tab_Posts',
        '\EFA_Widget_Teacher_Info',
        '\EFA_Widget_Testimonial',
        '\EFA_Widget_Video_Popup',
    ];

    $base_dir = EFA_PLUGIN_PATH . 'includes/widgets/elementor/';

    foreach ( $classes as $class ) {
        if ( ! class_exists( $class ) ) {
            // Lấy phần tên sau "EFA_Widget_"
            $short = strtolower( str_replace( 'EFA_Widget_', '', $class ) );
            // Chuyển underscore thành dấu gạch ngang cho đúng chuẩn file
            $file  = $base_dir . str_replace( '_', '-', $short ) . '.php';

            if ( file_exists( $file ) ) {
                require_once $file;
            }
        }

        if ( class_exists( $class ) ) {
            $widgets_manager->register( new $class() );
        }
    }
}

add_action( 'elementor/widgets/register', 'efa_register_widget_elementor_addon' );