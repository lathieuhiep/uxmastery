<?php
add_action('cmb2_admin_init', 'uxmastery_ctp_course_meta_boxes');
function uxmastery_ctp_course_meta_boxes(): void
{
    $cmb = new_cmb2_box(array(
        'id' => 'cmb_cpt_course',
        'title' => esc_html__('Thiết lập', 'uxmastery'),
        'object_types' => array('ux_course'),
        'context' => 'normal',
        'priority' => 'low',
        'show_names' => true,
    ));

    $cmb->add_field(array(
        'name' => esc_html__('Cấp độ', 'uxmastery'),
        'desc' => esc_html__('Chọn cấp độ của khóa học', 'uxmastery'),
        'id' => 'cmb_cpt_course_level',
        'type' => 'select',
        'options' => array(
            '1' => esc_html__('Cơ bản', 'uxmastery'),
            '2' => esc_html__('Nâng cao', 'uxmastery'),
        ),
        'default' => '1',
        'attributes' => [
            'required' => 'required',
        ],
    ));

    $cmb->add_field(array(
        'id' => 'cmb_cpt_course_price',
        'name' => esc_html__('Chi phí', 'uxmastery'),
        'type' => 'text',
        'attributes' => array(
            'type' => 'number',
            'class' => 'cmb2-formatted-currency',
            'pattern' => '\d*',
        ),
        'after_field' => ' <span class="cmb2-unit">VNĐ</span>',
    ));

    $cmb->add_field([
        'name' => esc_html__('Giảng viên', 'uxmastery'),
        'id' => 'cmb_cpt_select_teacher',
        'type' => 'select',
        'options' => uxmastery_get_cpt_options(esc_html__('— Chọn giáo viên —', 'uxmastery'), 'ux_teacher'),
    ]);

    $group_lessons = $cmb->add_field(array(
        'id' => 'cmb_cpt_course_lessons',
        'type' => 'group',
        'name' => esc_html__('Danh sách bài học', 'uxmastery'),
        'description' => esc_html__('Thêm các bài học cho khóa học này', 'uxmastery'),
        'options' => array(
            'group_title' => 'Bài học {#}', // Số thứ tự auto
            'add_button' => 'Thêm bài học',
            'remove_button' => 'Xóa',
            'sortable' => true,
            'closed' => true,
        ),
    ));

    $cmb->add_group_field($group_lessons, array(
        'name' => esc_html__('Tiêu đề hiển thị', 'uxmastery'),
        'id' => 'title',
        'type' => 'text',
        'desc' => 'Nhập tiêu đề riêng nếu muốn khác với tiêu đề gốc của bài học.',
        'attributes' => [
            'placeholder' => 'Mặc định lấy tiêu đề bài học',
        ],
    ));

    $cmb->add_group_field($group_lessons, array(
        'name' => 'Bài học',
        'id' => 'lesson',
        'type' => 'select',
        'options' => uxmastery_get_cpt_options(esc_html__('— Chọn bài học —', 'uxmastery'), 'ux_lesson'),
    ));
}