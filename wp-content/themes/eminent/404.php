<?php
/**
 * 404 pages (not found)
*/
get_header();
?>

<section>
	
            <div class="page-title col-md-12">
                <div class="container less-padding">
                    <div class="row">
                        <div class="col-md-6 col-sm-6 page-title-captions">
                           <h1 class="page-title-404"><?php _e( 'Epic 404 - Article Not Found.', 'eminent' ); ?></h1>
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
                        <div class="our-blog-content ">
                            <div class="row">
								<div class="blog-box jumbotron width ">
								<h1 class="page-title-404"><?php _e( 'Epic 404 - Article Not Found', 'eminent' ); ?></h1>
								<p class=""><?php _e( 'This is embarassing. We can&rsquo;t find what you were looking for.', 'eminent' ); ?></p>
					<p><?php _e( 'Whatever you were looking for was not found, but maybe try looking again or search using the form below.', 'eminent' ); ?></p>
					<?php get_search_form(); ?>
									</div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>    
			
        </section>
<?php get_footer();?>
