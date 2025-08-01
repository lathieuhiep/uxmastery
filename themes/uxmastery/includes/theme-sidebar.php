<?php
/* Better way to add multiple widgets areas */
function uxmastery_register_sidebar( $name, $id, $description = '' ): void {
	register_sidebar( array(
		'name'          => $name,
		'id'            => $id,
		'description'   => $description,
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget'  => '</div>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );
}

add_action( 'widgets_init', 'uxmastery_multiple_widget_init' );
function uxmastery_multiple_widget_init(): void {
	uxmastery_register_sidebar( esc_html__( 'Sidebar chính', 'uxmastery' ), 'sidebar-main', 'Dùng ở các trang bài viết' );
	uxmastery_register_sidebar( esc_html__( 'Sidebar dịch vụ', 'uxmastery' ), 'sidebar-service', 'Dùng ở chi tiết dịch vụ' );

	// sidebar footer
	$opt_number_columns = uxmastery_get_option( 'opt_footer_columns', '4' );
	for ( $i = 1; $i <= $opt_number_columns; $i ++ ) {
		uxmastery_register_sidebar( sprintf( esc_html__( 'Sidebar chân trang cột %d', 'uxmastery' ), $i ),
			'sidebar-footer-column-' . $i,
			esc_html__( 'Dùng ở chân trang', 'uxmastery' ) );
	}

    // sidebar footer full
    uxmastery_register_sidebar( esc_html__( 'Sidebar footer full', 'uxmastery' ), 'sidebar-footer-full', 'Dùng ở chân trang' );
}