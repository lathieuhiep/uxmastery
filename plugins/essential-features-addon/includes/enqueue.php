<?php
// register scripts
add_action( 'wp_enqueue_scripts', 'efa_elementor_script_libs' );
function efa_elementor_script_libs (): void {
	$efa_check_elementor = get_post_meta( get_the_ID(), '_elementor_edit_mode', true );

	if ( $efa_check_elementor == 'builder' ) {
		// lity
		wp_register_style( 'lity', EFA_PLUGIN_URL . 'assets/libs/lity/lity.min.css' );
		wp_register_script( 'lity', EFA_PLUGIN_URL . 'assets/libs/lity/lity.min.js', array( 'jquery' ), '2.4.1', true );

		// owl.carousel
		wp_register_style( 'owl.carousel', EFA_PLUGIN_URL . 'assets/libs/owl.carousel/owl.carousel.min.css' );
		wp_register_script('owl.carousel', EFA_PLUGIN_URL . 'assets/libs/owl.carousel/owl.carousel.min.js', array('jquery'), '2.3.4', true);

		// counterup
		wp_register_script( 'counterup', EFA_PLUGIN_URL . 'assets/libs/jquery.counterup.min.js', array( 'jquery' ), '1.0', true );

		// js plugin
		wp_register_script( 'efa-elementor-script', EFA_PLUGIN_URL . 'assets/js/efa-elementor.min.js', array( 'jquery' ), EFA_PLUGIN_VERSION, true );
	}
}

add_action( 'wp_enqueue_scripts', 'efa_elementor_scripts',21 );
function efa_elementor_scripts(): void {
	$efa_check_elementor = get_post_meta( get_the_ID(), '_elementor_edit_mode', true );

	if ( $efa_check_elementor == 'builder' ) {
		// style plugin
		wp_enqueue_style( 'efa-elementor-style', EFA_PLUGIN_URL . 'assets/css/efa-elementor.min.css', array(), EFA_PLUGIN_VERSION );
	}
}