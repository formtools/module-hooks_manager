<?php

require_once("../../global/library.php");

use FormTools\Core;
use FormTools\Modules;
use FormTools\Modules\HooksManager\Rules;

$module = Modules::initModulePage("admin");
$LANG = Core::$L;
$L = $module->getLangStrings();

$success = true;
$message = "";
if (isset($_POST["update"])) {
    list ($success, $message) = Rules::updateSettings($_POST, $L);
}

$page_vars = array(
    "g_success" => $success,
    "g_message" => $message,
    "num_rules_per_page" => Modules::getModuleSettings("num_rules_per_page")
);

$module->displayPage("templates/settings.tpl", $page_vars);
