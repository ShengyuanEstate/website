<?php
function eminent_options_init(){
 register_setting( 'eminent_options', 'eminent_theme_options','eminent_options_validate');
} 
add_action( 'admin_init', 'eminent_options_init' );
function eminent_framework_load_scripts(){
	wp_enqueue_media();
	wp_enqueue_style( 'eminent_framework', get_template_directory_uri(). '/theme-options/css/theme-option_framework.css' ,false, '1.0.0');	
}
add_action( 'admin_enqueue_scripts', 'eminent_framework_load_scripts' );
function eminent_framework_menu_settings() {
	$eminent_menu = array(
				'page_title' => __( 'eminent Options', 'eminent'),
				'menu_title' => __('Eminent Pro Features', 'eminent'),
				'capability' => 'edit_theme_options',
				'menu_slug' => 'eminent_framework',
				'callback' => 'eminent_framework_page'
				);
	return apply_filters( 'eminent_framework_menu', $eminent_menu );
}
add_action( 'admin_menu', 'eminent_options_add_page' ); 
function eminent_options_add_page() {
	$eminent_menu = eminent_framework_menu_settings();
   	add_theme_page($eminent_menu['page_title'],$eminent_menu['menu_title'],$eminent_menu['capability'],$eminent_menu['menu_slug'],$eminent_menu['callback']);
} 
function eminent_framework_page(){ 
		global $select_options; 
		if ( ! isset( $_REQUEST['settings-updated'] ) ) 
		$_REQUEST['settings-updated'] = false;		

?>
<div class="theme-option-themes">
	<form method="post" action="options.php" id="form-option" class="theme_option_ft">
  <div class="theme-option-header">
    <div class="logo">
       <?php
		$eminent_image=get_template_directory_uri().'/theme-options/images/logo.png';
		echo "<a href='http://fruitthemes.com/' target='_blank'><img src='".$eminent_image."' alt='fruitthemes' /></a>";
		?>
    </div>
  </div>
  <div class="theme-option-details">
    <div class="theme-option-options">
      <div class="right-box">
        <div class="nav-tab-wrapper">
          <ul>
            <li><a id="options-group-1-tab" class="nav-tab basicsettings-tab" title="<?php _e('PRO Theme Features','eminent'); ?>" href="#options-group-1"><?php _e('PRO Theme Features','eminent'); ?></a></li>
          </ul>  
        </div>
      </div>
      <div class="right-box-bg"></div>
      <div class="postbox left-box"> 
        <!--======================== F I N A L - - T H E M E - - O P T I O N ===================-->
          <?php settings_fields( 'eminent_options' );  
		$eminent_options = get_option( 'eminent_theme_options' );
		 ?>
          <div id="options-group-1" class="group theme-option-inner-tabs"> 
				<div class="eminent-pro-header">
              <h2 class="eminent-pro-logo">eminent PRO</h2>
              <a href="http://eminentpro.fruitthemes.com/" target="_blank">
					<img src="<?php echo get_template_directory_uri(); ?>/theme-options/images/buy-now.png" class="eminent-pro-buynow" /></a>  
              </div>
          	<img src="<?php echo get_template_directory_uri(); ?>/theme-options/images/profeatures.png" class="eminent-pro-image" />
		  </div>
      </div>
     </div>
	</div>
   </form>    
</div>
<?php } ?>