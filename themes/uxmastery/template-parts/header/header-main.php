<?php
$is_template_fixed_menu = is_page_template( 'templates/page-fixed-menu.php' );
$sticky_menu  = uxmastery_get_option( 'opt_menu_sticky', '1' );
$logo_light   = uxmastery_get_option( 'opt_general_logo_light' );
$logo_dark    = uxmastery_get_option( 'opt_general_logo_dark' );
$menu_contact = uxmastery_get_option( 'opt_menu_contact' );
$chat_zalo    = uxmastery_get_option( 'opt_link_zalo' );
?>

<header class="header header-sticky <?php echo esc_attr( $is_template_fixed_menu ? 'header-transparent': 'header-default' ) ?>">
    <nav class="navbar navbar-expand-lg<?php echo esc_attr( $is_template_fixed_menu ? ' navbar-sticky': '' ) ?>" id="primary-menu">
        <div class="container">
            <a class="logo navbar-brand" href="<?php echo esc_url( get_home_url( '/' ) ); ?>">
				<?php
				if ( $is_template_fixed_menu && ( ! empty( $logo_light['id'] ) || ! empty( $logo_dark['id'] ) ) ) :
					if ( ! empty( $logo_dark['id'] ) ) :
						echo wp_get_attachment_image( $logo_dark['id'], 'medium', false, array( "class" => "logo-dark" ) );
					endif;

                    if ( ! empty( $logo_light['id'] ) ) :
	                    echo wp_get_attachment_image( $logo_light['id'], 'medium', false, array( "class" => "logo-light" ) );
                    endif;
                elseif ( !$is_template_fixed_menu && ! empty( $logo_dark['id'] ) ) :
	                echo wp_get_attachment_image( $logo_dark['id'], 'medium' );
				else :
                ?>
                    <img class="logo-default"
                         src="<?php echo esc_url( get_theme_file_uri( '/assets/images/logo.png' ) ) ?>"
                         alt="<?php echo esc_attr( get_bloginfo( 'title' ) ); ?>" width="64" height="64"/>
				<?php endif; ?>
            </a>

            <button class="navbar-toggler collapsed" type="button" data-toggle="collapse" data-target="#navbarContent" aria-expanded="false">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarContent">
	            <?php
	            if ( has_nav_menu( 'primary' ) ) :
		            wp_nav_menu( array(
			            'theme_location' => 'primary',
			            'container'      => false,
			            'menu_class'     => 'navbar-nav ml-auto',
			            'items_wrap'     => '<ul class="%2$s">%3$s</ul>',
		            ) );
	            else:
		            ?>
                    <ul class="navbar-nav ml-auto">
                        <li class="nav-item active">
                            <a class="nav-link" href="<?php echo get_admin_url() . '/nav-menus.php'; ?>">
					            <?php esc_html_e( 'Thêm Menu', 'uxmastery' ); ?>
                            </a>
                        </li>
                    </ul>
	            <?php endif; ?>

                <?php if ( !empty( $chat_zalo ) ) : ?>
                    <div class="module-container">
                        <div class="module module-cta">
                            <a class="btn btn--white btn--secondary chat-zalo" href="<?php echo esc_url( $chat_zalo ) ?>" target="_blank">
                                <span><?php esc_html_e('Liên hệ ngay', 'uxmastery'); ?> <i class="fa-solid fa-arrow-right-long"></i></span>
                            </a>
                        </div>
                    </div>
                <?php endif; ?>
            </div>
            <!-- End .nav-collapse-->
        </div>
        <!-- End .container-->
    </nav>
    <!-- End .navbar-->
</header>