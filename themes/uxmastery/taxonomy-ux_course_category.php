<?php
get_header();

get_template_part( 'template-parts/parts/breadcrumbs' );

$zalo = uxmastery_get_option( 'opt_contact_zalo' );
$per_row_classes = uxmastery_get_responsive_row_class('opt_course_cat_per_row');
?>

<div class="site-container course-tax-warp has-breadcrumbs">
    <div class="container">
        <?php if ( have_posts() ) : ?>

        <div class="<?php echo esc_attr( $per_row_classes ); ?>">
            <?php
            while ( have_posts() ) : the_post();
                $price = get_post_meta( get_the_ID(), 'cmb_cpt_course_price', true );
            ?>
                <div class="course-item">
                    <div class="course-item__thumbnail">
                        <?php the_post_thumbnail('large'); ?>
                    </div>

                    <div class="course-item__content">
                        <h2 class="course-item__title">
                            <a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>">
                                <?php the_title(); ?>
                            </a>
                        </h2>

                        <?php if ( !empty( $price ) ) : ?>
                            <div class="course-item__meta">
                                <div class="course-item__price">
                                    <span class="txt-label"><?php esc_html_e('Chi phí:', 'uxmastery'); ?></span>

                                    <span class="txt-price">
                                        <span class="number"><?php echo esc_html( number_format_i18n( $price ) ); ?></span>
                                        <span class="currency">VND</span>
                                    </span>
                                </div>
                            </div>
                        <?php endif; ?>

                        <div class="course-item__excerpt">
                            <?php
                            if ( has_excerpt() ) :
                                echo esc_html( get_the_excerpt() );
                            else :
                                echo wp_trim_words( get_the_content(), 30, '...' );
                            endif;
                            ?>
                        </div>

                        <div class="course-item__action">
                            <?php if ( $zalo ) : ?>

                            <a href="<?php echo esc_url( $zalo ); ?>" class="btn-link btn-contact-zalo" target="_blank">
                                <i class="ic-mask ic-mask-bag"></i>
                                <span class="txt"><?php esc_html_e('Liên hệ mua', 'uxmastery'); ?></span>
                            </a>

                            <?php endif; ?>

                            <a href="<?php the_permalink(); ?>" class="btn-link btn-read-more">
                                <span class="txt"><?php esc_html_e('Xem chi tiết', 'uxmastery'); ?></span>
                                <i class="ic-mask ic-mask-arrow-right"></i>
                            </a>
                        </div>
                    </div>
                </div>
            <?php endwhile; ?>
        </div>

        <?php
            uxmastery_pagination();
        else :
        ?>
            <p><?php esc_html_e('Không có khóa học nào trong chuyên mục này.', 'uxmastery'); ?></p>
        <?php
        endif;
        wp_reset_postdata();
        ?>
    </div>
</div>

<?php
get_footer();