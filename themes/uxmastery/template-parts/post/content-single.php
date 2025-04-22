<?php
$show_related = uxmastery_get_option('opt_post_single_related', '1');

$back_url = wp_get_referer();
if ( ! $back_url ) {
	$back_url = home_url();
}
?>

<div id="post-<?php the_ID() ?>" <?php post_class('single-post-content'); ?>>
    <div class="back-url-warp">
        <a href="<?php echo esc_url( $back_url ); ?>" class="btn-back d-inline-flex align-items-center">
            <i class="fas fa-arrow-left-long"></i>
            <span><?php esc_html_e('Quay lại', 'uxmastery'); ?></span>
        </a>
    </div>

    <h1 class="single-post-content__title">
		<?php the_title(); ?>
    </h1>

    <?php uxmastery_social_sharing(); ?>

    <?php if ( has_post_thumbnail() ) :?>
        <div class="single-post-content__image">
            <?php the_post_thumbnail('full'); ?>
        </div>
    <?php endif; ?>

    <div class="single-post-content__detail">
		<?php
		the_content();

		uxmastery_link_page();
		?>
    </div>

	<?php uxmastery_social_sharing(); ?>
</div>

<?php
get_template_part( 'template-parts/parts/comment','form' );

if ( $show_related == '1' ) :
    get_template_part( 'template-parts/post/inc','related-post' );
endif;