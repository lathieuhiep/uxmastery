<?php
function efa_modify_queries_for_ctp( $query ): void {
	if ( $query->is_main_query() && ! is_admin() ) {
		if ( $query->is_post_type_archive( 'portfolio' ) || $query->is_tax( [ 'portfolio_cat', 'portfolio_tag' ] ) ) {
			$query->set( 'posts_per_page', 10 );
		}

		if ( $query->is_search() && isset( $_GET['post_type'] ) && $_GET['post_type'] === 'portfolio' ) {
			$query->set('post_type', 'portfolio');
		}
	}
}

add_action( 'pre_get_posts', 'efa_modify_queries_for_ctp' );

// ajax load more posts
add_action( 'wp_ajax_efa_load_more_dual_posts', 'efa_load_more_dual_posts' );
add_action( 'wp_ajax_nopriv_efa_load_more_dual_posts', 'efa_load_more_dual_posts' );

function efa_load_more_dual_posts(): void {
	check_ajax_referer( 'efa_load_nonce', 'nonce' );

	$paged          = isset( $_POST['paged'] ) ? intval( $_POST['paged'] ) : 2;
	$posts_per_page = isset( $_POST['posts_per_page'] ) ? intval( $_POST['posts_per_page'] ) : 6;
	$order_by       = isset( $_POST['order_by'] ) ? sanitize_text_field( $_POST['order_by'] ) : 'date';
	$order          = isset( $_POST['order'] ) ? sanitize_text_field( $_POST['order'] ) : 'DESC';
	$cat            = isset( $_POST['cat'] ) && is_array( $_POST['cat'] ) ? array_map( 'intval', $_POST['cat'] ) : [];
	$image_size     = isset( $_POST['image_size'] ) ? sanitize_text_field( $_POST['image_size'] ) : 'large';
	$show_excerpt   = isset( $_POST['show_excerpt'] ) ? sanitize_text_field( $_POST['show_excerpt'] ) : 'show';
	$excerpt_length = isset( $_POST['excerpt_length'] ) ? intval( $_POST['excerpt_length'] ) : 20;

	// Query
	$args = array(
		'post_type'           => 'post',
		'paged'               => $paged,
		'posts_per_page'      => $posts_per_page,
		'orderby'             => $order_by,
		'order'               => $order,
		'ignore_sticky_posts' => 1,
	);

	if ( ! empty( $cat ) ) {
		$args['tax_query'] = array(
			array(
				'taxonomy' => 'category',
				'field'    => 'term_id',
				'terms'    => $cat,
			),
		);
	}

	$query = new WP_Query( $args );

	ob_start();
	$post_count = 0;

	if ( $query->have_posts() ) :
		while ( $query->have_posts() ) : $query->the_post();
			efa_render_single_post_item($image_size, $show_excerpt, $excerpt_length);
			$post_count++;
		endwhile; wp_reset_postdata();
	endif;
	$html = ob_get_clean();

	wp_send_json_success([
		'html' => $html,
		'posts_loaded' => $post_count
	]);
}