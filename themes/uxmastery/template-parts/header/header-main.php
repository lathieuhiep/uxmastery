<?php
$is_template_fixed_menu = is_page_template( 'templates/page-fixed-menu.php' );
$sticky_menu  = uxmastery_get_option( 'opt_menu_sticky', '1' );
$logo_light   = uxmastery_get_option( 'opt_general_logo_light' );
$logo_dark    = uxmastery_get_option( 'opt_general_logo_dark' );
$menu_contact = uxmastery_get_option( 'opt_menu_contact' );
$contact_zalo = uxmastery_get_option( 'opt_contact_zalo' );
$contact_avatar = uxmastery_get_option( 'opt_contact_avatar' );
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
			            'menu_class'     => 'navbar-nav',
			            'items_wrap'     => '<ul class="%2$s">%3$s</ul>',
		            ) );
	            else:
		            ?>
                    <ul class="navbar-nav">
                        <li class="nav-item active">
                            <a class="nav-link" href="<?php echo get_admin_url() . '/nav-menus.php'; ?>">
					            <?php esc_html_e( 'Thêm Menu', 'uxmastery' ); ?>
                            </a>
                        </li>
                    </ul>
	            <?php endif; ?>
            </div>
            <!-- End .nav-collapse-->

            <?php if ( $contact_avatar && $contact_avatar['id'] && $contact_zalo ) : ?>
                <div class="chat-header d-flex align-items-center">
                    <div class="avatar">
                        <?php echo wp_get_attachment_image( $contact_avatar['id'] ); ?>
                    </div>

                    <div class="message-content">
                        <h4 class="message-text mb-0">
                            <?php esc_html_e('Bạn cần trợ giúp ?', 'uxmastery'); ?>
                        </h4>

                        <a href="<?php echo esc_url( $contact_zalo ); ?>" class="action-button" target="_blank">
                            <span><?php esc_html_e('Hỏi chuyên gia ngay', 'uxmastery'); ?></span>
                            <i class="ic-mask ic-mask-external-link"></i>
                        </a>
                    </div>
                </div>
            <?php endif; ?>
        </div>
        <!-- End .container-->
    </nav>
    <!-- End .navbar-->
</header>