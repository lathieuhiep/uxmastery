<?php
global $prefix_theme_options;

// Create a section social network
$max_social_networks = count( uxmastery_list_social_network() );

CSF::createSection( $prefix_theme_options, array(
	'title'  => esc_html__( 'Mạng xã hội', 'uxmastery' ),
	'icon'   => 'fab fa-hive',
	'fields' => array(
		array(
			'id'      => 'opt_social_networks',
			'type'    => 'repeater',
			'title'   => esc_html__( 'Mạng xã hội', 'uxmastery' ),
			'max'     => $max_social_networks,
			'fields'  => array(
				array(
					'id'          => 'item',
					'type'        => 'select',
					'title'       => 'Select',
					'placeholder' => esc_html__( '--Chọn mạng xã hội--', 'uxmastery' ),
					'options'     => uxmastery_list_social_network(),
				),

				array(
					'id'      => 'url',
					'type'    => 'text',
					'title'   => esc_html__( 'URL', 'uxmastery' ),
					'default' => '#'
				),
			),
			'default' => array(
				array(
					'item' => 'facebook-f',
					'url'  => '#',
				),

				array(
					'item' => 'youtube',
					'url'  => '#',
				),
			)
		),
	)
) );