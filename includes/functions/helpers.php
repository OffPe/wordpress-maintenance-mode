<?php

/**
 * Get plugin info
 *
 * @since 2.0.0
 * @param string $plugin_slug
 * @return array
 */
function wpmm_plugin_info($plugin_slug)
{
	add_filter('extra_plugin_headers', 'wpmm_add_extra_plugin_headers', 99, 1);

	$plugin_data = get_plugin_data(WPMM_PATH . $plugin_slug . '.php');

	return $plugin_data;
}

/**
 * Count db records using where
 *
 * EDIT: PHP Notice:  wpdb::prepare was called <strong>incorrectly</strong>. The query argument of wpdb::prepare() must have a placeholder.
 *
 * @since 2.0.0
 * @global object $wpdb
 * @param string $table
 * @param string $field
 */
function wpmm_count_where($table, $field = 'ID', $where = array())
{
	global $wpdb;

	$table = $wpdb->prefix . $table;
	$where_keys = array_keys($where);
	$where_values = array_values($where);

	if (!empty($where)) {
		$query = $wpdb->prepare("SELECT COUNT({$field}) FROM {$table} WHERE " . implode(' AND ', $where_keys), $where_values);
	} else {
		$query = "SELECT COUNT({$field}) FROM {$table}";
	}

	$count = $wpdb->get_var($query);

	return intval($count);
}

/**
 * Outputs the html selected attribute
 *
 * @since 2.0.4
 * @param array $values
 * @param string $current
 * @param bool $echo
 * @return string html attribute or empty string
 */
function wpmm_multiselect($values, $current)
{
	foreach ($values as $k => $role) {
		$is_selected = __checked_selected_helper($role, $current, false, 'selected');
		if (!empty($is_selected)) {
			return $is_selected;
			break;
		}
	}
}

/**
 * Sanitize Google Analytics SiteID code
 *
 * Valid examples:
 * UA-..........
 * UA-..........-....
 *
 * @since 2.0.7
 * @param string $string
 * @return string
 */
function wpmm_sanitize_ga_code($string)
{
	preg_match('/UA-\d{4,10}(-\d{1,4})?/', $string, $matches);

	return isset($matches[0]) ? $matches[0] : '';
}

if (!function_exists('wp_scripts')) {

	/**
	 * Initialize $wp_scripts if it has not been set.
	 *
	 * (to maintain backward compatibility for those with WP < 4.2.0)
	 *
	 * @since 2.0.8
	 * @global WP_Scripts $wp_scripts
	 * @return WP_Scripts instance
	 */
	function wp_scripts()
	{
		global $wp_scripts;

		if (!($wp_scripts instanceof WP_Scripts)) {
			$wp_scripts = new WP_Scripts();
		}

		return $wp_scripts;
	}
}
