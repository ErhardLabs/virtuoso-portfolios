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
  } else {
    $title = 'Portfolio';
    $reverseStylesDisplay = false;
    $masonryLayout = 0;
  }

  if ($reverseStylesDisplay) {
    array_reverse($styles);
  }

  ?>
  <div id="projects" class="virtuoso_portfolio_image_gallery" data-masonry="<?php echo $masonryLayout ?>">
    <div class="category_selector">
      <h2><?php echo $title ?></h2>
      <div class="categories">
        <?php
        if ($reverseStylesDisplay) {
          ?><a class="active" href="#/" data-taxonomy-slug="">All</a><?php
          foreach ($styles as $style) {
            echo "<a href='#/' data-taxonomy-slug='".$style->slug."'>" . $style->name . "</a>";
          }
        } else {
          foreach ($styles as $style) {
            echo "<a href='#/' data-taxonomy-slug='".$style->slug."'>" . $style->name . "</a>";
          }
          ?>
          <a class="active" href="#/" data-taxonomy-slug="">All</a>
          <?php
        }
        ?>

      </div>
    </div>
    <div class="virtuoso_gallery">
      <div class="gallery_wrap">
        <!--   PORTFOLIOS CALLED THROUGH AJAX     -->
        <?php //virtuoso_portfolio_display_posts(); ?>
      </div> <!-- .gallery_wrap -->
      <div class="show_more" data-index="0">
        <a>Show more <i class="ti-reload icon"></i></a>
      </div>
       <!-- Closing tag for .gallery_wrap needs to close before the show more button in posts.php-->
  </div>
  <?php

}