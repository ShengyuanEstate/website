<p><br>Thank you for using Content Views!</p>
<p>You are using
	<strong>Free</strong> version: <?php echo esc_html( PT_CV_Functions::plugin_info( PT_CV_FILE, 'Version' ) ); ?></p>
<p>
	By default, any user who has <strong>edit_posts</strong> capability (Administrator, Editor, Author, Contributor) can manage all Views (add, edit, delete).<br>
	To restrict which user role can manage Views,
	<?php
	echo sprintf( ' <a href="%s" target="_blank">%s</a>', esc_url( 'http://www.contentviewspro.com/pricing/?utm_source=settings_page&utm_medium=role' ), __( 'Get CVPro now!', PT_CV_TEXTDOMAIN ) );
	?>
</p>