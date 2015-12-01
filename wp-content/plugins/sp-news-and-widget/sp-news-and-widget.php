<?php
/*
Plugin Name: WP News and three widgets(static, scrolling and with thumbs)
Plugin URL: http://www.wponlinesupport.com/
Description: A simple News and three widgets(static, scrolling and with thumbs) plugin
Version: 3.2.1
Author: WP Online Support
Author URI: http://www.wponlinesupport.com/
Contributors: WP Online Support
*/
/*
 * Register CPT sp_News
 *
 */
// Initialization function
add_action('init', 'sp_cpt_news_init');
function sp_cpt_news_init() {
  // Create new News custom post type
    $news_labels = array(
    'name'                 => _x('News', 'post type general name'),
    'singular_name'        => _x('News', 'post type singular name'),
    'add_new'              => _x('Add News Item', 'news'),
    'add_new_item'         => __('Add New News Item'),
    'edit_item'            => __('Edit News Item'),
    'new_item'             => __('New News Item'),
    'view_item'            => __('View News Item'),
    'search_items'         => __('Search  News Items'),
    'not_found'            =>  __('No News Items found'),
    'not_found_in_trash'   => __('No  News Items found in Trash'), 
    '_builtin'             =>  false, 
    'parent_item_colon'    => '',
    'menu_name'            => 'News'
  );
  $news_args = array(
    'labels'              => $news_labels,
    'public'              => true,
    'publicly_queryable'  => true,
    'exclude_from_search' => false,
    'show_ui'             => true,
    'show_in_menu'        => true, 
    'query_var'           => true,
    'rewrite'             => array( 
							'slug' => 'news',
							'with_front' => false
							),
    'capability_type'     => 'post',
    'has_archive'         => true,
    'hierarchical'        => false,
    'menu_position'       => 8,
	'menu_icon'   => 'dashicons-feedback',
    'supports'            => array('title','editor','thumbnail','excerpt','comments'),
    'taxonomies'          => array('post_tag')
  );
  register_post_type('news',$news_args);
}
/* Register Taxonomy */
add_action( 'init', 'news_taxonomies');
function news_taxonomies() {
    $labels = array(
        'name'              => _x( 'Category', 'taxonomy general name' ),
        'singular_name'     => _x( 'Category', 'taxonomy singular name' ),
        'search_items'      => __( 'Search Category' ),
        'all_items'         => __( 'All Category' ),
        'parent_item'       => __( 'Parent Category' ),
        'parent_item_colon' => __( 'Parent Category:' ),
        'edit_item'         => __( 'Edit Category' ),
        'update_item'       => __( 'Update Category' ),
        'add_new_item'      => __( 'Add New Category' ),
        'new_item_name'     => __( 'New Category Name' ),
        'menu_name'         => __( 'News Category' ),
    );

    $args = array(
        'hierarchical'      => true,
        'labels'            => $labels,
        'show_ui'           => true,
        'show_admin_column' => true,
        'query_var'         => true,
        'rewrite'           => array( 'slug' => 'news-category' ),
    );

    register_taxonomy( 'news-category', array( 'news' ), $args );
}

function my_rewrite_flush() {  
		sp_cpt_news_init();  
    flush_rewrite_rules();
}
register_activation_hook( __FILE__, 'my_rewrite_flush' );
add_action( 'wp_enqueue_scripts','style_css_script' );
    function style_css_script() {
        wp_enqueue_style( 'cssnews',  plugin_dir_url( __FILE__ ). 'css/stylenews.css' );
        wp_enqueue_script( 'vticker', plugin_dir_url( __FILE__ ) . 'js/jcarousellite.js', array( 'jquery' ));
    }

require_once( 'widget_function.php' );	

function get_news( $atts, $content = null ){
            // setup the query
            extract(shortcode_atts(array(
		"limit" => '',	
		"category" => '',
		"grid" => '',
        "show_date" => '',
        "show_category_name" => '',
        "show_content" => '',
        "content_words_limit" => '',
	), $atts));
	// Define limit
	if( $limit ) { 
		$posts_per_page = $limit; 
	} else {
		$posts_per_page = '-1';
	}
	if( $category ) { 
		$cat = $category; 
	} else {
		$cat = '';
	}
	if( $grid ) { 
		$gridcol = $grid; 
	} else {
		$gridcol = '1';
	}
    if( $show_date ) { 
        $showDate = $show_date; 
    } else {
        $showDate = 'true';
    }
	if( $show_category_name ) { 
        $showCategory = $show_category_name; 
    } else {
        $showCategory = 'true';
    }
    if( $show_content ) { 
        $showContent = $show_content; 
    } else {
        $showContent = 'true';
    }
	 if( $content_words_limit ) { 
        $words_limit = $content_words_limit; 
    } else {
        $words_limit = '20';
    }
	ob_start();
	$paged = ( get_query_var('paged') ) ? get_query_var('paged') : 1;
	
	$post_type 		= 'news';
	$orderby 		= 'post_date';
	$order 			= 'DESC';
				 
        $args = array ( 
            'post_type'      => $post_type, 
            'orderby'        => $orderby, 
            'order'          => $order,
            'posts_per_page' => $posts_per_page,   
            'paged'          => $paged,
            );
	if($cat != ""){
            	$args['tax_query'] = array( array( 'taxonomy' => 'news-category', 'field' => 'id', 'terms' => $cat) );
            }        
      $query = new WP_Query($args);
      $post_count = $query->post_count;
          $count = 0;
             if ( $query->have_posts() ) : while ( $query->have_posts() ) : $query->the_post();
             $count++;
               $terms = get_the_terms( $post->ID, 'news-category' );
                    $news_links = array();
                    if($terms){

                    foreach ( $terms as $term ) {
                        $term_link = get_term_link( $term );
                        $news_links[] = '<a href="' . esc_url( $term_link ) . '">'.$term->name.'</a>';
                    }
                }
                    $cate_name = join( ", ", $news_links );
                $css_class="team";
                if ( ( is_numeric( $grid ) && ( $grid > 0 ) && ( 0 == ($count - 1) % $grid ) ) || 1 == $count ) { $css_class .= ' first'; }
                if ( ( is_numeric( $grid ) && ( $grid > 0 ) && ( 0 == $count % $grid ) ) || $post_count == $count ) { $css_class .= ' last'; }
                if($showDate == 'true'){ $date_class = "has-date";}else{$date_class = "has-no-date";}
                ?>
			
            	<div id="post-<?php the_ID(); ?>" class="news type-news news-col-<?php echo $gridcol.' '.$css_class.' '.$date_class; ?>">
					<div class="news-thumb">
					<?php
						// Post thumbnail.
						if ( has_post_thumbnail())  {
							if($gridcol == '1'){ ?>
						 <a href="<?php the_permalink(); ?>"><?php the_post_thumbnail('url'); ?></a>
						<?php } else if($gridcol > '2') { ?>
							<div class="grid-news-thumb">	
						 <a href="<?php the_permalink(); ?>">	<?php the_post_thumbnail('medium'); ?></a>
							</div>
					<?php	} else { ?>
					<div class="grid-news-thumb">	
							 <a href="<?php the_permalink(); ?>"><?php the_post_thumbnail('large'); ?></a>
							</div>
					<?php } }?>
					</div>
					<div class="news-content">
					<?php if($gridcol == '1') { 
                        if($showDate == 'true'){?>
						<div class="date-post">					
						<h2><span><?php echo get_the_date('j'); ?></span></h2>
						<p><?php echo get_the_date('M y'); ?></p>
						</div>
                        <?php }?>
					<?php } else { 

                        ?>
						<div class="grid-date-post">
						<?php echo ($showDate == "true")? get_the_date('j, M y') : "" ;?>
                        <?php echo ($showDate == "true" && $showCategory == "true" && $cate_name != '') ? " , " : "";?>
                        <?php echo ($showCategory == 'true' && $cate_name != '') ? $cate_name : ""?>
						</div>
					<?php  } ?>
					<div class="post-content-text">
						<?php the_title( sprintf( '<h4 class="news-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h4>' );	?>
					    
						<?php if($showCategory == 'true' && $gridcol == '1'){ ?>
						<div class="news-cat">
                            <?php echo $cate_name; ?>
							</div>
                       <?php }?>
                     <?php if($showContent == 'true'){?>   
					<div class="news-content-excerpt">
					<?php $excerpt = get_the_content();?>
                    <p class="news-short-content"><?php echo string_limit_newswords($excerpt,$words_limit); ?>...</p>
                   
                        <a href="<?php the_permalink(); ?>" class="more-link">Read More</a>	
					</div><!-- .entry-content -->
                    <?php }?>
					</div>
				</div>
</div><!-- #post-## -->			  
          <?php  endwhile;
            endif; ?>
			
<div class="news_pagination">				 	

<div class="button-news-p"><?php next_posts_link( ' Next >>', $query->max_num_pages ); ?></div>
<div class="button-news-n"><?php previous_posts_link( '<< Previous' ); ?> </div>
</div>


			<?php
             wp_reset_query(); 
				
		return ob_get_clean();			             
	}
add_shortcode('sp_news','get_news');	
function string_limit_newswords($string, $word_limit)
{
  $words = explode(' ', $string, ($word_limit + 1));
  if(count($words) > $word_limit)
  array_pop($words);
  return implode(' ', $words);
}	
	function mynewsscript() {
	$option = 'NewsWidget_option';
	$newsscrollingoptionadmin = get_option( $option); 
	$customscrollpost = $newsscrollingoptionadmin['news_width']; 
	$customscrollpostheight = $newsscrollingoptionadmin['news_height'];
	$customscrollpostdelay = $newsscrollingoptionadmin['news_delay'];
	$customscrollpostspeed = $newsscrollingoptionadmin['news_speed'];
  
		if ($customscrollpost == 0 )
		{
			$vtrue = 'true';
		} else { $vtrue = 'false';
		}
		if ($customscrollpostheight == '' )
		{
			$vvisible = 3;
		} else { $vvisible = $customscrollpostheight;
		}
		if ($customscrollpostdelay == '' )
		{
			$vdelay = 500;
		} else { $vdelay = $customscrollpostdelay;
		}
		if ($customscrollpostspeed == '' )
		{
			$vspeed = 2000;
		} else { $vspeed = $customscrollpostspeed;
		}
	?>
	<script type="text/javascript">
	
jQuery(function() {
	 jQuery(".newsticker-jcarousellite").jCarouselLite({
		vertical: <?php echo $vtrue; ?>,
		hoverPause:true,
		visible: <?php echo $vvisible; ?>,
		auto: <?php echo $vdelay; ?>,
		speed:<?php echo $vspeed; ?>,
		
	});  
	
});
</script>
	<?php
	}
add_action('wp_head', 'mynewsscript');


function spnews_display_tags( $query ) {
    if( is_tag() && $query->is_main_query() ) {       
       $post_types = array( 'post', 'news' );
        $query->set( 'post_type', $post_types );
    }
}
add_filter( 'pre_get_posts', 'spnews_display_tags' );


// Manage Category Shortcode Columns

add_filter("manage_news-category_custom_column", 'news_category_columns', 10, 3);
add_filter("manage_edit-news-category_columns", 'news_category_manage_columns'); 
function news_category_manage_columns($theme_columns) {
    $new_columns = array(
            'cb' => '<input type="checkbox" />',
            'name' => __('Name'),
            'news_shortcode' => __( 'News Category Shortcode', 'news' ),
            'slug' => __('Slug'),
            'posts' => __('Posts')
			);
    return $new_columns;
}

function news_category_columns($out, $column_name, $theme_id) {
    $theme = get_term($theme_id, 'news-category');
    switch ($column_name) {      

        case 'title':
            echo get_the_title();
        break;
        case 'news_shortcode':        

             echo '[sp_news category="' . $theme_id. '"]';
        break;

        default:
            break;
    }
    return $out;   

}


class SP_News_setting
{
    /**
     * Holds the values to be used in the fields callbacks
     */
    private $options;

    /**
     * Start up
     */
    public function __construct()
    {
        add_action( 'admin_menu', array( $this, 'add_news_page' ) );
        add_action( 'admin_init', array( $this, 'page_init_news' ) );
    }

    /**
     * Add options page
     */
    public function add_news_page()
    {
        // This page will be under "Settings"
        add_options_page(
            'Settings Admin', 
            'News Widget Settings', 
            'manage_options', 
            'news-setting-admin', 
            array( $this, 'create_newsadmin_page' )
        );
    }

    /**
     * Options page callback
     */
    public function create_newsadmin_page()
    {
        // Set class property
        $this->options = get_option( 'NewsWidget_option' );
        ?>
        <div class="wrap">
            <?php screen_icon(); ?>
            <h2>Scrolling News Widget Setting</h2>           
            <form method="post" action="options.php">
            <?php
                // This prints out all hidden setting fields
                settings_fields( 'news_option_group' );   
                do_settings_sections( 'news-setting-admin' );
                submit_button(); 
            ?>
            </form>
        </div>
        <?php
    }

    /**
     * Register and add settings
     */
    public function page_init_news()
    {        
        register_setting(
            'news_option_group', // Option group
            'NewsWidget_option', // Option name
            array( $this, 'sanitize' ) // Sanitize
        );

        add_settings_section(
            'setting_section_id', // ID
            'Scorlling News Widget Settings', // Title
            array( $this, 'print_section_info' ), // Callback
            'news-setting-admin' // Page
        );  

        add_settings_field(
            'news_width', // ID
            'Widget Scrolling Direction (Vertical OR Horizontal) ', // Title 
            array( $this, 'news_width_callback' ), // Callback
            'news-setting-admin', // Page
            'setting_section_id' // Section           
        );      

        add_settings_field(
            'news_height', 
            'Number of news visible at a time', 
            array( $this, 'news_height_callback' ), 
            'news-setting-admin', 
            'setting_section_id'
        );      
		add_settings_field(
            'news_delay', // ID
            'Enter delay ', // Title 
            array( $this, 'news_delay_callback' ), // Callback
            'news-setting-admin', // Page
            'setting_section_id' // Section           
        );      

        add_settings_field(
            'news_speed', 
            'Enter speed', 
            array( $this, 'news_speed_callback' ), 
            'news-setting-admin', 
            'setting_section_id'
        );     
	
    }

    /**
     * Sanitize each setting field as needed
     *
     * @param array $input Contains all settings fields as array keys
     */
    public function sanitize( $input )
    {
        $new_input = array();
        if( isset( $input['news_width'] ) )
            $new_input['news_width'] = sanitize_text_field( $input['news_width'] );

        if( isset( $input['news_height'] ) )
            $new_input['news_height'] = sanitize_text_field( $input['news_height'] );
		
		 if( isset( $input['news_delay'] ) )
            $new_input['news_delay'] = sanitize_text_field( $input['news_delay'] );
			
		 if( isset( $input['news_speed'] ) )
            $new_input['news_speed'] = sanitize_text_field( $input['news_speed'] );	

        return $new_input;
    }

    /** 
     * Print the Section text
     */
    public function print_section_info()
    {
        print 'Enter your settings below:';
    }

    /** 
     * Get the settings option array and print one of its values
     */
    public function news_width_callback()
    {
        printf(
            '<input type="text" id="news_width" name="NewsWidget_option[news_width]" value="%s" />',
            isset( $this->options['news_width'] ) ? esc_attr( $this->options['news_width']) : ''
        );
		printf(' Enter "0" for <b>Vertical Scrolling</b> and "1" for <b>Horizontal Scrolling</b>');
    }

    /** 
     * Get the settings option array and print one of its values
     */
    public function news_height_callback()
    {
        printf(
            '<input type="text" id="news_height" name="NewsWidget_option[news_height]" value="%s" />',
            isset( $this->options['news_height'] ) ? esc_attr( $this->options['news_height']) : ''
        );
		printf(' ie 1, 2, 3, 4 etc');
    }
	 public function news_delay_callback()
    {
        printf(
            '<input type="text" id="news_delay" name="NewsWidget_option[news_delay]" value="%s" />',
            isset( $this->options['news_delay'] ) ? esc_attr( $this->options['news_delay']) : ''
        );
		printf(' ie 500, 1000 milliseconds delay');
    }

    /** 
     * Get the settings option array and print one of its values
     */
    public function news_speed_callback()
    {
        printf(
            '<input type="text" id="news_speed" name="NewsWidget_option[news_speed]" value="%s" />',
            isset( $this->options['news_speed'] ) ? esc_attr( $this->options['news_speed']) : ''
        );
		printf(' ie 500, 1000 milliseconds speed');
    }
}

if( is_admin() )
    $my_newssettings_page = new SP_News_setting();

