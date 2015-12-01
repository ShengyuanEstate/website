<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
?>

<?php echo wp_kses( $args['before_widget'], wp_kses_allowed_html( 'post' ) ); ?>

<?php if ( ! empty( $instance['classes'] ) ) : ?>
	<div class="<?php echo esc_attr( $instance['classes'] );?>">
<?php endif; ?>

<?php if ( ! empty( $instance['title'] ) ) : ?>
	<?php echo wp_kses( $args['before_title'], wp_kses_allowed_html( 'post' ) ); ?>
	<?php echo wp_kses( $instance['title'], wp_kses_allowed_html( 'post' ) ); ?>
	<?php echo wp_kses( $args['after_title'], wp_kses_allowed_html( 'post' ) ); ?>
<?php endif; ?>

<?php if ( ! empty( $instance['description'] ) ) : ?>
	<div class="description">
		<?php echo wp_kses( $instance['description'], wp_kses_allowed_html( 'post' ) ); ?>
	</div><!-- /.description -->
<?php endif; ?>

<?php if ( have_posts() ) : ?>

    <div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">


        <?php $index = 1; ?>

        <?php while ( have_posts() ) : the_post(); ?>

            <div class="panel panel-faq">
                <div class="panel-heading" role="tab" id="heading-<?php echo $index; ?>">
                    <a role="button" data-toggle="collapse" data-parent="#accordion" href="#collapse-<?php echo $index; ?>" aria-expanded="<?php echo ( $index == 1 ) ? 'true' : 'false'; ?>">
                        <h4 class="panel-title">
                            <?php the_title(); ?>
                        </h4>
                    </a>
                </div>
                <div id="collapse-<?php echo $index; ?>" class="panel-collapse collapse <?php echo ( $index == 1 ) ? 'in' : ''; ?>" role="tabpanel">
                    <div class="panel-body">
                        <?php the_content(); ?>
                    </div>
                </div>
            </div>

            <?php $index++; ?>

        <?php endwhile; ?>

    </div>

<?php else : ?>

	<div class="alert alert-warning">
		<?php echo __( 'No FAQ found.', 'realia-faq' ); ?>
	</div><!-- /.alert -->

<?php endif; ?>

<?php if ( ! empty( $instance['classes'] ) ) : ?>
	</div>
<?php endif; ?>

<?php echo wp_kses( $args['after_widget'], wp_kses_allowed_html( 'post' ) ); ?>