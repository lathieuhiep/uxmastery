<?php
global $prefix_theme_options;

//
// -> Create a section blog (parent)
CSF::createSection( $prefix_theme_options, array(
	'id'    => 'opt_post_section',
	'icon'  => 'fas fa-blog',
	'title' => esc_html__( 'Bài viết', 'uxmastery' ),
) );

// Category Post
CSF::createSection( $prefix_theme_options, array(
	'parent'      => 'opt_post_section',
	'title'       => esc_html__( 'Danh mục', 'uxmastery' ),
	'description' => esc_html__( 'Sử dụng cho các trang archive, index, tìm kiếm', 'uxmastery' ),
	'fields'      => array(
		// Sidebar
		array(
			'id'      => 'opt_post_cat_sidebar_position',
			'type'    => 'select',
			'title'   => esc_html__( 'Vị trí sidebar', 'uxmastery' ),
			'options' => array(
				'hide'  => esc_html__( 'Ẩn', 'uxmastery' ),
				'left'  => esc_html__( 'Trái', 'uxmastery' ),
				'right' => esc_html__( 'Phải', 'uxmastery' ),
			),
			'default' => 'right'
		),

		// Per Row
		array(
			'id'      => 'opt_post_cat_per_row',
			'type'    => 'select',
			'title'   => esc_html__( 'Số bài viết trên mỗi hàng', 'uxmastery' ),
			'options' => array(
				'3' => esc_html__( '3', 'uxmastery' ),
				'4' => esc_html__( '4', 'uxmastery' ),
			),
			'default' => '3'
		),
	)
) );

// Single Post
CSF::createSection( $prefix_theme_options, array(
	'parent' => 'opt_post_section',
	'title'  => esc_html__( 'Bài viết chi tiết', 'uxmastery' ),
	'fields' => array(
		array(
			'id'      => 'opt_post_single_sidebar_position',
			'type'    => 'select',
			'title'   => esc_html__( 'Vị trí sidebar', 'uxmastery' ),
			'options' => array(
				'hide'  => esc_html__( 'Ẩn', 'uxmastery' ),
				'left'  => esc_html__( 'Trái', 'uxmastery' ),
				'right' => esc_html__( 'Phải', 'uxmastery' ),
			),
			'default' => 'right'
		),

		// Show related post
		array(
			'id'         => 'opt_post_single_related',
			'type'       => 'switcher',
			'title'      => esc_html__( 'Hiện thị bài viết liên quan', 'uxmastery' ),
			'text_on'    => esc_html__( 'Có', 'uxmastery' ),
			'text_off'   => esc_html__( 'Không', 'uxmastery' ),
			'default'    => true,
			'text_width' => 80
		),

		// Limit related post
		array(
			'id'      => 'opt_post_single_related_limit',
			'type'    => 'number',
			'title'   => esc_html__( 'Số lượng bài viết liên quan', 'uxmastery' ),
			'default' => 3,
		),
	)
) );