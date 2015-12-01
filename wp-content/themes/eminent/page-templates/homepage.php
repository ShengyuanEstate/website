<?php /* Template Name: Homepage  */?>
<?php get_header();?>
        <section>
        	<?php if(!empty($eminent_soliloquy)){ ?>
            <div class="home-banner-section col-md-12">
                
			<?php  $eminent_soliloquy = get_theme_mod( 'eminent_soliloquy' );
				   $supporters        = get_theme_mod('eminent_slideroption');
				if(1 == get_theme_mod('eminent_slideroption')){   
				
					if ( function_exists( 'soliloquy' ) ) { soliloquy( $eminent_soliloquy ); }
					}?>  

                   
            </div>
            <?php }?>

            <!--blog section start-->
            <div class="section-row portfolio-section col-md-12">
                <div class="container less-padding">
                    <div class="theme-title col-md-8  col-md-offset-2">
                <h2><span>
                      <?php $blog_check = get_theme_mod( 'eminent_blog-title' );
    if(!empty($blog_check)) {?>
                <?php  echo esc_attr( get_theme_mod('eminent_blog-title', '') ); }
                 else {  echo _e('Our Blog', 'eminent');  }?></span></h2>
                <?php $bloginfo_check = get_theme_mod( 'eminent_bloginfo' );
    if(!empty($bloginfo_check)) {?>
                <p><?php  echo esc_attr( get_theme_mod('eminent_bloginfo', '') ); ?></p>
             <?php } ?>
                    </div>
                    <div class="our-blog col-md-12">
                        <div class="row">
							  <?php
                $eminent_blogcategory=get_theme_mod('eminent_blogcategory');
                
                $eminent_args = array(
                    'ignore_sticky_posts' => '1',
                    
                    'meta_query' => array(
                        array(
                            'key' => '_thumbnail_id',
                            'compare' => 'EXISTS'
                        ),
                    )
                );
                if(!empty($eminent_blogcategory))
					$eminent_args['cat']=$eminent_blogcategory;
                $eminent_query = new WP_Query($eminent_args);
                if ($eminent_query->have_posts()) : while ($eminent_query->have_posts()) : $eminent_query->the_post();
                        ?>
                            <div class="col-md-4">
                                <div class="blog-box">
                                    <div class="post-header">
                                        <div class="post-date">
                                            <p class="date">
												<?php echo get_the_time("j"); ?><span><?php echo get_the_time(" M"); ?></span> 
											</p>
                                        </div>
                                        <?php if ( has_post_thumbnail() ) : ?>
										<div class="image-wrapper">
											<?php the_post_thumbnail( 'eminent-blog-thumbnail-image-home', array( 'alt' => esc_attr(get_the_title()), 'class' => 'img-responsive') ); ?>
										</div>
										<?php endif; ?>
                                    </div>
                                    <div class="post-detail">
                                        <div class="blog-title">
                                           <a href="<?php echo esc_url(get_permalink()); ?>" class="post-title"><span><?php the_title();?></span></a>
                                        </div>
                                        <?php eminent_entry_meta();?>
                                        <?php the_excerpt();?>
                                    </div>
                                </div>
                            </div>
                             <?php endwhile; ?>
                    <?php wp_reset_postdata(); ?>
                <?php endif; ?>
                            
                           
                        </div>
                    </div>
                </div>
            </div>    
			 <!--bg section strat-->
			 <?php 
					$welcome_check = get_theme_mod('eminent_welcometitle');
					$welcome_sub_check = get_theme_mod('eminent_welcome_subtitle');
					$welcomeinfo_check = get_theme_mod('eminent_welcomeinfo');
					
					if(!empty($welcome_check) || !empty($welcome_sub_check) || !empty($welcomeinfo_check))
					{?>
					
						<div class="section-row welcome-section col-md-12">
							<div class="blur-slider"></div>
							<div class="container less-padding">
								<div class="theme-title col-md-10 col-md-offset-1">
								   <?php $welcome_check = get_theme_mod( 'eminent_welcometitle' );
				if(!empty($welcome_check)) {?>
									<h2><?php echo esc_attr( get_theme_mod('eminent_welcometitle', '') ); ?></h2>
									<?php } ?>
									<?php $welcome_sub_check = get_theme_mod( 'eminent_welcome_subtitle' );
				if(!empty($welcome_sub_check)) {?>
									<h4><?php echo esc_attr( get_theme_mod('eminent_welcome_subtitle', '') ); ?></h4>
									<?php }?>
									<hr>
									<?php $welcomeinfo_check = get_theme_mod( 'eminent_welcomeinfo' );
				if(!empty($welcomeinfo_check)) {?>
									<p><?php echo esc_textarea( get_theme_mod('eminent_welcomeinfo', '') ); ?></p> <?php } ?>
								</div>
								
							</div>
						</div>
						<?php }?>
						<!--bg section-->
        </section>

<?php get_footer();?>
