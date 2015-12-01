<?php 
/* blog page template */
get_header();
?>

<section>
	 <div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
            <div class="page-title col-md-12">
                <div class="container less-padding">
                    <div class="row">
                        <div class="col-md-6 col-sm-6 page-title-captions">
                             <h1><?php echo esc_html( get_theme_mod( 'eminent_blogtitle', __( 'Our Blog', 'eminent' ) ) ); ?></h1>
                        </div><!-- /.span6 -->
                       
                    </div>
                </div>
            </div><?php if ( has_post_thumbnail() ) { 
					$class=" ";
			}
			else{
					$class="space";
				}?>
            <!--blog section start-->
            <div class="theme-content page-margin-top col-md-12">
                <div class="container less-padding">
                    <div class="row">
                        <div class="our-blog-content col-md-8 <?php echo $class;?>">
                            <div class="row">
								 <?php get_template_part( 'content' ); ?>
                                <div class="pagination col-md-12">
                                     <?php the_posts_pagination(); ?>
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
