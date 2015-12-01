 <!--Footer start-->
      <footer class="footer-main">
            <div class="container less-padding">
                <div class="row">
                    <div class="col-md-12 footer-row2">
                         <?php if ( is_active_sidebar( 'footer-1' ) || is_active_sidebar( 'footer-2' ) || is_active_sidebar( 'footer-3' ) || is_active_sidebar( 'footer-4' ) ) {?>
                        <div class="row footer-sidebar">
                           
                        <div class="col-md-3 col-sm-6">
                           <?php if ( is_active_sidebar( 'footer-1' ) ) {?>
                            <?php dynamic_sidebar( 'footer-1' );?><?php } ?>
                             
                        </div>
							
                            <?php if ( is_active_sidebar( 'footer-2' ) ) {?>
                        <div class="col-md-3 col-sm-6">
                             <?php dynamic_sidebar( 'footer-2' );?> 
                        </div><?php } ?>
                        <?php if ( is_active_sidebar( 'footer-3' ) ) {?>
                        <div class="col-md-3 col-sm-6">
                             <?php dynamic_sidebar( 'footer-3' );?> 
                        </div>
                        <?php } ?>
                             <?php if ( is_active_sidebar( 'footer-4' ) ) {?>
                        <div class="col-md-3 col-sm-6">
                             <?php dynamic_sidebar( 'footer-4' );?> 
                        </div>
                        <?php } ?>
								
                        </div>
                    </div>
                    <?php }?>
					  <div class="copyright-text col-md-12">
                                        <span>
		<?php printf( __( 'Powered by %1$s and %2$s.', 'eminent' ), '<a href="http://wordpress.org" target="_blank">WordPress</a>', '<a href="http://fruitthemes.com/wordpress-themes/Eminent" target="_blank">Eminent</a>' ); ?>
		</span>                   
                       <?php $copyright_check = get_theme_mod( 'copyright_url_setting' );
    if( $copyright_check != '' ) { ?>
						<p><?php echo esc_html( get_theme_mod('copyright_url_setting', '') );  ?></p> <?php } 
						 ?>
                       </div> 
                       
            </div>	  
                </div>
               

        </footer>
       
        <!--Footer end-->
      <?php wp_footer();?>
    </body>
</html>
