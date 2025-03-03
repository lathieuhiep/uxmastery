    <?php if ( !is_404() ) : ?>
        <footer class="footer" id="footer">
            <?php
            get_template_part( 'template-parts/footer/footer','sidebar' );

            get_template_part( 'template-parts/footer/footer','copyright' );
            ?>
        </footer>
    <?php endif; ?>
</div><!-- end class wrapper -->

<?php
$opt_back_to_top = uxmastery_get_option( 'opt_general_back_to_top', '1' );

get_template_part('template-parts/parts/loading');

if ( $opt_back_to_top == '1' ) :
?>
    <div id="back-top">
        <a href="#">
            <i class="fas fa-chevron-up"></i>
        </a>
    </div>
<?php endif; ?>

<?php wp_footer(); ?>

</body>
</html>
