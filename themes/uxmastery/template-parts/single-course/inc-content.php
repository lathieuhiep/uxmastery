<div class="content-wrap">
    <h1 class="entry-title"><?php the_title(); ?></h1>

    <div class="entry-content">
        <?php the_content(); ?>
    </div>

    <div id="accordion" class="accordion-course">
        <?php
        get_template_part( 'template-parts/single-course/collapse/lessons' );
        get_template_part( 'template-parts/single-course/collapse/benefits' );
        get_template_part( 'template-parts/single-course/collapse/audience' );
        ?>
    </div>
</div>