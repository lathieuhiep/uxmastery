<?php
$opt_back_to_top = uxmastery_get_option( 'opt_general_back_to_top', '1' );
$zalo = uxmastery_get_option( 'opt_contact_zalo' );
$phone = uxmastery_get_option( 'opt_contact_phone' );
?>

<div class="sticky-contact-panel">
    <?php if ( $opt_back_to_top == '1' ) : ?>
        <a id="back-top" class="panel-item back-top" href="#">
            <i class="ic-mask ic-mask-up-long"></i>
        </a>
    <?php endif; ?>

    <?php if ( $zalo ) : ?>
        <a class="panel-item panel-zalo" href="<?php echo esc_url( $zalo ); ?>" target="_blank">
            <img src="<?php echo esc_url( get_theme_file_uri('assets/images/zalo.webp') ) ?>" alt="zalo">
        </a>
    <?php endif; ?>

    <?php if ( $phone ) : ?>
        <a class="panel-item panel-phone" href="tel:<?php echo uxmastery_preg_replace_ony_number( $phone ); ?>">
            <i class="ic-mask ic-mask-phone-volume"></i>
        </a>
    <?php endif; ?>
</div>