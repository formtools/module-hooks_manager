<?php


/**
 * There was a bug introduced in the Core at some point, preventing hook_calls table entries from
 * being deleted properly (see bug #349). This resulted in this module creating multiple entries in the
 * hook_calls table, so whatever code is in added through Hooks Manager rules are called multiple times on
 * a single submission. To get around it, this module calls this function on the index page & on upgrading.
 * After the Core has been patched, the call on the index page will be removed & this will just be called
 * any time the user upgrades the module.
 */
function hm_clear_dud_hook_call_entries()
{
	global $g_table_prefix;

  $rules = hm_get_rules("all", 1);

  $valid_hook_ids = array();
  foreach ($rules["results"] as $rule_info)
  {
  	$valid_hook_ids[] = $rule_info["hook_id"];
  }

  $hook_id_clause = "";
  if (!empty($valid_hook_ids))
  {
  	$hook_id_clause = "AND hook_id NOT IN (" . implode(",", $valid_hook_ids) . ")";
  }

  mysql_query("
    DELETE FROM {$g_table_prefix}hook_calls
    WHERE module_folder = 'hooks_manager'
    $hook_id_clause
  ");
}