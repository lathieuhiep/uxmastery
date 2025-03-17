<?php
$menu_contact_list = uxmastery_get_option( 'opt_menu_contact_list' );

if ( $menu_contact_list ) :
?>

<div class="modal fade modal-contact-menu" id="contactMenuModal" tabindex="-1" aria-labelledby="contactMenuModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-dialog-centered">
		<div class="modal-content popup-contact-form">
			<div class="modal-header">
				<h5 class="modal-title" id="contactMenuModalLabel">
					<?php esc_html_e('Contact us', 'uxmastery'); ?>
				</h5>

				<button type="button" class="btn-close-modal" data-dismiss="modal" aria-label="Close">
					<i class="fas fa-xmark"></i>
				</button>
			</div>

			<div class="modal-body">
				<?php echo do_shortcode('[contact-form-7 id="'. $menu_contact_list .'"]'); ?>
			</div>
		</div>
	</div>
</div>

<?php endif; ?>