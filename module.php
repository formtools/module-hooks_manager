<?php

/**
 * Module file: Hooks Manager
 */

$MODULE["author"]          = "Encore Web Studios";
$MODULE["author_email"]    = "formtools@encorewebstudios.com";
$MODULE["author_link"]     = "http://www.encorewebstudios.com";
$MODULE["version"]         = "1.0.2";
$MODULE["date"]            = "2010-10-02";
$MODULE["origin_language"] = "en_us";
$MODULE["supports_ft_versions"] = "2.0.3";

// define the module navigation - the keys are keys defined in the language file. This lets
// the navigation - like everything else - be customized to the users language
$MODULE["nav"] = array(
  "module_name"         => array("index.php", false),
  "word_settings"       => array("settings.php", false),
  "word_help"           => array("help.php", false)
    );