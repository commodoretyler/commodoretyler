<?php
/**
 *
 * @package WordPress
 * @subpackage Commodore_Tyler
 * @since Commodore Tyler 1.0
 */

/**
 * Set up the content width value based on the theme's design.
 *
 * @see commo_content_width()
 *
 * @since Commodore Tyler 1.0
 */
if ( ! isset( $content_width ) ) {
	$content_width = 474;
}

/**
 * Commodore Tyler only works in WordPress 3.6 or later.
 */
if ( version_compare( $GLOBALS['wp_version'], '3.6', '<' ) ) {
	require get_template_directory() . '/inc/back-compat.php';
}

if ( ! function_exists( 'commo_setup' ) ) :
/**
 * Commodore Tyler setup.
 *
 * Set up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support post thumbnails.
 *
 * @since Commodore Tyler 1.0
 */
function commo_setup() {

	// Enable support for Post Thumbnails, and declare two sizes.
	add_theme_support( 'post-thumbnails' );
	set_post_thumbnail_size( 672, 372, true );
	add_image_size( 'commo-full-width', 1038, 576, true );
	add_image_size( 'work_thumb', 500, 300, true );


	// This theme uses wp_nav_menu() in two locations.
	register_nav_menus( array(
		'primary'   => __( 'Top primary menu', 'commo' ),
		'secondary' => __( 'Secondary menu in left sidebar', 'commo' ),
	) );

	/*
	 * Enable support for Post Formats.
	 * See http://codex.wordpress.org/Post_Formats
	 */
	add_theme_support( 'post-formats', array(
		'image', 'gallery',
	) );

	// This theme uses its own gallery styles.
	add_filter( 'use_default_gallery_style', '__return_false' );
}
endif; // commo_setup
add_action( 'after_setup_theme', 'commo_setup' );

/**
 * Register three Commodore Tyler widget areas.
 *
 * @return void
 */
function commo_widgets_init() {
	require get_template_directory() . '/inc/widgets.php';

	register_sidebar( array(
		'name'          => __( 'Home Page Footer', 'commo' ),
		'id'            => 'footer',
		'description'   => __( 'Main sidebar that appears on the left.', 'commo' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h1 class="widget-title">',
		'after_title'   => '</h1>',
	) );
	register_sidebar( array(
		'name'          => __( 'Content Sidebar', 'commo' ),
		'id'            => 'sidebar-2',
		'description'   => __( 'Additional sidebar that appears on the right.', 'commo' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h1 class="widget-title">',
		'after_title'   => '</h1>',
	) );
}
add_action( 'widgets_init', 'commo_widgets_init' );

/**
 * Enqueue scripts and styles for the front end.
 *
 * @since Commodore Tyler 1.0
 *
 * @return void
 */
function commo_scripts() {

	// Load the Internet Explorer specific stylesheet.
	wp_enqueue_style( 'commo-ie', get_template_directory_uri() . '/css/ie.css', array( 'commo-style' ), '20131205' );
	wp_style_add_data( 'commo-ie', 'conditional', 'lt IE 9' );

	wp_enqueue_script( 'commo-script', get_template_directory_uri() . '/js/functions.js', array( 'jquery' ), '20131209', true );

	wp_enqueue_style( 'commo-font', get_template_directory_uri() . '/css/commo.css' );
}
add_action( 'wp_enqueue_scripts', 'commo_scripts' );

if ( ! function_exists( 'commo_the_attached_image' ) ) :
/**
 * Print the attached image with a link to the next attached image.
 *
 * @since Commodore Tyler 1.0
 *
 * @return void
 */
function commo_the_attached_image() {
	$post                = get_post();
	/**
	 * Filter the default Commodore Tyler attachment size.
	 *
	 * @since Commodore Tyler 1.0
	 *
	 * @param array $dimensions {
	 *     An array of height and width dimensions.
	 *
	 *     @type int $height Height of the image in pixels. Default 810.
	 *     @type int $width  Width of the image in pixels. Default 810.
	 * }
	 */
	$attachment_size     = apply_filters( 'commo_attachment_size', array( 810, 810 ) );
	$next_attachment_url = wp_get_attachment_url();

	/*
	 * Grab the IDs of all the image attachments in a gallery so we can get the URL
	 * of the next adjacent image in a gallery, or the first image (if we're
	 * looking at the last image in a gallery), or, in a gallery of one, just the
	 * link to that image file.
	 */
	$attachment_ids = get_posts( array(
		'post_parent'    => $post->post_parent,
		'fields'         => 'ids',
		'numberposts'    => -1,
		'post_status'    => 'inherit',
		'post_type'      => 'attachment',
		'post_mime_type' => 'image',
		'order'          => 'ASC',
		'orderby'        => 'menu_order ID',
	) );

	// If there is more than 1 attachment in a gallery...
	if ( count( $attachment_ids ) > 1 ) {
		foreach ( $attachment_ids as $attachment_id ) {
			if ( $attachment_id == $post->ID ) {
				$next_id = current( $attachment_ids );
				break;
			}
		}

		// get the URL of the next image attachment...
		if ( $next_id ) {
			$next_attachment_url = get_attachment_link( $next_id );
		}

		// or get the URL of the first image attachment.
		else {
			$next_attachment_url = get_attachment_link( array_shift( $attachment_ids ) );
		}
	}

	printf( '<a href="%1$s" rel="attachment">%2$s</a>',
		esc_url( $next_attachment_url ),
		wp_get_attachment_image( $post->ID, $attachment_size )
	);
}
endif;


function custom_post_types(){
  $cover_labels = array(
    'name'          =>      'Cover Panels',
    'singular_name' =>      'Cover Panel',
    'all_items'     =>      'All Panels',
    'add_new'       =>      'Add New Panel',
    'add_new_item'  =>      'Add New Panel',
    'edit_item'     =>      'Edit Panel',
    'new_item'      =>      'New Panel',
    'view_item'     =>      'View Panel',
    'search_items'  =>      'Search Panels',
    'not_found'     =>      'Panels Not Found'
  );

  register_post_type( 'cover_panel',
    array(
      'labels'    => $cover_labels,
      'description' =>  'Cover Panels for the home page',
      'public'      =>  true,
      'exclude_from_search' => true,
      'publicly_queryable'  => false,
      'show_in_menu'        => true,
      'menu_position'       => 5,
      'capability_type'     => 'post',
      'supports'            => array('title', 'editor', 'thumbnail', 'custom-fields', 'page_attributes'),
      'has_archive'         => false
    )
  );


  register_taxonomy(
      'works',
      'portfolio',
      array(
          'label' => __('Portfolio Categories'),
          'singular_label' => __('Portfolio Category'),
          'hierarchical' => true,
          'query_var' => true,
          'rewrite' => true,
          'show_in_nav_menus' => true,
      )
  );

  register_post_type(
      'portfolio',
      array(
          'label' => __('Portfolio'),
          'singular_label' => __('Work'),
          'public' => true,
          'show_ui' => true,
          'capability_type' => 'post',
          'hierarchical' => false,
          'rewrite' => true,
          'query_var' => true,
          'show_in_nav_menus' => true,
          'menu_position' => 3,
          'taxonomies' => array('portfolio'),
          'supports' => array('title', 'editor', 'author', 'thumbnail', 'custom-fields'),
          '_builtin' => false, // It's a custom post type, not built in!
  ));

}
add_action( 'init', 'custom_post_types' );

function portfolio_shortcode( $atts ) {
  ob_start();
  $portfolio_posts = new WP_Query('post_type=portfolio');
  if( $portfolio_posts->have_posts() ) :
  ?>
  <div class="portfolio">
  <?php
    while( $portfolio_posts->have_posts() ) : $portfolio_posts->the_post();
      $icon_meta = get_post_meta( $portfolio_posts->post->ID, 'skill_set' );
  ?>
    <div class="portfolio-entry clickable-splitter" id="portfolio-<?php echo $portfolio_posts->post->ID; ?>">
      <h2 class="portfolio-title"><?php the_title(); ?></h2>

      <?php if(has_post_thumbnail($portfolio_posts->post->ID)) : ?>
        <div class="portfolio-thumb">
        <?php the_post_thumbnail( 'commo-full-width' ); ?>
        </div><!-- .portfolio-thumb -->
      <?php endif; ?>
      <?php if(count($icon_meta)): ?>
        <?php foreach($icon_meta as $icon): ?>
          <ul class="skill-set-icons">
            <li class="skill-set">
              <span class="<?php echo $icon; ?>"></span>
            </li>
          </ul>
        <?php endforeach; // skills icons ?>
      <?php endif; // skills icons ?>
      <div class="portfolio-content">
        <?php the_content(); ?>
      </div>
      <div class="splitter" id="splitter-<?php $portfolio_posts->post->ID; ?>">
        <?php // the gallery goes here ?>
      </div><!-- .splitter -->
  <?php endwhile; //posts ?>
  </div><!-- .portfolio -->
  <?php endif; // posts
  wp_reset_query();
  return ob_get_clean();
}
add_shortcode('portfolio', 'portfolio_shortcode');

function skillicon_shortcode( $atts ) {
  ob_start();

  extract( shortcode_atts( array(
		'icon' => ''
	), $atts ) );
?>
  <span class="skill-icon icon-<?php echo $icon; ?>"></span>
<?php
  return ob_get_clean();
}
add_shortcode( 'skillicon', 'skillicon_shortcode' );


//add_action( 'wp_ajax_portfolio_post', 'portfolio_post_callback' );
//add_action( 'wp_ajax_nopriv_portfolio_post', 'portfolio_post_callback' );