<?php
$course_level = get_post_meta(get_the_ID(), 'cmb_cpt_course_level', true);
$course_price = get_post_meta(get_the_ID(), 'cmb_cpt_course_price', true);
$course_teacher = get_post_meta(get_the_ID(), 'cmb_cpt_course_select_teacher', true);
?>

<div class="info">
    <div class="info__box">
        <div class="item level">
            <span class="label"><?php esc_html_e('Cấp độ:', 'uxmastery'); ?></span>
            <span class="value"><?php echo esc_html( uxmastery_get_course_level_name($course_level) ); ?></span>
        </div>

        <div class="item price">
            <span class="label"><?php esc_html_e('Chi phí:', 'uxmastery'); ?></span>
            <span class="value"><?php echo esc_html(number_format($course_price, 0, ',', '.')); ?> VNĐ</span>
        </div>

        <?php
        if ( $course_teacher ) :
            $teacher = get_post($course_teacher);
            ?>
            <div class="item teacher">
                <span class="label"><?php esc_html_e('Người hướng dẫn:', 'uxmastery'); ?></span>

                <div class="info-teacher">
                    <div class="avatar">
                        <?php echo get_the_post_thumbnail($teacher->ID, 'thumbnail'); ?>
                    </div>

                    <div class="content">
                        <h3 class="name"><?php echo esc_html($teacher->post_title); ?></h3>

                        <div class="description">
                            <?php echo wpautop($teacher->post_content); ?>
                        </div>
                    </div>
                </div>
            </div>
        <?php endif; ?>

        <?php
        $zalo = uxmastery_get_option( 'opt_contact_zalo' );

        if ( $zalo ) :
            ?>
            <div class="action-box">
                <a href="<?php echo esc_url( $zalo ); ?>" class="btn-link btn-contact-zalo" target="_blank">
                    <i class="ic-mask ic-mask-bag"></i>
                    <span class="txt"><?php esc_html_e('Liên hệ mua ngay', 'uxmastery'); ?></span>
                </a>
            </div>
        <?php endif; ?>
    </div>
</div>