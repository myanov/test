<?php

use Bitrix\Main\EventManager;
use Bitrix\Main\UI\Extension;
global $APPLICATION;

$eventManager = EventManager::getInstance();
$eventManager->addEventHandler('main', 'OnAfterEpilog', 'dumpViews');

function dumpViews()
{
    global $APPLICATION;
    echo 123;
}
/*
Extension::load('ui.buttons');
Extension::load('ui.buttons.icons');

// Пример 1: Добавляем кнопку.

ob_start();
?>
    <div class="pagetitle-container">
        <a href="#" class="ui-btn ui-btn-light-border ui-btn-icon-info">Отчет</a>
    </div>
<?
$customHtml = ob_get_clean();

$APPLICATION->AddViewContent('above_pagetitle', $customHtml, 10000);
*/