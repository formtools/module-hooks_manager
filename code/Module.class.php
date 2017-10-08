<?php


namespace FormTools\Modules\HooksManager;

use FormTools\Core;
use FormTools\Module as FormToolsModule;
use PDOException;


class Module extends FormToolsModule
{
    protected $moduleName = "Hooks Manager";
    protected $moduleDesc = "This module lets you embed your own HTML or execute your own code at specific points/events in the Form Tools interface and code.";
    protected $author = "Ben Keen";
    protected $authorEmail = "ben.keen@gmail.com";
    protected $authorLink = "https://formtools.org";
    protected $version = "2.0.0";
    protected $date = "2017-10-07";
    protected $originLanguage = "en_us";
    protected $cssFiles = array("styles.css");

    protected $nav = array(
        "module_name"   => array("index.php", false),
        "word_settings" => array("settings.php", false),
        "word_help"     => array("help.php", false)
    );

    public function install($module_id)
    {
        $db = Core::$db;
        $L = $this->getLangStrings();

        $queries = array();
        $queries[] = "
            CREATE TABLE IF NOT EXISTS {PREFIX}module_hooks_manager_rules (
              hook_id mediumint(9) NOT NULL,
              is_custom_hook enum('yes','no') NOT NULL default 'no',
              status enum('enabled', 'disabled') NOT NULL default 'enabled',
              rule_name varchar(255) NOT NULL,
              code mediumtext NOT NULL,
              hook_code_type enum('na', 'php', 'html', 'smarty') NOT NULL default 'na',
              PRIMARY KEY (hook_id)
            ) DEFAULT CHARSET=utf8
        ";

        $queries[] = "
            INSERT INTO {PREFIX}settings (setting_name, setting_value, module)
            VALUES ('num_rules_per_page', '10', 'hooks_manager')
        ";

        try {
            $db->beginTransaction();
            foreach ($queries as $query) {
                $db->query($query);
                $db->execute();
            }
            $db->processTransaction();
        } catch (PDOException $e) {
            $db->rollbackTransaction();
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
}