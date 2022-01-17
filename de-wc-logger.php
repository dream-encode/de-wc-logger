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
 * @since             1.0.0
 * @package           DreamEncode\WC_Logger
 *
 * @wordpress-plugin
 * Plugin Name:       Dream-Encode - WooCommerce Logger
 * Plugin URI:        https://maxmarineelectronics.com
 * Description:       A small WordPress plugin to create dedicated log files using WC_Logger.
 * Version:           0.9.0
 * Author:            David Baumwald
 * Author URI:        https://dream-encode.com
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       de-wc-logger
 * Domain Path:       /languages
 * GitHub Plugin URI: dream-encode/de-wc-logger
 * Primary Branch:    main
 */

namespace DreamEncode;

/**
 * Simple logger class to log data to custom files.
 *
 * Relies on the bundled logger class in WooCommerce.
 *
 * @package  DreamEncode\WC_Logger
 * @author   David Baumwald <david@dream-encode.com>
 */
class WC_Logger {

	/**
	 * Log namespace.
	 *
	 * @since   0.9.0
	 * @access  protected
	 * @var     string  $namespace  Log namespace.
	 */
	protected $namespace = '';

	/**
	 * Constructor.
	 *
	 * @since  0.9.0
	 * @param  string  $namespace  Namespace for this instance.
	 */
	public function __construct( $namespace ) {
		$this->namespace = $namespace;
	}

	/**
	 * Log data.
	 *
	 * @since  0.9.0
	 * @param  mixed  $data  Data to log.
	 * @return void
	 */
	public function log( $data, $level = 'info' ) {
		if ( ! function_exists( 'wc_get_logger' ) ) {
			error_log(
				sprintf(
					__( '%1$s->%2$s depends on `wc_get_logger` which is bundled with the WooCommerce plugin.', 'de-wc-logger' ),
					__CLASS__,
					__METHOD__
				)
			);
			return;
		}

		$logger = wc_get_logger();

		$available_log_levels = array(
			'debug',
			'info',
			'notice',
			'warning',
			'error',
			'critical',
			'alert',
			'emergency',
		);

		if ( ! in_array( $level, $available_log_levels, true ) ) {
			$logger->log(
				'warning',
				sprintf(
					__( '%1$s->%2$s `$level` invalid.  Available levels: `%3$s`', 'de-wc-logger' ),
					__CLASS__,
					__METHOD__,
					implode( '`, `', $available_log_levels )
				),
				array( 'source' => $this->namespace )
			);
		}

		if ( is_object( $data ) || is_array( $data ) ) {
			$data = print_r( $data, true ); // @phpcs:ignore
		}

		$logger->log( $level, $data, array( 'source' => $this->namespace ) );
	}
}
