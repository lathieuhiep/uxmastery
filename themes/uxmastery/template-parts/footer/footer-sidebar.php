<?php
$opt_number_columns = uxmastery_get_option('opt_footer_columns', '4');

$has_active_sidebar = false;
for ( $i = 0; $i < $opt_number_columns; $i++ ) {
    if ( is_active_sidebar( 'sidebar-footer-column-' . ($i + 1) ) ) {
        $has_active_sidebar = true;
        break;
    }
}

if ( $has_active_sidebar ) :
    ?>
    <div class="footer-widgets-container">
        <div class="container">
            <div class="row row-gap-6">
                <?php
                for( $i = 0; $i < $opt_number_columns; $i++ ):
                    $sidebar_id = 'sidebar-footer-column-'. ($i + 1);

                    if ( is_active_sidebar( $sidebar_id ) ):
                        $cols = uxmastery_get_option( 'opt_footer_column_width_' .  ($i + 1));

                        if ( empty( $cols ) ) {
                            $cols = [
                                'sm' => 12,
                                'md' => 6,
                                'lg' => 3,
                                'xl' => 3
                            ];
                        }

                        $class_cols = ['col-12'];
                        foreach ( $cols as $breakpoint => $value ) {
                            if ( ! empty( $value ) ) {
                                $class_cols[] = "col-{$breakpoint}-" . esc_attr( $value );
                            }
                        }
                    ?>
                        <div class="<?php echo esc_attr( implode( ' ', $class_cols ) ); ?>">
                            <div class="footer-widget">
                                <?php dynamic_sidebar( $sidebar_id ); ?>
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