<?php
$show_copyright = uxmastery_get_option('opt_footer_copyright_show', '1');
$copyright = uxmastery_get_option('opt_footer_copyright_content', 'Copyright &copy; DiepLK');

if ( $show_copyright == '1' ) :
?>
    <div class="footer-copyright text--center">
        <div class="container">
            <hr/>

            <div class="copyright">
                <?php echo wpautop( $copyright ); ?>
            </div>

            <div class="footer-social">
                <ul class="list-unstyled">
                    <li> <a href="javascript:void(0)"><i class="fab fa-facebook-f"></i></a></li>
                    <li> <a href="javascript:void(0)"><i class="fab fa-twitter"></i></a></li>
                    <li> <a href="javascript:void(0)"><i class="fab fa-dribbble"></i></a></li>
                    <li> <a href="javascript:void(0)"><i class="fab fa-behance"></i></a></li>
                </ul>
            </div>
        </div>
    </div>
<?php endif; ?>