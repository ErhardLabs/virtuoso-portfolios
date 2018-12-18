<?php

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

//  print_r($loop);


  ?>
  <div class="virtuoso_portfolio_image_gallery">
    <div class="category_selector">
      <h2>Projects</h2>
      <div class="categories">
        <a href="#/" data-slug="">All</a>
        <?php
        foreach ($styles as $style) {
          echo "<a href='#/'data-slug='".$style->slug."'>" . $style->name . "</a>";
        }
        ?>
      </div>
    </div>
    <div class="virtuoso_gallery">
      <?php
      if ( $loop->have_posts() ) :

        ?>
        <div class="slider_wrap"> <?php

          // loop through posts
          while ( $loop->have_posts() ): $loop->the_post();

            $image_attributes = wp_get_attachment_image_src( get_post_thumbnail_id( get_the_ID() ), array(400,400));

            if ( $image_attributes ) {

              $terms = get_the_terms( get_the_ID(), 'style' );

              ?>
              <li data-tax="<?php echo $terms[0]->slug?>">
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