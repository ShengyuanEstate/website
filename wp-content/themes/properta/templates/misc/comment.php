<?php
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}
?>

<li <?php comment_class(empty( $args['has_children'] ) ? '' : 'comments'); ?> id="comment-<?php comment_ID() ?>">
    <div class="comment clearfix">
        <div class="comment-author">
            <?php if ($args['avatar_size'] != 0) echo get_avatar( $comment, $args['avatar_size'] ); ?>
        </div><!-- /.comment-image -->

        <div class="comment-content">
            <div class="comment-meta">
                <strong class="comment-author"><?php comment_author(); ?></strong>
                <?php comment_reply_link(array_merge( $args, array(
                    'add_below'     => 'comment',
                    'depth'         => $depth,
                    'reply_text'    => __( 'Reply', 'properta' ),
                    'max_depth'     => $args['max_depth'])
                ) ); ?>
                <div class="comment-date"><?php echo get_comment_date(); ?> <?php echo get_comment_time(); ?></div>

            </div><!-- /.comment-meta -->

            <div class="comment-body">
                <?php comment_text(); ?>
            </div><!-- /.comment-body -->

            <?php if ($comment->comment_approved == '0') : ?>
                <em class="comment-awaiting-moderation"><?php echo __( 'Your comment is awaiting moderation.', 'properta' ); ?></em>
                <br />
            <?php endif; ?>
        </div><!-- /.comment-content -->
    </div><!-- /.comment -->
</li><!-- /.comment -->
