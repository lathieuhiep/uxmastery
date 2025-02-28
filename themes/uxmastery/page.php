<?php
get_header();

$uxmastery_check_elementor = get_post_meta( get_the_ID(), '_elementor_edit_mode', true );
$uxmastery_class_elementor = '';
if ( $uxmastery_check_elementor ) :
	$uxmastery_class_elementor = ' site-container-elementor';
endif;
?>
    <main class="site-container<?php echo esc_attr( $uxmastery_class_elementor ); ?>">
		<?php
		if ( $uxmastery_check_elementor ) :
			get_template_part( 'template-parts/page/content', 'page-elementor' );
		else:
			get_template_part( 'template-parts/page/content', 'page' );
		endif;
		?>
    </main>
<?php
get_footer();