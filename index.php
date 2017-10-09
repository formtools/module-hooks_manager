<?php

require_once("../../global/library.php");

use FormTools\Core;
use FormTools\General;
use FormTools\Modules;
use FormTools\Modules\HooksManager\Rules;

$module = Modules::initModulePage("admin");
$LANG = Core::$L;
$L = $module->getLangStrings();

$success = true;
$message = "";
if (isset($_POST["add_rule"])) {
    list($success, $message) = Rules::addRule($_POST, $L);
} else if (isset($_GET["delete"])) {
    list($success, $message) = Rules::deleteRule($_GET["delete"], $L);
}

$per_page = Modules::getModuleSettings("num_rules_per_page");

$page = Modules::loadModuleField("hooks_manager", "page", "page", 1);
$rule_info   = Rules::getRules($per_page, $page);
$results     = $rule_info["results"];
$num_results = $rule_info["num_results"];

$page_vars = array();
$page_vars["g_success"] = $success;
$page_vars["g_message"] = $message;
$page_vars["head_title"]  = $L["module_name"];
$page_vars["results"]     = $results;
$page_vars["num_results"] = $num_results;
$page_vars["pagination"] = General::getPageNav($num_results, $per_page, $page, "");
$page_vars["js_messages"] = array("word_edit");
$page_vars["head_js"] =<<< EOF
var page_ns = {};
page_ns.dialog = $("<div></div>");
page_ns.delete_rule = function(rule_id) {

  ft.create_dialog({
    title:      "{$LANG["phrase_please_confirm"]}",
    dialog:     page_ns.dialog,
    content:    "{$L["confirm_delete_rule"]}",
    popup_type: "warning",
    buttons: [
      {
        text:  "{$LANG["word_yes"]}",
        click: function() {
          window.location = 'index.php?delete=' + rule_id;
        }
      },
      {
        text:  "{$LANG["word_no"]}",
        click: function() {
          $(this).dialog("close");
        }
      }
    ]
  });
  return false;
}
EOF;

$module->displayPage("templates/index.tpl", $page_vars);
