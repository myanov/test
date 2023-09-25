<?php

namespace Loc\OrgStructureImport\Service;

use Bitrix\Main\Application;
use Bitrix\Main\Entity\Query;
use Bitrix\Main\Filter\Filter;
use Bitrix\Main\UserTable;

class OrgStructureImport
{
    private array $columns = [
        'ERP_NUMBER' => 0,
        'FIO' => 1,
        'POSITION' => 2,
        'COMPANY' => 3,
        'HEAD' => 4,
        'LEVEL_1' => 5,
        'LEVEL_2' => 6,
        'LEVEL_3' => 7,
        'LEVEL_4' => 8,
        'LEVEL_5' => 9,
        'LEVEL_6' => 10,
        'DEPARTMENT_HEAD' => 11
    ];

    public function getFileName() :string
    {
        UserTable::query()->setSelect([
            'NAME', 'LAST_NAME', 'SECOND_NAME'
        ])->where(Query::filter()
            ->logic('or')
            ->whereExpr("concat(%s, ' ', %s) like '%%Янов%%Максим%%'", ['NAME', 'LAST_NAME'])
        )->getQuery();
        return Application::getDocumentRoot()."/upload/importOrgStructure_".date("Y-m-d H:i:s").".csv";
    }
}