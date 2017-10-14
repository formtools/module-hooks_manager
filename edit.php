<?php

require("../../global/library.php");

use FormTools\Modules;
use FormTools\Modules\HooksManager\Rules;

$module = Modules::initModulePage("admin");
$L = $module->getLangStrings();

$success = true;
$message = "";
if (isset($_POST["add_rule"])) {
    list($success, $message, $hook_id) = Rules::addRule($_POST, $L);
    $_POST["hook_id"] = $hook_id;
}
// this updates a rule and returns the new hook ID
else if (isset($_POST["update_rule"])) {
    list($success, $message, $new_hook_id) = Rules::updateRule($_POST["hook_id"], $_POST, $L);
    $_GET["hook_id"] = $new_hook_id;
}

$hook_id = Modules::loadModuleField("hooks_manager", "hook_id", "hook_id");
$rule_info = Rules::getRule($hook_id);
$hook_info = Rules::getHooks();

$code_hooks = Rules::groupHooksByFile($hook_info["code_hooks"]);
$template_hooks = Rules::groupHooksByFile($hook_info["template_hooks"]);

$js_code_hooks = "var code_hooks = " . json_encode($code_hooks);
$js_template_hooks = "var template_hooks = " . json_encode($template_hooks);

$hook_type = $rule_info["hook_type"];
if ($rule_info["is_custom_hook"] == "yes") {
    $hook_type = "custom";
}

$page_vars = array(
    "g_success" => $success,
    "g_message" => $message,
    "head_title" => $L["phrase_edit_rule"],
    "rule_info"  => $rule_info,
    "code_hooks"     => $code_hooks,
    "template_hooks" => $template_hooks
);

$page_vars["head_js"] =<<< EOF
$js_code_hooks
$js_template_hooks
var rules = [];
rules.push("required,rule_name,{$L["validation_no_rule_name"]}");
rules.push("required,hook_type,{$L["validation_no_hook_type"]}");
rules.push("if:hook_type=code,required,code_hook_dropdown,{$L["validation_no_code_hook"]}");
rules.push("if:hook_type=template,required,template_hook_dropdown,{$L["validation_no_template_hook"]}");
rules.push("if:hook_type=template,required,template_hook_code_type,{$L["validation_no_content_type"]}");
rules.push("if:hook_type=custom,required,custom_hook,{$L["validation_no_custom_hook"]}");
rules.push("if:hook_type=custom,reg_exp,custom_hook,^[a-zA-Z0-9_]+$,{$L["validation_invalid_custom_hook_name"]}");
rules.push("if:hook_type=custom,required,custom_hook_code_type,{$L["validation_no_content_type"]}");

if (hm === undefined) {
  var hm = {};
}
hm.current_code_hook_type = "$hook_type";
$(hm.init_page);
EOF;

$module->displayPage("templates/edit.tpl", $page_vars);
