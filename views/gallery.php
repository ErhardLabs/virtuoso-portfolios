<?php

function virtuoso_portfolio_image_gallery() {

  // GET CUSTOM TAXONOMIES
  $styles = get_terms( array(
      'taxonomy' => 'style',
      'hide_empty' => false,  ) );

//  print_r($loop);


  ?>
  <div class="virtuoso_portfolio_image_gallery">
    <div class="category_selector">
      <h2>Projects</h2>
      <div class="categories">
        <?php
        foreach ($styles as $style) {
          echo "<a href='#/' data-taxonomy-slug='".$style->slug."'>" . $style->name . "</a>";
        }
        ?>
        <a href="#/" data-taxonomy-slug="">All</a>
      </div>
    </div>
    <div class="virtuoso_gallery">
      <div class="slider_wrap">
      <?php virtuoso_portfolio_display_posts(); ?>
      </div>
    </div>
  </div>


  <?php

}