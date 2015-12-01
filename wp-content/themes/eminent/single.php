<?php 
/**
 * The Single template file
**/

get_header();?>
        <section>
            <div class="page-title col-md-12">
                <div class="container less-padding">
                    <div class="row">
                        <div class="col-md-6 col-sm-6 page-title-captions">
                            <h1><?php the_title()?></h1>
                        </div><!-- /.span6 -->
                        <div class="col-md-6 col-sm-6 breadcrumbs">
                            <ul>
                                <?php if (function_exists('eminent_custom_breadcrumbs')) eminent_custom_breadcrumbs(); ?>  
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <?php if ( has_post_thumbnail() ) { 
					$class="";
			}
			else{
					$class="space";
				}?>
            <!--blog section start-->
            <div class="theme-content page-margin-top col-md-12">
                <div class="container less-padding">
                    <div class="row">
                        <div class="our-blog-content col-md-8">
                            <div class="row <?php echo $class;?>">
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
                                                <a  class="post-title"><span><?php the_title();?></span></a>
                                            </div>
                                             <?php eminent_entry_meta(); ?> 
                                           <?php 
												the_content();
															wp_link_pages( array(
															'before'      => '<div class="page-links"><span class="page-links-title">' . __( 'Pages:', 'eminent' ) . '</span>',
															'after'       => '</div>',
															'link_before' => '<span>',
															'link_after'  => '</span>',
														) );	
										  ?> 


                                        </div>
                                    </div>
                                   
                                </div>
                                 <?php endwhile;?>
				<div class="pagination col-md-12">
                                     <?php the_posts_pagination(); ?>
                                </div>
                                <div class="comments-article">
                                    <?php comments_template( '', true ); ?>
                                </div>
                                
                            </div>
                         
                        </div>

                      <?php get_sidebar();?>
                    </div>
                </div>
            </div>    

        </section>
<?php get_footer();?>
