<?php get_header(); ?>
    <div class="site-error">
        <div class="site-error__content">
            <h1 class="heading">
                404
            </h1>

            <p>
				<?php esc_html_e('Trang bạn đang tìm kiếm có thể đã bị xóa do đã thay đổi tên hoặc tạm thời không khả dụng.', 'uxmastery'); ?>
            </p>

            <a href="<?php echo esc_url( get_home_url('/') ); ?>">
				<?php esc_html_e('Trang chủ', 'uxmastery'); ?>
            </a>
        </div>
    </div>
<?php get_footer(); ?>