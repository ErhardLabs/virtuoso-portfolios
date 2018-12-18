<?php
/*
Plugin Name: Portfolio Image Gallery
Description: 	Custom, filterable image gallery for portfolio items.
Version: 		1.0.0
Author: 		Grayson & Sumner Erhard
Author URI: 	https://graysonerhard.com
License: 		GPLv2 or later
License URI:	http://www.gnu.org/licenses/gpl-2.0.html
Text Domain: portfolio-image-gallery
*/

//namespace PortfolioImageGallery;

define( 'PIG_TEXT_DOMAIN', 'portfolio-image-gallery');
define( 'PIG_PLUGIN_DIR_PATH', plugin_dir_path( __file__ ) );
define( 'PIG_PLUGIN_DIR_URL', plugin_dir_url( __file__ ) );

add_action('wp_enqueue_scripts','PIG_enqueue_assets');
function PIG_enqueue_assets() {
	wp_enqueue_style( PIG_TEXT_DOMAIN . '-styles', PIG_PLUGIN_DIR_URL . '/dist/styles/style.css', array() );
	wp_enqueue_script( PIG_TEXT_DOMAIN . '-app', PIG_PLUGIN_DIR_URL . '/dist/js/app.js', array( 'jquery' ), true );

}

function virtuoso_portfolio_image_gallery() {

  // GET CUSTOM TAXONOMIES
  $styles = get_terms( array(
      'taxonomy' => 'style',
      'hide_empty' => false,  ) );


  // WP_Query arguments
  $args = array(
      'post_type'       => array( 'portfolio' ),
      'post_status'     => array( 'published' ),
      'orderby'         => 'post_date',
      'order'           => 'DESC',
      'posts_per_page'  => 6
  );

// The Query
  $loop = new WP_Query( $args );





  ?>
<div class="virtuoso_portfolio_image_gallery">
  <div class="category_selector">
    <h2>Projects</h2>
    <div class="categories">
      <?php
      foreach ($styles as $style) {
        echo "<a href='/#'data-slug='".$style->slug."'>" . $style->name . "</a>";
      }
      ?>
    </div>
  </div>
  <div class="virtuoso_gallery">
    <?php
    if ( $loop->have_posts() ) :

      ?>
      <div class="architecture_slider_wrap"> <?php

        // loop through posts
        while ( $loop->have_posts() ): $loop->the_post();


          $image_attributes = wp_get_attachment_image_src( get_post_thumbnail_id( get_the_ID() ), 'thumbnail' );

          if ( $image_attributes ) {

            $terms = get_the_terms( get_the_ID(), 'style' );

            ?>
            <li data-tax="<?php echo $terms[0]->slug?>">
              <a href="<?php the_permalink(); ?>" class="portfolio_image_link">
                <img class="single_slider_item" src="<?php echo $image_attributes[0]; ?>"/>
                <div class="portfolio_header_wrap">
                  <a class="portfolio_name" href="<?php the_permalink(); ?>"><span><?php the_title(); ?></span></a>
                  <span><?php echo get_field('category'); ?></span>
                </div>
              </a>
            </li>
            <?php

          }

        endwhile; ?>

      </div>
      <div class="nav-next alignright"><?php next_posts_link( 'Show more' ); ?></div>
      <?php

    endif;

    wp_reset_query();
    wp_reset_postdata();
    ?>
  </div>
</div>


  <?php



}