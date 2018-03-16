<?php


namespace FormTools\Modules\HooksManager;

use FormTools\Core;
use FormTools\Hooks;
use FormTools\Modules;
use PDO, PDOException;


class Rules
{

    /**
     * Returns all information about a particular rule.
     *
     * @param integer $page_id
     * @return array
     */
    public static function getRule($hook_id)
    {
        $db = Core::$db;

        $db->query("
            SELECT *
            FROM   {PREFIX}module_hooks_manager_rules hmr, {PREFIX}hook_calls hc
            WHERE  hc.hook_id = hmr.hook_id AND
                   hc.hook_id = :hook_id
        ");
        $db->bind("hook_id", $hook_id);
        $db->execute();

        return $db->fetch();
    }


    /**
     * Returns a page worth of Hooks Manager rules for display purposes.
     *
     * @param mixed $num_per_page a number or "all"
     * @param integer $page_num
     * @return array
     */
    public static function getRules($num_per_page, $page_num = 1)
    {
        $db = Core::$db;

        if ($num_per_page == "all") {
            $db->query("
                SELECT *
                FROM   {PREFIX}module_hooks_manager_rules hmr, {PREFIX}hook_calls hc
                WHERE  hc.hook_id = hmr.hook_id
                ORDER BY hmr.rule_name
            ");
        } else {
            // determine the query offset
            if (empty($page_num)) {
                $page_num = 1;
            }

            $first_item = ($page_num - 1) * $num_per_page;

            $db->query("
                SELECT *
                FROM   {PREFIX}module_hooks_manager_rules hmr, {PREFIX}hook_calls hc
                WHERE  hc.hook_id = hmr.hook_id
                ORDER BY rule_name
                LIMIT $first_item, $num_per_page
            ");
        }
        $db->execute();
        $results = $db->fetchAll();

        $db->query("SELECT count(*) FROM {PREFIX}module_hooks_manager_rules");
        $db->execute();
        $num_results = $db->fetch(PDO::FETCH_COLUMN);

        $return_hash = array(
            "results" => $results,
            "num_results" => $num_results
        );

        return $return_hash;
    }


    /**
     * Adds a new rule to the module_hooks_manager_rules table. Each rule is identified by its unique hook ID, from its
     * corresponding hook entry in the hooks table.
     *
     * @param array $info
     * @return array return array
     */
    public static function addRule($info, $L)
    {
        $hook_type = $info["hook_type"];

        $success = true;
        $message = "";
        $hook_id = "";

        if ($hook_type == "code") {
            list ($success, $message, $hook_id) = self::addCodeRule($info, $L);
        } else if ($hook_type == "template") {
            list ($success, $message, $hook_id) = self::addTemplateRule($info, $L);
        } else if ($hook_type == "custom") {
            list ($success, $message, $hook_id) = self::addCustomRule($info, $L);
        }

        return array($success, $message, $hook_id);
    }


    /**
     * This function registered the new rule for a code hook in the hooks table, and stores all custom Hook Manager data in the
     * hooks_manager_rules table.
     *
     * @param array $info
     */
    private static function addCodeRule($info, $L)
    {
        $db = Core::$db;

        // the code hook dropdown contains the function name, a comma, then the location where it's call (e.g. "start", "end" etc.)
        list ($function_name, $location) = explode(",", $info["code_hook_dropdown"]);

        // register our new rule for this hook
        list ($success, $hook_id) = Hooks::registerHook("code", "hooks_manager", $location, $function_name,
            "parseCodeHook", $info["priority"]);

        if (!$success) {
            return array(false, $L["notify_rule_not_added"]);
        }

        // now store the rest of the info in the module rules table
        try {
            $db->query("
                INSERT INTO {PREFIX}module_hooks_manager_rules (hook_id, is_custom_hook, status, rule_name, code)
                VALUES (:hook_id, :is_custom_hook, :status, :rule_name, :code)
            ");
            $db->bindAll(array(
                "hook_id" => $hook_id,
                "is_custom_hook" => "no",
                "status" => $info["status"],
                "rule_name" => $info["rule_name"],
                "code" => $info["code_hook_code"]
            ));
            $db->execute();

            return array(true, $L["notify_rule_added"], $hook_id);
        } catch (PDOException $e) {
            return array(false, $L["notify_rule_not_added"] . $e->getMessage(), "");
        }
    }


    /**
     * This function registered the new rule for a template hook in the hooks table, and stores all custom Hook Manager data in the
     * hooks_manager_rules table.
     *
     * @param array $info
     */
    private static function addTemplateRule($info, $L)
    {
        $db = Core::$db;

        $action_location = $info["template_hook_dropdown"];

        list ($success, $hook_id) = Hooks::registerHook("template", "hooks_manager", $action_location, "", "parseTemplateHook", $info["priority"]);
        if (!$success) {
            return array(false, $L["notify_rule_not_added"]);
        }

        // now store the rest of the info in the module rules table
        try {
            $db->query("
                INSERT INTO {PREFIX}module_hooks_manager_rules (hook_id, is_custom_hook, status, rule_name, code, hook_code_type)
                VALUES (:hook_id, :is_custom_hook, :status, :rule_name, :code, :hook_code_type)
            ");
            $db->bindAll(array(
                "hook_id" => $hook_id,
                "is_custom_hook" => "no",
                "status" => $info["status"],
                "rule_name" => $info["rule_name"],
                "code" => $info["template_hook_code"],
                "hook_code_type" => $info["template_hook_code_type"]
            ));
            $db->execute();

            return array(true, $L["notify_rule_added"], $hook_id);
        } catch (PDOException $e) {
            return array(false, $L["notify_rule_not_added"] . $e->getMessage(), "");
        }
    }


    /**
     * This function registered the new rule for a custom hook in the hooks table, and stores all
     * custom Hook Manager data in the hooks_manager_rules table. A
     *
     * @param array $info
     */
    private static function addCustomRule($info, $L)
    {
        $db = Core::$db;

        // custom rules are stored as template hooks in the main hooks table. Right now I don't see any point to a "code" custom hook...
        // at this stage, the only real use for custom hooks is in conjunction with the Pages module, which will be template hooks only
        list ($success, $hook_id) = Hooks::registerHook("template", "hooks_manager", $info["custom_hook"], "", "parseTemplateHook", $info["priority"]);

        if (!$success) {
            return array(false, $L["notify_rule_not_added"]);
        }

        // now store the rest of the info in the module rules table
        try {
            $db->query("
                INSERT INTO {PREFIX}module_hooks_manager_rules (hook_id, is_custom_hook, status, rule_name, code, hook_code_type)
                VALUES (:hook_id, :is_custom_hook, :status, :rule_name, :code, :hook_code_type)
            ");
            $db->bindAll(array(
                "hook_id" => $hook_id,
                "is_custom_hook" => "yes",
                "status" => $info["status"],
                "rule_name" => $info["rule_name"],
                "code" => $info["custom_hook_code"],
                "hook_code_type" => $info["custom_hook_code_type"]
            ));
            $db->execute();
            return array(true, $L["notify_rule_added"], $hook_id);
        } catch (PDOException $e) {
            return array(false, $L["notify_rule_not_added"] . $e->getMessage(), "");
        }
    }


    /**
     * Deletes a rule.
     *
     * @param integer $page_id
     */
    public static function deleteRule($hook_id, $L)
    {
        $db = Core::$db;

        // delete the rule in the module and hooks table
        $db->query("DELETE FROM {PREFIX}hook_calls WHERE hook_id = :hook_id");
        $db->bind("hook_id", $hook_id);
        $db->execute();

        $db->query("DELETE FROM {PREFIX}module_hooks_manager_rules WHERE hook_id = :hook_id");
        $db->bind("hook_id", $hook_id);
        $db->execute();

        return array(true, $L["notify_rule_deleted"]);
    }


    /**
     * Updates the (one and only) setting on the Settings page.
     *
     * @param array $info
     * @return array [0] true/false
     *               [1] message
     */
    public static function updateSettings($info, $L)
    {
        Modules::setModuleSettings(array(
            "num_rules_per_page" => $info["num_rules_per_page"]
        ));

        return array(true, $L["notify_settings_updated"]);
    }


    /**
     * Updates a rule. This updates both the core hooks table and the Hooks Manager table. N.B. This
     * function and its template counterpart, works by delete the old hook then recreating a new one
     * in the main hooks table. This is simplest, given the available core functionality. I don't think
     * it's an issue that the hook ID will change when editing a hook; it's not used anywhere within
     * the UI and users won't need to pinpoint a rule by hook ID. We can always change it later, but
     * updating an existing hook in the hooks should really be handled by the core.
     *
     * @param integer $rule_id
     * @param array
     */
    public static function updateRule($hook_id, $info, $L)
    {
        $hook_type = $info["hook_type"];

        $success = true;
        $message = "";
        $new_hook_id = "";

        if ($hook_type == "code") {
            list ($success, $message, $new_hook_id) = self::updateCodeRule($hook_id, $info, $L);
        } else if ($hook_type == "template") {
            list ($success, $message, $new_hook_id) = self::updateTemplateRule($hook_id, $info, $L);
        } else if ($hook_type == "custom") {
            list ($success, $message, $new_hook_id) = self::updateCustomRule($hook_id, $info, $L);
        }

        return array($success, $message, $new_hook_id);
    }


    /**
     * Updates a code rule.
     *
     * @param integer $current_hook_id
     * @param array $info
     */
    private static function updateCodeRule($current_hook_id, $info, $L)
    {
        $db = Core::$db;

        // hook calls only contains live hooks.
        Hooks::deleteHookCall($current_hook_id);

        // the code hook dropdown contains the hook name, a comma, then the location where it's call (e.g. "start", "end" etc.)
        list ($hook_name, $location) = explode(",", $info["code_hook_dropdown"]);
        list ($success, $hook_id) = Hooks::registerHook("code", "hooks_manager", $location, $hook_name, "parseCodeHook", $info["priority"], false);

        try {
            $db->query("
                UPDATE {PREFIX}module_hooks_manager_rules
                SET    hook_id = :hook_id,
                       is_custom_hook = :is_custom_hook,
                       status = :status,
                       rule_name = :rule_name,
                       code = :code
                WHERE  hook_id = :current_hook_id
            ");
            $db->bindAll(array(
                "hook_id" => $hook_id,
                "is_custom_hook" => "no",
                "status" => $info["status"],
                "rule_name" => $info["rule_name"],
                "code" => $info["code_hook_code"],
                "current_hook_id" => $current_hook_id
            ));
            $db->execute();

            return array(true, $L["notify_rule_updated"], $hook_id);
        } catch (PDOException $e) {
            return array(false, $L["notify_rule_not_updated"] . $e->getMessage(), "");
        }
    }


    private static function updateTemplateRule($current_hook_id, $info, $L)
    {
        $db = Core::$db;

        Hooks::deleteHookCall($current_hook_id);

        // the code hook dropdown contains the hook name, a comma, then the location where it's call (e.g. "start", "end" etc.)
        $action_location = $info["template_hook_dropdown"];
        list ($success, $hook_id) = Hooks::registerHook("template", "hooks_manager", $action_location, "", "parseTemplateHook", $info["priority"]);

        try {
            $db->query("
                UPDATE {PREFIX}module_hooks_manager_rules
                SET    hook_id = :hook_id,
                       is_custom_hook = :is_custom_hook,
                       status = :status,
                       rule_name = :rule_name,
                       code = :code,
                       hook_code_type = :hook_code_type
                WHERE  hook_id = :current_hook_id
            ");
            $db->bindAll(array(
                "hook_id" => $hook_id,
                "is_custom_hook" => "no",
                "status" => $info["status"],
                "rule_name" => $info["rule_name"],
                "code" => $info["template_hook_code"],
                "hook_code_type" => $info["template_hook_code_type"],
                "current_hook_id" => $current_hook_id
            ));
            $db->execute();

            return array(true, $L["notify_rule_updated"], $hook_id);
        } catch (PDOException $e) {
            return array(false, $L["notify_rule_not_updated"] . $e->getMessage(), "");
        }
    }


    private static function updateCustomRule($current_hook_id, $info, $L)
    {
        $db = Core::$db;

        $hook_name = $info["custom_hook"];

        Hooks::deleteHookCall($current_hook_id);

        // the code hook dropdown contains the hook name, a comma, then the location where it's call (e.g. "start", "end" etc.)
        list ($success, $hook_id) = Hooks::registerHook("template", "hooks_manager", $hook_name, "", "parseTemplateHook", $info["priority"]);

        try {
            $db->query("
                UPDATE {PREFIX}module_hooks_manager_rules
                SET    hook_id = :hook_id,
                       is_custom_hook = :is_custom_hook,
                       status = :status,
                       rule_name = :rule_name,
                       code = :code,
                       hook_code_type = :hook_code_type
                WHERE  hook_id = :current_hook_id
            ");
            $db->bindAll(array(
                "hook_id" => $hook_id,
                "is_custom_hook" => "yes",
                "status" => $info["status"],
                "rule_name" => $info["rule_name"],
                "code" => $info["custom_hook_code"],
                "hook_code_type" => $info["custom_hook_code_type"],
                "current_hook_id" => $current_hook_id
            ));
            $db->execute();

            return array(true, $L["notify_rule_updated"], $hook_id);
        } catch (PDOException $e) {
            return array(false, $L["notify_rule_not_updated"] . $e->getMessage(), "");
        }
    }


    /**
     * Returns all those rules that are applicable to a particular form.
     *
     * @param integer $form_id
     */
    public static function getFormRules($rule_id)
    {
        $db = Core::$db;

        $db->query("
            SELECT *
            FROM   {PREFIX}module_hooks_manager_rules
            WHERE  rule_id = :rule_id
        ");
        $db->bind("rule_id", $rule_id);
        $db->execute();

        return $db->fetchAll();
    }


    /**
     * This function retrieves and parses out all hook data from the hooks table.
     *
     * @return array a hash with keys "code_hooks" and "template_hooks"
     */
    public static function getHooks()
    {
        $db = Core::$db;

        $db->query("SELECT * FROM {PREFIX}hooks ORDER BY id");
        $db->execute();

        $code_hooks = array();
        $template_hooks = array();
        foreach ($db->fetchAll() as $row) {
            if ($row["hook_type"] == "code") {
                $code_hooks[$row["function_name"] . ", " . $row["action_location"]] = $row;
            } else {
                $template_hooks[] = $row;
            }
        }

        ksort($code_hooks);
        ksort($template_hooks);

        return array(
            "code_hooks" => $code_hooks,
            "template_hooks" => $template_hooks
        );
    }

    public static function groupHooksByFile($hook_info)
    {
        $grouped_by_file = array();

        foreach ($hook_info as $hook_data) {
            $file = $hook_data["filepath"];

            if (!array_key_exists($file, $grouped_by_file)) {
                $grouped_by_file[$file] = array();
            }
            $grouped_by_file[$file][] = $hook_data;
        }

        return $grouped_by_file;
    }
}
