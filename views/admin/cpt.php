<?php

add_action( 'init', 'virtuoso_create_style_taxonomy', 0 );
function virtuoso_create_style_taxonomy() {

  $singularCPTName = get_option('virtuoso_portfolio_cpt_name_singular');
  $pluralCPTName = get_option('virtuoso_portfolio_cpt_name_plural');
  $cptSlug = strtolower($pluralCPTName);

  $taxonomyNameSingular = get_option('virtuoso_portfolio_taxonomy_name_singular');
  $taxonomyNamePlural = get_option('virtuoso_portfolio_taxonomy_name_plural');
  $taxonomySlug = strtolower($taxonomyNamePlural);

// Labels part for the GUI
  $labels = array(
      'name' => _x( $taxonomyNamePlural, $taxonomySlug ),
      'singular_name' => _x( $taxonomyNameSingular, $taxonomySlug ),
      'search_items' => __( 'Search ' . $taxonomyNamePlural ),
      'popular_items' => __( 'Popular ' . $taxonomyNamePlural ),
      'all_items' => __( 'All ' . $taxonomyNamePlural ),
      'parent_item' => null,
      'parent_item_colon' => null,
      'edit_item' => __( 'Edit ' . $taxonomyNameSingular ),
      'update_item' => __( 'Update ' . $taxonomyNameSingular ),
      'add_new_item' => __( 'Add New ' . $taxonomyNameSingular ),
      'new_item_name' => __( 'New Style Name' ),
      'separate_items_with_commas' => __( 'Separate style with commas' ),
      'add_or_remove_items' => __( 'Add or remove style' ),
      'choose_from_most_used' => __( 'Choose from the most used style' ),
      'menu_name' => __( $taxonomyNamePlural ),
  );

// Register the taxonomy like tag for case study
  register_taxonomy($taxonomySlug, $cptSlug,array(
      'hierarchical' => false,
      'labels' => $labels,
      'show_ui' => true,
      'show_admin_column' => true,
      'update_count_callback' => '_update_post_term_count',
      'query_var' => true,
      'rewrite' => array( 'slug' => $taxonomySlug ),
      'show_in_rest'  => true
  ));
}



if ( ! function_exists('virtuoso_register_portfolio_cpt') ) {

// Register Custom Post Type
  function virtuoso_register_portfolio_cpt() {

    $singularCPTName = get_option('virtuoso_portfolio_cpt_name_singular');
    $pluralCPTName = get_option('virtuoso_portfolio_cpt_name_plural');
    $cptSlug = strtolower($pluralCPTName);

    $taxonomyNameSingular = get_option('virtuoso_portfolio_taxonomy_name_singular');
    $taxonomyNamePlural = get_option('virtuoso_portfolio_taxonomy_name_plural');
    $taxonomySlug = strtolower($taxonomyNamePlural);

    $labels = array(
        'name'                  => _x( $pluralCPTName, 'Post Type General Name', 'CHILD_TEXT_DOMAIN' ),
        'singular_name'         => _x( $singularCPTName, 'Post Type Singular Name', 'CHILD_TEXT_DOMAIN' ),
        'menu_name'             => __( $pluralCPTName, 'CHILD_TEXT_DOMAIN' ),
        'name_admin_bar'        => __( $pluralCPTName, 'CHILD_TEXT_DOMAIN' ),
        'archives'              => __( $singularCPTName . ' Archives', 'CHILD_TEXT_DOMAIN' ),
        'attributes'            => __( $singularCPTName . ' Attributes', 'CHILD_TEXT_DOMAIN' ),
        'parent_item_colon'     => __( 'Parent ' . $singularCPTName  .  ':', 'CHILD_TEXT_DOMAIN' ),
        'all_items'             => __( 'All ' . $pluralCPTName, 'CHILD_TEXT_DOMAIN' ),
        'add_new_item'          => __( 'Add New ' . $singularCPTName, 'CHILD_TEXT_DOMAIN' ),
        'add_new'               => __( 'Add New', 'CHILD_TEXT_DOMAIN' ),
        'new_item'              => __( 'New ' . $singularCPTName, 'CHILD_TEXT_DOMAIN' ),
        'edit_item'             => __( 'Edit ' . $singularCPTName, 'CHILD_TEXT_DOMAIN' ),
        'update_item'           => __( 'Update ' . $singularCPTName, 'CHILD_TEXT_DOMAIN' ),
        'view_item'             => __( 'View ' . $singularCPTName, 'CHILD_TEXT_DOMAIN' ),
        'view_items'            => __( 'View ' . $pluralCPTName, 'CHILD_TEXT_DOMAIN' ),
        'search_items'          => __( 'Search ' . $singularCPTName, 'CHILD_TEXT_DOMAIN' ),
        'not_found'             => __( 'Not found', 'CHILD_TEXT_DOMAIN' ),
        'not_found_in_trash'    => __( 'Not found in Trash', 'CHILD_TEXT_DOMAIN' ),
        'featured_image'        => __( 'Featured Image', 'CHILD_TEXT_DOMAIN' ),
        'set_featured_image'    => __( 'Set featured image', 'CHILD_TEXT_DOMAIN' ),
        'remove_featured_image' => __( 'Remove featured image', 'CHILD_TEXT_DOMAIN' ),
        'use_featured_image'    => __( 'Use as featured image', 'CHILD_TEXT_DOMAIN' ),
        'insert_into_item'      => __( 'Insert into ' . $singularCPTName, 'CHILD_TEXT_DOMAIN' ),
        'uploaded_to_this_item' => __( 'Uploaded to this ' . $singularCPTName, 'CHILD_TEXT_DOMAIN' ),
        'items_list'            => __( $singularCPTName . ' item list', 'CHILD_TEXT_DOMAIN' ),
        'items_list_navigation' => __( $singularCPTName . ' item list navigation', 'CHILD_TEXT_DOMAIN' ),
        'filter_items_list'     => __( 'Filter ' . $singularCPTName . ' list', 'CHILD_TEXT_DOMAIN' ),
    );
    $args = array(
        'label'                 => __( $singularCPTName, 'CHILD_TEXT_DOMAIN' ),
        'description'           => __( 'Easily organize and display your ' . $pluralCPTName, 'CHILD_TEXT_DOMAIN' ),
        'labels'                => $labels,
        'supports'              => array( 'title', 'editor', 'thumbnail', 'custom-fields', 'page-attributes' ),
        'taxonomies'            => array( 'category', 'post_tag', $taxonomySlug ),
        'hierarchical'          => false,
        'public'                => true,
        'show_ui'               => true,
        'show_in_menu'          => true,
        'menu_position'         => 5,
        'show_in_admin_bar'     => true,
        'show_in_nav_menus'     => true,
        'can_export'            => true,
        'has_archive'           => true,
        'exclude_from_search'   => false,
        'publicly_queryable'    => true,
        'capability_type'       => 'page',
        'show_in_rest'          => true,
    );
    register_post_type( $cptSlug, $args );

  }
  add_action( 'init', 'virtuoso_register_portfolio_cpt', 0 );

}