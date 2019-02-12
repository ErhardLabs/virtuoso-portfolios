<?php

add_action( 'wp_ajax_virtuoso_portfolio_display_gallery_items', 'virtuoso_portfolio_display_gallery_items' );
add_action( 'wp_ajax_nopriv_virtuoso_portfolio_display_gallery_items', 'virtuoso_portfolio_display_gallery_items' );

function virtuoso_portfolio_display_gallery_items() {

  $portfolioID = ($_POST['portfolioID'] !== null) ? $_POST['portfolioID'] : ''; // for single term pagination
  $offset = ($_POST['offset'] !== null) ? $_POST['offset'] : 0; // for single term pagination
  define('DEBUG', FALSE);

  if (DEBUG) {
    print_r($offset);
    print_r($portfolioID);
  }

  try {

    if ( '' === $portfolioID ) {
      throw new Exception('Portfolio ID empty.');
    }

    $portfolioPost = get_post($portfolioID);
    $portfolioContent = $portfolioPost->post_content;
    $blocks = parse_blocks($portfolioContent);
    $orderedImages = array();

    foreach( $blocks as $block ) {

      // TODO: CHECK IF GALLERY BLOCK

      $i=0;
      $processedResult = $block['attrs']['ids'];

      if (DEBUG) {
        echo '<br>Before processing:<br>';
        print_r($processedResult);
      }

      if ($offset > 0) {
        $processedResult = array_splice($processedResult, 0, $offset); // remove items from beginning up until the offset number

        if (DEBUG) {
          echo '<br>After first splice:<br>';
          print_r($processedResult);
        }

      }

      if (0 === $offset) {
        $length = 6;
      } else {
        $length = 6+$offset;
      }

      $processedResult = array_splice($processedResult, 0, $length); // remove everything after the offset once the first values have been removed

      if (DEBUG) {
        echo '<br>After last splice:<br>';
        print_r($processedResult);
      }

      foreach( $processedResult as $imageID ) {
        $orderedImages[$i]['url'] = wp_get_attachment_url( $imageID );
        $orderedImages[$i]['caption'] = get_the_excerpt( $imageID );
        $i++;
      }
      
    }

    if (count($orderedImages) === 0) {
      throw new Exception('No gallery images found.');
    }

    wp_send_json_success($orderedImages);


  } catch (Exception $e) {
    wp_send_json_error('Caught exception: '.  $e->getMessage());
  }


}