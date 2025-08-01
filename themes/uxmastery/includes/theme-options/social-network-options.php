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
			'type'    => 'group',
			'title'   => esc_html__( 'Mạng xã hội', 'uxmastery' ),
			'max'     => $max_social_networks,
			'fields'  => array(
                array(
                    'id'    => 'title',
                    'type'  => 'text',
                    'title' => esc_html__( 'Tên hiển thị', 'uxmastery' ),
                ),

				array(
					'id'      => 'url',
					'type'    => 'text',
					'title'   => esc_html__( 'URL liên kết', 'uxmastery' ),
					'default' => '#'
				),

                array(
                    'id'    => 'icon_image',
                    'type'  => 'media',
                    'title' => esc_html__( 'Icon tùy chỉnh (ảnh)', 'uxmastery' ),
                    'library' => 'image',
                    'url'   => false,
                    'preview' => true,
                ),
			),
		),
	)
) );