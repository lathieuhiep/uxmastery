<?php
$lessons = get_post_meta(get_the_ID(), 'cmb_cpt_course_lessons', true);

if ( !empty($lessons) && is_array( $lessons ) ) :
    $lessons = get_posts(array(
        'post_type' => 'ux_lesson',
        'post__in' => $lessons,
        'orderby' => 'post__in',
        'posts_per_page' => -1,
        'no_found_rows' => true,
        'fields' => 'ids',
    ));
    ?>
    <div class="card">
        <div class="card-header">
            <h2 class="mb-0">
                <button class="btn btn-link collapsed d-flex justify-content-between align-items-center"
                        type="button"
                        data-toggle="collapse"
                        data-target="#collapseLesson"
                        aria-expanded="true"
                        aria-controls="collapseLesson"
                >
                    <span class="text"><?php esc_html_e('Nội dung giáo trình', 'uxmastery'); ?></span>

                    <span class="toggle-icon">
                        <i class="ic-mask ic-mask-chevron-up"></i>
                        <i class="ic-mask ic-mask-chevron-down"></i>
                    </span>
                </button>
            </h2>
        </div>

        <div id="collapseLesson" class="collapse collapse-content show">
            <div class="card-body">
                <div class="lessons">
                    <?php
                    foreach ($lessons as $index => $lesson_id) :
                        $title   = get_the_title($lesson_id);
                        $content = get_post_field('post_content', $lesson_id);
                        $excerpt = get_the_excerpt($lesson_id);
                        ?>
                        <div class="item item-lesson">
                            <h3 class="title">
                                <?php
                                esc_html_e('Nội dung', 'uxmastery');
                                echo ' ' . $index + 1 . ': ' . esc_html( $title );
                                ?>
                            </h3>

                            <p class="desc">
                                <?php
                                if ( !empty($excerpt) ) {
                                    echo esc_html( $excerpt );
                                } else {
                                    echo wp_kses_post( wp_trim_words( $content, 20, '...' ) );
                                }
                                ?>
                            </p>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>
    </div>
<?php endif; ?>