<?php
global $prefix_theme_options;

// Create a section menu
CSF::createSection( $prefix_theme_options, array(
	'title'  => esc_html__( 'Menu', 'uxmastery' ),
	'icon'   => 'fas fa-bars',
	'fields' => array(
		// Sticky menu
		array(
			'id'         => 'opt_menu_sticky',
			'type'       => 'switcher',
			'title'      => esc_html__( 'Menu cố định', 'uxmastery' ),
			'text_on'    => esc_html__( 'Có', 'uxmastery' ),
			'text_off'   => esc_html__( 'Không', 'uxmastery' ),
			'text_width' => 80,
			'default'    => true
		),

		// Show contact form 7
		array(
			'id'         => 'opt_menu_contact',
			'type'       => 'switcher',
			'title'      => esc_html__( 'Hiện thị liên hệ', 'uxmastery' ),
			'subtitle'   => esc_html__( 'Sử dụng contact form 7', 'uxmastery' ),
			'text_on'    => esc_html__( 'Có', 'uxmastery' ),
			'text_off'   => esc_html__( 'Không', 'uxmastery' ),
			'text_width' => 80,
			'default'    => true
		),
	)
) );