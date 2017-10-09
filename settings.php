<?php

require_once("../../global/library.php");

use FormTools\Core;
use FormTools\Modules;
use FormTools\Modules\HooksManager\Rules;

$module = Modules::initModulePage("admin");
$LANG = Core::$L;
$L = $module->getLangStrings();

if (isset($_POST["update"])) {
    list ($g_success, $g_message) = Rules::updateSettings($_POST, $L);
}

$page_vars = array(
    "num_rules_per_page" => Modules::getModuleSettings("num_rules_per_page")
);

$module->displayPage("templates/settings.tpl", $page_vars);
