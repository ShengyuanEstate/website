<?php
/**
 * The default template for displaying content
 */
?>
 <div class="masonry-container masonry">
<?php while ( have_posts() ) : the_post(); ?>
	<div class="col-md-6 tamp-div">
		<div class="blog-box">
			<div class="post-header">
				<div class="post-date">
					<p class="date">
					   <?php echo get_the_time("j"); ?><span><?php echo get_the_time("M"); ?></span> 
					</p>
				</div>
				<?php if ( has_post_thumbnail() ) : ?>
				<div class="image-wrapper">
					<?php the_post_thumbnail( 'eminent-blog-thumbnail-image', array( 'alt' => esc_attr(get_the_title()), 'class' => 'img-responsive') ); ?>
				</div>
				<?php endif; ?>
			</div>
			<div class="post-detail">
				<div class="blog-title">
					<a href="<?php echo esc_url(get_permalink()); ?>" class="post-title"><span><?php the_title();?></span></a>
				</div>
				<?php eminent_entry_meta(); ?> 
				<?php the_excerpt();?>

			</div>
		</div>
	</div>
	  <?php endwhile;  ?>  
	 </div>
