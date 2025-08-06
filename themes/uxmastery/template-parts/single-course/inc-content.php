<?php
$lessons = get_post_meta(get_the_ID(), 'cmb_cpt_course_lessons', true);
$benefits_list = get_post_meta(get_the_ID(), 'cmb_cpt_course_benefits_list', true);
$audience_list = get_post_meta(get_the_ID(), 'cmb_cpt_course_audience_list', true);
?>

<div class="content-wrap">
    <h1 class="entry-title"><?php the_title(); ?></h1>

    <div class="entry-content">
        <?php the_content(); ?>
    </div>
</div>