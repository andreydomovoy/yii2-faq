<?php

namespace ando\faq;

use yii\base\Module as BaseModule;

class Module extends BaseModule
{
    const VERSION = '0.1.0';

    public $layout = "main.php";
    public $layoutPath = "/view/layouts";

    public $urlPrefix = 'faq';

    public $urlRules = [
        'public'                => 'public/index',
        'search'                => 'public/search',
        'admin/qa'              => 'admin/qa/index',
        'admin/create-group'    => 'admin/groups/create',
        'admin/update-group'    => 'admin/groups/update',
        'admin/delete-group'    => 'admin/groups/delete',
        'admin'                 => 'admin/groups/index',
    ];
}