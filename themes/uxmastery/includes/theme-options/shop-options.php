<?php
global $prefix_theme_options;

//
//  Create a section shop
CSF::createSection( $prefix_theme_options, array(
	'id'    => 'opt_shop_section',
	'title' => esc_html__( 'Của hàng', 'uxmastery' ),
	'icon'  => 'fas fa-shopping-cart',
) );

// Category product
CSF::createSection( $prefix_theme_options, array(
	'parent'      => 'opt_shop_section',
	'title'       => esc_html__( 'Danh mục', 'uxmastery' ),
	'description' => esc_html__( 'Sử dụng cho danh mục và thẻ cửa hàng', 'uxmastery' ),
	'fields'      => array(
		// Sidebar
		array(
			'id'      => 'opt_shop_cat_sidebar_position',
			'type'    => 'select',
			'title'   => esc_html__( 'Vị trí sidebar', 'uxmastery' ),
			'options' => array(
				'hide'  => esc_html__( 'Ẩn', 'uxmastery' ),
				'left'  => esc_html__( 'Trái', 'uxmastery' ),
				'right' => esc_html__( 'Phải', 'uxmastery' ),
			),
			'default' => 'left'
		),

		// Limit
		array(
			'id'      => 'opt_shop_cat_limit',
			'type'    => 'number',
			'title'   => esc_html__( 'Số lượng sản phẩm hiển thị', 'uxmastery' ),
			'default' => 12,
		),

		// Per Row
		array(
			'id'      => 'opt_shop_cat_per_row',
			'type'    => 'select',
			'title'   => esc_html__( 'Số sản phẩm trên một hàng', 'uxmastery' ),
			'options' => array(
				'3' => esc_html__( '3', 'uxmastery' ),
				'4' => esc_html__( '4', 'uxmastery' ),
				'5' => esc_html__( '5', 'uxmastery' ),
			),
			'default' => '4'
		),
	)
) );

// Single product
CSF::createSection( $prefix_theme_options, array(
	'parent'      => 'opt_shop_section',
	'title'       => esc_html__( 'Chi tiết', 'uxmastery' ),
	'description' => esc_html__( 'Sử dụng cho chi tiết sản phẩm', 'uxmastery' ),
	'fields'      => array(
		// Sidebar
		array(
			'id'      => 'opt_shop_single_sidebar_position',
			'type'    => 'select',
			'title'   => esc_html__( 'Vị trí sidebar', 'uxmastery' ),
			'options' => array(
				'hide'  => esc_html__( 'Ẩn', 'uxmastery' ),
				'left'  => esc_html__( 'Trái', 'uxmastery' ),
				'right' => esc_html__( 'Phải', 'uxmastery' ),
			),
			'default' => 'left'
		)
	)
) );