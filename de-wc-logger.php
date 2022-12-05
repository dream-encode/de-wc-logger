<?php
/**
 * The plugin bootstrap file
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @link              https://dream-encode.com
 * @since             0.9.0
 * @package           DreamEncode\WC_Logger
 *
 * @wordpress-plugin
 * Plugin Name:       Dream-Encode - WooCommerce Logger
 * Plugin URI:        https://maxmarineelectronics.com
 * Description:       A small WordPress plugin to create dedicated log files using WC_Logger.
 * Version:           1.0.0
 * Author:            David Baumwald
 * Author URI:        https://dream-encode.com
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       de-wc-logger
 * Domain Path:       /languages
 * GitHub Plugin URI: dream-encode/de-wc-logger
 * Primary Branch:    main
 * Release Asset:     true
 */

namespace DreamEncode;

require_once plugin_dir_path( __FILE__ ) . 'includes/class-wc-logger.php';
