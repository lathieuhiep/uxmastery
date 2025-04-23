<?php
// register widget elementor
add_action( 'elementor/widgets/register', 'efa_register_widget_elementor_addon' );
function efa_register_widget_elementor_addon( $widgets_manager ): void {
	// include add on
	require_once EFA_PLUGIN_PATH . 'includes/widgets/elementor/connect-link.php';
	require_once EFA_PLUGIN_PATH . 'includes/widgets/elementor/hero.php';
	require_once EFA_PLUGIN_PATH . 'includes/widgets/elementor/heading-with-editor.php';
	require_once EFA_PLUGIN_PATH . 'includes/widgets/elementor/image-and-text-block.php';
	require_once EFA_PLUGIN_PATH . 'includes/widgets/elementor/service-card.php';
	require_once EFA_PLUGIN_PATH . 'includes/widgets/elementor/testimonial.php';
	require_once EFA_PLUGIN_PATH . 'includes/widgets/elementor/video-popup.php';
	require_once EFA_PLUGIN_PATH . 'includes/widgets/elementor/special-title.php';
	require_once EFA_PLUGIN_PATH . 'includes/widgets/elementor/post-grid.php';
	require_once EFA_PLUGIN_PATH . 'includes/widgets/elementor/dual-post-block.php';
	require_once EFA_PLUGIN_PATH . 'includes/widgets/elementor/service-grid.php';
	require_once EFA_PLUGIN_PATH . 'includes/widgets/elementor/book-curriculum.php';

//	require_once EFA_PLUGIN_PATH . 'includes/widgets/elementor/carousel-images.php';
//	require_once EFA_PLUGIN_PATH . 'includes/widgets/elementor/contact-form-7.php';
//	require_once EFA_PLUGIN_PATH . 'includes/widgets/elementor/post-carousel.php';
//	require_once EFA_PLUGIN_PATH . 'includes/widgets/elementor/slides.php';


	// register add on
	$widgets_manager->register( new \EFA_Widget_Connect_Link() );
	$widgets_manager->register( new \EFA_Widget_Hero() );
	$widgets_manager->register( new \EFA_Widget_Heading_With_Editor() );
	$widgets_manager->register( new \EFA_Widget_Image_And_Text_Block() );
	$widgets_manager->register( new \EFA_Widget_Service_Card() );
	$widgets_manager->register( new \EFA_Widget_Testimonial() );
	$widgets_manager->register( new \EFA_Widget_Video_Popup() );
	$widgets_manager->register( new \EFA_Widget_Special_Title() );
	$widgets_manager->register( new \EFA_Widget_Post_Grid() );
	$widgets_manager->register( new \EFA_Widget_Dual_Post_Block() );
	$widgets_manager->register( new \EFA_Widget_Service_Grid() );
	$widgets_manager->register( new \EFA_Widget_Book_Curriculum() );

//	$widgets_manager->register( new \EFA_Widget_Carousel_Images() );
//	$widgets_manager->register( new \EFA_Widget_Contact_Form_7() );
//	$widgets_manager->register( new \EFA_Widget_Post_Carousel() );
//	$widgets_manager->register( new \EFA_Widget_Slides() );

}