<?php

use Bitrix\Main\EventManager;

require_once $_SERVER['DOCUMENT_ROOT'] . '/local/php_interface/include/user_types/user_type_color.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/local/php_interface/include/user_types/custom_field.php';

$eventManager = EventManager::getInstance();
$eventManager->addEventHandler('main', 'OnUserTypeBuildList', ['MyUserType', 'getUserTypeDescription']);
