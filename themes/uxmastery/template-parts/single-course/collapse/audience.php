<?php
$audience_list = get_post_meta(get_the_ID(), 'cmb_cpt_course_audience_list', true);

if ( !empty( $audience_list) && is_array( $audience_list ) ):
?>

<div class="card">
    <div class="card-header">
        <h2 class="mb-0">
            <button class="btn btn-link collapsed d-flex justify-content-between align-items-center"
                    type="button" 
                    data-toggle="collapse" 
                    data-target="#collapseAudience" 
                    aria-expanded="false" 
                    aria-controls="collapseAudience"
            >
                <span class="text"><?php esc_html_e('Giáo trình phù hợp với ai', 'uxmastery'); ?></span>

                <span class="toggle-icon">
                    <i class="ic-mask ic-mask-chevron-up"></i>
                    <i class="ic-mask ic-mask-chevron-down"></i>
                </span>
            </button>
        </h2>
    </div>

    <div id="collapseAudience" class="collapse collapse-content">
        <div class="card-body">
            <ul class="list-group reset-list">
                <?php foreach ( $audience_list as $audience ): ?>
                    <li class="item item-audience">
                        <img src="<?php echo esc_url( get_theme_file_uri('assets/images/success-check.webp') ) ?>" alt="">
                        <span><?php echo esc_html( $audience ); ?></span>
                    </li>
                <?php endforeach; ?>
            </ul>
        </div>
    </div>
</div>

<?php
endif;