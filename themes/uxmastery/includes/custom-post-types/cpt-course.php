<?php
function uxmastery_register_cpt_course(): void
{
    // register post type
    $labels = array(
        'name' => esc_html__('Khoá học', 'uxmastery'),
        'singular_name' => esc_html__('Khoá học', 'uxmastery'),
        'add_new' => esc_html__('Thêm mới', 'uxmastery'),
        'add_new_item' => esc_html__('Thêm khóa học', 'uxmastery'),
        'edit_item' => esc_html__('Chỉnh sửa', 'uxmastery'),
        'new_item' => esc_html__('Khoá học mới', 'uxmastery'),
        'view_item' => esc_html__('Xem', 'uxmastery'),
        'search_items' => esc_html__('Tìm kiếm', 'uxmastery'),
        'not_found' => esc_html__('Không tìm thấy khoá học nào.', 'uxmastery'),
        'not_found_in_trash' => esc_html__('Không có khoá học nào trong thùng rác.', 'uxmastery'),
    );

    register_post_type('ux_course', [
        'labels' => $labels,
        'public' => true,
        'has_archive' => false,
        'rewrite' => ['slug' => 'khoa-hoc'],
        'menu_position' => 6,
        'menu_icon' => 'dashicons-welcome-learn-more',
        'supports' => ['title', 'editor', 'thumbnail', 'excerpt'],
        'show_in_rest' => true,
        'show_in_menu' => true,
    ]);

    // register taxonomy
    $tax_labels = array(
        'name' => esc_html__('Danh mục khoá học', 'uxmastery'),
        'singular_name' => esc_html__('Danh mục', 'uxmastery'),
        'search_items' => esc_html__('Tìm danh mục', 'uxmastery'),
        'all_items' => esc_html__('Tất cả danh mục', 'uxmastery'),
        'edit_item' => esc_html__('Chỉnh sửa danh mục', 'uxmastery'),
        'update_item' => esc_html__('Cập nhật danh mục', 'uxmastery'),
        'add_new_item' => esc_html__('Thêm danh mục mới', 'uxmastery'),
        'new_item_name' => esc_html__('Tên danh mục mới', 'uxmastery'),
        'menu_name' => esc_html__('Danh mục', 'uxmastery'),
    );

    register_taxonomy('ux_course_category', 'ux_course', [
        'labels' => $tax_labels,
        'hierarchical' => true,
        'show_ui' => true,
        'show_admin_column' => true,
        'show_in_menu' => true,
        'show_in_nav_menus' => true,
        'show_in_rest' => true,
        'rewrite' => array('slug' => 'danh-sach-khoa-hoc'),
    ]);
}

add_action('init', 'uxmastery_register_cpt_course');

// add custom taxonomy filter to CPT
add_action('init', function() {
    uxmastery_add_custom_taxonomy_filter_to_cpt('ux_course', 'ux_course_category');
});