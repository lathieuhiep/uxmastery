<?php
get_header();

get_template_part( 'template-parts/parts/breadcrumbs' );
?>
    <div class="site-container single-course-warp has-breadcrumbs">
        <div class="container">
            <?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
                <article id="course-<?php the_ID(); ?>" <?php post_class('course-warp'); ?>>
                    <?php
                    get_template_part( 'template-parts/single-course/inc','content' );

                    get_template_part( 'template-parts/single-course/inc','info' );
                    ?>
                </article>
            <?php endwhile; endif; wp_reset_query(); ?>
        </div>
    </div>
<?php
get_footer();
