<?php
function uxmastery_register_services_cpt(): void {
	// register post type service
	$labels = array(
		'name'          => esc_html__( 'Dịch vụ', 'uxmastery' ),
		'singular_name' => esc_html__( 'Dịch vụ', 'uxmastery' ),
		'add_new'       => esc_html__( 'Thêm', 'uxmastery' ),
		'add_new_item'  => esc_html__( 'Thêm dịch vụ', 'uxmastery' ),
		'edit_item'     => esc_html__( 'Sửa dịch vụ', 'uxmastery' ),
		'new_item'      => esc_html__( 'Dịch vụ mới', 'uxmastery' ),
		'view_item'     => esc_html__( 'Xem dịch vụ', 'uxmastery' ),
		'search_items'  => esc_html__( 'Tìm kiếm dịch vụ', 'uxmastery' ),
		'menu_name'     => esc_html__( 'Dịch vụ', 'uxmastery' ),
	);

	$args = array(
		'label'         => esc_html__( 'Dịch vụ', 'uxmastery' ),
		'labels'        => $labels,
		'public'        => true,
		'menu_icon'     => 'dashicons-hammer',
		'supports'      => array( 'title', 'editor', 'thumbnail', 'excerpt' ),
		'has_archive'   => true,
		'rewrite'       => array( 'slug' => 'dich-vu' ),
		'show_in_rest'  => true,
		'menu_position' => 5,
	);

	register_post_type( 'ux_service', $args );

	// register taxonomy service_category
	$tax_labels = array(
		'name'          => esc_html__( 'Danh mục', 'uxmastery' ),
		'singular_name' => esc_html__( 'Danh mục', 'uxmastery' ),
		'search_items'  => esc_html__( 'Tìm Danh mục', 'uxmastery' ),
		'all_items'     => esc_html__( 'Tất cả Danh mục', 'uxmastery' ),
		'edit_item'     => esc_html__( 'Sửa Danh mục', 'uxmastery' ),
		'update_item'   => esc_html__( 'Cập nhật Danh mục', 'uxmastery' ),
		'add_new_item'  => esc_html__( 'Thêm Danh mục mới', 'uxmastery' ),
		'new_item_name' => esc_html__( 'Tên Danh mục mới', 'uxmastery' ),
		'menu_name'     => esc_html__( 'Danh mục', 'uxmastery' ),
	);

	$tax_args = array(
		'hierarchical'      => true,
		'labels'            => $tax_labels,
		'show_ui'           => true,
		'show_admin_column' => true,
		'show_in_rest'      => true,
		'rewrite'           => array( 'slug' => 'loai-dich-vu' ),
	);

	register_taxonomy( 'ux_service_category', array( 'ux_service' ), $tax_args );
}

add_action( 'init', 'uxmastery_register_services_cpt' );