<?php if ( function_exists('bcn_display') ) : ?>
	<div class="breadcrumbs" typeof="BreadcrumbList" vocab="https://schema.org/">
		<div class="container">
            <h3 class="title">
				<?php echo esc_html( uxmastery_get_custom_archive_title() ); ?>
            </h3>

			<div class="breadcrumbs-col">
				<?php bcn_display(); ?>
			</div>
		</div>
	</div>
<?php endif; ?>