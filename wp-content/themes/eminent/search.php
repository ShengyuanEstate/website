<?php 
/**
 * The Search template file
**/
get_header(); ?>
<section>
	
            <div class="page-title col-md-12">
                <div class="container less-padding">
                    <div class="row">
                        <div class="col-md-6 col-sm-6 page-title-captions">
                            <h1><?php printf( __( 'Search Results for: %s', 'eminent' ), get_search_query() ); ?></h1>
                        </div><!-- /.span6 -->
                        <div class="col-md-6 col-sm-6 breadcrumbs">
                            <ul>
                               <?php if (function_exists('eminent_custom_breadcrumbs')) eminent_custom_breadcrumbs(); ?>  
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <!--blog section start-->
            <div class="theme-content page-margin-top col-md-12">
                <div class="container less-padding">
                    <div class="row">
                        <div class="our-blog-content col-md-8">
                            <div class="row">
								<?php if ( have_posts() ) : ?>  
								 <?php get_template_part( 'content' ); ?>
                               <?php else : ?>
							<div class="blog-box jumbotron">
						<?php echo	'<h3>' . __('Sorry, but nothing matched your search terms. Please try again with some different keywords.','eminent') . '</h3>';
						get_search_form(); ?>
							</div>	 
                               <?php endif; ?>
                                <div class="pagination col-md-12">
                                      <?php the_posts_pagination(); ?>	
                                </div>
                            </div>
                        </div>

                       <?php get_sidebar();?>
                    </div>
                </div>
            </div>    
			
        </section>
<?php get_footer();?>
