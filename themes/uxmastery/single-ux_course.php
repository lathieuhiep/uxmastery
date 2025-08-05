<?php
get_header();

get_template_part( 'template-parts/parts/breadcrumbs' );
?>
    <div class="site-container single-course-warp has-breadcrumbs">
        <div class="container">
            <?php
            if ( have_posts() ) :
                while ( have_posts() ) : the_post();

                $course_level = get_post_meta(get_the_ID(), 'cmb_cpt_course_level', true);
                $course_price = get_post_meta(get_the_ID(), 'cmb_cpt_course_price', true);
                $course_teacher = get_post_meta(get_the_ID(), 'cmb_cpt_course_select_teacher', true);
                ?>

                <article id="course-<?php the_ID(); ?>" <?php post_class('course-warp'); ?>>
                    <div class="content-wrap">
                        <h1 class="entry-title"><?php the_title(); ?></h1>

                        <div class="entry-content">
                            <?php the_content(); ?>
                        </div>
                    </div>

                    <div class="info">
                        <div class="info__box">
                            <div class="item level">
                                <span class="label"><?php esc_html_e('Cấp độ:', 'uxmastery'); ?></span>
                                <span class="value"><?php echo esc_html($course_level); ?></span>
                            </div>

                            <div class="item price">
                                <span class="label"><?php esc_html_e('Chi phí:', 'uxmastery'); ?></span>
                                <span class="value"><?php echo esc_html(number_format($course_price, 0, ',', '.')); ?> VNĐ</span>
                            </div>

                            <?php
                            if ( $course_teacher ) :
                                $teacher = get_post($course_teacher);

                                $zalo = uxmastery_get_option( 'opt_contact_zalo' );
                                ?>
                                <div class="item teacher">
                                    <span class="label"><?php esc_html_e('Giảng viên:', 'uxmastery'); ?></span>

                                    <div class="info-teacher">
                                        <div class="avatar">
                                            <?php echo get_the_post_thumbnail($teacher->ID, 'thumbnail'); ?>
                                        </div>

                                        <div class="content">
                                            <h3 class="name"><?php echo esc_html($teacher->post_title); ?></h3>

                                            <div class="description">
                                                <?php the_content(); ?>
                                            </div>
                                        </div>
                                    </div>

                                    <?php if ( $zalo ) : ?>
                                        <div class="action-box">
                                            <a href="<?php echo esc_url( $zalo ); ?>" class="btn-link btn-contact-zalo" target="_blank">
                                                <i class="ic-mask ic-mask-bag"></i>
                                                <span class="txt"><?php esc_html_e('Liên hệ mua ngay', 'uxmastery'); ?></span>
                                            </a>
                                        </div>
                                    <?php endif; ?>
                                </div>
                            <?php endif; ?>
                        </div>
                    </div>
                </article>

                <?php
                endwhile;
            endif;
            wp_reset_query();
            ?>
        </div>
    </div>
<?php
get_footer();
