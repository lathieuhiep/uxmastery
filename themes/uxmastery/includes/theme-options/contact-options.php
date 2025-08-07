<?php
// Create a section menu
CSF::createSection( PREFIX_THEME_OPTIONS, array(
    'title'  => esc_html__( 'Liên hệ', 'uxmastery' ),
    'icon'   => 'fas fa-address-card',
    'fields' => array(
        // zalo
        array(
            'id'    => 'opt_contact_zalo',
            'type'  => 'text',
            'title' => esc_html__( 'ZaLo', 'uxmastery' ),
            'default' => 'https://zalo.me/2127558141747969331?src=qr',
            'desc' => esc_html__('Link quét lấy mã:', 'uxmastery') . ' https://pageloot.com/vi/quet-ma-qr/',
        ),

        // phone
        array(
            'id'    => 'opt_contact_phone',
            'type'  => 'text',
            'title' => esc_html__( 'Số điện thoại', 'uxmastery' ),
            'default' => '0911.321.300',
        ),

        // avatar
        array(
            'id'      => 'opt_contact_avatar',
            'type'    => 'media',
            'title'   => esc_html__( 'Avatar', 'uxmastery' ),
            'library' => 'image',
            'url'     => false
        ),
    )
) );