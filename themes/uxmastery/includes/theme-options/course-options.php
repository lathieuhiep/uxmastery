<?php
//
// -> Create a section (parent)
CSF::createSection(PREFIX_THEME_OPTIONS, array(
    'id' => 'opt_course_section',
    'icon' => 'fab fa-discourse',
    'title' => esc_html__('Khóa học', 'uxmastery'),
));

// Category
CSF::createSection(PREFIX_THEME_OPTIONS, array(
    'parent' => 'opt_course_section',
    'title' => esc_html__('Danh mục', 'uxmastery'),
    'description' => esc_html__('Sử dụng cho trang danh mục khóa học', 'uxmastery'),
    'fields' => array(
        // Per Row
        array(
            'id' => 'opt_course_cat_per_row',
            'type' => 'fieldset',
            'title' => esc_html__('Số bài viết trên mỗi hàng', 'uxmastery'),
            'fields' => uxmastery_column_width_fields(1, 4, 1, 2, 3, 3),
        ),
    )
));