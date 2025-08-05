<?php
function uxmastery_register_cpt_teacher(): void
{
    // register post type
    $labels = array(
        'name' => esc_html__('Giảng viên', 'uxmastery'),
        'singular_name' => esc_html__('Giảng viên', 'uxmastery'),
        'add_new' => esc_html__('Thêm giảng viên', 'uxmastery'),
        'add_new_item' => esc_html__('Thêm mới', 'uxmastery'),
        'edit_item' => esc_html__('Chỉnh sửa', 'uxmastery'),
        'new_item' => esc_html__('Giảng viên mới', 'uxmastery'),
        'view_item' => esc_html__('Xem', 'uxmastery'),
        'search_items' => esc_html__('Tìm kiếm', 'uxmastery'),
        'not_found' => esc_html__('Không tìm thấy giảng viên nào.', 'uxmastery'),
        'not_found_in_trash' => esc_html__('Không có giảng viên nào trong thùng rác.', 'uxmastery'),
        'menu_name' => esc_html__('Giảng viên', 'uxmastery'),
    );

    register_post_type('ux_teacher', [
        'labels' => $labels,
        'public' => false,
        'show_ui' => true,
        'has_archive' => false,
        'rewrite' => ['slug' => 'giang-vien'],
        'menu_position' => 8,
        'menu_icon' => 'dashicons-admin-users',
        'supports' => ['title', 'editor', 'thumbnail'],
        'show_in_rest' => true,
        'show_in_menu' => true,
    ]);
}

add_action('init', 'uxmastery_register_cpt_teacher');