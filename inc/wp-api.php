<?php

add_action('rest_api_init', 'virtuoso_portfolio_api_route');
function virtuoso_portfolio_api_route()
{
  register_rest_route('virtuoso-portfolios/v2', '/portfolio/', array(
      'methods' => 'GET',
      'callback' => 'get_content_by_slug',
      'args' => array(
          'slug' => array(
              'required' => false
          )
      )
  ));

}

/**
 *
 * Get content by slug
 *
 * @param WP_REST_Request $request
 * @return WP_REST_Response
 */
function get_content_by_slug(WP_REST_Request $request)
{

  // get slug from request
  $slug = $request['slug'];

  // get title by slug
  $return = get_page_by_path($slug, ARRAY_A, array('page', 'post'));

  if ( $return['post_content'] ) {
    $response = new WP_REST_Response( $return );
  } else {
    $response = new WP_Error( 'post_empty', 'Post is empty', array( 'status' => 404 ) );
  }
  return $response;

}