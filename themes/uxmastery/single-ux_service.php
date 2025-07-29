<?php

use Elementor\Plugin;

get_header();

get_template_part( 'template-parts/parts/breadcrumbs' );
?>
    <div class="site-container single-post-warp">
		<?php
		if ( have_posts() ) :
			while ( have_posts() ) : the_post();
				$post_id        = get_the_ID();
				$used_elementor = get_post_meta( $post_id, '_elementor_edit_mode', true ) === 'builder';

				if ( $used_elementor ) :
					the_content();
				else:
            ?>
                <div class="container">
                    <h1><?php the_title(); ?></h1>

                    <div class="ux-service-content">
                        <?php the_content(); ?>
                    </div>
                </div>
            <?php
                endif;
			endwhile;
		endif;
		?>
    </div>
<?php
get_footer();
