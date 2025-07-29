<?php
$opt_number_columns = uxmastery_get_option('opt_footer_columns', '4');

if( is_active_sidebar( 'sidebar-footer-column-1' ) || is_active_sidebar( 'sidebar-footer-column-2' ) || is_active_sidebar( 'sidebar-footer-column-3' ) || is_active_sidebar( 'sidebar-footer-column-4' ) ) :

?>
    <div class="footer-widgets-container">
        <div class="container">
            <div class="row row-gap-6">
	            <?php
	            for( $i = 0; $i < $opt_number_columns; $i++ ):
		            $j = $i +1;
		            $cols = uxmastery_get_option( 'opt_footer_column_width_' .  $j);

                    if ( empty( $cols ) ) {
	                    $cols = [
		                    'sm' => 12,
		                    'md' => 6,
		                    'lg' => 3,
		                    'xl' => 3
                        ];
                    }

		            if( is_active_sidebar( 'sidebar-footer-column-'.$j ) ):
			            ?>
                        <div class="col-12 col-sm-<?php echo esc_attr( $cols['sm'] ); ?> col-md-<?php echo esc_attr( $cols['md'] ); ?> col-lg-<?php echo esc_attr( $cols['lg'] ); ?> col-xl-<?php echo esc_attr( $cols['xl'] ); ?>">
                            <div class="footer-widget">
	                            <?php dynamic_sidebar( 'sidebar-footer-column-'.$j ); ?>
                            </div>
                        </div>
		            <?php
		            endif;
	            endfor;
	            ?>
            </div>
        </div>
    </div>
<?php endif; ?>