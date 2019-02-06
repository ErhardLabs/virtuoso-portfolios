<?php
/*
Plugin Name: Virtuoso Portfolios
Description: 	Custom, filterable portfolios with galleries, shortcodes, cpts, and more.
Version: 		1.0.0
Author: 		Grayson & Sumner Erhard
Author URI: 	https://graysonerhard.com
License: 		GPLv2 or later
License URI:	http://www.gnu.org/licenses/gpl-2.0.html
Text Domain: portfolio-image-gallery
*/

//namespace PortfolioImageGallery;

define( 'VP_TEXT_DOMAIN', 'virtuoso-portfolio');
define( 'VP_PLUGIN_DIR_PATH', plugin_dir_path( __file__ ) );
define( 'VP_PLUGIN_DIR_URL', plugin_dir_url( __file__ ) );

add_action('wp_enqueue_scripts','VP_enqueue_assets');
function VP_enqueue_assets() {
	wp_enqueue_style( VP_TEXT_DOMAIN . '-styles', VP_PLUGIN_DIR_URL . '/dist/styles/portfolio-image-gallery.css', array() );

  wp_register_script( VP_TEXT_DOMAIN . '-app', VP_PLUGIN_DIR_URL . '/dist/js/app.js', array( 'jquery' ), true );

  $localize = array(
      'ajaxurl' => admin_url('admin-ajax.php'),
    // Securing your WordPress plugin AJAX calls using nonces
      'auth' => wp_create_nonce('_check__ajax_virtuoso')
  );

  wp_localize_script(VP_TEXT_DOMAIN . '-app', 'virtuoso_portfolio', $localize);
	wp_enqueue_script(VP_TEXT_DOMAIN . '-app');

}

//include( VP_PLUGIN_DIR_PATH . "/inc/wp-api.php" );
include( VP_PLUGIN_DIR_PATH . "/admin/portfolio.php" );
include( VP_PLUGIN_DIR_PATH . "/views/posts.php" );
include( VP_PLUGIN_DIR_PATH . "/views/gallery.php" );
include( VP_PLUGIN_DIR_PATH . "/views/block-portfolio.php" );