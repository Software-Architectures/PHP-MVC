<?php

declare(strict_types=1);

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\NamesModel;

class IndexController extends BaseController
{
    public function __invoke(int $index = 0)
    {
        $model = new NamesModel();
        $this->render('index', ['name'=>$model->getNameByIndex(0)]);
    }
}