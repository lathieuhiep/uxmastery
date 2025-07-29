<?php
global $prefix_theme_options;

$link = esc_url( 'https://loading.io/' );
// Create a section general
CSF::createSection( $prefix_theme_options, array(
	'title'  => esc_html__( 'Cài đặt chung', 'uxmastery' ),
	'icon'   => 'fas fa-cog',
	'fields' => array(
		// logo
		array(
			'id'      => 'opt_general_logo_light',
			'type'    => 'media',
			'title'   => esc_html__( 'Logo sáng', 'uxmastery' ),
			'library' => 'image',
			'url'     => false
		),

		array(
			'id'      => 'opt_general_logo_dark',
			'type'    => 'media',
			'title'   => esc_html__( 'Logo tối', 'uxmastery' ),
			'library' => 'image',
			'url'     => false
		),

		// show loading
		array(
			'id'         => 'opt_general_loading',
			'type'       => 'switcher',
			'title'      => esc_html__( 'Hiện tải trang', 'uxmastery' ),
			'text_on'    => esc_html__( 'Có', 'uxmastery' ),
			'text_off'   => esc_html__( 'Không', 'uxmastery' ),
			'text_width' => 80,
			'default'    => false
		),

		array(
			'id'         => 'opt_general_image_loading',
			'type'       => 'media',
			'title'      => esc_html__( 'Chọn ảnh tải trang', 'uxmastery' ),
			'subtitle'   => sprintf(
				esc_html__( 'Sử dụng ảnh .git %s', 'uxmastery' ),
				'<a href="' . $link . '" target="_blank">loading.io</a>'
			),
			'dependency' => array( 'opt_general_loading', '==', 'true' ),
			'url'        => false
		),

		// show back to top
		array(
			'id'         => 'opt_general_back_to_top',
			'type'       => 'switcher',
			'title'      => esc_html__( 'Hiện nút quay về đầu trang', 'uxmastery' ),
			'text_on'    => esc_html__( 'Có', 'uxmastery' ),
			'text_off'   => esc_html__( 'Không', 'uxmastery' ),
			'text_width' => 80,
			'default'    => true
		),
	)
) );