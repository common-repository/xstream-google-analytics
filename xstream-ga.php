<?php
/**
 * Plugin Name: Xstream Google Analytics
 * Description: Google Analytics for your Wordpress website with JS file completelly hosted locally for performance increase.
 * Version: 1.0.1
 * Author: XstreamThemes
 * Author URI: https://xstreamthemes.com
 * License: GPL2v2 or later
 */

// exit if accessed directly
if (!defined('ABSPATH')) exit;

// menu items
add_action('admin_menu', 'xstream_ga_create_menu');
function xstream_ga_create_menu() {
	add_options_page	(	'Complete Analytics Optimization Suite',
		'Xstream Analytics',
		'manage_options',
		'xstream-ga',
		'xstream_ga_settings_page'
	);

	add_action ('admin_init', 'register_xstream_ga_settings');
}

// settings registration
function register_xstream_ga_settings() {
	register_setting ('xstream-ga-settings','xga_tracking_id');
	register_setting ('xstream-ga-settings','xga_track_admin');
}

// settings page render
function xstream_ga_settings_page() {
	if (!current_user_can('manage_options')) {
		wp_die( __("You're not allowed to access this page."));
	}
?>

	<div class="wrap">
		<h2><?php _e('Xstream Google Analytics for Wordpress', 'xstream-ga'); ?></h2>
		<?php _e('Powered by: ', 'xstream-ga'); ?><a title="XstreamThemes" target="_blank" href="https://xstreamthemes.com">XstreamThemes</a>

		<form method="post" action="options.php">
			<?php
			settings_fields	('xstream-ga-settings');
			do_settings_sections ('xstream-ga-settings');

			$xga_tracking_id = esc_attr(get_option('xga_tracking_id'));
			$xga_track_admin = esc_attr(get_option('xga_track_admin'));
			?>

			<table class="form-table">
				<tr valign="top">
					<th scope="row"><?php _e('Google Analytics Tracking ID', 'xstream-ga'); ?></th>
					<td><input type="text" name="xga_tracking_id" placeholder="UA-XXXXXXXX-X" value="<?php echo $xga_tracking_id; ?>" /></td>
				</tr>
				<tr valign="top">
					<th scope="row"><?php _e('Track logged in Administrators?', 'xstream-ga'); ?></th>
					<td><input type="checkbox" name="xga_track_admin" <?php if($xga_track_admin == "on") echo 'checked = "checked"'; ?> /></td>
				</tr>
			</table>

			<?php do_action('xga_after_form_settings'); ?>
			<?php submit_button() ;?>

		</form>
	</div>
	<?php
}

// load update script to schedule in wp_cron()
add_action('update_xstream_ga', 'update_xstream_ga_script');
function update_xstream_ga_script() {
	include('inc/update-xga.php');
}

// hook registration to schedule script in wp_cron()
register_activation_hook(__FILE__, 'activate_update_xstream_ga');
function activate_update_xstream_ga() {
	if (!wp_next_scheduled('update_xstream_ga')) {
		wp_schedule_event(time(), 'daily', 'update_xstream_ga');
		include('inc/update-xga.php');
	}
}

// remove from wp_cron upon plugin deactivation
register_deactivation_hook(__FILE__, 'deactivate_update_xstream_ga');
function deactivate_update_xstream_ga() {
	if (wp_next_scheduled('update_xstream_ga')) {
		wp_clear_scheduled_hook('update_xstream_ga');
	}
}

// generate tracking code
function add_xga_header_script() {
	$xga_track_admin = esc_attr(get_option('xga_track_admin'));
	// no render for admin user
	if (current_user_can('manage_options') && (!$xga_track_admin)) return;

	$xga_tracking_id = esc_attr(get_option('xga_tracking_id'));

	echo "\n<!-- Powered by Xstream Google Analytics for Wordpress -->\n";
	echo "<script>\n";
	echo "(function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){\n";
	echo "(i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),\n";
	echo "m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)\n";
	echo "})(window,document,'script','" . plugin_dir_url(__FILE__) . "local/xstream-ga.js','ga');\n";
	echo "ga('create', '" . $xga_tracking_id . "', 'auto');\n";
	echo "ga('send', 'pageview');\n";
	echo "</script>\n";
	echo "<!-- Xstream Google Analytics for Wordpress END -->\n\n";
}

add_action('wp_footer', 'add_xga_header_script');
