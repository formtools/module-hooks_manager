<?php


namespace FormTools\Modules\HooksManager;

use FormTools\Core;
use FormTools\General as CoreGeneral;
use FormTools\Module as FormToolsModule;
use Exception;


class Module extends FormToolsModule
{
    protected $moduleName = "Hooks Manager";
    protected $moduleDesc = "This module lets you embed your own HTML or execute your own code at specific points/events in the Form Tools interface and code.";
    protected $author = "Ben Keen";
    protected $authorEmail = "ben.keen@gmail.com";
    protected $authorLink = "https://formtools.org";
    protected $version = "2.0.3";
    protected $date = "2018-03-15";
    protected $originLanguage = "en_us";
    protected $cssFiles = array(
        "{MODULEROOT}/styles.css",
        "{FTROOT}/global/codemirror/lib/codemirror.css"
    );
    protected $jsFiles = array(
        "{MODULEROOT}/hooks_manager.js",
        "{FTROOT}/global/codemirror/lib/codemirror.js",
        "{FTROOT}/global/codemirror/mode/xml/xml.js",
        "{FTROOT}/global/codemirror/mode/smarty/smarty.js",
        "{FTROOT}/global/codemirror/mode/php/php.js",
        "{FTROOT}/global/codemirror/mode/htmlmixed/htmlmixed.js",
        "{FTROOT}/global/codemirror/mode/css/css.js",
        "{FTROOT}/global/codemirror/mode/javascript/javascript.js",
        "{FTROOT}/global/codemirror/mode/clike/clike.js"
    );

    protected $nav = array(
        "module_name"   => array("index.php", false),
        "word_settings" => array("settings.php", false),
        "word_help"     => array("help.php", false)
    );

    public function install($module_id)
    {
        $db = Core::$db;
        $L = $this->getLangStrings();

        try {
            $db->query("
                CREATE TABLE IF NOT EXISTS {PREFIX}module_hooks_manager_rules (
                  hook_id mediumint(9) NOT NULL,
                  is_custom_hook enum('yes','no') NOT NULL default 'no',
                  status enum('enabled', 'disabled') NOT NULL default 'enabled',
                  rule_name varchar(255) NOT NULL,
                  code mediumtext NOT NULL,
                  hook_code_type enum('na', 'php', 'html', 'smarty') NOT NULL default 'na',
                  PRIMARY KEY (hook_id)
                ) Engine=InnoDB DEFAULT CHARSET=utf8
            ");
            $db->execute();

            $db->query("
                INSERT INTO {PREFIX}settings (setting_name, setting_value, module)
                VALUES ('num_rules_per_page', '10', 'hooks_manager')
            ");
            $db->execute();
        } catch (Exception $e) {
            return array(false, $L["text_error_installing"]);
        }

        return array(true, "");
    }


    public function uninstall($module_id)
    {
        $db = Core::$db;
        $db->query("DROP TABLE {PREFIX}module_hooks_manager_rules");
        $db->execute();

        return array(true, "");
    }


    public function upgrade($module_id, $old_module_version)
    {
        if (CoreGeneral::isVersionEarlierThan($old_module_version, "2.0.2")) {
            self::upgradeToFT3();
        }
        return array(true, "custom message");
    }


    /**
     * The parser function for code hooks. This is called whenever a page contains a hook
     * that has a rule (or rules) defined for it within the Hooks Manager.
     */
    public function parseCodeHook($vars)
    {
        // place all variables that have been explicitly passed to this hook as defined in this
        // scope (e.g. $vars["account_id"] becomes $account_id). This is for the sake of the
        // developer using the Hooks Manager UI
        $passed_vars = $vars;
        $overridable_vars = $vars["form_tools_overridable_vars"];

        unset($passed_vars["form_tools_hook_info"]);
        unset($passed_vars["form_tools_overridable_vars"]);
        unset($passed_vars["form_tools_calling_function"]);

        extract($passed_vars);
        $hook_info = Rules::getRule($vars["form_tools_hook_info"]["hook_id"]);

        if ($hook_info["status"] === "disabled") {
            return array(); // $overridable_vars;
        }

        eval($hook_info["code"]);

        // return the overridable values
        $hooks_manager_return_hash = array();
        foreach ($overridable_vars as $var) {
            if (isset($$var)) {
                $hooks_manager_return_hash[$var] = $$var;
            }
        }

        return $hooks_manager_return_hash;
    }


    /**
     * The parser function for template hooks. This is called whenever a page contains a hook
     * that has a rule (or rules) defined for it within the Hooks Manager.
     */
    public static function parseTemplateHook($location, $template_vars)
    {
        $hook_info = $template_vars["form_tools_hook_info"];
        $hook_id = $hook_info["hook_id"];

        // now get the FULL hook info (i.e. with the Hook Manager info)
        $hook_info = Rules::getRule($hook_id);

        // if this hook is disabled, do nothing
        if ($hook_info["status"] != "enabled") {
            return;
        }

        switch ($hook_info["hook_code_type"]) {
            case "html":
                echo $hook_info["code"];
                break;

            case "php":
                eval($hook_info["code"]);
                break;

            case "smarty":
                echo CoreGeneral::evalSmartyString($hook_info["code"]);
                break;
        }
    }

    /**
     * The code hooks all changed with Form Tools 3. Convert all defined hooks that we are able to identify to their
     * FT3 equivalents.
     */
    private static function upgradeToFT3()
    {
        $db = Core::$db;

        $db->query("
            SELECT *
            FROM {PREFIX}hook_calls
            WHERE module_folder = 'hooks_manager'
        ");
        $db->execute();
        $rows = $db->fetchAll();

        foreach ($rows as $row) {
            if ($row["hook_type"] == "template") {
                continue;
            }

            self::convertCodeHookToFT3($row["hook_id"], $row["action_location"], $row["function_name"]);
        }
    }

    private static function convertCodeHookToFT3($hook_id, $action_location, $function_name)
    {
        $db = Core::$db;

        // see if we can find the hook
        $found = false;
        foreach (HookVersionMap::$hookMapFT2ToFT3 as $mapping) {
            $old = $mapping["old"];
            if ($old["action_location"] == $action_location && $old["function_name"] == $function_name) {
                $found = $mapping["new"];
                break;
            }
        }

        if (!$found) {
            return;
        }

        $db->query("
            UPDATE {PREFIX}hook_calls
            SET    action_location = :action_location,
                   function_name = :function_name
            WHERE  hook_id = :hook_id  
        ");
        $db->bindAll(array(
            "action_location" => $found["action_location"],
            "function_name" => $found["function_name"],
            "hook_id" => $hook_id
        ));
        $db->execute();
    }
}

