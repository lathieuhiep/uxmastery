<?php
add_action('cmb2_admin_init', 'uxmastery_ctp_course_meta_boxes');
function uxmastery_ctp_course_meta_boxes(): void {
    $cmb = new_cmb2_box(array(
        'id' => 'cmb_cpt_course',
        'title' => esc_html__('Thiết lập', 'uxmastery'),
        'object_types' => array('ux_course'),
        'context' => 'normal',
        'priority' => 'low',
        'show_names' => true,
    ));

    $cmb->add_field( array(
        'id'   => 'cmb_cpt_course_price',
        'name' => esc_html__( 'Giá', 'uxmastery' ),
        'type' => 'text_money',
        'attributes'   => [
            'class' => 'cmb2-col-2',
            'min'  => 0,
        ],
        'before_field' => 'VND',
    ) );
}