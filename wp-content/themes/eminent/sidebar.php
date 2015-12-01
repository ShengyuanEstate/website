<?php 
/**
 * The left sidebar template file
**/

if (is_page_template('page-templates/left-sidebar.php')) {
    $eminent_offset = "";
  
} else {
    $eminent_offset = "col-md-offset-1";
   
}
?>	

						<div class="sidebar col-md-3 <?php echo $eminent_offset; ?> main-sidebar">
                           <?php if ( is_active_sidebar( 'sidebar-1' ) ) { 
			 dynamic_sidebar( 'sidebar-1' );
	 } ?>
                        </div>
