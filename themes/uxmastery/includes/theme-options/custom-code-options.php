<?php
CSF::createSection( PREFIX_THEME_OPTIONS, array(
	'title'  => esc_html__( 'Chèn Code', 'uxmastery' ),
	'icon'   => 'fas fa-code',
	'fields' => array(
		array(
			'id'       => 'opt_header_code',
			'type'     => 'code_editor',
			'title'    => esc_html__( 'Chèn vào head', 'uxmastery' ),
			'settings' => array( 'theme' => 'monokai' ),
			'sanitize' => false,
		),

		array(
			'id'       => 'opt_body_code',
			'type'     => 'code_editor',
			'title'    => esc_html__( 'Chèn sau body', 'uxmastery' ),
			'settings' => array( 'theme' => 'monokai' ),
			'sanitize' => false,
		),

		array(
			'id'       => 'opt_footer_code',
			'type'     => 'code_editor',
			'title'    => esc_html__( 'Chèn vào footer', 'uxmastery' ),
			'settings' => array( 'theme' => 'monokai' ),
			'sanitize' => false,
		),
	),
) );