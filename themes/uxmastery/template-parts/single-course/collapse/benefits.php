<?php
$benefits_list = get_post_meta(get_the_ID(), 'cmb_cpt_course_benefits_list', true);

if ( !empty( $benefits_list) && is_array( $benefits_list ) ):
?>

<div class="card">
    <div class="card-header">
        <h2 class="mb-0">
            <button class="btn btn-link collapsed d-flex justify-content-between align-items-center"
                    type="button"
                    data-toggle="collapse"
                    data-target="#collapseBenefits"
                    aria-expanded="false"
                    aria-controls="collapseBenefits"
            >
                <span class="text"><?php esc_html_e('Giá trị bạn nhận được', 'uxmastery'); ?></span>

                <span class="toggle-icon">
                    <i class="ic-mask ic-mask-chevron-up"></i>
                    <i class="ic-mask ic-mask-chevron-down"></i>
                </span>
            </button>
        </h2>
    </div>

    <div id="collapseBenefits" class="collapse collapse-content">
        <div class="card-body">
            <ul class="list-group reset-list">
                <?php foreach ( $benefits_list as $benefit ): ?>
                    <li class="item item-benefit">
                        <img src="<?php echo esc_url( get_theme_file_uri('assets/images/success-check.webp') ) ?>" alt="">
                        <span><?php echo esc_html( $benefit ); ?></span>
                    </li>
                <?php endforeach; ?>
            </ul>
        </div>
    </div>
</div>

<?php
endif;