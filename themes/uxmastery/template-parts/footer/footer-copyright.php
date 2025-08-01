<?php
$show_copyright = uxmastery_get_option('opt_footer_copyright_show', '1');
$copyright = uxmastery_get_option('opt_footer_copyright_content', 'Copyright &copy; DiepLK');

if ( $show_copyright == '1' ) :
?>
<div class="container">
    <div class="footer-copyright">
        <?php if ( is_active_sidebar( 'sidebar-footer-full' ) ) : ?>
            <div class="sidebar-footer-full">
                <?php dynamic_sidebar( 'sidebar-footer-full' ); ?>
            </div>
        <?php endif; ?>

        <div class="copyright">
            <?php echo wpautop( $copyright ); ?>
        </div>
    </div>
</div>
<?php endif; ?>