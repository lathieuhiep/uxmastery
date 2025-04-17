<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

// Required: Plugin Activation
require get_parent_theme_file_path( '/includes/class-tgm-plugin-activation.php' );
require get_parent_theme_file_path( '/includes/plugin-activation.php' );

// Required: Theme functions
require get_parent_theme_file_path( '/includes/theme-setup.php' );
require get_parent_theme_file_path( '/includes/theme-hooks.php' );
require get_parent_theme_file_path( '/includes/theme-functions.php' );
require get_parent_theme_file_path( '/includes/theme-scripts.php' );
require get_parent_theme_file_path( '/includes/theme-sidebar.php' );

// Required: Theme options
require get_theme_file_path( '/includes/theme-options.php' );

// Required: Widgets
require get_parent_theme_file_path( '/includes/widgets/contact-info-widget.php' );
require get_parent_theme_file_path( '/includes/widgets/recent-post.php' );
require get_parent_theme_file_path( '/includes/widgets/social-widget.php' );

// Required: Custom Post Types
require get_parent_theme_file_path( '/includes/custom-post-types/cpt-services.php' );