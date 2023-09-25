<?php

namespace Loc\OrgStructureImport\Controller;

use Bitrix\Main\Application;
use Bitrix\Main\Engine\ActionFilter\Authentication;
use Bitrix\Main\Engine\ActionFilter\Csrf;
use Bitrix\Main\Engine\ActionFilter\HttpMethod;
use Bitrix\Main\Engine\Controller;
use Bitrix\Main\Error;
use Loc\OrgStructureImport\Service\OrgStructureImport;

class OrgStructure extends Controller
{
    private OrgStructureImport $orgStructureService;

    public function configureActions()
    {
        return [
            'import' => [
                'prefilters' => [
                    new HttpMethod([HttpMethod::METHOD_POST]),
                    new Authentication(),
                    new Csrf(),
                ],
                'postfilters' => [],
            ]
        ];
    }

    public function importAction()
    {
        $this->orgStructureService = new OrgStructureImport();

        $request = Application::getInstance()->getContext()->getRequest();
        $file = $request->getFile('imported_file');

        if (!is_array($file))
        {
            $this->addError(new Error('Файл не прикреплён'));
            return null;
        }

        $fileNameParts = explode('.', $file['name']);
        if (!is_array($fileNameParts))
        {
            $this->addError(new Error('Название файла без расширения'));
        }

        if (end($fileNameParts) !== 'csv')
        {
            $this->addError(new Error('Неверное расширение файла. Поддерживаются только файлы формата csv utf-8'));
        }

        move_uploaded_file($file['tmp_name'], $this->orgStructureService->getFileName());
        $csv = file_get_contents($this->orgStructureService->getFileName());
        $rows = explode(PHP_EOL, $csv);

        $headers = explode(';', $rows[0]);

        foreach ($rows as $key => $row) {
            if ($key === 0)
                continue;

            $row = explode(';', $row);
        }
    }
}