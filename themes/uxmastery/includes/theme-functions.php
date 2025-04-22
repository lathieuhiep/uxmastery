<?php
// get version theme
function uxmastery_get_version_theme(): string {
	return wp_get_theme()->get( 'Version' );
}

// check is blog
function uxmastery_is_blog(): bool {
	return ( is_archive() || is_category() || is_tag() || is_author() || is_home() || ( is_search() && get_post_type() === 'post' ) );
}

// Callback Comment List
function uxmastery_comments( $uxmastery_comment, $uxmastery_comment_args, $uxmastery_comment_depth ): void {
	if ( $uxmastery_comment_args['style'] == 'div' ) :
		$uxmastery_comment_tag       = 'div';
		$uxmastery_comment_add_below = 'comment';
	else :
		$uxmastery_comment_tag       = 'li';
		$uxmastery_comment_add_below = 'div-comment';
	endif;

	?>
    <<?php echo $uxmastery_comment_tag . ' ' ?><?php comment_class( empty( $uxmastery_comment_args['has_children'] ) ? '' : 'parent' ) ?> id="comment-<?php comment_ID() ?>">

	<?php if ( 'div' != $uxmastery_comment_args['style'] ) : ?>

        <div id="div-comment-<?php comment_ID() ?>" class="comment__body">

	<?php endif; ?>
    <div class="author vcard">
        <div class="author__avatar">
			<?php if ( $uxmastery_comment_args['avatar_size'] != 0 ) {
				echo get_avatar( $uxmastery_comment, $uxmastery_comment_args['avatar_size'] );
			} ?>
        </div>

        <div class="author__info">
            <span class="name"><?php comment_author_link(); ?></span>

            <span class="date"><?php comment_date(); ?></span>
        </div>
    </div>

	<?php if ( $uxmastery_comment->comment_approved == '0' ) : ?>
        <div class="awaiting">
			<?php esc_html_e( 'Bình luận của bạn đang chờ kiểm duyệt.', 'uxmastery' ); ?>
        </div>
	<?php endif; ?>

    <div class="content">
		<?php comment_text(); ?>
    </div>

    <div class="action">
		<?php edit_comment_link( esc_html__( 'Sửa ', 'uxmastery' ) ); ?>

		<?php comment_reply_link( array_merge( $uxmastery_comment_args, array(
			'add_below' => $uxmastery_comment_add_below,
			'depth'     => $uxmastery_comment_depth,
			'max_depth' => $uxmastery_comment_args['max_depth']
		) ) ); ?>
    </div>

	<?php if ( $uxmastery_comment_args['style'] != 'div' ) : ?>

        </div>

	<?php
	endif;
}

// Content Nav
function uxmastery_comment_nav(): void {
	if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) :
		?>
        <nav class="navigation comment-navigation">
            <h2 class="screen-reader-text">
				<?php esc_html_e( 'Điều hướng bình luận', 'uxmastery' ); ?>
            </h2>

            <div class="nav-links">
				<?php
				if ( $prev_link = get_previous_comments_link( esc_html__( 'Bình luận cũ hơn', 'uxmastery' ) ) ) :
					printf( '<div class="nav-previous">%s</div>', $prev_link );
				endif;

				if ( $next_link = get_next_comments_link( esc_html__( 'Bình luận mới hơn', 'uxmastery' ) ) ) :
					printf( '<div class="nav-next">%s</div>', $next_link );
				endif;
				?>
            </div>
        </nav>
	<?php
	endif;
}

// Pagination
function uxmastery_pagination(): void {
	the_posts_pagination( array(
		'type'               => 'list',
		'mid_size'           => 2,
		'prev_text'          => esc_html__( 'Trước', 'basictheme' ),
		'next_text'          => esc_html__( 'Sau', 'basictheme' ),
		'screen_reader_text' => '&nbsp;',
	) );
}

// Pagination Nav Query
function uxmastery_paging_nav_query( $query ): void {
	$args = array(
		'prev_text' => esc_html__( ' Trước', 'basictheme' ),
		'next_text' => esc_html__( 'Sau', 'basictheme' ),
		'current'   => max( 1, get_query_var( 'paged' ) ),
		'total'     => $query->max_num_pages,
		'type'      => 'list',
	);

	$paginate_links = paginate_links( $args );

	if ( $paginate_links ) :
		?>
        <nav class="pagination">
			<?php echo $paginate_links; ?>
        </nav>
	<?php
	endif;
}

// Get col global
function uxmastery_col_use_sidebar( $option_sidebar, $active_sidebar ): string {
	if ( $option_sidebar != 'hide' && is_active_sidebar( $active_sidebar ) ):

		if ( $option_sidebar == 'left' ) :
			$class_position_sidebar = ' order-1 order-md-2';
		else:
			$class_position_sidebar = ' order-1';
		endif;

		$class_col_content = 'col-12 col-md-8' . $class_position_sidebar;
	else:
		$class_col_content = 'col-md-12';
	endif;

	return $class_col_content;
}

function uxmastery_col_sidebar(): string {
	return 'col-12 col-md-4';
}

// Link Pages
function uxmastery_link_page(): void {
	wp_link_pages( array(
		'before'      => '<div class="page-links">' . esc_html__( 'Trang:', 'uxmastery' ),
		'after'       => '</div>',
		'link_before' => '<span class="page-number">',
		'link_after'  => '</span>',
	) );
}

// Get Contact Form 7
function uxmastery_get_form_cf7(): array {
	$options = array();

	if ( function_exists( 'wpcf7' ) ) {

		$wpcf7_form_list = get_posts( array(
			'post_type'   => 'wpcf7_contact_form',
			'numberposts' => - 1,
		) );

		if ( ! empty( $wpcf7_form_list ) && ! is_wp_error( $wpcf7_form_list ) ) :
			foreach ( $wpcf7_form_list as $item ) :
				$options[ $item->ID ] = $item->post_title;
			endforeach;
		endif;
	}

	return $options;
}

// list social network
function uxmastery_list_social_network(): array {
	return array(
		'facebook-f'  => 'Facebook',
		'twitter'     => 'Twitter',
		'google'      => 'Google',
		'linkedin-in' => 'Linkedin',
		'youtube'     => 'Youtube',
		'instagram'   => 'Instagram'
	);
}

function uxmastery_get_social_url(): void {
	$opt_social_networks = uxmastery_get_option( 'opt_social_networks' );

	if ( ! empty( $opt_social_networks ) ) :
    ?>
    <ul class="list-unstyled">
        <?php
            foreach ( $opt_social_networks as $item ) :
                if ( empty( $item['item'] ) ) {
                    continue;
                }
            ?>
                <li class="social-network-item">
                    <a href="<?php echo esc_url( $item['url'] ); ?>" target="_blank">
                        <i class="fab fa-<?php echo esc_attr( $item['item'] ); ?>"></i>
                    </a>
                </li>
        <?php endforeach; ?>
    </ul>
    <?php
	endif;
}

// replace number
function uxmastery_preg_replace_ony_number( $string ): string|null {
	$number = '';

	if ( ! empty( $string ) ) {
		$number = preg_replace( '/[^0-9]/', '', strip_tags( $string ) );
	}

	return $number;
}

// Create a function to fetch all post categories and return them as an associative array for use in a select dropdown
function uxmastery_get_all_categories(): array {
	$categories = get_categories( array(
		'hide_empty' => 0,
	) );

	$categories_list = array();
	foreach ( $categories as $category ) {
		$categories_list[ $category->term_id ] = $category->name;
	}

	return $categories_list;
}

// check page elementor
function uxmastery_get_elementor_container_class( $post_id = null ): string {
	if ( ! $post_id ) {
		$post_id = get_the_ID();
	}

	$is_elementor = get_post_meta( $post_id, '_elementor_edit_mode', true );

	return $is_elementor ? ' site-container-elementor' : '';
}

// Get post description
function uxmastery_get_post_description_fallback( $post ): string {
	$excerpt = get_the_excerpt( $post );

	if ( empty( $excerpt ) ) {
		$content = strip_tags( strip_shortcodes( $post->post_content ) );
		$excerpt = wp_trim_words( $content, 30, '...' ); // Lấy 30 từ đầu làm mô tả
	}

	return $excerpt;
}

// Get post title
function uxmastery_get_custom_archive_title() {
	if ( is_singular('post') ) {
		$categories = get_the_category();
		return ! empty($categories) ? $categories[0]->name : '';

	} elseif ( is_page() ) {
		return get_the_title();

	} elseif ( is_category() ) {
		return single_cat_title('', false);

	} elseif ( is_tag() ) {
		return single_tag_title('', false);

	} elseif ( is_author() ) {
		$author = get_queried_object();
		return $author->display_name;

	} elseif ( is_tax() ) {
		$term = get_queried_object();
		return $term->name;

	} elseif ( is_post_type_archive() ) {
		return post_type_archive_title('', false);

	} elseif ( is_day() || is_month() || is_year() ) {
		return get_the_date();

	} else {
		return get_the_archive_title();
	}
}


// social sharing
function uxmastery_social_sharing(): void {
?>
    <div class="social-sharing">
        <p class="text"><?php esc_html_e('Chia sẻ trên', 'uxmastery'); ?></p>

        <div class="list">
            <a href="https://www.facebook.com/sharer/sharer.php?u=<?php echo urlencode( get_permalink() ); ?>"
               target="_blank"
               rel="noopener noreferrer"
               class="btn-share btn-share-facebook">
                <i class="fa-brands fa-facebook-f"></i>
            </a>

            <a href="https://www.linkedin.com/sharing/share-offsite/?url=<?php echo urlencode( get_permalink() ); ?>"
               target="_blank"
               rel="noopener noreferrer"
               class="btn-share btn-share-linkedin">
                <i class="fa-brands fa-linkedin-in"></i>
            </a>
        </div>
    </div>
<?php
}