<?php

use Bitrix\Main\UI\Extension;
use Bitrix\Main\UserField\Types\BaseType;

class MyUserType extends BaseType
{

    const USER_TYPE_ID = 'myusertype';

    public static function getUserTypeDescription (): array
    {
        return array(
            'USER_TYPE_ID' => static::USER_TYPE_ID,
            'CLASS_NAME' => __CLASS__,
            'DESCRIPTION' => 'Кастомное поле',
            'BASE_TYPE' => \CUserTypeManager::BASE_TYPE_STRING,
            'EDIT_CALLBACK' => array(
                __CLASS__,
                'renderEdit'
            ),
            'VIEW_CALLBACK' => array(
                __CLASS__,
                'renderView'
            ),
            'USE_FIELD_COMPONENT' => false
        );
    }

    static function GetDBColumnType(): string
    {
        global $DB;
        switch (strtolower($DB->type)) {
            case "mysql":
                return "text";
            case "oracle":
                return "varchar2(2000 char)";
            case "mssql":
                return "varchar(2000)";
            default:
                return 'text';
        }
    }

    public static function renderField(array $userField, ?array $additionalParameters = []): string
    {
        Extension::load('ui.buttons');
        return '<a href="#" class="ui-btn ui-btn-danger">Button From Custom Field</a>';
    }

    public static function renderView ($userField,
                                          $additionalParameters = array()): string
    {
        $additionalParameters['mode'] = self::MODE_VIEW;
        Extension::load('ui.buttons');
        return '<a href="#" class="ui-btn ui-btn-danger">Button From Custom Field</a>';
    }

    public static function renderEdit ($userField,
                                          $additionalParameters = array()): string
    {
        $additionalParameters['mode'] = self::MODE_EDIT;
        Extension::load('ui.buttons');
        $name = static::getFieldName($userField, $additionalParameters);
        return '<input type="hidden" name="' . $name . '" value="1"/>' .
            '<a href="#" class="ui-btn ui-btn-success">Button From Custom Field</a>';
    }
}
