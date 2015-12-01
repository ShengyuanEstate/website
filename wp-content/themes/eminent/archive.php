<?php 
/**
 * The Archive template file
**/
get_header(); ?>

<section>
	 <div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
            <div class="page-title col-md-12">
                <div class="container less-padding">
                    <div class="row">
                        <div class="col-md-6 col-sm-6 page-title-captions">
                             <h1><?php the_archive_title(); ?></h1>
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
								 <?php get_template_part( 'content' ); ?>
                                <div class="pagination col-md-12">
                                     <?php the_posts_pagination();?>	
                                </div>
                            </div>
                        </div>

                       <?php get_sidebar();?>
                    </div>
                </div>
            </div>    
			</div>
        </section>
<?php get_footer();?>
