<?php

class LWP_LwpOverlayImages extends DiviExtension {

	/**
	 * The gettext domain for the extension's translations.
	 *
	 * @since 1.0.0
	 *
	 * @var string
	 */
	public $gettext_domain = 'lwp-overlay-images';

	/**
	 * The extension's WP Plugin name.
	 *
	 * @since 1.0.0
	 *
	 * @var string
	 */
	public $name = 'lwp-overlay-images';

	/**
	 * The extension's version
	 *
	 * @since 1.0.0
	 *
	 * @var string
	 */
	public $version = '1.3';

	/**
	 * LWP_LwpOverlayImages constructor.
	 *
	 * @param string $name
	 * @param array  $args
	 */
	public function __construct( $name = 'lwp-overlay-images', $args = array() ) {
		$this->plugin_dir     = plugin_dir_path( __FILE__ );
		$this->plugin_dir_url = plugin_dir_url( $this->plugin_dir );

		parent::__construct( $name, $args );
	}	
}

new LWP_LwpOverlayImages;

