<?php
/**
 * The Comments template file
 *
**/
if ( post_password_required() ) {
	return;
}
?>
<div class="clearfix"></div> 
<div id="comments" class="comments-article col-md-12">
    <?php if (have_comments()) : ?>
        <div class="theme-title col-md-8  col-md-offset-2">
            <h2><span>
             <?php  printf(_n('1 Comment', '%1$s Comments', get_comments_number(), 'eminent'), number_format_i18n(get_comments_number()), get_the_title());
	     ?>   
            </span></h2>
        </div>
        <ol class="comments-box clearfix comment-list" style="list-style-type:none;">
        <?php wp_list_comments(array('avatar_size' => 80, 'style' => 'ol','short_ping' => true,)); ?>
        </ol>
        <?php  paginate_comments_links(); ?> 
    <?php endif; ?>
<?php  comment_form(); ?>
</div>
