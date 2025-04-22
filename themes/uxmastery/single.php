<?php
get_header();

$sidebar = uxmastery_get_option('opt_post_single_sidebar_position', 'right');
$class_col_content = uxmastery_col_use_sidebar( $sidebar, 'sidebar-main' );

get_template_part( 'template-parts/parts/breadcrumbs' );
?>

<div class="site-container single-post-warp has-breadcrumbs">
    <div class="container">
        <div class="row">
            <div class="<?php echo esc_attr( $class_col_content ); ?>">
                <?php
                if ( have_posts() ) : while (have_posts()) : the_post();

                    get_template_part( 'template-parts/post/content','single' );

                    endwhile;
                endif;
                ?>
            </div>

            <?php
            if ( $sidebar !== 'hide' ) :
	            get_sidebar();
            endif;
            ?>
        </div>
    </div>
</div>

<?php get_footer(); ?>

