<?php
function eminent_theme_customizer( $wp_customize ) {
    /* sections */
    $wp_customize->add_section( 'eminent_basic_section' , array(
    'title'       => __( 'Basic Settings', 'eminent' ),
    'priority'    => 30,
	) );
	
	$wp_customize->add_panel( 'home_id', array(
		'capability'     => 'edit_theme_options',
		'theme_supports' => '',
		'title'          => __('Home Page Settings','eminent'),
		'description'    => '',
		'priority'    => 30,
	) );

    $wp_customize->add_section( 'eminent_silder_section' , array(
		'title'       => __( 'Slider Section', 'eminent' ),
		'priority'    => 30,
		'panel'  => 'home_id',
	) );

	$wp_customize->add_section( 'eminent_welcome_section' , array(
		'title'       => __( 'Welcome Section', 'eminent' ),
		'priority'    => 30,
		'panel'  => 'home_id',
	) );
    $wp_customize->add_section( 'eminent_blog_section' , array(
		'title'       => __( 'Blog Section', 'eminent' ),
		'priority'    => 30,
		'panel'  => 'home_id',
	) );

        
	$wp_customize->add_section( 'eminent_social_icons_section', array(
		'title'          => __('Social Settings','eminent'),
		'priority'       => 35,
	) );
	
	$wp_customize->add_section( 'eminent_contact_section', array(
		'title'          => __('Contact Us Setting','eminent'),
		'priority'       => 35,
	) );

	/* basic section */
	$wp_customize->add_setting( 'eminent_logo' ,array(
		'sanitize_callback' => 'esc_url_raw',
		)
	 );
    $wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'eminent_logo', array(
		'label'    => __( 'Logo (Recommended size 182 x 39)', 'eminent' ),
		'section'  => 'eminent_basic_section',
		'settings' => 'eminent_logo',
	) ) );

	$wp_customize->add_setting( 'eminent_favicon',array(
		'sanitize_callback' => 'esc_url_raw',
		)
	 );
    
    $wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'eminent_favicon', array(
    'label'    => __( 'Favicon (Recommended size 32 x 32)', 'eminent' ),
    'section'  => 'eminent_basic_section',
    'settings' => 'eminent_favicon',
    
	) ) );

	$wp_customize->add_setting( 'eminent_blogtitle', array(
            'default'        => ' ',
            'sanitize_callback' => 'esc_html',
        ) );
    
    $wp_customize->add_control( 'eminent_blogtitle', array(
		'label'   => __('Blog Title','eminent'),
		'section' => 'eminent_basic_section',
		'type'    => 'text',
        ) );

	$wp_customize->add_setting( 'copyright_url_setting', array(
		'default'        => '',
		'sanitize_callback' => 'esc_html',
	) );
	
	$wp_customize->add_control( 'copyright_url_setting', array(
		'label'   => __('Copyright text','eminent'),
		'section' => 'eminent_basic_section',
		'type'    => 'text'
	) );
	
	$wp_customize->add_setting( 'eminent-breadcrumbsbg-bg' ,array(
		'sanitize_callback' => 'esc_url_raw',
		)
	 );
    $wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'eminent-breadcrumbsbg-bg', array(
		'label'    => __( 'Breadcrumb ', 'eminent' ),
		'section'  => 'eminent_basic_section',
		'settings' => 'eminent-breadcrumbsbg-bg',	
	) ) );

	//welcome  Settings
	$wp_customize->add_setting( 'eminent_welcometitle', array(
		'default'        => '',
		'sanitize_callback' => 'esc_html',
	) );
    
    $wp_customize->add_control( 'eminent_welcometitle', array(
		'label'   => __('Welcome Title','eminent'),
		'section' => 'eminent_welcome_section',
		'type'    => 'text',
    ) );

    $wp_customize->add_setting( 'eminent_welcome_subtitle', array(
		'default'        => '',
		'sanitize_callback' => 'esc_html',
	) );
    
    $wp_customize->add_control( 'eminent_welcome_subtitle', array(
		'label'   => __('Welcome Subtitle','eminent'),
		'section' => 'eminent_welcome_section',
		'type'    => 'text',
    ) );
	
	 $wp_customize->add_setting( 'eminent_welcomeinfo', array(
		'default'        => '',
		'sanitize_callback' => 'esc_html',
	) );
    
    $wp_customize->add_control( 'eminent_welcomeinfo', array(
		'label'   => __('Welcome Info','eminent'),
        'section' => 'eminent_welcome_section',
        'type'    => 'textarea',
           
    ) );
	$wp_customize->add_setting( 'eminent_welcome_image',array(
		'sanitize_callback' => 'esc_url_raw',
		)
	);
    
    $wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'eminent_welcome_image', array(
			'label'    => __( 'Background Image (Recommended size 1280 x 853)', 'eminent' ),
			'section'  => 'eminent_welcome_section',
			'settings' => 'eminent_welcome_image',
		) 
	) );
        
	//Blog Section
	$wp_customize->add_setting( 'eminent_blog-title', array(
		'default'        => '',
		'sanitize_callback' => 'esc_html',
	) );
    
    $wp_customize->add_control( 'eminent_blog-title', array(
		'label'   => __('Blog Title','eminent'),
        'section' => 'eminent_blog_section',
        'type'    => 'text'
    ) );
		
	$wp_customize->add_setting( 'eminent_bloginfo', array(
		'default'        => '',
		'sanitize_callback' => 'esc_html',
	) );
    
    $wp_customize->add_control( 'eminent_bloginfo', array(
		'label'   => __('Blog Info','eminent'),
        'section' => 'eminent_blog_section',
        'type'    => 'textarea',
    ) );
        
	$eminent_args = array(
	'posts_per_page'=> -1,
	'meta_query' => array(
						array(
						'key' => '_thumbnail_id',
						'compare' => 'EXISTS'
							),
						)
					);  
	$eminent_post = new WP_Query( $eminent_args );
	$eminent_cat_id=array();
	while($eminent_post->have_posts()){
	$eminent_post->the_post();
	$eminent_post_categories = wp_get_post_categories( get_the_id());
	foreach($eminent_post_categories as $eminent_post_category)
		$eminent_cat_id[]=$eminent_post_category;
	}
	
	$eminent_cat_id=array_unique($eminent_cat_id);
	$eminent_args = array(
	'orderby' => 'name',
	'parent' => 0,
	'include'=>$eminent_cat_id,
	
	);
	$eminent_cats=array();$i = 0;
	$eminent_categories = get_categories($eminent_args); 
	  foreach ($eminent_categories as $eminent_category) {
		  if($i==0){
			$eminent_default = $eminent_category->term_id;
			$i++;
		}
		$eminent_cats[$eminent_category->term_id] =  $eminent_category->cat_name;
	  }        
      
	 $wp_customize->add_setting( 'eminent_blogcategory', array(
		'default'        => $eminent_default,
		'sanitize_callback' => 'esc_html',
				
	) );
    
    $wp_customize->add_control( 'eminent_blogcategory', array(
			'label'   => __('Select Category','eminent'),
            'section' => 'eminent_blog_section',
            'type'    => 'select',
            'choices' => $eminent_cats,
        ) );
                

	$wp_customize->add_setting( 'eminent_slideroption', array(
            'default' => '',
			'sanitize_callback' => 'esc_html',
        ) );
    
    $wp_customize->add_control( 'eminent_slideroption', array(
		'label'   => __(' Soliloquy Slider Enable','eminent'),
		'section' => 'eminent_silder_section',
		'type'    => 'checkbox',
        ) );

	$wp_customize->add_setting( 'eminent_soliloquy', array(
            'default'        => '',
            'sanitize_callback' => 'absint',
        ) );
    
    $wp_customize->add_control( 'eminent_soliloquy', array(
			'label'   => __('Soliloque Slider Id','eminent'),
            'section' => 'eminent_silder_section',
            'type'    => 'number',
           
        ) );    
        
	 // Contact Section
	

	$wp_customize->add_setting( 'contact_telephone_setting', array(
		'default'        => '',
		'sanitize_callback' => 'esc_html',
	) );
	
	$wp_customize->add_control( 'contact_telephone_setting', array(
		'label'   => __('Contact Telephone','eminent'),
		'section' => 'eminent_contact_section',
		'type'    => 'text'
	) );

	 
	$wp_customize->add_setting( 'contact_email_setting', array(
		'default'        => '',
		'sanitize_callback' => 'esc_html'
	) );
	
	$wp_customize->add_control( 'contact_email_setting', array(
		'label'   => __('Contact Email','eminent'),
		'section' => 'eminent_contact_section',
		'type'    => 'text'
	) );
	
	 
	


	// Social Section
	$wp_customize->add_setting( 'twitter_setting', array(
		'default'        => '',
		'sanitize_callback' => 'esc_html',
	) );
	
	$wp_customize->add_control( 'twitter_setting', array(
		'label'   => __('Twitter URL','eminent'),
		'section' => 'eminent_social_icons_section',
		'type'    => 'text',
		'priority' => 1
	) );

	$wp_customize->add_setting( 'facebook_setting', array(
		'default'        => '',
		'sanitize_callback' => 'esc_html',
	) );
	
	$wp_customize->add_control( 'facebook_setting', array(
		'label'   => __('Facebook URL','eminent'),
		'section' => 'eminent_social_icons_section',
		'type'    => 'text',
		'priority' => 1
	) );
	
	$wp_customize->add_setting( 'youtube_setting', array(
		'default'        => '',
		'sanitize_callback' => 'esc_html',
	) );
	
	$wp_customize->add_control( 'youtube_setting', array(
		'label'   => __('YouTube URL','eminent'),
		'section' => 'eminent_social_icons_section',
		'type'    => 'text',
		'priority' => 1
	) );
	
	$wp_customize->add_setting( 'pinterest_setting', array(
		'default'        => '',
		'sanitize_callback' => 'esc_html',
	) );
	
	$wp_customize->add_control( 'pinterest_setting', array(
		'label'   => __('Pinterest URL','eminent'),
		'section' => 'eminent_social_icons_section',
		'type'    => 'text',
		'priority' => 1
	) );
	
   
	$wp_customize->add_setting( 'rss_setting', array(
		'default'        => '',
		'sanitize_callback' => 'esc_html',
	) );
	
	$wp_customize->add_control( 'rss_setting', array(
		'label'   => __('RSS Feed URL','eminent'),
		'section' => 'eminent_social_icons_section',
		'type'    => 'text',
		'priority' => 1
	) );        
	
            
}
add_action( 'customize_register', 'eminent_theme_customizer' );

?>
