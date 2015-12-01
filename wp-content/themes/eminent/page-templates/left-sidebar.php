<?php 
/**
 * Template Name: Left Sidebar
**/
get_header();
?>
<section class="section-main col-md-12 top-section">
	<div class="content-page">
		<div class="page-title col-md-12">
			<div class="container">
				<div class="row">
					<div class="col-md-6 col-sm-6 page-title-captions">
						<h1><?php the_title(); ?></h1>
					</div>
					<div class="col-md-6 col-sm-6 breadcrumbs">
						<ul>
							<?php if (function_exists('eminent_custom_breadcrumbs')) eminent_custom_breadcrumbs(); ?>
						</ul>
					</div>
				</div>
			</div>
		</div>
		<div class="theme-content page-margin-top col-md-12">
			<div class="container">
				<div class="row">
					<?php get_sidebar(); ?>
					<div class="content-blog col-md-8 col-md-offset-1">
						<?php while ( have_posts() ) : the_post(); ?>
                                <div class="col-md-12 tamp-div">
                                    <div class="blog-box">
                                        <div class="post-header">
                                            <div class="post-date">
                                                <p class="date">
                                                    <?php echo get_the_time(' j '); ?> <span><?php echo get_the_time(' M '); ?></span> 
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
                                                <a class="post-title"><span><?php the_title();?></span></a>
                                            </div>
                                         
                                            <?php eminent_entry_meta(); ?> 
                                         
                                            <?php the_content();?>
                                          


                                        </div>
                                    </div>
                                </div>
                                   <div class="comments-article">
                                    <?php comments_template( '', true ); ?>
                                </div>

								<?php endwhile;?>
					</div>  

				</div>  
			</div>
		</div>
	</div>
</section>
<?php get_footer(); ?>
