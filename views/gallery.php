<?php

function virtuoso_portfolio_image_gallery() {

  // GET CUSTOM TAXONOMIES
  $styles = get_terms( array(
      'taxonomy' => 'style',
      'hide_empty' => false,  ) );

  $options = get_field('options');
  if ($options) {
    $title = $options['section_title'];
    $reverseStylesDisplay = $options['reverse_stylescategories_display'];
    $masonryLayout = ($options['masonry_layout']) ? 1 : 0;
    $showAllCategorySelector = $options['show_all_category_selector'];
  } else {
    $title = 'Portfolio';
    $reverseStylesDisplay = false;
    $masonryLayout = 0;
    $showAllCategorySelector = true;
  }

  if ($reverseStylesDisplay) {
    array_reverse($styles);
  }

  if ($showAllCategorySelector) {
    $firstCategory = '';
  } else {
    $firstCategory = $styles[0]->slug;
  }

  if ($masonryLayout) {
    $portfolios = array();

    foreach( $styles as $style ) {

      $portfolio = get_posts(array(
          'post_type' => 'portfolio',
          'numberposts' => -1,
          'tax_query' => array(
              array(
                  'taxonomy' => 'style',
                  'field' => 'slug',
                  'terms' => $style->slug
              )
          )
      ));

      $style->attached_portfolio_id = $portfolio[0]->ID;
    }
  }



  ?>
  <div id="projects" class="virtuoso_portfolio_image_gallery" data-taxonomy-slug="<?php echo $firstCategory?>" data-masonry="<?php echo $masonryLayout ?>" data-all-category-selector="<?php ($showAllCategorySelector) ? '1' : '0'?>" data-offset="0">
    <div class="category_selector">
      <h2><?php echo $title ?></h2>
      <div class="categories">
        <?php
        if ($reverseStylesDisplay) {
          if ($showAllCategorySelector) {
            ?><a class="active" href="#/" data-taxonomy-slug="">All</a><?php
          }
          foreach ($styles as $style) {
            echo "<a href='#/' data-taxonomy-slug='".$style->slug."' data-id='".$style->attached_portfolio_id."'>" . $style->name . "</a>";
          }
        } else {
          foreach ($styles as $style) {
            echo "<a href='#/' data-taxonomy-slug='".$style->slug."' data-id='".$style->attached_portfolio_id."'>" . $style->name . "</a>";
          }
          if ($showAllCategorySelector) {
            ?><a class="active" href="#/" data-taxonomy-slug="">All</a><?php
          }
        }
        ?>

      </div>
    </div>
    <div class="virtuoso_gallery">
      <div class="gallery_wrap <?php if ($masonryLayout) { echo 'grid'; }?>">
        <!--   PORTFOLIOS CALLED THROUGH AJAX     -->
      </div> <!-- .gallery_wrap -->
      <div class="show_more" data-index="0">
        <a>Show more <i class="ti-reload icon"></i></a>
      </div>
       <!-- Closing tag for .gallery_wrap needs to close before the show more button in posts.php-->
  </div>
  <?php

}