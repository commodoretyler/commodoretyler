<?php
/**
 * Template Name: Home Page
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages and that
 * other 'pages' on your WordPress site will use a different template.
 *
 * @package WordPress
 * @subpackage Commodore_Tyler
 * @since Commodore Tyler 1.0
 */

get_header(); ?>

<?php
  $cover_args = array(
    'post_type' => 'cover_panel',
    'orderby'   => 'menu_order',
    'order'     => 'ASC'
  );
  $covers = new WP_Query( $cover_args );
?>

<div id="covers" class="main-content">
  <?php
    if ( $covers->have_posts() ):
      while( $covers->have_posts() ): $covers->the_post();
        $vast_shadow = get_post_meta($post->ID, 'vast-shadow-letter', true);
        $cover_title = get_post_meta($post->ID, 'cover-title', true);
  ?>
  <div id="<?php echo $post->post_name; ?>" class="clearfix cover <?php echo $post->post_name . " " . $cover_title; ?>">
    <div class="wrapper">
      <?php if( $vast_shadow ) : ?>
        <span class="vast-shadow">
          <span class="left-ring"></span>
          <span class="right-ring"></span>
          <?php echo $vast_shadow; ?>
        </span>
      <?php endif; ?>
      <h1 class="cover-title"><?php the_title(); ?></h1>

      <?php the_content(); ?>
    </div><!-- .wrapper -->
  </div><!-- .cover -->
  <?php
      endwhile;
    endif;
  ?>
  <?php get_sidebar( 'content' ); ?>
</div><!-- #main-content -->

<?php
get_footer();
