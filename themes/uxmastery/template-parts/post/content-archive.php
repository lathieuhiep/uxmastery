<?php
$sidebar = uxmastery_get_option('opt_post_cat_sidebar_position', 'right');
$per_row = uxmastery_get_option('opt_post_cat_per_row', '2');

$class_col_content = uxmastery_col_use_sidebar($sidebar, 'sidebar-main');
?>

<div class="site-container archive-post-warp has-breadcrumbs">
    <div class="container">
        <div class="row">
            <div class="<?php echo esc_attr( $class_col_content ); ?>">
                <?php if ( have_posts() ) : ?>
                    <div class="content-archive-post theme-row-cols-sm-1 theme-row-cols-md-2 theme-row-cols-lg-<?php echo esc_attr( $per_row ); ?>">
		                <?php
		                while ( have_posts() ) :
			                the_post();
                        ?>
                            <div class="item">
                                <div class="item__content">
                                    <div class="post-thumbnail mb-3">
						                <?php the_post_thumbnail('large'); ?>
                                    </div>

                                    <h2 class="post-title">
                                        <a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>">
			                                <?php if (is_sticky() && is_home()) : ?>
                                                <i class="fas fa-thumbtack"></i>
			                                <?php
			                                endif;

			                                the_title();
			                                ?>
                                        </a>
                                    </h2>

                                    <div class="post-desc">
                                        <p>
							                <?php
							                if (has_excerpt()) :
								                echo esc_html(get_the_excerpt());
							                else:
								                echo wp_trim_words(get_the_content(), 30, '...');
							                endif;
							                ?>
                                        </p>

                                        <a href="<?php the_permalink(); ?>" class="text-read-more">
							                <?php esc_html_e('Đọc thêm', 'uxmastery'); ?>
                                        </a>

						                <?php uxmastery_link_page(); ?>
                                    </div>
                                </div>
                            </div>
		                <?php
		                endwhile;
		                wp_reset_postdata();
		                ?>
                    </div>
                <?php
	                uxmastery_pagination();
                else:
	                if ( is_search() ) :
		                get_template_part('template-parts/post/content', 'no-data');
	                endif;
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