<article <?php post_class( 'post-row' ); ?>>
    <?php if ( has_post_thumbnail() ) : ?>
        <div class="post-row-image">
            <a href="<?php the_permalink(); ?>">
                <?php the_post_thumbnail(); ?>
            </a>
        </div><!-- /.post-row-image -->
    <?php endif; ?>

    <div class="post-row-content">
        <div class="post-row-content-inner">
            <div class="post-row-main">

                <h2 class="post-row-title entry-title">
                    <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                </h2>

                <div class="post-row-meta">
                    <?php echo __('Posted by', 'properta') ?>
                    <a href="<?php ?>"><?php the_author(); ?></a>
                    <?php echo __('on', 'properta') ?>
                    <?php echo get_the_date(); ?>
                </div>

                <span class="post-row-tags"><?php the_tags( '<i class="fa fa-tags"></i>', ', ' ) ?></span>

                <div class="post-row-body">
                    <p><?php the_excerpt(); ?></p>
                </div><!-- /.post-row-body -->


                <div class="read-more-button">
                    <a href="<?php echo get_the_permalink( get_the_ID() ); ?>" class="btn"><?php echo __('Read More', 'properta'); ?></a>
                </div><!-- /.post-box-meta-item -->

            </div><!-- /.post-row-main -->
        </div><!-- /.post-row-content-inner -->
    </div><!-- /.post-row-content -->
</article>