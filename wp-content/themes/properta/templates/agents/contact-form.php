<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
?>

<?php if ( ! empty( $_POST ) && array_key_exists( 'contact-form', $_POST ) ) : ?>
    <?php
	$is_form_filled = ! empty( $_POST['email'] ) && ! empty( $_POST['subject'] ) && ! empty( $_POST['message'] );
	$is_recaptcha = Realia_Recaptcha::is_recaptcha_enabled();
	$is_recaptcha_valid = array_key_exists( 'g-recaptcha-response', $_POST ) ? Realia_Recaptcha::is_recaptcha_valid( $_POST['g-recaptcha-response'] ) : false;
	?>

    <?php if ( ! ( $is_recaptcha && ! $is_recaptcha_valid ) && $is_form_filled ) : ?>
        <?php $result = wp_mail( $_POST['email'], $_POST['subject'], $_POST['message'] ); ?>

        <?php if ( $result ) : ?>
            <div class="alert alert-success"><?php echo __( 'Your message has been successfully sent.', 'properta' ); ?></div>
        <?php else : ?>
            <div class="alert alert-warning"><?php echo __( 'An error occured when sending an email.', 'properta' ); ?></div>
        <?php endif; ?>
    <?php else : ?>
        <div class="alert alert-warning"><?php echo __( 'Form has been not filled correctly.', 'properta' ); ?></div>
    <?php endif; ?>
<?php endif; ?>

<?php $email = get_post_meta( get_the_ID(), REALIA_AGENT_PREFIX . 'email', true ); ?>

<?php if ( ! empty( $email ) ) : ?>
    <div class="agent-contact">
        <h2><?php echo __( 'Contact Form', 'properta' ); ?></h2>

        <div class="agent-contact-form">
            <form method="post" action="?">
                <div class="form-group">
                    <input type="text" class="form-control" name="subject" placeholder="<?php echo __( 'Subject', 'properta' ); ?>">
                </div><!-- /.form-group -->

                <div class="form-group">
                    <input type="email" class="form-control" name="email" placeholder="<?php echo __( 'E-mail', 'properta' ); ?>">
                </div><!-- /.form-group -->

                <div class="form-group">
                    <textarea class="form-control" name="message" placeholder="<?php echo __( 'Message', 'properta' ); ?>" style="overflow: hidden; word-wrap: break-word; height: 68px;"></textarea>
                </div><!-- /.form-group -->

                <?php if ( Realia_Recaptcha::is_recaptcha_enabled() ) : ?>
                    <div id="recaptcha-agent-contact" class="recaptcha" data-sitekey="<?php echo get_theme_mod( 'realia_recaptcha_site_key' ); ?>"></div>
                <?php endif; ?>

                <button class="button" name="contact-form"><?php echo __( 'Send message', 'properta' ); ?></button>
            </form>
        </div><!-- /.agent-contact-form -->
    </div><!-- /.agent-contact-->
<?php endif; ?>
