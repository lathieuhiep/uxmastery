<?php
/*
 * Action
 * */

//Disable emojis in WordPress
add_action( 'init', 'uxmastery_disable_emojis' );
function uxmastery_disable_emojis(): void {
	remove_action( 'wp_head', 'print_emoji_detection_script', 7 );
	remove_action( 'admin_print_scripts', 'print_emoji_detection_script' );
	remove_action( 'wp_print_styles', 'print_emoji_styles' );
	remove_filter( 'the_content_feed', 'wp_staticize_emoji' );
	remove_action( 'admin_print_styles', 'print_emoji_styles' );
	remove_filter( 'comment_text_rss', 'wp_staticize_emoji' );
	remove_filter( 'wp_mail', 'wp_staticize_emoji_for_email' );
	add_filter( 'tiny_mce_plugins', 'uxmastery_disable_emojis_tinymce' );
}

// add open graph meta tags
function uxmastery_add_open_graph_tags(): void {
	if ( is_singular( 'post' ) ) {
		global $post;
		$title = get_the_title( $post );
		$desc  = uxmastery_get_post_description_fallback( $post );
		$img   = get_the_post_thumbnail_url( $post, 'full' );
		$url   = get_permalink( $post );

		if ( ! $img ) {
			$img = get_template_directory_uri() . '/assets/images/no-image.png';
		}
    ?>
        <meta property="og:title" content="<?php echo esc_attr( $title ); ?>">
        <meta property="og:description" content="<?php echo esc_attr( $desc ); ?>">
        <meta property="og:image" content="<?php echo esc_url( $img ); ?>">
        <meta property="og:url" content="<?php echo esc_url( $url ); ?>">
        <meta property="og:type" content="article">
    <?php
	}
}

add_action( 'wp_head', 'uxmastery_add_open_graph_tags', 1 );

function uxmastery_disable_emojis_tinymce( $plugins ): array {
	if ( is_array( $plugins ) ) {
		return array_diff( $plugins, array( 'wpemoji' ) );
	} else {
		return array();
	}
}

// add code to head
function uxmastery_custom_header_code(): void {
	$header_code = uxmastery_get_option( 'opt_header_code' );

	if ($header_code) {
		echo $header_code;
	}
}
add_action('wp_head', 'uxmastery_custom_header_code');

// add code to body
function uxmastery_custom_body_code(): void {
	$body_code = uxmastery_get_option( 'opt_body_code' );

	if ($body_code) {
		echo $body_code;
	}
}
add_action('wp_body_open', 'uxmastery_custom_body_code');

// add code to footer
function uxmastery_custom_footer_code(): void {
	$footer_code = uxmastery_get_option( 'opt_footer_code' );

	if ($footer_code) {
		echo $footer_code;
	}
}
add_action('wp_footer', 'uxmastery_custom_footer_code');

/*
 * Filter
 * */

// disable gutenberg editor
add_filter("use_block_editor_for_post_type", "disable_gutenberg_editor");
function disable_gutenberg_editor(): bool {
	return false;
}

// disable gutenberg widgets
add_filter('use_widgets_block_editor', '__return_false');

function uxmastery_add_custom_class_to_menu_item( $classes, $item, $args ) {
	// Thêm class tùy chỉnh vào tất cả các mục
	$classes[] = 'nav-item';
	return $classes;
}
add_filter( 'nav_menu_css_class', 'uxmastery_add_custom_class_to_menu_item', 10, 3 );

// Walker for the main menu
add_filter( 'walker_nav_menu_start_el', 'uxmastery_add_arrow',10,4);
function uxmastery_add_arrow( $output, $item, $depth, $args ){
	if('primary' == $args->theme_location && $depth >= 0 ){
		if (in_array("menu-item-has-children", $item->classes)) {
			$output .='<span class="sub-menu-toggle"></span>';
		}
	}

	return $output;
}

//
if ( function_exists('wpcf7') ) {
	add_filter('wpcf7_form_elements', 'uxmastery_check_spam_form_cf7');
    function uxmastery_check_spam_form_cf7($html): string {
	    ob_start();
    ?>
        <div class="d-none">
            <input class="wpcf7-form-control wpcf7-text" aria-invalid="false" value="" type="text" name="spam-email" aria-label="">
        </div>
    <?php
	    $content = ob_get_contents();
	    ob_end_clean();
	    return $html . $content;
    }

	// check field spam
	add_action('wpcf7_posted_data', 'uxmastery_check_spam_form_cf7_valid');
	function uxmastery_check_spam_form_cf7_valid($posted_data) {
		$submission = WPCF7_Submission::get_instance();
		$note_text = esc_html__('Đã có lỗi xảy ra', 'clinic');

		if ( !empty($posted_data['spam-email']) || !isset($_POST['spam-email'])) {
			$submission->set_status( 'spam' );
			$submission->set_response( $note_text );
		}
		unset($posted_data['spam-email']);
		return $posted_data;
	}

	// validate phone
	add_filter('wpcf7_validate_tel', 'uxmastery_custom_validate_phone', 10, 2);
	add_filter('wpcf7_validate_tel*', 'uxmastery_custom_validate_phone', 10, 2);
	function uxmastery_custom_validate_phone($result, $tag) {
		$name = $tag->name;

		if ($name === 'phone') {
			$sdt = isset($_POST[$name]) ? wp_unslash($_POST[$name]) : '';
			if (!preg_match('/^0([0-9]{9,10})+$/D', $sdt)) {
				$result->invalidate($tag, 'Số điện thoại không hợp lệ.');
			}
		}

		return $result;
	}
}