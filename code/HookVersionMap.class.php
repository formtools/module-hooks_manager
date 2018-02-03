<?php

namespace FormTools\Modules\HooksManager;


/**
 * This class provides a map of Form Tools 2 -> 3 code hooks. Template hooks didn't change.
 *
 * Three old code hooks no longer exist:
 *     "action_location" => "end","function_name" => "ft_delete_extended_field_settings"
 *     "action_location" => "end","function_name" => "ft_get_menus"
 *     "action_location" => "end","function_name" => "ft_init_module_page"
 *
 * Class HookVersionMap
 * @package FormTools\Modules\HooksManager
 */
class HookVersionMap
{
    public static $hookMapFT2ToFT3 = array(
        array(
            "old" => array(
                "action_location" => "start",
                "function_name" => "ft_process_form"
            ),
            "new" => array(
                "action_location" => "start",
                "function_name" => "FormTools\\Submissions::processFormSubmission"
            )
        ),
        array(
            "old" => array(
                "action_location" => "end",
                "function_name" => "ft_process_form"
            ),
            "new" => array(
                "action_location" => "end",
                "function_name" => "FormTools\\Submissions::processFormSubmission"
            )
        ),
        array(
            "old" => array(
                "action_location" => "manage_files",
                "function_name" => "ft_process_form"
            ),
            "new" => array(
                "action_location" => "manage_files",
                "function_name" => "FormTools\\Submissions::processFormSubmission"
            )
        ),
        array(
            "old" => array(
                "action_location" => "main",
                "function_name" => "ft_get_account_info"
            ),
            "new" => array(
                "action_location" => "main",
                "function_name" => "FormTools\\Accounts::getAccountInfo"
            )
        ),
        array(
            "old" => array(
                "action_location" => "main",
                "function_name" => "ft_get_account_settings"
            ),
            "new" => array(
                "action_location" => "main",
                "function_name" => "FormTools\\Accounts::getAccountSettings"
            )
        ),
        array(
            "old" => array(
                "action_location" => "main",
                "function_name" => "ft_login"
            ),
            "new" => array(
                "action_location" => "main",
                "function_name" => "FormTools\\User->login"
            )
        ),
        array(
            "old" => array(
                "action_location" => "start",
                "function_name" => "ft_send_password"
            ),
            "new" => array(
                "action_location" => "start",
                "function_name" => "FormTools\\Accounts::sendPassword"
            )
        ),
        array(
            "old" => array(
                "action_location" => "end",
                "function_name" => "ft_send_password"
            ),
            "new" => array(
                "action_location" => "end",
                "function_name" => "FormTools\\Accounts::sendPassword"
            )
        ),
        array(
            "old" => array(
                "action_location" => "start",
                "function_name" => "ft_set_account_settings"
            ),
            "new" => array(
                "action_location" => "start",
                "function_name" => "FormTools\\Accounts::setAccountSettings"
            ),
        ),
        array(
            "old" => array(
                "action_location" => "end",
                "function_name" => "ft_set_account_settings"
            ),
            "new" => array(
                "action_location" => "end",
                "function_name" => "FormTools\\Accounts::setAccountSettings"
            )
        ),
        array(
            "old" => array(
                "action_location" => "start",
                "function_name" => "ft_add_client"
            ),
            "new" => array(
                "action_location" => "start",
                "function_name" => "FormTools\\Administrator::addClient"
            )
        ),
        array(
            "old" => array(
                "action_location" => "end",
                "function_name" => "ft_add_client"
            ),
            "new" => array(
                "action_location" => "end",
                "function_name" => "FormTools\\Administrator::addClient"
            )
        ),
        array(
            "old" => array(
                "action_location" => "start",
                "function_name" => "ft_admin_update_client"
            ),
            "new" => array(
                "action_location" => "start",
                "function_name" => "FormTools\\Administrator::adminUpdateClient"
            )
        ),
        array(
            "old" => array(
                "action_location" => "end",
                "function_name" => "ft_admin_update_client"
            ),
            "new" => array(
                "action_location" => "end",
                "function_name" => "FormTools\\Administrator::adminUpdateClient"
            )
        ),
        array(
            "old" => array(
                "action_location" => "main",
                "function_name" => "ft_get_admin_info",
            ),
            "new" => array(
                "action_location" => "main",
                "function_name" => "FormTools\\Administrator::getAdminInfo"
            )
        ),
        array(
            "old" => array(
                "action_location" => "start",
                "function_name" => "ft_update_admin_account",
            ),
            "new" => array(
                "action_location" => "start",
                "function_name" => "FormTools\\Administrator::updateAdminAccount"
            )
        ),
        array(
            "old" => array(
                "action_location" => "end",
                "function_name" => "ft_update_admin_account",
            ),
            "new" => array(
                "action_location" => "end",
                "function_name" => "FormTools\\Administrator::updateAdminAccount"
            )
        ),
        array(
            "old" => array(
                "action_location" => "start",
                "function_name" => "ft_update_client",
            ),
            "new" => array(
                "action_location" => "start",
                "function_name" => "FormTools\\Clients::updateClient"
            )
        ),
        array(
            "old" => array(
                "action_location" => "end",
                "function_name" => "ft_update_client",
            ),
            "new" => array(
                "action_location" => "end",
                "function_name" => "FormTools\\Clients::updateClient"
            )
        ),
        array(
            "old" => array(
                "action_location" => "end",
                "function_name" => "ft_delete_client",
            ),
            "new" => array(
                "action_location" => "end",
                "function_name" => "FormTools\\Clients::deleteClient"
            )
        ),
        array(
            "old" => array(
                "action_location" => "end",
                "function_name" => "ft_disable_client",
            ),
            "new" => array(
                "action_location" => "end",
                "function_name" => "FormTools\\Clients::disableClient"
            )
        ),
        array(
            "old" => array(
                "action_location" => "start",
                "function_name" => "ft_search_clients",
            ),
            "new" => array(
                "action_location" => "start",
                "function_name" => "FormTools\\Clients::searchClients"
            )
        ),
        array(
            "old" => array(
                "action_location" => "end",
                "function_name" => "ft_search_clients",
            ),
            "new" => array(
                "action_location" => "end",
                "function_name" => "FormTools\\Clients::searchClients"
            )
        ),
        array(
            "old" => array(
                "action_location" => "end",
                "function_name" => "ft_get_client_form_views",
            ),
            "new" => array(
                "action_location" => "end",
                "function_name" => "FormTools\\Clients::getClientFormViews"
            )
        ),
        array(
            "old" => array(
                "action_location" => "end",
                "function_name" => "ft_create_blank_email_template",
            ),
            "new" => array(
                "action_location" => "end",
                "function_name" => "FormTools\\Emails::createBlankEmailTemplate"
            )
        ),
        array(
            "old" => array(
                "action_location" => "end",
                "function_name" => "ft_get_email_templates",
            ),
            "new" => array(
                "action_location" => "end",
                "function_name" => "FormTools\\Emails::getEmailTemplates"
            )
        ),
        array(
            "old" => array(
                "action_location" => "end",
                "function_name" => "ft_get_email_template_list",
            ),
            "new" => array(
                "action_location" => "end",
                "function_name" => "FormTools\\Emails::getEmailTemplateList"
            )
        ),
        array(
            "old" => array(
                "action_location" => "end",
                "function_name" => "ft_get_email_template",
            ),
            "new" => array(
                "action_location" => "end",
                "function_name" => "FormTools\\Emails::getEmailTemplate"
            )
        ),
        array(
            "old" => array(
                "action_location" => "start",
                "function_name" => "ft_send_test_email",
            ),
            "new" => array(
                "action_location" => "start",
                "function_name" => "FormTools\\Emails::sendTestEmail"
            )
        ),
        array(
            "old" => array(
                "action_location" => "end",
                "function_name" => "ft_get_email_patterns",
            ),
            "new" => array(
                "action_location" => "end",
                "function_name" => "FormTools\\Emails::getEmailPatterns"
            )
        ),
        array(
            "old" => array(
                "action_location" => "end",
                "function_name" => "ft_set_field_as_email_field",
            ),
            "new" => array(
                "action_location" => "end",
                "function_name" => "FormTools\\Emails::setFieldAsEmailField"
            )
        ),
        array(
            "old" => array(
                "action_location" => "end",
                "function_name" => "ft_unset_field_as_email_field",
            ),
            "new" => array(
                "action_location" => "end",
                "function_name" => "FormTools\\Emails::unsetFieldAsEmailField"
            )
        ),
        array(
            "old" => array(
                "action_location" => "start",
                "function_name" => "ft_update_email_template",
            ),
            "new" => array(
                "action_location" => "start",
                "function_name" => "FormTools\\Emails::updateEmailTemplate"
            )
        ),
        array(
            "old" => array(
                "action_location" => "end",
                "function_name" => "ft_update_email_template",
            ),
            "new" => array(
                "action_location" => "end",
                "function_name" => "FormTools\\Emails::updateEmailTemplate"
            )
        ),
        array(
            "old" => array(
                "action_location" => "end",
                "function_name" => "ft_get_edit_submission_email_templates",
            ),
            "new" => array(
                "action_location" => "end",
                "function_name" => "FormTools\\Emails::getEditSubmissionEmailTemplates"
            )
        ),
        array(
            "old" => array(
                "action_location" => "start",
                "function_name" => "ft_process_email_template",
            ),
            "new" => array(
                "action_location" => "start",
                "function_name" => "FormTools\\Emails::getEditSubmissionEmailTemplates"
            )
        ),
        array(
            "old" => array(
                "action_location" => "end",
                "function_name" => "ft_add_form_fields",
            ),
            "new" => array(
                "action_location" => "end",
                "function_name" => "FormTools\\Fields::addFormFieldsAdvanced"
            )
        ),
        array(
            "old" => array(
                "action_location" => "end",
                "function_name" => "ft_delete_form_fields",
            ),
            "new" => array(
                "action_location" => "end",
                "function_name" => "FormTools\\Fields::deleteFormFields"
            )
        ),
        array(
            "old" => array(
                "action_location" => "end",
                "function_name" => "ft_get_field_options",
            ),
            "new" => array(
                "action_location" => "end",
                "function_name" => "FormTools\\Fields::getFieldOptions"
            )
        ),
        array(
            "old" => array(
                "action_location" => "end",
                "function_name" => "ft_get_form_field",
            ),
            "new" => array(
                "action_location" => "end",
                "function_name" => "FormTools\\Fields::getFormField"
            )
        ),
        array(
            "old" => array(
                "action_location" => "end",
                "function_name" => "ft_get_form_field_settings",
            ),
            "new" => array(
                "action_location" => "end",
                "function_name" => "FormTools\\Fields::getFormFieldSettings"
            )
        ),
        array(
            "old" => array(
                "action_location" => "end",
                "function_name" => "ft_get_form_fields",
            ),
            "new" => array(
                "action_location" => "end",
                "function_name" => "FormTools\\Fields::getFormFields"
            )
        ),
        array(
            "old" => array(
                "action_location" => "end",
                "function_name" => "ft_get_extended_field_settings",
            ),
            "new" => array(
                "action_location" => "end",
                "function_name" => "FormTools\\Fields::getExtendedFieldSettings"
            )
        ),
        array(
            "old" => array(
                "action_location" => "end",
                "function_name" => "ft_update_form_fields",
            ),
            "new" => array(
                "action_location" => "end",
                "function_name" => "FormTools\\Fields::updateFormFields"
            )
        ),
        array(
            "old" => array(
                "action_location" => "end",
                "function_name" => "ft_update_field",
            ),
            "new" => array(
                "action_location" => "end",
                "function_name" => "FormTools\\Fields::updateField"
            )
        ),
        array(
            "old" => array(
                "action_location" => "start",
                "function_name" => "ft_get_uploaded_files",
            ),
            "new" => array(
                "action_location" => "start",
                "function_name" => "FormTools\\Fields::getUploadedFiles"
            )
        ),
        array(
            "old" => array(
                "action_location" => "start",
                "function_name" => "ft_get_uploaded_files",
            ),
            "new" => array(
                "action_location" => "start",
                "function_name" => "FormTools\\Fields::getUploadedFiles"
            )
        ),
        array(
            "old" => array(
                "action_location" => "end",
                "function_name" => "ft_get_unique_filename",
            ),
            "new" => array(
                "action_location" => "end",
                "function_name" => "FormTools\\Files::getUniqueFilename"
            )
        ),
        array(
            "old" => array(
                "action_location" => "start",
                "function_name" => "ft_delete_submission_files",
            ),
            "new" => array(
                "action_location" => "start",
                "function_name" => "FormTools\\Files::deleteSubmissionFiles"
            )
        ),
        array(
            "old" => array(
                "action_location" => "start",
                "function_name" => "ft_client_update_form_settings",
            ),
            "new" => array(
                "action_location" => "start",
                "function_name" => "FormTools\\Forms::clientUpdateFormSettings"
            )
        ),
        array(
            "old" => array(
                "action_location" => "end",
                "function_name" => "ft_client_update_form_settings",
            ),
            "new" => array(
                "action_location" => "end",
                "function_name" => "FormTools\\Forms::clientUpdateFormSettings"
            )
        ),
        array(
            "old" => array(
                "action_location" => "start",
                "function_name" => "ft_delete_form",
            ),
            "new" => array(
                "action_location" => "start",
                "function_name" => "FormTools\\Forms::deleteForm"
            )
        ),
        array(
            "old" => array(
                "action_location" => "end",
                "function_name" => "ft_finalize_form",
            ),
            "new" => array(
                "action_location" => "end",
                "function_name" => "FormTools\\Forms::finalizeForm"
            )
        ),
        array(
            "old" => array(
                "action_location" => "end",
                "function_name" => "ft_get_form",
            ),
            "new" => array(
                "action_location" => "end",
                "function_name" => "FormTools\\Forms::getForm"
            )
        ),
        array(
            "old" => array(
                "action_location" => "end",
                "function_name" => "ft_get_form_clients",
            ),
            "new" => array(
                "action_location" => "end",
                "function_name" => "FormTools\\Forms::getFormClients"
            )
        ),
        array(
            "old" => array(
                "action_location" => "end",
                "function_name" => "ft_set_form_main_settings",
            ),
            "new" => array(
                "action_location" => "end",
                "function_name" => "FormTools\\Forms::setFormMainSettings"
            )
        ),
        array(
            "old" => array(
                "action_location" => "start",
                "function_name" => "ft_set_form_field_types",
            ),
            "new" => array(
                "action_location" => "start",
                "function_name" => "FormTools\\Forms::setFormFieldTypes"
            )
        ),
        array(
            "old" => array(
                "action_location" => "start",
                "function_name" => "ft_update_form_main_tab",
            ),
            "new" => array(
                "action_location" => "start",
                "function_name" => "FormTools\\Forms::updateFormMainTab"
            )
        ),
        array(
            "old" => array(
                "action_location" => "end",
                "function_name" => "ft_update_form_main_tab",
            ),
            "new" => array(
                "action_location" => "end",
                "function_name" => "FormTools\\Forms::updateFormMainTab"
            )
        ),
        array(
            "old" => array(
                "action_location" => "start",
                "function_name" => "ft_update_form_fields_tab",
            ),
            "new" => array(
                "action_location" => "start",
                "function_name" => "FormTools\\Forms::updateFormFieldsTab"
            )
        ),
        array(
            "old" => array(
                "action_location" => "delete_fields",
                "function_name" => "ft_update_form_fields_tab",
            ),
            "new" => array(
                "action_location" => "delete_fields",
                "function_name" => "FormTools\\Forms::updateFormFieldsTab"
            )
        ),
        array(
            "old" => array(
                "action_location" => "end",
                "function_name" => "ft_update_form_fields_tab",
            ),
            "new" => array(
                "action_location" => "end",
                "function_name" => "FormTools\\Forms::updateFormFieldsTab"
            )
        ),
        array(
            "old" => array(
                "action_location" => "end",
                "function_name" => "_ft_alter_table_column",
            ),
            "new" => array(
                "action_location" => "end",
                "function_name" => "FormTools\\General::alterTableColumn"
            )
        ),
        array(
            "old" => array(
                "action_location" => "start",
                "function_name" => "ft_search_forms",
            ),
            "new" => array(
                "action_location" => "start",
                "function_name" => "FormTools\\Forms::searchForms"
            )
        ),
        array(
            "old" => array(
                "action_location" => "end",
                "function_name" => "ft_search_forms",
            ),
            "new" => array(
                "action_location" => "end",
                "function_name" => "FormTools\\Forms::searchForms"
            )
        ),
        array(
            "old" => array(
                "action_location" => "end",
                "function_name" => "ft_get_public_form_omit_list",
            ),
            "new" => array(
                "action_location" => "end",
                "function_name" => "FormTools\\OmitLists::getPublicFormOmitList"
            )
        ),
        array(
            "old" => array(
                "action_location" => "end",
                "function_name" => "ft_display_custom_page_message",
            ),
            "new" => array(
                "action_location" => "end",
                "function_name" => "FormTools\\General::displayCustomPageMessage"
            )
        ),
        array(
            "old" => array(
                "action_location" => "end",
                "function_name" => "ft_eval_smarty_string",
            ),
            "new" => array(
                "action_location" => "end",
                "function_name" => "FormTools\\General::evalSmartyString"
            )
        ),
        array(
            "old" => array(
                "action_location" => "main",
                "function_name" => "ft_check_client_may_view",
            ),
            "new" => array(
                "action_location" => "main",
                "function_name" => "FormTools\\General::checkClientMayView"
            )
        ),
        array(
            "old" => array(
                "action_location" => "end",
                "function_name" => "ft_generate_js_messages",
            ),
            "new" => array(
                "action_location" => "end",
                "function_name" => "FormTools\\General::generateJsMessages"
            )
        ),
        array(
            "old" => array(
                "action_location" => "end",
                "function_name" => "ft_get_submission_placeholders",
            ),
            "new" => array(
                "action_location" => "end",
                "function_name" => "FormTools\\General::getSubmissionPlaceholders"
            )
        ),
        array(
            "old" => array(
                "action_location" => "end",
                "function_name" => "ft_get_submission_placeholders",
            ),
            "new" => array(
                "action_location" => "end",
                "function_name" => "FormTools\\General::getSubmissionPlaceholders"
            )
        ),
        array(
            "old" => array(
                "action_location" => "end",
                "function_name" => "ft_get_menu_list",
            ),
            "new" => array(
                "action_location" => "end",
                "function_name" => "FormTools\\Menus::getMenuList"
            )
        ),
        array(
            "old" => array(
                "action_location" => "end",
                "function_name" => "ft_get_admin_menu",
            ),
            "new" => array(
                "action_location" => "end",
                "function_name" => "FormTools\\Menus::getAdminMenu"
            )
        ),
        array(
            "old" => array(
                "action_location" => "end",
                "function_name" => "ft_get_client_menu",
            ),
            "new" => array(
                "action_location" => "end",
                "function_name" => "FormTools\\Menus::getClientMenu"
            )
        ),
        array(
            "old" => array(
                "action_location" => "end",
                "function_name" => "ft_get_menu_items",
            ),
            "new" => array(
                "action_location" => "end",
                "function_name" => "FormTools\\Menus::getMenuItems"
            )
        ),
        array(
            "old" => array(
                "action_location" => "middle",
                "function_name" => "ft_get_admin_menu_pages_dropdown",
            ),
            "new" => array(
                "action_location" => "middle",
                "function_name" => "FormTools\\Menus::getAdminMenuPagesDropdown"
            )
        ),
        array(
            "old" => array(
                "action_location" => "middle",
                "function_name" => "ft_get_client_menu_pages_dropdown"
            ),
            "new" => array(
                "action_location" => "middle",
                "function_name" => "FormTools\\Menus::getAdminMenuPagesDropdown"
            )
        ),
        array(
            "old" => array(
                "action_location" => "middle",
                "function_name" => "ft_get_client_menu_pages_dropdown"
            ),
            "new" => array(
                "action_location" => "middle",
                "function_name" => "FormTools\\Menus::getClientMenuPagesDropdown"
            )
        ),
        array(
            "old" => array(
                "action_location" => "end",
                "function_name" => "ft_update_admin_menu"
            ),
            "new" => array(
                "action_location" => "end",
                "function_name" => "FormTools\\Menus::updateAdminMenu"
            )
        ),
        array(
            "old" => array(
                "action_location" => "end",
                "function_name" => "ft_update_menu_order"
            ),
            "new" => array(
                "action_location" => "end",
                "function_name" => "FormTools\\Menus::updateMenuOrder"
            )
        ),
        array(
            "old" => array(
                "action_location" => "end",
                "function_name" => "ft_update_client_menu"
            ),
            "new" => array(
                "action_location" => "end",
                "function_name" => "FormTools\\Menus::updateClientMenu"
            )
        ),
        array(
            "old" => array(
                "action_location" => "end",
                "function_name" => "ft_get_page_url"
            ),
            "new" => array(
                "action_location" => "end",
                "function_name" => "FormTools\\Pages::getPageUrl"
            )
        ),
        array(
            "old" => array(
                "action_location" => "start",
                "function_name" => "ft_construct_page_url"
            ),
            "new" => array(
                "action_location" => "start",
                "function_name" => "FormTools\\Pages::constructPageURL"
            )
        ),
        array(
            "old" => array(
                "action_location" => "start",
                "function_name" => "ft_delete_client_menu"
            ),
            "new" => array(
                "action_location" => "start",
                "function_name" => "FormTools\\Menus::deleteClientMenu"
            )
        ),
        array(
            "old" => array(
                "action_location" => "end",
                "function_name" => "ft_uninstall_module"
            ),
            "new" => array(
                "action_location" => "end",
                "function_name" => "FormTools\\Modules::uninstallModule"
            )
        ),
        array(
            "old" => array(
                "action_location" => "end",
                "function_name" => "ft_get_module"
            ),
            "new" => array(
                "action_location" => "end",
                "function_name" => "FormTools\\Modules::getModule"
            )
        ),
        array(
            "old" => array(
                "action_location" => "start",
                "function_name" => "ft_search_modules"
            ),
            "new" => array(
                "action_location" => "start",
                "function_name" => "FormTools\\Modules::searchModules"
            )
        ),
        array(
            "old" => array(
                "action_location" => "start",
                "function_name" => "ft_get_modules"
            ),
            "new" => array(
                "action_location" => "start",
                "function_name" => "FormTools\\Modules::getList"
            )
        ),
        array(
            "old" => array(
                "action_location" => "start",
                "function_name" => "ft_include_module"
            ),
            "new" => array(
                "action_location" => "start",
                "function_name" => "FormTools\\Modules::includeModule"
            )
        ),
        array(
            "old" => array(
                "action_location" => "start",
                "function_name" => "ft_module_override_data"
            ),
            "new" => array(
                "action_location" => "start",
                "function_name" => "FormTools\\Modules::moduleOverrideData"
            )
        ),
        array(
            "old" => array(
                "action_location" => "end",
                "function_name" => "ft_get_option_lists"
            ),
            "new" => array(
                "action_location" => "end",
                "function_name" => "FormTools\\OptionLists::getList"
            )
        ),
        array(
            "old" => array(
                "action_location" => "end",
                "function_name" => "ft_update_option_list"
            ),
            "new" => array(
                "action_location" => "end",
                "function_name" => "FormTools\\OptionLists::updateOptionList"
            )
        ),
        array(
            "old" => array(
                "action_location" => "end",
                "function_name" => "ft_delete_option_list"
            ),
            "new" => array(
                "action_location" => "end",
                "function_name" => "FormTools\\OptionLists::deleteOptionList"
            )
        ),
        array(
            "old" => array(
                "action_location" => "end",
                "function_name" => "ft_update_main_settings"
            ),
            "new" => array(
                "action_location" => "end",
                "function_name" => "FormTools\\Settings::updateMainSettings"
            )
        ),
        array(
            "old" => array(
                "action_location" => "end",
                "function_name" => "ft_update_account_settings"
            ),
            "new" => array(
                "action_location" => "end",
                "function_name" => "FormTools\\Settings::updateAccountSettings"
            )
        ),
        array(
            "old" => array(
                "action_location" => "end",
                "function_name" => "ft_update_file_settings"
            ),
            "new" => array(
                "action_location" => "end",
                "function_name" => "FormTools\\Settings::updateFileSettings"
            )
        ),
        array(
            "old" => array(
                "action_location" => "end",
                "function_name" => "ft_update_theme_settings"
            ),
            "new" => array(
                "action_location" => "end",
                "function_name" => "FormTools\\Settings::updateThemeSettings"
            )
        ),
        array(
            "old" => array(
                "action_location" => "end",
                "function_name" => "ft_create_blank_submission"
            ),
            "new" => array(
                "action_location" => "end",
                "function_name" => "FormTools\\Submissions::createBlankSubmission"
            )
        ),
        array(
            "old" => array(
                "action_location" => "start",
                "function_name" => "ft_delete_submission"
            ),
            "new" => array(
                "action_location" => "start",
                "function_name" => "FormTools\\Submissions::deleteSubmission"
            )
        ),
        array(
            "old" => array(
                "action_location" => "end",
                "function_name" => "ft_delete_submission"
            ),
            "new" => array(
                "action_location" => "end",
                "function_name" => "FormTools\\Submissions::deleteSubmission"
            )
        ),
        array(
            "old" => array(
                "action_location" => "start",
                "function_name" => "ft_delete_submissions"
            ),
            "new" => array(
                "action_location" => "start",
                "function_name" => "FormTools\\Submissions::deleteSubmissions"
            )
        ),
        array(
            "old" => array(
                "action_location" => "end",
                "function_name" => "ft_delete_submissions"
            ),
            "new" => array(
                "action_location" => "end",
                "function_name" => "FormTools\\Submissions::deleteSubmissions"
            )
        ),
        array(
            "old" => array(
                "action_location" => "end",
                "function_name" => "ft_get_submission"
            ),
            "new" => array(
                "action_location" => "end",
                "function_name" => "FormTools\\Submissions::getSubmission"
            )
        ),
        array(
            "old" => array(
                "action_location" => "end",
                "function_name" => "ft_get_submission_info"
            ),
            "new" => array(
                "action_location" => "end",
                "function_name" => "FormTools\\Submissions::getSubmissionInfo"
            )
        ),
        array(
            "old" => array(
                "action_location" => "start",
                "function_name" => "ft_update_submission"
            ),
            "new" => array(
                "action_location" => "start",
                "function_name" => "FormTools\\Submissions::updateSubmission"
            )
        ),
        array(
            "old" => array(
                "action_location" => "manage_files",
                "function_name" => "ft_update_submission"
            ),
            "new" => array(
                "action_location" => "manage_files",
                "function_name" => "FormTools\\Submissions::updateSubmission"
            )
        ),
        array(
            "old" => array(
                "action_location" => "end",
                "function_name" => "ft_update_submission"
            ),
            "new" => array(
                "action_location" => "end",
                "function_name" => "FormTools\\Submissions::updateSubmission"
            )
        ),
        array(
            "old" => array(
                "action_location" => "end",
                "function_name" => "ft_search_submissions"
            ),
            "new" => array(
                "action_location" => "end",
                "function_name" => "FormTools\\Submissions::searchSubmissions"
            )
        ),
        array(
            "old" => array(
                "action_location" => "main",
                "function_name" => "ft_display_submission_listing_quicklinks"
            ),
            "new" => array(
                "action_location" => "main",
                "function_name" => "FormTools\\Submissions::displaySubmissionListingQuicklinks"
            )
        ),
        array(
            "old" => array(
                "action_location" => "end",
                "function_name" => "ft_get_theme"
            ),
            "new" => array(
                "action_location" => "end",
                "function_name" => "FormTools\\Themes::getTheme"
            )
        ),
        array(
            "old" => array(
                "action_location" => "end",
                "function_name" => "ft_get_theme_by_theme_folder"
            ),
            "new" => array(
                "action_location" => "end",
                "function_name" => "FormTools\\Themes::getThemeByThemeFolder"
            )
        ),
        array(
            "old" => array(
                "action_location" => "end",
                "function_name" => "ft_get_themes"
            ),
            "new" => array(
                "action_location" => "end",
                "function_name" => "FormTools\\Themes::getList"
            )
        ),
        array(
            "old" => array(
                "action_location" => "main",
                "function_name" => "ft_display_page"
            ),
            "new" => array(
                "action_location" => "main",
                "function_name" => "FormTools\\Themes::displayPage"
            )
        ),
        array(
            "old" => array(
                "action_location" => "main",
                "function_name" => "ft_display_module_page"
            ),
            "new" => array(
                "action_location" => "main",
                "function_name" => "FormTools\\Themes::displayModulePage"
            )
        ),
        array(
            "old" => array(
                "action_location" => "end",
                "function_name" => "ft_get_view"
            ),
            "new" => array(
                "action_location" => "end",
                "function_name" => "FormTools\\Views::getView"
            )
        ),
        array(
            "old" => array(
                "action_location" => "end",
                "function_name" => "ft_get_views"
            ),
            "new" => array(
                "action_location" => "end",
                "function_name" => "FormTools\\Views::getViews"
            )
        ),
        array(
            "old" => array(
                "action_location" => "end",
                "function_name" => "ft_get_view_ids"
            ),
            "new" => array(
                "action_location" => "end",
                "function_name" => "FormTools\\Views::getViewIds"
            )
        ),
        array(
            "old" => array(
                "action_location" => "end",
                "function_name" => "ft_get_view_tabs"
            ),
            "new" => array(
                "action_location" => "end",
                "function_name" => "FormTools\\ViewTabs::getViewTabs"
            )
        ),
        array(
            "old" => array(
                "action_location" => "end",
                "function_name" => "ft_create_new_view"
            ),
            "new" => array(
                "action_location" => "end",
                "function_name" => "FormTools\\Views::createView"
            )
        ),
        array(
            "old" => array(
                "action_location" => "end",
                "function_name" => "ft_delete_view"
            ),
            "new" => array(
                "action_location" => "end",
                "function_name" => "FormTools\\Views::deleteView"
            )
        ),
        array(
            "old" => array(
                "action_location" => "end",
                "function_name" => "ft_get_view_clients"
            ),
            "new" => array(
                "action_location" => "end",
                "function_name" => "FormTools\\Views::getViewClients"
            )
        ),
        array(
            "old" => array(
                "action_location" => "end",
                "function_name" => "ft_update_view"
            ),
            "new" => array(
                "action_location" => "end",
                "function_name" => "FormTools\\Views::updateView"
            )
        ),
        array(
            "old" => array(
                "action_location" => "start",
                "function_name" => "ft_get_view_filter_sql"
            ),
            "new" => array(
                "action_location" => "start",
                "function_name" => "FormTools\\ViewFilters::getViewFilterSql"
            )
        ),
        array(
            "old" => array(
                "action_location" => "end",
                "function_name" => "ft_get_form_views"
            ),
            "new" => array(
                "action_location" => "end",
                "function_name" => "FormTools\\Views::getFormViews"
            )
        ),
        array(
            "old" => array(
                "action_location" => "end",
                "function_name" => "ft_get_view_list"
            ),
            "new" => array(
                "action_location" => "end",
                "function_name" => "FormTools\\Views::getViewList"
            )
        ),
        array(
            "old" => array(
                "action_location" => "start",
                "function_name" => "ft_api_process_form"
            ),
            "new" => array(
                "action_location" => "start",
                "function_name" => "FormTools\\API->processFormSubmission"
            )
        ),
        array(
            "old" => array(
                "action_location" => "manage_files",
                "function_name" => "ft_api_process_form"
            ),
            "new" => array(
                "action_location" => "manage_files",
                "function_name" => "FormTools\\API->processFormSubmission"
            )
        ),
        array(
            "old" => array(
                "action_location" => "start",
                "function_name" => "ft_process_email_template"
            ),
            "new" => array(
                "action_location" => "start",
                "function_name" => "FormTools\\Emails::processEmailTemplate"
            )
        ),
        array(
            "old" => array(
                "action_location" => "end",
                "function_name" => "ft_check_permission"
            ),
            "new" => array(
                "action_location" => "start", // not a typo. It was originally incorrect (or at least, it's at the start of the method in FT3)
                "function_name" => "FormTools\\User->checkAuth"
            )
        ),
        array(
            "old" => array(
                "action_location" => "end",
                "function_name" => "ft_get_module_menu_items"
            ),
            "new" => array(
                "action_location" => "end",
                "function_name" => "FormTools\\ModuleMenu::getMenuItems"
            )
        )

    );
}
