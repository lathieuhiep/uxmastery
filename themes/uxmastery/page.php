<?php
get_header();

get_template_part( 'template-parts/parts/breadcrumbs' );

$class_page_elementor = uxmastery_get_elementor_container_class();
?>
    <main class="site-container<?php echo esc_attr( $class_page_elementor ); ?>">
		<?php
		if ( $class_page_elementor ) :
			get_template_part( 'template-parts/page/content', 'page-elementor' );
		else:
			get_template_part( 'template-parts/page/content', 'page' );
		endif;
		?>
    </main>
<?php
get_footer();