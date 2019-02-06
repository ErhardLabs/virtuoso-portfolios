<?php
/**
 * Block Name: Portfolio
 *
 * This is the template that displays the virtuoso portfolio block.
 */

add_action('acf/init', 'portfolio_block_init');
function portfolio_block_init() {

  // check function exists
  if( function_exists('acf_register_block') ) {

    // register a testimonial block
    acf_register_block(array(
        'name'				=> 'portfolio',
        'title'				=> __('Portfolio'),
        'description'		=> __('A custom portfolio display block.'),
        'render_callback'	=> 'virtuoso_portfolio_acf_gutenberg_block_content_registration',
        'category'			=> 'virtuoso-blocks',
        'icon'				=> 'images-alt',
        'keywords'			=> array( 'portfolio'),
    ));
  }
}

function virtuoso_portfolio_acf_gutenberg_block_content_registration() {
  virtuoso_portfolio_image_gallery();
}

