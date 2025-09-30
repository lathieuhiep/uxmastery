<?php
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

require get_theme_file_path( '/includes/theme-options/helper-options.php' );

// Control core classes for avoid errors
function uxmastery_register_theme_options()
{
    if ( is_admin() && class_exists( 'CSF' ) ) {
        $facebook_url = esc_url( 'https://www.facebook.com/lathieuhiep' );

        // Set a unique slug-like ID
        $prefix_theme_options   = 'options';
        $menu_title = esc_html__( 'Cài đặt theme', 'uxmastery' );

        // Create options
        CSF::createOptions( PREFIX_THEME_OPTIONS, array(
            'menu_title'          => $menu_title,
            'menu_slug'           => 'theme-options',
            'menu_position'       => 2,
            'admin_bar_menu_icon' => 'dashicons-admin-generic',
            'framework_title'     => $menu_title,
            'footer_text'         => esc_html__( 'Cảm ơn bạn đã sử dụng theme của tôi', 'uxmastery' ),
            'footer_after'        => sprintf(
                '<pre>Liên hệ:<br />Zalo/Phone: 0975458209 - Skype: lathieuhiep - facebook: <a href="%s" target="_blank">lathieuhiep</a></pre>',
                $facebook_url
            ),
        ) );

        // general options
        require get_theme_file_path( '/includes/theme-options/general-options.php' );

        // menu options
        require get_theme_file_path( '/includes/theme-options/menu-options.php' );

        // contact options
        require get_theme_file_path( '/includes/theme-options/contact-options.php' );

        // blog options
        require get_theme_file_path( '/includes/theme-options/blog-options.php' );

        // course options
        require get_theme_file_path( '/includes/theme-options/course-options.php' );

        // social network options
        require get_theme_file_path( '/includes/theme-options/social-network-options.php' );

        // footer options
        require get_theme_file_path( '/includes/theme-options/footer-options.php' );

        // custom code options
        require get_theme_file_path( '/includes/theme-options/custom-code-options.php' );
    }
}
add_action( 'after_setup_theme', 'uxmastery_register_theme_options' );