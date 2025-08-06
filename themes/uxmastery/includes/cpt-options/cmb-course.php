<?php
add_action('cmb2_admin_init', 'uxmastery_ctp_course_meta_boxes');
function uxmastery_ctp_course_meta_boxes(): void
{
    // info base
    $cmb_cpt_course_base = new_cmb2_box(array(
        'id' => 'cmb_cpt_course_base',
        'title' => esc_html__('Thông tin cơ bản', 'uxmastery'),
        'object_types' => array('ux_course'),
        'context' => 'normal',
        'priority' => 'low',
        'show_names' => true,
    ));

    $cmb_cpt_course_base->add_field(array(
        'name' => esc_html__('Cấp độ', 'uxmastery'),
        'desc' => esc_html__('Chọn cấp độ của khóa học', 'uxmastery'),
        'id' => 'cmb_cpt_course_level',
        'type' => 'select',
        'options' => uxmastery_ctp_course_level(),
        'default' => '1',
        'attributes' => [
            'required' => 'required',
        ],
    ));

    $cmb_cpt_course_base->add_field(array(
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

    $cmb_cpt_course_base->add_field([
        'name' => esc_html__('Giảng viên', 'uxmastery'),
        'id' => 'cmb_cpt_course_select_teacher',
        'type' => 'select',
        'options' => uxmastery_get_cpt_options(esc_html__('— Chọn giáo viên —', 'uxmastery'), 'ux_teacher'),
    ]);

    // lessons
    $cmb_cpt_course_lessons = new_cmb2_box(array(
        'id' => 'cmb_cpt_course_lessons',
        'title' => esc_html__('Nội dung giáo trình', 'uxmastery'),
        'object_types' => array('ux_course'),
        'context' => 'normal',
        'priority' => 'low',
        'show_names' => true,
    ));

    $cmb_cpt_course_lessons->add_field([
        'name' => esc_html__('Chọn bài học', 'uxmastery'),
        'id' => 'cmb_cpt_course_lessons',
        'type' => 'post_ajax_search',
        'multiple-item' => true,
        'sortable' => true,
        'desc' => esc_html__('Sử dụng thì số lượng và sắp xếp sẽ nhận theo trường này. Nhập tên để tìm kiếm.', 'uxmastery'),
        'query_args' => array(
            'post_type' => 'ux_lesson',
            'post_status' => array('publish'),
        )
    ]);
    
    // services
    $cmb_cpt_course_services = new_cmb2_box( array(
        'id'            => 'cmb_cpt_course_services',
        'title'         => esc_html__( 'Giá trị bạn nhận được', 'uxmastery' ),
        'object_types'  => array( 'ux_course', ),
        'context'       => 'normal',
        'priority'      => 'low',
        'show_names'    => true,
    ) );
    
    $cmb_cpt_course_services->add_field( array(
        'name'       => esc_html__( 'Giá trị', 'uxmastery' ),
        'id'         => 'cmb_cpt_course_benefits_list',
        'type'       => 'text',
        'repeatable' => true,
        'classes'    => 'custom-wide-input',
        'text' => array(
            'add_row_text' => esc_html__( 'Thêm giá trị khác', 'uxmastery' ),
        ),
    ) );
    
    // audience
    $cmb_cpt_course_audience = new_cmb2_box( array(
        'id'            => 'cmb_cpt_course_audience_box',
        'title'         => esc_html__( 'Giáo trình phù hợp với ai', 'uxmastery' ),
        'object_types'  => array( 'ux_course', ),
        'context'       => 'normal',
        'priority'      => 'low',
        'show_names'    => true,
    ) );

    $cmb_cpt_course_audience->add_field( array(
        'name'       => esc_html__( 'Đối tượng', 'uxmastery' ),
        'id'         => 'cmb_cpt_course_audience_list',
        'type'       => 'text',
        'repeatable' => true,
        'classes'    => 'custom-wide-input',
        'text' => array(
            'add_row_text' => esc_html__( 'Thêm đối tượng', 'uxmastery' ),
        ),
    ) );
}

// Cấp độ khóa học
function uxmastery_ctp_course_level(): array
{
    return [
        '1' => esc_html__('Cơ bản', 'uxmastery'),
        '2' => esc_html__('Nâng cao', 'uxmastery'),
    ];
}

// get level name
function uxmastery_get_course_level_name($value): string
{
    $levels = uxmastery_ctp_course_level();

    return $levels[$value] ?? esc_html__('Không xác định', 'uxmastery');
}