<?php
/**
 * PluginName Settings
 *
 * @since   {VERSION}
 * @link    https://github.com/wppunk/WPPlugin
 * @license GPLv2 or later
 * @package PluginName
 * @author  WPPunk
 */

namespace PluginName\Admin;

use PluginName\Plugin;

/**
 * Class Settings
 *
 * @since   {VERSION}
 *
 * @package PluginName\Admin
 */
class Settings {

	/**
	 * Init hooks
	 *
	 * @since {VERSION}
	 */
	public function hooks() {
		add_action( 'admin_enqueue_scripts', [ $this, 'enqueue_styles' ] );
		add_action( 'admin_enqueue_scripts', [ $this, 'enqueue_scripts' ] );
		add_action( 'admin_menu', [ $this, 'add_menu' ] );
	}

	/**
	 * Register the styles for the admin area.
	 *
	 * @since {VERSION}
	 *
	 * @param string $hook_suffix The current admin page.
	 */
	public function enqueue_styles( string $hook_suffix ) {
		if ( false === strpos( $hook_suffix, Plugin::SLUG ) ) {
			return;
		}

		$min = Plugin::get_assets_suffix();

		wp_enqueue_style(
			'plugin-name-settings',
			PLUGIN_NAME_URL . "assets/css/settings$min.css",
			[],
			Plugin::VERSION,
			'all'
		);
	}

	/**
	 * Register the JavaScript for the admin area.
	 *
	 * @since {VERSION}
	 *
	 * @param string $hook_suffix The current admin page.
	 */
	public function enqueue_scripts( string $hook_suffix ) {
		if ( false === strpos( $hook_suffix, Plugin::SLUG ) ) {
			return;
		}

		$min = Plugin::get_assets_suffix();

		wp_enqueue_script(
			'plugin-name-settings',
			PLUGIN_NAME_URL . "assets/js/settings$min.js",
			[ 'jquery' ],
			Plugin::VERSION,
			true
		);
	}

	/**
	 * Add plugin page in WordPress menu.
	 *
	 * @since {VERSION}
	 */
	public function add_menu() {
		add_menu_page(
			'Plugin Name Settings',
			'Plugin Name Settings',
			'manage_options',
			Plugin::SLUG,
			[
				$this,
				'page_options',
			]
		);
	}

	/**
	 * Plugin page callback.
	 *
	 * @since {VERSION}
	 */
	public function page_options() {
		require_once PLUGIN_NAME_PATH . 'templates/admin/settings.php';
	}

}
