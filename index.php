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

define( 'PIG_TEXT_DOMAIN', 'portfolio-image-gallery');
define( 'PIG_PLUGIN_DIR_PATH', plugin_dir_path( __file__ ) );
define( 'PIG_PLUGIN_DIR_URL', plugin_dir_url( __file__ ) );

add_action('wp_enqueue_scripts','PIG_enqueue_assets');
function PIG_enqueue_assets() {
	wp_enqueue_style( PIG_TEXT_DOMAIN . '-styles', PIG_PLUGIN_DIR_URL . '/dist/styles/style.css', array() );
	wp_enqueue_script( PIG_TEXT_DOMAIN . '-app', PIG_PLUGIN_DIR_URL . '/dist/js/app.js', array( 'jquery' ), true );

}

include( PIG_PLUGIN_DIR_PATH . "/admin/portfolio.php" );
include( PIG_PLUGIN_DIR_PATH . "/views/portfolio.php" );