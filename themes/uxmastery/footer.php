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
get_template_part('template-parts/parts/sticky-contact-panel');
get_template_part('template-parts/parts/loading');

wp_footer();
 ?>
</body>
</html>
