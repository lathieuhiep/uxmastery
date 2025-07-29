<?php
$show_copyright = uxmastery_get_option('opt_footer_copyright_show', '1');
$copyright = uxmastery_get_option('opt_footer_copyright_content', 'Copyright &copy; DiepLK');

if ( $show_copyright == '1' ) :
?>
<div class="container">
    <div class="footer-copyright text--center">
        <div class="copyright">
            <?php echo wpautop( $copyright ); ?>
        </div>

        <div class="footer-social">
            <?php uxmastery_get_social_url(); ?>
        </div>
    </div>
</div>
<?php endif; ?>