<?php
$sticky_menu       = uxmastery_get_option( 'opt_menu_sticky', '1' );
$logo_light        = uxmastery_get_option( 'opt_general_logo_light' );
$logo_dark         = uxmastery_get_option( 'opt_general_logo_dark' );
$menu_contact      = uxmastery_get_option( 'opt_menu_contact' );
?>

<header class="header header-transparent header-sticky">
    <nav class="navbar navbar-sticky navbar-expand-lg" id="primary-menu">
        <div class="container">
            <a class="logo navbar-brand" href="<?php echo esc_url( get_home_url( '/' ) ); ?>">
				<?php
				if ( ! empty( $logo_light['id'] ) || ! empty( $logo_dark['id'] ) ) :
					if ( ! empty( $logo_dark['id'] ) ) :
						echo wp_get_attachment_image( $logo_dark['id'], 'medium', false, array( "class" => "logo-dark" ) );
					endif;

                    if ( ! empty( $logo_light['id'] ) ) :
	                    echo wp_get_attachment_image( $logo_light['id'], 'medium', false, array( "class" => "logo-light" ) );
                    endif;
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

                <?php if ( $menu_contact ) : ?>
                    <div class="module-container">
                        <div class="module module-cta">
                            <button type="button" class="btn btn--white btn--secondary" data-toggle="modal" data-target="#contactMenuModal">
                                <span><?php esc_html_e('contact us', 'uxmastery'); ?> <i class="fa-solid fa-arrow-right-long"></i></span>
                            </button>
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

<?php get_template_part('template-parts/modals/contact', 'menu'); ?>