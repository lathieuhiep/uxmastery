<?php
function uxmastery_register_cpt_lesson(): void
{
    // register post type
    $labels = array(
        'name' => esc_html__('Bài học', 'uxmastery'),
        'singular_name' => esc_html__('Bài học', 'uxmastery'),
        'add_new' => esc_html__('Thêm bài học', 'uxmastery'),
        'add_new_item' => esc_html__('Thêm mới', 'uxmastery'),
        'edit_item' => esc_html__('Chỉnh sửa', 'uxmastery'),
        'new_item' => esc_html__('Bài học mới', 'uxmastery'),
        'view_item' => esc_html__('Xem', 'uxmastery'),
        'search_items' => esc_html__('Tìm kiếm', 'uxmastery'),
        'not_found' => esc_html__('Không tìm thấy bài học nào.', 'uxmastery'),
        'not_found_in_trash' => esc_html__('Không có bài học nào trong thùng rác.', 'uxmastery'),
    );

    register_post_type('ux_lesson', [
        'labels' => $labels,
        'public' => false,
        'show_ui' => true,
        'has_archive' => false,
        'rewrite' => ['slug' => 'bai-hoc'],
        'menu_position' => 7,
        'menu_icon' => 'dashicons-media-text',
        'supports' => ['title', 'editor', 'excerpt'],
        'show_in_rest' => true,
        'show_in_menu' => true,
    ]);
}

add_action('init', 'uxmastery_register_cpt_lesson');