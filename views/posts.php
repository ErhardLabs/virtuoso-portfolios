<?php

add_action( 'wp_ajax_virtuoso_portfolio_display_posts', 'virtuoso_portfolio_display_posts' );
add_action( 'wp_ajax_nopriv_virtuoso_portfolio_display_posts', 'virtuoso_portfolio_display_posts' );


function virtuoso_portfolio_display_posts() {

  $offset = (count($_POST) > 0) ? (int) $_POST['offset'] : 0; // skip previous pagination
  $taxonomy = (count($_POST) > 0) ? (int) $_POST['taxonomy'] : ''; // for single term pagination
  $numberOfPosts = (count($_POST) > 0) ? (int) $_POST['numberOfPosts'] : 3; // default number of posts or grab from ajax

  if ($taxonomy !== '') {

    // single term
    $taxonomies = array($taxonomy);

  } else {

    $styles = get_terms( array(
        'taxonomy' => 'style',
        'hide_empty' => false,  ) );

    $taxonomies = array();

    foreach ($styles as $style) {
      $taxonomies[] = $style->slug;
    }

  }


  // WP_Query arguments
  $args = array(
    'post_type'       => array( 'portfolio' ),
    'post_status'     => array( 'published' ),
    'orderby'         => 'post_date',
    'order'           => 'DESC',
    'posts_per_page'  => $numberOfPosts,
    'numberposts'     => $numberOfPosts,
    'offset'          => $offset,
    'tax_query'       => array($taxonomies)
  );

  // The Query
  $loop = new WP_Query( $args );

  if ( $loop->have_posts() ) :

      // loop through posts
      while ( $loop->have_posts() ): $loop->the_post();

        $image_attributes = wp_get_attachment_image_src( get_post_thumbnail_id( get_the_ID() ), array(400,400));

        if ( $image_attributes ) {

          $taxonomies = get_the_terms( get_the_ID(), 'style' );

          ?>
          <li data-taxonomy-slug="<?php echo $taxonomies[0]->slug?>">
            <a href="<?php the_permalink(); ?>" class="portfolio_image_link">
              <img class="single_slider_item" src="<?php echo $image_attributes[0]; ?>"/>
              <div class="portfolio_header_wrap">
                <a class="portfolio_name" href="<?php the_permalink(); ?>"><span><?php the_title(); ?></span></a>
                <span class="portfolio_category"><?php echo get_field('category'); ?></span>
              </div>
            </a>
          </li>
          <?php

        }

      endwhile; ?>
  <?php

  endif;

  wp_reset_query();
  wp_reset_postdata();

  if (count($loop->posts) === $numberOfPosts) {
    ?>
    <a href="#/" class="show_more" data-offset="0" data-number-of-posts="<?php echo $numberOfPosts?>" data-taxonomy-slug="<?php echo $taxonomy?>">Show more <i class="ti-reload"></i></a>
    <?php
  }

  if ($offset > 0) {
    exit; // avoid trailing 0 from json
  }

}
