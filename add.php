<?php

require_once("../../global/library.php");

use FormTools\Core;
use FormTools\Modules;
use FormTools\Modules\HooksManager\Rules;

$module = Modules::initModulePage("admin");
$LANG = Core::$L;
$L = $module->getLangStrings();

$hook_info = Rules::getHooks();
$code_hooks = Rules::groupHooksByFile("code_hooks", $hook_info["code_hooks"]);
$template_hooks = Rules::groupHooksByFile("template_hooks", $hook_info["template_hooks"]);

$js_code_hooks = "var code_hooks = " . json_encode($code_hooks);
$js_template_hooks = "var template_hooks = " . json_encode($template_hooks);

$page_vars = array(
    "head_title" => $L["phrase_add_rule"],
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

$(function() { hm.add_rule_init(); });
EOF;

$module->displayPage("templates/add.tpl", $page_vars);
