<?php
/**
 * Logger class.
 *
 * Logger class extending WC_Logger
 *
 * @link              https://dream-encode.com
 * @since             0.9.0
 * @package           DreamEncode\WC_Logger
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
	 * @param  mixed   $data   Data to log.
	 * @param  string  $level  Log level.
	 * @return void
	 */
	public function log( $data, $level = 'info' ) {
		if ( ! function_exists( 'wc_get_logger' ) ) {
			// @phpcs:ignore
			error_log(
				sprintf(
					/* translators: 1: WC_Logger class name, 2: `log` method name.`. */
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
					/* translators: 1: WC_Logger class name, 2: `log` method name, 3: Available log levels.`. */
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
